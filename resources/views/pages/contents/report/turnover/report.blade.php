@extends('pages.dashboard')
@section('title', 'Report Turnover')
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
                        <li class="breadcrumb-item active">Reminder Contract</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('report-contract')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label>Branch</label>
                                <select class="form-control form-select" id="branch_id" name="branch_id">
                                    @foreach($branch as $branches)
                                    <option value="{{ $branches->id }}">{{ $branches->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3  mb-2">
                                <button type="button" id="filter_report_contract" class="btn btn-primary me-1 mt-4">Search</button>
                                <button type="submit" id="export_report_contract" class="btn btn-success me-1 mt-4"><span class="fa fa-file-excel"></span> Export</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="report_contract" class="table table-striped table-bordered table-hover table-sm w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Employee ID</th>
                                    <th>Employee</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Remainder</th>
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
@include('includes.reporting.contract_js');
@endpush
