<div id="modalApproveAttendance" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Approve</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <form>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Request Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" id="date_request" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Branch  <span class="text-danger">*</span></label>
                            <input type="" name="" readonly>
                            <div class="text-danger" role="alert">
                            </div>
                        </div>
                         <div class="form-group col-md-6">
                            <label>Employee<span class="text-danger">*</span></label>
                            <input type="" name="" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Request Type<span class="text-danger">*</span></label>
                            <input type="" name="" readonly>
                            <div class="text-danger" role="alert">
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <label class="mt-3">Date</label>
                            <input type="date" name="date" id="attendance_date" class="form-control  mb-3" readonly>
                            <label>Status</label>
                            <input type="" name="" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="mt-3">Clock In</label>
                            <input type="time" name="clock_in" class="form-control mb-3" id="attendance_clock_in" readonly>
                            <label>Clock Out</label>
                            <input type="time" name="clock_out" class="form-control mb-3"id="attendance_clock_out" readonly>
                        </div>
                        <div class="form-group">
                            <label for="leave_reason" class="form-label">Description</label>
                            <textarea class="form-control" placeholder="description" name="description" cols="50" rows="3" id="description_attendance" readonly></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                    <button type="button" class="btn btn-warning float-end me-1" id="btnAddinput">Reject</button>
                </form>
            </div>
        </div>
    </div>
</div>