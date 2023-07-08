<!-- Add  Modal -->
<div id="add_set_ptkp" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Set PTKP</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('set-ptkp.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Employee <span class="text-danger">*</span></label>
                                <select  class="form-control select-employee" name="employee_id" id="employee_id_add" required>
                                    @if ( !is_null(Auth::user()->employee) )
                                        @foreach ($employees as $e)
                                            @if ($e->id == Auth::user()->employee->id)
                                                <option value="{{$e->id}}"  selected>{{$e->name}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="0">Change Employee ID</option>
                                        @foreach ($employees as $e)
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
                        <div class="col-sm-12">
                            <div class="" id="pills-tabContent">
                                <div class="" id="pills-staff" role="tabpanel" aria-labelledby="pills-staff-tab">
                                    @php
                                         $modules=['tk_0', 'tk_1', 'tk_2', 'tk_3', 'k_0', 'k_1', 'k_2', 'k_3', 'ki0', 'ki1', 'ki2', 'ki3'];
                                    @endphp

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                        </th>
                                                        <th>PTKP</th>
                                                    </tr>
                                                    </thead>
                                                    @foreach ($modules as $module)
                                                        @php
                                                            $moduleMerged = $module;
                                                            $split = explode('_', $module);
                                                            if (count($split) > 1) {
                                                                $moduleMerged = $split[0].$split[1];
                                                            }
                                                        @endphp
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="col-md-3 custom-control custom-checkbox">
                                                                        <input class="form-check-input isscheck staff_checkall isscheck_" type="checkbox" name="ptkp[]" value="{{$module}}" id="">
                                                                    </div>
                                                                </td>
                                                                <td><label class="ischeck staff_checkall" data-id="{{str_replace(' ', '', str_replace('&', '', $module))}}">{{ strtoupper($moduleMerged) }}</label></td>
                                                            </tr>
                                                        </tbody>
                                                    @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add User Modal -->

<!-- Edit User Modal -->
<div id="edit_set_ptkp" class="modal custom-modal fade" role="dialog">≈
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Role</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-form-set-ptkp" action="" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Employee <span class="text-danger">*</span></label>
                                <select  class="form-control select-employee-edit" name="employee_id" id="employee_id_edit" required>
                                    @if ( !is_null(Auth::user()->employee) )
                                        @foreach ($employees as $e)
                                            @if ($e->id == Auth::user()->employee->id)
                                                <option value="{{$e->id}}"  selected>{{$e->name}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="0">Change Employee ID</option>
                                        @foreach ($employees as $e)
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
                        <div class="col-sm-12">
                            <div class="" id="pills-tabContent">
                                <div class="" id="pills-staff" role="tabpanel" aria-labelledby="pills-staff-tab">
                                    @php
                                        $modules=['tk_0', 'tk_1', 'tk_2', 'tk_3', 'k_0', 'k_1', 'k_2', 'k_3', 'ki0', 'ki1', 'ki2', 'ki3'];
                                    @endphp

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                        </th>
                                                        <th>PTKP</th>
                                                    </tr>
                                                    </thead>
                                            @foreach ($modules as $module)
                                                        @php
                                                            $moduleMerged = $module;
                                                            $split = explode('_', $module);
                                                            if (count($split) > 1) {
                                                                $moduleMerged = $split[0].$split[1];
                                                            }
                                                        @endphp
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="col-md-3 custom-control custom-checkbox">
                                                                    <input class="form-check-input isscheck staff_checkall isscheck_" type="checkbox" name="ptkp[]" value="{{$module}}" id="ptkp_edit_{{$module}}">
                                                                </div>
                                                            </td>
                                                            <td><label class="ischeck staff_checkall" data-id="{{str_replace(' ', '', str_replace('&', '', $module))}}">{{ strtoupper($module) }}</label></td>
                                                        </tr>
                                                    </tbody>
                                                    @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit User Modal -->

 <!-- Delete User Modal -->
 <div class="modal custom-modal fade" id="delete_set_ptkp" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Role</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <form action="" id="role-delete-form" method="POST">
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
