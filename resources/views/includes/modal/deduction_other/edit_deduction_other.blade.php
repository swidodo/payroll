    <!-- Add overtime Modal -->
    <div id="edit_modal_deduction_other" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Allowance Other</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-editdeductionOther" method="POST">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Date <span class="text-danger">*</span></label>
                                    <input type="date" name="date" id="date_edit" class="form-control">
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="branch_id_edit" id="branchInput_edit">
                                </div>
                                <div class="form-group">
                                    <label>Employee <span class="text-danger">*</span></label>
                                    <select class="form-control" id="employee_id_edit" name="employee_id">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Deduction Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name_edit" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" name="amount" id="amount_edit" class="form-control">
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
    <!-- /Add User Modal -->

    


