@extends('pages.dashboard')

@section('title', 'On Duty')

@section('dashboard-content')
    <div class="page-wrapper">

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">List On Duty</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">List On Duty</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#modal_export">
                            Report</a>
                    </div>
                    @can('create on duty')
                        <div class="col-auto float-end ms-auto">
                            <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_travel"><i
                                    class="fa fa-plus"></i> New Request</a>
                        </div>
                    @endcan
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive" style="overflow-x: visible">
                        <table class="table table-striped custom-table" id="table-travel">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Purpose of Trip</th>
                                    <th>Country</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    @if (Auth::user()->can('edit on duty') || Auth::user()->can('delete on duty'))
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

        @include('includes.modal.travel-modal')

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

    @if (Session::has('edit-show'))
        <script>
            $(window).on('load', function() {
                $('#edit_travel').modal('show')
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            // Datatable
            $('#table-travel').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: 'travels',
                },
                columns: [{
                        data: 'employee_name',
                        name: 'employee_name'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'purpose_of_visit',
                        name: 'purpose_of_visit'
                    },
                    {
                        data: 'place_of_visit',
                        name: 'place_of_visit'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    @if (Auth::user()->can('edit on duty') || Auth::user()->can('delete on duty'))
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                        }
                    @endif
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
                    dropdownParent: $('#add_travel')
                });
            }

            if ($('.select-employee-edit').length > 0) {
                $('.select-employee-edit').select2({
                    width: '100%',
                    tags: true,
                    dropdownParent: $('#edit_travel')
                });
            }

            $('body').on('click', '#edit-travel', function() {
                const editUrl = $(this).data('url');
                $('.wrapper-approver').empty()


                $.get(editUrl, (data) => {
                    // 3 tier approval
                    if (data.level_approve != null) {
                        $('#level_approve').attr('value', data.level_approve)
                        $('#form-status').show()
                    }
                    if (data.leaveApprovals.length > 0) {
                        $.each(data.leaveApprovals, function(indexInArray, valueOfElement) {
                            if (valueOfElement !== null) {
                                $('.wrapper-approver').append(
                                    `<input disabled style="margin-bottom: 3px" class="form-control"  type="text" value="${valueOfElement.approver}">`
                                )
                                $('#approver').show()
                            }
                        });
                    }
                    // 3 tier approval

                    $('#start_date_edit').val(data[0].start_date)
                    $('#end_date_edit').val(data[0].end_date)
                    $('#purpose_of_visit_edit').val(data[0].purpose_of_visit)
                    $('#place_of_visit_edit').val(data[0].place_of_visit)
                    $('#description_edit').html(data[0].description)

                    $('#employee_id_edit option[value=' + data[0].employee_id + ']').attr(
                        'selected', 'selected');
                    $('#employee_id_edit').val(data[0].employee_id ? data[0].employee_id : 0)
                        .trigger('change');

                    $('#status_edit option[value=' + data[0].status + ']').attr('selected',
                        'selected');
                    $('#status_edit').val(data[0].status ? data[0].status : 0).trigger('change');

                    const urlNow = '{{ Request::url() }}'
                    $('#edit-form-travel').attr('action', urlNow + '/' + data[0].id);
                })
            });

            $('body').on('click', '#delete-travel', function() {
                const deleteURL = $(this).data('url');
                $('#form-delete-travel').attr('action', deleteURL);
            })
        });
    </script>
@endpush
