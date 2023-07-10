@extends('pages.dashboard')

@section('title', 'Employees')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="page-title">Manage Employee</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Employees</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-center">
                        <div>
                            <button id="import_excel" class="btn btn-warning rounded-pill me-2"><i class="fa fa-download"></i> Import</button>
                        </div>
                        <div>
                            <button id="export_excel" class="btn btn-warning rounded-pill"><i class="fa fa-upload"></i> Export</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" style="overflow-x: visible">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Employee Number</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Branch</th>
                                <th>Date Of Joining</th>
                                <th>Status</th>
                                @can('delete employee')
                                    <th class="text-end">Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                         @can('show employee profile')
                                            <a href="{{route('employees.show',$employee->id)}}" class="btn btn-outline-primary">{{'#'.$employee->employee_id }}</a>
                                        @else
                                            {{-- <a href="#" class="avatar"><img src="https://ui-avatars.com/api/?name={{$employee->employee_id}}" alt=""></a> --}}
                                            <a href="#" class="btn btn-outline-primary">{{$employee->employee_id}}</a>
                                        @endcan
                                    </h2>
                                </td>
                                <td class="font-style">{{ $employee->no_employee ?? '' }}</td>
                                <td class="font-style">{{ $employee->name ?? '' }}</td>
                                <td>{{ $employee->email ?? '' }}</td>
                                <td>{{ $employee->phone ?? '' }}</td>
                                <td class="font-style">{{$employee->branch->name ?? ''}}</td>
                                <td class="font-style">{{$employee->company_doj ?  Auth::user()->dateFormat($employee->company_doj) : '-' }}</td>
                                <td>
                                    @if (strtolower($employee->status) == 'active')
                                            <span class="badge bg-inverse-success">{{ucwords($employee->status)}}</span>
                                    @elseif (strtolower($employee->status) == 'fired')
                                        <span class="badge bg-inverse-danger">{{ucwords($employee->status)}}</span>
                                    @elseif (strtolower($employee->status) == 'pension')
                                        <span class="badge bg-inverse-info">{{ucwords($employee->status)}}</span>
                                    @endif
                                </td>
                                @canany(['edit employee', 'delete employee'])
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                @if (strtolower($employee->status) == 'active')
                                                    @can('edit employee')
                                                        <a  data-url="" id="edit-employee" class="dropdown-item" href="{{route('employees.edit', $employee->id)}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    @endcan
                                                @endif
                                                @can('delete employee')
                                                    <a id="delete-employee" data-url="{{route('employees.destroy', $employee->id)}}" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

    @include('includes.modal.employees-modal')
    @include('includes.modal.report.employee.modal-export-excel')
    @include('includes.modal.employee-import-modal')

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
            $('#edit_user').modal('show')
        });
    </script>
    @endif

    <script>
            $(document).ready(function () {
                /* When click show user */

                $('body').on('click', '#delete-employee', function(){
                    const deleteURL = $(this).data('url');
                    $('#employee-destroy-form').attr('action', deleteURL);
                })
                $('#export_excel').on('click', function(){
                    $('#ExportExcelModal').modal('show');
                });
                $('#import_excel').on('click', function(){
                    $('#ImportExcelModal').modal('show');
                });
            });

    </script>
@endpush
