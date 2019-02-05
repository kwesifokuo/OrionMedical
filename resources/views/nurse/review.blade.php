
@role(['System Admin','Nurse','Nurse Assistant'])

@extends('layouts.default')
@section('content')
<section class="vbox">
           <header class="header bg-white b-b b-light">
                    

                     

                      <a href="#" class="btn btn-warning btn-s-md btn-lg pull-right">Total Charge : GHS {{ $payables }}</a>
                      <a href="#" class="btn btn-success btn-s-md btn-lg pull-right">Paid : GHS {{ $receivables }}</a>
                      <a href="#" class="btn btn-danger btn-s-md btn-lg pull-right">Outstanding : GHS {{ number_format($outstanding, 1, '.', ',') }}</a>

                      ||

                   
                      
                     <a href="#"  class="btn btn-info btn-s-md btn-lg">{{ $visit_details->care_provider }}</a> ||
                     <a href="#"  class="btn btn-info btn-s-md btn-lg ">{{ $patients[0]->company }}</span></a>
                   
           
            </header>
            <section class="scrollable">
              <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="clearfix m-b">
                          <a href="/images/{{ $patients[0]->image }}" class="pull-left thumb m-r">
                            <img src="/images/{{ $patients[0]->image }}" class="img-circle 3x">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs">{{ $patients[0]->fullname }}</div>
                            <br>
                            <div>
                          
                           <p class="block"><a href="#" class="">ID # </a> <span class="label label-default">{{ $patients[0]->patient_id }}</span></p><br>
                           <p><span class="label label-success">{{ $visit_details->consultation_type }} </span></p> <br>
                            <p class="block"><a href="#" class=""></a> <span class="label label-success btn-rounded">{{ $visit_details->opd_number }}</span></p><br>
                     <p class="block"><a href="#" class=""></a> <span class="label label-danger btn-rounded">Created : {{ Carbon\Carbon::parse($visit_details->created_on)->diffForHumans() }}</span></p>
                            </div>
                          </div>                
                        </div>
                        <div class="panel wrapper panel-success">
                          <div class="row">
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $patients[0]->gender }}</span>
                                 <input type="hidden" id="accounttype" name="accounttype" value="{{ $visit_details->payercode }}">
                                    <input type="hidden" id="opd_number" name="opd_number" value="{{ $visit_details->opd_number }}">
                                   <input type="hidden" id="fullname" name="fullname" value="{{ $visit_details->name }}">
                                    <input type="hidden" id="patient_id" name="patient_id" value="{{ $visit_details->patient_id }}">
                                <small class="text-muted">Gender</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                @if($patients[0]->date_of_birth->age > 1)
                                <span class="m-b-xs h4 block">{{ $patients[0]->date_of_birth->age }}</span>
                                @else
                                 <span class="m-b-xs h4 block"> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($patients[0]->date_of_birth))->diffForHumans() }} </span>
                                @endif
                                <small class="text-muted">Age</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h5 block">{{ $patients[0]->civil_status }}</span>
                                <small class="text-muted">Status</small>
                              </a>
                            </div>
                          </div>
                        </div>
                       <br>
                      
                        <div>
                          <ul class="list-group no-radius">
                          <li class="list-group-item">
                            <span class="pull-right">{{ str_limit($patients[0]->occupation,12) }}</span>
                             <small class="text-muted">Occupation</small>
                          </li>
                            <li class="list-group-item">
                            <span class="pull-right">{{ str_limit($patients[0]->nationality,12) }}</span>
                            
                             <small class="text-muted">Nationality</small>
                          </li>

                           <li class="list-group-item">
                            <span class="pull-right">{{ $patients[0]->mobile_number }}</span>
                            
                             <small class="text-muted">Mobile Number</small>
                          </li>
                            <li class="list-group-item">
                            <span class="pull-right">{{ $patients[0]->blood_group }}</span>
                            
                             <small class="text-muted text-danger">Blood Group</small>
                          </li>
                          <li class="list-group-item">
                            <span class="pull-right">{{ $patients[0]->blood_group }}</span>
                            
                             <small class="text-muted text-info">G6PD</small>
                          </li>

                        </ul>
                            

                          <ul class="list-group no-radius">
                         <h5>
                                <span>Vitals</span>
                               @foreach($myvitals as $vital)
                               <ul>
                                <label class="badge bg-danger"> {{ $vital->created_on }} </label>
                                @if($vital->weight == '') @else <li> Weight <label class="badge bg-info"> {{$vital->weight}}kg  </label>  </li> @endif
                                @if($vital->height == '') @else <li> Height <label class="badge bg-info"> {{$vital->height}} m </label></li> @endif

                                 @if($vital->height == '') @else <li> BMI <label class="badge bg-info"> {{ $vital->bmi }} kg/m^2  </label> {{ $vital->bmi_status }}</li> @endif

                                @if($vital->temperature == '') @else <li> Temperature <label class="badge bg-info"> {{$vital->temperature}} ° </label>{{ $vital->temp_status }}</li> @endif
                                @if($vital->pulse_rate == '') @else <li> Pulse Rate <label class="badge bg-info"> {{$vital->pulse_rate}} per min   </label></li> @endif
                                @if($vital->bp_status == '') @else <li> Blood Pressure <label class="badge bg-info"> {{$vital->sbp }} / {{ $vital->dbp  }} mmHg</label>{{$vital->bp_status}}</li> @endif
                                 @if($vital->spo2 == '') @else <li> SPO2 <label class="badge bg-info"> {{$vital->spo2}} %   </label></li> @endif
                                 @if($vital->waist_circumference == '') @else <li> Waist Circumference <label class="badge bg-info"> {{$vital->waist_circumference }} cm </label></li> @endif
                                  @if($vital->hip_circumference == '') @else <li> Hip Circumference <label class="badge bg-info"> {{$vital->hip_circumference }} cm </label></li> @endif

                                  @if($vital->remarks == '') @else <li> Remarks <label class="badge bg-info"> {{$vital->remarks}}  </label></li> @endif
                                 </ul>
                                 <div class="line"></div>
                               @endforeach
                              </h5>

                        </ul>
                          <br>
                     
                          
                          <img src="/images/387610.svg" width="100%"> 
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>


                
                <aside class="bg-white">
                  <section class="vbox">

                  <header class="header bg-white b-b b-light">
              
                    
                 <a href="#" onclick="doDischarge('{{$visit_details->id }}','{{ $visit_details->name }}')"  data-toggle="modal" class="btn btn-sm btn-danger bootstrap-modal-form-open pull-right"> <i class="fa fa-power-off"></i> End Visit </a>

{{--                 <a href="#new-appointment-request"  data-toggle="modal" class="btn btn-sm btn-info bootstrap-modal-form-open pull-right"> <i class="fa fa-plus"></i> Create a Follow Up Appointment</a>
                
                &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;
                

                <a href="#new-admission"  data-toggle="modal" class="btn btn-sm btn-warning bootstrap-modal-form-open pull-right"> <i class="fa fa-plus"></i> Admit Patient </a> --}}


              {{--     <a href="#new-discharge"  data-toggle="modal" class="btn btn-sm btn-warning bootstrap-modal-form-open pull-right"> <i class="fa fa-plus"></i> Discharge Patient </a> --}}
                


                     <p class="block pull-left"><a href="#" class=""></a> <span class="label label-success btn-rounded">eSigned </span></p>

                      @if($visit_details->billable=='Inpatient')

                       <p class="block pull-left"><a href="#" class=""></a> <span class="label bg-dark btn-rounded">Admission Type : {{ $visit_details->ward_admission_type}} </span></p>

                      <p class="block pull-left"><a href="#" class=""></a> <span class="label label-danger btn-rounded">Ward : {{ $visit_details->ward_id}} </span></p>

                      <p class="block pull-left"><a href="#" class=""></a> <span class="label bg-dark btn-rounded">Bed : {{ $visit_details->bed_id}}</span></p>

                       <p class="block pull-left"><a href="#" class=""></a> <span class="label label-danger btn-rounded">Admission Time : {{ $visit_details->ward_admission_time}}</span></p>
                      @else
                      <p class="block pull-left"><a href="#" class=""></a> <span class="label bg-dark btn-rounded">Admission Type : {{ $visit_details->consultation_type}} </span></p>
                      @endif
                     

                    
                   </header>
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">

                           <li class=""><a href="#review-summary" data-toggle="tab"><i class="fa fa-folder text-default"></i> Notes Summary </a></li>  
                         <li class=""><a href="#history-summary" data-toggle="tab"><i class="fa fa-archive text-default"></i> Notes History (Old Visits) </a></li>
                          <li class=""><a href="#review-vitals" data-toggle="tab"><i class="fa fa-lightbulb-o text-default"></i> Vital Signs </a></li>
                       
                          
                       
                     {{--      <li class=""><a href="#review-complaint" data-toggle="tab"><i class="fa fa-meh-o text-default"></i> Complaint </a></li>
                          <li class=""><a href="#review-diagnosis" data-toggle="tab"><i class="fa fa-gavel text-default"></i> Diagnosis </a></li>
                           --}}

                            <li class=""><a href="#review-doctor-assessment" data-toggle="tab"><i class="fa fa-puzzle-piece text-default"></i> Doctor's Plan </a></li>

                            <li class=""><a href="#review-assessment" data-toggle="tab"><i class="fa fa-puzzle-piece text-default"></i> Nurse Plan </a></li>
                            <li class=""><a href="#review-plan" data-toggle="tab"><i class="fa fa-table text-default"></i> Nurse Notes </a></li>
                            <li class=""><a href="#review-medication" data-toggle="tab"><i class="fa fa-flask text-default"></i> Drug Administration </a></li>

                            @role(['Nurse','System Admin'])
                            <li class=""><a href="#review-investigation" data-toggle="tab"><i class="fa fa-film text-default"></i> Lab / Investigations </a></li>
                            <li class=""><a href="#review-drug" data-toggle="tab"><i class="fa fa-flask text-default"></i> Prescription </a></li>
                            </a></li>
                          <li class=""><a href="#review-documents" data-toggle="tab"><i class="fa fa-folder text-default"></i> Documents </a></li>
                            @endrole

                  
                        
                        <li class=""><a href="#review-fluid" data-toggle="tab"><i class="fa fa-tint text-default"></i> Intake / Output Records </a></li> 
                        <li class=""><a href="#review-procedure" data-toggle="tab"><i class="fa fa-tasks text-default"></i> Bed Side Procedure / Consumables </a></li> 
                        

                         <span class="hidden-sm">.</span>
                      </ul>
                    </header>



                     <div class="panel-body">
                     <div class="tab-content"> 

                      <div class="tab-pane active" id="review-vitals">
                          <section class="panel panel-default">
                      <div class="panel-body">
                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-3">
                            <label>Weight ( kg )</label> 
                           <input type="text" class="form-control" class="text-success" id="weight"  value="{{ Request::old('weight') ?: '' }}"  name="weight">
                          @if ($errors->has('weight'))
                          <span class="help-block">{{ $errors->first('weight') }}</span>
                           @endif   
                          </div>


                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_dosage') ? ' has-error' : ''}}">
                            <label>Height ( m )</label>
                            <input type="text" class="form-control" class="text-success" id="height"  value="{{ $defaultheight }}"  name="height">
                           @if ($errors->has('height'))
                          <span class="help-block">{{ $errors->first('height') }}</span>
                           @endif    
                          </div>   
                        </div>
                            
                           <div class="col-sm-3">
                            <label>Temperature ( C )</label> 
                           <input type="text" class="form-control" id="temperature"  value="{{ Request::old('temperature') ?: '' }}"  name="temperature">
                          @if ($errors->has('temperature'))
                          <span class="help-block">{{ $errors->first('temperature') }}</span>
                           @endif   
                          </div>

                          <div class="col-sm-1">
                            <label>Systolic BP</label> 
                            <div class="form-group{{ $errors->has('systolic') ? ' has-error' : ''}}">
                             <input type="number" id="systolic" name="systolic"  class="form-control m-b" data-placeholder="Systolic" >
                         
                           @if ($errors->has('systolic'))
                          <span class="help-block">{{ $errors->first('systolic') }}</span>
                           @endif    
                          </div>
                          </div>
                            <div class="col-sm-1">
                            <label>Diastolic BP</label> 
                            <div class="form-group{{ $errors->has('diastolic') ? ' has-error' : ''}}">
                             <input type="number" id="diastolic" name="diastolic"  class="form-control m-b">
                         
                           @if ($errors->has('diastolic'))
                          <span class="help-block">{{ $errors->first('diastolic') }}</span>
                           @endif    
                          </div>
                          </div>
                          </div>




                         <div class="form-group pull-in clearfix">
                        <div class="col-sm-3">
                            <label>Pulse Rate ( / min )</label> 
                          <input type="text" class="form-control" id="pulse_rate"  value="{{ Request::old('pulse_rate') ?: '' }}"  name="pulse_rate">
                          @if ($errors->has('pulse_rate'))
                          <span class="help-block">{{ $errors->first('pulse_rate') }}</span>
                           @endif   
                          </div>

                           <div class="col-sm-3">
                            <label>Respiration ( / min )</label> 
                          <input type="text" class="form-control" id="respiration"  value="{{ Request::old('respiration') ?: '' }}"  name="respiration">
                           @if ($errors->has('respiration'))
                          <span class="help-block">{{ $errors->first('respiration') }}</span>
                           @endif    
                          </div> 

                          

                           <div class="col-sm-3">
                            <label>Waist Circumference</label> 
                            <input type="text" class="form-control" id="waist_circumference"  value="1"  name="waist_circumference">
                           @if ($errors->has('waist_circumference'))
                          <span class="help-block">{{ $errors->first('waist_circumference') }}</span>
                           @endif    
                          </div> 

                             <div class="col-sm-3">
                            <label>Hip Circumference</label> 
                            <input type="text" class="form-control" id="hip_circumference"  value="1"  name="hip_circumference">
                          @if ($errors->has('hip_circumference'))
                          <span class="help-block">{{ $errors->first('hip_circumference') }}</span>
                           @endif   
                          </div>
                        </div>




                         <div class="form-group pull-in clearfix">
                            <div class="col-sm-3">
                            <label>SpO2</label> 
                            <input type="text" class="form-control" id="SpO2"  value="{{ Request::old('SpO2') ?: '' }}"  name="SpO2">
                           @if ($errors->has('SpO2'))
                          <span class="help-block">{{ $errors->first('SpO2') }}</span>
                           @endif    
                          </div> 



                          <div class="col-sm-3">
                            <label>Body Fat</label> 
                            <input type="text" class="form-control" id="b_fat"  value="{{ Request::old('b_fat') ?: '' }}"  name="b_fat">
                           @if ($errors->has('b_fat'))
                          <span class="help-block">{{ $errors->first('b_fat') }}</span>
                           @endif    
                          </div> 

                             <div class="col-sm-3">
                            <label>Visceral Fat</label> 
                            <input type="text" class="form-control" id="v_fat"  value="{{ Request::old('v_fat') ?: '' }}"  name="v_fat">
                          @if ($errors->has('v_fat'))
                          <span class="help-block">{{ $errors->first('v_fat') }}</span>
                           @endif   
                          </div>

                          <div class="col-sm-1">
                            <label>RBS</label> 
                          <input type="text" class="form-control" id="rbs"  value="{{ Request::old('rbs') ?: '' }}"  name="pulse_rate">
                          @if ($errors->has('rbs'))
                          <span class="help-block">{{ $errors->first('rbs') }}</span>
                           @endif   
                          </div>

                           <div class="col-sm-1">
                            <label>FBS</label> 
                          <input type="text" class="form-control" id="fbs"  value="{{ Request::old('fbs') ?: '' }}"  name="fbs">
                           @if ($errors->has('fbs'))
                          <span class="help-block">{{ $errors->first('fbs') }}</span>
                           @endif    
                          </div> 

                         
                            
                        </div>



                         <div class="form-group pull-in clearfix">
                            <div class="col-sm-3">
                            <label>Visual Acuity</label> 
                            <input type="text" class="form-control" id="vr_visual_ascuity"  value="{{ Request::old('vr_visual_ascuity') ?: '' }}"  name="vr_visual_ascuity">
                           @if ($errors->has('SpO2'))
                          <span class="help-block">{{ $errors->first('vr_visual_ascuity') }}</span>
                           @endif    
                          </div> 



                          
                        </div>

                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Remarks</label> 
                           <textarea type="text" class="form-control" id="vital_remark"  value="{{ Request::old('vital_remark') ?: '' }}"  name="vital_remark"></textarea>
                          @if ($errors->has('vital_remark'))
                          <span class="help-block">{{ $errors->first('vital_remark') }}</span>
                           @endif   
                          </div>

                           
                        </div>


                      <img src="">
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addVitals()" class="btn btn-success btn-s-xs">Add Record</button>
                      </footer>
                    </section>
                    <img src="/images/139328.svg" width="7%" align="right"> 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Vital Signs Chart</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="vitalTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                             <tr>
                              <th>Date</th>
                              <th>Weight (kg)</th>
                              <th>Height (m)</th>
                              <th>BMI</th>
                              <th>Temperature (C)</th>
                              <th>BP (mm of Hg)</th>
                              <th>Pulse Rate (/ min)</th>
                               <th>Respiration (/ min)</th>
                               <th>SP02 </th>
                               <th>RBS/FBS</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                    </div>
                    </div>

                      <div class="col-lg-12">
                  <section class="panel panel-default">
                    <header class="panel-heading">
                      Vital Chart Graph
                    </header>
                    <div class="panel-body text-center">
                      
                      <small class="text-muted block"></small>
                      <div class="inline">
                          @include('charts/vitals') 
                      </div>                      
                    </div>
                    <div class="panel-footer"><small><a href="#" > % of change</a></small></div>
                  </section>
                </div>
                    </section>
                  </div>


                       @role(['Nurse','System Admin','Special Admin'])
                   <div class="tab-pane" id="review-summary">
                    
                    <section class="panel panel-info">
                                <header class="panel-heading font-bold">Note Summary</header>
                                <div class="panel-body">
                                       <section class="scrollable wrapper">
                  <div class="timeline">
                    <article class="timeline-item active">
                        <div class="timeline-caption">
                          <div class="panel bg-primary lter no-borders">
                            <div class="panel-body">
                              <span class="timeline-icon"><i class="fa fa-bell-o time-icon bg-primary"></i></span> 
                              <span class="timeline-date"> <label class="badge bg-danger">  <label class="badge bg-danger"> {{ $visit_details->created_on }} -  {{ $visit_details->consultation_type  }} </span>
                              <h5>
                                <span>Chief Complaint</span>
                               @foreach($mycomplaints as $complaint)
                               <a href="#"> <label class="badge bg-danger"> {{$complaint->complaint}} <i onclick="removecomplain('{{$complaint->id}}','{{$complaint->complaint}}')" class="fa fa-trash-o"></i></label></a>
                               @endforeach
                              </h5>
                             
                            </div>
                          </div>
                        </div>
                    </article>
                    <article class="timeline-item">
                        <div class="timeline-caption">
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <span class="arrow left"></span>
                              <span class="timeline-icon"><i class="fa fa-phone time-icon bg-primary"></i></span>
                              <span class="timeline-date">HPI</span>
                              <h5>
                                <span>HPI</span>
                                @foreach($mycomplaints as $complaint)
                                 <a>{!!$complaint->presenting!!} </a>
                               @endforeach

                               <span>On Direct Questions</span>
                                @foreach($mycomplaints as $complaint)
                                 <a>{{$complaint->directquestion}} <i class="fa fa-trash-o text-muted"></i> </a>
                               @endforeach
                              </h5>
                            </div>       
                          </div>
                        </div>
                    </article>
                    <article class="timeline-item alt">
                        <div class="timeline-caption">                
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <span class="arrow right"></span>
                              <span class="timeline-icon"><i class="fa fa-male time-icon bg-success"></i></span>
                              <span class="timeline-date">History</span>
                              <h5>
                                <span>History</span>
                                @foreach($myhistories as $history)
                                <ul>
                                @if($history->medical_history == '') @else <li>Past Medical History <label class="badge bg-default"> {{$history->medical_history}}  </label></li> @endif
                                @if($history->family_history == '') @else <li>Family History <label class="badge bg-info"> {{$history->family_history}}  </label></li> @endif
                                @if($history->social_history == '') @else <li> Social History <label class="badge bg-primary"> {{$history->social_history}}  </label></li> @endif
                                 @if($history->drug_history == '') @else <li> Drug History <label class="badge bg-success">Takes {{$history->drug_history}}  </label></li> @endif
                                @if($history->surgical_history == '') @else <li>Surgical History <label class="badge bg-warning"> {{$history->surgical_history}}  </label></li> @endif
                                @if($history->reproductive_history == '') @else <li> Reproductive History <label class="badge bg-danger"> {{$history->reproductive_history}}  </label></li> @endif
                                @if($history->vaccinations_history == '') @else <li>Vacinnations <label class="badge bg-default"> {{$history->vaccinations_history}}  </label></li> @endif
                                @if($history->allergy == '') @else <li> Allergies <label class="badge bg-danger"> {{$history->allergy}}  </label></li> 
                                @endif
                                </ul>
                               @endforeach
                              </h5>
                              <p></p>
                            </div>
                          </div>
                        </div>
                    </article>          
                    <article class="timeline-item">
                        <div class="timeline-caption">                
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <span class="arrow left"></span>
                              <span class="timeline-icon"><i class="fa fa-plane time-icon bg-dark"></i></span>
                              <span class="timeline-date">ROS</span>
                              <h5>
                                <span>Review of System</span>
                                @foreach($myros as $ros)
                                <ul>
                                @if($ros->general == '') @else <li> General <label class="badge bg-default"> {{$ros->general}}  </label></li> @endif
                                @if($ros->skin == '') @else <li> Skin <label class="badge bg-info"> {{$ros->skin}}  </label></li> @endif
                                @if($ros->head == '') @else <li> Head <label class="badge bg-primary"> {{$ros->head}}  </label></li> @endif
                                 @if($ros->eyes == '') @else <li>Eyes <label class="badge bg-success"> {{$ros->eyes}}  </label></li> @endif
                                @if($ros->ears == '') @else <li> Ears <label class="badge bg-warning"> {{$ros->ears }}  </label></li> @endif
                                @if($ros->nose == '') @else <li> Nose <label class="badge bg-danger"> {{$ros->nose}}  </label></li> @endif
                                @if($ros->throat == '') @else <li> Throat <label class="badge bg-default"> {{$ros->throat}}  </label></li> @endif
                                @if($ros->respiratory == '') @else <li> Respiratory <label class="badge bg-danger"> {{$ros->respiratory}}  </label></li> @endif
                                </ul>
                                @if($ros->cardiovascular == '') @else <li> Cardiovascular <label class="badge bg-default"> {{$ros->cardiovascular}}  </label></li> @endif
                                @if($ros->gastrointestinal == '') @else <li> Gastrointestinal <label class="badge bg-default"> {{$ros->gastrointestinal}}  </label></li> @endif
                                @if($ros->gynecologic == '') @else <li> Gynecologic <label class="badge bg-default"> {{$ros->gynecologic}}  </label></li> @endif
                                @if($ros->genitourinary == '') @else <li> Genitourinary <label class="badge bg-default"> {{$ros->genitourinary}}  </label></li> @endif
                                @if($ros->endocrine == '') @else <li> Endocrine <label class="badge bg-default"> {{$ros->endocrine}}  </label></li> @endif
                                @if($ros->musculoskeletal == '') @else <li> Musculoskeletal <label class="badge bg-default"> {{$ros->musculoskeletal}}  </label></li> @endif
                                @if($ros->peripheral_vascular == '') @else <li> Peripheral Vascular <label class="badge bg-default"> {{$ros->peripheral_vascular}}  </label></li> @endif
                                @if($ros->hematology == '') @else <li> Hematology <label class="badge bg-default"> {{$ros->hematology}}  </label></li> @endif
                                @if($ros->neuro == '') @else <li> Neuropsychiatric  <label class="badge bg-default"> {{$ros->neuro}}  </label></li> @endif
                               @endforeach
                              </h5>
                             
                            </div>
                          </div>
                        </div>
                    </article>
                    <article class="timeline-item alt">
                        <div class="timeline-caption">                
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <span class="arrow right"></span>
                              <span class="timeline-icon"><i class="fa fa-file-text time-icon bg-info"></i></span>
                              <span class="timeline-date">Vitals</span>
                              <h5>
                                <span>Vitals</span>
                               @foreach($myvitals as $vital)
                               <ul>
                                @if($vital->weight == '') @else <li> Weight <label class="badge bg-info"> {{$vital->weight}}  </label></li> @endif
                                @if($vital->height == '') @else <li> Height <label class="badge bg-info"> {{$vital->height}}  </label></li> @endif
                                 @if($vital->bmi == '') @else <li> BMI <label class="badge bg-info"> {{$vital->bmi}}  </label></li> @endif
                                @if($vital->temperature == '') @else <li> Temperature <label class="badge bg-info"> {{$vital->temperature}} ° </label></li> @endif
                                @if($vital->pulse_rate == '') @else <li> Pulse Rate <label class="badge bg-info"> {{$vital->pulse_rate}}  </label></li> @endif
                                @if($vital->blood_pressure == '') @else <li> Blood Pressure <label class="badge bg-info"> {{$vital->blood_pressure}}  </label></li> @endif
                                 </ul>
                               @endforeach
                              </h5>
                            
                            </div>
                          </div>
                        </div>
                    </article>
                    <article class="timeline-item">
                        <div class="timeline-caption">
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <span class="arrow left"></span>
                              <span class="timeline-icon"><i class="fa fa-code time-icon bg-dark"></i></span>
                              <span class="timeline-date">Physical Exam</span>
                              <h5>
                                <span>Physical Exam</span>
                                 @foreach($mype as $physical)
                                <ul>
                                @if($physical->pe_general == '') @else <li> General <label class="badge bg-default"> {{$physical->pe_general}}  </label></li> @endif
                                @if($physical->pe_HEENT == '') @else <li> HEENT <label class="badge bg-info"> {{$physical->pe_HEENT}}  </label></li> @endif
                                @if($physical->pe_neck == '') @else <li> Neck <label class="badge bg-primary"> {{$physical->pe_neck}}  </label></li> @endif
                                 @if($physical->pe_respiratory == '') @else <li> Respiratory <label class="badge bg-success"> {{$physical->pe_respiratory}}  </label></li> @endif
                                @if($physical->pe_heart == '') @else <li> Heart <label class="badge bg-warning"> {{$physical->pe_heart }}  </label></li> @endif
                                @if($physical->pe_abdominal == '') @else <li> Abdominal <label class="badge bg-danger"> {{$physical->pe_abdominal}}  </label></li> @endif
                                @if($physical->pe_extremities == '') @else <li> Extremities <label class="badge bg-default"> {{$physical->pe_extremities}}  </label></li> @endif
                                @if($physical->pe_cns == '') @else <li> CNS <label class="badge bg-default"> {{$physical->pe_cns}}  </label></li> @endif

                                @if($physical->pe_musculoskeletal == '') @else <li> Musculoskeletal <label class="badge bg-default"> {{$physical->pe_musculoskeletal}}  </label></li> @endif

                                @if($physical->pe_psychological == '') @else <li> Psychological <label class="badge bg-default"> {{$physical->pe_psychological}}  </label></li> @endif

                                 @if($physical->pe_breast == '') @else <li> Breast <label class="badge bg-default"> {{$physical->pe_breast}}  </label></li> @endif
                                
                               @endforeach
                              </h5>
                             
                            </div>
                          </div>
                        </div>
                    </article>
                     <article class="timeline-item alt">
                        <div class="timeline-caption">                
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <span class="arrow right"></span>
                              <span class="timeline-icon"><i class="fa fa-gavel time-icon bg-success"></i></span>
                              <span class="timeline-date">Assessment</span>
                              <h5>
                                <span>Assessment</span>
                                 @foreach($mydiagnosis as $mydiagnosis)
                               <ul>
                                 <li><label class="badge bg-success">{{$mydiagnosis->diagnosis}}</label></li>
                                 </ul>
                               @endforeach
                              </h5>
                              <p>Diagnosis and differential diagnosis</p>
                            </div>
                          </div>
                        </div>
                    </article>
                       <article class="timeline-item">
                        <div class="timeline-caption">
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <span class="arrow left"></span>
                              <span class="timeline-icon"><i class="fa fa-fire time-icon bg-dark"></i></span>
                              <span class="timeline-date">Investigations</span>
                              <h5>
                                <span>Investigations</span>
                               @foreach($mylabs as $lab)
                               <ul>
                                 <li><label class="label label-default">{{$lab->investigation}}</label></li>
                                 </ul>
                               @endforeach
                              </h5>
                              
                            </div>
                          </div>
                        </div>
                    </article>
                     <article class="timeline-item alt">
                        <div class="timeline-caption">                
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <span class="arrow right"></span>
                              <span class="timeline-icon"><i class="fa fa-flask time-icon bg-danger"></i></span>
                              <span class="timeline-date">Medications</span>
                              <h5>
                                <span>Drugs Prescribed</span>
                               @foreach($mydrugs as $drug)
                               <ul>
                                 <li><label class="badge bg-danger">{{$drug->drug_name}}</label></li>
                                 </ul>
                               @endforeach
                              </h5>
                              
                            </div>
                          </div>
                        </div>
                    </article>
                     <article class="timeline-item">
                        <div class="timeline-caption">
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <span class="arrow left"></span>
                              <span class="timeline-icon"><i class="fa fa-fire time-icon bg-dark"></i></span>
                              <span class="timeline-date">Plan</span>
                              <h5>
                                <span>Plan</span>
                                @foreach($myplan as $plan)
                                 <a>{!!$plan->assessment!!} <i class="fa fa-trash-o text-muted"></i> </a>
                               @endforeach
                              </h5>
                              
                            </div>
                          </div>
                        </div>
                    </article>
                    <div class="timeline-footer"><a href="#"><i class="fa fa-plus time-icon inline-block bg-dark"></i></a></div>
                  </div>
                </section>

                    </div>
                    </section>
                    </div>
                    @endrole


                       <div class="tab-pane" id="history-summary">
                    <section class="panel panel-default portlet-item" style="opacity: 1;">
                <header class="panel-heading">                    
                  <span class="label bg-dark"></span> Visits
                </header>
                <section class="panel-body">

                  @foreach($oldvisits as $visits)
                  <article class="media">
                    <span class="pull-left thumb-sm"><img src="images/avatar_default.jpg" class="img-circle"></span>
                    <div class="media-body">
                      <div class="pull-right media-xs text-center text-muted">
                        <strong class="h4">{{$visits->created_on}}</strong><br>
                       
                      </div>
                      <a href="/nurse-review/{{$visit_details->opd_number}}" class="h4">{{$visits->consultation_type}}</a>
                      <small class="block"><a href="#" class="">{{$visits->referal_doctor}}</a> <span class="label label-success">Click to view</span></small>
                      <small class="block m-t-sm">{{$visits->chief_complaint}}</small>
                    </div>
                  </article>
                  <div class="line"></div>
                  @endforeach



                  <div class="line pull-in"></div>
                </section>
              </section>
              </div>


                  <div class="tab-pane" id="review-fluid">
                          <section class="panel panel-default">
                      <div class="panel-body">
                          <div class="form-group pull-in clearfix">

                          <div class="col-sm-2">
                          <div class="form-group{{ $errors->has('fluid_time') ? ' has-error' : ''}}">
                            <label>Date & Time </label>
                              <input type="text" class="form-control" value="{{ Request::old('fluid_time') ?: '' }}"   id="fluid_time" name="fluid_time" placeholder="dd/mm/YYYY">        
                           @if ($errors->has('fluid_time'))
                          <span class="help-block">{{ $errors->first('fluid_time') }}</span>
                           @endif    
                          </div>   
                        </div>


                          <div class="col-sm-5">
                            <label>Fluid Intake Kind & Amount</label> 
                           <input type="text" class="form-control" class="text-success" id="ivf"  value="{{ Request::old('ivf') ?: '' }}"  name="ivf">
                          @if ($errors->has('ivf'))
                          <span class="help-block">{{ $errors->first('ivf') }}</span>
                           @endif   
                          </div>


                          <div class="col-sm-5">
                          <div class="form-group{{ $errors->has('oral') ? ' has-error' : ''}}">
                            <label> Fluid Output Kind & Amount  </label>
                            <input type="text" class="form-control" class="text-success" id="oral"  value="{{ Request::old('oral') ?: '' }}"  name="oral">
                           @if ($errors->has('oral'))
                          <span class="help-block">{{ $errors->first('oral') }}</span>
                           @endif    
                          </div>   
                        </div>
                            
                          {{--  <div class="col-sm-2">
                            <label>Urine Amount & Color </label> 
                           <input type="text" class="form-control" id="urine"  value="{{ Request::old('urine') ?: '' }}"  name="urine">
                          @if ($errors->has('urine'))
                          <span class="help-block">{{ $errors->first('urine') }}</span>
                           @endif   
                          </div>


                           <div class="col-sm-2">
                            <label>Stool Amount & Color </label> 
                          <input type="text" class="form-control" id="drains"  value="{{ Request::old('drains') ?: '' }}"  name="drains">
                          @if ($errors->has('drains'))
                          <span class="help-block">{{ $errors->first('drains') }}</span>
                           @endif   
                          </div>


                          <div class="col-sm-2">
                            <label>NGT (Nasogastric Tube)</label> 
                            <div class="form-group{{ $errors->has('ngt') ? ' has-error' : ''}}">
                             <input id="ngt" name="ngt"  class="form-control m-b">
                         
                           @if ($errors->has('ngt'))
                          <span class="help-block">{{ $errors->first('ngt') }}</span>
                           @endif    
                          </div>
                          </div> --}}

                          </div>




                         <div class="form-group pull-in clearfix">
                       
                        
                        </div>

                         <div class="form-group pull-in clearfix">
                     
                        
                        </div> 

                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Remarks</label> 
                           <textarea type="text" class="form-control" id="fluid_remark"  value="{{ Request::old('fluid_remark') ?: '' }}"  name="fluid_remark"></textarea>
                          @if ($errors->has('fluid_remark'))
                          <span class="help-block">{{ $errors->first('fluid_remark') }}</span>
                           @endif   
                          </div>

                           
                        </div>


                      <img src="">
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addFluids()" class="btn btn-success btn-s-xs">Add Record</button>
                      </footer>
                    </section>
                    <img src="/images/139239.svg" width="7%" align="right"> 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Fluid Intake - Output Chart</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="FluidTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                              <th>Date & Time</th>
                              <th>Intake Type & Amount</th>
                              <th>Fluid Output Kind & Amount</th>
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
 


                        <div class="tab-pane" id="review-investigation">
                          <section class="panel panel-default">
                      <div class="panel-body">
                 
                       <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <select id="investigation" name="investigation" rows="3" tabindex="1" data-placeholder="Search Investigation ..." style="width:100%">
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
                      </div>
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addInvestigation()" class="btn btn-success btn-s-xs">Add Investigation</button>
                      </footer>
                    </section>
                     <img src="/images/212327.svg" width="7%" align="right"> 
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

                  <div class="tab-pane" id="review-diagnosis">
                         {{--  <section class="panel panel-default">
                      <div class="panel-body">
                 
                       <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <select id="diagnosis" name="diagnosis" rows="3" tabindex="1" data-placeholder="Search Diagnosis ..." style="width:100%">
                           <option value="">-- Select Diagnosis --</option>
                           @foreach($diagnosis as $diagnosis)
                        <option value="{{ $diagnosis->type }}">{{ $diagnosis->type }}</option>
                          @endforeach
                        </select>         
                          </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label>Remarks</label> 
                            <div class="form-group{{ $errors->has('diagnosis_remark') ? ' has-error' : ''}}">
                            <textarea type="text" rows="3" class="form-control" id="diagnosis_remark" name="investigation_remark" value="{{ Request::old('diagnosis_remark') ?: '' }}"></textarea>   
                           @if ($errors->has('diagnosis_remark'))
                          <span class="help-block">{{ $errors->first('diagnosis_remark') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>
                      </div>
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addDiagnosis()" class="btn btn-success btn-s-xs">Add Diagnosis</button>
                      </footer>
                    </section> --}}
                     <img src="/images/426394.svg" width="7%" align="right"> 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Diagnosis History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                      <table id="diagnosisTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                          
                              <th>Diagnosis</th>
                              <th>Date</th>
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

                  <div class="tab-pane" id="review-drug">
                    <section class="panel panel-default">
                      <div class="panel-body">
                 
                      <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                          <div class="input-group m-b">
                           <select id="medication" name="medication" rows="3" onchange="getdrugdetail()" tabindex="1" data-placeholder="Search medication ..." style="width:100%">
                           <option value="">-- Select drug from pharmacy--</option>
                          @foreach($availabledrugs as $selectdrug)
                        <option value="{{ $selectdrug->id }}">{{ $selectdrug->name }} - {{$selectdrug->generic_name }}</option>
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
                        @if($visit_details->referal_doctor == Auth::user()->getNameOrUsername())
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


                    <section class="panel panel-info">
                                <header class="panel-heading font-bold">Drug Administration Notes</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="treatmentTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Drug</th>
                              <th>Time</th>
                              <th>Remark</th>
                             <th>Created By</th>
                             <th></th>
                             {{--  <th>Unit Cost</th>
                              <th>Total Cost</th> --}}
                             
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

                   <div class="tab-pane" id="review-history">
                                         <section class="panel panel-default">
                      <div class="panel-body">


                        <div class="form-group pull-in clearfix ">
                           <div class="col-sm-12">
                             <label class="badge bg-default">Past Medical History</label> 
                        <select name="medical_history[]" id="medical_history" style="width:100%" multiple data-placeholder=""  >
                          @foreach($histories as $history)
                        <option  value="{{ $history->type }}">{{ $history->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>


                          <div class="form-group pull-in clearfix ">
                           <div class="col-sm-12">
                           <label class="badge bg-default">Family History</label> 
                        <select name="family_history[]" id="family_history" style="width:100%" multiple data-placeholder=""  >
                          @foreach($histories as $history)
                        <option  value="{{ $history->type }}">{{ $history->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>


                          <div class="form-group pull-in clearfix ">
                           <div class="col-sm-12">
                           <label class="badge bg-default">Social History</label> 
                        <select name="social_history[]" id="social_history" style="width:100%" multiple data-placeholder=""  >
                          @foreach($histories as $history)
                        <option  value="{{ $history->type }}">{{ $history->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>

                          <div class="form-group pull-in clearfix ">
                           <div class="col-sm-12">
                           <label class="badge bg-default">Vaccinations</label> 
                        <select name="vaccinations_history[]" id="vaccinations_history" style="width:100%" multiple data-placeholder=""  >
                          @foreach($histories as $history)
                        <option  value="{{ $history->type }}">{{ $history->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>

                            <div class="form-group pull-in clearfix ">
                           <div class="col-sm-12">
                           <label class="badge bg-default">Drugs History</label> 
                        <select name="drug_history[]" id="drug_history" style="width:100%" multiple data-placeholder=""  >
                          @foreach($histories as $history)
                        <option  value="{{ $history->type }}">{{ $history->type }}</option>
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
                        <button type="button" onclick="addHistory()" class="btn btn-success btn-s-xs">Add History</button>
                      </footer>
                    </section>


           
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Social / Family / Medical History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="historyTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            <th> History</th>
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

                   <div class="tab-pane" id="review-complaint">
                         {{--  <section class="panel panel-default">
                      <div class="panel-body">
                          

                        <label class="badge bg-default">Chief Complaints</label> 
                        <div class="form-group pull-in clearfix">

                
                           <div class="col-sm-12">
                              <label>Complaint</label> 
                        <select name="complaint[]" id="complaint"  style="width:100%" multiple data-placeholder=""  >
                          @foreach($complaints as $complaint)
                        <option  value="{{ $complaint->type }}">{{ $complaint->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addComplaint()" class="btn btn-success btn-s-xs">Add Complaint</button>
                      </footer>
                    </section> --}}


                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Complaint History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="complaintTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Complaint</th>
                              <th>Remark</th>
                              <th>Date</th>
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
 
 

                    <div class="tab-pane" id="review-diagnosis2">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div class="table-responsive">
                          <header class="panel-heading font-bold">
                                 <a href="#new-diagnosis" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-danger pull-right">ICD +</span></a>
                                </header>
                       <table id="diagnosisTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                          
                              <th>Diagnosis</th>
                              <th></th>
                              <th>Date</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                    </div>
                      </ul>
                  </div>


                  <div class="tab-pane" id="review-medication">
                      {{-- 
                    <section class="panel panel-default">
                    <div class="panel-body">
                 
                      <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                          <div class="input-group m-b">
                           <select id="medication" name="medication" rows="3" readonly="true" onchange="getdrugdetail()" tabindex="1" data-placeholder="Select medication ..." style="width:100%">
                           <option value="">-- Select drug from pharmacy--</option>
                          @foreach($drugs as $drugs)
                        <option value="{{ $drugs->id }}">{{ $drugs->name }}</option>
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
                           <div class="col-sm-4">
                            <label>Quantity Prescribed </label> 
                           <input type="number" class="form-control" class="text-success" id="drug_quantity"  value="{{ Request::old('drug_quantity') ?: '' }}"  name="drug_quantity">
                          @if ($errors->has('drug_quantity'))
                          <span class="help-block">{{ $errors->first('drug_quantity') }}</span>
                           @endif   
                          </div>

                         <div class="col-sm-8">
                            <label>Dosage Remark</label> 
                          <input type="text" class="form-control" id="drug_application"  value="{{ Request::old('drug_application') ?: '' }}"  name="drug_application">
                           @if ($errors->has('drug_application'))
                          <span class="help-block">{{ $errors->first('drug_application') }}</span>
                           @endif    
                          </div>
                        </div>
                      <img src="">
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                       {{--  <button type="button" onclick="addDrug()" class="btn btn-success btn-s-xs">Add Medication</button> 
                      </footer>
                    </section>
                    --}}
                       <img src="/images/139202.svg" width="7%" align="right"> 
                      
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
                             {{--  <th>Unit Cost</th>
                              <th>Total Cost</th> --}}
                             
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                    </div>
                    </div>
                    </section>

                       <div class="line"></div>


                       <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                          <div class="input-group m-b">
                           <select id="medication_given" name="medication_given" rows="3" readonly="true" tabindex="1" data-placeholder="Select medication ..." style="width:100%">
                           <option value="">-- Select drug from pharmacy--</option>
                          @foreach($drugs as $drugs)
                        <option value="{{ $drugs->drug_name }}">{{ $drugs->drug_name }}</option>
                          @endforeach
                        </select>  <div class="input-group-btn">
                           <a href="#" class="bootstrap-modal-form-open" data-toggle="modal" ><button  class="btn btn-sm btn-default" type="button"><i class="fa fa-plus-circle"></i></button></a>
                        </div>     
                        </div>   
                          </div>
                        </div>



                          <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('medication_time') ? ' has-error' : ''}}">
                            <label>Time Given</label>
                              <input type="text" class="form-control" value="{{ Request::old('medication_time') ?: '' }}"   id="medication_time" name="medication_time" placeholder="dd/mm/YYYY">        
                           @if ($errors->has('medication_time'))
                          <span class="help-block">{{ $errors->first('medication_time') }}</span>
                           @endif    
                          </div>   
                        </div>
                        <div class="col-sm-8">
                          <div class="form-group{{ $errors->has('medication_plan') ? ' has-error' : ''}}">
                            <label>Remark</label>
                             <input type="text" class="form-control" class="text-success" id="medication_plan"  value="{{ Request::old('medication_plan') ?: '' }}"  name="medication_plan">       
                           @if ($errors->has('medication_plan'))
                          <span class="help-block">{{ $errors->first('medication_plan') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         <footer class="panel-footer text-right bg-light lter">

                        <button type="button" onclick="addTreatementPlan()" class="btn btn-success btn-s-xs">Add Drug Treatment Summary</button>
                      </footer>
                      
                      <section class="panel panel-info">
                                <header class="panel-heading font-bold">Treatment History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="treatmentTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Drug</th>
                              <th>Time</th>
                              <th>Remark</th>
                             <th>Created By</th>
                             <th></th>
                             {{--  <th>Unit Cost</th>
                              <th>Total Cost</th> --}}
                             
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                    </div>
                    </div>
                    </section>


                  </div>

                   <div class="tab-pane" id="review-procedure">
                                      <section class="panel panel-default">
                      <div class="panel-body">
                 
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <select id="procedure" name="procedure" rows="3" tabindex="1" data-placeholder="Select item ..." style="width:100%">
                           <option value="">-- Select Procedure / Consumable --</option>
                          @foreach($treatments as $treatment)
                        <option value="{{ $treatment->type }}">{{ $treatment->type }}</option>
                          @endforeach
                        </select>         
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                         <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_form') ? ' has-error' : ''}}">
                            <label>Quantity</label>
                             <input type="number" class="form-control" class="text-success" id="procedure_quanity"  value="{{ Request::old('procedure_quanity') ?: '' }}"  name="procedure_quanity">       
                           @if ($errors->has('procedure_quanity'))
                          <span class="help-block">{{ $errors->first('procedure_quanity') }}</span>
                           @endif    
                          </div>  
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
                        <button type="button" onclick="addProcedure()" class="btn btn-success btn-s-xs">Add Procedure</button>
                      </footer>
                    </section>
                          
 <img src="/images/128639.svg" width="7%" align="right"> 
                          <section class="panel panel-info">
                                <header class="panel-heading font-bold">Procedure History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="procedureTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                          
                             <th>Procedure</th>
                             <th>Quantity</th>
                              <th>Unit Price</th>
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


              {{--  <div class="tab-pane" id="review-assessment">
                          <section class="panel panel-default">
                      <div class="panel-body">
                       
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label class="badge bg-default">Plan</label> 
                            <div class="form-group{{ $errors->has('assessment') ? ' has-error' : ''}}">
                           <div id="assessment" name="assessment" class="form-control" style="overflow:scroll;height:500px;max-height:500px" contenteditable="true"> </div>   
                           @if ($errors->has('assessment'))
                          <span class="help-block">{{ $errors->first('assessment') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                      </div>
                      <footer class="panel-footer text-right bg-light lter">
                       
                        <button type="button" onclick="addNursePlan()" class="btn btn-success btn-s-xs">Add Plan</button>
                       
                      </footer>
                    </section>
                      <img src="/images/439190.svg" width="10%" align="right"> 
                   
                    {{--     <section class="panel panel-info">
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
                  </div> --}}



                     <div class="tab-pane" id="review-doctor-assessment">
                         
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Doctor's Plan</header>
                                <div class="panel-body">
                                      <div class="panel-body text-sm">
                          <div class="col-sm-12">
                      
                        
                       <textarea id="doctorassessment" name="doctorassessment"> 
                                 {!!$mydoctorplan->assessment!!}
                               </textarea>
                       
                      </div>
                      </div>

                                </div>
                                </section>

                        <footer class="panel-footer text-right bg-light lter">
                       
                         
                      </footer>
                     
                  </div>



                    <div class="tab-pane" id="review-assessment">
                         
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Nurse Plan</header>
                                <div class="panel-body">
                                      <div class="panel-body text-sm">
                          <div class="col-sm-12">
                      
                        
                       <textarea id="assessment" name="assessment"> 
                                 {!!$mynurseplan->content!!}
                               </textarea>
                       
                      </div>
                      </div>

                                </div>
                                </section>

                        <footer class="panel-footer text-right bg-light lter">
                         <button type="button" onclick="addNursePlan()" class="btn btn-success btn-s-xs">Save Plan</button>
                         
                      </footer>
                     
                  </div>





                   <div class="tab-pane" id="review-plan">
                         
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Nurse Notes</header>
                                <div class="panel-body">
                                      <div class="panel-body text-sm">
                          <div class="col-sm-12">
                      
                        
                       <textarea id="continuation_sheet" name="continuation_sheet"> 
                                 {!!$mynursenotes->content!!}
                               </textarea>
                       
                      </div>
                      </div>

                                </div>
                                </section>

                        <footer class="panel-footer text-right bg-light lter">
                      <button type="button" onclick="addNurseNote()" class="btn btn-success btn-s-xs">Add Note</button>
                         
                      </footer>
                     
                  </div> 



              {{--      <div class="tab-pane" id="review-plan">
                          <section class="panel panel-default">
                      <div class="panel-body">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label class="badge bg-default">Nurse Notes</label> 
                            <div class="form-group{{ $errors->has('continuation_sheet') ? ' has-error' : ''}}">
                           <div id="continuation_sheet" name="continuation_sheet" class="form-control" style="overflow:scroll;height:500px;max-height:500px" contenteditable="true"> @foreach($nursenotes as $note)
                                 <a> {!! $note->content!!}</a>
                               @endforeach</div>   
                           @if ($errors->has('continuation_sheet'))
                          <span class="help-block">{{ $errors->first('continuation_sheet') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                      </div>
                      <footer class="panel-footer text-right bg-light lter">
                       
                        <button type="button" onclick="addNurseNote()" class="btn btn-success btn-s-xs">Add Note</button>
                       
                      </footer>
                    </section>
                  </div>
 --}}
                 {{--  <div class="tab-pane" id="review-plan">
                          <section class="panel panel-default">
                      <div class="panel-body">
                 
                

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label class="badge bg-default">Care Plan </label> 
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
                            <label class="badge bg-default"> Notes </label> 
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
                        <button type="button" onclick="addPlan()" class="btn btn-success btn-s-xs">Add Summary</button>
                      </footer>
                    </section>
                    <img src="/images/432215.svg" width="5%" align="right"> 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Discharge History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="planTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                               <th>Date</th>
                              <th>Care Plan</th>
                              <th>Note</th>
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
                              </a>{{ $image->filename }} <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a> <span class="label label-default btn-rounded" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ $image->created_on}}">{{ $image->created_on->diffForHumans() }}</span>
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
                    </section>
                  </section>
                  
                </aside>


    
                    </section>
                    </section>
                    </section>



  @stop



  


<script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<script src="{{ asset('/js/tinymce/tinymce.min.js')}}"></script>
 
 <script>tinymce.init({
  selector: '#assessment',
  height: 500,
  menubar: true,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount',
    'template'
  ],
  toolbar: 'insert | undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
  

});
 </script>
 
 <script>tinymce.init({
  selector: '#doctorassessment',
  height: 500,
  menubar: true,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount',
    'template'
  ],
  toolbar: 'insert | undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help'
  

});
 </script>

 <script>tinymce.init({
  selector: '#continuation_sheet',
  height: 500,
  menubar: true,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount',
    'template'
  ],
  toolbar: 'insert | undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  templates: [
    //{title: 'Some title 1', description: 'Some desc 1', content: 'My content  {$bond_description}'},
    //{title: 'Advance Payment Bond', description: 'Some desc 2', url: 'http://127.0.0.1:8000/bond-test'}
  ],
  template_replace_values: {

  }

  

});
 </script>



<script type="text/javascript">
$(function () {
  $('#medication_time').daterangepicker({
     "minDate": moment('1930-06-14'),
      "maxDate": moment(),
      "singleDatePicker":true,
      "autoApply": true,
      "showDropdowns": true,
      "timePicker": true,
      "timePicker24Hour": true,
      //"timePickerIncrement": 15,
      "locale": {
      "format": "DD/MM/YYYY HH:mm:ss",
      "separator": " - ",
    }
  });
});

$(function () {
  $('#fluid_time').daterangepicker({
     "minDate": moment('1930-06-14'),
      "maxDate": moment(),
      "singleDatePicker":true,
      "autoApply": true,
      "showDropdowns": true,
      "timePicker": true,
      "timePicker24Hour": true,
      //"timePickerIncrement": 15,
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
                loadFluids();
                loadTreatmentPlan();

    $('#investigation').select2();  
    // $('#new-diagnosis select[name="diagnosis_category"]').select2();     
    // $('#new-diagnosis select[name="diagnosis"]').select2();  
    $('#complaint').select2({
      tags: true
      });
    $('#procedure').select2();
    $('#history').select2();
     $('#diagnosis').select2();
$('#medication_given').select2();
    $('#medication').select2();
      $('#drug_application').select2({
      tags: true
      });

    $('#social_history').select2();
    $('#medical_history').select2();
    $('#family_history').select2();
    $('#vaccinations_history').select2();
    $('#drug_history').select2();

  });
</script>



  <script type="text/javascript">

 function addVitals()
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
          "spo2": $('#SpO2').val(),
          "fbs": $('#fbs').val(),
          "rbs": $('#rbs').val(),
           "vr_visual_ascuity": $('#vr_visual_ascuity').val(),
          "vital_remark": $('#vital_remark').val(),
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


    function getdrugdetail()
{ 
   //alert($('#medication').val());

  $.get("/get-drug-info",
          {"medication": $('#medication').val()},
          function(json)
          {

            
                $('#drug_dosage').val(json['drug_dosage']);
                $('#drug_form').val(json['drug_form']);
                $('#drug_pack_size').val(json['drug_pack_size']);
                $('#drug_generic').val(json['drug_generic']);

                
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


function addComplaint()
{
if($('#complaint').val()!= "")
{

  //alert($('#editor').html());
    $.get('/add-complaint-nurse',
        {
          "opd_number": $('#opd_number').val(),
          "complaint": $('#complaint').val(),
          "com_period": $('#com_period').val(),
          "com_span":  $('#com_span').val(),
          "com_remark":  $('#com_remark').val(),
          "presentingcomplaint":  $('#editor').html(),
          "directquestion":  $('#directquestion').val()                                
        },
        function(data)
        { 
          
        $.each(data, function (key, value) {
        if(data["OK"])
        {
          //sweetAlert("Complaint has been added!");
          //$('#new-complaint').modal('toggle')
          loadComplaints();
        }
        else
        {
          sweetAlert("Complaint failed to be added!");
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
          "fullname":  $('#fullname').val()       
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


function addTreatementPlan()
{
if($('#medication_given').val()!= "")
{

  //alert($('#complaint').val());
    $.get('/add-treatment_schedule',
        {
          "opd_number": $('#opd_number').val(),
          "medication": $('#medication_given').val(),
          "medication_plan": $('#medication_plan').val(),
          "medication_time": $('#medication_time').val()
                         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          loadTreatmentPlan();
        }
        else
        {
          sweetAlert("Treatment details failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Treatment details!");}
}




function addNursePlan()
{
if($('#assessment').html()!= "")
{

  tinyMCE.triggerSave();
    $.get('/add-nurse-plan',
        {
          "opd_number": $('#opd_number').val(),
          "nurse_plan": $('#assessment').val()
                         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
           sweetAlert("Plan saved successfully!");
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
    {sweetAlert("Please add a nurse plan!");}
}



function addNurseNote()
{
if($('#continuation_sheet').html()!= "")
{

  //alert($('#complaint').val());
  tinyMCE.triggerSave();
    $.get('/add-nurse-note',
        {
          "opd_number": $('#opd_number').val(),
          "nurse_note": $('#continuation_sheet').val()
                         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          sweetAlert("Note saved successfully!");
          loadAssessment();
        }
        else
        {
          sweetAlert("Note failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please add a note!");}
}


function getDrugAvailable()
{

     $.get('/get-drug-availability',
        {
          "drug_name": $('#drug_name').val()             
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
          sweetAlert("Drug failed to be added!");
        }
      });
                                        
        },'json');

}



function addDrug()
{
if($('#medication').val()!= "" && $('#drug_quantity').val()!="")
{

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
    {sweetAlert("Please select a drug!");}
}

function addInvestigation()
{
if($('#investigation').val()!= "")
{

    $.get('/add-investigation',
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

function doDischarge(id,name)
  {

         
      swal({   
        title: "Discharging " + name +"!",  
        text: "Do you want to discharge "+name+" ?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, discharge!",   
        cancelButtonText: "No, cancel !",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/discharge-opd',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Discharged!", name +" was successfully deleted.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to discharge.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to delete.", "error");   
        } });

  }



function addProcedure()
{
if($('#procedure').val()!= "" && $('#procedure_quanity').val()!= "")
{

    $.get('/add-procedure-nurse',
        {
          "patient_id": $('#patient_id').val(),
           "accounttype": $('#accounttype').val(),
          "opd_number": $('#opd_number').val(),
          "procedure": $('#procedure').val(),
          "procedure_quanity": $('#procedure_quanity').val(),
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
    {sweetAlert("Please select a Procedure or enter a quantity!");}
}



function addFluids()
{
if($('#ivf').val()!= "")
{

    $.get('/add-fluid',
        {
          "patient_id": $('#patient_id').val(),
          "opd_number": $('#opd_number').val(),
          "ivf"       : $('#ivf').val(),
          "oral"      : $('#oral').val(),
          "urine"     : $('#urine').val(),
          "ngt"       : $('#ngt').val(),
          "fluid_time"       : $('#fluid_time').val(),
          "drains"    : $('#drains').val()

        },
        function(data)
        { 
          
        $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          loadFluids();
        }
        else
        {
          sweetAlert("Input / Output record failed to be added!");
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
        $.get("/add-diagnosis",
          
          {

            "opd_number":$('#opd_number').val(),
            "diagnosis":diagnosis
          },
          function(json)
          {

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
            $('#DocumentTable tbody').append('<tr><td>'+ value['filename'] +'</td><td>'+ value['original_name'] +'</td><td>'+ value['size'] +'</td><td>'+ value['created_on'] +'</td><td><a a href="/uploads/images/'+ value['filepath'] +'"><i onclick="/uploads/images/'+ value['filepath'] +'" class="fa fa-eye"></i></a></td></tr>');
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
            $('#drugTable tbody').append('<tr><td>'+ value['drug_quantity'] +'</td><td>'+ value['drug_name'] +'</td><td>'+ value['drug_application'] +'</td></tr>');
            });
                                          
         },'json');      
    }


    function loadFluids()
   {
         
        
        $.get('/patient-fluids',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#fluidTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#fluidTable tbody').append('<tr><td>'+ value['fluid_time'] +'</td><td>'+ value['ivf'] +'</td><td>'+ value['oral'] +'</td><td><a a href="#"><i onclick="removeFluid('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
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
            $('#planTable tbody').append('<tr><td>'+ value['date'] +'</td><td>'+ value['plan'] +'</td><td>'+ value['action'] +'</td></tr>');
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
            $('#assessmentTable tbody').append('<tr><td>'+ value['assessment'] +'</td><td>'+ value['created_by'] +'</td><td>'+ value['created_on'] +'</td></tr>');
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
            $('#complaintTable tbody').append('<tr><td>'+ value['complaint'] +'</td><td>'+ value['period'] +' '+ value['span'] +' '+ value['remark'] +'</td><td>'+ value['date'] +'</td></tr>');
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
            $('#vitalTable tbody').append('<tr><td>'+ value['created_on'] +'</td><td>'+ value['weight'] +'</td><td>'+ value['height'] +'</td><td>'+ value['bmi']  + (value['bmi_status'] == "Normal" ? '<span class="label label-success btn-rounded">'+ value['bmi_status'] +'</span>' :  '<span class="label label-danger btn-rounded">'+ value['bmi_status'] +'</span>' ) +'</td><td>'+ value['temperature'] + (value['temp_status'] == "Normal" ? '<span class="label label-success btn-rounded">'+ value['temp_status'] +'</span>' :  '<span class="label label-danger btn-rounded">'+ value['temp_status'] +'</span>' ) +'</td><td>'+ value['sbp'] + '/' + value['dbp'] + (value['bp_status'] == "Normal" ? '<span class="label label-success btn-rounded">'+ value['bp_status'] +'</span>' :  '<span class="label label-danger btn-rounded">'+ value['bp_status'] +'</span>' ) +'</td><td>'+ value['pulse_rate'] +'</td><td>'+ value['respiration'] +'</td><td>'+ value['spo2'] +'</td><td>'+ value['rbs'] +'</td><td><a a href="#"><i onclick="removeVital('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
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
           $('#investigationsTable tbody').append('<tr><td>'+ value['investigation'] +'</td><td>'+ value['cost'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['status'] +'</td><td><a a href="/test-collection-slip/'+value['visitid']+'"><i onclick="" class="fa fa-print"></i></a></td><td><a a href="/laboratory-results/'+value['visitid']+'"><i onclick="" class="fa fa-eye"></i></a></td><td><a a href="#"><i onclick="removeinvestigation('+value['id']+')" class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Investigation"></i></a></td></tr>');
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
            $('#diagnosisTable tbody').append('<tr><td>'+ value['diagnosis'] +'</td><td>'+ value['date'] +'</td></tr>');
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
            $('#procedureTable tbody').append('<tr><td>'+ value['procedure'] +'</td><td>'+ value['is_billable'] +'</td><td>'+ value['cost'] +'</td><td>'+ value['is_billable'] * value['cost'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['status'] +'</td><td><a a href="#"><i onclick="removeprocedure('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
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



    function loadTreatmentPlan()
   {
         
        
        $.get('/patient-nurse-treatment',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#treatmentTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#treatmentTable tbody').append('<tr><td>'+ value['treatment_name'] +'</td><td>'+ value['time_given'] +'</td><td>'+ value['remark'] +'</td><td>'+ value['created_by'] +'</td><td><a a href="#"><i onclick="removeTreatment('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
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
            $('#ImageTable tbody').append('<tr><td>'+ value['diagnosis'] +'</td><td>'+ value['remark'] +'</td><td>'+ value['date'] +'</td></tr>');
            });
                                          
         },'json');      
    }




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

    function removeFluid(id)
   {
     
          $.get('/delete-fluids',
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
              loadFluids();
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed.", "error");
              
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


   function removeTreatment(id)
   {
      
          $.get('/delete-treatment-sheet',
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
              loadTreatmentPlan();
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from history.", "error");
              
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
              //swal("Deleted!", name +" was removed from list.", "success"); 
              loadComplaints();
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');    
           
    
   }



  </script>



<div class="modal fade" id="new-diagnosis" style="height:700px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add Diagnosis</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" class="panel-body wrapper-lg">
                           @include('doctor/diagnosis')
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

      <div class="modal fade" id="new-medication" style="height:400px">
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

     <div class="modal fade" id="attach_document" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Attach Document</h4>
        </div>

        <div class="modal-body">
         <div class="fallback">
          <form method="post"  enctype="multipart/form-data" action="/uploadfiles">
          <input type="text" class="form-control" width="1000px" height="40px" name="filename" id="filename" placeholder="Enter file name" /><br>
          <input type="file" class="form-control dropbox" width="500px" height="40px" name="image" /><br>
          <input type="submit" name="submit"  class="btn btn-success btn-s-xs" value="upload" />
          <input type="hidden" name="_token" value="{{ Session::token() }}">
          <input type="hidden" name="selectedid" id="selectedid" value="{{ $visit_details->patient_id }}">
          <input type="hidden" name="visitid" id="visitid" value="{{ $visit_details->opd_number }}">
        </form>
        </div>
          <br>
          <br>
          <br>
              <div class="jumbotron how-to-create">
                <ul>
                    <li>Documents/Images are uploaded as soon as you drop them</li>
                    <li>Maximum allowed size of image is 8MB</li>
                </ul>

            </div>

      </div>
      </div>
      </div>
      </div>


@endrole
