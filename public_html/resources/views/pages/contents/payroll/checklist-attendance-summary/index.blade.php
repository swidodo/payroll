@extends('pages.dashboard')

@section('title', 'Checklist Attendance Summary')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Checklist Attendance Summary</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Checklist Attendance Summary</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row justify-content-center">
            <div class="col-md-8" >
            
                <form action="{{route('checklist-attendance-summary.store')}}" method="POST">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-12" >
                            <div class="task-wrapper p-0 pt-2">
                                <div class="task-list-container">
                                    <div class="task-list-body">
                                        <ul id="task-list">
                                            <li class="task">
                                                <div class="task-container d-flex">
                                                    <span class="task-action-btn task-check d-flex align-items-center me-2">
                                                        @php
                                                            $checked = false;
                                                            foreach ($checklists as $key => $value) {
                                                                if ($value->name == 'actual_working_day') {
                                                                    $checked = true;
                                                                }
                                                            } 
                                                        @endphp
                                                        <input {{$checked ? 'checked' : ''}} type="checkbox" name="checklists[actual_working_day]" id="" class="action-circle large complete-btn">
                                                    </span>
                                                    <span >Actual Working Day</span>
                                                </div>
                                            </li>
                                            <li class="task">
                                                <div class="task-container d-flex">
                                                    <span class="task-action-btn task-check d-flex align-items-center me-2">
                                                        @php
                                                            $checked = false;
                                                            foreach ($checklists as $key => $value) {
                                                                if ($value->name == 'schedule_working_day') {
                                                                    $checked = true;
                                                                }
                                                            } 
                                                        @endphp
                                                        <input {{$checked ? 'checked' : ''}} type="checkbox" name="checklists[schedule_working_day]" id="" class="action-circle large complete-btn">
                                                    </span>
                                                    <span >Schedule Working Day</span>
                                                </div>
                                            </li>
                                            <li class=" task">
                                                <div class="task-container d-flex">
                                                    <span class="task-action-btn task-check d-flex align-items-center me-2">
                                                        @php
                                                            $checked = false;
                                                            foreach ($checklists as $key => $value) {
                                                                if ($value->name == 'dayoff') {
                                                                    $checked = true;
                                                                }
                                                            } 
                                                        @endphp
                                                        <input {{$checked ? 'checked' : ''}} type="checkbox" name="checklists[dayoff]" id="" class="action-circle large complete-btn">
                                                    </span>
                                                    <span  >Dayoff</span>
                                                </div>
                                            </li>
                                            <li class="task">
                                                <div class="task-container d-flex">
                                                    <span class="task-action-btn task-check d-flex align-items-center me-2">
                                                        @php
                                                            $checked = false;
                                                            foreach ($checklists as $key => $value) {
                                                                if ($value->name == 'national_holiday') {
                                                                    $checked = true;
                                                                }
                                                            } 
                                                        @endphp
                                                        <input {{$checked ? 'checked' : ''}} type="checkbox" name="checklists[national_holiday]" id="" class="action-circle large complete-btn">
                                                    </span>
                                                    <span  >National Holiday</span>
                                                </div>
                                            </li>
                                            <li class="task">
                                                <div class="task-container d-flex">
                                                    <span class="task-action-btn task-check d-flex align-items-center me-2">
                                                        @php
                                                            $checked = false;
                                                            foreach ($checklists as $key => $value) {
                                                                if ($value->name == 'company_holiday') {
                                                                    $checked = true;
                                                                }
                                                            } 
                                                        @endphp
                                                        <input {{$checked ? 'checked' : ''}} type="checkbox" name="checklists[company_holiday]" id="" class="action-circle large complete-btn">
                                                    </span>
                                                    <span  >Company Holiday</span>
                                                </div>
                                            </li>
                                            <li class="task">
                                                <div class="task-container d-flex">
                                                    <span class="task-action-btn task-check d-flex align-items-center me-2">
                                                        @php
                                                            $checked = false;
                                                            foreach ($checklists as $key => $value) {
                                                                if ($value->name == 'timeoff_code') {
                                                                    $checked = true;
                                                                }
                                                            } 
                                                        @endphp
                                                        <input {{$checked ? 'checked' : ''}} type="checkbox" name="checklists[timeoff_code]" id="" class="action-circle large complete-btn">
                                                    </span>
                                                    <span  >Attendance/Time Off Code</span>
                                                </div>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
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
@endpush
