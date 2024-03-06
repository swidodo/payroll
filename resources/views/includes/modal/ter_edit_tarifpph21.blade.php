    <!-- Add bpjs Modal -->
    <div id="edit_modal_ter" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="heading"></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editFormCategoryTer" method="POST">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Start<span class="text-danger">*</span></label>
                                <input type="hidden" id="id" name="id">
                                <input type="number" class="form-control" id="starting_edit" name="start_value" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>End<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="ending_edit" name="end_value" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Monthly Rate %</label>
                                <input type="text" class="form-control" id="tarif_edit" name="tarif" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Category</label>
                                <input type="text" class="form-control" id="category_edit" readonly>
                            </div>
                        </div>
                        <div class="submit-section float-end">
                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    