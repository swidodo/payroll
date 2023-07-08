<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;

class EmployeesExport implements FromView
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
        return view('pages.contents.employee.export-excel', [
            'employee' => Employee::whereBetween('created_at', [$this->request->start_date, $this->request->end_date])->get()
        ]);
    }
}
