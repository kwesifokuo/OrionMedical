<section class="panel panel-default">
                      <div class="panel-body">
                      <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>BarCode</label> 
                            <div class="form-group{{ $errors->has('drug_number') ? ' has-error' : ''}}">
                            <input type="text" rows="3" data-required="true" class="form-control" id="drug_number" name="drug_number" value="{{ Request::old('drug_number') ?: '' }}">   
                           @if ($errors->has('drug_number'))
                          <span class="help-block">{{ $errors->first('drug_number') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                          <div class="form-group pull-in clearfix">
                   {{--         <div class="col-sm-6">
                            <label>Generic Name</label> 
                            <div class="form-group{{ $errors->has('generic_name') ? ' has-error' : ''}}">
                            <input type="text" rows="3" data-required="true" class="form-control" id="generic_name" name="generic_name" value="{{ Request::old('generic_name') ?: '' }}">       
                           @if ($errors->has('generic_name'))
                          <span class="help-block">{{ $errors->first('generic_name') }}</span>
                           @endif    
                          </div>
                          </div> --}}

                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('drug_name') ? ' has-error' : ''}}">
                            <label>Consumable Name</label>
                            <input type="text" rows="3" data-required="true" readonly="true" class="form-control" id="drug_name" name="drug_name" value="{{ Request::old('drug_name') ?: '' }}">      
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
                            <label>Quantity Assigned</label> 
                            <div class="form-group{{ $errors->has('stock_alert') ? ' has-error' : ''}}">
                            <input type="text" rows="3" data-required="true" class="form-control" id="quantity_assigned" name="quantity_assigned" value="{{ Request::old('stock_alert') ?: '' }}">   
                           @if ($errors->has('stock_alert'))
                          <span class="help-block">{{ $errors->first('stock_alert') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                        
                         <div class="form-group pull-in clearfix">
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('category') ? ' has-error' : ''}}">
                            <label>Assigned To</label>
                            <select id="assignee" name="assignee" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                            <option value=""> -- Select Supplier -- </option>
                         @foreach($assignees as $assignee)
                        <option value="{{ $assignee->fullname }}"> {{ $assignee->fullname }} </option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('supplier'))
                          <span class="help-block">{{ $errors->first('supplier') }}</span>
                           @endif    
                          </div>   
                        </div>
                        

                        <div class="col-sm-6">
                       <div class="form-group @if($errors->has('expiry_date')) has-error @endif">
                        <label for="expiry_date">Assigned On</label>
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
                        <button type="submit" class="btn btn-success btn-s-xs">Assign Consumable</button>
                        <input type="hidden" id="drugid" name="drugid" value="{{ old('drugid') }}">
                      </footer>
                    </section>