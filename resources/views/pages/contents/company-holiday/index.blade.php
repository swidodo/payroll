@extends('pages.dashboard')

@section('title', 'Set Company Holiday')

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
                    <h3 class="page-title">Set Company Holiday</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Set Company Holiday</li>
                    </ul>
                </div>
                @can('create company holiday')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_company_holiday"><i class="fa fa-plus"></i> New Holiday</a>
                    </div>
                @endcan
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" style="overflow-x: visible">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            @php
                                $no=1;
                            @endphp
                            <tr>
                                <th>No</th>
                                <th>Company Holiday</th>
                                @if(Auth::user()->can('edit company holiday') || Auth::user()->can('delete company holiday'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($holidays as $holiday)
                                <tr>
                                    <td>
                                        {{$no++}}
                                    </td>
                                    <td>
                                        {{ isset($holiday->company_holiday_date) ? \Carbon\Carbon::parse($holiday->company_holiday_date)->format('l j F Y') : '-' }}
                                    </td>
                                    @canany(['edit company holiday', 'delete company holiday'])
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('edit company holiday')
                                                        <a  data-url="{{route('company-holiday.edit', $holiday->id)}}" id="edit-company-holiday" class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_reimburst"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    @endcan
                                                    @can('delete company holiday')
                                                        <a id="delete-company-holiday-btn" data-url="{{route('company-holiday.destroy', $holiday->id)}}" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_company_holiday"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

    @include('includes.modal.company-holiday-modal')

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
                        dropdownParent: $('#add_company_holiday')
                    });
                }

                if($('.select-company holiday-type').length > 0) {
                    $('.select-company holiday-type').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#add_company_holiday')
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

                if($('.select-company holiday-type-edit').length > 0) {
                    $('.select-company holiday-type-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_reimburst')
                    });
                }

                    $('body').on('click', '#edit-company-holiday', function () {
                        const editUrl = $(this).data('url');
                        // $('#edit-name-branch').val('')


                        $.get(editUrl, (data) => {
                            console.log(data);
                            $('#company_holiday_date_edit').val(data.company_holiday_date)

                            const urlNow = '{{ Request::url() }}'
                            $('#edit-form-company-holiday').attr('action', urlNow + '/' + data.id);
                        })
                    });

                $('body').on('click', '#delete-company-holiday-btn', function(){
                    const deleteURL = $(this).data('url');
                    $('#form-delete-company-holiday').attr('action', deleteURL);
                })
            });
    </script>
@endpush
