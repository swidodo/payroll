@extends('pages.dashboard')

@section('title', 'Access Branch')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">User Access Branch</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">access</li>
                    </ul>
                </div>
                @can('create allowance option')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_allowance"><i class="fa fa-plus"></i>Create</a>
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
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-3">
                            <label>Branch</label>
                            <select class="form-select form-control" id="branch_id">
                                @foreach($branches as $br)
                                <option value="{{ $br->id }} ">{{ $br->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-center mt-4"> 
                            <button type="button" class="btn btn-primary" id="searchBranch">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Allowance Option</th>
                                <th>Pay Type</th>
                                @if(Auth::user()->can('edit allowance option') || Auth::user()->can('delete allowance option'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        @php
                            $no=1;
                        @endphp
                        <tbody>
                            @foreach ($allowanceOptions as $option)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>
                                        {{$option->name}}
                                    </td>
                                    <td>
                                        {{$option->pay_type}}
                                    </td>
                                    @canany(['edit allowance option', 'delete allowance option'])
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('edit allowance option')
                                                        <a  data-url="{{route('allowance-option.edit', $option->id)}}" id="edit-allowance-option" class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_allowance"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    @endcan
                                                    @can('delete allowance option')
                                                        <a id="delete-allowance-option" data-url="{{route('allowance-option.destroy', $option->id)}}" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_allowance"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

    @include('includes.modal.allowance-option-modal')

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


                    $('body').on('click', '#edit-allowance-option', function () {
                        const editUrl = $(this).data('url');
                        $('#edit-name-allowance-option').val('')


                        $.get(editUrl, (data) => {
                            $('#edit-name-allowance-option').val(data.name)
                            $('#edit_pay_type').val(data.pay_type)
                            $('#includeAttendance').val(data.include_attendance)

                            const urlNow = '{{ Request::url() }}'
                            $('#edit-form-allowance-option').attr('action', urlNow + '/' + data.id);
                        })
                    });

                $('body').on('click', '#delete-allowance-option', function(){
                    const deleteURL = $(this).data('url');
                    $('#form-delete-allowance-option').attr('action', deleteURL);
                })
            });
            $('#pay_type').on('change',function(){
                var val = $(this).val();
                if(val == "unfixed"){
                    $('#include').html(`
                        <div class="form-group">
                            <label>Include Attendance</label>
                            <select class="form-control form-select" name="include_attendance" id="includeAttendance">
                                <option value="N" selected>No</option>
                                <option value="Y">Yes</option>
                            </select>
                        </div>`);
                }else{
                    $('#include').html('');
                }
            })
            $('#edit_pay_type').on('change',function(){
                var val = $(this).val();
                if(val == "unfixed"){
                    $('#includes').html(`
                        <div class="form-group">
                            <label>Include Attendance</label>
                            <select class="form-control form-select" name="include_attendance" id="includeAttendance">
                                <option value="N" selected>No</option>
                                <option value="Y">Yes</option>
                            </select>
                        </div>`);
                }else{
                    $('#includes').html('');
                }
            })
            
    </script>
@endpush
