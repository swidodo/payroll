
<div id="edit_modal_allowance_other" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Allowance Other</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-addallowanceOther" method="POST">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="hidden" name="id" id="edit-id">
                                <input type="date" name="date" class="form-control" id="edit-date">
                            </div>
                            <div class="form-group">
                                <label>Employee <span class="text-danger">*</span></label>
                                <select class="form-control select-employee" id="edit_employee_id" name="employee_id">
                                   
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Type Allowance <span class="text-danger">*</span></label>
                                <select class="form-control select-allowance-type" id="edit-type_allowance" name="allowance_option_id">
                                
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" name="amount" class="form-control" id="edit-amount">
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
    