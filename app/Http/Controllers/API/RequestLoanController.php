<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\Loan;
use App\Models\LoanOption;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RequestLoanController extends Controller
{
    // =========start request loan
    public function loan(Request $request){
        $data = Loan::select('loans.*',
                            'loan_options.name as loan_name',
                            'employees.no_employee',
                            'employees.name as employee_name'
                            )
                    ->leftJoin('loan_options','loan_options.id','=','loans.loan_type_id')
                    ->leftJoin('employees','employees.id','=','loans.employee_id')
                    ->where('loans.employee_id','=',$request->employee_id)
                    ->where('loans.branch_id','=',Auth::user()->branch_id)
                    ->where('loans.type','=','installment')
                    ->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function getLoanType(){
        $loanType = LoanOption::select('loan_options.id','loan_options.name')
                                ->leftJoin('users','users.id','=','loan_options.created_by')
                                ->where('users.branch_id',Auth::user()->branch_id)
                                ->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $loanType
        ], Response::HTTP_OK);
    }
    public function store(Request $request){
        try{
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'employee_id'           => ['required','numeric'],
                'loan_type_id'          => ['required','numeric'],
                'installment'           => ['required','numeric'],
                'tenor'                 => ['required','numeric'],
                'amount'                => ['required','numeric']
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'wrong' => $validator->errors()
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $check = Loan::where('employee_id',$request->employee_id)
                        ->where('loan_type_id',$request->loan_type_id)
                        ->where('branch_id',Auth::user()->branch_id)
                        ->where('status','<>','paid off')
                        ->where('type','installment')
                        ->count();
            if ($check > 0 ){
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Your Loan ready in list!'
                ], Response::HTTP_OK);
            }

                $loan    = new Loan();
                $loan->employee_id          = $request->employee_id;
                $loan->loan_type_id         = $request->loan_type_id;
                $loan->installment          = $request->installment;
                $loan->number_of_installment= 0;
                $loan->tenor                = $request->tenor;
                $loan->amount               = $request->amount;
                $loan->remaining_installment= $request->amount;
                $loan->application_date     = date('Y-m-d');
                $loan->type                 = 'installment';
                $loan->status               = 'pending';
                $loan->branch_id            = Auth::user()->branch_id;
                $loan->created_by           = Auth::user()->id;
                $loan->save();
                $emp = Employee::where('id',$request->employee_id)->first();
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
                    'loan_id'       => DB::getPdo()->lastInsertId(),
                    'employee_id'   => $request->employee_id,
                    'department_id' => $emp->department_id,
                    'approve_1'     => $approve1,
                    'approve_2'     => $approve2,
                    'approve_3'     => $approve3,
                    'status'        => '0',
                    'created_at'    => date('Y-m-d H:m:s'),
                    'updated_at'    => date('Y-m-d H:m:s'),
                ];
            DB::table('loan_approvals')->insert($approve);
            DB::commit();
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Loan successfully created .'
            ], Response::HTTP_OK);
        }catch(Exeption $e){
            DB::rollBack();
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!'
            ], Response::HTTP_OK);
        }
    }
    public function edit(Request $request)
    {
        $loan['data']= Loan::select('loans.*',
                            'loan_options.name as loan_name',
                            'employees.no_employee',
                            'employees.name as employee_name'
                            )
                            ->leftJoin('loan_options','loan_options.id','=','loans.loan_type_id')
                            ->leftJoin('employees','employees.id','=','loans.employee_id')
                            ->where('loans.id','=',$request->id)
                            ->first();
        $loan['list_loan_type'] =  LoanOption::select('loan_options.id','loan_options.name')
                                            ->leftJoin('users','users.id','=','loan_options.created_by')
                                            ->where('users.branch_id',Auth::user()->branch_id)
                                            ->get();
        if ($loan['data'] != null){
            if($loan['data']->status != 'pending'){
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Sorry, This loan have been proccess!'
                ], Response::HTTP_OK);
            }
            return response()->json([
                'status' => Response::HTTP_OK,
                'result' => $loan
            ], Response::HTTP_OK);  
        }
             
    }
    public function update(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'loan_type_id'          => ['required','numeric'],
                'installment'           => ['required','numeric'],
                'tenor'                 => ['required','numeric'],
                'amount'                => ['required','numeric']
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'wrong' => $validator->errors()
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $loan = Loan::find($request->id);
            if ($loan->status =="pending"){
                $data = [
                    'loan_type_id'          => $request->loan_type_id,
                    'installment'           => $request->installment,
                    'tenor'                 => $request->tenor,
                    'amount'                => $request->amount,
                    'remaining_installment' => $request->amount,
                ];
           
                $update = $loan->update($data);
                if ($update){
                    return response()->json([
                        'status' => Response::HTTP_OK,
                        'result' => $loan,
                        'message'=> 'Data successfuly updated.'
                    ], Response::HTTP_OK);  
                }else{
                    return response()->json([
                        'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'message' => 'Something went wrong!'
                    ], Response::HTTP_OK);
                }
            }else{
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Sorry, This loan have been proccess !'
                ], Response::HTTP_OK);
            }

        } catch (Exception $e) {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!'
            ], Response::HTTP_OK);
        }
    }
    public function detail(Request $request){
        $data['loan'] = Loan::select('employees.no_employee',
                                    'employees.name as employee_name',
                                    'loan_options.name as loan_name',
                                    'loans.application_date',
                                    'loans.installment',
                                    'loans.number_of_installment',
                                    'loans.tenor',
                                    'loans.remaining_installment',
                                    'loans.amount',
                                    'loans.type',
                                    'loans.status')
                            ->leftJoin('employees','employees.id','=','loans.employee_id')
                            ->leftJoin('loan_options','loan_options.id','=','loans.loan_type_id')
                            ->where('loans.id',$request->id)
                            ->where('loans.branch_id',Auth::user()->branch_id)
                            ->first();
        $data['installment'] = DB::table('log_installment_loan')
                            ->select('loan_options.name as loan_name',
                                    'log_installment_loan.date',
                                    'log_installment_loan.installment',
                                    'log_installment_loan.number_of_installment',
                                    'log_installment_loan.tenor',
                                    'log_installment_loan.remaining_installment',
                                    'log_installment_loan.amount')
                            ->leftJoin('loan_options','loan_options.id','=','log_installment_loan.loan_type_id')
                            ->where('log_installment_loan.branch_id',Auth::user()->branch_id)
                            ->where('log_installment_loan.loan_id',$request->id)
                            ->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function destroy(Request $request){
        try{
            $del = Loan::where('id',$request->id)
                    ->where('status','pending')
                    ->where('branch_id',Auth::user()->branch_id)
                    ->delete();
            return response()->json([
                'status'  => Response::HTTP_OK,
                'message' => 'Loan successfuly deleted.'
            ], Response::HTTP_OK);
        }catch(Exeption $e){
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Something went wrong!'
            ], Response::HTTP_OK);
        }
    }
    // ============end request loan

    // ============start cash advance
    public function cash_advance(Request $request){
        $data = Loan::select('loans.id',
                            'loans.employee_id',
                            'employees.no_employee',
                            'employees.name as employee_name',
                            'loan_options.name as loan_name',
                            'loans.loan_type_id',
                            'loans.amount',
                            'loans.status',
                            'loans.type',
                            'loans.branch_id')
                    ->leftJoin('loan_options','loan_options.id','=','loans.loan_type_id')
                    ->leftJoin('employees','employees.id','=','loans.employee_id')
                    ->where('loans.employee_id','=',$request->employee_id)
                    ->where('loans.branch_id','=',Auth::user()->branch_id)
                    ->where('loans.type','=','cash_advance')
                    ->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function store_cash_advance(Request $request){
        try{
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'employee_id'           => ['required','numeric'],
                'loan_type_id'          => ['required','numeric'],
                'amount'                => ['required','numeric']
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'wrong' => $validator->errors()
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $check = Loan::where('employee_id',$request->employee_id)
                        ->where('loan_type_id',$request->loan_type_id)
                        ->where('branch_id',Auth::user()->branch_id)
                        ->where('status','<>','paid off')
                        ->where('type','cash_advance')
                        ->count();
            if ($check > 0 ){
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Your cash advance ready in list!'
                ], Response::HTTP_OK);
            }

                $loan    = new Loan();
                $loan->employee_id          = $request->employee_id;
                $loan->loan_type_id         = $request->loan_type_id;
                $loan->amount               = $request->amount;
                $loan->application_date     = date('Y-m-d');
                $loan->type                 = 'cash_advance';
                $loan->status               = 'pending';
                $loan->branch_id            = Auth::user()->branch_id;
                $loan->created_by           = Auth::user()->id;
                $loan->save();

            DB::commit();
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Cash advance successfully created .'
            ], Response::HTTP_OK);
        }catch(Exeption $e){
            DB::rollBack();
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!'
            ], Response::HTTP_OK);
        }
    }
    public function edit_cash_advance(Request $request){
        $loan['data']= Loan::select('loans.id',
                                    'loans.employee_id',
                                    'employees.no_employee',
                                    'employees.name as employee_name',
                                    'loan_options.name as loan_name',
                                    'loans.loan_type_id',
                                    'loans.amount',
                                    'loans.status',
                                    'loans.type',
                                    'loans.branch_id')
                            ->leftJoin('loan_options','loan_options.id','=','loans.loan_type_id')
                            ->leftJoin('employees','employees.id','=','loans.employee_id')
                            ->where('loans.id','=',$request->id)
                            ->first();
        $loan['list_loan_type'] =  LoanOption::select('loan_options.id','loan_options.name')
                                ->leftJoin('users','users.id','=','loan_options.created_by')
                                ->where('users.branch_id',Auth::user()->branch_id)
                                ->get();
        if ($loan['data'] != null){
            if($loan['data']->status != 'pending'){
                return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Sorry, This loan have been proccess!'
                ], Response::HTTP_OK);
            }
            return response()->json([
                'status' => Response::HTTP_OK,
                'result' => $loan
            ], Response::HTTP_OK);  
        }else{
            return response()->json([
                'status' => Response::HTTP_OK,
                'result' => []
            ], Response::HTTP_OK);  
        }
    }
    public function update_cash_advance(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'loan_type_id'          => ['required','numeric'],
                'amount'                => ['required','numeric']
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'wrong' => $validator->errors()
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $loan = Loan::find($request->id);
            if ($loan->status =="pending"){
                $data = [
                    'loan_type_id'          => $request->loan_type_id,
                    'amount'                => $request->amount,
                ];
           
                $update = $loan->update($data);
                if ($update){
                    $dataUpdate= Loan::select('loans.id',
                                    'loans.employee_id',
                                    'employees.no_employee',
                                    'employees.name as employee_name',
                                    'loan_options.name as loan_name',
                                    'loans.loan_type_id',
                                    'loans.amount',
                                    'loans.status',
                                    'loans.type',
                                    'loans.branch_id')
                            ->leftJoin('loan_options','loan_options.id','=','loans.loan_type_id')
                            ->leftJoin('employees','employees.id','=','loans.employee_id')
                            ->where('loans.id','=',$request->id)
                            ->first();
                    return response()->json([
                        'status' => Response::HTTP_OK,
                        'result' => $dataUpdate,
                        'message'=> 'Data successfuly updated.'
                    ], Response::HTTP_OK);  
                }else{
                    return response()->json([
                        'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'message' => 'Something went wrong!'
                    ], Response::HTTP_OK);
                }
            }else{
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Sorry, This cash advance have been proccess !'
                ], Response::HTTP_OK);
            }

        } catch (Exception $e) {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Something went wrong!'
            ], Response::HTTP_OK);
        }
    }
    public function detail_cash_advance(Request $request){
        $data['loan'] = Loan::select('employees.no_employee',
                                    'employees.name as employee_name',
                                    'loan_options.name as loan_name',
                                    'loans.application_date',
                                    'loans.amount',
                                    'loans.type',
                                    'loans.status')
                            ->leftJoin('employees','employees.id','=','loans.employee_id')
                            ->leftJoin('loan_options','loan_options.id','=','loans.loan_type_id')
                            ->where('loans.id',$request->id)
                            ->where('loans.branch_id',Auth::user()->branch_id)
                            ->first();

        return response()->json([
            'status' => Response::HTTP_OK,
            'result' => $data
        ], Response::HTTP_OK);
    }
    public function destroy_cash_advance(Request $request){
        try{
            $del = Loan::where('id',$request->id)
                    ->where('status','pending')
                    ->where('branch_id',Auth::user()->branch_id)
                    ->delete();
            return response()->json([
                'status'  => Response::HTTP_OK,
                'message' => 'Cash advance successfuly deleted.'
            ], Response::HTTP_OK);
        }catch(Exeption $e){
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Something went wrong!'
            ], Response::HTTP_OK);
        }
    }
}
