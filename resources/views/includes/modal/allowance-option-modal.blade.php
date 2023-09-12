


    <!-- Add allowance Modal -->
    <div id="add_allowance" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-l" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Allowance Option</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('allowance-option.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Name  <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" placeholder="Enter Allowance Option Name">

                                    @if ($errors->has('name'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('name')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Pay Type<span class="text-danger">*</span></label>
                                    <select class="form-control form-select" name="pay_type" id="pay_type">
                                        <option value="fixed">Fixed</option>
                                        <option value="unfixed">Unfixed</option>
                                    </select>
                                    @if ($errors->has('name'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('name')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                                <div id="include"></div>
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

    <!-- Edit reimbursement Modal -->
    <div id="edit_allowance" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Allowance Option</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="edit-form-allowance-option" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Name  <span class="text-danger">*</span></label>
                                        <input class="form-control" id="edit-name-allowance-option" type="text" name="name" placeholder="Enter Allowance Option Name">

                                        @if ($errors->has('name'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('name')[0] }}</strong></small>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pay Type<span class="text-danger">*</span></label>
                                    <select class="form-control form-select" name="pay_type" id="edit_pay_type">
                                        <option value="fixed">Fixed</option>
                                        <option value="unfixed">Unfixed</option>
                                    </select>
                                    @if ($errors->has('pay_type'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('pay_type')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Include Attendance</label>
                                    <select class="form-control form-select" name="include_attendance" id="includeAttendance">
                                        <option value="N" selected>No</option>
                                        <option value="Y">Yes</option>
                                    </select>
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
    <!-- /Edit User Modal -->

    <!-- Delete User Modal -->
    <div class="modal custom-modal fade" id="delete_allowance" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Allowance Option</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <form action="" id="form-delete-allowance-option" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary continue-btn">Delete</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete User Modal -->



