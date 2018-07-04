@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
                    <p><span class="label label-success">{{ $visit_details->consultation_type }} - {{ $patients[0]->fullname }}</span></p> 
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
                          <a href="/images/{{ $patients[0]->image }}" class="pull-left thumb m-r">
                            <img src="/images/{{ $patients[0]->image }}" class="img-circle 3x">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs">{{ $patients[0]->fullname }}</div>
                            <br>
                            <div>
                          
                           <p class="block"><a href="#" class="">ID # </a> <span class="label label-default">{{ $patients[0]->patient_id }}</span></p>
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
                                <span class="m-b-xs h4 block">{{ $patients[0]->date_of_birth->age }}</span>
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
                            <span class="pull-right">{{ $patients[0]->blood_group }}</span>
                            
                             <small class="text-muted">Blood Group</small>
                          </li>
                        </ul>
                            

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

                                   @if($vital->b_fat == '') @else <li> Body Fat <label class="badge bg-info"> {{$vital->b_fat }} </label></li> @endif

                                    @if($vital->v_fat == '') @else <li> Visceral Fat <label class="badge bg-info"> {{$vital->v_fat }} </label></li> @endif

                                     @if($vital->calories == '') @else <li> Current Calories <label class="badge bg-info"> {{$vital->calories }} </label></li> @endif
                                    
                                    @if($vital->weight == '') @else <li> WHR <label class="badge bg-info"> {{ $vital->waist_circumference/$vital->hip_circumference }}  </label></li> @endif

                                     @if($vital->IBW_range_lower == '') @else <li> IBW Range Upper <label class="badge bg-info"> {{ $vital->IBW_range_lower }}  </label></li> @endif

                                      @if($vital->IBW_range_upper == '') @else <li> IBW Range Lower <label class="badge bg-info"> {{ $vital->IBW_range_upper }}  </label></li> @endif

                                 </ul>
                                 <div class="line"></div>
                               @endforeach
                              </h5>
                            </ul>
                          <br>
                          <img src="/images/144315.svg"> 
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>


                
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class=""><a href="#review-complaint" data-toggle="tab"><i class="fa fa-meh-o text-default"></i> Nutritional Assessment </a></li>
                       <li class=""><a href="#review-assessment" data-toggle="tab"><i class="fa fa-puzzle-piece text-default"></i> Nutritional Intervention </a></li>
                        <li class=""><a href="#review-diagnosis" data-toggle="tab"><i class="fa fa fa-legal (alias) text-default"></i> Diagnosis </a></li> 
                         <li class=""><a href="#review-investigation" data-toggle="tab"><i class="fa fa-film text-default"></i> Lab / Investigations </a></li>
                       
                        <li class=""><a href="#review-medication" data-toggle="tab"><i class="fa fa-flask text-default"></i> Nutritional Supplements </a></li>
                         <li class=""><a href="#review-discharge" data-toggle="tab"><i class="fa fa-bars text-default"></i> Visit Summary </a></li>
                         <li class=""><a href="#review-documents" data-toggle="tab"><i class="fa fa-folder text-default"></i> Documents </a></li> 
                         <li class=""><a href="#review-summary" data-toggle="tab"><i class="fa fa-folder text-default"></i> Notes Summary </a></li> 
                         <span class="hidden-sm">.</span>
                      </ul>
                    </header>



                     <div class="panel-body">
                     <div class="tab-content"> 


                        <div class="tab-pane" id="review-investigation">
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

                     <div class="tab-pane" id="review-discharge">
                          <section class="panel panel-default">
                      <div class="panel-body">
                 
                

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label class="badge bg-default">Reason for Discharge </label> 
                            <div class="form-group{{ $errors->has('treament_plan') ? ' has-error' : ''}}">
                            <textarea type="text" rows="5" class="form-control" id="treament_plan" name="treament_plan" value="{{ Request::old('treament_plan') ?: '' }}"></textarea>   
                           @if ($errors->has('treament_plan'))
                          <span class="help-block">{{ $errors->first('treament_plan') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <div class="form-group">
                      <label class="col-sm-2 control-label badge bg-default">Disposition</label>
                      <div class="col-sm-10">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="">
                            Return Visit Request <a href="/doctor-appointments/{{ $visit_details->referal_doctor}}" class="btn btn-info rounded" data-toggle="modal">Appointment Request</a>
                          </label>
                        </div>

                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                            Corespondence Letter <a href="#letter-request" class="btn btn-info rounded" data-toggle="modal">Create A Request</a>
                          </label>
                        </div>
                         <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                            Internal Referral <a href="#internal-referral" class="btn btn-info rounded bootstrap-modal-form-open" onclick="getDetails('{{ $patients[0]->id }}')" data-toggle="modal">Create Internal Referral</a>
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                            External Referral <a href="/print-referal-note/{{ $visit_details->opd_number }}" class="btn btn-info rounded" data-toggle="modal">Create Referral Letter</a>
                          </label>
                        </div>

                         <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                            Excuse Duty <a href="/print-excuse-duty/{{ $visit_details->opd_number }}" class="btn btn-info rounded" data-toggle="modal">Print Excuse Duty</a>
                          </label>
                        </div>

                         <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                            Refusal of Treatment <a href="/print-refusal-treatment/{{ $visit_details->opd_number }}" class="btn btn-info rounded" data-toggle="modal">Print Refusal of Treatment</a>
                          </label>
                        </div>
                       
                      </div>
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
                              <th>Reason for Discharge</th>
                              <th>Plan</th>
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
                  </div>

                  <div class="tab-pane" id="review-summary">
                    
                    <section class="panel panel-info">
                                <header class="panel-heading font-bold">Treatment Summary</header>
                                <div class="panel-body">
                                       <section class="scrollable wrapper">
                  <div class="timeline">
                    <article class="timeline-item active">
                        <div class="timeline-caption">
                          <div class="panel bg-primary lter no-borders">
                            <div class="panel-body">
                              <span class="timeline-icon"><i class="fa fa-bell-o time-icon bg-primary"></i></span> 
                              <span class="timeline-date"> <label class="badge bg-danger">  <label class="badge bg-danger"> </span>
                              <h5>
                                <span>Chief Complaint</span>
                               @foreach($mycomplaints as $complaint)
                               <a href="#"> <label class="badge bg-danger"> {{$complaint->complaint}} <i onclick="removecomplain('{{$complaint->id}}','{{$complaint->complaint}}')" class="fa fa-trash-o"></i></label></a>
                               @endforeach
                              </h5>
                              <div class="m-t-sm timeline-action">
                               {{--  <span class="h3 pull-left m-r-sm">4:51</span> --}}
                                <a href="/print-visit-summary/{{ $visit_details->opd_number  }}"><button class="btn btn-sm btn-default btn-bg"><i class="fa fa-check"></i> Print </button></a>
                              </div>
                            </div>
                          </div>
                        </div>
                    </article>
                    <article class="timeline-item active">
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
                    <div class="timeline-footer"><a href="#"><i class="fa fa-plus time-icon inline-block bg-dark"></i></a></div>
                  </div>
                </section>
                    </div>

                      </section>
                  </div>

                    <div class="tab-pane" id="review-diagnosis">
                          <section class="panel panel-default">
                            <header class="panel-heading font-bold">
                                 <a href="#new-diagnosis" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-danger pull-right">Select from ICD 10 +</span></a>
                                </header>
                      <div class="panel-body">
               
                       <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <select id="diagnosis" name="diagnosis[]" multiple rows="3" tabindex="1" data-placeholder="Search diagnosis ..." style="width:100%">
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
                    </section>
                     <img src="/images/426394.svg" width="10%" align="right"> 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Diagnosis History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
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
                    </div>
                    </section>
                  </div>


                  
                   <div class="tab-pane" id="review-history">
                          <section class="panel panel-default">
                      
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

                   <div class="tab-pane active" id="review-complaint">
                          <section class="panel panel-default">
                      <div class="panel-body">


                       <!-- .accordion -->
                  <div class="panel-group m-b" id="accordion2">
                   
{{-- 
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                         1. Chief Compliant
                        </a>
                      </div>
                      <div id="collapseOne" class="panel-collapse in">
                        <div class="panel-body text-sm">

                         <div class="form-group pull-in clearfix">
                           <div class="col-sm-12">
                              <label>Complaint</label> 
                        <select name="complaint[]" id="complaint" style="width:100%" multiple data-placeholder=""  >
                          @foreach($complaints as $complaint)
                        <option  value="{{ $complaint->type }}">{{ $complaint->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>

                          <div>
                            
                              @foreach($mycomplaints as $complaint)
                               <a a href="#"> <label class="badge bg-danger"> {{$complaint->complaint}} <i onclick="removecomplain('{{$complaint->id}}','{{$complaint->complaint}}')" class="fa fa-trash-o"></i></label></a>
                               @endforeach
                          </div>




                        </div>
                      </div>
                    </div> --}}

                    
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                          1. Nutritional Assessment
                        </a>
                      </div>
                      <div id="collapseTwo" class="panel-collapse in">
                        <div class="panel-body text-sm">
                          <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                        <label class="badge bg-default">Nutritional Assessment</label> 
                        <div class="btn-toolbar m-b-sm btn-editor" data-role="editor-toolbar" data-target="#editor">
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li><li><a data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li><li><a data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li><li><a data-edit="fontName Arial Black" style="font-family:'Arial Black'">Arial Black</a></li><li><a data-edit="fontName Courier" style="font-family:'Courier'">Courier</a></li><li><a data-edit="fontName Courier New" style="font-family:'Courier New'">Courier New</a></li><li><a data-edit="fontName Comic Sans MS" style="font-family:'Comic Sans MS'">Comic Sans MS</a></li><li><a data-edit="fontName Helvetica" style="font-family:'Helvetica'">Helvetica</a></li><li><a data-edit="fontName Impact" style="font-family:'Impact'">Impact</a></li><li><a data-edit="fontName Lucida Grande" style="font-family:'Lucida Grande'">Lucida Grande</a></li><li><a data-edit="fontName Lucida Sans" style="font-family:'Lucida Sans'">Lucida Sans</a></li><li><a data-edit="fontName Tahoma" style="font-family:'Tahoma'">Tahoma</a></li><li><a data-edit="fontName Times" style="font-family:'Times'">Times</a></li><li><a data-edit="fontName Times New Roman" style="font-family:'Times New Roman'">Times New Roman</a></li><li><a data-edit="fontName Verdana" style="font-family:'Verdana'">Verdana</a></li></ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                              <ul class="dropdown-menu">
                              <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                              <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                              <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                              </ul>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="strikethrough" title="" data-original-title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i class="fa fa-list-ul"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="insertorderedlist" title="" data-original-title="Number list"><i class="fa fa-list-ol"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="outdent" title="" data-original-title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="indent" title="" data-original-title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                            <a class="btn btn-default btn-sm btn-info" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                          </div>
                          <div class="btn-group">
                          <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="" data-original-title="Hyperlink"><i class="fa fa-link"></i></a>
                            <div class="dropdown-menu">
                              <div class="input-group m-l-xs m-r-xs">
                                <input class="form-control input-sm" placeholder="URL" type="text" data-edit="createLink">
                                <div class="input-group-btn">
                                  <button class="btn btn-default btn-sm" type="button">Add</button>
                                </div>
                              </div>
                            </div>
                            <a class="btn btn-default btn-sm" data-edit="unlink" title="" data-original-title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                          </div>
                          
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" title="" id="pictureBtn" data-original-title="Insert picture (or just drag &amp; drop)"><i class="fa fa-picture-o"></i></a>
                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 36px; height: 31px;">
                          </div>
                          <div class="btn-group">
                            <a class="btn btn-default btn-sm" data-edit="undo" title="" data-original-title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                            <a class="btn btn-default btn-sm" data-edit="redo" title="" data-original-title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                          </div>
                        </div>
                        <div id="editor" name="editor" class="form-control" style="overflow:scroll;height:150px;max-height:150px" contenteditable="true"> @foreach($mycomplaints as $complaint)
                                 <a>{!!$complaint->presenting!!}</a>
                               @endforeach</div>
                      </div>
                    </div>
                        </div>
                      </div>
                    </div>

                    {{--   <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseEight">
                         3. On Direct Question
                        </a>
                      </div>
                      <div id="collapseEight" class="panel-collapse collapse">
                        <div class="panel-body text-sm">

                         <div class="form-group pull-in clearfix">
                           <div class="col-sm-12">
                              <label>On Direct Question</label> 
                        <select name="directquestion[]" id="directquestion" style="width:100%" multiple data-placeholder=""  >
                          @foreach($complaints as $complaint)
                        <option  value="{{ $complaint->type }}">{{ $complaint->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>
                           @foreach($mycomplaints as $complaint)
                                 <a> <label class="badge bg-danger"> {{$complaint->directquestion}} </label></a> <i class="fa fa-trash-o text-muted"></i> </a>
                               @endforeach

                        </div>
                      </div>
                    </div>
                  
 --}}
                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                         2. Personal , Family , Social History
                        </a>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                        <div class="panel-body">
                        <div class="form-group pull-in clearfix ">
                           <div class="col-sm-3">
                             <label class="badge bg-primary">Past Medical History</label> 
                        <select name="medical_history[]" id="medical_history" style="width:100%" multiple data-placeholder="PMHx"  >
                          @foreach($pastmedicalhx as $pastmedicalhx)
                        <option  value="{{ $pastmedicalhx->type }}">{{ $pastmedicalhx->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                           <div class="col-sm-3">
                           <label class="badge bg-warning">Family History</label> 
                        <select name="family_history[]" id="family_history" style="width:100%" multiple data-placeholder="FMHx"  >
                          @foreach($familyhx as $familyhx)
                        <option  value="{{ $familyhx->type }}">{{ $familyhx->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                           <div class="col-sm-3">
                           <label class="badge bg-success">Phychosocial History</label> 
                        <select name="social_history[]" id="social_history" style="width:100%" multiple data-placeholder="SHx"  >
                          @foreach($socialhx as $socialhx)
                        <option  value="{{ $socialhx->type }}">{{ $socialhx->type }}</option>
                          @endforeach
                            </select>    
                          </div>

                           <div class="col-sm-3">
                           <label class="badge bg-danger">Vaccinations</label> 
                        <select name="vaccinations_history[]" id="vaccinations_history" style="width:100%" multiple data-placeholder=""  >
                          @foreach($vacinnationhx as $vacinnationhx)
                        <option  value="{{ $vacinnationhx->type }}">{{ $vacinnationhx->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>


                        


                            <div class="form-group pull-in clearfix ">
                           <div class="col-sm-3">
                           <label class="badge bg-danger">Current Medications</label> 
                        <select name="drug_history[]" id="drug_history" style="width:100%" multiple data-placeholder="Meds"  >
                          @foreach($medicationhx as $medicationhx)
                        <option  value="{{ $medicationhx->type }}">{{ $medicationhx->type }}</option>
                          @endforeach
                            </select>    
                          </div>

                           <div class="col-sm-3">
                           <label class="badge bg-info">Surgical History</label> 
                        <select name="surgical_history[]" id="surgical_history" style="width:100%" multiple data-placeholder="PSHx"  >
                          @foreach($surgicalhx as $surgicalhx)
                        <option  value="{{ $surgicalhx->type }}">{{ $surgicalhx->type }}</option>
                          @endforeach
                            </select>    
                          </div>

                           <div class="col-sm-3">
                           <label class="badge bg-warning">Reproductive/Prenatal History</label> 
                        <select name="reproductive_history[]" id="reproductive_history" style="width:100%" multiple data-placeholder="RHx"  >
                          @foreach($reproductivehx as $reproductivehx)
                        <option  value="{{ $reproductivehx->type }}">{{ $reproductivehx->type }}</option>
                          @endforeach
                            </select>    
                          </div>


                           <div class="col-sm-3">
                           <label class="badge bg-default"> Allergies</label> 
                        <select name="allergy[]" id="allergy" style="width:100%" multiple data-placeholder="Allergy"  >
                          @foreach($allergichx as $allergichx)
                        <option  value="{{ $allergichx->type }}">{{ $allergichx->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>

                      </div>
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
                     
                         
                        </div>
                      </div>
                    </div>
                      
                     {{-- <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                         5. Review of Systems (ROS)
                        </a>
                      </div>
                      <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body text-sm">

                         <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                             <label class="badge bg-info">Constitutional</label> 
                        <select name="ros_constitutional[]" id="ros_constitutional" style="width:100%" multiple data-placeholder="General"  >
                          @foreach($ros_constitutional as $ros_constitutional)
                        <option  value="{{ $ros_constitutional->type }}">{{ $ros_constitutional->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          <div class="col-sm-3">
                              <label class="badge bg-info">Skin</label> 
                        <select name="ros_skin[]" id="ros_skin" style="width:100%" multiple data-placeholder="Skin"  >
                          @foreach($ros_skin as $ros_skin)
                        <option  value="{{ $ros_skin->type }}">{{ $ros_skin->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          <div class="col-sm-3">
                              <label class="badge bg-info">Head</label> 
                        <select name="ros_head[]" id="ros_head" style="width:100%" multiple data-placeholder="Head"  >
                          @foreach($ros_head as $ros_head)
                        <option  value="{{ $ros_head->type }}">{{ $ros_head->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>

                           <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                             <label class="badge bg-primary">Eyes</label> 
                        <select name="ros_eyes[]" id="ros_eyes" style="width:100%" multiple data-placeholder="Eyes"  >
                          @foreach($ros_eyes as $ros_eyes)
                        <option  value="{{ $ros_eyes->type }}">{{ $ros_eyes->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          <div class="col-sm-3">
                             <label class="badge bg-primary">Ears</label> 
                        <select name="ros_ears[]" id="ros_ears" style="width:100%" multiple data-placeholder="Ears"  >
                          @foreach($ros_ears as $ros_ears)
                        <option  value="{{ $ros_ears->type }}">{{ $ros_ears->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                            <div class="col-sm-3">
                             <label class="badge bg-primary">Nose</label> 
                        <select name="ros_nose[]" id="ros_nose" style="width:100%" multiple data-placeholder="Nose"  >
                          @foreach($ros_nose as $ros_nose)
                        <option  value="{{ $ros_nose->type }}">{{ $ros_nose->type }}</option>
                          @endforeach
                            </select>    
                          </div>

                          <div class="col-sm-3">
                              <label class="badge bg-primary">Throat</label> 
                        <select name="ros_throat[]" id="ros_throat" style="width:100%" multiple data-placeholder="Throat"  >
                          @foreach($ros_throat as $ros_throat)
                        <option  value="{{ $ros_throat->type }}">{{ $ros_throat->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>

                             <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                             <label class="badge bg-warning">Respiratory</label> 
                        <select name="ros_respiratory[]" id="ros_respiratory" style="width:100%" multiple data-placeholder="Respiratory"  >
                          @foreach($ros_respiratory as $ros_respiratory)
                        <option  value="{{ $ros_respiratory->type }}">{{ $ros_respiratory->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          <div class="col-sm-3">
                             <label class="badge bg-warning">Cardiovascular</label> 
                        <select name="ros_cardiovasular[]" id="ros_cardiovasular" style="width:100%" multiple data-placeholder="Cardio"  >
                          @foreach($ros_cardiovasular as $ros_cardiovasular)
                        <option  value="{{ $ros_cardiovasular->type }}">{{ $ros_cardiovasular->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                            <div class="col-sm-3">
                             <label class="badge bg-warning">Gastrointestinal</label> 
                        <select name="ros_gastro[]" id="ros_gastro" style="width:100%" multiple data-placeholder="Gastro"  >
                          @foreach($ros_gastro as $ros_gastro)
                        <option  value="{{ $ros_gastro->type }}">{{ $ros_gastro->type }}</option>
                          @endforeach
                            </select>    
                          </div>

                          <div class="col-sm-3">
                              <label class="badge bg-warning">Gynecologic</label> 
                        <select name="ros_gynecology[]" id="ros_gynecology" style="width:100%" multiple data-placeholder="Gynea"  >
                          @foreach($ros_gynecology as $ros_gynecology)
                        <option  value="{{ $ros_gynecology->type }}">{{ $ros_gynecology->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>


                             <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                             <label class="badge bg-default">Genitourinary</label> 
                        <select name="ros_genitourinary[]" id="ros_genitourinary" style="width:100%" multiple data-placeholder="Genitour"  >
                          @foreach($ros_genitourinary as $ros_genitourinary)
                        <option  value="{{ $ros_genitourinary->type }}">{{ $ros_genitourinary->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          <div class="col-sm-3">
                             <label class="badge bg-default">Endocrine</label> 
                        <select name="ros_endocrine[]" id="ros_endocrine" style="width:100%" multiple data-placeholder="Endocrine"  >
                          @foreach($ros_endocrine as $ros_endocrine)
                        <option  value="{{ $ros_endocrine->type }}">{{ $ros_endocrine->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                            <div class="col-sm-3">
                             <label class="badge bg-default">Musculoskeletal</label> 
                        <select name="ros_musculoskeletal[]" id="ros_musculoskeletal" style="width:100%" multiple data-placeholder="Muscu"  >
                          @foreach($ros_musculoskeletal as $ros_musculoskeletal)
                        <option  value="{{ $ros_musculoskeletal->type }}">{{ $ros_musculoskeletal->type }}</option>
                          @endforeach
                            </select>    
                          </div>

                          <div class="col-sm-3">
                              <label class="badge bg-default">Peripheral Vascular</label> 
                        <select name="ros_peripheral_vascular[]" id="ros_peripheral_vascular" style="width:100%" multiple data-placeholder="Vascular"  >
                          @foreach($ros_peripheral_vascular as $ros_peripheral_vascular)
                        <option  value="{{ $ros_peripheral_vascular->type }}">{{ $ros_peripheral_vascular->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>


                           <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                             <label class="badge bg-danger">Hematology</label> 
                        <select name="ros_hematology[]" id="ros_hematology" style="width:100%" multiple data-placeholder="Hematology"  >
                          @foreach($ros_hematology as $ros_hematology)
                        <option  value="{{ $ros_hematology->type }}">{{ $ros_hematology->type }}</option>
                          @endforeach
                            </select>    
                          </div>

                          <div class="col-sm-3">
                             <label class="badge bg-danger">Neuropsychiatric</label> 
                        <select name="ros_neuropsychiatric[]" id="ros_neuropsychiatric" style="width:100%" multiple data-placeholder="Neuro"  >
                          @foreach($ros_neuropsychiatric as $ros_neuropsychiatric)
                        <option  value="{{ $ros_neuropsychiatric->type }}">{{ $ros_neuropsychiatric->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>
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
                        </div>


                      </div>
                    </div> --}}


                    

                    

                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
                         3. Vitals
                        </a>
                      </div>
                      <div id="collapseFive" class="panel-collapse collapse">
                   
                        <div class="tab-pane active" id="review-vitals">

                          <section class="panel panel-default">
                          <img src="/images/139328.svg" width="7%" align="right"> 
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
                            <input type="text" class="form-control" class="text-success" id="height"  value="{{ Request::old('height') ?: '' }}"  name="height">
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
                            <input type="text" class="form-control" id="waist_circumference"  value="{{ Request::old('waist_circumference') ?: '' }}"  name="waist_circumference">
                           @if ($errors->has('waist_circumference'))
                          <span class="help-block">{{ $errors->first('waist_circumference') }}</span>
                           @endif    
                          </div> 

                             <div class="col-sm-3">
                            <label>Hip Circumference</label> 
                            <input type="text" class="form-control" id="hip_circumference"  value="{{ Request::old('hip_circumference') ?: '' }}"  name="hip_circumference">
                          @if ($errors->has('hip_circumference'))
                          <span class="help-block">{{ $errors->first('hip_circumference') }}</span>
                           @endif   
                          </div>

                        </div>






                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-3">
                            <label>Frame</label> 
                          <input type="text" class="form-control" id="frame"  value="{{ Request::old('frame') ?: '' }}"  name="frame">
                          @if ($errors->has('frame'))
                          <span class="help-block">{{ $errors->first('frame') }}</span>
                           @endif   
                          </div>

                           <div class="col-sm-3">
                            <label>Wrist Circumference</label> 
                          <input type="text" class="form-control" id="wrist_circumference"  value="{{ Request::old('wrist_circumference') ?: '' }}"  name="wrist_circumference">
                           @if ($errors->has('wrist_circumference'))
                          <span class="help-block">{{ $errors->first('wrist_circumference') }}</span>
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

                        </div>

                         <div class="form-group pull-in clearfix">
                     
                        
                        </div> 

                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Remarks</label> 
                          <select name="vital_remark[]" id="vital_remark" style="width:100%" multiple data-placeholder=""  >
                        
                        <option  value=""></option>
                         
                            </select>    
                          @if ($errors->has('vital_remark'))
                          <span class="help-block">{{ $errors->first('vital_remark') }}</span>
                           @endif   
                          </div>

                           
                        </div>


                      <img src="">
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addVitals()" class="btn btn-success btn-s-xs">Add New</button>
                      </footer>
                    </section>
                    
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
                               <th>Waist Cir / cm </th>
                               <th>Hip Cir (/ cm)</th>
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
                    <br>
                <br>
                <br>
                <br>
                      </div>
                    </div>


                  {{--    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseSix">
                         7. Physical Examination
                        </a>
                      </div>
                      <div id="collapseSix" class="panel-collapse collapse">
                        <div class="panel-body text-sm">

                         <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                             <label class="badge bg-info">General</label> 
                        <select name="pe_general[]" id="pe_general" style="width:100%" multiple data-placeholder="General"  >
                          @foreach($pe_constitutional as $pe_constitutional)
                        <option  value="{{ $pe_constitutional->type }}">{{ $pe_constitutional->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                          <div class="col-sm-3">
                              <label class="badge bg-info">HEENT</label> 
                        <select name="pe_HEENT[]" id="pe_HEENT" style="width:100%" multiple data-placeholder="HEENT"  >
                         @foreach($pe_HEENT as $pe_HEENT)
                        <option  value="{{ $pe_HEENT->type }}">{{ $pe_HEENT->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                          <div class="col-sm-3">
                              <label class="badge bg-info">Neck</label> 
                        <select name="pe_neck[]" id="pe_neck" style="width:100%" multiple data-placeholder="Neck"  >
                          @foreach($pe_neck as $pe_neck)
                        <option  value="{{ $pe_neck->type }}">{{ $pe_neck->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                          </div>

                           <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                             <label class="badge bg-primary">Lungs</label> 
                        <select name="pe_respiratory[]" id="pe_respiratory" style="width:100%" multiple data-placeholder="Lungs"  >
                          @foreach($pe_respiratory as $pe_respiratory)
                        <option  value="{{ $pe_respiratory->type }}">{{ $pe_respiratory->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                          <div class="col-sm-3">
                             <label class="badge bg-primary">Heart</label> 
                        <select name="pe_heart[]" id="pe_heart" style="width:100%" multiple data-placeholder="Heart"  >
                          @foreach($pe_heart as $pe_heart)
                        <option  value="{{ $pe_heart->type }}">{{ $pe_heart->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                            <div class="col-sm-3">
                             <label class="badge bg-primary">Abdomen</label> 
                        <select name="pe_abdominal[]" id="pe_abdominal" style="width:100%" multiple data-placeholder="Abdomen"  >
                          @foreach($pe_abdominal as $pe_abdominal)
                        <option  value="{{ $pe_abdominal->type }}">{{ $pe_abdominal->type }}</option>
                          @endforeach 
                            </select>    
                          </div>

                          <div class="col-sm-3">
                              <label class="badge bg-primary">Extremities</label> 
                        <select name="pe_extremities[]" id="pe_extremities" style="width:100%" multiple data-placeholder="Extremities"  >
                         @foreach($pe_extremities as $pe_extremities)
                        <option  value="{{ $pe_extremities->type }}">{{ $pe_extremities->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                          </div>

                             <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                             <label class="badge bg-warning">CNS</label> 
                        <select name="pe_cns[]" id="pe_cns" style="width:100%" multiple data-placeholder="CNS"  >
                          @foreach($pe_neuropsychiatric as $pe_neuropsychiatric)
                        <option  value="{{ $pe_neuropsychiatric->type }}">{{ $pe_neuropsychiatric->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                          <div class="col-sm-3">
                             <label class="badge bg-warning">Musculoskeletal</label> 
                        <select name="pe_musculoskeletal[]" id="pe_musculoskeletal" style="width:100%" multiple data-placeholder="Musculoskeletal"  >
                          @foreach($pe_musculoskeletal as $pe_musculoskeletal)
                        <option  value="{{ $pe_musculoskeletal->type }}">{{ $pe_musculoskeletal->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                            <div class="col-sm-3">
                             <label class="badge bg-warning">Psychological</label> 
                        <select name="pe_psychological[]" id="pe_psychological" style="width:100%" multiple data-placeholder="Psychological"  >
                          @foreach($pe_psychological as $pe_psychological)
                        <option  value="{{ $pe_psychological->type }}">{{ $pe_psychological->type }}</option>
                          @endforeach 
                            </select>    
                          </div>

                        
                          </div> --}}


           {{--                 


                          
                        </div> 
                      </div>
                    </div> --}}
                      {{--  <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseSeven">
                         8. Drawings
                        </a>
                      </div>
                      <div id="collapseSeven" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                          <a href="/images/dermatomes.jpg">
                        <img src="/images/dermatomes.jpg" >
                        </a>
                        </div>
                      </div>
                    </div>
              --}}
                  <!-- / .accordion -->
                          


                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addNote()" class="btn btn-success btn-s-xs">Save Note</button>
                      </footer>
                    </section>


                        

                  </div>
 
 

                   


                  <div class="tab-pane" id="review-medication">
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
                        <button type="button" onclick="addDrug()" class="btn btn-success btn-s-xs">Add Medication</button>
                      </footer>
                    </section>
                       <img src="/images/139202.svg" width="10%" align="right"> 
                      
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
                        <button type="button" onclick="addProcedure()" class="btn btn-success btn-s-xs">Add Procedure</button>
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
                            <label class="badge bg-default">Nutritional Intervention</label> 
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
                        <button type="button" onclick="addAssessment()" class="btn btn-success btn-s-xs">Add Plan</button>
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

                  <div class="tab-pane" id="review-plan">
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
                        <button type="button" onclick="addPlan()" class="btn btn-success btn-s-xs">Add Plan</button>
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
                  </div>

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
          "wrist_circumference":  $('#wrist_circumference').val(),
           "whr": $('#whr').val(),
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

            
                $('#drug_dosage').val(json['drug_dosage']);
                $('#drug_form').val(json['drug_form']);
                $('#drug_pack_size').val(json['drug_pack_size']);
                $('#drug_generic').val(json['drug_generic']);
                $('#drug_quantity').val("");

                getDrugAvailable();
                
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
          sweetAlert("Drug failed to be added!");
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
            $('#drugTable tbody').append('<tr><td>'+ value['drug_quantity'] +'</td><td>'+ value['drug_name'] +'</td><td>'+ value['drug_application'] +'</td><td>'+ value['drug_cost'] +'</td><td>'+ value['drug_cost']*value['drug_quantity'] +'</td><td><a a href="#" class="btn btn-sm btn-danger btn-rounded">'+ value['status'] +'</a></td><td><a a href="#"><i onclick="removeMedication('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
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
         
        
        $.get('/patient-vitals-all',
          {
            "patient_id": $('#patient_id').val()
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
           $('#investigationsTable tbody').append('<tr><td>'+ value['investigation'] +'</td><td>'+ value['cost'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['status'] +'</td><td>' + ( value['type'] == "Laboratory" ? '<a a href="/test-collection-slip/'+value['visitid']+'">' : '<a a href="/image-request-slip/'+value['visitid']+'">' ) + '<i onclick="" class="fa fa-print"></i></a></td><td>' + ( value['type'] == "Laboratory" ? '<a a href="/laboratory-results/'+value['visitid']+'">' : '<a a href="/upload-scan/'+value['visitid']+'">' ) + '<i onclick="" class="fa fa-eye"></i></a></td><td><a a href="#"><i onclick="removeinvestigation('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
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
            $('#diagnosisTable tbody').append('<tr><td>'+ value['diagnosis'] +'</td><td>'+ value['date'] +'</td><td><a a href="#"><i onclick="removediagnosis('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
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

       <div class="modal fade" id="appointment-request" size="600px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">New Appointment</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" action="/create-event" class="panel-body wrapper-lg">
                          @include('event/create')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                      </div>
                    </section>
                  </section>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


  <div class="modal fade" id="letter-request" size="600px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Correspondence Letter</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" action="/create-event" class="panel-body wrapper-lg">
{{--                           @include('event/create')
 --}}                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                      </div>
                    </section>
                  </section>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


  <div class="modal fade" id="new-diagnosis" style="height:700px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">ICD 10 - Add Diagnosis</h4>
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


<div class="modal fade" id="internal-referral" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Internal Referral Registration</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" data-validate="parsley" action="/create-opd-referral" class="panel-body wrapper-lg">
                          @include('opd/referals')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                        </section>
                        </section>
                      </div>
               </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div>




