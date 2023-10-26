    <!-- Add overtime Modal -->
    <div id="add_modal_allowance_other" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Allowance Other</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-addallowanceOther" method="POST">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" name="date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Employee <span class="text-danger">*</span></label>
                                    <select class="form-control select" id="employee_id" name="employee_id">
                                       
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Type Allowance <span class="text-danger">*</span></label>
                                    <select class="form-control select-allowance-type" id="employee_id" name="allowance_option_id">
                                    @foreach ($allowanceTypes as $type)
                                       <option value="{{ $type->id }}">{{ $type->name }}</option> 
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" name="amount" class="form-control">
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
    <!-- /Add User Modal -->

    


