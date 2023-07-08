@extends('pages.dashboard')

@section('title', 'Performance Review')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Performance Review</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Performance Review</li>
                    </ul>
                </div>
                @can('create performance review')
                    <div class="col-auto float-end ms-auto">
                        <a href="{{route('performance-review.create')}}" class="btn add-btn"><i class="fa fa-plus"></i> New Performance</a>
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
                                <th>No</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Employee</th>
                                <th>Kpi Score</th>
                                <th>Notes</th>
                                @if(Auth::user()->can('edit performance review') || Auth::user()->can('delete performance review'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        @php
                            $no=1;
                        @endphp
                        <tbody>
                            @foreach ($performanceReviews as $review)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>
                                        {{$review->employee->company_doj}}
                                    </td>
                                    <td>
                                        {{$review->employee->company_doe}}
                                    </td>
                                    <td>
                                        {{$review->employee->name}}
                                    </td>
                                    <td>
                                        {{$review->kpi_total_score ?? '-'}}
                                    </td>
                                    <td>
                                        {{$review->notes?? '-'}}
                                    </td>
                                    @canany(['edit performance review', 'delete performance review'])
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('edit performance review')
                                                        <a  id="edit-performance-review" class="dropdown-item" href="{{route('performance-review.edit', $review->id)}}" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    @endcan

                                                    @can('delete performance review')
                                                        <form action="{{route('performance-review.destroy', $review->id)}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" id="delete-performance-review" class="dropdown-item" ><i class="fa fa-trash-o m-r-5"></i> Delete</button>
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

    {{-- @include('includes.modal.performance-review-modal') --}}

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
            $('#edit_user').modal('show')
        });
    </script>
    @endif

    <script>
            $(document).ready(function () {
                /* When click show user */


                    $('body').on('click', '#edit-payslip-type', function () {
                        const editUrl = $(this).data('url');
                        $('#edit-name-payslip-type').val('')


                        $.get(editUrl, (data) => {
                            $('#edit-name-payslip-type').val(data.name)

                            const urlNow = '{{ Request::url() }}'
                            $('#edit-form-payslip-type').attr('action', urlNow + '/' + data.id);
                        })
                    });

                $('body').on('click', '#delete-payslip-type', function(){
                    const deleteURL = $(this).data('url');
                    $('#form-delete-payslip-type').attr('action', deleteURL);
                })
            });
    </script>
@endpush
