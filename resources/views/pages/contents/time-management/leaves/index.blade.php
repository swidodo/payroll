@extends('pages.dashboard')

@section('title', 'Leave')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">List of Leave</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Leave</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#modal_export"> Report</a>
                </div>
                @can('create leave')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_leave"><i class="fa fa-plus"></i> New Request</a>
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
                                <th>Employee</th>
                                <th>Leave Type</th>
                                <th>Applied On</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Days</th>
                                <th>Attachment</th>
                                <th>Leave Reason</th>
                                <th>Status</th>
                                @if(Auth::user()->can('edit leave') || Auth::user()->can('delete leave'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaves as $leave)
                                <tr>
                                    <td>
                                        {{$leave->employee->name ?? '-'}}
                                    </td>
                                    <td>
                                        {{$leave->leave_type->title ?? '-'}}
                                    </td>
                                    <td>
                                        {{$leave->applied_on ?? '-'}}
                                    </td>
                                    <td>
                                        {{$leave->start_date ?? '-'}}
                                    </td>
                                    <td>
                                        {{$leave->end_date ?? '-'}}
                                    </td>
                                    @php
                                        $startDate = new DateTime($leave->start_date);
                                        $endDate   = new DateTime($leave->end_date);
                                        $total_leave_days = !empty($startDate->diff($endDate))?$startDate->diff($endDate)->days:0;
                                    @endphp
                                    <td>
                                        {{$total_leave_days ?? '-'}}
                                    </td>
                                    <td>
                                        <a href=" {{isset($leave->attachment_request_path) ? asset($leave->attachment_request_path) : '#'}}">
                                            <div class="status_badge badge bg-success p-2 px-3 rounded">
                                                File
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        {{$leave->leave_reason ?? '-'}}
                                    </td>
                                    <td>
                                        @if($leave->status=="Pending")
                                            <div class="status_badge badge bg-warning p-2 px-3 rounded">{{ $leave->status ?? '-'}}</div>
                                        @elseif($leave->status=="Approved")
                                            <div class="status_badge badge bg-success p-2 px-3 rounded">{{ $leave->status ?? '-'}}</div>
                                        @elseif($leave->status=="Rejected")
                                            <a href="{{route('leaves.show', $leave->id)}}" class="text-white">
                                                <div class="status_badge badge bg-danger p-2 px-3 rounded">
                                                    {{ $leave->status ?? '-'}}
                                                </div>
                                            </a>
                                        @endif
                                    </td>
                                    @canany(['edit leave', 'delete leave'])
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('edit leave')
                                                        <a  data-url="{{route('leaves.edit', $leave->id)}}" id="edit-leave" class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_leave"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    @endcan
                                                    @can('delete leave')
                                                        <a id="delete-leave" data-url="{{route('leaves.destroy', $leave->id)}}" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_leave"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

    @include('includes.modal.leave-modal')

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

                //edit
                if($('.select-employee-edit').length > 0) {
                    $('.select-employee-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_leave')
                    });
                }

                if($('.select-leave-type-edit').length > 0) {
                    $('.select-leave-type-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_leave')
                    });
                }

                    $('body').on('click', '#edit-leave', function () {
                        const editUrl = $(this).data('url');
                        $('.wrapper-approver').empty()
                        $('#approver').hide()


                        $.get(editUrl, (data) => {
                            // let splitFile = data[2].attachment_reject.split('/')
                            // const lastItem = splitFile[splitFile.length - 1]

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
                            $('#leave_reason_edit').html(data[2].leave_reason)
                            $('#rejected_reason_edit').html(data[2].rejected_reason)
                            // $('#attachment_rejected_edit_anchor').attr('href', data[2].attachment_reject)
                            // $('#attachment_rejected_edit_anchor').html(lastItem)
                            
                            $('#employee_id_edit option[value='+ data[0].id +']').attr('selected','selected');
                            $('#employee_id_edit').val(data[0].id ? data[0].id : 0).trigger('change');

                            $('#leave_type_id_edit option[value='+ data[2].leave_type_id +']').attr('selected','selected');
                            $('#leave_type_id_edit').val(data[2].leave_type_id ? data[2].leave_type_id : 0).trigger('change');

                            $('#status_edit option[value='+ data[2].status +']').attr('selected','selected');
                            $('#status_edit').val(data[2].status ? data[2].status : 0).trigger('change');
                            
                            const urlNow = '{{ Request::url() }}'
                            $('#edit-form-leave').attr('action', urlNow + '/' + data[2].id);
                        })
                    });

                $('body').on('click', '#delete-leave', function(){
                    const deleteURL = $(this).data('url');
                    $('#form-delete-leave').attr('action', deleteURL);
                })
            });
    </script>
@endpush
