


    <!-- Add timesheet Modal -->
<div id="add_timesheet" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Timesheet</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('timesheets.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
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
                                        <option value="0">Change Employee ID</option>
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

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="project_stage_id" class="control-label" required>Project stage</label>
                                <select  class="form-control select-project-stage-add" name="project_stage" id="project_stage_add" >
                                    <option value="0">Select </option>
                                    <option value="Dinas Luar Kota">Dinas Luar Kota </option>
                                    <option value="Dinas Dalam Kota">Dinas Dalam Kota </option>
                                </select>

                                @if ($errors->has('project_stage'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('project_stage')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Task / Project </label>
                                <input type="text" name="task_or_project" id="task_or_project" class="form-control " required>

                                @if ($errors->has('task_or_project'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('task_or_project')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>


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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Activity</label>
                                <input type="text" name="activity" id="activity" class="form-control " required>

                                @if ($errors->has('activity'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('activity')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Client Company</label>
                                <input type="text" name="client_company" id="client_company" class="form-control " required>

                                @if ($errors->has('client_company'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('client_company')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Label Project</label>
                                <input type="text" name="label_project" id="label_project" class="form-control " required>

                                @if ($errors->has('label_project'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('label_project')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Support</label>
                                <input type="text" name="support" id="support" class="form-control " required>

                                @if ($errors->has('support'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('support')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>File Attachment</label>
                                <input class="form-control" type="file" id="formFile" name="attachment">

                                @if ($errors->has('attachment'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('attachment')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                       

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remark </label>
                                <textarea name="remark" id="remark" cols="30" rows="2" class="form-control"></textarea>

                                @if ($errors->has('remark'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('remark')[0] }}</strong></small>
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
<!-- /Add timesheet Modal -->

<!-- Edit timesheet Modal -->
<div id="edit_timesheet" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit On Duty</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="edit-form-timesheet" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="religion" class="control-label" required>Employee ID </label>
                                <select  class="form-control select-employee-edit" name="employee_id" id="employee_id_edit" required>
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

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="project_stage_id" class="control-label" required>Project Stage </label>
                                <select  class="form-control select-project-stage-edit" name="project_stage" id="project_stage_edit" >
                                    <option value="0">Select </option>
                                    <option value="Dinas Luar Kota">Dinas Luar Kota </option>
                                    <option value="Dinas Dalam Kota">Dinas Dalam Kota </option>
                                </select>

                                @if ($errors->has('project_stage'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('project_stage')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Task / Project </label>
                                <input type="text" name="task_or_project" id="task_or_project_edit" class="form-control " required>

                                @if ($errors->has('task_or_project'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('task_or_project')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Start Date </label>
                                <input type="date" name="start_date" id="start_date_edit" class="form-control " placeholder="Start Date" required>

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
                                <input type="date" name="end_date" id="end_date_edit" class="form-control " placeholder="End Date" required>

                                @if ($errors->has('end_date'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('end_date')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Activity</label>
                                <input type="text" name="activity" id="activity_edit" class="form-control " required>

                                @if ($errors->has('activity'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('activity')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Client Company</label>
                                <input type="text" name="client_company" id="client_company_edit" class="form-control " required>

                                @if ($errors->has('client_company'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('client_company')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Label Project</label>
                                <input type="text" name="label_project" id="label_project_edit" class="form-control " required>

                                @if ($errors->has('label_project'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('label_project')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Support</label>
                                <input type="text" name="support" id="support_edit" class="form-control " required>

                                @if ($errors->has('support'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('support')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>File Attachment</label>
                                <input class="form-control" type="file" id="attachment_edit" name="attachment">
                                <a target="_blank" href="" id="file-attachment-see"></a>

                                @if ($errors->has('attachment'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('attachment')[0] }}</strong></small>
                                </div>
                            @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remark </label>
                                <textarea name="remark" id="remark_edit" cols="30" rows="2" class="form-control"></textarea>

                                @if ($errors->has('remark'))
                                <div class="text-danger" role="alert">
                                    <small><strong>{{ $errors->get('remark')[0] }}</strong></small>
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
                                        <input class="form-control" type="file" id="formFile" name="attachment_rejected">
                                <a target="_blank" href="" id="attachment-rejected-see"></a>

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
<div class="modal custom-modal fade" id="delete_timesheet" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete On Duty</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <form action="" id="form-delete-timesheet" method="POST">
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

<!-- Add timesheet Modal -->
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
                    <input hidden type="text" name="menu" id="" value="timesheet">
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



