    <!-- Add leave Modal -->
    <div id="add_leave" class="modal custom-modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Leave</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('leaves.store')}}" method="POST" enctype="multipart/form-data" id="formLeave">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="employee_id"  class="form-label">Employee <span class="text-danger">*</span></label>
                                            <select class="form-control select-employee" id="employee_id" name="employee_id" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="leave_type_id" class="form-label">Leave Type</label>
                                            <select name="leave_type_id" id="leave_type_id" class="form-control select-leave-type" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input class="form-control" name="start_date" type="date" id="start_date" required>

                                            @if ($errors->has('start_date'))
                                                <div class="text-danger" role="alert">
                                                    <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input class="form-control" name="end_date" type="date" id="end_date" required>
                                        </div>

                                        @if ($errors->has('end_date'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('end_date')[0] }}</strong></small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group col-md-6">
                                            <label for="total_leave" class="form-label">Have Leave</label>
                                            <input class="form-control" type="text" id="total_leave" readonly disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">   
                                        <div class="form-group col-md-6">
                                            <label for="formFile" class="form-label">Attachment (opsional)</label>
                                            <input name="attachment_request" class="form-control" type="file" id="attachment_leave">
                                            <a href="" id="attachment_rejected_add_anchor"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="leave_reason" class="form-label">Leave Reason</label>
                                    <textarea class="form-control" placeholder="Leave Reason" name="leave_reason" cols="50" rows="3" id="leave_reason"></textarea>

                                    @if ($errors->has('leave_reason'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('leave_reason')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn" id="add-leave">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add User Modal -->

    <!-- export leave Modal -->
    <div id="modal_export" class="modal custom-modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-l" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('time-management.export')}}" method="POST">
                        @csrf
                        <input hidden type="text" name="menu" id="" value="leaves">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date </label>
                                    <input type="date" name="start_date" id="startdate" class="form-control " placeholder="Start Date" required>
    
                                    @if ($errors->has('start_date'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date </label>
                                    <input type="date" name="end_date" id="enddate" class="form-control " placeholder="End Date" required>
    
                                    @if ($errors->has('end_date'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('end_date')[0] }}</strong></small>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Export PDF</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add User Modal -->

    <!-- Edit leave Modal -->
    <div id="edit_leave" class="modal custom-modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Leave</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-form-leave">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="employee_id_edit">Employee <span class="text-danger">*</span></label>
                                            <input type="hidden" name="id" id="id">
                                            <select  class="form-control select-employee-edit" id="employee_id_edit" name="employee_id">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="leave_type_id" class="form-label">Leave Type</label>
                                            <select name="leave_type_id" id="leave_type_id_edit" class="form-control select-leave-type-edit">
                                            
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input class="form-control" name="start_date" type="date" id="start_date_edit">

                                            @if ($errors->has('start_date'))
                                                <div class="text-danger" role="alert">
                                                    <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input class="form-control" name="end_date" type="date" id="end_date_edit">
                                        </div>

                                        @if ($errors->has('end_date'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('end_date')[0] }}</strong></small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label for="leave_reason" class="form-label">Leave Reason</label>
                                    <textarea class="form-control" placeholder="Leave Reason" name="leave_reason" cols="50" rows="3" id="leave_reason_edit"></textarea>

                                    @if ($errors->has('leave_reason'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('leave_reason')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>

                                <div class="form-group" id="approver" style="display: none">
                                    <label for="status" class="form-label">Approved By</label>
                                    <div class="wrapper-approver">
                                        
                                    </div>
                                </div>
                               
                                <div class="form-group" id="form-status" style="display: none">
                                    <label for="status" class="form-label">Status</label>
                                    <input hidden type="text" name="level_approve" id="level_approve" value="">
                                    <select name="status" id="status_edit" class="form-control">
                                        <option value="0">Select Status</option>
                                        <option value="Approved">Approve</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Rejected">Reject</option>
                                    </select>

                                        @if ($errors->has('status'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('employee_id')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>
                                    <div class="form-group" id="rejected-reason" style="display: none">
                                        <label for="rejected_reason" class="form-label">Rejected Reason</label>
                                        <textarea class="form-control" placeholder="Rejected Reason" name="rejected_reason" cols="30" rows="3" id="rejected_reason_edit"></textarea>

                                        <div class="mt-3">
                                            <label for="formFile" class="form-label">Attachment (opsional)</label> &nbsp; <span class="text-muted" style="font-size: 10px">pdf, jpg, jpeg, png</span>
                                            <input name="attachment_reject" class="form-control" type="file" id="attachment_rejected_edit">
                                            <a href="" id="attachment_rejected_edit_anchor"></a>
                                        </div>
                                    </div>
                                {{-- @endif --}}
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
    <!-- /Edit User Modal -->

