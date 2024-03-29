<?php

namespace App\Exports;

use App\Models\Leave;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class LeaveExport implements FromView
{
  
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        return view('pages.contents.time-management.report.leave', [
            'leaves' => Leave::where('branch_id', Auth::user()->branch_id)->whereBetween('created_at', [$this->request->start_date, $this->request->end_date])->get()
        ]);
    }
}
