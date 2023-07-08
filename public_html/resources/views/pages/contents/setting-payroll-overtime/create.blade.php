@extends('pages.dashboard')

@section('title', 'Create Setting Overtime')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Create Setting Overtime</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('request-shift-schedule.index')}}">Create Setting Overtime</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-3">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title mb-0" id="title">Create Setting Overtime</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('denda.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="card mb-0">
                                                <div class="card-body">
                                                    <div id="container-denda">

                                                    </div>
                                                    <a href="#" id="add-denda"> + Add New</a>
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

                $('#add-denda').click(function(e){
                    e.preventDefault();

                    let dendaNo
                    if ($('span[id*="counterBreak"]').last().html() > 0) {
                        dendaNo = parseInt($('span[id*="counterBreak"]').last().html()) +1
                    }else{
                        dendaNo = 1
                    }

                    let content = `<div class="card flex-fill" id="card-denda-${dendaNo}">
                                                            <div class="card-header d-flex">
                                                                <div class="d-flex align-items-center me-auto">
                                                                    <h5 class="card-title mb-0" id="title">Denda <span id="counterBreak${dendaNo}">${dendaNo}</span></h5>
                                                                </div>
                                                                <a href="#" class="btn btn-danger" data-id="${dendaNo}" id="delete-break"><i class="la la-trash"></i></a>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="wrapper-form ">
                                                                    <div class="row"  id="form-edit-education">

                                                                        <div class="form-group col-md-6">
                                                                            <label for="phone" class="form-label">Day Type</label><span class="text-danger pl-1"> *</span>
                                                                            <select required class=" select" id="" name="denda[${dendaNo}][day_type_id]">
                                                                                <option value="0">Select Shift</option>
                                                                                @foreach ($dayTypes as $type)
                                                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group col-md-6">
                                                                            <label for="name" class="form-label">Time</label><span class="text-danger pl-1"> *</span>
                                                                            <input required class="form-control" type="text" value="" name="denda[${dendaNo}][time]">
                                                                        </div>

                                                                        <div class="form-group col-md-6">
                                                                            <label for="name" class="form-label">Amount</label><span class="text-danger pl-1"> *</span>
                                                                                <input required class="form-control" type="text" value="" name="denda[${dendaNo}][amount]">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>`

                    $('#container-denda').append(content)
                    $('input[name*="time"]').each(function( index ) {
                        $(this).timepicker({
                            timeFormat: 'HH:mm',
                            // minTime: '05:00'
                        });
                    })

                    $('select[name*="day_type_id"]').each(function( index ) {
                        $(this).select2({
                            width: '100%',
                            tags: true,
                        });
                    })

                })


                $('body').on('click','#delete-break', function(e){
                    e.preventDefault()
                    const cardId = $(this).data('id')
                    $('#card-denda-'+ cardId).remove()
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
