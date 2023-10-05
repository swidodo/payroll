    <!-- Add bpjs Modal -->
    <div id="edit_groupPosition" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Department</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <form id="updateFormGroupPotision" method="POST">
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <div class="col-sm-12">
                                     <div class="form-group">
                                        <label>Branch  <span class="text-danger">*</span></label>
                                        <input type="hidden" name="branch_id" id="editBranchId">
                                        <input type="text" class="form-control" id="editBranchName" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Employee Name<span class="text-danger">*</span></label>
                                        <input type="hidden" name="employee_id" id="editEmployeeId">
                                        <input type="text" class="form-control" id="editEmployeeName" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Departement Name<span class="text-danger">*</span></label>
                                        <select class="form-control form-select" id="editDepartementId" name="departement_id" required>
                                            <option value="0">Select Departement</option>
                                        </select>
                                        <div class="text-danger" role="alert">
                                            <small><strong></strong></small>
                                        </div>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label>Position Name  <span class="text-danger">*</span></label>
                                        <select class="form-control form-select" id="editPositionId" name="position_id" required>
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