<?php

namespace App\Http\Controllers;

use App\Models\Dayoff;
use App\Models\ShiftSchedule;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DayoffController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage dayoff')) {
            // $employees = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
            // $shiftSchedules = ShiftSchedule::where('created_by', '=', Auth::user()->creatorId())->where('status', 'Approved')->orderBy('id', 'asc')->get();
            $dayoffs = Dayoff::where('created_by', Auth::user()->creatorId())->get();

            $days = [
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday',
            ];

            return view('pages.contents.dayoff.index', compact('days', 'dayoffs'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('dayoff.index');
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('create dayoff')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'date' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();
                ShiftSchedule::updateShiftDayOff($request->date, 'l', 'Company Holiday', 'Company Holiday');

                Dayoff::create([
                    'date'       => $request->date,
                    'created_by' => Auth::user()->creatorId()
                ]);

                DB::commit();
                toast('Successfully create dayoff.', 'success');
                return redirect()->route('dayoff.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.' . $e, 'error');
                return redirect()->route('dayoff.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('dayoff.index');
        }
    }

    public function edit($id)
    {
        if (Auth::user()->can('edit dayoff')) {
            $dayoff = Dayoff::find($id);

            return response()->json($dayoff);
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->can('create dayoff')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'dayoff' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                $dayoff = Dayoff::find($id);
                DB::beginTransaction();

                ShiftSchedule::updateShift($request->dayoff, 'l', 'Dayoff', 'Dayoff');

                $dayoff->day = $request->dayoff;
                $dayoff->save();

                DB::commit();
                toast('Successfully update dayoff.', 'success');
                return redirect()->route('dayoff.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.', 'error');
                return redirect()->route('dayoff.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('dayoff.index');
        }
    }

    public function destroy($id)
    {
        $dayoff = Dayoff::find($id);
        if (Auth::user()->can('delete dayoff')) {
            if ($dayoff->created_by == Auth::user()->creatorId()) {

                ShiftSchedule::destroyHoliday($dayoff->day, 'l');

                $dayoff->delete();

                toast('Dayoff successfully deleted.', 'success');
                return redirect()->route('dayoff.index');
            } else {
                toast('Permission denied.', 'error');
                return redirect()->route('dayoff.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('dayoff.index');
        }
    }
}
