@extends('pages.dashboard')

@section('title', 'Payroll')

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
                    <h3 class="page-title">Payroll</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Payroll</li>
                    </ul>
                </div>
                @can('create payroll')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_payroll"><i class="fa fa-plus"></i> New Payroll</a>
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
            <div class="col-md-12">
                <div class="table-responsive" style="overflow-x: visible">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>Type</th>
                                <th>Amount</th>
                                @if(Auth::user()->can('edit payroll') || Auth::user()->can('delete payroll'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payroll as $payrolls)
                                <tr>
                                    <td>
                                        {{$payrolls->employee->name  ?? '-'}}
                                    </td>
                                    <td>
                                        {{ isset($payrolls->payslip_type) ? $payrolls->payslip_type->name.' ('.ucwords($payrolls->payslip_type->type).')' : '-'}}
                                    </td>
                                    <td>
                                        {{formatRupiah($payrolls->amount) ?? '-' }}
                                    </td>
                                    @canany(['edit payroll', 'delete payroll'])
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('edit payroll')
                                                        <a  data-url="{{route('payroll.edit', $payrolls->id)}}" id="edit-payroll" class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_payroll"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    @endcan
                                                    @can('delete payroll')
                                                        <a id="delete-payroll-btn" data-url="{{route('payroll.destroy', $payrolls->id)}}" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_payroll"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    @endcan

                                                </div>
                                            </div>
                                        </td>
                                    @endcanany
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    @include('includes.modal.payroll-modal')

</div>
@endsection

@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
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

    @if (Session::has('edit-show'))
    <script>
        $(window).on('load', function(){
            $('#edit_reimburst').modal('show')
        });
    </script>
    @endif

    <script>
            $(document).ready(function () {
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
                        dropdownParent: $('#add_payroll')
                    });
                }

                if($('.select-payroll-type').length > 0) {
                    $('.select-payroll-type').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#add_payroll')
                    });
                }

                //edit
                if($('.select-employee-edit').length > 0) {
                    $('.select-employee-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_reimburst')
                    });
                }

                if($('.select-payroll-type-edit').length > 0) {
                    $('.select-payroll-type-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_reimburst')
                    });
                }

                    $('body').on('click', '#edit-payroll', function () {
                        const editUrl = $(this).data('url');

                        $.get(editUrl, (data) => {
                            $('#amount_edit').val(data.amount)
                            
                            $('#employee_id_edit option[value='+ data.employee_id +']').attr('selected','selected');
                            $('#employee_id_edit').val(data.employee_id ? data.employee_id : 0).trigger('change');

                            $('#payslip_type_id_edit option[value='+ data.payslip_type_id +']').attr('selected','selected');
                            $('#payslip_type_id_edit').val(data.payslip_type_id ? data.payslip_type_id : 0).trigger('change');

                            const urlNow = '{{ Request::url() }}'
                            $('#edit-form-payroll').attr('action', urlNow + '/' + data.id);
                        })
                    });

                $('body').on('click', '#delete-payroll-btn', function(){
                    const deleteURL = $(this).data('url');
                    $('#form-delete-payroll').attr('action', deleteURL);
                })
            });
    </script>
@endpush
