<?php

namespace App\Exports;

use App\Models\Overtime;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class OvertimeExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($request)
    {
        $this->request = $request;
    }

    // public function collection()
    // {
    //     return Overtime::all();
    // }

    public function view(): View
    {
        return view('pages.contents.time-management.report.overtimes', [
            'overtimes' => DB::table('v_data_overtimes')
                                ->where('branch_id',Auth::user()->branch_id)
                                ->whereBetween('start_date',[$this->request->start_date, $this->request->end_date])
                                ->get()
            // 'overtimes' => Overtime::where('created_by', Auth::user()->creatorId())->whereBetween('created_at', [$this->request->start_date, $this->request->end_date])->get()
        ]);
    }
}
