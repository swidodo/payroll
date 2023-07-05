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
                    ->select('*')
                    ->whereBetween('date',[ $this->request->from_date, $this->request->to_date])
                    ->get();
        $mst = DB::table('v_all_attendance')
                    ->select('employee_id','name')
                    ->whereBetween('date',[ $this->request->from_date, $this->request->to_date])
                    ->groupBy('employee_id')
                    ->groupBy('name')
                    ->get();
        $data ['mst'] = $mst;
        $data ['dtl'] = $dtl;
        return view('pages.contents.report.export_excel.attendance_periode',$data);
    }
}
