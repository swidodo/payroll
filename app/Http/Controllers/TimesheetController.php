<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LevelApproval;
use App\Models\Timesheet;
use App\Models\TimesheetApproval;
use App\Models\Utility;
use App\Models\Branch;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TimesheetController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage timesheet')) {
            $branches = Branch::where('id',Auth::user()->branch_id)->first();
            if (Auth::user()->initial != 'HO') {
                $employee     = Employee::where('id', '=', Auth::user()->employee->id)->get();
                $timesheets = Timesheet::where('employee_id', '=', Auth::user()->employee->id)->get();
                $branch = Branch::where('id',$branches->id)->get();
                //3 tier approval
                if (!is_null($employee[0]->level_approval)) {
                    $levelApprove = $employee[0]->approval;

                    $approval = TimesheetApproval::where('level', $levelApprove->level)
                        ->where('is_approver_company', false)
                        ->where('approver_id', $employee[0]->id)
                        ->get();
                    foreach ($approval as $key => $value) {
                        $timesheets = collect($timesheets)->prepend($value->timesheet);
                        $employee = collect($employee)->prepend($value->timesheet->employee);
                    }
                }
                //3 tier approval
            } else {
                $timesheets = Timesheet::where('created_by', '=', Auth::user()->creatorId())->get();
                $employee     = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
                $branch = Branch::where('company_id',$branches->company_id)->get();
            }

            return view('pages.contents.timesheet.index', compact('branch','employee', 'timesheets'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('dashboard');
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('create timesheet')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'employee_id'       => 'required',
                    'start_date'        => 'required',
                    'end_date'          => 'required',
                    'project_stage'     => 'required',
                    'task_or_project'   => 'required',
                    'activity'          => 'required',
                    'client_company'    => 'required',
                    'label_project'     => 'required',
                    'support'           => 'required',
                    // 'remark'            => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            if (Auth::user()->type == 'company') {
                if ($request->file()) {
                    $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
                    $filePath = $request->file('attachment')->storeAs('public', $fileName);
                    $request['file_attachment'] = 'storage/' . $fileName ?? null;
                }

                $request['status'] = 'Approved';
                $request['created_by'] = Auth::user()->creatorId();

                try {
                    DB::beginTransaction();
                    $model = Timesheet::create($request->except('attachment'));
                    Utility::insertToRequest($model, Auth::user(), 'Timesheet');

                    DB::commit();
                    toast('Timesheet  successfully created.', 'success');
                } catch (Exception $e) {
                    DB::rollback();
                    toast('Terjadi Kesalahan saat Input Data.', 'error');
                    return redirect()->back();
                }
            } else {
                if ($request->file()) {
                    $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
                    $filePath = $request->file('attachment')->storeAs('public', $fileName);
                    $request['file_attachment'] = 'storage/' . $fileName ?? null;
                }

                $request['status'] = 'Pending';
                $request['created_by'] = Auth::user()->creatorId();

                try {
                    DB::beginTransaction();
                    $model = Timesheet::create($request->except('attachment'));

                    // 3 Tier Approval
                    $levels = LevelApproval::where('created_by', Auth::user()->creatorId())->get();
                    foreach ($levels as $key => $value) {
                        TimesheetApproval::create([
                            'timesheet_id'          => $model->id,
                            'level'                 => $value->level,
                            'is_approver_company'   => $value->company_id ? true : false,
                            'approver_id'           => isset($value->company_id) ? $value->company_id : $value->employee_id,
                            'status'                => 'Pending',
                            'created_by'            => Auth::user()->creatorId(),
                        ]);
                    }
                    // 3 Tier Approval

                    Utility::insertToRequest($model, Auth::user(), 'Timesheet');

                    DB::commit();
                    toast('Timesheet  successfully created.', 'success');
                } catch (Exception $e) {
                    DB::rollback();
                    toast('Terjadi Kesalahan saat Input Data.', 'error');
                    return redirect()->back();
                }
            }

            return redirect()->route('timesheets.index');
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function edit(Timesheet $timesheet)
    {
        if (Auth::user()->can('edit timesheet')) {
            // $employees = Employee::where('created_by', Auth::user()->creatorId())->get()->pluck('name', 'id');

            if ($timesheet->created_by == Auth::user()->creatorId()) {

                // 3 Tier Approval
                if (Auth::user()->type == 'company') {
                    $levelApprove = LevelApproval::where('created_by', '=', Auth::user()->creatorId())
                        ->where('company_id', Auth::user()->creatorId())
                        ->first();
                } elseif (Auth::user()->type != 'company' && Auth::user()->type != 'client') {
                    $levelApprove = LevelApproval::where('created_by', '=', Auth::user()->creatorId())
                        ->where('employee_id', isset(Auth::user()->employee) ? Auth::user()->employee->id : 0)
                        ->first();
                }

                $overtimeApprovals = $timesheet->timesheet_approvals()->orderBy('level', 'asc')->get();
                $levelAndApprovals = Utility::getLevelAndApprover($levelApprove, $overtimeApprovals);
                // 3 Tier Approval

                return response()->json([
                    $timesheet,
                    'leaveApprovals' => $levelAndApprovals['approver'],
                    'level_approve' => $levelAndApprovals['level']
                ]);
            } else {
                return response()->json(['error' => 'Permission denied.'], 401);
            }
        } else {
            return response()->json(['error' => 'Permission denied.'], 401);
        }
    }

    public function show($id)
    {
        $timesheet = Timesheet::find($id);
        $fileType = null;

        if (!is_null($timesheet->attachment_reject)) {
            $fileType = Utility::getFileType($timesheet->attachment_reject);
        }

        return view('pages.contents.timesheet.detail-rejected', compact('timesheet', 'fileType'));
    }

    public function update(Request $request, Timesheet $timesheet)
    {
        if (Auth::user()->can('create timesheet')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'employee_id'       => 'required',
                    'start_date'        => 'required',
                    'end_date'          => 'required',
                    'project_stage'     => 'required',
                    'task_or_project'   => 'required',
                    'activity'          => 'required',
                    'client_company'    => 'required',
                    'label_project'     => 'required',
                    'support'           => 'required',
                    // 'remark'            => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            if ($request->file('attachment')) {
                $fileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
                $request->file('attachment')->storeAs('public', $fileName);
                $path = 'storage/' . $fileName;
                $request['file_attachment'] = $path ?? null;
            }
            if ($request->file('attachment_rejected')) {
                $fileNameReject = time() . '_' . $request->file('attachment_rejected')->getClientOriginalName();
                $request->file('attachment_rejected')->storeAs('public', $fileNameReject);
                $pathRejectedFileAtt = 'storage/' . $fileNameReject;
                $request['attachment_reject'] = $pathRejectedFileAtt ?? null;
            }

            $request['status']          = $request->status;
            $request['rejected_reason'] = isset($request->rejected_reason) ? $request->rejected_reason : null;
            $request['created_by'] = Auth::user()->creatorId();

            try {
                DB::beginTransaction();
                $timesheet->update($request->except('attachment', 'status'));

                // 3 Tier Approval
                if (isset($request->status) && $request->status != 0 && isset($request->level_approve) && $timesheet->status != 'Rejected') {
                    $timesheetApprove = TimesheetApproval::where('timesheet_id', $timesheet->id)
                        ->where('level', $request->level_approve)
                        ->where('status', 'Pending')
                        ->first();


                    if (!is_null($timesheetApprove)) {
                        //check if employee can be a approver
                        $employee = Employee::find($timesheetApprove->approver_id);
                        $level = null;
                        if ($employee) {
                            $level = LevelApproval::where('created_by', Auth::user()->creatorId())
                                ->where('employee_id', $employee->id)
                                ->first();
                        }

                        if ($timesheetApprove->is_approver_company && Auth::user()->type == 'company') {
                            if ($request->status == 'Rejected') {
                                $timesheetApprove->status = 'Rejected';
                                $timesheet->status           =  'Rejected';
                                $timesheet->save();
                            } else {
                                $timesheetApprove->status = $request->status;
                            }
                            $timesheetApprove->save();
                        } elseif (!$timesheetApprove->is_approver_company && Auth::user()->type != 'company' && !is_null($level)) {
                            if ($request->status == 'Rejected') {
                                $timesheetApprove->status = 'Rejected';
                                $timesheet->status           =  'Rejected';
                                $timesheet->save();
                            } else {
                                $timesheetApprove->status = $request->status;
                            }

                            $timesheetApprove->save();
                        }
                    }

                    $countTimesheetApproved = TimesheetApproval::where('timesheet_id', $timesheet->id)
                        ->where('status', 'Approved')
                        ->count();
                    $countLevel = LevelApproval::where('created_by', Auth::user()->creatorId())->count();
                    if ($countTimesheetApproved == $countLevel) {
                        $timesheet->status       =  'Approved';
                        $timesheet->save();
                    }
                }
                // 3 Tier Approval

                DB::commit();
                toast('Timesheet  successfully updated.', 'success');
                return redirect()->route('timesheets.index');
            } catch (Exception $e) {
                DB::rollback();
                toast('an error occurred while updating the data' . $e, 'error');
                return redirect()->route('timesheets.index');
            }

            return redirect()->route('timesheets.index');
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('timesheets.index');;
        }
    }

    public function destroy(Timesheet $timesheet)
    {
        if (Auth::user()->can('delete timesheet')) {
            if ($timesheet->created_by == Auth::user()->creatorId()) {
                if ($timesheet->attachment_reject != null) {
                    $fileNameAttReject = explode('/', $timesheet->attachment_reject);
                    if (Storage::exists('public/' . $fileNameAttReject[1])) {
                        Storage::delete('public/' . $fileNameAttReject[1]);
                    }
                }

                if ($timesheet->file_attachment != null) {
                    $fileNameAttFile = explode('/', $timesheet->file_attachment);
                    if (Storage::exists('public/' . $fileNameAttFile[1])) {
                        Storage::delete('public/' . $fileNameAttFile[1]);
                    }
                }

                $timesheet->delete();

                toast('Timesheet successfully deleted.', 'success');
                return redirect()->route('timesheets.index');
            } else {
                toast('Permission denied.', 'error');
                return redirect()->route('timesheets.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('timesheets.index');
        }
    }

    public function recordTime(Request $request)
    {
        if (Auth::user()->type != 'company' || Auth::user()->type != 'client') {
            $validator = Validator::make(
                $request->all(),
                [
                    'time_now'       => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            $timesheet = Timesheet::where('employee_id', Auth::user()->employee->id)->where('created_by', '=', Auth::user()->creatorId())->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->first();

            if ($timesheet->start_time == null) {
                $timesheet->start_time = $request->time_now;
            } else {
                $timesheet->end_time = $request->time_now;

                $totalDuration = strtotime($timesheet->end_time) - strtotime($timesheet->start_time);
                $hours                    = floor($totalDuration / 3600);
                $mins                     = floor($totalDuration / 60 % 60);
                $secs                     = floor($totalDuration % 60);
                $duration                 = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

                $timesheet->duration = $duration;
            }
            $timesheet->save();

            toast('Success Record Time', 'success');
            return redirect()->route('dashboard');
        } else {
            toast('Permission denied.', 'error');
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
}
