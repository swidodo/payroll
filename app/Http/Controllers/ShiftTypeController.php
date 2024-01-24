<?php

namespace App\Http\Controllers;

use App\Models\BreakTime;
use App\Models\DayType;
use App\Models\ShiftType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShiftTypeController extends Controller
{
   public function index()
    {
        if (Auth::user()->can('manage shift type')) {
            $shiftTypes = ShiftType::where('created_by', '=', Auth::user()->creatorId())->get();
            $dayTypes = DayType::where('created_by', '=', Auth::user()->creatorId())->get();

            return view('pages.contents.shift-type.index', compact('shiftTypes', 'dayTypes'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
    public function create()
    {
        if (Auth::user()->can('create shift type')) {
            $shiftTypes = ShiftType::where('created_by', '=', Auth::user()->creatorId())->get();
            $dayTypes = DayType::where('created_by', '=', Auth::user()->creatorId())->get();

            return view('pages.contents.shift-type.create', compact('shiftTypes', 'dayTypes'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
    
    public function store(Request $request)
    {
        // dd($request->all()['break_time'][1]);
        if (Auth::user()->can('create shift type')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }
            // dd(Auth::user()->branch_id);
            $shiftType = ShiftType::create([
                'name'          => $request->name,
                'day_type_id'   => $request->day_type_id,
                'start_time'    => $request->start_time,
                'end_time'      => $request->end_time,
                'is_wfh'        => isset($request->is_wfh) &&  $request->is_wfh == 'on' ? 1 : 0,
                'created_by'    => Auth::user()->creatorId(),
                'branch_id'     => Auth::user()->branch_id,
            ]);

            if (isset($request->break_time)) {
                foreach ($request->break_time as $key) {
                    BreakTime::create([
                        'shift_type_id' => $shiftType->id,
                        'start_time'    => $key['start_time'],
                        'end_time'      => $key['end_time'],
                        'created_by'    => Auth::user()->creatorId(),
                    ]);
                }
            }

            toast('Shift Type ' . $shiftType->name . ' successfully created.', 'success');
            return redirect()->route('shift-type.index');
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

        if (Auth::user()->can('edit shift type')) {
            $shiftType = ShiftType::find($id);
            $breakTimes = BreakTime::where('shift_type_id', $shiftType->id)->get();
            $dayTypes = DayType::where('created_by', '=', Auth::user()->creatorId())->get();

            return view('pages.contents.shift-type.edit', compact('shiftType', 'dayTypes', 'breakTimes'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
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
        $shiftType = ShiftType::find($id);
        $breakTime = BreakTime::where('shift_type_id', $shiftType->id)->where('created_by', '=', Auth::user()->creatorId())->get();
        if (Auth::user()->can('create shift type')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            $shiftType->update($request->all());


            if (isset($request->break_time)) {
                foreach ($breakTime as $key) {
                    $key->delete();
                }

                foreach ($request->break_time as $key) {
                    BreakTime::create([
                        'shift_type_id' => $shiftType->id,
                        'start_time'    => $key['start_time'],
                        'end_time'      => $key['end_time'],
                        'created_by'    => Auth::user()->creatorId(),
                    ]);
                }
            } else {
                foreach ($breakTime as $key) {
                    $key->delete();
                }
            }

            toast('Shift Type ' . $shiftType->name . ' successfully created.', 'success');
            return redirect()->route('shift-type.index');
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
        $shiftType = ShiftType::find($id);
        $breakTime = BreakTime::where('shift_type_id', $shiftType->id)->where('created_by', '=', Auth::user()->creatorId())->get();

        if (Auth::user()->can('delete shift type')) {
            if ($shiftType->created_by == Auth::user()->creatorId()) {
                $shiftType->delete();
                if ($shiftType) {
                    foreach ($breakTime as $key) {
                        $key->delete();
                    }
                }

                return redirect()->route('shift-type.index')->with('success', 'shift Type ' . $shiftType->name . ' successfully deleted.');
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
