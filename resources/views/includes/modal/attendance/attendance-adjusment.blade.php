<div class="modal custom-modal fade" id="adjustment" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card-header mb-3"><h4>Ajustment Attendance</h4> </div>
                    <form id="formAjusment">
                         <label>Employee</label>
                         <select class="form-control form-select mt-3 mb-3">
                            <option></option>
                            <option></option>
                            <option></option>
                        </select>
                        <label>Date</label>
                        <input type="date" name="date[]" class="form-control mb-3">
                        <label>Clock In</label>
                        <input type="date" name="clock_in[]" class="form-control mb-3">
                        <label>Clock Out</label>
                        <input type="date" name="clock_out[]" class="form-control mb-3">
                        <label>Status</label>
                        <select class="form-control form-select mb-3" name="status[]">
                            <option value="Present" selected>Present</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Leave">Leave</option>
                            <option value="Sick">Sick</option>
                            <option value="Permit">Permit</option>
                            <option value="Dispensation">Dispensation</option>
                        </select>
                        <hr/>
                        <div id="item1"></div>
                        <button type="submit" class="btn btn-primary float-end">Save</button>
                        <button type="button" class="btn btn-primary float-end me-1" id="btnAddinput">+</button>
                    </form>
                </div>
            </div>
        </div>
    </div>