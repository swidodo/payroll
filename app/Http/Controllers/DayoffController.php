<?php

namespace App\Http\Controllers;

use App\Models\Dayoff;
use App\Models\ShiftSchedule;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DayoffController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->can('manage dayoff')) {
            $branchId = Auth::user()->branch_id;
            // dd($branchId);

            // $dayoffs = Dayoff::where('created_by', $branchId)->get();

            $dayoffs = DB::table('dayoffs')
            ->whereIn('created_by', function ($query) use ($branchId) {
                $query->select('id')
                    ->from('users')
                    ->where('branch_id', $branchId);
            })
            ->get();

            // // Get user ids with the same branch_id
            // $userIds = User::where('branch_id', $branchId)->pluck('id')->toArray();

            // // Fetch Dayoff data based on the created_by (user_id) with the same branch_id
            // $dayoffs = DB::table('dayoffs')
            //     ->whereIn('created_by', $userIds)
            //     ->get();

            // dd($dayoffs);
            // $employees = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
            // $shiftSchedules = ShiftSchedule::where('created_by', '=', Auth::user()->creatorId())->where('status', 'Approved')->orderBy('id', 'asc')->get();
            // $dayoffs = Dayoff::select('id', 'date')->get();
            // dd($dayoffs);
            if ($request->ajax()) {
                return DataTables::of($dayoffs)->addIndexColumn()
                    ->addColumn('company_dayoff', function ($dayoff) {
                        return \Carbon\Carbon::parse($dayoff->date)->format('l') ?? '-';
                    })
                    ->addColumn('date', function ($dayoff) {
                        return \Carbon\Carbon::parse($dayoff->date)->format('j F Y') ?? '-';
                    })
                    ->addColumn('action', function ($data) {
                        $action = '';
                        if (Auth()->user()->canany(['edit dayoff', 'delete dayoff'])) {
                            $action = '<td class="text-center" >
                                            <div class="dropdown dropdown-action" >
                                                <a href = "#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons"> more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">';
                            if (Auth()->user()->can('delete dayoff')) {
                                $url_delete = route('dayoff.destroy', $data->id);
                                $action .= '<a id="delete-dayoff-btn" data-url="' . $url_delete . '" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_dayoff"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                            }

                            $action .= '</div></div></td>';
                        }
                        return $action;
                    })
                    ->escapeColumns([])
                    ->toJson();
            }

            return view('pages.contents.dayoff.index');
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
