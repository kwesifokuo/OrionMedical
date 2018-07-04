  <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('medication_no_available') ? ' has-error' : ''}}">
                          <label>Medication Name</label>
                          <input type="text" class="form-control" id="medication_no_available" name="medication_no_available" value="{{ Request::old('medication_no_available') ?: '' }}"> 
                          @if ($errors->has('medication_no_available'))
                          <span class="help-block">{{ $errors->first('medication_no_available') }}</span>
                           @endif                            
                        </div>
                        </div>
                        </div>



                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('medication_no_remark') ? ' has-error' : ''}}">
                          <label>Dosage Remark</label>
                          <input type="text" class="form-control" id="medication_no_remark" name="medication_no_remark" value="{{ Request::old('medication_no_remark') ?: '' }}"> 
                          @if ($errors->has('medication_no_remark'))
                          <span class="help-block">{{ $errors->first('medication_no_remark') }}</span>
                           @endif                            
                        </div>
                        </div>
                        </div>

                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('medication_no_days') ? ' has-error' : ''}}">
                          <label>Number of Days</label>
                          <input type="text" class="form-control" id="medication_no_days" name="medication_no_days" value="{{ Request::old('medication_no_days') ?: '' }}"> 
                          @if ($errors->has('medication_no_days'))
                          <span class="help-block">{{ $errors->first('medication_no_days') }}</span>
                           @endif                            
                        </div>
                        </div>
                        </div>



                

                                     <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addNoAvailableDrug()" class="btn btn-success btn-s-xs">Add Medication</button>
                      </footer>