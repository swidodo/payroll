    <!-- Add overtime Modal -->
    <div id="add_allowance" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Allowance</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('allowances.store')}}" method="POST">
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
                                    <label for="allowance_type_id" class="form-label">Type</label>
                                    <select name="allowance_type_id" id="allowance_type_id" class="form-control select-allowance-type">
                                        <option value="0">Select Allowance Type</option>
                                        @foreach ($allowanceTypes as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                        @if ($errors->has('allowance_type_id'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('allowance_type_id')[0] }}</strong></small>
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
    <div id="edit_allowance" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Allowance</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="edit-form-allowance" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12">
                                {{-- @if (Auth::user()->type == 'company') --}}
                                    <div class="form-group">
                                        <label>Employee <span class="text-danger">*</span></label>
                                        <select class="form-control select-employee-edit" id="employee_id_edit" name="employee_id">
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
                                    <label for="allowance_type_id" class="form-label">Type</label>
                                    <select name="allowance_type_id" id="allowance_type_id_edit" class="form-control select-allowance-type-edit">
                                        <option value="0">Select Allowance Type</option>
                                        @foreach ($allowanceTypes as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                        @if ($errors->has('allowance_type_id'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('allowance_type_id')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>

                                <div class="form-group">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" placeholder="Amount" name="amount"  id="amount-edit">

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
    <!-- /Edit User Modal -->

    <!-- Delete User Modal -->
    <div class="modal custom-modal fade" id="delete_allowance" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Allowance</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <form action="" id="form-delete-allowance" method="POST">
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



