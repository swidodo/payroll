    <!-- Add bpjs Modal -->
    <div id="add_master_bpjs" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Master Bpjs</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" id="addMasterBpjs">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>BPJS Name</label>
                                    <select class="form-control form-select" name="bpjs_code" id="bpjsName" required>
                                        <option value="">- Select BPJS -</option>
                                        <option value="KSHT">BPJS KESEHATAN</option>
                                        <option value="JHT">BPJS JHT</option>
                                        <option value="JKK">BPJS JKK</option>
                                        <option value="JKM">BPJS JKM</option>
                                        <option value="JP">BPJS JP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Company Pay</label>
                                    <input type="text" name="company_pay" class="form-control" id="company_pay" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Employee Pay</label>
                                    <input type="text" name="employee_pay" class="form-control" id="employee_pay" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Value</label>
                                    <input type="text" name="total_value" class="form-control" id="total_value" readonly required>
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
    <div id="editMasterBpjs" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Master Bpjs</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateMaterBpjs" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>BPJS Name</label>
                                    <select class="form-control form-select" name="bpjs_code" id="editBpjsCode" required>
                                        <option value="">- Select BPJS -</option>
                                        <option value="KSHT">BPJS KESEHATAN</option>
                                        <option value="JHT">BPJS JHT</option>
                                        <option value="JKK">BPJS JKK</option>
                                        <option value="JKM">BPJS JKM</option>
                                        <option value="JP">BPJS JP</option>
                                    </select>
                                    <input type="hidden" value="" name="id" id="id" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Company Pay</label>
                                    <input type="text" name="company_pay" class="form-control" id="editCompanyPay" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Employee Pay</label>
                                    <input type="text" name="employee_pay" class="form-control" id="editEmployeePay" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Value</label>
                                    <input type="text" name="total_value" class="form-control" id="editTotalValue" readonly required>
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




