


    <!-- Add allowance Modal -->
    <div id="add_performance_review" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Performance</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('performance-review.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Start Date  <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="start_date" placeholder="Start Date">

                                    @if ($errors->has('start_date'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>End Date  <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="end_date" placeholder="Start Date">

                                    @if ($errors->has('end_date'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('end_date')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Employee ID</label>
                                    <select class="select" id="employee_id" name="role">
                                        <option value="0">Select a Employee ID</option>
                                        {{-- @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach --}}
                                    </select>

                                    @if ($errors->has('role'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('role')[0] }}</strong></small>
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

    <!-- Edit allowance Modal -->
    <div id="edit_performance_review" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Performance</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="edit-form-performance-review" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Name  <span class="text-danger">*</span></label>
                                        <input class="form-control" id="edit-name-payslip-type" type="text" name="name" placeholder="Enter Appraisal Name">

                                        @if ($errors->has('name'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('name')[0] }}</strong></small>
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
    <div class="modal custom-modal fade" id="delete_performance_review" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Performance</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <form action="" id="form-delete-performance-review" method="POST">
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



