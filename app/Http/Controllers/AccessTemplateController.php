<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessTemplate;
use App\Models\Company;
use App\Models\Branch;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;

class AccessTemplateController extends Controller
{
    public function index(){
        $data['company'] = Company::All();
        return view('pages.contents.template.index',$data);
    }
    public function get_data(Request $request){
        $data = AccessTemplate::select('access_templates.*','branches.name as branch_name','companies.name as company_name')
                                ->leftJoin('branches','branches.id','=','access_templates.branch_id')
                                ->leftJoin('companies','companies.id','=','access_templates.company_id');
                                if ($request->branch_id !='all'){
                                    $data->where('access_templates.branch_id',$request->branch_id);
                                }
                                $data->where('access_templates.company_id',$request->company_id);
                                $data->get();
        return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
                                $btn ='';
                                if(Auth()->user()->canany(['edit access branch','delete access branch'])){
                                    $btn .= '<div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right p-2">';
                                    if(Auth()->user()->can('edit access branch')){
                                        $btn .= '<a  data-id='.$row->branch_id.' class="dropdown-item edit-access-template" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a><br />';
                                    }
                                        $btn .= '</div></div>';
                                    }
                                    return $btn;
                                })
                ->rawColumns(['action'])
                ->make(true);
    }
    public function get_branch(Request $request){
        $data = Branch::where('company_id',$request->company_id)->get();
        return response()->json($data);
    }
    public function create(){
        $data['company'] = Company::All();
        return view('pages.contents.template.create',$data);
    }
    public function store(Request $request){
        if ($request->template == null){
            $res = [
                'status' =>'info',
                'msg' => 'Please checked access!'
            ];
            return response()->json($res);
        }
        $check = AccessTemplate::where('company_id',$request->company_id)->where('branch_id',$request->branch_id)->count();
        if($check > 0){
            $res = [
                'status' =>'info',
                'msg' => 'Access template to branch already!'
            ];
            return response()->json($res);
        }
        $data = [
            'company_id' => $request->company_id,
            'branch_id' => $request->branch_id,
            'versi' => $request->template,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ];
        $save = AccessTemplate::insert($data);
        if ($save){
            $res = [
                'status' =>'success',
                'msg' => 'Created Access template successfuly !'
            ]; 
        }else{
            $res = [
                'status' =>'error',
                'msg' => 'Someting went wrong !'
            ];
        }
        return response()->json($res);
    }
    public function edit(Request $request){
        $data['data'] = AccessTemplate::select('access_templates.*','branches.name as branch_name','companies.name as company_name')
                                        ->leftJoin('branches','branches.id','=','access_templates.branch_id')
                                        ->leftJoin('companies','companies.id','=','access_templates.company_id')
                                        ->where('access_templates.branch_id',$request->id)
                                        ->first();
        return view('pages.contents.template.edit',$data);
    }
    public function update(Request $request){
        if ($request->template == null){
            $res = [
                'status' =>'info',
                'msg' => 'Please checked access!'
            ];
            return response()->json($res);
        }
        
        $data = [
            'versi' => $request->template,
            'updated_at' => date('Y-m-d H:m:s'),
        ];
        $update = AccessTemplate::where('company_id',$request->company_id)->where('branch_id',$request->branch_id)->update($data);
        if ($update){
            $res = [
                'status' =>'success',
                'msg' => 'Update Access template successfuly !'
            ]; 
        }else{
            $res = [
                'status' =>'error',
                'msg' => 'Someting went wrong !'
            ];
        }
        return response()->json($res);
    }
    public function get_template_branch(Request $request){
        $data = AccessTemplate::where('branch_id',$request->branch_id)
                                        ->first();
        return response()->json($data);
    }
}
