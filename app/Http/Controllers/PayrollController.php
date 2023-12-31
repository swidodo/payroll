<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Employee;
use App\Models\Payroll;
use App\Models\PayslipType;
use App\Models\SetBpjsTK;
use App\Models\Utility;
use App\Models\AllowanceFinance;
use App\Models\AllowanceOption;
use App\Models\Master_bpjs;
use App\Models\Bpjs_value;
use App\Models\Branch;
use App\Models\LoanOption;
use App\Models\Loan;
use App\Models\Deduction_other;
use App\Models\Deduction_admin;
use App\Models\AccessBranch;
use Carbon\Carbon;
use Exception;
use DataTables;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PayrollController extends Controller
{
    public function index()
    {
       if (Auth::user()->can('manage payroll')) {
            $branch = Branch::where('id',Auth::user()->branch_id)->first();
            $emp = Employee::where('user_id',Auth::user()->id)->first();
            if (Auth::user()->initial == "HO"){
                if (Auth::user()->type == "company"){
                    $branches = Branch::where('company_id',$branch->company_id)->get();
                }else{
                    $branches = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                    ->where('access_branches.employee_id',$emp->id)
                                                    ->where('access_branches.company_id',$branch->company_id)->get();
                }
            }else{
                $branches = Branch::where('id',$branch->id)->get();
            }
            $payroll = Payroll::where('branch_id', '=', Auth::user()->branch_id)->get();
            $employee  = Employee::where('branch_id', '=', Auth::user()->branch_id)->get();
            $payslipType = PayslipType::all();
            $allowanceTypes  = AllowanceOption::where('branch_id', '=', Auth::user()->branch_id)->get();
            $data_bpjs = Master_bpjs::where('branch_id','=',Auth::user()->branch_id)->get();
            return view('pages.contents.payroll.index', compact('payroll', 'employee', 'payslipType','allowanceTypes','data_bpjs','branches'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
    public function get_data(Request $request){
        $data = DB::table('v_payrolls')->select('*')->where('branch_id',$request->branch_id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $btn ='';
                    if(Auth()->user()->canany('edit payroll', 'show payroll','delete payroll')){
                        $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                        if(Auth()->user()->can('show payroll')){
                            $btn .= '<a  data-id ="'.$row->id.'" class="dropdown-item view-payroll" href="javascript:void(0)" ><i class="fa fa-eye m-r-5"></i> View</a>';
                        }if(Auth()->user()->can('edit payroll')){
                            $btn .= '<a  data-id ="'.$row->id.'" class="dropdown-item edit-payroll" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_payroll"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                        }
                        if(Auth()->user()->can('delete payroll')){
                            $btn .='<a  data-id="'.$row->id.'" class="dropdown-item delete-data-payroll" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                        }
                    }
                    return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
    }
    public function get_data_setpayroll(Request $request){
        $data['employee']        = Employee::where('branch_id', '=',$request->branch_id)->get();
        $data['allowanceTypes']  = AllowanceOption::where('branch_id', '=', Auth::user()->branch_id)->get();
        $data['data_bpjs'  ]     = Master_bpjs::where('branch_id','=',Auth::user()->branch_id)->get();
        return response()->json($data);
    }
    public function store(Request $request)
    {
        if (Auth::user()->can('create payroll')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'payslip_type_id'   => 'required',
                    'employee_id'       => 'required',
                    'amount_salary'     => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }
            $payrollData = Payroll::where('employee_id',$request->employee_id)->count();
            if ($payrollData > 0){
                $res =[
                    'status' => 'info',
                    'msg'    => 'Data already in payroll data !',
                ];
                return response()->json($res);
            }

            try {
                DB::beginTransaction();

                $employee = Employee::where('id', '=', $request->employee_id)->first();
                $payroll    = new Payroll();
                if (Auth::user()->type == "employee") {
                    $payroll->employee_id = $employee->id;
                } else {
                    $payroll->employee_id = $request->employee_id;
                }

                $payroll->payslip_type_id    = $request->payslip_type_id;
                $payroll->amount             = $request->amount_salary;
                $payroll->branch_id          = $request->branch_id;
                $payroll->status_pph21       = (isset($request->pph21)) ? $request->pph21 : '0';
                $payroll->status_bpjs       = (isset($request->unnormatif_bpjs)) ? 'unnormatif' : 'normatif';
                $payroll->created_by         = Auth::user()->creatorId();

                $employee->salary            = $payroll->amount;
                $employee->salary_type       = isset($payroll->payslip_type) ? $payroll->payslip_type->name . ' (' . ucwords($payroll->payslip_type->type) . ')' : null;


                // allowance

                $allowance    = new AllowanceFinance();
                $i=0;
                $data_array= [];
                if($request->amount !=""){
                    foreach($request->amount as $amount){
                        if ($amount !=''){
                            $data = [
                                'allowance_type_id' =>$request->allowance_id[$i],
                                'employee_id'       => $request->employee_id,
                                'amount'            => $amount,
                                'created_by'        => Auth::user()->creatorId()
                            ];
                            if(! in_array($data,$data_array)){
                                array_push($data_array,$data);
                            }
                        }
                        $i++;
                    }
                }
                $payroll->save();
                $employee->save();
                if (count($data_array) > 0){
                    AllowanceFinance::Insert($data_array);
                }
                DB::commit();

                $allowance = AllowanceFinance::select(DB::raw('sum(allowance_finances.amount) as allowance'))
                                              ->leftJoin('allowance_options','allowance_options.id','=','allowance_finances.allowance_type_id')
                                              ->where('allowance_finances.employee_id',$request->employee_id)
                                              ->where('allowance_options.pay_type','=','fixed')
                                              ->first();

                if (isset($request->unnormatif_bpjs)){
                    $salary_gross = $request->amount_salary + $allowance->allowance;
                    $bp = [];
                    $code = ['JHT','JKK','JKM','JP','KSHT'];
                    foreach ($code as $dt ){
                        if ($dt == "JHT"){
                            $bpjs = Master_bpjs::where('bpjs_code','JHT')->first();
                            $valbpjs  = $request->bpjs_jht;
                        }else if($dt == "JKK"){
                             $bpjs = Master_bpjs::where('bpjs_code','JKK')->first();
                            $valbpjs  = $request->bpjs_jkk;
                        }else if($dt == "JKM"){
                             $bpjs = Master_bpjs::where('bpjs_code','JKM')->first();
                            $valbpjs  = $request->bpjs_jkm;
                        }else if($dt == "JP"){
                             $bpjs = Master_bpjs::where('bpjs_code','JP')->first();
                            $valbpjs  = $request->bpjs_jp;
                        }else if($dt == "KSHT"){
                             $bpjs = Master_bpjs::where('bpjs_code','KSHT')->first();
                            $valbpjs  = $request->bpjs_kesehatan;
                        }
                        if ($valbpjs != ""){
                            $databpjs = [
                                'bpjs_id'       => $bpjs->id,
                                'bpjs_name'     => $bpjs->bpjs_name,
                                'is_company'    => 0,
                                'is_employee'   => $valbpjs,
                                'is_total'      => $valbpjs,
                                'salary_gross'  => $salary_gross,
                                'salary_kes'    => 0,
                                'salary_tk_jp'  => 0,
                                'value_kes'     => 0,
                                'value_tk_jp'   => 0,
                                'employee_id'   => $request->employee_id,
                                'branch_id'     => $request->branch_id,
                                'created_at'    => date("Y-m-d H:i:s"),
                                'updated_at'    => date("Y-m-d H:i:s"),
                            ];
                            if(!in_array($databpjs,$bp)){
                                array_push($bp,$databpjs);
                            }
                        }  
                    }
                    $checkBp = Bpjs_value::where('employee_id',$request->employee_id)->count(); 
                    if ($checkBp > 0 ){
                        Bpjs_value::destroy($request->employee_id);
                    }
                    if(count($bp) > 0){
                        Bpjs_value::Insert($bp);
                    }
                } else {
                    if(isset($request->bpjs)){
                        $array_bpjs = [];
                        $salary_gross = $request->amount_salary + $allowance->allowance;

                        foreach($request->bpjs as $bpjs){
                            $getName     = Master_bpjs::where('id','=',$bpjs)->first();
                            $max_bpjs = DB::table('master_limit_max_bpjs')->select('value')->where('bpjs_code',$getName->bpjs_code)->first();
                                
                            if ($getName->bpjs_code == 'KSHT' || $getName->bpjs_code == 'JP'){
                                if ($max_bpjs->value <  $salary_gross ){
                                    $val_comp   = round($max_bpjs->value * $getName->is_company / 100 );
                                    $val_emp    = round($max_bpjs->value * $getName->is_employee / 100 );
                                    $total      = round($val_comp + $val_emp);
                                }else{
                                    $val_comp   = round($salary_gross * $getName->is_company / 100 );
                                    $val_emp    = round($salary_gross * $getName->is_employee / 100 );
                                    $total      = round($val_comp + $val_emp);
                                }
                            }else{
                                $val_comp   = round($salary_gross * $getName->is_company / 100 );
                                $val_emp    = round($salary_gross * $getName->is_employee / 100 );
                                $total      = round($val_comp + $val_emp);
                            }
                            $check = Bpjs_value::where('employee_id','=',$request->employee_id)->where('bpjs_id','=',$bpjs)->count();
                            if ($check <= 0){
                                $databpjs = [
                                    'bpjs_id'       => $bpjs,
                                    'bpjs_name'     => $getName->bpjs_name,
                                    'is_company'    => $val_comp,
                                    'is_employee'   => $val_emp,
                                    'is_total'      => $total,
                                    'salary_gross'  => $salary_gross,
                                    'salary_kes'    => 0,
                                    'salary_tk_jp'  => 0,
                                    'value_kes'     => 0,
                                    'value_tk_jp'   => 0,
                                    'employee_id'   => $request->employee_id,
                                    'branch_id'     => $request->branch_id,
                                    'created_at'    => date("Y-m-d H:i:s"),
                                    'updated_at'    => date("Y-m-d H:i:s"),
                                ];
                                if(! in_array($databpjs,$array_bpjs)){
                                    array_push($array_bpjs,$databpjs);
                                }
                            }
                        }
                        $checkBp = Bpjs_value::where('employee_id',$request->employee_id)->count(); 
                        if ($checkBp > 0 ){
                            Bpjs_value::destroy($request->employee_id);
                        }
                        if (count($array_bpjs) > 0){
                            $bpjsVlue = Bpjs_value::Insert($array_bpjs);
                        }
                    }
                }

                $res = [
                    'status' => 'success',
                    'msg'    => 'Payroll successfully created !',
                ];
                return response()->json($res);

            } catch (Exception $e) {
                DB::rollBack();
                $res = [
                    'status' => 'error',
                    'msg'    => 'Payroll Not Successfully Created !',
                ];
                return response()->json($res);
            }
        } else {
            $res = [
                    'status' => 'error',
                    'msg'    => 'Permission denied.',
                ];
            return response()->json($res);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request)
    {
        if (Auth::user()->can('edit payroll')) {
            $data['payroll']        = Payroll::where('id','=',$request->id)->with('employee','payslip_type')->first();
            $data['payslip_type']   = PayslipType::select('id','name','type')->get();
            $data['valAllowance']   = AllowanceFinance::where('employee_id','=',$data['payroll']->employee_id)->with('allowance_type')->get();
            $data['bpjs']           = Bpjs_value::where('employee_id','=',$data['payroll']->employee_id)->get();
            $data['master_bpjs']    = Master_bpjs::get();
            $data['allowance']      = AllowanceOption::get();

            return response()->json($data);
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {

        if (Auth::user()->can('edit payroll')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'payslip_type_id' => 'required',
                    'employee_id' => 'required',
                    'amount_salary' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();
                $checkPayroll = Payroll::find($request->id);
                if (is_null($checkPayroll)) {
                    $res = [
                        'status' => 'error',
                        'msg'    => 'Payroll not found.'
                    ];
                    return response()->json($res);
                }
                $employee = Employee::where('id', '=', $request->employee_id)->first();
                $salary_type  = (isset($checkPayroll->payslip_type_id)) ? $checkPayroll->payslip_type->name . ' (' . ucwords($checkPayroll->payslip_type->type) . ')' : null;
                $status_bpjs =(isset($request->unnormatif_bpjs)) ? 'unnormatif' : 'normatif';
                $status_pph21 = (isset($request->pph21)) ? $request->pph21 : '0';
                $payroll = [
                    'payslip_type_id' => $request->payslip_type_id,
                    'amount'          => $request->amount_salary,
                    'status_bpjs'     => $status_bpjs,
                    'status_pph21'    => $status_pph21,
                    'update_by'       => Auth::user()->creatorId(),
                ];

                $emp = [
                    'salary'        => $request->amount_salary,
                    'salary_type'   => $salary_type,
                ];

               if(isset($request->amount)){
                    $allowance    = new AllowanceFinance();
                    $i=0;
                    $data_array= [];
                    foreach($request->amount as $amount){
                        if ($amount != ''){
                            $data = [
                                'allowance_type_id' => $request->allowance_id[$i],
                                'employee_id'       => $request->employee_id,
                                'amount'            => $amount,
                                'created_by'        => Auth::user()->creatorId()
                            ];

                            if(! in_array($data,$data_array)){
                                array_push($data_array,$data);
                            }
                        
                            $i++;
                        }
                    }
                    if (count($data_array) > 0){

                        AllowanceFinance::where('employee_id','=',$employee->id)->delete();
                        AllowanceFinance::Insert($data_array);
                    }
                }
                Payroll::where('employee_id','=',$employee->id)->update($payroll);
                Employee::where('id',$employee->id)->update($emp);
                DB::commit();
                $allowance = AllowanceFinance::select(DB::raw('sum(amount) as allowance'))
                                            ->leftJoin('allowance_options','allowance_options.id','=','allowance_type_id')
                                            ->where('employee_id',$request->employee_id)
                                            ->where('allowance_options.pay_type','=','fixed')
                                            ->first();

                if (isset($request->unnormatif_bpjs)){
                    $salary_gross = $request->amount_salary + $allowance->allowance;
                    $bp = [];
                    $code = ['JHT','JKK','JKM','JP','KSHT'];
                    foreach ($code as $dt ){
                        if ($dt == "JHT"){
                            $bpjs = Master_bpjs::where('bpjs_code','JHT')->first();
                            $valbpjs  = $request->bpjs_jht;
                        }else if($dt == "JKK"){
                             $bpjs = Master_bpjs::where('bpjs_code','JKK')->first();
                            $valbpjs  = $request->bpjs_jkk;
                        }else if($dt == "JKM"){
                             $bpjs = Master_bpjs::where('bpjs_code','JKM')->first();
                            $valbpjs  = $request->bpjs_jkm;
                        }else if($dt == "JP"){
                             $bpjs = Master_bpjs::where('bpjs_code','JP')->first();
                            $valbpjs  = $request->bpjs_jp;
                        }else if($dt == "KSHT"){
                             $bpjs = Master_bpjs::where('bpjs_code','KSHT')->first();
                            $valbpjs  = $request->bpjs_kesehatan;
                        }
                        if ($valbpjs != ""){
                            $databpjs = [
                                'bpjs_id'       => $bpjs->id,
                                'bpjs_name'     => $bpjs->bpjs_name,
                                'is_company'    => 0,
                                'is_employee'   => $valbpjs,
                                'is_total'      => $valbpjs,
                                'salary_gross'  => $salary_gross,
                                'salary_kes'    => 0,
                                'salary_tk_jp'  => 0,
                                'value_kes'     => 0,
                                'value_tk_jp'   => 0,
                                'employee_id'   => $request->employee_id,
                                'branch_id'     => $request->branch_id,
                                'created_at'    => date("Y-m-d H:i:s"),
                                'updated_at'    => date("Y-m-d H:i:s"),
                            ];
                            if(!in_array($databpjs,$bp)){
                                array_push($bp,$databpjs);
                            }
                        }  
                    }
                    
                    if(count($bp) > 0){
                        Bpjs_value::where('employee_id','=',$request->employee_id)->delete();
                        Bpjs_value::Insert($bp);
                    }
                } else {
                    $a = 0;
                    $array_bpjs = [];
                    $salary_gross = $request->amount_salary + $allowance->allowance;

                    if(isset($request->bpjs)){
                        foreach($request->bpjs as $bpjs){
                            $getName     = Master_bpjs::where('id','=',$bpjs)->first();
                            $max_bpjs = DB::table('master_limit_max_bpjs')->select('value')->where('bpjs_code',$getName->bpjs_code)->first();
                                
                            if ($getName->bpjs_code == 'KSHT' || $getName->bpjs_code == 'JP'){
                                if ($max_bpjs->value <  $salary_gross ){
                                    $val_comp   = round($max_bpjs->value * $getName->is_company / 100 );
                                    $val_emp    = round($max_bpjs->value * $getName->is_employee / 100 );
                                    $total      = round($val_comp + $val_emp);
                                }else{
                                    $val_comp   = round($salary_gross * $getName->is_company / 100 );
                                    $val_emp    = round($salary_gross * $getName->is_employee / 100 );
                                    $total      = round($val_comp + $val_emp);
                                }
                            }else{
                                $val_comp   = round($salary_gross * $getName->is_company / 100 );
                                $val_emp    = round($salary_gross * $getName->is_employee / 100 );
                                $total      = round($val_comp + $val_emp);
                            }
                            $databpjs = [
                                'bpjs_id'       => $bpjs,
                                'bpjs_name'     => $getName->bpjs_name,
                                'is_company'    => $val_comp,
                                'is_employee'   => $val_emp,
                                'is_total'      => $total,
                                'salary_gross'  => $salary_gross,
                                'salary_kes'    => 0,
                                'salary_tk_jp'  => 0,
                                'value_kes'     => 0,
                                'value_tk_jp'   => 0,
                                'employee_id'   => $request->employee_id,
                                'branch_id'     => $request->branch_id,
                                'created_at'    => date("Y-m-d H:i:s"),
                                'updated_at'    => date("Y-m-d H:i:s"),
                            ];
                            // dd($request);
                            if(! in_array($databpjs,$array_bpjs)){
                                array_push($array_bpjs,$databpjs);
                            }
                        }
                        if (count($array_bpjs) > 0){
                            Bpjs_value::where('employee_id','=',$request->employee_id)->delete();
                            $bpjsVlue = Bpjs_value::Insert($array_bpjs);
                        }
                    }
                }
                $res = [
                    'status' => 'success',
                    'msg'    => 'Payroll successfully created !',
                ];
                return response()->json($res);
            } catch (Exception $e) {
                DB::rollBack();
                 $res = [
                'status' => 'error',
                'msg'    => 'Sameting went wrong !',
                ];
                return response()->json($res);
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('payroll.index');
        }
    }

    public function destroy(Request $request)
    {
        if (Auth::user()->can('delete payroll')) {
            DB::beginTransaction();
                $payroll = Payroll::find($request->id);
                AllowanceFinance::where('employee_id','=',$payroll->employee_id)->delete();
                Bpjs_value::where('employee_id','=',$payroll->employee_id);
                Payroll::where('id','=',$request->id)->delete();
            DB::commit();
                $res = [
                    'status' => 'success',
                    'msg'    => 'Data success delete !'
                ];
                return response()->json($res);
            DB::rollBack();
                $res = [
                    'status' => 'error',
                    'msg'    => 'Data Not Success Delete !'
                ];
                return response()->json($res);
        } else {
            $res = [
                'status' => 'error',
                'msg'    => 'Permission denied.!'
            ];
            return response()->json($res);
        }
    }
    public function list_bpjs(){
        $data['bpjs'] = Master_bpjs::all();
        return response()->json($data);
    }
    public function run_payroll(){
        if(Auth::user()->can('manage payroll')){
            $companyId  = Branch::where('id',Auth::user()->branch_id)->first();
            $emp = Employee::where('user_id',Auth::user()->id)->first();
        
            if (Auth::user()->type == "company"){
                $branch['branch']   = Branch::where('company_id',$companyId->company_id)->get();
            }else{
                $branch['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                ->where('access_branches.employee_id',$emp->id)
                                                ->where('access_branches.company_id',$companyId->company_id)->get();
            }
            return  view('pages.contents.payroll.run_payroll',$branch);
        }else{
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
    public function generate_run_payroll(Request $request){
        try {
            DB::beginTransaction();
            $tochecked = DB::table('take_home_pay')->select('*')
                                    ->where('branch_id',$request->branch_id)
                                    ->where('startdate','>=',$request->startdate)
                                    ->where('enddate','<=',$request->enddate)
                                    ->get();
            if($tochecked !=null){
                DB::table('take_home_pay')
                ->where('branch_id','=',$request->branch_id)
                ->where('startdate','>=',$request->startdate)
                ->where('enddate','<=',$request->enddate)
                ->delete();
            }

            $thps = DB::select("SELECT a.*,b.position_id,b.name as emp_name FROM get_take_home_pay('".$request->startdate."','".$request->enddate."','".$request->branch_id."') as a LEFT JOIN employees as b
                ON a.employee_id = b.id and b.status = 'active'");
            $data_thp = [];
            foreach($thps as $thp) {
                $data = [
                    'date' => date('Y-m-d'),
                    'employee_id' => $thp->employee_id,
                    'employee_code' => $thp->employee_code,
                    'no_employee' => $thp->no_employee,
                    'name' => $thp->emp_name,
                    'position_id' => $thp->position_id,
                    'level' => '',
                    'bank_name' => $thp->bank_name,
                    'account_number' => $thp->account_number,
                    'basic_salary' => $thp->basic_salary,
                    'allowance_fixed' => $thp->allowance_fixed,
                    'allowance_unfixed' => $thp->allowance_unfixed,
                    'allowance_other' => $thp->allowance_other,
                    'overtime' => $thp->overtime,
                    'salary_this_month' => $thp->salary_this_month,
                    'company_pay_bpjs' => $thp->company_pay_bpjs,
                    'total_salary' => $thp->total_salary,
                    'company_pay_bpjs_kesehatan' => $thp->company_pay_bpjs_kesehatan,
                    'company_pay_bpjs_ketenagakerjaan' => $thp->company_pay_bpjs_ketenagakerjaan,
                    'employee_pay_bpjs_kesehatan' => $thp->employee_pay_bpjs_kesehatan,
                    'employee_pay_bpjs_ketenagakerjaan' => $thp->employee_pay_bpjs_ketenagakerjaan,
                    'company_total_pay_bpjs' => $thp->company_total_pay_bpjs,
                    'employee_total_pay_bpjs' => $thp->employee_total_pay_bpjs,
                    'installment' => $thp->installment,
                    'loans' => $thp->loans,
                    'total_pay_loans' => $thp->total_pay_loans,
                    'total_deduction_other' => $thp->total_pay_deduction_other,
                    'sanksi_adm' => $thp->total_pay_adm,
                    'pph21' => $thp->pph21,
                    'total_deduction' => $thp->total_deduction,
                    'take_home_pay' => $thp->take_home_pay,
                    'branch_id' => $request->branch_id,
                    'startdate' => $request->startdate,
                    'enddate' => $request->enddate,
                    'created_at' => date('Y-m-d H:m:s'),
                ];
                if(!in_array($data,$data_thp)){
                    array_push($data_thp, $data);
                }
                $month = date('m',strtotime($request->enddate));
                $year = date('Y',strtotime($request->enddate));
                $loans =  DB::table('loans')
                    ->select('loans.*')
                    ->leftJoin('loan_options','loan_options.id','loans.loan_type_id')
                    ->where('loans.employee_id',$thp->employee_id)
                    ->where('loans.branch_id',$request->branch_id)
                    ->where('loans.status','ongoing')
                    // ->whereMonth('loans.updated_at', $month)
                    // ->whereYear('loans.updated_at', $year)
                    ->get();

                    if ($loans !=null){
                        foreach($loans as $empLoans){
                            if ($empLoans->installment != 0 && $empLoans->number_of_installment < $empLoans->tenor){
                                $numberInstallment = $empLoans->number_of_installment + 1;
                                if ($empLoans->tenor == $numberInstallment){
                                    $status = 'paid off';
                                }else{
                                    $status = 'ongoing';
                                }
                                $dataLoans = [
                                    'status' =>  $status,
                                    'number_of_installment' => $numberInstallment,
                                    'updated_at' => $request->enddate.' '.date('h:m:s'),
                                ];
                                DB::table('loans')->where('employee_id',$empLoans->employee_id)
                                                 ->where('installment','!=',0)
                                                 ->update($dataLoans);
                            }else if($empLoans->installment == 0){
                                $dataLoans = [
                                    'status' =>'paid off',
                                    'updated_at' => $request->enddate.' '.date('h:m:s'),
                                ];
                                DB::table('loans')->where('employee_id',$empLoans->employee_id)
                                                 ->where('installment','=',0)
                                                 ->update($dataLoans);
                            }
                        }
                    }
            }
            DB::table('take_home_pay')->insert($data_thp);  
    
            $pph = DB::select("SELECT * from get_rekap_pph21_final('".$request->startdate."','".$request->enddate."','".$request->branch_id."')");
                $pph21Final = [];
                foreach($pph as $pph21){
                    $pphData = [
                        'date' => date('Y-m-d'),
                        'branch_id' => $request->branch_id,
                        'employee_id' => $pph21->employee_id, 
                        'salary_pokok' => $pph21->salary_pokok, 
                        'total_allowance_fixed'=> $pph21->total_allowance_fixed,
                        'total_allowance_unfixed'=> $pph21->total_allowance_unfixed,
                        'total_allowance_other'=> $pph21->total_allowance_other,
                        'total_overtime'=> $pph21->total_overtime,
                        'salary_in_month'=> $pph21->salary_in_month, 
                        'pay_bpjs_company'=> $pph21->pay_bpjs_company, 
                        'salary_brutto'=> $pph21->salary_brutto,
                        'biaya_jabatan'=> $pph21->biaya_jabatan,
                        'pay_bpjs_employee'=> $pph21->pay_bpjs_employee, 
                        'total_pengurangan'=> $pph21->total_pengurangan,
                        'salary_netto'=> $pph21->salary_netto,
                        'salary_1_tahun'=> $pph21->salary_1_year, 
                        'ptkp_1_tahun'=> $pph21->ptkp_1_tahun,
                        'pkp'=> $pph21->ptkp_1_tahun,
                        'pph21_terhutang_1_tahun'=> $pph21->pph21_terhutang_1_tahun, 
                        'pph21_terhutang_1_bulan'=> $pph21->pph21_terhutang_1_bulan,
                        'startdate' => $request->startdate,
                        'enddate' => $request->enddate,
                    ];

                    $cekPayroll = Payroll::where('employee_id',$pph21->employee_id)->first();
                    if ($cekPayroll->status_pph21 == '1' || $cekPayroll->status_pph21 == 1){
                        if (!in_array($pphData,$pph21Final)){
                            array_push($pph21Final,$pphData);
                        }
                    }

                }
                if (count($pph21Final) > 0){
                    $checkPayrollpph = DB::table('rekap_pph21s')->where('startdate','<=',$request->startdate)->where('enddate','>=',$request->enddate)->get();
                    if ($checkPayrollpph !=null){
                        DB::table('rekap_pph21s')->where('startdate','>=',$request->startdate)->where('enddate','<=',$request->enddate)->delete();
                    }
                    DB::table('rekap_pph21s')->insert($pph21Final);
                }
            DB::commit();
            $res = [
                    'status' => 'success',
                    'msg'    => 'Payroll Successfully Generated !',
                ];
            return response()->json($res);
        } catch (Exception $e) {
             DB::rollBack();
                $res = [
                    'status' => 'error',
                    'msg'    => 'Someting went wrong!',
                ];
            return response()->json($res);
        }
    }
    // public function import_run_payroll(Request $request){
    //     $file_extension = request()->file('import-payroll')->extension();
    //     if ('csv' == $file_extension) {
    //         $res = [
    //             'status' => 'success',
    //             'msg'    => 'Import Data Successfuly !',
    //         ];
    //         return response()->json($res);
    //         return true;
    //     } elseif ('xls' == $file_extension) {
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    //     } elseif ('xlsx' == $file_extension) {
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    //     }

    //     // $reader = new Xls();
    //     $spreadsheet = $reader->load(request()->file('import-payroll'));
    //     $sheetData = $spreadsheet->getActiveSheet()->toArray();
    //     $import =[];
    //     DB::beginTransaction();
    //     foreach ($sheetData as $key => $value) {
    //         if ($key > 0) :
    //             $branch = Branch::where('alias',$value[19])->first();
    //             if ($branch != null) :
    //                 $employeeId = employee::where('no_employee',$value[1])->where('branch_id',$branch->id)->first();
    //                 $takeHP = DB::table('take_home_pay')
    //                             ->where('employee_id',$employeeId->id)
    //                             ->where('startdate',$value[17])
    //                             ->where('enddate',$value[18])
    //                             ->count();
    //                 if ($takeHP > 0){
    //                     DB::table('take_home_pay')
    //                         ->where('employee_id',$employeeId->id)
    //                         ->where('startdate',$value[17])
    //                         ->where('enddate',$value[18])
    //                         ->delete();
    //                 }
    //                 $ded_other = Deduction_other::where('employee_id',$employeeId->id)->whereBetween('date',['startdate'=>$value[17],'enddate'=>$value[18]])->count();
    //                 if($ded_other > 0 ){
    //                     Deduction_other::where('employee_id',$employeeId->id)->whereBetween('date',['startdate'=>$value[17],'enddate'=>$value[18]])->delete();
    //                 }
    //                 $ded_loan = Loan::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[17],$value[18]])->count();
    //                 if ($ded_loan > 0 ){
    //                     Loan::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[17],$value[18]])->delete();
    //                 }
    //                 $allFinance = AllowanceFinance::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[17],$value[18]])->count();
    //                 if ($allFinance > 0){
    //                     AllowanceFinance::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[17],$value[18]])->delete();
    //                 }
    //                 $allother = DB::table('allowances')->where('employee_id',$employeeId->id)->whereBetween('date',[$value[17],$value[18]])->count();
    //                 if ($allother > 0){
    //                     DB::table('allowances')->where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[17],$value[18]])->delete();
    //                 }
    //                 if ($employeeId != null ):
    //                     if($employeeId->id =='' | $employeeId->id ==null){
    //                         return true;
    //                     }
    //                     $val_salarymonth = (($value[3] !=null) ? $value[3] : 0 ) + (($value[4] !=null) ? $value[4] : 0 ) + (($value[5] !=null) ? $value[5] : 0 ) + (($value[6] !=null) ? $value[6] : 0 );
    //                     $total_loan      = (($value[8] !=null) ? $value[8] : 0 );
    //                     $deduction_other = (($value[9] !=null) ? $value[9] : 0 ) + (($value[12] !=null) ? $value[12] : 0 ) + (($value[13] !=null) ? $value[13] : 0 ) + (($value[14] !=null) ? $value[14] : 0 ) + (($value[15] !=null) ? $value[15] : 0 );
    //                     $bpjs = (($value[10] !=null) ? $value[10] : 0 ) + (($value[11] !=null) ? $value[11] : 0 );
    //                     $total_deduction = $total_loan + $deduction_other + $bpjs;
    //                     $datas = [
    //                         'date'                              => date('Y-m-d'),
    //                         'employee_id'                       => $employeeId->id,
    //                         'employee_code'                     => $employeeId->employee_id,
    //                         'no_employee'                       => $employeeId->no_employee,
    //                         'name'                              => $employeeId->name,
    //                         'position_id'                       => $employeeId->position_id,
    //                         // 'level'                          => $employeeId->position_id,
    //                         'bank_name'                         => $employeeId->bank_name,
    //                         'account_number'                    => $employeeId->account_number,
    //                         'basic_salary'                      => (($value[3] !=null) ? $value[3] : 0 ),
    //                         'allowance_fixed'                   => (($value[4] !=null) ? $value[4] : 0 ),
    //                         'allowance_unfixed'                 => (($value[5] !=null) ? $value[5] : 0 ),
    //                         'allowance_other'                   => 0,
    //                         'overtime'                          => (($value[6] !=null) ? $value[6] : 0 ),
    //                         'salary_this_month'                 => $val_salarymonth,
    //                         'company_pay_bpjs'                  => 0,
    //                         'total_salary'                      => $val_salarymonth,
    //                         'company_pay_bpjs_kesehatan'        => 0,
    //                         'company_pay_bpjs_ketenagakerjaan'  => 0,
    //                         'employee_pay_bpjs_kesehatan'       => (($value[11] !=null) ? $value[11] : 0 ),
    //                         'employee_pay_bpjs_ketenagakerjaan' => (($value[10] !=null) ? $value[10] : 0 ),
    //                         'company_total_pay_bpjs'            => 0,
    //                         'employee_total_pay_bpjs'           => $bpjs,
    //                         'installment'                       => 0,
    //                         'loans'                             => (($value[8] !=null) ? $value[8] : 0 ),
    //                         'total_pay_loans'                   => $total_loan,
    //                         'sanksi_adm'                        => (($value[9] !=null) ? $value[9] : 0 ),
    //                         'total_deduction_other'             => $deduction_other,
    //                         'pph21'                             => 0,
    //                         'total_deduction'                   => $total_deduction,
    //                         'startdate'                         => $value[17],
    //                         'enddate'                           => $value[18],
    //                         'take_home_pay'                     => (($value[16] !=null) ? $value[16] : 0 ),
    //                         'branch_id'                         => $employeeId->branch_id,
    //                         'created_at'                        => date('Y-m-d h:m:s'),
    //                     ];
    //                     if (!in_array($datas,$import)){
    //                         array_push($import,$datas);
    //                     }
    //                     if ($value[4] !=null){
    //                         $opt = AllowanceOption::where('name','Tunjangan Jabatan')->where('pay_type','fixed')->where('include_attendance','N')->first();
    //                         if ($opt !=null){
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_type_id' => $opt->id,
    //                                 'amount'            => (($value[4] !=null) ? $value[4] : 0 ),
    //                                 'created_by'        => Auth::user()->id,
    //                                 'created_at'        => $value[18].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[18].' '.date('h:m:s')
    //                             ];
    //                             AllowanceFinance::insert($data);
    //                         }else{
    //                             $opts = [
    //                                 'name'               => 'Tunjangan Jabatan',
    //                                 'pay_type'           => 'fixed',
    //                                 'include_attendance' => 'N',
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_by'         => Auth::user()->id,
    //                                 'created_at'        => $value[18].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[18].' '.date('h:m:s')
    //                             ];
                                
    //                             $createOpt = AllowanceOption::Insert($opts);
                                
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_type_id' => DB::getPdo()->lastInsertId(),
    //                                 'amount'            => (($value[4] !=null) ? $value[4] : 0 ),
    //                                 'created_by'        => Auth::user()->creatorId(),
    //                                 'created_at'        => $value[18].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[18].' '.date('h:m:s')
    //                             ];
    //                             AllowanceFinance::insert($data);
                                
    //                         }
                            
    //                     }
    //                     if ($value[5] !=null){
    //                         $opt = AllowanceOption::where('name','Insentif')->where('pay_type','unfixed')->where('include_attendance','N')->first();
    //                         if ($opt !=null){
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => $opt->id,
    //                                 'amount'            => (($value[5] !=null) ? $value[5] : 0 ),
    //                                 'created_by'        => Auth::user()->id,
    //                                 'date'              => date('Y-m-d', strtotime($value[18])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[18].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[18].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
    //                         }else{
    //                             $opts = [
    //                                 'name'               => 'Insentif',
    //                                 'pay_type'           => 'unfixed',
    //                                 'include_attendance' => 'N',
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_by'         => Auth::user()->id,
    //                                 'created_at'        =>  $value[18].' '.date('h:m:s'),
    //                                 'updated_at'        =>  $value[18].' '.date('h:m:s')
    //                             ];
                                
    //                             $createOpt = AllowanceOption::Insert($opts);
                                
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => DB::getPdo()->lastInsertId(),
    //                                 'amount'            => (($value[5] !=null) ? $value[5] : 0 ),
    //                                 'created_by'        => Auth::user()->creatorId(),
    //                                 'date'              => date('Y-m-d', strtotime($value[18])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[18].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[18].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
                                
    //                         }
                            
    //                     }
    //                     if ($value[8] !=null){
    //                         $idopt = LoanOption::where('name','KASBON')->first();
                        
    //                         $data = [
    //                             'employee_id'           => $employeeId->id,
    //                             'loan_type_id'          => $idopt->id,
    //                             'installment'           => 0,
    //                             'number_of_installment' => 0,
    //                             'status'                => 'paid off',
    //                             'amount'                => $value[8],
    //                             'created_by'            => Auth::user()->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'created_at'            => $value[18].' '.date('h:m:s'),
    //                             'updated_at'            => $value[18].' '.date('h:m:s')
    //                         ];
    //                         Loan::insert($data);
    //                     }

    //                     // if ($value[9] != null){
    //                     //     $checkAdm =  Deduction_admin::where('branch_id',$employeeId->branch_id)->where('name','admin')->count();
    //                     //     if ($checkAdm > 0 ){
    //                     //         Deduction_admin::where('')->update();
    //                     //     }
    //                     // }
    //                     if ($value[12] != null){
    //                         $deduc2 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[18],
    //                             'name'                  => 'Koperasi',
    //                             'amount'                => $value[12],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[18].' '.date('h:m:s'),
    //                             'updated_at'            => $value[18].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc2);
    //                     }
    //                     if ($value[13] != null){
    //                         $deduc3 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[18],
    //                             'name'                  => 'Seragam',
    //                             'amount'                => $value[13],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[18].' '.date('h:m:s'),
    //                             'updated_at'            => $value[18].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc3);
    //                     }
    //                     if ($value[14] != null){
    //                         $deduc4 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[18],
    //                             'name'                  => 'Potongan Absensi',
    //                             'amount'                => $value[14],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[18].' '.date('h:m:s'),
    //                             'updated_at'            => $value[18].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc4);
    //                     }
    //                     if ($value[15] != null){
    //                         $deduc5 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[18],
    //                             'name'                  => 'Potongan Lain-lain',
    //                             'amount'                => $value[15],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[18].' '.date('h:m:s'),
    //                             'updated_at'            => $value[18].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc5);
    //                     }
    //                 endif;
    //             endif;
    //         endif;
    //     }
    //     $run = DB::table('take_home_pay')->insert($import);
    //     DB::commit();
    //         $res = [
    //             'status' => 'success',
    //             'msg'    => 'Import Data Successfuly !',
    //         ];
    //         return response()->json($res);
    //     DB::rollBack();
    //         $res = [
    //             'status' => 'error',
    //             'msg'    => 'Someting went Wrong!',
    //         ];
    //         return response()->json($res);
    // }
    // public function import_run_payroll_v2(Request $request){
    //     $file_extension = request()->file('import-payroll')->extension();
    //     if ('csv' == $file_extension) {
    //         $res = [
    //             'status' => 'success',
    //             'msg'    => 'Import Data Successfuly !',
    //         ];
    //         return response()->json($res);
    //         return true;
    //     } elseif ('xls' == $file_extension) {
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    //     } elseif ('xlsx' == $file_extension) {
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    //     }

    //     // $reader = new Xls();
    //     $spreadsheet = $reader->load(request()->file('import-payroll'));
    //     $sheetData = $spreadsheet->getActiveSheet()->toArray();
    //     $import =[];
    //     DB::beginTransaction();
    //     foreach ($sheetData as $key => $value) {
    //         if ($key > 0) :
    //             $branch = Branch::where('alias',$value[18])->first();
    //             if ($branch != null) :
    //                 $employeeId = employee::where('no_employee',$value[1])->where('branch_id',$branch->id)->first();
    //                 $takeHP = DB::table('take_home_pay')
    //                             ->where('employee_id',$employeeId->id)
    //                             ->where('startdate',$value[16])
    //                             ->where('enddate',$value[17])
    //                             ->count();
    //                 if ($takeHP > 0){
    //                     DB::table('take_home_pay')
    //                         ->where('employee_id',$employeeId->id)
    //                         ->where('startdate',$value[16])
    //                         ->where('enddate',$value[17])
    //                         ->delete();
    //                 }
    //                 $ded_other = Deduction_other::where('employee_id',$employeeId->id)->whereBetween('date',['startdate'=>$value[16],'enddate'=>$value[17]])->count();
    //                 if($ded_other > 0 ){
    //                     Deduction_other::where('employee_id',$employeeId->id)->whereBetween('date',['startdate'=>$value[16],'enddate'=>$value[17]])->delete();
    //                 }
    //                 $ded_loan = Loan::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[16],$value[17]])->count();
    //                 if ($ded_loan > 0 ){
    //                     Loan::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[16],$value[17]])->delete();
    //                 }
    //                 $allFinance = AllowanceFinance::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[16],$value[17]])->count();
    //                 if ($allFinance > 0){
    //                     AllowanceFinance::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[16],$value[17]])->delete();
    //                 }
    //                 $allother = DB::table('allowances')->where('employee_id',$employeeId->id)->whereBetween('date',[$value[16],$value[17]])->count();
    //                 if ($allother > 0){
    //                     DB::table('allowances')->where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[16],$value[17]])->delete();
    //                 }
    //                 if ($employeeId != null ):
    //                     if($employeeId->id =='' | $employeeId->id ==null){
    //                         return true;
    //                     }
    //                     $basic_salary    =  (($value[3] !=null) ? $value[3] : 0) * (($value[4] !=null) ? $value[4] : 0);
    //                     $val_salarymonth =  $basic_salary + (($value[5] !=null) ? $value[5] : 0 ) + (($value[6] !=null) ? $value[6] : 0 ) +  (($value[7] !=null) ? $value[7] : 0 );
    //                     $total_loan      = (($value[8] !=null) ? $value[8] : 0 );
    //                     $deduction_other = (($value[9] !=null) ? $value[9] : 0 ) + (($value[12] !=null) ? $value[12] : 0 ) + (($value[13] !=null) ? $value[13] : 0 ) + (($value[14] !=null) ? $value[14] : 0 ) + (($value[15] !=null) ? $value[15] : 0 );
    //                     $bpjs = (($value[10] !=null) ? $value[10] : 0 ) + (($value[11] !=null) ? $value[11] : 0 );
    //                     $total_deduction = $total_loan + $deduction_other + $bpjs;
    //                     $thp = $val_salarymonth -  $total_deduction;
    //                     $datas = [
    //                         'date'                              => date('Y-m-d'),
    //                         'employee_id'                       => $employeeId->id,
    //                         'employee_code'                     => $employeeId->employee_id,
    //                         'no_employee'                       => $employeeId->no_employee,
    //                         'name'                              => $employeeId->name,
    //                         'position_id'                       => $employeeId->position_id,
    //                         // 'level'                          => $employeeId->position_id,
    //                         'bank_name'                         => $employeeId->bank_name,
    //                         'account_number'                    => $employeeId->account_number,
    //                         'basic_salary'                      =>  $basic_salary,
    //                         'allowance_fixed'                   =>  (($value[5] !=null) ? $value[5] : 0 ),
    //                         'allowance_unfixed'                 => (($value[6] !=null) ? $value[6] : 0 ),
    //                         'allowance_other'                   => 0,
    //                         'overtime'                          =>  (($value[7] !=null) ? $value[7] : 0 ),
    //                         'salary_this_month'                 => $val_salarymonth,
    //                         'company_pay_bpjs'                  => 0,
    //                         'total_salary'                      => $val_salarymonth,
    //                         'company_pay_bpjs_kesehatan'        => 0,
    //                         'company_pay_bpjs_ketenagakerjaan'  => 0,
    //                         'employee_pay_bpjs_kesehatan'       => (($value[11] !=null) ? $value[11] : 0 ),
    //                         'employee_pay_bpjs_ketenagakerjaan' => (($value[10] !=null) ? $value[10] : 0 ),
    //                         'company_total_pay_bpjs'            => 0,
    //                         'employee_total_pay_bpjs'           => $bpjs,
    //                         'installment'                       => 0,
    //                         'loans'                             => (($value[8] !=null) ? $value[8] : 0 ),
    //                         'total_pay_loans'                   => $total_loan,
    //                         'sanksi_adm'                        => (($value[9] !=null) ? $value[9] : 0 ),
    //                         'total_deduction_other'             => $deduction_other,
    //                         'pph21'                             => 0,
    //                         'total_deduction'                   => $total_deduction,
    //                         'startdate'                         => $value[16],
    //                         'enddate'                           => $value[17],
    //                         'take_home_pay'                     => $thp,
    //                         'branch_id'                         => $employeeId->branch_id,
    //                         'created_at'                        => date('Y-m-d h:m:s'),
    //                     ];
    //                     if (!in_array($datas,$import)){
    //                         array_push($import,$datas);
    //                     }
    //                     if ($value[5] !=null){
    //                         $opt = AllowanceOption::where('name','Tunjangan Jabatan')->where('pay_type','fixed')->where('include_attendance','N')->first();
    //                         if ($opt !=null){
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_type_id' => $opt->id,
    //                                 'amount'            => (($value[5] !=null) ? $value[5] : 0 ),
    //                                 'created_by'        => Auth::user()->id,
    //                                 'created_at'        => $value[17].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[17].' '.date('h:m:s')
    //                             ];
    //                             AllowanceFinance::insert($data);
    //                         }else{
    //                             $opts = [
    //                                 'name'               => 'Tunjangan Jabatan',
    //                                 'pay_type'           => 'fixed',
    //                                 'include_attendance' => 'N',
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_by'         => Auth::user()->id,
    //                                 'created_at'        => $value[17].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[17].' '.date('h:m:s')
    //                             ];
                                
    //                             $createOpt = AllowanceOption::Insert($opts);
                                
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_type_id' => DB::getPdo()->lastInsertId(),
    //                                 'amount'            => (($value[5] !=null) ? $value[5] : 0 ),
    //                                 'created_by'        => Auth::user()->id,
    //                                 'created_at'        => $value[17].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[17].' '.date('h:m:s')
    //                             ];
    //                             AllowanceFinance::insert($data);
                                
    //                         }
                            
    //                     }
    //                     if ($value[6] !=null){
    //                         $opt = AllowanceOption::where('name','Insentif')->where('pay_type','unfixed')->where('include_attendance','N')->first();
    //                         if ($opt !=null){
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => $opt->id,
    //                                 'amount'            => (($value[6] !=null) ? $value[6] : 0 ),
    //                                 'create_by'        => Auth::user()->id,
    //                                 'date'              => date('Y-m-d', strtotime($value[17])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[17].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[17].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
    //                         }else{
    //                             $opts = [
    //                                 'name'               => 'Insentif',
    //                                 'pay_type'           => 'unfixed',
    //                                 'include_attendance' => 'N',
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_by'         => Auth::user()->id,
    //                                 'created_at'        =>  $value[17].' '.date('h:m:s'),
    //                                 'updated_at'        =>  $value[17].' '.date('h:m:s')
    //                             ];
                                
    //                             $createOpt = AllowanceOption::Insert($opts);
                                
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => DB::getPdo()->lastInsertId(),
    //                                 'amount'            => (($value[6] !=null) ? $value[6] : 0 ),
    //                                 'create_by'        => Auth::user()->id,
    //                                 'date'              => date('Y-m-d', strtotime($value[17])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[17].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[17].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
                                
    //                         }
                            
    //                     }
    //                     if ($value[8] !=null){
    //                         $idopt = LoanOption::where('name','KASBON')->first();
                        
    //                         $data = [
    //                             'employee_id'           => $employeeId->id,
    //                             'loan_type_id'          => $idopt->id,
    //                             'installment'           => 0,
    //                             'number_of_installment' => 0,
    //                             'status'                => 'paid off',
    //                             'amount'                => $value[8],
    //                             'created_by'            => Auth::user()->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'created_at'            => $value[17].' '.date('h:m:s'),
    //                             'updated_at'            => $value[17].' '.date('h:m:s')
    //                         ];
    //                         Loan::insert($data);
    //                     }

    //                     // if ($value[9] != null){
    //                     //     $checkAdm =  Deduction_admin::where('branch_id',$employeeId->branch_id)->where('name','admin')->count();
    //                     //     if ($checkAdm > 0 ){
    //                     //         Deduction_admin::where('')->update();
    //                     //     }
    //                     // }
    //                     if ($value[12] != null){
    //                         $deduc2 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[17],
    //                             'name'                  => 'Koperasi',
    //                             'amount'                => $value[12],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[17].' '.date('h:m:s'),
    //                             'updated_at'            => $value[17].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc2);
    //                     }
    //                     if ($value[13] != null){
    //                         $deduc3 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[17],
    //                             'name'                  => 'Seragam',
    //                             'amount'                => $value[13],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[17].' '.date('h:m:s'),
    //                             'updated_at'            => $value[17].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc3);
    //                     }
    //                     if ($value[14] != null){
    //                         $deduc4 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[17],
    //                             'name'                  => 'Potongan Absensi',
    //                             'amount'                => $value[14],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[17].' '.date('h:m:s'),
    //                             'updated_at'            => $value[17].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc4);
    //                     }
    //                     if ($value[15] != null){
    //                         $deduc5 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[17],
    //                             'name'                  => 'Potongan Lain-lain',
    //                             'amount'                => $value[15],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[17].' '.date('h:m:s'),
    //                             'updated_at'            => $value[17].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc5);
    //                     }
    //                 endif;
    //             endif;
    //         endif;
    //     }
    //     $run = DB::table('take_home_pay')->insert($import);
    //     DB::commit();
    //         $res = [
    //             'status' => 'success',
    //             'msg'    => 'Import Data Successfuly !',
    //         ];
    //         return response()->json($res);
    //     DB::rollBack();
    //         $res = [
    //             'status' => 'error',
    //             'msg'    => 'Someting went Wrong!',
    //         ];
    //         return response()->json($res);
    // }
    // public function import_run_payroll_v2(Request $request){
    //     $file_extension = request()->file('import-payroll')->extension();
    //     if ('csv' == $file_extension) {
    //         $res = [
    //             'status' => 'success',
    //             'msg'    => 'Import Data Successfuly !',
    //         ];
    //         return response()->json($res);
    //         return true;
    //     } elseif ('xls' == $file_extension) {
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    //     } elseif ('xlsx' == $file_extension) {
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    //     }

    //     // $reader = new Xls();
    //     $spreadsheet = $reader->load(request()->file('import-payroll'));
    //     $sheetData = $spreadsheet->getActiveSheet()->toArray();
    //     $import =[];
    //     DB::beginTransaction();
    //     foreach ($sheetData as $key => $value) {
    //         if ($key > 0) :
    //             $branch = Branch::where('alias',$value[21])->first();
    //             if ($branch != null) :
    //                 $employeeId = Employee::where('no_employee',$value[1])->where('branch_id',$branch->id)->first();
    //                 $takeHP = DB::table('take_home_pay')
    //                             ->where('employee_id',$employeeId->id)
    //                             ->where('startdate',$value[19])
    //                             ->where('enddate',$value[20])
    //                             ->count();
    //                 if ($takeHP > 0){
    //                     DB::table('take_home_pay')
    //                         ->where('employee_id',$employeeId->id)
    //                         ->where('startdate',$value[19])
    //                         ->where('enddate',$value[20])
    //                         ->delete();
    //                 }
    //                 $ded_other = Deduction_other::where('employee_id',$employeeId->id)->whereBetween('date',['startdate'=>$value[19],'enddate'=>$value[20]])->count();
    //                 if($ded_other > 0 ){
    //                     Deduction_other::where('employee_id',$employeeId->id)->whereBetween('date',['startdate'=>$value[19],'enddate'=>$value[20]])->delete();
    //                 }
    //                 $ded_loan = Loan::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[19],$value[20]])->count();
    //                 if ($ded_loan > 0 ){
    //                     Loan::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[19],$value[20]])->delete();
    //                 }
    //                 $allFinance = AllowanceFinance::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[19],$value[20]])->count();
    //                 if ($allFinance > 0){
    //                     AllowanceFinance::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[19],$value[20]])->delete();
    //                 }
    //                 $allother = DB::table('allowances')->where('employee_id',$employeeId->id)->whereBetween('date',[$value[19],$value[20]])->count();
    //                 if ($allother > 0){
    //                     DB::table('allowances')->where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[19],$value[20]])->delete();
    //                 }
    //                 if ($employeeId != null ):
    //                     if($employeeId->id =='' | $employeeId->id ==null){
    //                         return true;
    //                     }
    //                     $basic_salary     =  (($value[3] !=null) ? $value[3] : 0) * (($value[4] !=null) ? $value[4] : 0);
    //                     $meal_allowance   =  (($value[6] !=null) ? $value[6] : 0) * (($value[4] !=null) ? $value[4] : 0);
    //                     $allowancefixed   = $meal_allowance + (($value[5] !=null) ? $value[5] : 0 );
    //                     $allowanceUnfixed = (($value[7] !=null) ? $value[7] : 0 );
    //                     $overtime   =  (($value[8] !=null) ? $value[8] : 0)*(($value[9] !=null) ? $value[9] : 0);
    //                     $val_salarymonth  =  $basic_salary + $meal_allowance + (($value[5] !=null) ? $value[5] : 0 ) + (($value[7] !=null) ? $value[7] : 0 ) +  $overtime;
    //                     $total_loan      = (($value[10] !=null) ? $value[10] : 0 );
    //                     $deduction_other = (($value[11] !=null) ? $value[11] : 0 ) + (($value[14] !=null) ? $value[14] : 0 ) + (($value[15] !=null) ? $value[15] : 0 ) + (($value[16] !=null) ? $value[16] : 0 ) + (($value[17] !=null) ? $value[17] : 0 ) + (($value[18] !=null) ? $value[18] : 0 );
    //                     $bpjs = (($value[12] !=null) ? $value[12] : 0 ) + (($value[13] !=null) ? $value[13] : 0 );
    //                     $total_deduction = $total_loan + $deduction_other + $bpjs;
    //                     $thp = $val_salarymonth -  $total_deduction;
    //                     $datas = [
    //                         'date'                              => date('Y-m-d'),
    //                         'employee_id'                       => $employeeId->id,
    //                         'employee_code'                     => $employeeId->employee_id,
    //                         'no_employee'                       => $employeeId->no_employee,
    //                         'name'                              => $employeeId->name,
    //                         'position_id'                       => $employeeId->position_id,
    //                         // 'level'                          => $employeeId->position_id,
    //                         'bank_name'                         => $employeeId->bank_name,
    //                         'account_number'                    => $employeeId->account_number,
    //                         'basic_salary'                      => $basic_salary,
    //                         'allowance_fixed'                   => $allowancefixed,
    //                         'allowance_unfixed'                 => $allowanceUnfixed,
    //                         'allowance_other'                   => 0,
    //                         'overtime'                          => $overtime,
    //                         'salary_this_month'                 => $val_salarymonth,
    //                         'company_pay_bpjs'                  => 0,
    //                         'total_salary'                      => $val_salarymonth,
    //                         'company_pay_bpjs_kesehatan'        => 0,
    //                         'company_pay_bpjs_ketenagakerjaan'  => 0,
    //                         'employee_pay_bpjs_kesehatan'       => (($value[13] !=null) ? $value[13] : 0 ),
    //                         'employee_pay_bpjs_ketenagakerjaan' => (($value[12] !=null) ? $value[12] : 0 ),
    //                         'company_total_pay_bpjs'            => 0,
    //                         'employee_total_pay_bpjs'           => $bpjs,
    //                         'installment'                       => 0,
    //                         'loans'                             => (($value[10] !=null) ? $value[10] : 0 ),
    //                         'total_pay_loans'                   => $total_loan,
    //                         'sanksi_adm'                        => (($value[11] !=null) ? $value[11] : 0 ),
    //                         'total_deduction_other'             => $deduction_other,
    //                         'pph21'                             => 0,
    //                         'total_deduction'                   => $total_deduction,
    //                         'startdate'                         => $value[19],
    //                         'enddate'                           => $value[20],
    //                         'take_home_pay'                     => $thp,
    //                         'branch_id'                         => $employeeId->branch_id,
    //                         'total_attendance'                  => $value[4],
    //                         'total_overtime_hour'               => $value[9],
    //                         'created_at'                        => date('Y-m-d h:m:s'),
    //                     ];
    //                     if (!in_array($datas,$import)){
    //                         array_push($import,$datas);
    //                     }
                        
    //                     if ($value[5] !=null){
    //                         $opt = AllowanceOption::where('name','Tunjangan Jabatan')->where('pay_type','fixed')->where('include_attendance','N')->first();
    //                         if ($opt !=null){
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_type_id' => $opt->id,
    //                                 'amount'            => (($value[5] !=null) ? $value[5] : 0 ),
    //                                 'created_by'        => Auth::user()->id,
    //                                 'created_at'        => $value[20].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[20].' '.date('h:m:s')
    //                             ];
    //                             AllowanceFinance::insert($data);
    //                         }else{
    //                             $opts = [
    //                                 'name'               => 'Tunjangan Jabatan',
    //                                 'pay_type'           => 'fixed',
    //                                 'include_attendance' => 'N',
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_by'         => Auth::user()->id,
    //                                 'created_at'        => $value[20].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[20].' '.date('h:m:s')
    //                             ];
                                
    //                             $createOpt = AllowanceOption::Insert($opts);
                                
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_type_id' => DB::getPdo()->lastInsertId(),
    //                                 'amount'            => (($value[5] !=null) ? $value[5] : 0 ),
    //                                 'created_by'        => Auth::user()->creatorId(),
    //                                 'created_at'        => $value[20].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[20].' '.date('h:m:s')
    //                             ];
    //                             AllowanceFinance::insert($data);
                                
    //                         }
                            
    //                     }
    //                     if ($value[6] !=null){
    //                         $opt = AllowanceOption::where('name','Uang Makan')->where('pay_type','fixed')->where('include_attendance','Y')->first();
    //                         if ($opt !=null){
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_type_id' => $opt->id,
    //                                 'amount'            => (($value[6] !=null) ? $value[6] : 0 ),
    //                                 'created_by'        => Auth::user()->creatorId(),
    //                                 'created_at'        => $value[20].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[20].' '.date('h:m:s')
    //                             ];
    //                             AllowanceFinance::insert($data);
    //                         }else{
    //                             $opts = [
    //                                 'name'               => 'Uang Makan',
    //                                 'pay_type'           => 'fixed',
    //                                 'include_attendance' => 'Y',
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_by'         => Auth::user()->id,
    //                                 'created_at'        =>  $value[20].' '.date('h:m:s'),
    //                                 'updated_at'        =>  $value[20].' '.date('h:m:s')
    //                             ];
                                
    //                             $createOpt = AllowanceOption::Insert($opts);
                                
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_type_id' => DB::getPdo()->lastInsertId(),
    //                                 'amount'            => (($value[6] !=null) ? $value[6] : 0 ),
    //                                 'created_by'        => Auth::user()->creatorId(),
    //                                 'created_at'        => $value[20].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[20].' '.date('h:m:s')
    //                             ];
    //                             AllowanceFinance::insert($data);
    //                         }
    //                     }
    //                     if ($value[7] !=null){
    //                         $opt = AllowanceOption::where('name','Insentif')->where('pay_type','unfixed')->where('include_attendance','N')->first();
    //                         if ($opt !=null){
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => $opt->id,
    //                                 'amount'            => (($value[7] !=null) ? $value[7] : 0 ),
    //                                 'created_by'        => Auth::user()->id,
    //                                 'date'              => date('Y-m-d', strtotime($value[20])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[20].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[20].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
    //                         }else{
    //                             $opts = [
    //                                 'name'               => 'Insentif',
    //                                 'pay_type'           => 'unfixed',
    //                                 'include_attendance' => 'N',
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_by'         => Auth::user()->id,
    //                                 'created_at'        =>  $value[20].' '.date('h:m:s'),
    //                                 'updated_at'        =>  $value[20].' '.date('h:m:s')
    //                             ];
                                
    //                             $createOpt = AllowanceOption::Insert($opts);
                                
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => DB::getPdo()->lastInsertId(),
    //                                 'amount'            => (($value[7] !=null) ? $value[7] : 0 ),
    //                                 'created_by'        => Auth::user()->creatorId(),
    //                                 'date'              => date('Y-m-d', strtotime($value[20])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[20].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[20].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
                                
    //                         }
    //                     }
    //                     if ($value[10] !=null){
    //                         $idopt = LoanOption::where('name','KASBON')->first();
                        
    //                         $data = [
    //                             'employee_id'           => $employeeId->id,
    //                             'loan_type_id'          => $idopt->id,
    //                             'installment'           => 0,
    //                             'number_of_installment' => 0,
    //                             'status'                => 'paid off',
    //                             'amount'                => $value[10],
    //                             'created_by'            => Auth::user()->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'created_at'            => $value[20].' '.date('h:m:s'),
    //                             'updated_at'            => $value[20].' '.date('h:m:s')
    //                         ];
    //                         Loan::insert($data);
    //                     }
    //                     if ($value[14] != null){
    //                         $deduc2 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[20],
    //                             'name'                  => 'Koperasi',
    //                             'amount'                => $value[14],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[20].' '.date('h:m:s'),
    //                             'updated_at'            => $value[20].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc2);
    //                     }
    //                     if ($value[15] != null){
    //                         $deduc3 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[20],
    //                             'name'                  => 'Seragam',
    //                             'amount'                => $value[15],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[20].' '.date('h:m:s'),
    //                             'updated_at'            => $value[20].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc3);
    //                     }
    //                     if ($value[16] != null){
    //                         $deduc4 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[20],
    //                             'name'                  => 'Potongan Absensi',
    //                             'amount'                => $value[16],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[20].' '.date('h:m:s'),
    //                             'updated_at'            => $value[20].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc4);
    //                     }
    //                     if ($value[17] != null){
    //                         $deduc5 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[20],
    //                             'name'                  => 'Potongan Terlambat',
    //                             'amount'                => $value[17],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[20].' '.date('h:m:s'),
    //                             'updated_at'            => $value[20].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc5);
    //                     }
    //                     if ($value[18] != null){
    //                         $deduc5 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[20],
    //                             'name'                  => 'Potongan Lain-lain',
    //                             'amount'                => $value[18],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[20].' '.date('h:m:s'),
    //                             'updated_at'            => $value[20].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc5);
    //                     }
    //                 endif;
    //             endif;
    //         endif;
    //     }
       
    //     $run = DB::table('take_home_pay')->insert($import);
    //     DB::commit();
    //         $res = [
    //             'status' => 'success',
    //             'msg'    => 'Import Data Successfuly !',
    //         ];
    //         return response()->json($res);
    //     DB::rollBack();
    //         $res = [
    //             'status' => 'error',
    //             'msg'    => 'Someting went Wrong!',
    //         ];
    //         return response()->json($res);
    // }
    // public function import_run_payroll_v3(Request $request){
    //     $file_extension = request()->file('import-payroll')->extension();
    //     if ('csv' == $file_extension) {
    //         $res = [
    //             'status' => 'success',
    //             'msg'    => 'Import Data Successfuly !',
    //         ];
    //         return response()->json($res);
    //         return true;
    //     } elseif ('xls' == $file_extension) {
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    //     } elseif ('xlsx' == $file_extension) {
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    //     }

    //     // $reader = new Xls();
    //     $spreadsheet = $reader->load(request()->file('import-payroll'));
    //     $sheetData = $spreadsheet->getActiveSheet()->toArray();
    //     $import =[];
    //     DB::beginTransaction();
    //     foreach ($sheetData as $key => $value) {
    //         if ($key > 0) :
    //             $branch = Branch::where('alias',$value[26])->first();
    //             if ($branch != null) :
    //                 $employeeId = Employee::where('no_employee',$value[1])->where('branch_id',$branch->id)->first();
    //                 // dd($value[1]);
    //                 $takeHP = DB::table('take_home_pay')
    //                             ->where('employee_id',$employeeId->id)
    //                             ->where('startdate',$value[24])
    //                             ->where('enddate',$value[25])
    //                             ->count();
    //                 if ($takeHP > 0){
    //                     DB::table('take_home_pay')
    //                         ->where('employee_id',$employeeId->id)
    //                         ->where('startdate',$value[24])
    //                         ->where('enddate',$value[25])
    //                         ->delete();
    //                 }
    //                 $ded_other = Deduction_other::where('employee_id',$employeeId->id)->whereBetween('date',['startdate'=>$value[24],'enddate'=>$value[25]])->count();
    //                 if($ded_other > 0 ){
    //                     Deduction_other::where('employee_id',$employeeId->id)->whereBetween('date',['startdate'=>$value[24],'enddate'=>$value[25]])->delete();
    //                 }
    //                 $ded_loan = Loan::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[24],$value[25]])->count();
    //                 if ($ded_loan > 0 ){
    //                     Loan::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[24],$value[25]])->delete();
    //                 }
    //                 $allFinance = AllowanceFinance::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[24],$value[25]])->count();
    //                 if ($allFinance > 0){
    //                     AllowanceFinance::where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[24],$value[25]])->delete();
    //                 }
    //                 $allother = DB::table('allowances')->where('employee_id',$employeeId->id)->whereBetween('date',[$value[24],$value[25]])->count();
    //                 if ($allother > 0){
    //                     DB::table('allowances')->where('employee_id',$employeeId->id)->whereBetween(DB::raw("DATE(created_at)"),[$value[24],$value[25]])->delete();
    //                 }
    //                 if ($employeeId != null ):
    //                     if($employeeId->id =='' | $employeeId->id ==null){
    //                         return true;
    //                     }
    //                     $basic_salary     =  (($value[3] !=null) ? $value[3] : 0);
    //                     $meal_allowance   =  (($value[6] !=null) ? $value[6] : 0) * (($value[4] !=null) ? $value[4] : 0);
    //                     $allowanceUnfixed = (($value[7] !=null) ? $value[7] : 0 ) + (($value[8] !=null) ? $value[8] : 0 ) + (($value[9] !=null) ? $value[9] : 0 ) +(($value[10] !=null) ? $value[10] : 0 )+(($value[11] !=null) ? $value[11] : 0 )+(($value[12] !=null) ? $value[12] : 0 );
    //                     $allowancefixed   = $meal_allowance + (($value[5] !=null) ? $value[5] : 0 );
    //                     $overtime         =  (($value[13] !=null) ? $value[13] : 0);
    //                     $val_salarymonth  =  $basic_salary + $allowancefixed + $allowanceUnfixed +  $overtime;
    //                     $total_loan       = (($value[15] !=null) ? $value[15] : 0 );
    //                     $deduction_other  = (($value[16] !=null) ? $value[16] : 0 ) + (($value[19] !=null) ? $value[19] : 0 ) + (($value[20] !=null) ? $value[20] : 0 ) + (($value[21] !=null) ? $value[21] : 0 ) + (($value[22] !=null) ? $value[22] : 0 ) + (($value[23] !=null) ? $value[23] : 0 );
    //                     $bpjs             = (($value[17] !=null) ? $value[17] : 0 ) + (($value[18] !=null) ? $value[18] : 0 );
    //                     $total_deduction  = $total_loan + $deduction_other + $bpjs;
    //                     $thp              = $val_salarymonth -  $total_deduction;
    //                     $datas = [
    //                         'date'                              => date('Y-m-d'),
    //                         'employee_id'                       => $employeeId->id,
    //                         'employee_code'                     => $employeeId->employee_id,
    //                         'no_employee'                       => $employeeId->no_employee,
    //                         'name'                              => $employeeId->name,
    //                         'position_id'                       => $employeeId->position_id,
    //                         // 'level'                          => $employeeId->position_id,
    //                         'bank_name'                         => $employeeId->bank_name,
    //                         'account_number'                    => $employeeId->account_number,
    //                         'basic_salary'                      => $basic_salary,
    //                         'allowance_fixed'                   => $allowancefixed,
    //                         'allowance_unfixed'                 => $allowanceUnfixed,
    //                         'allowance_other'                   => 0,
    //                         'overtime'                          => $overtime,
    //                         'salary_this_month'                 => $val_salarymonth,
    //                         'company_pay_bpjs'                  => 0,
    //                         'total_salary'                      => $val_salarymonth,
    //                         'company_pay_bpjs_kesehatan'        => 0,
    //                         'company_pay_bpjs_ketenagakerjaan'  => 0,
    //                         'employee_pay_bpjs_kesehatan'       => (($value[18] !=null) ? $value[18] : 0 ),
    //                         'employee_pay_bpjs_ketenagakerjaan' => (($value[17] !=null) ? $value[17] : 0 ),
    //                         'company_total_pay_bpjs'            => 0,
    //                         'employee_total_pay_bpjs'           => $bpjs,
    //                         'installment'                       => 0,
    //                         'loans'                             => (($value[15] !=null) ? $value[15] : 0 ),
    //                         'total_pay_loans'                   => $total_loan,
    //                         'sanksi_adm'                        => (($value[16] !=null) ? $value[16] : 0 ),
    //                         'total_deduction_other'             => $deduction_other,
    //                         'pph21'                             => 0,
    //                         'total_deduction'                   => $total_deduction,
    //                         'startdate'                         => $value[24],
    //                         'enddate'                           => $value[25],
    //                         'take_home_pay'                     => $thp,
    //                         'branch_id'                         => $employeeId->branch_id,
    //                         'total_attendance'                  => $value[4],
    //                         'total_overtime_hour'               => $value[14],
    //                         'created_at'                        => date('Y-m-d h:m:s'),
    //                     ];
    //                     if (!in_array($datas,$import)){
    //                         array_push($import,$datas);
    //                     }
                        
    //                     if ($value[5] !=null){
    //                         $opt = AllowanceOption::where('name','Tunjangan Jabatan')->where('pay_type','fixed')->where('include_attendance','N')->first();
    //                         if ($opt !=null){
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_type_id' => $opt->id,
    //                                 'amount'            => (($value[5] !=null) ? $value[5] : 0 ),
    //                                 'created_by'        => Auth::user()->id,
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             AllowanceFinance::insert($data);
    //                         }else{
    //                             $opts = [
    //                                 'name'               => 'Tunjangan Jabatan',
    //                                 'pay_type'           => 'fixed',
    //                                 'include_attendance' => 'N',
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_by'         => Auth::user()->id,
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
                                
    //                             $createOpt = AllowanceOption::Insert($opts);
                                
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_type_id' => DB::getPdo()->lastInsertId(),
    //                                 'amount'            => (($value[5] !=null) ? $value[5] : 0 ),
    //                                 'created_by'        => Auth::user()->creatorId(),
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             AllowanceFinance::insert($data);
                                
    //                         }
                            
    //                     }
    //                     if ($value[6] !=null){
    //                         $opt = AllowanceOption::where('name','Uang Makan')->where('pay_type','fixed')->where('include_attendance','Y')->first();
    //                         if ($opt !=null){
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_type_id' => $opt->id,
    //                                 'amount'            => (($value[6] !=null) ? $value[6] : 0 ),
    //                                 'created_by'        => Auth::user()->creatorId(),
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             AllowanceFinance::insert($data);
    //                         }else{
    //                             $opts = [
    //                                 'name'               => 'Uang Makan',
    //                                 'pay_type'           => 'fixed',
    //                                 'include_attendance' => 'Y',
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_by'         => Auth::user()->id,
    //                                 'created_at'        =>  $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        =>  $value[25].' '.date('h:m:s')
    //                             ];
                                
    //                             $createOpt = AllowanceOption::Insert($opts);
                                
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_type_id' => DB::getPdo()->lastInsertId(),
    //                                 'amount'            => (($value[6] !=null) ? $value[6] : 0 ),
    //                                 'created_by'        => Auth::user()->creatorId(),
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             AllowanceFinance::insert($data);
    //                         }
    //                     }
    //                     if ($value[7] !=null){
    //                         $opt = AllowanceOption::where('name','Loyalitas')->where('pay_type','unfixed')->where('include_attendance','N')->first();
    //                         if ($opt !=null){
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => $opt->id,
    //                                 'amount'            => (($value[7] !=null) ? $value[7] : 0 ),
    //                                 'created_by'        => Auth::user()->id,
    //                                 'date'              => date('Y-m-d', strtotime($value[25])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
    //                         }else{
    //                             $opts = [
    //                                 'name'               => 'Loyalitas',
    //                                 'pay_type'           => 'unfixed',
    //                                 'include_attendance' => 'N',
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_by'         => Auth::user()->id,
    //                                 'created_at'        =>  $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        =>  $value[25].' '.date('h:m:s')
    //                             ];
                                
    //                             $createOpt = AllowanceOption::Insert($opts);
                                
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => DB::getPdo()->lastInsertId(),
    //                                 'amount'            => (($value[7] !=null) ? $value[7] : 0 ),
    //                                 'created_by'        => Auth::user()->creatorId(),
    //                                 'date'              => date('Y-m-d', strtotime($value[25])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
                                
    //                         }
    //                     }
    //                     if ($value[8] !=null){
    //                         $opt = AllowanceOption::where('name','Kehadiran')->where('pay_type','unfixed')->where('include_attendance','N')->first();
    //                         if ($opt !=null){
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => $opt->id,
    //                                 'amount'            => (($value[8] !=null) ? $value[8] : 0 ),
    //                                 'created_by'        => Auth::user()->id,
    //                                 'date'              => date('Y-m-d', strtotime($value[25])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
    //                         }else{
    //                             $opts = [
    //                                 'name'               => 'Kehadiran',
    //                                 'pay_type'           => 'unfixed',
    //                                 'include_attendance' => 'N',
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_by'         => Auth::user()->id,
    //                                 'created_at'        =>  $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        =>  $value[25].' '.date('h:m:s')
    //                             ];
                                
    //                             $createOpt = AllowanceOption::Insert($opts);
                                
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => DB::getPdo()->lastInsertId(),
    //                                 'amount'            => (($value[8] !=null) ? $value[8] : 0 ),
    //                                 'created_by'        => Auth::user()->creatorId(),
    //                                 'date'              => date('Y-m-d', strtotime($value[25])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
                                
    //                         }
    //                     }
    //                     if ($value[9] !=null){
    //                         $opt = AllowanceOption::where('name','Shif')->where('pay_type','unfixed')->where('include_attendance','N')->first();
    //                         if ($opt !=null){
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => $opt->id,
    //                                 'amount'            => (($value[9] !=null) ? $value[9] : 0 ),
    //                                 'created_by'        => Auth::user()->id,
    //                                 'date'              => date('Y-m-d', strtotime($value[25])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
    //                         }else{
    //                             $opts = [
    //                                 'name'               => 'Shif',
    //                                 'pay_type'           => 'unfixed',
    //                                 'include_attendance' => 'N',
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_by'         => Auth::user()->id,
    //                                 'created_at'        =>  $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        =>  $value[25].' '.date('h:m:s')
    //                             ];
                                
    //                             $createOpt = AllowanceOption::Insert($opts);
                                
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => DB::getPdo()->lastInsertId(),
    //                                 'amount'            => (($value[9] !=null) ? $value[9] : 0 ),
    //                                 'created_by'        => Auth::user()->creatorId(),
    //                                 'date'              => date('Y-m-d', strtotime($value[25])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
                                
    //                         }
    //                     }
    //                     if ($value[10] !=null){
    //                         $opt = AllowanceOption::where('name','Insentif Panel')->where('pay_type','unfixed')->where('include_attendance','N')->first();
    //                         if ($opt !=null){
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => $opt->id,
    //                                 'amount'            => (($value[10] !=null) ? $value[10] : 0 ),
    //                                 'created_by'        => Auth::user()->id,
    //                                 'date'              => date('Y-m-d', strtotime($value[25])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
    //                         }else{
    //                             $opts = [
    //                                 'name'               => 'Insentif Panel',
    //                                 'pay_type'           => 'unfixed',
    //                                 'include_attendance' => 'N',
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_by'         => Auth::user()->id,
    //                                 'created_at'        =>  $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        =>  $value[25].' '.date('h:m:s')
    //                             ];
                                
    //                             $createOpt = AllowanceOption::Insert($opts);
                                
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => DB::getPdo()->lastInsertId(),
    //                                 'amount'            => (($value[10] !=null) ? $value[10] : 0 ),
    //                                 'created_by'        => Auth::user()->creatorId(),
    //                                 'date'              => date('Y-m-d', strtotime($value[25])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
                                
    //                         }
    //                     }
    //                     if ($value[11] !=null){
    //                         $opt = AllowanceOption::where('name','Kirim Barang')->where('pay_type','unfixed')->where('include_attendance','N')->first();
    //                         if ($opt !=null){
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => $opt->id,
    //                                 'amount'            => (($value[11] !=null) ? $value[11] : 0 ),
    //                                 'created_by'        => Auth::user()->id,
    //                                 'date'              => date('Y-m-d', strtotime($value[25])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
    //                         }else{
    //                             $opts = [
    //                                 'name'               => 'Kirim Barang',
    //                                 'pay_type'           => 'unfixed',
    //                                 'include_attendance' => 'N',
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_by'         => Auth::user()->id,
    //                                 'created_at'        =>  $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        =>  $value[25].' '.date('h:m:s')
    //                             ];
                                
    //                             $createOpt = AllowanceOption::Insert($opts);
                                
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => DB::getPdo()->lastInsertId(),
    //                                 'amount'            => (($value[11] !=null) ? $value[11] : 0 ),
    //                                 'created_by'        => Auth::user()->creatorId(),
    //                                 'date'              => date('Y-m-d', strtotime($value[25])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
                                
    //                         }
    //                     }
    //                     if ($value[12] !=null){
    //                         $opt = AllowanceOption::where('name','Rapel')->where('pay_type','unfixed')->where('include_attendance','N')->first();
    //                         if ($opt !=null){
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => $opt->id,
    //                                 'amount'            => (($value[12] !=null) ? $value[12] : 0 ),
    //                                 'created_by'        => Auth::user()->id,
    //                                 'date'              => date('Y-m-d', strtotime($value[25])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
    //                         }else{
    //                             $opts = [
    //                                 'name'               => 'Rapel',
    //                                 'pay_type'           => 'unfixed',
    //                                 'include_attendance' => 'N',
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_by'         => Auth::user()->id,
    //                                 'created_at'        =>  $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        =>  $value[25].' '.date('h:m:s')
    //                             ];
                                
    //                             $createOpt = AllowanceOption::Insert($opts);
                                
    //                             $data =[
    //                                 'employee_id'       => $employeeId->id,
    //                                 'allowance_option_id' => DB::getPdo()->lastInsertId(),
    //                                 'amount'            => (($value[12] !=null) ? $value[12] : 0 ),
    //                                 'created_by'        => Auth::user()->creatorId(),
    //                                 'date'              => date('Y-m-d', strtotime($value[25])),
    //                                 'branch_id'          => $employeeId->branch_id,
    //                                 'created_at'        => $value[25].' '.date('h:m:s'),
    //                                 'updated_at'        => $value[25].' '.date('h:m:s')
    //                             ];
    //                             DB::table('allowances')->insert($data);
                                
    //                         }
    //                     }
    //                     if ($value[15] !=null){
    //                         $idopt = LoanOption::where('name','KASBON')->first();
                        
    //                         $data = [
    //                             'employee_id'           => $employeeId->id,
    //                             'loan_type_id'          => $idopt->id,
    //                             'installment'           => 0,
    //                             'number_of_installment' => 0,
    //                             'status'                => 'paid off',
    //                             'amount'                => $value[15],
    //                             'created_by'            => Auth::user()->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'created_at'            => $value[25].' '.date('h:m:s'),
    //                             'updated_at'            => $value[25].' '.date('h:m:s')
    //                         ];
    //                         Loan::insert($data);
    //                     }
    //                     if ($value[19] != null){
    //                         $deduc2 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[25],
    //                             'name'                  => 'Koperasi',
    //                             'amount'                => $value[19],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[25].' '.date('h:m:s'),
    //                             'updated_at'            => $value[25].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc2);
    //                     }
    //                     if ($value[20] != null){
    //                         $deduc3 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[25],
    //                             'name'                  => 'Seragam',
    //                             'amount'                => $value[20],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[25].' '.date('h:m:s'),
    //                             'updated_at'            => $value[25].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc3);
    //                     }
    //                     if ($value[21] != null){
    //                         $deduc4 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[25],
    //                             'name'                  => 'Potongan Absensi',
    //                             'amount'                => $value[21],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[25].' '.date('h:m:s'),
    //                             'updated_at'            => $value[25].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc4);
    //                     }
    //                     if ($value[22] != null){
    //                         $deduc5 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[25],
    //                             'name'                  => 'Potongan Terlambat',
    //                             'amount'                => $value[22],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[25].' '.date('h:m:s'),
    //                             'updated_at'            => $value[25].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc5);
    //                     }
    //                     if ($value[23] != null){
    //                         $deduc5 = [
    //                             'employee_id'           => $employeeId->id,
    //                             'branch_id'             => $employeeId->branch_id,
    //                             'date'                  => $value[25],
    //                             'name'                  => 'Potongan Lain-lain',
    //                             'amount'                => $value[23],
    //                             'created_by'            => Auth::user()->id,
    //                             'created_at'            => $value[25].' '.date('h:m:s'),
    //                             'updated_at'            => $value[25].' '.date('h:m:s')
    //                         ];
    //                         Deduction_other::create($deduc5);
    //                     }
    //                 endif;
    //             endif;
    //         endif;
    //     }
       
    //     $run = DB::table('take_home_pay')->insert($import);
    //     DB::commit();
    //         $res = [
    //             'status' => 'success',
    //             'msg'    => 'Import Data Successfuly !',
    //         ];
    //         return response()->json($res);
    //     DB::rollBack();
    //         $res = [
    //             'status' => 'error',
    //             'msg'    => 'Someting went Wrong!',
    //         ];
    //         return response()->json($res);
    // }
    public function get_run_payroll(Request $request){
        $data   = DB::table('take_home_pay')
                    ->select('take_home_pay.*',
                             'employees.name',
                             'employees.no_employee',
                             'employees.bank_name',
                             'employees.account_number',
                             'position.position_name')
                    ->leftJoin('employees','employees.id','=','take_home_pay.employee_id')
                    ->leftJoin('position','position.id','=','take_home_pay.position_id')
                    ->where('take_home_pay.branch_id','=',$request->branch_id)
                    ->where('take_home_pay.date',date(NOW()))
                    ->get();
        return DataTables::of($data)->make(true);
    }
    public function data_payroll_final(){
        $companyId          = Branch::where('id',Auth::user()->branch_id)->first();
        $emp = Employee::where('user_id',Auth::user()->id)->first();
        if (Auth::user()->type == "company"){
            $branch['branch']   = Branch::where('company_id',$companyId->company_id)->get();
        }else{
            $branch['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                            ->where('access_branches.employee_id',$emp->id)
                                            ->where('access_branches.company_id',$companyId->company_id)->get();
        }
        return  view('pages.contents.payroll.data_payroll_final',$branch);
    } 
    public function get_payroll_final(Request $request){
        $data   = DB::table('take_home_pay')
                    ->select('take_home_pay.*',
                             'employees.name',
                             'employees.no_employee',
                             'employees.bank_name',
                             'employees.account_number',
                             'position.position_name'
                            )
                    ->leftJoin('employees','employees.id','=','take_home_pay.employee_id')
                    ->leftJoin('position','position.id','=','take_home_pay.position_id')
                    ->where('take_home_pay.branch_id','=',$request->branch_id)
                    ->where('take_home_pay.startdate','>=',$request->startdate)
                    ->where('take_home_pay.enddate','<=',$request->enddate)
                    ->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $btn ='';
                    if(Auth()->user()->canany('show payroll')){
                        $btn .= '<div class="dropdown dropdown-action">
                                <a href="#"  class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                        if(Auth()->user()->can('show payroll')){
                            $btn .= '<a  data-id ="'.$row->id.'" data-employeeid ="'.$row->employee_id.'" class="dropdown-item cetak-payroll" href="'.route("generate_slip_payroll", ['id'=>$row->id]).'" target="_blank"><i class="fa fa-print m-r-5"></i>Print Payslip</a>';
                        }
                    }
                    return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
    }
    public function generate_slip_payroll($id){
        $branch         = Auth::user()->branch_id;
        $data['salary'] = DB::table('take_home_pay')
                            ->select('take_home_pay.*',
                                    'employees.name as employee_name',
                                    'branches.name as branch_name',
                                    'position.position_name',
                                    'companies.name as company_name',
                                    'companies.logo')
                            ->leftJoin('employees','employees.id','=','take_home_pay.employee_id')
                            ->leftJoin('branches','branches.id','=','take_home_pay.branch_id')
                            ->leftJoin('position','position.id','=','employees.position_id')
                            ->leftJoin('companies','companies.id','=','branches.company_id')
                            ->where('take_home_pay.id',$id)->first();
        $data['allowance_fixed'] = DB::select("SELECT * from get_allowance_fixed('".$data['salary']->startdate."','".$data['salary']->enddate."','".$data['salary']->branch_id."') where employeeid = '".$data['salary']->employee_id."'");
        $data['allowance_unfixed'] = DB::select("SELECT * from getallowance_unfixed('".$data['salary']->startdate."','".$data['salary']->enddate."','".$data['salary']->branch_id."') where employeeid = '". $data['salary']->employee_id."'");
        $data['allowance_other'] = DB::select("SELECT * from get_other_allowance('".$data['salary']->startdate."','".$data['salary']->enddate."','".$data['salary']->branch_id."') where employeeid = '".$data['salary']->employee_id."'");
        $data['reimbursement'] = DB::select("SELECT * FROM get_reimburstment('".$data['salary']->startdate."','".$data['salary']->enddate."','".$data['salary']->branch_id."') where employee_id = '".$data['salary']->employee_id."'");
         $data['deduction_other'] = DB::select("SELECT * FROM get_deduction_other('".$data['salary']->startdate."','".$data['salary']->enddate."','".$data['salary']->branch_id."') where employeeid = '".$data['salary']->employee_id."'");
        $data['deduction'] = DB::table('v_deduction_acumulation')->where('employee_id',$data['salary']->employee_id)->first();
        $data['attendance'] = DB::select("SELECT * FROM getsalary('".$data['salary']->startdate."','".$data['salary']->enddate."','".$data['salary']->branch_id."') where employee_id = '". $data['salary']->employee_id."'");
        $data['adm']    = Deduction_admin::where('branch_id',$data['salary']->branch_id)->get();
        
        $pdf = PDF::loadview('pages.contents.payroll.payslip.pdf',$data);
        return $pdf->stream('payslip-'.$data['salary']->employee_name.'-'.substr($data['salary']->enddate,0,7));
    }
    public function ExportPayrollPdf(Request $request){
        if ($request->employee_id == ''){
            return redirect()->back();
        }
        $emp = explode(',',$request->employee_id);
        $employee =[];
        foreach($emp as $arr){
            $empId = $arr;
            array_push($employee,$empId);
        }
        $data['salarys'] = DB::table('take_home_pay')
                            ->select('take_home_pay.*',
                                    'employees.name as employee_name',
                                    'branches.name as branch_name',
                                    'position.position_name',
                                    'companies.name as company_name',
                                    'companies.logo')
                            ->leftJoin('employees','employees.id','=','take_home_pay.employee_id')
                            ->leftJoin('branches','branches.id','=','take_home_pay.branch_id')
                            ->leftJoin('position','position.id','=','employees.position_id')
                            ->leftJoin('companies','companies.id','=','branches.company_id')
                            ->where('take_home_pay.branch_id',$request->branch_id)
                            ->where('take_home_pay.startdate','>=',$request->startdate)
                            ->where('take_home_pay.enddate','<=',$request->enddate)
                            ->whereIn('take_home_pay.employee_id', $employee)
                            // ->limit(50)
                            ->get();
        $data['allowance_fixed'] = DB::select("SELECT * from get_allowance_fixed('".$request->startdate."','".$request->enddate."','".$request->branch_id."')");
        $data['allowance_unfixed'] = DB::select("SELECT * from getallowance_unfixed('".$request->startdate."','".$request->enddate."','".$request->branch_id."') ");
        $data['allowance_other'] = DB::select("SELECT * from get_other_allowance('".$request->startdate."','".$request->enddate."','".$request->branch_id."') ");
        $data['reimbursement'] = DB::select("SELECT * FROM get_reimburstment('".$request->startdate."','".$request->enddate."','".$request->branch_id."') ");
        $data['deduction_other'] = DB::select("SELECT * FROM get_deduction_other('".$request->startdate."','".$request->enddate."','".$request->branch_id."') ");
        // $data['deductions'] = DB::table('v_deduction_acumulation')->where('branch_id',$request->branch_id)->get();
        $data['attendance'] = DB::select("SELECT * FROM getsalary('".$request->startdate."','".$request->enddate."','".$request->branch_id."') ");
        $data['adm']    = Deduction_admin::where('branch_id',$request->branch_id)->get();

        $pdf = PDF::loadview('pages.contents.payroll.payslip.export_pdf_payslip',$data);
        $download = $pdf->download('payslip-'.substr($request->enddate,0,7).'.pdf');
        return  $download ;
    }
    
}
