@extends('pages.dashboard')

@section('title', 'History Leave')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">List of History Leave</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Leave</li>
                    </ul>
                </div>
                {{-- <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#modal_export"> Report</a>
                </div> --}}
                {{-- @can('create leave')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_leave"><i class="fa fa-plus"></i> New Request</a>
                    </div>
                @endcan --}}
            </div>
        </div>
        <!-- /Page Header -->

        <form action="{{route('history-leave.index')}}" accept-charset="UTF-8"  method="GET">
                <div class="row filter-row align-items-center">
            <div class="col-sm-6 col-md-3">
                <div class="form-group" >
                    <label class="focus-label">Branch</label>
                    <select class="select" name="branch_id" id="branch-filter">
                        @foreach ($branch as $item)
                            <option value={{ $item->id }}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group" >
                    <label class="focus-label">Employee</label>
                    <select class="select" name="employee_id" id="employee-filter">
                        <option value=""></option>
                        @foreach ($employee as $item)
                            <option value={{ $item->id }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <button href="#" type="submit" class="btn btn-success w-100"> Search </button>
            </div>
        </div>
    </form>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="tblHistory">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Leave Type</th>
                                <th>Applied On</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Days</th>
                                <th>Attachment</th>
                                <th>Leave Reason</th>
                                <th>Status</th>
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

    {{-- @include('includes.modal.leave-modal') --}}

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
            $('#edit_leave').modal('show')
        });
    </script>
    @endif

    <script>

        $(document).ready(function () {
            /* When click show user */
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
            });
            $('select#status_edit').change(function(){
                let selectedItem = $(this).children('option:selected').val()

                if (selectedItem == 'Rejected') {
                    $('#rejected-reason').show()
                }else{
                    $('#rejected-reason').hide()
                }
            })

            if($('.select-employee').length > 0) {
                $('.select-employee').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#add_leave')
                });
            }

            if($('.select-leave-type').length > 0) {
                $('.select-leave-type').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#add_leave')
                });
            }
            var branch_id = $('#branch-filter').val();
            var employeeId = $('#employee-filter').val();
            var table = $('#tblHistory').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                        "url" : 'data-history-leaves',
                        "type" : 'POST',
                        "data" : {branch_id : branch_id,employee_id : employeeId},
                    },
                columns: [
                    {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'title',
                            name : 'title'
                        },
                        {
                            data: 'applied_on',
                            name : 'applied_on'
                        },
                        {
                            data: 'start_date',
                            name : 'start_date'
                        },
                        {
                            data: 'end_date',
                            name : 'end_date'
                        },
                        {
                            data: 'total_leave_days',
                            name : 'total_leave_days'
                        },
                        {
                            data: 'attachment_request_path',
                            render: function ( data, type, row ) {
                                return `<a href="`+data+`">
                                            <div class="status_badge badge bg-success p-2 px-3 rounded">
                                                File
                                            </div>
                                        </a>`;
                            }
                        },
                        {
                            data: 'leave_reason',
                            name : 'leave_reason'
                        },
                        {
                            data: 'status',
                            render : function(data, type, row){
                                var btn = '';
                                if (data == 'Pending'){
                                    btn = `<div class="status_badge badge bg-warning p-2 px-3 rounded">`+data+`</div>`;
                                }
                                if (data == 'Approved'){
                                    btn = `<div class="status_badge badge bg-success p-2 px-3 rounded">`+data+`</div>`;
                                }
                                if (data =='Rejected'){
                                    btn = `<a href="" class="text-white">
                                                <div class="status_badge badge bg-danger p-2 px-3 rounded">
                                                    `+data+`
                                                </div>
                                            </a>`;
                                }
                                return btn;
                            }
                        },
                ],
            })
            $().on('change',function(){

            })
        });
    </script>
@endpush



