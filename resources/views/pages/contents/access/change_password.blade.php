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
       <form action="{{route('change_store')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <input class="form-control" type="password" name="password">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Repassword <span class="text-danger">*</span></label>
                        <input class="form-control" type="password" name="repassword">
                    </div>
                </div>
            </div>
        </form>              
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

