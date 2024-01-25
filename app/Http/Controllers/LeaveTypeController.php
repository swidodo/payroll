<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage leave type')) {
            $leavetypes = LeaveType::leftJoin('users','users.id','leave_types.created_by')
                                    ->where('users.branch_id', '=', Auth::user()->branch_id)->get();

            return view('pages.contents.leave-type.index', compact('leavetypes'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            $check = LeaveType::where('code',$request->code)->count();
            if($check > 0){
                $res = [
                    'status' => 'error',
                    'msg'    => 'Data already in leave Type.',
                ];
                return response()->json($res);
            }
            $leavetype                  = new LeaveType();
            $leavetype->title           = $request->title;
            $leavetype->code            = $request->code;
            $leavetype->days            = $request->days;
            $leavetype->include_salary  = $request->include_salary;
            $leavetype->created_by = Auth::user()->creatorId();
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
        $leavetype = LeaveType::find($id);
        if (Auth::user()->can('edit leave type')) {
            if ($leavetype->created_by == Auth::user()->creatorId()) {
                return response()->json($leavetype);
            } else {
                return response()->json(['error' => 'Permission denied.'], 401);
            }
        } else {
            return response()->json(['error' => 'Permission denied.'], 401);
        }
    }
    public function update(Request $request, $id)
    {
        $leavetype = LeaveType::find($id);
        if (Auth::user()->can('edit leave type')) {
            if ($leavetype->created_by == Auth::user()->creatorId()) {
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

                $leavetype->title           = $request->title;
                $leavetype->days            = $request->days;
                $leavetype->include_salary  = $request->include_salary;
                $leavetype->save();

                return redirect()->route('leave-type.index')->with('success', 'LeaveType successfully updated.');
            } else {
                toast('Permission denied.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
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
        $leavetype = LeaveType::find($id);
        if (Auth::user()->can('delete leave type')) {
            if ($leavetype->created_by == Auth::user()->creatorId()) {
                $leavetype->delete();

                return redirect()->route('leave-type.index')->with('success', 'LeaveType successfully deleted.');
            } else {
                toast('Permission denied.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
}
