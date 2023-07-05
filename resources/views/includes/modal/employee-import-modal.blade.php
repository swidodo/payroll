<div class="modal fade" id="ImportExcelModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Form Import Employee</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action = "{{route('excel-employee.import')}}" method="POST" enctype="multipart/form-data">
            {{-- @csrf --}}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <label>Pilih data :</label>
                    <input type="file" name="upload_file" class="form-control">
                </div>
                <div class="mt-4">
                    <a href="{{URL::to('public/file/template-excel-employee/template-excel-employee.xlsx')}}"><p>Download Format Import Data</p></a>
                    Note : import harus tanpa format header
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Import Data</button>
        </div>
    </form>
      </div>
    </div>
  </div>
