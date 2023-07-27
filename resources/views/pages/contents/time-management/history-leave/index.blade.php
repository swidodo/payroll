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
                        <option value="0" >Select Branch</option>
                        {{-- @foreach ($branches as $item)
                            @if (strlen(Request::query('branch_id')) > 10)
                                @if ($item->id == \Illuminate\Support\Facades\Crypt::decrypt(Request::query('branch_id')))
                                    <option value="{{\Illuminate\Support\Facades\Crypt::encrypt($item->id)}}" selected>{{ $item->name }}</option>
                                @else
                                    <option value="{{\Illuminate\Support\Facades\Crypt::encrypt($item->id)}}" >{{ $item->name }}</option>
                                @endif
                            @else
                                <option value="{{\Illuminate\Support\Facades\Crypt::encrypt($item->id)}}" >{{ $item->name }}</option>
                            @endif
                        @endforeach --}}
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
                        {{-- @foreach ($employee as $item)
                            @if (strlen(Request::query('employee_id')) > 10)
                                @if ($item->id == \Illuminate\Support\Facades\Crypt::decrypt(Request::query('employee_id')))
                                    <option value="{{\Illuminate\Support\Facades\Crypt::encrypt($item->id)}}" selected>{{ $item->name }}</option>
                                @else
                                    <option value="{{\Illuminate\Support\Facades\Crypt::encrypt($item->id)}}" >{{ $item->name }}</option>
                                @endif
                            @else
                                <option value="{{\Illuminate\Support\Facades\Crypt::encrypt($item->id)}}" >{{ $item->name }}</option>
                            @endif
                        @endforeach --}}
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
                                {{-- @if(Auth::user()->can('edit leave') || Auth::user()->can('delete leave'))
                                    <th class="text-end">Action</th>
                                @endif --}}
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($leaves as $leave)
                                <tr>
                                    <td>
                                        {{$leave->employee->name ?? '-'}}
                                    </td>
                                    <td>
                                        {{$leave->title ?? '-'}}
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

                                </tr>
                            {{-- @endforeach --}}
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
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
             });
            var branch_id=$('#branch-filter').val();
            var table = $('#tblHistory').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                        "url" : 'data-history-leaves',
                        "type" : 'POST',
                        "data" : {"_token": "{{ csrf_token() }}",branch_id : branch_id},
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



