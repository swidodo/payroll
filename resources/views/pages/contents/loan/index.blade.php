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
                    <h3 class="page-title">Loan</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Loan</li>
                    </ul>
                </div>
                @can('create loan')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_loan"><i class="fa fa-plus"></i> New Loan</a>
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
                                <th>Installment</th>
                                <th>Current Installment</th>
                                <th>Amount</th>
                                <th>Status</th>
                                @if(Auth::user()->can('edit loan') || Auth::user()->can('delete loan'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                                <tr>
                                    <td>
                                        {{$loan->employee->name  ?? '-'}}
                                    </td>
                                    <td>
                                        {{$loan->loan_type->name ?? '-'}}
                                    </td>
                                    <td>
                                        {{$loan->installment.'x' ?? '-'}}
                                    </td>
                                    <td>
                                        {{$loan->number_of_installment ?? '-'}}
                                    </td>
                                    <td>
                                        {{formatRupiah($loan->amount)  ?? '-' }}
                                    </td>
                                    <td>
                                        @if($loan->status=="ongoing")
                                            <div class="status_badge badge bg-warning p-2 px-3 rounded">{{ ucwords($loan->status) ?? '-'}}</div>
                                        @elseif($loan->status=="paid off")
                                            <div class="status_badge badge bg-success p-2 px-3 rounded">{{ ucwords($loan->status) ?? '-'}}</div>
                                        @endif
                                    </td>
                                    @canany(['edit loan', 'delete loan'])
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('edit loan')
                                                        <a  data-url="{{route('loans.edit', $loan->id)}}" id="edit-loan" class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_loan"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    @endcan
                                                    @can('delete loan')
                                                        <a id="delete-loan" data-url="{{route('loans.destroy', $loan->id)}}" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_loan"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

    @include('includes.modal.loan-modal')

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
            $('#edit_loan').modal('show')
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
                            console.log(data);
                            $('#amount-edit').val(data.amount)
                            $('#installment-edit').val(data.installment)
                            
                            $('#employee_id_edit option[value='+ data.employee_id +']').attr('selected','selected');
                            $('#employee_id_edit').val(data.employee_id ? data.employee_id : 0).trigger('change');

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
    </script>
@endpush
