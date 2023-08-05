<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use App\Models\AllRequest;
use App\Models\Branch;
use App\Models\Departement;
use App\Models\Document;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\EmployeeEducation;
use App\Models\EmployeeExperience;
use App\Models\EmployeeMedical;
use App\Models\Employement;
use App\Models\Family;
use App\Models\Leave;
use App\Models\Overtime;
use App\Models\ReqShiftSchedule;
use App\Models\ShiftSchedule;
use App\Models\Timesheet;
use App\Models\Travel;
use App\Models\User;
use App\Models\Utility;
use Carbon\Carbon;
use DataTables;
use Exception;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeeImportExcel;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage employee')) {
            return view('pages.contents.employee.index');
        } else {
            return redirect()->route('employees.index')->with('error', __('Permission denied.'));
        }
    }

    /** ajaxDatatable */
    public function GetDataEmployees()
    {
        try {
            /** type user */
            if (Auth::user()->type == 'employee') {
                $employees = Employee::query()->where('user_id', '=', Auth::user()->id)->with('branch');
            } else {
                $employees = Employee::query()->where('created_by', Auth::user()->creatorId())->with('branch');
            }
            $response = datatables()->eloquent($employees)
                ->addColumn('view_profile', function ($d) {
                    $view = '';
                    $view .= '<h2 class="table-avatar">';
                    if (Auth()->user()->can('show employee profile')) {
                        $url_view = route('employees.show',$d->id);
                        $view .= '<a href="'.$url_view.'" class="btn btn-outline-primary">'.$d->employee_id.'</a>';
                    }else {
                        $view .= '<a href="#" class="avatar"><img src ="https://ui-avatars.com/api/?name='.$d->employee_id.'" alt =""></a><a href = "#" class="btn btn-outline-primary">'.$d->employee_id.'</a>';
                    }
                    $view .= '</h2>';
                    return $view;
                })
                ->addColumn('view_status', function ($d) {
                    $view = '';
                    if (strtolower($d->status) == 'active'){
                        $view .= '<span class="badge bg-inverse-success">'.ucwords($d->status).'</span>';
                    }else if(strtolower($d->status) == 'fired') {
                        $view .= '<span class="badge bg-inverse-danger">'.ucwords($d->status).'</span>';
                    }else if(strtolower($d->status) == 'pension') {
                        $view .= '<span class="badge bg-inverse-info">'.ucwords($d->status).'</span>';
                    }
                    return $view;
                })
                ->addColumn('view', function ($d) {
                    $view = '';
                    if (Auth()->user()->canany(['edit employee', 'delete employee'])) {
                        $view = '<td class="text-end" >
                                        <div class="dropdown dropdown-action" >
                                            <a href = "#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons"> more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">';
                        if (strtolower($d->status) == 'active') {
                            if (Auth()->user()->can('edit employee')) {
                                $url_edit = route('employees.edit', $d->id);
                                $view .= '<a data-url="" id="edit-employee" class="dropdown-item" href="'.$url_edit.'"><i class="fa fa-pencil m-r-5" ></i> Edit</a>';
                            }
                        }
                        if (Auth()->user()->can('delete employee')) {
                            $url_delete = route('employees.destroy', $d->id);
                            $view .= '<a id="delete-employee" data-url="'.$url_delete.'" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                        }

                        $view .= '</div></div></td>';
                    }
                    return $view;
                })
                ->escapeColumns([])
                ->toJson();
        } catch (Throwable $e) {
            /** error response */
            $response = response()->json([
                'draw'            => 0,
                'recordsTotal'    => 0,
                'recordsFiltered' => 0,
                'data'            => [],
                'error'           => $e->getMessage(),
            ]);
        }
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = DB::table('rotates')
            ->select('*')
            ->orderBy('id','DESC')
            ->get();
        return DataTables::of($data)->make(true);
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
        if (Auth::user()->can('view employee')) {
            $empId        = $id;
            $documents    = Document::where('created_by', Auth::user()->creatorId())->get();
            $branches     = Branch::where('created_by', Auth::user()->creatorId())->get()->pluck('name', 'id');
            // $departments  = Department::where('created_by', Auth::user()->creatorId())->get()->pluck('name', 'id');
            // $designations = Designation::where('created_by', Auth::user()->creatorId())->get()->pluck('name', 'id');

            $employee           = Employee::where('id', $empId)->first();
            $employement        = Employement::find($employee->id);
            $employeeEducations  = EmployeeEducation::where('employee_id', $employee->id)->get();
            $employeeExperience = EmployeeExperience::find($employee->id);
            $employeeExperiences = EmployeeExperience::where('employee_id', $employee->id)->get();
            $employeeFamilies    = Family::where('employee_id', $employee->id)->get();
            $employeeMedical    = EmployeeMedical::where('employee_id', $employee->id)->first();

            $employeesId  = $employee->employee_id;


            return view('pages.contents.employee.show', compact('employee', 'employeesId', 'branches', 'employement', 'employeeEducations', 'employeeExperience', 'employeeExperiences', 'documents', 'employeeFamilies', 'employeeMedical'));
            // return view('pages.contents.employee.show', compact('employee', 'employeesId', 'branches', 'departments', 'designations', 'documents'));
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('edit employee')) {
            $empId        = $id;
            $documents    = Document::where('created_by', Auth::user()->creatorId())->get();
            $branches     = Branch::where('created_by', Auth::user()->creatorId())->get();
            $departements     = Departement::where('created_by', Auth::user()->creatorId())->get();
            // $departments  = Department::where('created_by', Auth::user()->creatorId())->get()->pluck('name', 'id');
            // $designations = Designation::where('created_by', Auth::user()->creatorId())->get()->pluck('name', 'id');

            $employee           = Employee::where('id', $empId)->first();

            if (is_null($employee)) {
                return view('pages.contents.employee.edit');
            }

            $employement        = Employement::find($employee->id);
            $employeeEducation  = EmployeeEducation::find($employee->id);
            $employeeEducations  = EmployeeEducation::where('employee_id', $employee->id)->get();
            $employeeExperience = EmployeeExperience::find($employee->id);
            $employeeExperiences = EmployeeExperience::where('employee_id', $employee->id)->get();
            $employeeFamilies    = Family::where('employee_id', $employee->id)->get();
            $employeeMedical    = EmployeeMedical::where('employee_id', $employee->id)->first();
            $employeesId  = $employee->employee_id;
            $currentDate = Carbon::now()->format('Y-m-d');


            return view('pages.contents.employee.edit', compact('employee', 'employeesId', 'branches', 'employement', 'employeeEducation', 'employeeExperience', 'employeeExperiences', 'branches', 'employeeEducations', 'documents', 'employeeFamilies', 'employeeMedical', 'currentDate','departements'));
            // return view('pages.contents.employee.show', compact('employee', 'employeesId', 'branches', 'departments', 'designations', 'documents'));
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
        // dd($request->all());
        if (Auth::user()->can('edit employee')) {
            $validator = Validator::make(
                $request->all(),
                [
                    // 'name' => 'required',
                    // 'dob' => 'required',
                    // 'doe' => 'required',
                    // 'gender' => 'required',
                    // 'phone' => 'required|numeric',
                    // 'address' => 'required',
                    // 'document.*' => 'mimes:jpeg,png,jpg,gif,svg,pdf,doc,zip|max:20480',
                ]
            );

            if ($validator->fails()) {
                toast($validator->messages(), 'error');
                return redirect()->back();
            }

            $employee = Employee::findOrFail($id);
            //document
            if ($request->document) {
                foreach ($request->document as $key => $document) {
                    if (!empty($document)) {
                        $filenameWithExt = $request->file('document')[$key]->getClientOriginalName();
                        $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        $extension       = $request->file('document')[$key]->getClientOriginalExtension();
                        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                        //$dir        = storage_path('uploads/document/');
                        $dir             = 'uploads/document/';

                        $image_path = $dir . $filenameWithExt;

                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }

                        $path = Utility::upload_coustom_file($request, 'document', $fileNameToStore, $dir, $key, []);

                        if ($path['flag'] == 1) {
                            $url = $path['url'];
                        } else {
                            return redirect()->back()->with('error', __($path['msg']));
                        }

                        $employee_document = EmployeeDocument::where('employee_id', $employee->employee_id)->where('document_id', $key)->first();

                        if (!empty($employee_document)) {
                            $employee_document->document_value = $fileNameToStore;
                            $employee_document->save();
                        } else {
                            $employee_document                 = new EmployeeDocument();
                            $employee_document->employee_id    = $employee->employee_id;
                            $employee_document->document_id    = $key;
                            $employee_document->document_value = $fileNameToStore;
                            $employee_document->created_by     = Auth::user()->creatorId();
                            $employee_document->save();
                        }
                    }
                }
            }

            $employee = Employee::findOrFail($id);
            $request['leave_type'] = $request->leave_type == 0 ? null : $request->leave_type;
            $request['marital_status'] = $request->marital_status == 0 ? null : $request->marital_status;
            $request['identity_card'] = $request->identity_card == 0 ? null : $request->identity_card;
            $request['family_card'] = $request->family_card == 0 ? null : $request->family_card;
            $request['npwp_number'] = $request->npwp_number == 0 ? null : $request->npwp_number;
            $request['account_number'] = $request->account_number == 0 ? null : $request->account_number;
            $request['religion'] = $request->religion == 0 ? null : $request->religion;
            $request['status'] = $request->employee_status == 0 ? null : $request->employee_status;
            $request['no_employee'] = $request->no_employee == 0 ? null : $request->no_employee;

            if ($request['status'] == 'fired' || $request['status'] == 'pension' || $request['status'] == 'resign') {
                $request['is_active'] = 0;
                $request['out_date'] = date('Y-m-d');
            }
            //total leavez
            $work       = Carbon::parse($employee->company_doj)->diffInMonths(date('Y-m-d'));
            $thisMonth  = date('m',strtotime($employee->company_doj));
            $thisday    = date('d',strtotime($employee->company_doj));
            $moreMonth  =  12 - (int)$thisMonth;

            if ($work >= 12 ){
                $total_leave =0;
                if ($request->leave_type == "PS"){
                    if ((int)$thisday < 15){
                        $total_leave = (int)$moreMonth + 1;
                    }else{
                        $total_leave = $moreMonth;
                    }
                }
                if($request->leave_type == "PE"){
                    $total_leave = (int)$moreMonth + 1;
                }
               $request['total_leave'] = $total_leave;
            }else{
                $request['total_leave'] = 0;
            }

            $employee->update($request->except(['educations', 'experiences', 'families']));

            //education
            if (isset($request->educations)) {
                foreach ($request->educations as $education) {
                    $employeeEducation = EmployeeEducation::find($education['id-education'] ?? 0);
                    if (!is_null($employeeEducation)) {
                        $employeeEducation->update(
                            [
                                'employee_id'  => $employee->id,
                                'start_date'   => $education['start_education'],
                                'end_date'     => $education['end_education'],
                                'type'         => $education['type_education'],
                                'level'        => $education['level_education'],
                                'institution'  => $education['institution_education'],
                                'major'        => $education['major_education'],
                                'address'      => $education['address_education'],
                            ]
                        );
                    } else {
                        EmployeeEducation::create([
                            'employee_id'  => $employee->id,
                            'start_date'   => $education['start_education'],
                            'end_date'     => $education['end_education'],
                            'type'         => $education['type_education'],
                            'level'        => $education['level_education'],
                            'institution'  => $education['institution_education'],
                            'major'        => $education['major_education'],
                            'address'      => $education['address_education'],
                        ]);
                    }
                }
            }

            //experience
            if (isset($request->experiences)) {
                foreach ($request->experiences as $experience) {
                    $employeeExperience = EmployeeExperience::find($experience['id-experience'] ?? 0);
                    if (!is_null($employeeExperience)) {
                        $employeeExperience->update(
                            [
                                'employee_id'   => $employee->id,
                                'start_date'    => $experience['start_experience'],
                                'end_date'      => $experience['end_experience'],
                                'sequence'      => $experience['sequence_experience'],
                                'job'           => $experience['job_experience'],
                                'position'      => $experience['position_experience'],
                                'city'          => $experience['city_experience'],
                                'reason_leaving' => $experience['reason_leaving_experience'],
                                'address'       => $experience['address_experience'],
                                'note'          => $experience['note_experience'] ?? '',
                            ]
                        );
                    } else {
                        EmployeeExperience::create([
                            'employee_id'   => $employee->id,
                            'start_date'    => $experience['start_experience'],
                            'end_date'      => $experience['end_experience'],
                            'sequence'      => $experience['sequence_experience'],
                            'job'           => $experience['job_experience'],
                            'position'      => $experience['position_experience'],
                            'city'          => $experience['city_experience'],
                            'reason_leaving' => $experience['reason_leaving_experience'],
                            'address'       => $experience['address_experience'],
                            'note'          => $experience['note_experience'] ?? '',
                        ]);
                    }
                }
            }

            //family
            if (isset($request->families)) {
                foreach ($request->families as $family) {
                    $employeeFamily = Family::find(isset($family['id-family']) ? $family['id-family'] : 0);

                    if (!is_null($employeeFamily)) {
                        $employeeFamily->update([
                            'employee_id'  => $employee->id,
                            'name'          => $family['name'],
                            'gender'        => $family['gender'],
                            'relationship'  => $family['relationship'],
                            'notes'         => $family['notes'],
                        ]);
                    } else {
                        Family::create([
                            'employee_id'  => $employee->id,
                            'name'          => $family['name'],
                            'gender'        => $family['gender'],
                            'relationship'  => $family['relationship'],
                            'notes'         => $family['notes'],
                        ]);
                    }
                }
            }

            //medical
            if (isset($request->medicals)) {
                // dd($request->all());
                $employeeMedical = employeeMedical::where('employee_id', $employee->id)->first();

                if (!is_null($employeeMedical)) {
                    $employeeMedical->update([
                        'employee_id'  => $employee->id,
                        'height'          => $request->medicals['height'],
                        'weight'        => $request->medicals['weight'],
                        'blood_type'  => $request->medicals['blood_type'],
                        'medical_test'         => $request->medicals['medical_test'],
                    ]);
                } else {
                    employeeMedical::create([
                        'employee_id'  => $employee->id,
                        'height'          => $request['height'],
                        'weight'        => $request['weight'],
                        'blood_type'  => $request['blood_type'],
                        'medical_test'         => $request['medical_test'],
                    ]);
                }
            }

            $user = User::where('id', $employee->user_id)->first();
            if (!empty($user)) {
                $user->name = $employee->name;
                $user->email = $employee->email;
                $user->save();
            }

            if ($request->salary) {
                toast('Employee successfully updated.', 'success');
                return redirect()->route('setsalary.index');
            }

            if (Auth::user()->type != 'employee') {
                toast('Employee successfully updated.', 'success');
                return redirect()->route('employees.show', $employee->id);
            } else {
                toast('Employee successfully updated.', 'success');
                return redirect()->route('employees.index');
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
        if (Auth::user()->can('delete employee')) {
            $employee      = Employee::findOrFail($id);
            $user          = User::where('id', '=', $employee->user_id)->first();
            $emp_documents = EmployeeDocument::where('employee_id', $employee->employee_id)->get();
            $employee->delete();
            $user->delete();
            $dir = storage_path('uploads/document/');
            foreach ($emp_documents as $emp_document) {
                $emp_document->delete();
                if (!empty($emp_document->document_value)) {
                    unlink($dir . $emp_document->document_value);
                }
            }

            toast('Employee successfully deleted.', 'success');
            return redirect()->route('employees.index', $id);
        } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }

    public function employeeEducations(EmployeeEducation $employeeEducation)
    {
        return $employeeEducation;
    }

    public function employeeExperiences(EmployeeExperience $employeeExperience)
    {
        return $employeeExperience;
    }

    public function employeeFamily(Family $employeeFamily)
    {
        return $employeeFamily;
    }

    public function employeeMedical(EmployeeMedical $employeeMedical)
    {
        return $employeeMedical;
    }

    public function deleteExperience(EmployeeExperience $experience)
    {
        $experience->delete();
        return response()->json($experience->id);
    }

    public function deleteEducation(EmployeeEducation $education)
    {
        $education->delete();
        return response()->json($education->id);
    }

    public function deleteFamily(Family $family)
    {
        $family->delete();
        return response()->json($family->id);
    }

    public function deleteMedical(employeeMedical $medical)
    {
        $medical->delete();
        return response()->json($medical->id);
    }

    public function employeeRequest()
    {
        if (Auth::user()->can('show employee request')) {
            $allReqs = AllRequest::where('created_by', Auth::user()->creatorId())->where('status', 'Pending')->get();

            return view('pages.contents.employee-request.index', compact('allReqs'));
        }
    }

    public function dataRequest($id)
    {
        $allReq = AllRequest::find($id);

        if ($allReq->request_type == 'On Duty') {
            $model = Travel::find($allReq->request_id);
        } elseif ($allReq->request_type == 'Leave') {
            $model = Leave::with('leave_type')->where('id', $allReq->request_id)->first();
        } elseif ($allReq->request_type == 'Overtime') {
            $model = Overtime::with('overtime_type', 'day_type')->where('id', $allReq->request_id)->first();
        } elseif ($allReq->request_type == 'Request Shift Schedule') {
            $model = ReqShiftSchedule::with('shift_schedules.shift_type')->where('id', $allReq->request_id)->first();
        } elseif ($allReq->request_type == 'Timesheet') {
            $model = Timesheet::where('id', $allReq->request_id)->first();
        }

        return response()->json([$allReq, $model]);
    }

    public function approveRequest(Request $request)
    {
        $allReq = AllRequest::find($request->employee_request_id);

        try {
            DB::beginTransaction();
            if ($allReq->request_type == 'On Duty') {
                $model = Travel::find($allReq->request_id);
                $model->status = 'Approved';
                $allReq->status = 'Approved';
            } elseif ($allReq->request_type == 'Leave') {
                $model = Leave::with('leave_type')->where('id', $allReq->request_id)->first();
                $model->status = 'Approved';
                $allReq->status = 'Approved';
            } elseif ($allReq->request_type == 'Overtime') {
                $model = Overtime::with('overtime_type', 'day_type')->where('id', $allReq->request_id)->first();
                $model->status = 'Approved';
                $allReq->status = 'Approved';
            } elseif ($allReq->request_type == 'Request Shift Schedule') {
                $model = ReqShiftSchedule::with('shift_schedules.shift_type')->where('id', $allReq->request_id)->first();
                $shiftSchedulesApproved = ShiftSchedule::where('req_shift_schedules_id', $model->id)->where('status', 'Approved')->where('created_by', '=', Auth::user()->creatorId())->get();
                $shiftSchedulesPending = ShiftSchedule::where('req_shift_schedules_id', $model->id)->where('status', 'Pending')->where('created_by', '=', Auth::user()->creatorId())->get();

                foreach ($shiftSchedulesApproved as $key) {
                    $key->req_shift_schedules_id   = null;
                    $key->schedule_date            = $key['schedule_date'];
                    $key->shift_id                 = 1;
                    $key->status                   = 'Approved';
                    $key->save();
                }


                foreach ($shiftSchedulesPending as $key) {

                    $shifSchedule = ShiftSchedule::where('employee_id', $model->employee_id)->where('schedule_date', Carbon::parse($key['schedule_date'])->format('Y-m-d'))->where('status', 'Approved')->first();


                    $shifSchedule->req_shift_schedules_id   = $model->id;
                    $shifSchedule->schedule_date            = Carbon::parse($key['schedule_date'])->format('Y-m-d');
                    $shifSchedule->shift_id                 = $key['shift_id'];
                    $shifSchedule->status                   = 'Approved';
                    $shifSchedule->save();
                }
                foreach ($shiftSchedulesPending as $key) {
                    $key->delete();
                }
                $allReq->status = 'Approved';
                $model->status = 'Approved';
            } elseif ($allReq->request_type == 'Timesheet') {
                $model = Timesheet::where('id', $allReq->request_id)->first();
                $model->status = 'Approved';
                $allReq->status = 'Approved';
            }
            $allReq->save();
            $model->save();
            DB::commit();
            toast('Approve Success.', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            toast('Something went wrong.', 'error');
            return redirect()->back();
        }
    }

    public function rejectRequest(Request $request)
    {
        $allReq = AllRequest::find($request->employee_request_id);

        try {
            DB::beginTransaction();
            if ($allReq->request_type == 'On Duty') {
                $model = Travel::find($allReq->request_id);
                if ($request->file('attachment_reject')) {
                    $fileName = time() . '_' . $request->file('attachment_reject')->getClientOriginalName();
                    $filePath = $request->file('attachment_reject')->storeAs('public', $fileName);
                    $model->attachment_reject =  'storage/' . $fileName ?? null;
                }
                $model->rejected_reason  =  $request->rejected_reason ?? null;

                $model->status = 'Rejected';
                $allReq->status = 'Rejected';
            } elseif ($allReq->request_type == 'Leave') {

                $model = Leave::with('leave_type')->where('id', $allReq->request_id)->first();

                if ($request->file('attachment_reject')) {
                    $fileName = time() . '_' . $request->file('attachment_reject')->getClientOriginalName();
                    $filePath = $request->file('attachment_reject')->storeAs('public', $fileName);
                    $model->attachment_reject =  'storage/' . $fileName ?? null;
                }
                $model->rejected_reason  =  $request->rejected_reason ?? null;
                $model->status = 'Rejected';
                $allReq->status = 'Rejected';
            } elseif ($allReq->request_type == 'Overtime') {
                $model = Overtime::with('overtime_type', 'day_type')->where('id', $allReq->request_id)->first();
                if ($request->file('attachment_reject')) {
                    $fileName = time() . '_' . $request->file('attachment_reject')->getClientOriginalName();
                    $filePath = $request->file('attachment_reject')->storeAs('public', $fileName);
                    $model->attachment_reject =  'storage/' . $fileName ?? null;
                }
                $model->rejected_reason  =  $request->rejected_reason ?? null;
                $model->status = 'Rejected';
                $allReq->status = 'Rejected';
            } elseif ($allReq->request_type == 'Request Shift Schedule') {
                $model = ReqShiftSchedule::with('shift_schedules.shift_type')->where('id', $allReq->request_id)->first();
                $shiftSchedulesApproved = ShiftSchedule::where('req_shift_schedules_id', $model->id)->where('status', 'Approved')->where('created_by', '=', Auth::user()->creatorId())->get();
                $shiftSchedulesPending = ShiftSchedule::where('req_shift_schedules_id', $model->id)->where('status', 'Pending')->where('created_by', '=', Auth::user()->creatorId())->get();

                foreach ($shiftSchedulesPending as $key) {
                    $shifSchedulePending = ShiftSchedule::where('employee_id', $model->employee_id)->where('schedule_date', Carbon::parse($key['schedule_date'])->format('Y-m-d'))->where('status', 'Pending')->first();
                    // dd($shifSchedulePending);


                    if ($request->file('attachment_reject')) {
                        $fileName = time() . '_' . $request->file('attachment_reject')->getClientOriginalName();
                        $filePath = $request->file('attachment_reject')->storeAs('public', $fileName);
                        $model->attachment_reject        =  'storage/' . $fileName ?? null;
                    }

                    $shifSchedulePending->req_shift_schedules_id   = $model->id;
                    $shifSchedulePending->schedule_date            = $key['schedule_date'];
                    $shifSchedulePending->shift_id                 = $key['shift_id'];
                    $shifSchedulePending->status                   = 'Rejected'; // data bisa dinamis sesuai request->status

                    $model->rejected_reason          =  $request->rejected_reason ?? null;

                    $shifSchedulePending->save();
                }

                $allReq->status = 'Rejected';
                $model->status = 'Rejected';
            } elseif ($allReq->request_type == 'Timesheet') {
                $model = Timesheet::where('id', $allReq->request_id)->first();

                if ($request->file('attachment_reject')) {
                    $fileName = time() . '_' . $request->file('attachment_reject')->getClientOriginalName();
                    $filePath = $request->file('attachment_reject')->storeAs('public', $fileName);
                    $model->attachment_reject =  'storage/' . $fileName ?? null;
                }
                $model->rejected_reason  =  $request->rejected_reason ?? null;
                $model->status = 'Rejected';
                $allReq->status = 'Rejected';
            }
            $allReq->save();
            $model->save();
            DB::commit();
            toast('Reject Success.', 'success');
            return redirect()->back();
        } catch (Exception $th) {
            DB::rollBack();
            dd($th);
            toast('Something went wrong.', 'error');
            return redirect()->back();
        }
    }
    // function auto number
    public static function employeeNumber($created_by)
    {
        $latest = Employee::where('created_by', $created_by)->latest()->first();

        if (!$latest) {
            return 1;
        }

        return $latest->id + 1;
    }
    // import data
    public function import_data(Request $request){

       // validasi
		// $this->validate($request, [
		// 	'upload_file' => 'required|mimes:csv,xls,xlsx'
		// ]);

		// menangkap file excel
		$file = $request->file('upload_file');
		// membuat nama file unik
		$nama_file = rand().str_replace(" ","-",$file->getClientOriginalName());
		// upload ke folder file_siswa di dalam folder public
		$file->move('public/uploads',$nama_file);
        chmod(public_path('uploads/'.$nama_file), 777);


        // update new
        $filpath = public_path('/uploads/'.$nama_file);
        $arr_dataApi =[];
        $pengajuan = [];
        $success = 0;
        $fail = 0;
        $data  = $this->read_files($filpath);
        $employee_arr = [];
        $users        = [];
        $error        = 0;
        $success      = 0;
        foreach ($data as $key => $row) {
            if ($key > 0){
                $branchId = DB::table('branches')
                                ->select('id')
                                ->where('alias',$row[11])
                                ->get()->first();
                $active = (strtolower($row[24]) === "true") ? true : false;
                if ($branchId != null){
                    $name = strtolower($row[0]);
                    $check = DB::select("select name,dob
                                        from employees
                                        where LOWER(name) = '$name'
                                        and dob='$row[4]'
                                        and email='$row[10]'");
                    if(count($check) <= 0){
                        $user = new User();
                        $user->name     = $row[0];
                        $user->email    = $row[10];
                        $user->password = 'phadir123';//default
                        $user->type     = 'user'; //default
                        $doj            = ($row[14] != "" ) ? $row[14] : '0000-00-00';
                        $doe            = ($row[15] != "" ) ? $row[15] : '0000-00-00';
                        $out_date       = ($row[22] != "" ) ? $row[22] : '0000-00-00';
                        if($user->save()){
                            $employee = [
                                "name"                  =>$row[0],
                                "identity_card"         =>$row[1],
                                "family_card"           =>$row[2],
                                "npwp_number"           =>$row[3],
                                "dob"                   =>$row[4],
                                "gender"                =>$row[5],
                                "religion"              =>$row[6],
                                "marital_status"        =>$row[7],//value harus sesuai format yang aaaada dioptionnya
                                "phone"                 =>$row[8],
                                "address"               =>$row[9],
                                "email"                 =>$row[10],
                                "department_id"         =>$row[12],//belum diget
                                "no_employee"           =>$row[13],//belum diget
                                "company_doj"           => $doj,
                                "company_doe"           => $doe,
                                "account_holder_name"   =>$row[16],
                                "account_number"        =>$row[17],
                                "bank_name"             =>$row[18],
                                "bank_identifier_code"  =>$row[19],
                                "branch_location"       =>$row[20],
                                "employee_type"         =>$row[21],//value harus sama dengan optionnya
                                "out_date"              =>$out_date,
                                "status"                =>$row[23],
                                "user_id"               =>$user->id,
                                "branch_id"             =>$branchId->id,
                                "employee_id"           =>User::employeeIdFormat($branchId->id, self::employeeNumber(Auth::user()->creatorId())),
                                "is_active"             =>$active,
                                "created_by"            =>Auth::user()->creatorId(),
                            ];
                            array_push($employee_arr,$employee);
                        }
                    }
                }
            }
        }
        Employee::Insert($employee_arr);
   return redirect('/employees');
    }
    public function read_files($filename)
    {
       if (($open = fopen($filename, "r")) !== FALSE) {
			$array = [];
            while (($data = fgetcsv($open, 100000, ";")) !== FALSE) {
				if(count($data) > 0 ){
                	$array[] = $data;
				}
            }

            fclose($open);
            return $array;
        }
        return false;
    }
}
