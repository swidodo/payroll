@extends('pages.dashboard')

@section('title', 'Attendance')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Attendance List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('attendance.index')}}">Attendance</a></li>
                        <li class="breadcrumb-item active">Attendance List</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#modal_export"> Report</a>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_import">Import Excel</a>
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
                        <form method="GET" action="{{route('attendance.index')}}" accept-charset="UTF-8" id="attendanceemployee_filter">
                        <div class="row align-items-center justify-content-end">
                            <div class="col-md-10 ">
                                <div class="row justify-content-end">
                                    <div class="col-3">
                                        <label class="form-label">Type</label> <br>

                                        <div class="form-check form-check-inline form-group">
                                            <input type="radio" id="monthly" value="monthly" name="type" class="form-check-input" {{isset($_GET['type']) && $_GET['type']=='monthly' ?'checked':'checked'}}>
                                            <label class="form-check-label" for="monthly">Monthly</label>
                                        </div>
                                        <div class="form-check form-check-inline form-group">
                                            <input type="radio" id="daily" value="daily" name="type" class="form-check-input" {{isset($_GET['type']) && $_GET['type']=='daily' ?'checked':''}}>
                                            <label class="form-check-label" for="daily">Daily</label>
                                        </div>

                                    </div>
                                    <div class="col-md-3 month">
                                        <div class="btn-box">
                                            <label for="month" class="form-label">Month</label>
                                            <input class="month-btn form-control month-btn" name="month" type="month" value="{{isset($_GET['month'])?$_GET['month']:date('Y-m')}}" id="month">
                                        </div>
                                    </div>
                                    <div class="col-md-3 date d-none">
                                        <div class="btn-box">
                                            <label for="date" class="form-label">Date</label>
                                            <input class="form-control month-btn" name="date" type="date" value="" id="date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="btn-box">
                                            <label for="attendance" class="form-label">Branch</label>
                                            <select class="form-control select" id="branch" name="branch">
                                                <option value="" selected="selected">Select Branch</option>
                                                @foreach ($branches as $branch)
                                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mt-4">
                                <div class="row">
                                    <div class="col-auto">

                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('attendanceemployee_filter').submit(); return false;" data-bs-toggle="tooltip" title="" data-original-title="Search" data-bs-original-title="Search">
                                            <span class="btn-inner--icon"><i class="la la-search"></i></span>
                                        </a>

                                        {{-- <a href="https://vixprodigitech.com/hrm/attendanceemployee" class="btn btn-sm btn-danger " data-bs-toggle="tooltip" data-original-title="Reset" data-bs-original-title="Reset">
                                            <span class="btn-inner--icon"><i class="la la-trash"></i></span>
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form></div>

                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table datatable">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Shift</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Clock In</th>
                                        <th>Clock Out</th>
                                        <th>Late</th>
                                        <th>Early Leaving</th>
                                        <th>Overtime</th>
                                        @if(Auth::user()->can('edit attendance') || Auth::user()->can('delete attendance'))
                                            <th class="text-end">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                @php
                                    $no=1;
                                @endphp
                                <tbody>
                                    @foreach ($attendanceEmployee as $att)
                                        <tr>
                                            <td>
                                                {{$att->employee->name}}
                                            </td>
                                            <td>
                                                {{isset($att->shift) && $att->shift->status == 'Approved' ? $att->shift->shift_type->name : '-'}}
                                            </td>
                                            <td>
                                                {{$att->date}}
                                            </td>
                                            <td>
                                                {{$att->status}}
                                            </td>
                                            <td>
                                                {{\Carbon\Carbon::parse(  $att->clock_in)->format('H:i') }}
                                            </td>
                                            <td>
                                                {{\Carbon\Carbon::parse(  $att->clock_out)->format('H:i')}}
                                            </td>
                                            <td>
                                                {{\Carbon\Carbon::parse(  $att->late)->format('H:i')}}
                                            </td>
                                            <td>
                                                {{\Carbon\Carbon::parse(  $att->early_leaving)->format('H:i')}}
                                            </td>
                                            <td>
                                                {{\Carbon\Carbon::parse(  $att->overtime)->format('H:i')}}
                                            </td>
                                            @canany(['edit attendance', 'delete attendance'])
                                                <td class="text-end">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            @can('edit attendance')
                                                                <a  data-url="{{route('attendance.edit', $att->id)}}" id="edit-attendance_btn" class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_attendance"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                            @endcan
                                                            @can('delete attendance')
                                                                <a id="delete-attendance" data-url="{{route('attendance.destroy', $att->id)}}" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_attendance"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                            @endcan

                                                        </div>
                                                    </div>
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
        </div>
    </div>
    <!-- /Page Content -->

    @include('includes.modal.attendance-modal')

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
                /* When click show user */


                    $('body').on('click', '#edit-attendance_btn', function () {
                        const editUrl = $(this).data('url');
                        $('#employee_id_edit option[value='+ 0 +']').attr('selected','selected');
                        $('#employee_id_edit').val(0).trigger('change');
                        $('#date').val('')
                        $('#clock_in').val('')
                        $('#clock_out').val('')
                        const time = {{ Js::from(date("H:i:s")) }}

                        $.get(editUrl, (data) => {
                            $('#date-edit').val(data[1].date)
                            $('#clock_in').val(data[1].clock_in)
                            $('#clock_out').val(time)

                            $('#employee_id_edit option[value='+ data[0][0].id +']').attr('selected','selected');
                            $('#employee_id_edit').val(data[0][0].id ? data[0][0].id : 0).trigger('change');

                            const urlNow = '{{ Request::url() }}'
                            $('#edit-form-attendance').attr('action', urlNow + '/' + data[1].id);
                        })
                    });

                $('body').on('click', '#delete-attendance', function(){
                    const deleteURL = $(this).data('url');
                    $('#form-delete-attendance').attr('action', deleteURL);
                })
            });
    </script>
@endpush
