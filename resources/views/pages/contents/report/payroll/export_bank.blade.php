@extends('pages.dashboard')
@section('title', 'export Payroll bank')
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
                        <li class="breadcrumb-item"><a href="">Report</a></li>
                        <li class="breadcrumb-item active">Rekap Payroll</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="card-title-sm">
                        Filter Periode
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('export-bank-payroll')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <select class="form-control form-select" id="branch_id" name="branch_id">
                                @foreach($branch as $branches)
                                <option value="{{ $branches->id }}">{{ $branches->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <input type="date" name="start_date" id="from_date" class="form-control">
                        </div>
                        <div class="col-md-2 mb-2">
                            <input type="date" name="end_date" id="to_date" class="form-control">
                        </div>
                        <div class="col-md-2 mb-2">
                            <select class="form-control form-select" name="bank_name" id="type_print">
                                <option value="BCA">BCA</option>
                                <option value="BRI">BRI</option>
                                <option value="BNI">BNI</option>
                                <option value="CIMB">CIMB NIAGA</option>
                                <option value="MANDIRI">MANDIRI</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex justify-content-start mb-2">
                            <a href="javascript:void(0)" id="filter_rekap_payroll" class="btn btn-success btn-sm me-1 text-center"><span class="fa fa-filter"></span> Filter</a>
                            <button type="submit" id="print_rekap_payroll" class="btn btn-primary btn-sm"> <span class="fa fa-export"></span>Export</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="data_export_payroll" class="table table-striped table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Acc. No</th>
                                    <th>Trans. Amount</th>
                                    <th>Emp. Number</th>
                                    <th>Emp. Name</th>
                                    <th>Dept</th>
                                    <th>Trans. Date</th>
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
@include('includes.reporting.export_bank_payroll_js');
@endpush
