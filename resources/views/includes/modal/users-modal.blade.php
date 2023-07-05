    <!-- Add User Modal -->
    <div id="add_user" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('users.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" placeholder="Enter Username">

                                    @if ($errors->has('name'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('name')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input class="form-control" type="email" name="email" placeholder="Enter User Email">

                                    @if ($errors->has('email'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('email')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" name="password" placeholder="Enter User Password">

                                    @if ($errors->has('password'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('password')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>User Role</label>
                                    <select class="select-role" name="role">
                                        <option value="0" selected>Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('role'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('role')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Branch</label>
                                    <select class="select-branch"  name="branch_id">
                                        <option value="0" selected>Select Branch</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('branch_id'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('branch_id')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Employee Type</label>
                                    <select class="select-employee-type"  name="employee_type" id="employee_type" required>
                                        <option value="0" selected>Select Type</option>
                                        <option value="jobholder" >Jobholder</option>
                                        <option value="outsourcing" >Outsourcing</option>
                                        <option value="parttime" >Part-time</option>
                                        <option value="freelancers" >Freelancers</option>
                                    </select>

                                    @if ($errors->has('employee_type'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('employee_type')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6" id="section-doj"
                             {{-- style="display: none" --}}
                             >
                                <div class="form-group">
                                    <label>Date Join</label>
                                        <input class="form-control" name="doj" id="doj" type="date">
                                    @if ($errors->has('doj'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('doj')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6" id="section-doe" 
                            {{-- style="display: none" --}}
                            >
                                <div class="form-group">
                                    <label>Date End</label>
                                        <input class="form-control" name="doe" id="doe" type="date">

                                    @if ($errors->has('doe'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('doe')[0] }}</strong></small>
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

    <!-- Edit User Modal -->
    <div id="edit_user" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="edit-form-user" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="edit-name" type="text" name="name" placeholder="Enter Username">

                                    @if ($errors->has('name'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('name')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input class="form-control" id="edit-email" type="email" name="email" placeholder="Enter User Email">

                                    @if ($errors->has('email'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('email')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>User Role</label>
                                    <select class="select-role-edit" id="edit-role" name="role">
                                        <option value="0">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('role'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('role')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Branch</label>
                                    <select class="select-branch-edit" id="branch-id-edit"   name="branch_id">
                                        <option value="0"  selected>Select Branch</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('branch_id'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('branch_id')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6" id="section-doj-edit" >
                                <div class="form-group">
                                    <label>Date Join</label>
                                        <input readonly class="form-control" name="doj" id="doj-edit" type="date">
                                    @if ($errors->has('doj'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('doj')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6" id="section-doe-edit" >
                                <div class="form-group">
                                    <label>Date End</label>
                                        <input class="form-control" name="doe" id="doe-edit" type="date">

                                    @if ($errors->has('doe'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('doe')[0] }}</strong></small>
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
    <div class="modal custom-modal fade" id="delete_user" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete User</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <form action="" id="user-delete-form" method="POST">
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



