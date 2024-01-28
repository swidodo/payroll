<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Departement;
use App\Models\Employee;
use DataTables;
class DailyReportController extends Controller
{
    public function index(){
        $depart['department'] = Departement::select('id','name')->where('branch_id',Auth::user()->branch_id)->groupBy('id','name')->get();
        return view('pages.contents.report.daily_report.index', $depart);
    }
    public function get_data(Request $request){

        $data = DB::table('v_daily_reports')
                    ->select('v_daily_reports.date',
                    'v_daily_reports.time',
                    'v_daily_reports.location_name',
                    'v_daily_reports.employee_id',
                    'v_daily_reports.foto_url',
                    'v_daily_reports.branch_id',
                    'employees.name as employee_name')
                    ->leftJoin('employees','employees.id','=','v_daily_reports.employee_id')
                    ->where('v_daily_reports.department_id',$request->department_id);
                    if ($request->startdate != "" && $request->enddate != ""){
                        $data->whereBetween('v_daily_reports.date',[$request->startdate,$request->enddate]);
                    }
                    if ($request->employee_id != ""){
                        $data->where('v_daily_reports.employee_id',$request->employee_id);
                    }
                    $data->orderBy('date','DESC');
                    $data->get();
        return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('view_map', function($row){
                            $btn = '<a  class="btn btn-primary w-100" href="maps?id='.$row->employee_id.'&branch='.$row->branch_id.'&date='.$row->date.'" target="_blank">map view</a>';
                        return $btn;
                        })
                    ->rawColumns(['view_map'])
                    ->make(true);
    }
    public function get_employee(Request $request){
        $data = Employee::where('department_id',$request->department_id)->get();
    }
    public function view_maps(Request $request){
        $data = DB::table('daily_report_details')
                    ->select('daily_report_details.latitude','daily_report_details.longitude','employees.name')
                    ->leftJoin('employees','employees.id','daily_report_details.employee_id')
                    ->where('daily_report_details.employee_id', $request->id)
                    ->where('daily_report_details.branch_id', $request->branch)
                    ->where('daily_report_details.date', $request->date)
                    ->get();
                   
        $initialMarkers = [];
        foreach($data as $loglat){
            $loc = [
                'position' => [
                    'lat' => $loglat->longitude,
                    'lng' => $loglat->latitude
                ],
                'draggable' => true,
                'name' => $loglat->name
            ];
            if (!in_array($loc,$initialMarkers)){
                array_push($initialMarkers,$loc);
            }
        }
        return view('pages.contents.report.daily_report.maps', compact('initialMarkers'));
    }
}
