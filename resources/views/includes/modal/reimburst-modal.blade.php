    <!-- Add overtime Modal -->
    <div id="add_reimburst" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Reimburst</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAddReimurse">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Branch <span class="text-danger">*</span></label>
                                     <select name="branch_id" id="branchInput" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Employee <span class="text-danger">*</span></label>
                                    <select class="form-control select-employee" id="employee_id" name="employee_id" required>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="reimburst_type_id" class="form-label">Reimburst Type</label>
                                    <select name="reimburst_type_id" id="reimburst_type_id" class="form-control select-reimburst-type">
                                        <option value="0">Select Reimburst Type</option>
                                       
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" placeholder="Amount" name="amount"  id="amount">
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

    <!-- Add overtime Modal -->
    <div id="modal_export" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-l" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('time-management.export')}}" method="POST">
                        @csrf
                        <input hidden type="text" name="menu" id="" value="leaves">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date </label>
                                    <input type="date" name="start_date" id="startdate" class="form-control " placeholder="Start Date" required>
    
                                    @if ($errors->has('start_date'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date </label>
                                    <input type="date" name="end_date" id="enddate" class="form-control " placeholder="End Date" required>
    
                                    @if ($errors->has('end_date'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('end_date')[0] }}</strong></small>
                                    </div>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Export PDF</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add User Modal -->

    <!-- Edit Overtime Modal -->
    <div id="edit_reimburst" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Reimburstment</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateReimburse" >
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Employee <span class="text-danger">*</span></label>
                                    <input type="hidden" id="id" name="id">
                                    <select  class="form-control" id="editemployee_id" name="employee_id">
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="reimburst_type_id" class="form-label">Reimburst Type</label>
                                    <select name="reimburst_type_id" id="editreimburst_type_id" class="form-control select-reimburst-type-edit">
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" placeholder="Amount" name="amount"  id="edit_amount">
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



