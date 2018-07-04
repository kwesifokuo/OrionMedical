<p><section class="panel panel-default">
                      <div class="panel-body">
                      <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Ward Number</label> 
                            <div class="form-group{{ $errors->has('ward_number') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" readonly="true" id="ward_number" name="ward_number" value="{{ Request::old('ward_number') ?: '' }}">   
                           @if ($errors->has('ward_number'))
                          <span class="help-block">{{ $errors->first('ward_number') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('ward_name') ? ' has-error' : ''}}">
                            <label>Ward Name</label>
                            <input type="text" rows="3" class="form-control" id="ward_name" name="ward_name" value="{{ Request::old('ward_name') ?: '' }}">      
                           @if ($errors->has('ward_name'))
                          <span class="help-block">{{ $errors->first('ward_name') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Ward Location</label> 
                            <div class="form-group{{ $errors->has('ward_location') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="ward_location" name="ward_location" value="{{ Request::old('ward_location') ?: '' }}">   
                           @if ($errors->has('ward_location'))
                          <span class="help-block">{{ $errors->first('ward_location') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('total_beds') ? ' has-error' : ''}}">
                            <label>Total Beds</label>
                            <input type="text" rows="3" class="form-control" id="total_beds" name="total_beds" value="{{ Request::old('total_beds') ?: '' }}">      
                           @if ($errors->has('total_beds'))
                          <span class="help-block">{{ $errors->first('total_beds') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Ward Rate</label> 
                            <div class="form-group{{ $errors->has('ward_rate') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="ward_rate" name="ward_rate" value="{{ Request::old('ward_rate') ?: '' }}">   
                           @if ($errors->has('ward_rate'))
                          <span class="help-block">{{ $errors->first('ward_rate') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                      
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Update Ward</button>
                      </footer>
                    </section></p>