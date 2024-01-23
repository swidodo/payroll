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
                        <a href="#" class="btn add-btn" id="addNewLeave"><i class="fa fa-plus"></i> New Request</a>
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
                    <table class="table table-striped custom-table" id="tblLeaveEmployee">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee ID</th>
                                <th>Employee</th>
                                <th>Leave Type</th>
                                <th>Applied On</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Days</th>
                                <th>Attachment</th>
                                <th>Leave Reason</th>
                                <th>Status</th>
                                {{-- @if(Auth::user()->can('edit leave') || Auth::user()->can('delete leave')) --}}
                                    <th class="text-end">Action</th>
                                {{-- @endif --}}
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
                    // tags: true,
                    dropdownParent: $('#add_leave')
                });
            }

            if($('.select-leave-type').length > 0) {
                $('.select-leave-type').select2({
                    width: '100%',
                    // tags: true,
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

                    
                })
            });

            $('body').on('click', '#delete-leave', function(){
                const deleteURL = $(this).data('url');
                $('#form-delete-leave').attr('action', deleteURL);
            })
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
             });
            var branchId = $('#branch_id').val();
            loadData(branchId)
            function loadData(branchId){
                $('#tblLeaveEmployee').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax : {
                            "url" : 'get-leaves',
                            "type" : 'post',
                            "data" : {branch_id : branchId},
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
                                render : function(data,row,type){
                                    var btn ='';
                                    if (data !=null){
                                        btn ="<a href='"+data+"' target='_blank' class='btn btn-primary'>view file </a>";
                                    }
                                    return btn;
                                }
                            },
                            {
                                data: 'leave_reason',
                                name : 'leave_reason'
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
                    order: [[4, 'desc']]
                });
            }
             $('#searchBranch').on('click',function(e){
                var branchId = $('#branch_id').val();
                loadData(branchId)
            })
            $('#addNewLeave').on('click',function(e){
                $('#add_leave').modal('show')
                var branch_id = $('#branch_id').val();
                $.ajax({
                    url : 'add-request-leave',
                    type : 'post',
                    data : { branch_id : branch_id },
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        var emp = '<option value="" selected>-- Select Employee --</option>';
                        $.each(respon.employee,function(key,val){
                            emp +=`<option value="`+val.id+`">`+val.name+`</option>`;
                        })
                        $('#employee_id').html(emp)

                        var type ='<option value="" selected>-- Select Leave Type --</option>';
                        $.each(respon.leaveType,function(key,val){
                            type +=`<option value="`+val.id+`">`+val.title+`</option>`;
                        })
                        $('#leave_type_id').html(type)
                    },
                    error : function() {
                        alert('Samting went wrong!')
                    }
                })
            })
            $('#formLeave').on('submit',function(e){
                e.preventDefault();
                var req_date    = $('#date_request').val();
                var request_type= $('#request-options').val();
                var branchId    = $('#branchId').val();
                var employeeId  = $('#employee_id').val();
                var leave_type_id   = $('#leave_type_id').val();
                var start_date      = $('#start_date').val();
                var end_date        = $('#end_date').val();
                var leave_reason    = $('#leave_reason').val();
                var attachment_request  = $('#attachment_leave')[0].files[0];
                var formData = new FormData();
                formData.append('branch_id',branchId)
                formData.append('employee_id',employeeId)
                formData.append('leave_type_id',leave_type_id)
                formData.append('start_date',start_date)
                formData.append('end_date',end_date)
                formData.append('leave_reason',leave_reason)
                formData.append('attachment_request',attachment_request)
                $.ajax({
                    url : 'store-leave',
                    type : 'post',
                    contentType: false,
                    processData: false,
                    cache: false,
                    data : formData,
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        var branchId = $('#branch_id').val();
                        if (respon.status == 'success'){
                            $('#formLeave')[0].reset();
                            $('#add_leave').modal('hide')
                            loadData(branchId)
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg,
                        })
                    },
                    error : function(){
                        alert('Sameting went wrong !');
                    }
            })})

            $(document).on('click','.edit-leave',function(e){
                e.preventDefault()
                var id = $(this).attr('data-id')
                $.ajax({
                    url :'edit-leave',
                    type :'post',
                    data :{id : id },
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        $('#edit_leave').modal('show')
                        var emp = `<option value="`+respon.employee.id+`">`+respon.employee.name+`</option>`
                        $('#employee_id_edit').html(emp)

                        var types ='<option value="" selected>-- Select Leave Type --</option>';
                        $.each(respon.type,function(key,val){
                            if (val.id == respon.leave.leave_type_id){
                                types +=`<option value="`+val.id+`" selected>`+val.title+`</option>`;
                            }else{
                                types +=`<option value="`+val.id+`">`+val.title+`</option>`;
                            }
                            
                        })
                        $('#leave_type_id_edit').html(types)
                       
                        $('#start_date_edit').val(respon.leave.start_date)
                        $('#end_date_edit').val(respon.leave.end_date)
                        $('#leave_reason_edit').val(respon.leave.leave_reason)
                        $('#rejected_reason_edit').val()
                         const urlNow = '{{ Request::url() }}'
                        $('#edit-form-leave').attr('action', urlNow + '/' + respon.leave.id);
                    },

                    error : function(){
                        alert('Sameting went wrong!')
                    }
                })
            })

        });
    </script>
@endpush
