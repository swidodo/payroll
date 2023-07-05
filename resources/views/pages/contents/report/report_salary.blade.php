@extends('pages.dashboard')
@section('title', 'Employees')
@section('dashboard-content')

@push('addon-style')
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
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item active">Report Salary</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="card-title-sm">
                        filter Periode
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <input type="date" name="from_date" id="from_date" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <input type="date" name="to_date" id="to_date" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <select class="form-control form-control-sm" name="type" id="type_print">
                                <option value="PDF">PDF</option>
                                <option value="EXCEL">EXCEL</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex justify-content-start mb-2">
                            <button type="button" id="filter_salary" class="btn btn-success btn-sm me-1"><span class="fa fa-filter"></span> Filter</button>
                            <button type="button" id="print_salary" class="btn btn-primary btn-sm"> <span class="fa fa-print"></span> Print</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="report_salary" class="table table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                   <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Basic Salary</th>
                                    <th>Salary</th>
                                    <th>Allowance</th>
                                    <th>Reimbursts</th>
                                    <th>Overtime</th>
                                    <th>cash</th>
                                    <th>Loan</th>
                                    <th>Denda</th>
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
@include('includes.reporting.reporting_salary_js');
@endpush
