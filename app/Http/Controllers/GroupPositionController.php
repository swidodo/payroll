<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupPositionModel;
use App\Models\Branch;
use App\Models\Departement;
use App\Models\Position;
use App\Models\Employee;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupPositionController extends Controller
{
    public function index(){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        if (Auth::user()->initial == "HO"){
            $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
        }else{
            $data['branch'] = Branch::where('id',$branch->id)->get();
        }
        return view('pages.contents.group_position.index',$data);
    }
    public function get_data(Request $request){
        try {
            $group   = GroupPositionModel::select('group_positions.*','employees.name as employee_name','branches.name as branch_name','departements.departement_code','departements.name as departement_name','position.position_name')->where('group_positions.branch_id', Auth::user()->branch_id)->leftJoin('branches','branches.id','=','group_positions.branch_id')->leftJoin('departements','departements.id','=','group_positions.departement_id')->leftJoin('employees','employees.id','=','group_positions.employee_id')->leftJoin('position','position.id','=','group_positions.position_id')->get();
            return DataTables::of($group)
                            ->addColumn('action', function ($d) {
                        $view = '';
                        if(Auth()->user()->canany('edit group position','delete group position')){
                            $view = '<td class="text-end" >
                                            <div class="dropdown dropdown-action" >
                                                <a href ="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons"> more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">';
                            /** edit */
                            $view .= '<a href="#" data-id = "'.$d->id.'" class="dropdown-item edit-group-position"><i class="fa fa-pencil m-r-5" ></i> Edit</a>';
                            /** delete */
                            $view .= '<a data-id="'.$d->id.'" class="dropdown-item delete-group-position" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
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
            $companiId = Branch::select('company_id')->where('id',Auth::user()->branch_id)->first();
            $data['branch'] = Branch::where('company_id',$companyId)->get();
        }else{
            $data['branch'] = Branch::where('id',Auth::user()->branch_id)->get();
            $data['position'] = Position::where('branch_id',Auth::user()->branch_id)->get();
            $data['employee'] = Employee::where('branch_id',Auth::user()->branch_id)->get();
            $data['departement'] = Departement::where('branch_id',Auth::user()->branch_id)->get();
        }
        return response()->json($data);
    }
    public function get_option(Request $request){
        $data['employee'] = Employee::where('branch_id',$request->branch_id)->get();
        $data['position'] = Position::where('branch_id',$request->branch_id)->get();
        $data['departement'] = Departement::where('branch_id',$request->branch_id)->get();
        return response()->json($data);
    }
    public function store(Request $request){
        {
    
            try {
                DB::beginTransaction();

                $data = [
                    'departement_id'     =>$request->departement_id,
                    'position_id'        =>$request->position_id,
                    'branch_id'          =>$request->branch_id,
                    'employee_id'        =>$request->employee_id,
                    'create_by'          =>Auth::user()->creatorId()
                ];

                GroupPositionModel::Insert($data);
                DB::commit();
                $res = [
                    'status' => 'success',
                    'msg'    => 'Group Position successfully created !'
                ];
                return response()->json($res);

            } catch (Exception $e) {
                DB::rollBack();
                 $res = [
                    'status' => 'error',
                    'msg'    => 'Somting went wrong !'
                ];
                return response()->json($res);
            }
    }
    }
    public function edit(Request $request){
        $data['data'] = GroupPositionModel::select('group_positions.*','employees.name as employee_name','branches.name as branch_name')->leftJoin('employees','employees.id','=','group_positions.employee_id')->leftJoin('branches','branches.id','=','group_positions.branch_id')->first();
        $data['position'] = Position::where('branch_id',Auth::user()->branch_id)->get();
        $data['departement'] = Departement::where('branch_id',Auth::user()->branch_id)->get();
        return response()->json($data);
    }
    public function update(Request $request){
         try {
            DB::beginTransaction();
            $data = [
                'departement_id'    => $request->departement_id,
                'position_id'       => $request->position_id
            ];
            GroupPositionModel::where('id', $request->id)->update($data);

            DB::commit();
             $res = [
                    'status' => 'success',
                    'msg'    => 'Group Position successfully updated !'
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
             $del = GroupPositionModel::destroy($request->id);
             $res = [
                    'status' => 'success',
                    'msg'    => 'Group Position Successfully Deleted !'
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
