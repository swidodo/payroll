<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\AccessBranch;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;

class AccessBranchController extends Controller
{
    public function index(){
        return view('pages.contents.access.access_branch');
    }
    public function get_data(){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $data = AccessBranch::select('access_branches.employee_id',
                                    'access_branches.employee_id',
                                    'employees.name',
                                    'branches.name as branch_name',
                                    DB::raw('count(access_branches.employee_id) as jml'))
                            ->leftJoin('employees','employees.id','access_branches.employee_id')
                            ->leftJoin('branches','branches.id','employees.branch_id')
                            ->where('access_branches.company_id',$branch->company_id)
                            ->groupBy('access_branches.employee_id',
                            'access_branches.employee_id',
                            'employees.name','branches.name')
                            ->get();
        return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
                                $btn ='';
                            if(Auth()->user()->canany(['edit access branch','delete access branch'])){
                                $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right p-2">';
                                if(Auth()->user()->can('edit access branch')){
                                    $btn .= '<a  data-id='.$row->employee_id.' class="dropdown-item edit-access-branch" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a><br />';
                                }
                                if(Auth()->user()->can('delete access branch')){
                                    $btn .= '<a data-id='.$row->employee_id.' class="dropdown-item delete-access-branch" href="#"><i class="fa fa-trash-o m-r-5"></i>Delete</a>';
                                }
                                    $btn .= '</div></div>';
                                }
                                return $btn;
                            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function create(){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $data['branch']     = Branch::where('company_id',$branch->company_id)->get();
        $data['company_id'] = $branch->company_id;
        $data['data']       = Branch::where('company_id',$branch->company_id)->get();
        return view('pages.contents.access.add_access_branch',$data);
    }
    public function get_employee(Request $request){
        $acces  = AccessBranch::where('branch_id',$request->branch_id)->first();
        if($acces != null ){
            $emp = AccessBranch::where('company_id',$acces->company_id)->get();
            $checked = [];
            foreach($emp as $employee){
                array_push($checked,$employee->employee_id);
            }
        }else{
            $checked =[];
        }
        $data = Employee::where('branch_id',$request->branch_id)->whereNotIn('id',$checked)->orderBy('name')->get();
        return response()->json($data);
    }
    public function store(Request $request){
        if ($request->branch == ''){
            $res = [
                'status' => 'info',
                'msg'    => 'Please checked access branch !'
            ];
            return response()->json($res);
        }
        $check = AccessBranch::where('employee_id',$request->employee_id)->count();

        if($check > 0){
            $res = [
                'status' => 'info',
                'msg'    => 'Employee Ready Access Branch !'
            ];
            return response()->json($res);
        }
        $data_arr = [];
        foreach($request->branch as $branch){
            $data = [
                'employee_id'  => $request->employee_id,
                'branch_id'    => $branch,
                'company_id'   => $request->company_id,
                'created_at'   => date('Y-m-d H:m:s'),
                'updated_at'   => date('Y-m-d H:m:s'),
            ];
            array_push($data_arr,$data);
        }
        $save = AccessBranch::insert($data_arr);
        if($save){
            $res = [
                'status' => 'success',
                'msg'    => 'Created Access branch Successfuly.'
            ];
        }else{
            $res = [
                'status' => 'error',
                'msg'    => 'Someting went wrong!.'
            ];
        }
        return response()->json($res);
    }
    public function edit(Request $request){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $data['data'] = AccessBranch::select('access_branches.employee_id',
                                             'access_branches.branch_id',
                                             'access_branches.company_id',
                                            'employees.name',
                                            'branches.name as branch_name',)
                                    ->leftJoin('employees','employees.id','access_branches.employee_id')
                                    ->leftJoin('branches','branches.id','employees.branch_id')
                                    ->where('access_branches.employee_id',$request->id)->get();
        $data['cabang']  = Branch::where('company_id',$branch->company_id)->get();
        return view('pages.contents.access.edit_access_branch',$data);
    }
    public function update(Request $request){
        try{
            DB::beginTransaction();
            $data = AccessBranch::where('employee_id',$request->employee_id)->get();
            $branches =[];
            foreach($data as $access){
                array_push($branches,$access->branch_id);
            }
            $uptbranch =[];
            foreach($request->branch as $branch){
                if (!in_array($branch,$branches)){
                    $data = [
                        'employee_id'  => $request->employee_id,
                        'branch_id'    => $branch,
                        'company_id'   => $request->company_id,
                        'created_at'   => date('Y-m-d H:m:s'),
                        'updated_at'   => date('Y-m-d H:m:s'),
                    ];
                    AccessBranch::insert($data);
                }
                array_push($uptbranch,$branch);
            }
            foreach($branches as $ckbranch){
                if (!in_array($ckbranch,$uptbranch)){
                    AccessBranch::where('branch_id',$ckbranch)->delete();
                }
            }
            DB::commit();
                $res = [
                    'status' => 'success',
                    'msg'    => 'Updated Access branch successfuly.'
                ];
                return response()->json($res);
        }catch (Exception $e){
            DB::rollBack();
            $res = [
                'status' => 'error',
                'msg'    => 'Someting went wrong !'
            ];
            return response()->json($res);
        }
    }
    public function destroy(Request $request){
        $del = AccessBranch::where('employee_id',$request->id)->delete();
        if($del){
            $res = [
                'status' => 'success',
                'msg'    => 'Data Access branch deleted.'
            ];
        }else{
            $res = [
                'status' => 'error',
                'msg'    => 'Someting wen wrong !.'
            ];
        }
        return response()->json($res);
    }
}
