<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\ReqShiftSchedule;
use App\Models\ShiftSchedule;
use App\Models\ShiftType;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
{
    public function index(){
        try{
            $data = DB::table('v_request_shift')
                    ->where('branch_id',Auth::user()->branch_id)
                    ->where('employee_id',Auth::user()->employee->id)
                    ->get();
            return response()->json([
                'status' => Response::HTTP_OK,
                'result' => (($data !=null) ? $data : 'Not Found'),
            ], Response::HTTP_OK);
        }catch(Exception $e){
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function create(){
        try{
            $emp = Employee::where('id',Auth::user()->employee->id)->first();
            $shift = ShiftType::where('branch_id',Auth::user()->branch_id)->get();
            $data = [
                'employee'  => $emp,
                'shift_type'=> $shift,
            ];
            return response()->json([
                'status' => Response::HTTP_OK,
                'result' => $data,
            ], Response::HTTP_OK);
        }catch(Exception $e){
            return response()->json([
                'status'  => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }    
    }
    public function check_req_date_employee(Request $request){
        try{
            $checkSchedule = DB::table('v_shift_schedule')->where('schedule_date',$request->request_date)
                            ->where('employee_id',Auth::user()->employee->id)
                            ->first();
            if($checkSchedule->is_dayoff == true){
                return response()->json([
                    'status'  => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Sorry, Your schedule on day off!',
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }else{
                return response()->json([
                    'status'  => Response::HTTP_OK,
                    'result' => $checkSchedule,
                ], Response::HTTP_OK);
            }
        }catch(Exception $e){
            return response()->json([
                'status'  => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

    }
    public function check_schedule_date_repemployee(Request $request){
        $checkSchedule = DB::table('v_shift_schedule')
                    ->where('employee_id',$request->employee_id)
                    ->where('schedule_date',$request->request_date)
                    ->first();
        if($checkSchedule != null){
            if($checkSchedule->shift_id == $request->request_shift_id){
                return response()->json([
                    'status'  => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Sorry, employee on same schadule!',
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }else if($checkSchedule->is_dayoff == true){
                return response()->json([
                    'status'  => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Sorry, employee on day off!',
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }else{
                return response()->json([
                    'status'  => Response::HTTP_OK,
                    'result' => $checkSchedule,
                ], Response::HTTP_OK);
            }
        }else{
            return response()->json([
                'status'  => Response::HTTP_OK,
                'message' => "Not Found Schedule!",
            ], Response::HTTP_OK);
        }
    }
    public function get_emp_replace(Request $request){
        try{
            $emp = Employee::where('id',Auth::user()->employee->id)->first();
            $dataRepalce = null;
            if($emp !=null){
                if($emp->department_id != null && $emp->department_id != ''){
                    $dataRepalce = Employee::select('id as employee_id','name as employee_name','no_employee')
                                    ->where('id','<>',Auth::user()->employee->id)
                                    ->where('branch_id',Auth::user()->branch_id)
                                    ->where('department_id',$emp->department_id)
                                    ->get();
                    return response()->json([
                        'status' => Response::HTTP_OK,
                        'result' => $dataRepalce,
                    ], Response::HTTP_OK);
                }else{
                    return response()->json([
                        'status' => Response::HTTP_OK,
                        'message' => 'Please set your deparment!',
                    ], Response::HTTP_OK);
                }
                
            }else{
                return response()->json([
                    'status' => Response::HTTP_OK,
                    'message' => 'Not Found!',
                ], Response::HTTP_OK);
            }
            
        }catch(Exception $e){
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'result' => 'Something went wrong!',
            ], Response::HTTP_UNPROCESSABLE_ENTITY,);
        }
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $check = ReqShiftSchedule::where('requested_date',$request->request_date)
                    ->where('employee_id',Auth::user()->employee->id)
                    ->first();
            if($check !=null && $check->status == "pending"){
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Your request ready to approved!',
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }else if($check !=null && $check->status == "approved"){
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Your request have been approved!',
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $data = [
                'employee_id'           => Auth::user()->employee->id,
                'requested_date'        => $request->request_date,
                'shift_id_1'            => $request->shift_id_1,
                'shift_to'              => $request->shift_to,
                'replace_employee_id'   => (($request->replace_employee_id !=null) ? $request->replace_employee_id : null),
                'shift_id_2'            => (($request->shift_id_2 !=null) ? $request->shift_id_2 : null),
                'status'                => 'pending',
                'rejected_reason'       => null,
                'remark'                => $request->remark,
                'created_by'            => Auth::user()->id,
            ];
            ReqShiftSchedule::create($data);
            $emp = Employee::where('id',Auth::user()->employee->id)->first();
                if($emp != null){
                    if($emp->department_id == '' || $emp->department_id == null ) {
                        return response()->json([
                            'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                            'message' => 'Depratment not empty!'
                        ], Response::HTTP_OK);
                    }
                }
            $superior = DB::table('level_approvals')->where('department_id',$emp->department_id)->where('branch_id',Auth::user()->branch_id)->get();
            $approve1 = null;
            $approve2 = null;
            $approve3 = null;
            foreach ($superior as $s){
                if ($s->level == '1'){
                    $approve1 = $s->employee_id;
                }
                if ($s->level == '2'){
                    $approve2 = $s->employee_id;
                }
                if ($s->level == '3'){
                    $approve3 = $s->employee_id;
                }
            }
            $approve = [
                'req_shift_schedule_id' => DB::getPdo()->lastInsertId(),
                'employee_id'           => Auth::user()->employee->id,
                'department_id'         => $emp->department_id,
                'approve_1'             => $approve1,
                'approve_2'             => null,
                'approve_3'             => null,
                'status'                => '0',
                'created_at'            => date('Y-m-d H:m:s'),
                'updated_at'            => date('Y-m-d H:m:s'),
            ];
            DB::table('request_shift_schedule_approvals')->insert($approve);
            DB::commit();
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Request Shift successfuly created.',
            ], Response::HTTP_OK);
        }catch(Exception $e){
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function edit(Request $request){
        try{
            $data = DB::table('v_request_shift')
                    ->where('id',$request->id)
                    ->first();
            return response()->json([
                'status' => Response::HTTP_OK,
                'result' => (($data !=null) ? $data : 'Not Found'),
            ], Response::HTTP_OK);
        }catch(Exception $e){
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function update(Request $request){
        try{
            $check = ReqShiftSchedule::where('requested_date',$request->request_date)
                    ->where('employee_id',Auth::user()->employee->id)
                    ->first();
            if($check !=null && $check->status != "pending"){
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Your request have been approved!',
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $data = [
                'requested_date'        => $request->request_date,
                'shift_id_1'            => $request->shift_id_1,
                'shift_to'              => $request->shift_to,
                'replace_employee_id'   => (($request->replace_employee_id !=null) ? $request->replace_employee_id : null),
                'shift_id_2'            => (($request->shift_id_2 !=null) ? $request->shift_id_2 : null),
                'remark'                => $request->remark,
                'created_by'            => Auth::user()->id,
            ];
            ReqShiftSchedule::where('id',$request->id)->update($data);
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Request Scedule successfuly updated.',
            ], Response::HTTP_OK);
        }catch(Exception $e){
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function detail(Request $request){
        try{
            $data = DB::table('v_request_shift')
                    ->where('id',$request->id)
                    ->first();
            return response()->json([
                'status' => Response::HTTP_OK,
                'result' => $data ,
            ], Response::HTTP_OK);
        }catch(Exception $e){
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function destroy(Request $request){
        try {
            ReqShiftSchedule::where('id',$request->id)->where('employee_id',Auth::user()->employee->id)->delete();
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Request shift successfully deleted.',
            ], Response::HTTP_OK);
        }catch(Exception $e){
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!',
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
   
}
