    <!-- Add overtime Modal -->
    <div id="add_dayoff" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Dayoff</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('dayoff.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            {{-- <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="payslip_type_id" class="form-label">Day</label>
                                    <select name="dayoff" id="payslip_type_id" class="form-control select-payroll-type">
                                        <option value="0" selected>Select Day</option>
                                        @foreach ($days as $day)
                                        <option value="{{$day}}">{{$day}}</option>
                                        @endforeach
                                    </select>

                                        @if ($errors->has('dayoff'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('dayoff')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>
                            </div> --}}
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" value="" name="date" id="date">

                                        @if ($errors->has('date'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('date')[0] }}</strong></small>
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

    <!-- Edit Overtime Modal -->
    <div id="edit_reimburst" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Leave</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="edit-form-dayoff" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            {{-- <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="payslip_type_id" class="form-label">Day</label>
                                    <select name="dayoff" id="dayoff_edit" class="form-control select-payroll-type">
                                        <option value="0" selected>Select Day</option>
                                        @foreach ($days as $day)
                                        <option value="{{$day}}">{{$day}}</option>
                                        @endforeach
                                    </select>

                                        @if ($errors->has('dayoff'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('dayoff')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>
                            </div> --}}
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" value="" name="date" id="date_edit">

                                        @if ($errors->has('date'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('date')[0] }}</strong></small>
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
    <div class="modal custom-modal fade" id="delete_dayoff" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Dayoff</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <form action="" id="form-delete-dayoff" method="POST">
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



