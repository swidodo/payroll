@extends('pages.dashboard')

@push('addon-style')
    <style>
        #donut-chart svg{
            height: 240px !important;
            /* top: -100px; */
        }
        .dropstart .dropdown-toggle::before {
            display: inline-block;
            margin-right: 0.255em;
            vertical-align: 0.255em;
            content: none;
        }
        .dropdown-menu{
            height : 200px !important;
            overflow-y: scroll;
            width :1px !important;
            border-radius: 15px !important;
            background-color: lightgrey;
            scrollbar-width: thin !important;
        }
    </style>
@endpush

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">
        <div id="loader-wrapper" style="display: none;">
            <div id="loader">
                <div class="loader-ellips">
                  <span class="loader-ellips__dot"></span>
                  <span class="loader-ellips__dot"></span>
                  <span class="loader-ellips__dot"></span>
                  <span class="loader-ellips__dot"></span>
                </div>
            </div>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-9">
                    <h3 class="page-title">Dashboard</h3>
                </div>
                <div class="col-sm-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" id="branch_id">
                            <option value="0" selected>All Branch</option>
                            @foreach ($branches as $item)
                                <option value="{{$item->id}}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <label class="focus-label">Branch</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                        <div class="dash-widget-info">
                            <h3 id="totalEmployee"></h3>
                            <span>Employees</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-list"></i></span>
                        <div class="dash-widget-info">
                            <h3 id="totalJobholder"></h3>
                            <span>Permanent</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                        <div class="dash-widget-info">
                            <h3 id="totalContractEmployee"></h3>
                            <span>Contract</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-files-o"></i></span>
                        <div class="dash-widget-info">
                            <h3 id="totalFreelanceEmployee"></h3>
                            <span>Freelance</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10 col-10">
                                <h4 id="header_1"></h4>
                            </div>
                            <div class="col-md-2 col-2">
                                <div class="dropdown dropstart dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle filter_1" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <ul class="dropdown-menu shadow-lg" id="result_filter_1">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="filter_area_1" class="mt-4"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10 col-10">
                                <h4 id="header_2"></h4>
                            </div>
                            <div class="col-md-2 col-2">
                                <div class="dropdown dropstart dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle filter_2" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <ul class="dropdown-menu shadow-lg" id="result_filter_2">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="filter_area_2" class="mt-4"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10 col-10">
                                <h4 id="header_3"></h4>
                            </div>
                            <div class="col-md-2 col-2">
                                <div class="dropdown dropstart dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle filter_3" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <ul class="dropdown-menu shadow-lg" id="result_filter_3">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="filter_area_3" class="mt-4"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-10 col-10">
                                <h4 id="header_4"></h4>
                            </div>
                            <div class="col-md-2 col-2">
                                <div class="dropdown dropstart dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle filter_4" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <ul class="dropdown-menu shadow-lg" id="result_filter_4">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="filter_area_4" class="mt-4"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="filter-bar mt-3 mb-3">
                                            <!-- Search Filter -->
                                            <div class="row filter-row justify-content-center">
                                                <div class="col-sm-6 col-md-3">
                                                    <div class="form-group form-focus select-focus">
                                                        <select class="select floating" id="chart_type">
                                                            {{-- <option value="0" selected>Select type</option> --}}
                                                            <option value="attendance" selected>Attendance</option>
                                                            <option value="employee_status" >Employee Status</option>
                                                        </select>
                                                        <label class="focus-label">Type</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-3">
                                                    <div class="form-group form-focus">
                                                        <div class="cal-icon">
                                                            <input class="form-control floating datepickerFrom"  type="text">
                                                        </div>
                                                        <label class="focus-label">From</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-3">
                                                    <div class="form-group form-focus">
                                                        <div class="cal-icon">
                                                            <input class="form-control floating datepickerTo" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-3">
                                                    <a href="#" id="apply-filter" class="btn btn-success w-100">Apply Filter</a>
                                                </div>
                                            </div>
                                            <!-- /Search Filter -->
                                        </div>
                                        <div id="bar-charts"></div>
                                    </div>
                                    <div class="col-md-2 p-3" id="wrapper-indicator">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Statistics Widget -->

        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-4 d-flex">
                <div class="card flex-fill dash-statistics">
                    <div class="card-body">
                        <h5 class="card-title">Statistics</h5>
                        <div class="stats-list">
                            <div class="stats-info">
                                <p>Today Sick <strong > <span id="totalTodaySick">0</span> / <small id="totalEmployeeStatistic">0</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" id="progress-bar-sick" role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>Today Leave <strong ><span id="totalTodayLeave">0</span> / <small id="totalEmployeeStatistic">0</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" id="progress-bar-leave" role="progressbar"   aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>Today Permit <strong ><span id="totalTodayPermit">0</span> / <small id="totalEmployeeStatistic">0</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-info" id="progress-bar-permit" role="progressbar"  aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>Today Alpha <strong ><span id="totalTodayAlpha">0</span> / <small id="totalEmployeeStatistic">0</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-info" id="progress-bar-alpha" role="progressbar"  aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                        <h4 class="card-title">Task Statistics</h4>
                        <div class="statistics">
                            <div class="row">
                                <div class="col-md-6 col-6 text-center">
                                    <div class="stats-box mb-4">
                                        <p>Total Clock In</p>
                                        <h3 id="totalClockIn">0</h3>
                                    </div>
                                </div>
                                <div class="col-md-6 col-6 text-center">
                                    <div class="stats-box mb-4">
                                        <p>Total Absent</p>
                                        <h3 id="totalAbsent">0</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p><i class="fa fa-dot-circle-o text-purple me-2"></i>Timesheets <span class="float-end" id="totalTimesheets">0</span></p>
                            <p><i class="fa fa-dot-circle-o text-warning me-2"></i>Dinas Dalam Kota<span class="float-end" id="timesheetsInCity">0</span></p>
                            <p><i class="fa fa-dot-circle-o text-success me-2"></i>Dinas Luar Kota <span class="float-end" id="timesheetsOutCity">0</span></p>
                            <p><i class="fa fa-dot-circle-o text-success me-2"></i>Late <span class="float-end" id="totalLate">0</span></p>
                        </div>
                    </div>
                </div>
            </div>

              <div class="col-md-12 col-lg-6 col-xl-4 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                        <h4 class="card-title">Today Absent</h4>
                        <div class="body-content">

                        </div>
                        {{-- @if (count($topThreeEmployeeClockIn) > 0)
                            <div class="load-more text-center">
                                <a class="text-dark" href="javascript:void(0);">Load More</a>
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- /Statistics Widget -->



         <div class="row">
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Timesheets Schedule</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-2">
                            <table class="table table-nowrap custom-table tbl-timesheet-schedule">
                                <thead>
                                    <tr>
                                        <th>Project / Task</th>
                                        <th>Client</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="card-footer">
                        <a href="#">More Details</a>
                    </div> --}}
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Employee Resume</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-2">
                            <table class="table custom-table table-nowrap tbl-employee-resume">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Activity</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="card-footer">
                        <a href="#">More Details</a>
                    </div> --}}
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Absent employees </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-2">
                            <table class="table table-nowrap custom-table ">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Branch</th>
                                        <th>Sick</th>
                                        <th>Alpha</th>
                                        <th>Cuti</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($absentEmployees as $item)
                                        <tr>
                                            <td>
                                                {{$item['employeeName']}}
                                            </td>
                                            <td>
                                                {{$item['branch']}}
                                            </td>
                                            <td>
                                                {{$item['totalSick']}}
                                            </td>
                                            <td>
                                                {{$item['alpha']}}
                                            </td>
                                            <td>
                                                {{$item['leave']}}
                                            </td>
                                        </tr>
                                    @empty

                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#">More Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Employee Birthday</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-2">
                            <table class="table custom-table table-nowrap ">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Branch</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($birthdayEmployees as $item)
                                        <tr>
                                            <td>
                                                {{$item['employeeName']}}
                                            </td>
                                            <td>
                                                {{$item['branch']}}
                                            </td>
                                            <td>
                                                {{$item['birth']}}
                                            </td>
                                        </tr>
                                    @empty

                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#">More Details</a>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="row">
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Employee Contract Will End </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-2">
                            <table class="table table-nowrap custom-table datatable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Branch</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($employeesContractWillExpire))
                                        @foreach ($employeesContractWillExpire as $item)
                                            <tr>
                                                <td>
                                                    {{$item['employeeName']}}
                                                </td>
                                                <td>
                                                    {{$item['branch']}}
                                                </td>
                                                <td>
                                                    {{$item['end_date']}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else

                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Best Employee </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-2">
                            <table class="table table-nowrap custom-table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($bestEmployees))
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($bestEmployees as $item)
                                            <tr>
                                                <td>
                                                    {{$no++}}
                                                </td>
                                                <td>
                                                    {{$item['name']}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else

                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div> --}}
    </div>
    <!-- /Page Content -->

</div>
@endsection

@push('addon-style')
    <!-- Chart CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">
     <!-- Datatable CSS -->
     <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
     <!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
        <!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endpush

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Slimscroll JS -->
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

    <!-- Select2 JS -->
		<script src="{{asset('assets/js/select2.min.js')}}"></script>

     <!-- Chart JS -->
    <script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
    {{-- <script src="{{asset('assets/js/chart.js')}}"></script> --}}
    <script src="{{asset('assets/js/greedynav.js')}}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <!-- jquery -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>

    @include('includes.dashboard.filter_js');
    <script>

        $(document).ready(function() {
            const dateNow = new Date();
            const yKeysAttendance = ['onTime', 'totalLate', 'alpha', 'leave', 'sick'];
            const labelAttendance = ['On Time', 'Late', 'Alpha', 'Leave', 'Sick'];

            const yKeysEmployeeStatus = ['newEmployee', 'outEmployee', 'jobholder', 'contract', 'freelance'];
            const labelEmployeeStatus = ['New', 'Out', 'Jobholder', 'Contract', 'Freelance'];



            function convertDate(year, month)
            {
                return new Date(year, month, 1);
            }

            function drawDonutChart(data) {
                $('#donut-chart').empty()
                Morris.Donut({
                    element: 'donut-chart',
                    redrawOnParentResize: true,
                    data: data,
                    redraw: true
                });
             }

            function updateDataChartAttendance(data){
                return data;
            }

            function addIndicators(chart_type){
                $('#wrapper-indicator').empty()
                    if (chart_type == 'attendance') {
                        const indicators = `<div class="form-group d-flex justify-content-start">
                                            <input id="chartIndicator" checked data-label="On Time" value="onTime" type="checkbox" class="checkmail me-2">
                                            <label class="label">On Time</label>
                                        </div>
                                        <div class="form-group d-flex justify-content-start">
                                            <input id="chartIndicator" checked data-label="Late" value="totalLate" type="checkbox" class="checkmail me-2">
                                            <label class="label">Late</label>
                                        </div>
                                        <div class="form-group d-flex justify-content-start">
                                            <input id="chartIndicator" checked data-label="Alpha" value="alpha" type="checkbox" class="checkmail me-2">
                                            <label class="label">Alpha</label>
                                        </div>
                                        <div class="form-group d-flex justify-content-start">
                                            <input id="chartIndicator" checked data-label="Leave" value="leave" type="checkbox" class="checkmail me-2">
                                            <label class="label">Leave</label>
                                        </div>
                                        <div class="form-group d-flex justify-content-start">
                                            <input id="chartIndicator" checked data-label="Sick" value="sick" type="checkbox" class="checkmail me-2">
                                            <label class="label">Sick</label>
                                        </div>`;
                        $('#wrapper-indicator').append(indicators)
                    }else if(chart_type == 'employee_status'){
                        const indicators = `<div class="form-group d-flex justify-content-start">
                                                <input id="chartIndicator" checked data-label="New" value="newEmployee" type="checkbox" class="checkmail me-2">
                                                <label class="label">New</label>
                                            </div>
                                            <div class="form-group d-flex justify-content-start">
                                                <input id="chartIndicator" checked data-label="Out" value="outEmployee" type="checkbox" class="checkmail me-2">
                                                <label class="label">Out</label>
                                            </div>
                                            <div class="form-group d-flex justify-content-start">
                                                <input id="chartIndicator" checked data-label="Jobholder" value="jobholder" type="checkbox" class="checkmail me-2">
                                                <label class="label">Jobholder</label>
                                            </div>
                                            <div class="form-group d-flex justify-content-start">
                                                <input id="chartIndicator" checked data-label="Contract" value="contract" type="checkbox" class="checkmail me-2">
                                                <label class="label">Contract</label>
                                            </div>
                                            <div class="form-group d-flex justify-content-start">
                                                <input id="chartIndicator" checked data-label="Freelance" value="freelance" type="checkbox" class="checkmail me-2">
                                                <label class="label">Freelance</label>
                                            </div>`;
                        $('#wrapper-indicator').append(indicators)
                    }
            }

            function initiateEventsChartIfIndicatorChanged(){
                $('input[id="chartIndicator"]').click(function (e) {
                        let yKeysArr = [];
                        let labels = [];
                        const dateFrom = $('.datepickerFrom').val();
                        const dateTo = $('.datepickerTo').val();
                        const branch_id = $('#branch_id').val();
                        const chart_type = $('#chart_type').val();

                        $('input[id="chartIndicator"]:checked').each(function (index, element) {
                            yKeysArr.push($(this).val());
                            labels.push($(this).data('label'));
                        });
                        $.post( "{{ route('dashboard.filter-chart-attendance') }}",
                        {
                            "_token": "{{ csrf_token() }}",
                            "dateFrom" : dateFrom,
                            "dateTo"   : dateTo,
                            "branch_id"   : branch_id,
                            "chart_type"   : chart_type,
                            "yKeysArr"   : yKeysArr,
                            "labels"   : labels,
                        })
                        .done(function( data ) {
                            $('#bar-charts').empty()

                            if (chart_type == 'attendance') {
                                const chartAttendance = Morris.Bar({
                                element: 'bar-charts',
                                redrawOnParentResize: true,
                                data: updateDataChartAttendance(data),
                                xkey: 'month',
                                ykeys: yKeysArr,
                                // ykeys: yKeysAttendance,
                                labels: labels,
                                // labels: labelAttendance,
                                lineColors: ['#ff9b44','#fc6075', '#0000FF', '#808080', '#0ad0FF'],
                                lineWidth: '5px',
                                barColors: ['#ff9b44','#fc6075', '#0000FF', '#808080', '#0ad0FF'],
                                resize: true,
                                redraw: true
                            });
                            } else if (chart_type == 'employee_status'){
                                const chartAttendance = Morris.Bar({
                                    element: 'bar-charts',
                                    redrawOnParentResize: true,
                                    data: updateDataChartAttendance(data),
                                    xkey: 'month',
                                    ykeys: yKeysArr,
                                    // ykeys: yKeysEmployeeStatus,
                                    labels: labels,
                                    // labels: labelEmployeeStatus,
                                    lineColors: ['#ff9b44','#fc6075', '#0000FF', '#808080', '#ddd'],
                                    lineWidth: '5px',
                                    barColors: ['#ff9b44','#fc6075', '#0000FF', '#808080', '#ddd'],
                                    resize: true,
                                    redraw: true
                                });
                            }
                        // chartAttendance.setData(updateDataChartAttendance(JSON.parse(data)))
                        });
                   });
            }

            function chart(chart_type, data) {
                $('#bar-charts').empty()

                if (chart_type == 'attendance') {
                        const chartAttendance = Morris.Bar({
                        element: 'bar-charts',
                        redrawOnParentResize: true,
                        data: updateDataChartAttendance(data),
                        xkey: 'month',
                        ykeys: yKeysAttendance,
                        labels: labelAttendance,
                        lineColors: ['#ff9b44','#fc6075', '#0000FF', '#808080', '#0ad0FF'],
                        lineWidth: '5px',
                        barColors: ['#ff9b44','#fc6075', '#0000FF', '#808080', '#0ad0FF'],
                        resize: true,
                        redraw: true
                    });
                    } else if (chart_type == 'employee_status'){
                        const chartAttendance = Morris.Bar({
                            element: 'bar-charts',
                            redrawOnParentResize: true,
                            data: updateDataChartAttendance(data),
                            xkey: 'month',
                            ykeys: yKeysEmployeeStatus,
                            labels: labelEmployeeStatus,
                            lineColors: ['#ff9b44','#fc6075', '#0000FF', '#808080', '#ddd'],
                            lineWidth: '5px',
                            barColors: ['#ff9b44','#fc6075', '#0000FF', '#808080', '#ddd'],
                            resize: true,
                            redraw: true
                        });
                    }
              }

            const tblTimesheet = $('.tbl-timesheet-schedule').DataTable({
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    searching:false,
                    ajax: {
                        url: `{{ route('dashboard.filter-timesheet-schedules') }}`,
                        data: function (d){
                            d.branch_id   = $('#branch_id').val();
                        }
                    },
                    columns : [
                        {data: 'label_project'},
                        {
                            data: 'client_company',
                        },
                        {
                            data: 'start_date',
                        },
                        {
                            data: 'end_date',
                        },
                        {
                            data: 'status',
                        },
                    ],
                });

            const tblResume = $('.tbl-employee-resume').DataTable({
                    processing: true,
                    serverSide: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    searching:false,
                    ajax: {
                        url: `{{ route('dashboard.filter-employee-resume') }}`,
                        data: function (d){
                            d.branch_id   = $('#branch_id').val();
                        }
                    },
                    columns : [
                        {data: 'date'},
                        {data: 'activity'},
                    ],
                });

            function loadData(){
                let branch_id = $('#branch_id').val();
                const chart_type = $('#chart_type').val();
                addIndicators(chart_type)

                let yKeysArr = [];
                let labels = [];

                $('input[id="chartIndicator"]:checked').each(function (index, element) {
                    yKeysArr.push($(this).val());
                    labels.push($(this).data('label'));
                });

                $('#totalEmployee').html("0");
                $('#totalJobholder').html("0");
                $('#totalContractEmployee').html("0");
                $('#totalFreelanceEmployee').html("0");

                $.post( "{{ route('dashboard.filter-branch') }}",
                {
                    "_token": "{{ csrf_token() }}",
                    "branch_id"   : branch_id,
                    "chart_type"   : chart_type,
                    "yKeysArr"   : yKeysArr,
                    "labels"   : labels,
                })
                .done(function( data ) {
                    const res = data.data
                    console.log(res);
                    $('#totalEmployee').html(res.totalEmployees);
                    $('#totalJobholder').html(res.totalEmployeesJobholder);
                    $('#totalContractEmployee').html(res.totalEmployeesContract);
                    $('#totalFreelanceEmployee').html(res.totalEmployeesFreelance);
                    $('small[id="totalEmployeeStatistic"]').each(function () {
                        $(this).html(res.totalEmployees)
                    });

                    $('#totalTodaySick').html(res.totalTodaySick);
                    $('#progress-bar-sick').css("width", (res.totalTodaySick / res.totalEmployees) * 100 + '%');

                    $('#totalTodayLeave').html(res.totalTodayLeave);
                    $('#progress-bar-leave').css("width", (res.totalTodayLeave / res.totalEmployees) * 100 + '%');

                    $('#totalTodayPermit').html(res.totalTodayPermit);
                    $('#progress-bar-permit').css("width", (res.totalTodayPermit / res.totalEmployees) * 100 + '%');

                    $('#totalTodayAlpha').html(res.totalTodayAlpha);
                    $('#progress-bar-alpha').css("width", (res.totalTodayAlpha / res.totalEmployees) * 100 + '%');

                    $('#totalClockIn').html(res.totalClockIn);
                    $('#totalAbsent').html(res.totalAbsent);
                    $('#totalTimesheets').html(res.totalTimesheets);
                    $('#timesheetInCity').html(res.timesheetInCity);
                    $('#timesheetsOutCity').html(res.timesheetsOutCity);
                    $('#totalLate').html(res.totalLate);

                    const esJobholder = (res.totalEmployeesJobholder / res.totalEmployees) * 100 ;
                    $('#es-jobholder').html(res.totalEmployeesJobholder);
                    $('#es-progress-jobholder').css("width",esJobholder + '%');
                    $('#es-progress-jobholder').html(esJobholder + '%');

                    const esContract = (res.totalEmployeesContract / res.totalEmployees) * 100 ;
                    $('#es-contract').html(res.totalEmployeesContract);
                    $('#es-progress-contract').css("width", esContract + '%');
                    $('#es-progress-contract').html(esContract + '%');

                    const esFreelance = (res.totalEmployeesFreelance / res.totalEmployees) * 100 ;
                    $('#es-freelance').html(res.totalEmployeesFreelance);
                    $('#es-progress-freelance').css("width", esFreelance + '%');
                    $('#es-progress-freelance').html(esFreelance + '%');

                    $('#es-total-employee').html(res.totalEmployees);

                    $('#es-gender-male').html(res.male);
                    $('#es-gender-female').html(res.female);

                    $.each(res.logNewestAttendance, function (i, v) {
                        const d = new Date(v.date);
                        let content = `<div class="leave-info-box">
                                            <div class="media d-flex align-items-center">
                                                <div class="media-body flex-grow-1">
                                                    <div class="text-sm my-0">${v.name}</div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center mt-3">
                                                <div class="col-8">
                                                    <span class="text-sm text-muted">${v.activity}</span>
                                                </div>
                                                <div class="col-4">
                                                    <h6 class="mb-0 text-end">${d.toLocaleTimeString()}</h6>
                                                </div>
                                            </div>
                                        </div>`;
                         $('.body-content').append(content)
                    });
                    chart(chart_type, res.dataChart)
                    initiateEventsChartIfIndicatorChanged();
                    drawDonutChart(res.dataChartGenderDiversity);


                });



                }
            loadData();

            $( "#branch_id" ).change(function() {
                $('#loader-wrapper').css('display', 'block')
                let branch_id = $(this).val();
                const chart_type = $('#chart_type').val();
                addIndicators(chart_type)

                let yKeysArr = [];
                let labels = [];

                $('input[id="chartIndicator"]:checked').each(function (index, element) {
                    yKeysArr.push($(this).val());
                    labels.push($(this).data('label'));
                });

                $.post( "{{ route('dashboard.filter-branch') }}",
                {
                    "_token": "{{ csrf_token() }}",
                    "branch_id"   : branch_id,
                    "chart_type"   : chart_type,
                    "yKeysArr"   : yKeysArr,
                    "labels"   : labels,
                })
                .done(function( data ) {
                    const res = data.data
                    // console.log(res);
                    $('.body-content').empty()

                    $('#totalEmployee').html(res.totalEmployees);
                    $('#totalJobholder').html(res.totalEmployeesJobholder);
                    $('#totalContractEmployee').html(res.totalEmployeesContract);
                    $('#totalFreelanceEmployee').html(res.totalEmployeesFreelance);

                    $('small[id="totalEmployeeStatistic"]').each(function () {
                        $(this).html(res.totalEmployees)
                    });

                    $('#totalTodaySick').html(res.totalTodaySick);
                    $('#progress-bar-sick').css("width", (res.totalTodaySick / res.totalEmployees) * 100 + '%');

                    $('#totalTodayLeave').html(res.totalTodayLeave);
                    $('#progress-bar-leave').css("width", (res.totalTodayLeave / res.totalEmployees) * 100 + '%');

                    $('#totalTodayPermit').html(res.totalTodayPermit);
                    $('#progress-bar-permit').css("width", (res.totalTodayPermit / res.totalEmployees) * 100 + '%');

                    $('#totalTodayAlpha').html(res.totalTodayAlpha);
                    $('#progress-bar-alpha').css("width", (res.totalTodayAlpha / res.totalEmployees) * 100 + '%');

                    $('#totalClockIn').html(res.totalClockIn);
                    $('#totalAbsent').html(res.totalAbsent);
                    $('#totalTimesheets').html(res.totalTimesheets);
                    $('#timesheetInCity').html(res.timesheetsInCity);
                    $('#timesheetsOutCity').html(res.timesheetsOutCity);
                    $('#totalLate').html(res.totalLate);

                    const esJobholder = (res.totalEmployeesJobholder / res.totalEmployees) * 100 ;
                    $('#es-jobholder').html(res.totalEmployeesJobholder);
                    $('#es-progress-jobholder').css("width",esJobholder + '%');
                    $('#es-progress-jobholder').html(esJobholder + '%');

                    const esContract = (res.totalEmployeesContract / res.totalEmployees) * 100 ;
                    $('#es-contract').html(res.totalEmployeesContract);
                    $('#es-progress-contract').css("width", esContract + '%');
                    $('#es-progress-contract').html(esContract + '%');

                    const esFreelance = (res.totalEmployeesFreelance / res.totalEmployees) * 100 ;
                    $('#es-freelance').html(res.totalEmployeesFreelance);
                    $('#es-progress-freelance').css("width", esFreelance + '%');
                    $('#es-progress-freelance').html(esFreelance + '%');

                    $('#es-total-employee').html(res.totalEmployees);

                    $.each(res.logNewestAttendance, function (i, v) {
                        const d = new Date(v.date);
                        let content = `<div class="leave-info-box">
                                            <div class="media d-flex align-items-center">
                                                <div class="media-body flex-grow-1">
                                                    <div class="text-sm my-0">${v.name}</div>
                                                </div>
                                            </div>
                                            <div class="row align-items-center mt-3">
                                                <div class="col-8">
                                                    <span class="text-sm text-muted">${v.activity}</span>
                                                </div>
                                                <div class="col-4">
                                                    <h6 class="mb-0 text-end">${d.toLocaleTimeString()}</h6>
                                                </div>
                                            </div>
                                        </div>`;
                         $('.body-content').append(content)
                    });

                    $('#es-gender-male').html(res.male);
                    $('#es-gender-female').html(res.female);

                    tblResume.draw();
                    tblTimesheet.draw();
                    chart(chart_type, res.dataChart)
                    initiateEventsChartIfIndicatorChanged();
                    drawDonutChart(res.dataChartGenderDiversity);
                });


                setTimeout(() => {
                    $('#loader-wrapper').css('display', 'none')
                }, 400);
            });

            $('#apply-filter').click(function (e) {
                e.preventDefault();
                const dateFrom = $('.datepickerFrom').val();
                const dateTo = $('.datepickerTo').val();
                const branch_id = $('#branch_id').val();
                const chart_type = $('#chart_type').val();
                addIndicators(chart_type)

                let yKeysArr = [];
                let labels = [];

                $('input[id="chartIndicator"]:checked').each(function (index, element) {
                    yKeysArr.push($(this).val());
                    labels.push($(this).data('label'));
                });

                $.post( "{{ route('dashboard.filter-chart-attendance') }}",
                {
                    "_token": "{{ csrf_token() }}",
                    "dateFrom" : dateFrom,
                    "dateTo"   : dateTo,
                    "branch_id"   : branch_id,
                    "chart_type"   : chart_type,
                    "yKeysArr"   : yKeysArr,
                    "labels"   : labels,
                })
                    .done(function( data ) {
                        chart(chart_type, data)

                        initiateEventsChartIfIndicatorChanged();
                });
            });

            $(".datepickerFrom").datetimepicker( {
                useCurrent: false,
                format: 'MMM YYYY',
                defaultDate: convertDate(dateNow.getFullYear(), 0),
            });

            $(".datepickerTo").datetimepicker( {
                useCurrent: false,
                format: 'MMM YYYY',
                defaultDate: dateNow,
            });
        });
    </script>
@endpush

