@extends('pages.dashboard')

@section('title', 'Request')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Request Employee</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Request</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="{{route('add-request')}}" class="btn add-btn" id="add_position"><i class="fa fa-plus"></i>Request</a>
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
                    <table class="table table-striped custom-table" id="table-request">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Request Type</th>
                                <th>Branch</th>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Approve Name</th>
                                <th>Status</th>
                                <th>Action</th>
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
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/sweetalert2.min.css')}}">
@endpush

@push('addon-script')
    <!-- Slimscroll JS -->
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{asset('assets/js/moment.min.js')}}"></script>

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
            var table = $('#table-request').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                    url : "get-request",
                    type : 'post',
                },
                columns: [
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'request_type',
                        name: 'request_type'
                    },
                    {
                        data: 'branch_name',
                        name: 'branch_name'
                    },
                    {
                        data: 'no_employee',
                        name: 'no_employee'
                    },
                    {
                        data: 'employee_name',
                        name: 'employee_name'
                    }, 
                    {
                        data: 'departement_name',
                        name: 'departement_name'
                    },
                    {
                        data: 'position_name',
                        name : 'position_name'
                    },
                    {
                        data: 'approve_name',
                        name : 'approve_name'
                    },
                    {
                        data: 'status',
                        name : 'status'
                    },
                    {
                        data: 'action',
                        name : 'action'
                    },
                ],

            });
            $(document).on('click','.approve',function(e){
                var request_type    = $(this).attr('req-type');
                var id              = $(this).attr('data-id');
                if (request_type == 'leave'){
                    $.ajax({
                        url : 'get-approve-leave'
                        type : 'post',
                        data : {id:id},
                        dataType : 'json',
                        beforeSend : function(){

                        },
                        success : function(respon){
                            $('#modalApproveLeave').modal('show');

                        },
                        error : function(){
                            alert('Someting went wrong !')
                        }
                    })
                }
                else if(request_type == 'overtime'){
                    $.ajax({
                        url : 'get-approve-overtime'
                        type : 'post',
                        data : {id:id},
                        dataType : 'json',
                        beforeSend : function(){

                        },
                        success : function(respon){
                            $('#modalApproveOvertime').modal('show');
                        },
                        error : function(){
                            alert('Someting went wrong !')
                        }
                    })

                }else if(request_type == 'timesheet'){
                     $.ajax({
                        url : 'get-approve-timesheet'
                        type : 'post',
                        data : {id:id},
                        dataType : 'json',
                        beforeSend : function(){

                        },
                        success : function(respon){
                            $('#modalApproveTimesheet').modal('show');
                        },
                        error : function(){
                            alert('Someting went wrong !')
                        }
                    })
                }else if(request_type == 'attendance'){
                     $.ajax({
                        url : 'get-approve-attendance'
                        type : 'post',
                        data : {id:id},
                        dataType : 'json',
                        beforeSend : function(){

                        },
                        success : function(respon){
                            $('#modalApproveAttendance').modal('show');
                        },
                        error : function(){
                            alert('Someting went wrong !')
                        }
                    })
                }

            })
        });
    </script>
@endpush
