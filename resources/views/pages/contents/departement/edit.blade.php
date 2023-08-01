@extends('pages.dashboard')

@section('title', 'Create Departement')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Departement</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('departement.index')}}">Departements</a></li>
                        <li class="breadcrumb-item active">Edit Departement</li>
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
                    <div class="card-body">
                        <form action="{{route('departement.update', $departement->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Name  <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" value="{{$departement->name}}" placeholder="Departement Name">

                                        @if ($errors->has('name'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('name')[0] }}</strong></small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Branch  <span class="text-danger">*</span></label>
                                        <select class=" select" id="" name="branch_id">
                                            <option value="0">Select Branch</option>
                                            @foreach ($branch as $b)
                                            <option @if($b->id == $departement->branch->id) selected @endif value="{{$b->id}}">{{$b->name}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('branch_id'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('branch_id')[0] }}</strong></small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Departement Head  <span class="text-danger">*</span></label>
                                        <select class=" select" id="" name="departement_head_id">
                                            <option value="0">Select Head</option>
                                            @foreach ($departement_head as $dh)
                                            <option @if($dh->id == $departement->departement_head->id) selected @endif value="{{$dh->id}}">{{$dh->name}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('departement_head_id'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('departement_head_id')[0] }}</strong></small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Description  <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" placeholder="description">{{$departement->description}}</textarea>

                                        @if ($errors->has('description'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('description')[0] }}</strong></small>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Status  <span class="text-danger">*</span></label>
                                        <select class=" select" id="" name="is_active">
                                            <option @if($departement->is_active == 1) selected @endif value="1">Active</option>
                                            <option @if($departement->is_active == 0) selected @endif value="0">Not Active</option>
                                        </select>

                                        @if ($errors->has('is_active'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('is_active')[0] }}</strong></small>
                                        </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
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

<!-- Jquery timepicker -->
<link rel="stylesheet" href="{{asset('assets/css/jquery.timepicker.min.css')}}">


<!-- Select2 CSS -->
<link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">

<!-- Datetimepicker CSS -->
{{-- <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}"> --}}
@endpush

@push('addon-script')
<!-- Slimscroll JS -->
<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

<!-- Select2 JS -->
<script src="{{asset('assets/js/select2.min.js')}}"></script>

<!-- Datetimepicker JS -->
{{-- <script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script> --}}

<!-- timepicker JS -->
<script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script>

<!-- Datatable JS -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

<script>
    $(document).ready(function () {
        /* When click show user */


    });
</script>
@endpush
