<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use App\Models\Employee;
class RequestController extends Controller
{
    public function index(){
        $userInitial = Auth::user()->initial;
        $data = '';
        if ($userInitial != null){
            if ($userInitial == 'HO'){
                $branch = Branch::select('id_company')->where('id', Auth::user()->branch_id)->first(); 
                $branchCompany = Branch::select('id','name')->where('company_id',$branch->company_id)->get();
                $data['branch'] = $branchCompany;
            }else{
                 $data['branch'] = Branch::select('id','name')->where('id',Auth::user()->branch_id)->fist();
            }
        }else{
            $data = [
                'status' => 'success',
                'msg'    => 'Branch Nothing IN employee !'
            ];
        }
        
        return view('pages.contents.request.index',$data);
    }
    public function get_data(){
        // $data = DB::()
    }
    public function create(){
        $user = Auth::user()->initial;
        if ($user == "HO"){
            $branch = Branch::where('id',Auth::user()->branch_id)->first();
            $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
            $data['employee'] = Employee::where('branch_id',Auth::user()->branch_id)->get();
        }else{
            $data['branch'] = Branch::where('id',Auth::user()->branch_id)->get();
            $data['employee'] = Employee::where('user_id',Auth::user()->id)->get();
        }
        return view('pages.contents.request.create',$data);
    }
}
