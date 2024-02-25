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
                    <h3 class="page-title">Setup Template</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">template</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="{{ route('access-template')}}" class="btn add-btn">Back</a>
                </div>
            </div>
        </div>
        <div class="row">
            <form id="formTemplate">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-3">
                                    <label>Company</label>
                                    <select class="form-select form-control" id="company_id" name="company_id" required>
                                        <option value=""> --pilih-- </option>
                                        @foreach ($company as $comp)
                                            <option value="{{$comp->id}}">{{$comp->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Branch</label>
                                    <select class="form-select form-control" id="branch_id" name="branch_id" required>
                                    
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-center mt-4"> 
                                    <button type="submit" class="btn btn-primary" id="save">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped custom-table w-100 datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Template</th>
                                    <th class="text-center">Access</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i=1;$i<=50;$i++)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>Template Versi {{$i}}</td>
                                        <td class="text-center"><input class="form-check-input template-input" type="radio" name="template" value="V{{$i}}" id="flexCheckDefault"></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
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
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>


    <!-- Datatable JS -->
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
            });
            
            $('#company_id').on('change',function(){
                var comp_id = $(this).val();
                $.ajax({
                    url : 'get-branch-company',
                    type : 'post',
                    data : {company_id : comp_id },
                    dataType : 'json',
                    success : function(respon){
                        html = '<option value="all">All</option>';
                        $.each(respon, function(key,val){
                            html +=`<option value="`+val.id+`">`+val.name+`</option>`
                        })
                        $('#branch_id').html(html)
                    }
                })
            })
            $('#formTemplate').on('submit',function(e){
                e.preventDefault()
                var data = $('#formTemplate').serialize();
                $.ajax({
                    url : 'store-template',
                    type : 'post',
                    data : data,
                    dataType : 'json',
                    success : function(respon){
                        if (respon.status == "info"){
                            swal.fire({
                                icon : respon.status,
                                text : respon.msg
                            })
                        }else{
                            swal.fire({
                                icon : respon.status,
                                text : respon.msg
                            })
                        }
                    }
                })
           })
        })
      
    </script>
@endpush
