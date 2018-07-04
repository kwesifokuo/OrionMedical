<section class="panel panel-default">
                      <div class="panel-body">
        
                          <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Drug Name</label> 
                            <div class="form-group{{ $errors->has('drug_name') ? ' has-error' : ''}}">
                            <select type="text" rows="3" data-required="true" disabled style="width:100%" id="drug_name" name="drug_name" value="{{ Request::old('drug_name') ?: '' }}">
                            <option value=""> -- Select Drug -- </option>
                               @foreach($drugs as $drug)
                            <option value="{{ $drug->name }}">{{ $drug->name }}</option>
                            @endforeach 
                            </select>

                           @if ($errors->has('drug_name'))
                          <span class="help-block">{{ $errors->first('drug_name') }}</span>
                           @endif    
                          </div>
                          </div> 
                        </div>



                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Report Type</label> 
                            <div class="form-group{{ $errors->has('drug_name') ? ' has-error' : ''}}">
                            <select type="text" rows="3" data-required="true"class="form-control" id="damaged_status" name="damaged_status" value="{{ Request::old('damaged_status') ?: '' }}">
                            <option value=""> -- Select status -- </option>
                              
                            <option value="Stock Damaged">Stock Damaged</option>
                            <option value="Stock Returned">Stock Returned</option>
                            <option value="Stock Transfered">Stock Transfered</option>
                           
                            </select>

                           @if ($errors->has('drug_name'))
                          <span class="help-block">{{ $errors->first('drug_name') }}</span>
                           @endif    
                          </div>
                          </div> 
                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Quantity in Stock </label> 
                            <div class="form-group{{ $errors->has('stock') ? ' has-error' : ''}}">
                            <input type="text" rows="3" data-required="true" readonly="true" class="form-control" id="stock" name="stock" value="{{ Request::old('stock') ?: '' }}">   
                           @if ($errors->has('stock'))
                          <span class="help-block">{{ $errors->first('stock') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                            <label>Quantity Damaged/Return</label> 
                            <div class="form-group{{ $errors->has('damaged_stock') ? ' has-error' : ''}}">
                            <input type="text" rows="3" data-required="true" class="form-control" id="damaged_stock" name="damaged_stock" value="{{ Request::old('damaged_stock') ?: '' }}">   
                           @if ($errors->has('damaged_stock'))
                          <span class="help-block">{{ $errors->first('damaged_stock') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Damage/Return Remark</label> 
                            <div class="form-group{{ $errors->has('remark') ? ' has-error' : ''}}">
                            <input type="text" rows="3" data-required="true" class="form-control" id="remark" name="remark" value="{{ Request::old('remark') ?: '' }}">       
                           @if ($errors->has('remark'))
                          <span class="help-block">{{ $errors->first('remark') }}</span>
                           @endif    
                          </div>
                          </div> 
                        </div>
                      </div>

                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Add Damaged Drug</button>
                        <input type="hidden" name="drugid" id="drugid" value="{{ Request::old('drugid') ?: '' }}">
                      </footer>
                    </section>