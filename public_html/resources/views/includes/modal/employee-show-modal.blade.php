    <!-- Show Experience Modal -->
    <div id="show-experience" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Experience</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php
                        $no=1;
                    @endphp
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Sequence</th>
                                <th>Job</th>
                                <th>Position</th>
                                <th>City</th>
                                <th>Reason Leaving</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($employeeExperiences as $experience)
                          <tr>
                            <th>{{$no++}}</th>
                            <td>{{$experience->start_date}}</td>
                            <td>{{$experience->end_date}}</td>
                            <td>{{$experience->sequence}}</td>
                            <td>{{$experience->job}}</td>
                            <td>{{$experience->position}}</td>
                            <td>{{$experience->city}}</td>
                            <td>{{$experience->reason_leaving}}</td>
                            <td title="{{$experience->address}}">{{ strlen($experience->address) > 10 ? substr($experience->address, 10) : $experience->address}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Show Experience Modal -->
