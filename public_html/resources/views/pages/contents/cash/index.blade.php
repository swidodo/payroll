@extends('pages.dashboard')

@section('title', 'Cash')

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
                    <h3 class="page-title">Cash Advance</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Cash Advance</li>
                    </ul>
                </div>
                @can('create cash advance')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_cash"><i class="fa fa-plus"></i> New Cash</a>
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
                                @if(Auth::user()->can('edit cash advance') || Auth::user()->can('delete cash advance'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cash as $cashes)
                                <tr>
                                    <td>
                                        {{$cashes->employee->name  ?? '-'}}
                                    </td>
                                    <td>
                                        {{$cashes->loan_type->name ?? '-'}}
                                    </td>
                                    <td>
                                        {{$cashes->installment.'x' ?? '-'}}
                                    </td>
                                    <td>
                                        {{$cashes->number_of_installment ?? '-'}}
                                    </td>
                                    <td>
                                        {{formatRupiah($cashes->amount)  ?? '-' }}
                                    </td>
                                    <td>
                                        @if($cashes->status=="ongoing")
                                            <div class="status_badge badge bg-warning p-2 px-3 rounded">{{ ucwords($cashes->status) ?? '-'}}</div>
                                        @elseif($cashes->status=="paid off")
                                            <div class="status_badge badge bg-success p-2 px-3 rounded">{{ ucwords($cashes->status) ?? '-'}}</div>
                                        @endif
                                    </td>
                                    @canany(['edit cash advance', 'delete cash advance'])
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('edit cash advance')
                                                        <a  data-url="{{route('cash.edit', $cashes->id)}}" id="edit-cash" class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_cash"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    @endcan
                                                    @can('delete cash advance')
                                                        <a id="delete-cash" data-url="{{route('cash.destroy', $cashes->id)}}" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_cash"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

    @include('includes.modal.cash-modal')

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
            $('#edit_cash').modal('show')
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
                        dropdownParent: $('#add_cash')
                    });
                }

                if($('.select-cash-type').length > 0) {
                    $('.select-cash-type').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#add_cash')
                    });
                }

                //edit
                if($('.select-employee-edit').length > 0) {
                    $('.select-employee-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_cash')
                    });
                }

                if($('.select-cash-type-edit').length > 0) {
                    $('.select-cash-type-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_cash')
                    });
                }

                    $('body').on('click', '#edit-cash', function () {
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
                            $('#edit-form-cash').attr('action', urlNow + '/' + data.id);
                        })
                    });

                $('body').on('click', '#delete-cash', function(){
                    const deleteURL = $(this).data('url');
                    $('#form-delete-cash').attr('action', deleteURL);
                })
            });
    </script>
@endpush
