@extends('pages.dashboard')

@section('title', 'Reimburst')

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
                    <h3 class="page-title">Reimburst</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Reimburst</li>
                    </ul>
                </div>
                @can('create reimburst')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" id="addRreimburst"><i class="fa fa-plus"></i> New Reimburst</a>
                    </div>
                @endcan
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
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-3">
                            <label>Branch</label>
                            <select class="form-select form-control" id="branch_id">
                                @foreach($branch as $br)
                                <option value="{{ $br->id }} ">{{ $br->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-center mt-4"> 
                            <button type="button" class="btn btn-primary" id="searchBranch">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="tblReimburse">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Type</th>
                                <th>Amount</th>
                                @if(Auth::user()->can('edit reimburst') || Auth::user()->can('delete reimburst'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @include('includes.modal.reimburst-modal')

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
         $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        $(document).ready(function () {
            /* When click show user */
             var branchId = $('#branch_id').val();
             loadData(branchId)
            $('#searchBranch').on('click',function(e){
                var branchId = $('#branch_id').val();
                loadData(branchId)
            })
             function loadData(branchId){
                $('#tblReimburse').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax : {
                            url : 'get-data-reimburse',
                            type : 'post',
                            data : {branch_id : branchId},
                        },
                    columns: [
                        { data: 'no', name:'id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {
                            data: 'no_employee',
                            name: 'no_employee'
                        },
                        {
                            data: 'employee_name',
                            name: 'employee_name'
                        },
                        {
                            data: 'type',
                            name: 'type'
                        },
                        {
                            data: 'amount',
                            render : function(data,type,row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ],
                })
             }

            if($('.select-employee').length > 0) {
                $('.select-employee').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#add_reimburst')
                });
            }

            if($('.select-reimburst-type').length > 0) {
                $('.select-reimburst-type').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#add_reimburst')
                });
            }
            $('#addRreimburst').on('click', function(e){
                e.preventDefault()
                var branch =  $('#branch_id').val();
                $.ajax({
                    url : 'add-data-reimburse',
                    type :'post',
                    data : { branch_id : branch},
                    dataType :'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        $('#add_reimburst').modal('show')
                        var html =`<option value="">-- select employee --</option>`;
                        $.each(respon.employee,function(key,val){
                            html +=`<option value="`+val.id+`">`+val.name+`</option>`
                        })
                        var type =`<option value="">-- select employee --</option>`;
                        $.each(respon.reimburseType,function(key,val){
                            type +=`<option value="`+val.id+`">`+val.name+`</option>`
                        })
                        $('#employee_id').html(html)
                        $('#reimburst_type_id').html(type)
                        $('#branchInput').html(`<option value="`+branch+`">`+$('#branch_id option:selected').text()+`</option>`)
                       
                    },
                    error : function(){
                        Alert('Someting went wrong!')
                    }
                })
            })
            $('#formAddReimurse').on('submit',function(e){
                e.preventDefault()
                var branchId = $('#branch_id').val();
                var data = $('#formAddReimurse').serialize()
                 $.ajax({
                    url : 'store-reimbursment',
                    type : 'post',
                    data : data,
                    dataType :'json',
                    beforeSend : function(){

                    },
                     success : function(respon){
                        if(respon.status == 'success'){
                            $('#formAddReimurse')[0].reset();
                            $('#add_reimburst').modal('hide')
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        })

                    loadData(branchId)
                    },
                    error :function(){
                        Alert('Sameting went wrong!')
                    }
                })
            })
            //edit
            if($('.select-reimburst-type-edit').length > 0) {
                $('.select-reimburst-type-edit').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#edit_reimburst')
                });
            }
            $(document).on('click','.edit-reimburse',function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');
                $.ajax({
                    url : 'edit-data-reimburse',
                    type : 'post',
                    data : {id : id},
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        $('#edit_reimburst').modal('show')
                        var type = '';
                        $.each(respon.reimburseType,function(key,val){
                            if (respon.reimburse.reimburst_type_id == val.id){
                                type +=`<option value="`+val.id+`" selected>`+val.name+`</option>`
                            }else{
                                type +=`<option value="`+val.id+`">`+val.name+`</option>`
                            }
                        })
                        $('#editreimburst_type_id').html(type)
                        $('#editemployee_id').html(`<option value="`+respon.reimburse.employee_id+`">`+respon.reimburse.employee_name+`</option>`)
                        $('#edit_amount').val(respon.reimburse.amount)
                         $('#id').val(respon.reimburse.id)

                    },
                    error : function(){
                        alert('Sameting went wrong!')
                    }
                })
            })
            $('#updateReimburse').on('submit', function(e){
                e.preventDefault()
                 var branchId = $('#branch_id').val();
                var data = $('#updateReimburse').serialize();
                $.ajax({
                    url : 'update-reimbursment',
                    type : 'post',
                    data : data,
                    dataType :'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        if(respon.status == 'success'){
                            $('#updateReimburse')[0].reset();
                            $('#edit_reimburst').modal('hide')
                        }
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg
                        })
                        loadData(branchId)
                    },
                    error :function(){
                        Alert('Sameting went wrong!')
                    }
                })
            })
            $(document).on('click','.delete-reimburse',function(e){
                e.preventDefault()
                var branchId = $('#branch_id').val();
                var id = $(this).attr('data-id')
                Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then(function(confirm){
                        if (confirm.value == true){
                            $.ajax({
                                url : 'destroy-reimburse',
                                type :'post',
                                data : {id : id},
                                dataType : 'json',
                                beforeSend : function (){

                                },
                                success : function(respon){
                                    swal.fire({
                                        icon : respon.status,
                                        text : respon.msg
                                    })
                                    loadData(branchId)
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
