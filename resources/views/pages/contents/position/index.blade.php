@extends('pages.dashboard')

@section('title', 'position')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Position</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Position</li>
                    </ul>
                </div>
                @can('create position')
                <div class="col-auto float-end ms-auto">
                    <a href="javascript:void(0);" class="btn add-btn" id="add_position"><i class="fa fa-plus"></i>Position</a>
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
                            <a href="#" id="importPosition" class="btn btn-primary ms-1">Import</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="table-position">
                        <thead>
                            <tr>
                                <th>Branch</th>
                                <th>Position Code</th>
                                <th>Position Name</th>
                                <th>Description</th>
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
 @include('includes.modal.position.add_position')
 @include('includes.modal.position.edit_position')
 @include('includes.modal.position.import-position')
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
            var branchId = $('#branch_id').val();
            loadData(branchId)
            function loadData(branchId){
                $('#table-position').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax : {
                        url : "get-position",
                        type : 'post',
                        data : {branch_id : branchId}
                    },
                    columns: [
                        {
                            data: 'branch_name',
                            name: 'branch_name'
                        },
                        {
                            data: 'position_code',
                            name: 'position_code'
                        },
                        {
                            data: 'position_name',
                            name: 'position_name'
                        }, 
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'action',
                            name : 'action'
                        },
                    ],
                });
            }
            $('#add_position').on('click', function(e){
                e.preventDefault();
                $.ajax({
                    url : 'add-position',
                    type : 'get',
                    dataType : 'json',
                    beforeSend : function(){
                        $('.containerLoader').attr('hidden',false)
                    },
                    success : function(respon){
                        $('.containerLoader').attr('hidden',true)
                        var branch = '';
                        $.each(respon.branch, function(key,val){
                            branch += `<option value="`+val.id+`">`+val.name+`</option>`
                        })
                        $('#branchId').html(branch);
                        $('#add_modal_position').modal('show');
                    }
                })
            })
           
            $('#addFormPosition').on('submit', function(e){
                e.preventDefault()
                var data = $('#addFormPosition').serialize();
                var branchId = $('#branch_id').val();
        
                $.ajax({
                    url : 'store-position',
                    type : 'post',
                    data : data,
                    dataType : 'json',
                    beforeSend : function(){
                        $('.containerLoader').attr('hidden',false)
                    },
                    success : function(respon){
                        $('.containerLoader').attr('hidden',true)
                        if (respon.status == "success"){
                            $('#add_modal_position').modal('hide');
                            $('#addFormPosition')[0].reset()
                            loadData(branchId)
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        })
                    },
                    error : function(){
                        alert('Someting went wrong !');
                        $('.containerLoader').attr('hidden',true)
                    }
                })
            })
            $(document).on('click','.edit-position',function(e){
               e.preventDefault();
               var id = $(this).attr('data-id')
                $.ajax({
                    url : 'edit-position',
                    type : 'post',
                    data : {id : id},
                    dataType : 'json',
                    beforeSend : function(){
                        $('.containerLoader').attr('hidden',false)
                    },
                    success : function(respon){
                        $('.containerLoader').attr('hidden',true)
                        $('#id').val(respon.data.id);
                        $('#editBranchId').val(respon.data.branch_id);
                        $('#editBranchName').val(respon.data.branch_name);
                        $('#editPositionCode').val(respon.data.position_code);
                        $('#editPositionName').val(respon.data.position_name);
                        $('#editDescription').html(respon.data.description)
                       
                        $('#edit_position').modal('show');
                    }
                })
            })
            $('#updateFormPotision').on('submit', function(e){
                e.preventDefault()
                var branchId = $('#branch_id').val();
                var data = $('#updateFormPotision').serialize();
                $.ajax({
                    url : 'update-position',
                    type : 'post',
                    data : data,
                    dataType : 'json',
                    beforeSend : function(){
                        $('.containerLoader').attr('hidden',false)
                    },
                    success : function(respon){
                        $('.containerLoader').attr('hidden',true)
                        if (respon.status == "success"){
                            $('#edit_position').modal('hide');
                            loadData(branchId)
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        })
                    },
                    error : function(){
                        alert('Someting went wrong !');
                        $('.containerLoader').attr('hidden',true)
                    }
                })
            })
            $(document).on('click','.delete-position',function(e){
                e.preventDefault()
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
                                url : 'destroy-position',
                                type :'post',
                                data : {id : id},
                                dataType : 'json',
                                beforeSend : function (){
                                    $('.containerLoader').attr('hidden',false)
                                },
                                success : function(respon){
                                    $('.containerLoader').attr('hidden',true)
                                    swal.fire({
                                        icon : respon.status,
                                        text : respon.msg
                                    })
                                    loadData(branchId)
                                },
                                error : function(){
                                    alert('Someting went wrong !');
                                    $('.containerLoader').attr('hidden',true)
                                }
                            })
                        }
                    })
            })
             $('#searchBranch').on('click',function(e){
                var branchId = $('#branch_id').val();
                loadData(branchId)
            })
            $('#importPosition').on('click',function(e){
                e.preventDefault();
                $('#add_import_position').modal('show')
            })
            $('#formImportPosition').on('submit',function(e){
                e.preventDefault();
                var branchId = $('#branch_id').val();
                var position  = $('#position-file-excel')[0].files[0];
                var formData = new FormData();
                formData.append('file-excel',position)
                $.ajax({
                    url : 'import-position',
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
                            $('#formImportPosition')[0].reset();
                            $('#add_import_position').modal('hide')
                            loadData(branchId)
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
        });
    </script>
@endpush
