@extends('pages.dashboard')

@section('title', 'Set Dayoff')

@section('dashboard-content')
    @php
        function formatRupiah($angka)
        {
            $hasil_rupiah = 'IDR ' . number_format($angka, 0, ',', '.');
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
                        <h3 class="page-title">Set Dayoff</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Set Dayoff</li>
                        </ul>
                    </div>
                    @can('create dayoff')
                        <div class="col-auto float-end ms-auto">
                            <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_dayoff"><i
                                    class="fa fa-plus"></i> New Dayoff</a>
                        </div>
                    @endcan
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive" style="overflow-x: visible">
                        <table class="table table-striped custom-table display" id="table-dayoff">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Company Dayoff</th>
                                    <th>Date</th>
                                    @if (Auth::user()->can('delete dayoff'))
                                        <th>Action</th>
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

        @include('includes.modal.dayoff-modal')

    </div>
@endsection

@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
@endpush

@push('addon-script')
    <!-- Slimscroll JS -->
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

    <!-- Select2 JS -->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Datatable JS -->
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script> --}}


    @if (Session::has('edit-show'))
        <script>
            $(window).on('load', function() {
                $('#edit_reimburst').modal('show')
            });
        </script>
    @endif

    <script type="text/javascript">
        /* Datatables */
        $(document).ready(function() {
            $('#table-dayoff').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: 'dayoff',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'company_dayoff',
                        name: 'company_dayoff',
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    @can('delete dayoff')
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                        }
                    @endcan
                ],
            });

            /* When click show user */
            $('select#status_edit').change(function() {
                let selectedItem = $(this).children('option:selected').val()

                if (selectedItem == 'Rejected') {
                    $('#rejected-reason').show()
                } else {
                    $('#rejected-reason').hide()
                }
            })

            if ($('.select-employee').length > 0) {
                $('.select-employee').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#add_dayoff')
                });
            }

            if ($('.select-dayoff-type').length > 0) {
                $('.select-dayoff-type').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#add_dayoff')
                });
            }

            //edit
            if ($('.select-employee-edit').length > 0) {
                $('.select-employee-edit').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#edit_reimburst')
                });
            }

            if ($('.select-dayoff-type-edit').length > 0) {
                $('.select-dayoff-type-edit').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#edit_reimburst')
                });
            }

            //  $('body').on('click', '#edit-dayoff', function() {
            //      const editUrl = $(this).data('url');
            //      // $('#edit-name-branch').val('')


            //      $.get(editUrl, (data) => {
            //          console.log(data);
            //          $('#dayoff_edit option[value=' + data.day + ']').attr('selected', 'selected');
            //          $('#dayoff_edit').val(data.day ? data.day : 0).trigger('change');

            //          const urlNow = '{{ Request::url() }}'
            //          $('#edit-form-dayoff').attr('action', urlNow + '/' + data.id);
            //      })
            //  });

            $('body').on('click', '#delete-dayoff-btn', function() {
                const deleteURL = $(this).data('url');
                $('#form-delete-dayoff').attr('action', deleteURL);
            })
        });
    </script>
@endpush
