@extends('pages.dashboard')

@section('title', 'My Profile')
@section('class', '')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">My Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">my profile</li>
                    </ul>
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
                <div class="card-header">
                    <h3><strong>{{ ($employee == null) ?  '' : $employee->name }}</strong></h3>
                   {{-- <div class="row">
                    <div class="col-md-2">Head office</div>
                    <div class="col-md-2">{{ $company->name}}</div>
                    <div class="col-md-2">Branch</div>
                    <div class="col-md-2">{{ $branch->name }}</div>
                   </div> --}}
                   <div class="float-end">
                        <button class="btn btn-primary"><i class="fa fa-edit"></i>Edit</button>
                    </div>
                </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control data" readOnly>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="name" value="{{ $user->email }}" class="form-control data" readOnly>
                                </div>
                                @if ($employee != null)
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="name" value="{{ $employee->name }}" class="form-control data" readOnly>
                                </div>
                                <div class="form-group">
                                    <label>Date Of day</label>
                                    <input type="date" name="name" value="{{ $employee->doe }}" class="form-control data" readOnly>
                                </div>
                                <div class="form-group">
                                    <label>Gander</label>
                                    <input type="text" name="name" class="form-control data" readOnly>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="name" value="{{ $employee->phone }}" class="form-control data" readOnly>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="name" value="{{ $employee->address }}" class="form-control data" readOnly>
                                </div>
                                @endif
                            </div>
                            @if ($employee != null)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Identitas Card</label>
                                    <input type="text" name="name" value="{{ $employee->identity_card }}" class="form-control data" readOnly>
                                </div>
                                <div class="form-group">
                                    <label>Family Card</label>
                                    <input type="text" name="name" value="{{ $employee->family_card }}" class="form-control data" readOnly>
                                </div>
                                <div class="form-group">
                                    <label>NPWP Number</label>
                                    <input type="text" name="name" value="{{ $employee->npwp_number }}" class="form-control data" readOnly>
                                </div>
                                <div class="form-group">
                                    <label>Religion</label>
                                    <input type="text" name="name" value="{{ $employee->religion }}" class="form-control data" readOnly>
                                </div>
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input type="text" name="name" value="{{ $employee->bank_name }}" class="form-control data" readOnly>
                                </div>
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input type="text" name="name" value="{{ $employee->account_number }}" class="form-control data" readOnly>
                                </div>
                                <div class="form-group">
                                    <label>Account Holder Name</label>
                                    <input type="text" name="name" value="{{ $employee->account_holder_name }}" class="form-control data" readOnly>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
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
