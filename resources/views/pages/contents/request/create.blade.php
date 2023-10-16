@extends('pages.dashboard')

@section('title', 'Create Request')

@section('dashboard-content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Create Request</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Request</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="modal-body">
                    <form id="addFormPosition" method="POST">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Branch  <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" id="branchId" name="branch_id" required>
                                            <option value="0">Select Branch</option>
                                        </select>
                                        <div class="text-danger" role="alert">
                                        </div>
                                        
                                    </div>
                                     <div class="form-group">
                                        <label>Employee<span class="text-danger">*</span></label>
                                        <select class="form-control form-select" id="branchId" name="branch_id" required>
                                            <option value="0">Select Branch</option>
                                        </select>
                                        <div class="text-danger" role="alert">
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Request Type<span class="text-danger">*</span></label>
                                        <select class="form-control form-select" id="branchId" name="branch_id" required>
                                            <option value="0">Attendance</option>
                                            <option value="0">Schedule</option>
                                            <option value="0">Timesheet</option>
                                            <option value="0">Overtime</option>
                                        </select>
                                        <div class="text-danger" role="alert">
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                    </form>
                </div>
        </div>
    </div>
</div>