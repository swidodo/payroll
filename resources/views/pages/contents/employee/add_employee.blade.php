@extends('pages.dashboard')

@section('title', 'Employees')

@section('dashboard-content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Employee</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Employee</a></li>
                        <li class="breadcrumb-item active">{{$employeesId ?? 'Employee Detail'}}</li>
                    </ul>
                </div>

            </div>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{Session::get('success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{Session::get('error')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
        <!-- /Page Header -->
        <form action="{{route('save-create-employee')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (Auth::user()->type != 'employee')
                <div class="row">
                    <div class="col-md-6">
                        <div class="card emp_details">
                            <div class="card-header p-3"><h4 class="mb-0">Personal Detail</h4></div>
                            <div class="card-body employee-detail-edit-body fulls-card">

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="name" class="form-label">Name</label><span class="text-danger pl-1">*</span>
                                            <input class="form-control"  name="name" type="text" id="name" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="phone" class="form-label">Phone</label><span class="text-danger pl-1">*</span>
                                            <input class="form-control" name="phone" type="number" id="phone">
                                        </div>
                                        <div class="form-group col-md-6">

                                            <label for="dob" class="form-label">Date of Birth</label><span class="text-danger pl-1">*</span>
                                            <input class="form-control" name="dob" type="date" id="dob" >

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="gender" class="form-label">Gender</label><span class="text-danger pl-1">*</span>
                                            <div class="d-flex radio-check mt-2">
                                                <select class="form-control form-select" name="gender" required>
                                                    <option value="">-- Pilih --</option>
                                                    <option value="MALE">MALE</option>
                                                    <option value="FEMALE">FEMALE</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="identity_card" class="form-label">Identity Card Number</label>
                                            <input class="form-control"  name="identity_card" type="text" id="name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="identity_card" class="form-label">Family Card Number</label>
                                            <input class="form-control"  name="family_card" type="text"  id="name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="religion" class="form-label">Religion</label>
                                            <select class="form-control form-select"  id="religion" name="religion" required>
                                                <option value="" disabled>-- Select Religion --</option>
                                                <option value="ISLAM">ISLAM</option>
                                                <option value="KATHOLIK">KATHOLIK</option>
                                                <option value="KRISTEN">KRISTEN</option>
                                                <option value="HINDU">HINDU</option>
                                                <option value="BUDHA">BUDHA</option>
                                                <option value="OTHER">OTHER</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="marital_status" class="form-label">Marital Status</label>
                                            <select class="form-control select"  id="marital_status" name="marital_status" required>
                                                @foreach ($paramPph21 as $param)
                                                <option value="{{$param->code }}" >{{ $param->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="bank_name" class="form-label">Email</label>
                                            <input class="form-control"  name="email" type="text" id="email" required>
                                        </div> 
                                        <div class="form-group">
                                            <label for="address" class="form-label">Address</label><span class="text-danger pl-1">*</span>
                                            <textarea class="form-control" rows="2" name="address" cols="50" id="address"></textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="bank_name" class="form-label">Bank Name</label>
                                            <input class="form-control"  name="account_nubank_namember" type="text" id="name">
                                        </div> 
                                        <div class="form-group col-md-6">
                                            <label for="account_number" class="form-label">Bank Account</label>
                                            <input class="form-control"  name="account_number" type="text"  id="name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="identity_card" class="form-label">NPWP Number</label>
                                            <input class="form-control"  name="npwp_number" type="text" id="name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="marital_status" class="form-label">Status</label>
                                            <select class="form-control select"  id="status-employee-edit" name="status">
                                                <option value="active" selected>Active</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card emp_details">
                            <div class="card-header p-3"><h4 class="mb-0">Employee Data</h4></div>
                            <div class="card-body employee-detail-edit-body fulls-card">
                                <div class="row">
                                <div class="form-group col-md-6">
                                        <label for="employee_id" class="form-label">Employee ID</label>
                                        <input class="form-control" name="no_employee" type="text" id="employee_id" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Employee Type</label>
                                        <select class="form-control select"  name="employee_type" id="employee_type">
                                            <option value="" disabled>Select Type</option>
                                            <option value="permanent">Permanent</option>
                                            <option value="probation">Probation</option>
                                            <option value="contract">Contract</option>
                                            <option value="outsourcing">Outsourcing</option>
                                            <option value="hl">Past Daily</option>
                                            <option value="magang">Magang</option>
                                            <option value="freelancers">Freelancers</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="leave_type" class="form-label">Work Type</label>
                                        <select class="form-control select"  id="work_type" name="work_type" required>
                                            <option value="">Select Type</option>
                                            <option value="61">6-1 (6 Days Work) </option>
                                            <option value="52">5-2 (5 Days Work) </option>
                                            <option value="30">3-0 (Full Days Work) </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="leave_type" class="form-label">Leave Type</label>
                                        <select class="form-control select"  id="leave_type" name="leave_type">
                                            <option value="0">Select Type</option>
                                            <option value="PS">Annual Proreta Start</option>
                                            <option value="PE">Annual Proreta End</option>
                                        </select>
                                    </div>
                                    <hr >
                                    <div class="form-group col-md-6">
                                        <label for="branch_id" class="form-label">Branch</label>
                                        <select class="form-control select" name="branch_id" id="branchInput" required>
                                            <option value="" selected>Select Branch</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{$branch->id }}">{{$branch->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="company_doj" class="form-label">Join Date</label>
                                        <input class="form-control" name="company_doj" type="date" id="company_doj" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="company_doe" class="form-label">End Date</label>
                                        <input class="form-control" name="company_doe" type="date">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Department </label>
                                        <select class="form-control select" name="department" id="departs">
                                            <option value="" selected>Select Department</option>
                                            @foreach ($department as $depart)
                                                <option value="{{$depart->id }}">{{$depart->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Position </label>
                                        <select class="form-control select" name="position" id="positId">
                                            <option value="" selected>Select Position</option>
                                            @foreach ($position as $post)
                                                <option value="{{$post->id }}">{{$post->position_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
            @endif
        </form>
    </div>
    <!-- /Page Content -->
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

    <script>
            $(document).ready(function () {
                $('#leave_type').val(employee.leave_type != null ? employee.leave_type : 0).trigger('change');
                $('#marital_status').val(employee.marital_status != null ? employee.marital_status : 0).trigger('change');

                $('#status-employee-edit option[value='+ employee.status +']').attr('selected','selected');
                $('#status-employee-edit').val(employee.status ? employee.status : 0).trigger('change');

               $('.cancel-btn').click(function(e){
                    e.preventDefault()
                })
                $('#branch_id option[value='+ branchId +']').attr('selected','selected');
                $('#branch_id').val(branchId ? branchId : 0).trigger('change');
            });
            $('#branchInput').on('change',function(){
                var branch_id = $(this).val();
                $.ajax({
                    url : 'get-dept-posit',
                    type : 'post',
                    data : {branch_id : branch_id},
                    dataType : 'json',
                    success : function(respon){
                        var depart ='<option value="">-- select -- </option>';
                        $.each(respon.dept, function(key,val){
                            dept += `<option value="`+val.id+`">`+val.name+`</option>`;
                        })
                        $('#departs').html(depart);

                        var position ='<option value="">-- select -- </option>';
                        $.each(respon.posit, function(key,val){
                            position += `<option value="`+val.id+`">`+val.position_name+`</option>`;
                        })
                        $('#positId').html(position);
                    }
                })
            })
    </script>
@endpush
