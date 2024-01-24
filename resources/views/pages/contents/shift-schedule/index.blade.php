@extends('pages.dashboard')

@section('title', 'Request Shift Schedule')

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
                        <li class="breadcrumb-item active"> Shift Schedule</li>
                    </ul>
                </div>
                @can('import schedule')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" id="ImportData" class="btn add-btn"><i class="fa fa-upload"></i> Import</a>
                    </div>
                @endcan
                {{-- @can('create request shift schedule')
                    <div class="col-auto float-end ms-auto">
                        <a href="{{route('request-shift-schedule.create')}}" class="btn add-btn"><i class="fa fa-plus"></i> New Request</a>
                    </div>
                @endcan --}}
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
                <div class="table-responsive" >
                    @php
                        $days = ['0', '1', '2', '3', '4', '5', '6'];
                        $currentDateTime = \Carbon\Carbon::now();
                    @endphp
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Employee Name</th>
                                @foreach ($days as $day)
                                    @php
                                        $newDateTime = \Carbon\Carbon::now()->addDays($day)->format('D, j M');
                                    @endphp
                                    <th>{{ $newDateTime }}</th>
                                @endforeach
                                {{-- @if(Auth::user()->can('edit shift schedule') || Auth::user()->can('delete shift schedule'))
                                    <th class="text-end">Action</th>
                                @endif --}}
                            </tr>
                        </thead>
                        @php
                            $no=1;
                        @endphp
                        <tbody>
                            @if (!empty($shiftSchedules) || !is_null($shiftSchedules))
                                @foreach ($employees as $employee)
                                <tr>
                                    <td>
                                        {{$no++}}
                                    </td>
                                    <td>
                                        {{$employee->name}}
                                    </td>
                                    @foreach ($days as $day)
                                        @php
                                            $newDateTime = \Carbon\Carbon::now()->addDays($day)->format('D, j M');
                                            $date = \Carbon\Carbon::now()->addDays($day)->format('j');
                                            $haveShift = null;
                                            $time = null;
                                            $desc = '';
                                            $shiftId = 0;
                                        @endphp
                                        @foreach ($employee->shift_schedules as $schedule)
                                            @if ($schedule->status != 'Pending' && $schedule->status != 'Rejected')
                                                @if (\Carbon\Carbon::parse($schedule->schedule_date)->format('D, j M') == $newDateTime)
                                                    @if ($schedule->is_dayoff == true)
                                                        @php
                                                            $haveShift = 'dayoff';
                                                            $desc = $schedule->dayoff_type;
                                                        @endphp
                                                    @else
                                                        @php
                                                            $haveShift = 'have shift';
                                                            $time = \Carbon\Carbon::parse($schedule->shift_type->start_time)->format('H:i').' - '.\Carbon\Carbon::parse($schedule->shift_type->end_time)->format('H:i');
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                        @if ($haveShift == 'have shift')
                                            <td>
                                            {{$time}}</td>
                                        @elseif ($haveShift == 'dayoff')
                                            <td>
                                                {{$desc}}
                                            </td>
                                        @else
                                            <td>No Shift</td>
                                        @endif
                                    @endforeach

                                    {{-- @canany(['edit shift schedule', 'delete shift schedule'])
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('edit request shift schedule')
                                                        <a  href="{{route('shift-schedule.edit', $shift->id)}}" id="edit-shift-shift" class="dropdown-item" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    @endcan
                                                    @can('delete request shift schedule')
                                                        <form action="{{route('request-shift-schedule.destroy', $shift->id)}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item"><i class="fa fa-trash-o m-r-5"> </i> Delete</button>
                                                        </form>
                                                    @endcan

                                                </div>
                                            </div>
                                        </td>
                                    @endcanany --}}
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @include('includes.modal.schedule.import')
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

    <!-- timepicker JS -->
    {{-- <script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script> --}}

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
         $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
            });
        $(document).ready(function(){
            $('#ImportData').on('click', function(){
                $('#import_schedule').modal('show');
            })
            $('#formImportSchedule').on('submit',function(e){
                e.preventDefault();
                var schedule  = $('#schedule-file')[0].files[0];
                var formData = new FormData();
                formData.append('file-excel',schedule)
                $.ajax({
                    url : 'upload-schedule',
                    type : 'post',
                    contentType: false,
                    processData: false,
                    cache: false,
                    data : formData,
                    dataType : 'json',
                    beforeSend : function(){
                        $('.containerLoader').attr('hidden',false)
                    },
                    success : function(respon){
                        $('.containerLoader').attr('hidden',true)
                        if (respon.status == 'success'){
                            $('#formImportSchedule')[0].reset();
                            $('#import_schedule').modal('hide')
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg,
                        })
                    },
                    error : function(){
                        alert('Someting went wrong !');
                        $('.containerLoader').attr('hidden',true)
                    }

                })
            })
        })
    </script>

@endpush
