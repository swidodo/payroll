@extends('pages.dashboard')

@section('title', 'PTKP')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">PTKP</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">PTKP</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row justify-content-center">
            <div class="mb-4">
                @can('create ptkp')
                    <a href="javascript:void(0);" class="btn btn-primary float-end" id="btnCreatePtkp"> Create PTKP</a>
                @endcan
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="tblPtkp">
                    <thead>
                        <th>PTKP</th>
                        <th>PTKP Code</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </thead>
                </table>
                <tbody>
                    
                </tbody>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
    @include('includes.modal.ptkp.edit-ptkp-modal')
    @include('includes.modal.ptkp.add-ptkp-modal')
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

    @if (Session::has('edit-show'))
    <script>
        $(window).on('load', function(){
            $('#edit_reimburst').modal('show')
        });
    </script>
    @endif

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
            });

            var table = $('#tblPtkp').DataTable({
                        processing: true,
                        serverSide: true,
                        destroy: true,
                        ajax : {
                                "url" : 'get-ptkp',
                                "type" : 'POST',
                            },
                        columns: [
                            {
                                data: 'name',
                                name: 'name'
                            },
                            {
                                data: 'code',
                                name: 'code'
                            },
                            {
                                data: 'value',
                                name: 'value'
                            },
                            {
                                data: 'action',
                                render : function(data, row,type){
                                    return '';
                                }
                                // name: 'action' //hidden sementara
                            },
                        ],
                    })
        $('#btnCreatePtkp').on('click',function(){
            $('#add_ptkp_modal').modal('show')
        })
        $('#add-form-ptkp').on('submit',function(e){
            e.preventDefault()
            var data = $('#add-form-ptkp').serialize();
            $.ajax({
                url : 'save-ptkp',
                type : 'post',
                data : data,
                dataType : 'json',
                beforeSend :function(){

                },
                success : function(respon){
                    if (respon.status == 'success'){
                        $('#add_ptkp_modal').modal('hide')
                        $('#add-form-ptkp')[0].reset();
                        table.ajax.reload();
                    }
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    })
                }
            })
        })
        $(document).on('click','.edit-ptkp',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                url : 'edit-ptkp',
                type : 'post',
                data : {id:id},
                dataType : 'json',
                beforeSend : function(){

                },
                success : function(respon){
                    $('#edit-id').val(respon.id);
                    $('#edit-name').val(respon.name);
                    $('#edit-code').val(respon.code);
                    $('#edit-amount').val(respon.value);
                    $('#edit_ptkp_modal').modal('show')
                },
                error : function(){
                    alert('terjadi kesalahan !');
                }
            })
        })
        $('#edit-form-ptkp').on('submit',function(e){
            e.preventDefault();
            var data = $('#edit-form-ptkp').serialize();
            $.ajax({
                url : 'update-ptkp',
                type : 'post',
                data : data,
                dataType : 'json',
                beforeSend : function(){

                },
                success : function(respon){
                    table.ajax.reload();
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    })
                    $('#edit_ptkp_modal').modal('hide')
                     table.ajax.reload();
                },
                error : function(){
                    alert('There is an error !, please try again')
                }
            })
        })
        });
    </script>
@endpush
