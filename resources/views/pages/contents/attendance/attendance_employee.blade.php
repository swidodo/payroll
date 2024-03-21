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
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="mb-4 fw-bold">
                                    <tr>
                                        <td>Employee ID</td>
                                        <td><span class="px-4">:</span></td>
                                        <td>{{Auth::user()->employee->no_employee}}</td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td><span class="px-4">:</span></td>
                                        <td>{{Auth::user()->name}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <form action="{{route('search-attendance')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="month" name="priode" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped custom-table" id="attandaceList">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Employee</th>
                                        <th>Shift</th>
                                        <th>Date</th>
                                        <th>Clock In</th>
                                        <th>Clock Out</th>
                                        <th>Late</th>
                                        <th>Early Leaving</th>
                                        <th>Overtime</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendance as $a)
                                        <tr>
                                            <td>{{$a->no_employee}}</td>
                                            <td>{{$a->name}}</td>
                                            <td>{{$a->shif}}</td>
                                            <td>{{$a->date}}</td>
                                            <td>{{$a->clock_in}}</td>
                                            <td>{{$a->clock_out}}</td>
                                            <td>{{$a->late}}</td>
                                            <td>{{$a->early_leaving}}</td>
                                            <td>{{$a->overtime}}</td>
                                            <td>{{$a->status}}</td>
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
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/sweetalert2.min.css')}}">

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

@endpush
