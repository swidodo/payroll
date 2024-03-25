@extends('pages.dashboard')

@section('title', 'Attendance')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Attendance List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('attendance.index')}}">Attendance</a></li>
                        <li class="breadcrumb-item active">Attendance List</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#modal_export"> Report</a>
                </div>
                @if(Auth::user()->can('create attendance'))
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_import">Import Excel</a>
                </div>
                @endif
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
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{route('attendance.index')}}" accept-charset="UTF-8" id="attendanceemployee_filter">
                        <div class="row align-items-center justify-content-start">
                            <div class="col-md-9">
                                <div class="row justify-content-start align-items-center">
                                    <div class="col-md-5">
                                        <div class="btn-box">
                                            <label for="attendance" class="form-label">Branch</label>
                                            <select class="form-control select" id="branch" name="branch">
                                                @foreach ($branch as $branch)
                                                    <option value="{{$branch->id}}" {{($branch->id == Auth::user()->branch_id) ? 'selected':''}}>{{$branch->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 month">
                                        <div class="btn-box">
                                            <label for="month" class="form-label">Tanggal</label>
                                            <input class="form-control" name="month" type="date" value="{{ $date }}" id="dateId">
                                        </div>
                                    </div>

                                    <div class="col-3 d-flex align-items-center">
                                        <div class="form-check form-check-inline form-group  mt-4">
                                            <input type="checkbox" id="monthly" value="" name="type" class="form-check-input">
                                            <label class="form-check-label" for="monthly">Monthly</label>
                                        </div>
                                        <div class="mt-2">
                                            <a href="#" class="ms-4" id="btnEmployee"><i class="fa fa-window-restore fa-2x" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-5 date d-none">
                                        <div class="btn-box">
                                            <label for="date" class="form-label">Date</label>
                                            <input class="form-control month-btn" name="date" type="date" value="" id="month">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mt-3 d-flex justify-content-start">
                                <div class="row">
                                    <div class="col-auto ">
                                        <button type="button" class="btn btn-primary" id="btnSerach">search <span class="btn-inner--icon"><i class="la la-search"></i></span></button>
                                    </div> 
                                </div>
                            </div>
                            @if(Auth::user()->can('create attendance'))
                            <div class="col-4 mt-3 d-flex justify-content-start">
                                <div class="col-auto ">
                                    <button type="button" class="btn btn-primary ms-1 mt-1" id="btnAdjustment">Adjustment <span class="btn-inner--icon"><i class="la la-gear"></i></span></button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>

                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table" id="attandaceList">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Employee ID</th>
                                        <th>Employee</th>
                                        <th>Shift</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Clock In</th>
                                        <th>Clock Out</th>
                                        <th>Late</th>
                                        <th>Early Leaving</th>
                                        <th>Overtime</th>
                                        <th>Location</th>
                                        @if(Auth::user()->can('edit attendance') || Auth::user()->can('delete attendance'))
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
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @include('includes.modal.attendance.attendance-modal')
    @include('includes.modal.attendance.attendance-employee')
    @include('includes.modal.attendance.attendance-adjusment')

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
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/sweetalert2.min.css')}}">

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>


    <script>
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        $(document).ready(function () {
            $('.employee-select').select2({
                dropdownParent: $("#adjustment")
            });
            $(document).on('click','.edit-attendance',function(){
                var url = $(this).attr('data-url');
                $.get(url,(data)=>{
                   $('#noEmployee').val(data[0].employee.no_employee);
                   $('#nameEmployee').val(data[0].employee.name);
                   $('#date-edit').val(data[0].date);
                   $('#clock_in').val(data[0].clock_in);
                   $('#clock_out').val(data[0].clock_out);
                   $('#EmployeeId').val(data[0].employee_id);
                   $('#Id').val(data[0].id);
                })
                $('#edit_attendance').modal('show')
            })
            $(document).on('click','.delete-attendance',function(e){
                e.preventDefault();
                var url = $(this).attr('data-url');
                $('#delete_attendance').modal('show')
                // $.get(url,(data)=>{
                //     console.log(data);
                // })

            })
        });
        var employeeId = [];
        $(document).on('change','.checkedEmployee',function(){
            var id = $(this).val();

            if (this.checked === true) {
                if (! employeeId.includes(id)){
                    employeeId.push(id);
                }
		    }else{
                var list = $(this).val();
			    $.each(employeeId,function(key,val){
                    if (list == val){
                        employeeId.splice(key,1)
                    }
                })
            }
        })

        $('#btnEmployee').on('click',function(e){
            e.preventDefault();
            getListEmployee(branchId)
            $('#getDataEmployee').modal('show')
        })
        var type = $('#monthly').val();
        var date = $('#dateId').val();
        var branchId = $('#branch').val();
        loadData(type,date,branchId,employeeId);

        function loadData(type,date,branchId,employeeId){
            $('#attandaceList').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                        "url" : 'data-attendance-employee',
                        "type" : 'POST',
                        "data" : {type_filter : type, date :date, branch_id : branchId, employee_id : employeeId},
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
                        data: 'shif',
                        name: 'shif'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'clock_in',
                        name: 'clock_in'
                    },
                    {
                        data: 'clock_out',
                        name: 'clock_out'
                    },
                    {
                        data: 'late',
                        name: 'late'
                    },
                    {
                        data: 'early_leaving',
                        name: 'early_leaving'
                    },
                    {
                        data: 'overtime',
                        name: 'overtime'
                    },
                    {
                        data: 'id',
                        render : function(data,row,type){
                            var link = `<a href="location-attendance-maps/`+data+`" target="_blank" class="btn btn-primary">maps</a>`;
                            return link;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
            })
        }
        function getListEmployee(branchId){
            var branchId = $('#branch').val();
            $('#setFilterattandaceList').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                        "url" : 'getList-employee-attendance',
                        "type" : 'POST',
                        "data" : {branch_id : branchId},
                    },
                columns: [
                    {
                        data :'action',
                        name :'action'
                    },
                    {
                        data: 'no_employee',
                        name: 'no_employee'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    // {
                    //     data: 'department.name',
                    //     name: 'department.name'
                    // },
                    {
                        data: 'branch.name',
                        name: 'branch.name'
                    },
                ],
                "drawCallback": function( settings ) {
				$(".checkedEmployee").each(function (key,val) {
					if (employeeId.includes(val.value)) {
						$(this).prop("checked",true);
					}
				})
   			}
            })
        }
        $('#setSearch').on('click',function(){
            $('#getDataEmployee').modal('hide');
        })
        $('#monthly').on('change',function(){
            if (this.checked){
                $('#monthly').val('monthly');
            }else{
                $('#monthly').val();
            }
        })
        $('#btnSerach').on('click',function(){
            var type = $('#monthly').val();
            var date = $('#dateId').val();
            var branchId = $('#branch').val();
            loadData(type,date,branchId,employeeId)
        })
        $('#edit-form-attendance').on('submit',function(e){
            e.preventDefault();
            var type = $('#monthly').val();
            var date = $('#dateId').val();
            var branchId = $('#branch').val();
            var data = $('#edit-form-attendance').serialize();
            $.ajax({
                    url: 'update-employee-attendance',
                    data: data,
                    type: 'POST',
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(e){
                        swal.fire({
                            icon : e.status,
                            text : e.msg
                        })
                        $('#edit_attendance').modal('hide')
                        loadData(type,date,branchId,employeeId="")
                    },
                    error : function(){
                        alert('Someting went Wrong !')
                    }
                });
        })
        $('#btnAdjustment').on('click',function(e){
            var branchId = $('#branch').val();
            $.ajax({
                url : 'get-employee-adjustment',
                type : 'post',
                data : {branch_id : branchId },
                dataType :'json',
                beforeSend :function(){

                },
                success : function(respon){
                    var html = '<option value="">-- employee --</option>';
                    $.each(respon.employee, function(key,val){
                        html += `<option value="`+val.id+`">`+val.no_employee+`-`+val.name+`</option>`;
                    })
                    $('#employeAjustment').html(html)
                    $('#adjustment').modal('show')
                },
                error :function(){
                    alert('Someting went Wrong !')
                }
            })
        })
        $('#btnAddinput').on('click', function(e){
             e.preventDefault();
            $('#item1').append(`
                <div class="items">
                <hr />
                 <div class="row">
                    <div class="col-md-6">
                        <label>Date</label>
                        <input type="date" name="date[]" class="form-control mb-3" required>
                        <label>Status</label>
                        <select class="form-control form-select mb-3" name="status[]" required>
                            <option value="Present" selected>Present</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Leave">Leave</option>
                            <option value="Sick">Sick</option>
                            <option value="Permit">Permit</option>
                            <option value="Dispensation">Dispensation</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Clock In</label>
                        <input type="time" name="clock_in[]" class="form-control mb-3" required>
                        <label>Clock Out</label>
                        <input type="time" name="clock_out[]" class="form-control mb-3" required>
                   </div>
                </div>
                <hr /></div>`);
        })
        $('#formAjusment').on('submit',function(e){
             e.preventDefault();
            var type = $('#monthly').val();
            var date = $('#dateId').val();
            var branchId = $('#branch').val();
            var data = $('#formAjusment').serialize();
             $.ajax({
                url :'ajdusment-attendance',
                type : 'post',
                data :data,
                dataType :'json',
                beforeSend : function(){

                },
                success : function(respon){
                    loadData(type,date,branchId,employeeId="")
                    if (respon.status == 'success'){
                         $('#adjustment').modal('hide')
                        $('#formAjusment')[0].reset();
                        $('.items').remove();

                    }
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    })
                },
                error: function(){

                }
             })
              
        })
        $('#formImportAttendance').on('submit',function(e){
            e.preventDefault();
            var attendance  = $('#attendance-file-excel')[0].files[0];
            var formData = new FormData();
            formData.append('file-excel',attendance)
                $.ajax({
                    url : 'import-excel-attendance',
                    type : 'post',
                    contentType: false,
                    processData: false,
                    cache: false,
                    data : formData,
                    dataType : 'json',
                    beforeSend : function(){
                        $('.containerLoader').attr('hidden',false)
                    },
                    success : function(respon){
                        $('.containerLoader').attr('hidden',true)
                        if (respon.status == 'success'){
                            $('#formImportAttendance')[0].reset();
                            $('#add_import').modal('hide')
                            // loadData(startdate,enddate,branch_id)
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg,
                        })
                    },
                    error : function(){
                        alert('Someting went wrong !');
                        $('.containerLoader').attr('hidden',true)
                    }

                })
        })
        $(document).on('click','.delete-attendance',function(e){
            e.preventDefault();
            var branchId = $('#branch_id').val();
            var id = $(this).attr('data-id')
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(confirm){
            if (confirm.value == true){
                $.ajax({
                    url : 'delete-attendance',
                    type : 'post',
                    data : {id : id},
                    dataType : 'json',
                    beforeSend : function(){
                        $('.containerLoader').attr('hidden',false)
                    },
                    success : function(respon){
                        $('.containerLoader').attr('hidden',true)
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg,
                        })
                        loadData(branchId ,"")
                    },
                    error : function (){
                        alert('There is an error !, please try again')
                    }
                })
            }
        })
        })
    </script>
@endpush
