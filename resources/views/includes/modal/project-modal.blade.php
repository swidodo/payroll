    <!-- Add overtime Modal -->
    <div id="add_project" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Project</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('projects.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                {{-- @if (Auth::user()->type == 'company') --}}
                                    {{-- <div class="form-group">
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
                                    </div> --}}
                                {{-- @endif --}}

                                {{-- <div class="form-group">
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
                                </div> --}}

                                <div class="form-group">
                                    <label for="project_name" class="form-label">Project Name</label>
                                    <input type="text" class="form-control" placeholder="" name="project_name"  id="project_name_add">

                                        @if ($errors->has('project_name'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('project_name')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input class="form-control" name="start_date" type="date" id="start_date_add">

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
                                            <input class="form-control" name="end_date" type="date" id="end_date_add">
                                        </div>

                                        @if ($errors->has('end_date'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('end_date')[0] }}</strong></small>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="formFile" class="form-label">Project Image (optional)</label>
                                    <input name="project_image" class="form-control" type="file" id="project_image_add">
                                    <a href="" id="project_image_add_anchor"></a>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="client_name" class="form-label">Client</label>
                                            <input class="form-control" name="client_name" type="text" id="client_name_add">

                                            @if ($errors->has('client_name'))
                                                <div class="text-danger" role="alert">
                                                    <small><strong>{{ $errors->get('client_name')[0] }}</strong></small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="user_id" class="form-label">User</label>
                                            
                                            <select class="form-control select" id="employee_id" name="user_id">
                                                @if ( !is_null(Auth::user()) && Auth::user()->type != 'company')
                                                <option value="0">Select User</option>
                                                    @foreach ($users as $e)
                                                        @if ($e->id == Auth::user()->id)
                                                            <option value="{{$e->id}}" selected>{{$e->name}}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <option value="0">Select User</option>
                                                    @foreach ($users as $e)
                                                        <option value="{{$e->id}}">{{$e->name}}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                        </div>

                                        @if ($errors->has('user_id'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('user_id')[0] }}</strong></small>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="budget" class="form-label">Budget</label>
                                            <input class="form-control" name="budget" type="number" id="budget_add">

                                            @if ($errors->has('budget'))
                                                <div class="text-danger" role="alert">
                                                    <small><strong>{{ $errors->get('budget')[0] }}</strong></small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estimated_hours" class="form-label">
                                                Estimated Hours
                                            </label>
                                            <input class="form-control" name="estimated_hrs" type="number" id="estimated_hours_add">
                                        </div>

                                        @if ($errors->has('estimated_hours'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('estimated_hours')[0] }}</strong></small>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" placeholder="" name="description" cols="50" rows="3" id="description_add"></textarea>

                                    @if ($errors->has('description'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('description')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>

                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" name="status" id="status_add">
                                        <option value="in_progress">In Progress</option>
                                        <option value="on_hold">On Hold</option>
                                        <option value="completed">Completed</option>
                                        <option value="canceled">Canceled</option>
                                    </select>

                                    @if ($errors->has('status'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('status')[0] }}</strong></small>
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
    <div id="edit_project" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Project</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="edit-form-project" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12">
                                {{-- @if (Auth::user()->type == 'company') --}}
                                    {{-- <div class="form-group">
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
                                    </div> --}}
                                {{-- @endif --}}

                                {{-- <div class="form-group">
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
                                </div> --}}

                                <div class="form-group">
                                    <label for="project_name" class="form-label">Project Name</label>
                                    <input type="text" class="form-control" placeholder="" name="project_name"  id="project_name_edit">

                                        @if ($errors->has('project_name'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('project_name')[0] }}</strong></small>
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
                                    <label for="formFile" class="form-label">Project Image (optional)</label>
                                    <input name="project_image" class="form-control" type="file" id="project_image_edit">
                                    <a href="" id="project_image_edit_anchor"></a>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="client_name" class="form-label">Client</label>
                                            <input class="form-control" name="client_name" type="text" id="client_name_edit">

                                            @if ($errors->has('client_name'))
                                                <div class="text-danger" role="alert">
                                                    <small><strong>{{ $errors->get('client_name')[0] }}</strong></small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="budget" class="form-label">Budget</label>
                                            <input class="form-control" name="budget" type="number" id="budget_edit">

                                            @if ($errors->has('budget'))
                                                <div class="text-danger" role="alert">
                                                    <small><strong>{{ $errors->get('budget')[0] }}</strong></small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estimated_hours" class="form-label">
                                                Estimated Hours
                                            </label>
                                            <input class="form-control" name="estimated_hrs" type="number" id="estimated_hours_edit">
                                        </div>

                                        @if ($errors->has('estimated_hours'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('estimated_hours')[0] }}</strong></small>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" placeholder="" name="description" cols="50" rows="3" id="description_edit"></textarea>

                                    @if ($errors->has('description'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('description')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>

                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" name="status" id="status_edit">
                                        <option value="in_progress">In Progress</option>
                                        <option value="on_hold">On Hold</option>
                                        <option value="completed">Completed</option>
                                        <option value="canceled">Canceled</option>
                                    </select>

                                    @if ($errors->has('status'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('status')[0] }}</strong></small>
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
    <div class="modal custom-modal fade" id="delete_project" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Project</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <form action="" id="form-delete-project" method="POST">
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



