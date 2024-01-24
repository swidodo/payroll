 <!-- Import attendance Modal -->
 <div id="import_schedule" class="modal custom-modal fade"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Schedule</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formImportSchedule">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>File schedule<span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="schedule-file" name="file-excel">
                                <a class="text-success" download href="{{asset('file/template-excel-schedule/template-import-schedule.xlsx')}}"> Download template</a>
                    
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