<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class ReimburseExport implements FromView
{
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        $dat = DB::table('v_reimbursement')
                    ->where('branch_id','=',$this->request->branch_id)
                    ->whereBetween('date',[$this->request->startdate,$this->request->enddate])
                    ->orderBy('date','DESC');
        $res['reimburse'] = $dat->get(); 
        $tot  = DB::table('v_reimbursement')
                    ->select(DB::raw('sum(amount) as total'))
                    ->where('branch_id','=',$this->request->branch_id)
                    ->whereBetween('date',[$this->request->startdate,$this->request->enddate]);
        $res['total'] = $tot->first(); 
        return view('pages.contents.report.reimburse.export_reimburse',$res);
    }
}
