 <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new service charge</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-mortgage">
                                    <div class="form-group">
                                      <label>Service Name</label>
                                      <input type="text" id="service" name="service" data-required="true" class="form-control" placeholder="">
                                    </div>

                                     <div class="form-group">
                                      <label>Description</label>
                                      <input type="text" id="description" name="description" data-required="true" class="form-control" placeholder="">
                                    </div>

                                     <div class="form-group">
                                      <label>Charge</label>
                                      <input type="text" id="charge" name="charge" data-required="true" class="form-control" placeholder="">
                                    </div>


                                            <div class="form-group pull-in clearfix">
                               <div class="col-sm-3">
                                <div class="form-group{{ $errors->has('walk_margin') ? ' has-error' : ''}}">
                                  <label>Walk In Sale Margin</label>
                                   <input type="text" class="form-control" class="text-success" data-required="true" id="walk_margin" name="walk_margin" value="{{ Request::old('walk_margin') ?: '' }}" >       
                                 @if ($errors->has('walk_margin'))
                                <span class="help-block">{{ $errors->first('walk_margin') }}</span>
                                 @endif    
                                </div>   
                              </div>

                                 
                              <div class="col-sm-3">
                                <div class="form-group{{ $errors->has('corporate_margin') ? ' has-error' : ''}}">
                                  <label>Corporate Sale Margin</label>
                                  <input type="text" rows="3" data-required="true" class="form-control" id="corporate_margin" name="corporate_margin" value="{{ Request::old('corporate_margin') ?: '' }}">      
                                 @if ($errors->has('corporate_margin'))
                                <span class="help-block">{{ $errors->first('corporate_margin') }}</span>
                                 @endif    
                                </div>   
                              </div>
                        

                                
                              <div class="col-sm-3">
                                <div class="form-group{{ $errors->has('insurance_margin') ? ' has-error' : ''}}">
                                  <label>Normal Insurance Sale Margin</label>
                                  <input type="text" rows="3" data-required="true" class="form-control" id="insurance_margin" name="insurance_margin" value="{{ Request::old('insurance_margin') ?: '' }}">      
                                 @if ($errors->has('insurance_margin'))
                                <span class="help-block">{{ $errors->first('insurance_margin') }}</span>
                                 @endif    
                                </div>   
                              </div>
                        </div>


                           <div class="form-group pull-in clearfix">
                               <div class="col-sm-3">
                                <div class="form-group{{ $errors->has('cosmopolitan_margin') ? ' has-error' : ''}}">
                                  <label>Cosmopolitan Sale Margin</label>
                                   <input type="text" class="form-control" class="text-success" data-required="true" id="cosmopolitan_margin" name="cosmopolitan_margin" value="{{ Request::old('cosmopolitan_margin') ?: '' }}">       
                                 @if ($errors->has('cosmopolitan_margin'))
                                <span class="help-block">{{ $errors->first('cosmopolitan_margin') }}</span>
                                 @endif    
                                </div>   
                              </div>

                                 
                              <div class="col-sm-3">
                                <div class="form-group{{ $errors->has('premier_margin') ? ' has-error' : ''}}">
                                  <label>Premier Sale Margin</label>
                                  <input type="text" rows="3" data-required="true" class="form-control" id="premier_margin" name="premier_margin" value="{{ Request::old('premier_margin') ?: '' }}">      
                                 @if ($errors->has('premier_margin'))
                                <span class="help-block">{{ $errors->first('premier_margin') }}</span>
                                 @endif    
                                </div>   
                              </div>
                        

                                
                              <div class="col-sm-3">
                                <div class="form-group{{ $errors->has('insurance_margin') ? ' has-error' : ''}}">
                                  <label>Glico Sale Margin</label>
                                  <input type="text" rows="3" data-required="true" class="form-control" id="glico_margin" name="glico_margin" value="{{ Request::old('special_margin') ?: '' }}">      
                                 @if ($errors->has('special_margin'))
                                <span class="help-block">{{ $errors->first('special_margin') }}</span>
                                 @endif    
                                </div>   
                              </div>
                        </div>


                          <div class="form-group pull-in clearfix">
                               <div class="col-sm-3">
                                <div class="form-group{{ $errors->has('cosmopolitan_margin') ? ' has-error' : ''}}">
                                  <label>Metropolitan Sale Margin</label>
                                   <input type="text" class="form-control" class="text-success" data-required="true" id="metropolitan_margin" name="metropolitan_margin" value="{{ Request::old('metropolitan_margin') ?: '' }}"  >       
                                 @if ($errors->has('cosmopolitan_margin'))
                                <span class="help-block">{{ $errors->first('cosmopolitan_margin') }}</span>
                                 @endif    
                                </div>   
                              </div>

                                 
                              <div class="col-sm-3">
                                <div class="form-group{{ $errors->has('premier_margin') ? ' has-error' : ''}}">
                                  <label>Acacia Sale Margin</label>
                                  <input type="text" rows="3" data-required="true" class="form-control" id="acacia_margin" name="acacia_margin" value="{{ Request::old('acacia_margin') ?: '' }}">      
                                 @if ($errors->has('premier_margin'))
                                <span class="help-block">{{ $errors->first('premier_margin') }}</span>
                                 @endif    
                                </div>   
                              </div>
                        

                                
                              <div class="col-sm-3">
                                <div class="form-group{{ $errors->has('insurance_margin') ? ' has-error' : ''}}">
                                  <label>Apex Sale Margin</label>
                                  <input type="text" rows="3" data-required="true" class="form-control" id="apex_margin" name="apex_margin" value="{{ Request::old('special_margin') ?: '' }}">      
                                 @if ($errors->has('special_margin'))
                                <span class="help-block">{{ $errors->first('special_margin') }}</span>
                                 @endif    
                                </div>   
                              </div>
                        </div>


                                    


                                     <div class="form-group">
                                      <label>Department</label>
                                      <select id="department" name="department" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                                        @foreach($departments as $value)
                                          <option value="{{ $value->name }}">{{ $value->name  }}</option>
                                      @endforeach 
                                     </select>     
                                    </div>




                                    <button type="submit" class="btn btn-sm btn-default pull-right">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
