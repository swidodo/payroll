<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\EmployeesExport;
use App\Exports\RemainderContractExport;
use App\Exports\TurnoverExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use App\Models\AccessBranch;
use App\Models\Employee;
use DataTables;

class EmployeeReportController extends Controller
{

    //
    public function exportExcel(Request $request){
        return Excel::download(new EmployeesExport($request), 'Employee Report.xlsx');
    }
    public function employee_status(Request $request){
        if($request->branch_id == '0'){
            $branch = DB::table('branches')->where('id',Auth::user()->branch_id)->first();
            $status = DB::table('v_employee_status')
                        ->select(DB::raw("sum(v_employee_status.permanent) as permanent,
                        sum(v_employee_status.contract) as contract,
                        sum(v_employee_status.probation) as probation,
                        sum(v_employee_status.daily_worker) as daily_work,
                        sum(v_employee_status.freelance) as freelance"))
                        ->leftJoin('branches','branches.id','v_employee_status.branch_id')
                        ->where('branches.company_id',$branch->company_id)
                        ->get();
            $response['data'] = $status;
        }else{
            $status = DB::table('v_employee_status')
                            ->select(DB::raw("sum(v_employee_status.permanent) as permanent,
                            sum(v_employee_status.contract) as contract,
                            sum(v_employee_status.probation) as probation,
                            sum(v_employee_status.daily_worker) as daily_work,
                            sum(v_employee_status.freelance) as freelance"))
                        ->where('branch_id',$request->branch_id)
                        ->get();
            $response['data'] = $status;
        }
        return response()->json($response);
    }
    public function employee_gender(Request $request){
        if($request->branch_id == '0'){
            $branch = DB::table('branches')->where('id',Auth::user()->branch_id)->first();
            $gender = DB::table('v_employee_gender')
                        ->select('v_employee_gender.label',DB::raw("SUM(value) as value"))
                        ->leftJoin('branches','branches.id','=','v_employee_gender.branch_id')
                        ->where('branches.company_id',$branch->company_id)
                        ->groupBy('label')
                        ->get();
            $response['data'] = $gender;
        }else{
            $gender = DB::table('v_employee_gender')
                        ->select('label',DB::raw("SUM(value) as value"))
                        ->where('branch_id',$request->branch_id)
                        ->groupBy('branch_id')
                        ->groupBy('label')
                        ->get();
            $response['data'] = $gender;
        }
        return response()->json($response);
    }
   
    public function monthly_turnover(Request $request){
        $branch = DB::table('branches')->where('id',Auth::user()->branch_id)->first();
        dd($branch);
        if ($request->branch_id == 0){
            $turnover = DB::table('v_monthly_turnover')
                        ->select(DB::raw("SUM(turnover) / count(branch_id) as turnover "))
                        ->leftJoin('branches','branches.id','=','v_monthly_turnover.branch_id')
                        ->where('branches.company_id',$branch->company_id)
                        ->get();
            $response['data'] = $turnover;
        }else{
            $turnover = DB::table('v_monthly_turnover')
                        ->select('*')
                        ->where('branch_id',$request->branch_id)
                        ->get();
            $response['data'] = $turnover;
        }
        return response()->json($response);

    }
   
    public function employee_department(Request $request){
        $branch = DB::table('branches')->where('id',Auth::user()->branch_id)->first();
        if($request->branch_id == 0){
            $dep['data'] = DB::table('departements')
                    ->select('departements.name',DB::raw('count(employees.id)'))
                    ->leftJoin('employees','employees.department_id','departements.id')
                    ->leftJoin('branches','branches.id','=','employees.branch_id')
                    ->where('branches.id',$branch->company_id)
                    ->groupBy('departements.departement_code','departements.name')->get();
        }else{
            $dep['data'] = DB::table('departements')
                    ->select('departements.name',DB::raw('count(employees.id)'))
                    ->leftJoin('employees','employees.department_id','departements.id')
                    ->where('employees.branch_id',$request->branch_id)
                    ->groupBy('departements.departement_code','departements.name')->get();
        
        }
        return response()->json($dep);
    }
    public function report_totalemployee(Request $request){
        $branch = DB::table('branches')->where('id',Auth::user()->branch_id)->first();
        if($request->branch_id == 0){
            // male
           $data['jan_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='01' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['feb_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='02' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['mart_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='03' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['april_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='04' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['mei_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='05' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['juni_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='06' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['july_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='07' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['agust_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='08' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['sept_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='09' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['okt_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='10' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['nov_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='11' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['des_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='12' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
            // 
           $data['jan_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='01' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['feb_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='02' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['mart_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='03' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['april_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='04' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['mei_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='05' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['juni_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='06' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['july_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='07' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['agust_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='08' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['sept_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='09' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['okt_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='10' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['nov_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='11' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['des_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='12' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");

        }else{
            // female
            $data['jan_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='01' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['feb_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='02' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['mart_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='03' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['april_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='04' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['mei_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='05' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['juni_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='06' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['july_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='07' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['agust_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='08' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['sept_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='09' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['okt_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='10' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['nov_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='11' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['des_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='12' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            // male
            $data['jan_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='01' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['feb_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='02' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['mart_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='03' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['april_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='04' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['mei_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='05' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['juni_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='06' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['july_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='07' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['agust_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='08' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['sept_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='09' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['okt_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='10' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['nov_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='11' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
            $data['des_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE UPPER(gender) ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='12' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.id = $request->branch_id");
        
        }
        return response()->json($data);
    }
    public function report_employee_in_year(Request $request){
        $year1 = date('Y') - 4;
        $year2 = date('Y') - 3;
        $year3 = date('Y') - 2;
        $year4 = date('Y') - 1;
        $year5 = date('Y');
        $branch = DB::table('branches')->where('id',Auth::user()->branch_id)->first();
        if($request->branch_id == 0){
            $data['year1'] = DB::SELECT("SELECT count(a.id)
                                            FROM employees a 
                                            LEFT JOIN branches b 
                                            ON b.id =a.branch_id
                                            WHERE to_char(date(a.created_at),'YYYY') <= '$year1'
                                            AND a.status ='active' 
                                            AND b.company_id = $branch->company_id");
            $data['year2'] = DB::SELECT("SELECT count(a.id)
                                            FROM employees a 
                                            LEFT JOIN branches b 
                                            ON b.id =a.branch_id
                                            WHERE to_char(date(a.created_at),'YYYY') <= '$year2'
                                            AND to_char(date(a.created_at),'YYYY') > '$year1'
                                            AND a.status ='active' 
                                            AND b.company_id = $branch->company_id");
            $data['year3'] = DB::SELECT("SELECT count(a.id)
                                            FROM employees a 
                                            LEFT JOIN branches b 
                                            ON b.id =a.branch_id
                                            WHERE to_char(date(a.created_at),'YYYY') <= '$year3'
                                            AND to_char(date(a.created_at),'YYYY') > '$year2'
                                            AND a.status ='active' 
                                            AND b.company_id = $branch->company_id");
            $data['year4'] = DB::SELECT("SELECT count(a.id)
                                            FROM employees a 
                                            LEFT JOIN branches b 
                                            ON b.id =a.branch_id
                                            WHERE to_char(date(a.created_at),'YYYY') <= '$year4'
                                            AND to_char(date(a.created_at),'YYYY') > '$year3'
                                            AND a.status ='active' 
                                            AND b.company_id = $branch->company_id");
            $data['year5'] = DB::SELECT("SELECT count(a.id)
                                            FROM employees a 
                                            LEFT JOIN branches b 
                                            ON b.id =a.branch_id
                                            WHERE to_char(date(a.created_at),'YYYY') <= '$year5'
                                            AND to_char(date(a.created_at),'YYYY') > '$year4'
                                            AND a.status ='active' 
                                            AND b.company_id = $branch->company_id");
        }else{
            $data['year1'] = DB::SELECT("SELECT count(id)
                                FROM employees
                                WHERE to_char(date(created_at),'YYYY') <= '$year1'
                                AND status ='active' 
                                AND branch_id = $request->branch_id");
            $data['year2'] = DB::SELECT("SELECT count(id)
                                FROM employees
                                WHERE to_char(date(created_at),'YYYY') <= '$year2'
                                AND to_char(date(created_at),'YYYY') > '$year1'
                                AND status ='active' 
                                AND branch_id = $request->branch_id");
            $data['year3'] = DB::SELECT("SELECT count(id)
                                FROM employees
                                WHERE to_char(date(created_at),'YYYY') <= '$year3'
                                AND to_char(date(created_at),'YYYY') > '$year2'
                                AND status ='active' 
                                AND branch_id = $request->branch_id");
            $data['year4'] = DB::SELECT("SELECT count(id)
                                FROM employees
                                WHERE to_char(date(created_at),'YYYY') <= '$year4'
                                AND to_char(date(created_at),'YYYY') > '$year3'
                                AND status ='active' 
                                AND branch_id = $request->branch_id");
            $data['year5'] = DB::SELECT("SELECT count(id)
                                FROM employees
                                WHERE to_char(date(created_at),'YYYY') <= '$year5'
                                AND to_char(date(created_at),'YYYY') > '$year4'
                                AND status ='active' 
                                AND branch_id = $request->branch_id");
        }
         return response()->json($data);
    }
    public function report_contract(){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $emp = Employee::where('user_id',Auth::user()->id)->first();
        
        if(Auth::user()->initial =="HO"){
            if (Auth::user()->type == "company"){
                $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
            }else{
                $data['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                ->where('access_branches.employee_id',$emp->id)
                                                ->where('access_branches.company_id',$branch->company_id)->get();
            }
        }else{
            $data['branch'] = Branch::where('id',$branch->id)->get();
        }
        return view('pages.contents.report.turnover.report',$data);
    }
    public function get_turnover_report(Request $request){
        $data = DB::table('v_remainder_contracts')
                    ->where('branch_id',$request->branch_id)
                    ->where('remainder','<=',60)
                    ->where('status','active')
                    ->whereIn('status_contract',['EXPIRED CONTRACT','AVAILABLE'])
                    ->orderBy('employee_name','ASC');
            if ($request->branch_id !=''){
                $data->where('branch_id',$request->branch_id);
            }
            if($request->startdate !='' && $request->enddate !=''){
                $data->whereBetween(DB::raw('date(update_at)',[$request->startdate,$request->enddate]));
            }
            $data->get();
            return DataTables::of($data)->make(true);
        
    }
    public function rekap_turnover(){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $emp = Employee::where('user_id',Auth::user()->id)->first();
        
        if(Auth::user()->initial =="HO"){
            if (Auth::user()->type == "company"){
                $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
            }else{
                $data['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                ->where('access_branches.employee_id',$emp->id)
                                                ->where('access_branches.company_id',$branch->company_id)->get();
            }
        }else{
            $data['branch'] = Branch::where('id',$branch->id)->get();
        }
        $data['brch'] = $branch;
       
        return view('pages.contents.report.turnover.rekap',$data);
    }
    public function get_data_rekap(Request $request){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $emp = Employee::where('user_id',Auth::user()->id)->first();
        if(Auth::user()->initial =="HO"){
            if (Auth::user()->type == "company"){
                $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
            }else{
                $data['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                ->where('access_branches.employee_id',$emp->id)
                                                ->where('access_branches.company_id',$branch->company_id)->get();
            }
        }else{
            $data['branch'] = Branch::where('id',$branch->id)->get();
        }
        $data['brch'] = Branch::where('id',$request->branch_id)->first();
        $data['out'] = DB::SELECT("SELECT branch_id,
                                        branch_name,
                                        status, 
                                        count(status) as total
                                    FROM v_remainder_contracts WHERE branch_id = '$request->branch_id' and status <> 'active'
                                    AND date(updated_at) BETWEEN '$request->from_date' AND '$request->to_date'
                                    GROUP BY status, branch_id,branch_name");
         $data['active'] = DB::SELECT("SELECT branch_id,
                                        'EMPLOYEE - ACTIVE' as active, 
                                        count(status) as total
                                    FROM employees 
                                    WHERE branch_id = '$request->branch_id' and status ='active'
                                    GROUP BY status, branch_id");
        $data['permanent'] = DB::SELECT("SELECT branch_id,
                                        'EMPLOYEE - PERMANENT' as permanent, 
                                        count(status) as total
                                    FROM employees 
                                    WHERE branch_id = '$request->branch_id' and status ='active' and UPPER(employee_type) ='PERMANENT'
                                    GROUP BY status, branch_id");
        $data['in'] = DB::SELECT("SELECT branch_id,branch_name,
                                    'EMPLOYEE - JOIN' as join, 
                                    count(status) as total
                                    FROM v_remainder_contracts 
                                    WHERE status = 'active' 
                                    and branch_id = '$request->branch_id'
                                    AND date(created_at) BETWEEN '$request->from_date' AND '$request->to_date'
                                    GROUP BY status, branch_id,branch_name");
        return view('pages.contents.report.turnover.rekap',$data);
    }
    public function ExportExcelRemainder(Request $request){
        $date = date('Ymd');
        $fileName = 'remainder-contract_'.$date.'.xlsx';
        return Excel::download(new RemainderContractExport($request), $fileName);
    }
    public function ExportExcelTurnover(Request $request){
        $date = date('Ymd');
        $fileName = 'turnover-report_'.$date.'.xlsx';
        return Excel::download(new TurnoverExport($request), $fileName);
    }

}
