<section class="panel panel-default">
                      <div class="panel-body">
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Fixed Income Name</label> 
                            <div class="form-group{{ $errors->has('accountnumber') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="accountnumber" name="accountnumber" value="{{ Request::old('accountnumber') ?: '' }}">   
                           @if ($errors->has('accountnumber'))
                          <span class="help-block">{{ $errors->first('accountnumber') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('postaladdress') ? ' has-error' : ''}}">
                            <label>Share Type</label>
                            <input type="text" rows="3" class="form-control" id="accounttype" name="accounttype" value="{{ Request::old('accounttype') ?: '' }}">      
                           @if ($errors->has('accounttype'))
                          <span class="help-block">{{ $errors->first('accounttype') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group">
                         <div class="form-group{{ $errors->has('fullname') ? ' has-error' : ''}}">
                          <label>Price</label>
                          <input type="text" class="form-control" id="fullname" value="{{ Request::old('fullname') ?: '' }}"  name="fullname">
                          @if ($errors->has('fullname'))
                          <span class="help-block">{{ $errors->first('fullname') }}</span>
                           @endif                        
                        </div>

                        <div class="form-group">
                        <div class="form-group{{ $errors->has('dateofbirth') ? ' has-error' : ''}}">
                          <label>Units</label>
                          <input type="text" class="input-sm input-s datepicker-input form-control" value="{{ Request::old('dateofbirth') ?: '' }}"   id="dateofbirth" name="dateofbirth">                        
                          @if ($errors->has('dateofbirth'))
                          <span class="help-block">{{ $errors->first('dateofbirth') }}</span>
                           @endif           
                        </div>

                         
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Buy</button>
                      </footer>
                    </section>