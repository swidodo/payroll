<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\Reimburst;
use App\Models\ReimburstmentOption;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class RequestReimbursementController extends Controller
{
    public function index(Request $request){
       $data = Reimburst::select('reimbursts.id',
                                'reimbursts.reimburst_type_id',
                                'reimburstment_options.name as reimburst_name',
                                'reimbursts.date',
                                'reimbursts.amount',
                                'reimbursts.status',
                                'employees.id as employee_id',
                                'employees.no_employee',
                                'employees.name as employee_name'
                                )
                        ->leftJoin('reimburstment_options','reimburstment_options.id','=','reimbursts.reimburst_type_id')
                        ->leftJoin('employees','employees.id','=','reimbursts.employee_id')
                        ->where('reimbursts.employee_id',$request->employee_id)
                        ->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function getTypeReimburst(){
        $data = ReimburstmentOption::select('reimburstment_options.id','reimburstment_options.name')
                                ->leftJoin('users','users.id','=','reimburstment_options.created_by')
                                ->where('branch_id',Auth::user()->branch_id)
                                ->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
                $validator = Validator::make($request->all(), [
                    'employee_id'       => ['required','numeric'],
                    'reimburst_type_id' => ['required','numeric'],
                    'date'              => ['required','date'],
                    'amount'            => ['required','numeric']                    
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'wrong' => $validator->errors()
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }
                $data = [
                    'employee_id'       => $request->employee_id,
                    'reimburst_type_id' => $request->reimburst_type_id,
                    'amount'            => $request->amount,
                    'date'              => $request->date,
                    'status'            => 'pending',
                    'branch_id'         => Auth::user()->branch_id,
                    'created_by'        => Auth::user()->id,
                ];
            Reimburst::create($data);
            DB::commit();
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Reimbursement successfully created.'
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
        $data['data'] = Reimburst::select('reimbursts.id',
                                'reimbursts.date',
                                'reimburstment_options.name as reimburst_name',
                                'reimbursts.reimburst_type_id',
                                'reimbursts.amount',
                                'reimbursts.status',
                                'reimbursts.branch_id',
                                'reimbursts.employee_id',
                                'employees.no_employee',
                                'employees.name as employee_name'
                                )
                        ->leftJoin('reimburstment_options','reimburstment_options.id','=','reimbursts.reimburst_type_id')
                        ->leftJoin('employees','employees.id','=','reimbursts.employee_id')
                        ->where('reimbursts.id',$request->id)
                        ->where('reimbursts.branch_id',Auth::user()->branch_id)
                        ->first();
        $data['reimburst_type'] = ReimburstmentOption::select('reimburstment_options.id','reimburstment_options.name')
                                ->leftJoin('users','users.id','=','reimburstment_options.created_by')
                                ->where('branch_id',Auth::user()->branch_id)
                                ->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function update(Request $request){
        try{
            DB::beginTransaction();
                $validator = Validator::make($request->all(), [
                    'reimburst_type_id' => ['required','numeric'],
                    'date'              => ['required','date'],
                    'amount'            => ['required','numeric']
                    
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'wrong' => $validator->errors()
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }
                $data = [
                    'reimburst_type_id' => $request->reimburst_type_id,
                    'amount'            => $request->amount,
                    'date'              => $request->date,
                ];
            Reimburst::where('id',$request->id)->update($data);
            DB::commit();
            $dataUpdate = Reimburst::select('reimbursts.id',
                                        'reimbursts.date',
                                        'reimburstment_options.name as reimburst_name',
                                        'reimbursts.reimburst_type_id',
                                        'reimbursts.amount',
                                        'reimbursts.status',
                                        'reimbursts.branch_id',
                                        'reimbursts.employee_id',
                                        'employees.no_employee',
                                        'employees.name as employee_name'
                                        )
                                ->leftJoin('reimburstment_options','reimburstment_options.id','=','reimbursts.reimburst_type_id')
                                ->leftJoin('employees','employees.id','=','reimbursts.employee_id')
                                ->where('reimbursts.id',$request->id)
                                ->where('reimbursts.branch_id',Auth::user()->branch_id)
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
    public function detail(Request $request){
        $data['data'] = Reimburst::select('reimbursts.id',
                                'reimbursts.date',
                                'reimburstment_options.name as reimburst_name',
                                'reimbursts.reimburst_type_id',
                                'reimbursts.amount',
                                'reimbursts.status',
                                'reimbursts.branch_id',
                                'reimbursts.employee_id',
                                'employees.no_employee',
                                'employees.name as employee_name'
                                )
                        ->leftJoin('reimburstment_options','reimburstment_options.id','=','reimbursts.reimburst_type_id')
                        ->leftJoin('employees','employees.id','=','reimbursts.employee_id')
                        ->where('reimbursts.id',$request->id)
                        ->where('reimbursts.branch_id',Auth::user()->branch_id)
                        ->first();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function destroy(Request $request){
        try{
            $del = Reimburst::where('id',$request->id)
                    ->where('status','pending')
                    ->where('branch_id',Auth::user()->branch_id)
                    ->delete();
            return response()->json([
                'status'  => Response::HTTP_OK,
                'message' => 'Reimbursement successfuly deleted.'
            ], Response::HTTP_OK);
        }catch(Exeption $e){
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Something went wrong!'
            ], Response::HTTP_OK);
        }
    }
}