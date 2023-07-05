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
                    <form action="{{route('reimburst.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                {{-- @if (Auth::user()->type == 'company') --}}
                                    <div class="form-group">
                                        <label>Employee <span class="text-danger">*</span></label>
                                        <select class="form-control select-employee" id="employee_id" name="employee_id">
                                            @if ( !is_null(Auth::user()->employee) )
                                                @foreach ($employee as $e)
                                                    @if ($e->id == Auth::user()->employee->id)
                                                        <option value="{{$e->id}}" selected>{{$e->name}}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                <option value="0">Select Employee</option>
                                                @foreach ($employee as $e)
                                                    <option value="{{$e->id}}">{{$e->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @if ($errors->has('employee_id'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('employee_id')[0] }}</strong></small>
                                            </div>
                                        @endif
                                    </div>
                                {{-- @endif --}}

                                <div class="form-group">
                                    <label for="reimburst_type_id" class="form-label">Reimburst Type</label>
                                    <select name="reimburst_type_id" id="reimburst_type_id" class="form-control select-reimburst-type">
                                        <option value="0">Select Reimburst Type</option>
                                        @foreach ($reimburstType as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>

                                        @if ($errors->has('reimburst_type_id'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('reimburst_type_id')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>

                                <div class="form-group">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" placeholder="Amount" name="amount"  id="amount">

                                        @if ($errors->has('amount'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('amount')[0] }}</strong></small>
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
                    <h5 class="modal-title">Edit Leave</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="edit-form-leave" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Employee <span class="text-danger">*</span></label>
                                        <select  class="form-control select-employee-edit" id="employee_id_edit" name="employee_id">
                                            @foreach ($employee as $e)
                                                @if (!is_null(Auth::user()->employee))
                                                    @if ($e->id == Auth::user()->employee->id)
                                                        <option value="{{$e->id}}" selected>{{$e->name}}</option>
                                                    @endif
                                                @elseif (is_null(Auth::user()->employee))
                                                    <option value="{{$e->id}}">{{$e->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @if ($errors->has('employee_id'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('employee_id')[0] }}</strong></small>
                                            </div>
                                        @endif
                                    </div>

                                <div class="form-group">
                                    <label for="leave_type_id" class="form-label">Leave Type</label>
                                    <select name="leave_type_id" id="leave_type_id_edit" class="form-control select-reimburst-type-edit">
                                        <option value="0">Select Leave Type</option>
                                        @foreach ($reimburstType as $type)
                                        <option value="{{$type->id}}">{{$type->title.'('.$type->days.')'}}</option>
                                        @endforeach
                                    </select>

                                        @if ($errors->has('employee_id'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('employee_id')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input class="form-control" name="start_date" type="date" id="start_date_edit">

                                            @if ($errors->has('start_date'))
                                                <div class="text-danger" role="alert">
                                                    <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input class="form-control" name="end_date" type="date" id="end_date_edit">
                                        </div>

                                        @if ($errors->has('end_date'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('end_date')[0] }}</strong></small>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="leave_reason" class="form-label">Leave Reason</label>
                                    <textarea class="form-control" placeholder="Leave Reason" name="leave_reason" cols="50" rows="3" id="leave_reason_edit"></textarea>

                                    @if ($errors->has('leave_reason'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('leave_reason')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>
                                @if (Auth::user()->type == 'company')
                                    <div class="form-group">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status_edit" class="form-control">
                                            <option value="0">Select Status</option>
                                            <option value="Approved">Approve</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Rejected">Reject</option>
                                        </select>

                                            @if ($errors->has('status'))
                                                <div class="text-danger" role="alert">
                                                    <small><strong>{{ $errors->get('employee_id')[0] }}</strong></small>
                                                </div>
                                            @endif
                                    </div>
                                    <div class="form-group" id="rejected-reason" style="display: none">
                                        <label for="rejected_reason" class="form-label">Rejected Reason</label>
                                        <textarea class="form-control" placeholder="Rejected Reason" name="rejected_reason" cols="30" rows="3" id="rejected_reason_edit"></textarea>

                                        <div class="mt-3">
                                            <label for="formFile" class="form-label">Attachment (opsional)</label> &nbsp; <span class="text-muted" style="font-size: 10px">pdf, jpg, jpeg, png</span>
                                            <input name="attachment_reject" class="form-control" type="file" id="attachment_rejected_edit">
                                            <a href="" id="attachment_rejected_edit_anchor"></a>
                                        </div>
                                    </div>
                                @endif
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
    <div class="modal custom-modal fade" id="delete_reimburst" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Leave</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <form action="" id="form-delete-leave" method="POST">
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



