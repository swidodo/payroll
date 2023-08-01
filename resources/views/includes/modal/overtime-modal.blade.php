


    <!-- Add overtime Modal -->
<div id="add_overtime" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Overtime</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('overtimes.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="religion" class="control-label" required>Employee ID </label>
                                <select  class="form-control select-employee" name="employee_id" id="employee_id_add" required>
                                    @if ( !is_null(Auth::user()->employee) )
                                        @foreach ($employee as $e)
                                            @if ($e->id == Auth::user()->employee->id)
                                                <option value="{{$e->id}}"  selected>{{$e->name}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="0">Change Employee</option>
                                        @foreach ($employee as $e)
                                            <option value="{{$e->id}}">{{$e->no_employee." - ".$e->name}}</option>
                                        @endforeach
                                    @endif
                                </select>

                                @if ($errors->has('employee_id'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('employee_id')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Date </label>
                                <input type="date" name="start_date" id="startdate" class="form-control " placeholder="Start Date" required>

                                @if ($errors->has('start_date'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                    </div>
                                @endif
                            </div>
                        </div> --}}

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date </label>
                                <input type="date" name="end_date" id="enddate" class="form-control " placeholder="End Date" required>

                                @if ($errors->has('end_date'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('end_date')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>



                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="religion" class="control-label" required>Overtime Type </label>
                                <select class="form-control  select-overtime" name="overtime_type_id" id="overtime_id_add" required >
                                    <option value="" selected>Change Overtime Type</option>
                                    @foreach ($overtimeTypes as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('overtime_type_id'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('overtime_type_id')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div> --}}


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Start Time </label>
                                <input type="text" name="start_time" id="time_add" class="form-control" placeholder="00:00" required>

                                @if ($errors->has('start_time'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('start_time')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End Time </label>
                                <input type="text" name="end_time" id="time_add" class="form-control" placeholder="00:00" required>

                                @if ($errors->has('end_time'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('end_time')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="religion" class="control-label" required="">Day type </label>
                                <select class="form-control  select-day-type" name="day_type_id" id="daytype_id_add" required >
                                    <option value="" selected>Change Day Type</option>
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
                        </div>
                            {{-- <div class="form-group">
                            <label>duration </label>
                            <input type="text" name="duration" id="duration" class="form-control " placeholder="duration" required>
                            </div> --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Notes </label>
                                    <input type="text" name="notes" id="notes" class="form-control " placeholder="notes">

                                    @if ($errors->has('notes'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('notes')[0] }}</strong></small>
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
<div id="edit_overtime" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Overtime</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="edit-form-overtime" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="religion" class="control-label" required>Employee</label>
                                <select class="form-control select-employee-edit" name="employee_id" id="employee_id_edit" required>
                                    @if ( !is_null(Auth::user()->employee) )
                                        @foreach ($employee as $e)
                                                <option value="{{$e->id}}">{{$e->name}}</option>
                                        @endforeach
                                    @else
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
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Date </label>
                                <input type="date" name="start_date" id="start_date_edit" class="form-control " placeholder="Start Date" required>

                                @if ($errors->has('start_date'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                    </div>
                                @endif
                            </div>
                        </div> --}}

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date </label>
                                <input type="date" name="end_date" id="end_date_edit" class="form-control " placeholder="End Date" required>

                                @if ($errors->has('end_date'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('end_date')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="religion" class="control-label" required>Overtime Type </label>
                                <select class="form-control  select-overtime-edit" name="overtime_type_id" id="overtime_id_edit" required >
                                    <option value="0" selected>Change Overtime Type</option>
                                    @foreach ($overtimeTypes as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('overtime_type_id'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('overtime_type_id')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div> --}}



                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Start Time </label>
                                <input type="text" name="start_time" id="start_time_edit" class="form-control " placeholder="01:00 - 23:59" required>

                                @if ($errors->has('start_time'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('start_time')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>End Time </label>
                                <input type="text" name="end_time" id="end_time_edit" class="form-control " placeholder="01:00 - 23:59" required>

                                @if ($errors->has('end_date'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('end_date')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="religion" class="control-label" required="">Day type </label>
                                <select class="form-control  select-day-type-edit" name="day_type_id" id="day_type_id_edit" required >
                                    <option value="0" selected>Change Day Type</option>
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
                        </div>
                            {{-- <div class="form-group">
                            <label>duration </label>
                            <input type="text" name="duration" id="duration" class="form-control " placeholder="duration" required>
                            </div> --}}

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Notes </label>
                                <input type="text" name="notes" id="notes_edit" class="form-control " placeholder="notes">

                                @if ($errors->has('notes'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('notes')[0] }}</strong></small>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group" id="approver" style="display: none">
                                <label for="status" class="form-label">Approved By</label>
                                <div class="wrapper-approver">

                                </div>
                            </div>

                            <div class="form-group" id="form-status" style="display: none">
                                <label for="status" class="form-label">Status</label>
                                <input hidden type="text" name="level_approve" id="level_approve" value="">
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
                                    <input class="form-control" type="file" id="formFile" name="attachment_reject">
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
<!-- /Edit User Modal -->

<!-- Delete User Modal -->
<div class="modal custom-modal fade" id="delete_overtime" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Overtime</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <form action="" id="form-delete-overtime" method="POST">
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
                    <input hidden type="text" name="menu" id="" value="overtimes">
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
                        <button type="submit" class="btn btn-primary">Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add User Modal -->



