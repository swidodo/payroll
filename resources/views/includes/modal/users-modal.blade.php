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
                    <form  id="formAddUser">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" placeholder="Enter Name" required>

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
                                    <input class="form-control" type="email" name="email" placeholder="Enter User Email" required>

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
                                    <select class="select-role form-select form-control" name="role" id="role" required>
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
                                    <select class="form-select form-control" name="branch_id" id="addbranch_id" required>
                                        <option value="0" selected>Select Branch</option>
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
                                    <select class="form-select form-control"  name="employee_type" id="employee_type" required>
                                        <option value="" selected disabled>Select Type</option>
                                        <option value="permanent" >Permanent</option>
                                        <option value="probation" >Probation</option>
                                        <option value="contract" >Contract</option>
                                        <option value="outsourcing" >Outsourcing</option>
                                        <option value="hl" >Harian Lepas</option>
                                        <option value="magang" >Magang</option>
                                        <option value="freelancers" >Freelancers</option>
                                    </select>

                                    @if ($errors->has('employee_type'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('employee_type')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Placement</label>
                                    <select class="form-control form-select"  name="initial" required>
                                        <option value="" selected disabled>Select Type</option>
                                        @if(Auth::user()->initial =="HO")
                                            <option value="HO" >Head Office</option>
                                        @endif
                                        <option value="Null">Non Head Office</option>
                                    </select>

                                    @if ($errors->has('Placement'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('Placement')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6" id="section-doj" style="display: none">
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
                            <div class="col-sm-6" id="section-doe" style="display: none">
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" name="password" placeholder="Enter User Password" required>
                                    <div class="text-small" id="errpass"></div>
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
    <div id="edit_usermodal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editFormUser">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="editname" type="text" name="name" placeholder="Enter Username" required>
                                    <input id="id" name="id" type="hidden">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input class="form-control" id="edit-email" type="email" name="email" placeholder="Enter User Email" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>User Role</label>
                                    <select class="form-control form-select" id="editrole" name="role" required>
                                        <option value="0">Select Role</option>
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
                                    <select class="form-select form-control" id="branch-id-edit" name="branch_id" required>
                                    </select>

                                    @if ($errors->has('branch_id'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('branch_id')[0] }}</strong></small>
                                    </div>
                                    @endif
                                </div>
                            </div>
                           <!--  <div class="col-sm-6" id="section-doj-edit" >
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
                            </div> -->
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit User Modal -->


