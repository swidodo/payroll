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
        $branch = Branch::find(Auth::user()->branch_id);
        return view('pages.contents.bpjs.view_data_bpjs',$branch);
    }
    public function get_data(){
        $data = DB::table('v_deduction_bpjs')->where('branch_id','=',Auth::user()->branch_id)->get();
        return DataTables::of($data)
                        ->make(true);
    }
}
