@extends('pages.dashboard')

@section('title', 'Edit Access Mobile')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Access Mobile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">access</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    @can('create access mobile')
                        <a href="#" class="btn add-btn me-2" id="create-menu"><i class="fa fa-plus"></i> Menu</a>
                    @endcan
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <form id="form-access">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Company <i class="text-danger">*</i></label>
                                    <select class="form-control" name="company_id" id="filter-company" required>
                                        <option value="{{ $data->company_id}}">{{ $data->company_name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Branch <i class="text-danger">*</i></label>
                                    <select class="form-control" name="branch_id" id="filter-branch" required>
                                        <option value="{{ $data->id}}">{{ $data->name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary mt-4">Update</button>
                                    <a href="{{ route('access-mobile')}}" class="btn btn-secondary mt-4">Back</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered mt-4">
                                        <thead>
                                            <th width="3" class="text-center">No</th>
                                            <th>Menu Name</th>
                                            <th class="text-center">Access <i class="text-danger">*</i></th>
                                        </thead>
                                        <tbody>
                                            @php $no =1; @endphp
                                            @foreach ($access as $list)
                                                <tr>
                                                    <td class="text-center">{{ $no }}</td>
                                                    <td>
                                                        {{ $list->name }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($list->status == 1)
                                                            <input class="form-check-input" type="checkbox" name="menu_id[]" value="{{ $list->id }}" id="flexCheckDefault" checked>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" name="menu_id[]" value="{{ $list->id }}" id="flexCheckDefault">
                                                        @endif
                                                    </td>
                                                </tr>
                                                @php $no++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @include('includes.modal.menu-accessmobile-modal')

</div>
@endsection

@push('addon-style')
<style>
    .select2-results { background-color: #cfd8dc; }
</style>
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
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
            });  
            $('#filter-company').select2({
                width: '100%'
            })          
            $('#filter-branch').select2({
                width: '100%'
            })          
           
            $('#form-access').on('submit',function(e){
                e.preventDefault();
                var data = $('#form-access').serialize()
                var branch = $('#filter-branch').val();
                $.ajax({
                    url : 'update-access-menu',
                    type : 'post',
                    data : data,
                    dataType : 'json',
                    success : function(respon){
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        }).then(function() {
                            if(respon.status == 'success'){
                                window.location.href = branch;
                            }
                        });
                    }
                })
            }) 
        })
            
    </script>
@endpush
