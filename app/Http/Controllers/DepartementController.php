<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Departement;
use App\Models\Employee;
use App\Models\AccessBranch;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DepartementController extends Controller
{
    public function index()
    {
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
        return view('pages.contents.departement.index',$data);
    }

    /** ajaxDatatable */
    public function GetDataDepartements(Request $request)
    {
        try {
            /** Departement */
            $departements   = Departement::query()->where('branch_id', $request->branch_id)->with('branch');
            $response       = datatables()->eloquent($departements)
                            ->addColumn('action', function ($d) {
                        $view = '';
                        $view = '<td class="text-end" >
                                        <div class="dropdown dropdown-action" >
                                            <a href ="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons"> more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">';
                        /** edit */
                        $view .= '<a href="#" data-id = "'.$d->id.'" class="dropdown-item edit-departement"><i class="fa fa-pencil m-r-5" ></i> Edit</a>';
                        /** delete */
                        $view .= '<a data-id="'.$d->id.'" class="dropdown-item delete-departement" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                        /** delete */
                        $view .= '</div></div></td>';
                    return $view;
                })
                ->addColumn('status', function ($d) {
                    $view = '';
                    if($d->is_active == '1'){
                        $view ='Active';
                    }else{
                        $view ='Not Active';
                    }
                    return $view;
                })
                ->escapeColumns([])
                ->toJson();
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
    public function create()
    {
        $initial = Auth::user()->initial;
        if ($initial == "HO"){
            $companyId = Branch::select('company_id')->where('id',Auth::user()->branch_id)->first();
            $data['branch'] = Branch::where('company_id',$companyId->company_id)->get();
        }else{
            $data['branch'] = Branch::where('id',Auth::user()->branch_id)->get();
        }

        return response()->json($data);
    }
    public function store(Request $request)
    {
            $validator = Validator::make(
                $request->all(),
                [
                    'departement_code'      => 'required',
                    'branch_id'             => 'required',
                    'name'                  => 'required'
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }
            $checkDept = Departement::where('departement_code',$request->departement_code)->where('branch_id',$request->branch_id)->count();
            if ($checkDept > 0){
                $res = [
                    'status' => 'error',
                    'msg'    => 'Departement code ready !'
                ];
                return response()->json($res);
                return true;
            }
            try {
                DB::beginTransaction();

                $data = [
                    'departement_code'   =>$request->departement_code,
                    'branch_id'          =>$request->branch_id,
                    'name'               =>$request->name,
                    'description'        =>$request->description,
                    'is_active'          =>$request->is_active,
                    'create_by'          =>Auth::user()->creatorId()
                ];

                Departement::Insert($data);
                DB::commit();
                $res = [
                    'status' => 'success',
                    'msg'    => 'Departement successfully created !'
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

    public function show($id)
    {
       //
    }
    public function edit(Request $request)
    {
        $initial = Auth::user()->initial;
        if ($initial == "HO"){
            $companyId = Branch::select('company_id')->where('id',Auth::user()->branch_id)->first();
            $data['branch'] = Branch::where('company_id',$companyId->company_id)->get();
        }else{
            $data['branch'] = Branch::where('id',Auth::user()->branch_id)->get();
        }

        $data['departement'] =  Departement::where('id',$request->id)->first();

        return response()->json($data);
    }
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'departement_code'      => 'required',
                'branch_id'             => 'required',
                'name'                  => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->messages());
        }

        try {
            DB::beginTransaction();
            $data = [
                'departement_code'   =>$request->departement_code,
                'branch_id'          =>$request->branch_id,
                'name'               =>$request->name,
                'description'        =>$request->description,
                'is_active'          =>$request->is_active
            ];

            Departement::where('id', $request->id)->update($data);

            DB::commit();
             $res = [
                    'status' => 'success',
                    'msg'    => 'Departement successfully updated !'
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
    public function destroy(Request $request)
    {
        try{
             $del = Departement::destroy($request->id);
             $res = [
                    'status' => 'success',
                    'msg'    => 'Departement successfully Deleted !'
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
