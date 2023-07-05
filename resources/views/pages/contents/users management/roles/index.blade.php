@extends('pages.dashboard')

@section('title', 'Roles')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Roles</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_role" title="Create New Role"><i class="fa fa-plus"></i> Add Role</a>
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
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Permissions</th>
                                @if(Auth::user()->can('edit role') || Auth::user()->can('delete role'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{$role->name}}</td>
                                    <td class="d-flex flex-wrap pad-bot-role">
                                        @for($j=0; $j < count($role->permissions()->pluck('name')) ; $j++)
                                            <span class="badge bg-inverse-success mt-2 ms-2">{{$role->permissions()->pluck('name')[$j]}}</span>
                                        @endfor
                                    </td>
                                    @if(Auth::user()->can('edit role') || Auth::user()->can('delete role'))
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @can('edit role')
                                                    <a  data-url="{{ route('roles.edit', $role->id) }}" id="edit-role" class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_role"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                @endcan
                                                @can('delete role')
                                                    <a id="delete-role" data-url="{{ route('roles.destroy', $role->id) }}" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_role"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @include('includes.modal.roles-modal')

</div>
@endsection

@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
    <style>
        .pad-bot-role{
            padding-bottom: 16px !important;
        }
    </style>
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
            $('#edit_role').modal('show')
        });
    </script>
    @endif

    <script>
        $(document).ready(function () {
        $("#staff_checkall").click(function(){
            $('.staff_checkall').not(this).prop('checked', this.checked);
        });
        $("#crm_checkall").click(function(){
            $('.crm_checkall').not(this).prop('checked', this.checked);
        });
        $("#project_checkall").click(function(){
            $('.project_checkall').not(this).prop('checked', this.checked);
        });
        $("#hrm_checkall").click(function(){
            $('.hrm_checkall').not(this).prop('checked', this.checked);
        });
        $("#account_checkall").click(function(){
            $('.account_checkall').not(this).prop('checked', this.checked);
        });
        $(".ischeck").click(function(){
            var ischeck = $(this).data('id');
            $('.isscheck_'+ ischeck).prop('checked', this.checked);
        });

        $("#staff_checkall_edit").click(function(){
            $('.staff_checkall_edit').not(this).prop('checked', this.checked);
        });
        // $("#crm_checkall").click(function(){
        //     $('.crm_checkall').not(this).prop('checked', this.checked);
        // });
        // $("#project_checkall").click(function(){
        //     $('.project_checkall').not(this).prop('checked', this.checked);
        // });
        // $("#hrm_checkall").click(function(){
        //     $('.hrm_checkall').not(this).prop('checked', this.checked);
        // });
        // $("#account_checkall").click(function(){
        //     $('.account_checkall').not(this).prop('checked', this.checked);
        // });
        $(".ischeck").click(function(){
            var ischeck = $(this).data('id');
            $('.isscheckedit_'+ ischeck).prop('checked', this.checked);
        });

        $('body').on('click', '#edit-role', function () {
            $("input:checkbox").prop('checked', false)

            const editUrl = $(this).data('url');

            $.get(editUrl, (data) => {
                const {name, id : idRole} = data?.role
                const {permissions} = data

                $('#role-name').val(name);

                Object.keys(permissions).forEach(permission => {
                    if($('#permission'+permission+'edit').prop('checked') != true){
                        $('#permission'+permission+'edit').prop('checked', true)
                    }
                });

                const urlNow = '{{ Request::url() }}'
                $('#edit-form-role').attr('action', urlNow + '/' + idRole);

            })
        });

        $('body').on('click', '#delete-role', function(){
            const deleteURL = $(this).data('url');
            $('#role-delete-form').attr('action', deleteURL);
        })
    });
    </script>
@endpush
