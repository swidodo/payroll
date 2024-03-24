@extends('pages.dashboard')
@section('title', 'Rekap Attendance')
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
                        <li class="breadcrumb-item active">Rekap Attendance</li>
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
                    <form action="{{route('rekap_monthly_filter')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <select class="form-control form-select" id="branch_id" name="branch_id">
                                    
                                    @foreach($branches as $branch)
                                    @if ($br == $branch->id)
                                        <option value="{{ $branch->id }}" selected>{{ $branch->name }}</option>
                                    @else
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>   
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                               <input type="date" name="startdate" id="from_date" class="form-control" value="{{$start}}">
                            </div>
                            <div class="col-md-2 mb-2">
                                <input type="date" name="enddate" id="to_date" class="form-control" value="{{$end}}">
                            </div>
                            {{-- <div class="col-md-2 mb-2">
                                <select class="form-control form-select" name="type" id="type_print">
                                    <option value="PDF">PDF</option>
                                    <option value="EXCEL">EXCEL</option>
                                </select>
                            </div> --}}
                            <div class="col-md-3 d-flex justify-content-start mb-2">
                                {{-- <button type="button" id="filter_rekap_attendance" class="btn btn-success btn-sm me-1"><span class="fa fa-filter"></span> Filter</button> --}}
                                <button type="submit" id="print_rekap_attendance" class="btn btn-primary btn-sm"> Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover table-sm" id="rekap_attendance">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    @foreach ($header as $h)
                                        <th>{{$h}}</th>
                                    @endforeach
                                    @foreach ($headerEnd as $hE)
                                        <th>{{$hE}}</th>
                                    @endforeach
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
@include('includes.reporting.rekap_monthly_attendance_js');
@endpush
