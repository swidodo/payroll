<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ReqShiftSchedule;
use App\Models\ShiftSchedule;
use App\Models\ShiftType;
use App\Models\Utility;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShiftScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show shift schedule
        if (Auth::user()->can('show shift schedule')) {
            $shiftSchedules = ShiftSchedule::where('created_by', '=', Auth::user()->creatorId())->where('status', 'Approved')->orderBy('id', 'asc')->get();

            $nationalDay = Utility::nationalHoliday();

            if (isset($shiftSchedules)) {
                foreach ($shiftSchedules as $key => $value) {
                    $dayOfShift         = Carbon::parse($value->schedule_date)->format('Ymd');

                    if (isset($nationalDay[$dayOfShift])) {
                        $value->is_dayoff = true;
                        $value->dayoff_type = 'National Holiday';
                        $value->description = $nationalDay[$dayOfShift]['deskripsi'];
                        $value->save();
                    }
                }
            }

            $employees = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
            return view('pages.contents.shift-schedule.index', compact('shiftSchedules', 'employees'));
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
        //
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
        if (Auth::user()->can('edit shift schedule')) {
            $employees      = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
            $shifts         = ShiftType::where('created_by', '=', Auth::user()->creatorId())->get();
            $reqShiftSchedule   = ReqShiftSchedule::find($id);
            $shiftSchedules      =  ShiftSchedule::where('req_shift_schedules_id', $reqShiftSchedule->id)->get();

            return view('pages.contents.shift-schedule.edit', compact('employees', 'shifts', 'reqShiftSchedule', 'shiftSchedules'));
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
        $reqShiftSchedule = ReqShiftSchedule::find($id);
        $shiftSchedules = ShiftSchedule::where('req_shift_schedules_id', $reqShiftSchedule->id)->where('created_by', '=', Auth::user()->creatorId())->get();


        if (Auth::user()->can('edit shift schedule')) {
            $validator = Validator::make(
                $request->all(),
                []
            );

            if (isset($request->schedule)) {
                if (count($request->schedule) > 0) {
                    foreach ($request->schedule as $key => $val) {
                        if (isset($request->schedule[$key + 1]) && $val['schedule_date']  == $request->schedule[$key + 1]['schedule_date']) {
                            return redirect()->back()->with('error', 'There is duplicate shift in request, please check the dates during the request');
                        }

                        if ($val['shift_id'] == 0) {
                            return redirect()->back()->with('error', 'Please select valid shift daily');
                        }
                    }
                }
            }

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            // $reqShiftSchedule->update($request->all());

            if (isset($request->schedule)) {
                foreach ($shiftSchedules as $key) {
                    $key->delete();
                }

                foreach ($request->schedule as $key) {
                    ShiftSchedule::create([
                        'req_shift_schedules_id'    => $reqShiftSchedule->id,
                        'schedule_date'             => $key['schedule_date'],
                        'shift_id'                  => $key['shift_id'],
                        'created_by'                => Auth::user()->creatorId(),
                    ]);
                }
            } else {
                foreach ($shiftSchedules as $key) {
                    $key->delete();
                }
            }

            return redirect()->route('shift-schedule.index')->with('success', $reqShiftSchedule->employee->name . ' successfully updated.');
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
        $reqShiftSchedule = ReqShiftSchedule::find($id);
        $shiftSchedule = ShiftSchedule::where('req_shift_schedules_id', $reqShiftSchedule->id)->where('created_by', '=', Auth::user()->creatorId())->get();

        if (Auth::user()->can('delete shift schedule')) {
            if ($reqShiftSchedule->created_by == Auth::user()->creatorId()) {
                $reqShiftSchedule->delete();
                if ($reqShiftSchedule) {
                    foreach ($shiftSchedule as $key) {
                        $key->delete();
                    }
                }

                return redirect()->route('request-shift-schedule.index')->with('success', $reqShiftSchedule->employee->name . ' successfully deleted.');
            } else {
                toast('Permission denied.', 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function indexDayOff()
    {
        if (Auth::user()->can('show shift schedule')) {
            // $employees = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
            // $shiftSchedules = ShiftSchedule::where('created_by', '=', Auth::user()->creatorId())->where('status', 'Approved')->orderBy('id', 'asc')->get();
            return view('pages.contents.dayoff.index');
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
}
