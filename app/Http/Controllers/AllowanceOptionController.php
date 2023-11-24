<?php

namespace App\Http\Controllers;

use App\Models\AllowanceOption;
use App\Models\Branch;
use App\Models\AccessBranch;
use App\Models\Employee;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class AllowanceOptionController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage allowance option')) {
            $branch = Branch::where('id',Auth::user()->branch_id)->first();
            $emp = Employee::where('user_id',Auth::user()->id)->first();
        
            if (Auth::user()->initial == "HO"){
                if (Auth::user()->type == "company"){
                    $branches = Branch::where('company_id',$branch->company_id)->get();
                }else{
                    $branches = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                    ->where('access_branches.employee_id',$emp->id)
                                                    ->where('access_branches.company_id',$branch->company_id)->get();
                }
            }else{
                $branches = Branch::where('id',$branch->id)->get();
            }
            $allowanceOptions = AllowanceOption::where('branch_id', '=', Auth::user()->branch_id)->get();

            return view('pages.contents.allowance-option.index', compact('allowanceOptions','branches'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
    public function get_data(Request $request){
        $data =  AllowanceOption::where('branch_id', '=', $request->branch_id)->get();

        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                        $btn ='';
                        if(Auth()->user()->canany(['edit allowance option', 'delete allowance option'])){
                            $btn .= '<div class="dropdown">
                                    <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                    <div class="dropdown-menu dropdown-menu-right">';
                                        if(Auth()->user()->can('edit allowance option')){
                                            $btn .=' <a  data-url="'.route('allowance-option.edit', $row->id).'" id="edit-allowance-option" class="dropdown-item fw-bold" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_allowance"><i class="fa fa-pencil"></i> Edit</a>';
                                         }
                                        if(Auth()->user()->can('delete allowance option')){
                                            $btn .= '<a data-id="'.$row->id.'" class="dropdown-item fw-bold delete-allowance" href="#" ><i class="fa fa-trash-o"></i> Delete</a>';
                                        }
                                        $btn .= '</div></div>';
                        }
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);return response()->json($data);
    }
    public function store(Request $request)
    {
        if (Auth::user()->can('create allowance option')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required|max:20',
                    'pay_type' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();
                if (isset($request->include_attendance)){
                    $include_attendance = $request->include_attendance;
                }else{
                    $include_attendance = 'N';
                }
                $allowanceOption                       = new AllowanceOption();
                $allowanceOption->name                 = $request->name;
                $allowanceOption->pay_type             = $request->pay_type;
                $allowanceOption->include_attendance   = $include_attendance;
                $allowanceOption->branch_id            = $request->branch_id;
                $allowanceOption->created_by           = Auth::user()->creatorId();
                $allowanceOption->save();

                DB::commit();
                toast('Allowance Option  successfully created.', 'success');
                return redirect()->route('allowance-option.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $allowanceOption = AllowanceOption::find($id);
        if (Auth::user()->can('edit allowance option')) {
            if ($allowanceOption->created_by == Auth::user()->creatorId()) {

                return response()->json($allowanceOption);
            } else {
                return response()->json(['error' => 'Permission denied.'], 401);
            }
        } else {
            return response()->json(['error' => 'Permission denied.'], 401);
        }
    }

    public function update(Request $request, $id)
    {
        $allowanceOption = AllowanceOption::find($id);

        if (Auth::user()->can('edit allowance option')) {
            if ($allowanceOption->created_by == Auth::user()->creatorId()) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required|max:20',
                        'pay_type' => 'required',

                    ]
                );

                if ($validator->fails()) {
                    return redirect()->back()->with('errors', $validator->messages());
                }

                try {
                    DB::beginTransaction();
                    if (isset($request->include_attendance)){
                        $include_attendance = $request->include_attendance;
                    }else{
                        $include_attendance = 'N';
                    }
                    $allowanceOption->name       = $request->name;
                    $allowanceOption->pay_type   = $request->pay_type;
                    $allowanceOption->include_attendance   = $include_attendance;
                    $allowanceOption->save();

                    DB::commit();
                    toast('Allowance Option  successfully updated.', 'success');
                    return redirect()->route('allowance-option.index');
                } catch (Exception $e) {
                    DB::rollBack();
                    toast('Something went wrong.', 'error');
                    return redirect()->back();
                }
            } else {
                toast('Permission denied.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $allowanceOption = AllowanceOption::find($request->id);

        if (Auth::user()->can('delete allowance option')) {
                $del =  AllowanceOption::destroy($request->id);
                if ($del){
                    $res = [
                        'status' => 'success',
                        'msg'    => 'Data successfully Deleted !'
                    ];
               }else{
                $res = [
                        'status' =>'error',
                        'msg'    =>'Data Fail Deleted !',
                    ];
               }
               return response()->json($res);
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
}
