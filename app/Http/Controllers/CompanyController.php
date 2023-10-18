<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
class CompanyController extends Controller
{
     public function index(){
        return view('pages.contents.company.index');
    }
    public function get_data(Request $request){
        try {
            $data = Company::all();
             return DataTables::of($group)
                            ->addColumn('action', function ($d) {
                        $view = '';
                        if(Auth()->user()->canany('edit set company','delete set company')){
                            $view = '<td class="text-end" >
                                            <div class="dropdown dropdown-action" >
                                                <a href ="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons"> more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">';
                            /** edit */
                            $view .= '<a href="#" data-id = "'.$d->id.'" class="dropdown-item edit-company"><i class="fa fa-pencil m-r-5" ></i> Edit</a>';
                            /** delete */
                            $view .= '<a data-id="'.$d->id.'" class="dropdown-item delete-company" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                            /** delete */
                            $view .= '</div></div></td>';
                        }
                    return $view;
                })
               ->rawColumns(['action'])
                        ->make(true);
        }catch (Throwable $e) {
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
}
