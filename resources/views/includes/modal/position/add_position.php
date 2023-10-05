    <!-- Add bpjs Modal -->
    <div id="add_modal_position" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Position</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
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
                                        <label>Position Code<span class="text-danger">*</span></label>
                                        <input class="form-control" id="position_code" name="position_code" required>
                                        <div class="text-danger" role="alert">
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Position Name<span class="text-danger">*</span></label>
                                        <input class="form-control" id="position_name" name="position_name" required>
                                        <div class="text-danger" role="alert">
                                            <small><strong></strong></small>
                                        </div>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label>Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" id="description"></textarea>
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