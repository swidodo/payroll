@extends('pages.dashboard')

@section('title', 'Rotation')

@section('dashboard-content')
@push('addon-style')
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/sweetalert2.min.css')}}">
@endpush
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Rotation Employee</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Rotation</li>
                    </ul>
                </div>
                @can('create rotation')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" id="addDataRotate"><i class="fa fa-plus"></i>Add Rotation</a>
                    </div>
                @endcan
            </div>
        </div>
        <div class="card">
            <div class="card-body">
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
                {{-- <div class="card mb-2">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
                    </div>
                </div> --}}
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="tblRotation">
                        <thead>
                            <th>No</th>
                            <th>Rotation Date</th>
                            <th>Rotation Name</th>
                            <th>Employee Name</th>
                            <th>Position</th>
                            <th>From Department</th>
                            <th>To Department</th>
                            <th>Branch Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.modal.rotate.rotate-add-modal');
@include('includes.modal.rotate.rotate-edit-modal');
@endsection
@push('addon-script')
<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        var branchId = $('#branch_id').val();
        loadData(branchId)
        function loadData(branchId){
            $('#tblRotation').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                        "url" : 'get-rotation-employee',
                        "type" : 'post',
                        "data" :{ branch_id : branchId },
                    },
                columns: [
                        { data: 'no', name:'id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {
                            data: 'rotate_date',
                            name: 'rotate_date'
                        }, 
                        {
                            data: 'rotate_name',
                            name: 'rotate_name'
                        },
                        {
                            data: 'employee_name',
                            name : 'employee_name'
                        },
                        {
                            data: 'position_name',
                            name : 'position_name'
                        },
                        {
                            data: 'from_department_name',
                            name : 'from_department_name'
                        },
                        {
                            data: 'to_department_name',
                            name : 'to_department_name'
                        },
                        {
                            data: 'branch_name',
                            name : 'branch_name'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                ],
            })
        }
        $('#addDataRotate').on('click',function(){
            $.ajax({
                url : 'get-branch-select',
                type : 'get',
                data :{

                },
                success : function(respon){
                   $('#company').val
                   (respon.company[0].name);
                   $('#companyName').val(respon.company[0].name);
                   $('#companyId').val(respon.company[0].id);
                   $('#branch').val(respon.branch[0].name);
                   $('#branchName').val(respon.branch[0].name);
                   $('#branchId').val(respon.branch[0].id);
                   var html =`<option value=""></option>`;
                   var html2=`<option value=""></option>`;
                   $.each(respon.department,function(key,val){
                        html += `<option value="`+val.id+`">`+val.department_name+`</option>`;
                        html2 += `<option value="`+val.id+`">`+val.department_name+`</option>`;
                   }) 
                    var emp = `<option value=""></option>`;
                    $.each(respon.employee,function(key,val){
                        emp += `<option value="`+val.id+`">`+val.name+`</option>`;
                   })
                     var position =`<option value=""></option>`;
                   $.each(respon.position,function(key,val){
                        position += `<option value="`+val.id+`">`+val.position_name+`</option>`;
                    })
                   $('#fromDepartment').html(html);
                   $('#toDepartment').html(html2);
                   $('#employeeId').html(emp);
                   $('#position_id').html(position);
                }
            })
            $('#addRotate').modal('show')
        })
        // slect 2
        if($('.branch-select').length > 0) {
            $('.branch-select').select2({
                width: '100%',
                tags: true,
                dropdownParent: $('#addDataRotate')
            });
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#formRotation').on('submit',function(e){
            e.preventDefault();
            var branchId = $('#branch_id').val();
            var data = $('#formRotation').serialize();
            $.ajax({
                url : 'save-data-rotation',
                type : 'post',
                data : data,
                beforeSend : function(){

                },
                success : function(respon){
                    if(respon.status == 'success'){
                        $('#addRotate').modal('hide')
                        $('#formRotation')[0].reset();
                       loadData(branchId)
                    }
                   
                    swal.fire({
                        icon :respon.status,
                        text :respon.msg,
                    })
                     
                },
                error : function(){
                    alert('Terjadi kesalahan, Silahkan coba kembali !');
                }
            })
        })
        $(document).on('click','.edit_rotate',function(){
           var id = $(this).attr('data-id');
           $.ajax({
                url : 'edit-data-rotation',
                type : 'post',
                data : {id : id},
                dataType : 'json',
                beforeSend : function(){

                },
                success : function(respon){
                    $('#editRotate').modal('show')
                    $('#editRotationDate').val(respon.rotation.rotate_date);
                    $('#editCompany').val(respon.company[0].name);
                    $('#editCompanyName').val(respon.company[0].name);
                    $('#editCompanyId').val(respon.company[0].id);
                    $('#editBranch').val(respon.branch[0].name);
                    $('#editBranchName').val(respon.branch[0].name);
                    $('#editBranchId').val(respon.branch[0].id);
                    $('#editjobLevel').val(respon.rotation.job_level);
                    $('#id').val(respon.rotation.id);
                   var html =`<option value="`+respon.rotation.from_department_id+`" selected>`+ respon.rotation.from_department_name +`</option>`;
                   var html2=`<option value="`+respon.rotation.to_department_id+`" selected>`+ respon.rotation.to_department_name+`</option>`;
                   $.each(respon.department,function(key,val){
                    if(respon.rotation.to_department_id == val.id ){
                         html2 += `<option value="`+val.id+`" selected>`+val.name+`</option>`;
                    }else{

                        html2 += `<option value="`+val.id+`">`+val.name+`</option>`;
                    }
                   })
                   $('#editFromDepartment').html(html);
                   $('#editToDepartment').html(html2);
                   var emp = `<option value="`+respon.rotation.employee_id+`" selected>`+ respon.rotation.employee_name +`</option>`;
                   $('#editEmployeeId').html(emp);
                   var position ='';
                    $.each(respon.position,function(key,val){
                        if(val.id == respon.rotation.position_id){
                            position += `<option value="`+val.id+`" selected>`+val.position_name+`</option>`;
                        }else{

                        position += `<option value="`+val.id+`">`+val.position_name+`</option>`;
                        }
                   })
                    $('#editpositionId').html(position);
                },
                error : function(){
                    alert('Terjadi kesalahan, silahkan coba kembali !')
                }
           })
        })
        $('#editFormRotation').on('submit',function(e){
            e.preventDefault();
            var branchId = $('#branch_id').val();
            var data = $('#editFormRotation').serialize();
            $.ajax({
                url : 'update-data-rotation',
                type : 'post',
                data : data,
                dataType : 'json',
                beforeSend : function(){

                },
                success : function(respon){
                    if (respon.status == 'success'){
                        $('#editRotate').modal('hide')
                        loadData(branchId)
                    }
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    })
                    
                }

            })
        })
        $('#searchBranch').on('click',function(e){
            var branchId = $('#branch_id').val();
            loadData(branchId)
        })
    })
    $('#closedbtn').click(function(e){
        e.preventDefault();
        $('#editRotate').modal('hide')
    })
</script>
@endpush
