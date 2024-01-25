<div class="modal fade" id="ExportExcelModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Form Report Employee</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action = "{{route('excel-employee.export')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-4">
                    <label>Branch</label>
                    <select class="form-select form-control" name="branch_id">
                        @foreach($branch as $br)
                          <option value="{{ $br->id }} ">{{ $br->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-4">
                  <label>Status</label>
                  <select class="form-select form-control" name="status">
                     <option value="active">Active</option>
                     <option value="resign">Resign</option>
                     <option value="fired">Fired</option>
                     <option value="pension">Pension</option>
                  </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Export</button>
        </div>
    </form>
      </div>
    </div>
  </div>
