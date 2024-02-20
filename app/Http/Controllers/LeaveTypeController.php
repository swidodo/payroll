<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LeaveTypeController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage leave type')) {
            $leavetypes = LeaveType::select('leave_types.*')
                                    ->leftJoin('users','users.id','leave_types.created_by')
                                    ->where('users.branch_id', '=', Auth::user()->branch_id)
                                    ->get();
            return view('pages.contents.leave-type.index', compact('leavetypes'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
    public function store(Request $request)
    {
        if (Auth::user()->can('create leave type')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                    'days' => 'required',
                ]
            );

            if ($validator->fails()) {
                $res = [
                    'status' => 'error',
                    'msg'    => $validator->messages(),
                ];
                return response()->json($res);
            }
            $check = LeaveType::leftJoin('users','users.id','leave_types.created_by')
                                ->where('code',$request->code)
                                ->where('users.branch_id',Auth::user()->branch_id)
                                ->count();
            if($check > 0){
                $res = [
                    'status' => 'error',
                    'msg'    => 'Data already in list leave Type.',
                ];
                return response()->json($res);
            }
            $leavetype                  = new LeaveType();
            $leavetype->title           = $request->title;
            $leavetype->code            = $request->code;
            $leavetype->days            = $request->days;
            $leavetype->include_salary  = $request->include_salary;
            $leavetype->created_by = Auth::user()->id;
            $insert = $leavetype->save();
            if($insert){
                $res = [
                    'status' => 'success',
                    'msg'    => 'Data successfully created.',
                ];
            }else{
                $res = [
                    'status' => 'error',
                    'msg'    => 'Data Not Success created.',
                ];
            }
            return response()->json($res);
        } else {
            $res = [
                'status' => 'error',
                'msg'    => 'Permission denied.',
            ];
            return response()->json($res);
        }
    }
    public function edit($id)
    {
        
        if (Auth::user()->can('edit leave type')) {
            $leavetype = LeaveType::find($id);
            return response()->json($leavetype);
            
        } else {
            return response()->json(['error' => 'Permission denied.'], 401);
        }
    }
    public function update(Request $request, $id)
    {
        if (Auth::user()->can('edit leave type')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                    'days' => 'required',
                ]
            );

            if ($validator->fails()) {

                return redirect()->back()->with([
                    'errors'    => $validator->messages(),
                    'edit-show' => true,
                ]);
            }
            $leavetype = LeaveType::find($id);
            $leavetype->title           = $request->title;
            $leavetype->days            = $request->days;
            $leavetype->include_salary  = $request->include_salary;
            $leavetype->save();
            return redirect()->route('leave-type.index')->with('success', 'LeaveType successfully updated.');
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        if (Auth::user()->can('delete leave type')) {
            try {
                LeaveType::where('id',$id)->delete();
                $res = [
                    'status' => 'success',
                    'msg'    => 'LeaveType successfully deleted.',
                ];
                return response()->json($res);
            }catch(Exeption $e){
                $res = [
                    'status' => 'error',
                    'msg'    => 'Something went wrong!.',
                ];
                return response()->json($res);
            }
        } else {
            $res = [
                'status' => 'error',
                'msg'    => 'Permission denied.',
            ];
            return response()->json($res);
        }
    }
}
