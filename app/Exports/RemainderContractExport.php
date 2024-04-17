<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;
class RemainderContractExport implements FromView
{
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        $data = DB::table('v_remainder_contracts')
                ->where('branch_id',$this->request->branch_id)
                ->where('remainder','<=',60)
                ->where('status','active')
                ->whereIn('status_contract',['EXPIRED CONTRACT','AVAILABLE'])
                ->orderBy('employee_name','ASC');
                if ($this->request->branch_id !=''){
                    $data->where('branch_id',$this->request->branch_id);
                }
                if($this->request->startdate !='' & $this->request->enddate !=''){
                    $data->whereBetween(DB::raw('date(update_at)',[$this->request->startdate,$this->request->enddate]));
                }
        $res['contract'] = $data->get();
        return view('pages.contents.report.turnover.export_remainder_contract',$res);
    }
}
