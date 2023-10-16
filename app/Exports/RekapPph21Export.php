<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class RekapPph21Export implements FromView
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
        $data = DB::table('rekap_pph21s')->select('rekap_pph21s.*','employees.name','employees.no_employee',,'position.position_name')
                                            ->leftJoin('employees','employees.id','=','rekap_pph21s.employee_id')
                                            ->leftJoin('position','position.id','=','employees.position_id')
                                            ->where('rekap_pph21s.branch_id','=',$this->request->branch_id)
                                            ->where('rekap_pph21s.startdate','>=',$this->request->from_date)
                                            ->where('rekap_pph21s.enddate','<=',$this->request->to_date)
                                            ->get(); 
        $total = DB::table('rekap_pph21s')->select(DB::raw('sum(pph21_terhutang_1_bulan) as total'))
                                            ->where('branch_id','=',$this->request->branch_id)
                                            ->where('startdate','>=',$this->request->from_date)
                                            ->where('enddate','<=',$this->request->to_date)
                                            ->first();
        $dat ['pph'] = $data;
        $dat ['total'] = $total;
        return view('pages.contents.report.rekap_pph21s.rekap_pph21_excel',$dat);
    }
}
