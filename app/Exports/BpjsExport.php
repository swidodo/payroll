<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class BpjsExport implements FromView
{
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        $dat = $data = DB::table('v_deduction_bpjs')->where('branch_id','=',$this->request->branch_id);
        $res['bpjs'] = $dat->get(); 
        $tot  = DB::table('v_deduction_bpjs')
                    ->select(DB::raw('SUM(total_bpjs) as total'))
                    ->where('branch_id','=',$this->request->branch_id);
        $res['total'] = $tot->first(); 
        return view('pages.contents.report.bpjs.export_rekap_bpjs',$res);
    }
}
