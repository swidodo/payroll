<?php

namespace App\Http\Controllers;

use App\Models\DayType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class DayTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage day type')) {
            $dayTypes = DayType::all();
            return view('pages.contents.day-type.index', compact('dayTypes'));
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
        if (Auth::user()->can('create day type')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            $dayType                = new DayType();
            $dayType->name          = $request->name;
            $dayType->created_by    = Auth::user()->creatorId();
            $dayType->branch_id     = Auth::user()->baranch_id();
            $dayType->save();

            return redirect()->route('day-type.index')->with('success', 'Day Type ' . $dayType->name . ' successfully created.');
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
        $dayType = DayType::find($id);
        if (Auth::user()->can('edit day type')) {
            if ($dayType->created_by == Auth::user()->creatorId()) {

                return response()->json($dayType);
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
        $dayType = DayType::find($id);

        if (Auth::user()->can('edit day type')) {
            if ($dayType->created_by == Auth::user()->creatorId()) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'name' => 'required',

                    ]
                );

                if ($validator->fails()) {
                    return redirect()->back()->with('errors', $validator->messages());
                }

                $dayType->name = $request->name;
                $dayType->save();

                return redirect()->route('day-type.index')->with('success', 'Day Type ' . $dayType->name . ' successfully updated.');
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
        $dayType = DayType::find($id);

        if (Auth::user()->can('delete day type')) {
            if ($dayType->created_by == Auth::user()->creatorId()) {
                $dayType->delete();

                return redirect()->route('day-type.index')->with('success', 'Day Type ' . $dayType->name . ' successfully deleted.');
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
