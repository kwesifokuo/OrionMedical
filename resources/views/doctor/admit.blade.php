<form  class="bootstrap-modal-form" method="post" data-validate="parsley" action="/create-ipd-opd" class="panel-body wrapper-lg">
                          <section class="panel panel-default">
                           <div class="panel-body">
                      <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('accounttype') ? ' has-error' : ''}}">
                            <label>Billing Account</label>
                            <select id="ipd_accounttype" name="ipd_accounttype" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                           <option value="{{ $visit_details->payercode }}">{{ $visit_details->payercode }}</option>
                          @foreach($accounttype as $accounttype)
                        <option value="{{ $accounttype->type }}">{{ $accounttype->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('accounttype'))
                          <span class="help-block">{{ $errors->first('accounttype') }}</span>
                           @endif    
                          </div>   
                          </div> 

                         <div class="col-sm-6">
                       <div class="form-group @if($errors->has('visit_date')) has-error @endif">
                        <label for="visit_date">Admission Date</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="visit_date" data-required="true" id="visit_date" placeholder="Select your time" value="{{ old('visit_date') }}">
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


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('visit_type') ? ' has-error' : ''}}">
                            <label>Visit Type</label>
                            <select id="visit_type" name="visit_type" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                         
                        <option value="Admission">Admission</option>
                         <option value="Detention">Detention</option>
                         
                        </select>         
                           @if ($errors->has('visit_type'))
                          <span class="help-block">{{ $errors->first('visit_type') }}</span>
                           @endif    
                          </div>   
                          </div>


                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('consultation_type') ? ' has-error' : ''}}">
                            <label>Admission Serive Type</label>
                            <select id="consultation_type" name="consultation_type" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                            <option value=""> -- Select Consultation -- </option>
                          @foreach($ipdservices as $ipd)
                        <option value="{{ $ipd->type }}">{{ $ipd->type }} </option>
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
                            <div class="form-group{{ $errors->has('visit_type') ? ' has-error' : ''}}">
                            <label>Ward Name</label>
                            <select id="location" name="location" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          @foreach($wards as $branch)
                        <option value="{{ $branch->ward_type }}">{{  $branch->ward_type }}</option>
                          @endforeach  
                        </select>         
                           @if ($errors->has('visit_type'))
                          <span class="help-block">{{ $errors->first('visit_type') }}</span>
                           @endif    
                          </div>   
                          </div>


                          <div class="col-sm-6">
                               <div class="form-group{{ $errors->has('referal_doctor') ? ' has-error' : ''}}">
                            <label>Bed Number</label>
                            <select id="ipd_referal_doctor" name="ipd_referal_doctor" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%" >
                            <option value="1">1</option>
                         <option value="2">2</option>
                          {{-- <option value="Non Assigned">Non Assigned</option>
                          @foreach($doctors as $doctor)
                        <option value="{{ $doctor->name }}">{{ $doctor->name }}</option>
                          @endforeach --}} 
                        </select>         
                           @if ($errors->has('referal_doctor'))
                          <span class="help-block">{{ $errors->first('referal_doctor') }}</span>
                           @endif    
                          </div> 
                          </div>   
                        </div>
                      </div> 
                    </section> 

                     <footer class="panel-footer text-right bg-light lter">
                      <input type="hidden" id="patient_id" name="patient_id" value="{{ $visit_details->patient_id }}">
                        <input type="hidden" id="myopdnumber" name="myopdnumber" value="{{ $visit_details->opd_number }}">
                        <input type="hidden" id="fullname" name="fullname" value="{{ $visit_details->name }}">
                         <input type="hidden" id="myaccounttype" name="myaccounttype" value="{{ $visit_details->payercode }}"> 
                        <input type="hidden" id="mycopayer" name="mycopayer" value="{{ $visit_details->care_provider }}"> 
                          <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <button type="submit" class="btn btn-success btn-s-xs">Click to Admit Patient</button>
                        
                      </footer>
                      </form>
