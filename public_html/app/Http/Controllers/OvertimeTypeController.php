<?php

namespace App\Http\Controllers;

use App\Models\OvertimeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OvertimeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage overtime type')) {
            $overtimeTypes = OvertimeType::where('created_by', '=', Auth::user()->creatorId())->get();

            return view('pages.contents.overtime-type.index', compact('overtimeTypes'));
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
        if (Auth::user()->can('create overtime type')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            $overtimeType             = new OvertimeType();
            $overtimeType->name       = $request->name;
            $overtimeType->created_by = Auth::user()->creatorId();
            $overtimeType->save();

            return redirect()->route('overtime-type.index')->with('success', 'Overtime Type ' . $overtimeType->name . ' successfully created.');
        } else {
            toast('Permission denied.', 'error');
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
        $overtimeType = OvertimeType::find($id);
        if (Auth::user()->can('edit overtime type')) {
            if ($overtimeType->created_by == Auth::user()->creatorId()) {

                return response()->json($overtimeType);
            } else {
                return response()->json(['error' => 'Permission denied.'], 401);
            }
        } else {
            return response()->json(['error' => 'Permission denied.'], 401);
        }
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
        $overtimeType = OvertimeType::find($id);

        if (Auth::user()->can('edit overtime type')) {
            if ($overtimeType->created_by == Auth::user()->creatorId()) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required',

                    ]
                );

                if ($validator->fails()) {
                    return redirect()->back()->with('errors', $validator->messages());
                }

                $overtimeType->name = $request->name;
                $overtimeType->save();

                return redirect()->route('overtime-type.index')->with('success', 'Overtime Type ' . $overtimeType->name . ' successfully updated.');
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
        $overtimeType = OvertimeType::find($id);

        if (Auth::user()->can('delete overtime type')) {
            if ($overtimeType->created_by == Auth::user()->creatorId()) {
                $overtimeType->delete();

                return redirect()->route('overtime-type.index')->with('success', 'Overtime Type ' . $overtimeType->name . ' successfully deleted.');
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
