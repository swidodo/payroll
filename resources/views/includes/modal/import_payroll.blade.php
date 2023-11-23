
     <!-- Import Manual payroll Modal -->
     <div class="modal custom-modal fade" id="modalImportPayroll" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Payroll</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="UploadDataPayroll">
                            <div class="mb-3">
                                <label>File Import</label>
                                <input type="file" name="import_payroll" id="import-payroll" class="form-control" required>
                                <a download href="{{asset('file/template-excel-payroll/template-import-payroll.xlsx')}}" class="text-small">Download template import payroll</a>
                                
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">IMPORT AND RUN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /import Modal -->
     <!-- Import Auto payroll Modal -->
     <div class="modal custom-modal fade" id="modalImportPayrollAuto" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Payroll</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="UploadDataPayroll">
                            <div class="mb-3">
                                <label>File Import</label>
                                <input type="file" name="import_payroll" id="import-payroll" class="form-control" required>
                                <a download href="{{asset('file/template-excel-payroll/template-import-payroll_V2.xlsx')}}" class="text-small">Download template import payroll</a>
                                
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">IMPORT AND RUN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /import Modal -->