<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\Overtime;
use App\Models\DayType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class RequestOvertimeController extends Controller
{
    public function index(Request $request){
        $data = Overtime::select('overtimes.*',
                            'employees.name as employee_name',
                            'employees.no_employee as no_employee',
                            'branches.name as branch_name')
                ->leftJoin('employees','employees.id','overtimes.employee_id')
                ->leftJoin('branches','branches.id','overtimes.branch_id')
                ->where('overtimes.employee_id',$request->employee_id)
                ->orderBy('overtimes.id','DESC')
                ->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function get_dayType(){
        $data['day_type'] = DayType::all();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
                $validator = Validator::make($request->all(), [
                    'employee_id'       => 'required',
                    'day_type_id'       => 'required',
                    'start_date'        => 'required|date',
                    'end_date'          => 'required|date',
                    'start_time'        => 'required',
                    'end_time'          => 'required',        
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'wrong' => $validator->errors()
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }
                $data = [
                    'employee_id'       => $request->employee_id,
                    'day_type_id'       => $request->day_type_id,
                    'start_date'        => $request->start_date,
                    'end_date'          => $request->end_date,
                    'start_time'        => $request->start_time,
                    'end_time'          => $request->end_time,
                    'status'            => 'pending',
                    'overtime'          => 'normatif',
                    'branch_id'         => Auth::user()->branch_id,
                    'created_by'        => Auth::user()->id,
                ];
            Overtime::create($data);
            $emp = Employee::where('id',$request->employee_id)->first();
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
                    'overtime_id'      => DB::getPdo()->lastInsertId(),
                    'department_id' => $emp->department_id,
                    'approve_1'     => $approve1,
                    'approve_2'     => $approve2,
                    'approve_3'     => $approve3,
                    'status'        => '0',
                    'created_at'    => date('Y-m-d H:m:s'),
                    'updated_at'    => date('Y-m-d H:m:s'),
                ];
            DB::table('overtime_approvals')->insert($approve);
            DB::commit();
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Overtime successfully created.'
            ], Response::HTTP_OK);
        }catch(Exeption $e){
            DB::rollBack();
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!'
            ], Response::HTTP_OK);
        }
    }
    public function edit(Request $request){
        $data['data'] = Overtime::select('overtimes.*',
                                    'employees.name as employee_name',
                                    'employees.no_employee as no_employee',
                                    'branches.name as branch_name')
                            ->leftJoin('employees','employees.id','overtimes.employee_id')
                            ->leftJoin('branches','branches.id','overtimes.branch_id')
                            ->where('overtimes.id',$request->id)
                            ->first();
        $data['day_type'] = DayType::all();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function update(Request $request){
        try{
            DB::beginTransaction();
                $validator = Validator::make($request->all(), [
                          
                    
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'wrong' => $validator->errors()
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }

                $data = [
                    'day_type_id'       => $request->day_type_id,
                    'start_date'        => $request->start_date,
                    'end_date'          => $request->end_date,
                    'start_time'        => $request->start_time,
                    'end_time'          => $request->end_time,
                ];
            Overtime::where('id',$request->id)->update($data);
            DB::commit();
            $dataUpdate = Overtime::select('overtimes.*',
                                        'employees.name as employee_name',
                                        'employees.no_employee as no_employee',
                                        'branches.name as branch_name')
                                ->leftJoin('employees','employees.id','overtimes.employee_id')
                                ->leftJoin('branches','branches.id','overtimes.branch_id')
                                ->where('overtimes.id',$request->id)
                                ->first();
            return response()->json([
                'status' => Response::HTTP_OK,
                'result' => $dataUpdate,
                'message'=> 'Data successfuly updated.'
            ], Response::HTTP_OK);
        }catch(Exeption $e){
            DB::rollBack();
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!'
            ], Response::HTTP_OK);
        }
    }
    public function show(Request $request){
        $data['data'] = Overtime::select('overtimes.*',
                                'employees.name as employee_name',
                                'employees.no_employee as no_employee',
                                'branches.name as branch_name')
                        ->leftJoin('employees','employees.id','overtimes.employee_id')
                        ->leftJoin('branches','branches.id','overtimes.branch_id')
                        ->where('overtimes.id',$request->id)
                        ->first();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function destroy(Request $request){
        try{
            $del = Overtime::where('id',$request->id)
                    ->where('status','pending')
                    ->where('branch_id',Auth::user()->branch_id)
                    ->orWhereNull('status')
                    ->orWhereNull('branch_id')
                    ->delete();
            return response()->json([
                'status'  => Response::HTTP_OK,
                'message' => 'Overtime successfuly deleted.'
            ], Response::HTTP_OK);
        }catch(Exeption $e){
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Something went wrong!'
            ], Response::HTTP_OK);
        }
    }
}