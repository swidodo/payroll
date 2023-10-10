
    <!-- Import attendance Modal -->
    <div id="add_import" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-l" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Attendance</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('import.excel.attendace')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>File <span class="text-danger">*</span></label>
                                    <input class="form-control" type="file" name="file-excel">
                                    <a style="font-size: 11px;" download href="{{asset('file/template-excel-attendance/AttendanceReport.xlsx')}}">Click here for template</a>

                                    @if ($errors->has('file-excel'))
                                    <div class="text-danger" role="alert">
                                        <small><strong>{{ $errors->get('file-excel')[0] }}</strong></small>
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
    <!-- /Import User Modal -->


    <!-- Edit Branch Modal -->
    <div id="edit_attendance" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Attendance</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="edit-form-attendance" method="POST">
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion" class="control-label" required>Employee ID </label>
                                        <input type="text" class="form-control " name="no_employee" id="noEmployee" readonly>
                                        <input type="hidden" name="id" id="Id">
                                        <input type="hidden" name="employee_id" id="EmployeeId">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion" class="control-label" required>Employee Name</label>
                                        <input type="text" class="form-control " name="no_employee" id="nameEmployee" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion" class="control-label" required>Date </label>
                                        <input class="form-control" name="date" type="date" value="" id="date-edit">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion" class="control-label" required>Clock In </label>
                                        <input class="form-control " name="clock_in" type="time" value="" id="clock_in">

                                        {{-- @if ($errors->has('clock_in'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('clock_in')[0] }}</strong></small>
                                        </div>
                                    @endif --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion" class="control-label" required>Clock Out </label>
                                        <input class="form-control " name="clock_out" type="time" value="" id="clock_out">

                                        {{-- @if ($errors->has('clock_out'))
                                        <div class="text-danger" role="alert">
                                            <small><strong>{{ $errors->get('clock_out')[0] }}</strong></small>
                                        </div>
                                    @endif --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion" class="control-label" required>Status</label>
                                        <select class="form-control form-select" id="editStatus" name="status">
                                            <option value="Present">Present</option>
                                            <option value="Alpha">Alpha</option>
                                            <option value="Leave">Leave</option>
                                            <option value="Sick">Sick</option>
                                            <option value="Permit">Permit</option>
                                            <option value="Dispensation">Dispensation</option>
                                        </select>
                                    </div>
                                </div>
                               <!--  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="religion" class="control-label" required>upload file</label>
                                        <input type="file" class="form-control" name="upload_file" id="editFileUpload">
                                    </div>
                                </div> -->
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
    <div class="modal custom-modal fade" id="delete_attendance" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Attendance</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <form action="" id="form-delete-attendance" method="POST">
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



<!-- Add modal export Modal -->
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
                    <input hidden type="text" name="menu" id="" value="attendances">
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
<!-- /Add modal export Modal -->
