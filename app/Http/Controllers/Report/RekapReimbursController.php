<?php

namespace App\Http\Controllers\Report;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\AccessBranch;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReimburseExport;

class RekapReimbursController extends Controller
{
    public function index(){
        $user = Auth::user();
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $emp = Employee::where('user_id',Auth::user()->id)->first();
        if (Auth::user()->initial == "HO"){
            if (Auth::user()->type == "company"){
                $branch['branch'] = Branch::where('company_id',$branch->company_id)->get();
            }else{
                $branch['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                ->where('access_branches.employee_id',$emp->id)
                                                ->where('access_branches.company_id',$branch->company_id)->get();
            }
        }else{
            $branch['branch'] = Branch::where('id',$branch->id)->get();
        }
        return view('pages.contents.report.reimburse.index',$branch);
    }
    public function get_data(Request $request){
        $data = DB::table('v_reimbursement')
                ->where('branch_id',$request->branch_id);
                if($request->startdate != null & $request->enddate != null){
                    $data->whereBetween('date',[$request->startdate,$request->enddate]);
                }
                $data->orderBy('date','DESC');
        return Datatables::of($data->get())->make(true);
    }
    public function ExportExcel(Request $request){
        $date = date('Ymd');
        $fileName = 'reimbursement-report_'.$date.'.xlsx';
        return Excel::download(new ReimburseExport($request), $fileName);
    }
    
}
