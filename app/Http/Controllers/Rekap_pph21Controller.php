<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Rekap_pph21;
use Illuminate\Support\Facades\DB;

class Rekap_pph21Controller extends Controller
{
    public function index(){
        $user = Auth::user();
        if ($user->initial == "HO"){
            $branchId           = Branch::where('id',$user->branch_id)->first();
            $branch['branch']   = Branch::where('company_id',$branchId->company_id)->get();
        }else{
            $branch['branch']   = Branch::where('id',$user->branch_id)->get();
        }
        return view('pages.contents.rekap_pph21.index', $branch);
    }
    public function get_pph21(Request $request){
        $data   = Rekap_pph21::select('rekap_pph21s.*','employees.name','employees.no_employee')
                                ->leftJoin('employees','employees.id','=','rekap_pph21s.employee_id')
                                ->where('rekap_pph21s.branch_id','=',$request->branch_id)
                                ->where('rekap_pph21s.startdate','>=',$request->startdate)
                                ->where('rekap_pph21s.enddate','<=',$request->enddate)
                                ->get();
        return DataTables::of($data)->make(true);
    }
}
