@extends('pages.dashboard')

@section('title', 'Travelling')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Travelling</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Travelling</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#modal_export"> Report</a>
                </div>
                @can('create timesheet')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" id="addTimesheet" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_timesheet"><i class="fa fa-plus"></i> New Request</a>
                    </div>
                @endcan
            </div>
        </div>
        <!-- /Page Header -->

{{-- 
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session::get('success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif --}}

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-3">
                            <label>Branch</label>
                            <select class="form-select form-control" id="branch_id">
                                @foreach($branch as $br)
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
                    <table class="table table-striped custom-table" id="tblTimesheets">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Duration</th>
                                <th>Task / Project</th>
                                <th>Client</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
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

    @include('includes.modal.timesheet-modal')

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
            $('#edit_timesheet').modal('show')
        });
    </script>
    @endif

    <script>
         $.ajaxSetup({
            headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
            $(document).ready(function () {
                /* When click show user */
                var branchId = $('#branch_id').val()
                loadData(branchId);
                function loadData(branchId){
                $('#tblTimesheets').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax : {
                            "url" : 'filter-branch-timesheets',
                            "type" : 'post',
                            "data" :{ branch_id : branchId },
                        },
                    columns: [
                            { data: 'no', name:'id', render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }},
                            {
                                data: 'name',
                                name: 'name'
                            }, 
                            {
                                data: 'start_date',
                                name: 'start_date'
                            },
                            {
                                data: 'end_date',
                                name : 'end_date'
                            },
                            {
                                data: 'duration',
                                name : 'duration'
                            },
                            {
                                data: 'task_or_project',
                                name : 'task_or_project'
                            },
                            {
                                data: 'client_company',
                                name : 'client_company'
                            },
                            {
                                data: 'status',
                                name : 'status'
                            },
                            {
                                data: 'action',
                                name: 'action'
                            },
                        ],
                    })
                }
                $('#searchBranch').on('click',function(){
                    var branchId = $('#branch_id').val()
                    loadData(branchId);
                })
                $('#addTimesheet').on('click',function(){
                    var val = $('#branch_id').val();
                    var text = $('#branch_id option:selected').text();
                    $('#branchInput').html(`<option value="`+val+`">`+text+`</option>`)
                    $.ajax({
                        url : 'get-emp-timesheet',
                        type : 'post',
                        data : {branch_id : val},
                        dataType : 'json',
                        success : function(respon){
                            var emp = '';
                            $.each(respon, function(key,val){
                                emp += `<option value="`+val.id+`">`+val.name+`</option>`;
                            })
                            $('#employee_id_add').html(emp);
                        }
                    })
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
                        dropdownParent: $('#add_timesheet')
                    });
                }
                if($('.select-employee-edit').length > 0) {
                    $('.select-employee-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_timesheet')
                    });
                }
                if($('.select-project-stage-add').length > 0) {
                    $('.select-project-stage-add').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#add_timesheet')
                    });
                }
                if($('.select-project-stage-edit').length > 0) {
                    $('.select-project-stage-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_timesheet')
                    });
                }
                $('body').on('click', '#edit-timesheet', function () {
                    var id = $(this).attr('data-id');
                    const editUrl = `timesheets/`+id+`/edit`;
                    // $('#edit-name-branch').val('')
                    $('.wrapper-approver').empty()


                    $.get(editUrl, (data) => {
                        let hostNameFileAttachment = `{{ asset('${data.file_attachment}') }}`
                        let hostNameAttachmentRejected = `{{ asset('${data.attachment_reject}') }}`

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
                        $('#employee_id_edit').html(`<option value="`+data[0].employee_id+`">`+data[0].name+`</option>`)
                        $('#start_date_edit').val(data[0].start_date)
                        $('#end_date_edit').val(data[0].end_date)
                        $('#task_or_project_edit').val(data[0].task_or_project)
                        $('#activity_edit').val(data[0].activity)
                        $('#client_company_edit').val(data[0].client_company)
                        $('#label_project_edit').val(data[0].label_project)
                        $('#support_edit').val(data[0].support)
                        $('#remark_edit').html(data[0].remark)
                        $('#rejected_reason_edit').html(data[0].rejected_reason)
                        $('#file-attachment-see').attr('href', hostNameFileAttachment)
                        $('#file-attachment-see').html(data[0].file_attachment != null ? data[0].file_attachment.split('/')[1] : '')
                        $('#attachment-rejected-see').attr('href', hostNameAttachmentRejected)
                        $('#attachment-rejected-see').html(data[0].attachment_reject != null ? data[0].attachment_reject.split('/')[1] : '')
                        
                        $('#employee_id_edit option[value='+ data[0].employee_id +']').attr('selected','selected');
                        $('#employee_id_edit').val(data[0].employee_id ? data[0].employee_id : 0).trigger('change');

                        $('#status_edit option[value='+ data[0].status +']').attr('selected','selected');
                        $('#status_edit').val(data[0].status ? data[0].status : 0).trigger('change');

                        // $('#project_stage_edit option[value='+ data[0].project_stage +']').attr('selected','selected');
                            $('#project_stage_edit').val(data[0].project_stage ? data[0].project_stage : 0).trigger('change');

                        const urlNow = '{{ Request::url() }}'
                        $('#edit-form-timesheet').attr('action', urlNow + '/' + data[0].id);
                    })
                });
                $(document).on('click','.delete-timesheets',function(){
                    var id = $(this).attr('data-id');
                    $.ajax({
                        url : 'delete-timesheet',
                        type : 'post',
                        data : {id : id },
                        dataType : 'json',
                        success : function(respon){
                            swal.fire({
                                icon : respon.status,
                                text : respon.msg
                            })
                            var branchId = $('#branch_id').val()
                            loadData(branchId);
                        }
                    })
                })
            });
    </script>
@endpush
