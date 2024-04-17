<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class DailyReportExport implements FromView
{
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
         $data = DB::table('v_rekap_daily_report')
                    ->where('branch_id','=',$this->request->branch_id)
                    ->whereBetween('date',[$this->request->startdate,$this->request->enddate]);
                    if($this->request->department_id !='all'){
                        $data->where('department_id',$this->request->department_id);
                    }
                    if ($this->request->employee_id !='all'){
                        $data->where('department_id',$this->request->employee_id);
                    }
        $res['daily'] = $data->get(); 
        return view('pages.contents.report.daily_report.export_daily_report',$res);
    }
}
