    <!-- Add overtime Modal -->
    <div id="modal_pin" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-l" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enter PIN</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="form-pin">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="pin" class="form-label">PIN</label>
                                    <input type="password" class="form-control" placeholder="" name="pin"  id="pin" value="">

                                        @if ($errors->has('pin'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('pin')[0] }}</strong></small>
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