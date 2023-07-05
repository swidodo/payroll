@extends('pages.dashboard')

@section('title', 'Create Request Shift Schedule')

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
                        <li class="breadcrumb-item active">Create</li>
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
                            <h5 class="card-title mb-0" id="title">Create Request Shift Schedule</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('request-shift-schedule.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Employee  <span class="text-danger">*</span></label>
                                        <select class="select" id="" name="employee_id">
                                            @if ( !is_null(Auth::user()->employee) )
                                                @foreach ($employees as $e)
                                                    @if ($e->id == Auth::user()->employee->id)
                                                        <option value="{{$e->id}}" selected>{{$e->name}}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="0">Select Employee</option>
                                                @foreach ($employees as $e)
                                                    <option value="{{$e->id}}">{{$e->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @if ($errors->has('employee_id'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('employee_id')[0] }}</strong></small>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Requested Date  <span class="text-danger">*</span></label>
                                        <input readonly type="text" class="form-control" name="requested_date" id="" value="{{date("j F Y", strtotime('now'))}}">

                                        @if ($errors->has('requested_date'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('requested_date')[0] }}</strong></small>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Remark  <span class="text-danger">*</span></label>
                                        <textarea name="remark" class="form-control" placeholder="Enter Remarks Here" id="" cols="30" rows="4"></textarea>

                                        @if ($errors->has('remark'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('remark')[0] }}</strong></small>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <div class="card mb-0">
                                                <div class="card-body">
                                                    <div id="container-req-shift-schedule">

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
                                                                                <input class="form-control"   type="text" value="{{date("d/m/Y")}}" name="schedule[${scheduleNo}][schedule_date]">
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
                            format: 'DD-MM-YYYY',
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
