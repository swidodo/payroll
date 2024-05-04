<?php

namespace App\Http\Controllers\Report;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\AccessBranch;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapPayrollExport;

class RekapPayrollController extends Controller
{
    public function index(){
        $initial = Auth::user()->initial;
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $emp = Employee::where('user_id',Auth::user()->id)->first();
        
        if ($initial == "HO"){
            if (Auth::user()->type == "company"){
                $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
            }else{
                $data['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                ->where('access_branches.employee_id',$emp->id)
                                                ->where('access_branches.company_id',$branch->company_id)->get();
            }
        }else{
            $data['branch'] = $branch = Branch::where('id',Auth::user()->branch_id)->get();
        }
        return view('pages.contents.report.payroll.rekap_payroll',$data);
    }
    public function get_rekap_payroll(Request $request){
        $data = DB::table('take_home_pay')->select('take_home_pay.*','position.position_name')
                                        ->leftJoin('position','position.id','=','take_home_pay.position_id')
                                        ->where('take_home_pay.branch_id','=',$request->branch_id);
                                        if ($request->start_date !== null && $request->end_date !== null){
                                            $data->where('take_home_pay.startdate','>=',$request->start_date);
                                            $data->where('take_home_pay.enddate','<=',$request->end_date);
                                        }
                                        $data->get();
        return DataTables::of($data)->make(true);
    }
    public function cetak_pdf(Request $request){
        $date = date('Ymd');
         if ($request->from_date !== null && $request->to_date !== null){
            $data = DB::table('take_home_pay')->select('take_home_pay.*','position.position_name')
                                            ->leftJoin('position','position.id','=','take_home_pay.position_id')
                                            ->where('take_home_pay.branch_id','=',$request->branch_id)
                                            ->where('take_home_pay.startdate','>=',$request->from_date)
                                            ->where('take_home_pay.enddate','<=',$request->to_date)
                                            ->get(); 
            $total = DB::table('take_home_pay')->select(DB::raw('sum(take_home_pay) as total'))
                                            ->where('branch_id','=',$request->branch_id)
                                            ->where('startdate','>=',$request->from_date)
                                            ->where('enddate','<=',$request->to_date)
                                            ->first();
        }
        $dat['branch']      = Branch::where('id',$request->branch_id)->first();
        $dat['start_date']  = $request->from_date;
        $dat['end_date']    = $request->to_date;
        $dat['pay']         = $data;                           
        $dat['total']       = $total;                           
        $pdf = PDF::loadview('pages.contents.report.payroll.rekap_payroll_pdf',$dat)->setPaper('A3','landscape');
        ob_get_clean();
        return $pdf->stream('Rekap_payroll_'.$date.'');
    }
    public function ExportExcel(Request $request){
        $date = date('Ymd');
        $fileName = 'Rekap_payroll_'.$date.'.xlsx';
        return Excel::download(new RekapPayrollExport($request), $fileName);
    }
    // public function export_bank_payroll(Request $request){

    // }
    
}
