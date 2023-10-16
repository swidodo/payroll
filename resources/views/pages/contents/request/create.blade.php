@extends('pages.dashboard')

@section('title', 'Create Request')

@section('dashboard-content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Create Request</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Request</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="card col-md-7">
                    <div class="card-header"></div>
                    <div class="modal-body">
                        <form id="addFormPosition" method="POST">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Branch  <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" id="branchId" name="branch_id" required>
                                            @foreach($branch as $branchs)
                                            <option value="{{ $branchs->id }}">{{ $branchs->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger" role="alert">
                                        </div>
                                        
                                    </div>
                                     <div class="form-group">
                                        <label>Employee<span class="text-danger">*</span></label>
                                        <select class="form-control form-select" id="branchId" name="branch_id" required>
                                            @foreach($employee as $employees)
                                            <option value="{{ $employees->id }}">{{ $employees->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger" role="alert">
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Request Type<span class="text-danger">*</span></label>
                                        <select class="form-control form-select" id="branchId" name="branch_id" required>
                                            <option value="0">Attendance</option>
                                            <option value="0">Schedule</option>
                                            <option value="0">Timesheet</option>
                                            <option value="0">Overtime</option>
                                        </select>
                                        <div class="text-danger" role="alert">
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="overtimeForm" class="hidden">
                        <form action="{{route('overtimes.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion" class="control-label" required>Employee ID </label>
                                        <select  class="form-control select-employee" name="employee_id" id="employee_id_add" required>
                                            @if ( !is_null(Auth::user()->employee) )
                                                @foreach ($employee as $e)
                                                    @if ($e->id == Auth::user()->employee->id)
                                                        <option value="{{$e->id}}"  selected>{{$e->name}}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="0">Change Employee</option>
                                                @foreach ($employee as $e)
                                                    <option value="{{$e->id}}">{{$e->no_employee." - ".$e->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @if ($errors->has('employee_id'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('employee_id')[0] }}</strong></small>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date </label>
                                        <input type="date" name="start_date" id="startdate" class="form-control " placeholder="Start Date" required>

                                        @if ($errors->has('start_date'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                            </div>
                                        @endif
                                    </div>
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date </label>
                                        <input type="date" name="start_date" id="enddate" class="form-control " placeholder="End Date" required>

                                        @if ($errors->has('start_date'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                        </div>
                                    @endif
                                    </div>
                                </div>



                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion" class="control-label" required>Overtime Type </label>
                                        <select class="form-control  select-overtime" name="overtime_type_id" id="overtime_id_add" required >
                                            <option value="" selected>Change Overtime Type</option>
                                            @foreach ($overtimeTypes as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('overtime_type_id'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('overtime_type_id')[0] }}</strong></small>
                                        </div>
                                    @endif
                                    </div>
                                </div> --}}


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Start Time </label>
                                        <input type="text" name="start_time" id="time_add" class="form-control" placeholder="00:00" required>

                                        @if ($errors->has('start_time'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('start_time')[0] }}</strong></small>
                                        </div>
                                    @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Time </label>
                                        <input type="text" name="end_time" id="time_add" class="form-control" placeholder="00:00" required>

                                        @if ($errors->has('end_time'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('end_time')[0] }}</strong></small>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion" class="control-label" required="">Day type </label>
                                        <select class="form-control  select-day-type" name="day_type_id" id="daytype_id_add" required >
                                            <option value="" selected>Change Day Type</option>
                                            @foreach ($dayTypes as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('day_type_id'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('day_type_id')[0] }}</strong></small>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                    {{-- <div class="form-group">
                                    <label>duration </label>
                                    <input type="text" name="duration" id="duration" class="form-control " placeholder="duration" required>
                                    </div> --}}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Notes </label>
                                            <input type="text" name="notes" id="notes" class="form-control " placeholder="notes">

                                            @if ($errors->has('notes'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('notes')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>