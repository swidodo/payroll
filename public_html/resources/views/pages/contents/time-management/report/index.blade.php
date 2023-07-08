@extends('pages.dashboard')

@section('title', 'Report')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Time Management Report</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Time Management Report</li>
                    </ul>
                </div>
                {{-- @can('create overtime')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_overtime"><i class="fa fa-plus"></i> New Overtime</a>
                    </div>
                @endcan --}}
            </div>
        </div>
        <!-- /Page Header -->


        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session::get('success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h4>Export Time Managemet</h4></div>
                    <div class="card-body">
                        <form action="{{route('time-management.export')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date </label>
                                        <input type="date" name="start_date" id="startdate" class="form-control " placeholder="Start Date" required>
        
                                        @if ($errors->has('start_date'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Date </label>
                                        <input type="date" name="end_date" id="enddate" class="form-control " placeholder="End Date" required>
        
                                        @if ($errors->has('end_date'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('end_date')[0] }}</strong></small>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Export</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                            <div class="row justify-content-end">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start Date </label>
                                        <input type="date" name="start_date" id="startdate" class="form-control " placeholder="Start Date" required>
        
                                        @if ($errors->has('start_date'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End Date </label>
                                        <input type="date" name="end_date" id="enddate" class="form-control " placeholder="End Date" required>
        
                                        @if ($errors->has('end_date'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('end_date')[0] }}</strong></small>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary"><i class="la la-search"></i></button>
                                </div>
                            </div>
                            
                    </div>
                </div>
            </div> --}}

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

    @if (Session::has('edit-show'))
    <script>
        $(window).on('load', function(){
            $('#edit_overtime').modal('show')
        });
    </script>
    @endif

@endpush
