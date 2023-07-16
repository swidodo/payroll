@extends('pages.dashboard')

@section('title', 'Request Schedule')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Request Schedule</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Request Schedule</li>
                    </ul>
                </div>
                @can('create request shift schedule')
                    <div class="col-auto float-end ms-auto">
                        <a href="{{route('request-shift-schedule.create')}}" class="btn add-btn"><i class="fa fa-plus"></i> New Request</a>
                    </div>
                @endcan
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

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" style="overflow-x: visible">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Reason</th>
                                <th>Requested For</th>
                                <th>Date</th>
                                <th>Status</th>
                                @if(Auth::user()->can('edit request shift schedule') || Auth::user()->can('delete request shift schedule'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        @php
                            $no=1;
                        @endphp
                        <tbody>
                            @foreach ($reqShiftSchedule as $shift)
                                <tr>
                                    <td>
                                        {{$no++}}
                                    </td>
                                    <td>
                                        {{$shift->remark ?? '-'}}
                                    </td>
                                    <td>
                                        {{$shift->employee->name  ?? '-'}}
                                    </td>
                                    <td>
                                        {{ date("j M Y", strtotime($shift->requested_date))  ?? '-' }}
                                    </td>
                                    <td>
                                        @if($shift->status=="Pending")
                                            <div class="status_badge badge bg-warning p-2 px-3 rounded">{{ $shift->status ?? '-'}}</div>
                                        @elseif($shift->status=="Approved")
                                            <div class="status_badge badge bg-success p-2 px-3 rounded">{{ $shift->status ?? '-'}}</div>
                                        @elseif($shift->status=="Rejected")
                                        <a href="{{route('request-shift-schedule.show', $shift->id)}}" class="text-white">
                                            <div class="status_badge badge bg-danger p-2 px-3 rounded">
                                                {{ $shift->status ?? '-'}}
                                            </div>
                                        </a>
                                        @endif
                                    </td>
                                    @canany(['edit request shift schedule', 'delete request shift schedule'])
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('edit request shift schedule')
                                                        <a  href="{{route('request-shift-schedule.edit', $shift->id)}}" id="edit-shift-shift" class="dropdown-item" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    @endcan
                                                    @can('delete request shift schedule')
                                                        <form action="{{route('request-shift-schedule.destroy', $shift->id)}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item"><i class="fa fa-trash-o m-r-5"> </i> Delete</button>
                                                        </form>
                                                    @endcan

                                                </div>
                                            </div>
                                        </td>
                                    @endcanany
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

       <!-- Jquery timepicker -->
    <link rel="stylesheet" href="{{asset('assets/css/jquery.timepicker.min.css')}}">


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

    <!-- timepicker JS -->
    {{-- <script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script> --}}

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

    @if (Session::has('edit-show'))
    <script>
        $(window).on('load', function(){
            $('#edit_user').modal('show')
        });
    </script>
    @endif
    <script>

                /* When click show user */
    </script>
@endpush
