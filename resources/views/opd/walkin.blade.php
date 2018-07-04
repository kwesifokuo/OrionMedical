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
                            <div class="form-group{{ $errors->has('patient_id') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="patient_id" readonly="true" name="patient_id" value="{{ uniqid(10) }}">   
                           @if ($errors->has('patient_id'))
                          <span class="help-block">{{ $errors->first('patient_id') }}</span>
                           @endif    
                          </div>
                          </div>

                          

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('accounttype') ? ' has-error' : ''}}">
                            <label>Billing Account</label> <span class="label label-warning btn-rounded"><label type="text" id="myoutstanding" name="myoutstanding" value="{{ Request::old('myoutstanding') ?: '' }}"></span>
                             
                          <select id="accounttype" name="accounttype" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:430px">
                         
                        <option value="Private">Private</option>
                          
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
                          <input type="text" class="form-control" id="fullname" data-required="true" value="{{ Request::old('fullname') ?: '' }}"  name="fullname">
                          @if ($errors->has('fullname'))
                          <span class="help-block">{{ $errors->first('fullname') }}</span>
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
                            <input type="text" rows="3" class="form-control" id="opd_number" name="opd_number" readonly="true" value="{{ Request::old('opd_number') ?: '' }}">   
                          </div>
                          <div class="col-sm-6">
                               <div class="form-group{{ $errors->has('referal_doctor') ? ' has-error' : ''}}">
                            <label>Doctor</label>
                            <select id="referal_doctor" name="referal_doctor" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:430px" disabled>
                          <option value="Non Assigned">Non Assigned</option>
                          @foreach($doctors as $doctor)
                        <option value="{{ $doctor->name }}">{{ $doctor->name }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('referal_doctor'))
                          <span class="help-block">{{ $errors->first('referal_doctor') }}</span>
                           @endif    
                          </div> 
                          </div>   
                        </div>
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('visit_type') ? ' has-error' : ''}}">
                            <label>Visit Type</label>
                            <select id="visit_type" name="visit_type" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:430px" disabled>
                          @foreach($visittypes as $visittypes)
                        <option value="{{ $visittypes->type }}">{{ $visittypes->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('visit_type'))
                          <span class="help-block">{{ $errors->first('visit_type') }}</span>
                           @endif    
                          </div>   
                          </div>


                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('consultation_type') ? ' has-error' : ''}}">
                            <label>Service Type</label>
                            <select id="consultation_type2" name="consultation_type2"  data-required="true" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                            <option value=""> -- Select Consultation -- </option>
                          @foreach($walkins as $servicetype)
                        <option value="{{ $servicetype->type }}">{{ $servicetype->type }} </option>
                          @endforeach
                        </select>         
                           @if ($errors->has('consultation_type'))
                          <span class="help-block">{{ $errors->first('consultation_type') }}</span>
                           @endif    
                          </div>   
                        </div>  
                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('last_visit_date') ? ' has-error' : ''}}">
                            <label>Last Visit Date</label>
                            <input type="text" rows="3" class="form-control" readonly="true" id="last_visit_date" name="last_visit_date" value="{{ Request::old('last_visit_date') ?: '' }}">
                           @if ($errors->has('last_visit_date'))
                          <span class="help-block">{{ $errors->first('last_visit_date') }}</span>
                           @endif    
                          </div>   
                          </div>
                          
                          <div class="col-sm-6">
                       <div class="form-group @if($errors->has('visit_date')) has-error @endif">
                        <label for="visit_date">Visit/Admission Date</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="visit_date" data-required="true" id="visit_date" placeholder="Select your time" value="{{ Carbon\Carbon::now() }}">
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
                        <button type="submit" class="btn btn-success btn-s-xs">Create Walk-In Visit</button>
                        
                      </footer>
                    </section>