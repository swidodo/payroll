@extends('pages.dashboard')

@section('title', 'Shift Type')

@section('dashboard-content')
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Manage Shift Type</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Shift Type</li>
                    </ul>
                </div>
                @can('create shift type')
                    <div class="col-auto float-end ms-auto">
                        <a href="{{route('shift-type.create')}}" class="btn add-btn"><i class="fa fa-plus"></i> Shift Type</a>
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
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <select class="form-control" id="branch_id">
                                    @foreach ($lisBranch as $bch)
                                        <option value="{{ $bch->id }}" {{($bch->id == Auth::user()->branch_id ) ? 'selected' : ''}}>{{ $bch->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <button class="btn btn-primary" id="Search">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" style="overflow-x: visible">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>Shift Name</th>
                                <th>Time</th>
                                @if(Auth::user()->can('edit shift type') || Auth::user()->can('delete shift type'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shiftTypes as $type)
                                <tr>
                                    <td>
                                        {{$type->name}}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($type->start_time)->format('H:i').' - '.Carbon\Carbon::parse($type->end_time)->format('H:i')}}
                                    </td>
                                    @canany(['edit shift type', 'delete shift type'])
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('edit shift type')
                                                        <a  href="{{route('shift-type.edit', $type->id)}}" id="edit-shift-type" class="dropdown-item" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    @endcan
                                                    @can('delete shift type')
                                                        <form action="{{route('shift-type.destroy', $type->id)}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item"><i class="fa fa-trash-o m-r-5"> </i> Delete</button>
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

    {{-- @include('includes.modal.shift-type-modal') --}}

</div>
@endsection

@push('addon-style')
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">

       <!-- Jquery timepicker -->
    <link rel="stylesheet" href="{{asset('assets/css/jquery.timepicker.min.css')}}">


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

    <!-- timepicker JS -->
    {{-- <script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script> --}}

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

                 // add modal
                 if($('.select-day-type-edit').length > 0) {
                    $('.select-day-type-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#add_shift_type')
                    });
                }


                    $('body').on('click', '#edit-shift-type', function () {
                        const editUrl = $(this).data('url');
                        $('#edit-name-shift-type').val('')


                        $.get(editUrl, (data) => {
                            $('#edit-name-shift-type').val(data.name)

                            const urlNow = '{{ Request::url() }}'
                            $('#edit-form-shift-type').attr('action', urlNow + '/' + data.id);
                        })
                    });

                $('body').on('click', '#delete-shift-type', function(){
                    const deleteURL = $(this).data('url');
                    $('#form-delete-shift-type').attr('action', deleteURL);
                })
            });
    </script>
@endpush
