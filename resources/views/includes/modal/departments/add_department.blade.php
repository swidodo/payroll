    <!-- Add bpjs Modal -->
    <div id="add_department" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Department</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <form id="addFormDepartement" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Department Code<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="departement_code" placeholder=" Departement Name" required>   
                                        <div class="text-danger" role="alert">
                                            <small><strong></strong></small>
                                        </div>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label>Department Name  <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" placeholder="Departement Name" required>   
                                        <div class="text-danger" role="alert">
                                            <small><strong></strong></small>
                                        </div>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label>Branch  <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" id="branchId" name="branch_id" required>
                                            <option value="0">Select Branch</option>
                                        </select>
                                        <div class="text-danger" role="alert">
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Description  <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" placeholder="description" required></textarea>
                                        <div class="text-danger" role="alert">
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Status  <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" id="" name="is_active" required>
                                            <option value="1">Active</option>
                                            <option value="0">Not Active</option>
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