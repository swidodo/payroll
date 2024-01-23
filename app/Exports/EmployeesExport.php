<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'employee' => Employee::select('employees.*',
                                            'departements.name as departement_name',
                                            'branches.alias as branch_code',
                                            'position_name'
                                            )
                                    ->leftJoin('branches','branches.id','=','employees.branch_id')
                                    ->leftJoin('departements','departements.id','=','employees.department_id')
                                    ->leftJoin('position','position.id','=','employees.position_id')
                                    ->leftJoin('parameter_pph21s','parameter_pph21s.code','=','employees.marital_status')
                                    // ->where(DB::raw('date(employees.created_at)'),'>=',$this->request->start_date)
                                    // ->where(DB::raw('date(employees.created_at)'),'<=', $this->request->end_date)
                                    ->where('status',$this->request->status)
                                    ->where('employees.branch_id',$this->request->branch_id)
                                    ->distinct()
                                    ->orderBy('employees.name','ASC')
                                    ->get()
        ]);
    }
}
