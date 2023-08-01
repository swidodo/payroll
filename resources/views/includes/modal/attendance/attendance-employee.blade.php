
    <!-- Import attendance Modal -->
    <div id="getDataEmployee" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Employee Attendance</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="table-responsive">
                            <table class="table table-sm table-strip table-hover table-bordered" id="setFilterattandaceList">
                                <thead>
                                    <th><input type="checkbox" class="disabled" disabled></th>
                                    <th>Employee ID</th>
                                    <th>Name</th>
                                    {{-- <th>Department</th> --}}
                                    <th>Branch</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-4" id="setSearch">Set To Search</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Import User Modal -->
