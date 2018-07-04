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
                          <div class="form-group{{ $errors->has('request_accounttype') ? ' has-error' : ''}}">
                            <label>Account Type</label>
                            <input id="request_accounttype" name="request_accounttype" value="Private" readonly="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                       
                           @if ($errors->has('request_accounttype'))
                          <span class="help-block">{{ $errors->first('request_accounttype') }}</span>
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

                        <br>
                        <br>
                        <br>
                        <br>
                       

                       <section class="panel panel-default">
                    <header class="panel-heading bg-light">
                      <ul class="nav nav-tabs pull-left">
                      
                        <li><a href="#investigation_tab"  data-toggle="tab"><i class="fa fa-flask text-default"></i> Investigation / Procedure </a></li>
                       
                       
                      </ul>
                      <span class="hidden-sm">.</span>
                    </header>
                    <div class="panel-body">
                      <div class="tab-content">              
                       
                      
                      
                      {{-- Patient History End --}}

                        {{-- Patient clinical Start --}}
                         {{-- Patient treatment Start --}}
                <div class="tab-pane Active" id="investigation_tab">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <select id="investigation" name="investigation" rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="">-- Nothing selected --</option>
                          @foreach($generalservices as $service)
                        <option value="{{ $service->type }}">{{ $service->type }}</option>
                          @endforeach 
                        </select>         
                          </div>
                        </div>
                        <div>
                          <span class="input-group-btn">
                              <button class="btn btn-primary pull-right" onclick="addInvestigation()" type="button">Add </button>
                            </span>
                        </div>
                    <div >
                   
                    <br>
                    <br>
                       <table id="investigationsTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Investigation / Procedure </th>
                              <th>Cost</th>
                              <th>Date</th>
                              <th>Status</th>
                              <th></th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                </div>
                 <div class="line"></div>
                
              </div>

                          
                    </div>
                  </section>

                        
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                       
                         <input type="hidden" name="opd_number" id="opd_number" value="{{ Request::old('opd_number') ?: '' }}">                
                      </footer>
                    </section>



