<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessMobile;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;

class AccessMobileController extends Controller
{
    public function index(){
        $company = Company::all();
        return view('pages.contents.access_mobile',$company);
    }
    public function get_data(){
        $data = AccessMobile::select('access_mobiles.*','branches.name as branch_name')
                            ->leftJoin('branches','branches.id','=','access_mobiles.branch_id');
                            if ($request->company_id !=''){
                                $data->where('branches.company_id',$request->company_id);
                            }
                            if ($request->branch_id !=''){
                                $data->where('branches.id',$request->branch_id);
                            }
                            $data->get();
        
    }
}
