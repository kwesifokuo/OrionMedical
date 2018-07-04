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
                           <div class="col-sm-6">
                            <label>Generic Name</label> 
                            <div class="form-group{{ $errors->has('generic_name') ? ' has-error' : ''}}">
                            <input type="text" rows="3" data-required="true" class="form-control" id="generic_name" name="generic_name" value="{{ Request::old('generic_name') ?: '' }}">       
                           @if ($errors->has('generic_name'))
                          <span class="help-block">{{ $errors->first('generic_name') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('drug_name') ? ' has-error' : ''}}">
                            <label>Drug Name</label>
                            <input type="text" rows="3" data-required="true" class="form-control" id="drug_name" name="drug_name" value="{{ Request::old('drug_name') ?: '' }}">      
                           @if ($errors->has('drug_name'))
                          <span class="help-block">{{ $errors->first('drug_name') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                         <div class="form-group pull-in clearfix">
                           <div class="col-sm-6">
                            <label>Brand</label> 
                            <div class="form-group{{ $errors->has('brand') ? ' has-error' : ''}}">
                            <select type="text" rows="3" data-required="true" style="width:100%" id="brand" name="brand" value="{{ Request::old('brand') ?: '' }}">
                            <option value=""> -- Select Brand -- </option>
                               @foreach($brands as $brand)
                            <option value="{{ $brand->brand }}">{{ $brand->brand }}</option>
                            @endforeach 
                            </select>
                           @if ($errors->has('brand'))
                          <span class="help-block">{{ $errors->first('brand') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('classification') ? ' has-error' : ''}}">
                            <label>Classification</label>
                            <select type="text" rows="3" data-required="true" style="width:100%" id="classification" name="classification" value="{{ Request::old('classification') ?: '' }}"> 
                              <option value=""> -- Select Category -- </option>
                         @foreach($drugcategories as $category)
                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                          @endforeach 
                             </select>    
                           @if ($errors->has('classification'))
                          <span class="help-block">{{ $errors->first('classification') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Cost Price</label> 
                            <div class="form-group{{ $errors->has('sale_price') ? ' has-error' : ''}}">
                            <input type="text" rows="3" data-required="true" class="form-control" id="sale_price" name="sale_price" value="{{ Request::old('sale_price') ?: '' }}">   
                           @if ($errors->has('sale_price'))
                          <span class="help-block">{{ $errors->first('sale_price') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('buy_price') ? ' has-error' : ''}}">
                            <label>Selling Price</label>
                            <input type="text" rows="3" data-required="true" class="form-control" id="buy_price" name="buy_price" value="{{ Request::old('buy_price') ?: '' }}">      
                           @if ($errors->has('buy_price'))
                          <span class="help-block">{{ $errors->first('buy_price') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('unit_price') ? ' has-error' : ''}}">
                            <label>Unit Price</label>
                            <input type="text" rows="3" data-required="true" class="form-control" id="unit_price" name="unit_price" value="{{ Request::old('unit_price') ?: '' }}">      
                           @if ($errors->has('unit_price'))
                          <span class="help-block">{{ $errors->first('unit_price') }}</span>
                           @endif    
                          </div>   
                        </div>
                         <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('drug_form') ? ' has-error' : ''}}">
                            <label>Unit</label>
                             <select id="drug_form" name="drug_form" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                            <option value=""> -- Select Unit -- </option>
                         @foreach($application as $application)
                        <option value="{{ $application->type }}">{{ $application->type }}</option>
                          @endforeach 
                        </select>              
                           @if ($errors->has('drug_form'))
                          <span class="help-block">{{ $errors->first('drug_form') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Quantity</label> 
                            <div class="form-group{{ $errors->has('stock') ? ' has-error' : ''}}">
                            <input type="text" rows="3" data-required="true" readonly="true" class="form-control" id="stock" name="stock" value="{{ Request::old('stock') ?: '' }}">   
                           @if ($errors->has('stock'))
                          <span class="help-block">{{ $errors->first('stock') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                            <label>Stock Alert Level</label> 
                            <div class="form-group{{ $errors->has('stock_alert') ? ' has-error' : ''}}">
                            <input type="text" rows="3" data-required="true" class="form-control" id="stock_alert" name="stock_alert" value="{{ Request::old('stock_alert') ?: '' }}">   
                           @if ($errors->has('stock_alert'))
                          <span class="help-block">{{ $errors->first('stock_alert') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                         <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('pack_size') ? ' has-error' : ''}}">
                            <label>Pack Size</label>
                             <input type="text" class="form-control" class="text-success" id="pack_size"  value="{{ Request::old('pack_size') ?: '' }}"  name="pack_size">       
                           @if ($errors->has('pack_size'))
                          <span class="help-block">{{ $errors->first('pack_size') }}</span>
                           @endif    
                          </div>   
                        </div>

                           
                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('store_box') ? ' has-error' : ''}}">
                            <label>Rack No</label>
                            <input type="text" rows="3" data-required="true" class="form-control" id="store_box" name="store_box" value="{{ Request::old('store_box') ?: '' }}">      
                           @if ($errors->has('store_box'))
                          <span class="help-block">{{ $errors->first('store_box') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                       
                    
  

                    
                        
                         <div class="form-group pull-in clearfix">
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('category') ? ' has-error' : ''}}">
                            <label>Supplier</label>
                            <select id="supplier" name="supplier" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                            <option value=""> -- Select Supplier -- </option>
                         @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->name }}"> {{ strtoupper($supplier->name) }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('supplier'))
                          <span class="help-block">{{ $errors->first('supplier') }}</span>
                           @endif    
                          </div>   
                        </div>
                        

                        <div class="col-sm-6">
                       <div class="form-group @if($errors->has('expiry_date')) has-error @endif">
                        <label for="expiry_date">Expiry Date</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="expiry_date" data-required="true" id="expiry_date" placeholder="Select your time" value="{{ old('expiry_date') }}">
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
                        <button type="submit" class="btn btn-success btn-s-xs">Add Drug</button>
                      </footer>
                    </section>