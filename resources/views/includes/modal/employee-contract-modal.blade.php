<div class="modal fade" id="ContractModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Form Contract Employee</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          	<form id="formUpdateContract">
				<div class="row">
					<div class="form-group col-md-6">
						<label for="name" class="form-label">Employee ID</label><span class="text-danger pl-1">*</span>
						<input class="form-control" id="edit-employee_id-contract" type="text">
						<input type="hidden" id="edit-employee-id" type="text" name="employee_id">
						<input type="hidden" id="id_contract" type="text" name="id">
					</div>
					<div class="form-group col-md-6">
						<label for="name" class="form-label">Employee Name</label><span class="text-danger pl-1">*</span>
						<input class="form-control" id="edit-employee_name-contract"  type="text">
					</div>
					<div class="form-group col-md-6">
						<label for="name" class="form-label">Start date</label><span class="text-danger pl-1">*</span>
						<input class="form-control" id="edit-start-date-contract" type="date" name="start_date">
					</div>
					<div class="form-group col-md-6">
						<label for="phone" class="form-label">End date</label><span class="text-danger pl-1">*</span>
						<input class="form-control" id="edit-end-date-contract" type="date" name="end_date">
					</div>
					<div class="form-group col-md-6">
						<label for="phone" class="form-label">Type</label><span class="text-danger pl-1">*</span>
						<select class="form-control form-select" name="contract_type" id="edit-type-contract">
							<option value="">--Select -- </option>
							<option value="PKWT">PKWT</option>
							<option value="PKWTT">PKWTT</option>
						</select>
					</div>
				</div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
    	</form>
      </div>
    </div>
  </div>
