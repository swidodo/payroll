<?php

namespace App\Exports;

use App\Models\AttendanceEmployee;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceEmployeeExport implements FromView
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
    //     return AttendanceEmployee::where('created_by', Auth::user()->creatorId())->whereBetween('created_at', [$request->start_date, $request->end_date])->get();
    // }

    public function view(): View
    {
        return view('pages.contents.time-management.report.attendances', [
            'attendances' => AttendanceEmployee::where('created_by', Auth::user()->creatorId())->whereBetween('created_at', [$this->request->start_date, $this->request->end_date])->get()
        ]);
    }
}
