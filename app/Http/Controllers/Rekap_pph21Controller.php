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
        $branch['branch'] = Branch::where('id',$user->branch_id)->get();
        return view('pages.contents.rekap_pph21.index', $branch);
    }
    public function get_pph21(Request $request){
        $branch  = Auth::user()->branch_id;
        $branch = Branch::where('id',$branch)->first();
        $data   = Rekap_pph21::where('branch_id','=',$branch->id);
        if ($request->employee_id !=""){
            $data->where('employee_id','=',$request->employee_id);
        }
        if($request->date !=""){
            $data->where('date','=',$request->date);
        }
        $data->with('employees')->get();
        return DataTables::of($data)->make(true);
    }
}
