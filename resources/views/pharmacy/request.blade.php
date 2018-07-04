                    <section class="panel panel-default">
                      <div class="panel-body">
                       <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                       <div class="form-group @if($errors->has('request_visitid')) has-error @endif">
                        <label for="request_visitid">Visit Number</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="request_visitid" data-required="true" id="request_visitid" placeholder="Enter visit number" value="{{ old('request_visitid') }}">
                         <span class="input-group-btn">
                          <button class="btn btn-sm btn-default" type="button" onclick="getVisitDetails()">Go!</button>
                        </span>
                      </div>
                        @if ($errors->has('request_visitid'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('request_visitid') }}
                       </p>
                        @endif
                      </div>
                      </div>
                      
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('accounttype') ? ' has-error' : ''}}">
                            <label>Account Type</label>
                            <input id="accounttype" name="accounttype" value="Private" readonly="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                       
                           @if ($errors->has('accounttype'))
                          <span class="help-block">{{ $errors->first('accounttype') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        
                        
                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                         <div class="form-group{{ $errors->has('request_name') ? ' has-error' : ''}}">
                          <label>Patient Name </label>
                          <input type="text" class="form-control" id="request_name" value="{{ Request::old('request_name') ?: '' }}"  name="request_name">
                          <input type="hidden" class="form-control" id="request_patient_id" readonly="true" value="{{ Request::old('request_patient_id') ?: '' }}"  name="request_patient_id">
                          @if ($errors->has('request_name'))
                          <span class="help-block">{{ $errors->first('request_name') }}</span>
                           @endif                        
                        </div>
                        
                        </div>
                        </div>



                        <div class="panel-body">
                 
                      <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                          <div class="input-group m-b">
                           <select id="medication" name="medication" rows="3" onchange="getdrugdetail()" tabindex="1" data-placeholder="Search medication ..." style="width:100%">
                           <option value="">-- Select drug from pharmacy--</option>
                          @foreach($drugs as $drugs)
                        <option value="{{ $drugs->id }}">{{ $drugs->name }}</option>
                          @endforeach
                        </select>  <div class="input-group-btn">
                           <a href="#new-medication" class="bootstrap-modal-form-open" data-toggle="modal" ><button  class="btn btn-sm btn-default" type="button"><i class="fa fa-plus-circle"></i></button></a>
                        </div>     
                        </div>   
                          </div>
                        </div>



                          <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_dosage') ? ' has-error' : ''}}">
                            <label>Dosage</label>
                             <input type="text" class="form-control" class="text-success" readonly="true" id="drug_dosage"  value="{{ Request::old('drug_dosage') ?: '' }}"  name="drug_dosage">       
                           @if ($errors->has('drug_dosage'))
                          <span class="help-block">{{ $errors->first('drug_dosage') }}</span>
                           @endif    
                          </div>   
                        </div>
                         


                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_form') ? ' has-error' : ''}}">
                            <label>Fomulation</label>
                             <input type="text" class="form-control" class="text-success" readonly="true" id="drug_form"  value="{{ Request::old('drug_form') ?: '' }}"  name="drug_form">       
                           @if ($errors->has('drug_form'))
                          <span class="help-block">{{ $errors->first('drug_form') }}</span>
                           @endif    
                          </div>   
                        </div>


                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_pack_size') ? ' has-error' : ''}}">
                            <label>Pack Size</label>
                             <input type="text" class="form-control" class="text-success" readonly="true" id="drug_pack_size"  value="{{ Request::old('drug_pack_size') ?: '' }}"  name="drug_pack_size">       
                           @if ($errors->has('drug_pack_size'))
                          <span class="help-block">{{ $errors->first('drug_pack_size') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_generic') ? ' has-error' : ''}}">
                            <label>Generic Name</label>
                             <input type="text" class="form-control" class="text-success" readonly="true" id="drug_generic"  value="{{ Request::old('drug_generic') ?: '' }}"  name="drug_generic">       
                           @if ($errors->has('drug_generic'))
                          <span class="help-block">{{ $errors->first('drug_generic') }}</span>
                           @endif    
                          </div>   
                        </div>

                            
                        
                        </div>

                         <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                            <label>Quantity Prescribed </label> 
                           <input type="number" class="form-control" class="text-success" id="drug_quantity"  value="{{ Request::old('drug_quantity') ?: '' }}"  name="drug_quantity">
                          @if ($errors->has('drug_quantity'))
                          <span class="help-block">{{ $errors->first('drug_quantity') }}</span>
                           @endif   
                          </div>

                         <div class="col-sm-8">
                            <label>Dosage Remark</label> 
                          <input type="text" class="form-control" id="drug_application"  value="{{ Request::old('drug_application') ?: '' }}"  name="drug_application">
                           @if ($errors->has('drug_application'))
                          <span class="help-block">{{ $errors->first('drug_application') }}</span>
                           @endif    
                          </div>
                        </div>
                      <img src="">
                      </div>
                        <div >

                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addDrug()"  class="btn btn-success btn-s-xs">Add</button>       
                      </footer>
                      <br>
                    <br>
                     <section class="panel panel-info">
                                <header class="panel-heading font-bold">Prescription</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="drugTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Quantity</th>
                              <th>Drug Name</th>
                              <th>Dosage Remark</th>
                              <th>Unit Cost</th>
                              <th>Total Cost</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                    </div>
                    </div>
                    </section>

                </div>
                 <div class="line"></div>
                      </div>

                         <footer class="panel-footer text-right bg-light lter">
                       
                         <input type="hidden" name="opd_number" id="opd_number" value="{{ Request::old('opd_number') ?: '' }}">                
                      </footer>
                    </section>


