@extends('pages.dashboard')

@section('title', 'Users')
@section('class', '')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Users</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ul>
                </div>
                @can('create user')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" id="AddUser"><i class="fa fa-plus"></i> Add User</a>
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
                 <div class="card">
                    <div class="card-body">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-3">
                                <label>Company</label>
                                <select class="form-select form-control" id="company_id" required>
                                    @if(Auth::user()->type =='superadmin')
                                        <option value="" selected disabbled>select company</option>
                                    @endif
                                    @foreach($company as $comp)
                                        <option value="{{ $comp->id }}">{{ $comp->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Branch</label>
                                <select class="form-select form-control" id="branchId">
                                    @if (isset($branch))
                                       @foreach($branch as $branchs)
                                            <option value="{{ $branchs->id }}" {{ (Auth::user()->branch_id == $branchs->id) ? 'selected' :'' }}>{{ $branchs->name }}</option>
                                       @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-center mt-4"> 
                                <button type="button" class="btn btn-primary" id="search">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="tableUser">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                @if(Auth::user()->can('edit user') || Auth::user()->can('delete user'))
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
    <!-- /Page Content -->

    @include('includes.modal.users-modal')

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


    <script>
         $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        $(document).ready(function () {
            var branchId = $('#branchId').val();
            LoadData(branchId)
            function LoadData(branch_id){
                $('#tableUser').DataTable({
                        processing: true,
                        serverSide: true,
                        destroy: true,
                        ajax : {
                            url : "get-data-user",
                            type : 'post',
                            data : {branch_id :branch_id},
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
                                data: 'email',
                                name : 'email'
                            },
                            {
                                data: 'type',
                                name : 'type'
                            },
                            {
                                data: 'action',
                                name : 'action'
                            },
                        ],

                    });
            }
            $('#AddUser').on('click',function(e){
                e.preventDefault();
                $.ajax({
                    url : 'add-user-data',
                    type:'post',
                    dataType : 'json',
                    beforeSend :function(){

                    },
                    success : function(respon){
                        var branch ='';
                        $.each(respon.branches,function(key,val){
                            if (respon.user.branch_id == val.id){
                                 branch +=`<option value="`+val.id+`" selected>`+val.name+`</option>`;
                            }else{
                                branch +=`<option value="`+val.id+`">`+val.name+`</option>`; 
                            }
                        }) 

                        $('#addbranch_id').html(branch)
                        var role ='<option value="" selected disabled>Select Role</option>';
                        $.each(respon.role,function(key,val){
                            role +=`<option value="`+val.id+`">`+val.name+`</option>`;
                        })
                        $('#role').html(role);
                        $('#add_user').modal('show');
                    },
                    error :function(){
                        alert('Someting went wrong !')
                    }
                }) 
            })
            $('#formAddUser').on('submit',function(e){
                e.preventDefault();
                var pass = 8;
                if (pass < 8){
                    $('#errpass').html('password must be 8 character!')
                    return true;
                }
                var branchId = $('#branchId').val();
                var data = $('#formAddUser').serialize();
                $.ajax({
                    url : 'store-user',
                    type :'post',
                    data : data,
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        if (respon.status == "success"){
                            $('#formAddUser')[0].reset();
                            $('#add_user').modal('hide')
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        })
                        LoadData(branchId)
                    },
                    error :function(){
                        alert('Someting went Wrong !')
                    }
                })
            })
            $(document).on('click','.edit-user',function(e){
                var id = $(this).attr('data-id')
                $.ajax({
                    url : 'edit-user',
                    type : 'post',
                    data : {id :id },
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        var branch ='';
                        $.each(respon.branches,function(key,val){
                            if (respon.user.branch_id == val.id){
                                 branch +=`<option value="`+val.id+`" selected>`+val.name+`</option>`;
                            }
                            else{
                                branch +=`<option value="`+val.id+`">`+val.name+`</option>`; 
                            }
                        }) 

                        $('#branch-id-edit').html(branch)
                        var role ='<option value="" selected disabled>Select Role</option>';
                        $.each(respon.role,function(key,val){
                            
                             if (respon.user.type == val.name){
                                role +=`<option value="`+val.id+`" selected>`+val.name+`</option>`;
                            }else{
                                 role +=`<option value="`+val.id+`">`+val.name+`</option>`;
                            }
                        })
                        $('#id').val(respon.user.id);
                        $('#editrole').html(role);
                        $('#editname').val(respon.user.name);
                        $('#edit-email').val(respon.user.email);
                        $('#edit_usermodal').modal('show');
                    },
                    error : function(){
                        Alert('Someting went wrong!')
                    }
                })
            })
            $('#editFormUser').on('submit',function(e){
                e.preventDefault()
                var data = $('#editFormUser').serialize();
                $.ajax({
                    url : 'update-user',
                    type :'post',
                    data : data,
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        if (respon.status == "success"){
                            $('#editFormUser')[0].reset();
                            $('#edit_usermodal').modal('hide')
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        })
                        LoadData(branchId)
                    },
                    error :function(){
                        alert('Someting went Wrong !')
                    }
                })
            })
            $('#search').on('click', function(e){
                e.preventDefault();
                var branchId = $('#branchId').val();
                // var compny = $('#company').val();
                LoadData(branchId)
            })
            $(document).on('click','.delete-user',function(e){
                e.preventDefault()
                var id = $(this).attr('data-id')
                 var branchId = $('#branchId').val();
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
                                url : 'destroy-user',
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
                                     LoadData(branchId)
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
