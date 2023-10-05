<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Exports\RekapAttendanceExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\ReportAttendanceExport;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportRecapAttendanceController extends Controller
{
    public function index(){
        return view('pages.contents.report.report_attandance');
    }
    public function get_report_attadance(Request $request){
        $data = DB::table('v_all_attendance')
                    ->select('*')
                    ->whereBetween('date',[$request->from_date,$request->to_date])
                    ->get();
        return DataTables::of($data)->make(true);
    }
    public function attandancePrintPdf(Request $request){
        $dtl= DB::table('v_all_attendance')
                    ->select('*')
                    ->whereBetween('date',[$request->from_date,$request->to_date])
                    ->get();
        $mst = DB::table('v_all_attendance')
                    ->select('employee_id','name')
                    ->whereBetween('date',[$request->from_date,$request->to_date])
                    ->groupBy('employee_id')
                    ->groupBy('name')
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
        if ($initial == "HO"){
            $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
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
}
