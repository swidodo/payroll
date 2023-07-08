    <!-- Add overtime Modal -->
    <div id="add_loan" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Loan</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('loans.store')}}" method="POST">
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
                                    <label for="loan_type_id" class="form-label">Loan Type</label>
                                    <select name="loan_type_id" id="loan_type_id" class="form-control select-cash-type">
                                        <option value="0">Select Loan Type</option>
                                        @foreach ($loanType as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>

                                        @if ($errors->has('loan_type_id'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('loan_type_id')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>

                                <label for="installment" class="form-label">Installment</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="Installment Plan" name="installment"  id="installment">
                                    <span class="input-group-text">X</span>

                                        @if ($errors->has('installment'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('installment')[0] }}</strong></small>
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

    <!-- Edit Overtime Modal -->
    <div id="edit_loan" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Leave</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="edit-form-loan" method="POST">
                        @method('PUT')
                        @csrf
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
                                    <label for="loan_type_id" class="form-label">Loan Type</label>
                                    <select name="loan_type_id" id="loan_type_id_edit" class="form-control select-cash-type-edit">
                                        <option value="0">Select Loan Type</option>
                                        @foreach ($loanType as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>

                                        @if ($errors->has('loan_type_id'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('loan_type_id')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>

                                <label for="installment" class="form-label">Installment</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="Installment Plan" name="installment"  id="installment-edit">
                                    <span class="input-group-text">X</span>

                                        @if ($errors->has('installment'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('installment')[0] }}</strong></small>
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
    <div class="modal custom-modal fade" id="delete_loan" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Loan</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <form action="" id="form-delete-loan" method="POST">
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



