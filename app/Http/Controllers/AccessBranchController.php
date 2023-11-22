<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\AccessBranch;

class AccessBranchController extends Controller
{
    public function index(){
        return view('pages.content.access.access_branch');
    }
    public function get_data(){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $data = AccessBranch::select('access_branch.*','employees.name','branches.name as branch_name')
                            ->leftJoin('employees','employees.id','access_branch.employee_id')
                            ->leftJoin('branches','branches.id','access_branch.branch_id')
                            ->where('company_id',$branch->id)
                            ->get();
        return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
                                $btn ='';
                                if(Auth()->user()->canany('edit allowance','delete allowance')){
                                    $btn .= '<div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">';
                                    if(Auth()->user()->can('edit allowance')){
                                        $btn .= '<a  data-id='.$row->id.' class="dropdown-item edit-allowance-other" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                    }
                                    if(Auth()->user()->can('delete allowance')){
                                        $btn .= '<a data-id='.$row->id.' class="dropdown-item delete-allowance-other" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                    }
                                        
                                }
                                return $btn;
                            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function create(){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $data = Branch::where('company_id',$branch->company_id)->get();
        return response()->json($data);
    }
    public function store(Request $request){
    
    }
    public function update(Request $request){

    }
    public function destroy(Request $request){

    }
}
