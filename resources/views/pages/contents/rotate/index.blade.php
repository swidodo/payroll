@extends('pages.dashboard')

@section('title', 'Denda')

@section('dashboard-content')
@push('addon-style')
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
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
                @can('create leave type')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" id="addDataRotate"><i class="fa fa-plus"></i>Add Rotation</a>
                    </div>
                @endcan
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                {{-- <div class="card mb-2">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
                    </div>
                </div> --}}
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="tblRotation">
                        <thead>
                            <th>Rotate ID</th>
                            <th>Rotation Date</th>
                            <th>Employee Name</th>
                            <th>From Department</th>
                            <th>To Department</th>
                            <th>Company Office</th>
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


<script>
    $(document).ready(function () {
        var table = $('#tblRotation').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                        "url" : 'get-rotation-employee',
                    },
                columns: [
                        {
                            data: 'rotate_id',
                            name: 'rotate_id'
                        },
                        {
                            data: 'rotate_date',
                            name: 'rotate_date'
                        },
                        {
                            data: 'employee_name',
                            name : 'employee_name'
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
                            data: 'company_name',
                            name : 'company_name'
                        },
                        {
                            data: 'id',
                            render: function ( data, type, row ) {
                                return  `<button class="btn btn-primary btn-sm edit_rotate" data-id=`+data+`><span class="fa fa-pencil"></span></button>`;
                            }
                        },
                ],

        })
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
                   var html ='';
                   var html2='';
                   $.each(respon.department,function(key,val){
                        html += `<option value="`+val.id+`">`+val.department_name+`</option>`;
                        html2 += `<option value="`+val.id+`">`+val.department_name+`</option>`;
                   })
                   $('#fromDepartment').html(html);
                   $('#toDepartment').html(html2);
                   var emp = '';
                   $.each(respon.employee,function(key,val){
                        emp += `<option value="`+val.id+`">`+val.name+`</option>`;
                   })
                   $('#employeeId').html(emp);
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
            var data = $('#formRotation').serialize();
            $.ajax({
                url : 'save-data-rotation',
                type : 'post',
                data : data,
                beforeSend : function(){

                },
                success : function(respon){
                    $('#addRotate').modal('hide')
                    $('#formRotation')[0].reset();
                    table.ajax.reload(null,true);
                    // swal.fire({
                    //     icon :respon.status,
                    //     text :respon.msg,
                    // })
                },
                error : function(){
                    alert('Terjadi kesalahan, Silahkan coba kembali !');
                }
            })
        })
        $(document).on('click','.edit_rotate',function(){
           var id = $(this).attr('data-id');
           $('#editRotate').modal('show')
        })
    })
</script>
@endpush
