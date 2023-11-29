<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use App\Models\AllRequest;
use App\Models\Branch;
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
use App\Models\Parameter_pph21;
use App\Models\Departement;
use App\Models\Position;
use App\Models\AccessBranch;
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
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

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
            $user = Auth::user();
            $emp = Employee::where('user_id',Auth::user()->id)->first();
            $data = Branch::where('id',$user->branch_id)->first();
            if ($user->initial =="HO"){
                if(Auth::user()->type == 'company'){
                    $branch['branch'] = Branch::where('company_id',$data->company_id)->get();
                }else{
                    $branch['branch'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                    ->where('access_branches.employee_id',$emp->id)
                                                    ->where('access_branches.company_id',$data->company_id)->get();
                }
            }else{
                $branch['branch'] = Branch::where('id',$user->branch_id)->get();
            }
            return view('pages.contents.employee.index',$branch);
        } else {
            return redirect()->route('employees.index')->with('error', __('Permission denied.'));
        }
    }

    /** ajaxDatatable */
    public function GetDataEmployees(Request $request)
    {
        try {
            /** type user */
            if (Auth::user()->type == 'employee') {
                $employees = Employee::query()->where('user_id', '=', Auth::user()->id)->with('branch');
            } else {
                $employees = Employee::query()->where('branch_id', $request->branch_id)->where('status',$request->status)->with('branch');
            }
            $response = datatables()->eloquent($employees)
                ->addColumn('view_profile', function ($d) {
                    $view = '';
                    $view .= '<h2 class="table-avatar">';
                    if (Auth()->user()->can('show employee profile')) {
                        $url_view = route('employees.show',$d->id);
                        $view .= '<a href="'.$url_view.'" class="btn btn-outline-primary">'.$d->no_employee.'</a>';
                    }else {
                        $view .= '<a href="#" class="avatar"><img src ="https://ui-avatars.com/api/?name='.$d->no_employee.'" alt =""></a><a href = "#" class="btn btn-outline-primary">'.$d->no_employee.'</a>';
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
    public function create()
    {
        $data = DB::table('rotates')
            ->select('*')
            ->orderBy('id','DESC')
            ->get();
        return DataTables::of($data)->make(true);
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        if (Auth::user()->can('view employee')) {
            $empId        = $id;
            $documents    = Document::where('created_by', Auth::user()->creatorId())->get();
            $employee           = Employee::select('employees.*',
                                                    'parameter_pph21s.name as marital_name',
                                                    'branches.name as branch_name',
                                                    'departements.name as department_name',
                                                    'position.position_name')
                                            ->where('employees.id', $empId)
                                            ->leftJoin('parameter_pph21s','parameter_pph21s.code','=','employees.marital_status')
                                            ->leftJoin('branches','branches.id','=','employees.branch_id')
                                            ->leftJoin('departements','departements.id','=','employees.department_id')
                                            ->leftJoin('position','position.id','=','employees.position_id')
                                            ->first();
            // $employement        = Employement::find($employee->id);
            $employeeEducations  = EmployeeEducation::where('employee_id', $employee->id)->get();
            $employeeExperience = EmployeeExperience::find($employee->id);
            $employeeExperiences = EmployeeExperience::where('employee_id', $employee->id)->get();
            $employeeFamilies    = Family::where('employee_id', $employee->id)->get();
            $employeeMedical    = EmployeeMedical::where('employee_id', $employee->id)->first();

            $employeesId  = $employee->employee_id;


            return view('pages.contents.employee.show', compact('employee', 'employeesId', 'employeeEducations', 'employeeExperience', 'employeeExperiences', 'documents', 'employeeFamilies', 'employeeMedical'));
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
            $paramPph21   = Parameter_pph21::get();
            $employee     = Employee::select('employees.*','departements.name as departement_name','position.position_name')
                                        ->where('employees.id', $empId)
                                        ->leftJoin('departements','departements.id','=','employees.department_id')
                                        ->leftJoin('position','position.id','=','employees.position_id')->first();

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


            return view('pages.contents.employee.edit', compact('employee', 'employeesId', 'branches', 'employement', 'employeeEducation', 'employeeExperience', 'employeeExperiences', 'branches', 'employeeEducations', 'documents', 'employeeFamilies', 'employeeMedical', 'currentDate','paramPph21'));
         } else {
            toast('Permission denied.', 'error');
            return redirect()->back();
        }
    }
    public function update(Request $request, $id)
    {
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
            $checktkp = DB::table('take_home_pay')->where('no_employee',$employee->no_employee)->first();
            if($checktkp != null){
                if ($checktkp->no_employee != $request->no_employee ){
                    toast('Employee ID have use take home pay!.', 'error');
                    return redirect()->route('employees.index');
                }
            }

            //document
            if ($request->document) {
                foreach ($request->document as $key => $document) {
                    if (!empty($document)) {
                        $filenameWithExt = $request->file('document')[$key]->getClientOriginalName();
                        $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        $extension       = $request->file('document')[$key]->getClientOriginalExtension();
                        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                        //$dir        = storage_path('uploads/document/');
                        $dir             = 'uploads/document/' ;

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

                        $employee_document = EmployeeDocument::where('employee_id', $employee->id)->where('document_id', $key)->first();

                        if (!empty($employee_document)) {
                            $employee_document->document_value = $fileNameToStore;
                            $employee_document->save();
                        } else {
                            $employee_document                 = new EmployeeDocument();
                            $employee_document->employee_id    = $employee->id;
                            $employee_document->document_id    = $key;
                            $employee_document->document_value = $fileNameToStore;
                            $employee_document->created_by     = Auth::user()->creatorId();
                            $employee_document->save();
                        }
                    }
                }
            }
            
            $getId = Departement::where('departement_code',$request->department)->first();
            if (isset($getId)){
                $request['department'] = $getId->id;
            }else{
                $request['department'] = '';
            }
            $employee = Employee::findOrFail($id);
            $request['leave_type'] = $request->leave_type == 0 ? null : $request->leave_type;
            $request['marital_status'] = $request->marital_status == 0 ? null : $request->marital_status;
            $request['identity_card'] = $request->identity_card == 0 ? null : $request->identity_card;
            $request['family_card'] = $request->family_card == 0 ? null : $request->family_card;
            $request['npwp_number'] = $request->npwp_number == 0 ? null : $request->npwp_number;
            $request['account_number'] = $request->account_number == 0 ? null : $request->account_number;
            $request['religion'] = $request->religion == 0 ? null : $request->religion;
            $request['work_type'] = $request->work_type == 0 ? null : $request->work_type;
            $request['status'] = $request->employee_status == 0 ? null : $request->employee_status;
            $request['no_employee'] = $request->no_employee == 0 ? null : $request->no_employee;
            
            if ($request['status'] == 'fired' || $request['status'] == 'pension' || $request['status'] == 'resign') {
                $request['is_active'] = 0;
                $request['out_date'] = date('Y-m-d');
            }
            //total leave
            if ($request->company_doj != '' || $employee->company_doj != "-" || $request->company_doj != '--' || $request->company_doj != null){
                if($employee->company_doj != "-"){
                    $doj = $employee->company_doj;
                }else{
                    $doj = date('Y-m-d');
                }
                $work       = Carbon::parse($doj)->diffInMonths(date('Y-m-d'));
                $thisMonth  = date('m',strtotime($employee->company_doj));
                $thisday    = date('d',strtotime($employee->company_doj));
                $moreMonth  =  12 - (int)$thisMonth;
            }else{
                $work       = date('Y-m-d');
                $thisMonth  = date('m',strtotime($employee->company_doj));
                $thisday    = date('d',strtotime($employee->company_doj));
                $moreMonth  =  12 - (int)$thisMonth;
            }

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
    public function destroy($id)
    {
        if (Auth::user()->can('delete employee')) {
            $employee      = Employee::findOrFail($id);
            $user          = User::where('id', '=', $employee->user_id)->first();
            $emp_documents = EmployeeDocument::where('employee_id', $employee->id)->get();
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
        try {
            DB::beginTransaction();
            $file_extension = request()->file('upload_file')->extension();
            if ('csv' == $file_extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } elseif ('xls' == $file_extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } elseif ('xlsx' == $file_extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }


            // $reader = new Xls();
            $spreadsheet = $reader->load(request()->file('upload_file'));
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            $employee_arr = [];
            $users        = [];
        
            foreach ($sheetData as $key => $row) {
                // dd($sheetData);
                if ($key > 0){
                $branchId = DB::table('branches')
                                ->select('id')
                                ->where('alias','=',$row[24])
                                ->get()->first();
                // $active = (strtolower($row[24]) === "true") ? true : false;
                
                    if ($branchId != null){
                        $name = strtolower($row[0]);
                        $departementId = DB::table('departements')->select("id")->where('departement_code',$row[14])->where('is_active','1')->first();
                        if($departementId != null){
                            $departId = $departementId->id;
                        }else{
                            $departId = 0;
                        }
                        $positionId = DB::table('position')->select("id")->where('position_code',$row[15])->first();
                        if($positionId != null){
                            $positId = $positionId->id;
                        }else{
                            $positId = 0;
                        }
                        $check = DB::select("select no_employee
                                            from employees
                                            where no_employee ='$row[11]'
                                            AND branch_id ='$branchId->id'");
                        $checkUser = DB::select("select id,email,name
                                            from users
                                            where LOWER(name) = '$name'
                                            and email='$row[10]'");
                        
                        if(count($check) > 0){
                            $doj            = ($row[22] != "" ) ? $row[22] : null;
                            $doe            = ($row[23] != "" ) ? $row[23] : null;
                            $dob            = ($row[4] !="" && $row[4] !='0000-00-00') ? $row[4] : null;
                            $userId         = $checkUser[0]->id;
                            $uptemployee = [
                                "name"                  =>$row[0],
                                "identity_card"         =>$row[1],
                                "family_card"           =>$row[2],
                                "npwp_number"           =>$row[3],
                                "dob"                   =>$dob,
                                "gender"                =>strtoupper($row[5]),
                                "religion"              =>$row[6],
                                "marital_status"        =>strtoupper($row[7]),
                                "phone"                 =>$row[8],
                                "address"               =>$row[9],
                                "email"                 =>$row[10],
                                "no_employee"           =>$row[11],
                                "employee_type"         =>strtoupper($row[12]),
                                "work_type"             =>$row[13],
                                "department_id"         =>$departId,
                                "position_id"           =>$positId,
                                "account_holder_name"   =>$row[16],
                                "bank_name"             =>$row[17],
                                "account_number"        =>$row[18],
                                "bank_identifier_code"  =>$row[19],
                                "branch_location"       =>$row[20],
                                "status"                =>strtolower($row[21]),
                                "company_doj"          => $doj,
                                "company_doe"           => $doe,
                                "branch_id"             =>$branchId->id,
                                "employee_id"           =>User::employeeIdFormat($branchId->id, self::employeeNumber(Auth::user()->creatorId())),
                                "user_id"               =>$userId,
                                // "is_active"             =>$active,
                                "created_by"            =>Auth::user()->creatorId(),
                                "created_at"            => date('Y-m-d h:m:s'),
                                "updated_at"            => date('Y-m-d h:m:s'),
                            ];
                            Employee::where('no_employee',$row[11])->where('branch_id',$branchId->id)->update($uptemployee);
                        }
                        if (count($check) <= 0) {
                            $user = new User();
                            $user->name     = $row[0];
                            $user->email    = $row[10];
                            $user->branch_id = $branchId->id;
                            $user->password = Hash::make('12345678');
                            $user->type     = 'user'; //default
                            $doj            = ($row[22] != "" ) ? $row[22] : null;
                            $doe            = ($row[23] != "" ) ? $row[23] : null;
                            $dob            = ($row[4] !="" && $row[4] !='0000-00-00') ? $row[4] : null;
                            if (count($checkUser) <= 0 ){
                                $data = $user->save();
                                $userId = $user->id;
                            }else{
                                $userId = $checkUser[0]->id;
                            }
                            $employee = [
                                "name"                  =>$row[0],
                                "identity_card"         =>$row[1],
                                "family_card"           =>$row[2],
                                "npwp_number"           =>$row[3],
                                "dob"                   =>$dob,
                                "gender"                =>strtoupper($row[5]),
                                "religion"              =>strtoupper($row[6]),
                                "marital_status"        =>strtoupper($row[7]),
                                "phone"                 =>$row[8],
                                "address"               =>$row[9],
                                "email"                 =>$row[10],
                                "no_employee"           =>$row[11],
                                "employee_type"         =>strtoupper($row[12]),
                                "work_type"             =>$row[13],
                                "department_id"         =>$departId,
                                "position_id"           =>$positId,
                                "account_holder_name"   =>$row[16],
                                "bank_name"             =>$row[17],
                                "account_number"        =>$row[18],
                                "bank_identifier_code"  =>$row[19],
                                "branch_location"       =>$row[20],
                                "status"                =>strtolower($row[21]),
                                "company_doj"          => $doj,
                                "company_doe"           => $doe,
                                "branch_id"             =>$branchId->id,
                                "employee_id"           =>User::employeeIdFormat($branchId->id, self::employeeNumber(Auth::user()->creatorId())),
                                "user_id"               =>$userId,
                                // "is_active"             =>$active,
                                "created_by"            =>Auth::user()->creatorId(),
                                "created_at"            => date('Y-m-d h:m:s'),
                                "updated_at"            => date('Y-m-d h:m:s'),
                            ];

                            array_push($employee_arr,$employee);
                        }
                    }
                }

            }
            $insert = Employee::Insert($employee_arr);
            DB::commit();
            $res = [
                'status' => 'success',
                'msg'    => 'Import Employee successfuly !'
            ];
            return response()->json($res);
            // return redirect('/employees');
        }catch(Exeption $e){
            DB::rollback();
            $res = [
                'status' => 'error',
                'msg'    => 'Someting went wrong !'
            ];
            return response()->json($res);
            // return redirect('/employees');
        }
        // return redirect('/employees');
    }
    public function my_profile(){
        $data['employee'] = Employee::where('user_id',Auth::user()->id)->first();
        $data['user'] = User::where('id',Auth::user()->id)->first();
        $data['branch'] = Branch::where('id',Auth::user()->branch_id)->first();
        $data['company'] = DB::table('companies')->where('id',$data['branch']->company_id)->first();
        return view('pages.contents.employee.my_profile',$data);
    }
    public function change_profile(Request $request){
        $user = [
            'name'  => $request->username,
            'email' => $request->email,
        ];
        $employee = [
            'name'          => $request->name,
            'dob'           => $request->doe,
            'gender'        => $request->gender,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'identity_card' => $request->identity_card,
            'family_card'   => $request->family_card,
            'npwp_number'   => $request->npwp_number,
            'religion'      => $request->religion,
            'bank_name'     => $request->bank_name,
            'account_number'        => $request->account_number,
            'account_holder_name'   => $request->account_holder_name,
        ];
        User::where('id',Auth::user()->id)->update($user);
        $Emp = Employee::where('user_id',Auth::user()->id)->update($employee);
        $res = [
            'status' =>'success',
            'msg' => 'Update Profile successfuly',
        ];
        return response()->json($res);
    }
    public function create_employee(){
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $emp = Employee::where('user_id',Auth::user()->id)->first();
        $data['paramPph21']  = Parameter_pph21::get();
        if (Auth::user()->initial == "HO"){
            if (Auth::user()->type == 'company'){
                $data['branches']      = Branch::where('company_id',$branch->company_id)->get();
            }else{
                $data['branches'] = AccessBranch::leftJoin('branches','branches.id','=','access_branches.branch_id')
                                                    ->where('access_branches.employee_id',$emp->id)
                                                    ->where('access_branches.company_id',$branch->company_id)->get();
            }
            $data['position']      = Position::leftJoin('branches','branches.id','=','position.branch_id')->where('company_id',$branch->company_id)->get();
            $data['department']    = Departement::select('departements.*')->leftJoin('branches','branches.id','=','departements.branch_id')->where('company_id',$branch->company_id)->get();
        // dd($data['department']->id);
        }else{
            $data['branches']      = Branch::where('branch_id',$branch->id)->first();
            $data['department']    = Departement::where('branch_id',$branch->id)->first();
            $data['position']      = Position::where('branch_id',$branch->id)->first();
        }
        return view('pages.contents.employee.add_employee',$data);
    }
    public function get_department_position_ByBranch(Request $request){
        $data['dept'] = Departement::where('branch_id',$request->branch_id)->get();
        $data['posit'] = Position::where('branch_id',$request->branch_id)->get();
        return response()->json($data);
    }
    public function save_create_employee(Request $request){
        $check = DB::select("select no_employee
                            from employees
                            where no_employee ='$request->no_employee'
                            AND branch_id ='$request->branch_id'");
        $checkUser = DB::select("select id,email,name
                                from users
                                where LOWER(name) = '$request->name'
                                and email='$request->email'");

        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->branch_id = $request->branch_id;
        $user->password = Hash::make('12345678');
        $user->type     = 'user'; //default
        $dob            = ($request->dob !="" && $request->dob !='0000-00-00') ? $request->dob : null;
        if (count($checkUser) <= 0 ){
            $data = $user->save();
            $userId = $user->id;
        }else{
            $userId = $checkUser[0]->id;
        }


        $employee = [
            "name"                  => $request->name,
            "identity_card"         => $request->identity_card,
            "family_card"           => $request->family_card,
            "npwp_number"           => $request->npwp_number,
            "dob"                   => $dob,
            "gender"                => strtoupper( $request->gender),
            "religion"              => strtoupper( $request->religion),
            "marital_status"        => strtoupper( $request->marital_status),
            "phone"                 => $request->phone,
            "address"               => $request->address,
            "email"                 => $request->email,
            "no_employee"           => $request->no_employee,
            "employee_type"         => strtoupper( $request->employee_type),
            "work_type"             => $request->work_type,
            "department_id"         => $request->department,
            "position_id"           => $request->position,
            "account_holder_name"   => $request->account_holder_name,
            "bank_name"             => $request->account_nubank_namember,
            "account_number"        => $request->account_number,
            "bank_identifier_code"  => $request->bank_identifier_code,
            "branch_location"       => $request->branch_location,
            "status"                => strtolower( $request->status),
            "company_doj"           => $request->company_doj,
            "company_doe"           => $request->company_doe,
            "branch_id"             =>$request->branch_id,
            "employee_id"           =>User::employeeIdFormat($request->branch_id, self::employeeNumber(Auth::user()->creatorId())),
            "user_id"               =>$userId,
            "is_active"             => 1,
            "created_by"            => Auth::user()->creatorId(),
            "created_at"            => date('Y-m-d h:m:s'),
            "updated_at"            => date('Y-m-d h:m:s'),
        ];
        $save = Employee::insert($employee);
        if ($save){
            return redirect()->back()->with('success','Created employee successfuly !.');
        }else{
           return redirect()->back()->with('success','someting wnt wrong !.');
        }
    }
    
}
