@extends('pages.dashboard')

@section('title', 'Access Branch')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Access Branch</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">access</li>
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
                <form id="edit-form-access">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="hidden" value="{{$data[0]->company_id}}" name="company_id">
                                    <label>Branch <i class="text-danger">*</i></label>
                                    <select class="form-control" name="branch_id" id="filter-branch" required>
                                       <option value="{{ $data[0]->branch_id}}">{{ $data[0]->branch_name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Employee <i class="text-danger">*</i></label>
                                    <select class="form-control" name="employee_id" id="filter-employee" required>
                                        <option value="{{ $data[0]->employee_id}}">{{ $data[0]->name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    @can('edit access branch')
                                        <button type="submit" class="btn btn-primary mt-4">Update</button>
                                    @endcan
                                    <a href="{{ route('access-branch')}}" class="btn btn-secondary mt-4">Back</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered mt-4">
                                        <thead>
                                            <th width="3" class="text-center">No</th>
                                            <th>Branch Name</th>
                                            <th class="text-center">Access <i class="text-danger">*</i></th>
                                        </thead>
                                        <tbody>
                                            @php 
                                                $no =1;
                                                $dtbranch =[];
                                            @endphp
                                            @foreach ($data as $dt )
                                                @php
                                                    array_push($dtbranch,$dt->branch_id);
                                                @endphp
                                            @endforeach
                                            @foreach ($cabang as $list)
                                                <tr>
                                                        <td class="text-center">{{ $no }}</td>
                                                        <td>
                                                            {{ $list->name }}
                                                        </td>
                                                        <td class="text-center">
                                                            @if(in_array($list->id,$dtbranch))
                                                            <input class="form-check-input" type="checkbox" name="branch[]" value="{{ $list->id }}" id="flexCheckDefault" checked>
                                                            @else
                                                            <input class="form-check-input" type="checkbox" name="branch[]" value="{{ $list->id }}" id="flexCheckDefault">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @php $no++;@endphp
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

    @include('includes.modal.allowance-option-modal')

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
            $('#filter-branch').select2({
                width: '100%'
            })        
            $('#filter-employee').select2({
                width: '100%'
            })    
            $('#filter-branch').on('change',function(){
                var branch_id = $(this).val();
                $.ajax({
                    url : 'setup-access-branch',
                    type : 'post',
                    data : {branch_id : branch_id },
                    dataType : 'json',
                    success : function(respon){
                        var emp = '<option value="">-- Select --</option>';
                        $.each(respon, function(key,val){
                            emp += `<option value="`+val.id+`">`+val.name+`</option>`;
                        })
                        $('#filter-employee').html(emp)
                    }
                })
            })   
            $('#edit-form-access').on('submit',function(e){
                e.preventDefault();
                var data = $('#edit-form-access').serialize()
                $.ajax({
                    url : 'update-access-branch',
                    type : 'post',
                    data : data,
                    dataType : 'json',
                    success : function(respon){
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg,
                        }).then(function() {
                            window.location = "{{route('access-branch')}}";
                        });
                       
                       
                    }
                })
            }) 
        })
    </script>
@endpush
