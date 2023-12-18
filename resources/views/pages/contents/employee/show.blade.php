@extends('pages.dashboard')

@section('title', 'Employees')
@push('addon-style')
    <style>
        .borderless {
            border:0px !important;
        }
    </style>
@endpush()
@section('dashboard-content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Employee</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Employee</a></li>
                        <li class="breadcrumb-item active">{{$employeesId}}</li>
                    </ul>
                </div>
                @canany(['edit employee'])
                    <div class="col-auto float-end ms-auto">
                        <a href="{{route('employees.edit', $employee->id)}}" class="btn add-btn" ><i class="fa fa-plus"></i> Edit Employee</a>
                    </div>
                @endcanany
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-body employee-detail-body fulls-card">
                    <h4>Personal Data</h4>
                        <hr style="margin-bottom :-4px;">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr class="borderless">
                                    <td width="40" class="borderless">Name</td>
                                    <td width="1" class="borderless">:</td>
                                    <td class="borderless">{{$employee->name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td width="40" class="borderless">Email</td>
                                    <td width="1" class="borderless">:</td>
                                    <td class="borderless">{{$employee->email ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td width="40" class="borderless">Date of Birth</td>
                                    <td width="1" class="borderless">:</td>
                                    <td class="borderless">{{$employee->dob ? date("F jS, Y", strtotime($employee->dob)) : ''}}</td>
                                </tr>
                                <tr>
                                    <td width="40" class="borderless">Identity Number</td>
                                    <td width="1" class="borderless">:</td>
                                    <td class="borderless">{{$employee->identity_card  ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td width="40" class="borderless">Bank Name</td>
                                    <td width="1" class="borderless">:</td>
                                    <td class="borderless">{{$employee->bank_name  ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td width="40" class="borderless">Account Number</td>
                                    <td width="1" class="borderless">:</td>
                                    <td class="borderless">{{$employee->account_number  ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td width="40" class="borderless">Family Card</td>
                                    <td width="1" class="borderless">:</td>
                                    <td class="borderless">{{$employee->family_card  ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td width="40" class="borderless">Npwp Number</td>
                                    <td width="1" class="borderless">:</td>
                                    <td class="borderless">{{$employee->npwp_number  ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td width="40" class="borderless">Phone</td>
                                    <td width="1" class="borderless">:</td>
                                    <td class="borderless">{{$employee->phone  ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td width="40" class="borderless">Gender</td>
                                    <td width="1" class="borderless">:</td>
                                    <td class="borderless">{{$employee->gender  ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td width="40" class="borderless">Marital Status</td>
                                    <td width="1" class="borderless">:</td>
                                    <td class="borderless">{{ucwords($employee->marital_name)  ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td width="40" class="borderless">Status</td>
                                    <td width="1" class="borderless">:</td>
                                    <td class="borderless">{{ucwords($employee->status)  ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td width="40" class="borderless">Email</td>
                                    <td width="1" class="borderless">:</td>
                                    <td class="borderless">{{ $employee->email ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td width="40" class="borderless">Religion</td>
                                    <td width="1" class="borderless">:</td>
                                    <td class="borderless">{{ucwords($employee->religion)  ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td width="40" class="borderless">Address</td>
                                    <td width="1" class="borderless">:</td>
                                    <td class="borderless">{{ucwords($employee->address)  ?? ''}}</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body employee-detail-body fulls-card" style="margin-bottom : -10px;">
                        <h4>Employement Data</h4>
                        <hr style="margin-bottom :-4px;">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                {{-- <tr>
                                    <td width="40" class="borderless">Employee Code</td>
                                    <td width="1" class="borderless">:</td>
                                    <td  class="borderless">{{$employeesId ?? 'Detail Employee'}}</td>
                                </tr> --}}
                                <tr>
                                    <td width="40" class="borderless">Employee ID</td>
                                    <td width="1" class="borderless">:</td>
                                    <td  class="borderless">{{$employee->no_employee ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td width="40" class="borderless">Employee Type</td>
                                    <td width="1" class="borderless">:</td>
                                    <td  class="borderless">{{$employee->employee_type ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td  class="borderless">Leave Type</td>
                                    <td  class="borderless">:</td>
                                    <td  class="borderless">{{($employee->leave_type =="PS") ? 'Annual Proreta Start' : 'Annual Proreta End'}}</td>
                                </tr>
                                <tr>
                                    <td  class="borderless">Leave Allowance </td>
                                    <td  class="borderless">:</td>
                                    <td  class="borderless">{{ucwords($employee->total_leave) ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td  class="borderless">Branch</td>
                                    <td  class="borderless">:</td>
                                    <td  class="borderless">{{ $employee->branch_name }}</td>
                                </tr> 
                                <tr>
                                    <td  class="borderless">Departement</td>
                                    <td  class="borderless">:</td>
                                    <td  class="borderless">{{ $employee->department_name }}</td>
                                </tr> 
                                <tr>
                                    <td  class="borderless">Position</td>
                                    <td  class="borderless">:</td>
                                    <td  class="borderless">{{ $employee->position_name }}</td>
                                </tr>
                                <tr>
                                    <td  class="borderless">Join Date</td>
                                    <td  class="borderless">:</td>
                                    <td  class="borderless">{{ ($employee->company_doj !=null && $employee->company_doj !='0000-00-00') ? date('d-m-Y',strtotime($employee->company_doj)) : '' }}</td>
                                </tr>
                                <tr>
                                    <td  class="borderless">End Date</td>
                                    <td  class="borderless">:</td>
                                    <td  class="borderless">{{ ($employee->company_doe !='0000-00-00' && $employee->company_doe !=null) ? date('d-m-Y',strtotime($employee->company_doe)) : '' }}</td>
                                </tr>
                                <tr>
                                    <td  class="borderless">Out Date</td>
                                    <td  class="borderless">:</td>
                                    <td  class="borderless">{{ ($employee->out_date !='0000-00-00' && $employee->out_date !=null) ? date('d-m-Y', strtotime($employee->out_date)) :'' }}</td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top : -20px;">
                    <div class="card-body employee-detail-body fulls-card" style="margin-bottom:-30px;">
                        <h4>Medical</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong class="font-bold">Height (cm) : </strong>
                                    <span>{{$employeeMedical->height ?? ''}} </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm font-style">
                                    <strong class="font-bold">Weight (kg) :</strong>
                                    <span>{{$employeeMedical->weight ?? ''}}  </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm font-style">
                                    <strong class="font-bold">Blood Type
                                        :</strong>
                                    <span>{{$employeeMedical->blood_type ?? ''}} </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm font-style">
                                    <strong class="font-bold">Medical Test
                                        :</strong>
                                    <span>{{$employeeMedical->medical_test ?? ''}} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                {{-- <div class="card ">
                    <div class="card-body employee-detail-body fulls-card">
                        <h4>Company Detail</h4>
                        <hr style="margin-bottom :-4px;">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr class="borderless">
                                        <td width="40" class="borderless">Branch</td>
                                        <td width="1" class="borderless">:</td>
                                        <td class="borderless">{{$employee->branch_name ?? ''}}</td>
                                    </tr>
                                    <tr class="borderless">
                                        <td width="40" class="borderless">Join Date</td>
                                        <td width="1" class="borderless">:</td>
                                        <td class="borderless">{{$employee->company_doj ? date("F jS, Y", strtotime($employee->company_doj)) : ''}}</td>
                                    </tr>
                                    <tr class="borderless">
                                        <td width="40" class="borderless">End Date</td>
                                        <td width="1" class="borderless">:</td>
                                        <td class="borderless">{{$employee->company_doe ? date("F jS, Y", strtotime($employee->company_doe)) : ''}}</td>
                                    </tr>
                                    <tr class="borderless">
                                        <td width="40" class="borderless">Address</td>
                                        <td width="1" class="borderless">:</td>
                                        <td class="borderless">{{$employee->company_doe ? date("F jS, Y", strtotime($employee->company_doe)) : ''}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
                <div class="card ">
                    <div class="card-body employee-detail-body fulls-card">
                        <div class="title d-flex">
                          <h4 class="mb-0 pt-1">Experience</h4>
                          <div class="ms-auto">
                              <a href="#" title="List Experience" id="show-modal-experience" data-bs-toggle="modal" data-bs-target="#show-experience" class="btn p-0 px-2 btn-primary" ><i class="fa fa-eye"></i></a>
                          </div>
                      </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong class="font-bold">Start Date : </strong>
                                    <span> {{$employeeExperience != null ? $employeeExperience->start_date ? date("F jS, Y", strtotime($employeeExperience->start_date)) : '' : ''}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm font-style">
                                    <strong class="font-bold">End Date :</strong>
                                    <span> {{$employeeExperience != null ? $employeeExperience->end_date ? date("F jS, Y", strtotime($employeeExperience->end_date)) : '' : ''}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong class="font-bold">Sequence :</strong>
                                    <span>{{$employeeExperience->sequence  ?? ''}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong class="font-bold">Job :</strong>
                                    <span>{{$employeeExperience->job  ?? ''}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong class="font-bold">Position :</strong>
                                    <span>{{$employeeExperience->position ?? ''}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong class="font-bold">Address :</strong>
                                    <span>{{$employeeExperience->address ?? ''}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong class="font-bold">City :</strong>
                                    <span>{{$employeeExperience->city ?? ''}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong class="font-bold">Reason Leaving :</strong>
                                    <span>{{$employeeExperience->reason_leaving ?? ''}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card ">
                    <div class="card-body employee-detail-body fulls-card">
                    <h4>Document Detail</h4>
                        <hr>
                        <div class="row">
                            @php

                            $employeedoc = !empty($employee)?$employee->documents()->pluck('document_value','document_id'):[];
                        @endphp
                        @if(!$documents->isEmpty())
                        @foreach($documents as $key=>$document)
                        <div class="col-md-6">
                            <div class="info text-sm">
                                <strong class="font-bold">{{$document->name }} : </strong>
                                <span><a href="{{ (!empty($employeedoc[$document->id])?asset('../storage/app/public/uploads/document').'/'.$employeedoc[$document->id]:'') }}" target="_blank">{{ (!empty($employeedoc[$document->id])?$employeedoc[$document->id]:'') }}</a></span>
                            </div>
                        </div>
                        @endforeach
                        @else
                          <div class="text-center">
                            No Document Type Added.!
                          </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-body employee-detail-body fulls-card">
                    <h4>Education</h4>
                        <hr>
                        <div class="row">

                            @foreach ($employeeEducations as $education)
                                <div class="col-md-6">
                                    <div class="info text-sm">
                                        <strong class="font-bold">{{$education->institution  ?? ''}}</strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info text-sm text-end">
                                        @if ($education->start_date && $education->end_date)
                                                <strong class="font-bold">{{date("Y", strtotime($education->start_date)).'-'.date("Y", strtotime($education->end_date))}}</strong>
                                        @endif

                                        @if ( $education->start_date != null && $education->end_date == null)
                                            <strong class="font-bold">{{date("Y", strtotime($education->start_date))}}</strong>
                                        @endif

                                        @if ( $education->start_date == null && $education->end_date != null)
                                            <strong class="font-bold">{{date("Y", strtotime($education->end_date))}}</strong>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-body employee-detail-body fulls-card">
                    <h4>Family</h4>
                        <div class="row " style="margin-top: 16px">
                            <div class="col-md-12">
                                <table class="table table-family">
                                    <thead>
                                      <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Relationship</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employeeFamilies as $family)
                                            <tr>
                                            <td class="borderless">{{ $family->name }}</td>
                                            <td class="borderless">{{ $family->gender }}</td>
                                            <td class="borderless">{{ $family->relationship }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                  </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /Page Content -->

    @include('includes.modal.employee-show-modal')

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


                    $('body').on('click', '#edit-user', function () {
                        const userURL = $(this).data('url');
                        // $('#option0').attr('selected','selected');
                        // $('#option0').trigger('change');

                        $.get(userURL, (data) => {
                            const {name, email, id : idUser, branch_id} = data?.user
                            const {id} = data?.user.roles[0] ?? 0
                            console.log(data);
                            const urlNow = '{{ Request::url() }}'
                            $('#edit-name').val(name);

                            $('#edit-email').val(email);

                            $('#edit-role option[value='+ id +']').attr('selected','selected');
                            $('#edit-role').val(id ? id : 0).trigger('change');

                            $('#branch-id-edit option[value='+ branch_id +']').attr('selected','selected');
                            $('#branch-id-edit').val(branch_id ? branch_id : 0).trigger('change');



                            $('#edit-form-user').attr('action', urlNow + '/' + idUser);
                        })
                    });

                $('body').on('click', '#delete-user', function(){
                    const deleteURL = $(this).data('url');
                    $('#user-delete-form').attr('action', deleteURL);
                })
            });
    </script>
@endpush
