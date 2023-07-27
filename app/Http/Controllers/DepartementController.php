<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Departement;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return view('pages.contents.departement.index');
    }

    /** ajaxDatatable */
    public function GetDataDepartements()
    {
        try {
            /** Departement */
            $departements = Departement::query()->where('created_by', Auth::user()->creatorId())->with('branch','departement_head');
            $response = datatables()->eloquent($departements)
                ->addColumn('action', function ($d) {
                    $view = '';
                        $view = '<td class="text-end" >
                                        <div class="dropdown dropdown-action" >
                                            <a href = "#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons"> more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">';
                        /** edit */
                        $url_edit = route('departements.edit', $d->id);
                        $view .= '<a data-url="" id="edit-departement" class="dropdown-item" href="'.$url_edit.'"><i class="fa fa-pencil m-r-5" ></i> Edit</a>';
                        /** edit */
                        /** delete */
                        $url_delete = route('departements.destroy', $d->id);
                        $view .= '<a id="delete-departement" data-url="'.$url_delete.'" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                        /** delete */
                        $view .= '</div></div></td>';
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branch = Branch::all();
        $departement_head = Branch::all();
        return view('pages.contents.departement.create',compact('branch','departement_head'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $validator = Validator::make(
                $request->all(),
                [
                    'departement_head_id'   => 'required',
                    'branch_id'             => 'required',
                    'name'                  => 'required'
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();
                $i=0;
                $data_array= [];
                foreach($request->name as $data_row){
                    if ($data_row !=''){
                        $data = [
                            'departement_head_id'   =>$request->departement_head_id[$i],
                            'branch_id'             => $request->branch_id[$i],
                            'name'                  => $request->name[$i],
                            'description'           => $request->name[$i],
                            'created_by'            => Auth::user()->creatorId()
                        ];
                        array_push($data_array,$data);
                    }
                    $i++;
                }
                if (count($data_array) > 0){
                    Departement::Insert($data_array);
                }else{
                    toast('Departement Faild created.', 'error');
                    return redirect()->route('departement.index');
                }
                DB::commit();
                toast('Departement successfully created.', 'success');
                return redirect()->route('allowances.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.', 'error');
                return redirect()->back();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Branch::all();
        $departement_head = Branch::all();
        $departement =  Departement::with('branch','departement_head')->where('id',$id)->first();

        return view('pages.contents.departement.show', compact('branch', 'departement_head', 'departement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'departement_head_id'   => 'required',
                'branch_id'             => 'required',
                'name'                  => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->messages());
        }

        try {
            DB::beginTransaction();
            $insert_departement = Departement::find($id);
            $insert_departement->update($request->all());

            DB::commit();
            toast('Departement successfully updated.', 'success');
            return redirect()->route('allowances.index');
        } catch (Exception $e) {
            DB::rollBack();
            toast('Something went wrong.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $delete = Departement::findOrFail($id);
            $delete->delete();

            toast('Departement successfully deleted.', 'success');
            return redirect()->route('employees.index', $id);
    }

}