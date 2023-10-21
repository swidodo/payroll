<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Employee;
use App\Models\Reimburst;
use App\Models\ReimburstmentOption;
use App\Models\ShiftType;
use App\Models\Utility;
use App\Models\Branch;
use Carbon\Carbon;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReimburstController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage reimburst')) {
            $branch = Branch::where('id',Auth::user()->branch_id)->first();
            if(Auth::user()->initial == "HO"){
                $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
                return view('pages.contents.reimburst.index',$data);
            }else{
                $data['branch'] = Branch::where('id',$branch->id)->get();
                return view('pages.contents.reimburst.index', $data);
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

   public function get_data(Request $request){
    $data = Reimburst::select('reimbursts.*','reimburstment_options.name as type','employees.no_employee','employees.name as employee_name')
                        ->leftJoin('reimburstment_options','reimburstment_options.id','=','reimbursts.reimburst_type_id')
                        ->leftJoin('employees','employees.id','=','reimbursts.employee_id')
                        ->where('employees.branch_id',$request->branch_id)
                        ->get();
    return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn ='';
                            if(Auth()->user()->canany('edit reimburst','delete reimburst')){
                                $btn .= '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">';
                                if(Auth()->user()->can('edit reimburst')){
                                    $btn .= '<a  data-id='.$row->id.' class="dropdown-item edit-reimburse" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                }
                                if(Auth()->user()->can('delete reimburst')){
                                    $btn .= '<a data-id='.$row->id.' class="dropdown-item delete-reimburse" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                }
                                    
                            }
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
   }
   public function get_data_employee(Request $request){
    $branch = Branch::where('id',Auth::user()->branch_id)->first();
    $data['employee'] = Employee::select('id','name')->where('branch_id',$request->branch_id)->get();
    $data['reimburseType'] = ReimburstmentOption::all();
     return response()->json($data);
   }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('create reimburst')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'reimburst_type_id' => 'required',
                    'employee_id' => 'required',
                    'amount' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();
                $data = [
                    'employee_id'       => $request->employee_id,
                    'reimburst_type_id' => $request->reimburst_type_id,
                    'amount'            => $request->amount,
                    'created_by'        => Auth::user()->id,
                    'date'              => date('Y-m-d'),
                ];
               Reimburst::create($data);
                DB::commit();
                $res = [
                    'status' =>'success',
                    'msg'    =>'Created data successfuly !',
                ];
                return response()->json($res);
            } catch (Exception $e) {
                DB::rollBack();
                $res = [
                    'status' =>'error',
                    'msg'    =>'Sameting went wrong!',
                ];  
                 return response()->json($res);
            }
        } else {
            $res = [
                    'status' =>'error',
                    'msg'    =>'Permission denied!',
                ];  
            return response()->json($res);
        }
    }

   public function edit(Request $request)
    {
        $data['reimburse'] = Reimburst::select('reimbursts.*','employees.name as employee_name')
                                        ->leftJoin('employees','employees.id','reimbursts.employee_id')
                                        ->where('reimbursts.id',$request->id)
                                        ->first();
        $data['reimburseType'] = ReimburstmentOption::all();
        return response()->json($data);
    }
    public function update(Request $request)
    {
        $data = [
            'reimburst_type_id' => $request->reimburst_type_id,
            'amount' => $request->amount,
        ];
        $update = Reimburst::where('id',$request->id)->update($data);
        if($update){
            $res = [
                'status' =>'success',
                'msg'    =>'Updated data successfuly !',
            ];
        }else{
            $res = [
                'status' =>'error',
                'msg'    =>'Sameting went wrong!',
            ];   
        }
        return response()->json($res);
    }

  public function destroy(Request $request)
    {
        $data = Reimburst::destroy($request->id);
        if($data){
            $res = [
                'status' =>'success',
                'msg'    =>'Delete data successfuly !',
            ];
        }else{
            $res = [
                'status' =>'error',
                'msg'    =>'Sameting went wrong!',
            ];   
        }
        return response()->json($res);
    }
}
