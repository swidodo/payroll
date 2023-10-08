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
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="table-empolyees">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee ID</th>
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
                /* datatable employees */
                $('#table-empolyees').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax : {
                        url : "{{route('employees.get-data-employees')}}",
                    },
                    columns: [
                        { data: 'no', name:'id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {
                            data: 'view_profile',
                            name: 'no_employee'
                        },
                        {
                            data: 'name',
                            name : 'name'
                        },
                        {
                            data: 'email',
                            name : 'email'
                        },
                        {
                            data: 'phone',
                            name : 'phone'
                        },
                        {
                            data: 'branch.name',
                            name : 'branch.name'
                        },
                        {
                            data: 'company_doj',
                            name : 'company_doj'
                        },
                        {
                            data: 'view_status',
                            name : 'status'
                        },
                        @can('delete employee')
                            {
                                data: 'view',
                                orderable: 'false',
                                searcharable: 'false'
                            }
                        @endcan
                    ],

                });

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
