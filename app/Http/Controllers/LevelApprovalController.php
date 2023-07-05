<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LevelApproval;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class LevelApprovalController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage level approval')) {
            $employees = Employee::where('created_by', Auth::user()->creatorId())->get();
            $tiers = LevelApproval::where('created_by', Auth::user()->creatorId())->get();
            return view('pages.contents.set-level-approval.index', compact('employees', 'tiers'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('edit level approval')) {
            try {
                DB::beginTransaction();
                // if ($request->level[0] == 0) {
                //     toast('Tier 1 must be selected', 'error');
                //     return redirect()->back();
                // }
                foreach ($request->level as $key => $value) {
                    $split = explode('_', $value);
                    $approval = LevelApproval::where('created_by', Auth::user()->creatorId())->where('level', $key + 1)->first();
                    if (count($split) > 1) {
                        if (is_null($approval)) {
                            if ($split[0] == 'company') {
                                $company = User::where('id', Auth::user()->creatorId())->where('type', 'company')->first();
                                if (!is_null($company)) {
                                    LevelApproval::create([
                                        'level'         => $key + 1,
                                        'company_id'    => $company->id,
                                        'created_by'    => Auth::user()->creatorId(),
                                    ]);
                                }
                            } elseif ($split[0] == 'employee') {
                                $employee = Employee::where('id', $split[1])->first();
                                if (!is_null($employee)) {
                                    $level = LevelApproval::create([
                                        'level'         => $key + 1,
                                        'employee_id'    => $employee->id,
                                        'created_by'    => Auth::user()->creatorId(),
                                    ]);
                                    $employee->update(['level_approval' => $level->level]);
                                }
                            }
                        } else {
                            $approval->employee_id = null;
                            $approval->company_id = null;
                            $approval->save();
                            if ($split[0] == 'company') {
                                $company = User::where('id', Auth::user()->creatorId())->where('type', 'company')->first();
                                if (!is_null($company)) {
                                    $approval->company_id = $company->id;
                                }
                            } elseif ($split[0] == 'employee') {
                                $employee = Employee::where('id', $split[1])->first();
                                if (!is_null($employee)) {
                                    $approval->employee_id = $employee->id;
                                    $employee->update(['level_approval' => $approval->level]);
                                }
                            }
                            $approval->save();
                        }
                    } else {
                        if ($approval) {
                            $approval->employee_id = null;
                            $approval->company_id = null;
                            $approval->save();
                        }
                    }
                }

                DB::commit();
                toast('Successfuly set level approval', 'success');
                return redirect()->route('level-approvals.index');
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
