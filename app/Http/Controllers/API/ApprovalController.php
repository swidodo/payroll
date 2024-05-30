<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Timesheet;
use App\Models\Branch;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ApprovalController extends Controller
{
    public function index(){
        $emp = Employee::where('user_id',Auth::user()->id)->first();
        $cekLevel = DB::table('level_approvals')
                        ->where('employee_id',$emp->id)
                        ->first();
        if($cekLevel != null){
            if($cekLevel->level == '1'){
                $data['leave'] = DB::table('v_approve_leaves')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('approve_1',$emp->id)
                            ->whereIn('status',[0,1,2])
                            ->get();
                           
                $data['traveling'] = DB::table('v_approve_timesheet')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('approve_1',$emp->id)
                            ->whereIn('status',[0,1,2])
                            ->get();
                $data['loan'] = DB::table('v_approve_loan')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('approve_1',$emp->id)
                            ->whereIn('status',[0,1,2])
                            ->get();
                $data['overtime'] = DB::table('v_approve_overtime')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('approve_1',$emp->id)
                            ->whereIn('status',[0,1,2])
                            ->get();
                $data['reimburs'] = DB::table('v_approve_reimbursement')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('approve_1',$emp->id)
                            ->whereIn('status',[0,1,2])
                            ->get();
            }
            if($cekLevel->level == '2'){
                $data['leave'] = DB::table('v_approve_leaves')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('approve_2',$emp->id)
                            ->whereIn('status',[0,1,2])
                            ->get();
                $data['traveling'] = DB::table('v_approve_timesheet')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('approve_2',$emp->id)
                            ->whereIn('status',[0,1,2])
                            ->get();
                $data['loan'] = DB::table('v_approve_loan')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('approve_2',$emp->id)
                            ->whereIn('status',[0,1,2])
                            ->get();
                $data['overtime'] = DB::table('v_approve_overtime')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('approve_2',$emp->id)
                            ->whereIn('status',[0,1,2])
                            ->get();
                $data['reimburs'] = DB::table('v_approve_reimbursement')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('approve_2',$emp->id)
                            ->whereIn('status',[0,1,2])
                            ->get();
            }
            if($cekLevel->level == '3'){
                $data['leave'] = DB::table('v_approval_leaves')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('approve_3',$emp->id)
                            ->whereIn('status',[0,1,2])
                            ->get();
                $data['traveling'] = DB::table('v_approve_timesheet')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('approve_3',$emp->id)
                            ->whereIn('status',[0,1,2])
                            ->get();
                $data['loan'] = DB::table('v_approve_loan')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('approve_3',$emp->id)
                            ->whereIn('status',[0,1,2])
                            ->get();
                $data['overtime'] = DB::table('v_approve_overtime')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('approve_3',$emp->id)
                            ->whereIn('status',[0,1,2])
                            ->get();
                $data['reimburs'] = DB::table('v_approve_reimbursement')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->where('approve_3',$emp->id)
                            ->whereIn('status',[0,1,2])
                            ->get();
            }
        }else{
            $data['leave'] = DB::table('v_approve_leaves')
                            ->where('branch_id',Auth::user()->branch_id)
                            ->whereIn('status',[0,1,2])
                            ->orderBy('start_date','DESC')
                            ->get();
            $data['traveling'] = DB::table('v_approve_timesheet')
                        ->where('branch_id',Auth::user()->branch_id)
                        ->orderBy('start_date','DESC')
                        ->whereIn('status',[0,1,2])
                        ->get();
            $data['loan'] = DB::table('v_approve_loan')
                        ->where('branch_id',Auth::user()->branch_id)
                        ->orderBy('id','DESC')
                        ->whereIn('status',[0,1,2])
                        ->get();
            $data['overtime'] = DB::table('v_approve_overtime')
                        ->where('branch_id',Auth::user()->branch_id)
                        ->orderBy('start_date','DESC')
                        ->whereIn('status',[0,1,2])
                        ->get();
            $data['reimburs'] = DB::table('v_approve_reimbursement')
                        ->where('branch_id',Auth::user()->branch_id)
                        ->orderBy('date','DESC')
                        ->whereIn('status',[0,1,2])
                        ->get();
            $data['shift'] = DB::table('v_approve_shift')
                        ->where('branch_id',Auth::user()->branch_id)
                        ->orderBy('requested_date','DESC')
                        ->whereIn('status',[0,1,2])
                        ->get();
            
        }
       
        return response()->json($data, Response::HTTP_OK);
    }
    public function ApproveStatus(Request $request){
        $emp = Employee::where('user_id',Auth::user()->id)->first();
        if($request->name == 'leave'){
            $check = DB::table('leave_approvals')->where('leave_id',$request->id)->first();
        }
        if($request->name == 'travelling'){
            $check = DB::table('timesheet_approvals')->where('timesheet_id',$request->id)->first();
        }
        if($request->name == 'overtime'){
            $check = DB::table('overtime_approvals')->where('overtime_id',$request->id)->first();
        }
        if($request->name == 'loan'){
            $check = DB::table('loan_approvals')->where('loan_id',$request->id)->first();
        }
        $level = DB::table('level_approvals')->where('employee_id',$emp->id)->first();
        if($check != null){
            if ($check->approve_1 != null && $check->approve_1 == $emp->id && $level->level == 1){
                $approve = [
                    'status_1'      => $request->status,
                    'status'        => $request->status,
                    'note_1'        => $request->note,
                    'updated_at'    => date('Y-m-d H:m:s'),
                ];
                if($request->name == 'leave'){
                    if($request->status == '3'){
                        $leave = [
                            'status' => 'Approved',
                        ];
                        Leave::where('id',$request->id)->update($leave);
                    }
                    DB::table('leave_approvals')->where('leave_id',$request->id)->update($approve);
                    return response()->json([
                        'success' =>true,
                        'message' => 'Status Data success updated.'
                    ], Response::HTTP_OK);
                }
                if($request->name == 'travelling'){
                    if($request->status == '3'){
                        $timesheet = [
                            'status' => 'Approved',
                        ];
                        Leave::where('id',$request->id)->update($leave);
                    }
                    DB::table('timesheet_approvals')->where('timesheet_id',$request->id)->update($approve);
                    return response()->json([
                        'success' =>true,
                        'message' => 'Status Data success updated.'
                    ], Response::HTTP_OK);
                }
                if($request->name == 'overtime'){
                    if($request->status == '3'){
                        $leave = [
                            'status' => 'Approved',
                        ];
                        Leave::where('id',$request->id)->update($leave);
                    }
                    DB::table('overtime_approvals')->where('overtime_id',$request->id)->update($approve);
                    return response()->json([
                        'success' =>true,
                        'message' => 'Status Data success updated.'
                    ], Response::HTTP_OK);
                }
                if($request->name == 'loan'){
                    if($request->status == '3'){
                        $leave = [
                            'status' => 'Approved',
                        ];
                        Leave::where('id',$request->id)->update($leave);
                    }
                    DB::table('loan_approvals')->where('loan_id',$request->id)->update($approve);
                    return response()->json([
                        'success' =>true,
                        'message' => 'Status Data success updated.'
                    ], Response::HTTP_OK);
                }
            }else if($check->approve_2 != null && $check->approve_2 == $emp->id &&  $level->level == 2){
                if ($check->status_1 == '' || $check->status_1 == null){
                    return response()->json([
                        'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'message' => 'Status approve level 1 not empty !'
                    ], Response::HTTP_OK);
                }
                $approve = [
                    'status_2'      => $request->status,
                    'status'        => $request->status,
                    'note_2'        => $request->note,
                    'updated_at'    => date('Y-m-d H:m:s'),
                ];
                if($request->name == 'leave'){
                    if($request->status == '3'){
                        $leave = [
                            'status' => 'Approved',
                        ];
                        Leave::where('id',$request->id)->update($leave);
                    }
                    
                    DB::table('leave_approvals')->where('leave_id',$request->id)->update($approve);
                    return response()->json([
                        'success' =>true,
                        'message' => 'Status Data success updated.'
                    ], Response::HTTP_OK);
                }
                if($request->name == 'travelling'){
                    if($request->status == '3'){
                        $timesheet = [
                            'status' => 'Approved',
                        ];
                        Timesheet::where('id',$request->id)->update($leave);
                    }
                   
                    DB::table('timesheet_approvals')->where('timesheet_id',$request->id)->update($approve);
                    return response()->json([
                        'success' =>true,
                        'message' => 'Status Data success updated.'
                    ], Response::HTTP_OK);
                }
                if($request->name == 'overtime'){
                    if($request->status == '3'){
                        $leave = [
                            'status' => 'Approved',
                        ];
                        Leave::where('id',$request->id)->update($leave);
                    }
                    DB::table('overtime_approvals')->where('overtime_id',$request->id)->update($approve);
                    return response()->json([
                        'success' =>true,
                        'message' => 'Status Data success updated.'
                    ], Response::HTTP_OK);
                }
                if($request->name == 'loan'){
                    if($request->status == '3'){
                        $leave = [
                            'status' => 'ongoing',
                        ];
                        Leave::where('id',$request->id)->update($leave);
                    }
                    DB::table('loan_approvals')->where('loan_id',$request->id)->update($approve);
                    return response()->json([
                        'success' =>true,
                        'message' => 'Status Data success updated.'
                    ], Response::HTTP_OK);
                }
            }else if($check->approve_3 != null && $check->approve_3 == $emp->id && $level->level == 3){
                if ($check->status_2 == '' || $check->status_2 == null){
                    return response()->json([
                        'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'message' => 'Status approve level 2 not empty !'
                    ], Response::HTTP_OK);
                }
                $approve = [
                    'status_3'      => $request->status,
                    'status'        => $request->status,
                    'note_3'        => $request->note,
                    'updated_at'    => date('Y-m-d H:m:s'),
                ];
                if($request->name == 'leave'){
                    if($request->status == '3'){
                        $leave = [
                            'status' => 'Approved',
                        ];
                        Leave::where('id',$request->id)->update($leave);
                    }
                    DB::table('leave_approvals')->where('leave_id',$request->id)->update($approve);
                    return response()->json([
                        'success' =>true,
                        'message' => 'Status Data success updated.'
                    ], Response::HTTP_OK);
                }
                if($request->name == 'travelling'){
                    if($request->status == '3'){
                        $timesheet = [
                            'status' => 'Approved',
                        ];
                        Leave::where('id',$request->id)->update($leave);
                    }
                    DB::table('timesheet_approvals')->where('timesheet_id',$request->id)->update($approve);
                    return response()->json([
                        'success' =>true,
                        'message' => 'Status Data success updated.'
                    ], Response::HTTP_OK);
                }
                if($request->name == 'overtime'){
                    if($request->status == '3'){
                        $leave = [
                            'status' => 'Approved',
                        ];
                        Leave::where('id',$request->id)->update($leave);
                    }
                    DB::table('overtime_approvals')->where('overtime_id',$request->id)->update($approve);
                    return response()->json([
                        'success' =>true,
                        'message' => 'Status Data success updated.'
                    ], Response::HTTP_OK);
                }
                if($request->name == 'loan'){
                    if($request->status == '3'){
                        $leave = [
                            'status' => 'Approved',
                        ];
                        Leave::where('id',$request->id)->update($leave);
                    }
                    DB::table('loan_approvals')->where('loan_id',$request->id)->update($approve);
                    return response()->json([
                        'success' =>true,
                        'message' => 'Status Data success updated.'
                    ], Response::HTTP_OK);
                }
            }
        }
    }
}