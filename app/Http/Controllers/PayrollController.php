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
use Carbon\Carbon;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage payroll')) {
            if (Auth::user()->type != 'company') {
                $user     = Auth::user();
                $employee = Employee::where('user_id', '=', $user->id)->get();
                $payroll  = Payroll::where('employee_id', '=', $user->employee->id)->get();
                $payslipType = PayslipType::where('created_by', '=', Auth::user()->creatorId())->get();

                // allowance
                $allowance = AllowanceFinance::where('created_by', '=', Auth::user()->creatorId())->get();
                $employee  = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
                $allowanceTypes  = AllowanceOption::where('created_by', '=', Auth::user()->creatorId())->get();

                return view('pages.contents.payroll.index', compact('payroll', 'employee', 'payslipType','allowance','allowanceTypes'));
            } else {
                $payroll = Payroll::where('created_by', '=', Auth::user()->creatorId())->get();
                $employee  = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
                $payslipType = PayslipType::where('created_by', '=', Auth::user()->creatorId())->get();
                $allowance = AllowanceFinance::where('created_by', '=', Auth::user()->creatorId())->get();
                $employee  = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
                $allowanceTypes  = AllowanceOption::where('created_by', '=', Auth::user()->creatorId())->get();
                $data_bpjs = Master_bpjs::where('branch_id','=',Auth::user()->branch_id)->get();
                return view('pages.contents.payroll.index', compact('payroll', 'employee', 'payslipType','allowance','allowanceTypes','data_bpjs'));
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
    public function get_data(Request $request){
        $data = DB::table('v_payrolls')->select('*')->where('branch_id',Auth::user()->branch_id)->get();
        // $data = Payroll::leftJoin('allowance_finances','allowance_finances.employee_id','=','payrolls.employee_id')
        //                 ->where('payrolls.branch_id','=',Auth::user()->branch_id)
        //                 ->where('payrolls.id','=','is not null')
        //                 ->with('employees','payslip_type')
        //                 ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $btn ='';
                    if(Auth()->user()->canany('edit payroll', 'delete payroll')){
                        $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                        if(Auth()->user()->can('edit payroll')){
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

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
                $payroll->branch_id          = Auth::user()->branch_id;
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
                $allowance = AllowanceFinance::select(DB::raw('sum(amount) as allowance'))
                                              ->leftJoin('allowance_options','allowance_options.id','=','allowance_type_id')
                                              ->where('employee_id',$request->employee_id)
                                              ->where('allowance_options.pay_type','=','fixed')
                                              ->first();
                $a = 0;

                if(isset($request->bpjs)){
                    $array_bpjs = [];
                    $salary_gross = $request->amount_salary + $allowance->allowance;
                    foreach($request->bpjs as $bpjs){
                        $getName     = Master_bpjs::where('id','=',$bpjs)->first();

                        if($request->nominal_bpjs_kes > 0 && $getName->bpjs_code == 'KSHT'){
                            $val_comp   = round(($request->nominal_bpjs_kes + $allowance->allowance) * $getName->is_company / 100 );
                            $val_emp    = round(($request->nominal_bpjs_kes + $allowance->allowance) * $getName->is_employee / 100 );
                            $salary_kes = round($request->nominal_bpjs_kes + $allowance->allowance);
                            $value_kes  = round($request->nominal_bpjs_kes);
                            $total      = round($val_comp + $val_emp);
                            $salary_tk_jp = 0;
                            $value_tk_jp = 0;
                        }else if($request->nominal_bpjs_jp > 0 & $getName->bpjs_code ==="JP"){
                            $val_comp   = round(($request->nominal_bpjs_jp + $allowance->allowance) * $getName->is_company / 100 );
                            $val_emp    = round(($request->nominal_bpjs_jp + $allowance->allowance) * $getName->is_employee / 100 );
                            $salary_tk_jp = round($request->nominal_bpjs_jp + $allowance->allowance);
                            $value_tk_jp = round($request->nominal_bpjs_jp);
                            $total      = round($val_comp + $val_emp);
                            $value_kes  = 0;
                            $salary_kes = 0;
                        }else{
                            $val_comp   = round($salary_gross * $getName->is_company / 100 );
                            $val_emp    = round($salary_gross * $getName->is_employee / 100 );
                            $total      = round($val_comp + $val_emp);
                            $salary_kes = 0;
                            $value_kes  = 0;
                            $salary_tk_jp = 0;
                            $value_tk_jp = 0;
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
                                'salary_kes'    => $salary_kes,
                                'salary_tk_jp'  => $salary_tk_jp,
                                'value_kes'     => $value_kes,
                                'value_tk_jp'   => $value_tk_jp,
                                'employee_id'   => $request->employee_id,
                                'branch_id'     => Auth::user()->branch_id,
                                'created_at'    => date("Y-m-d H:i:s"),
                                'updated_at'    => date("Y-m-d H:i:s"),
                            ];
                            if(! in_array($databpjs,$array_bpjs)){
                                array_push($array_bpjs,$databpjs);
                            }
                        }
                    }
                    if (count($array_bpjs) > 0){
                        $bpjsVlue = Bpjs_value::Insert($array_bpjs);
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
            toast('Permission denied.', 'error');
            return redirect()->route('payroll.index');
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

                $payroll = [
                    'payslip_type_id' => $request->payslip_type_id,
                    'amount'          => $request->amount_salary,
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
                $a = 0;
                $array_bpjs = [];
                $salary_gross = $request->amount_salary + $allowance->allowance;

                if(isset($request->bpjs)){
                    foreach($request->bpjs as $bpjs){
                        $getName     = Master_bpjs::where('id','=',$bpjs)->first();

                        if($request->nominal_bpjs_kes > 0 && $getName->bpjs_code == 'KSHT'){
                            $val_comp   = round(($request->nominal_bpjs_kes + $allowance->allowance) * $getName->is_company / 100 );
                            $val_emp    = round(($request->nominal_bpjs_kes + $allowance->allowance) * $getName->is_employee / 100 );
                            $salary_kes = round($request->nominal_bpjs_kes + $allowance->allowance);
                            $value_kes  = round($request->nominal_bpjs_kes);
                            $total      = round($val_comp + $val_emp);
                            $salary_tk_jp = 0;
                            $value_tk_jp = 0;
                        }else if($request->nominal_bpjs_jp > 0 & $getName->bpjs_code ==="JP"){
                            $val_comp   = round(($request->nominal_bpjs_jp + $allowance->allowance) * $getName->is_company / 100 );
                            $val_emp    = round(($request->nominal_bpjs_jp + $allowance->allowance) * $getName->is_employee / 100 );
                            $total      = round($val_comp + $val_emp);
                            $salary_tk_jp = round($request->nominal_bpjs_jp + $allowance->allowance);
                            $value_tk_jp = round($request->nominal_bpjs_jp);
                            $salary_kes = 0;
                            $value_kes = 0;
                        }else{
                            $val_comp   = round($salary_gross * $getName->is_company / 100 );
                            $val_emp    = round($salary_gross * $getName->is_employee / 100 );
                            $total      = round($val_comp + $val_emp);
                            $salary_kes = 0;
                            $value_kes = 0;
                            $salary_tk_jp = 0;
                            $value_tk_jp = 0;
                        }

                        $databpjs = [
                            'bpjs_id'       => $bpjs,
                            'bpjs_name'     => $getName->bpjs_name,
                            'is_company'    => $val_comp,
                            'is_employee'   => $val_emp,
                            'is_total'      => $total,
                            'salary_gross'  => $salary_gross,
                            'salary_kes'    => $salary_kes,
                            'salary_tk_jp'  => $salary_tk_jp,
                            'value_kes'     => $value_kes,
                            'value_tk_jp'   => $value_tk_jp,
                            'employee_id'   => $request->employee_id,
                            'branch_id'     => Auth::user()->branch_id,
                            'created_at'    => date("Y-m-d H:i:s"),
                            'updated_at'    => date("Y-m-d H:i:s"),
                        ];
                        if(! in_array($databpjs,$array_bpjs)){
                            array_push($array_bpjs,$databpjs);
                        }
                    }
                    if (count($array_bpjs) > 0){
                        Bpjs_value::where('employee_id','=',$request->employee_id)->delete();
                        $bpjsVlue = Bpjs_value::Insert($array_bpjs);
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
                'status' => 'success',
                'msg'    => 'Something went wrong. !',
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

    public function indexBpjsTk()
    {
        if (Auth::user()->can('manage bpjs kesehatan')) {
            $bpjs_tk = Utility::where('name', 'bpjs_tk')->first();

            $bpjs_tk_val = null;
            if (!is_null($bpjs_tk)) {
                $bpjs_tk_val = json_decode($bpjs_tk->value, true);
            }

            return view('pages.contents.payroll.bpjs-tk.index', compact('bpjs_tk_val'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function storeBpjsTk(Request $request)
    {
        if (Auth::user()->can('create bpjs kesehatan')) {

            try {
                DB::beginTransaction();
                $bpjs_tk = Utility::where('name', 'bpjs_tk')->first();

                if (is_null($bpjs_tk)) {
                    $data = ['type' => $request->type, 'value' => $request->number_value, 'maximum_salary' => $request->maximum_salary];
                    $encode = json_encode($data);

                    $utility  = new Utility();
                    $utility->name = 'bpjs_tk';
                    $utility->value = $encode;
                    $utility->created_by = Auth::user()->creatorId();
                    $utility->save();
                } else {
                    $data = ['type' => $request->type, 'value' => $request->number_value, 'maximum_salary' => $request->maximum_salary];
                    $encode = json_encode($data);
                    $bpjs_tk->value = $encode;
                    $bpjs_tk->save();
                }

                DB::commit();

                toast('Successfully saved', 'success');
                return redirect()->route('setting.bpjs-tk.index');
            } catch (Exception $th) {
                DB::rollBack();
                toast('Something went wrong', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function indexPph21()
    {
        if (Auth::user()->can('manage pph21')) {
            $pph21 = Utility::where('name', 'pph21')->first();

            $pph21_val = null;
            if (!is_null($pph21)) {
                $pph21_val = json_decode($pph21->value, true);
            }

            return view('pages.contents.payroll.pph21.index', compact('pph21_val'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function storePph21(Request $request)
    {
        if (Auth::user()->can('edit pph21')) {

            try {
                DB::beginTransaction();
                $bpjs_tk = Utility::where('name', 'pph21')->first();
                $is_paid_by_employee_themselve = Utility::where('name', 'is_paid_by_employee_themselve')->first();

                if (isset($request->is_paid_by_employee_themselve)) {
                    if ($request->is_paid_by_employee_themselve == 'on') {

                        if (is_null($is_paid_by_employee_themselve)) {
                            Utility::create([
                                'name' => 'is_paid_by_employee_themselve',
                                'value' => true,
                                'created_by' => Auth::user()->creatorId(),
                            ]);
                        } else {
                            $is_paid_by_employee_themselve->value = true;
                            $is_paid_by_employee_themselve->save();
                        }
                    }
                } else {
                    if (is_null($is_paid_by_employee_themselve)) {
                        Utility::create([
                            'name' => 'is_paid_by_employee_themselve',
                            'value' => false,
                            'created_by' => Auth::user()->creatorId(),
                        ]);
                    } else {
                        $is_paid_by_employee_themselve->value = false;
                        $is_paid_by_employee_themselve->save();
                    }
                }

                if (is_null($bpjs_tk)) {
                    if (isset($request->pph21)) {
                        foreach ($request->pph21 as $key => $value) {
                            if (!is_null($value['income']) && $value['percentage']) {
                                $arrays[] = ['income' => $value['income'], 'percentage' => $value['percentage']];
                            }
                        }
                    }



                    $values = json_encode($arrays);

                    $utility  = new Utility();
                    $utility->name = 'pph21';
                    $utility->value = $values;
                    $utility->created_by = Auth::user()->creatorId();
                    $utility->save();
                } else {
                    if (isset($request->pph21)) {
                        foreach ($request->pph21 as $key => $value) {
                            if (!is_null($value['income']) && $value['percentage']) {
                                $arrays[] = ['income' => $value['income'], 'percentage' => $value['percentage']];
                            }
                        }
                    }

                    $values = json_encode($arrays);

                    $bpjs_tk->value = $values;
                    $bpjs_tk->save();
                }

                DB::commit();

                toast('Successfully saved', 'success');
                return redirect()->route('setting.pph21.index');
            } catch (Exception $th) {
                DB::rollBack();
                toast('Something went wrong', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function indexJht()
    {
        if (Auth::user()->can('manage jht')) {
            $jht = Utility::where('name', 'jht')->first();

            $jht_val = null;
            if (!is_null($jht)) {
                $jht_val = json_decode($jht->value, true);
            }

            return view('pages.contents.payroll.jaminan-hari-tua.index', compact('jht_val'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function storeJht(Request $request)
    {
        if (Auth::user()->can('edit jht')) {
            try {
                DB::beginTransaction();
                $jht = Utility::where('name', 'jht')->first();

                if (is_null($jht)) {
                    $data = ['type' => $request->name_type, 'value' => $request->number_value];
                    $encode = json_encode($data);

                    $utility  = new Utility();
                    $utility->name = 'jht';
                    $utility->value = $encode;
                    $utility->created_by = Auth::user()->creatorId();
                    $utility->save();
                } else {
                    $data = ['type' => $request->name_type, 'value' => $request->number_value];
                    $encode = json_encode($data);
                    $jht->value = $encode;
                    $jht->save();
                }

                DB::commit();

                toast('Successfully saved', 'success');
                return redirect()->route('setting.jht.index');
            } catch (Exception $th) {
                DB::rollBack();
                toast('Something went wrong', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function indexJkk()
    {
        if (Auth::user()->can('manage jkk')) {
            $jkk = Utility::where('name', 'jkk')->first();

            $jkk_val = null;
            if (!is_null($jkk)) {
                $jkk_val = json_decode($jkk->value, true);
            }

            return view('pages.contents.payroll.jaminan-kecelakaan-kerja.index', compact('jkk_val'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function storeJkk(Request $request)
    {
        if (Auth::user()->can('edit jkk')) {

            try {
                DB::beginTransaction();
                $jkk = Utility::where('name', 'jkk')->first();

                if (is_null($jkk)) {
                    if (isset($request->jkk)) {
                        foreach ($request->jkk as $key => $value) {
                            if (!is_null($value['risk']) && $value['percentage']) {
                                $arrays[] = ['risk' => $value['risk'], 'percentage' => $value['percentage']];
                            }
                        }
                    }

                    $values = json_encode($arrays);

                    $utility  = new Utility();
                    $utility->name = 'jkk';
                    $utility->value = $values;
                    $utility->created_by = Auth::user()->creatorId();
                    $utility->save();
                } else {
                    if (isset($request->jkk)) {
                        foreach ($request->jkk as $key => $value) {
                            if (!is_null($value['risk']) && $value['percentage']) {
                                $arrays[] = ['risk' => $value['risk'], 'percentage' => $value['percentage']];
                            }
                        }
                    }

                    $values = json_encode($arrays);

                    $jkk->value = $values;
                    $jkk->save();
                }

                DB::commit();

                toast('Successfully saved', 'success');
                return redirect()->route('setting.jkk.index');
            } catch (Exception $th) {
                DB::rollBack();
                toast('Something went wrong', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function indexJkm()
    {
        if (Auth::user()->can('manage jkm')) {
            $jkm = Utility::where('name', 'jkm')->first();

            $jkm_val = null;
            if (!is_null($jkm)) {
                $jkm_val = json_decode($jkm->value, true);
            }

            return view('pages.contents.payroll.jaminan-kematian.index', compact('jkm_val'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function storeJkm(Request $request)
    {
        if (Auth::user()->can('edit jkm')) {
            try {
                DB::beginTransaction();
                $jkm = Utility::where('name', 'jkm')->first();

                if (is_null($jkm)) {
                    $data = ['type' => $request->type, 'value' => $request->number_value];
                    $encode = json_encode($data);

                    $utility  = new Utility();
                    $utility->name = 'jkm';
                    $utility->value = $encode;
                    $utility->created_by = Auth::user()->creatorId();
                    $utility->save();
                } else {
                    $data = ['type' => $request->type, 'value' => $request->number_value];
                    $encode = json_encode($data);
                    $jkm->value = $encode;
                    $jkm->save();
                }

                DB::commit();

                toast('Successfully saved', 'success');
                return redirect()->route('setting.jkm.index');
            } catch (Exception $th) {
                DB::rollBack();
                toast('Something went wrong', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function indexJp()
    {
        if (Auth::user()->can('manage jp')) {
            $jp = Utility::where('name', 'jp')->first();

            $jp_val = null;
            if (!is_null($jp)) {
                $jp_val = json_decode($jp->value, true);
            }

            return view('pages.contents.payroll.jaminan-pensiun.index', compact('jp_val'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    // jika pensiun
    public function storeJp(Request $request)
    {
        if (Auth::user()->can('edit jp')) {
            try {
                DB::beginTransaction();
                $jp = Utility::where('name', 'jp')->first();

                if (is_null($jp)) {
                    $data = ['type' => $request->name_type, 'value' => $request->number_value, 'maximum_limit_value' => $request->maximum_limit_value];
                    $encode = json_encode($data);

                    $utility  = new Utility();
                    $utility->name = 'jp';
                    $utility->value = $encode;
                    $utility->created_by = Auth::user()->creatorId();
                    $utility->save();
                } else {
                    $data = ['type' => $request->name_type, 'value' => $request->number_value, 'maximum_limit_value' => $request->maximum_limit_value];
                    $encode = json_encode($data);
                    $jp->value = $encode;
                    $jp->save();
                }

                DB::commit();

                toast('Successfully saved', 'success');
                return redirect()->route('setting.jp.index');
            } catch (Exception $th) {
                DB::rollBack();
                toast('Something went wrong', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function indexSetBpjsTk()
    {
        $datas = SetBpjsTK::where('created_by', Auth::user()->creatorId())->get();
        $employees = Employee::where('created_by', Auth::user()->creatorId())->get();
        // $bpjstk = new Collection();

        // foreach ($user->bpjstk as $tk) {
        //     $bpjstk = $bpjstk->merge($tk->bpjstk_name);
        // }
        // $bpjstk = $bpjstk->pluck('name', 'id')->toArray();
        // dd($datas);

        return view('pages.contents.set-bpjstk.index', compact('datas', 'employees'));
    }
    public function storeSetBpjsTk(Request $request)
    {
        try {
            DB::beginTransaction();

            if (isset($request->bpjstk)) {
                foreach ($request->bpjstk as $key => $value) {
                    $arrays[] =
                        $value;
                }
            }

            $values = json_encode($arrays);

            $set  = new SetBpjsTK();
            $set->employee_id = $request->employee_id;
            $set->bpjstk_name = $values;
            $set->created_by = Auth::user()->creatorId();
            $set->save();
            DB::commit();

            toast('Successfully saved', 'success');
            return redirect()->route('set-bpjstk.index');
        } catch (Exception $th) {
            DB::rollBack();
            toast('Something went wrong', 'error');
            return redirect()->back();
        }
    }

    public function editSetBpjsTk($id)
    {
        $bpjstk = SetBpjsTK::find($id);
        $decode = json_decode($bpjstk->bpjstk_name, true);

        return response()->json([
            'id' => $bpjstk->id,
            'employee_id' => $bpjstk->employee_id,
            'val_bpjstk'  => $decode
        ]);
    }

    public function updateSetBpjsTk(Request $request, $id)
    {
        $model = SetBpjsTK::find($id);
        try {
            DB::beginTransaction();
            if (isset($request->bpjstk)) {
                foreach ($request->bpjstk as $key => $value) {
                    $arrays[] =
                        $value;
                }
            }

            $values = json_encode($arrays);

            $model->employee_id = $request->employee_id;
            $model->bpjstk_name = $values;
            $model->save();
            DB::commit();

            toast('Successfully updated.', 'success');
            return redirect()->route('set-bpjstk.index');
        } catch (Exception $e) {
            DB::rollBack();
            toast('Failure occurred.', 'error');
            return redirect()->back();
        }
    }

    public function destroySetBpjstk($id)
    {
        $model = SetBpjsTK::find($id);
        $model->delete();

        toast('Successfully deleted.', 'success');
        return redirect()->route('set-bpjstk.index');
    }
}
