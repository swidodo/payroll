<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Loan;

class LoanExport implements FromCollection
{
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        
        return view('pages.contents.report.daily_report.export_daily_report',$res);
    }
}
