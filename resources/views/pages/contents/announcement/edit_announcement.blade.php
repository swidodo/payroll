@extends('pages.dashboard')

@section('title', 'Manage Announcement')

@section('dashboard-content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Announcement</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Announcement</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-md-12">
                <form id="formAnnouncement" action="{{route('update-announcement')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="hidden" name="id" class="form-control" value="{{ $info->id }}">
                        <input type="hidden" name="branch_id" class="form-control" value="{{ $info->branch_id }}">
                        <input type="text" name="title" class="form-control" value="{{ $info->title }}">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="ckeditor" name="content" rows="7" id="editor">{{ $info->content }}</textarea>
                    </div>
                    <a href="" class="btn btn-warning">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
    <!-- Ck Editor -->
	<link rel="stylesheet" href="{{asset('assets/css/ckeditor.css')}}">
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
    <!-- Ck Editor JS -->
	<script src="{{asset('assets/js/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
            });
        });
    </script>
@endpush
