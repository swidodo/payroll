<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\AccessBranch;
use App\Exports\RekapAttendanceExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\ReportAttendanceExport;
use App\Exports\TimesheetAttendanceExport;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportRecapAttendanceController extends Controller
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
        return view('pages.contents.report.report_attandance',$data);
    }
    public function get_report_attadance(Request $request){
        $data = DB::table('v_all_attendance')
                    ->select('v_all_attendance.*')
                    ->leftJoin('employees','employees.id','v_all_attendance.employee_id')
                    ->where('employees.branch_id',$request->branch_id)
                    ->whereBetween('v_all_attendance.date',[$request->from_date,$request->to_date])
                    ->get();
        return DataTables::of($data)->make(true);
    }
    public function attandancePrintPdf(Request $request){
        $dtl= DB::table('v_all_attendance')
                    ->select('v_all_attendance.*')
                    ->leftJoin('employees','employees.id','v_all_attendance.employee_id')
                    ->where('employees.branch_id',$request->branch_id)
                    ->whereBetween('v_all_attendance.date',[$request->from_date,$request->to_date])
                    ->get();
        $mst = DB::table('v_all_attendance')
                    ->select('v_all_attendance.no_employee','v_all_attendance.name','v_all_attendance.employee_id')
                    ->leftJoin('employees','employees.id','v_all_attendance.employee_id')
                    ->where('employees.branch_id',$request->branch_id)
                    ->whereBetween('v_all_attendance.date',[$request->from_date,$request->to_date])
                    ->groupBy('v_all_attendance.no_employee')
                    ->groupBy('v_all_attendance.employee_id')
                    ->groupBy('v_all_attendance.name')
                    ->get();
        $data ['mst'] = $mst;
        $data ['dtl'] = $dtl;
        $pdf = PDF::loadview('pages.contents.report.export_pdf.attendance_periode',$data);
        ob_get_clean();
        return $pdf->stream();
    }
    public function attandanceExportExcel(Request $request){
        $date = date('YYYYmmdd');
        $fileName = 'Report_Attandance_'.$date.'.xlsx';
        return Excel::download(new ReportAttendanceExport($request), $fileName);
    }
    public function rekap_attendance(){
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
        return view('pages.contents.report.attendance.rekap_attendance',$data);
    }
    public function get_rekap_attendance(Request $request){
        $data = DB::select("SELECT * FROM getattendance('".$request->startdate."','".$request->enddate."','".$request->branch_id."')");
        return DataTables::of($data)->make(true);
    }
    public function cetak_rekap_attendance_pdf(Request $request){
        $date = date('Ymd');
        $data['branch']          = Branch::where('id',$request->branch_id)->first();
        $data['start_date']     = $request->from_date;
        $data['end_date']       = $request->to_date;
        $data['attendance']     = DB::select("SELECT * FROM getattendance('".$request->from_date."','".$request->to_date."','".$request->branch_id."')");
        $pdf = PDF::loadview('pages.contents.report.attendance.rekap_attendance_pdf',$data)->setPaper('A3','portrait');
        ob_get_clean();
        return $pdf->stream('Rekap_attendance_'.$date.'');
    }
     public function ExportExcel(Request $request){
        $date = date('Ymd');
        $fileName = 'Rekap_attendance_'.$date.'.xlsx';
        return Excel::download(new RekapAttendanceExport($request), $fileName);
    }
    public function ExportTimesheeAttenndance(Request $request){
        $date = date('Ymd');
        $fileName = 'Timesheet_attendance_'.$date.'.xlsx';
        return Excel::download(new TimesheetAttendanceExport($request), $fileName);
    }
}
