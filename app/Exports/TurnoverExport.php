<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Employee;
class TurnoverExport implements FromView
{
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $emp = Employee::where('user_id',Auth::user()->id)->first();
        if(Auth::user()->initial =="HO"){
            if (Auth::user()->type == "company"){
                $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
            }else{
                $data['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                ->where('access_branches.employee_id',$emp->id)
                                                ->where('access_branches.company_id',$branch->company_id)->get();
            }
        }else{
            $data['branch'] = Branch::where('id',$branch->id)->get();
        }
        $data['brch'] = Branch::where('id',$this->request->branch_id)->first();
        $bchid = $this->request->branch_id;
        $to_date = $this->request->to_date;
        $from_date = $this->request->from_date;
        $data['out'] = DB::SELECT("SELECT branch_id,
                                        branch_name,
                                        status, 
                                        count(status) as total
                                    FROM v_remainder_contracts WHERE branch_id = '$bchid' and status <> 'active'
                                    AND date(updated_at) BETWEEN '$from_date' AND '$to_date'
                                    GROUP BY status, branch_id,branch_name");
        $data['active'] = DB::SELECT("SELECT branch_id,
                                        'EMPLOYEE - ACTIVE' as active, 
                                        count(status) as total
                                    FROM employees 
                                    WHERE branch_id = '$bchid' and status ='active'
                                    GROUP BY status, branch_id");
        $data['permanent'] = DB::SELECT("SELECT branch_id,
                                        'EMPLOYEE - PERMANENT' as permanent, 
                                        count(status) as total
                                    FROM employees 
                                    WHERE branch_id = '$bchid' and status ='active' and UPPER(employee_type) ='PERMANENT'
                                    GROUP BY status, branch_id");
        $data['in'] = DB::SELECT("SELECT branch_id,branch_name,
                                    'EMPLOYEE - JOIN' as join, 
                                    count(status) as total
                                    FROM v_remainder_contracts 
                                    WHERE status = 'active' 
                                    and branch_id = '$bchid'
                                    AND date(created_at) BETWEEN '$from_date' AND '$to_date'
                                    GROUP BY status, branch_id,branch_name");
                                    // dd($data);
        return view('pages.contents.report.turnover.export_turnover',$data);
    }
}
