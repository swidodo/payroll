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
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                               <input type="date" name="startdate" id="from_date" class="form-control">
                            </div>
                            <div class="col-md-2 mb-2">
                                <input type="date" name="enddate" id="to_date" class="form-control">
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
                    <table class="table table-striped table-bordered table-hover table-sm">
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
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($data as $key=>$d)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $d->employee_id }}</td>
                                    <td>{{ $d->employee_name }}</td>
                                    {{-- start 1 --}}
                                    @switch($tglstart)
                                         @case(1)
                                            <td>{{ $d->d1 }}</td>
                                            <td>{{ $d->d2 }}</td>
                                            <td>{{ $d->d3 }}</td>
                                            <td>{{ $d->d4 }}</td>
                                            <td>{{ $d->d5 }}</td>
                                            <td>{{ $d->d6 }}</td>
                                            <td>{{ $d->d7 }}</td>
                                            <td>{{ $d->d8 }}</td>
                                            <td>{{ $d->d9 }}</td>
                                            <td>{{ $d->d10 }}</td>
                                            <td>{{ $d->d11 }}</td>
                                            <td>{{ $d->d12 }}</td>
                                            <td>{{ $d->d13 }}</td>
                                            <td>{{ $d->d14 }}</td>
                                            <td>{{ $d->d15 }}</td>
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 2 --}}
                                    @switch($tglstart)
                                         @case(2)
                                            <td>{{ $d->d2 }}</td>
                                            <td>{{ $d->d3 }}</td>
                                            <td>{{ $d->d4 }}</td>
                                            <td>{{ $d->d5 }}</td>
                                            <td>{{ $d->d6 }}</td>
                                            <td>{{ $d->d7 }}</td>
                                            <td>{{ $d->d8 }}</td>
                                            <td>{{ $d->d9 }}</td>
                                            <td>{{ $d->d10 }}</td>
                                            <td>{{ $d->d11 }}</td>
                                            <td>{{ $d->d12 }}</td>
                                            <td>{{ $d->d13 }}</td>
                                            <td>{{ $d->d14 }}</td>
                                            <td>{{ $d->d15 }}</td>
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 3 --}}
                                    @switch($tglstart)
                                         @case(3)
                                            <td>{{ $d->d3 }}</td>
                                            <td>{{ $d->d4 }}</td>
                                            <td>{{ $d->d5 }}</td>
                                            <td>{{ $d->d6 }}</td>
                                            <td>{{ $d->d7 }}</td>
                                            <td>{{ $d->d8 }}</td>
                                            <td>{{ $d->d9 }}</td>
                                            <td>{{ $d->d10 }}</td>
                                            <td>{{ $d->d11 }}</td>
                                            <td>{{ $d->d12 }}</td>
                                            <td>{{ $d->d13 }}</td>
                                            <td>{{ $d->d14 }}</td>
                                            <td>{{ $d->d15 }}</td>
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 4 --}}
                                    @switch($tglstart)
                                         @case(4)
                                            <td>{{ $d->d4 }}</td>
                                            <td>{{ $d->d5 }}</td>
                                            <td>{{ $d->d6 }}</td>
                                            <td>{{ $d->d7 }}</td>
                                            <td>{{ $d->d8 }}</td>
                                            <td>{{ $d->d9 }}</td>
                                            <td>{{ $d->d10 }}</td>
                                            <td>{{ $d->d11 }}</td>
                                            <td>{{ $d->d12 }}</td>
                                            <td>{{ $d->d13 }}</td>
                                            <td>{{ $d->d14 }}</td>
                                            <td>{{ $d->d15 }}</td>
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 5 --}}
                                    @switch($tglstart)
                                         @case(5)
                                            <td>{{ $d->d5 }}</td>
                                            <td>{{ $d->d6 }}</td>
                                            <td>{{ $d->d7 }}</td>
                                            <td>{{ $d->d8 }}</td>
                                            <td>{{ $d->d9 }}</td>
                                            <td>{{ $d->d10 }}</td>
                                            <td>{{ $d->d11 }}</td>
                                            <td>{{ $d->d12 }}</td>
                                            <td>{{ $d->d13 }}</td>
                                            <td>{{ $d->d14 }}</td>
                                            <td>{{ $d->d15 }}</td>
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 6 --}}
                                    @switch($tglstart)
                                         @case(6)
                                            <td>{{ $d->d6 }}</td>
                                            <td>{{ $d->d7 }}</td>
                                            <td>{{ $d->d8 }}</td>
                                            <td>{{ $d->d9 }}</td>
                                            <td>{{ $d->d10 }}</td>
                                            <td>{{ $d->d11 }}</td>
                                            <td>{{ $d->d12 }}</td>
                                            <td>{{ $d->d13 }}</td>
                                            <td>{{ $d->d14 }}</td>
                                            <td>{{ $d->d15 }}</td>
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 7 --}}
                                    @switch($tglstart)
                                         @case(7)
                                            <td>{{ $d->d7 }}</td>
                                            <td>{{ $d->d8 }}</td>
                                            <td>{{ $d->d9 }}</td>
                                            <td>{{ $d->d10 }}</td>
                                            <td>{{ $d->d11 }}</td>
                                            <td>{{ $d->d12 }}</td>
                                            <td>{{ $d->d13 }}</td>
                                            <td>{{ $d->d14 }}</td>
                                            <td>{{ $d->d15 }}</td>
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 8 --}}
                                    @switch($tglstart)
                                         @case(8)
                                            <td>{{ $d->d8 }}</td>
                                            <td>{{ $d->d9 }}</td>
                                            <td>{{ $d->d10 }}</td>
                                            <td>{{ $d->d11 }}</td>
                                            <td>{{ $d->d12 }}</td>
                                            <td>{{ $d->d13 }}</td>
                                            <td>{{ $d->d14 }}</td>
                                            <td>{{ $d->d15 }}</td>
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 9 --}}
                                    @switch($tglstart)
                                         @case(9)
                                            <td>{{ $d->d9 }}</td>
                                            <td>{{ $d->d10 }}</td>
                                            <td>{{ $d->d11 }}</td>
                                            <td>{{ $d->d12 }}</td>
                                            <td>{{ $d->d13 }}</td>
                                            <td>{{ $d->d14 }}</td>
                                            <td>{{ $d->d15 }}</td>
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                     {{-- start 10 --}}
                                    @switch($tglstart)
                                        @case(10)
                                            <td>{{ $d->d10 }}</td>
                                            <td>{{ $d->d11 }}</td>
                                            <td>{{ $d->d12 }}</td>
                                            <td>{{ $d->d13 }}</td>
                                            <td>{{ $d->d14 }}</td>
                                            <td>{{ $d->d15 }}</td>
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 11 --}}
                                    @switch($tglstart)
                                        @case(11)
                                            <td>{{ $d->d11 }}</td>
                                            <td>{{ $d->d12 }}</td>
                                            <td>{{ $d->d13 }}</td>
                                            <td>{{ $d->d14 }}</td>
                                            <td>{{ $d->d15 }}</td>
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 12 --}}
                                    @switch($tglstart)
                                        @case(12)
                                            <td>{{ $d->d12 }}</td>
                                            <td>{{ $d->d13 }}</td>
                                            <td>{{ $d->d14 }}</td>
                                            <td>{{ $d->d15 }}</td>
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 13 --}}
                                    @switch($tglstart)
                                        @case(13)
                                            <td>{{ $d->d13 }}</td>
                                            <td>{{ $d->d14 }}</td>
                                            <td>{{ $d->d15 }}</td>
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                     {{-- start 14 --}}
                                    @switch($tglstart)
                                        @case(14)
                                            <td>{{ $d->d14 }}</td>
                                            <td>{{ $d->d15 }}</td>
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 15 --}}
                                    @switch($tglstart)
                                        @case(15)
                                            <td>{{ $d->d15 }}</td>
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 16 --}}
                                    @switch($tglstart)
                                        @case(16)
                                            <td>{{ $d->d16 }}</td>
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 17 --}}
                                    @switch($tglstart)
                                        @case(17)
                                            <td>{{ $d->d17 }}</td>
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 18 --}}
                                    @switch($tglstart)
                                        @case(18)
                                            <td>{{ $d->d18 }}</td>
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                     {{-- start 19 --}}
                                    @switch($tglstart)
                                        @case(19)
                                            <td>{{ $d->d19 }}</td>
                                            <td>{{ $d->d20 }}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- start 20--}}
                                    @switch ($tglstart)
                                        @case (20)
                                            <td>{{ $d->d20}}</td>
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                            @break
                                    @endswitch
                                    {{-- start 21--}}
                                    @switch ($tglstart)
                                        @case (21)
                                            <td>{{ $d->d21 }}</td>
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                            @break
                                    @endswitch
                                    {{-- start 22--}}
                                    @switch ($tglstart)
                                        @case (22)
                                            <td>{{ $d->d22 }}</td>
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                            @break
                                    @endswitch
                                    {{-- start 23--}}
                                    @switch ($tglstart)
                                        @case (23)
                                            <td>{{ $d->d23 }}</td>
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                            @break
                                    @endswitch
                                    {{-- start 24--}}
                                    @switch ($tglstart)
                                        @case (24)
                                            <td>{{ $d->d24 }}</td>
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                            @break
                                    @endswitch
                                    {{-- start 25--}}
                                    @switch ($tglstart)
                                        @case (25)
                                            <td>{{ $d->d25 }}</td>
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                            @break
                                    @endswitch
                                    {{-- start 26--}}
                                    @switch ($tglstart)
                                        @case (26)
                                            <td>{{ $d->d26 }}</td>
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                            @break
                                    @endswitch
                                    {{-- start 27--}}
                                    @switch ($tglstart)
                                        @case (27)
                                            <td>{{ $d->d27 }}</td>
                                            @break
                                        @default
                                            @break
                                    @endswitch
                                   {{-- perpanjang date start --}}
                                    @switch ($jumtglstart)
                                        @case (28)
                                            <td>{{ $d->d28 }}</td>
                                            @break
                                        @case (29)
                                            <td>{{ $d->d28 }}</td>
                                            <td>{{ $d->d29 }}</td>
                                            @break
                                        @case (30)
                                            <td>{{ $d->d28 }}</td>
                                            <td>{{ $d->d29 }}</td>
                                            <td>{{ $d->d30 }}</td>
                                            @break
                                        @case (31)
                                            <td>{{ $d->d28 }}</td>
                                            <td>{{ $d->d29 }}</td>
                                            <td>{{ $d->d30 }}</td>
                                            <td>{{ $d->d31 }}</td>
                                            @break
                                        @default
                                            @break
                                    @endswitch


                                    {{-- end 1 --}}
                                    @switch($tglEnd)
                                        @case(1)
                                            <td>{{ $d->e1 }}</td>
                                            <td>{{ $d->e2 }}</td>
                                            <td>{{ $d->e3 }}</td>
                                            <td>{{ $d->e4 }}</td>
                                            <td>{{ $d->e5 }}</td>
                                            <td>{{ $d->e6 }}</td>
                                            <td>{{ $d->e7 }}</td>
                                            <td>{{ $d->e8 }}</td>
                                            <td>{{ $d->e9 }}</td>
                                            <td>{{ $d->e10 }}</td>
                                            <td>{{ $d->e11 }}</td>
                                            <td>{{ $d->e12 }}</td>
                                            <td>{{ $d->e13 }}</td>
                                            <td>{{ $d->e14 }}</td>
                                            <td>{{ $d->e15 }}</td>
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                            @break
                                    @endswitch
                                    {{-- end 2 --}}
                                    @switch($tglEnd)
                                        @case(2)
                                            <td>{{ $d->e2 }}</td>
                                            <td>{{ $d->e3 }}</td>
                                            <td>{{ $d->e4 }}</td>
                                            <td>{{ $d->e5 }}</td>
                                            <td>{{ $d->e6 }}</td>
                                            <td>{{ $d->e7 }}</td>
                                            <td>{{ $d->e8 }}</td>
                                            <td>{{ $d->e9 }}</td>
                                            <td>{{ $d->e10 }}</td>
                                            <td>{{ $d->e11 }}</td>
                                            <td>{{ $d->e12 }}</td>
                                            <td>{{ $d->e13 }}</td>
                                            <td>{{ $d->e14 }}</td>
                                            <td>{{ $d->e15 }}</td>
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                            @break
                                    @endswitch

                                    {{--end 3 --}}
                                    @switch($tglEnd)
                                         @case(3)
                                            <td>{{ $d->e3 }}</td>
                                            <td>{{ $d->e4 }}</td>
                                            <td>{{ $d->e5 }}</td>
                                            <td>{{ $d->e6 }}</td>
                                            <td>{{ $d->e7 }}</td>
                                            <td>{{ $d->e8 }}</td>
                                            <td>{{ $d->e9 }}</td>
                                            <td>{{ $d->e10 }}</td>
                                            <td>{{ $d->e11 }}</td>
                                            <td>{{ $d->e12 }}</td>
                                            <td>{{ $d->e13 }}</td>
                                            <td>{{ $d->e14 }}</td>
                                            <td>{{ $d->e15 }}</td>
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{--end 4 --}}
                                    @switch($tglEnd)
                                         @case(4)
                                            <td>{{ $d->e4 }}</td>
                                            <td>{{ $d->e5 }}</td>
                                            <td>{{ $d->e6 }}</td>
                                            <td>{{ $d->e7 }}</td>
                                            <td>{{ $d->e8 }}</td>
                                            <td>{{ $d->e9 }}</td>
                                            <td>{{ $d->e10 }}</td>
                                            <td>{{ $d->e11 }}</td>
                                            <td>{{ $d->e12 }}</td>
                                            <td>{{ $d->e13 }}</td>
                                            <td>{{ $d->e14 }}</td>
                                            <td>{{ $d->e15 }}</td>
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{--end 5 --}}
                                    @switch($tglEnd)
                                         @case(5)
                                            <td>{{ $d->e5 }}</td>
                                            <td>{{ $d->e6 }}</td>
                                            <td>{{ $d->e7 }}</td>
                                            <td>{{ $d->e8 }}</td>
                                            <td>{{ $d->e9 }}</td>
                                            <td>{{ $d->e10 }}</td>
                                            <td>{{ $d->e11 }}</td>
                                            <td>{{ $d->e12 }}</td>
                                            <td>{{ $d->e13 }}</td>
                                            <td>{{ $d->e14 }}</td>
                                            <td>{{ $d->e15 }}</td>
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{--end 6 --}}
                                    @switch($tglEnd)
                                         @case(6)
                                            <td>{{ $d->e6 }}</td>
                                            <td>{{ $d->e7 }}</td>
                                            <td>{{ $d->e8 }}</td>
                                            <td>{{ $d->e9 }}</td>
                                            <td>{{ $d->e10 }}</td>
                                            <td>{{ $d->e11 }}</td>
                                            <td>{{ $d->e12 }}</td>
                                            <td>{{ $d->e13 }}</td>
                                            <td>{{ $d->e14 }}</td>
                                            <td>{{ $d->e15 }}</td>
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{--end 7 --}}
                                    @switch($tglEnd)
                                         @case(7)
                                            <td>{{ $d->e7 }}</td>
                                            <td>{{ $d->e8 }}</td>
                                            <td>{{ $d->e9 }}</td>
                                            <td>{{ $d->e10 }}</td>
                                            <td>{{ $d->e11 }}</td>
                                            <td>{{ $d->e12 }}</td>
                                            <td>{{ $d->e13 }}</td>
                                            <td>{{ $d->e14 }}</td>
                                            <td>{{ $d->e15 }}</td>
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{--end 8 --}}
                                    @switch($tglEnd)
                                         @case(8)
                                            <td>{{ $d->e8 }}</td>
                                            <td>{{ $d->e9 }}</td>
                                            <td>{{ $d->e10 }}</td>
                                            <td>{{ $d->e11 }}</td>
                                            <td>{{ $d->e12 }}</td>
                                            <td>{{ $d->e13 }}</td>
                                            <td>{{ $d->e14 }}</td>
                                            <td>{{ $d->e15 }}</td>
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{--end 9 --}}
                                    @switch($tglEnd)
                                         @case(9)
                                            <td>{{ $d->e9 }}</td>
                                            <td>{{ $d->e10 }}</td>
                                            <td>{{ $d->e11 }}</td>
                                            <td>{{ $d->e12 }}</td>
                                            <td>{{ $d->e13 }}</td>
                                            <td>{{ $d->e14 }}</td>
                                            <td>{{ $d->e15 }}</td>
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                     {{--end 10 --}}
                                    @switch($tglEnd)
                                        @case(10)
                                            <td>{{ $d->e10 }}</td>
                                            <td>{{ $d->e11 }}</td>
                                            <td>{{ $d->e12 }}</td>
                                            <td>{{ $d->e13 }}</td>
                                            <td>{{ $d->e14 }}</td>
                                            <td>{{ $d->e15 }}</td>
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{--end 11 --}}
                                    @switch($tglEnd)
                                        @case(11)
                                            <td>{{ $d->e11 }}</td>
                                            <td>{{ $d->e12 }}</td>
                                            <td>{{ $d->e13 }}</td>
                                            <td>{{ $d->e14 }}</td>
                                            <td>{{ $d->e15 }}</td>
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{--end 12 --}}
                                    @switch($tglEnd)
                                        @case(12)
                                            <td>{{ $d->e12 }}</td>
                                            <td>{{ $d->e13 }}</td>
                                            <td>{{ $d->e14 }}</td>
                                            <td>{{ $d->e15 }}</td>
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{--end 13 --}}
                                    @switch($tglEnd)
                                        @case(13)
                                            <td>{{ $d->e13 }}</td>
                                            <td>{{ $d->e14 }}</td>
                                            <td>{{ $d->e15 }}</td>
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                     {{--end 14 --}}
                                    @switch($tglEnd)
                                        @case(14)
                                            <td>{{ $d->e14 }}</td>
                                            <td>{{ $d->e15 }}</td>
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{--end 15 --}}
                                    @switch($tglEnd)
                                        @case(15)
                                            <td>{{ $d->e15 }}</td>
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{--end 16 --}}
                                    @switch($tglEnd)
                                        @case(16)
                                            <td>{{ $d->e16 }}</td>
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{--end 17 --}}
                                    @switch($tglEnd)
                                        @case(17)
                                            <td>{{ $d->e17 }}</td>
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{--end 18 --}}
                                    @switch($tglEnd)
                                        @case(18)
                                            <td>{{ $d->e18 }}</td>
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                     {{--end 19 --}}
                                    @switch($tglEnd)
                                        @case(19)
                                            <td>{{ $d->e19 }}</td>
                                            <td>{{ $d->e20 }}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                    @endswitch
                                    {{-- end 20--}}
                                    @switch ($tglEnd)
                                        @case (20)
                                            <td>{{ $d->e20}}</td>
                                            <td>{{ $d->e21 }}</td>
                                            <td>{{ $d->e22 }}</td>
                                            <td>{{ $d->e23 }}</td>
                                            <td>{{ $d->e24 }}</td>
                                            <td>{{ $d->e25 }}</td>
                                            <td>{{ $d->e26 }}</td>
                                            <td>{{ $d->e27 }}</td>
                                            @break
                                        @default
                                            @break
                                    @endswitch

                                    {{-- end 21--}}
                                    @switch ($tglEnd)
                                    @case (21)
                                        <td>{{ $d->e21 }}</td>
                                        <td>{{ $d->e22 }}</td>
                                        <td>{{ $d->e23 }}</td>
                                        <td>{{ $d->e24 }}</td>
                                        <td>{{ $d->e25 }}</td>
                                        <td>{{ $d->e26 }}</td>
                                        <td>{{ $d->e27 }}</td>
                                        @break
                                    @default
                                        @break
                                    @endswitch

                                    {{-- end 22--}}
                                    @switch ($tglEnd)
                                    @case (22)
                                        <td>{{ $d->e22 }}</td>
                                        <td>{{ $d->e23 }}</td>
                                        <td>{{ $d->e24 }}</td>
                                        <td>{{ $d->e25 }}</td>
                                        <td>{{ $d->e26 }}</td>
                                        <td>{{ $d->e27 }}</td>
                                        @break
                                    @default
                                        @break
                                    @endswitch
                                    {{-- end 23--}}
                                    @switch ($tglEnd)
                                    @case (23)
                                        <td>{{ $d->e23 }}</td>
                                        <td>{{ $d->e24 }}</td>
                                        <td>{{ $d->e25 }}</td>
                                        <td>{{ $d->e26 }}</td>
                                        <td>{{ $d->e27 }}</td>
                                        @break
                                    @default
                                        @break
                                    @endswitch
                                    {{-- end 24--}}
                                    @switch ($tglEnd)
                                    @case (24)
                                        <td>{{ $d->e24 }}</td>
                                        <td>{{ $d->e25 }}</td>
                                        <td>{{ $d->e26 }}</td>
                                        <td>{{ $d->e27 }}</td>
                                        @break
                                    @default
                                        @break
                                    @endswitch
                                    {{-- end 25--}}
                                    @switch ($tglEnd)
                                    @case (25)
                                        <td>{{ $d->e25 }}</td>
                                        <td>{{ $d->e26 }}</td>
                                        <td>{{ $d->e27 }}</td>
                                        @break
                                    @default
                                        @break
                                    @endswitch
                                    {{-- end 26--}}
                                    @switch ($tglEnd)
                                    @case (26)
                                        <td>{{ $d->e26 }}</td>
                                        <td>{{ $d->e27 }}</td>
                                        @break
                                    @default
                                        @break
                                    @endswitch
                                    {{-- end 27--}}
                                    @switch ($tglEnd)
                                    @case (27)
                                        <td>{{ $d->e27 }}</td>
                                        @break
                                    @default
                                        @break
                                    @endswitch

                                       
                                    @switch ($jumtglEnd)
                                        @case (28)
                                            <td>{{ $d->e28 }}</td>
                                            @break
                                        @case (29)
                                            <td>{{ $d->e28 }}</td>
                                            <td>{{ $d->e29 }}</td>
                                            @break
                                        @case (30)
                                            <td>{{ $d->e28 }}</td>
                                            <td>{{ $d->e29 }}</td>
                                            <td>{{ $d->e30 }}</td>
                                            @break
                                        @case (31)
                                            <td>{{ $d->e28 }}</td>
                                            <td>{{ $d->e29 }}</td>
                                            <td>{{ $d->e30 }}</td>
                                            <td>{{ $d->e31 }}</td>
                                            @break
                                        @default
                                            @break
                                    @endswitch

                                    @php
                                        $no++;
                                    @endphp
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
@endsection()
@push('addon-script')
 <!-- Slimscroll JS -->
<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
{{-- @include('includes.reporting.rekap_attendance_js'); --}}
@endpush
