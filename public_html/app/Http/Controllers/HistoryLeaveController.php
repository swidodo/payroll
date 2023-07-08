<?php

namespace App\Http\Controllers;

use App\Models\AttendanceEmployee;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\HistoryLeave;
use App\Models\Leave;
use App\Models\LeaveApproval;
use App\Models\LeaveType;
use App\Models\LevelApproval;
use App\Models\Overtime;
use App\Models\Utility;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HistoryLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all(), Crypt::decryptString($request->branch_id), Crypt::decryptString($request->employee_id));
        if (Auth::user()->can('manage leave')) {
            $leaves = HistoryLeave::where('history_leaves.created_by', '=', Auth::user()->creatorId())
                ->join('leave_types', 'history_leaves.leave_type_id', '=', 'leave_types.id')
                ->join('employees', 'history_leaves.employee_id', '=', 'employees.id');

            if (isset($request->branch_id) && $request->branch_id != 0) {
                $branch_id = Crypt::decrypt($request->branch_id);
                $leaves
                    ->whereRaw('employees.branch_id = ?', [$branch_id]);
            }
            if (isset($request->employee_id) && $request->employee_id != 0) {
                $employee_id = Crypt::decrypt($request->employee_id);
                $leaves->whereRaw('employees.id = ?', [$employee_id]);
            }
            $employee  = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
            $leaveType = LeaveType::where('created_by', '=', Auth::user()->creatorId())->get();
            $branches = Branch::where('created_by', Auth::user()->creatorId())->get();
            $leaves = $leaves->get();

            return view('pages.contents.time-management.history-leave.index', compact('branches', 'leaves', 'employee', 'leaveType'));
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
        // if (Auth::user()->can('create leave')) {
        //     $validator = Validator::make(
        //         $request->all(),
        //         [
        //             'leave_type_id' => 'required',
        //             'employee_id' => 'required',
        //             'start_date' => 'required',
        //             'end_date' => 'required',
        //             // 'leave_reason' => 'required',
        //             //    'remark' => 'required',
        //         ]
        //     );

        //     if ($validator->fails()) {
        //         return redirect()->back()->with('errors', $validator->messages());
        //     }
        //     try {
        //         DB::beginTransaction();
        //         $startDate = new DateTime($request->start_date);
        //         $endDate   = new DateTime($request->end_date);
        //         $total_leave_days = !empty($startDate->diff($endDate)) && $startDate < $endDate ? $startDate->diff($endDate)->days : 0;
        //         $employee = Employee::where('user_id', '=', Auth::user()->id)->first();
        //         $startDateCarbon = Carbon::parse($request->start_date);

        //         $leave    = new HistoryLeave();
        //         if (Auth::user()->type == "employee") {
        //             $leave->employee_id = $employee->id;
        //         } else {
        //             $leave->employee_id = $request->employee_id;
        //         }

        //         if ($request->file('attachment_request')) {
        //             $fileName = time() . '_' . $request->file('attachment_request')->getClientOriginalName();
        //             $store = $request->file('attachment_request')->storeAs('public', $fileName);
        //             $pathFile = 'storage/' . $fileName ?? null;
        //             $leave->attachment_request_path =  $pathFile;
        //         }

        //         $leave->leave_type_id    = $request->leave_type_id;
        //         $leave->applied_on       = date('Y-m-d');
        //         $leave->start_date       = $request->start_date;
        //         $leave->end_date         = $request->end_date;
        //         $leave->total_leave_days = $total_leave_days;
        //         $leave->leave_reason     = $request->leave_reason;
        //         // $leave->remark           = $request->remark;
        //         $leave->status           = Auth::user()->type == "company" ? 'Approved' : 'Pending';
        //         $leave->created_by       = Auth::user()->creatorId();
        //         $leave->save();

        //         // 3 Tier Approval
        //         // $levels = LevelApproval::where('created_by', Auth::user()->creatorId())->get();
        //         // foreach ($levels as $key => $value) {
        //         //     LeaveApproval::create([
        //         //         'leave_id'              => $leave->id,
        //         //         'level'                 => $value->level,
        //         //         'is_approver_company'   => $value->company_id ? true : false,
        //         //         'approver_id'           => isset($value->company_id) ? $value->company_id : $value->employee_id,
        //         //         'status'                => 'Pending',
        //         //         'created_by'            => Auth::user()->creatorId(),
        //         //     ]);
        //         // }
        //         // 3 Tier Approval

        //         // if (Auth::user()->type == "company") {
        //         //     if ($leave->total_leave_day > 1) {
        //         //         for ($i = 0; $i < $leave->total_leave_day; $i++) {
        //         //             AttendanceEmployee::insertToAttendanceEmployeeLeave($leave, $leave->leave_type->title, $leave->attachment_request_path, $startDateCarbon);
        //         //             //add day to date
        //         //             $startDateCarbon->addDay(1);
        //         //         }
        //         //     } else {
        //         //         AttendanceEmployee::insertToAttendanceEmployeeLeave($leave, $leave->leave_type->title, $leave->attachment_request_path, $startDateCarbon);
        //         //     }
        //         // }

        //         // if (Auth::user()->type != "company" && Auth::user()->type != "client") {
        //         //     Utility::insertToRequest($leave, Auth::user(), 'Leave');
        //         // }

        //         DB::commit();
        //         toast('Leave successfully created.', 'success');
        //         return redirect()->route('leaves.index');
        //     } catch (Exception $e) {
        //         DB::rollBack();
        //         toast('Something went wrong.', 'error');
        //         return redirect()->route('leaves.index');
        //     }
        // } else {
        //     toast('Permission denied.', 'error');
        //     return redirect()->route('leaves.index');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leave = HistoryLeave::find($id);
        $fileType = null;

        if (!is_null($leave->attachment_reject)) {
            $fileType = Utility::getFileType($leave->attachment_reject);
        }

        return view('pages.contents.time-management.history-leave.detail-rejected', compact('leave', 'fileType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $leave = Leave::find($id);
        // if (Auth::user()->can('edit leave')) {
        //     if ($leave->created_by == Auth::user()->creatorId()) {
        //         $user = Auth::user();
        //         $employee  = Employee::where('created_by', '=', Auth::user()->creatorId())->where('id', $leave->employee_id)->first();
        //         $leavetypes = LeaveType::where('created_by', '=', Auth::user()->creatorId())->get();

        //         // 3 Tier Approval
        //         if (Auth::user()->type == 'company') {
        //             $levelApprove = LevelApproval::where('created_by', '=', Auth::user()->creatorId())
        //                 ->where('company_id', Auth::user()->creatorId())
        //                 ->first();
        //         } elseif (Auth::user()->type != 'company' && Auth::user()->type != 'client') {
        //             $levelApprove = LevelApproval::where('created_by', '=', Auth::user()->creatorId())
        //                 ->where('employee_id', isset(Auth::user()->employee) ? Auth::user()->employee->id : 0)
        //                 ->first();
        //         }

        //         $leaveApprovals = $leave->leave_aprovals()->orderBy('level', 'asc')->get();
        //         $levelAndApprovals = Utility::getLevelAndApprover($levelApprove, $leaveApprovals);
        //         // 3 Tier Approval

        //         return response()->json([
        //             $employee, $leavetypes, $leave,
        //             'leaveApprovals' => $levelAndApprovals['approver'],
        //             'level_approve' => $levelAndApprovals['level']
        //         ]);
        //     } else {
        //         return response()->json(['error' => 'Permission denied.'], 403);
        //     }
        // } else {
        //     return response()->json(['error' => 'Permission denied.'], 403);
        // }
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
        // if (Auth::user()->can('edit leave')) {
        //     $validator = Validator::make(
        //         $request->all(),
        //         [
        //             'leave_type_id' => 'required',
        //             'employee_id' => 'required',
        //             'start_date' => 'required',
        //             'end_date' => 'required',
        //         ]
        //     );


        //     if ($validator->fails()) {
        //         return redirect()->back()->with('errors', $validator->messages());
        //     }

        //     $startDate = new DateTime($request->start_date);
        //     $endDate   = new DateTime($request->end_date);
        //     $total_leave_days = !empty($startDate->diff($endDate)) && $startDate < $endDate ? $startDate->diff($endDate)->days : 0;
        //     $startDateCarbon = Carbon::parse($request->start_date);


        //     try {
        //         DB::beginTransaction();
        //         $leave    =  Leave::find($id);

        //         $filePath = '';
        //         if ($request->file('attachment_reject')) {
        //             $fileName = time() . '_' . $request->file('attachment_reject')->getClientOriginalName();
        //             $filePath = $request->file('attachment_reject')->storeAs('public', $fileName);
        //             $leave->attachment_reject =  'storage/' . $fileName ?? null;
        //         }


        //         $leave->employee_id     = $request->employee_id;
        //         $leave->leave_type_id    = $request->leave_type_id;
        //         $leave->applied_on       = date('Y-m-d');
        //         $leave->start_date       = $request->start_date;
        //         $leave->end_date         = $request->end_date;
        //         $leave->total_leave_days = $total_leave_days;
        //         $leave->leave_reason     = $request->leave_reason;
        //         // $leave->remark           = $request->remark;
        //         // $leave->status           =  $request->status ?? 'Pending';
        //         $leave->rejected_reason  =  $request->rejected_reason ?? null;
        //         $leave->created_by       = Auth::user()->creatorId();
        //         $leave->save();

        //         // 3 Tier Approval
        //         if (isset($request->status) && $request->status != 0 && isset($request->level_approve) && $leave->status != 'Rejected') {
        //             $leaveApprove = LeaveApproval::where('leave_id', $leave->id)
        //                 ->where('level', $request->level_approve)
        //                 ->where('status', 'Pending')
        //                 ->first();


        //             if (!is_null($leaveApprove)) {
        //                 //check if employee can be a approver
        //                 $employee = Employee::find($leaveApprove->approver_id);
        //                 $level = null;
        //                 if ($employee) {
        //                     $level = LevelApproval::where('created_by', Auth::user()->creatorId())
        //                         ->where('employee_id', $employee->id)
        //                         ->first();
        //                 }

        //                 if ($leaveApprove->is_approver_company && Auth::user()->type == 'company') {
        //                     if ($request->status == 'Rejected') {
        //                         $leaveApprove->status = 'Rejected';
        //                         $leave->status        =  'Rejected';
        //                         $leave->save();
        //                     } else {
        //                         $leaveApprove->status = $request->status;
        //                     }
        //                     $leaveApprove->save();
        //                 } elseif (!$leaveApprove->is_approver_company && Auth::user()->type != 'company' && !is_null($level)) {
        //                     if ($request->status == 'Rejected') {
        //                         $leaveApprove->status = 'Rejected';
        //                         $leave->status           =  'Rejected';
        //                         $leave->save();
        //                     } else {
        //                         $leaveApprove->status = $request->status;
        //                     }
        //                     $leaveApprove->save();
        //                 }
        //             }

        //             $countLeaveApproved = LeaveApproval::where('leave_id', $leave->id)
        //                 ->where('status', 'Approved')
        //                 ->count();
        //             $countLevel = LevelApproval::where('created_by', Auth::user()->creatorId())->count();
        //             if ($countLeaveApproved == $countLevel) {
        //                 $leave->status       =  'Approved';
        //                 $leave->save();
        //             }
        //         }
        //         // 3 Tier Approval


        //         if ($leave->status == 'Approved' && Auth::user()->type == "employee" && Auth::user()->type != "company") {
        //             if ($leave->total_leave_day > 1) {
        //                 for ($i = 0; $i < $leave->total_leave_day; $i++) {
        //                     AttendanceEmployee::insertToAttendanceEmployeeLeave($leave, $leave->leave_type->title, $leave->attachment_request_path, $startDateCarbon);
        //                     //add day to date
        //                     $startDateCarbon->addDay(1);
        //                 }
        //             } else {
        //                 AttendanceEmployee::insertToAttendanceEmployeeLeave($leave, $leave->leave_type->title, $leave->attachment_request_path, $startDateCarbon);
        //             }
        //         }

        //         DB::commit();
        //         toast('Leave successfully updated.', 'success');
        //         return redirect()->route('leaves.index');
        //     } catch (Exception $e) {
        //         DB::rollBack();
        //         dd($e);
        //         toast('Something went wrong.' . $e, 'error');
        //         return redirect()->route('leaves.index');
        //     }
        // } else {
        //     toast('Permission denied.', 'error');
        //     return redirect()->route('leaves.index');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //     $leave = Leave::find($id);
        //     if (Auth::user()->can('delete leave')) {
        //         if ($leave->created_by == Auth::user()->creatorId()) {
        //             if ($leave->attachment_reject != null) {
        //                 $fileNameAttReject = explode('/', $leave->attachment_reject);
        //                 if (Storage::exists('public/' . $fileNameAttReject[1])) {
        //                     Storage::delete('public/' . $fileNameAttReject[1]);
        //                 }
        //             }
        //             if ($leave->attachment_request_path != null) {
        //                 $fileNameAttReject = explode('/', $leave->attachment_request_path);
        //                 if (Storage::exists('public/' . $fileNameAttReject[1])) {
        //                     Storage::delete('public/' . $fileNameAttReject[1]);
        //                 }
        //             }
        //             $leave->delete();

        //             toast('Leave successfully deleted.', 'success');
        //             return redirect()->route('leaves.index');
        //         } else {
        //             toast('Permission denied.', 'error');
        //             return redirect()->route('leaves.index');
        //         }
        //     } else {
        //         toast('Permission denied.', 'error');
        //         return redirect()->route('leaves.index');
        //     }
    }
}
