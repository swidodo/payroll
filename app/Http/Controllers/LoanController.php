<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Loan;
use App\Models\LoanOption;
use App\Models\Branch;
use App\Models\AccessBranch;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage loan')) {
            $user = Auth::user();
            $getBranch = Branch::select('name','id','company_id')->where('id',$user->branch_id)->first();
            $emp = Employee::where('user_id',Auth::user()->id)->first();
         
            if ($user->initial == "HO"){
                if (Auth::user()->type == "company"){
                    $branch = Branch::select('name','id')->where('company_id',$getBranch->company_id)->get();
                }else{
                    $branch = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                    ->where('access_branches.employee_id',$emp->id)
                                                    ->where('access_branches.company_id',$getBranch->company_id)->get();
                }
            }else{
                $branch = Branch::select('name','id')->where('id',$user->branch_id)->get();
            }
            $loans = Loan::where('branch_id', '=', Auth::user()->branch_id)->get();
            $employee  = Employee::where('branch_id', '=', Auth::user()->branch_id)->get();
            $loanType = LoanOption::where('name','=','KASBON')->get();
            return view('pages.contents.loan.index', compact('employee', 'loanType','branch'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function installment()
    {
        if (Auth::user()->can('manage loan')) {
            $user = Auth::user();
            $getBranch = Branch::select('name','id','company_id')->where('id',$user->branch_id)->first();
            $emp = Employee::where('user_id',Auth::user()->id)->first();
         
            $branch ='';
            if ($user->initial == "HO"){
                if (Auth::user()->type == "company"){
                    $branch = Branch::select('name','id')->where('company_id',$getBranch->company_id)->get();
                }else{
                    $branch = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                    ->where('access_branches.employee_id',$emp->id)
                                                    ->where('access_branches.company_id',$getBranch->company_id)->get();
                }
            }else{
                $branch = Branch::select('name','id')->where('id',$user->branch_id)->get();;
            }
            $loans = Loan::where('branch_id', '=', Auth::user()->branch_id)->get();
            $employee  = Employee::where('branch_id', '=', Auth::user()->branch_id)->get();
            $loanType = LoanOption::where('name','<>','KASBON')->get();
            return view('pages.contents.loan.installment', compact('employee', 'loanType','branch'));
     } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
    public function get_data_castReceipt(Request $request){
        if($request->branch_id !=""){
            $branchId = $request->branch_id;
        }else{
            $branchId = Auth::user()->branch_id;
        }
        if ($request->status !=""){
            $status = $request->status;
        }else{
            $status = 'ongoing';
        }
        $data = Loan::select('loans.*','employees.no_employee','employees.name as employee_name')
                    ->leftJoin('employees','employees.id','loans.employee_id')
                    ->where('loans.branch_id','=',$branchId)
                    // ->where('loans.installment','=',0)
                    // ->where('loans.number_of_installment','=',0)
                    ->where('loans.status','=',$status)
                    ->whereIn('loans.type',['cash_advance',null])
                    ->orderBy('loans.created_at','DESC')
                    ->with('loan_type')
                    ->get();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action',function($row){
                            $btn ='';
                            if(Auth()->user()->canany('edit loan','delete loan')){
                                $btn .= '<div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">';
                                            if(Auth()->user()->can('edit loan')){
                                                $btn .= ' <a  data-url="'.route('loans.edit', $row->id).'" id="edit-loan" class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_loan"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                            }
                                            if(Auth()->user()->can('delete loan')){
                                                $btn .= '<a data-id='.$row->id.' class="dropdown-item delete-loan" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                            }
                                $btn .= '</div></div>';
                            }
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);

    }
    public function get_data_installment(Request $request){
        if($request->branch_id !=""){
            $branchId = $request->branch_id;
        }else{
            $branchId = Auth::user()->branch_id;
        }
        if ($request->status !=""){
            $status = $request->status;
        }else{
            $status = 'ongoing';
        }
        $data = Loan::select('loans.*','employees.no_employee','employees.name as employee_name')
                    ->leftJoin('employees','employees.id','loans.employee_id')
                    ->where('loans.branch_id','=',$branchId)
                    ->where('loans.installment','<>',0)
                    ->where('loans.type','installment')
                    ->where('loans.status','=',$status)
                    ->with('loan_type')
                    ->get();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action',function($row){
                            $btn ='';
                            if(Auth()->user()->canany('edit loan','delete loan')){
                                $btn .= '<div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">';
                                            if(Auth()->user()->can('edit loan')){
                                                $btn .= ' <a  data-url="'.route('loans.edit', $row->id).'" id="edit-loan" class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_loan"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                            }
                                            if($row->status="ongoing" && $row->number_of_installment == 0 ){
                                                if(Auth()->user()->can('delete loan')){
                                                    $btn .= '<a data-id='.$row->id.' class="dropdown-item delete-installment" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                                }
                                            }
                                $btn .= '</div></div>';
                            }
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);

    }
    public function get_employee(Request $request){
        $data['employee'] = Employee::where('branch_id',$request->branch_id)->get();
        return response()->json($data);
    }
    public function store(Request $request)
    {
        if (Auth::user()->can('create loan')) {
            if ($request->loan == "installment"){
                $validator = Validator::make(
                    $request->all(),
                    [
                        'loan_type_id'  => 'required',
                        'employee_id'   => 'required',
                        'installment'   => 'required',
                        'tenor'         => 'required',
                        'amount'        => 'required',
                        'branch_id'     => 'required',
                    ]
                );
            }else{
                $validator = Validator::make(
                    $request->all(),
                    [
                        'loan_type_id'  => 'required',
                        'employee_id'   => 'required',
                        'amount'        => 'required',
                        'branch_id'     => 'required',
                    ]
                );
            }

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }
            try {
                DB::beginTransaction();

                $employee = Employee::where('user_id', '=', Auth::user()->id)->first();
                $loan    = new Loan();
                if ($request->loan == "installment"){
                    $loan->employee_id          = $request->employee_id;
                    $loan->loan_type_id         = $request->loan_type_id;
                    $loan->number_of_installment= 0;
                    $loan->tenor                = $request->tenor;
                    $loan->remaining_installment= $request->amount;
                    $loan->amount               = $request->amount;
                    $loan->installment          = $request->installment;
                    $loan->status               = 'pending';
                    $loan->type                 = 'installment';
                    $loan->branch_id            = $request->branch_id;
                    $loan->application_date     = date('Y-m-d');
                    $loan->is_update            = '0';
                    $loan->created_by           = Auth::user()->creatorId();
                }else{
                    $loan->employee_id = $request->employee_id;
                    $loan->loan_type_id         = $request->loan_type_id;
                    $loan->amount               = $request->amount;
                    $loan->installment          = 0;
                    $loan->number_of_installment = 0;
                    $loan->status               = 'pending';
                    $loan->type                 = 'cash_advance';
                    $loan->branch_id            = $request->branch_id;
                    $loan->created_by           = Auth::user()->creatorId();
                }
                $loan->save();

                DB::commit();
                toast('Loan successfully created.', 'success');
                if ($request->loan == "installment"){
                    return redirect()->route('loan_cash_receipt');
                }else{
                    return redirect()->route('loans.index');
                }
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.', 'error');
                if ($request->loan == "installment"){
                    return redirect()->route('loan_cash_receipt');
                }else{
                    return redirect()->route('loans.index');
                }
            }
        } else {
            toast('Permission denied.', 'error');
            if ($request->loan == "installment"){
                return redirect()->route('loan_cash_receipt');
            }else{
                return redirect()->route('loans.index');
            }
        }
    }

    public function edit($id)
    {
        $loan = Loan::where('id','=',$id)->with('employee')->first();
        if (Auth::user()->can('edit loan')) {
            if ($loan->branch_id == Auth::user()->branch_id) {
                return response()->json($loan);
            } else {
                return response()->json(['error' => 'Permission denied.'], 401);
            }
        } else {
            return response()->json(['error' => 'Permission denied.'], 401);
        }
    }

    public function update(Request $request)
    {
        $loan = Loan::find($request->id);

        if (Auth::user()->can('edit loan')) {
            if ($loan->branch_id == Auth::user()->branch_id) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'loan_type_id' => 'required',
                        'employee_id' => 'required',
                        'amount' => 'required',
                    ]
                );

                if ($validator->fails()) {
                    return redirect()->back()->with('errors', $validator->messages());
                }

                try {
                    $arr = [
                        'loan_type_id' => $request->loan_type_id,
                        'installment'  => $request->installment,
                        'tenor'        => $request->tenor,
                        'amount'       => $request->amount,
                        'is_update'    => '0',
                    ];
                    $data = $loan->update($arr);
                    if ($data){
                        $res = [
                            'status' => 'success',
                            'msg'    => 'Data success updated!'
                        ];
                    }else{
                        $res = [
                            'status' => 'error',
                            'msg'    => 'Data not success updated!'
                        ];
                    }
                    return response()->json($res);

                } catch (Exception $e) {
                    toast('Permission denied.', 'error');
                    return redirect()->back();
                }
            } else {
                toast('Permission denied.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        if (Auth::user()->can('delete loan')) {
            $loan = Loan::find($request->id);
            if ($loan->branch_id == Auth::user()->branch_id) {
                $del = $loan->delete();

                if ($del){
                    $res = [
                        'status' =>'success',
                        'msg'    => "Data success deleted !",
                    ];
                }else{
                    $res = [
                        'status' =>'success',
                        'msg'    => "Data success deleted !",
                    ];
                }
               return response()->json($res);
            } else {
                $res = [
                    'status' =>'error',
                    'msg'    => "Permission denied.",
                ];
                return response()->json($res);
            }
        } else {
            $res = [
                'status' =>'error',
                'msg'    => "Permission denied.",
            ];
            return response()->json($res);
        }
    }
}
