<div id="modalApproveAttendance" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Allowance</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <form>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Request Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" id="date_request" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Branch  <span class="text-danger">*</span></label>
                            <select class="form-control form-select" id="branchId" name="branch_id" required>
                                @foreach($branch as $branchs)
                                <option value="{{ $branchs->id }}">{{ $branchs->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger" role="alert">
                            </div>
                        </div>
                         <div class="form-group col-md-6">
                            <label>Employee<span class="text-danger">*</span></label>
                            <select class="form-control form-select" id="employeeId" name="employee_id" required>
                                @foreach($employee as $employees)
                                <option value="{{ $employees->id }}">{{ $employees->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger" role="alert">
                            </div>
                            
                        </div>
                        <div class="form-group col-md-6">
                            <label>Request Type<span class="text-danger">*</span></label>
                            <select class="form-control form-select" id="request-options" name="request_type" required>
                                <option value="" disabled selected>-- request options -- </option>
                                <option value="attendance">Attendance</option>
                                <option value="schedule">Schedule</option>
                                <option value="timesheet">Timesheet</option>
                                <option value="overtime">Overtime</option>
                                <option value="leave">Leave</option>
                            </select>
                            <div class="text-danger" role="alert">
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <label class="mt-3">Date</label>
                            <input type="date" name="date" id="attendance_date" class="form-control  mb-3" required>
                            <label>Status</label>
                            <select class="form-control form-select mb-3" name="status" id="attendance_status" required>
                                <option value="Present" selected>Present</option>
                               <!--  <option value="Alpha">Alpha</option>
                                <option value="Leave">Leave</option>
                                <option value="Sick">Sick</option>
                                <option value="Permit">Permit</option>
                                <option value="Dispensation">Dispensation</option> -->
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="mt-3">Clock In</label>
                            <input type="time" name="clock_in" class="form-control mb-3" id="attendance_clock_in" required>
                            <label>Clock Out</label>
                            <input type="time" name="clock_out" class="form-control mb-3"id="attendance_clock_out" required>
                        </div>
                        <div class="form-group">
                            <label for="leave_reason" class="form-label">Description</label>
                            <textarea class="form-control" placeholder="description" name="description" cols="50" rows="3" id="description_attendance"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                    <button type="button" class="btn btn-warning float-end me-1" id="btnAddinput">Reject</button>
                </form>
            </div>
        </div>
    </div>
</div>