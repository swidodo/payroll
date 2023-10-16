@extends('pages.dashboard')

@section('title', 'Loan')

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
                    <h3 class="page-title">Installment</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">installment</li>
                    </ul>
                </div>
                @can('create loan')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_loan"><i class="fa fa-plus"></i> New Installment</a>
                    </div>
                @endcan
            </div>
        </div>
        <!-- /Page Header -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <h4>Filter Data</h4>
                    <hr />
                    <div class="col-md-4">
                        <label for="attendance" class="form-label">Branch</label>
                        <select class="form-control form-control-sm select" id="branch-filter" name="branch">
                            @foreach ($branch as $branchs)
                           
                                <option value="{{$branchs->id}}" {{($branchs->id == Auth::user()->branch_id) ? 'selected':''}}> @php print_r($bbranchs); @endphp{{$branchs->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="attendance" class="form-label">Status</label>
                        <select class="form-control form-control-sm select" id="status-filter" name="status-filter">
                            <option value="ongoing">Ongoing</option>
                            <option value="paid off">Paid off</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-center">
                    <button type="button" class="btn btn-primary mt-4" id="searchData"> Search </button>
                    </div>
                </div>
            </div>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session::get('success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="tbLoan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee ID</th>
                                <th>Employee</th>
                                <th>Installment Name</th>
                                <th>Nominal</th>
                                <th>Installment</th>
                                <th>Current<br />Installment</th>
                                <th>Tenor</th>
                                <th>Status</th>
                                @if(Auth::user()->can('edit loan') || Auth::user()->can('delete loan'))
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

    @include('includes.modal.loan-modal-installment')

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
            $('#edit_loan').modal('show')
        });
    </script>
    @endif

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
            });
            var branch = $('#branch-filter').val();
            var status = $('#status-filter').val();
            loadData(branch,status)
            /* When click show user */

            $('select#status_edit').change(function(){
                let selectedItem = $(this).children('option:selected').val()

                if (selectedItem == 'Rejected') {
                    $('#rejected-reason').show()
                }else{
                    $('#rejected-reason').hide()
                }
            })

            if($('.select-employee').length > 0) {
                $('.select-employee').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#add_loan')
                });
            }

            if($('.select-cash-type').length > 0) {
                $('.select-cash-type').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#add_loan')
                });
            }

            //edit
            if($('.select-employee-edit').length > 0) {
                $('.select-employee-edit').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#edit_loan')
                });
            }

            if($('.select-cash-type-edit').length > 0) {
                $('.select-cash-type-edit').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#edit_loan')
                });
            }

            $('body').on('click', '#edit-loan', function () {
                const editUrl = $(this).data('url');
                // $('#edit-name-branch').val('')


                $.get(editUrl, (data) => {
                    $('#amount-edit').val(data.amount)
                    $('#editId').val(data.id)
                    $('#branch_id').val(data.branch_id)
                    $('#tenor-edit').val(data.tenor)
                    $('#installment-edit').val(data.installment)

                    $('#employee_id_edit option[value='+ data.employee_id +']').attr('selected','selected');
                    $('#employee_id_edit').html('<option value="'+data.employee.id+'">'+data.employee.name+'</option>');

                    $('#loan_type_id_edit option[value='+ data.loan_type_id +']').attr('selected','selected');
                    $('#loan_type_id_edit').val(data.loan_type_id ? data.loan_type_id : 0).trigger('change');

                    const urlNow = '{{ Request::url() }}'
                    $('#edit-form-loan').attr('action', urlNow + '/' + data.id);
                })
            });

            $('body').on('click', '#delete-loan', function(){
                const deleteURL = $(this).data('url');
                $('#form-delete-loan').attr('action', deleteURL);
            })
        });
        function loadData(branch,status){
            $('#tbLoan').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax : {
                        "url" : 'get-list-installment',
                        "type" : 'post',
                        "data" : {branch_id : branch, status : status},
                    },
                columns: [
                        { data: 'no', name:'id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {
                            data: 'employee.no_employee',
                            name: 'employee.no_employee'
                        },
                        {
                            data: 'employee.name',
                            name: 'employee.name'
                        },
                        {
                            data: 'loan_type.name',
                            name: 'loan_type.name'
                        },
                        {
                            data: 'amount',
                            render : function(data, type, row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'installment',
                            render : function(data, type, row){
                                return data.toLocaleString('en-US');
                            }
                        },
                        {
                            data: 'number_of_installment',
                            name: 'number_of_installment'
                        },
                        {
                            data: 'tenor',
                            name: 'tenor'
                        },
                        {
                            data: 'status',
                            render : function(data,type,row){
                                 var bg ='';
                                if (data === "ongoing"){
                                    bg = "badge-warning";
                                }else if (data === "paid off"){
                                    bg = "badge-success";
                                }else{
                                    bg = "badge-danger";
                                }
                                return btn = '<span class="badge '+bg +'">'+data+'</span>';
                            }
                            // name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ],
            })
        }
        $('#searchData').on('click', function(){
            var branch = $('#branch-filter').val();
            var status = $('#status-filter').val()
            loadData(branch,status)
        })
        $('#edit-form-loan').on('submit', function(e){
            e.preventDefault()
            var branch = $('#branch-filter').val();;
            var status = $('#status-filter').val();;
            var data = $('#edit-form-loan').serialize();
            $.ajax({
                url : 'update-loan-installment',
                type : 'post',
                data : data,
                dataType : 'json',
                beforeSend : function(){

                },
                success : function(respon){
                    loadData(branch,status)
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    })
                    $('#edit_loan').modal('hide')
                },
                error : function(){
                    alert('There is an error !, please try again')
                }
            })
        })
        $(document).on('click','.delete-installment',function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            var branch = $('#branch-filter').val();;
            var status = $('#status-filter').val();;
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function(confirm){
                    if(confirm.value == true ){
                        $.ajax({
                            url : 'delete-installment',
                            type : 'post',
                            data : {id:id},
                            dataType : 'json',
                            beforeSend : function(){

                            },
                            success : function(respon){
                                swal.fire({
                                    icon : respon.status,
                                    text : respon.msg,
                                })
                                loadData(branch,status)
                            },
                            error : function(){
                                alert('There is an error !, please try again')
                            }
                        })
                    }
                })

        })
    </script>
@endpush
