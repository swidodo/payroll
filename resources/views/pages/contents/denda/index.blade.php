@extends('pages.dashboard')

@section('title', 'Denda')

@section('dashboard-content')
@php
    function formatRupiah($angka){
	$hasil_rupiah = "IDR " . number_format($angka,2,',','.');
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
                    <h3 class="page-title">Denda</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Denda</li>
                    </ul>
                </div>
                @can('create allowance')
                    <div class="col-auto float-end ms-auto">
                        <a href="{{route('denda.create')}}" class="btn add-btn"><i class="fa fa-plus"></i> New</a>
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
                                <th>Type Day</th>
                                <th>Hour</th>
                                <th>Amount</th>
                                @if(Auth::user()->can('edit denda') || Auth::user()->can('delete denda'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dendas as $denda)
                                <tr>
                                    <td>
                                        {{$denda->day_type->name  ?? '-'}}
                                    </td>
                                    <td>
                                        {{date('H:i', strtotime($denda->time)) ?? '-'}}
                                    </td>
                                    <td>
                                        {{ formatRupiah(floor($denda->amount))   ?? '-' }}
                                    </td>
                                    @canany(['edit denda', 'delete denda'])
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    {{-- @can('edit denda')
                                                        <a  data-url="{{route('denda.edit', $denda->id)}}" id="edit-leave" class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_denda"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    @endcan --}}
                                                    @can('delete denda')
                                                        {{-- <a id="delete-leave" data-url="{{route('denda.destroy', $denda->id)}}" class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_denda"><i class="fa fa-trash-o m-r-5"></i> Delete</a> --}}

                                                        <form action="{{route('denda.destroy', $denda->id)}}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                                                        </form>
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

    {{-- @include('includes.modal.allowance-modal') --}}

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
            $('#edit_allowance').modal('show')
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
                        dropdownParent: $('#add_allowance')
                    });
                }

                if($('.select-allowance-type').length > 0) {
                    $('.select-allowance-type').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#add_allowance')
                    });
                }

                //edit
                if($('.select-employee-edit').length > 0) {
                    $('.select-employee-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_allowance')
                    });
                }

                if($('.select-allowance-type-edit').length > 0) {
                    $('.select-allowance-type-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_allowance')
                    });
                }

                    $('body').on('click', '#edit-leave', function () {
                        const editUrl = $(this).data('url');
                        // $('#edit-name-branch').val('')


                        $.get(editUrl, (data) => {
                            // let splitFile = data[2].attachment_reject.split('/')
                            // const lastItem = splitFile[splitFile.length - 1]
                            $('#start_date_edit').val(data[2].start_date)
                            $('#end_date_edit').val(data[2].end_date)
                            $('#leave_reason_edit').html(data[2].leave_reason)
                            $('#rejected_reason_edit').html(data[2].rejected_reason)
                            // $('#attachment_rejected_edit_anchor').attr('href', data[2].attachment_reject)
                            // $('#attachment_rejected_edit_anchor').html(lastItem)
                            
                            $('#employee_id_edit option[value='+ data[0].id +']').attr('selected','selected');
                            $('#employee_id_edit').val(data[0].id ? data[0].id : 0).trigger('change');

                            $('#leave_type_id_edit option[value='+ data[2].leave_type_id +']').attr('selected','selected');
                            $('#leave_type_id_edit').val(data[2].leave_type_id ? data[2].leave_type_id : 0).trigger('change');

                            $('#status_edit option[value='+ data[2].status +']').attr('selected','selected');
                            $('#status_edit').val(data[2].status ? data[2].status : 0).trigger('change');
                            
                            const urlNow = '{{ Request::url() }}'
                            $('#edit-form-leave').attr('action', urlNow + '/' + data[2].id);
                        })
                    });

                $('body').on('click', '#delete-leave', function(){
                    const deleteURL = $(this).data('url');
                    $('#form-delete-leave').attr('action', deleteURL);
                })
            });
    </script>
@endpush
