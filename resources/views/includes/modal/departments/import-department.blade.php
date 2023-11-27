 <!-- Import attendance Modal -->
 <div id="add_import_department" class="modal custom-modal fade"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Department</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formImportDepartment">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>File Department<span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="department-file-excel" name="file-excel">
                                <a class="text-success" download href="{{asset('file/template-excel-department/template-import-department.xlsx')}}">Download template</a>
                    
                                @if ($errors->has('file-excel'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('file-excel')[0] }}</strong></small>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary submit-btn">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Import User Modal -->