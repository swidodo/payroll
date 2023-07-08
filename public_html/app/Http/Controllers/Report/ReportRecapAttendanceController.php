<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
}
