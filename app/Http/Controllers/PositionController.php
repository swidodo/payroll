<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Position;
use App\Models\Branch;

class PositionController extends Controller
{
    public function index(){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $emp = Employee::where('user_id',Auth::user()->id)->first();
        
        if (Auth::user()->initial == "HO"){
            if (Auth::user()->type == "company"){
                $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
            }else{
                $data['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                ->where('access_branches.employee_id',$emp->id)
                                                ->where('access_branches.company_id',$branch->company_id)->get();
            }
        }else{
            $data['branch'] = Branch::where('id',$branch->id)->get();
        }
        return view('pages.contents.position.index',$data);
    }
     public function get_data(Request $request){
        try {
            // $branch = Auth::user()->branch_id;
            $group   = Position::select('position.*','branches.name as branch_name')->leftJoin('branches','branches.id','=','position.branch_id')->WHERE('branch_id',$request->branch_id)->get();
            return DataTables::of($group)
                            ->addColumn('action', function ($d) {
                        $view = '';
                        if (Auth()->user()->canany('manage position','edit position','delete position')){
                        $view = '<td class="text-end" >
                                            <div class="dropdown dropdown-action" >
                                                <a href ="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons"> more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">';
                            /** edit */
                            if (Auth()->user()->can('edit position')){
                                $view .= '<a href="#" data-id = "'.$d->id.'" class="dropdown-item edit-position"><i class="fa fa-pencil m-r-5" ></i> Edit</a>';
                            }
                            if (Auth()->user()->can('delete position')){
                                /** delete */
                                $view .= '<a data-id="'.$d->id.'" class="dropdown-item delete-position" href="#"><i class="fa fa-trash-o m-r-5"></i>Delete</a>';
                            }
                            /** delete */
                            $view .= '</div></div></td>';
                        }
                    return $view;
                })
                ->rawColumns(['action'])
                ->make(true);
            } catch (Throwable $e) {
                /** error response */
                $response = response()->json([
                    'draw'            => 0,
                    'recordsTotal'    => 0,
                    'recordsFiltered' => 0,
                    'data'            => [],
                    'error'           => $e->getMessage(),
                ]);
            }
            return $response;
        }
    public function create(Request $request){
         $initial = Auth::user()->initial;
        if ($initial == "HO"){
            $companyId = Branch::select('company_id')->where('id',Auth::user()->branch_id)->first();
            $emp = Employee::where('user_id',Auth::user()->id)->first();
            if (Auth::user()->type == "company"){
                $data['branch'] = Branch::where('company_id',$companyId->company_id)->get();
            }else{
                $data['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                ->where('access_branches.employee_id',$emp->id)
                                                ->where('access_branches.company_id',$companyId->company_id)->get();
            }
        }else{
            $data['branch'] = Branch::where('id',Auth::user()->branch_id)->get();
        }
        return response()->json($data);
    }
    public function store(Request $request){
        {
            
            try {
                $checkPosition = Position::where('position_code',$request->position_code)->where('branch_id',$request->branch_id)->count();
                if($checkPosition > 0 ){
                    $res = [
                        'status' => 'error',
                        'msg'    => 'Position code ready !'
                    ];
                    return response()->json($res);
                }
                DB::beginTransaction();

                $data = [
                    'position_code'     =>$request->position_code,
                    'position_name'     =>$request->position_name,
                    'branch_id'         =>$request->branch_id,
                    'description'       =>$request->description,
                    'create_by'         =>Auth::user()->creatorId()
                ];

                Position::Insert($data);
                DB::commit();
                $res = [
                    'status' => 'success',
                    'msg'    => 'Position successfully created !'
                ];
                return response()->json($res);

            } catch (Exception $e) {
                DB::rollBack();
                 $res = [
                    'status' => 'error',
                    'msg'    => 'Something went wrong !'
                ];
                return response()->json($res);
            }
    }
    }
    public function edit(Request $request){
        $data['data'] = Position::select('position.*','branches.name as branch_name')->where('position.id',$request->id)->leftJoin('branches','branches.id','=','position.branch_id')->first();
        return response()->json($data);
    }
    public function update(Request $request){
         try {
            DB::beginTransaction();
            $data = [
                'position_name'    => $request->position_name,
                'description'      => $request->description
            ];
            Position::where('id', $request->id)->update($data);

            DB::commit();
             $res = [
                    'status' => 'success',
                    'msg'    => 'Position successfully updated !'
                ];
                return response()->json($res);
        } catch (Exception $e) {
            DB::rollBack();
             $res = [
                    'status' => 'error',
                    'msg'    => 'Something went wrong !'
                ];
                return response()->json($res);
        }
    }
    public function destroy(Request $request){
        try{
             $del = Position::destroy($request->id);
             $res = [
                    'status' => 'success',
                    'msg'    => 'Position Successfully Deleted !'
                ];
            return response()->json($res);
        }catch(Exception $e){
            $res = [
                    'status' => 'error',
                    'msg'    => 'Somting went wrong !'
                ];
                return response()->json($res);
        }
    }
}

