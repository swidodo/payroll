<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class RekapPayrollExport implements FromView
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
         $data = DB::table('take_home_pay')->select('*')
                                            ->where('branch_id','=',$this->request->branch_id)
                                            ->where('startdate','>=',$this->request->from_date)
                                            ->where('enddate','<=',$this->request->to_date)
                                            ->get(); 
        $total = DB::table('take_home_pay')->select(DB::raw('sum(take_home_pay) as total'))
                                            ->where('branch_id','=',$this->request->branch_id)
                                            ->where('startdate','>=',$this->request->from_date)
                                            ->where('enddate','<=',$this->request->to_date)
                                            ->first();
        $dat ['pay'] = $data;
        $dat ['total'] = $total;
        return view('pages.contents.report.payroll.rekap_payroll_excel',$dat);
    }
}
