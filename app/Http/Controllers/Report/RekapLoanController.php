<?php

namespace App\Http\Controllers\Report;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\AccessBranch;
use App\Models\Employee;
use App\Models\Loan;
use App\Models\LoanOption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LoanExport;
use App\Exports\CashadvanceExport;
use DataTables;

class RekapLoanController extends Controller
{
    public function loan(){
        $user = Auth::user();
        $getBranch = Branch::select('name','id','company_id')->where('id',$user->branch_id)->first();
        $emp = Employee::where('user_id',Auth::user()->id)->first();
        
        if ($user->initial == "HO"){
            if (Auth::user()->type == "company"){
                $data['branch'] = Branch::select('name','id')->where('company_id',$getBranch->company_id)->get();
            }else{
                $data['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                ->where('access_branches.employee_id',$emp->id)
                                                ->where('access_branches.company_id',$getBranch->company_id)->get();
            }
        }else{
            $data['branch'] = Branch::select('name','id')->where('id',$user->branch_id)->get();;
        }
        $data['loans']      = Loan::where('branch_id', '=', Auth::user()->branch_id)->get();
        $data['employee']   = Employee::where('branch_id', '=', Auth::user()->branch_id)->get();
        $data['loanType']  = LoanOption::where('name','<>','KASBON')->get();
        return view('pages.contents.report.loan.index',$data);
    }
    public function get_loan(Request $request){
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
                            if(Auth()->user()->canany('view loan')){
                                $btn .= '<div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">';
                                            if(Auth()->user()->can('view loan')){
                                                $btn .= ' <a  data-url="'.route('loans.edit', $row->id).'" class="dropdown-item view-loan" href="javascript:void(0)"><i class="fa fa-eye m-r-5"></i> Edit</a>';
                                            }
                                $btn .= '</div></div>';
                            }
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
    }
    public function cashadvance(){
        $user = Auth::user();
        $getBranch = Branch::select('name','id','company_id')->where('id',$user->branch_id)->first();
        $emp = Employee::where('user_id',Auth::user()->id)->first();
        
        if ($user->initial == "HO"){
            if (Auth::user()->type == "company"){
                $data['branch'] = Branch::select('name','id')->where('company_id',$getBranch->company_id)->get();
            }else{
                $data['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                ->where('access_branches.employee_id',$emp->id)
                                                ->where('access_branches.company_id',$getBranch->company_id)->get();
            }
        }else{
            $data['branch'] = Branch::select('name','id')->where('id',$user->branch_id)->get();
        }
        $data['loans'] = Loan::where('branch_id', '=', Auth::user()->branch_id)->get();
        $data['employee']  = Employee::where('branch_id', '=', Auth::user()->branch_id)->get();
        $data['loanType'] = LoanOption::where('name','=','KASBON')->get();
        return view('pages.contents.report.cash-advance.index',$data);
    }
    public function get_cashadvance(Request $request){
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
                    ->where('loans.status','=',$status)
                    ->whereIn('loans.type',['cash_advance',null])
                    ->orderBy('loans.created_at','DESC')
                    ->with('loan_type')
                    ->get();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action',function($row){
                            $btn ='';
                            if(Auth()->user()->canany('view cash advance')){
                                $btn .= '<div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">';
                                            if(Auth()->user()->can('view cash advance')){
                                                $btn .= ' <a  data-url="'.route('loans.edit', $row->id).'" class="dropdown-item cash-advance-view" href="javascript:void(0)"><i class="fa fa-eye m-r-5"></i> View</a>';
                                            }
                                $btn .= '</div></div>';
                            }
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);

    }
    public function LoanExportExcel(Request $request){
        $date = date('Ymd');
        $fileName = 'loan-report_'.$date.'.xlsx';
        return Excel::download(new LoanExport($request), $fileName);
    }
    public function CashadvanceExportExcel(Request $request){
        $date = date('Ymd');
        $fileName = 'cash-advance-report_'.$date.'.xlsx';
        return Excel::download(new CashadvanceExport($request), $fileName);
    }
    
}
