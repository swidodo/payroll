<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LevelApproval;
use App\Models\ReqShiftSchedule;
use App\Models\RequestShiftScheduleApproval;
use App\Models\ShiftSchedule;
use App\Models\ShiftType;
use App\Models\Utility;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReqShiftScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage request shift schedule')) {
            // $shiftTypes = ShiftType::where('created_by', '=', Auth::user()->creatorId())->get();
            if (Auth::user()->type != 'company') {
                $reqShiftSchedule = ReqShiftSchedule::where('employee_id', '=', Auth::user()->employee->id)->orderBy('id', 'asc')->get();
                $employee = Employee::where('user_id', '=', Auth::user()->id)->get();

                //3 tier approval
                if (!is_null($employee[0]->level_approval)) {
                    $levelApprove = $employee[0]->approval;

                    $approval = RequestShiftScheduleApproval::where('level', $levelApprove->level)
                        ->where('is_approver_company', false)
                        ->where('approver_id', $employee[0]->id)
                        ->get();
                    foreach ($approval as $key => $value) {
                        $reqShiftSchedule = collect($reqShiftSchedule)->prepend($value->request_shift_schedule);
                        // $employee = collect($employee)->prepend($value->overtime->employee);
                    }
                }
                //3 tier approval

            } else {
                $reqShiftSchedule = ReqShiftSchedule::where('created_by', '=', Auth::user()->creatorId())->orderBy('id', 'asc')->get();
            }

            return view('pages.contents.request-shift-schdule.index', compact('reqShiftSchedule'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('create request shift schedule')) {
            $employees = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
            $shifts = ShiftType::where('created_by', '=', Auth::user()->creatorId())->get();

            return view('pages.contents.request-shift-schdule.create', compact('employees', 'shifts'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('request-shift-schedule.index');
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
        if (Auth::user()->can('create request shift schedule')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'employee_id' => 'required|not_in:0',
                ],
                // custom message
                [
                    'employee_id.not_in' => 'Employee id is required'
                ]
            );

            if (isset($request->schedule)) {
                if (count($request->schedule) > 0) {
                    foreach ($request->schedule as $key => $val) {
                        if (isset($request->schedule[$key + 1]) && $val['schedule_date']  == $request->schedule[$key + 1]['schedule_date']) {
                            return redirect()->back()->with('error', 'There is duplicate shift in request, please check the dates during the request');
                        }

                        if ($val['shift_id'] == 0) {
                            return redirect()->back()->with('error', 'Please select valid shift daily');
                        }
                    }
                }
            }

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();


                $request['requested_date'] = date('Y-m-d', strtotime($request->requested_date));
                $request['created_by'] = Auth::user()->creatorId();

                if (Auth::user()->type == 'company') {
                    $request['status'] = 'Approved';
                } else {
                    $request['status'] = 'Pending';
                }

                $reqShiftSchedule = ReqShiftSchedule::create($request->all());

                // 3 Tier Approval
                $levels = LevelApproval::where('created_by', Auth::user()->creatorId())->get();
                foreach ($levels as $key => $value) {
                    RequestShiftScheduleApproval::create([
                        'req_shift_schedule_id' => $reqShiftSchedule->id,
                        'level'                 => $value->level,
                        'is_approver_company'   => $value->company_id ? true : false,
                        'approver_id'           => isset($value->company_id) ? $value->company_id : $value->employee_id,
                        'status'                => 'Pending',
                        'created_by'            => Auth::user()->creatorId(),
                    ]);
                }
                // 3 Tier Approval

                if (isset($request->schedule)) {
                    if ($request['status'] == 'Pending') {
                        foreach ($request->schedule as $key) {
                            ShiftSchedule::create([
                                'employee_id'               => $request->employee_id,
                                'req_shift_schedules_id'    => $reqShiftSchedule->id,
                                'schedule_date'             => Carbon::parse($key['schedule_date'])->format('Y-m-d'),
                                'shift_id'                  => $key['shift_id'],
                                'status'                    => 'Pending',
                                'created_by'                => Auth::user()->creatorId(),
                            ]);
                        }
                    } else {
                        foreach ($request->schedule as $key) {
                            $shifSchedule = ShiftSchedule::where('employee_id', $reqShiftSchedule->employee_id)->where('schedule_date', Carbon::parse($key['schedule_date'])->format('Y-m-d'))->first();

                            $shifSchedule->req_shift_schedules_id   = $reqShiftSchedule->id;
                            $shifSchedule->schedule_date            = Carbon::parse($key['schedule_date'])->format('Y-m-d');
                            $shifSchedule->shift_id                 = $key['shift_id'];
                            $shifSchedule->status                   = 'Approved';
                            $shifSchedule->save();
                        }
                    }
                }


                DB::commit();

                Utility::insertToRequest($reqShiftSchedule, Auth::user(), 'Request Shift Schedule');


                toast('Request Shift Schedule ' . $reqShiftSchedule->name . ' successfully created.', 'success');
                return redirect()->route('request-shift-schedule.index');
            } catch (Exception $e) {
                DB::rollBack();
                dd($e);
                toast('Something went wrong.', 'error');
                return redirect()->route('request-shift-schedule.create');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('request-shift-schedule.index');
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
        $reqShiftSchedule = ReqShiftSchedule::find($id);
        $fileType = null;

        if (!is_null($reqShiftSchedule->attachment_reject)) {
            $fileType = Utility::getFileType($reqShiftSchedule->attachment_reject);
        }

        return view('pages.contents.request-shift-schdule.detail-rejected', compact('reqShiftSchedule', 'fileType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('edit request shift schedule')) {
            $employees      = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
            $shifts         = ShiftType::where('created_by', '=', Auth::user()->creatorId())->get();
            $reqShiftSchedule   = ReqShiftSchedule::find($id);
            $shiftSchedules      =  ShiftSchedule::where('req_shift_schedules_id', $reqShiftSchedule->id)->get();

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

            $overtimeApprovals = $reqShiftSchedule->req_shift_schedule_approvals()->orderBy('level', 'asc')->get();
            $levelAndApprovals = Utility::getLevelAndApprover($levelApprove, $overtimeApprovals);
            // dd($levelAndApprovals, $overtimeApprovals);
            // 3 Tier Approval
            $leaveApprovals = $levelAndApprovals['approver'];
            $level_approve = $levelAndApprovals['level'];

            return view('pages.contents.request-shift-schdule.edit', compact('employees', 'shifts', 'reqShiftSchedule', 'shiftSchedules', 'leaveApprovals', 'level_approve'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('request-shift-schedule.index');
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
        $reqShiftSchedule = ReqShiftSchedule::find($id);
        $shiftSchedulesApproved = ShiftSchedule::where('req_shift_schedules_id', $reqShiftSchedule->id)->where('status', 'Approved')->where('created_by', '=', Auth::user()->creatorId())->get();
        $shiftSchedulesPending = ShiftSchedule::where('req_shift_schedules_id', $reqShiftSchedule->id)->where('status', 'Pending')->where('created_by', '=', Auth::user()->creatorId())->get();
        $shiftSchedules = ShiftSchedule::where('req_shift_schedules_id', $reqShiftSchedule->id)->where('created_by', '=', Auth::user()->creatorId())->get();

        if (Auth::user()->can('edit request shift schedule')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'employee_id' => 'required|not_in:0',
                ],
                // custom message
                [
                    'employee_id.not_in' => 'Employee id is required'
                ]
            );

            if (isset($request->schedule)) {
                if (count($request->schedule) > 0) {
                    foreach ($request->schedule as $key => $val) {
                        if (isset($request->schedule[$key + 1]) && $val['schedule_date']  == $request->schedule[$key + 1]['schedule_date']) {
                            return redirect()->back()->with('error', 'There is duplicate shift in request, please check the dates during the request');
                        }

                        if ($val['shift_id'] == 0) {
                            return redirect()->back()->with('error', 'Please select valid shift daily');
                        }
                    }
                }
            }

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();
                $reqShiftSchedule->update($request->except('status'));

                // 3 Tier Approval
                if (isset($request->status) && $request->status != 0 && isset($request->level_approve) && $reqShiftSchedule->status != 'Rejected') {
                    $reqShiftScheduleApprove = RequestShiftScheduleApproval::where('req_shift_schedule_id', $reqShiftSchedule->id)
                        ->where('level', $request->level_approve)
                        ->where('status', 'Pending')
                        ->first();


                    if (!is_null($reqShiftScheduleApprove)) {
                        //check if employee can be a approver
                        $employee = Employee::find($reqShiftScheduleApprove->approver_id);
                        $level = null;
                        if ($employee) {
                            $level = LevelApproval::where('created_by', Auth::user()->creatorId())
                                ->where('employee_id', $employee->id)
                                ->first();
                        }

                        if ($reqShiftScheduleApprove->is_approver_company && Auth::user()->type == 'company') {
                            if ($request->status == 'Rejected') {
                                $reqShiftScheduleApprove->status = 'Rejected';
                                $reqShiftSchedule->status           =  'Rejected';
                                $reqShiftSchedule->save();
                            } else {
                                $reqShiftScheduleApprove->status = $request->status;
                            }
                            $reqShiftScheduleApprove->save();
                        } elseif (!$reqShiftScheduleApprove->is_approver_company && Auth::user()->type != 'company' && !is_null($level)) {
                            if ($request->status == 'Rejected') {
                                $reqShiftScheduleApprove->status = 'Rejected';
                                $reqShiftSchedule->status           =  'Rejected';
                                $reqShiftSchedule->save();
                            } else {
                                $reqShiftScheduleApprove->status = $request->status;
                            }

                            $reqShiftScheduleApprove->save();
                        }
                    }

                    $countOvertimeApproved = RequestShiftScheduleApproval::where('req_shift_schedule_id', $reqShiftSchedule->id)
                        ->where('status', 'Approved')
                        ->count();
                    $countLevel = LevelApproval::where('created_by', Auth::user()->creatorId())->count();
                    if ($countOvertimeApproved == $countLevel) {
                        $reqShiftSchedule->status       =  'Approved';
                        $reqShiftSchedule->save();
                    }
                }
                // 3 Tier Approval


                if (isset($request->schedule)) {

                    if ($reqShiftSchedule->status == 'Pending') {
                        $shifSchedulePending = ShiftSchedule::where('employee_id', $reqShiftSchedule->employee_id)->where('status', 'Pending')->get();
                        foreach ($shifSchedulePending as $keyy) {
                            $keyy->delete();
                        }
                        foreach ($request->schedule as $key) {
                            ShiftSchedule::create([
                                'employee_id'               => $request->employee_id,
                                'req_shift_schedules_id'    => $reqShiftSchedule->id,
                                'schedule_date'             => $key['schedule_date'],
                                'shift_id'                  => $key['shift_id'],
                                'status'                    => 'Pending',
                                'created_by'                => Auth::user()->creatorId(),
                            ]);
                        }
                    } elseif ($reqShiftSchedule->status == 'Rejected') {
                        foreach ($request->schedule as $key) {
                            $shifSchedulePending = ShiftSchedule::where('employee_id', $reqShiftSchedule->employee_id)->where('schedule_date', Carbon::parse($key['schedule_date'])->format('Y-m-d'))->where('status', 'Pending')->first();

                            if ($request->file()) {
                                $fileName = time() . '_' . $request->file('attachment_reject')->getClientOriginalName();
                                $filePath = $request->file('attachment_reject')->storeAs('public', $fileName);
                                $reqShiftSchedule->attachment_reject        =  'storage/' . $fileName ?? null;
                            }

                            $shifSchedulePending->req_shift_schedules_id   = $reqShiftSchedule->id;
                            $shifSchedulePending->schedule_date            = $key['schedule_date'];
                            $shifSchedulePending->shift_id                 = $key['shift_id'];
                            $shifSchedulePending->status                   = 'Rejected'; // data bisa dinamis sesuai request->status
                            $reqShiftSchedule->rejected_reason          =  $request->rejected_reason ?? null;

                            $reqShiftSchedule->save();
                            $shifSchedulePending->save();
                        }
                    } else {
                        foreach ($shiftSchedulesApproved as $key) {
                            $key->req_shift_schedules_id   = null;
                            $key->schedule_date            = $key['schedule_date'];
                            $key->shift_id                 = 1;
                            $key->status                   = 'Approved';
                            $key->save();
                        }
                        foreach ($shiftSchedulesPending as $key) {
                            $key->delete();
                        }

                        foreach ($request->schedule as $key) {

                            $shifSchedule = ShiftSchedule::where('employee_id', $reqShiftSchedule->employee_id)->where('schedule_date', Carbon::parse($key['schedule_date'])->format('Y-m-d'))->where('status', 'Approved')->first();


                            $shifSchedule->req_shift_schedules_id   = $reqShiftSchedule->id;
                            $shifSchedule->schedule_date            = Carbon::parse($key['schedule_date'])->format('Y-m-d');
                            $shifSchedule->shift_id                 = $key['shift_id'];
                            $shifSchedule->status                   = 'Approved';
                            $shifSchedule->save();
                        }
                    }
                } else {
                    foreach ($shiftSchedules as $key) {
                        $key->delete();
                    }
                }
                DB::commit();
                toast($reqShiftSchedule->employee->name . ' successfully updated.', 'success');
                return redirect()->route('request-shift-schedule.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.', 'error');
                return redirect()->route('request-shift-schedule.edit');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('request-shift-schedule.edit');
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
        $reqShiftSchedule = ReqShiftSchedule::find($id);
        $shiftSchedule = ShiftSchedule::where('req_shift_schedules_id', $reqShiftSchedule->id)->where('created_by', '=', Auth::user()->creatorId())->get();

        if (Auth::user()->can('delete request shift schedule')) {
            if ($reqShiftSchedule->created_by == Auth::user()->creatorId()) {


                if ($reqShiftSchedule->attachment_reject != null) {
                    $fileName = explode('/', $reqShiftSchedule->attachment_reject);
                    if (Storage::exists('public/' . $fileName[1])) {
                        Storage::delete('public/' . $fileName[1]);
                    }
                }

                $reqShiftSchedule->delete();
                if ($reqShiftSchedule) {
                    foreach ($shiftSchedule as $key) {
                        $key->delete();
                    }
                }
                toast('Request Shift Schedule successfully deleted.', 'success');
                return redirect()->route('request-shift-schedule.index');
            } else {
                toast('Permission denied.', 'error');
                return redirect()->route('request-shift-schedule.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('request-shift-schedule.index');
        }
    }
}
