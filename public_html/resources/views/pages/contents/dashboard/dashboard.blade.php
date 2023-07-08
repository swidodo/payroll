@extends('pages.dashboard')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="welcome-box">
                    <div class="welcome-img">
                        <img src="https://ui-avatars.com/api/?name={{$employee->name}}" alt="">
                    </div>
                    <div class="welcome-det">
                        <h3>Welcome, {{$employee->name}}</h3>
                        <p>{{\Carbon\Carbon::now()->format('l, j F Y')}}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->


        <div class="row">
            
            <div class="col-md-4">
                <div class="card punch-status">
                    <div class="card-body">
                        <h5 class="card-title">Attendance <small class="text-muted"> {{\Carbon\Carbon::now()->format('j M Y')}}</small></h5>

                            @if ($shiftSchedule)
                                @if (!empty($attendanceStatus) && $attendanceStatus->status == 'Present' || !empty($attendanceStatus) && $attendanceStatus->status == 'Overtime')
                                    <div class="punch-det">
                                        <div class="row">
                                            <div class="col-auto">
                                                <h6>Clock In at</h6>
                                                <p> {{\Carbon\Carbon::now()->format('j M Y').' '.\Carbon\Carbon::parse($attendanceEmployee->clock_in)->format('H:i') }}</p>
                                            </div>
                                            @if (!empty($attendanceStatus) && $attendanceStatus->clock_out != '00:00:00')
                                                <div class="col-auto">
                                                    <h6>Clock Out at</h6>
                                                    <p> {{\Carbon\Carbon::now()->format('j M Y').' '.\Carbon\Carbon::parse($attendanceEmployee->clock_out)->format('H:i') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                @elseif (empty($attendanceStatus))

                                @endif
                                
                                @if (isset($attendanceEmployee))
                                    @if ($attendanceEmployee->break_in != '00:00:00')
                                        <div class="punch-det">
                                            <div class="row">
                                                <div class="col-auto">
                                                    <h6>Break In at</h6>
                                                    <p> {{\Carbon\Carbon::now()->format('j M Y').' '.\Carbon\Carbon::parse($attendanceEmployee->break_in)->format('H:i') }}</p>
                                                </div>
                                                @if ($attendanceEmployee->break_out != '00:00:00')
                                                    <div class="col-auto">
                                                        <h6>Break Out at</h6>
                                                        <p> {{\Carbon\Carbon::now()->format('j M Y').' '.\Carbon\Carbon::parse($attendanceEmployee->break_out)->format('H:i') }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        
                                    @endif
                                @endif

                            @else
                            <div class="punch-det">
                                <div class="row justify-content-center">
                                    <div class="col-auto ">
                                        <h5 class="mb-0">You don't have shift today</h5>
                                    </div>
                                </div>
                            </div>
                            @endif

                        <div class="punch-btn-section">
                            <form action="{{ route('clock_store') }}" method="post">
                                @csrf
                                
                                @if (!empty($attendanceStatus) && $attendanceStatus->status == 'Present' || !empty($attendanceStatus) && $attendanceStatus->status == 'Overtime')
                                    <input hidden name="clock" value="clock_out" type="text">
                                    <button {{ empty($shiftSchedule) || !empty($attendanceStatus) && $attendanceStatus->clock_out != '00:00:00' ? 'disabled' : ''}} type="submit" class="btn btn-primary punch-btn">Clock Out </button>
                                    @else
                                    <input hidden name="clock" value="clock_in" type="text">
                                    <button {{ empty($shiftSchedule) || !empty($attendanceStatus) && $attendanceStatus->clock_out != '00:00:00' ? 'disabled' : ''}} type="submit" class="btn btn-primary punch-btn">Clock In</button>
                                @endif
                            </form>

                            @if (isset($attendanceEmployee))
                                <form action="{{route('break_store')}}" class="mt-3" method="POST">
                                    @csrf
                                    @if ($attendanceEmployee->break_in == '00:00:00')
                                        <input hidden name="break" value="break_in" type="text">
                                        <button type="submit" class="btn btn-secondary btn-sm">Start Break</button>
                                    @else
                                        @if ($attendanceEmployee->break_out == '00:00:00')
                                            <input hidden name="break" value="break_out" type="text">
                                            <button type="submit" class="btn btn-secondary btn-sm">End Break</button>
                                        @endif
                                    @endif
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card punch-status">
                    <div class="card-body">
                        <h5 class="card-title">Timesheet <small class="text-muted"> {{\Carbon\Carbon::now()->format('j M Y')}}</small></h5>

                        @if (!is_null($timesheet))
                            <div class="punch-det">
                                <div class="row">
                                    <div class="col-auto ">
                                        <h5 class="mb-0">{{$timesheet->task_or_project}}</h5>
                                        <h6 class="mb-0">{{$timesheet->activity}}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="punch-det">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <h6>Record Time</h6>
                                    </div>
                                    <div class="col-6 d-flex">
                                        <h6>Start Time</h6>
                                        <p class="ms-auto">{{is_null($timesheet->start_time) ? '00:00' : $timesheet->start_time}}</p>
                                    </div>
                                    <div class="col-6 d-flex">
                                        <h6>End Time</h6>
                                        <p class="ms-auto">{{is_null($timesheet->end_time) ? '00:00' :  $timesheet->end_time}}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="punch-det">
                                <div class="row">
                                    <div class="col-auto ">
                                        <h5 class="mb-0">You have no timesheet today</h5>
                                    </div>
                                </div>
                            </div>
                        @endif



                        <div class="punch-btn-section">
                            <form action="{{ route('timesheets.record-time') }}" method="post">
                                @csrf
                                <input hidden name="time_now" value="{{date("H:i:s")}}" type="text">
                                <button
                                 {{ is_null($timesheet) ? 'disabled' : ''}} 
                                 type="submit" class="btn btn-primary punch-btn">{{ !is_null($timesheet) ? is_null($timesheet->start_time) ? 'Start' : 'End' : 'Start'}}</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /Page Content -->

</div>
@endsection

@push('addon-style')
    <!-- Chart CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">
@endpush

@push('addon-script')
    <!-- Slimscroll JS -->
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script> --}}

     <!-- Chart JS -->
    <script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('assets/js/chart.js')}}"></script>
    <script src="{{asset('assets/js/greedynav.js')}}"></script>
@endpush
