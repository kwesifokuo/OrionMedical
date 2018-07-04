                      <section class="panel panel-default">
                      <div class="panel-body">
                     

                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('assigned_drug_name') ? ' has-error' : ''}}">
                            <label>Item Name</label>
                           
                        <input type="text" rows="3" data-required="true" readonly="true" class="form-control" id="item_requested" name="item_requested" value="{{ Request::old('item_requested') ?: '' }}">      
                           @if ($errors->has('drug_name'))
                          <span class="help-block">{{ $errors->first('drug_name') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Quantity Available</label> 
                            <div class="form-group{{ $errors->has('stock') ? ' has-error' : ''}}">
                            <input type="text" rows="3" data-required="true" readonly="true" class="form-control" id="stock" name="stock" value="{{ Request::old('stock') ?: '' }}">   
                           @if ($errors->has('stock'))
                          <span class="help-block">{{ $errors->first('stock') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                            <label>Quantity Requested</label> 
                            <div class="form-group{{ $errors->has('stock_alert') ? ' has-error' : ''}}">
                            <input type="text" rows="3" data-required="true" class="form-control" id="quantity_requested" name="quantity_requested" value="{{ Request::old('stock_alert') ?: '' }}">   
                           @if ($errors->has('stock_alert'))
                          <span class="help-block">{{ $errors->first('stock_alert') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Price</label> 
                            <div class="form-group{{ $errors->has('item_price') ? ' has-error' : ''}}">
                            <input type="text" rows="3" data-required="true" readonly="true" class="form-control" id="item_price" name="item_price" value="{{ Request::old('item_price') ?: '' }}">   
                           @if ($errors->has('item_price'))
                          <span class="help-block">{{ $errors->first('item_price') }}</span>
                           @endif    
                          </div>
                          </div>

                        
                        </div>

                        
                         <div class="form-group pull-in clearfix">
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('category') ? ' has-error' : ''}}">
                            <label>Requested By</label>
                            <input id="requested_by" name="requested_by" readonly="true" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control" value="{{ Auth::user()->getNameOrUsername() }}">
                            
                           @if ($errors->has('supplier'))
                          <span class="help-block">{{ $errors->first('supplier') }}</span>
                           @endif    
                          </div>   
                        </div>
                        

                        <div class="col-sm-6">
                       <div class="form-group @if($errors->has('expiry_date')) has-error @endif">
                        <label for="expiry_date">Requested On</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="assigned_on" data-required="true" id="assigned_on" placeholder="Select your time" value="{{ old('assigned_on') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('expiry_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('expiry_date') }}
                       </p>
                        @endif
                      </div>
                      </div>
                    </div>

                    </div>
      

                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Forward Request to Store</button>
                        <input type="hidden" id="drugid" name="drugid" value="{{ old('drugid') }}">
                      </footer>
                    </section>