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
    public function employee_jobLevel(Request $request){
        if($request->branch_id == '0'){
            $job = DB::table('v_employee_joblevel')
                        ->select('position_name',DB::raw("SUM(subtotal)/count(branch_id) as subtotal") )
                        ->groupBy('position_name')
                        ->get();
            $response['data'] = $job;
        }else{
            $job = DB::table('v_employee_joblevel')
                        ->select('position_name',DB::raw("SUM(subtotal)/count(branch_id) as subtotal") )
                        ->where('branch_id',$request->branch_id)
                        ->groupBy('position_name')
                        ->get();
            $response['data'] = $job;
        }
        return response()->json($response);
    }
    public function employee_education(Request $request){
        if($request->branch_id == '0'){
            $education = DB::table('v_employee_education')
                        ->select('level',DB::raw("SUM(count) as count"))
                        ->groupBy('level')
                        ->get();
            $total   = DB::table('v_employee_education')
                        ->select(DB::raw("SUM(count) as count"))
                        ->get();
            $response['data'] = $education;
            $response['total'] = $total;

        }else{
            $education = DB::table('v_employee_education')
                        ->select('*')
                        ->where('branch_id',$request->branch_id)
                        ->get();
            $total   = DB::table('v_employee_education')
                        ->select("count")
                        ->where('branch_id',$request->branch_id)
                        ->get();
            $response['data'] = $education;
            $response['total'] = $total;
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
    public function employee_age_average(Request $request){
        if ($request->branch_id == 0){
            $age = DB::table('v_employee_age_average')
                    ->select(DB::raw("(SUM(range_18) / count(branch_id)) as range_18,(SUM(range_20_30) / count(branch_id)) as range_20_30,
                    (SUM(range_31_40) / count(branch_id)) as range_31_40,(SUM(range_41_50) / count(branch_id)) as range_41_50"))
                    ->get();
            $response['data'] = $age;
        }else{
            $age = DB::table('v_employee_age_average')
                    ->select('*')
                    ->where('branch_id',$request->branch_id)
                    ->get();
            $response['data'] = $age;
        }

        return response()->json($response);
    }
    public function employee_active_staff(Request $request){
        if ($request->branch_id == 0){
            $branch = DB::table('branches')->where('id',Auth::user()->branch_id)->first();
            $staff = DB::table('v_employee_active_staff')
                        ->select('bulan_des',DB::raw("count(subtotal) as subtotal"))
                        ->leftJoin('branches','branches.id','v_employee_active_staff.branch_id')
                        ->where('branches.company_id',$branch->company_id)
                        ->groupBy('bulan_des')
                        ->groupBy('bulan')
                        ->orderBy('bulan','ASC')
                        ->get();
            $response['data'] = $staff;
        }else{
            $staff = DB::table('v_employee_active_staff')
                        ->select('*')
                        ->where('branch_id',$request->branch_id)
                        ->orderBy('bulan','ASC')
                        ->get();
            $response['data'] = $staff;
        }
        return response()->json($response);
    }
    public function employee_lenght_of_service(Request $request){
        if($request->branch_id != '0') :
            $service3 = DB::table('v_lenght_of_service')
                        ->select(DB::raw("subtotal/(select count(employee_id) from employees where is_active =true and status ='active' and branch_id = branch_id)::float * 100  as tot"))
                        ->where('service' ,'<=',3)
                        ->where('branch_id',$request->branch_id)
                        ->get();
            $service5 = DB::table('v_lenght_of_service')
                        ->select(DB::raw("subtotal/(select count(employee_id) from employees where is_active =true and status ='active' and branch_id = branch_id)::float * 100  as tot"))
                        ->where('service', '>', 3)
                        ->where('service', '<=' ,5)
                        ->get();
            $service10 = DB::table('v_lenght_of_service')
                        ->select(DB::raw("subtotal/(select count(employee_id) from employees where is_active =true and status ='active' and branch_id = branch_id)::float * 100  as tot"))
                        ->where('service' ,'>', 5)
                        ->where('service', '<=', 10)
                        ->where('branch_id',$request->branch_id)
                        ->get();
            $service15 = DB::table('v_lenght_of_service')
                        ->select(DB::raw("subtotal/(select count(employee_id) from employees where is_active =true and status ='active' and branch_id = branch_id)::float * 100  as tot"))
                        ->where('service', '>', 10)
                        ->where('service', '<=', 15)
                        ->where('branch_id',$request->branch_id)
                        ->get();
            $service20 = DB::table('v_lenght_of_service')
                        ->select(DB::raw("subtotal/(select count(employee_id) from employees where is_active =true and status ='active' and branch_id = branch_id)::float * 100  as tot"))
                        ->where('service', '>', 15)
                        ->where('service','<=', 20)
                        ->where('branch_id',$request->branch_id)
                        ->get();
            $service_30 = DB::table('v_lenght_of_service')
                        ->select(DB::raw("subtotal/(select count(employee_id) from employees where is_active =true and status ='active' and branch_id = branch_id)::float * 100  as tot"))
                        ->where('service', '>', 20)
                        ->where('branch_id',$request->branch_id)
                        ->get();
        endif;
        if($request->branch_id == '0') :
            $branch = DB::table('branches')->where('id',Auth::user()->branch_id)->first();
            $service3 = DB::table('v_lenght_of_service')
                        ->select(DB::raw("SUM(subtotal)/(select count(employee_id) from employees where is_active =true and status ='active' and branch_id = branch_id)::float * 100  as tot"))
                        ->leftJoin('branches','branches.id','v_lenght_of_service.branch_id')
                        ->where('branches.company_id',$branch->company_id)
                        ->where('service' ,'<=',3)
                        ->get();
            $service5 = DB::table('v_lenght_of_service')
                        ->select(DB::raw("SUM(subtotal)/(select count(employee_id) from employees where is_active =true and status ='active' and branch_id = branch_id)::float * 100  as tot"))
                        ->leftJoin('branches','branches.id','v_lenght_of_service.branch_id')
                        ->where('branches.company_id',$branch->company_id)
                        ->where('service', '>', 3)
                        ->where('service', '<=' ,5)
                        ->get();
            $service10 = DB::table('v_lenght_of_service')
                        ->select(DB::raw("SUM(subtotal)/(select count(employee_id) from employees where is_active =true and status ='active' and branch_id = branch_id)::float * 100  as tot"))
                        ->leftJoin('branches','branches.id','v_lenght_of_service.branch_id')
                        ->where('branches.company_id',$branch->company_id)
                        ->where('service' ,'>', 5)
                        ->where('service', '<=', 10)
                        ->where('branch_id',$request->branch_id)
                        ->get();
            $service15 = DB::table('v_lenght_of_service')
                        ->select(DB::raw("SUM(subtotal)/(select count(employee_id) from employees where is_active =true and status ='active' and branch_id = branch_id)::float * 100  as tot"))
                        ->leftJoin('branches','branches.id','v_lenght_of_service.branch_id')
                        ->where('branches.company_id',$branch->company_id)
                        ->where('service', '>', 10)
                        ->where('service', '<=', 15)
                        ->where('branch_id',$request->branch_id)
                        ->get();
            $service20 = DB::table('v_lenght_of_service')
                        ->select(DB::raw("SUM(subtotal)/(select count(employee_id) from employees where is_active =true and status ='active' and branch_id = branch_id)::float * 100  as tot"))
                        ->leftJoin('branches','branches.id','v_lenght_of_service.branch_id')
                        ->where('branches.company_id',$branch->company_id)
                        ->where('service', '>', 15)
                        ->where('service','<=', 20)
                        ->where('branch_id',$request->branch_id)
                        ->get();
            $service_30 = DB::table('v_lenght_of_service')
                        ->select(DB::raw("SUM(subtotal)/(select count(employee_id) from employees where is_active =true and status ='active' and branch_id = branch_id)::float * 100  as tot"))
                        ->leftJoin('branches','branches.id','v_lenght_of_service.branch_id')
                        ->where('branches.company_id',$branch->company_id)
                        ->where('service', '>', 20)
                        ->where('branch_id',$request->branch_id)
                        ->get();
        endif;
        $response['lenght_3']  = $service3 ;
        $response['lenght_5']  = $service5;
        $response['lenght_10'] = $service10;
        $response['lenght_15'] = $service15;
        $response['lenght_20'] = $service20;
        $response['lenght_30'] = $service_30 ;
        return response()->json($response);
    }
    public function monthly_turnover(Request $request){
        if ($request->branch_id == 0){
            $turnover = DB::table('v_monthly_trunover')
                        ->select('bulan',DB::raw("SUM(turnover) / count(branch_id) as turnover "))
                        ->groupBy('bulan')
                        ->get();
            $response['data'] = $turnover;
        }else{
            $turnover = DB::table('v_monthly_trunover')
                        ->select('*')
                        ->where('branch_id',$request->branch_id)
                        ->get();
            $response['data'] = $turnover;
        }
        return response()->json($response);

    }
    public function employee_religion(Request $request){
        if($request->branch_id == 0){
            $religion = DB::table('v_employee_religion')
                        ->select(DB::raw("(SUM(islam) / count(branch_id)) as islam,
                        (SUM(kristen) / count(branch_id)) as kristen,
                        (SUM(katholik) / count(branch_id)) as katholik,
                        (SUM(hindu) / count(branch_id)) as hindu,
                        (SUM(budha) / count(branch_id)) as budha,
                        (SUM(lain) / count(branch_id)) as lain"))
                        ->get();
            $response['data'] = $religion;
        }else{
            $religion = DB::table('v_employee_religion')
                        ->select('*')
                        ->where('branch_id',$request->branch_id)
                        ->get();
            $response['data'] = $religion;
        }
        return response()->json($response);

    }
}
