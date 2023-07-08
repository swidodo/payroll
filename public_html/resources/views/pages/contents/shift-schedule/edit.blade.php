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
                    <h3 class="page-title">Shift Schedule</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('shift-schedule.index')}}">Shift Schedule</a></li>
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
                            <h5 class="card-title mb-0" id="title">Edit Shift Schedule</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('shift-schedule.update', $reqShiftSchedule->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Employee  <span class="text-danger">*</span></label>
                                        {{-- <select aria-readonly="true" class="select" id="" name="employee_id">
                                            @foreach ($employees as $employee)
                                                @if ($employee->id == $reqShiftSchedule->employee_id)
                                                    <option value="{{$employee->id}}" selected>{{$employee->name}}</option>
                                                @endif
                                            @endforeach
                                        </select> --}}
                                        <input type="text" class="form-control" value="{{$reqShiftSchedule->employee->name}}" readonly>

                                        @if ($errors->has('employee_id'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('employee_id')[0] }}</strong></small>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="row mt-3">
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
                                                                                <input class="form-control"   type="text" value="{{$schedule->schedule_date}}" name="schedule[{{$no}}][schedule_date]">
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
                /* When click show user */
                $('input[name*="schedule_date"]').each(function( index ) {
                    let val = $(this)
                    $(this).datetimepicker({
                        format: 'YYYY/MM/DD',
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
                                                                                <input class="form-control"   type="text" value="{{date("Y/m/d")}}" name="schedule[${scheduleNo}][schedule_date]">
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
                            format: 'YYYY/MM/DD',
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
