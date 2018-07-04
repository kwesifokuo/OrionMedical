                    <section class="panel panel-default">
                      <div class="panel-body">
                       
                        <div class="clearfix m-b">

                          <a href="#" class="pull-left thumb m-r">
                            <img src="" name="imagePreview" id="imagePreview"  class="img-circle">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs"></div>
                            <small class="text-muted"><i class="fa fa-map-marker"></i> </small>
                          </div>                
                        </div>
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Patient Number</label> 
                            <div class="form-group{{ $errors->has('patient_id') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="patient_id" readonly="true" name="patient_id" value="{{ Request::old('patient_id') ?: '' }}">   
                           @if ($errors->has('patient_id'))
                          <span class="help-block">{{ $errors->first('patient_id') }}</span>
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


                        <div class="form-group">
                         <div class="form-group{{ $errors->has('fullname') ? ' has-error' : ''}}">
                          <label>Name </label>
                          <input type="text" class="form-control" id="fullname" readonly="true" value="{{ Request::old('fullname') ?: '' }}"  name="fullname">
                          @if ($errors->has('fullname'))
                          <span class="help-block">{{ $errors->first('fullname') }}</span>
                           @endif                        
                        </div>
                        
                        </div>

                        <div class="form-group">
                         <div class="form-group{{ $errors->has('consultation_title') ? ' has-error' : ''}}">
                          <label>Title </label>
                          <input type="text" class="form-control" id="consultation_title"  placeholder="Please enter title of review" value="{{ Request::old('consultation_title') ?: '' }}"  name="consultation_title">
                          @if ($errors->has('consultation_title'))
                          <span class="help-block">{{ $errors->first('consultation_title') }}</span>
                           @endif                        
                        </div>
                        
                        </div>

                       <section class="panel panel-default">
                    <header class="panel-heading bg-light">
                      <ul class="nav nav-tabs pull-left">
                        
                       {{--  <li><a href="#profile-1" data-toggle="tab"><i class="fa  fa-folder-open-o text-default"></i> General Information</a></li>
                        <li><a href="#settings-1" data-toggle="tab"><i class="fa  fa-user-md text-default"></i> Vital Parameters</a></li> --}}
             
                        <li><a href="#treatment_tab" data-toggle="tab"><i class="fa  fa-user-md text-default"></i> Bedside Procedures</a></li>
                        <li><a href="#medication_tab" data-toggle="tab"><i class="fa fa-flask text-default"></i> Medication  </a></li>
                         <li><a href="#progess_tab" data-toggle="tab"><i class="fa fa-bar-chart-o text-default"></i> Progress Note  </a></li>
                         <li><a href="#vitals_tab" data-toggle="tab"><i class="fa fa-heart-o text-default"></i> Vital Signs  </a></li>
                         <li><a href="#room_transfer_tab" data-toggle="tab"><i class="fa fa-shield text-default"></i> Room Transfer  </a></li>
                         <li><a href="#intake_output_tab" data-toggle="tab"><i class="fa fa-unsorted text-default"></i> Intake/Output  </a></li>
                         <li><a href="#discharge_tab" data-toggle="tab"><i class="fa fa-unlink text-default"></i> Discharge Summary  </a></li>
                      </ul>
                      <span class="hidden-sm">.</span>
                    </header>
                    <div class="panel-body">
                      <div class="tab-content">              
                       
                      {{-- Patient compliant Start --}}
                        <div class="tab-pane" id="compliant_tab">
                         <div class="form-group pull-in clearfix ">
                          <div class="col-sm-12 ">
                             <div class="select2-container select2-container-multi">
                           <select  multiple="multiple" id="complaint" name="complaint[]" rows="3" tabindex="1" data-placeholder="Compliant"  style="width:900px">
                          @foreach($complaints as $complaints)
                        <option value="{{ $complaints->type }}">{{ $complaints->type }}</option>
                          @endforeach
                        </select>         
                          </div>
                          </div>
                        </div>
                        </div>
                      {{-- Patient History End --}}

                        {{-- Patient clinical Start --}}
                        <div class="tab-pane" id="investigation_tab">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <div class="select2-container select2-container-multi">
                           <select  multiple="multiple" id="investigation" name="investigation[]" rows="3" tabindex="1" data-placeholder="Search investigations findings..."  style="width:900px">
                          @foreach($investigations as $investigations)
                        <option value="{{ $investigations->type }}">{{ $investigations->type }}</option>
                          @endforeach
                        </select>         
                          </div>
                          </div>
                        </div>
                        </div>
                      {{-- Patient History End --}}

                       {{-- Patient diagnosis Start --}}
                        <div class="tab-pane" id="diagnosis_tab">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                             <div class="select2-container select2-container-multi">
                           <select multiple="multiple" id="diagnosis"  name="diagnosis[]" rows="3" tabindex="1" data-placeholder="Search for diagnosis..."   style="width:900px">
                          @foreach($diagnosis as $diagnosis)
                        <option value="{{ $diagnosis->type }}">{{ $diagnosis->type }}</option>
                          @endforeach
                        </select>         
                          </div>
                          </div>
                        </div>
                        </div>
                      {{-- Patient History End --}}
                        

                        {{-- Patient treatment Start --}}
                        <div class="tab-pane" id="treatment_tab">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                             <div class="select2-container select2-container-multi">
                           <select  multiple="multiple" id="procedures" name="procedures[]" rows="3" tabindex="1" data-placeholder="Search procedures..." style="width:900px">
                          @foreach($treatments as $treatment)
                        <option value="{{ $treatment->procedure }}">{{ $treatment->procedure }}</option>
                          @endforeach
                        </select>         
                          </div>
                          </div>
                        </div>
                        </div>
                      {{-- Patient History End --}}

                       {{-- Patient treatment Start --}}
                             <div class="tab-pane" id="medication_tab">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-8">
                             <div class="select2-container select2-container-multi">
                           <select id="medication" name="medication" rows="3" tabindex="1" data-placeholder="drug name" style="width:900px">
                          @foreach($drugs as $drugs)
                        <option value="{{ $drugs->Name }}">{{ $drugs->Name }}</option>
                          @endforeach
                        </select>         
                          </div>
                        </div>
                        </div>
                        <div>
                          <span class="input-group-btn">
                              <button class="btn btn-primary pull-right" onclick="addDrug()" type="button">Add Drug</button>
                            </span>
                        </div>
                    <div >
                     <header class="panel-heading">
                      <span class="label bg-dark pull-left">Prescription List</span>
                  </header>
                    <br>
                    <br>
                       <table id="investigationsTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Quantity</th>
                              <th>Drug Name</th>
                              <th>Cost</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                </div>
              </div>
                     
                      {{-- Patient History End --}}
                      

                        <div class="tab-pane" id="recommendation_tab">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                             <div id="MyPillbox" class="pillbox clearfix">
                           <input type="text" rows="3" class="form-control" id="recommendation" name="recommendation" value="{{ Request::old('recommendation') ?: '' }}"> 
                           </div>
                          </div>
                        </div>
                        </div>


                         {{-- Patient treatment Start --}}
                        <div class="tab-pane" id="treatment_tab">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                             <div class="select2-container select2-container-multi">
                           <select  multiple="multiple" id="procedures" name="procedures[]" rows="3" tabindex="1" data-placeholder="Search procedures..." style="width:900px">
                          @foreach($treatments as $treatment)
                        <option value="{{ $treatment->procedure }}">{{ $treatment->procedure }}</option>
                          @endforeach
                        </select>         
                          </div>
                          </div>
                        </div>
                        </div>
                      {{-- Patient History End --}}
                       {{-- Patient treatment Start --}}
                        <div class="tab-pane" id="treatment_tab">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                             <div class="select2-container select2-container-multi">
                           <select  multiple="multiple" id="procedures" name="procedures[]" rows="3" tabindex="1" data-placeholder="Search procedures..." style="width:900px">
                          @foreach($treatments as $treatment)
                        <option value="{{ $treatment->procedure }}">{{ $treatment->procedure }}</option>
                          @endforeach
                        </select>         
                          </div>
                          </div>
                        </div>
                        </div>
                      {{-- Patient History End --}}
                       {{-- Patient treatment Start --}}
                        <div class="tab-pane" id="treatment_tab">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                             <div class="select2-container select2-container-multi">
                           <select  multiple="multiple" id="procedures" name="procedures[]" rows="3" tabindex="1" data-placeholder="Search procedures..." style="width:900px">
                          @foreach($treatments as $treatment)
                        <option value="{{ $treatment->procedure }}">{{ $treatment->procedure }}</option>
                          @endforeach
                        </select>         
                          </div>
                          </div>
                        </div>
                        </div>
                      {{-- Patient History End --}}
                       {{-- Patient treatment Start --}}
                        <div class="tab-pane" id="treatment_tab">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                             <div class="select2-container select2-container-multi">
                           <select  multiple="multiple" id="procedures" name="procedures[]" rows="3" tabindex="1" data-placeholder="Search procedures..." style="width:900px">
                          @foreach($treatments as $treatment)
                        <option value="{{ $treatment->procedure }}">{{ $treatment->procedure }}</option>
                          @endforeach
                        </select>         
                          </div>
                          </div>
                        </div>
                        </div>
                      {{-- Patient History End --}}
                       {{-- Patient treatment Start --}}
                        <div class="tab-pane" id="treatment_tab">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                             <div class="select2-container select2-container-multi">
                           <select  multiple="multiple" id="procedures" name="procedures[]" rows="3" tabindex="1" data-placeholder="Search procedures..." style="width:900px">
                          @foreach($treatments as $treatment)
                        <option value="{{ $treatment->procedure }}">{{ $treatment->procedure }}</option>
                          @endforeach
                        </select>         
                          </div>
                          </div>
                        </div>
                        </div>
                      {{-- Patient History End --}}
                          
                    </div>
                  </section>

                        
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Save</button>
                         <input type="hidden" name="opd_number" id="opd_number" value="{{ Request::old('opd_number') ?: '' }}">                
                      </footer>
                    </section>



