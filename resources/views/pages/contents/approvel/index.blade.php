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
                    <h3 class="page-title">Approvals</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('attendance.index')}}">Approval</a></li>
                        <li class="breadcrumb-item active">Approvals</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" id="addApproval"><span class="fa fa-plus"></span> Approval</a>
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
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{route('attendance.index')}}" accept-charset="UTF-8" id="attendanceemployee_filter">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="btn-box">
                                        <label for="attendance" class="form-label">Branch</label>
                                        <select class="form-control select" id="branch" name="branch">
                                            <option value="" selected>--select branch --</option>
                                            @foreach ($branch as $branch)
                                                <option value="{{$branch->id}}" {{($branch->id == Auth::user()->branch_id) ? 'selected':''}}>{{$branch->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="btn-box">
                                        <label for="attendance" class="form-label">Department</label>
                                        <select class="form-control select" id="department_id" name="department_id">
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 align-self-end">
                                    <button type="button" class="btn btn-primary align-self-center" id="btnSerach">search <span class="btn-inner--icon"><i class="la la-search"></i></span></button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table w-100" id="attandaceList">
                                <thead>
                                    <tr>
                                        <th>Status Approve</th>
                                        <th>Employee ID</th>
                                        <th>Employee</th>
                                        <th>Department</th>
                                        <th>Branch</th>
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
        </div>
    </div>
    <!-- /Page Content -->

    @include('includes.modal.approval.add-approval')
    
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
        $('#branch').on('change',function(){
            var branch_id = $(this).val();
            $.ajax({
                url : 'get-depart',
                type : 'post',
                data : {branch_id : branch_id },
                success : function(respon){
                    var dep ='<option value="">- Select Department -</option>';
                    $.each(respon.department,function(key,val){
                        dep +=`<option value="`+val.id+`">`+val.name+`</option>`;
                    })
                    $('#department_id').html(dep)
                }
            })
        })
        var branchId = $('#branch').val();
        var department_id = $('#department_id').val();
        loadData(branchId,department_id);
        function loadData(branchId,department_id){
            $('#attandaceList').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                        "url" : 'get-data-level',
                        "type" : 'POST',
                        "data" : {branch_id : branchId, department_id : department_id},
                    },
                columns: [
                    {
                        data: 'level',
                        name: 'level'
                    },
                    {
                        data: 'no_employee',
                        name: 'no_employee'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'department_name',
                        name: 'department_name'
                    },
                    {
                        data: 'branch_name',
                        name: 'branch_name'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
            })
        }
       
        $('#btnSerach').on('click',function(){
            var branchId = $('#branch').val();
            var department_id = $('#department_id').val();
            loadData(branchId,department_id);
        })
        $('#addApproval').on('click',function(){
            var branchId = $('#branch').val();
            var text = $('#branch option:selected').text();
            $.ajax({
                url : 'get-depart',
                type : 'post',
                data : {branch_id : branchId},
                beforeSend : function(){

                },
                success : function(respon){
                    $('#addModalApproval').modal('show');
                    var dep ='<option value="">- Select Department -</option>';
                    $.each(respon.department,function(key,val){
                        dep +=`<option value="`+val.id+`">`+val.name+`</option>`;
                    })
                    $('#addBranch').html(`<option value="`+branchId+`">`+text+`</option>`);
                    $('#addDepartment').html(dep);
                },
                error : function(){
                    alert('Someting Went Wrong!');
                }
            })
        })
        $('#addDepartment').on('change',function(){
            var branch_id = $('#addBranch').val();
            $.ajax({
                url : 'get-employee-dept',
                type : 'post',
                data : {branch_id : branch_id },
                success : function(respon){
                    if (respon !=null){
                        var emp = '';
                        $.each(respon, function(key,val){
                            emp +=`<option value="`+val.id+`">`+ val.no_employee+` - `+val.name+`</option>`;
                        })
                        $('#addEmployee').html(emp)
                    }else{
                        $('#addEmployee').html('')
                    }
                }
            })
        })
        $('#formAddApproval').on('submit',function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var branchId = $('#branch').val();
            var department_id = $('#department_id').val();
        
            $.ajax({
                url : 'store-approval',
                type : 'post',
                data : data,
                beforeSend : function(){

                },
                success : function(respon){
                    if (respon.status == "success"){
                        loadData(branchId,department_id);
                        $('#formAddApproval')[0].reset();
                        $('#addModalApproval').modal('hide')
                    }
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    })
                    
                },
                error : function(){
                    alert('Someting Went Wrong!');
                }
            })
        })
        $(document).on('click','.edit-approval',function(){
             var id = $(this).attr('data-id');
             $.ajax({
                url : 'edit-approval',
                type : 'post',
                data : {id :id },
                success : function(respon){
                    $('#editModalApproval').modal('show')
                    $('#id').val(respon.approval.id)
                    var dep ='';
                    $.each(respon.department,function(key,val){
                        if (val.id == respon.approval.department_id ){
                            dep +=`<option value="`+val.id+`" selected>`+val.name+`</option>`;
                        }else{
                            dep +=`<option value="`+val.id+`">`+val.name+`</option>`;
                        }
                    })
                    $('#editdepartment_id').html(dep)
                    var emp ='';
                    $.each(respon.employee,function(key,val){
                        if (val.id == respon.approval.employee_id ){
                            emp +=`<option value="`+val.id+`" selected>`+val.no_employee+` - `+val.name+`</option>`;
                        }else{
                            emp +=`<option value="`+val.id+`">`+val.no_employee+` - `+val.name+`</option>`;
                        }
                    })
                    $('#editemployee_id').html(emp)
                    $('#editbranch_id').html(`<option value="`+respon.approval.branch_id+`">`+respon.approval.branch_name+`</option>`)
                    var lvl = '';
                    if (respon.approval.level == '1'){
                        lvl = `
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        `;
                    }
                    if (respon.approval.level == '2'){
                        lvl = `
                        <option value="1">1</option>
                        <option value="2" selected>2</option>
                        <option value="3">3</option>
                        `;
                    }
                    if (respon.approval.level == '3'){
                        lvl = `
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3" selected>3</option>
                        `;
                    }
                    $('#editlevel').html(lvl)
                }
             })
        })
        $('#formEditApproval').on('submit',function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var branchId = $('#branch').val();
            var department_id = $('#department_id').val();
            $.ajax({
                url : 'update-approval',
                type : 'post',
                data : data,
                beforeSend : function(){

                },
                success : function(respon){
                    if (respon.status == 'success'){
                        $('#editModalApproval').modal('hide')
                        loadData(branchId,department_id);
                    }
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    })
                    
                },
                error:function(){
                    alert('Something went wrong!')
                }
             })
        })
        $(document).on('click','.delete-approval', function(e){
                e.preventDefault();
                var branchId = $('#branch').val();
                var department_id = $('#department_id').val();
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure ?',
                    text: "You want remove this approval!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function(confirm){
                    if (confirm.value == true){
                        $.ajax({
                            url : 'delete-approval',
                            type : 'post',
                            data : {id : id},
                            dataType : 'json',
                            beforeSend : function(){

                            },
                            success : function(respon){
                                swal.fire({
                                    icon : respon.status,
                                    text : respon.msg,
                                })
                                loadData(branchId,department_id);
                            }
                        })
                    }
                })
                
            });
        
    </script>
@endpush
