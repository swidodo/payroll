<div id="modalApproveLeave" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Approve</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  method="POST"  id="formLeave">
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label>Request Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" id="date_request_leave" class="form-control" readonly />
                        </div>
                        <div class="form-group col-md-6">
                            <label>Branch  <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="branch_id" id="branch_id_leave" readonly />
                        </div>
                         <div class="form-group col-md-6">
                            <label>Employee<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="employee_id" id="employe_id_leave" readonly />
                        </div>
                        <div class="form-group col-md-6">
                            <label>Request Type<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="request_type" id="request_type_leave" readonly />
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="leave_type_id" class="form-label">Leave Type</label>
                                <input type="text" class="form-control" name="leave_type_id" id="leave_type_id" readonly />
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input class="form-control" name="start_date" type="date" id="start_date_leave" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input class="form-control" name="end_date" type="date" id="end_date_leave" readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="leave_reason" class="form-label">Leave Reason</label>
                                <textarea class="form-control" placeholder="Leave Reason" name="leave_reason" cols="50" rows="3" id="leave_reason" readonly></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="formFile" class="form-label">Image Attachment</label>
                                <div class="row">
                                    <div class="col-md-12 h-50 w-50">
                                        <a href="{{ asset('../storage/app/public/1697598451_image.png'); }}" target="_blank">
                                            <img src="" id="imgLeave">
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>