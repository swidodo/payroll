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
                   Change Password
                </div>
                    <div class="card-body">
                       <form id="formChangePassword">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $user->email }}" id="email" readOnly required>
                            </div>
                            <div class="form-group">
                                <label> Password Old</label>
                                <input type="password" class="form-control" name="pass_old" id="pass_old" required>
                            </div>
                            <div class="form-group">
                                <label>Password New</label>
                                <input type="password" class="form-control" name="pass_new" id="pass_new" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="pass_confirm" id="pass_confirm" required>
                                <div class="text-small" id="error"></div>
                            </div>
                            <button class="btn btn-primary" type="submit" id="btnsend">Change Password</button>
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
           $('#pass_confirm').on('keyup',function(){
            var conf = $('#pass_confirm').val()
            var pass = $('#pass_new').val()
                if (conf != pass){
                    $('#error').html('confirm password no metch !')
                    $('#btnsend').attr('disabled',true)
                }else{
                    $('#error').html('')
                    $('#btnsend').attr('disabled',false)
                }
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
                                    document.location.href ='{{route("get-my-profile")}}';
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
