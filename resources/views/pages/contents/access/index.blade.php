@extends('pages.dashboard')

@section('title', 'setup menu')

@section('dashboard-content')
@php
    function formatRupiah($angka){
	$hasil_rupiah = "IDR " . number_format($angka,0,',','.');
	return $hasil_rupiah;
    }
@endphp
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">setup menu</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">setup menu</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Create Permission</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Open Permission</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="card col-md-6">
                    <div class="card-header">Create</div>
                    <div class="card-body">
                        <form id="createPermission">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Permission Name</label>
                               <input class="form-control" type="text" placeholder="permission" name="permission_name" aria-label="default input example">
                            </div>
                           <button type="submit" class="btn btn-primary mt-3 float-right">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card col-md-6">
                    <div class="card-header">Open</div>
                        <div class="card-body">
                            <form id="openPermission">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Role Name</label>
                                    <select class="form-select select" aria-label="Default select example" name="role_id" required>
                                        <option value="" selected>select role</option>
                                        @foreach($role as $roles)
                                            <option value="{{$roles->id}}">{{$roles->name}}</option>
                                         @endforeach
                                    </select> 
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Permission Name</label>
                                    <select class="form-select select" aria-label="Default select example" name="permission_id" required>
                                            <option value="" selected>select permission</option>
                                        @foreach($permission as $permiss)
                                            <option value="{{$permiss->id}}">{{$permiss->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 float-right">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
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
    $('#createPermission').on('submit',function(e){
        e.preventDefault();
        var data = $('#createPermission').serialize();
        $.ajax({
            url :'create-permission',
            type : 'post',
            data : data,
            dataType : 'json',
            success : function(respon){
                if (respon.status=="success"){
                    $('#createPermission')[0].reset();
                }
                swal.fire({
                    icon : respon.status,
                    text : respon.msg
                })
            }
        })
    })
    $('#openPermission').on('submit',function(e){
        e.preventDefault();
        var data = $('#openPermission').serialize();
        $.ajax({
            url :'open-permission',
            type : 'post',
            data : data,
            dataType : 'json',
            success : function(respon){
                if (respon.status=="success"){
                    $('#openPermission')[0].reset();
                }
                swal.fire({
                    icon : respon.status,
                    text : respon.msg
                })
            }
        })
    })
</script>
@endpush

