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
                                <input type="date" name="rotate_date" class="form-control mb-3" required>
                                <label>Rotation Type</label>
                                <select name="rotate_name" class="form-control form-select mb-3">
                                    <option value="Promotion">Promotion</option>
                                    <option value="Rotation">Rotation</option>
                                    <option value="Mutation">Mutation</option>
                                    <option value="Demotion">Demotion</option>
                                </select>
                                <label>Employee Name</label>
                                <select name="employee_id" class="form-control form-select mb-3 select-employee" id="employeeId" required>
                                </select>
                                <label>Position</label>
                                <select name="position_id" class="form-control form-select mb-3 select-position" id="position_id" >
                                    <option></option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Head Office</label>
                                <input type="text" id="company" class="form-control form-select mb-3" disable>
                                <input type="hidden" name="company_id" id="companyId">
                                <input type="hidden" name="company_name" id="companyName">
                                <label>Branch Name</label>
                                <input type="text" id="branch" class="form-control form-select mb-3" disable>
                                <input type="hidden" name="branch_id" id="branchId">
                                <input type="hidden" name="branch_name" id="branchName">
                                <label>From Department</label>
                                <select name="from_department" class="form-control form-select mb-3 form-depart" id="fromDepartment">
                                </select>
                                <label>To Department</label>
                                <select name="to_department" class="form-control form-select mb-3 to-depart" id="toDepartment">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary me-3">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
