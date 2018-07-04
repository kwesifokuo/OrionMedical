
@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
                    <p><span class="label label-success">{{ $visit_details->consultation_type }} - {{ $visit_details->name }}</span></p> 
                    <p class="block"><a href="#" class=""></a> <span class="label label-warning btn-rounded">{{ $visit_details->visit_type }}</span></p>
                     <p class="block"><a href="#" class=""></a> <span class="label label-success btn-rounded">{{ $visit_details->opd_number }}</span></p>
                     <p class="block"><a href="#" class=""></a> <span class="label label-danger btn-rounded">Created : {{ Carbon\Carbon::parse($visit_details->created_on)->diffForHumans() }}</span></p>

                     <div class="btn-group pull-right">
                    <p>
        <a href="#" class="btn btn-rounded btn-sm btn-info"><i class="fa fa-fw fa-user"></i> {{ $visit_details->payercode }}</a>
        <a href="#" class="btn btn-rounded btn-sm btn-primary"><i class="fa fa-fw fa-home"></i> {{ $visit_details->care_provider }} </a>
                    </p>
              </div>
            </header>
            <section class="scrollable">
              <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="clearfix m-b">
                          <a href="/images/avatar_default.jpg" class="pull-left thumb m-r">
                            <img src="/images/avatar_default.jpg" class="img-circle 3x">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs">{{ $visit_details->name }}</div>
                            <br>
                            <div>
                          
                           <p class="block"><a href="#" class="">ID # </a> <span class="label label-default">{{ $visit_details->patient_id }}</span></p>
                            </div>
                          </div>                
                        </div>
                        <div class="panel wrapper panel-success">
                          <div class="row">
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">NA</span>
                                 <input type="hidden" id="accounttype" name="accounttype" value="{{ $visit_details->payercode }}">
                                    <input type="hidden" id="opd_number" name="opd_number" value="{{ $visit_details->opd_number }}">
                                   <input type="hidden" id="fullname" name="fullname" value="{{ $visit_details->name }}">
                                    <input type="hidden" id="patient_id" name="patient_id" value="{{ $visit_details->patient_id }}">
                                <small class="text-muted">Gender</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                0
                                <small class="text-muted">Age</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h5 block">NA</span>
                                <small class="text-muted">Status</small>
                              </a>
                            </div>
                          </div>
                        </div>
                       <br>
                      
                        <div>
                          

                          <ul class="list-group no-radius">
                         <h5>
                                <span>Vitals</span>
                               @foreach($myvitals as $vital)
                               <ul>
                                <label class="badge bg-danger"> {{ $vital->created_on }} </label>
                                @if($vital->weight == '') @else <li> Weight <label class="badge bg-info"> {{$vital->weight}}  </label></li> @endif
                                @if($vital->height == '') @else <li> Height <label class="badge bg-info"> {{$vital->height}}  </label></li> @endif

                                 @if($vital->height == '') @else <li> BMI <label class="badge bg-info"> {{ $vital->bmi }}  </label> {{ $vital->bmi_status }}</li> @endif

                                @if($vital->temperature == '') @else <li> Temperature <label class="badge bg-info"> {{$vital->temperature}} ° </label>{{ $vital->temp_status }}</li> @endif
                                @if($vital->pulse_rate == '') @else <li> Pulse Rate <label class="badge bg-info"> {{$vital->pulse_rate}}  </label></li> @endif
                                @if($vital->bp_status == '') @else <li> Blood Pressure <label class="badge bg-info"> {{$vital->sbp }} / {{ $vital->dbp  }} </label>{{$vital->bp_status}}</li> @endif
                                 @if($vital->waist_circumference == '') @else <li> Waist Circumference <label class="badge bg-info"> {{$vital->waist_circumference }} </label></li> @endif
                                  @if($vital->hip_circumference == '') @else <li> Hip Circumference <label class="badge bg-info"> {{$vital->hip_circumference }} </label></li> @endif
                                 </ul>
                                 <div class="line"></div>
                               @endforeach
                              </h5>

                        </ul>
                          <br>
                     
                          
                          <img src="/images/188062.svg"> 
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>


                
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                    
                     
                        @if($visit_details->consultation_type == "WALK-IN DIAGNOSTIC")
                         <li class=""><a href="#review-investigation" data-toggle="tab"><i class="fa fa-film text-default"></i> Lab / Investigations </a></li>
                        
                        @elseif($visit_details->consultation_type == "WALK-IN PHARMACY")
                        <li class=""><a href="#review-medication" data-toggle="tab"><i class="fa fa-flask text-default"></i> Medication </a></li>

                        @else

                        @endif
                      </ul>
                    </header>



                     <div class="panel-body">
                     <div class="tab-content"> 


                         @if($visit_details->consultation_type == "WALK-IN DIAGNOSTIC")
                        <div class="tab-pane active" id="review-investigation">
                          <section class="panel panel-default">
                      <div class="panel-body">
                 
                       <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <select id="investigation" name="investigation" rows="3" tabindex="1" data-placeholder="Search investigation ..." style="width:100%">
                           <option value="">-- Select Investigation --</option>
                           @foreach($investigations as $investigation)
                        <option value="{{ $investigation->type }}">{{ $investigation->type }}</option>
                          @endforeach
                        </select>         
                          </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label>Remarks</label> 
                            <div class="form-group{{ $errors->has('investigation_remark') ? ' has-error' : ''}}">
                            <textarea type="text" rows="3" class="form-control" id="investigation_remark" name="investigation_remark" value="{{ Request::old('investigation_remark') ?: '' }}"></textarea>   
                           @if ($errors->has('investigation_remark'))
                          <span class="help-block">{{ $errors->first('investigation_remark') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>
                        <footer class="panel-footer text-right bg-light lter">
                        
                        <button type="button" onclick="addInvestigation()" class="btn btn-success btn-s-xs">Add Investigation</button>
                        
                      </footer>
                      </div>
                      
                    </section>
                     <img src="/images/212327.svg" width="10%" align="right"> 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Investigation History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="investigationsTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                              <th>Investigation</th>
                              <th>Cost</th>
                              <th>Date</th>
                              <th>Status</th>
                              <th>Requested By</th>
                               <th>Remarks</th>
                              <th></th>
                              <th></th>
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

                  @else

                  @endif



               

              

                 

                  


                  
                 

                   
 
 

                   
                    @if($visit_details->consultation_type == "WALK-IN PHARMACY")

                  <div class="tab-pane active" id="review-medication">
                    <section class="panel panel-default">
                      <div class="panel-body">
                 
                      <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                          <div class="input-group m-b">
                           <select id="medication" name="medication" rows="3" onchange="getdrugdetail()" tabindex="1" data-placeholder="Search medication ..." style="width:100%">
                           <option value="">-- Select drug from pharmacy--</option>
                          @foreach($drugs as $drugs)
                        <option value="{{ $drugs->id }}">{{ $drugs->name }} - {{$drugs->generic_name }}</option>
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
                           
                  <div class="col-sm-8">
                    <label>Dosage Remark</label> 
                      <select id="drug_application" name="drug_application" rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="">-- Select drug from pharmacy--</option>
                          @foreach($application as $dosage_remark)
                        <option value="{{ $dosage_remark->remark }}">{{ $dosage_remark->remark  }}</option>
                          @endforeach
                        </select>
                           @if ($errors->has('drug_application'))
                          <span class="help-block">{{ $errors->first('drug_application') }}</span>
                           @endif    
                          </div>


                           <div class="col-sm-4">
                            <label> Number of Day(s) </label> 
                           <input type="number" class="form-control" class="text-success" id="drug_quantity"  value="{{ Request::old('drug_quantity') ?: '' }}"  name="drug_quantity">
                          @if ($errors->has('drug_quantity'))
                          <span class="help-block">{{ $errors->first('drug_quantity') }}</span>
                           @endif   
                          </div> 
                        </div>
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                        @if($visit_details->created_by == Auth::user()->getNameOrUsername())
                        <a href="https://reference.medscape.com/drug-interactionchecker" target="_new" class="btn btn-dark btn-s-xs">Drug Interaction Checker</a>
                        <button type="button" onclick="addDrug()" class="btn btn-success btn-s-xs">Add Medication</button>
                        @else
                        @endif
                      </footer>
                    </section>
                       <img src="/images/139202.svg" width="10%" align="right"> 
                      <section>
                      
                      </section>
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Medication History</header>
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
                              <th>Requested By</th>
                              <th></th>
                               <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                    </div>
                    </div>
                    </section>

                       <div class="line"></div>
                 <div>
                 <a href="/print-prescription/{{ $visit_details->opd_number }}"  class="btn btn-sm btn-dark pull-right" name="visitid" id="visitid" > <i class="fa fa-file"></i>  Print Prescription </a>
                </div>
                  </div>

                  @else

                  @endif



                   <div class="tab-pane" id="review-procedure">
                                      <section class="panel panel-default">
                      <div class="panel-body">
                 
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <select id="procedure" name="procedure" rows="3" tabindex="1" data-placeholder="Search procedure ..." style="width:100%">
                           <option value="">-- Select Procedure --</option>
                          @foreach($treatments as $treatment)
                        <option value="{{ $treatment->type }}">{{ $treatment->type }}</option>
                          @endforeach
                        </select>         
                          </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label>Remarks</label> 
                            <div class="form-group{{ $errors->has('experience_comment') ? ' has-error' : ''}}">
                            <textarea type="text" rows="3" class="form-control" id="experience_comment" name="experience_comment" value="{{ Request::old('experience_comment') ?: '' }}"></textarea>   
                           @if ($errors->has('experience_comment'))
                          <span class="help-block">{{ $errors->first('experience_comment') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                      </div>
                             

                      <footer class="panel-footer text-right bg-light lter">
                        @if($visit_details->referal_doctor == Auth::user()->getNameOrUsername())
                        <button type="button" onclick="addProcedure()" class="btn btn-success btn-s-xs">Add Procedure</button>
                        @else
                        @endif
                      </footer>
                    </section>
                          
 <img src="/images/128639.svg" width="10%" align="right"> 
                          <section class="panel panel-info">
                                <header class="panel-heading font-bold">Procedure History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="procedureTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                          
                            <th>Procedure</th>
                              <th>Cost</th>
                              <th>Date</th>
                              <th>Status</th>
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


                   <div class="tab-pane" id="review-history">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div class="table-responsive">
                          <header class="panel-heading font-bold">
                                 <a href="#new-history" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-info pull-right">+</span></a>
                                </header>
                       <table id="historyTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                             <th>Medical History</th>
                            <th>Family History</th>
                            <th>Social History</th>
                             <th>Vacinnations History</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                    </div>
                      </ul>
                  </div>


                  <div class="tab-pane" id="review-assessment">
                          <section class="panel panel-default">
                      <div class="panel-body">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label class="badge bg-default">Plan</label> 
                            <div class="form-group{{ $errors->has('assessment') ? ' has-error' : ''}}">
                            <textarea type="text" rows="10" class="form-control" id="assessment" name="assessment" value="{{ Request::old('assessment') ?: '' }}"></textarea>   
                           @if ($errors->has('assessment'))
                          <span class="help-block">{{ $errors->first('assessment') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                      </div>
                      <footer class="panel-footer text-right bg-light lter">
                        @if($visit_details->referal_doctor == Auth::user()->getNameOrUsername())
                        <button type="button" onclick="addAssessment()" class="btn btn-success btn-s-xs">Add Plan</button>
                        @else
                        @endif
                      </footer>
                    </section>

                    <img src="/images/439190.svg" width="10%" align="right"> 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Plan History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="assessmentTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                              <th>Plan</th>
                              <th>Added By</th>
                              <th>Date</th>
                              <th></th>
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

                  {{-- <div class="tab-pane" id="review-plan">
                          <section class="panel panel-default">
                      <div class="panel-body">
                 
                

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label class="badge bg-default">Plan</label> 
                            <div class="form-group{{ $errors->has('treament_plan') ? ' has-error' : ''}}">
                            <textarea type="text" rows="10" class="form-control" id="treament_plan" name="treament_plan" value="{{ Request::old('treament_plan') ?: '' }}"></textarea>   
                           @if ($errors->has('treament_plan'))
                          <span class="help-block">{{ $errors->first('treament_plan') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label class="badge bg-default">Action</label> 
                            <div class="form-group{{ $errors->has('treament_plan_action') ? ' has-error' : ''}}">
                            <textarea type="text" rows="10" class="form-control" id="treament_plan_action" name="treament_plan_action" value="{{ Request::old('treament_plan_action') ?: '' }}"></textarea>   
                           @if ($errors->has('treament_plan_action'))
                          <span class="help-block">{{ $errors->first('treament_plan_action') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>
                      </div>
                      <footer class="panel-footer text-right bg-light lter">
                        @if($visit_details->referal_doctor == Auth::user()->getNameOrUsername())
                        <button type="button" onclick="addPlan()" class="btn btn-success btn-s-xs">Add Plan</button>
                        @else
                        @endif
                      </footer>
                    </section>
                    <img src="/images/432215.svg" width="10%" align="right"> 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Plan History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="planTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                              <th>Plan</th>
                              <th>Action</th>
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
                    </div>
                    </section>
                  </div> --}}

                  <div class="tab-pane" id="review-documents">
                         <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <header class="panel-heading">
                      <a href="#attach_document" class="bootstrap-modal-form-open" data-toggle="modal"><span class="label bg-success pull-right">Add New</span></a>
                      
                    </header>
                          <div class="row">
                  

                     
                     @foreach($images as $keys => $image)
                   

                   <div class="col-md-3 col-sm-4 thumb-lg">
  
                    @if($image->mime == 'docx')
                   <a href="{!! '/uploads/images/'.$image->filepath !!}" target="_blank">
                              <img src="{!! '/images/ms_word.png' !!}" class="img-circle">
                              </a>  {{ $image->filename }}  <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                    @elseif($image->mime == 'pdf')
                     <a href="{!! '/uploads/images/'.$image->filepath !!}" target="_blank">
                              <img src="{!! '/images/pdf.png' !!}" class="img-circle">
                              </a>{{ $image->filename }} <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a> <span class="label label-default btn-rounded">{{ $image->created_on->diffForHumans() }}</span>
                      @else 
                     <a href="{!! '/uploads/images/'.$image->filepath !!}" target="_blank">
                              <img src="{!! '/uploads/images/'.$image->filepath !!}" class="img-circle">
                              </a> {{ $image->filename }}  <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                    @endif        
                      </div>
                    @endforeach


                    </div>
                          </ul>
                        </div>

               
                      </div>
                      </div>
                    </section>
               
                </aside>


    
                    </section>
                    </section>
                    </section>



  @stop


  <script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
$(function () {
   $('#time').daterangepicker({
    "minDate": moment('2016-06-14 0'),
     "singleDatePicker":true,
    "timePicker": true,
    "timePicker24Hour": true,
    "timePickerIncrement": 15,
    "autoApply": true,
    "locale": {
      "format": "DD/MM/YYYY HH:mm:ss",
      "separator": " - ",
    }
  });
});
</script>


<script type="text/javascript">

$(document).ready(function () {
                loadMedication();
                loadComplaints();
                loadInvestigation();
                loadDiagnosis();
                loadProcedure();
                loadHistory();
                loadVitals();
                loadAssessment();
                loadPlan();

    $('#investigation').select2();  
     $('#procedure').select2();
     $('#medication').select2();
  
    $('#complaint').select2({
      tags: true
      });

     $('#directquestion').select2({
      tags: true
      });

    $('#drug_application').select2({
      tags: true
      });
   
    $('#history').select2({
      tags: true
      });
     $('#diagnosis').select2({
      tags: true
      });
    
    $('#social_history').select2({
      tags: true
      });
    $('#medical_history').select2({
      tags: true
      });
    $('#family_history').select2({
      tags: true
      });
    $('#vaccinations_history').select2({
      tags: true
      });
    $('#drug_history').select2({
      tags: true
      });
    $('#surgical_history').select2({
      tags: true
      });
    $('#reproductive_history').select2({
      tags: true
      });
    $('#allergy').select2({
      tags: true
      });
     $('#complaint_assoc').select2({
      tags: true
      });

     $('#ros_throat').select2({
      tags: true
      });

     $('#ros_nose').select2({
      tags: true
      });

     $('#ros_eyes').select2({
      tags: true
      });

     $('#ros_head').select2({
      tags: true
      });

     $('#ros_skin').select2({
      tags: true
      });

     $('#ros_constitutional').select2({
      tags: true
      });

     $('#ros_ears').select2({
      tags: true
      });

       $('#ros_respiratory').select2({
      tags: true
      });

      $('#ros_cardiovasular').select2({
      tags: true
      });

      $('#ros_gastro').select2({
      tags: true
      });

      $('#ros_gynecology').select2({
      tags: true
      });

      $('#ros_genitourinary').select2({
      tags: true
      });

      $('#ros_endocrine').select2({
      tags: true
      });

      $('#ros_musculoskeletal').select2({
      tags: true
      });

      $('#ros_peripheral_vascular').select2({
      tags: true
      });

      $('#ros_hematology').select2({
      tags: true
      });

      $('#ros_neuropsychiatric').select2({
      tags: true
      });


      $('#pe_general').select2({
      tags: true
      });

        $('#pe_respiratory').select2({
      tags: true
      });

      $('#pe_HEENT').select2({
      tags: true
      });

      $('#pe_neck').select2({
      tags: true
      });

      $('#pe_abdominal').select2({
      tags: true
      });

      $('#pe_psychological').select2({
      tags: true
      });

       $('#pe_breast').select2({
      tags: true
      });


      $('#pe_lungs').select2({
      tags: true
      });

      $('#pe_musculoskeletal').select2({
      tags: true
      });

      $('#pe_heart').select2({
      tags: true
      });

      $('#pe_cns').select2({
      tags: true
      });

      $('#pe_extremities').select2({
      tags: true
      });

       $('#vital_remark').select2({
      tags: true
      });

  });
</script>





  <script type="text/javascript">

 function addVitals()
{
if($('#weight').val()!= "" && $('#height').val()!="")
{

    $.get('/add-vitals',
        {
          "patient_id": $('#patient_id').val(),
          "opd_number": $('#opd_number').val(),
          "weight": $('#weight').val(),
          "height": $('#height').val(),
          "waist_circumference": $('#waist_circumference').val(),
          "hip_circumference":  $('#hip_circumference').val(),
          "frame": $('#frame').val(),
          "b_fat": $('#b_fat').val(),
          "v_fat": $('#v_fat').val(),
          "diastolic": $('#diastolic').val(),
          "systolic": $('#systolic').val(),
          "pulse_rate": $('#pulse_rate').val(),
          "blood_pressure": $('#blood_pressure').val(),
          "respiration": $('#respiration').val(),
          "temperature": $('#temperature').val()                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
         
           loadVitals();

        }
        else
        {
          sweetAlert("Vital parameters failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please enter weight and height!");}
}
    function getdrugdetail()
{ 
   //alert($('#medication').val());

  $.get("/get-drug-info",
          {"medication": $('#medication').val()},
          function(json)
          {
                 getDrugAvailable();
            
                $('#drug_dosage').val(json['drug_dosage']);
                $('#drug_form').val(json['drug_form']);
                $('#drug_pack_size').val(json['drug_pack_size']);
                $('#drug_generic').val(json['drug_generic']);
                $('#drug_quantity').val("");

               
                
              //}
          },
          'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}

  function deletedrug(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+name+" from the prescription list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/delete-medication',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was removed from prescription list.", "success"); 
             loadMedication();
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from prescription.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to be removed from prescription.", "error");   
        } });

    
   }


function addNote()
{
if($('#complaint').val()!= "")
{

  //alert($('#editor').html());
    $.get('/add-note',
        {
          // Chief Complaint & HPI
            "patient_id": $('#patient_id').val(),
          "opd_number": $('#opd_number').val(),
          "complaint": $('#complaint').val(),
          "com_period": $('#com_period').val(),
          "com_span":  $('#com_span').val(),
          "com_remark":  $('#com_remark').val(),
          "presentingcomplaint":  $('#editor').html(),
          "directquestion":  $('#directquestion').val(),

          //History
          "medical_history":  $('#medical_history').val(),
          "family_history":  $('#family_history').val(),
          "social_history":  $('#social_history').val(),
          "vaccinations_history":  $('#vaccinations_history').val(),
          "drug_history":  $('#drug_history').val(),
          "surgical_history":  $('#surgical_history').val(),
          "reproductive_history":  $('#reproductive_history').val(),
          "allergy":  $('#allergy').val(),

          //ROS
          "ros_constitutional":  $('#ros_constitutional').val(),
          "ros_skin":  $('#ros_skin').val(),
          "ros_head":  $('#ros_head').val(),
          "ros_eyes":  $('#ros_eyes').val(),
          "ros_ears":  $('#ros_ears').val(),
          "ros_nose":  $('#ros_nose').val(),
          "ros_throat":  $('#ros_throat').val(),
          "ros_respiratory":  $('#ros_respiratory').val(),
          "ros_cardiovasular":  $('#ros_cardiovasular').val(),
          "ros_gastro":  $('#ros_gastro').val(),
          "ros_gynecology":  $('#ros_gynecology').val(),
          "ros_genitourinary":  $('#ros_genitourinary').val(),
          "ros_endocrine":  $('#ros_endocrine').val(),
          "ros_musculoskeletal":  $('#ros_musculoskeletal').val(),
          "ros_peripheral_vascular":  $('#ros_peripheral_vascular').val(),
          "ros_hematology":  $('#ros_hematology').val(),
          "ros_neuropsychiatric":  $('#ros_neuropsychiatric').val(),


          //PE
          "pe_general":  $('#pe_general').val(),
          "pe_HEENT":  $('#pe_HEENT').val(),
          "pe_neck":  $('#pe_neck').val(),
          "pe_respiratory":  $('#pe_respiratory').val(),
          "pe_heart":  $('#pe_heart').val(),
          "pe_abdominal":  $('#pe_abdominal').val(),
          "pe_extremities":  $('#pe_extremities').val(),
          "pe_cns":  $('#pe_cns').val(),
          "pe_musculoskeletal":  $('#pe_musculoskeletal').val(),
          "pe_psychological":  $('#pe_psychological').val(),
          "pe_breast":  $('#pe_breast').val(),
  



          //vitals
          "weight":  $('#weight').val(),
          "height":  $('#height').val(),
          "temperature":  $('#temperature').val(),
          "blood_pressure":  $('#blood_pressure').val(),
          "pulse_rate":  $('#pulse_rate').val(),
          "respiration":  $('#respiration').val(),

        },
        function(data)
        { 
          
        $.each(data, function (key, value) {
        if(data["OK"])
        {
           toastr.success("Note successfully saved!");
          loadComplaints();
        }
        else
        {
          toastr.success("Complaint failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please add a complaint!");}
}


function addNoAvailableDrug()
{

  if($('#medication_no_available').val()!= "")
{

    $.get('/add-medication-no-stock',
        {
          "patient_id": $('#patient_id').val(),
          "opd_number": $('#opd_number').val(),
          "medication": $('#medication_no_available').val(),
          "drug_application": $('#medication_no_remark').val(),
          "drug_quantity": $('#medication_no_days').val(),
          "fullname":  $('#fullname').val()       
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          //sweetAlert("Drug has been forwarded to pharmacy!");
          $('#new-medication').modal('toggle')
          loadMedication();
        }
        else
        {
          sweetAlert("Drug failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please type a drug name!");}

}

function addPlan()
{
if($('#treament_plan').val()!= "")
{

  //alert($('#complaint').val());
    $.get('/add-plan',
        {
          "opd_number": $('#opd_number').val(),
          "treament_plan": $('#treament_plan').val(),
           "treament_plan_action": $('#treament_plan_action').val()
                         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          loadPlan();
        }
        else
        {
          sweetAlert("Assessment failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please add an assessment!");}
}



function addPlanReferal()
{
if($('#myreferal').html()!= "")
{

  //alert($('#complaint').val());
    $.get('/add-assessment',
        {
          "opd_number": $('#opd_number').val(),
          "assessment": $('#myreferal').html()
                         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          loadAssessment();
        }
        else
        {
          sweetAlert("Assessment failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please add an assessment!");}
}


function addAssessment()
{
if($('#assessment').val()!= "")
{

  //alert($('#complaint').val());
    $.get('/add-assessment',
        {
          "opd_number": $('#opd_number').val(),
          "assessment": $('#assessment').val()
                         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          loadAssessment();
        }
        else
        {
          sweetAlert("Assessment failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please add an assessment!");}
}

function getDrugAvailable()
{

     $.get('/get-drug-availability',
        {
          "medication": $('#medication').val()    

        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          sweetAlert("Drug is out of stock!");
         
        }
        else
        {
          //sweetAlert("Drug failed to be added!");
        }
      });
                                        
        },'json');

}



function addDrug()
{
if($('#medication').val()!= "")
{
  //alert($('#opd_number').val());

    $.get('/add-medication',
        {
          "patient_id": $('#patient_id').val(),
          "opd_number": $('#opd_number').val(),
          "medication": $('#medication').val(),
          "fullname":  $('#fullname').val(),
          "drug_quantity": $('#drug_quantity').val(),
          "drug_dosage": $('#drug_dosage').val(),
          "drug_application": $('#drug_application').val(),
          "drug_frequency": $('#drug_frequency').val(),
          "drug_days": $('#drug_days').val(),
          "drug_span": $('#drug_span').val()                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          //sweetAlert("Drug has been forwarded to pharmacy!");
          //$('#new-medication').modal('toggle')
          loadMedication();
        }
        else
        {
          sweetAlert("Drug failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please select a drug or add the number of day to take drugs!");}
}

function addInvestigation()
{
if($('#investigation').val()!= "")
{

    $.get('/add-investigation-walkin',
        {
          "patient_id":           $('#patient_id').val(),
          "accounttype":           $('#accounttype').val(),
          "opd_number":           $('#opd_number').val(),
          "investigation":        $('#investigation').val(),
          "remark":               $('#investigation_remark').val(),
          "fullname":             $('#fullname').val()                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          //sweetAlert("Investigation has been forwarded to Lab!");
          //$('#new-investigation').modal('toggle')
          loadInvestigation();
        
        }
        else
        {
          sweetAlert("Investigation failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please select an Investigation!");}
}

function addProcedure()
{
if($('#procedure').val()!= "")
{

    $.get('/add-procedure',
        {
          "patient_id": $('#patient_id').val(),
           "accounttype": $('#accounttype').val(),
          "opd_number": $('#opd_number').val(),
          "procedure": $('#procedure').val(),
          "fullname":  $('#fullname').val()                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          //sweetAlert("Procedure added!");
           //$('#new-procedure').modal('toggle')
          loadProcedure();
        }
        else
        {
          sweetAlert("Procedure failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please select a Procedure!");}
}


function addDiagnosis()
{
if($('#diagnosis').val()!= "")
{

    $.get('/add-diagnosis',
        {
          "patient_id": $('#patient_id').val(),
          "opd_number": $('#opd_number').val(),
          "diagnosis":  $('#diagnosis').val(),
          "code":       $('#diagnosis_remark').val(),
          "fullname":  $('#fullname').val()                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          loadDiagnosis();
        }
        else
        {
          sweetAlert("Diagnosis failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please select a Diagnosis!");}
}

 function loadDiagnosisDescription()
    {
         
        
        $.get('/load-dignosis-description',
          {
            "diagnosis_category": $('#diagnosis_category').val()
          },
          function(data)
          { 

            $('#diagnosis').empty();
            $.each(data, function () 
            {           
            $('#diagnosis').append($('<option></option>').val(this['type']).html(this['type']));
            });
                                          
         },'json');      
    }

function addHistory()
{
if($('#history').val()!= "")
{

    $.get('/add-history',
        {
          "patient_id": $('#patient_id').val(),
          "opd_number": $('#opd_number').val(),
          "family_history": $('#family_history').val(),
          "social_history": $('#social_history').val(),
          "medical_history": $('#medical_history').val(),
          "vaccinations_history": $('#vaccinations_history').val(),
          "fullname":  $('#fullname').val()                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          //sweetAlert("History added!");
          // $('#new-history').modal('toggle')
          loadHistory();
        }
        else
        {
          sweetAlert("History failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please select a social or family history!");}
}


  function loadAllDiagnosis()
   {
         
         if($('#search').val()=="")
  {sweetAlert("Please enter a diagnosis",'Fill field', "error");}
        
        else
        {
        $.get('/load-dignosis-description',
          {
            "search": $('#search').val()
          },
          function(data)
          { 

            $('#searchTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#searchTable tbody').append('<tr><td><a a href="#" class="text-info" onclick="setDiagnosis(\''+value['type']+'\')">'+ value['code'] +'</a></td><td>'+ value['category'] +'</td><td>'+ value['type'] +'</td></tr>');
            });
                                          
         },'json');  
         }    
    }



 function setDiagnosis(diagnosis)
   {
         //alert($('#opd_number').val());
        $.get("/add-diagnosis-icd",
          
          {

            "opd_number":$('#opd_number').val(),
            "diagnosis":diagnosis
          },
          function(json)
          {

                 //sweetAlert(json.diagnosis);
                //$('#customer_number').val(json.fullname);
                //sweetAlert("Diagnosis added!");
                $('#new-diagnosis').modal('toggle')
                loadDiagnosis();
               
               
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

    }


function loadDocumentDetail()
   {
         
        
        $.get('/load-document-details',
          {
            "patient_id": $('#patient_id').val()
          },
          function(data)
          { 

            $('#DocumentTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#DocumentTable tbody').append('<tr><td>'+ value['filename'] +'</td><td>'+ value['original_name'] +'</td><td>'+ value['size'] +'</td><td>'+ value['created_on'] +'</td><td><a a href="/uploads/images/'+ value['filepath'] +'"><i onclick="/uploads/images/'+ value['filepath'] +'" class="fa fa-eye"></i></a></td><td><a a href="#"><i onclick="deleteDocument('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }




function loadMedication()
   {
         
        
        $.get('/patient-medication',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#drugTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#drugTable tbody').append('<tr><td>'+ value['drug_quantity'] +'</td><td>'+ value['drug_name'] +'</td><td>'+ value['drug_application'] +'</td><td>'+ value['drug_cost'] +'</td><td>'+ value['drug_cost']*value['drug_quantity'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#" class="btn btn-sm btn-danger btn-rounded">'+ value['status'] +'</a></td><td><a a href="#"><i onclick="removeMedication('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }

    function loadPlan()
   {
         
        
        $.get('/patient-plan',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#planTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#planTable tbody').append('<tr><td>'+ value['date'] +'</td><td>'+ value['plan'] +'</td><td>'+ value['action'] +'</td><td><a a href="#"><i onclick="removePlan('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }

    function loadAssessment()
   {
         
        
        $.get('/patient-assessment',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#assessmentTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#assessmentTable tbody').append('<tr><td>'+ value['assessment'] +'</td><td>'+ value['created_by'] +'</td><td>'+ value['created_on'] +'</td><td><a a href="#"><i onclick="removeAssessment('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }




function loadComplaints()
   {
         
        
        $.get('/patient-complaint',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#complaintTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#complaintTable tbody').append('<tr><td>'+ value['complaint'] +'</td><td>'+ value['period'] +' '+ value['span'] +' '+ value['remark'] +'</td><td>'+ value['date'] +'</td><td><a a href="#"><i onclick="removecomplain('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


 function loadVitals()
   {
         
        
        $.get('/patient-vitals',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#vitalTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#vitalTable tbody').append('<tr><td>'+ value['created_on'] +'</td><td>'+ value['weight'] +'</td><td>'+ value['height'] +'</td><td>'+ value['bmi']  + (value['bmi_status'] == "Normal" ? '<span class="label label-success btn-rounded">'+ value['bmi_status'] +'</span>' :  '<span class="label label-danger btn-rounded">'+ value['bmi_status'] +'</span>' ) +'</td><td>'+ value['temperature'] + (value['temp_status'] == "Normal" ? '<span class="label label-success btn-rounded">'+ value['temp_status'] +'</span>' :  '<span class="label label-danger btn-rounded">'+ value['temp_status'] +'</span>' ) +'</td><td>'+ value['sbp'] + '/' + value['dbp'] + (value['bp_status'] == "Normal" ? '<span class="label label-success btn-rounded">'+ value['bp_status'] +'</span>' :  '<span class="label label-danger btn-rounded">'+ value['bp_status'] +'</span>' ) +'</td><td>'+ value['pulse_rate'] +'</td><td>'+ value['respiration'] +'</td><td>'+ value['waist_circumference'] +'</td><td>'+ value['hip_circumference'] +'</td><td><a a href="#"><i onclick="removeVital('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }

function loadInvestigation()
   {


         
        
        $.get('/patient-investigation',
          {
            "opd_number": $('#opd_number').val() 
          },
          function(data)
          { 

            $('#investigationsTable tbody').empty();
            $.each(data, function (key, value) 
            {           
           $('#investigationsTable tbody').append('<tr><td>'+ value['investigation'] +'</td><td>'+ value['cost'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['status'] +'</td><td>'+ value['created_by'] +'</td><td><input type="text" style="width:200px; border: 1px solid #ABADB3; text-align: center;" item_code="'+ value['id'] +'" value="'+ value['remark'] +'" onchange="change_count(this);"></td><td>' + ( value['type'] == "Laboratory" ? '<a a href="/test-collection-slip/'+value['visitid']+'">' : '<a a href="/image-request-slip/'+value['id']+'">' ) + '<i onclick="" class="fa fa-print" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print investigation request"></i></a></td><td>' + ( value['type'] == "Laboratory" ? '<a a href="/laboratory-results/'+value['visitid']+'">' : '<a a href="/upload-scan/'+value['visitid']+'">' ) + '<i onclick="" class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="View result"></i></a></td><td><a a href="#"><i onclick="removeinvestigation('+value['id']+')" class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Investigation"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


    function change_count(obj)
    {

      var item_code=$(obj).attr('item_code');
      var new_qty=$(obj).val();
        //alert(item_code);

          $.get('/update-investigation-comment',
          {
             "id": item_code,
             "drug_quantity": new_qty
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
             loadInvestigation();
             }
            else
            { 
             loadInvestigation();
              
            }
           
        });
                                          
          },'json');    
           
    }

function loadDiagnosis()
   {
         
        
        $.get('/patient-diagnosis',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#diagnosisTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#diagnosisTable tbody').append('<tr><td>'+ value['diagnosis'] +'</td><td>'+ value['created_by'] +'</td><td>'+ value['date'] +'</td><td><a a href="#"><i onclick="removediagnosis('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


      function loadDiagnosisDescription()
    {
         
        
        $.get('/load-dignosis-description',
          {
            "diagnosis_category": $('#diagnosis_category').val()
          },
          function(data)
          { 

            $('#diagnosis').empty();
            $.each(data, function () 
            {           
            $('#diagnosis').append($('<option></option>').val(this['type']).html(this['type']));
            });
                                          
         },'json');      
    }


    function loadProcedure()
   {
         
        
        $.get('/patient-procedure',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#procedureTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#procedureTable tbody').append('<tr><td>'+ value['procedure'] +'</td><td>'+ value['cost'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['status'] +'</td><td><a a href="#"><i onclick="removeprocedure('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }

    function loadHistory()
   {
         
        
        $.get('/patient-history',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#historyTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#historyTable tbody').append('<tr><td>'+ value['medical_history'] +'</td><td>'+ value['family_history'] +'</td><td>'+ value['social_history'] +'</td><td>'+ value['vaccinations_history'] +'</td><td><a a href="#"><i onclick="removeHistory('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


    function loadImages()
   {
         
        
        $.get('/patient-imaging',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#ImageTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#ImageTable tbody').append('<tr><td>'+ value['diagnosis'] +'</td><td>'+ value['remark'] +'</td><td>'+ value['date'] +'</td><td><a a href="#"><i onclick="removediagnosis('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }



  @if($visit_details->created_by == Auth::user()->getNameOrUsername())
  function removeMedication(id)
   {
    

          $.get('/delete-medication',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              //swal("Deleted!", name +" was removed from prescription list.", "success"); 
              loadMedication();
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from prescription.", "error");
              
            }
           
        });
                                          
          },'json');    
           
   }


    function removeHistory(id)
   {
      
          $.get('/delete-history',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              //swal("Deleted!", name +" was removed from history list.", "success"); 
              loadHistory();
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from history.", "error");
              
            }
           
        });
                                          
          },'json');    
           
   }




   function removediagnosis(id)
   {
     
          $.get('/delete-diagnosis',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              //swal("Deleted!", name +" was removed from list.", "success"); 
              loadDiagnosis();
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');    

   }


function removeinvestigation(id)
   {
     
          $.get('/delete-investigation',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              //swal("Deleted!", name +" was removed from list.", "success"); 
              loadInvestigation();
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }

  
   function removeAssessment(id)
   {
     
          $.get('/delete-assessment',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              //swal("Deleted!", name +" was removed from list.", "success"); 
              loadAssessment();
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }


function removeprocedure(id)
   {
     
          $.get('/delete-procedure',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              //swal("Deleted!", name +" was removed from list.", "success"); 
              loadProcedure();
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');    
           
            

    
   }


   function removeVital(id)
   {
      
          $.get('/delete-vital',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              //swal("Deleted!", name +" was removed from history list.", "success"); 
              loadVitals();
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from records.", "error");
              
            }
           
        });
                                          
          },'json');    
           
   }


   function removecomplain(id)
   {

     
          $.get('/delete-complaint',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              toastr.error("Deleted!", name +" was removed from list.", "success"); 
              loadComplaints();
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');    
           
    
   }


@else

@endif

 function removePlan(id)
   {
     
          $.get('/delete-plan',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              //swal("Deleted!", name +" was removed from list.", "success"); 
              loadPlan();
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');        
    
   }


function getAge()
{

    $.get('/patient-age-occupation',
        {

          "id": $('#patient_id').val()
         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        
          //sweetAlert("Employee SSF : ", data["employeessf"], "info");
           $('#age').val(data.age);
           $('#occupation').val(data.occupation);
           $('#accounttype').val(data.accounttype);
       
      });
                                        
        },'json');
  
}

function loadRisk()
   {
         
        
        $.get('/load-account',
          {
            "patient_id": $('#patient_id').val()
          },
          function(data)
          { 

            $('#ref_accounttype').empty();
            $.each(data, function () 
            {           
            $('#ref_accounttype').append($('<option></option>').val(this['accounttype']).html(this['accounttype']));
            });
                                          
         },'json');      
    }

function getDetails(acct_no)
{ 
  //alert(acct_no);

  $.get("/edit-patient",
          {"patient_id":acct_no},
          function(json)
          {

                $('#internal-referral input[name="ref_patient_id"]').val(json.patient_id);
                $('#internal-referral input[name="ref_fullname"]').val(json.fullname);
                $('#internal-referral select[name="ref_accounttype"]').select2();
                $('#internal-referral select[name="ref_referal_doctor"]').select2();
                $('#internal-referral select[name="ref_consultation_type"]').select2();
                $('#internal-referral select[name="ref_visit_type"]').select2();
                $('#internal-referral img[name="imagePreview"]').attr("src", '/images/'+json.image);

                getAge();
                loadRisk();

          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}



  </script>


<script type="text/javascript">
$(function () {
  $('#ref_visit_date').daterangepicker({
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


  <div class="modal fade" id="new-medication" style="height:600px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Medication</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" class="panel-body wrapper-lg">
                           @include('doctor/medication')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>                  
                        </div>
                        </section>
                </section>
         </div>        
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->


