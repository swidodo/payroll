<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Departement;
use App\Models\Employee;
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
            return view('pages.contents.departement.index');
    }

    /** ajaxDatatable */
    public function GetDataDepartements()
    {
        try {
            /** Departement */
            $departements   = Departement::query()->where('branch_id', 1)->with('branch');
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
            $companiId = Branch::select('company_id')->where('id',Auth::user()->branch_id)->first();
            $data['branch'] = Branch::where('company_id',$companyId)->get();
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
            $companiId = Branch::select('company_id')->where('id',Auth::user()->branch_id)->first();
            $data['branch'] = Branch::where('company_id',$companyId)->get();
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
