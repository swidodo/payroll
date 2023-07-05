<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LevelApproval;
use App\Models\OnDutyApproval;
use App\Models\Travel;
use App\Models\Utility;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator as FacadesValidator;

use function GuzzleHttp\Promise\all;

class TravelController extends Controller
{
    public function index()
    {
        if (Auth::user()->can('manage on duty')) {
            if (Auth::user()->type == 'employee') {
                $emp     = Employee::where('user_id', '=', Auth::user()->id)->first();
                $travels = Travel::where('created_by', '=', Auth::user()->creatorId())->where('employee_id', '=', $emp->id)->get();
                $employee     = Employee::where('created_by', '=', Auth::user()->creatorId())->get();

                //3 tier approval
                if (!is_null($employee[0]->level_approval)) {
                    $levelApprove = $employee[0]->approval;

                    $approval = OnDutyApproval::where('level', $levelApprove->level)
                        ->where('is_approver_company', false)
                        ->where('approver_id', $employee[0]->id)
                        ->get();
                    foreach ($approval as $key => $value) {
                        $travels = collect($travels)->prepend($value->travel);
                        $employee = collect($employee)->prepend($value->travel->employee);
                    }
                }
                //3 tier approval
            } else {
                $travels = Travel::where('created_by', '=', Auth::user()->creatorId())->get();
                $employee     = Employee::where('created_by', '=', Auth::user()->creatorId())->get();
            }

            return view('pages.contents.travel.index', compact('travels', 'employee'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('dashboard');
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->can('create on duty')) {
            $validator = FacadesValidator::make(
                $request->all(),
                [
                    'employee_id' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'purpose_of_visit' => 'required',
                    'place_of_visit' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }

            try {
                DB::beginTransaction();

                if (Auth::user()->type == 'company') {
                    $travel                   = new Travel();
                    $travel->employee_id      = $request->employee_id;
                    $travel->start_date       = $request->start_date;
                    $travel->end_date         = $request->end_date;
                    $travel->purpose_of_visit = $request->purpose_of_visit;
                    $travel->place_of_visit   = $request->place_of_visit;
                    $travel->description      = $request->description;
                    // $travel->status           = 'Pending';
                    $travel->status           = 'Approved';
                    $travel->created_by       = Auth::user()->creatorId();
                    $travel->save();
                } else {
                    $travel                   = new Travel();
                    $travel->employee_id      = $request->employee_id;
                    $travel->start_date       = $request->start_date;
                    $travel->end_date         = $request->end_date;
                    $travel->purpose_of_visit = $request->purpose_of_visit;
                    $travel->place_of_visit   = $request->place_of_visit;
                    $travel->description      = $request->description;
                    $travel->status           = 'Pending';
                    $travel->created_by       = Auth::user()->creatorId();
                    $travel->save();
                }

                // 3 Tier Approval
                $levels = LevelApproval::where('created_by', Auth::user()->creatorId())->get();
                foreach ($levels as $key => $value) {
                    OnDutyApproval::create([
                        'travel_id'             => $travel->id,
                        'level'                 => $value->level,
                        'is_approver_company'   => $value->company_id ? true : false,
                        'approver_id'           => isset($value->company_id) ? $value->company_id : $value->employee_id,
                        'status'                => 'Pending',
                        'created_by'            => Auth::user()->creatorId(),
                    ]);
                }
                // 3 Tier Approval

                Utility::insertToRequest($travel, Auth::user(), 'On Duty');

                $setings = Utility::settings();
                if ($setings['trip_send'] == 1) {
                    $employee      = Employee::find($travel->employee_id);

                    $tripArr = [
                        'trip_name' => $employee->name,
                        'purpose_of_visit' => $travel->purpose_of_visit,
                        'start_date'  => $travel->start_date,
                        'end_date'  => $travel->end_date,
                        'place_of_visit' => $travel->place_of_visit,
                        'trip_description' => $travel->description,
                    ];

                    // $resp = Utility::sendEmailTemplate('trip_send', [$employee->id => $employee->email], $tripArr);

                    // return redirect()->route('travel.index')->with('success', __('Travel  successfully created.') . ((!empty($resp) && $resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));
                }
                DB::commit();

                toast('On Duty successfully created.', 'success');
                return redirect()->route('travels.index');
            } catch (Exception $e) {
                DB::rollBack();
                toast('Something went wrong.', 'error');
                return redirect()->route('travels.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('travels.index');
        }
    }

    public function show($id)
    {
        $travel = Travel::find($id);
        $fileType = null;

        if (!is_null($travel->attachment_reject)) {
            $fileType = Utility::getFileType($travel->attachment_reject);
        }

        return view('pages.contents.travel.detail-rejected', compact('travel', 'fileType'));
    }

    public function edit(Travel $travel)
    {
        if (Auth::user()->can('edit on duty')) {
            // $employees = Employee::where('created_by', Auth::user()->creatorId())->get()->pluck('name', 'id');
            if ($travel->created_by == Auth::user()->creatorId()) {
                // 3 Tier Approval
                if (Auth::user()->type == 'company') {
                    $levelApprove = LevelApproval::where('created_by', '=', Auth::user()->creatorId())
                        ->where('company_id', Auth::user()->creatorId())
                        ->first();
                } elseif (Auth::user()->type != 'company' && Auth::user()->type != 'client') {
                    $levelApprove = LevelApproval::where('created_by', '=', Auth::user()->creatorId())
                        ->where('employee_id', isset(Auth::user()->employee) ? Auth::user()->employee->id : 0)
                        ->first();
                }

                $travelApprovals = $travel->travel_approvals()->orderBy('level', 'asc')->get();
                $levelAndApprovals = Utility::getLevelAndApprover($levelApprove, $travelApprovals);
                // 3 Tier Approval

                return response()->json([
                    $travel,
                    'leaveApprovals' => $levelAndApprovals['approver'],
                    'level_approve' => $levelAndApprovals['level']
                ]);
            } else {
                return response()->json(['error' => 'Permission denied.'], 401);
            }
        } else {
            return response()->json(['error' => 'Permission denied.'], 401);
        }
    }

    public function update(Request $request, Travel $travel)
    {
        if (Auth::user()->can('edit on duty')) {
            if ($travel->created_by == Auth::user()->creatorId()) {

                $validator = FacadesValidator::make(
                    $request->all(),
                    [
                        'employee_id' => 'required',
                        'start_date' => 'required',
                        'end_date' => 'required',
                        'purpose_of_visit' => 'required',
                        'place_of_visit' => 'required',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                try {
                    DB::beginTransaction();

                    if ($request->file('attachment_reject')) {
                        $fileName = time() . '_' . $request->file('attachment_reject')->getClientOriginalName();
                        $filePath = $request->file('attachment_reject')->storeAs('public', $fileName);
                        $travel->attachment_reject =  'storage/' . $fileName ?? null;
                    }

                    $travel->employee_id      = $request->employee_id;
                    $travel->start_date       = $request->start_date;
                    $travel->end_date         = $request->end_date;
                    $travel->purpose_of_visit = $request->purpose_of_visit;
                    $travel->place_of_visit   = $request->place_of_visit;
                    $travel->description      = $request->description;
                    // $travel->status           = $request->status;
                    $travel->rejected_reason  =  $request->rejected_reason ?? null;
                    $travel->save();

                    // 3 Tier Approval
                    if (isset($request->status) && $request->status != 0 && isset($request->level_approve) && $travel->status != 'Rejected') {
                        $travelApprove = OnDutyApproval::where('travel_id', $travel->id)
                            ->where('level', $request->level_approve)
                            ->where('status', 'Pending')
                            ->first();


                        if (!is_null($travelApprove)) {
                            //check if employee can be a approver
                            $employee = Employee::find($travelApprove->approver_id);
                            $level = null;
                            if ($employee) {
                                $level = LevelApproval::where('created_by', Auth::user()->creatorId())
                                    ->where('employee_id', $employee->id)
                                    ->first();
                            }

                            if ($travelApprove->is_approver_company && Auth::user()->type == 'company') {
                                if ($request->status == 'Rejected') {
                                    $travelApprove->status = 'Rejected';
                                    $travel->status           =  'Rejected';
                                    $travel->save();
                                } else {
                                    $travelApprove->status = $request->status;
                                }
                                $travelApprove->save();
                            } elseif (!$travelApprove->is_approver_company && Auth::user()->type != 'company' && !is_null($level)) {
                                if ($request->status == 'Rejected') {
                                    $travelApprove->status = 'Rejected';
                                    $travel->status           =  'Rejected';
                                    $travel->save();
                                } else {
                                    $travelApprove->status = $request->status;
                                }

                                $travelApprove->save();
                            }
                        }

                        $countTravelApproved = OnDutyApproval::where('travel_id', $travel->id)
                            ->where('status', 'Approved')
                            ->count();
                        $countLevel = LevelApproval::where('created_by', Auth::user()->creatorId())->count();
                        if ($countTravelApproved == $countLevel) {
                            $travel->status       =  'Approved';
                            $travel->save();
                        }
                    }
                    // 3 Tier Approval


                    DB::commit();
                    toast('On Duty successfully updated.', 'success');
                    return redirect()->route('travels.index');
                } catch (Exception $e) {
                    DB::rollBack();
                    dd($e);
                    toast('Something went wrong.', 'error');
                    return redirect()->route('travels.index');
                }
            } else {
                toast('Permission denied.', 'error');
                return redirect()->route('travels.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('travels.index');
        }
    }

    public function destroy(Travel $travel)
    {
        if (Auth::user()->can('delete on duty')) {
            if ($travel->created_by == Auth::user()->creatorId()) {
                if ($travel->attachment_reject != null) {
                    $fileNameAttReject = explode('/', $travel->attachment_reject);
                    if (Storage::exists('public/' . $fileNameAttReject[1])) {
                        Storage::delete('public/' . $fileNameAttReject[1]);
                    }
                }

                $travel->delete();
                toast('On Duty successfully deleted.', 'success');
                return redirect()->route('travels.index');
            } else {
                toast('Permission denied.', 'error');
                return redirect()->route('travels.index');
            }
        } else {
            toast('Permission denied.', 'error');
            return redirect()->route('travels.index');
        }
    }
}
