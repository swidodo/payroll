@extends('pages.dashboard')

@section('title', 'project')

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
                    <h3 class="page-title">Projects</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Projects</li>
                    </ul>
                </div>
                @can('create project')
                    <div class="col-auto float-end ms-auto">
                        <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_project"><i class="fa fa-plus"></i> Create Project</a>
                    </div>
                @endcan
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Team</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                @if(Auth::user()->can('edit project') || Auth::user()->can('delete project'))
                                    <th class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>
                                        {{ $project->project_name }}
                                    </td>
                                    <td>
                                        <ul class="team-members text-nowrap">
                                            @if (count($project->user_in_project) < 4)
                                                @foreach ($project->user_in_project as $user)
                                                    <li>
                                                        <a href="#" title="{{$user->user->name}}" data-bs-toggle="tooltip">
                                                            <img alt="" src="https://ui-avatars.com/api/?name={{$user->user->name}}">
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @else
                                                {{-- <li class="dropdown avatar-dropdown"> --}}
                                                    <a href="#" class="all-users dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">{{count($project->user_in_project)}}</a>
                                                    {{-- <div class="dropdown-menu dropdown-menu-right">
                                                        <div class="avatar-group">
                                                            <a class="avatar avatar-xs" href="#">
                                                                <img alt="" src="assets/img/profiles/avatar-02.jpg">
                                                            </a>
                                                            <a class="avatar avatar-xs" href="#">
                                                                <img alt="" src="assets/img/profiles/avatar-09.jpg">
                                                            </a>
                                                            <a class="avatar avatar-xs" href="#">
                                                                <img alt="" src="assets/img/profiles/avatar-10.jpg">
                                                            </a>
                                                            <a class="avatar avatar-xs" href="#">
                                                                <img alt="" src="assets/img/profiles/avatar-05.jpg">
                                                            </a>
                                                            <a class="avatar avatar-xs" href="#">
                                                                <img alt="" src="assets/img/profiles/avatar-11.jpg">
                                                            </a>
                                                            <a class="avatar avatar-xs" href="#">
                                                                <img alt="" src="assets/img/profiles/avatar-12.jpg">
                                                            </a>
                                                            <a class="avatar avatar-xs" href="#">
                                                                <img alt="" src="assets/img/profiles/avatar-13.jpg">
                                                            </a>
                                                            <a class="avatar avatar-xs" href="#">
                                                                <img alt="" src="assets/img/profiles/avatar-01.jpg">
                                                            </a>
                                                            <a class="avatar avatar-xs" href="#">
                                                                <img alt="" src="assets/img/profiles/avatar-16.jpg">
                                                            </a>
                                                        </div>
                                                        <div class="avatar-pagination">
                                                            <ul class="pagination">
                                                                <li class="page-item">
                                                                    <a class="page-link" href="#" aria-label="Previous">
                                                                        <span aria-hidden="true">«</span>
                                                                        <span class="visually-hidden">Previous</span>
                                                                    </a>
                                                                </li>
                                                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                <li class="page-item">
                                                                    <a class="page-link" href="#" aria-label="Next">
                                                                        <span aria-hidden="true">»</span>
                                                                    <span class="visually-hidden">Next</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div> --}}
                                                {{-- </li> --}}
                                            @endif
                                        </ul>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($project->end_date)->format('j F Y') }}
                                    </td>
                                    <td>
                                        @if ($project->status == 'completed')
                                            <div class="status_badge badge bg-success p-2 px-3 rounded">Completed</div>
                                        @elseif ($project->status == 'in_progress')
                                            <div class="status_badge badge bg-success p-2 px-3 rounded">In Progress</div>
                                        @elseif ($project->status == 'on_hold')
                                            <div class="status_badge badge bg-success p-2 px-3 rounded">On Hold</div>
                                        @elseif ($project->status == 'canceled')
                                            <div class="status_badge badge bg-success p-2 px-3 rounded">Canceled</div>
                                        @endif
                                    </td>
                                    @canany(['edit project', 'delete project'])
                                        <td class="d-flex justify-content-end">
                                            <a title="Invite User" data-url="{{route('projects.edit', $project->id)}}" id="edit-leave" class="btn btn-add" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_project"><i class="fa fa-user m-r-5"></i> </a>
                                            @can('edit project')
                                                <a title="Edit" data-url="{{route('projects.edit', $project->id)}}" id="edit-project" class="btn btn-add" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit_project"><i class="fa fa-pencil m-r-5"></i></a>
                                            @endcan
                                            @can('delete project')
                                                <a title="Delete" id="delete-project" data-url="{{route('projects.destroy', $project->id)}}" class="btn btn-add" href="#" data-bs-toggle="modal" data-bs-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i></a>
                                            @endcan
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

    @include('includes.modal.project-modal')

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
            $('#edit_project').modal('show')
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
                        dropdownParent: $('#add_project')
                    });
                }

                if($('.select-project-type').length > 0) {
                    $('.select-project-type').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#add_project')
                    });
                }

                //edit
                if($('.select-employee-edit').length > 0) {
                    $('.select-employee-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_project')
                    });
                }

                if($('.select-project-type-edit').length > 0) {
                    $('.select-project-type-edit').select2({
                        width: '100%',
                        tags: true,
                        dropdownParent: $('#edit_project')
                    });
                }

                    $('body').on('click', '#edit-project', function () {
                        const editUrl = $(this).data('url');

                        $.get(editUrl, (data) => {
                            $('#project_name_edit').val(data.project_name)
                            $('#client_name_edit').val(data.client)
                            $('#start_date_edit').val(data.start_date)
                            $('#end_date_edit').val(data.end_date)
                            $('#description_edit').html(data.description)
                            
                            $('#budget_edit').val(data.budget)
                            $('#estimated_hours_edit').val(data.estimated_hrs)

                            $('#status_edit option[value='+ data.status +']').attr('selected','selected');
                            $('#status_edit').val(data.status ? data.status : 0).trigger('change');
                            
                            const urlNow = '{{ Request::url() }}'
                            $('#edit-form-project').attr('action', urlNow + '/' + data.id);
                        })
                    });

                $('body').on('click', '#delete-project', function(){
                    const deleteURL = $(this).data('url');
                    $('#form-delete-project').attr('action', deleteURL);
                })
            });
    </script>
@endpush
