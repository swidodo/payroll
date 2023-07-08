@extends('pages.dashboard')

@section('title', 'Employee Request')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Employee Request</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Employee Request</li>
                    </ul>
                </div>
                {{-- <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#modal_export"> Report</a>
                </div> --}}
                
            </div>
        </div>
        <!-- /Page Header -->


        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" style="overflow-x: visible">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>Request No.</th>
                                <th>Request For</th>
                                <th>Request By</th>
                                <th>Request Type</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                @if(Auth::user()->can('manage employee request'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allReqs as $req)
                                <tr>
                                    <td>
                                        {{$req->request_no ?? '-'}}
                                    </td>
                                    <td>
                                        {{$req->request_for ?? '-'}}
                                    </td>
                                    <td>
                                        {{$req->request_by ?? '-'}}
                                    </td>
                                    <td>
                                        {{$req->request_type ?? '-'}}
                                    </td>
                                    <td>
                                        {{$req->req_date ?? '-'}}
                                    </td>
                                    <td>
                                        @if($req->status=="Pending")
                                            <div class="status_badge badge bg-warning p-2 px-3 rounded">{{ $req->status ?? '-'}}</div>
                                        @endif
                                    </td>
                                    @canany(['manage employee request'])
                                        <td>
                                            <div class="d-flex">
                                                <a title="Detail" data-url="{{route('employee.request.data', $req->id)}}" id="detail-emp-request" class="btn btn-primary px-2 py-1 me-1" href="javascript:void(0)"><i class="fa-solid fa-eye"></i></a>
                                                <form action="{{route('employee.request.approve')}}" method="POST">
                                                    @csrf
                                                    <input type="text" hidden name="employee_request_id" value="{{$req->id}}" id="">
                                                    <button type="submit" title="Approve" class="btn btn-primary px-2 py-1"><i class="fa-solid fa-check"></i> </button>
                                                </form>
                                                <a  data-url="{{route('employee.request.reject', $req->id)}}" data-id="{{$req->id}}" id="btn-reject" class="btn btn-danger px-2 py-1 ms-1 text-white" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal_reject" title="Reject"><i class="fa-solid fa-x"></i> </a>
                                            </div>
                                            {{-- <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('manage employee request')
                                                        <a  data-url="{{route('employee.request.data', $req->id)}}" id="detail-emp-request" class="dropdown-item" href="javascript:void(0)"> Detail</a>
                                                        <form action="{{route('employee.request.approve')}}" method="POST">
                                                            @csrf
                                                            <input type="text" hidden name="employee_request_id" value="{{$req->id}}" id="">
                                                            <button type="submit" class="dropdown-item"> Approve</button>
                                                        </form>
                                                        <a  data-url="{{route('employee.request.reject', $req->id)}}" data-id="{{$req->id}}" id="btn-reject" class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal_reject"> Reject</a>
                                                    @endcan
                                                </div>
                                            </div> --}}
                                        </td>
                                    @endcanany
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <div id="modal_detail" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Request No.</label>
                                        <input readonly type="text" class="form-control" value="" name="" id="req_no">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Request Type</label>
                                        <input readonly type="text" class="form-control" value="" name="" id="req_type">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Request For</label>
                                        <input readonly type="text" class="form-control" value="" name="" id="req_for">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Request By</label>
                                        <input readonly type="text" class="form-control" value="" name="" id="req_by">
                                    </div>
                                </div>
                            </div>
                            <hr>
                           <div class="append">
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- reject --}}
    <!-- Delete User Modal -->
    <div class="modal custom-modal fade" id="modal_reject" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex">
                        <h3>Reject</h3>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        <div></div></button>
                </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" id="form-reject" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden type="text" name="employee_request_id" value="" id="employee_request_id_reject">
                                    <div class="form-group" id="rejected-reason">
                                        <label for="rejected_reason" class="form-label">Rejected Reason</label>
                                        <textarea class="form-control" placeholder="Rejected Reason" name="rejected_reason" cols="30" rows="3" id="rejected_reason_edit"></textarea>

                                        <div class="mt-3">
                                            <label for="formFile" class="form-label">Attachment (opsional)</label> &nbsp; <span class="text-muted" style="font-size: 10px">pdf, jpg, jpeg, png</span>
                                            <input name="attachment_reject" class="form-control" type="file" id="attachment_rejected_edit">
                                            <a href="" id="attachment_rejected_edit_anchor"></a>
                                        </div>
                                    </div>
                                    <div class="">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete User Modal -->

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
<script src="https://kit.fontawesome.com/bbc31f3764.js" crossorigin="anonymous"></script>

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
                /* When click show user */

                $('body').on('click', '#detail-emp-request', function(){
                    const url = $(this).data('url');
                   

                    $.get(url, (data) => {
                        console.log(data);
                        $('.append').empty()

                        $('#req_no').val(data[0].request_no)
                        $('#req_type').val(data[0].request_type)
                        $('#req_for').val(data[0].request_for)
                        $('#req_by').val(data[0].request_by)

                        if(data[0].request_type == 'On Duty'){
                            const formDetail = `<div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="start_date">Start Date</label>
                                                            <input readonly class="form-control" name="start_date" type="text" id="start_date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="end_date">End Date</label>
                                                            <input readonly class="form-control" name="end_date" type="text" id="end_date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Place of Visit</label>
                                                            <input readonly type="text" class="form-control" value="" name="" id="place_of_visit">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Purpose Of Visit</label>
                                                            <input readonly type="text" class="form-control" value="" name="" id="purpose_of_visit">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="leave_reason" class="form-label">Description</label>
                                                            <textarea readonly class="form-control" placeholder="Leave Reason" name="leave_reason" cols="50" rows="3" id="description"></textarea>
                                                        </div>
                                                    </div>
                                                </div>`
                            $('.append').append(formDetail)

                            $('#start_date').val(data[1].start_date)
                            $('#end_date').val(data[1].end_date)
                            $('#place_of_visit').val(data[1].place_of_visit)
                            $('#purpose_of_visit').val(data[1].purpose_of_visit)
                            $('#description').val(data[1].description)
                        }
                        else if(data[0].request_type == 'Leave'){
                            const formDetail = `<div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="start_date">Start Date</label>
                                                            <input readonly class="form-control" name="start_date" type="text" id="start_date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="end_date">End Date</label>
                                                            <input readonly class="form-control" name="end_date" type="text" id="end_date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Leave Type</label>
                                                            <input readonly type="text" class="form-control" value="" name="" id="leave_type">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="leave_reason" class="form-label">Leave Reason</label>
                                                            <textarea readonly class="form-control" placeholder="Leave Reason" name="leave_reason" cols="50" rows="3" id="leave_reason"></textarea>
                                                        </div>
                                                    </div>
                                                </div>`
                            $('.append').append(formDetail)
                            $('#start_date').val(data[1].start_date)
                            $('#end_date').val(data[1].end_date)
                            $('#leave_type').val(data[1].leave_type.title)
                            $('#leave_reason').val(data[1].leave_reason)
                        }
                        else if(data[0].request_type == 'Overtime'){
                            const formDetail = `<div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="start_date">Start Date</label>
                                                            <input readonly class="form-control" name="start_date" type="text" id="start_date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="end_date">End Date</label>
                                                            <input readonly class="form-control" name="end_date" type="text" id="end_date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Overtime Type</label>
                                                            <input readonly type="text" class="form-control" value="" name="" id="overtime_type">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Day Type</label>
                                                            <input readonly type="text" class="form-control" value="" name="" id="day_type">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Start Time</label>
                                                            <input readonly type="text" class="form-control" value="" name="" id="start_time">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>End Time</label>
                                                            <input readonly type="text" class="form-control" value="" name="" id="end_time">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="leave_reason" class="form-label">Notes</label>
                                                            <textarea readonly class="form-control" placeholder="Leave Reason"  cols="50" rows="3" id="notes"></textarea>
                                                        </div>
                                                    </div>
                                                </div>`
                            $('.append').append(formDetail)
                            $('#start_date').val(data[1].start_date)
                            $('#end_date').val(data[1].end_date)
                            $('#overtime_type').val(data[1].overtime_type.name)
                            $('#day_type').val(data[1].day_type.name)
                            $('#start_time').val(data[1].start_time)
                            $('#end_time').val(data[1].end_time)
                            $('#notes').val(data[1].notes)
                        }
                        else if(data[0].request_type == 'Request Shift Schedule'){
                            const formDetail = `<div class="row" id="row-req-shift">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="start_date">Requested Date</label>
                                                            <input readonly class="form-control" name="start_date" type="text" id="req_date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="leave_reason" class="form-label">Remark</label>
                                                            <textarea readonly class="form-control" placeholder="Leave Reason"  cols="50" rows="3" id="remark"></textarea>
                                                        </div>
                                                    </div>
                                                </div>`
                            $('.append').append(formDetail)
                                                
                            let html = ''
                            $.each(data[1].shift_schedules, function (indexInArray, valueOfElement) { 
                                console.log(valueOfElement);

                                html += `       
                                                    <div class="card flex-fill" id="card-req-shift-schedule-1">
                                                            <div class="card-header d-flex mt-2">
                                                                <div class="d-flex align-items-center me-auto">
                                                                    <h5 class="card-title mb-0 " id="title">Schedule ${indexInArray}<span id="counterBreak1">1</span></h5>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="wrapper-form ">
                                                                    <div class="row" id="form-edit-education">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="name" class="form-label">Date</label><span class="text-danger pl-1"> *</span>
                                                                                <input readonly class="form-control" type="text" value="${valueOfElement.schedule_date}" id="schedule-date-${indexInArray}">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="phone" >Shift </label>
                                                                                    <input readonly class="form-control" type="text" value="${valueOfElement.shift_type.name}" id="schedule-shift-${indexInArray}">
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                        `
                            });
                            $('#row-req-shift').append(html)
                            
                            
                            $('#remark').val(data[1].remark)
                            $('#req_date').val(data[1].requested_date)
                        }
                        else if(data[0].request_type == 'Timesheet'){
                            let hostNameFileAttachment = `{{ asset('${data[1].file_attachment}') }}`
                            const formDetail = `<div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="start_date">Start Date</label>
                                                            <input readonly class="form-control" name="start_date" type="text" id="start_date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="end_date">End Date</label>
                                                            <input readonly class="form-control" name="end_date" type="text" id="end_date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Project Stage</label>
                                                            <input readonly type="text" class="form-control" value="" name="" id="project_stage">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Task / Project</label>
                                                            <input readonly type="text" class="form-control" value="" name="" id="task_or_project">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Activity</label>
                                                            <input readonly type="text" class="form-control" value="" name="" id="activity">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Client Company</label>
                                                            <input readonly type="text" class="form-control" value="" name="" id="client_company">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Label Project</label>
                                                            <input readonly type="text" class="form-control" value="" name="" id="label_project">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Support</label>
                                                            <input readonly type="text" class="form-control" value="" name="" id="support">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="leave_reason" class="form-label">Remark</label>
                                                            <textarea readonly class="form-control" placeholder="Leave Reason"  cols="50" rows="3" id="remark"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>File Attachment</label>
                                                            <a target="_blank" href="" id="file-attachment-see"></a>
                                                        </div>
                                                    </div>
                                                </div>`
                            $('.append').append(formDetail)

                            $('#start_date').val(data[1].start_date)
                            $('#end_date').val(data[1].end_date)
                            $('#project_stage').val(data[1].project_stage)
                            $('#task_or_project').val(data[1].task_or_project)
                            $('#activity').val(data[1].activity)
                            $('#client_company').val(data[1].client_company)
                            $('#label_project').val(data[1].label_project)
                            $('#support').val(data[1].support)
                            $('#remark').val(data[1].remark)
                            $('#file-attachment-see').attr('href', hostNameFileAttachment)
                            $('#file-attachment-see').html(data[0].file_attachment != null ? data[0].file_attachment.split('/')[1] : '')
                        }


                        $('#modal_detail').modal('show')
                        })
                })

                $('body').on('click', '#btn-reject', function(){
                    const empReqId = $(this).data('id')
                    const url = $(this).data('url')
                    const urlNow = '{{ Request::url() }}'
                    $('#form-reject').attr('action',url);


                    $('#employee_request_id_reject').val(empReqId)
                    $('#employee_request_id_reject').attr('value',empReqId)
                })
                
            });
    </script>
@endpush
