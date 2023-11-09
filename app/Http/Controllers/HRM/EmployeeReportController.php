<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;

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
        if ($request->branch_id == 0){
            $turnover = DB::table('v_monthly_turnover')
                        ->select('bulan',DB::raw("SUM(turnover) / count(branch_id) as turnover "))
                        ->groupBy('bulan')
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
                    ->where('employees.branch_id',$request->branch)
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
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='01' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['feb_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='02' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['mart_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='03' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['april_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='04' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['mei_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='05' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['juni_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='06' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['july_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='07' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['agust_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='08' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['sept_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='09' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['okt_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='10' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['nov_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='11' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['des_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='12' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
            // 
           $data['jan_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='01' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['feb_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='02' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['mart_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='03' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['april_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='04' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['mei_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='05' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['juni_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='06' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['july_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='07' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['agust_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='08' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['sept_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='09' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['okt_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='10' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['nov_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='11' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");
           $data['des_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='12' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.company_id = $branch->company_id");

        }else{
            // female
            $data['jan_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='01' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['feb_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='02' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['mart_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='03' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['april_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='04' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['mei_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='05' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['juni_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='06' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['july_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='07' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['agust_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='08' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['sept_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='09' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['okt_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='10' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['nov_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='11' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['des_female'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='FEMALE' 
                                            AND to_char(date(a.created_at),'mm') ='12' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            // male
            $data['jan_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='01' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['feb_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='02' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['mart_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='03' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['april_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='04' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['mei_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='05' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['juni_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='06' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['july_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='07' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['agust_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='08' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['sept_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='09' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['okt_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='10' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['nov_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='11' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
            $data['des_male'] = DB::select("SELECT count(a.id) FROM employees a
                                            LEFT JOIN branches as b 
                                            ON b.id = a.branch_id
                                            WHERE gender ='MALE' 
                                            AND to_char(date(a.created_at),'mm') ='12' 
                                            AND to_char(date(a.created_at),'YYYY') = to_char(date(now()),'YYYY')
                                            AND b.branch_id = $request->branch_id");
        
        }
        return response()->json($data);
    }
}
