
<!-- Edit ptkp -->
<div id="add_ptkp_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create PTKP</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="add-form-ptkp" method="POST">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Ptkp Description <span class="text-danger">*</span></label>
                                <input class="form-control" id="name" type="text" name="name" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Ptkp Code <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="code" id="code" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Amount <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="value" id="edit-amount" required>                                
                                <div class="text-danger" role="alert">
                                    <small><strong></strong></small>
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
<!-- /Edit ptkp -->

    


