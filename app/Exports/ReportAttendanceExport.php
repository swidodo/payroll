<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class ReportAttendanceExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        $dtl= DB::table('v_all_attendance')
                    ->select('v_all_attendance.*')
                    ->leftJoin('employees','employees.id','v_all_attendance.employee_id')
                    ->where('employees.branch_id',$this->request->branch_id)
                    ->whereBetween('v_all_attendance.date',[ $this->request->from_date, $this->request->to_date])
                    ->get();
                   
        $mst = DB::table('v_all_attendance')
                    ->select('v_all_attendance.no_employee','v_all_attendance.name','v_all_attendance.employee_id')
                    ->leftJoin('employees','employees.id','v_all_attendance.employee_id')
                    ->where('employees.branch_id',$this->request->branch_id)
                    ->whereBetween('v_all_attendance.date',[ $this->request->from_date, $this->request->to_date])
                    ->groupBy('v_all_attendance.no_employee')
                    ->groupBy('v_all_attendance.employee_id')
                    ->groupBy('v_all_attendance.name')
                    ->get();
                    
        $data ['mst'] = $mst;
        $data ['dtl'] = $dtl;
        return view('pages.contents.report.export_excel.attendance_periode',$data);
    }
}
