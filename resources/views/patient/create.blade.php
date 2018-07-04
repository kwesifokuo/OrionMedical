                    <section class="panel panel-default">
                      <div class="panel-body">
                       
                        <div class="clearfix m-b">

                          <a href="#" class="thumb-lg">
                            <img src="images/avatar_default.jpg" id="imagePreview"  class="img-circle">

                             <input type="file" height="40px" name="image" id="image" enctype="multipart/form-data">
                          </a>
                                
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
                            <label>Account Type <span class="text-danger">*</span></label>
                            <select id="accounttype" name="accounttype" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" onchange="gettabstatus()">
                            <option value=""> -- Select Account Type -- </option>
                          @foreach($accounttype as $accounttype)
                        <option value="{{ $accounttype->type }}">{{ $accounttype->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('accounttype'))
                          <span class="help-block">{{ $errors->first('accounttype') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                      
                       <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                         <div class="form-group{{ $errors->has('fullname') ? ' has-error' : ''}}">
                          <label>Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="fullname" data-required="true" value="{{ Request::old('fullname') ?: '' }}"  name="fullname">
                          @if ($errors->has('fullname'))
                          <span class="help-block">{{ $errors->first('fullname') }}</span>
                           @endif                        
                        </div>
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                        <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : ''}}">
                          <label>Date of Birth  <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" value="{{ Request::old('dateofbirth') ?: '' }}"   id="date_of_birth" name="date_of_birth" placeholder="dd/mm/YYYY"> 
                                        
                          @if ($errors->has('date_of_birth'))
                          <span class="help-block">{{ $errors->first('date_of_birth') }}</span>
                           @endif           
                        </div>
                        </div>
                        </div>
                        

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : ''}}">
                          <label>Gender <span class="text-danger">*</span></label>
                           <select id="gender" name="gender" rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                          <option value=""> -- Select Gender -- </option>
                          @foreach($gender as $gender)
                        <option value="{{ $gender->type }}">{{ $gender->type }}</option>
                          @endforeach
                        </select>                         
                          @if ($errors->has('gender'))
                          <span class="help-block">{{ $errors->first('gender') }}</span>
                           @endif           
                        </div>
                        </div>
                        </div>

                         


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                         <div class="form-group{{ $errors->has('occupation') ? ' has-error' : ''}}">
                          <label>Occupation</label>
                          <input type="text" class="form-control" id="occupation" name="occupation" value="{{ Request::old('occupation') ?: '' }}"> 
                          @if ($errors->has('occupation'))
                          <span class="help-block">{{ $errors->first('occupation') }}</span>
                           @endif                                  
                        </div>
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
                          <label>Email</label>
                          <input type="text" class="form-control" id="email" name="email" value="{{ Request::old('email') ?: '' }}"> 
                          @if ($errors->has('email'))
                          <span class="help-block">{{ $errors->first('email') }}</span>
                           @endif                            
                        </div>
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <label>Mobile Number <span class="text-danger">*</span></label>
                          <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : ''}}">
                          <input type="text" class="form-control" id="mobile_number" data-required="true" name="mobile_number" value="{{ Request::old('mobile_number') ?: '' }}">   
                          @if ($errors->has('mobile_number'))
                          <span class="help-block">{{ $errors->first('mobile_number') }}</span>
                           @endif                           
                        </div>
                        </div>
                        </div>

                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-4">
                            <label>Residential Address <span class="text-danger">*</span></label> 
                            <div class="form-group{{ $errors->has('residential_address') ? ' has-error' : ''}}">
                            <textarea type="text" rows="3" class="form-control" id="residential_address" name="residential_address" data-required="true" value="{{ Request::old('residential_address') ?: '' }}"></textarea>   
                           @if ($errors->has('residential_address'))
                          <span class="help-block">{{ $errors->first('residential_address') }}</span>
                           @endif    
                          </div>
                          </div>
                      
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('office_address') ? ' has-error' : ''}}">
                            <label>Office Address</label>
                            <textarea type="text" rows="3" class="form-control" id="office_address" name="office_address" value="{{ Request::old('office_address') ?: '' }}"></textarea>     
                           @if ($errors->has('office_address'))
                          <span class="help-block">{{ $errors->first('office_address') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-4">
                            <label>Postal Address</label> 
                            <div class="form-group{{ $errors->has('postal_address') ? ' has-error' : ''}}">
                            <textarea type="text" rows="3" class="form-control" id="postal_address" name="postal_address" value="{{ Request::old('postal_address') ?: '' }}"></textarea>   
                           @if ($errors->has('postal_address'))
                          <span class="help-block">{{ $errors->first('postal_address') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                     
                         
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('civil_status') ? ' has-error' : ''}}"> 
                            <label>Civil Status</label>
                            <select id="civil_status" name="civil_status" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                             <option value=""> -- Select Civil Status -- </option>
                          @foreach($civilstatus as $civilstatus)
                        <option value="{{ $civilstatus->type }}">{{ $civilstatus->type }}</option>
                          @endforeach
                        </select>    
                          @if ($errors->has('civil_status'))
                          <span class="help-block">{{ $errors->first('civil_status') }}</span>
                           @endif      
                            </div>
                          </div>
                        

                        <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('nationality') ? ' has-error' : ''}}"> 
                            <label>Nationality</label>
                            <select id="nationality" name="nationality" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                             <option value="Ghanaian">Ghanaian</option>
                          @foreach($nationalities as $nationality)
                        <option value="{{ $nationality->nationality }}">{{ $nationality->nationality }}</option>
                          @endforeach
                        </select>    
                          @if ($errors->has('nationality'))
                          <span class="help-block">{{ $errors->first('nationality') }}</span>
                           @endif      
                            </div>
                          </div>
                        </div>


                      {{--   <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('id_type') ? ' has-error' : ''}}"> 
                            <label>National ID Type</label>
                            <select id="id_type" name="id_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value=""> -- Select ID Type -- </option>
                          @foreach($identifications as $identification)
                        <option value="{{ $identification->type }}">{{ $identification->type }}</option>
                          @endforeach
                        </select>    
                          @if ($errors->has('id_type'))
                          <span class="help-block">{{ $errors->first('id_type') }}</span>
                           @endif      
                            </div>
                          </div>

                          
                          <div class="col-sm-6">
                           <div class="form-group{{ $errors->has('id_number') ? ' has-error' : ''}}"> 
                            <label>ID Number</label>
                              <input type="text" class="form-control" id="id_number" name="id_number" value="{{ Request::old('id_number') ?: '' }}">    
                            @if ($errors->has('id_number'))
                          <span class="help-block">{{ $errors->first('id_number') }}</span>
                           @endif             
                          </div>   
                        </div>
                        </div>
 --}}
                       {{--  <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                           <div class="form-group{{ $errors->has('blood_group') ? ' has-error' : ''}}"> 
                            <label>Blood Group</label>
                             <select id="blood_group" name="blood_group" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value=""> -- Select Group -- </option>
                          @foreach($bloodgroup as $bloodgroup)
                        <option value="{{ $bloodgroup->type }}">{{ $bloodgroup->type }}</option>
                          @endforeach
                        </select>    
                            @if ($errors->has('blood_group'))
                          <span class="help-block">{{ $errors->first('blood_group') }}</span>
                           @endif             
                          </div>   
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group{{ $errors->has('blood_type') ? ' has-error' : ''}}"> 
                            <label>Blood Type</label>
                             <select id="blood_type" name="blood_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value=""> -- Select Type -- </option>
                        @foreach($bloodgroup as $bloodgroup)
                        <option value="{{ $bloodgroup->type }}">{{ $bloodgroup->type }}</option>
                          @endforeach 
                        </select>    
                            @if ($errors->has('blood_type'))
                          <span class="help-block">{{ $errors->first('blood_type') }}</span>
                           @endif             
                          </div>   
                        </div>
                        </div> --}}
                          
                           <div id="contactperson" name="contactperson">
                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Incase of Emergency (Contact Person Details)
                    </header>
                      <div class="panel-body">
                       <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Name<span class="text-danger">*</span></label> 
                            <input type="text" rows="3" class="form-control" data-required="true" id="kin_name" name="kin_name" value="{{ Request::old('kin_name') ?: '' }}">   
                          </div>
                         
                            
                           
                           <div class="col-sm-6">
                            <label>Relationship</label>
                            <select id="kin_relationship" name="kin_relationship" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value="">-- Not set --</option>
                          @foreach($relationships as $relationship)
                            <option value="{{ $relationship->type }}">{{ $relationship->type }}</option>
                          @endforeach
                        </select>    
                          </div> 
                          </div>


                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Contact Number<span class="text-danger">*</span></label>
                            <input type="text" rows="3" class="form-control" data-required="true" id="kin_phone" name="kin_phone" value="{{ Request::old('kin_phone') ?: '' }}">      
                          </div>   
                          <div class="col-sm-6">
                            <label>Email</label>
                            <input type="text" rows="3" class="form-control" id="kin_email" name="kin_email" value="{{ Request::old('kin_email') ?: '' }}">      
                          </div>  
                          </div> 

                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Parent ID</label>
                            <input type="text" rows="3" class="form-control"  id="parent_id" name="parent_id" value="{{ Request::old('parent_id') ?: '' }}">      
                          </div>   
                          <div class="col-sm-6">
                            <label>Link Type</label>
                            <input type="text" rows="3" class="form-control" id="link_type" placeholder="Dependant" name="link_type" value="{{ Request::old('link_type') ?: '' }}">      
                          </div>  
                          </div> 

                    </div>
                   </section> 
                  </div>
    
                       <div id="insurancetab" name="insurancetab">
                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Insurance Details
                    </header>
                      <div class="panel-body">
                        
                           <div class="form-group pull-in clearfix">
                              <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('insurance_company') ? ' has-error' : ''}}">
                              <label>Insurer</label>
                               <select id="insurance_company" name="insurance_company" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                               <option value=""> -- Not Set -- </option>
                              @foreach($insurers as $insurer)
                            <option value="{{ $insurer->name }}">{{ $insurer->name }}</option>
                              @endforeach
                            </select>                         
                              @if ($errors->has('insurance_company'))
                              <span class="help-block">{{ $errors->first('insurance_company') }}</span>
                               @endif           
                            </div>
                             </div>
                              <div class="col-sm-6">
                                <label>Policy Number</label>
                                <input type="text" rows="3" class="form-control" id="insurance_id" name="insurance_id" value="{{ Request::old('insurance_id') ?: '' }}">      
                              </div> 
                              </div> 

                              <div class="form-group pull-in clearfix">
                              <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('insurance_cover') ? ' has-error' : ''}}">
                              <label>Group Plan</label>
                               <select id="insurance_cover" name="insurance_cover" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                               <option value=""> -- Not Set -- </option>
                               <option value="Comprehensive"> Comprehensive </option>
                               <option value="Standard"> Standard </option>
                               <option value="Platinum"> Platinum </option>
                               <option value="Mercury"> Mercury </option>
                                <option value="Emerald"> Emerald </option> 
                                <option value="Diamond"> Diamond </option> 
                                       
                            </select>                         
                              @if ($errors->has('insurance_cover'))
                              <span class="help-block">{{ $errors->first('insurance_cover') }}</span>
                               @endif           
                            </div>
                             </div>
                              <div class="col-sm-6">
                                <label>Eligibility</label>
                                <select id="insurance_eligibility" name="insurance_eligibility" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                               <option value="Not Verified"> Not Verified </option>
                               <option value="Verified"> Verified </option>
                            </select>        
                              </div> 
                              </div> 

                            

                              <div class="form-group pull-in clearfix">
                              <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('expiry_date') ? ' has-error' : ''}}">
                              <label>Expiry Date</label>
                              

                             <input type="text" class="form-control" value="{{ Request::old('expiry_date') ?: '' }}"   id="expiry_date" name="expiry_date" placeholder="dd/mm/YYYY"> 
                                        
                          @if ($errors->has('expiry_date'))
                          <span class="help-block">{{ $errors->first('expiry_date') }}</span>
                           @endif           
                        </div>

                             </div>
                              <div class="col-sm-6">
                                <label>Authorization Letter (Scan & Upload)</label>
                                <input type="file" rows="3" class="form-control" id="auth_letter" name="auth_letter">      
                              </div> 
                              </div>   
              

                    </div>
                   </section> 
                  </div>

                     <div id="corporatetab" name="corporatetab">
                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Employer Details
                    </header>
                      <div class="panel-body">
                        <div class="form-group pull-in clearfix">
                              <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('company') ? ' has-error' : ''}}">
                              <label>Employer</label>
                               <select id="company" name="company" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                               <option value=""> -- Not Set -- </option>
                              @foreach($companies as $company)
                            <option value="{{ $company->name }}">{{ $company->name }}</option>
                              @endforeach
                            </select>                         
                              @if ($errors->has('company'))
                              <span class="help-block">{{ $errors->first('company') }}</span>
                               @endif           
                            </div>
                             </div>
                              <div class="col-sm-6">
                                <label>Staff #</label>
                                <input type="text" rows="3" class="form-control" id="staff_id" name="staff_id" value="{{ Request::old('staff_id') ?: '' }}">      
                              </div> 
                              </div>  
                    </div>
                   </section> 
                  </div>
                       
                     
                     </div>
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Save Record</button>
                      </footer>
                    </section>