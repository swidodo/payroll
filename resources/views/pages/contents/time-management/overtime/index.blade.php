@extends('pages.dashboard')

@section('title', 'Overtime')

@section('dashboard-content')
@php
    function formatRupiah($angka){
	$hasil_rupiah = "IDR " . number_format($angka,2,',','.');
	return $hasil_rupiah;
    }
@endphp
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">List of Overtime</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Overtime</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#modal_export"> Report</a>
                </div>
                @can('create overtime')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_overtime"><i class="fa fa-plus"></i> New Request</a>
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
                    <div class="row">
                        <h4>Filter Data</h4>
                        <hr />
                        <div class="col-md-4">
                            <label for="attendance" class="form-label">Branch</label>
                            <select class="form-control form-control-sm select" id="branchId" name="branch">
                                @foreach ($branch as $branch)
                                    <option value="{{$branch->id}}" {{($branch->id == Auth::user()->branch_id) ? 'selected':''}}>{{$branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="attendance" class="form-label">Date</label>
                            <input type="date" id="date" value="{{ $date}}" class="form-control">
                        </div>
                        <div class="col-md-4 d-flex align-items-center">
                        <button type="button" class="btn btn-primary mt-4" id="searchData"> Search </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped custom-table" id="tblOvertimes" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Employee ID</th>
                            <th>Employee</th>
                            <th>Date</th>
                            {{-- <th>End Date</th> --}}
                            {{-- <th>Overtime Type</th> --}}
                            <th>Day Type</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Amount Fee</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Notes</th>
                            @if(Auth::user()->can('edit overtime') || Auth::user()->can('delete overtime'))
                                <th class="text-end">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @include('includes.modal.overtime-modal')

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
    {{-- <script src="{{asset('assets/js/moment.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script> --}}

    <!-- timepicker JS -->
    <script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script>

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

    @if (Session::has('edit-show'))
    <script>
        $(window).on('load', function(){
            $('#edit_overtime').modal('show')
        });
    </script>
    @endif

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
            });
            // load datatable
            var branchId = $('#branchId').val();
            var date = "";
            loadData(branchId,date)
            /* When click show user */
            $('input[id*="time_add"]').each(function( index ) {
                    $(this).timepicker({
                        timeFormat: 'HH:mm',
                        // minTime: '05:00'
                    });
                })

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
                    dropdownParent: $('#add_overtime')
                });
            }

            if($('.select-day-type').length > 0) {
                $('.select-day-type').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#add_overtime')
                });
            }

            if($('.select-overtime').length > 0) {
                $('.select-overtime').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#add_overtime')
                });
            }

            //edit
            if($('.select-employee-edit').length > 0) {
                $('.select-employee-edit').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#edit_overtime')
                });
            }

            if($('.select-overtime-edit').length > 0) {
                $('.select-overtime-edit').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#edit_overtime')
                });
            }
            if($('.select-day-type-edit').length > 0) {
                $('.select-day-type-edit').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#edit_overtime')
                });
            }

                $('body').on('click', '#edit-overtime', function () {
                    const editUrl = $(this).data('url');
                    $('.wrapper-approver').empty()
                    $('#approver').hide()
                    $('#start_date_edit').val("")
                    $('#end_date_edit').val("")
                    $('#start_time_edit').val("")
                    $('#end_time_edit').val("")
                    $('#notes_edit').html("")


                    $('#employee_id_edit option[value='+ 0 +']').attr('selected','selected');
                    $('#employee_id_edit').val(0).trigger('change');

                    $('#overtime_id_edit option[value='+0 +']').attr('selected','selected');
                    $('#overtime_id_edit').val(0).trigger('change');

                    $('#day_type_id_edit option[value='+ 0 +']').attr('selected','selected');
                    $('#day_type_id_edit').val(0).trigger('change');


                    $.get(editUrl, (data) => {

                        // 3 tier approval
                        if(data.level_approve != null)
                        {
                            $('#level_approve').attr('value', data.level_approve)
                            $('#form-status').show()
                        }
                        if(data.leaveApprovals.length > 0)
                        {
                            $.each(data.leaveApprovals, function (indexInArray, valueOfElement) {
                                if (valueOfElement !== null) {
                                    $('.wrapper-approver').append(`<input disabled style="margin-bottom: 3px" class="form-control"  type="text" value="${valueOfElement.approver}">`)
                                    $('#approver').show()
                                }
                            });
                        }
                        // 3 tier approval

                        $('#start_date_edit').val(data[2].start_date)
                        $('#end_date_edit').val(data[2].end_date)
                        $('#start_time_edit').val(data[2].start_time)
                        $('#end_time_edit').val(data[2].end_time)
                        $('#notes_edit').val(data[2].notes)
                        $('#rejected_reason_edit').val(data[2].rejected_reason)


                        $('#employee_id_edit option[value='+ data[2].employee_id +']').attr('selected','selected');
                        $('#employee_id_edit').val(data[2].employee_id ? data[2].employee_id : 0).trigger('change');

                        $('#overtime_id_edit option[value='+ data[2].overtime_type_id +']').attr('selected','selected');
                        $('#overtime_id_edit').val(data[2].overtime_type_id ? data[2].overtime_type_id : 0).trigger('change');

                        $('#day_type_id_edit option[value='+ data[2].day_type_id +']').attr('selected','selected');
                        $('#day_type_id_edit').val(data[2].day_type_id ? data[2].day_type_id : 0).trigger('change');

                        $('#status_edit option[value='+ data[2].status +']').attr('selected','selected');
                        $('#status_edit').val(data[2].status ? data[2].status : 0).trigger('change');

                        const urlNow = '{{ Request::url() }}'
                        $('#edit-form-overtime').attr('action', urlNow + '/' + data[2].id);
                    })
                });

            $('body').on('click', '#delete-overtime', function(){
                const deleteURL = $(this).data('url');
                $('#form-delete-overtime').attr('action', deleteURL);
            })
            $('#searchData').on('click',function(){
                var branchId = $('#branchId').val();
                var date = $('#date').val();
                loadData(branchId,date)
            })

        });
        function loadData(branch_id,date){
           $('#tblOvertimes').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                        "url" : 'get-list-overtime',
                        "type" : 'post',
                        "data" : {branch_id : branch_id, date : date},
                    },
                columns: [
                        { data: 'no', name:'id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {
                            data: 'no_employee',
                            name: 'no_employee'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'start_date',
                            name: 'start_date'
                        },
                        {
                            data: 'day_name',
                            name: 'day_name'
                        },
                        {
                            data: 'start_time',
                            name: 'start_time'
                        },
                        {
                            data: 'end_time',
                            name: 'end_time'
                        },
                        {
                            data: 'amount_fee',
                            render : function(data, type, row){
                                var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                    if(base.lastIndexOf(".") != -1)
                                        base = base.substring(0, base.lastIndexOf("."));
                                    return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                        },
                        {
                            data: 'duration',
                            name: 'duration'
                        },
                        {
                            data: 'status',
                            render : function(data,type,row){
                                var btn ='';
                                if (data === "Pending"){
                                    btn = '<span class="badge badge-warning">Pending</span>'
                                }
                                if (data === "Approve"){
                                    btn = '<span class="badge badge-success">Approve</span>'
                                }
                                if (data === "Reject"){
                                    btn = '<span class="badge badge-danger">Reject</span>'
                                }
                                return btn;
                            }
                        },
                        {
                            data: 'notes',
                            name: 'notes'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                ],
            })
        }
    </script>
@endpush
