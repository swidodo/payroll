@extends('pages.dashboard')

@section('title', 'Branches')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Branch</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Branch</li>
                    </ul>
                </div>
                @can('create branch')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_branch"><i class="fa fa-plus"></i> New Branch</a>
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
                                <th>No</th>
                                <th>Branch</th>
                                @if(Auth::user()->can('edit branch') || Auth::user()->can('delete branch'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        @php
                            $no=1;
                        @endphp
                        <tbody>
                            @foreach ($branches as $branch)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>
                                        {{$branch->name}}
                                    </td>
                                    @canany(['edit branch', 'delete branch'])
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('edit branch')
                                                        <a  data-url="{{route('branches.edit', $branch->id)}}" id="edit-branch" class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_branch"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    @endcan
                                                    @can('delete branch')
                                                        <a id="delete-branch" data-url="{{route('branches.destroy', $branch->id)}}" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_branch"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

    @include('includes.modal.branches-modal')

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


                    $('body').on('click', '#edit-branch', function () {
                        const editUrl = $(this).data('url');
                        $('#edit-name-branch').val('')


                        $.get(editUrl, (data) => {
                            $('#edit-name-branch').val(data.name)

                            const urlNow = '{{ Request::url() }}'
                            $('#edit-form-branch').attr('action', urlNow + '/' + data.id);
                        })
                    });

                $('body').on('click', '#delete-branch', function(){
                    const deleteURL = $(this).data('url');
                    $('#form-delete-branch').attr('action', deleteURL);
                })
            });
    </script>
@endpush
