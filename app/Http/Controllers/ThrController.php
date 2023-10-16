<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ThrController extends Controller
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
        
        return view('pages.contents.thr.index',$data);
    }
}
