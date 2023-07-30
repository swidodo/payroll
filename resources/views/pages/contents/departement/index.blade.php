@extends('pages.dashboard')

@section('title', 'Departement Management')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Departements</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Departement</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="{{route('departement.create')}}" class="btn add-btn"><i class="fa fa-plus"></i> Departement</a>
                </div>
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
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="table-departements">
                        <thead>
                            <tr>
                                <th>Departement Name</th>
                                <th>Branch</th>
                                <th>Head</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
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

</div>
@endsection

@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endpush

@push('addon-script')
    <!-- Slimscroll JS -->
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{asset('assets/js/moment.min.js')}}"></script>

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

    <script>
            $(document).ready(function () {

                $('#table-departements').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax : {
                        url : "{{route('departement.get-data-departements')}}",
                    },
                    columns: [
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'branch.name',
                            name: 'branch.name'
                        },
                        {
                            data: 'departement_head.name',
                            name: 'departement_head.name'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name : 'action'
                        },
                    ],

                });
            });
    </script>
@endpush
