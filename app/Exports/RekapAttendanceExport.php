<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;


class RekapAttendanceExport implements FromView
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
        $data['attendance'] = DB::select("SELECT * FROM getattendance('".$this->request->from_date."','".$this->request->to_date."','".$this->request->branch_id."')");
        return view('pages.contents.report.attendance.rekap_attendance_excel',$data);
    }
}
