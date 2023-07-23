@extends('pages.dashboard')

@section('title', 'Employees')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Edit Employee</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Employee</a></li>
                    <li class="breadcrumb-item active">{{$employeesId ?? 'Employee Detail'}}</li>
                </ul>
            </div>

        </div>
    </div>
    <!-- /Page Header -->


    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{Session::get('success')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    <form action="{{route('employees.update', $employee->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @if (Auth::user()->type != 'employee')
            <div class="row">
                <div class="col-md-6">
                    <div class="card emp_details">
                        <div class="card-header p-3"><h4 class="mb-0">Personal Detail</h4></div>
                        <div class="card-body employee-detail-edit-body fulls-card">

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="form-label">Name</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control"  name="name" type="text" value="{{$employee->name ?? ''}}" id="name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone" class="form-label">Phone</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name="phone" type="number" id="phone" value="{{$employee->phone ?? ''}}">
                                    </div>
                                    <div class="form-group col-md-6">

                                        <label for="dob" class="form-label">Date of Birth</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name="dob" type="date" id="dob" value="{{$employee->dob ?? ''}}">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="gender" class="form-label">Gender</label><span class="text-danger pl-1">*</span>
                                        <div class="d-flex radio-check mt-2">
                                            @if (strtolower($employee->gender) == 'male')
                                                <div class="form-check form-check-inline form-group">
                                                    <input type="radio" id="g_male" value="Male" name="gender" checked class="form-check-input">
                                                    <label class="form-check-label" for="g_male">Male</label>
                                                </div>
                                            @else
                                                <div class="form-check form-check-inline form-group">
                                                    <input type="radio" id="g_male" value="Male" name="gender" class="form-check-input">
                                                    <label class="form-check-label" for="g_male">Male</label>
                                                </div>
                                            @endif

                                            @if (strtolower($employee->gender) == 'female')
                                                <div class="form-check form-check-inline form-group">
                                                    <input type="radio" id="g_female" value="Female" name="gender" checked class="form-check-input">
                                                    <label class="form-check-label" for="g_female">Female</label>
                                                </div>
                                            @else
                                                <div class="form-check form-check-inline form-group">
                                                    <input type="radio" id="g_female" value="Female" name="gender" class="form-check-input">
                                                    <label class="form-check-label" for="g_female">Female</label>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="identity_card" class="form-label">Identity Card Number</label>
                                        <input class="form-control"  name="identity_card" type="text" value="{{$employee->identity_card ?? ''}}" id="name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="identity_card" class="form-label">Family Card Number</label>
                                        <input class="form-control"  name="family_card" type="text" value="{{$employee->family_card ?? ''}}" id="name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="identity_card" class="form-label">Bank Account</label>
                                        <input class="form-control"  name="account_number" type="text" value="{{$employee->account_number ?? ''}}" id="name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="identity_card" class="form-label">NPWP Number</label>
                                        <input class="form-control"  name="npwp_number" type="text" value="{{$employee->npwp_number ?? ''}}" id="name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="religion" class="form-label">Religion</label>
                                        <select class="form-control form-select"  id="religion" name="religion">
                                            <option value="" disabled>-- Select Religion --</option>
                                            <option value="ISLAM">Islam</option>
                                            <option value="KATHOLIK">Katholik</option>
                                            <option value="KRISTEN">Kristen</option>
                                            <option value="HINDU">Hindu</option>
                                            <option value="BUDHA">Budha</option>
                                            <option value="LAIN">Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="marital_status" class="form-label">Marital Status</label>
                                        <select class="form-control select"  id="marital_status" name="marital_status">
                                            <option value="single" {{ ($employee->marital_status == "single") ? 'selected':''}}>Single</option>
                                            <option value="married" {{ ($employee->marital_status == "married") ? 'selected':''}}>Married</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="form-label">Address</label><span class="text-danger pl-1">*</span>
                                        <textarea class="form-control" rows="2" name="address" cols="50" id="address">{{$employee->address ?? ''}}</textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="marital_status" class="form-label">Status</label>
                                        <select class="form-control select"  id="status-employee-edit" name="employee_status">
                                            <option value="0">Select Status</option>
                                            <option value="active" {{ ($employee->status == "active") ? 'selected' : ''}}>Active</option>
                                            @if ($currentDate != $employee->company_doj )
                                                <option value="fired" {{ ($employee->status == "fired") ? 'selected' : ''}}>Fired</option>
                                                <option value="pension" {{ ($employee->status == "pension") ? 'selected' : ''}}>Pension</option>
                                           @endif
                                        </select>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card emp_details">
                        <div class="card-header p-3"><h4 class="mb-0">Employee Data</h4></div>
                        <div class="card-body employee-detail-edit-body fulls-card">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="employee_id" class="form-label">Employee Code</label>
                                    <input class="form-control" disabled="disabled" name="employee_id" type="text" value="{{$employeesId ?? ''}}" id="employee_id">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="employee_id" class="form-label">Employee ID</label>
                                    <input class="form-control" name="no_employee" type="text" value="{{$employee->no_employee ?? ''}}" id="employee_id">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Employee Type</label>
                                    <select class="form-control select"  name="employee_type" id="employee_type">
                                        <option value="" disabled>Select Type</option>
                                        <option value="permanent" {{($employee->employee_type =="permanent") ? 'selected' : ''}}>Permanent</option>
                                        <option value="probation" {{($employee->employee_type =="probation") ? 'selected' : ''}}>Probation</option>
                                        <option value="contract" {{($employee->employee_type =="contract") ? 'selected' : ''}}>Contract</option>
                                        <option value="outsourcing" {{($employee->employee_type =="outsourcing") ? 'selected' : ''}}>Outsourcing</option>
                                        <option value="hl" {{($employee->employee_type =="hl") ? 'selected' : ''}}>Past Daily</option>
                                        <option value="magang" {{($employee->employee_type =="magang") ? 'selected' : ''}}>Magang</option>
                                        <option value="freelancers" {{($employee->employee_type =="freelancers") ? 'selected' : ''}}>Freelancers</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="leave_type" class="form-label">Leave Type</label>
                                    <select class="form-control select"  id="leave_type" name="leave_type">
                                        <option value="0">Select Type</option>
                                        {{-- <option value="monthly">Monthly</option> --}}
                                        <option value="PS" {{($employee->leave_type == 'PS') ? 'selected' : ''}}>Annual Proreta Start</option>
                                        <option value="PE"  {{($employee->leave_type == 'PE') ? 'selected' : ''}}>Annual Proreta End</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="branch_id" class="form-label">Branch</label>
                                    <select class="form-control select" name="branch_id">
                                        <option value="" selected>Select Branch</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{$branch->id }}" {{($branch->id == $employee->branch_id) ? 'selected' : ''}}>{{$branch->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="company_doj" class="form-label">Company Date Of Joining</label>
                                    <input class="form-control" value="{{$employee->company_doj  ?? ''}}"   name="company_doj" type="date" id="company_doj">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="company_doe\" class="form-label">Company Date End</label>
                                    <input class="form-control" value="{{$employee->company_doe  ?? ''}}"   name="company_doe" type="date" id="company_doj">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card emp_details">
                        <div class="card-header p-3 d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Educations</h4>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary" id="add-education"><i class="la la-plus"></i></button>
                            </div>
                        </div>
                        <div class="card-body employee-detail-edit-body fulls-card" >
                            <div id="card-body-education">
                                @php
                                    $index=0;
                                @endphp
                                @forelse ($employeeEducations as $education)
                                <div class="row row-edu" id="{{'education'.$education->id}}">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <input readonly class="form-control" type="text" id="education-institution-readonly-{{$education->id}}" value="{{$education->institution ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="info text-sm text-center">
                                                    @if ($education->start_date && $education->end_date)
                                                            <input readonly type="text" id="{{'education-date'.$education->id}}"  class="form-control" value="{{date("Y", strtotime($education->start_date)).'-'.date("Y", strtotime($education->end_date))}}">
                                                    @endif

                                                    @if ( $education->start_date != null && $education->end_date == null)
                                                        <strong class="font-bold" id="{{'education-date'.$education->id}}" >{{date("Y", strtotime($education->start_date))}}</strong>
                                                        <input readonly type="text" id="{{'education-date'.$education->id}}"  class="form-control" value="{{date("Y", strtotime($education->start_date))}}">
                                                    @endif

                                                    @if ( $education->start_date == null && $education->end_date != null)
                                                        <input readonly type="text" id="{{'education-date'.$education->id}}"  class="form-control" value="{{date("Y", strtotime($education->end_date))}}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 d-flex align-items-center">
                                                <div class="info me-2">
                                                    <button class="btn btn-primary" data-url="{{route('employee.education', $education->id)}}" data-id="{{$education->id}}" id="btn-edit-education"><i class="la la-pencil"></i></button>
                                                </div>
                                                <div class="info">
                                                    <button class="btn btn-danger" id="btn-delete-education" data-url="{{route('employee.education.delete', $education->id)}}" data-bs-toggle="modal" data-bs-target="#delete_education"><i class="la la-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                            <input hidden class="form-control"  name="educations[{{$index}}][id-education]" type="number" value="{{$education->id ?? ''}}" id="id-education-{{$education->id}}">
                                            <input hidden class="form-control"  name="educations[{{$index}}][start_education]" type="date" value="{{$education->start_date ?? ''}}" id="start-education-{{$education->id}}">
                                            <input hidden class="form-control"  name="educations[{{$index}}][end_education]" type="date" id="end-education-{{$education->id}}" value="{{$education->end_date ?? ''}}">
                                            <input hidden class="form-control"  name="educations[{{$index}}][type_education]" type="text" id="type-education-{{$education->id}}" value="{{$education->type ?? ''}}">
                                            <input hidden class="form-control"  name="educations[{{$index}}][level_education]" type="text" id="level-education-{{$education->id}}" value="{{$education->level ?? ''}}">
                                            <input hidden class="form-control" name="educations[{{$index}}][institution_education]" type="text" id="institution-education-{{$education->id}}" value="{{$education->institution ?? ''}}">
                                            <input hidden class="form-control" name="educations[{{$index}}][major_education]" type="text" id="major-education-{{$education->id}}" value="{{$education->major ?? ''}}">
                                            <textarea hidden class="form-control"  rows="2" name="educations[{{$index}}][address_education]" cols="50" id="address-education-{{$education->id}}">{{$education->address ?? ''}}</textarea>
                                </div>
                                    @php
                                        $index++
                                    @endphp
                                @empty
                                <div class="row row-edu">
                                </div>
                                @endforelse

                            </div>

                            <!-- form input data -->
                            <div class="wrapper-form d-flex justify-content-center">
                                <div class="row" style="display: none" id="form-edit-education">
                                    <input type="text" hidden  id="ed-id" value="">
                                    <input type="text" hidden  id="ed-purpose" value="">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="form-label">Start date</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" id="ed-start-date"  type="date" value="" id="name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone" class="form-label">End date</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" id="ed-end-date" type="date" id="phone" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone" class="form-label">Education Type</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" id="ed-type" type="text" id="phone" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone" class="form-label">Education Level</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" id="ed-level" type="text" id="phone" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone" class="form-label">Institution </label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" id="ed-institution" type="text" id="phone" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone" class="form-label">Major </label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" id="ed-major" type="text" id="phone" value="">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="address-education" class="form-label">Address</label><span class="text-danger pl-1">*</span>
                                        <textarea class="form-control" id="ed-address" rows="2" cols="50" id="address-education"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-primary" id="btn-save">Save</button>
                                        <button class="btn btn-info" id="cancel-edit-education">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card emp_details">
                        <div class="card-header p-3 d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Experience</h4>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary" id="add-experience"><i class="la la-plus"></i></button>
                            </div>
                        </div>
                        <div class="card-body employee-detail-edit-body fulls-card">
                            <div id="card-body-experience">
                                @php
                                    $index=0;
                                @endphp
                                @forelse ($employeeExperiences as $experience)
                                <div class="row row-edu" id="{{'experience'.$experience->id}}">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12">
                                            <input readonly class="form-control" type="text" id="experience-job-readonly-{{$experience->id}}" value="{{$experience->job ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="info text-sm text-center">
                                                    @if ($experience->start_date && $experience->end_date)
                                                            <input readonly type="text" id="{{'experience-date'.$experience->id}}"  class="form-control" value="{{date("Y", strtotime($experience->start_date)).'-'.date("Y", strtotime($experience->end_date))}}">
                                                    @endif

                                                    @if ( $experience->start_date != null && $experience->end_date == null)
                                                        <strong class="font-bold" id="{{'experience-date'.$experience->id}}" >{{date("Y", strtotime($experience->start_date))}}</strong>
                                                        <input readonly type="text" id="{{'experience-date'.$experience->id}}"  class="form-control" value="{{date("Y", strtotime($experience->start_date))}}">
                                                    @endif

                                                    @if ( $experience->start_date == null && $experience->end_date != null)
                                                        <input readonly type="text" id="{{'experience-date'.$experience->id}}"  class="form-control" value="{{date("Y", strtotime($experience->end_date))}}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 d-flex align-items-center">
                                                <div class="info me-2">
                                                    <button class="btn btn-primary" data-url="{{route('employee.experience', $experience->id)}}" data-id="{{$experience->id}}" id="btn-edit-experience"><i class="la la-pencil"></i></button>
                                                </div>
                                                <div class="info">
                                                    <button class="btn btn-danger" id="btn-delete-experience" data-url="{{route('employee.experience.delete', $experience->id)}}" data-bs-toggle="modal" data-bs-target="#delete_experience"><i class="la la-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                            <input hidden class="form-control"  name="experiences[{{$index}}][id-experience]" type="number" value="{{$experience->id ?? ''}}" id="id-experience-{{$experience->id}}">
                                            <input hidden class="form-control"  name="experiences[{{$index}}][start_experience]" type="date" value="{{$experience->start_date ?? ''}}" id="start-experience-{{$experience->id}}">
                                            <input hidden class="form-control"  name="experiences[{{$index}}][end_experience]" type="date" id="end-experience-{{$experience->id}}" value="{{$experience->end_date ?? ''}}">
                                            <input hidden class="form-control"  name="experiences[{{$index}}][sequence_experience]" type="text" id="sequence-experience-{{$experience->id}}" value="{{$experience->sequence ?? ''}}">
                                            <input hidden class="form-control" name="experiences[{{$index}}][job_experience]" type="text" id="job-experience-{{$experience->id}}" value="{{$experience->job ?? ''}}">
                                            <input hidden class="form-control"  name="experiences[{{$index}}][position_experience]" type="text" id="position-experience-{{$experience->id}}" value="{{$experience->position ?? ''}}">
                                            <input hidden class="form-control" name="experiences[{{$index}}][city_experience]" type="text" id="city-experience-{{$experience->id}}" value="{{$experience->city ?? ''}}">
                                            <input hidden class="form-control" name="experiences[{{$index}}][reason_leaving_experience]" type="text" id="reason-leaving-experience-{{$experience->id}}" value="{{$experience->reason_leaving ?? ''}}">
                                            <textarea hidden class="form-control"  rows="2" name="experiences[{{$index}}][address_experience]" cols="50" id="address-experience-{{$experience->id}}">{{$experience->address ?? ''}}</textarea>
                                </div>
                                    @php
                                        $index++
                                    @endphp
                                @empty
                                <div class="row row-edu">
                                </div>
                                @endforelse

                            </div>

                            <!-- form input data -->
                            <div class="wrapper-form d-flex justify-content-center">
                                <div class="row" style="display: none" id="form-edit-experience">
                                    <input type="text" hidden  id="ex-id" value="">
                                    <input type="text" hidden  id="ex-purpose" value="">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="form-label">Start date</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name=""  type="date" value="" id="ex-start-date">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone" class="form-label">End date</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name type="date" id="ex-end-date" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone" class="form-label">Sequence</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name type="number" id="ex-sequence" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone" class="form-label">Position</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name type="text" id="ex-position" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone" class="form-label">Job </label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" type="text" id="ex-job" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone" class="form-label">Reason Leaving </label><span class="text-danger pl-1">*</span>
                                        <input class="form-control"  type="text" id="ex-reason-leaving" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone" class="form-label">City </label><span class="text-danger pl-1">*</span>
                                        <input class="form-control"  type="text" id="ex-city" value="">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="address-education" class="form-label">Address</label><span class="text-danger pl-1">*</span>
                                        <textarea class="form-control" rows="2"  cols="50" id="ex-address"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-primary" id="btn-save-ex">Save</button>
                                        <button class="btn btn-info" id="cancel-edit-experience">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card emp_details">
                        <div class="card-header p-3 d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Family</h4>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary" id="add-family"><i class="la la-plus"></i></button>
                            </div>
                        </div>
                        <div class="card-body employee-detail-edit-body fulls-card">
                            <div id="card-body-family">
                                @php
                                    $index=0;
                                @endphp
                                @forelse ($employeeFamilies as $family)
                                <div class="row row-edu" id="{{'family'.$family->id}}">
                                    <div class="col-md-3">
                                        <input readonly class="form-control" type="text" id="family-name-readonly-{{$family->id}}" value="{{ $family->name ?? '' }}">
                                        <div class="form-group col-md-12">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group col-md-12">
                                            <input readonly class="form-control" type="text" id="family-gender-readonly-{{$family->id}}" value="{{ $family->gender ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="info text-sm text-center">
                                                        <input readonly type="text" id="{{'family-relationship-readonly-'.$family->id}}"  class="form-control" value="{{ $family->relationship ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-5 d-flex align-items-center">
                                                <div class="info me-2">
                                                    <button class="btn btn-primary" data-url="{{route('employee.family', $family->id)}}" data-id="{{$family->id}}" id="btn-edit-family"><i class="la la-pencil"></i></button>
                                                </div>
                                                <div class="info">
                                                    <button class="btn btn-danger" id="btn-delete-family" data-url="{{route('employee.family.delete', $family->id)}}" data-bs-toggle="modal" data-bs-target="#delete_family"><i class="la la-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input hidden class="form-control"  name="families[{{$index}}][id-family]" type="number" value="{{$family->id ?? ''}}" id="id-family-{{$family->id}}">
                                    <input hidden class="form-control"  name="families[{{$index}}][name]" type="text" value="{{ $family->name ?? '' }}" id="name-family-{{$family->id}}">
                                    <input hidden class="form-control"  name="families[{{$index}}][gender]" type="text" id="gender-family-{{$family->id}}" value="{{ $family->gender ?? '' }}">
                                    <input hidden class="form-control"  name="families[{{$index}}][relationship]" type="text" id="relationship-family-{{$family->id}}" value="{{ $family->relationship ?? '' }}">
                                    <textarea hidden class="form-control"  rows="2" name="families[{{$index}}][notes]" cols="50" id="notes-family-{{$family->id}}">{{ $family->notes ?? '' }}</textarea>
                                </div>
                                    @php
                                        $index++
                                    @endphp
                                @empty
                                <div class="row row-edu">
                                </div>
                                @endforelse

                            </div>

                            <!-- form input data -->
                            <div class="wrapper-form ">
                                <div class="row" style="display: none" id="form-edit-family">
                                    <input type="text" hidden  id="fam-id" value="">
                                    <input type="text" hidden  id="fam-purpose" value="">
                                    <div class="form-group col-md-12">
                                        <label for="name" class="form-label">Family Name</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name=""  type="text" value="" id="fam-name">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name" class="form-label">Gender </label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name=""  type="text" value="" id="fam-gender" placeholder="ex: Male, Female">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name" class="form-label">Relationship </label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name=""  type="text" value="" id="fam-relationship" placeholder="ex: Aunt, Brother, Father">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name" class="form-label">Notes </label><span class="text-danger pl-1">*</span>
                                        <textarea class="form-control"  rows="2" name="" cols="50" id="fam-notes"></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-primary" id="btn-save-fam">Save</button>
                                        <button class="btn btn-info" id="cancel-edit-family">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="card emp_details">
                        <div class="card-header p-3 d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Medical</h4>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary" id="add-medical"><i class="la la-plus"></i></button>
                            </div>
                        </div>
                        <div class="card-body employee-detail-edit-body fulls-card">
                            <div id="card-body-medical">
                                @php
                                    $index=0;
                                @endphp
                                @forelse ($employeeMedicals as $medical)
                                <div class="row row-edu" id="{{'medical'.$medical->id}}">
                                    <div class="col-md-3">
                                        <input readonly class="form-control" type="text" id="medical-name-readonly-{{$medical->id}}" value="{{ $medical->name ?? '' }}">
                                        <div class="form-group col-md-12">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group col-md-12">
                                            <input readonly class="form-control" type="text" id="medical-gender-readonly-{{$medical->id}}" value="{{ $medical->gender ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="info text-sm text-center">
                                                        <input readonly type="text" id="{{'medical-relationship-readonly-'.$medical->id}}"  class="form-control" value="{{ $medical->relationship ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="col-md-5 d-flex align-items-center">
                                                <div class="info me-2">
                                                    <button class="btn btn-primary" data-url="{{route('employee.medical', $medical->id)}}" data-id="{{$medical->id}}" id="btn-edit-medical"><i class="la la-pencil"></i></button>
                                                </div>
                                                <div class="info">
                                                    <button class="btn btn-danger" id="btn-delete-medical" data-url="{{route('employee.medical.delete', $medical->id)}}" data-bs-toggle="modal" data-bs-target="#delete_medical"><i class="la la-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input hidden class="form-control"  name="families[{{$index}}][id-medical]" type="number" value="{{$medical->id ?? ''}}" id="id-medical-{{$medical->id}}">
                                    <input hidden class="form-control"  name="families[{{$index}}][name]" type="text" value="{{ $medical->name ?? '' }}" id="name-medical-{{$medical->id}}">
                                    <input hidden class="form-control"  name="families[{{$index}}][gender]" type="text" id="gender-medical-{{$medical->id}}" value="{{ $medical->gender ?? '' }}">
                                    <input hidden class="form-control"  name="families[{{$index}}][relationship]" type="text" id="relationship-medical-{{$medical->id}}" value="{{ $medical->relationship ?? '' }}">
                                    <textarea hidden class="form-control"  rows="2" name="families[{{$index}}][notes]" cols="50" id="notes-medical-{{$medical->id}}">{{ $medical->notes ?? '' }}</textarea>
                                </div>
                                    @php
                                        $index++
                                    @endphp
                                @empty
                                <div class="row row-edu">
                                </div>
                                @endforelse

                            </div>

                            <!-- form input data -->
                            <div class="wrapper-form ">
                                <div class="row" style="display: none" id="form-edit-medical">
                                    <input type="text" hidden  id="med-id" value="">
                                    <input type="text" hidden  id="med-purpose" value="">
                                    <div class="form-group col-md-12">
                                        <label for="name" class="form-label">Height (Kg)</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name=""  type="text" value="" id="med-height">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name" class="form-label">Weight (Kg)</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name=""  type="text" value="" id="med-weight" >
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name" class="form-label">Blood Type  </label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name=""  type="text" value="" id="med-blood-type" placeholder="ex: A, B, AB, O">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name" class="form-label">Medical Test  </label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name=""  type="text" value="" id="med-medical-test" placeholder="ex: Passed, Failed">
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-primary" id="btn-save-med">Save</button>
                                        <button class="btn btn-info" id="cancel-edit-medical">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-6">
                    <div class="card emp_details">
                        <div class="card-header p-3"><h4 class="mb-0">Medical</h4></div>
                        <div class="card-body employee-detail-edit-body fulls-card">

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="form-label">Height (Kg)</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name="medicals[height]"  type="text" value="{{$employeeMedical->height ?? '' }}" id="med-height">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name" class="form-label">Weight (Kg)</label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name="medicals[weight]"  type="text" value="{{$employeeMedical->weight ?? '' }}" id="med-weight" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name" class="form-label">Blood Type  </label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name="medicals[blood_type]"  type="text" value="{{$employeeMedical->blood_type ?? ''}}" id="med-blood-type" placeholder="ex: A, B, AB, O">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name" class="form-label">Medical Test  </label><span class="text-danger pl-1">*</span>
                                        <input class="form-control" name="medicals[medical_test]"  type="text" value="{{$employeeMedical->medical_test ?? ''}}" id="med-medical-test" placeholder="ex: Passed, Failed">
                                    </div>

                                </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card emp_details">
                        <div class="card-header p-3"><h4 class="mb-0">Document Detail</h4></div>
                        <div class="card-body employee-detail-edit-body fulls-card">

                                <div class="row">
                                    @php
                                        $employeedoc = $employee->documents()->pluck('document_value','document_id');
                                    @endphp
                                    @foreach($documents as $key=>$document)
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <div class="float-left col-4">
                                                <label for="document" class="float-left pt-1 form-label">{{ $document->name }} @if($document->is_required == 1) <span class="text-danger">*</span> @endif</label>
                                            </div>
                                            <div class="float-right col-6">
                                                <input type="hidden" name="emp_doc_id[{{ $document->id}}]" id="" value="{{$document->id}}">
                                                <div class="choose-file form-group">
                                                    <label for="document[{{ $document->id }}]">
                                                        <input class="form-control @if(!empty($employeedoc[$document->id])) float-left @endif @error('document') is-invalid @enderror border-0" @if($document->is_required == 1 && empty($employeedoc[$document->id]) ) required @endif name="document[{{ $document->id}}]"
                                                        type="file"  data-filename="{{ $document->id.'_filename'}}">
                                                    </label>
                                                    <p class="{{ $document->id.'_filename'}}"></p>

                                                    {{-- @php
                                                        $logo= \App\Models\Utility::get_file('uploads/document/');
                                                    @endphp --}}


                                                </div>

                                                    {{--@if(!empty($employeedoc[$document->id]))--}}
                                                    {{--<br> <span class="text-xs"><a href="{{ (!empty($employeedoc[$document->id])?asset(Storage::asset('uploads/document')).'/'.$employeedoc[$document->id]:'') }}" target="_blank">{{ (!empty($employeedoc[$document->id])?$employeedoc[$document->id]:'') }}</a>--}}
                                                    {{--</span>--}}
                                                    {{--@endif--}}
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                                </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </div>
        @endif
    </form>

</div>
    <!-- /Page Content -->

    <!-- Delete Experience Detail Modal -->
    <div class="modal custom-modal fade" id="delete_experience" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Experience</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                    <div class="d-grid gap-2">
                                        <button id="delete-experience-yes" data-url="" class="btn btn-primary continue-btn" >Delete</button>
                                    </div>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Experience Detail Modal -->

    <!-- Delete Education Detail Modal -->
    <div class="modal custom-modal fade" id="delete_education" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Education</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                    <div class="d-grid gap-2">
                                        <button id="delete-education-yes" data-url="" class="btn btn-primary continue-btn" >Delete</button>
                                    </div>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Education Detail Modal -->

    <!-- Delete Family Detail Modal -->
    <div class="modal custom-modal fade" id="delete_family" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Family</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                    <div class="d-grid gap-2">
                                        <button id="delete-family-yes" data-url="" class="btn btn-primary continue-btn" >Delete</button>
                                    </div>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Family Detail Modal -->
</div>
@endsection

@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endpush

@push('addon-script')
    <!-- Slimscroll JS -->
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

    <!-- Select2 JS -->
    <script src="{{asset('assets/js/select2.min.js')}}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

    <script>
            $(document).ready(function () {
                const employee = JSON.parse('{!! $employee !!}')
                $('#leave_type').val(employee.leave_type != null ? employee.leave_type : 0).trigger('change');
                $('#marital_status').val(employee.marital_status != null ? employee.marital_status : 0).trigger('change');

                $('#status-employee-edit option[value='+ employee.status +']').attr('selected','selected');
                $('#status-employee-edit').val(employee.status ? employee.status : 0).trigger('change');

                branchId = {{ $employee->id }}
                $('.cancel-btn').click(function(e){
                    e.preventDefault()
                })
                $('#branch_id option[value='+ branchId +']').attr('selected','selected');
                $('#branch_id').val(branchId ? branchId : 0).trigger('change');


                //education
                $('body').on('click','#delete-education-yes', function(e){
                    e.preventDefault()

                    const destroyUrl = $(this).attr('data-url')
                        $.ajax(
                        {
                            url: destroyUrl,
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (res){
                                $('#education'+res).remove();
                                $('#delete_education').modal('hide');
                            }
                        });

                })
                $('body').on('click', '#btn-delete-education', function(e){
                    // $(this).closest('.row-edu').remove();
                    e.preventDefault()
                    const destroyUrl = $(this).data('url')
                    $('#delete-education-yes').attr('data-url', destroyUrl);
                })
                $('#btn-save').click(function(e){
                    e.preventDefault()

                    const purpose       = $('#ed-purpose').val()
                    const id            = $('#ed-id').val()
                    const startDate     = $('#ed-start-date').val()
                    const endDate       = $('#ed-end-date').val()
                    const type          = $('#ed-type').val()
                    const level         = $('#ed-level').val()
                    const institution   = $('#ed-institution').val()
                    const major         = $('#ed-major').val()
                    const address       = $('#ed-address').val()

                    const start_year    = startDate.split('-')[0]
                    const end_year      = endDate.split('-')[0]

                    if(purpose == 'add'){
                            let lastEducationName;
                            if($('input[name*="educations"]').last().length > 0){
                                lastEducationName = parseInt($('input[name*="educations"]').last().attr('name').split('[')[1].split(']')[0]) + 1
                            }else{
                                lastEducationName = 1
                            }
                            let date;
                            if (startDate && endDate) {
                                date = `<input readonly type="text" class="form-control" value="${start_year}-${end_year}">`
                            }
                            else if(startDate != '' && endDate == ''){
                                date = `<strong class="font-bold">${start_year}</strong>`
                            }
                            else if(startDate == '' && endDate != ''){
                                date = `<strong class="font-bold">${end_year}</strong>`
                            }

                            let content     = `<div class="row" id="education">
                                                <div class="col-md-6">
                                                    <div class="form-group col-md-12">
                                                        <input readonly class="form-control"  type="text" id="phone" value="${institution}">
                                                        <input class="form-control" hidden type="text" id="phone" value="${institution}">
                                                    </div>
                                                </div>

                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="info text-sm text-center">
                                                                    ${date}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <input hidden class="form-control"   name="educations[${lastEducationName}][start_education]" type="date" value="${startDate}" id="name">
                                                    <input hidden class="form-control"  name="educations[${lastEducationName}][end_education]" type="date" id="phone" value="${endDate}">
                                                    <input hidden class="form-control"  name="educations[${lastEducationName}][type_education]" type="text" id="phone" value="${type}">
                                                    <input hidden class="form-control"  name="educations[${lastEducationName}][level_education]" type="text" id="phone" value="${level}">
                                                    <input hidden class="form-control" name="educations[${lastEducationName}][institution_education]" type="text" id="phone" value="${institution}">
                                                    <input hidden class="form-control" name="educations[${lastEducationName}][major_education]" type="text" id="phone" value="${major}">
                                                    <textarea hidden class="form-control"  rows="2" name="educations[${lastEducationName}][address_education]" cols="50" id="address-education">${address}</textarea>
                                                </div>
                                                `

                            $('#card-body-education').append(content)
                            $('#form-edit-education').hide()
                            $('button[id="btn-edit-education"]').prop('disabled', false);
                            $('button[id="btn-delete-education"]').prop('disabled', false);
                            $('#add-education').prop('disabled', false)

                    }else if(purpose == 'edit'){
                        if (startDate && endDate) {
                            $('#education-date'+id).attr('value', `${start_year}-${end_year}`)
                        }
                        else if(startDate != '' && endDate == ''){
                            $('#education-date'+id).attr('value', `${start_year}`)
                        }
                        else if(startDate == '' && endDate != ''){
                            $('#education-date'+id).attr('value', `${end_year}`)
                        }

                        $('#education-institution-readonly-'+id).attr('value', `${institution}`)

                        // insert into hidden input
                        $('#start-education-'+id).attr('value',startDate)
                        $('#end-education-'+id).attr('value',endDate)
                        $('#type-education-'+id).attr('value',type)
                        $('#level-education-'+id).attr('value',level)
                        $('#institution-education-'+id).attr('value',institution)
                        $('#major-education-'+id).attr('value',major)
                        $('#address-education-'+id).attr('value',address)

                        $('#form-edit-education').hide()
                        $('#add-education').show()
                        $('button[id="btn-edit-education"]').prop('disabled', false);
                        $('button[id="btn-delete-education"]').prop('disabled', false);
                    }

                })


                $('body').on('click', '#btn-edit-education', function(e){
                    e.preventDefault();

                    const idEducation = $(this).data('id')
                    const editUrl = $(this).data('url')
                    $('#ed-purpose').attr('value', 'edit')
                    $('#add-education').hide()

                    $('button[id="btn-edit-education"]').prop('disabled', true);
                    const spinner = `<div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                    </div>`

                    // $('.wrapper-form').html(spinner)

                    $.get( editUrl , (data) => {
                        $('#ed-id').attr('value', idEducation)
                        $('#ed-start-date').val(data?.start_date)
                        $('#ed-end-date').val(data?.end_date)
                        $('#ed-type').val(data?.type)
                        $('#ed-level').val(data?.level)
                        $('#ed-institution').val(data?.institution)
                        $('#ed-major').val(data?.major)
                        $('#ed-address').val(data?.address)
                        $('#form-edit-education').show()
                    });
                })
                $('body').on('click', '#add-education', function(e)
                {
                    e.preventDefault();
                    $('#ed-id').attr('')
                        $('#ed-start-date').val('')
                        $('#ed-end-date').val('')
                        $('#ed-type').val('')
                        $('#ed-level').val('')
                        $('#ed-institution').val('')
                        $('#ed-major').val('')
                        $('#ed-address').val('')

                    $(this).prop('disabled', true)
                    $('button[id="btn-edit-education"]').prop('disabled', true);
                    $('button[id="btn-delete-education"]').prop('disabled', true);
                    $('#form-edit-education').show()
                    $('#ed-purpose').attr('value', 'add')
                })
                $('#cancel-edit-education').click(function(e){
                    e.preventDefault();
                    $('#form-edit-education').hide()
                    $('#add-education').show()
                    $('button[id="btn-edit-education"]').prop('disabled', false);
                    $('button[id="add-education"]').prop('disabled', false);
                    $('button[id="btn-delete-education"]').prop('disabled', false);

                })

                // experience
                $('body').on('click','#delete-experience-yes', function(){
                    const destroyUrl = $(this).attr('data-url')

                        $.ajax({
                            url: destroyUrl,
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (res){
                                $('#experience'+res).remove();
                                $('#delete_experience').modal('hide');
                            }
                        });

                })

                $('body').on('click', '#btn-edit-experience', function(e){
                    e.preventDefault();

                    const idExperience = $(this).data('id')
                    const editUrlExperience = $(this).data('url')
                    $('#ex-purpose').attr('value', 'edit')
                    $('#add-experience').hide()

                    $('button[id="btn-edit-experience"]').prop('disabled', true);
                    const spinner = `<div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                    </div>`

                    // $('.wrapper-form').html(spinner)

                    $.get( editUrlExperience , (data) => {
                        console.log(data);
                        $('#ex-id').attr('value', idExperience)
                        $('#ex-start-date').val(data?.start_date)
                        $('#ex-end-date').val(data?.end_date)
                        $('#ex-sequence').val(data?.sequence)
                        $('#ex-position').val(data?.position)
                        $('#ex-job').val(data?.job)
                        $('#ex-reason-leaving').val(data?.reason_leaving)
                        $('#ex-city').val(data?.city)
                        $('#ex-address').val(data?.address)
                        $('#form-edit-experience').show()
                    });
                })

                $('body').on('click', '#add-experience', function(e)
                {
                    e.preventDefault();
                        $('#ex-id').attr('')
                        $('#ex-start-date').val('')
                        $('#ex-end-date').val('')
                        $('#ex-sequence').val('')
                        $('#ex-position').val('')
                        $('#ex-job').val('')
                        $('#ex-reason-leaving').val('')
                        $('#ex-city').val('')
                        $('#ex-address').val('')

                    $(this).prop('disabled', true);
                    $('button[id="btn-edit-experience"]').prop('disabled', true);
                    $('button[id="btn-delete-experience"]').prop('disabled', true);
                    $('#form-edit-experience').show()
                    $('#ex-purpose').attr('value', 'add')
                })
                $('body').on('click', '#btn-delete-experience', function(e){
                    e.preventDefault()
                    const destroyUrl = $(this).data('url')
                    $('#delete-experience-yes').attr('data-url', destroyUrl);

                })
                $('#cancel-edit-experience').click(function(e){
                    e.preventDefault();
                    $('#form-edit-experience').hide()
                    $('#add-experience').show()
                    $('button[id="add-experience"]').prop('disabled', false);
                    $('button[id="btn-edit-experience"]').prop('disabled', false);
                    $('button[id="btn-delete-experience"]').prop('disabled', false);

                })
                $('#btn-save-ex').click(function(e){
                    e.preventDefault()

                    const purpose       = $('#ex-purpose').val()
                    const id            = $('#ex-id').val()
                    const startDate     = $('#ex-start-date').val()
                    const endDate       = $('#ex-end-date').val()
                    const sequence      = $('#ex-sequence').val()
                    const position      = $('#ex-position').val()
                    const job           = $('#ex-job').val()
                    const reasonLeaving = $('#ex-reason-leaving').val()
                    const city          = $('#ex-city').val()
                    const address       = $('#ex-address').val()

                    const start_year    = startDate.split('-')[0]
                    const end_year      = endDate.split('-')[0]

                    if(purpose == 'add'){
                        let lastexperienceName;
                        if($('input[name*="experiences"]').last().length > 0){
                             lastexperienceName = parseInt($('input[name*="experiences"]').last().attr('name').split('[')[1].split(']')[0]) + 1
                        }else{
                            lastexperienceName = 1
                        }
                            let date;
                            if (startDate && endDate) {
                                date = `<input readonly type="text" readonly class="form-control" value="${start_year}-${end_year}">`
                            }
                            else if(startDate != '' && endDate == ''){
                                date = `<strong class="font-bold">${start_year}</strong>`
                            }
                            else if(startDate == '' && endDate != ''){
                                date = `<strong class="font-bold">${end_year}</strong>`
                            }

                            let content     = `<div class="row" id="experience">
                                                <div class="col-md-6">
                                                    <div class="form-group col-md-12">
                                                        <input readonly class="form-control"  type="text" id="phone" value="${job}">
                                                        <input class="form-control" hidden type="text" id="phone" value="${job}">
                                                    </div>
                                                </div>

                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="info text-sm text-center">
                                                                    ${date}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <input hidden class="form-control"   name="experiences[${lastexperienceName}][start_experience]" type="date" value="${startDate}" id="name">
                                                    <input hidden class="form-control"  name="experiences[${lastexperienceName}][end_experience]" type="date" id="phone" value="${endDate}">
                                                    <input hidden class="form-control"  name="experiences[${lastexperienceName}][sequence_experience]" type="text" id="phone" value="${sequence}">
                                                    <input hidden class="form-control"  name="experiences[${lastexperienceName}][position_experience]" type="text" id="phone" value="${position}">
                                                    <input hidden class="form-control" name="experiences[${lastexperienceName}][job_experience]" type="text" id="phone" value="${job}">
                                                    <input hidden class="form-control" name="experiences[${lastexperienceName}][reason_leaving_experience]" type="text" id="phone" value="${reasonLeaving}">
                                                    <input hidden class="form-control" name="experiences[${lastexperienceName}][city_experience]" type="text" id="phone" value="${city}">
                                                    <textarea hidden class="form-control"  rows="2" name="experiences[${lastexperienceName}][address_experience]" cols="50" id="address-experience">${address}</textarea>
                                                </div>
                                                `

                            $('#card-body-experience').append(content)
                            $('#form-edit-experience').hide()
                            $('button[id="btn-edit-experience"]').prop('disabled', false);
                            $('button[id="btn-delete-experience"]').prop('disabled', false);
                            $('#add-experience').prop('disabled', false)

                    }else if(purpose == 'edit'){
                        if (startDate && endDate) {
                            $('#experience-date'+id).attr('value', `${start_year}-${end_year}`)
                        }
                        else if(startDate != '' && endDate == ''){
                            $('#experience-date'+id).attr('value', `${start_year}`)
                        }
                        else if(startDate == '' && endDate != ''){
                            $('#experience-date'+id).attr('value', `${end_year}`)
                        }

                        $('#experience-job-readonly-'+id).attr('value', `${job}`)

                        // insert into hidden input
                        $('#start-experience-'+id).attr('value',startDate)
                        $('#end-experience-'+id).attr('value',endDate)
                        $('#sequence-experience-'+id).attr('value',sequence)
                        $('#job-experience-'+id).attr('value',job)
                        $('#position-experience-'+id).attr('value',position)
                        $('#reason-leaving-experience-'+id).attr('value',reasonLeaving)
                        $('#city-experience-'+id).attr('value', city)
                        $('#address-experience-'+id).attr('value',address)

                        $('#form-edit-experience').hide()
                        $('#add-experience').show()
                        $('button[id="btn-edit-experience"]').prop('disabled', false);
                        $('button[id="btn-delete-experience"]').prop('disabled', false);
                    }

                })

                // family
                $('body').on('click', '#add-family', function(e)
                {
                    e.preventDefault();
                        $('#fam-id').attr('')
                        $('#fam-name').val('')
                        $('#fam-gender').val('')
                        $('#fam-relationship').val('')
                        $('#fam-notes').val('')

                    $(this).prop('disabled', true);
                    $('button[id="btn-edit-family"]').prop('disabled', true);
                    $('button[id="btn-delete-family"]').prop('disabled', true);
                    $('#form-edit-family').show()
                    $('#fam-purpose').attr('value', 'add')
                })

                $('#cancel-edit-family').click(function(e){
                    e.preventDefault();
                    $('#form-edit-family').hide()
                    $('#add-family').show()
                    $('button[id="btn-edit-family"]').prop('disabled', false);
                    $('button[id="add-family"]').prop('disabled', false);
                    $('button[id="btn-delete-family"]').prop('disabled', false);

                })

                $('body').on('click', '#btn-edit-family', function(e){
                    e.preventDefault();

                    const idFamily = $(this).data('id')
                    const editUrlFamily = $(this).data('url')
                    $('#fam-purpose').attr('value', 'edit')
                    $('#add-family').hide()

                    $('button[id="btn-edit-family"]').prop('disabled', true);


                    $.get( editUrlFamily , (data) => {
                        $('#fam-id').attr('value', idFamily)
                        $('#fam-name').val(data.name)
                        $('#fam-gender').val(data.gender)
                        $('#fam-relationship').val(data.relationship)
                        $('#fam-notes').val(data.notes)
                        $('#form-edit-family').show()

                    });
                })

                $('body').on('click', '#btn-delete-family', function(e){
                    e.preventDefault()
                    const destroyUrl = $(this).data('url')
                    $('#delete-family-yes').attr('data-url', destroyUrl);

                })

                $('body').on('click','#delete-family-yes', function(){
                    const destroyUrl = $(this).attr('data-url')

                        $.ajax({
                            url: destroyUrl,
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (res){
                                $('#family'+res).remove();
                                $('#delete_family').modal('hide');
                            }
                        });

                })

                $('#btn-save-fam').click(function(e){
                    e.preventDefault()

                    const purpose       = $('#fam-purpose').val()
                    const id            = $('#fam-id').val()
                    const name          = $('#fam-name').val()
                    const gender        = $('#fam-gender').val()
                    const relationship  = $('#fam-relationship').val()
                    const notes         = $('#fam-notes').val()

                    if(purpose == 'add'){
                        let lastFamilyId;
                        if($('input[name*="families"]').last().length > 0){
                             lastFamilyId = parseInt($('input[name*="families"]').last().attr('name').split('[')[1].split(']')[0]) + 1
                        }else{
                            lastFamilyId = 1
                        }

                        let content     = `<div class="row row-edu" id="family">
                                    <div class="col-md-3">
                                        <div class="form-group col-md-12">
                                            <input readonly class="form-control" type="text" id="family-name-readonly" value="${name}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group col-md-12">
                                            <input readonly class="form-control" type="text" id="family-name-readonly" value="${gender}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="info text-sm text-center">
                                                        <input readonly type="text" id=""  class="form-control" value="${relationship}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                            <input hidden class="form-control"  name="families[${lastFamilyId}][name]" type="text" value="${name}" id="family-name">
                                            <input hidden class="form-control"  name="families[${lastFamilyId}][gender]" type="text" id="family-gender" value="${gender}">
                                            <input hidden class="form-control"  name="families[${lastFamilyId}][relationship]" type="text" id="family-relationship" value="${relationship}">
                                            <textarea hidden class="form-control"  rows="2" name="families[${lastFamilyId}][notes]" cols="50" id="family-notes">${notes}</textarea>
                                </div>
                                                `

                            $('#card-body-family').append(content)
                            $('#form-edit-family').hide()
                            $('button[id="btn-edit-family"]').prop('disabled', false);
                            $('button[id="btn-delete-family"]').prop('disabled', false);
                            $('#add-family').prop('disabled', false)

                    }else if(purpose == 'edit'){
                        //insert into readonly input
                        $('#family-name-readonly-'+id).attr('value',name)
                        $('#family-gender-readonly-'+id).attr('value',gender)
                        $('#family-relationship-readonly-'+id).attr('value',relationship)
                        $('#family-notes-readonly-'+id).attr('value',notes)


                        // insert into hidden input
                        $('#name-family-'+id).attr('value',name)
                        $('#gender-family-'+id).attr('value',gender)
                        $('#relationship-family-'+id).attr('value',relationship)
                        $('#notes-family-'+id).attr('value',notes)

                        $('#form-edit-family').hide()
                        $('#add-family').show()
                        $('button[id="btn-edit-family"]').prop('disabled', false);
                        $('button[id="btn-delete-family"]').prop('disabled', false);
                    }

                })


                // medical
                $('body').on('click', '#add-medical', function(e)
                {
                    e.preventDefault();
                        $('#med-id').attr('')
                        $('#med-height').val('')
                        $('#med-weight').val('')
                        $('#med-blood-type').val('')
                        $('#med-medical-test').val('')

                    $(this).prop('disabled', true);
                    $('button[id="btn-edit-medical"]').prop('disabled', true);
                    $('button[id="btn-delete-medical"]').prop('disabled', true);
                    $('#form-edit-medical').show()
                    $('#med-purpose').attr('value', 'add')
                })

                $('#cancel-edit-medical').click(function(e){
                    e.preventDefault();
                    $('#form-edit-medical').hide()
                    $('#add-medical').show()
                    $('button[id="btn-edit-medical"]').prop('disabled', false);
                    $('button[id="add-medical"]').prop('disabled', false);
                    $('button[id="btn-delete-medical"]').prop('disabled', false);

                })

                $('body').on('click', '#btn-edit-family', function(e){
                    e.preventDefault();

                    const idFamily = $(this).data('id')
                    const editUrlFamily = $(this).data('url')
                    $('#fam-purpose').attr('value', 'edit')
                    $('#add-family').hide()

                    $('button[id="btn-edit-family"]').prop('disabled', true);


                    $.get( editUrlFamily , (data) => {
                        $('#fam-id').attr('value', idFamily)
                        $('#fam-name').val(data.name)
                        $('#fam-gender').val(data.gender)
                        $('#fam-relationship').val(data.relationship)
                        $('#fam-notes').val(data.notes)
                        $('#form-edit-family').show()

                    });
                })

                $('body').on('click', '#btn-delete-medical', function(e){
                    e.preventDefault()
                    const destroyUrl = $(this).data('url')
                    $('#delete-medical-yes').attr('data-url', destroyUrl);

                })

                $('body').on('click','#delete-medical-yes', function(){
                    const destroyUrl = $(this).attr('data-url')

                        $.ajax({
                            url: destroyUrl,
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (res){
                                $('#medical'+res).remove();
                                $('#delete_medical').modal('hide');
                            }
                        });

                })

                $('#btn-save-med').click(function(e){
                    e.preventDefault()

                    const purpose       = $('#med-purpose').val()
                    const id            = $('#med-id').val()
                    const height        = $('#med-height').val()
                    const weight        = $('#med-weight').val()
                    const bloodType     = $('#med-blood-type').val()
                    const medicalTest   = $('#med-medical-test').val()

                    if(purpose == 'add'){
                        let lastMedicalId;
                        if($('input[name*="medicals"]').last().length > 0){
                             lastMedicalId = parseInt($('input[name*="medicals"]').last().attr('name').split('[')[1].split(']')[0]) + 1
                        }else{
                            lastMedicalId = 1
                        }

                        let content     = `<div class="row row-edu" id="medical">
                                    <div class="col-md-2">
                                        <div class="form-group col-md-12">
                                            <input readonly class="form-control" type="text" id="medical-name-readonly" value="${height}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group col-md-12">
                                            <input readonly class="form-control" type="text" id="medical-name-readonly" value="${weight}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group col-md-12">
                                            <input readonly class="form-control" type="text" id="medical-name-readonly" value="${medicalTest}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="info text-sm text-center">
                                            <input readonly type="text" id=""  class="form-control" value="${bloodType}">
                                        </div>
                                    </div>

                                            <input hidden class="form-control"  name="medicals[${lastMedicalId}][height]" type="text" value="${height}" id="medical-height">
                                            <input hidden class="form-control"  name="medicals[${lastMedicalId}][weight]" type="text" id="medical-weight" value="${weight}">
                                            <input hidden class="form-control"  name="medicals[${lastMedicalId}][blood_type]" type="text" id="medical-relationship" value="${bloodType}">
                                            <input hidden class="form-control"  name="medicals[${lastMedicalId}][medical_test]" type="text" id="medical-relationship" value="${medicalTest}">
                                </div>
                                                `

                            $('#card-body-medical').append(content)
                            $('#form-edit-medical').hide()
                            $('button[id="btn-edit-medical"]').prop('disabled', false);
                            $('button[id="btn-delete-medical"]').prop('disabled', false);
                            $('#add-medical').prop('disabled', false)

                    }else if(purpose == 'edit'){
                        //insert into readonly input
                        $('#medical-name-readonly-'+id).attr('value',name)
                        $('#medical-gender-readonly-'+id).attr('value',gender)
                        $('#medical-relationship-readonly-'+id).attr('value',relationship)
                        $('#medical-notes-readonly-'+id).attr('value',notes)


                        // insert into hidden input
                        $('#name-medical-'+id).attr('value',name)
                        $('#gender-medical-'+id).attr('value',gender)
                        $('#relationship-medical-'+id).attr('value',relationship)
                        $('#notes-medical-'+id).attr('value',notes)

                        $('#form-edit-medical').hide()
                        $('#add-medical').show()
                        $('button[id="btn-edit-medical"]').prop('disabled', false);
                        $('button[id="btn-delete-medical"]').prop('disabled', false);
                    }

                })
            });
    </script>
@endpush
