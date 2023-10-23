<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bpjs_value;
use App\Models\Branch;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeductionBpjs extends Controller
{
    public function index(){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        if (Auth::user()->initial == "HO"){
            $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
        }else{
            $data['branch'] = Branch::find($branch->branch_id);
        }
        return view('pages.contents.bpjs.view_data_bpjs',$data);
    }
    public function get_data(Request $request){
        $data = DB::table('v_deduction_bpjs')->where('branch_id','=',$request->branch_id)->get();
        return DataTables::of($data)
                        ->make(true);
    }
}
