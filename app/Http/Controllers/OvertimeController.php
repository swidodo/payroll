<?php

namespace App\Http\Controllers;

use App\Models\DayType;
use App\Models\Employee;
use App\Models\LevelApproval;
use App\Models\Overtime;
use App\Models\OvertimeApproval;
use App\Models\OvertimeType;
use App\Models\Utility;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage overtime')) {
            // belum selesai nunggu kelanjutan dr mb elyn
            if (Auth::user()->type != 'company') {
                $user     = Auth::user();
                $employee = Employee::where('user_id', '=', $user->id)->get();
                $overtimes  = Overtime::where('employee_id', '=', $user->employee->id)->get();
                $overtimeTypes = OvertimeType::where('created_by', '=', Auth::user()->creatorId())->get();
                $dayTypes      = DayType::where('created_by', '=', Auth::user()->creatorId())->get();

                //3 tier approval
                if (!is_null($employee[0]->level_approval)) {
                    $levelApprove = $employee[0]->approval;

                    $approval = OvertimeApproval::where('level', $levelApprove->level)
                        ->where('is_approver_company', false)
                        ->where('approver_id', $employee[0]->id)
                        ->get();
                    foreach ($approval as $key => $value) {
                        $overtimes = collect($overtimes)->prepend($value->overtime);
                        $employee = collect($employee)->prepend($value->overtime->employee);
                    }
                }
                //3 tier approval

                return view('pages.contents.time-management.overtime.index', compact('overtimes', 'employee', 'overtimeTypes', 'dayTypes'));
            } else {
                $overtimes = Overtime::where('created_by', '=', Auth::user()->creatorId())->get();
                $employee  = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
                $overtimeTypes = OvertimeType::where('created_by', '=', Auth::user()->creatorId())->get();
                $dayTypes      = DayType::where('created_by', '=', Auth::user()->creatorId())->get();

                return view('pages.contents.time-management.overtime.index', compact('overtimes', 'employee', 'overtimeTypes', 'dayTypes'));
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('dashboard');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('create overtime')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'employee_id' => 'required',
                    'overtime_type_id' => 'required',
                    'day_type_id' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'start_time' => 'required',
                    'end_time' => 'required',
                    // 'duration' => 'required',
                    // 'notes' => 'required',
                    // 'status' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }
            try {
                DB::beginTransaction();
                $employee       = Employee::where('id', $request->employee_id)->where('created_by', Auth::user()->creatorId())->first();
                $dayType       = DayType::where('id', $request->day_type_id)->first();
                $duration       = strtotime($request->end_time) - strtotime($request->start_time);
                $diffInHour     = Carbon::parse($request->end_time)->diffInHours(Carbon::parse($request->start_time));
                $diffInDay     = Carbon::parse($request->end_date)->diffInDays(Carbon::parse($request->start_date));
                $durationToTime =  gmdate('H:i:s', $duration);

                // overtime calculation
                if (!is_null($employee->basic_salary)) {
                    $overtimePayPerHour    = 1 / 173 * $employee->basic_salary->amount;
                    $pay = 0;
                    if ($diffInHour == 1) {
                        $pay = 1.5 * floor($overtimePayPerHour);
                    } elseif ($diffInHour > 1) {
                        $pay = 0;
                        for ($i = 0; $i < $diffInHour; $i++) {
                            if ($i == 0) {
                                $pay += 1.5 * floor($overtimePayPerHour);
                            } else {
                                $pay += 2 * floor($overtimePayPerHour);
                            }
                        }
                    }
                    $request['amount_fee'] = $diffInDay > 0 ? $pay * $diffInDay : 0;
                } else {
                    toast('Please set employee salary.', 'warning');
                    return redirect()->back();
                }



                $request['duration'] = $durationToTime;
                if (Auth::user()->type == 'company') {
                    $request['created_by']  = Auth::user()->creatorId();
                    $request['status']      = 'Approved';
                    $model = Overtime::create($request->all());
                } else {
                    $request['created_by']  = Auth::user()->creatorId();
                    $request['status']      = 'Pending';
                    $model = Overtime::create($request->all());
                }

                // 3 Tier Approval
                $levels = LevelApproval::where('created_by', Auth::user()->creatorId())->get();
                foreach ($levels as $key => $value) {
                    OvertimeApproval::create([
                        'overtime_id'              => $model->id,
                        'level'                 => $value->level,
                        'is_approver_company'   => $value->company_id ? true : false,
                        'approver_id'           => isset($value->company_id) ? $value->company_id : $value->employee_id,
                        'status'                => 'Pending',
                        'created_by'            => Auth::user()->creatorId(),
                    ]);
                }
                // 3 Tier Approval

                Utility::insertToRequest($model, Auth::user(), 'Overtime');

                DB::commit();
                toast('Overtime successfully created.', 'success');
                return redirect()->route('overtimes.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.', 'error');
                return redirect()->route('overtimes.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('overtimes.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $overtime = Overtime::find($id);
        $fileType = null;

        if (!is_null($overtime->attachment_reject)) {
            $fileType = Utility::getFileType($overtime->attachment_reject);
        }

        return view('pages.contents.time-management.overtime.detail-rejected', compact('overtime', 'fileType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $overtime = Overtime::find($id);
        if (Auth::user()->can('edit overtime')) {
            if ($overtime->created_by == Auth::user()->creatorId()) {
                $employee  = Employee::where('created_by', '=', Auth::user()->creatorId())->where('id', $overtime->employee_id)->first();
                $overtimetypes = OvertimeType::where('created_by', '=', Auth::user()->creatorId())->get();
                $daytypes = DayType::where('created_by', '=', Auth::user()->creatorId())->get();

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

                $overtimeApprovals = $overtime->overtime_approvals()->orderBy('level', 'asc')->get();
                $levelAndApprovals = Utility::getLevelAndApprover($levelApprove, $overtimeApprovals);
                // 3 Tier Approval

                return response()->json([
                    $employee, $overtimetypes, $overtime, $daytypes,
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('edit overtime')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'employee_id' => 'required',
                    'overtime_type_id' => 'required',
                    'day_type_id' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'start_time' => 'required',
                    'end_time' => 'required',
                    'status' => 'required',
                    // 'duration' => 'required',
                    // 'notes' => 'required',
                ]
            );


            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();

                $overtime                   =  Overtime::find($id);

                if ($request->file()) {
                    $fileName = time() . '_' . $request->file('attachment_reject')->getClientOriginalName();
                    $filePath = $request->file('attachment_reject')->storeAs('public', $fileName);
                    $overtime->attachment_reject =  'storage/' . $fileName ?? null;
                }

                // fee
                $employee       = Employee::where('id', $request->employee_id)->where('created_by', Auth::user()->creatorId())->first();
                $dayType       = DayType::where('id', $request->day_type_id)->first();
                $duration       = strtotime($request->end_time) - strtotime($request->start_time);
                $durationToTime =  gmdate('H:i:s', $duration);
                $diffInHour     = Carbon::parse($request->end_time)->diffInHours(Carbon::parse($request->start_time));
                $diffInDay     = Carbon::parse($request->end_date)->diffInDays(Carbon::parse($request->start_date));
                $request['duration'] = $durationToTime;

                if (!is_null($employee->basic_salary)) {
                    $overtimePayPerHour    = 1 / 173 * $employee->basic_salary->amount;
                    if ($diffInHour == 1) {
                        $pay = 1.5 * floor($overtimePayPerHour);
                    } elseif ($diffInHour > 1) {
                        $pay = 0;
                        for ($i = 0; $i < $diffInHour; $i++) {
                            if ($i == 0) {
                                $pay += 1.5 * floor($overtimePayPerHour);
                            } else {
                                $pay += 2 * floor($overtimePayPerHour);
                            }
                        }
                    }
                    $request['amount_fee'] = $diffInDay > 0 ? $pay * $diffInDay : 0;
                    $overtime->amount_fee       = $request['amount_fee'];
                } else {
                    toast('Please set employee salary.', 'warning');
                    return redirect()->back();
                }

                $overtime->employee_id      = $request->employee_id;
                $overtime->overtime_type_id = $request->overtime_type_id;
                $overtime->day_type_id      = $request->day_type_id;
                $overtime->start_date       = $request->start_date;
                $overtime->end_date         = $request->end_date;
                $overtime->start_time       = $request->start_time;
                $overtime->end_time         = $request->end_time;
                $overtime->duration         = $request['duration'];
                $overtime->notes            = $request->notes;
                $overtime->rejected_reason  =  $request->rejected_reason ?? null;
                $overtime->created_by       = Auth::user()->creatorId();
                $overtime->save();

                // 3 Tier Approval
                if (isset($request->status) && $request->status != 0 && isset($request->level_approve) && $overtime->status != 'Rejected') {
                    $overtimeApprove = OvertimeApproval::where('overtime_id', $overtime->id)
                        ->where('level', $request->level_approve)
                        ->where('status', 'Pending')
                        ->first();


                    if (!is_null($overtimeApprove)) {
                        //check if employee can be a approver
                        $employee = Employee::find($overtimeApprove->approver_id);
                        $level = null;
                        if ($employee) {
                            $level = LevelApproval::where('created_by', Auth::user()->creatorId())
                                ->where('employee_id', $employee->id)
                                ->first();
                        }

                        if ($overtimeApprove->is_approver_company && Auth::user()->type == 'company') {
                            if ($request->status == 'Rejected') {
                                $overtimeApprove->status = 'Rejected';
                                $overtime->status           =  'Rejected';
                                $overtime->save();
                            } else {
                                $overtimeApprove->status = $request->status;
                            }
                            $overtimeApprove->save();
                        } elseif (!$overtimeApprove->is_approver_company && Auth::user()->type != 'company' && !is_null($level)) {
                            if ($request->status == 'Rejected') {
                                $overtimeApprove->status = 'Rejected';
                                $overtime->status           =  'Rejected';
                                $overtime->save();
                            } else {
                                $overtimeApprove->status = $request->status;
                            }

                            $overtimeApprove->save();
                        }
                    }

                    $countOvertimeApproved = OvertimeApproval::where('overtime_id', $overtime->id)
                        ->where('status', 'Approved')
                        ->count();
                    $countLevel = LevelApproval::where('created_by', Auth::user()->creatorId())->count();
                    if ($countOvertimeApproved == $countLevel) {
                        $overtime->status       =  'Approved';
                        $overtime->save();
                    }
                }
                // 3 Tier Approval

                DB::commit();
                toast('Overtime successfully updated.', 'success');
                return redirect()->route('overtimes.index');
            } catch (Exception $e) {
                DB::rollBack();
                dd($e);
                toast('Something went wrong.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $overtime = Overtime::find($id);
        if (Auth::user()->can('delete overtime')) {
            if ($overtime->created_by == Auth::user()->creatorId()) {

                if ($overtime->attachment_reject != null) {
                    $fileNameAttReject = explode('/', $overtime->attachment_reject);
                    if (Storage::exists('public/' . $fileNameAttReject[1])) {
                        Storage::delete('public/' . $fileNameAttReject[1]);
                    }
                }

                $overtime->delete();

                toast('Overtime successfully deleted.', 'success');
                return redirect()->route('overtimes.index');
            } else {
                toast('Permission denied.', 'error');
                toast('Permission denied.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
}
