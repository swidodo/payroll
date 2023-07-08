@extends('pages.dashboard')

@section('title', 'Create Shift Type')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Request Shift Schedule</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('request-shift-schedule.index')}}">Request Shift Schedule</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /Page Header -->

        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{Session::get('error')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-3">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title mb-0" id="title">Edit Request Shift Schedule</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('request-shift-schedule.update', $reqShiftSchedule->id)}}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Employee  <span class="text-danger">*</span></label>
                                        <select  class="select" id="" name="employee_id">
                                            @foreach ($employees as $employee)
                                                @if ($employee->id == $reqShiftSchedule->employee_id)
                                                    <option value="{{$employee->id}}" selected>{{$employee->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @if ($errors->has('employee_id'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('employee_id')[0] }}</strong></small>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Requested Date  <span class="text-danger">*</span></label>
                                        <input readonly type="text" class="form-control" name="requested_date" id="" value="{{$reqShiftSchedule->requested_date}}">

                                        @if ($errors->has('requested_date'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('requested_date')[0] }}</strong></small>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Remark  <span class="text-danger">*</span></label>
                                        <textarea readonly name="remark" class="form-control" placeholder="Enter Remarks Here" id="" cols="30" rows="4">{{ $reqShiftSchedule->remark }}</textarea>

                                        @if ($errors->has('remark'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('remark')[0] }}</strong></small>
                                        </div>
                                        @endif
                                    </div>
                                    @if (count($leaveApprovals) > 0)
                                    
                                    <div class="form-group" id="approver">
                                        @php
                                            $show = false;
                                        @endphp
                                        @foreach ($leaveApprovals as $item)
                                                @if (!is_null($item))
                                                    @php
                                                        $show = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @if ($show)
                                            <label for="status" class="form-label">Approved By</label>
                                            <div class="wrapper-approver">
                                                @foreach ($leaveApprovals as $item)
                                                    @if (!is_null($item))
                                                        <input disabled style="margin-bottom: 3px" class="form-control"  type="text" value="{{$item['approver']}}">
                                                    @endif
                                                @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endif

                                    @if (!is_null($level_approve))
                                        <div class="form-group">
                                            <label for="status" class="form-label">Status</label>
                                            <input hidden type="text" name="level_approve" id="level_approve" value="{{$level_approve}}">
                                            <select name="status" id="status_edit" class="form-control">
                                                {{-- @if ($reqShiftSchedule->status == 'Approved')
                                                     <option value="Approved" selected>Approve</option>
                                                @elseif($reqShiftSchedule->status == 'Pending')
                                                <option value="0">Select Status</option>
                                                    <option value="Approved">Approve</option>
                                                    <option value="Pending" selected>Pending</option>
                                                    <option value="Rejected">Reject</option>
                                                @elseif($reqShiftSchedule->status == 'Rejected')
                                                    <option value="0">Select Status</option>
                                                    <option value="Approved">Approve</option>
                                                    <option value="Pending" >Pending</option>
                                                    <option value="Rejected" selected>Reject</option>
                                                @endif --}}
                                                @if ($reqShiftSchedule->status == 'Pending')
                                                    <option value="0">Select Status</option>
                                                    <option value="Approved">Approve</option>
                                                    <option value="Pending" selected>Pending</option>
                                                    <option value="Rejected">Reject</option>
                                                @endif
                                            </select>

                                            <div class="form-group mt-3" id="rejected-reason" style="display: none">
                                                <label for="rejected_reason" class="form-label">Rejected Reason</label>
                                                <textarea class="form-control" placeholder="Rejected Reason" name="rejected_reason" cols="30" rows="3" id="rejected_reason_edit">{{$reqShiftSchedule->rejected_reason}}</textarea>
        
                                                <div class="mt-3">
                                                    <label for="formFile" class="form-label">Attachment</label>
                                                    <input class="form-control" type="file" id="formFile" name="attachment_reject">
                                                </div>
                                            </div>

                                                @if ($errors->has('status'))
                                                    <div class="text-danger" role="alert">
                                                        <small><strong>{{ $errors->get('employee_id')[0] }}</strong></small>
                                                    </div>
                                                @endif
                                        </div>
                                    @endif

                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <div class="card mb-0">
                                                <div class="card-body">
                                                    <div id="container-req-shift-schedule">
                                                        @php
                                                            $no=1;
                                                        @endphp
                                                        @foreach ($shiftSchedules as $schedule)
                                                        <div class="card flex-fill" id="card-req-shift-schedule-{{$no}}">
                                                            <div class="card-header d-flex">
                                                                <div class="d-flex align-items-center me-auto">
                                                                    <h5 class="card-title mb-0" id="title">Schedule <span id="counterBreak${$no}">{{$no}}</span></h5>
                                                                </div>
                                                                <a href="#" class="btn btn-danger" data-id="{{$no}}" id="delete-break"><i class="la la-trash"></i></a>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="wrapper-form ">
                                                                    <div class="row"  id="form-edit-education">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="name" class="form-label">Date</label><span class="text-danger pl-1"> *</span>
                                                                            <div class="cal-icon">
                                                                                <input class="form-control" type="text" value="{{$schedule->schedule_date}}" name="schedule[{{$no}}][schedule_date]">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="phone" class="form-label">Shift </label><span class="text-danger pl-1"> *</span>
                                                                            <select class="select" id="" name="schedule[{{$no}}][shift_id]">
                                                                                <option value="0">Select Shift</option>
                                                                                @foreach ($shifts as $shift)
                                                                                    @if ($shift->id == $schedule->shift_id)
                                                                                        <option value="{{$shift->id}}" selected>{{$shift->name}}</option>
                                                                                    @else
                                                                                        <option value="{{$shift->id}}">{{$shift->name}}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            @php
                                                                $no++;
                                                            @endphp
                                                        @endforeach
                                                    </div>
                                                    <a href="#" id="add-req-shift-schedule"> + Add New</a>
                                                </div>
                                            </div>
                                        </div>
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
    <!-- /Page Content -->

    {{-- @include('includes.modal.shift-type-modal') --}}

</div>
@endsection

@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

       <!-- Jquery timepicker -->
    <link rel="stylesheet" href="{{asset('assets/css/jquery.timepicker.min.css')}}">


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

    <!-- timepicker JS -->
    {{-- <script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script> --}}

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

    @if (Session::has('edit-show'))
    <script>
        $(window).on('load', function(){
            $('#edit_user').modal('show')
        });
    </script>
    @endif
    <script>
            $(document).ready(function () {

                $('input[name*="schedule_date"]').each(function( e ) {
                    let val = $(this)
                    val.change(function (e) { 
                        console.log(e.target.value);
                        // console.log($(this).val());
                        $(this).attr('value', $(this).val())
                        $(this).attr('value', e.target.value)
                     })

                

                })
                /* When click show user */

                let rejected = $('select#status_edit').children('option:selected').val()
                if (rejected == 'Rejected') {
                        $('#rejected-reason').show()
                    }
                $('select#status_edit').change(function(){
                    let selectedItem = $(this).children('option:selected').val()

                    if (selectedItem == 'Rejected') {
                        $('#rejected-reason').show()
                    }else{
                        $('#rejected-reason').hide()
                    }
                })

                $('input[name*="schedule_date"]').each(function( index ) {
                    let val = $(this)
                    $(this).datetimepicker({
                        format: 'YYYY-MM-DD',
                        defaultDate: val,
                        icons: {
                            up: "fa fa-angle-up",
                            down: "fa fa-angle-down",
                            next: 'fa fa-angle-right',
                            previous: 'fa fa-angle-left'
                        }
                    });
                })

                $('#add-req-shift-schedule').click(function(e){
                    e.preventDefault();

                    let scheduleNo
                    if ($('span[id*="counterBreak"]').last().html() > 0) {
                        scheduleNo = parseInt($('span[id*="counterBreak"]').last().html()) +1
                    }else{
                        scheduleNo = 1
                    }

                    let content = `<div class="card flex-fill" id="card-req-shift-schedule-${scheduleNo}">
                                                            <div class="card-header d-flex">
                                                                <div class="d-flex align-items-center me-auto">
                                                                    <h5 class="card-title mb-0" id="title">Schedule <span id="counterBreak${scheduleNo}">${scheduleNo}</span></h5>
                                                                </div>
                                                                <a href="#" class="btn btn-danger" data-id="${scheduleNo}" id="delete-break"><i class="la la-trash"></i></a>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="wrapper-form ">
                                                                    <div class="row"  id="form-edit-education">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="name" class="form-label">Date</label><span class="text-danger pl-1"> *</span>
                                                                            <div class="cal-icon">
                                                                                <input class="form-control"   type="text" value="{{date("Y-m-d")}}" name="schedule[${scheduleNo}][schedule_date]">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="phone" class="form-label">Shift </label><span class="text-danger pl-1"> *</span>
                                                                            <select class="select" id="" name="schedule[${scheduleNo}][shift_id]">
                                                                                <option value="0">Select Shift</option>
                                                                                @foreach ($shifts as $shift)
                                                                                    <option value="{{$shift->id}}">{{$shift->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>`

                    $('#container-req-shift-schedule').append(content)
                    $('input[name*="schedule_date"]').each(function( index ) {
                        $(this).datetimepicker({
                            format: 'YYYY-MM-DD',
                            icons: {
                                up: "fa fa-angle-up",
                                down: "fa fa-angle-down",
                                next: 'fa fa-angle-right',
                                previous: 'fa fa-angle-left'
                            }
                        });
                    })

                    $('select[name*="shift_id"]').each(function( index ) {
                        $(this).select2({
                            width: '100%',
                            tags: true,
                        });
                    })

                })


                $('body').on('click','#delete-break', function(e){
                    e.preventDefault()
                    const cardId = $(this).data('id')
                    $('#card-req-shift-schedule-'+ cardId).remove()
                    const lengthCounter = $('span[id*="counterBreak"]').length
                    console.log(lengthCounter);

                    for (let i = 0; i < lengthCounter; i++) {
                        // $('span[id*="counterBreak'+ i +'"]').html()
                        console.log($('span[id*="counterBreak"]').get(i).innerHTML = i+1);
                        // console.log('ini ke'+ i);
                    }



                })

            });
    </script>
@endpush
