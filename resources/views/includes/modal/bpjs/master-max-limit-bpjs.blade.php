    <!-- Add bpjs Modal -->
    <div id="add_masterLimitbpjs" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Max Limit</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" id="addMasterLimitBpjs">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>BPJS Name</label>
                                    <select class="form-control form-select" name="bpjs_code" id="bpjsName" required>
                                        <option value="">- Select BPJS -</option>
                                        <option value="KSHT">BPJS KESEHATAN</option>
                                        <option value="JP">BPJS JP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Max Value</label>
                                    <input type="text" name="value" class="form-control" id="value" required>
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
    <div id="editMasterLimitBpjs" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Master Max Limit</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateMaterLimitBpjs" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>BPJS Name</label>
                                    <select class="form-control form-select" name="bpjs_code" id="editBpjsCode" required>
                                        <option value="">- Select BPJS -</option>
                                        <option value="KSHT">BPJS KESEHATAN</option>
                                        <option value="JP">BPJS JP</option>
                                    </select>
                                    <input type="hidden" value="" name="id" id="id" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Max Value</label>
                                    <input type="text" name="value" class="form-control" id="editValue" required>
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




