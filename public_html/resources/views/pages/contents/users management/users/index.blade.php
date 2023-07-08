@extends('pages.dashboard')

@section('title', 'Users')
@section('class', '')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Users</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ul>
                </div>
                @can('create user')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_user"><i class="fa fa-plus"></i> Add User</a>
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
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                @if(Auth::user()->can('edit user') || Auth::user()->can('delete user'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                          
                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar"><img src="https://ui-avatars.com/api/?name={{$user->name}}" alt=""></a>
                                        <a href="#">{{$user->name}}</a>
                                    </h2>
                                </td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if (isset($user->roles[0]))
                                        @if (strtolower($user->roles[0]->name) == 'admin')
                                            <span class="badge bg-inverse-danger">Admin</span>
                                        @endif

                                        @if (strtolower($user->roles[0]->name) == null)
                                            <span class="badge bg-inverse-danger">No Role</span>
                                        @endif

                                        @if (strtolower($user->roles[0]->name) == 'client')
                                            <span class="badge bg-inverse-info">Client</span>
                                        @endif

                                        @if (strtolower($user->roles[0]->name) == 'company')
                                            <span class="badge bg-inverse-success">Company</span>
                                        @endif

                                        @if (strtolower($user->roles[0]->name) != 'client' && strtolower($user->roles[0]->name) != 'admin' && strtolower($user->roles[0]->name) != 'company' && strtolower($user->roles[0]->name) != null)
                                            <span class="badge bg-inverse-success">{{$user->roles[0]->name}}</span>
                                        @endif
                                    @else
                                        -
                                    @endif

                                   

                                </td>
                                @if(Auth::user()->can('edit user') || Auth::user()->can('delete user'))
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @can('edit user')
                                                    <a  data-url="{{ route('users.edit', $user->id) }}" id="edit-user" class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_user"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                @endcan
                                                @can('delete user')
                                                    <a id="delete-user" data-url="{{ route('users.destroy', $user->id) }}" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_user"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

    @include('includes.modal.users-modal')

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

    <script>
            $(document).ready(function () {
                /* When click show user */

                // add modal
                if($('.select-role').length > 0) {
                    $('.select-role').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#add_user')
                    });
                }

                if($('.select-branch').length > 0) {
                    $('.select-branch').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#add_user')
                    });
                }

                // edit modal
                if($('.select-role-edit').length > 0) {
                    $('.select-role-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_user')
                    });
                }

                if($('.select-branch-edit').length > 0) {
                    $('.select-branch-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_user')
                    });
                }
                if($('.select-employee-type').length > 0) {
                    $('.select-employee-type').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#add_user')
                    });
                }

                $('body').on('click', '#edit-user', function () {
                    const userURL = $(this).data('url');
                    // $('#option0').attr('selected','selected');
                    // $('#option0').trigger('change');

                    $.get(userURL, (data) => {
                        console.log(data);
                        const {employee, name, email, id : idUser, branch_id} = data?.user
                        const {id} = data?.user.roles[0] ?? 0

                        const urlNow = '{{ Request::url() }}'
                        $('#edit-name').val(name);
                        $('#doe-edit').val(employee.company_doe);
                        $('#doj-edit').val(employee.company_doj);

                        $('#edit-email').val(email);

                        $('#edit-role option[value='+ id +']').attr('selected','selected');
                        $('#edit-role').val(id ? id : 0).trigger('change');

                        $('#branch-id-edit option[value='+ branch_id +']').attr('selected','selected');
                        $('#branch-id-edit').val(branch_id ? branch_id : 0).trigger('change');

                        $('#edit-form-user').attr('action', urlNow + '/' + idUser);
                    })
                });

                // const employeeType = $('#employee_type').val();
                // if (employeeType != 'jobholder' && employeeType != 0) {
                //         $('#section-doj').css('display', 'block');

                //         $('#section-doe').css('display', 'block');


                //     }else{
                //         $('#section-doj').css('display', 'none');

                //         $('#section-doe').css('display', 'none');
                //     }

                // $('body').on('change', '#employee_type', function () {
                //     const val = $(this).val();

                //     if (val != 'jobholder' && val != 0) {
                //         $('#section-doj').css('display', 'block');
                //         $('#section-doe').css('display', 'block');
                //     }else{
                //         $('#section-doj').css('display', 'none');
                //         $('#section-doe').css('display', 'none');
                //     }
                // });

                $('body').on('click', '#delete-user', function(){
                    const deleteURL = $(this).data('url');
                    $('#user-delete-form').attr('action', deleteURL);
                })
            });
    </script>
@endpush
