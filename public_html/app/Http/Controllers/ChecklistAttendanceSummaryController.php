<?php

namespace App\Http\Controllers;

use App\Models\ChecklistAttendanceSummary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChecklistAttendanceSummaryController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage payslip checklist attendance summary')) {
            $checklists = ChecklistAttendanceSummary::where('created_by', Auth::user()->creatorId())->get();

            return view('pages.contents.payroll.checklist-attendance-summary.index', compact('checklists'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('edit payslip checklist attendance summary')) {
            try {
                DB::beginTransaction();

                $checklists = ChecklistAttendanceSummary::where('created_by', Auth::user()->creatorId())->get();
                foreach ($checklists as $key => $value) {
                    $value->delete();
                }

                if (isset($request->checklists)) {
                    foreach ($request->checklists as $key => $value) {
                        ChecklistAttendanceSummary::create([
                            'name'          => $key,
                            'is_displayed'  => $value == 'on' ? true : false,
                            'created_by'    => Auth::user()->creatorId()
                        ]);
                    }
                }

                DB::commit();
                toast('Successfully', 'success');
                return redirect()->back();
            } catch (Exception $e) {
                DB::rollBack();
                toast($e->getMessage(), 'error');
                return redirect()->back();
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
}
