@extends('pages.dashboard')
@section('title', 'Daily Report')
@section('dashboard-content')

@push('addon-style')
<link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
@endpush
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Report</a></li>
                        <li class="breadcrumb-item active">daily report</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label>Department</label>
                            <select class="form-control form-select" id="department_id" name="department_id">
                                @foreach($department as $depart)
                                <option value="{{ $depart->id }}">{{ $depart->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Date</label>
                           <input type="date" class="form-control" id="date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Employee</label>
                            <select class="form-control form-select" id="employee_id" name="employee_id">
                                <option value="">-- pilih --</option>
                            </select>
                        </div>
                        <div class="col-md-3  mb-2">
                            <button type="button" id="filter_report_daily" class="btn btn-success me-1 mt-4"><span class="fa fa-filter"></span> Filter</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="daily_report" class="table table-striped table-bordered table-hover table-sm w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Employee</th>
                                    <th>Time</th>
                                    <th>Location Name</th>
                                    <th>Foto</th>
                                    <th>Map View</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()
@push('addon-script')
 <!-- Slimscroll JS -->
<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/select2.min.js')}}"></script>
<script>
    $('#branch_id').select2({
        width: '100%',
    })
</script>
@include('includes.reporting.daily_report');
@endpush
