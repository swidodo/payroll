
<form id="formovertime" method="POST">
                               <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date </label>
                                            <input type="date" name="start_date" id="start_date_overtime" class="form-control" required>

                                            @if ($errors->has('start_date'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('start_date')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="religion" class="control-label" required="">Day type </label>
                                            <select class="form-control  select-day-type" name="day_type_id" id="daytype_id_overtime"  required>
                                            </select>

                                            @if ($errors->has('day_type_id'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('day_type_id')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Time </label>
                                            <input type="time" name="start_time" id="time_start_overtime" class="form-control" placeholder="00:00" required>

                                            @if ($errors->has('start_time'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('start_time')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Time </label>
                                            <input type="time" name="end_time" id="time_end_overtime" class="form-control" placeholder="00:00" required>

                                            @if ($errors->has('end_time'))
                                            <div class="text-danger" role="alert">
                                                <small><strong>{{ $errors->get('end_time')[0] }}</strong></small>
                                            </div>
                                        @endif
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Notes </label>
                                                <input type="text" name="notes" id="notes_overtime" class="form-control " placeholder="notes">

                                                @if ($errors->has('notes'))
                                                <div class="text-danger" role="alert">
                                                    <small><strong>{{ $errors->get('notes')[0] }}</strong></small>
                                                </div>
                                            @endif
                                            </div>
                                        </div>
                                </div>
                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                </div>
                            </form>