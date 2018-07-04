<section class="panel panel-default">
                      <div class="panel-body">
                      <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Test Code</label> 
                            <div class="form-group{{ $errors->has('drug_number') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="drug_number" name="drug_number" value="{{ Request::old('drug_number') ?: '' }}">   
                           @if ($errors->has('drug_number'))
                          <span class="help-block">{{ $errors->first('drug_number') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('drug_name') ? ' has-error' : ''}}">
                            <label>Test Name</label>
                            <input type="text" rows="3" data-required="true" class="form-control" id="drug_name" name="drug_name" value="{{ Request::old('drug_name') ?: '' }}">      
                           @if ($errors->has('drug_name'))
                          <span class="help-block">{{ $errors->first('drug_name') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        
                        <div class="form-group pull-in clearfix">
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('category') ? ' has-error' : ''}}">
                            <label>Category</label>
                            <select id="category" name="category" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                            <option value=""> -- Select Category Type -- </option>
{{--                           @foreach($drugcategories as $drugcategory)
                        <option value="{{ $drugcategory->category }}">{{ $drugcategory->category }}</option>
                          @endforeach --}}
                        </select>         
                           @if ($errors->has('category'))
                          <span class="help-block">{{ $errors->first('category') }}</span>
                           @endif    
                          </div>   
                        </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('store_box') ? ' has-error' : ''}}">
                            <label>Short Name</label>
                            <input type="text" rows="3" data-required="true" class="form-control" id="store_box" name="store_box" value="{{ Request::old('store_box') ?: '' }}">      
                           @if ($errors->has('store_box'))
                          <span class="help-block">{{ $errors->first('store_box') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Charge</label> 
                            <div class="form-group{{ $errors->has('buy_price') ? ' has-error' : ''}}">
                            <input type="text" rows="3" data-required="true" class="form-control" id="buy_price" name="buy_price" value="{{ Request::old('buy_price') ?: '' }}">   
                           @if ($errors->has('buy_price'))
                          <span class="help-block">{{ $errors->first('buy_price') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('sale_price') ? ' has-error' : ''}}">
                            <label>Specimen</label>
                            <input type="text" rows="3" data-required="true" class="form-control" id="sale_price" name="sale_price" value="{{ Request::old('sale_price') ?: '' }}">      
                           @if ($errors->has('sale_price'))
                          <span class="help-block">{{ $errors->first('sale_price') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                         </div>
       
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Add Test</button>
                      </footer>
                    </section>