


    <!-- Add overtime type Modal -->
    <div id="add_shift_type" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('shift-type.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Name  <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" placeholder="Enter Day Type Name">

                                    @if ($errors->has('name'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('name')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Day Type  <span class="text-danger">*</span></label>
                                    <select class=" select-day-type-edit" id="" name="day_type_id">
                                        <option value="0">Select Day Type</option>
                                        @foreach ($dayTypes as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('day_type_id'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('day_type_id')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Time  <span class="text-danger">*</span></label>
                                            <div class="input-group date" id="timePicker">
                                                <input type="text" class="form-control timePicker">
                                                <span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                              </div>

                                            @if ($errors->has('start_time'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('start_time')[0] }}</strong></small>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Time  <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name" >

                                            @if ($errors->has('end_time'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('end_time')[0] }}</strong></small>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
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

    <!-- Edit day type Modal -->
    <div id="edit_shift_type" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Day Type</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="edit-form-shift-type" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Name  <span class="text-danger">*</span></label>
                                        <input class="form-control" id="edit-name-shift-type" type="text" name="name" placeholder="Enter Loan Option Name">

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

    <!-- Delete Day Modal -->
    <div class="modal custom-modal fade" id="delete_shift_type" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Cash in Advance</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <form action="" id="form-delete-shift-type" method="POST">
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



