<div id="addRotate" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Employee Rotation</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form id="formRotation">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label>Rotation Date</label>
                                <input type="date" name="rotate_date" class="form-control mb-3">
                                <label>Rotation Type</label>
                                <select name="rotate_name" class="form-control form-select mb-3">
                                    <option>Promotion</option>
                                    <option>Rotation</option>
                                    <option>Mutation</option>
                                    <option>Demotion</option>
                                </select>
                                <label>Employee Name</label>
                                <select name="employee_id" class="form-control form-select mb-3" id="employeeId">
                                </select>
                                <label>Job Level</label>
                                <input type="text" name="job_level" class="form-control mb-3">
                            </div>
                            <div class="col-md-6">
                                <label>Central Office</label>
                                <input type="text" id="company" class="form-control form-select mb-3" disable>
                                <input type="hidden" name="company_id" id="companyId">
                                <input type="hidden" name="company_name" id="companyName">
                                <label>Branch Name</label>
                                <input type="text" id="branch" class="form-control form-select mb-3" disable>
                                <input type="hidden" name="branch_id" id="branchId">
                                <input type="hidden" name="branch_name" id="branchName">
                                <label>From Department</label>
                                <select name="from_department" class="form-control form-select mb-3" id="fromDepartment">
                                </select>
                                <label>To Department</label>
                                <select name="to_department" class="form-control form-select mb-3" id="toDepartment">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary me-3">Save</button>
                            <button class="btn btn-warning">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>