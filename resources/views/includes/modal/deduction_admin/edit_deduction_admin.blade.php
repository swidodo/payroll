    <!-- Add overtime Modal -->
    <div id="edit_modal_deduction_admin" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Deduction Fixed</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-editdeductionadmin" method="POST">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Branch<span class="text-danger">*</span></label>
                                    <select class="form-control" id="branch_id_edit" name="branch_id">
                                    </select>
                                    <input type="hidden" name="id" id="id">
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

    


