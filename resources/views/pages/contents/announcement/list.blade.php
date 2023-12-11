@extends('pages.dashboard')

@section('title', 'Inbox Announcement')

@section('dashboard-content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Inbox Announcement</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">inbox</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-md-12">
                @if($inbox !=null)
                    @foreach($inbox as $pesan)
                        <a href="view-inbox/{{$pesan->id}}" class="text-black">
                            <div class="card shadow-sm bg-success">
                                <div class="card-body"> 
                                    <span class="fa fa-envelope text-light fa-lg me-1"></span> {{ Ucwords($pesan->title) }}
                                </div>
                                <div class="card-footer">{{ date('d-m-Y', strtotime($pesan->date))}}</div>
                            </div>
                        </a>
                    @endforeach
                @endif
                @foreach ($inbox_read as $read)
                    <a href="view-inbox/{{$read->id}}" class="text-black">
                        <div class="card shadow-sm" style="background-color :rgb(210, 212, 214)">
                            <div class="card-body"> 
                                <span class="fa fa-envelope-open-o text-light fa-lg me-1"></span> {{ Ucwords($read->title) }}
                            </div>
                            <div class="card-footer">{{date('d-m-Y', strtotime($read->date))}}</div>
                        </div>
                    </a>
                @endforeach
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

    <!-- Ck Editor -->
	<link rel="stylesheet" href="{{asset('assets/css/ckeditor.css')}}">
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

    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Ck Editor JS -->
	<script src="{{asset('assets/js/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function () {
        });
    </script>
@endpush
