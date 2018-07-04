                    <section class="panel panel-default">
                      <div class="panel-body">
                       
                        <div class="clearfix m-b">

                          <a href="#" class="thumb-lg">
                            <img src="" name="imagePreview" id="imagePreview"  class="img-circle">
                          </a>

                        </div>
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Patient Number</label> 
                            <div class="form-group{{ $errors->has('ref_patient_id') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="ref_patient_id" readonly="true" name="ref_patient_id" value="{{ Request::old('ref_patient_id') ?: '' }}">   
                           @if ($errors->has('ref_patient_id'))
                          <span class="help-block">{{ $errors->first('ref_patient_id') }}</span>
                           @endif    
                          </div>
                          </div>

                          
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('ref_accounttype') ? ' has-error' : ''}}">
                            <label>Billing Account</label> <span class="label label-warning btn-rounded"><label type="text" id="myoutstanding" name="myoutstanding" value="{{ Request::old('myoutstanding') ?: '' }}"></span>
                            {{-- <input type="text" rows="3" class="form-control" id="accounttype" readonly="true" name="accounttype" value="{{ Request::old('accounttype') ?: '' }}">   --}}  
                          <select id="ref_accounttype" name="ref_accounttype" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:430px" >
                          
                        
                        </select>      
                           @if ($errors->has('ref_accounttype'))
                          <span class="help-block">{{ $errors->first('ref_accounttype') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        <div class="form-group">
                         <div class="form-group{{ $errors->has('ref_fullname') ? ' has-error' : ''}}">
                          <label>Name </label>
                          <input type="text" class="form-control" readonly="true" id="ref_fullname" value="{{ Request::old('ref_fullname') ?: '' }}"  name="ref_fullname">
                          @if ($errors->has('ref_fullname'))
                          <span class="help-block">{{ $errors->first('ref_fullname') }}</span>
                           @endif                        
                        </div>
                        
                        </div>

                       <section class="panel panel-default">
                    <header class="panel-heading bg-light">
                      <ul class="nav nav-tabs pull-left">
                        
                        <li><a href="#profile-1" data-toggle="tab"><i class="fa  fa-folder-open-o text-default"></i> General Information</a></li>
                        
                      </ul>
                      <span class="hidden-sm">.</span>
                    </header>
                    <div class="panel-body">
                      <div class="tab-content">              
                       
                        <div class="tab-pane active" id="profile-1">
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Visit Number</label> 
                            <input type="text" rows="3" class="form-control" id="ref_opd_number" name="ref_opd_number" readonly="true" value="{{ Request::old('ref_opd_number') ?: '' }}">   
                          </div>
                          <div class="col-sm-6">
                               <div class="form-group{{ $errors->has('referal_doctor') ? ' has-error' : ''}}">
                            <label>Doctor</label>
                            <select id="ref_referal_doctor" name="ref_referal_doctor" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:430px" >
                          @foreach($doctors as $doctor)
                        <option value="{{ $doctor->name }}">{{ $doctor->name }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('ref_referal_doctor'))
                          <span class="help-block">{{ $errors->first('ref_referal_doctor') }}</span>
                           @endif    
                          </div> 
                          </div>   
                        </div>
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('visit_type') ? ' has-error' : ''}}">
                            <label>Visit Type</label>
                            <select id="ref_visit_type" name="ref_visit_type" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:430px">
                          @foreach($visittypes as $visittypes)
                        <option value="{{ $visittypes->type }}">{{ $visittypes->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('ref_visit_type'))
                          <span class="help-block">{{ $errors->first('ref_visit_type') }}</span>
                           @endif    
                          </div>   
                          </div>


                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('ref_consultation_type') ? ' has-error' : ''}}">
                            <label>Consultation Type</label>
                            <select id="ref_consultation_type" name="ref_consultation_type" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                            <option value=""> -- Select Consultation -- </option>
                          @foreach($servicetype as $servicetype)
                        <option value="{{ $servicetype->type }}">{{ $servicetype->type }} </option>
                          @endforeach
                        </select>         
                           @if ($errors->has('ref_consultation_type'))
                          <span class="help-block">{{ $errors->first('ref_consultation_type') }}</span>
                           @endif    
                          </div>   
                        </div>  
                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('ref_last_visit_date') ? ' has-error' : ''}}">
                            <label>Last Visit Date</label>
                            <input type="text" rows="3" class="form-control" readonly="true" id="last_visit_date" name="last_visit_date" value="{{ Request::old('last_visit_date') ?: '' }}">
                           @if ($errors->has('last_visit_date'))
                          <span class="help-block">{{ $errors->first('ref_last_visit_date') }}</span>
                           @endif    
                          </div>   
                          </div>
                          
                          <div class="col-sm-6">
                       <div class="form-group @if($errors->has('visit_date')) has-error @endif">
                        <label for="visit_date">Visit Date</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="ref_visit_date" data-required="true" id="ref_visit_date" placeholder="Select your time" value="{{ old('visit_date') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('visit_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('visit_date') }}
                       </p>
                        @endif
                      </div>
                      </div>  
                        </div>
                        </div>

                    </div>
                  </section>

                        
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Save</button>
                      
                      </footer>
                    </section>