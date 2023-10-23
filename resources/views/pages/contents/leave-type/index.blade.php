@extends('pages.dashboard')

@section('title', 'Leave type')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Leave Type</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Leave Type</li>
                    </ul>
                </div>
                @can('create leave type')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_leave_type"><i class="fa fa-plus"></i> Leave Type</a>
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
                                <th>Leave Type</th>
                                <th>Days / Year</th>
                                @if(Auth::user()->can('edit leave type') || Auth::user()->can('delete leave type'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        @php
                            $no=1;
                        @endphp
                        <tbody>
                            @foreach ($leavetypes as $type)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>
                                        {{$type->title}}
                                    </td>
                                    <td>
                                        {{$type->days}}
                                    </td>
                                    @canany(['edit leave type', 'delete leave type'])
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('edit leave type')
                                                        <a  data-url="{{route('leave-type.edit', $type->id)}}" id="edit-leave-type" class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_leave_type"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    @endcan
                                                    @can('delete leave type')
                                                        <a id="delete-leave-type" data-url="{{route('leave-type.destroy', $type->id)}}" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_leave_type"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

    @include('includes.modal.leave-type-modal')

</div>
@endsection

@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/sweetalert2.min.css')}}">
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
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    @if (Session::has('edit-show'))
    <script>
        $(window).on('load', function(){
            $('#edit_user').modal('show')
        });
    </script>
    @endif

    <script>
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
                });
                /* When click show user */


                    $('body').on('click', '#edit-leave-type', function () {
                        const editUrl = $(this).data('url');
                        $('#edit-title-leave-type').val('')
                        $('#edit-days-leave-type').val('')


                        $.get(editUrl, (data) => {
                            $('#edit-title-leave-type').val(data.title)
                            $('#edit-days-leave-type').val(data.days)

                            const urlNow = '{{ Request::url() }}'
                            $('#edit-form-leave-type').attr('action', urlNow + '/' + data.id);
                        })
                    });

                $('body').on('click', '#delete-leave-type', function(){
                    const deleteURL = $(this).data('url');
                    $('#form-delete-leave-type').attr('action', deleteURL);
                })
            });
            $('#fromAddLeaveType').on('submit', function(e){
                e.preventDefault();
                var title = $('#typeName option:selected').text();
                var code = $('#typeName option:selected').val();
                var days = $('#days').val();
                var include = $('#includeSalary').val();
                $.ajax({
                    url : 'create-leave-type',
                    type : 'post',
                    data :{ title : title, code : code, days: days,include_salary:include},
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        Swal.fire({
                            icon : respon.status,
                            text : respon.msg,
                        })
                       $('#add_leave_type').modal('hide');
                    },
                    error : function () {
                        alert('There is an error !, please try again')
                    }
                })

            })
    </script>
@endpush
