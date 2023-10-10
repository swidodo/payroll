@extends('pages.dashboard')

@section('title', 'Branches')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Bulk Attendance</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('attendance.index')}}">Attendance</a></li>
                        <li class="breadcrumb-item active">Bulk Attendance</li>
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
                    <div class="card-body">
                        <form method="GET" action="{{route('bulk-attendance.index')}}" accept-charset="UTF-8" id="bulkattendance_filter">
                            @csrf
                        <div class="row justify-content-end">
                                    <div class="col-md-3">
                                        <div class="btn-box">
                                            <button class="btn btn-primary">Attendance</button>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="btn-box">
                                            <label for="date" class="form-label">Date</label>
                                            <input class="month-btn form-control " name="date" type="date" value="{{isset($_GET['date'])?$_GET['date']:date('Y-m-d')}}" id="date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="btn-box">
                                            <label for="branch" class="form-label">Branch</label>
                                            <select class="form-control select" required="" id="branch" name="branch">
                                                @foreach ($branches as $branch)
                                                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                            <div class="col-auto d-flex align-items-end pb-2">
                                <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('bulkattendance_filter').submit(); return false;" data-bs-toggle="tooltip" title="" data-original-title="apply" data-bs-original-title="Apply">
                                    <span class="btn-inner--icon"><i class="la la-search"></i></span>
                                </a>
                            </div>
                        </div>
                    </form></div>

                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-body table-border-style">
                        <h5></h5>

                        <form method="POST" action="{{route('bulk-attendance.index')}}" >
                            @csrf
                        <div class="table-responsive">
                            <table class="table" id="pc-dt-simple">
                                <thead>
                                <tr>
                                    <th width="10%">Employee Id</th>
                                    <th>Employee</th>
                                    <th>Branch</th>
                                    <th>
                                        <div class="form-group my-auto">
                                            <div class="custom-control ">
                                                <input class="form-check-input" type="checkbox" name="present_all"
                                                       id="present_all" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="present_all">
                                                    Attendance</label>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        @php
                                            $attendance = $employee->present_status($employee->id, isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'));
                                            $attendancePresent = null;
                                            if (!is_null($attendance)) {
                                                $attendancePresent = $attendance->status;
                                            }
                                            
                                        @endphp

                                        <tr>
                                            <td class="Id">
                                                <input type="hidden" value="{{$employee->id}}" name="employee_id[]">
                                                <a href="" class=" btn btn-outline-primary">{{Auth::user()->employeeIdFormat($employee->branch_id,$employee->id)}}</a>
                                            </td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ !empty($employee->branch) ? $employee->branch->name : '' }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12 d-flex">
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-checkbox mt-2">
                                                                        <input class="form-check-input present" type="checkbox" name="present-{{ $employee->id }}" id="present{{ $employee->id }}" {{ !empty($attendance) && $attendance->status == 'Present' ? 'checked' : '' }}>
                                                                        <label class="custom-control-label" for="present{{ $employee->id }}"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-11 present_check_in {{ !is_null($attendancePresent) ? $attendancePresent == 'Present' ? '' : 'd-none' : 'd-none' }}">
                                                                <div class="row">

                                                                    <label class="px-0  mt-2" style="font-size: 13px; width:6%">In</label>
                                                                    <div class="col-md-2">
                                                                        <input type="text" class="form-control form-control-sm timepickerr" name="in-{{ $employee->id }}" value="{{ !empty($attendance) && $attendance->clock_in != '00:00:00' ? \Carbon\Carbon::parse( $attendance->clock_in)->format('H:i') : \Carbon\Carbon::parse( \App\Models\Utility::getValByName('company_start_time'))->format('H:i') }}">
                                                                    </div>

                                                                    <label for="inputValue" class="px-0  mt-2" style="font-size: 13px; width:6%">Out</label>
                                                                    <div class="col-md-2">
                                                                        <input type="text" class="form-control form-control-sm timepickerr" name="out-{{ $employee->id }}" value="{{ !empty($attendance) && $attendance->clock_out != '00:00:00' ? \Carbon\Carbon::parse( $attendance->clock_out)->format('H:i')  : \Carbon\Carbon::parse( \App\Models\Utility::getValByName('company_end_time'))->format('H:i') }}">
                                                                    </div>

                                                                    <label for="inputValue" class="px-0  mt-2" style="font-size: 13px; width:10%">Break In</label>
                                                                    <div class="col-md-2">
                                                                        <input type="text" class="form-control form-control-sm timepickerr" name="break_in-{{ $employee->id }}" value="{{ !empty($attendance) && $attendance->break_in != '00:00:00' ? \Carbon\Carbon::parse( $attendance->break_in)->format('H:i')  : \Carbon\Carbon::parse( \App\Models\Utility::getValByName('company_break_in_time'))->format('H:i') }}">
                                                                    </div>

                                                                    <label for="inputValue" class="px-0  mt-2" style="font-size: 13px; width:10%">Break Out</label>
                                                                    <div class="col-md-2">
                                                                        <input type="text" class="form-control form-control-sm timepickerr" name="break_out-{{ $employee->id }}" value="{{ !empty($attendance) && $attendance->break_out != '00:00:00' ? \Carbon\Carbon::parse( $attendance->break_out)->format('H:i')  : \Carbon\Carbon::parse( \App\Models\Utility::getValByName('company_break_end_time'))->format('H:i') }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="attendance-btn float-end pt-4">
                            <input type="hidden" value="{{ isset($_GET['date']) ? $_GET['date'] : date('Y-m-d') }}" name="date">
                            <input type="hidden" value="{{ isset($_GET['branch']) ? $_GET['branch'] : '1' }}" name="branch">
                            {{-- <input type="hidden" value="{{ isset($_GET['department']) ? $_GET['department'] : '' }}" name="department"> --}}
                            <input class="btn btn-primary" type="submit" value="Update">
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

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">

      <!-- Jquery timepicker -->
      <link rel="stylesheet" href="{{asset('assets/css/jquery.timepicker.min.css')}}">

      <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endpush

@push('addon-script')
    <!-- Slimscroll JS -->
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

     <!-- Datetimepicker JS -->
    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>

    <!-- Select2 JS -->
    <script src="{{asset('assets/js/select2.min.js')}}"></script>

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

                $('input[class*="timepickerr"]').each(function(){
                        $(this).timepicker({
                            timeFormat: 'HH:mm',
                            // minTime: '05:00'
                        });
                    })

                $('#present_all').click(function (event) {

                if (this.checked) {
                    $('.present').each(function () {
                        this.checked = true;
                    });

                    $('.present_check_in').removeClass('d-none');
                    $('.present_check_in').addClass('d-block');

                } else {
                    $('.present').each(function () {
                        this.checked = false;
                    });
                    $('.present_check_in').removeClass('d-block');
                    $('.present_check_in').addClass('d-none');

                }
                });

                $('.present').click(function (event) {


                var div = $(this).parent().parent().parent().parent().find('.present_check_in');
                if (this.checked) {
                    div.removeClass('d-none');
                    div.addClass('d-block');
                } else {
                    div.removeClass('d-block');
                    div.addClass('d-none');
                }

                });
            });
    </script>
@endpush
