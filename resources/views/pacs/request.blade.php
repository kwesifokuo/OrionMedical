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
                            <select id="accounttype" name="accounttype" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                         {{--  @foreach($accounttype as $accounttype)
                        <option value="{{ $accounttype->type }}">{{ $accounttype->type }}</option>
                          @endforeach --}}
                        </select>         
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
                          <input type="text" class="form-control" id="request_name" readonly="true" value="{{ Request::old('request_name') ?: '' }}"  name="request_name">
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
                      
                        <li><a href="#investigation_tab"  data-toggle="tab"><i class="fa fa-flask text-default"></i> Imaging Types </a></li>

                       
                      </ul>
                      <span class="hidden-sm">.</span>
                    </header>
                    <div class="panel-body">
                      <div class="tab-content">              
                       
                      
                      
                      {{-- Patient History End --}}

                        {{-- Patient clinical Start --}}
                         {{-- Patient treatment Start --}}
                <div class="tab-pane" id="investigation_tab">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <select id="scan_type" name="scan_type" rows="3" tabindex="1" data-placeholder="drug name" style="width:100%">
                           <option value="">-- Nothing selected --</option>
                          @foreach($imaging as $imaging)
                        <option value="{{ $imaging->type }}">{{ $imaging->type }}</option>
                          @endforeach 
                        </select>         
                          </div>
                        </div>
                        <div>
                          <span class="input-group-btn">
                              <button class="btn btn-primary pull-right" onclick="addImageRequest()" type="button">Add </button>
                            </span>
                        </div>
                    <div >
                   
                    <br>
                    <br>
                       <table id="investigationsTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Imaging Type</th>
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
                 <div>
                 <a href=""  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open" name="visitid" id="visitid" > <i class="fa fa-file"></i>  Print Imaging Request </a>
                </div>
              </div>

                          
                    </div>
                  </section>

                        
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                       
                                       
                      </footer>
                    </section>



