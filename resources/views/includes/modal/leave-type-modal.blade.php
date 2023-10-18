


    <!-- Add leave_type Modal -->
    <div id="add_leave_type" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-l" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Leave Type</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('leave-type.store')}}" method="POST" id="fromAddLeaveType">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Leave Type  <span class="text-danger">*</span></label>
                                    <select class="form-select" name="type_name" id="typeName">
                                        <option value="SDS">SICK</option>
                                        <option value="IZN">PERMIT</option>
                                        <option value="A">ALPHA</option>
                                        <option value="CT">LEAVE</option>
                                        <option value="DSP">DISPENSATION</option>
                                    </select>
                                    @if ($errors->has('title'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('title')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Days Per Year <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="days" placeholder="Enter Days / Year Name" id="days">

                                    @if ($errors->has('days'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('days')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Include Salary<span class="text-danger">*</span></label>
                                     <select class="form-select" name="include_salary" id="includeSalary">
                                        <option value="N">No</option>
                                        <option value="Y">Yes</option>
                                    </select>

                                    @if ($errors->has('include_salary'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('include_salary')[0] }}</strong></small>
                                    </div>
                                    @endif
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

    <!-- Edit leave_type Modal -->
    <div id="edit_leave_type" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Leave Type</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="edit-form-leave-type" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Leave Type  <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="title" placeholder="Enter Leave Type Name" id="edit-title-leave-type">

                                    @if ($errors->has('title'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('title')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Days Per Year <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="days" placeholder="Enter Days / Year Name" id="edit-days-leave-type">

                                    @if ($errors->has('days'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('days')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                             <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Include Salary<span class="text-danger">*</span></label>
                                     <select class="form-select" name="include_salary" id="editincludeSalary">
                                        <option value="N">No</option>
                                        <option value="Y">Yes</option>
                                    </select>

                                    @if ($errors->has('include_salary'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('include_salary')[0] }}</strong></small>
                                    </div>
                                    @endif
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
    <!-- /Edit User Modal -->

    <!-- Delete User Modal -->
    <div class="modal custom-modal fade" id="delete_leave_type" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Leave Type</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <form action="" id="form-delete-leave-type" method="POST">
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



