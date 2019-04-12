
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="#">Records</a></li>
                <li><a href="#">Manage Member</a></li>
                <li class="active">New</li>
              </ul>
              <div class="m-b-md">
                <h3 class="m-b-none">New Member</h3>
              </div>
              <div class="panel panel-default">
                <div class="wizard clearfix" id="form-wizard">
                  <ul class="steps">
                    <li data-target="#step1" class="active"><span class="badge badge-info">1</span>Personal Details</li>
                    <li data-target="#step2"><span class="badge">2</span>Contact</li>
                    <li data-target="#step3"><span class="badge">3</span>Insurance & Company Details</li>
                  </ul>
                </div>
                <div class="step-content">
                  <form>
                    <div class="step-pane active" id="step1">
                      <div class="clearfix m-b">

                          <a href="#" class="thumb-lg">
                            <img src="images/avatar_default.jpg" id="imagePreview"  class="img-circle">

                             <input type="file" height="40px" name="image" id="image" enctype="multipart/form-data">
                          </a>
                                
                        </div>
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Account Number</label> 
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
                            <select id="accounttype" name="accounttype" data-required="true"  rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
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
                    </div>
                    


                    <div class="step-pane" id="step2">
                       <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
                          <label>Email</label>
                          <input type="text" class="form-control" data-type="email" id="email" name="email" value="{{ Request::old('email') ?: '' }}"> 
                          @if ($errors->has('email'))
                          <span class="help-block">{{ $errors->first('email') }}</span>
                           @endif                            
                        </div>
                        </div>

                        <div class="col-sm-6">
                          <label>Mobile Number <span class="text-danger">*</span></label>
                          <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : ''}}">
                          <input type="text" class="form-control" id="mobile_number" data-type="phone" data-required="true" name="mobile_number" value="{{ Request::old('mobile_number') ?: '' }}">   
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

                         
                    </div>
                   </section> 


                   <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Communication
                    </header>
                      <div class="panel-body">
                       
                       <div class="form-group pull-in clearfix">
                           <div class="col-sm-6">
                            <label>Channel</label>
                            <select id="communication_channel" name="communication_channel" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value="SMS">SMS</option>
                          <option value="Phone Call">Phone Call</option>
                        </select>    
                          </div> 
                          </div>
                    </div>
                   </section>




                    </div>
                    <div class="step-pane" id="step3">
                      

                      <div id="insurancepane">
                      <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Insurance Details
                    </header>
                      <div class="panel-body">
                        
                           <div class="form-group pull-in clearfix">
                              <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('insurance_company') ? ' has-error' : ''}}">
                              <label>Membership Type</label>
                               <select id="insurance_company" name="insurance_company" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                               <option value=""> -- Not Set -- </option>
                              
                            <option value="Corporate">Corporate</option>
                            <option value="Individual">Individual</option>
                            <option value="Family">Family</option>
                              
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
                              <label>Cover / Plan</label>
                               <select id="insurance_cover" name="insurance_cover" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                               <option value=""> -- Not Set -- </option>
                               <option value="Comprehensive"> Comprehensive </option>
                               <option value="Standard"> Standard </option>
                               <option value="Platinum"> Platinum </option>
                               <option value="Adom"> Adom </option>
                                <option value="Unique"> Unique </option> 
                                <option value="Wisdom"> Wisdom </option> 
                                       
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

                  
                   <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Employer Details
                    </header>
                      <div class="panel-body">
                        <div class="form-group pull-in clearfix">
                              <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('company') ? ' has-error' : ''}}">
                              <label>Employer</label>
                               <select id="company" name="company" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
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


                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                    NHIS Status
                    </header>
                      <div class="panel-body">
                        <div class="form-group pull-in clearfix">
                              <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('company') ? ' has-error' : ''}}">
                              <label>Status</label>
                               <select id="nhia_status" name="nhia_status" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                               <option value=""> -- Not Set -- </option>
                             
                            <option value="Yes">Yes</option>
                              <option value="No">No</option>
                             
                            </select>                         
                              @if ($errors->has('company'))
                              <span class="help-block">{{ $errors->first('company') }}</span>
                               @endif           
                            </div>
                             </div>
                              <div class="col-sm-6">
                                <label>Scheme Code & number</label>
                                <input type="text" rows="3" class="form-control" id="staff_id" name="staff_id" value="{{ Request::old('staff_id') ?: '' }}">      
                              </div> 
                              </div>  


                    </div>
                   </section> 

                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                    Other Private Health Insurance Details
                    </header>
                      <div class="panel-body">
                        <div class="form-group pull-in clearfix">
                              <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('company') ? ' has-error' : ''}}">
                              <label>Insurer</label>
                               <select id="other_insurance" name="other_insurance" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                               <option value=""> -- Not Set -- </option>
                              @foreach($insurers as $insurer)
                            <option value="{{ $insurer->name }}">{{ $insurer->name }}</option>
                              @endforeach
                            </select>                         
                              @if ($errors->has('company'))
                              <span class="help-block">{{ $errors->first('company') }}</span>
                               @endif           
                            </div>
                             </div>
                              <div class="col-sm-6">
                                <label>Policy #</label>
                                <input type="text" rows="3" class="form-control" id="staff_id" name="staff_id" value="{{ Request::old('staff_id') ?: '' }}">      
                              </div> 
                              </div>  
                    </div>
                   </section> 



                   </div>
                  
                  <div id="alertclause">
                   <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
       
                    </header>
                      <div class="panel-body">
                        <div class="form-group pull-in clearfix">
                              <h3 class="m-b-none"> Please ensure information provided is true and valid before clicking save. </h3>  
                              </div>
                    </div>
                   </section> 
                   </div>



                   <footer>
                        <div class="btn-group pull-right">
                        {!! csrf_field() !!}
                        <button type="button" onclick="addPatient();" class="btn btn-sm btn-info"><i class=""></i> Save </button>
                        
                        </div>
                        </footer>
                    </div>                
                  </form>
                  <div class="actions m-t">
                    <button type="button" class="btn btn-default btn-sm btn-prev" data-target="#form-wizard" data-wizard="previous" disabled="disabled">Prev</button>
                    <button type="button" class="btn btn-default btn-sm btn-next" data-target="#form-wizard" data-wizard="next" data-last="Finish">Next</button>
                 
                  </div>


                       
                        
                       
                </div>
              </div>
            </section>
            </section>
            </section>
            @stop


            <script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
$(document).ready(function () {
   
    $('#insurance_cover').select2({
      tags: true
      });

    $('#company').select2({
      tags: true
      });

     $('#other_insurance').select2({
      tags: true
      });
        

  });
</script>

<script type="text/javascript">
$(function () {
  $('#date_of_birth').daterangepicker({
     "minDate": moment('1930-06-14'),
      "maxDate": moment(),
      "singleDatePicker":true,
      "autoApply": true,
      "showDropdowns": true,
      "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});


</script>

<script type="text/javascript">
$(function () {
  $('#visit_date').daterangepicker({
     "minDate": moment('2017-02-01'),
     "maxDate": moment(),
    "singleDatePicker":true,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>


<script type="text/javascript">
    function notbusiness()
{
  if($('#accounttype').val() != "Private")
   {
     $('#insurancepane').show();
     


   }

   else
   {
     $('#insurancepane').hide();
     
    
   }

}

</script>
<script type="text/javascript">
$(function () {
  $('#expiry_date').daterangepicker({
     "minDate": moment(),
    "singleDatePicker":true,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});



function addPatient()
{
if($('#accounttype').val()=="Health Insurance" & $('#insurance_company').val()=="")
  {document.getElementById('insurance_company').focus();sweetAlert("Please select insurance company ",'Fill all fields', "error");}

else if($('#accounttype').val()=="Health Insurance" & $('#insurance_id').val()=="")
  {document.getElementById('insurance_id').focus(); sweetAlert("Please enter insurance number ",'Fill all fields', "error"); }

else if($('#accounttype').val()=="Health Insurance" & $('#insurance_cover').val()=="")
  {document.getElementById('insurance_cover').focus(); sweetAlert("Please enter insurance cover ",'Fill all fields', "error");  }

  else if($('#accounttype').val()=="Health Insurance" & $('#company').val()=="")
  {document.getElementById('company').focus(); sweetAlert("Please select company of insured ",'Fill all fields', "error");  }

else
  {

    $.get('/create-patient',
        {
          "fullname"                   :$('#fullname').val(),
          "accounttype"                :$('#accounttype').val(),
          "blood_group"                :$('#blood_group').val(),
          "postal_address"             :$('#postal_address').val(),
          "residential_address"        :$('#residential_address').val(),
          "email"                      :$('#email').val(),
          "mobile_number"              :$('#mobile_number').val(),
          "date_of_birth"              :$('#date_of_birth').val(),
          "occupation"                 :$('#occupation').val(),
          "place_of_birth"             :$('#place_of_birth').val(),
          "gender"                     :$('#gender').val(),
          "insurance_company"          :$('#insurance_company').val(),
          "company"                    :$('#company').val(),
          "nationality"                :$('#nationality').val(),
          "insurance_id"               :$('#insurance_id').val(),
          "civil_status"               :$('#civil_status').val(),

          "id_type"                    :$('#id_type').val(),
          "kin_name"                   :$('#kin_name').val(),    
          "kin_phone"                  :$('#kin_phone').val(),    
          "kin_relationship"           :$('#kin_relationship').val(),
          "insurance_cover"            :$('#insurance_cover').val(),    
          "insurance_eligibility"      :$('#insurance_eligibility').val(),
          "parent_id"                  :$('#parent_id').val(),    
          "link_type"                  :$('#link_type').val(),
          "expiry_date"                :$('#expiry_date').val()


        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          toastr.success("Customer successfully saved!");
          
          window.location = "/patient-profile-limited/"+data["ReferenceNumber"];
        
        }
        else
        {
          toastr.error("Customer failed to save!");
          
        }
      });
                                        
        },'json');
  }
 
}
</script>
