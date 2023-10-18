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
                <div class="card col-md-8">
                    <div class="card-header">Form Request</div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Request Date <span class="text-danger">*</span></label>
                                    <input type="date" name="date" id="date_request" class="form-control" value="{{ date('Y-m-d');}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Branch  <span class="text-danger">*</span></label>
                                    <select class="form-control form-select" id="branchId" name="branch_id" required>
                                        @foreach($branch as $branchs)
                                        <option value="{{ $branchs->id }}">{{ $branchs->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger" role="alert">
                                    </div>
                                </div>
                                 <div class="form-group col-md-6">
                                    <label>Employee<span class="text-danger">*</span></label>
                                    <select class="form-control form-select" id="employeeId" name="employee_id" required>
                                        @foreach($employee as $employees)
                                        <option value="{{ $employees->id }}">{{ $employees->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger" role="alert">
                                    </div>
                                    
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Request Type<span class="text-danger">*</span></label>
                                    <select class="form-control form-select" id="request-options" name="request_type" required>
                                        <option value="" disabled selected>-- request options -- </option>
                                        <option value="attendance">Attendance</option>
                                        <option value="schedule">Schedule</option>
                                        <option value="timesheet">Timesheet</option>
                                        <option value="overtime">Overtime</option>
                                        <option value="leave">Leave</option>
                                    </select>
                                    <div class="text-danger" role="alert">
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                        <!-- form attendance ================================================== -->
                        <div id="attendanceForm" hidden>
                            <form id="formattendance">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="mt-3">Date</label>
                                        <input type="date" name="date" id="attendance_date" class="form-control  mb-3" required>
                                        <label>Status</label>
                                        <select class="form-control form-select mb-3" name="status" id="attendance_status" required>
                                            <option value="Present" selected>Present</option>
                                           <!--  <option value="Alpha">Alpha</option>
                                            <option value="Leave">Leave</option>
                                            <option value="Sick">Sick</option>
                                            <option value="Permit">Permit</option>
                                            <option value="Dispensation">Dispensation</option> -->
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mt-3">Clock In</label>
                                        <input type="time" name="clock_in" class="form-control mb-3" id="attendance_clock_in" required>
                                        <label>Clock Out</label>
                                        <input type="time" name="clock_out" class="form-control mb-3"id="attendance_clock_out" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="leave_reason" class="form-label">Description</label>
                                        <textarea class="form-control" placeholder="description" name="description" cols="50" rows="3" id="description_attendance"></textarea>
                                    </div>
                                </div>
                                
                                <hr/>
                                <div id="item1"></div>
                                <button type="submit" class="btn btn-primary float-end">Save</button>
                                <button type="button" class="btn btn-warning float-end me-1" id="btnAddinput">+</button>
                            </form>
                        </div>
                        <!-- form schedule ===================================================== -->
                        <div id="scheduleFrom"></div>
                        <!-- form Timesheet ==================================================== -->
                        <div id="timesheetForm" hidden>
                            <form action="{{route('timesheets.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="religion" class="control-label" required>Employee ID </label>
                                            <select  class="form-control select-employee" name="employee_id" id="employee_id_add" required>
                                                <option value=""  selected></option>
                                            </select>

                                            @if ($errors->has('employee_id'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('employee_id')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="project_stage_id" class="control-label" required>Project stage</label>
                                            <select  class="form-control select-project-stage-add" name="project_stage" id="project_stage_add" >
                                                <option value="0">Select </option>
                                                <option value="Dinas Luar Kota">Dinas Luar Kota </option>
                                                <option value="Dinas Dalam Kota">Dinas Dalam Kota </option>
                                            </select>

                                            @if ($errors->has('project_stage'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('project_stage')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Task / Project </label>
                                            <input type="text" name="task_or_project" id="task_or_project" class="form-control " required>

                                            @if ($errors->has('task_or_project'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('task_or_project')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Date </label>
                                            <input type="date" name="start_date" id="startdate" class="form-control " placeholder="Start Date" required>

                                            @if ($errors->has('start_date'))
                                                <div class="text-danger" role="alert">
                                                    <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Date </label>
                                            <input type="date" name="end_date" id="enddate" class="form-control " placeholder="End Date" required>

                                            @if ($errors->has('end_date'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('end_date')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Activity</label>
                                            <input type="text" name="activity" id="activity" class="form-control " required>

                                            @if ($errors->has('activity'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('activity')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Client Company</label>
                                            <input type="text" name="client_company" id="client_company" class="form-control " required>

                                            @if ($errors->has('client_company'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('client_company')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Label Project</label>
                                            <input type="text" name="label_project" id="label_project" class="form-control " required>

                                            @if ($errors->has('label_project'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('label_project')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Support</label>
                                            <input type="text" name="support" id="support" class="form-control " required>

                                            @if ($errors->has('support'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('support')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>File Attachment</label>
                                            <input class="form-control" type="file" id="formFile" name="attachment">

                                            @if ($errors->has('attachment'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('attachment')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Remark </label>
                                            <textarea name="remark" id="remark" cols="30" rows="2" class="form-control"></textarea>

                                            @if ($errors->has('remark'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('remark')[0] }}</strong></small>
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
                        <!-- form overtime =================================================== -->
                        <div id="overtimeForm" class="hidden" hidden>
                            <form id="formovertime" method="POST">
                               <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date </label>
                                            <input type="date" name="start_date" id="start_date_overtime" class="form-control" required>

                                            @if ($errors->has('start_date'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="religion" class="control-label" required="">Day type </label>
                                            <select class="form-control  select-day-type" name="day_type_id" id="daytype_id_overtime"  required>
                                            </select>

                                            @if ($errors->has('day_type_id'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('day_type_id')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Time </label>
                                            <input type="time" name="start_time" id="time_start_overtime" class="form-control" placeholder="00:00" required>

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
                                            <input type="time" name="end_time" id="time_end_overtime" class="form-control" placeholder="00:00" required>

                                            @if ($errors->has('end_time'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('end_time')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Notes </label>
                                                <input type="text" name="notes" id="notes_overtime" class="form-control " placeholder="notes">

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
                        <!-- form Leave ========================================================== -->
                        <div id="leaveForm" hidden>
                            <form  method="POST"  id="formLeave">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="leave_type_id" class="form-label">Leave Type</label>
                                            <select name="leave_type_id" id="leave_type_id" class="form-control form-select select-leave-type">
                                                <option value="0">Select Leave Type</option>
                                            </select>
                                                @if ($errors->has('employee_id'))
                                                    <div class="text-danger" role="alert">
                                                        <small><strong>{{ $errors->get('employee_id')[0] }}</strong></small>
                                                    </div>
                                                @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="start_date" class="form-label">Start Date</label>
                                                    <input class="form-control" name="start_date" type="date" id="start_date_leave">

                                                    @if ($errors->has('start_date'))
                                                        <div class="text-danger" role="alert">
                                                            <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="end_date" class="form-label">End Date</label>
                                                    <input class="form-control" name="end_date" type="date" id="end_date_leave">
                                                </div>

                                                @if ($errors->has('end_date'))
                                                    <div class="text-danger" role="alert">
                                                        <small><strong>{{ $errors->get('end_date')[0] }}</strong></small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="leave_reason" class="form-label">Leave Reason</label>
                                            <textarea class="form-control" placeholder="Leave Reason" name="leave_reason" cols="50" rows="3" id="leave_reason"></textarea>

                                            @if ($errors->has('leave_reason'))
                                                    <div class="text-danger" role="alert">
                                                        <small><strong>{{ $errors->get('leave_reason')[0] }}</strong></small>
                                                    </div>
                                                @endif
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="formFile" class="form-label">Attachment (opsional)</label>
                                            <input name="attachment_request" class="form-control" type="file" id="attachment_leave">
                                            <a href="" id="attachment_rejected_add_anchor"></a>
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
@endsection

@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/sweetalert2.min.css')}}">
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
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
 <script>
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        $(document).ready(function () {
            $('#request-options').on('change',function(){
                $type = $('#request-options').val();
                if ($type == "attendance"){
                    $('#attendanceForm').attr('hidden',false);
                    $('#scheduleFrom').attr('hidden',true);
                    $('#timesheetForm').attr('hidden',true);
                    $('#overtimeForm').attr('hidden',true);
                    $('#leaveForm').attr('hidden',true);

                }else if($type == "schedule"){
                    $('#attendanceForm').attr('hidden',true);
                    $('#scheduleFrom').attr('hidden',false);
                    $('#timesheetForm').attr('hidden',true);
                    $('#overtimeForm').attr('hidden',true);
                    $('#leaveForm').attr('hidden',true);
                }else if($type == "timesheet"){
                    $('#attendanceForm').attr('hidden',true);
                    $('#scheduleFrom').attr('hidden',true);
                    $('#timesheetForm').attr('hidden',false);
                    $('#overtimeForm').attr('hidden',true);
                    $('#leaveForm').attr('hidden',true);
                }else if($type == "overtime"){
                    $('#attendanceForm').attr('hidden',true);
                    $('#scheduleFrom').attr('hidden',true);
                    $('#timesheetForm').attr('hidden',true);
                    $('#overtimeForm').attr('hidden',false);
                    $('#leaveForm').attr('hidden',true);
                    $.ajax({
                        url : 'get-day-type',
                        type : 'post',
                        dataType : 'json',
                        beforeSend : function(){

                        },
                        success : function(respon){
                            var option = '<option value="" disabled selected>-- select day type --</option>';
                            $.each(respon.day_type,function(key,val){
                                option +=`<option value="`+val.id+`">`+val.name+`</option>`;
                            })
                            $('#daytype_id_overtime').html(option);
                        }
                    })
                }else if($type == "leave"){
                    $('#attendanceForm').attr('hidden',true);
                    $('#scheduleFrom').attr('hidden',true);
                    $('#timesheetForm').attr('hidden',true);
                    $('#overtimeForm').attr('hidden',true);
                    $('#leaveForm').attr('hidden',false);
                     $.ajax({
                        url : 'get-leave-type',
                        type : 'post',
                        dataType : 'json',
                        beforeSend : function(){

                        },
                        success : function(respon){
                            var option = '<option value="" disabled selected>-- select day type --</option>';
                            $.each(respon.leave_type,function(key,val){
                                option +=`<option value="`+val.id+`">`+val.title+`</option>`;
                            })
                            $('#leave_type_id').html(option);
                        }
                    })
                }
            })
            $('#formattendance').on('submit',function(e){
                e.preventDefault()
                var req_date    = $('#date_request').val();
                var request_type = $('#request-options').val();
                var branchId    = $('#branchId').val();
                var employeeId  = $('#employeeId').val();
                var attendance_date = $('#attendance_date').val();
                var attendance_status = $('#attendance_status').val();
                var attendance_clock_in = $('#attendance_clock_in').val();
                var attendance_clock_out= $('#attendance_clock_out').val();

                var formData = $('#formattendance').serialize();
                $.ajax({
                    url : 'store-request',
                    type : 'post',
                    data : {
                        employee_id : employeeId,
                        branch_id : branchId,
                        date_request : req_date,
                        request_type : request_type,
                        date : attendance_date,
                        status : attendance_status,
                        clock_in : attendance_clock_in,
                        clock_out : attendance_clock_out
                    },
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        if (respon.status == 'success'){
                            $('#formattendance')[0].reset();
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg,
                        })
                    },
                    error : function(){
                        alert('Sameting went wrong !');
                    }
                })
            })
            $('#formovertime').on('submit',function(e){
                e.preventDefault();
                var req_date    = $('#date_request').val();
                var request_type= $('#request-options').val();
                var branchId    = $('#branchId').val();
                var employeeId  = $('#employeeId').val();
                var start_date  = $('#start_date_overtime').val();
                var time_start  = $('#time_start_overtime').val();
                var time_end    = $('#time_end_overtime').val();
                var daytype_id  = $('#daytype_id_overtime').val();
                var notes       = $('#notes_overtime').val();
                $.ajax({
                    url : 'store-request',
                    type : 'post',
                    data : {
                        employee_id : employeeId,
                        branch_id : branchId,
                        date_request : req_date,
                        request_type : request_type,
                        start_date : start_date,
                        start_time : time_start,
                        end_time : time_end,
                        daytype_id : daytype_id,
                        notes : notes
                    },
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        if (respon.status == 'success'){
                            $('#formovertime')[0].reset();
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg,
                        })
                    },
                    error : function(){
                        alert('Sameting went wrong !');
                    }

                })
            })
             $('#formLeave').on('submit',function(e){
                e.preventDefault();
                var req_date    = $('#date_request').val();
                var request_type= $('#request-options').val();
                var branchId    = $('#branchId').val();
                var employeeId  = $('#employeeId').val();
                var leave_type_id   = $('#leave_type_id').val();
                var start_date      = $('#start_date_leave').val();
                var end_date        = $('#end_date_leave').val();
                var leave_reason    = $('#leave_reason').val();
                var attachment_leave  = $('#attachment_leave')[0].files[0];
                var formData = new FormData();
                formData.append('date_request',req_date)
                formData.append('request_type',request_type)
                formData.append('branch_id',branchId)
                formData.append('employee_id',employeeId)
                formData.append('leave_type_id',leave_type_id)
                formData.append('start_date',start_date)
                formData.append('end_date',end_date)
                formData.append('leave_reason',leave_reason)
                formData.append('attachment_leave',attachment_leave)
                $.ajax({
                    url : 'store-request',
                    type : 'post',
                    contentType: false,
                    processData: false,
                    cache: false,
                    data : formData,
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        if (respon.status == 'success'){
                            $('#formLeave')[0].reset();
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg,
                        })
                    },
                    error : function(){
                        alert('Sameting went wrong !');
                    }

                })
            })
        })
</script>
@endpush
