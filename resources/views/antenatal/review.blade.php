@role(['System Admin','Doctor'])
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
                     
                          
                          <img src="/images/387614.svg" width="100%"> 
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>


                
                <aside class="bg-white">
                  <section class="vbox">

                  <header class="header bg-white b-b b-light">
              
                  @if($visit_details->status!='Discharged')
                 <a href="#" onclick="doDischarge('{{$visit_details->id }}','{{ $visit_details->name }}')"  data-toggle="modal" class="btn btn-sm btn-danger bootstrap-modal-form-open pull-right"> <i class="fa fa-power-off"></i> @if($visit_details->billable=='Inpatient') Discharge from Inpatient @else End Visit @endif </a>
                 @else

                 @endif

                <a href="#new-appointment-request"  data-toggle="modal" class="btn btn-sm btn-info bootstrap-modal-form-open pull-right"> <i class="fa fa-plus"></i> Create a Follow Up Appointment</a>
                
                &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;
                
                @if($visit_details->billable!='Inpatient')
                <a href="#new-admission"  data-toggle="modal" class="btn btn-sm btn-warning bootstrap-modal-form-open pull-right"> <i class="fa fa-plus"></i> Admit Patient </a>
                @else

                @endif


              {{--     <a href="#new-discharge"  data-toggle="modal" class="btn btn-sm btn-warning bootstrap-modal-form-open pull-right"> <i class="fa fa-plus"></i> Discharge Patient </a> --}}
                


                       <p class="block pull-left"><a href="#" class=""></a> <span class="label label-success btn-rounded">{{ $visit_details->status }} </span></p>

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
                    
                     
                          <li class=""><a href="#review-complaint" data-toggle="tab"><i class="fa fa-meh-o text-default"></i> Chart Notes </a></li>

                          <li class=""><a href="#review-antenatal" data-toggle="tab"><i class="fa fa-calendar text-default"></i> Antenatal Attendant Chart </a></li>

                        <li class=""><a href="#review-diagnosis" data-toggle="tab"><i class="fa fa fa-legal (alias) text-default"></i> Provisional Diagnosis / Assesment </a></li> 
                         <li class=""><a href="#review-assessment" data-toggle="tab"><i class="fa fa-puzzle-piece text-default"></i> Plan </a></li>
                         <li class=""><a href="#review-investigation" data-toggle="tab"><i class="fa fa-film text-default"></i> Lab / Investigations </a></li>
                        <li class=""><a href="#review-procedure" data-toggle="tab"><i class="fa fa-gears (alias) text-default"></i> Procedures </a></li>
                        <li class=""><a href="#review-medication" data-toggle="tab"><i class="fa fa-flask text-default"></i> Medication </a></li>
                        
                         <li class=""><a href="#review-documents" data-toggle="tab"><i class="fa fa-folder text-default"></i> Documents </a></li> 
                         <li class=""><a href="#review-summary" data-toggle="tab"><i class="fa  fa-code-fork text-default"></i> Notes Summary </a></li> 
                         <li class=""><a href="#history-summary" data-toggle="tab"><i class="fa fa-archive text-default"></i> Notes History (Old Visits) </a></li> 
                         <li class=""><a href="#review-referal" data-toggle="tab"><i class="fa fa-briefcase text-default"></i> Referal Note </a></li> 

                         <li class=""><a href="#review-operation" data-toggle="tab"><i class="fa fa-bars text-default"></i> Operation Notes </a></li> 

                         <li class=""><a href="#review-continuation" data-toggle="tab"><i class="fa fa-file text-default"></i> Continuation Note for Ward Review </a></li> 

                          <li class=""><a href="#review-vitals" data-toggle="tab"><i class="fa fa-tint text-default"></i> Intake / Output Chart </a></li>  

                           <li class=""><a href="#nurse-plan" data-toggle="tab"><i class="fa fa-folder-o text-default"></i> Nurse Notes </a></li>  


                         <li class=""><a href="#review-discharge" data-toggle="tab"><i class="fa fa-bars text-default"></i> Visit Summary </a></li>
                         <li class=""><a href="#review-appointment" data-toggle="tab"><i class="fa fa-calendar text-default"></i> Book & View Appointments </a></li>
                         <li class=""><a href="#review-admission" data-toggle="tab"><i class="fa fa-bell-o text-default"></i> Admission / Detentions </a></li>
                      </ul>
                    </header>



                     <div class="panel-body">
                     <div class="tab-content"> 




                        <div class="tab-pane" id="review-investigation">
                          <section class="panel panel-default">
                      <div class="panel-body">
                 
                       <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <select id="investigation" name="investigation" onchange="getDiagnosisState();" rows="3" tabindex="1" data-placeholder="Search investigation ..." style="width:100%">
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
                         @if($visit_details->referal_doctor == Auth::user()->getNameOrUsername())
                        <button type="button" onclick="addInvestigation()" class="btn btn-success btn-s-xs">Add Investigation</button>
                        @else
                        @endif
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


                   <div class="tab-pane" id="nurse-plan">
                         
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Nurse Notes</header>
                                <div class="panel-body">
                                      <div class="panel-body text-sm">
                          <div class="col-sm-12">
                      
                        
                       <textarea id="continuation_sheet_nurse" name="continuation_sheet_nurse"> 
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

                     <div class="tab-pane" id="review-discharge">
                          <section class="panel panel-default">
                      <div class="panel-body">
                 
                

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label class="badge bg-default">Conclusion </label> 
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
                            <label class="badge bg-default">Recommendations </label> 
                            <div class="form-group{{ $errors->has('treament_plan_action') ? ' has-error' : ''}}">
                            <textarea type="text" rows="5" class="form-control" id="treament_plan_action" name="treament_plan_action" value="{{ Request::old('treament_plan') ?: '' }}"></textarea>   
                           @if ($errors->has('treament_plan'))
                          <span class="help-block">{{ $errors->first('treament_plan') }}</span>
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
                      <a href="/consultation/{{$visits->opd_number}}" class="h4">{{$visits->consultation_type}}</a>
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



              <div class="tab-pane" id="review-referal">
                    <section class="panel panel-default portlet-item" style="opacity: 1;">
                <header class="panel-heading">                    
                  <span class="label bg-dark"></span> Referals
                </header>
                <section class="panel-body">
                <div class="col-sm-12">
                        <label class="badge bg-default">Referal note</label> 
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
                        <div id="myreferal" name="myreferal" class="form-control" style="overflow:scroll;height:300px;max-height:300px" contenteditable="true"> @foreach($referals as $note)
                                 <a>{!!$note->content!!}</a>
                               @endforeach</div>


                      </div>
                       <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addPlanReferal()" class="btn btn-success btn-s-xs">Add Referal Plan</button>
                      </footer>
                



                  
                </section>
              </section>
              </div>


                  <div class="tab-pane @if($visit_details->doctor!= Auth::user()->getNameOrUsername()) active @else @endif" id="review-summary">
                    
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
                              <div class="m-t-sm timeline-action">
                               {{--  <span class="h3 pull-left m-r-sm">4:51</span> --}}
                                <a href="/print-visit-summary/{{ $visit_details->opd_number  }}"><button class="btn btn-sm btn-default btn-bg"><i class="fa fa-check"></i> Print this note </button></a>

                                <a href="/print-executive-cover/{{ $visit_details->opd_number  }}"><button class="btn btn-sm btn-default btn-bg"><i class="fa fa-check"></i> Exec Cover Note </button></a>

                                 <a href="/doctor-appointments/{{ $visit_details->referal_doctor}}" class="btn btn-default rounded" data-toggle="modal">Appointment Request</a>

                                   <a href="/print-referal-note/{{ $visit_details->opd_number }}" class="btn btn-default rounded" data-toggle="modal">Print Referral Letter</a>

                                   <a href="/print-excuse-duty/{{ $visit_details->opd_number }}" class="btn btn-default rounded" data-toggle="modal">Print Excuse Duty</a>

                                    <a href="/print-refusal-treatment/{{ $visit_details->opd_number }}" class="btn btn-default rounded" data-toggle="modal">Print Refusal of Treatment</a>
                              </div>
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
                                
                                <ul>
                                @if($myhistories->medical_history == '') @else <li>Past Medical History <label class="badge bg-default"> {{$myhistories->medical_history}}  </label></li> @endif
                                @if($myhistories->family_history == '') @else <li>Family History <label class="badge bg-info"> {{$myhistories->family_history}}  </label></li> @endif
                                @if($myhistories->social_history == '') @else <li> Social History <label class="badge bg-primary"> {{$myhistories->social_history}}  </label></li> @endif
                                 @if($myhistories->drug_history == '') @else <li> Drug History <label class="badge bg-success">Takes {{$myhistories->drug_history}}  </label></li> @endif
                                @if($myhistories->surgical_history == '') @else <li>Surgical History <label class="badge bg-warning"> {{$myhistories->surgical_history}}  </label></li> @endif
                                @if($myhistories->reproductive_history == '') @else <li> Reproductive History <label class="badge bg-danger"> {{$myhistories->reproductive_history}}  </label></li> @endif
                                @if($myhistories->vaccinations_history == '') @else <li>Vacinnations <label class="badge bg-default"> {{$myhistories->vaccinations_history}}  </label></li> @endif
                                @if($myhistories->allergy == '') @else <li> Allergies <label class="badge bg-danger"> {{$myhistories->allergy}}  </label></li> 
                                @endif
                                </ul>
                               
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

                    <div class="tab-pane" id="review-diagnosis">
                          <section class="panel panel-default">
                            <header class="panel-heading font-bold">
                                 <a href="#new-diagnosis" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-danger pull-right">Select from ICD 10 +</span></a>
                                </header>
                      <div class="panel-body">
               
                       <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <select id="diagnosis_type" name="diagnosis_type" rows="3" tabindex="1" data-placeholder="Search diagnosis ..." class="form-control m-b">
                           <option value="">-- Select Diagnosis Type --</option>
                            <option value="Differential Diagnosis">Differential Diagnosis</option>
                             <option value="Provisional Diagnosis">Provisional Diagnosis</option>
                             <option value="Final Diagnosis">Final Diagnosis</option>
                        </select>         
                          </div>
                        </div>


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
                            <textarea type="text" rows="3" class="form-control" id="diagnosis_remark" name="diagnosis_remark" value="{{ Request::old('diagnosis_remark') ?: '' }}"></textarea>   
                           @if ($errors->has('diagnosis_remark'))
                          <span class="help-block">{{ $errors->first('diagnosis_remark') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>
                      </div>
                      <footer class="panel-footer text-right bg-light lter">
                       @if($visit_details->referal_doctor == Auth::user()->getNameOrUsername())
                        <button type="button" onclick="addDiagnosis()" class="btn btn-success btn-s-xs">Add Diagnosis</button>
                        @else
                        @endif
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
                              <th>Type</th>
                              <th>Diagnosis</th>
                              <th> Remark </th>
                              <th> By</th>
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



                                   <div class="tab-pane active" id="review-vitals">
                         
                    <img src="/images/139328.svg" width="7%" align="right"> 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Vital Signs Chart</header>
                                
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

                   <div class="tab-pane @if($visit_details->doctor== Auth::user()->getNameOrUsername()) active @else @endif" id="review-complaint">
                          <section class="panel panel-default">
                      <div class="panel-body">


                       <!-- .accordion -->
                  <div class="panel-group m-b" id="accordion2">
                   

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
                        <select name="complaint[]" id="complaint" style="width:100%" multiple data-placeholder="">

                        <option value="@foreach($mycomplaints as $val) {{ $val->complaint }}@endforeach" selected > @foreach($mycomplaints as $val) {{ $val->complaint }},@endforeach </option>

                          @foreach($complaints as $complaint)
                        <option  value="{{ $complaint->type }}">{{ $complaint->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                          2. History Of The Present Illness (HPI)
                        </a>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                          <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                        <label class="badge bg-default">History of Presenting Complaint (HPI)</label> 
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

                      <div class="panel panel-default">
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
                           <option value="@foreach($mycomplaints as $val) {{ $val->directquestion }}@endforeach" selected > @foreach($mycomplaints as $val) {{ $val->directquestion }}@endforeach
                        </option>
                          @foreach($complaints as $complaint)
                        <option  value="{{ $complaint->type }}">{{ $complaint->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>
                          
                      </div>
                    </div>
                    </div>
                  

                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                         4. Personal , Family , Social History
                        </a>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                        <div class="panel-body">
                        <div class="form-group pull-in clearfix ">
                           <div class="col-sm-3">
                             <label class="badge bg-primary">Past Medical History</label> 
                        <select name="medical_history[]" id="medical_history" style="width:100%" multiple data-placeholder="PMHx"  >

                         <option value="{{ $myhistories->medical_history }}" selected > {{ $myhistories->medical_history }} </option>

                          @foreach($pastmedicalhx as $pastmedicalhx)
                        <option  value="{{ $pastmedicalhx->type }}">{{ $pastmedicalhx->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                           <div class="col-sm-3">
                           <label class="badge bg-warning" data-toggle="tooltip" data-placement="right" title="" data-original-title="Indicate ages and state of health of family members. For deceased family members, note age at the time of death and cause, if known. Specifically mention diabetes, hypetention, coronary artery disease, cancer, arthritis, alcoholism or known genetic illnesses.">Family History</label> 
                        <select name="family_history[]" id="family_history" style="width:100%" multiple data-placeholder="FMHx">

                          <option value="{{ $myhistories->family_history }}" selected > {{ $myhistories->family_history }}</option>
                          
                          @foreach($familyhx as $familyhx)
                        <option  value="{{ $familyhx->type }}">{{ $familyhx->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                           <div class="col-sm-3">
                           <label class="badge bg-success" data-toggle="tooltip" data-placement="right" title="" data-original-title="Born, raised, resides, living situation, relationship, support system, dialy activities, leisure, cultural/spiritual beliefs, alternative health care practises, health habits, tobacco, alcohol, sexual risk.">Phychosocial History</label> 
                        <select name="social_history[]" id="social_history" style="width:100%" multiple data-placeholder="SHx"  >

                        <option value="{{ $myhistories->social_history }}" selected >  {{ $myhistories->social_history }} </option>

                          @foreach($socialhx as $socialhx)
                        <option  value="{{ $socialhx->type }}">{{ $socialhx->type }}</option>
                          @endforeach
                            </select>    
                          </div>

                           <div class="col-sm-3">
                           <label class="badge bg-danger">Vaccinations</label> 
                        <select name="vaccinations_history[]" id="vaccinations_history" style="width:100%" multiple data-placeholder=""  >

                        <option value="{{ $myhistories->vaccinations_history }}" selected > {{ $myhistories->vaccinations_history }} </option>

                          @foreach($vacinnationhx as $vacinnationhx)
                        <option  value="{{ $vacinnationhx->type }}">{{ $vacinnationhx->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>


                        


                            <div class="form-group pull-in clearfix ">
                           <div class="col-sm-3">
                           <label class="badge bg-danger">Past Medications</label> 
                        <select name="drug_history[]" id="drug_history" style="width:100%" multiple data-placeholder="Meds"  >

                        <option value="{{ $myhistories->drug_history }}" selected > {{ $myhistories->drug_history }} </option>

                          @foreach($medicationhx as $medicationhx)
                        <option  value="{{ $medicationhx->type }}">{{ $medicationhx->type }}</option>
                          @endforeach
                            </select>    
                          </div>

                           <div class="col-sm-3">
                           <label class="badge bg-info">Surgical History</label> 
                        <select name="surgical_history[]" id="surgical_history" style="width:100%" multiple data-placeholder="PSHx"  >
                        <option value="{{ $myhistories->surgical_history }}" selected > {{ $myhistories->surgical_history }}</option>

                          @foreach($surgicalhx as $surgicalhx)
                        <option  value="{{ $surgicalhx->type }}">{{ $surgicalhx->type }}</option>
                          @endforeach
                            </select>    
                          </div>

                           <div class="col-sm-3">
                           <label class="badge bg-warning">Reproductive/Prenatal History</label> 
                        <select name="reproductive_history[]" id="reproductive_history" style="width:100%" multiple data-placeholder="RHx"  >
                        <option value="{{ $myhistories->reproductive_history }}" selected > {{ $myhistories->reproductive_history }} </option>

                          @foreach($reproductivehx as $reproductivehx)
                        <option  value="{{ $reproductivehx->type }}">{{ $reproductivehx->type }}</option>
                          @endforeach
                            </select>    
                          </div>


                           <div class="col-sm-3">
                           <label class="badge bg-default"> Allergies</label> 
                        <select name="allergy[]" id="allergy" style="width:100%" multiple data-placeholder="Allergy"  >
                        <option value="{{ $myhistories->allergy }}" selected > {{ $myhistories->allergy }} </option>
                          @foreach($allergichx as $allergichx)
                        <option  value="{{ $allergichx->type }}">{{ $allergichx->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>



                          <div class="form-group pull-in clearfix ">
                           <div class="col-sm-3">
                           <label class="badge bg-danger">Present Medications</label> 
                        <select name="drug_history_recent[]" id="drug_history_recent" style="width:100%" multiple data-placeholder="Meds"  >

                        <option value="{{ $myhistories->drug_history_recent }}" selected > {{ $myhistories->drug_history_recent }} </option>

                         {{--  @foreach($medicationhx as $medicationhx)
                        <option  value="{{ $medicationhx->type }}">{{ $medicationhx->type }}</option>
                          @endforeach --}}
                            </select>    
                          </div>

                          <div class="col-sm-3">
                           <label class="badge bg-danger">G6PD</label> 
                        <select name="g6pd[]" id="g6pd" style="width:100%" multiple data-placeholder=""  >

                        <option value="{{ $myhistories->g6pd }}" selected > {{ $myhistories->g6pd }} </option>

                         {{--  @foreach($medicationhx as $medicationhx)
                        <option  value="{{ $medicationhx->type }}">{{ $medicationhx->type }}</option>
                          @endforeach --}}
                            </select>    
                          </div>


                          <div class="col-sm-3">
                           <label class="badge bg-danger">Blood Group & Type</label> 
                        <select name="blood_group[]" id="blood_group" style="width:100%" multiple data-placeholder=""  >

                        <option value="{{ $myhistories->blood_group }}" selected > {{ $myhistories->blood_group }} </option>

                         {{--  @foreach($medicationhx as $medicationhx)
                        <option  value="{{ $medicationhx->type }}">{{ $medicationhx->type }}</option>
                          @endforeach --}}
                            </select>    
                          </div>



                          </div>


                          <div class="form-group pull-in clearfix ">
                           <div class="col-sm-3">
                           <label class="badge bg-danger">Hospitalization</label> 
                        <select name="hospitalization_history[]" id="hospitalization_history" style="width:100%" multiple data-placeholder="Hsp Hx"  >
                        <option value="{{ $myhistories->hospitalization_history }}" selected > {{ $myhistories->hospitalization_history }}</option>
                         {{--  @foreach($medicationhx as $medicationhx)
                        <option  value="{{ $medicationhx->type }}">{{ $medicationhx->type }}</option>
                          @endforeach --}}
                            </select>    
                          </div>

                        

                           <div class="col-sm-3">
                           <label class="badge bg-warning">Gravida</label> 
                        <select name="gravida[]" id="gravida" style="width:100%" multiple data-placeholder="Gravida"  >
                         <option value="{{ $myhistories->gravida }}" selected >{{ $myhistories->gravida }} </option>
                         {{--  @foreach($reproductivehx as $reproductivehx)
                        <option  value="{{ $reproductivehx->type }}">{{ $reproductivehx->type }}</option>
                          @endforeach --}}
                            </select>    
                          </div>


                           <div class="col-sm-3">
                           <label class="badge bg-default"> Parity </label> 
                        <select name="parity[]" id="parity" style="width:100%" multiple data-placeholder="Para"  >
                         <option value="{{ $myhistories->parity }}" selected > {{ $myhistories->parity }} </option>
                         {{--  @foreach($allergichx as $allergichx)
                        <option  value="{{ $allergichx->type }}">{{ $allergichx->type }}</option>
                          @endforeach --}}
                            </select>    
                          </div>

                            <div class="col-sm-3">
                           <label class="badge bg-default"> Living Children </label> 
                        <select name="living[]" id="living" style="width:100%" multiple data-placeholder="Live"  >
                        <option value="{{ $myhistories->living }}" selected > {{ $myhistories->living }}</option>
                         {{--  @foreach($allergichx as $allergichx)
                        <option  value="{{ $allergichx->type }}">{{ $allergichx->type }}</option>
                          @endforeach --}}
                            </select>    
                          </div>
                          </div>


                          <div class="form-group pull-in clearfix ">
                           <div class="col-sm-3">
                           <label class="badge bg-danger">Developmental </label> 
                        <select name="developmental_history[]" id="developmental_history" style="width:100%" multiple data-placeholder="Dev Hx"  >
                        <option value="{{ $myhistories->developmental_history }}" selected > {{ $myhistories->developmental_history }} </option>
                         {{--  @foreach($medicationhx as $medicationhx)
                        <option  value="{{ $medicationhx->type }}">{{ $medicationhx->type }}</option>
                          @endforeach --}}
                            </select>    
                          </div>

                           <div class="col-sm-3">
                           <label class="badge bg-info">Obstetrics </label> 
                        <select name="obs_history[]" id="obs_history" style="width:100%" multiple data-placeholder="obs Hx"  >
                        <option value="{{ $myhistories->obs_history }}" selected >{{ $myhistories->obs_history }} </option>
                         {{--  @foreach($surgicalhx as $surgicalhx)
                        <option  value="{{ $surgicalhx->type }}">{{ $surgicalhx->type }}</option>
                          @endforeach --}}
                            </select>    
                          </div>

                           <div class="col-sm-3">
                           <label class="badge bg-warning">Gynaecologic</label> 
                        <select name="gynae_history[]" id="gynae_history" style="width:100%" multiple data-placeholder="Gynae Hx"  >
                         <option value="{{ $myhistories->gynae_history }}" selected > {{ $myhistories->gynae_history }} </option>
                         {{--  @foreach($reproductivehx as $reproductivehx)
                        <option  value="{{ $reproductivehx->type }}">{{ $reproductivehx->type }}</option>
                          @endforeach --}}
                            </select>    
                          </div>
                          </div>


                      </div>
    
                         
                        </div>
                      </div>
                    </div>
                      
                     <div class="panel panel-default">
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
                         <option value="@foreach($myros as $val) {{ $val->general }}@endforeach" selected > @foreach($myros as $val) {{ $val->general }}@endforeach </option>

                          @foreach($ros_constitutional as $ros_constitutional)
                        <option  value="{{ $ros_constitutional->type }}">{{ $ros_constitutional->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          <div class="col-sm-3">
                              <label class="badge bg-info">Skin</label> 
                        <select name="ros_skin[]" id="ros_skin" style="width:100%" multiple data-placeholder="Skin"  >
                         <option value="@foreach($myros as $val) {{ $val->skin }}@endforeach" selected > @foreach($myros as $val) {{ $val->skin }}@endforeach </option>
                          @foreach($ros_skin as $ros_skin)
                        <option  value="{{ $ros_skin->type }}">{{ $ros_skin->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          <div class="col-sm-3">
                              <label class="badge bg-info">Head</label> 
                        <select name="ros_head[]" id="ros_head" style="width:100%" multiple data-placeholder="Head"  >
                         <option value="@foreach($myros as $val) {{ $val->head }}@endforeach" selected > @foreach($myros as $val) {{ $val->head }}@endforeach </option>
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
                        <option value="@foreach($myros as $val) {{ $val->eyes }}@endforeach" selected > @foreach($myros as $val) {{ $val->eyes }}@endforeach </option>
                          @foreach($ros_eyes as $ros_eyes)
                        <option  value="{{ $ros_eyes->type }}">{{ $ros_eyes->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          <div class="col-sm-3">
                             <label class="badge bg-primary">Ears</label> 
                        <select name="ros_ears[]" id="ros_ears" style="width:100%" multiple data-placeholder="Ears"  >
                         <option value="@foreach($myros as $val) {{ $val->ears }}@endforeach" selected > @foreach($myros as $val) {{ $val->ears }}@endforeach </option>
                          @foreach($ros_ears as $ros_ears)
                        <option  value="{{ $ros_ears->type }}">{{ $ros_ears->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                            <div class="col-sm-3">
                             <label class="badge bg-primary">Nose</label> 
                        <select name="ros_nose[]" id="ros_nose" style="width:100%" multiple data-placeholder="Nose"  >
                        <option value="@foreach($myros as $val) {{ $val->nose }}@endforeach" selected > @foreach($myros as $val) {{ $val->nose }}@endforeach </option>
                          @foreach($ros_nose as $ros_nose)
                        <option  value="{{ $ros_nose->type }}">{{ $ros_nose->type }}</option>
                          @endforeach
                            </select>    
                          </div>

                          <div class="col-sm-3">
                              <label class="badge bg-primary">Throat</label> 
                        <select name="ros_throat[]" id="ros_throat" style="width:100%" multiple data-placeholder="Throat"  >
                         <option value="@foreach($myros as $val) {{ $val->throat }}@endforeach" selected > @foreach($myros as $val) {{ $val->throat }}@endforeach </option>
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
                        <option value="@foreach($myros as $val) {{ $val->respiratory }}@endforeach" selected > @foreach($myros as $val) {{ $val->respiratory }}@endforeach </option>
                          @foreach($ros_respiratory as $ros_respiratory)
                        <option  value="{{ $ros_respiratory->type }}">{{ $ros_respiratory->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          <div class="col-sm-3">
                             <label class="badge bg-warning">Cardiovascular</label> 
                        <select name="ros_cardiovasular[]" id="ros_cardiovasular" style="width:100%" multiple data-placeholder="Cardio"  >
                        <option value="@foreach($myros as $val) {{ $val->cardiovascular }}@endforeach" selected > @foreach($myros as $val) {{ $val->cardiovascular }}@endforeach </option>
                          @foreach($ros_cardiovasular as $ros_cardiovasular)
                        <option  value="{{ $ros_cardiovasular->type }}">{{ $ros_cardiovasular->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                            <div class="col-sm-3">
                             <label class="badge bg-warning">Gastrointestinal</label> 
                        <select name="ros_gastro[]" id="ros_gastro" style="width:100%" multiple data-placeholder="Gastro"  >
                         <option value="@foreach($myros as $val) {{ $val->gastrointestinal }}@endforeach" selected > @foreach($myros as $val) {{ $val->gastrointestinal }}@endforeach </option>
                          @foreach($ros_gastro as $ros_gastro)
                        <option  value="{{ $ros_gastro->type }}">{{ $ros_gastro->type }}</option>
                          @endforeach
                            </select>    
                          </div>

                          <div class="col-sm-3">
                              <label class="badge bg-warning">Gynecologic</label> 
                        <select name="ros_gynecology[]" id="ros_gynecology" style="width:100%" multiple data-placeholder="Gynea"  >
                        <option value="@foreach($myros as $val) {{ $val->gynecologic }}@endforeach" selected > @foreach($myros as $val) {{ $val->gynecologic }}@endforeach </option>
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
                        <option value="@foreach($myros as $val) {{ $val->genitourinary }}@endforeach" selected > @foreach($myros as $val) {{ $val->genitourinary }}@endforeach </option>
                          @foreach($ros_genitourinary as $ros_genitourinary)
                        <option  value="{{ $ros_genitourinary->type }}">{{ $ros_genitourinary->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          <div class="col-sm-3">
                             <label class="badge bg-default">Endocrine</label> 
                        <select name="ros_endocrine[]" id="ros_endocrine" style="width:100%" multiple data-placeholder="Endocrine"  >
                        <option value="@foreach($myros as $val) {{ $val->endocrine }}@endforeach" selected > @foreach($myros as $val) {{ $val->endocrine }}@endforeach </option>
                          @foreach($ros_endocrine as $ros_endocrine)
                        <option  value="{{ $ros_endocrine->type }}">{{ $ros_endocrine->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                            <div class="col-sm-3">
                             <label class="badge bg-default">Musculoskeletal</label> 
                        <select name="ros_musculoskeletal[]" id="ros_musculoskeletal" style="width:100%" multiple data-placeholder="Muscu"  >
                        <option value="@foreach($myros as $val) {{ $val->musculoskeletal }}@endforeach" selected > @foreach($myros as $val) {{ $val->musculoskeletal }}@endforeach </option>
                          @foreach($ros_musculoskeletal as $ros_musculoskeletal)
                        <option  value="{{ $ros_musculoskeletal->type }}">{{ $ros_musculoskeletal->type }}</option>
                          @endforeach
                            </select>    
                          </div>

                          <div class="col-sm-3">
                              <label class="badge bg-default">Peripheral Vascular</label> 
                        <select name="ros_peripheral_vascular[]" id="ros_peripheral_vascular" style="width:100%" multiple data-placeholder="Vascular"  >
                        <option value="@foreach($myros as $val) {{ $val->peripheral_vascular }}@endforeach" selected > @foreach($myros as $val) {{ $val->peripheral_vascular }}@endforeach </option>
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
                        <option value="@foreach($myros as $val) {{ $val->hematology }}@endforeach" selected > @foreach($myros as $val) {{ $val->hematology }}@endforeach </option>
                          @foreach($ros_hematology as $ros_hematology)
                        <option  value="{{ $ros_hematology->type }}">{{ $ros_hematology->type }}</option>
                          @endforeach
                            </select>    
                          </div>

                          <div class="col-sm-3">
                             <label class="badge bg-danger">Neuropsychiatric</label> 
                        <select name="ros_neuropsychiatric[]" id="ros_neuropsychiatric" style="width:100%" multiple data-placeholder="Neuro"  >
                        <option value="@foreach($myros as $val) {{ $val->neuro }}@endforeach" selected > @foreach($myros as $val) {{ $val->neuro }}@endforeach </option>
                          @foreach($ros_neuropsychiatric as $ros_neuropsychiatric)
                        <option  value="{{ $ros_neuropsychiatric->type }}">{{ $ros_neuropsychiatric->type }}</option>
                          @endforeach
                            </select>    
                          </div>
                          </div>
                          
                        </div>


                      </div>
                    </div>


                    

                    

                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
                         6. Vitals
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
                       @if($visit_details->referal_doctor == Auth::user()->getNameOrUsername())
                        <button type="button" onclick="addVitals()" class="btn btn-success btn-s-xs">Add New</button>
                        @else
                        @endif
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


                     <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseSix">
                         7. Physical Examination
                        </a>
                      </div>
                      <div id="collapseSix" class="panel-collapse collapse">
                        <div class="panel-body text-sm">

                         <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                             <label class="badge bg-info" data-toggle="tooltip" data-placement="right" title="" data-original-title="General statement about overall health status of the patient and general apperance">General</label> 
                        <select name="pe_general[]" id="pe_general" style="width:100%" multiple data-placeholder="General"  >
                         <option value="@foreach($mype as $val) {{ $val->pe_general }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_general }}@endforeach </option>
                          @foreach($pe_constitutional as $pe_constitutional)
                        <option  value="{{ $pe_constitutional->type }}">{{ $pe_constitutional->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                          <div class="col-sm-3">
                              <label class="badge bg-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Facial Symmetry, involuntary movement, color of hair, hair texture, distribution, eye acuity, visual fields, eyebrows, eyelids, scelera, extraocular movements, outer ear, ear canals, typanic membranes, outer nose, nsal mucosa, nasal septum.">HEENT</label> 
                        <select name="pe_HEENT[]" id="pe_HEENT" style="width:100%" multiple data-placeholder="HEENT"  >
                        <option value="@foreach($mype as $val) {{ $val->pe_HEENT }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_HEENT }}@endforeach </option>
                         @foreach($pe_HEENT as $pe_HEENT)
                        <option  value="{{ $pe_HEENT->type }}">{{ $pe_HEENT->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                          <div class="col-sm-3">
                              <label class="badge bg-info">Neck</label> 
                        <select name="pe_neck[]" id="pe_neck" style="width:100%" multiple data-placeholder="Neck"  >
                        <option value="@foreach($mype as $val) {{ $val->pe_neck }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_neck }}@endforeach </option>
                          @foreach($pe_neck as $pe_neck)
                        <option  value="{{ $pe_neck->type }}">{{ $pe_neck->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                          <div class="col-sm-3">
                              <label class="badge bg-info">Skin</label> 
                        <select name="pe_skin[]" id="pe_skin" style="width:100%" multiple data-placeholder="Neck"  >
                        <option value="@foreach($mype as $val) {{ $val->pe_skin }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_skin }}@endforeach </option>
                         
                            </select>    
                          </div>
                          </div>

                           <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                             <label class="badge bg-primary">Lungs</label> 
                        <select name="pe_respiratory[]" id="pe_respiratory" style="width:100%" multiple data-placeholder="Lungs"  >
                        <option value="@foreach($mype as $val) {{ $val->pe_respiratory }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_respiratory }}@endforeach </option>
                          @foreach($pe_respiratory as $pe_respiratory)
                        <option  value="{{ $pe_respiratory->type }}">{{ $pe_respiratory->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                          <div class="col-sm-3">
                             <label class="badge bg-primary">Heart</label> 
                        <select name="pe_heart[]" id="pe_heart" style="width:100%" multiple data-placeholder="Heart"  >
                        <option value="@foreach($mype as $val) {{ $val->pe_heart }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_heart }}@endforeach </option>
                          @foreach($pe_heart as $pe_heart)
                        <option  value="{{ $pe_heart->type }}">{{ $pe_heart->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                            <div class="col-sm-3">
                             <label class="badge bg-primary">Abdomen</label> 
                        <select name="pe_abdominal[]" id="pe_abdominal" style="width:100%" multiple data-placeholder="Abdomen"  >
                        <option value="@foreach($mype as $val) {{ $val->pe_abdominal }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_abdominal }}@endforeach </option>
                          @foreach($pe_abdominal as $pe_abdominal)
                        <option  value="{{ $pe_abdominal->type }}">{{ $pe_abdominal->type }}</option>
                          @endforeach 
                            </select>    
                          </div>

                          <div class="col-sm-3">
                              <label class="badge bg-primary">Extremities</label> 
                        <select name="pe_extremities[]" id="pe_extremities" style="width:100%" multiple data-placeholder="Extremities"  >
                        <option value="@foreach($mype as $val) {{ $val->pe_extremities }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_extremities }}@endforeach </option>
                         @foreach($pe_extremities as $pe_extremities)
                        <option  value="{{ $pe_extremities->type }}">{{ $pe_extremities->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                          </div>

                             <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                             <label class="badge bg-warning" data-toggle="tooltip" data-placement="right" title="" data-original-title="Mental status(describe using SLUMS 0/30) , cranial nerves, motor strength, sensory function (light touch, pinprick, temperature, vibration, joint position sense), coordination (rapid alternative movements, finger to finger, heel to shin), reflexes, Babinski, Clonus, Presence of pronator drift, Gait, Romberg ">CNS</label> 
                        <select name="pe_cns[]" id="pe_cns" style="width:100%" multiple data-placeholder="CNS"  >
                        <option value="@foreach($mype as $val) {{ $val->pe_cns }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_cns }}@endforeach </option>
                          @foreach($pe_neuropsychiatric as $pe_neuropsychiatric)
                        <option  value="{{ $pe_neuropsychiatric->type }}">{{ $pe_neuropsychiatric->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                          <div class="col-sm-3">
                             <label class="badge bg-warning">Musculoskeletal</label> 
                        <select name="pe_musculoskeletal[]" id="pe_musculoskeletal" style="width:100%" multiple data-placeholder="Musculoskeletal"  >
                        <option value="@foreach($mype as $val) {{ $val->pe_musculoskeletal }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_musculoskeletal }}@endforeach </option>
                          @foreach($pe_musculoskeletal as $pe_musculoskeletal)
                        <option  value="{{ $pe_musculoskeletal->type }}">{{ $pe_musculoskeletal->type }}</option>
                          @endforeach 
                            </select>    
                          </div>
                            <div class="col-sm-3">
                             <label class="badge bg-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Affect, Mood, Appearance, Judgement, Mini-Mental State Examination.">Psychological</label> 
                        <select name="pe_psychological[]" id="pe_psychological" style="width:100%" multiple data-placeholder="Psychological"  >
                        <option value="@foreach($mype as $val) {{ $val->pe_psychological }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_psychological }}@endforeach </option>
                          @foreach($pe_psychological as $pe_psychological)
                        <option  value="{{ $pe_psychological->type }}">{{ $pe_psychological->type }}</option>
                          @endforeach 
                            </select>    
                          </div>

                            <div class="col-sm-3">
                             <label class="badge bg-warning">Breast</label> 
                        <select name="pe_breast[]" id="pe_breast" style="width:100%" multiple data-placeholder="Breast"  >
                        <option value="@foreach($mype as $val) {{ $val->pe_breast }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_breast }}@endforeach </option>
                          @foreach($pe_breast as $pe_breast)
                        <option  value="{{ $pe_breast->type }}">{{ $pe_breast->type }}</option>
                          @endforeach 
                            </select>    
                          </div>

                        
                          </div>


                           <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                             <label class="badge bg-warning">Adnexa</label> 
                        <select name="pe_adnexa[]" id="pe_adnexa" style="width:100%" multiple data-placeholder=""  >
                        <option value="@foreach($mype as $val) {{ $val->pe_adnexa }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_adnexa }}@endforeach </option>
                         {{--  @foreach($pe_neuropsychiatric as $pe_neuropsychiatric)
                        <option  value="{{ $pe_neuropsychiatric->type }}">{{ $pe_neuropsychiatric->type }}</option>
                          @endforeach  --}}
                            </select>    
                          </div>
                          <div class="col-sm-3">
                             <label class="badge bg-warning">External Genetalia</label> 
                        <select name="pe_ext_genitalia[]" id="pe_ext_genitalia" style="width:100%" multiple data-placeholder=""  >
                         <option value="@foreach($mype as $val) {{ $val->pe_ext_genitalia }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_ext_genitalia }}@endforeach </option>
                         {{--  @foreach($pe_musculoskeletal as $pe_musculoskeletal)
                        <option  value="{{ $pe_musculoskeletal->type }}">{{ $pe_musculoskeletal->type }}</option>
                          @endforeach  --}}
                            </select>    
                          </div>
                            <div class="col-sm-3">
                             <label class="badge bg-warning">Vulva</label> 
                        <select name="pe_vulva[]" id="pe_vulva" style="width:100%" multiple data-placeholder=""  >
                         <option value="@foreach($mype as $val) {{ $val->pe_vulva }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_vulva }}@endforeach </option>
                         {{--  @foreach($pe_psychological as $pe_psychological)
                        <option  value="{{ $pe_psychological->type }}">{{ $pe_psychological->type }}</option>
                          @endforeach  --}}
                            </select>    
                          </div>

                           <div class="col-sm-3">
                             <label class="badge bg-warning">Vagina</label> 
                        <select name="pe_vagina[]" id="pe_vagina" style="width:100%" multiple data-placeholder=""  >
                         <option value="@foreach($mype as $val) {{ $val->pe_vagina }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_vagina }}@endforeach </option>
                         {{--  @foreach($pe_psychological as $pe_psychological)
                        <option  value="{{ $pe_psychological->type }}">{{ $pe_psychological->type }}</option>
                          @endforeach  --}}
                            </select>    
                          </div>

                        
                          </div>


                      
                      <div class="form-group pull-in clearfix">
                           <div class="col-sm-3">
                             <label class="badge bg-warning">Cervix</label> 
                        <select name="pe_cervix[]" id="pe_cervix" style="width:100%" multiple data-placeholder=""  >
                        <option value="@foreach($mype as $val) {{ $val->pe_cervix }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_cervix }}@endforeach </option>
                         {{--  @foreach($pe_neuropsychiatric as $pe_neuropsychiatric)
                        <option  value="{{ $pe_neuropsychiatric->type }}">{{ $pe_neuropsychiatric->type }}</option>
                          @endforeach  --}}
                            </select>    
                          </div>
                          <div class="col-sm-3">
                             <label class="badge bg-warning">Uterus</label> 
                        <select name="pe_uterus[]" id="pe_uterus" style="width:100%" multiple data-placeholder=""  >
                         <option value="@foreach($mype as $val) {{ $val->pe_uterus }}@endforeach" selected > @foreach($mype as $val) {{ $val->pe_uterus }}@endforeach </option>
                         {{--  @foreach($pe_musculoskeletal as $pe_musculoskeletal)
                        <option  value="{{ $pe_musculoskeletal->type }}">{{ $pe_musculoskeletal->type }}</option>
                          @endforeach  --}}
                            </select>    
                          </div>
                           
                         
                        
                          </div>


                           


                          
                        </div> 
                      </div>
                    </div>
                       <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseSeven">
                         8. Doctor Comments
                        </a>
                      </div>
                      <div id="collapseSeven" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                          <textarea type="text" rows="3" class="form-control" id="perspective_comment_doctor" name="perspective_comment_doctor" value="{{ Request::old('perspective_comment_doctor') ?: '' }}">@foreach($mycomplaints as $complaint)
                                 {!!$complaint->doctors_note!!}
                               @endforeach</textarea>
                        </div>
                      </div>
                    </div>

                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseNine">
                         9. Patient Illness Perspective
                        </a>
                      </div>
                      <div id="collapseNine" class="panel-collapse collapse">
                        <div class="panel-body text-sm">
                          <textarea type="text" rows="3" class="form-control" id="perspective_comment_patient" name="perspective_comment_patient" value="{{ Request::old('perspective_comment_patient') ?: '' }}" > {{ $complaint->patients_note }}</textarea>
                        </div>
                      </div>
                    </div>
             
                  <!-- / .accordion -->
                          
                      @if($visit_details->referal_doctor == Auth::user()->getNameOrUsername())
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addNote()" class="btn btn-success btn-s-xs">Save Note</button>
                      </footer>
                      @else

                    @endif
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
                         <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_form') ? ' has-error' : ''}}">
                            <label>Quantity</label>
                             <input type="number" class="form-control" class="text-success" id="procedure_quantity"  value="{{ Request::old('procedure_quantity') ?: '' }}"  name="procedure_quantity">       
                           @if ($errors->has('procedure_quantity'))
                          <span class="help-block">{{ $errors->first('procedure_quantity') }}</span>
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


                  <div class="tab-pane" id="review-antenatal">
                          <section class="panel panel-default">
                      <div class="panel-body">


                          <div class="form-group pull-in clearfix">
                             <div class="col-sm-3">
                            <label>LMP</label> 
                            <div class="form-group{{ $errors->has('lmp') ? ' has-error' : ''}}">
                             <input type="text" class="form-control" id="lmp"  value=""  name="lmp">
                           @if ($errors->has('edd'))
                          <span class="help-block">{{ $errors->first('edd') }}</span>
                           @endif    
                          </div>
                          </div>


                            <div class="col-sm-3">
                            <label>EDD/EDC</label> 
                            <div class="form-group{{ $errors->has('edd') ? ' has-error' : ''}}">
                             <input type="text" class="form-control" id="edd"  value=""  name="edd">
                           @if ($errors->has('edd'))
                          <span class="help-block">{{ $errors->first('edd') }}</span>
                           @endif    
                          </div>
                          </div>


                          <div class="col-sm-3">
                            <label>Gestational Week</label> 
                            <div class="form-group{{ $errors->has('gestation_by_date') ? ' has-error' : ''}}">
                             <select id="gestation_by_date" name="gestation_by_date" readonly="true" rows="1" tabindex="1" data-placeholder="Select here.." style="width:100%">
                             
                          <option value="">-- Not set --</option>
                          @foreach($gestationperiods as $gestationperiod)
                        <option value="{{ $gestationperiod->week }}">{{ $gestationperiod->week }}</option>
                          @endforeach
                        </select>            
                           @if ($errors->has('gestation_by_date'))
                          <span class="help-block">{{ $errors->first('gestation_by_date') }}</span>
                           @endif    
                          </div>
                          </div>


                          <div class="col-sm-3">
                            <label>Gestational Days</label> 
                            <div class="form-group{{ $errors->has('gestation_by_date_day') ? ' has-error' : ''}}">
                             <select id="gestation_by_date_day" name="gestation_by_date_day" readonly="true" rows="1" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          <option value="">-- Not set --</option>
                          
                        </select>            
                           @if ($errors->has('gestation_by_date_day'))
                          <span class="help-block">{{ $errors->first('gestation_by_date_day') }}</span>
                           @endif    
                          </div>
                          </div>

                          </div>



                          <div class="form-group pull-in clearfix">
  


                           

                          <div class="col-sm-3">
                            <label>Lie</label> 
                            <div class="form-group{{ $errors->has('lie') ? ' has-error' : ''}}">
                             <select id="lie" name="lie[]" rows="1" tabindex="1" multiple data-placeholder="Select here.." style="width:100%">
                          <option value="">-- Not set --</option>
                          @foreach($lie as $lie)
                        <option value="{{ $lie->type }}">{{ $lie->type }}</option>
                          @endforeach
                        </select>            
                           @if ($errors->has('lie'))
                          <span class="help-block">{{ $errors->first('lie') }}</span>
                           @endif    
                          </div>
                          </div>


                              <div class="col-sm-3">
                            <label>Presentation</label> 
                            <div class="form-group{{ $errors->has('presentation') ? ' has-error' : ''}}">
                             <select id="presentation" name="presentation[]" multiple rows="1" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          <option value="">-- Not set --</option>
                          @foreach($presentations as $presentation)
                        <option value="{{ $presentation->type }}">{{ $presentation->type }}</option>
                          @endforeach
                        </select>            
                           @if ($errors->has('presentation'))
                          <span class="help-block">{{ $errors->first('presentation') }}</span>
                           @endif    
                          </div>
                          </div>



                          <div class="col-sm-3">
                            <label>Engagement</label> 
                            <div class="form-group{{ $errors->has('engagement') ? ' has-error' : ''}}">
                             <select id="engagement" name="engagement[]" rows="1" multiple tabindex="1" data-placeholder="Select here.." style="width:100%">
                          <option value="">-- Not set --</option>
                          
                            <option value="Not Engaged">Not Engaged</option>
                            <option value="Fully Engaged">Fully Engaged</option>
                             <option value="Not Applicable">Not Applicable</option>
                        
                        </select>            
                           @if ($errors->has('engagement'))
                          <span class="help-block">{{ $errors->first('engagement') }}</span>
                           @endif    
                          </div>
                          </div>
                          </div>




                         <div class="form-group pull-in clearfix">
                        <div class="col-sm-3">
                            <label>Fundal Height</label> 
                          <input type="text" class="form-control" id="fh_fm"  value="{{ Request::old('fh_fm') ?: '' }}"  name="fh_fm">
                          @if ($errors->has('fh_fm'))
                          <span class="help-block">{{ $errors->first('fh_fm') }}</span>
                           @endif   
                          </div>

                           <div class="col-sm-3">
                            <label>Fetus</label> 
                            <div class="form-group{{ $errors->has('fetus') ? ' has-error' : ''}}">
                             <select id="fetus" name="fetus" rows="1" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value="">-- Not set --</option>
                          @foreach($fetus as $fetus)
                        <option value="{{ $fetus->type }}">{{ $fetus->type }}</option>
                          @endforeach
                        </select>            
                           @if ($errors->has('fetus'))
                          <span class="help-block">{{ $errors->first('fetus') }}</span>
                           @endif    
                          </div>
                          </div>

                          

                           <div class="col-sm-3">
                            <label>Position</label> 
                            <div class="form-group{{ $errors->has('position') ? ' has-error' : ''}}">
                             <select id="position" name="position[]" rows="1" multiple tabindex="1" data-placeholder="Select here.." style="width:100%">
                          <option value="">-- Not set --</option>
                           @foreach($position as $position)
                        <option value="{{ $position->type }}">{{ $position->type }}</option>
                          @endforeach 
                        </select>            
                           @if ($errors->has('position'))
                          <span class="help-block">{{ $errors->first('position') }}</span>
                           @endif    
                          </div>
                          </div>

                           <div class="col-sm-3">
                            <label>Oedema</label> 
                           <select id="oedema" name="oedema" rows="1" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          <option value="">-- Not set --</option>
                            <option value="Negative">Negative</option>
                            <option value="None">None</option>
                             <option value="Puffy">Puffy</option>
                        
                        </select>
                          @if ($errors->has('oedema'))
                          <span class="help-block">{{ $errors->first('oedema') }}</span>
                           @endif   
                          </div>

                        </div>



                          <div class="form-group pull-in clearfix">
                        <div class="col-sm-3">
                            <label>Urine Sugar</label> 
                          <input type="text" class="form-control" id="urine_sugar"  value="{{ Request::old('urine_sugar') ?: '' }}"  name="urine_sugar">
                          @if ($errors->has('urine_sugar'))
                          <span class="help-block">{{ $errors->first('urine_sugar') }}</span>
                           @endif   
                          </div>

                           <div class="col-sm-3">
                            <label>Urine Protein</label> 
                            <div class="form-group{{ $errors->has('urine_protein') ? ' has-error' : ''}}">
                            <input type="text" class="form-control" id="urine_protein"  value="{{ Request::old('urine_protein') ?: '' }}"  name="urine_protein">
                           @if ($errors->has('urine_protein'))
                          <span class="help-block">{{ $errors->first('urine_protein') }}</span>
                           @endif    
                          </div>
                          </div>

                          

                         

                           <div class="col-sm-3">
                            <label>Blood Type</label> 
                      <input type="text" class="form-control" id="bloodtype"  value="{{$defaultbloodgroup}}"  name="bloodtype">
                          @if ($errors->has('bloodtype'))
                          <span class="help-block">{{ $errors->first('bloodtype') }}</span>
                           @endif   
                          </div>
                        </div>


                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-3">
                            <label>G6PD</label> 
                          <input type="text" class="form-control" id="ant_g6pd"  value="{{ $defaultg6pd }}"  name="ant_g6pd">
                          @if ($errors->has('g6pd'))
                          <span class="help-block">{{ $errors->first('g6pd') }}</span>
                           @endif   
                          </div>

                            <div class="col-sm-3">
                            <label>TT</label> 
                      <input type="text" class="form-control" id="tt"  value="{{ Request::old('tt') ?: '' }}"  name="tt">
                          @if ($errors->has('tt'))
                          <span class="help-block">{{ $errors->first('tt') }}</span>
                           @endif   
                          </div>

                          
                           <div class="col-sm-3">
                            <label>SP</label> 
                      <input type="text" class="form-control" id="sp"  value="{{ Request::old('sp') ?: '' }}"  name="sp">
                          @if ($errors->has('sp'))
                          <span class="help-block">{{ $errors->first('sp') }}</span>
                           @endif   
                          </div>

                          <div class="col-sm-3">
                            <label>Fetal Heart Tone</label> 
                      <input type="text" class="form-control" id="fetal_heart_tone"  value="{{ Request::old('fetal_heart_tone') ?: '' }}"  name="fetal_heart_tone">
                          @if ($errors->has('fetal_heart_tone'))
                          <span class="help-block">{{ $errors->first('fetal_heart_tone') }}</span>
                           @endif   
                          </div>

                        </div>

                  

                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                            <label>Remarks (Comment on the size / shape / appearance of the abdomen / Fetal movements / Linea Nigra / Striae Gravidarum)</label> 
                           <textarea type="text" class="form-control" rows="5" id="antenatal_remarks"  value="{{ Request::old('antenatal_remarks') ?: '' }}"  name="antenatal_remarks"></textarea>
                          @if ($errors->has('antenatal_remarks'))
                          <span class="help-block">{{ $errors->first('antenatal_remarks') }}</span>
                           @endif   
                          </div>

                           
                        </div>


                      <img src="">
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                        @if($visit_details->referal_doctor == Auth::user()->getNameOrUsername())
                        <a href="https://reference.medscape.com/drug-interactionchecker" target="_new" class="btn btn-dark btn-s-xs">Drug Interaction Checker</a>
                         <button type="button" onclick="addAntenatal()" class="btn btn-success btn-s-xs">Add Record</button>
                        @else
                        @endif
                       
                      </footer>
                    </section>
                {{--     <img src="/images/361463.svg" width="7%" align="right">  --}}
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Antenatal Attendance Chart</header>
                                <div class="panel-body">
                                      <div class="table-responsive" style="overflow-y: scroll;">
                       <table id="AntenatalTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th>LMP</th>
                              <th>Gest Date</th>
                              <th>EDD/EDC</th>
                              <th>Pos.</th>
                              <th>Pres.</th>
                              <th>Eng.</th>
                              <th>FH</th>
                              <th>Lie</th>
                              <th>Fetus</th>
                              <th>SP</th>
                              <th>FHT</th>
                              <th>Remark</th>
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


                 <div class="tab-pane" id="review-admission">
                  {{-- <form  class="bootstrap-modal-form" method="post" data-validate="parsley" action="/create-ipd-opd" class="panel-body wrapper-lg">
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
                            <label>Admission / Serive Type</label>
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
                            <label>Ward</label>
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
                            <label>Doctor</label>
                            <select id="ipd_referal_doctor" name="ipd_referal_doctor" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%" >
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
                      </div> 
                    </section> 

                     <footer class="panel-footer text-right bg-light lter">
                      <input type="hidden" id="patient_id" name="patient_id" value="{{ $visit_details->patient_id }}">
                        <input type="hidden" id="fullname" name="fullname" value="{{ $visit_details->name }}">
                          <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <button type="submit" class="btn btn-success btn-s-xs">Click to Admit Patient</button>
                        
                      </footer>
                      </form>
 --}}
                  </div>


                    <div class="tab-pane" id="review-assessment">
                         
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Doctor's Plan</header>
                                <div class="panel-body">
                                      <div class="panel-body text-sm">
                          <div class="col-sm-12">
                      
                        
                       <textarea id="assessment" name="assessment"> 
                                 {!!$mydoctorplan->assessment!!}
                               </textarea>
                       
                      </div>
                      </div>

                                </div>
                                </section>

                        <footer class="panel-footer text-right bg-light lter">
                         <button type="button" onclick="addAssessment()" class="btn btn-success btn-s-xs">Save Plan</button>
                         
                      </footer>
                     
                  </div>



                    <div class="tab-pane" id="review-appointment">
                         <section class="hbox stretch">          
            <!-- .aside -->
            <aside>
              <section class="vbox">
                <section class="scrollable wrapper">
                  <section class="panel panel-default">
                    
                    <div class="calendar" id="calendar">

                    </div>
                  </section>
                </section>
              </section>
            </aside>
            <!-- /.aside -->
            <!-- .aside -->
         <aside class="aside-lg b-l">
              <div class="padder">
                <h5>Dragable events</h5>
                <div class="line"></div>


                 <div>
                <a href="#new-appointment-request"  data-toggle="modal" class="btn btn-sm btn-info bootstrap-modal-form-open"> <i class="fa fa-plus"></i> Create An Appointment</a>
                </div>

                {{-- <div class="line"></div>
                 <p class="text-muted">By Consultation </p>
                <div>
                 @foreach($servicetype as $servicetype)
                <a href="/consultation-calendar/{{ 1 }}"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open"> <i class="fa fa-home"></i>  {{ $servicetype->description }} </a>
                @endforeach
                </div> --}}
                <div class="line"></div>
                <div>  
               <input type="hidden" id="doctor" name="doctor" value="{{ $visit_details->referal_doctor }}">
                </div>
                <p class="text-muted">By Doctor </p>
                <div>
                @foreach($doctors as $doctor)
                <a href="/doctor-appointments/{{ $doctor->name }}"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open"> <i class="fa fa-user-md"></i>  {{ $doctor->name }} </a>
                @endforeach
                </div>
              </div>
            </aside>
            <!-- /.aside -->
          </section>
                       
                     
                  </div>


                   <div class="tab-pane" id="review-continuation">
                          <section class="panel panel-default">
                      <div class="panel-body">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label class="badge bg-default">Continuation Sheet / SOAP Notes</label> 
                            <div class="form-group{{ $errors->has('assessment') ? ' has-error' : ''}}">
                            
                       <textarea id="continuation_sheet" name="continuation_sheet">
                                 {!!$continuation->content!!}
                               </textarea> 

                           @if ($errors->has('continuation_sheet'))
                          <span class="help-block">{{ $errors->first('continuation_sheet') }}</span>

                           @endif    
                          </div>
                          </div>
                        </div>

                      </div>
                      <footer class="panel-footer text-right bg-light lter">
                        @if($visit_details->referal_doctor == Auth::user()->getNameOrUsername())
                        <button type="button" onclick="addContinuation()" class="btn btn-success btn-s-xs">Add Note</button>
                        @else
                        @endif
                      </footer>
                    </section>
                  </div>




                   <div class="tab-pane" id="review-operation">
                          <section class="panel panel-default">
                      <div class="panel-body">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label class="badge bg-default"> Operation Notes</label> 
                            <div class="form-group{{ $errors->has('assessment') ? ' has-error' : ''}}">
                            
                       <textarea id="operation_sheet" name="operation_sheet">
                                @if(!$continuationop->content)
                                <p>Operation :</p>
                                <p>Indication :</p>
                                <p>Surgeon :</p>
                                <p>Scrub Nurse :</p>
                                <p>Anaesthesia Type/ Anaesthetist :</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p><strong>Findings</strong> :</p>
                                <table style="border-collapse: collapse; width: 100%;" border="1">
                                <tbody>
                                <tr>
                                <td style="width: 100%;">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                </td>
                                </tr>
                                </tbody>
                                </table>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p><strong>Procedure(s) :</strong></p>
                                <table style="border-collapse: collapse; width: 100%;" border="1">
                                <tbody>
                                <tr>
                                <td style="width: 100%;">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                </td>
                                </tr>
                                </tbody>
                                </table>
                                <p><strong>Post Op Plan :</strong></p>
                                <table style="border-collapse: collapse; width: 100%;" border="1">
                                <tbody>
                                <tr>
                                <td style="width: 100%;">
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                </td>
                                </tr>
                                </tbody>
                                </table>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                @else
                                 {!!$continuationop->content!!}
                                @endif
                               </textarea> 

                           @if ($errors->has('continuation_sheet'))
                          <span class="help-block">{{ $errors->first('continuation_sheet') }}</span>

                           @endif    
                          </div>
                          </div>
                        </div>

                      </div>
                      <footer class="panel-footer text-right bg-light lter">
                        @if($visit_details->referal_doctor == Auth::user()->getNameOrUsername())
                        <button type="button" onclick="addContinuationOP()" class="btn btn-success btn-s-xs">Add Note</button>
                        @else
                        @endif
                      </footer>
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
                      </div>
                    </section>
               
                </aside>


    
                    </section>
                    </section>
                    </section>



  @stop


   <script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {

    var base_url = '{{ url('/') }}';
     var doctor = $('#doctor').val();

   $('#calendar').fullCalendar({
      weekends: true,
      slotMinutes: 15,
      theme: false,
      header: false,
      minTime: 7,
      maxTime: 20,
      height: 800,
      slotEventOverlap: true,

      header: {
        left: 'prev,next today,prevYear,nextYear',
        center: 'title',
        right: 'listDay,month,agendaWeek,agendaDay'
      },
      //weekends : false,
     defaultView: 'agendaDay',
      weekNumberTitle : "Week",
      allDayDefault: false,
      weekNumbers : true,
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      events: {
         url: '/doctor-calendar/'+doctor+'' ,
        error: function() {
          alert("cannot load json");
        }
      }
    });


    $('#new-appointment-request select[name="title"]').select2();
  $('#new-appointment-request select[name="name"]').select2();
  $('#new-appointment-request select[name="referal_doctor"]').select2();

  });
</script>

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
  selector: '#continuation_sheet',
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
  selector: '#operation_sheet',
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
  selector: '#continuation_sheet_nurse',
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





 <script type="text/javascript">
        $(window).on("beforeunload", function() {
          //swal ("Are you sure? You didn't finish the form!");
            return "Are you sure? You didn't finish the form!";

        });
        
        $(document).ready(function() {
            $("#masterform").on("submit", function(e) {
                //check form to make sure it is kosher
                //remove the ev
                $(window).off("beforeunload");
                return true;
            });
        });
</script> 


<script type="text/javascript">
$(function () {
  $('#new-appointment-request input[name="time"]').daterangepicker({
     "daysOfWeek": ['Mo', 'Tu', 'We', 'Th', 'Fr'],
    "singleDatePicker":true,
    "autoApply": true,
    "showISOWeekNumbers": true,
    "showDropdowns": true,
    "timePicker": true,
    "timePicker24Hour": true,
    "timePickerIncrement": 15,
    "locale": {
     "format": "DD/MM/YYYY HH:mm:ss",
      "separator": " - ",
    }
  });
});
</script>


<script type="text/javascript">
$(function () {
   $('#lmp').daterangepicker({
    "minDate": moment('2016-06-14 0'),
     "singleDatePicker":true,
    "timePicker": false,
    "timePicker24Hour": true,
    "timePickerIncrement": 15,
    "autoApply": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>

<script type="text/javascript">
$(function () {
   $('#edd').daterangepicker({
    "minDate": moment('2016-06-14 0'),
     "singleDatePicker":true,
    "timePicker": false,
    "timePicker24Hour": true,
    "timePickerIncrement": 15,
    "autoApply": true,
    "locale": {
      "format": "DD/MM/YYYY",
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
                loadAntenatal();
                //loadTreatmentPlan();


$('#referal_doctor').select2();    
$('#consultation_type').select2();
$('#location').select2();
$('#visit_type').select2();
$('#ipd_accounttype').select2();
$('#ipd_referal_doctor').select2({
      tags: true
      });


    $('#investigation').select2();  
     $('#procedure').select2();
     $('#medication').select2();
  
    $('#complaint').select2({
      tags: true
      });

     $('#directquestion').select2({
      tags: true
      });

 $('#gestation_by_date').select2({
      tags: true
      });

      $('#gestation_by_date_day').select2({
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

     $('#drug_history_recent').select2({
      tags: true
      });

        $('#g6pd').select2({
      tags: true
      });

           $('#blood_group').select2({
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

      $('#pe_skin').select2({
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



      $('#hospitalization_history').select2({
      tags: true
      });

       $('#developmental_history').select2({
      tags: true
      });


 $('#obs_history').select2({
      tags: true
      });


 $('#gynae_history').select2({
      tags: true
      });


 $('#living').select2({
      tags: true
      });


 $('#parity').select2({
      tags: true
      });

 $('#lie').select2({
    tags: true
    });

    $('#presentation').select2({
      tags: true
      });
    $('#engagement').select2({
      tags: true
      });
    
    $('#position').select2({
      tags: true
      });

    $('#oedema').select2({
      tags: true
      });



 $('#pe_pelvic').select2({
      tags: true
      });

 $('#pe_adnexa').select2({
      tags: true
      });

$('#pe_ext_genitalia').select2({
      tags: true
      });

$('#pe_vulva').select2({
      tags: true
      });

$('#pe_vagina').select2({
      tags: true
      });

$('#pe_cervix').select2({
      tags: true
      });

$('#pe_uterus').select2({
      tags: true
      });

$('#gravida').select2({
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
                 getDiagnosisState();
            
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

function loadAntenatal()
    {
       $.get('/get-antenatal-records',
          {
            "patient_id": $('#patient_id').val()
          },
          function(data)
          { 
            $('#AntenatalTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#AntenatalTable tbody').append('<tr><td>'+ value['created_on'] +'</td><td>'+ value['lmp'] +'</td><td>'+ value['gestation_by_date'] +'</td><td>'+ value['edd'] +'</td><td>'+ value['position'] +'</td><td>'+ value['presentation'] +'</td><td>'+ value['engagement'] +'</td><td>'+ value['fh_fm'] +'</td> <td>'+ value['lie'] +'</td><td>'+ value['fetus'] +'</td><td>'+ value['sp'] +'</td><td>'+ value['fetal_heart_tone'] +'</td><td>'+ value['remarks'] +'</td><td><a a href="#"><i onclick="removeAntenatalRecord('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });                                 
         },'json');      
    }


function addAntenatal()
{
  //alert($('#patient_id').val());
if($('#lmp').val()!= "" && $('#presentation').val()!="")
{

    $.get('/add-antenatal-records',
        {
          "opd_number": $('#opd_number').val(),
          "lmp" :$('#lmp').val(), 
          "patient_id": $('#patient_id').val(),
          "gestation_by_date": $('#gestation_by_date').val() + ' ' + $('#gestation_by_date_day').val() + 'day(s)',
          "fetus":  $('#fetus').val(),
          "presentation": $('#presentation').val(),
          "engagement": $('#engagement').val(),
          "fh_fm": $('#fh_fm').val(),
          "position": $('#position').val(),
          "lie": $('#lie').val(),
          "oedema": $('#oedema').val(),
          "antenatal_remarks": $('#antenatal_remarks').val(),
          "urine_sugar": $('#urine_sugar').val(),
          "urine_protein": $('#urine_protein').val(),
          "edd": $('#edd').val(),
          "bloodtype": $('#bloodtype').val(),
          "g6pd": $('#ant_g6pd').val(),
          "tt": $('#tt').val(),
          "sp": $('#sp').val(),
          "fetal_heart_tone": $('#fetal_heart_tone').val()


        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          loadAntenatal();
          sweetalert('Records Added');
        }
        else
        {
          sweetAlert("Record failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {
      sweetAlert("Add a record first before saving !");
    }
}


function removeAntenatalRecord(id)
   {
      
          $.get('/delete-antenatal-records',
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
              loadAntenatal();
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from record.", "error");
              
            }
           
        });
                                          
          },'json');    
           
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
          "doctors_note":  $('#perspective_comment_doctor').val(),
          "patients_note":  $('#perspective_comment_patient').val(),

          //History
          "medical_history":  $('#medical_history').val(),
          "family_history":  $('#family_history').val(),
          "social_history":  $('#social_history').val(),
          "vaccinations_history":  $('#vaccinations_history').val(),
          "drug_history":  $('#drug_history').val(),
          "drug_history_recent":  $('#drug_history_recent').val(),
          "g6pd":  $('#g6pd').val(),
          "blood_group":  $('#blood_group').val(),
          "surgical_history":  $('#surgical_history').val(),
          "reproductive_history":  $('#reproductive_history').val(),
          "allergy":  $('#allergy').val(),


            //antenatal
          "gravida":  $('#gravida').val(),
          "parity":  $('#parity').val(),
          "living":  $('#living').val(),
          "hospitalization_history":  $('#hospitalization_history').val(),
          "gynae_history":  $('#gynae_history').val(),
          "developmental_history":  $('#developmental_history').val(),
          "obs_history":  $('#obs_history').val(),
          "pe_vulva":  $('#pe_vulva').val(),
          "pe_vagina":  $('#pe_vagina').val(),
          "pe_uterus":  $('#pe_uterus').val(),
          "pe_cervix":  $('#pe_cervix').val(),
          "pe_adnexa":  $('#pe_adnexa').val(),
          "pe_ext_genitalia":  $('#pe_ext_genitalia').val(),
          "pe_pelvic":  $('#pe_pelvic').val(),




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
          "pe_skin":  $('#pe_skin').val(),
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
    $.get('/add-doctor-referal',
        {
          "opd_number": $('#opd_number').val(),
          "patient_id": $('#patient_id').val(),
          "referal_note": $('#myreferal').html()
                         
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

  tinyMCE.triggerSave();
    $.get('/add-assessment',
        {
          "opd_number": $('#opd_number').val(),
          "patient_id": $('#patient_id').val(),
          "assessment": $('#assessment').val()
                         
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
    {sweetAlert("Please add an assessment!");}
}

function addContinuation()
{
if($('#continuation_sheet').val()!= "")
{

  //alert($('#complaint').val());
  tinyMCE.triggerSave();
    $.get('/add-continuation',
        {
          "opd_number": $('#opd_number').val(),
          "patient_id": $('#patient_id').val(),
          "continuation_sheet": $('#continuation_sheet').val()
                         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          sweetAlert("Note saved successfully!");
          //loadContinuation();
        }
        else
        {
          sweetAlert("Note failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please add a Note!");}
}


function addContinuationOP()
{
if($('#continuation_sheet').val()!= "")
{

  //alert($('#complaint').val());
  tinyMCE.triggerSave();
    $.get('/add-continuation-op',
        {
          "opd_number": $('#opd_number').val(),
          "patient_id": $('#patient_id').val(),
          "continuation_sheet": $('#operation_sheet').val()
                         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          sweetAlert("Note saved successfully!");
          //loadContinuation();
        }
        else
        {
          sweetAlert("Note failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please add a Note!");}
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

function getDiagnosisState()
{

     $.get('/get-diagnosis-state',
        {
           "opd_number": $('#opd_number').val()    

        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          sweetAlert("No Diagnosis has been added");

          $('#medication').val('');
          $('#investigation').val('');


         
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
if($('#procedure').val()!= "" && $('#procedure_quantity').val()!= "")
{

    $.get('/add-procedure-nurse',
        {
          "patient_id": $('#patient_id').val(),
           "accounttype": $('#accounttype').val(),
          "opd_number": $('#opd_number').val(),
          "procedure": $('#procedure').val(),
          "procedure_quanity": $('#procedure_quantity').val(),
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



function addDiagnosis()
{
if($('#diagnosis').val()!= "" && $('#diagnosis_type').val()!= "")
{

    $.get('/add-diagnosis',
        {
          "patient_id": $('#patient_id').val(),
          "opd_number": $('#opd_number').val(),
          "diagnosis":  $('#diagnosis').val(),
          "diagnosis_type":  $('#diagnosis_type').val(),
          "diagnosis_remark":       $('#diagnosis_remark').val(),
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
    {sweetAlert("Please select a diagnosis type / Key in a diagnosis!");}
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
            $('#diagnosisTable tbody').append('<tr><td>'+ value['diagnosis_type'] +'</td><td>'+ value['diagnosis'] +'</td><td>'+ value['remark'] +'</td><td>'+ value['created_by'] +'</td><td>'+ value['date'] +'</td><td><a a href="#"><i onclick="removediagnosis('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
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



  @if($visit_details->referal_doctor == Auth::user()->getNameOrUsername())
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



<div class="modal fade" id="new-admission" style="height:600px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Admit Patient</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           
                            @include('doctor/admit') 
                      
                        </div>                  
                        </div>
                        </section>
                </section>
         </div>        
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->



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


    <div class="modal fade" id="new-appointment-request" size="600">
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
                           <form  class="bootstrap-modal-form" data-validate="parsley" method="post" action="/create-event" class="panel-body wrapper-lg">
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



@endrole

