<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessMobile;
use App\Models\Company;
use App\Models\Menu;
use App\Models\Branch;
use DataTables;
use Exception;
use Illuminate\Support\Facades\DB;

class AccessMobileController extends Controller
{
    public function index(){
        $data['company'] = Company::all();
        return view('pages.contents.access_mobile.index',$data);
    }
    public function get_data(Request $request){
        $data = AccessMobile::select('access_mobiles.*','menus.name as menu_name','branches.name as branch_name')
                            ->leftJoin('menus','menus.id','=','access_mobiles.menu_id')
                            ->leftJoin('branches','branches.id','=','access_mobiles.branch_id')
                            ->where('branches.company_id',$request->company_id)
                            ->where('branches.id',$request->branch_id)
                            ->get();
        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                                $btn ='';
                            if(Auth()->user()->canany(['edit access mobile','delete access mobile'])){
                                $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right p-2">';
                                if(Auth()->user()->can('edit access mobile')){
                                    $btn .= '<a  data-id='.$row->branch_id.' class="dropdown-item edit-access-mobile" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                }
                                if(Auth()->user()->can('delete access mobile')){
                                    $btn .= '<a data-id='.$row->branch_id.' class="dropdown-item delete-access-mobile" href="#"><i class="fa fa-trash-o m-r-5"></i>Delete</a>';
                                }
                                    $btn .= '</div></div>';
                                }
                                return $btn;
                            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function create(){
        $data['company']    = Company::all();
        $data['access']     = Menu::all();
        return view('pages.contents.access_mobile.add_access_mobile',$data);
    }
    public function get_branch(Request $request){
        $data = Branch::where('company_id',$request->company_id)
                        // ->where('branch_id')
                        ->get();
        return response()->json($data);
    }
    public function get_branch_filter(Request $request){
        $data = Branch::where('company_id',$request->company_id)
                        ->get();
        return response()->json($data);
    }
    public function store_menu(Request $request){
        $data = [
            'name' => $request->menu_name,
        ];
        $save = Menu::create($data);
        if ($save){
            $res = [
                'status' =>'success',
                'msg'    => 'Create Access Mobile Successfuly.'
            ];
        }else{
            $res = [
                'status' =>'error',
                'msg'    => 'Someting went wrong!'
            ]; 
        }
        return response()->json($res);
    }
    public function store_accessMenu(Request $request){
        $menu = [];
        foreach($request->menu_id as $id){
            $data = [
                'menu_id'   => $id,
                'branch_id' => $request->branch_id,
                'status'    => 1,
                'created_at'=> date('Y-m-d H:m:s'),
                'updated_at'=> date('Y-m-d H:m:s')
            ];
            if (!in_array($data,$menu)) :
                array_push($menu,$data);
            endif;
        }
        $save = AccessMobile::insert($menu);
        if ($save){
            $res = [
                'status' =>'success',
                'msg'    => 'Create Access Mobile Successfuly.'
            ];
        }else{
            $res = [
                'status' =>'error',
                'msg'    => 'Someting went wrong!'
            ]; 
        }
        return response()->json($res);
    }
    public function edit(Request $request){
        $data['data'] = Branch::select('branches.*','companies.id as company_id','companies.name as company_name')
                                ->leftJoin('companies','companies.id','=','branches.company_id')
                                ->where('branches.id',$request->id)->first();
        $data['access'] = DB::select("SELECT a.id,a.name,
                                    (SELECT status FROM access_mobiles 
                                        WHERE branch_id ='$request->id' 
                                        AND menu_id = a.id) AS status
                                        FROM menus a");
                                        // dd($data);
        return view('pages.contents.access_mobile.edit_access_mobile',$data);
    }
    public function update(Request $request){
        try {
            DB::beginTransaction();
                $menu = [];
                foreach($request->menu_id as $id){
                    $data = [
                        'menu_id'   => $id,
                        'branch_id' => $request->branch_id,
                        'status'    => 1,
                        'created_at'=> date('Y-m-d H:m:s'),
                        'updated_at'=> date('Y-m-d H:m:s')
                    ];
                    if (!in_array($data,$menu)) :
                        array_push($menu,$data);
                    endif;
                }
                $del = AccessMobile::where('branch_id',$request->branch_id)->delete();
                if ($del) {
                    $save = AccessMobile::insert($menu);
                }
            DB::commit();
                $res = [
                    'status' =>'success',
                    'msg'    => 'Update Access Mobile Successfuly.'
                ];
                return response()->json($res);
        } catch (Exception $e) {
            DB::rollBack();
                $res = [
                    'status' => 'error',
                    'msg'    => 'Someting went wrong!',
                ];
                return response()->json($res);
        }
    }
    public function destroy(Request $request){
        $del = AccessMobile::where('branch_id',$request->id)->delete();
        if($del){
            $res = [
                'status' => 'success',
                'msg'    => 'Data success deleted!',
            ];
        }else{
            $res = [
                'status' => 'success',
                'msg'    => 'Data not success deleted!',
            ];
        }
        return response()->json($res);
    }
}
