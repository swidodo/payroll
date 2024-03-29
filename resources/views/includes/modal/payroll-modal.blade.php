    <!-- Add overtime Modal -->
    <div id="add_payroll" class="modal custom-modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Set Payroll</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="payroll_submit" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Employee <span class="text-danger">*</span></label>
                                    <select class="form-control select-employee" id="employee_id" name="employee_id">
                                    </select>
                                    <input type="hidden" name="branch_id" id="branchInput">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payslip_type_id">Payroll Status</label>
                                    <select name="payslip_type_id" id="payslip_type_id" class="form-control form-control-sm select-payroll-type">
                                        <option value="">-- payroll status --</option>
                                        @foreach ($payslipType as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                        @if ($errors->has('payslip_type_id'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('payslip_type_id')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount" class="form-label">Basic Salary</label>
                                    <input type="number" class="form-control" placeholder="Amount" name="amount_salary"  id="amount">

                                        @if ($errors->has('amount'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('amount')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-4">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Select Allowance Type</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAllEdit">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Select All
                                            </label>
                                        </div>
                                        <hr />
                                    </div>
                                    <div id="ListAllowance"></div>                                   
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                         <div class="row">
                                            <div class="col-md-3">
                                                <label>BPJS NORMATIF</label>
                                            </div>
                                        </div>
                                        <hr />
                                    </div>
                                    <div class="row mx-4">
                                        <div class="row" id="ListBpjs">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="checkbox" id="customeBpjs" name="unnormatif_bpjs" value="unnormatif" class="form-check-input" >
                                            <label>BPJS UNNORMATIF</label>
                                        </div>
                                        <hr />
                                        <div id="costumeView"></div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="checkbox" name="pph21" value="1" class="form-check-input" >
                                            <label>PPH21</label>
                                        </div>
                                        <hr />
                                        <div id="costumeView"></div>
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
    <!-- /Add User Modal -->

    <!-- Edit Overtime Modal -->
    <div id="edit_payroll" class="modal custom-modal fade"  id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Set Payroll</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="update-payroll" method="POST">
                        <input type="hidden" name="id" id="editId">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Employee <span class="text-danger">*</span></label>
                                        <select class="form-control" id="employee_id_edit" name="employee_id">
                                        </select>
                                        <input type="hidden" name="branch_id" id="editbranchInput">

                                        @if ($errors->has('employee_id'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('employee_id')[0] }}</strong></small>
                                            </div>
                                        @endif
                                    </div>

                                <div class="form-group">
                                    <label for="payslip_type_id" class="form-label">Payslip Type</label>
                                        <select name="payslip_type_id" id="payslip_type_id_edit" class="form-control">
                                    </select>

                                        @if ($errors->has('payslip_type_id'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('payslip_type_id')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>

                                <div class="form-group">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" class="form-control" placeholder="Amount" name="amount_salary"  id="amount_edit">

                                        @if ($errors->has('amount'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('amount')[0] }}</strong></small>
                                            </div>
                                        @endif
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mt-4">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label>Select Allowance Type</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Select All
                                                    </label>
                                                </div>
                                                <hr />
                                            </div>
                                            <div id="list-allowance"></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label>BPJS</label>
                                                <hr />
                                            </div>
                                            <div class="row mx-4">
                                                <div class="row" id="bpjs-list">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-12">
                                            <input type="checkbox" id="edit-customeBpjs" name="unnormatif_bpjs" value="unnormatif" class="form-check-input" >
                                            <label>BPJS UNNORMATIF</label>
                                        </div>
                                        <hr />
                                        <div id="editcostumeView"></div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="checkbox" id="status_pph21" name="pph21" value="1" class="form-check-input" >
                                            <label>PPH21</label>
                                        </div>
                                        <hr />
                                        
                                    </div>
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

    <!-- view User Modal -->
    <div class="modal custom-modal fade" id="view_payroll" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Data Payroll</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <table>
                            {{-- <tr>
                                <td width="50%">Employee Code</td>
                                <td>:</td>
                                <td id="empCode">:</td>
                            </tr> --}}
                            <tr>
                                <td width="50%">Employee ID</td>
                                <td>:</td>
                                <td id="empID">:</td>
                            </tr>
                            <tr>
                                <td width="50%">Employee Name</td>
                                <td>:</td>
                                <td id="empName">:</td>
                            </tr>
                            <tr>
                                <td width="50%">Salary Type</td>
                                <td>:</td>
                                <td id="empSalaryType">:</td>
                            </tr>
                            <tr>
                                <td>Basic Salary</td>
                                <td>:</td>
                                <td id="empSalary">:</td>
                            </tr>
                        </table>
                        <hr />
                            ALLOWANCE
                        <hr />
                        <table id="allowanceDtl" class="mb-4">
                            
                        </table>
                        <hr />
                        <table>
                            <tr>
                            <td width="50%">TOTAL</td>
                            <td>:</td>
                            <td><i id="total" class="fw-bold"></i>
                            </td>
                        </tr> 
                         </table>
                        <hr />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /view User Modal -->


