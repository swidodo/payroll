@extends('pages.dashboard')

@section('title', 'Department Management')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Department</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Department</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="javascript:void(0);" class="btn add-btn" id="addDepartment"><i class="fa fa-plus"></i> Department</a>
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
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="table-departements">
                        <thead>
                            <tr>
                                <th>Department Code</th>
                                <th>Department Name</th>
                                <th>Description</th>
                                <th>Branch</th>
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

    <!-- Delete Day Modal -->
    <div class="modal custom-modal fade" id="delete_departement" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Cash in Advance</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <form action="" id="form-delete-departement" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary continue-btn">Delete</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete User Modal -->
</div>
 @include('includes.modal.departments.add_department')
 @include('includes.modal.departments.edit_department')
@endsection

@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/sweetalert2.min.css')}}">
@endpush

@push('addon-script')
    <!-- Slimscroll JS -->
    <script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{asset('assets/js/moment.min.js')}}"></script>

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
            var table = $('#table-departements').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                    url : "{{route('departement.get-data-departements')}}",
                },
                columns: [
                    {
                        data: 'departement_code',
                        name: 'departement_code'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'branch.name',
                        name: 'branch.name'
                    },
                    {
                        data: 'is_active',
                        render : function(data,type,row){
                            var status='';
                            if(data == '1'){
                                status = 'Active';
                            }else{
                                status = 'Non Active';
                            }
                            return status;
                       }
                    },
                    {
                        data: 'action',
                        name : 'action'
                    },
                ],

            });
            $('body').on('click', '#delete-departement', function(){
                const deleteURL = $(this).data('url');
                $('#form-delete-departement').attr('action', deleteURL);
            })
            $('#addDepartment').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url : 'add-departement',
                    type : 'get',
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        var branch = '';
                        $.each(respon.branch, function(key,val){
                            branch += `<option value="`+val.id+`">`+val.name+`</option>`
                        })
                        $('#branchId').html(branch);
                        $('#add_department').modal('show');
                    }
                })
            })
            $('#addFormDepartement').on('submit', function(e){
                e.preventDefault()
                var data = $('#addFormDepartement').serialize();

                $.ajax({
                    url : 'store-departement',
                    type : 'post',
                    data : data,
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        if (respon.status == "success"){
                            $('#add_department').modal('hide');
                            $('#addFormDepartement')[0].reset()
                            table.ajax.reload();
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        })
                    },
                    error : function(){
                        alert('Someting went wrong !');
                    }
                })
            })
            $(document).on('click','.edit-departement',function(e){
               e.preventDefault();
               var id = $(this).attr('data-id')
                $.ajax({
                    url : 'edit-departement',
                    type : 'post',
                    data : {id : id},
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        var branch = '';
                        $.each(respon.branch, function(key,val){
                            if (respon.departement.branch_id == val.id){
                                 branch += `<option value="`+val.id+`" selected>`+val.name+`</option>`
                            }
                            branch += `<option value="`+val.id+`">`+val.name+`</option>`
                        })
                        $('#editbranchId').html(branch);
                        $('#id').val(respon.departement.id);
                        $('#editdepartement_code').val(respon.departement.departement_code)
                        $('#editname').val(respon.departement.name)
                        $('#editdescription').val(respon.departement.description)
                        var status ='';
                        if (respon.is_active == '1'){
                            status = `<option value="1" selected>Active</option>
                                            <option value="0">Not Active</option>`;
                        }else{
                             status = `<option value="1">Active</option>
                                            <option value="0"  selected>Not Active</option>`;
                        }
                         $('#editstatus').html(status)
                        $('#edit_departement').modal('show');
                    }
                })
            })
            $('#updateFormDepartement').on('submit', function(e){
                e.preventDefault()
                var data = $('#updateFormDepartement').serialize();

                $.ajax({
                    url : 'update-departement',
                    type : 'post',
                    data : data,
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        if (respon.status == "success"){
                            $('#edit_departement').modal('hide');
                            table.ajax.reload();
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        })
                    },
                    error : function(){
                        alert('Someting went wrong !');
                    }
                })
            })
            $(document).on('click','.delete-departement',function(e){
                e.preventDefault()
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
                                url : 'destroy-departement',
                                type :'post',
                                data : {id : id},
                                dataType : 'json',
                                beforeSend : function (){

                                },
                                success : function(respon){
                                    swal.fire({
                                        icon : respon.status,
                                        text : respon.msg
                                    })
                                    table.ajax.reload();
                                },
                                error : function(){
                                    alert('Someting went wrong !');
                                }
                            })
                        }
                    })
            })
        });
    </script>
@endpush
