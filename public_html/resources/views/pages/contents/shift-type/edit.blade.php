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
                    <h3 class="page-title">Edit Shift Type</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('shift-type.index')}}">Shift Type</a></li>
                        <li class="breadcrumb-item active">Edit Shift Type</li>
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

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('shift-type.update', $shiftType->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Name  <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" placeholder="Enter Shift Type Name" value="{{$shiftType->name}}">

                                        @if ($errors->has('name'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('name')[0] }}</strong></small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Day Type  <span class="text-danger">*</span></label>
                                        <select class=" select" id="" name="day_type_id">
                                            <option value="0">Select Day Type</option>
                                            @foreach ($dayTypes as $type)
                                                @if ($type->id == $shiftType->day_type_id)
                                                    <option value="{{$type->id}}" selected>{{$type->name}}</option>
                                                @else
                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @if ($errors->has('day_type_id'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('day_type_id')[0] }}</strong></small>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Start Time  <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="start_time" id="timePicker" value="{{\Carbon\Carbon::parse($shiftType->start_time)->format('H:i')}}">

                                                @if ($errors->has('start_time'))
                                                <div class="text-danger" role="alert">
                                                    <small><strong>{{ $errors->get('start_time')[0] }}</strong></small>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>End Time  <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="end_time" id="timePicker2" value="{{ \Carbon\Carbon::parse($shiftType->end_time)->format('H:i')}}">

                                                @if ($errors->has('end_time'))
                                                <div class="text-danger" role="alert">
                                                    <small><strong>{{ $errors->get('end_time')[0] }}</strong></small>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check form-switch">
                                            @if ($shiftType->is_wfh == 'on')
                                                <input class="form-check-input" name="is_wfh" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                            @else
                                                <input class="form-check-input" name="is_wfh" type="checkbox" role="switch" id="flexSwitchCheckChecked" >
                                            @endif
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Work From Home (WFH)</label>
                                          </div>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-md-12">
                                            <div class="card mb-0">
                                                <div class="card-body">
                                                    <div id="container-break-shift">
                                                        @php
                                                            $no=1;
                                                        @endphp
                                                        @foreach ($breakTimes as $breakTime)
                                                            <div class="card flex-fill" id="card-break-shift-{{$no}}">
                                                                <div class="card-header d-flex">
                                                                    <div class="d-flex align-items-center me-auto">
                                                                        <h5 class="card-title mb-0" id="title">Break time <span id="counterBreak{{$no}}">{{$no}}</span></h5>
                                                                    </div>
                                                                    <a href="#" class="btn btn-danger" data-id="{{$no}}" id="delete-break"><i class="la la-trash"></i></a>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="wrapper-form ">
                                                                        <div class="row"  id="form-edit-education">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="name" class="form-label">Start Time</label><span class="text-danger pl-1">*</span>
                                                                                <input class="form-control" id="ed-start-date"  type="text" value="{{\Carbon\Carbon::parse($breakTime->start_time)->format('H:i')}}" name="break_time[{{$no}}][start_time]">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="phone" class="form-label">End Time</label><span class="text-danger pl-1">*</span>
                                                                                <input class="form-control" id="ed-end-date" type="text" name="break_time[{{$no}}][end_time]" value="{{\Carbon\Carbon::parse($breakTime->end_time)->format('H:i') }}">
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
                                                    <a href="#" id="add-break-shift"> + Add New Break Shift</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('shift-type.index')}}" class="btn btn-secondary ms-2">Cancel</a>
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
    {{-- <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}"> --}}
@endpush

@push('addon-script')
    <!-- Slimscroll JS -->
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

    <!-- Select2 JS -->
    <script src="{{asset('assets/js/select2.min.js')}}"></script>

    <!-- Datetimepicker JS -->
    {{-- <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script> --}}

    <!-- timepicker JS -->
    <script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script>

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

                //start time
                $('#timePicker').timepicker({
                    timeFormat: 'HH:mm',
                });

                //end time
                $('#timePicker2').timepicker({
                    timeFormat: 'HH:mm',
                });

                //break time
                $('#timePicker3').timepicker({
                    timeFormat: 'HH:mm',
                });


                $('#add-break-shift').click(function(e){
                    e.preventDefault();

                    let breakTime
                    if ($('span[id*="counterBreak"]').last().html() > 0) {
                        breakTime = parseInt($('span[id*="counterBreak"]').last().html()) +1
                    }else{
                        breakTime = 1
                    }

                    let content = `<div class="card flex-fill" id="card-break-shift-${breakTime}">
                                                            <div class="card-header d-flex">
                                                                <div class="d-flex align-items-center me-auto">
                                                                    <h5 class="card-title mb-0" id="title">Break time <span id="counterBreak${breakTime}">${breakTime}</span></h5>
                                                                </div>
                                                                <a href="#" class="btn btn-danger" data-id="${breakTime}" id="delete-break"><i class="la la-trash"></i></a>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="wrapper-form ">
                                                                    <div class="row"  id="form-edit-education">
                                                                        <input type="text" hidden  id="ed-id" value="">
                                                                        <input type="text" hidden  id="ed-purpose" value="">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="name" class="form-label">Start Time</label><span class="text-danger pl-1">*</span>
                                                                            <input class="form-control" id="ed-start-date"  type="text" value="00:00" name="break_time[${breakTime}][start_time]">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="phone" class="form-label">End Time</label><span class="text-danger pl-1">*</span>
                                                                            <input class="form-control" id="ed-end-date" type="text" name="break_time[${breakTime}][end_time]" value="00:00">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>`

                    $('#container-break-shift').append(content)
                    $('input[name*="break_time"]').each(function(){
                        $(this).timepicker({
                            timeFormat: 'HH:mm',
                        });
                    })
                })


                $('body').on('click','#delete-break', function(e){
                    e.preventDefault()
                    const cardId = $(this).data('id')
                    $('#card-break-shift-'+ cardId).remove()
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
