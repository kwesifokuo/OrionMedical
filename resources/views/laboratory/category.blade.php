                    <section class="panel panel-default">
                      <div class="panel-body">
                       
                       

                       

                       <section class="panel panel-default">
                    <header class="panel-heading bg-light">
                      <ul class="nav nav-tabs pull-left">
                      
                        <li><a href="#investigation_tab"  data-toggle="tab"><i class="fa fa-flask text-default"></i> Investigation </a></li>

                       
                      </ul>
                      <span class="hidden-sm">.</span>
                    </header>
                    <div class="panel-body">

                      <div class="tab-content">              
                       
                    
                <div class="tab-pane Active" id="investigation_tab">

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <div class="form-group{{ $errors->has('drug_dosage') ? ' has-error' : ''}}">
                            <label>Test Name</label>
                             <input type="text" class="form-control" class="text-success" readonly="true" id="drug_dosage"  value="{{ Request::old('drug_dosage') ?: '' }}"  name="drug_dosage">       
                           @if ($errors->has('drug_dosage'))
                          <span class="help-block">{{ $errors->first('drug_dosage') }}</span>
                           @endif    
                          </div>   
                          </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <label>Parameter</label>
                           <select id="investigation" name="investigation" rows="3" tabindex="1" data-placeholder="drug name" style="width:100%">
                           <option value="">-- Nothing selected --</option>
                          @foreach($investigations as $investigation)
                        <option value="{{ $investigation->type }}">{{ $investigation->type }}</option>
                          @endforeach 
                        </select>         
                          </div>
                        </div>


                        <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_dosage') ? ' has-error' : ''}}">
                            <label>Male Reference Range</label>
                             <input type="text" class="form-control" class="text-success" id="drug_dosage"  value="{{ Request::old('drug_dosage') ?: '' }}"  name="drug_dosage">       
                           @if ($errors->has('drug_dosage'))
                          <span class="help-block">{{ $errors->first('drug_dosage') }}</span>
                           @endif    
                          </div>   
                        </div>
                         
                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_form') ? ' has-error' : ''}}">
                          <label>.</label>
                             <input type="text" class="form-control" class="text-success" id="drug_form"  value="{{ Request::old('drug_form') ?: '' }}"  name="drug_form">       
                           @if ($errors->has('drug_form'))
                          <span class="help-block">{{ $errors->first('drug_form') }}</span>
                           @endif    
                          </div>   
                        </div>


                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_pack_size') ? ' has-error' : ''}}">
                          <label>.</label>
                             <input type="text" class="form-control" class="text-success" id="drug_pack_size"  value="{{ Request::old('drug_pack_size') ?: '' }}"  name="drug_pack_size">       
                           @if ($errors->has('drug_pack_size'))
                          <span class="help-block">{{ $errors->first('drug_pack_size') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                           <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_dosage') ? ' has-error' : ''}}">
                            <label>Female Reference Range</label>
                             <input type="text" class="form-control" class="text-success" id="drug_dosage"  value="{{ Request::old('drug_dosage') ?: '' }}"  name="drug_dosage">       
                           @if ($errors->has('drug_dosage'))
                          <span class="help-block">{{ $errors->first('drug_dosage') }}</span>
                           @endif    
                          </div>   
                        </div>
                         
                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_form') ? ' has-error' : ''}}">
                          <label>.</label>
                             <input type="text" class="form-control" class="text-success" id="drug_form"  value="{{ Request::old('drug_form') ?: '' }}"  name="drug_form">       
                           @if ($errors->has('drug_form'))
                          <span class="help-block">{{ $errors->first('drug_form') }}</span>
                           @endif    
                          </div>   
                        </div>



                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_pack_size') ? ' has-error' : ''}}">
                          <label>.</label>
                             <input type="text" class="form-control" class="text-success" id="drug_pack_size"  value="{{ Request::old('drug_pack_size') ?: '' }}"  name="drug_pack_size">       
                           @if ($errors->has('drug_pack_size'))
                          <span class="help-block">{{ $errors->first('drug_pack_size') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                           <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_dosage') ? ' has-error' : ''}}">
                            <label>Baby Reference Range</label>
                             <input type="text" class="form-control" class="text-success" id="drug_dosage"  value="{{ Request::old('drug_dosage') ?: '' }}"  name="drug_dosage">       
                           @if ($errors->has('drug_dosage'))
                          <span class="help-block">{{ $errors->first('drug_dosage') }}</span>
                           @endif    
                          </div>   
                        </div>
                         
                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_form') ? ' has-error' : ''}}">
                          <label>.</label>
                             <input type="text" class="form-control" class="text-success" id="drug_form"  value="{{ Request::old('drug_form') ?: '' }}"  name="drug_form">       
                           @if ($errors->has('drug_form'))
                          <span class="help-block">{{ $errors->first('drug_form') }}</span>
                           @endif    
                          </div>   
                        </div>


                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_pack_size') ? ' has-error' : ''}}">
                          <label>.</label>
                             <input type="text" class="form-control" class="text-success" id="drug_pack_size"  value="{{ Request::old('drug_pack_size') ?: '' }}"  name="drug_pack_size">       
                           @if ($errors->has('drug_pack_size'))
                          <span class="help-block">{{ $errors->first('drug_pack_size') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>




                        <div>
                          <span class="input-group-btn">
                              <button class="btn btn-primary pull-right" onclick="addParameter()" type="button">Add </button>
                            </span>
                        </div>
                    <div >
                   
                    <br>
                    <br>
                       <table id="investigationsTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Category</th>
                              <th>UOM</th>
                              <th>Male Range</th>
                              <th>Female Range</th>
                              <th>Baby Range</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                </div>
                 <div class="line"></div>
                 <div>
                 <a href=""  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open" name="visitid" id="visitid" > <i class="fa fa-file"></i>  Print Lab Request </a>
                </div>
              </div>

                          
                    </div>
                  </section>

                        
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                       
                         <input type="hidden" name="opd_number" id="opd_number" value="{{ Request::old('opd_number') ?: '' }}">                
                      </footer>
                    </section>



