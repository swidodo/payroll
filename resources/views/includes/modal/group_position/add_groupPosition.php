    <!-- Add bpjs Modal -->
    <div id="addGroupPosition" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Group Position</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <form id="addFormGroupPosition" method="POST">
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
                                        <label>Employee Name  <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" id="employeeId" name="employee_id" required>
                                            <option value="0">Select Employee</option>
                                        </select>
                                        <div class="text-danger" role="alert">
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Departement Name<span class="text-danger">*</span></label>
                                        <select class="form-control form-select" id="departementId" name="departement_id" required>
                                            <option value="0">Select Departement</option>
                                        </select>
                                        <div class="text-danger" role="alert">
                                            <small><strong></strong></small>
                                        </div>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label>Position Name  <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" id="positionId" name="position_id" required>
                                            <option value="0">Select Position</option>
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