<div class="modal custom-modal fade" id="adjustment" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card-header mb-3"><h4>Ajustment Attendance</h4> </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form id="formAjusment">
                         <label>Employee</label>
                         <select class="form-control form-select mt-3 mb-3 employee-select" id="employeAjustment" name="employee_id" style="width:100%;" required>
                            <option value="">--Pilih employee --</option>
                            <option value="test">--employee --</option>
                        </select>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mt-3">Date</label>
                                <input type="date" name="date[]" class="form-control  mb-3" required>
                                <label>Status</label>
                                <select class="form-control form-select mb-3" name="status[]" required>
                                    <option value="Present" selected>Present</option>
                                    <option value="Alpha">Alpha</option>
                                    <option value="Leave">Leave</option>
                                    <option value="Sick">Sick</option>
                                    <option value="Permit">Permit</option>
                                    <option value="Dispensation">Dispensation</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="mt-3">Clock In</label>
                                <input type="time" name="clock_in[]" class="form-control mb-3" required>
                                <label>Clock Out</label>
                                <input type="time" name="clock_out[]" class="form-control mb-3" required>
                            </div>
                        </div>
                        
                        <hr/>
                        <div id="item1"></div>
                        <button type="submit" class="btn btn-primary float-end">Save</button>
                        <button type="button" class="btn btn-warning float-end me-1" id="btnAddinput">+</button>
                    </form>
                </div>
            </div>
        </div>
    </div>