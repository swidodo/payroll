@extends('pages.dashboard')

@section('title', 'deduction admin')

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
                    <h3 class="page-title">Deduction Fixed</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Deduction fixed</li>
                    </ul>
                </div>
                @can('create deduction admin')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" id="add-deductionadmin"><i class="fa fa-plus"></i> Deduction</a>
                    </div>
                @endcan
            </div>
        </div>
        <!-- /Page Header -->
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
                    <table class="table table-striped custom-table" id="tblDeductionadmin">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Branch</th>
                                <th>Deduction Name</th>
                                <th>Amount</th>
                                <th class="text-end">Action</th>
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
    @include('includes.modal.deduction_admin.add_deduction_admin')
    @include('includes.modal.deduction_admin.edit_deduction_admin')
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
        $('.select-employee').select2({
            dropdownParent: $("#add_modal_deduction_admin"),
        })
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        var branchId = $('#branch_id').val();
        loadData(branchId)
        function loadData(branchId){
            $('#tblDeductionadmin').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                        "url" : 'get-deduction-admin',
                        "type" : 'POST',
                        "data" : {branch_id : branchId},
                    },
                columns: [
                    { data: 'no', name:'id', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {
                        data: 'branch_name',
                        name: 'branch_name'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'amount',
                        render : function(data, type, row){
                            if (data !=null) {
                                    var base = new String(data).substring(data.lastIndexOf('/') + 1);
                                        if(base.lastIndexOf(".") != -1)
                                            base = base.substring(0, base.lastIndexOf("."));
                                        return base.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    }else{
                                        return 0;
                                    }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
            })
        }
        $('#add-deductionadmin').click(function(e){
            // $('#branchIdAdd').val($('#branch_id').val())
            $('#branchIdAdd').html(`<option value="`+$('#branch_id').val()+`">`+$('#branch_id option:selected').text()+`</option>`)
            $('#add_modal_deduction_admin').modal('show')
        })
        $('#form-deductionadmin').on('submit',function(e){
            e.preventDefault();
            var branchId = $('#branch_id').val();
            var data = $('#form-deductionadmin').serialize();
            $.ajax({
                url : 'store-deduction-admin',
                type : 'post',
                data : data,
                dataType : 'json',
                beforeSend : function(){
                    $('.containerLoader').attr('hidden',false)
                },
                success : function(respon){
                    $('.containerLoader').attr('hidden',true)
                    if(respon.status =="success"){
                        $('#add_modal_deduction_admin').modal('hide')
                        $('#form-deductionadmin')[0].reset();
                        loadData(branchId)
                    }
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    })
                    
                },
                error : function(e){
                    alert('There is an error !, please try again')
                    $('.containerLoader').attr('hidden',true)
                }
            })
        })
        $(document).on('click','.edit-deduction_admin',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                url : 'edit-deduction-admin',
                type : 'post',
                data : {id:id},
                dataType : 'json',
                beforeSend : function(){
                    $('.containerLoader').attr('hidden',false)
                },
                success : function(respon){
                    $('.containerLoader').attr('hidden',true)
                    var html ='';
                    $('#id').val(respon.id);
                    $('#branch_id_edit').html(`<option value="`+ respon.branch_id +`">`+respon.branch_name+`</option>`)
                    $('#name_edit').val(respon.name);
                    $('#amount_edit').val(respon.amount);
                    $('#edit_modal_deduction_admin').modal('show')
                },
                error : function(){
                    alert('Sameting went wrong! !');
                    $('.containerLoader').attr('hidden',true)
                }
            })
        })
        $('#form-editdeductionadmin').on('submit',function(e){
            e.preventDefault();
            var branchId = $('#branch_id').val();
            var data = $('#form-editdeductionadmin').serialize();
            $.ajax({
                url : 'update-deduction-admin',
                type : 'post',
                data : data,
                dataType : 'json',
                beforeSend : function(){
                    $('.containerLoader').attr('hidden',false)
                },
                success : function(respon){
                    $('.containerLoader').attr('hidden',true)
                    if (respon.status == "success"){
                        loadData(branchId)
                        $('#edit_modal_deduction_admin').modal('hide')
                        $('#form-editdeductionadmin')[0].reset();
                    }
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    })
                },
                error : function(){
                    alert('Someting went wrong !')
                    $('.containerLoader').attr('hidden',true)
                }
            })
        })
        $(document).on('click','.delete-data-deduction_admin',function(e){
            e.preventDefault();
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
                    url : 'delete-deduction-admin',
                    type : 'post',
                    data : {id : id},
                    dataType : 'json',
                    beforeSend : function(){
                        $('.containerLoader').attr('hidden',false)
                    },
                    success : function(respon){
                        $('.containerLoader').attr('hidden',true)
                        loadData(branchId)
                        swal.fire({
                            icon : respon.status,
                            text : respon.msg,
                        })
                    },
                    error : function (){
                        alert('Someting went wrong !')
                        $('.containerLoader').attr('hidden',true)
                    }
                })
            }
        })
            
        })
        $('#searchBranch').on('click',function(e){
                var branchId = $('#branch_id').val();
                loadData(branchId ,employeeId="");
            })

    </script>
@endpush
