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
                     
                  </div>

                     <div id="corporatetab" name="corporatetab">
                     
                  </div>
                       
                     
                     </div>
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Save Record</button>
                      </footer>
                    </section>