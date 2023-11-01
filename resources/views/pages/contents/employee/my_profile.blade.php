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
            {{-- <div class="card">
                <div class="row">
                <div class="col-md-2">Head office</div>
                <div class="col-md-2">{{ $company->name}}</div>
                <div class="col-md-2">Branch</div>
                <div class="col-md-2">{{ $branch->name }}</div>
                </div>
            </div> --}}
            <div class="col-md-12">
               <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3><strong>{{ ($employee == null) ?  '' : $employee->name }}</strong></h3>
                        </div>
                        <div class="col-md-6" id="btnAct">
                            <div class="float-end">
                                <button class="btn btn-primary" id="editProfile"><i class="fa fa-edit"></i> Edit</button>
                                <button class="btn btn-primary" id="Simpanedit" hidden><i class="fa fa-save"></i> Save</button>
                                <button class="btn btn-primary" id="Bataledit" hidden><i class="fa fa-cancel"></i>Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="card-body">
                        <form id="formProfile">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" value="{{ $user->name }}" class="form-control data" readOnly>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control data" readOnly>
                                    </div>
                                    @if ($employee != null)
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" value="{{ $employee->name }}" class="form-control data" readOnly>
                                    </div>
                                    <div class="form-group">
                                        <label>Date Of day</label>
                                        <input type="date" name="doe" value="{{ $employee->doe }}" class="form-control data" readOnly>
                                    </div>
                                    <div class="form-group">
                                        <label>Gander</label>
                                        <select class="form-control" name="gender">
                                            <option value="MALE" {{ ($employee->gender =='MALE') ? 'selected':'';}}>MALE</option>
                                            <option value="FEMALE" {{ ($employee->gender =='FEMALE') ? 'selected':'';}}>FEMALE</option>
                                        </select>
                                        </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="{{ $employee->phone }}" class="form-control data" readOnly>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" value="{{ $employee->address }}" class="form-control data" readOnly>
                                    </div>
                                    @endif
                                </div>
                                @if ($employee != null)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Identitas Card</label>
                                        <input type="text" name="identity_card" value="{{ $employee->identity_card }}" class="form-control data" readOnly>
                                    </div>
                                    <div class="form-group">
                                        <label>Family Card</label>
                                        <input type="text" name="family_card" value="{{ $employee->family_card }}" class="form-control data" readOnly>
                                    </div>
                                    <div class="form-group">
                                        <label>NPWP Number</label>
                                        <input type="text" name="npwp_number" value="{{ $employee->npwp_number }}" class="form-control data" readOnly>
                                    </div>
                                    <div class="form-group">
                                        <label>Religion</label>
                                        <input type="text" name="religion" value="{{ $employee->religion }}" class="form-control data" readOnly>
                                    </div>
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input type="text" name="bank_name" value="{{ $employee->bank_name }}" class="form-control data" readOnly>
                                    </div>
                                    <div class="form-group">
                                        <label>Account Number</label>
                                        <input type="text" name="account_number" value="{{ $employee->account_number }}" class="form-control data" readOnly>
                                    </div>
                                    <div class="form-group">
                                        <label>Account Holder Name</label>
                                        <input type="text" name="account_holder_name" value="{{ $employee->account_holder_name }}" class="form-control data" readOnly>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>
               </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

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
           $('#editProfile').on('click',function(){
                $('.data').attr('readonly',false);
                $('#editProfile').attr('hidden',true)
                $('#Bataledit').attr('hidden',false)
                $('#Simpanedit').attr('hidden',false)
           })
           $('#Bataledit').on('click',function(){
                $('.data').attr('readonly',true);
                $('#editProfile').attr('hidden',false)
                $('#Bataledit').attr('hidden',true)
                $('#Simpanedit').attr('hidden',true)
           })
           $('#Simpanedit').on('click', function(){
                var data = $('#formProfile').serialize()
                Swal.fire({
                            title: 'Are you sure?',
                            text: "You Change profile!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        }).then(function(confirm){
                        if (confirm.value == true){
                            $.ajax({
                                url : 'change-profile',
                                type :'post',
                                data : data,
                                dataType : 'json',
                                beforeSend : function (){
                                    $('.containerLoader').attr('hidden',false)
                                },
                                success : function(respon){
                                    swal.fire({
                                        icon : respon.status,
                                        text : respon.msg
                                    })
                                    $('.containerLoader').attr('hidden',true)
                                    window.location.href ={{route('get-my-profile')}}
                                },
                                error : function(){
                                    alert('Someting went wrong !');
                                }
                            })
                        }
                    })
           })
            // $(document).on('click','.delete-user',function(e){
            //     e.preventDefault()
            //     var id = $(this).attr('data-id')
            //      var branchId = $('#branchId').val();
            //     Swal.fire({
            //                 title: 'Are you sure?',
            //                 text: "You won't be able to revert this!",
            //                 icon: 'warning',
            //                 showCancelButton: true,
            //                 confirmButtonColor: '#3085d6',
            //                 cancelButtonColor: '#d33',
            //                 confirmButtonText: 'Yes, delete it!'
            //             }).then(function(confirm){
            //             if (confirm.value == true){
            //                 $.ajax({
            //                     url : 'destroy-user',
            //                     type :'post',
            //                     data : {id : id},
            //                     dataType : 'json',
            //                     beforeSend : function (){

            //                     },
            //                     success : function(respon){
            //                         swal.fire({
            //                             icon : respon.status,
            //                             text : respon.msg
            //                         })
            //                          LoadData(branchId)
            //                     },
            //                     error : function(){
            //                         alert('Someting went wrong !');
            //                     }
            //                 })
            //             }
            //         })
            // })
        });
       
    </script>
@endpush
