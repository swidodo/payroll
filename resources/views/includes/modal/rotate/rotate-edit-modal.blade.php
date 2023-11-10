<div id="editRotate" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee Rotation</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="editFormRotation">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Rotation Date</label>
                                <input type="date" name="rotate_date" id="editRotationDate" class="form-control mb-3">
                                <input type="hidden" name="id" id="id">
                                <label>Rotation Type</label>
                                <select name="rotate_name" class="form-control form-select mb-3">
                                    <option>Promotion</option>
                                    <option>Rotation</option>
                                    <option>Mutation</option>
                                    <option>Demotion</option>
                                </select>
                                <label>Employee Name</label>
                                <select name="employee_id" class="form-control mb-3" id="editEmployeeId" readonly>
                                </select>
                                <label>Position</label>
                                <select name="position_id" class="form-control form-select mb-3" id="editpositionId">
                                    <option></option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Central Office</label>
                                <input type="text" id="editCompany" class="form-control mb-3" disable readonly>
                                <input type="hidden" name="company_id" id="editCompanyId">
                                <input type="hidden" name="company_name" id="editCompanyName">
                                <label>Branch Name</label>
                                <input type="text" id="editBranch" class="form-control mb-3" disable >
                                <input type="hidden" name="branch_id" id="editBranchId">
                                <input type="hidden" name="branch_name" id="editBranchName">
                                <label>From Department</label>
                                <select name="from_department" class="form-control form-select mb-3" id="editFromDepartment" readonly>
                                </select>
                                <label>To Department</label>
                                <select name="to_department" class="form-control form-select mb-3" id="editToDepartment" required>
                                    <option></option>
                                </select> 

                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary me-3">Save</button>
                            <a href="#" class="btn btn-warning" id="closedbtn">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
