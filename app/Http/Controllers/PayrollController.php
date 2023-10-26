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
            if (Auth::user()->initial == "HO"){
                $branches = Branch::where('company_id',$branch->company_id)->get();
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
            $companyId          = Branch::where('id',Auth::user()->branch_id)->first();
            $branch['branch']   = Branch::where('company_id',$companyId->company_id)->get();
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
                ->where('startdate','>=',$request->startdate)
                ->where('enddate','<=',$request->enddate)
                ->delete();
            }

            $thps = DB::select("SELECT a.*,b.position_id,b.name as emp_name FROM get_take_home_pay('".$request->startdate."','".$request->enddate."','".$request->branch_id."') as a LEFT JOIN employees as b
                ON a.employee_id = b.id");
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
                    'sanksi_adm' => '0',
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
                    ->whereMonth('loans.updated_at', $month)
                    ->whereYear('loans.updated_at', $year)
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
                                    'updated_at' => date('Y-m-d h:m:s'),
                                ];
                                DB::table('loans')->where('employee_id',$empLoans->employee_id)
                                                 ->where('installment','!=',0)
                                                 ->update($dataLoans);
                            }else if($empLoans->installment == 0){
                                $dataLoans = [
                                    'status' =>'paid off',
                                    'updated_at' => date('Y-m-d h:m:s'),
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
                    if (!in_array($pphData,$pph21Final)){
                        array_push($pph21Final,$pphData);
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
        $branch['branch']   = Branch::where('company_id',$companyId->company_id)->get();
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
                    ->whereBetween('take_home_pay.date',[$request->startdate,$request->enddate])
                    ->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $btn ='';
                    if(Auth()->user()->canany('manage payroll','show payroll', 'edit payroll')){
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
                            ->select('take_home_pay.*','employees.name as employee_name','branches.name as branch_name','position.position_name','companies.name as company_name')
                            ->leftJoin('employees','employees.id','=','take_home_pay.employee_id')
                            ->leftJoin('branches','branches.id','=','take_home_pay.branch_id')
                            ->leftJoin('position','position.id','=','employees.position_id')
                            ->leftJoin('companies','companies.id','=','branches.company_id')
                            ->where('take_home_pay.id',$id)->first();
        $data['allowance_fixed'] = DB::select("SELECT * from get_allowance_fixed('".$data['salary']->startdate."','".$data['salary']->enddate."','".$branch."') where employeeid = '".$data['salary']->employee_id."'");
        $data['allowance_unfixed'] = DB::select("SELECT * from getallowance_unfixed('".$data['salary']->startdate."','".$data['salary']->enddate."','".$branch."') where employeeid = '". $data['salary']->employee_id."'");
        $data['allowance_other'] = DB::select("SELECT * from get_other_allowance('".$data['salary']->startdate."','".$data['salary']->enddate."','".$branch."') where employeeid = '".$data['salary']->employee_id."'");
        $data['reimbursement'] = DB::select("SELECT * FROM get_reimburstment('".$data['salary']->startdate."','".$data['salary']->enddate."','".$branch."') where employee_id = '".$data['salary']->employee_id."'");
         $data['deduction_other'] = DB::select("SELECT * FROM get_deduction_other('".$data['salary']->startdate."','2023-10-30','".$branch."') where employeeid = '".$data['salary']->employee_id."'");
        $data['deduction'] = DB::table('v_deduction_acumulation')->where('employee_id',$data['salary']->employee_id)->first();
        $data['attendance'] = DB::select("SELECT * FROM getsalary('".$data['salary']->startdate."','".$data['salary']->enddate."','".$branch."') where employee_id = '". $data['salary']->employee_id."'");
        $pdf = PDF::loadview('pages.contents.payroll.payslip.pdf',$data);
        return $pdf->stream('payslip-'.$data['salary']->employee_name.'-'.substr($data['salary']->enddate,0,7));
    }
}
