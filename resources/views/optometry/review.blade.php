@role(['System Admin','Ophthalmologist'])
@extends('layouts.default')
@section('content')
<section class="vbox">
           <header class="header bg-white b-b b-light">
                    

                     

                      <a href="#" class="btn btn-warning btn-s-md btn-lg pull-right">Total Charge : GHS {{ $payables }}</a>
                      <a href="#" class="btn btn-success btn-s-md btn-lg pull-right">Paid : GHS {{ $receivables }}</a>
                      <a href="#" class="btn btn-danger btn-s-md btn-lg pull-right">Outstanding : GHS {{ number_format($outstanding, 1, '.', ',') }}</a>

                      ||

                   
                      <p class="block"><a href="#" class=""></a> <span class="label label-success btn-rounded">{{ $visit_details->payercode }}</span></p> ||
                      <p class="block"><a href="#" class=""></a> <span class="label label-success btn-rounded">{{ $visit_details->care_provider }}</span></p> ||
                      <p class="block"><a href="#" class=""></a> <span class="label label-success btn-rounded">{{ $patients[0]->company }}</span></p>
                   
           
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
                           <p><span class="label label-success">{{ $visit_details->consultation_type }} </span></p> 
                            <p class="block"><a href="#" class=""></a> <span class="label label-success btn-rounded">{{ $visit_details->opd_number }}</span></p>
                     <p class="block"><a href="#" class=""></a> <span class="label label-danger btn-rounded">Created : {{ Carbon\Carbon::parse($visit_details->created_on)->diffForHumans() }}</span></p>
                            </div>
                          </div>                
                        </div>
                        <div class="panel wrapper panel-success">
                          <div class="row">
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $patients[0]->gender }}</span>
                                 <input type="hidden" id="accounttype" name="accounttype" value="{{ $patients[0]->accounttype }}">
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
                            <span class="pull-right">{{ $patients[0]->mobile_number }}</span>
                            
                             <small class="text-muted">Mobile Number</small>
                          </li>     
                         
                        </ul>

                        <div class="clear">
                        <p>Bill Item(s)</p>
                           @foreach($bills as $bill)
                               <a a href="#"> <label class="badge bg-danger"> {{$bill->item_name}} <i class="fa fa-trash-o"></i></label></a>
                               @endforeach
                            </div>
                         
                         {{--    <input type="hidden" id="opd_number" name="opd_number" value="{{ $visit_details->opd_number }}">
                           <input type="hidden" id="fullname" name="fullname" value="{{ $visit_details->name }}">
                            <input type="hidden" id="patient_id" name="patient_id" value="{{ $visit_details->patient_id }}"> --}}

                          <ul class="list-group no-radius">
                         <h5>
                                <span>Vitals</span>
                               @foreach($myvitals as $vital)
                               <ul>
                                @if($vital->weight == '') @else <li> Weight <label class="badge bg-info"> {{$vital->weight}}  </label></li> @endif
                                @if($vital->height == '') @else <li> Height <label class="badge bg-info"> {{$vital->height}}  </label></li> @endif

                                 @if($vital->height == '') @else <li> BMI <label class="badge bg-info"> {{ $vital->bmi }}  </label> {{ $vital->bmi_status }}</li> @endif

                                @if($vital->temperature == '') @else <li> Temperature <label class="badge bg-info"> {{$vital->temperature}} ° </label>{{ $vital->temp_status }}</li> @endif
                                @if($vital->pulse_rate == '') @else <li> Pulse Rate <label class="badge bg-info"> {{$vital->pulse_rate}}  </label></li> @endif
                                @if($vital->bp_status == '') @else <li> Blood Pressure <label class="badge bg-info"> {{$vital->sbp }} / {{ $vital->dbp  }} </label>{{$vital->bp_status}}</li> @endif
                                 </ul>
                               @endforeach
                              </h5>
                        </ul>
                          <br>
                         <img src="/images/214302.svg"> 
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                     {{--  
                        
                        --}}
                        <li class=""><a href="#review-complaint" data-toggle="tab"> <i class="fa fa-folder-o text-default"></i>  Clerking Notes </a></li>

                         <li class=""><a href="#review-ocular" data-toggle="tab"> <i class="fa fa-fire text-default"></i>  Ocular Examination </a></li>
                        <li class=""><a href="#review-procedure" data-toggle="tab"> <i class="fa fa-fire text-default"></i>  Refraction Finding </a></li>

                        <li class=""><a href="#review-assessment" data-toggle="tab"> <i class="fa fa-pencil text-default"></i>  Examination Findings </a></li>

                         <li class=""><a href="#review-billing" data-toggle="tab"> <i class="fa fa-money text-default"></i>  Lens / Frame Billing </a></li>

                        <li class=""><a href="#review-investigation" data-toggle="tab"> <i class="fa fa-code-fork text-default"></i>  Labs / Investigation </a></li>
                        <li class=""><a href="#review-diagnosis" data-toggle="tab"> <i class="fa fa-gavel text-default"></i>  Differential  Diagnosis </a></li> 
                        
                        <li class=""><a href="#review-medication" data-toggle="tab"> <i class="fa fa-flask text-default"></i>  Medication </a></li>
                  
                         <li class=""><a href="#review-summary" data-toggle="tab"><i class="fa  fa-code-fork text-default"></i> Notes Summary </a></li> 
                         <li class=""><a href="#history-summary" data-toggle="tab"><i class="fa fa-archive text-default"></i> Notes History (Old Visits) </a></li> 
                         <li class=""><a href="#review-referal" data-toggle="tab"><i class="fa fa-briefcase text-default"></i> Referal Note </a></li> 
                         <li class=""><a href="#review-continuation" data-toggle="tab"><i class="fa fa-file text-default"></i> Continuation Note for Review </a></li> 

                        
                         <li class=""><a href="#review-discharge" data-toggle="tab"><i class="fa fa-bars text-default"></i> Visit Summary </a></li>
                         <li class=""><a href="#review-appointment" data-toggle="tab"><i class="fa fa-calendar text-default"></i> Book & View Appointments </a></li>
                         
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
                           <select id="investigation" name="investigation" rows="3" tabindex="1" data-placeholder="Select investigation ..." style="width:100%">
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
                    <img src="/images/223683.svg" width="15%" align="right"> 
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
                      <a href="/ophthalmology-review/{{$visits->opd_number}}" class="h4">{{$visits->consultation_type}}</a>
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
                        <div id="myreferal" name="myreferal" class="form-control" style="overflow:scroll;height:300px;max-height:300px" contenteditable="true"> 
                                 {!!$referals->content!!}
                               </div>


                      </div>
                       <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addPlanReferal()" class="btn btn-success btn-s-xs">Add Referal Plan</button>
                      </footer>
                



                  
                </section>
              </section>
              </div>

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
                              <div class="m-t-sm timeline-action">
                               {{--  <span class="h3 pull-left m-r-sm">4:51</span> --}}
                                <a href="/print-visit-summary/{{ $visit_details->opd_number  }}"><button class="btn btn-sm btn-default btn-bg"><i class="fa fa-check"></i> Print this note </button></a>

                                <a href="/print-executive-cover/{{ $visit_details->opd_number  }}"><button class="btn btn-sm btn-default btn-bg"><i class="fa fa-check"></i> Exec Cover Note </button></a>
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
                               {{--  @if($myhistories->reproductive_history == '') @else <li> Reproductive History <label class="badge bg-danger"> {{$myhistories->reproductive_history}}  </label></li> @endif --}}
                                @if($myhistories->vaccinations_history == '') @else <li>Past Ophthalmic history <label class="badge bg-default"> {{$myhistories->vaccinations_history}}  </label></li> @endif
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
                               
                                 <a>{!!$myplan->assessment!!} <i class="fa fa-trash-o text-muted"></i> </a>
                              
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

                     
                     


                       <div class="tab-pane active" id="review-complaint">
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
                         4. Personal , Ophthalmic , Social , Habits, Diet Histories
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
                           <label class="badge bg-danger">Past Ophthalmic history</label> 
                        <select name="vaccinations_history[]" id="vaccinations_history" style="width:100%" multiple data-placeholder=""  >

                        <option value="{{ $myhistories->vaccinations_history }}" selected > {{ $myhistories->vaccinations_history }} </option>
                         <option value="Lazy eye" > Lazy eye </option>
                          <option value="Ocular surgery" > Ocular surgery </option>
                           <option value="Ocular trauma" > Ocular trauma </option>
                            <option value="Squint" > Squint </option>
                             <option value="Astigmatism" > Astigmatism </option>
                              <option value="Myopia" > Myopia </option>
                              <option value="Hyperopia" > Hyperopia </option>



                         {{--  @foreach($vacinnationhx as $vacinnationhx)
                        <option  value="{{ $vacinnationhx->type }}">{{ $vacinnationhx->type }}</option>
                          @endforeach --}}
                            </select>    
                          </div>
                          </div>


                        


                            <div class="form-group pull-in clearfix ">
                           <div class="col-sm-3">
                           <label class="badge bg-danger">Past & Present Medications</label> 
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
                           <label class="badge bg-default"> Allergies </label> 
                        <select name="allergy[]" id="allergy" style="width:100%" multiple data-placeholder="Allergy"  >
                        <option value="{{ $myhistories->allergy }}" selected > {{ $myhistories->allergy }} </option>
                          
                       @foreach($allergichx as $allergichx)
                        <option  value="{{ $allergichx->type }}">{{ $allergichx->type }}</option>
                          @endforeach
                             
                          
                            </select>    
                          </div>
                          </div>



                         
                      </div>
    
                         
                        </div>
                      </div>
                    </div>


                      
         

                    


                    
                       <div class="panel panel-default">
                      <div class="panel-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseSeven">
                         4. Doctor Comments
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
                         5. Patient Illness Perspective
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


                  <div class="tab-pane" id="review-procedure">
                            <section class="panel panel-default">
                      <div class="panel-body">
                          
                      


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <label>Examination type </label>
                           <select id="examination_type" name="examination_type" rows="3" tabindex="1" data-placeholder="Select procedure" style="width:100%">
                           <option value="{{ $eyefindings['examination_type']}}" selected>{{ $eyefindings['examination_type']}}</option>
                           <option value="">-- Select Examination --</option>
                          @foreach($treatments as $treatment)
                        <option value="{{ $treatment->type }}">{{ $treatment->type }}</option>
                          @endforeach
                        </select>         
                          </div>
                        </div>

                        <br>
                        <br>
                      
                        <label>Auto Refraction </label>
                        <div class="table-responsive">
                       <table id="" cellpadding="2" cellspacing="0" border="2" class="table table-striped m-b-none text-sm" width="100%">
                         
                          <thead>
                            <tr>
                            
                              <th></th>
                              <th>Sphere</th>
                              <th>Cylinder</th>
                              <th>Axis</th>
                              <th>PD</th>
                              
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                          <tr>
                          <td>OD</td>
                        <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_sphere_auto" name="od_sphere_auto" value="{{ $eyefindings['od_sphere_auto']}}"></td>
                        <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_cylinder_auto" name="od_cylinder_auto" value="{{ $eyefindings['od_cylinder_auto']}}"</td>
                        <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_axis_auto" name="od_axis_auto" value="{{ $eyefindings['od_axis_auto']}}"></td>
                        <td>D: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_h_prism_auto" name="od_h_prism_auto" value="{{ $eyefindings['od_h_prism_auto']}}"> N: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_h_prism_auto" name="os_h_prism_auto" value="{{ $eyefindings['os_h_prism_auto']}}">  </td>

                          
                          <td></td>
                          </tr>

                          <tr>
                           <tr>
                          <td>OS</td>
                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_sphere_auto" name="os_sphere_auto" value="{{ $eyefindings['os_sphere_auto']}}"></td>
                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_cylinder_auto" name="os_cylinder_auto" value="{{ $eyefindings['os_cylinder_auto']}}"></td>
                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_axis_auto" name="os_axis_auto" value="{{ $eyefindings['os_axis_auto']}}"></td>
                          <td>VR: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="vr_visual_ascuity" name="vr_visual_ascuity" value="{{ $eyefindings['vr_visual_ascuity']}}"> VL: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="vl_visual_ascuity" name="vl_visual_ascuity" value="{{ $eyefindings['vl_visual_ascuity']}}">   </td>
                          <td></td>
                          </tr>
                          </tbody>
                                 
                        </table>
                    </div>

                    <br>
                    <br>
                    <br>


                        <label>Subjective Refraction </label>
                        <div class="table-responsive">
                       <table id="" cellpadding="2" cellspacing="0" border="2" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th></th>
                              <th>Sphere</th>
                              <th>Cylinder</th>
                              <th>Axis</th>
                              <th>Prism</th>
                              <th>Add</th>
                              <th>PD</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                          <tr>
                          <td>OD</td>
                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_sphere" name="od_sphere" value="{{ $eyefindings['od_sphere']}}"></td>
                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_cylinder" name="od_cylinder" value="{{ $eyefindings['od_cylinder']}}"></td>
                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_axis" name="od_axis" value="{{ $eyefindings['od_axis']}}"></td>
                          <td>H: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_h_prism" name="od_h_prism" value="{{ $eyefindings['od_h_prism']}}"> <br><br> V: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_v_prism" name="od_v_prism" value="{{ $eyefindings['od_v_prism']}}"> </td>

                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_h_add" name="od_h_add" value="{{ $eyefindings['od_h_add']}}"> {{-- <br><br> <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_v_add" name="od_v_add"> --}} </td>

                          <td> D: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_h_pd" name="od_h_pd" value="{{ $eyefindings['od_h_pd']}}"> N: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_v_pd" name="od_v_pd" value="{{ $eyefindings['od_v_pd']}}"> </td>
                          <td></td>
                          </tr>

                          <tr>
                           <tr>
                          <td>OS</td>
                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_sphere" name="os_sphere" value="{{ $eyefindings['os_sphere']}}"></td>
                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_cylinder" name="os_cylinder" value="{{ $eyefindings['os_cylinder']}}"></td>
                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_axis" name="os_axis" value="{{ $eyefindings['os_axis']}}"></td>
                          <td>H: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_h_prism" name="os_h_prism" value="{{ $eyefindings['os_h_prism']}}"> <br><br> V: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_v_prism" name="os_v_prism" value="{{ $eyefindings['os_v_prism']}}"> </td>

                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_h_add" name="os_h_add" value="{{ $eyefindings['os_h_add']}}"> {{-- <br><br> <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_v_add" name="os_v_add">  --}}</td>

                          <td>{{-- <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_h_pd" name="os_h_pd"> <br><br> <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_v_pd" name="os_v_pd">  --}}</td>
                          <td></td>
                          </tr>
                          </tbody>
                        </table>
                    </div>
 
                        <br>
                        <br>
                        <br>
                        <br>

                          
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <label>Lens Material </label>
                          <select id="lens_type" name="lens_type[]" rows="3" multiple tabindex="1" data-placeholder="Select lense" style="width:100%">
                          <option value="{{ $eyefindings['lens_type']}}" selected="">{{ $eyefindings['lens_type']}}</option>
                           <option value="">-- Select lens --</option>
                          <option value="Plastic">Plastic</option>
                          <option value="Polycarbonate">Polycarbonate</option>
                        </select>         
                          </div>
                        </div>
                         <br>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <label>Lens Type </label>
                           <select id="lens_power" name="lens_power[]" multiple rows="3" tabindex="1" data-placeholder="Select lense" style="width:100%">
                            <option value="{{ $eyefindings['lens_power']}}" selected="">{{ $eyefindings['lens_power']}}</option>
                           <option value="">-- Select lens --</option>
                           @foreach($lenstypes as $type)
                        <option value="{{ $type->lens }}">{{ $type->lens }}</option>
                          @endforeach 
                        </select>         
                          </div>
                        </div>
                         <br>
                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <label>Lens Treatment </label>
                           <select id="lens_treatment" name="lens_treatment[]" multiple rows="3" tabindex="1" data-placeholder="Select treatment" style="width:100%">
                            <option value="{{ $eyefindings['lens_treatment']}}" selected>{{ $eyefindings['lens_treatment']}}</option>
                           <option value="">-- Select --</option>
                           @foreach($lenstreatments as $type)
                        <option value="{{ $type->treatments }}">{{ $type->treatments }}</option>
                          @endforeach 
                        </select>         
                          </div>
                        </div>
                        <br>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <label>Lens Index </label>
                           <select id="lens_index" name="lens_index[]" multiple rows="3" tabindex="1" data-placeholder="Select index" style="width:100%">
                             <option value="{{ $eyefindings['lens_index']}}" selected>{{ $eyefindings['lens_index']}}</option>
                           <option value="">-- Select --</option>
                           
                        <option value="1.49">1.49</option>
                        <option value="1.50">1.50</option>
                         <option value="1.56">1.56</option>
                          <option value="1.67">1.67</option>
                          
                        </select>         
                          </div>
                        </div>
                        <br>

                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <label>Style </label>
                           <select id="lens_style" name="lens_style[]" multiple rows="3" tabindex="1" data-placeholder="Select style" style="width:100%">
                            <option value="{{ $eyefindings['style']}}" selected>{{ $eyefindings['style']}}</option>
                         
                         {{--  @foreach($treatments as $treatment)
                        <option value="{{ $treatment->type }}">{{ $treatment->type }}</option>
                          @endforeach --}}
                        </select>         
                          </div>

                          <div class="col-sm-3">
                          <label>Color </label>
                           <select id="lens_color" name="lens_color[]" multiple rows="3" tabindex="1" data-placeholder="Select style" style="width:100%">
                            <option value="{{ $eyefindings['color']}}" selected>{{ $eyefindings['color']}}</option>
                          
                          {{--  @foreach($treatments as $treatment)
                          <option value="{{ $treatment->type }}">{{ $treatment->type }}</option>
                          @endforeach --}}
                        </select>         
                          </div>

                          <div class="col-sm-3">
                          <label>Rim Type </label>
                           <select id="rim_type" name="rim_type[]" multiple rows="3" tabindex="1" data-placeholder="Select type" style="width:100%">
                            <option value="{{ $eyefindings['rim_type']}}" selected>{{ $eyefindings['rim_type']}}</option>
                          
                           <option value="Full Rim">Full Rim</option>
                           <option value="Half Rim">Half Rim</option>
                           <option value="Rimless">Rimless</option>
                        </select>         
                          </div>
                        </div>

                         <br>
                       <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label>Remarks</label> 
                            <div class="form-group{{ $errors->has('lens_remark') ? ' has-error' : ''}}">
                            <textarea type="text" rows="3" class="form-control" id="lens_remark" name="lens_remark" value="{{ $eyefindings['lens_remark']}}"></textarea>   
                           @if ($errors->has('procedure_remark'))
                          <span class="help-block">{{ $errors->first('remark') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

{{-- 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Contact Lens Prescription</header>
                                <div class="panel-body">
                             <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('drug_dosage') ? ' has-error' : ''}}">
                            <label>R</label>
                            <input type="text" class="form-control" class="text-success" id="height"  value="{{ Request::old('height') ?: '' }}"  name="height">
                           @if ($errors->has('height'))
                          <span class="help-block">{{ $errors->first('height') }}</span>
                           @endif    
                          </div>   
                        </div>


                         <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('drug_dosage') ? ' has-error' : ''}}">
                            <label>L</label>
                            <input type="text" class="form-control" class="text-success" id="height"  value="{{ Request::old('height') ?: '' }}"  name="height">
                           @if ($errors->has('height'))
                          <span class="help-block">{{ $errors->first('height') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('drug_dosage') ? ' has-error' : ''}}">
                            <label>Base Curve</label>
                            <input type="text" class="form-control" class="text-success" id="height"  value="{{ Request::old('height') ?: '' }}"  name="height">
                           @if ($errors->has('height'))
                          <span class="help-block">{{ $errors->first('height') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('drug_dosage') ? ' has-error' : ''}}">
                            <label>Diameter</label>
                            <input type="text" class="form-control" class="text-success" id="height"  value="{{ Request::old('height') ?: '' }}"  name="height">
                           @if ($errors->has('height'))
                          <span class="help-block">{{ $errors->first('height') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        </section> --}}



  
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addlense()" class="btn btn-success btn-s-xs">Add Finding</button>
                        <a href="/print-eye-plan/{{ $visit_details->opd_number }}" Class="btn-info btn-xs"> PRINT RESULT </a> 
                      </footer>
                    </section>
                          
                  <img src="/images/139281.svg" width="15%" align="right"> 
                         {{--  <section class="panel panel-info">
                                <header class="panel-heading font-bold">Lens History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="procedureTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            <th>Lens</th>
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
                       --}}
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


               {{--  <div class="tab-pane" id="review-assessment">
                          <section class="panel panel-default">
                      <div class="panel-body">
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label class="badge bg-default">Examination Finding</label> 
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
                        <button type="button" onclick="addAssessment()" class="btn btn-success btn-s-xs">Add Finding</button>
                      </footer>
                    </section>

                    <img src="/images/439190.svg" width="10%" align="right"> 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Findings History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="assessmentTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                              <th>Finding</th>
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

                  <div class="tab-pane" id="review-ocular">
                            <section class="panel panel-default">
                      <div class="panel-body">

                           <label> Ocular Examination </label> 

                           <button type="button" onclick="setOcularNull()" class="btn btn-dark btn-s-xs pull-right">Set Defualt </button>
                        <div class="table-responsive">
                       <table id="" cellpadding="2" cellspacing="0" border="2" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th></th>
                              <th>OD</th>
                              <th>OS</th>
                           
                            </tr>
                          </thead>
                          <tbody>

                          <tr>
                          <td>Visual Acuity</td>
                          <td>
                          {{--  <input type="text" style="width:300px; border: 1px solid #ABADB3; text-align: center;" id="od_ocular_adnexae" name="od_ocular_adnexae">  --}}
                          <select id="od_visual_ascuity" name="od_visual_ascuity[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                          <option value="{{ $ocularfindings['od_visual_ascuity']}}" selected>{{ $ocularfindings['od_visual_ascuity']}}</option>
                       
                           <option value="NAD">NAD</option>
                          </select>

                          </td>
                          <td>
                           <select id="os_visual_ascuity" name="os_visual_ascuity[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                            <option value="{{ $ocularfindings['os_visual_ascuity']}}" selected>{{ $ocularfindings['os_visual_ascuity']}}</option>
                 
                           <option value="NAD">NAD</option>
                          </select>
                          </td>
                        
                          </tr>


                          <tr>
                          <td>Ocular Adnexae</td>
                          <td>
                          {{--  <input type="text" style="width:300px; border: 1px solid #ABADB3; text-align: center;" id="od_ocular_adnexae" name="od_ocular_adnexae">  --}}
                          <select id="od_ocular_adnexae" name="od_ocular_adnexae[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                          <option value="{{ $ocularfindings['od_ocular_adnexae']}}" selected>{{ $ocularfindings['od_ocular_adnexae']}}</option>
                          
                           <option value="NAD">NAD</option>
                          </select>

                          </td>
                          <td>
                           <select id="os_ocular_adnexae" name="os_ocular_adnexae[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                            <option value="{{ $ocularfindings['os_ocular_adnexae']}}" selected>{{ $ocularfindings['os_ocular_adnexae']}}</option>
                         
                           <option value="NAD">NAD</option>
                          </select>
                          </td>
                        
                          </tr>


                           <tr>
                          <td>Conjunctiva / Sclera</td>
                          <td>
        
                          <select id="od_conjunctiva_sclera" name="od_conjunctiva_sclera[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                          <option value="{{ $ocularfindings['od_conjunctiva_sclera']}}" selected>{{ $ocularfindings['od_conjunctiva_sclera']}}</option>
                          
                           <option value="NAD">NAD</option>
                          </select>

                          </td>
                          <td>
                           <select id="os_conjunctiva_sclera" name="os_conjunctiva_sclera[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                            <option value="{{ $ocularfindings['os_conjunctiva_sclera']}}" selected>{{ $ocularfindings['os_conjunctiva_sclera']}}</option>
                  
                           <option value="NAD">NAD</option>
                          </select>
                          </td>
                        
                          </tr>






                           <tr>
                          <td>Cornea</td>
                          <td>
                          <select id="od_cornea" name="od_cornea[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['od_cornea']}}" selected>{{ $ocularfindings['od_cornea']}}</option>
                     
                           <option value="NAD">NAD</option>
                          </select>
                          </td>
                          <td><select id="os_cornea" name="os_cornea[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['os_cornea']}}" selected>{{ $ocularfindings['os_cornea']}}</option>
                        
                           <option value="NAD">NAD</option>
                          </select></td>
                        
                          </tr>

                           <tr>
                          <td>AC</td>
                          <td>
                          <select id="od_ac_lens" name="od_ac_lens[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['od_ac_lens']}}" selected>{{ $ocularfindings['od_ac_lens']}}</option>
                        
                           <option value="NAD">NAD</option>
                          </select>
                          </td>
                          <td><select id="os_ac_lens" name="os_ac_lens[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['os_ac_lens']}}" selected>{{ $ocularfindings['os_ac_lens']}}</option>
                           
                           <option value="NAD">NAD</option>
                          </select></td>
                        
                          </tr>

                          <tr>
                          <td>Pupil</td>
                          <td><select id="od_pupil_lens" name="od_pupil_lens[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['od_pupil_lens']}}" selected>{{ $ocularfindings['od_pupil_lens']}}</option>
                          
                           <option value="NAD">NAD</option>
                            <option value="PERRLA">PERRLA</option>
                          </select></td>
                          <td><select id="os_pupil_lens" name="os_pupil_lens[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['os_pupil_lens']}}" selected>{{ $ocularfindings['os_pupil_lens']}}</option>
                          
                           <option value="NAD">NAD</option>
                           <option value="PERRLA">PERRLA</option>
                          </select></td>
                        
                          </tr>


                          <tr>
                          <td>Lens</td>
                          <td><select id="od_ocular_lens" name="od_ocular_lens[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['od_ocular_lens']}}" selected>{{ $ocularfindings['od_ocular_lens']}}</option>
                 
                           <option value="NAD">NAD</option>
                          </select></td>
                          <td><select id="os_ocular_lens" name="os_ocular_lens[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['os_ocular_lens']}}" selected>{{ $ocularfindings['os_ocular_lens']}}</option>
                          
                           <option value="NAD">NAD</option>
                          </select></td>
                        
                          </tr>


                           <tr>
                          <td>Virteous</td>
                          <td><select id="od_virteous" name="od_virteous[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['od_virteous']}}" selected>{{ $ocularfindings['od_virteous']}}</option>
                       
                           <option value="NAD">NAD</option>
                          </select></td>
                          <td><select id="os_virteous" name="os_virteous[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['os_virteous']}}" selected>{{ $ocularfindings['os_virteous']}}</option>
                          
                           <option value="NAD">NAD</option>
                          </select></td>
                        
                          </tr>

                          <tr>
                          <td>C/D Ratio</td>
                          <td><select id="od_c_d_ratio" name="od_c_d_ratio[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['od_c_d_ratio']}}" selected>{{ $ocularfindings['od_c_d_ratio']}}</option>
                           
                           <option value="NAD">NAD</option>
                          </select></td>
                          <td><select id="os_c_d_ratio" name="os_c_d_ratio[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['os_c_d_ratio']}}" selected>{{ $ocularfindings['os_c_d_ratio']}}</option>
                           
                           <option value="NAD">NAD</option>
                          </select></td>
                          </tr>


                           <tr>
                          <td>Retina</td>
                          <td><select id="od_retina" name="od_retina[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['od_retina']}}" selected>{{ $ocularfindings['od_retina']}}</option>
                           
                           <option value="NAD">NAD</option>
                          </select>
                          </td>
                          <td><select id="os_retina" name="os_retina[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['os_retina']}}" selected>{{ $ocularfindings['os_retina']}}</option>
                           
                           <option value="NAD">NAD</option>
                          </select></td>
                          </tr>

                           <tr>
                          <td>Others</td>
                          <td><select id="od_others" name="od_others[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['od_others']}}" selected>{{ $ocularfindings['od_others']}}</option>
                           
                           <option value="NAD">NAD</option>
                          </select></td>
                          <td><select id="os_others" name="os_others[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['os_others']}}" selected>{{ $ocularfindings['os_others']}}</option>
                          
                           <option value="NAD">NAD</option>
                          </select></td>
                          </tr>


                           <tr>
                          <td>IOP (mmHG)</td>
                          <td><select id="od_iop" name="od_iop[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['od_iop']}}" selected>{{ $ocularfindings['od_iop']}}</option>
                          
                           <option value="NAD">NAD</option>
                          </select></td>
                          <td><select id="os_iop" name="os_iop[]" multiple rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="{{ $ocularfindings['os_iop']}}" selected>{{ $ocularfindings['os_iop']}}</option>
                          
                           <option value="NAD">NAD</option>
                          </select></td>
                          </tr>

                          
                   
                          </tbody>
                        </table>
                    </div>
                      </div>

                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addOptha()" class="btn btn-success btn-s-xs">Add Findings</button>
                      </footer>
                      </section>
                  </div>


                    <div class="tab-pane" id="review-appointment">
                         <section class="hbox stretch">          
            <!-- .aside -->
            <aside>
              <section class="vbox">
                <section class="scrollable wrapper">
                  <section class="panel panel-default">
                    <header class="panel-heading bg-light clearfix">
                      <div class="btn-group pull-right" data-toggle="buttons">
                        <label class="btn btn-sm btn-bg btn-default active" id="monthview">
                          <input type="radio" name="options">Month
                        </label>
                        <label class="btn btn-sm btn-bg btn-default" id="weekview">
                          <input type="radio" name="options">Week
                        </label>
                        <label class="btn btn-sm btn-bg btn-default" id="dayview">
                          <input type="radio" name="options">Day
                        </label>
                      </div>
                      <span class="m-t-xs inline">
                        Fullcalendar - {{ $visit_details->referal_doctor }}
                      </span>
                    </header>
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


                  <div class="tab-pane" id="review-assessment">
                         
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Examination Finding</header>
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
                         <button type="button" onclick="addAssessment()" class="btn btn-success btn-s-xs">Save </button>
                         
                      </footer>
                     
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



                        <section class="panel panel-info">
                                
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table width="100%">
                          
                          <tbody>
                            <tr>
                            <td>
                            <a href="/doctor-appointments/{{ $visit_details->referal_doctor}}" class="btn btn-info rounded" data-toggle="modal">Appointment Request</a>
                            </td>
                            <td>
                             <a href="#internal-referral" class="btn btn-info rounded bootstrap-modal-form-open" onclick="getDetails('{{ $patients[0]->id }}')" data-toggle="modal">Create Internal Referral</a>
                            </td>
                            <td>
                            <a href="/print-referal-note/{{ $visit_details->opd_number }}" class="btn btn-info rounded" data-toggle="modal">Print Referral Letter</a>
                            </td>
                            </tr>
                            <tr>
                            <td>
                           <a href="/print-excuse-duty/{{ $visit_details->opd_number }}" class="btn btn-info rounded" data-toggle="modal">Print Excuse Duty</a>
                            </td>
                            <td>
                          <a href="/print-refusal-treatment/{{ $visit_details->opd_number }}" class="btn btn-info rounded" data-toggle="modal">Print Refusal of Treatment</a>
                            </td>
                        </tr>
                          </tbody>
                        </table>
                    </div>
                    </div>
                    </section>

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
                              <th>Reason for Discharge / Recommendation</th>
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

                   <div class="tab-pane" id="review-medication">
                    <section class="panel panel-default">
                      <div class="panel-body">
                 
                      <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                          <div class="input-group m-b">
                           <select id="medication" name="medication" rows="3" onchange="getdrugdetail()" tabindex="1" data-placeholder="Select drug ..." style="width:100%">
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
                      <img src="">
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

                    <div class="tab-pane" id="review-billing">
                                      <section class="panel panel-default">
                      <div class="panel-body">
                 
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <select id="procedure" name="procedure" rows="3" tabindex="1" data-placeholder="Search lens / frame ..." style="width:100%">
                           <option value="">-- Select lens/Frame --</option>
                          @foreach($treatments as $treatment)
                        <option value="{{ $treatment->type }}">{{ $treatment->type }}</option>
                          @endforeach
                        </select>         
                          </div>
                        </div>

                          <div class="form-group pull-in clearfix">
                         <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('procedure_quantity') ? ' has-error' : ''}}">
                            <label>Quantity</label>
                             <input type="number" class="form-control" class="text-success" id="procedure_quantity"  value="{{ Request::old('procedure_quantity') ?: '' }}"  name="procedure_quantity">       
                           @if ($errors->has('procedure_quantity'))
                          <span class="help-block">{{ $errors->first('procedure_quantity') }}</span>
                           @endif    
                          </div>  
                          </div>

                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('procedure_discount') ? ' has-error' : ''}}">
                            <label>Discount (%)</label>
                             <input type="number" class="form-control" class="text-success" id="procedure_discount"  value="{{ Request::old('procedure_discount') ?: '' }}"  name="procedure_discount">       
                           @if ($errors->has('procedure_discount'))
                          <span class="help-block">{{ $errors->first('procedure_discount') }}</span>
                           @endif    
                          </div>  
                          </div>
                          </div> 

                        
                       


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label>Remarks</label> 
                            <div class="form-group{{ $errors->has('procedure_remark') ? ' has-error' : ''}}">
                            <textarea type="text" rows="3" class="form-control" id="procedure_remark" name="procedure_remark" value="{{ Request::old('procedure_remark') ?: '' }}"></textarea>   
                           @if ($errors->has('procedure_remark'))
                          <span class="help-block">{{ $errors->first('procedure_remark') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                      </div>
                             

                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addProcedure()" class="btn btn-success btn-s-xs">Add Frame/Lens</button>
                      </footer>
                    </section>
                          
            <img src="/images/eye-glass.svg" width="10%" align="right"> 
                          <section class="panel panel-info">
                                <header class="panel-heading font-bold">Frame / Lens Prescription History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="procedureTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            <th></th>
                              <th>Prescription</th>
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



                      </div>
                      </div>
                    </section>
                  
                  
                </aside>
               {{--  <aside class="col-lg-3 b-l">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                       
                       <section class="panel clearfix bg-default lter">
                          <div class="panel-body">
                          
                            <div class="clear">
                           <p>
                       <a href="#" class="btn btn-warning btn-lg pull-right">Total Charge : GHS {{ $payables }}</a>
                      </p>
                      <p>
                       <a href="#" class="btn btn-success btn-lg pull-right"> Paid : GHS {{ $receivables }}</a>
                      </p>
                      <p>
                       <a href="#" class="btn btn-danger btn-lg pull-right"> Outstanding : GHS {{ number_format($outstanding, 1, '.', ',') }}</a>
                      </p>
                            </div>
                          </div>
                        </section>

                         <section class="panel clearfix bg-default lter">
                          <div class="panel-body">
                          
                            <div class="clear">
                           @foreach($bills as $bill)
                               <a a href="#"> <label class="badge bg-danger"> {{$bill->item_name}} <i class="fa fa-trash-o"></i></label></a>
                               @endforeach
                            </div>
                          </div>
                        </section>

                      @if($patients[0]->date_of_birth->age > 6)
                      <img src="/images/dentallegend.jpg" style="width=5%">
                      @else
                      <img src="/images/babyteeth.jpg" style="width=5%">
                      @endif
                      </div>
                    </section>
                    </section>
                    </aside> --}}
    
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
  toolbar: 'insert | undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  templates: [
    //{title: 'Some title 1', description: 'Some desc 1', content: 'My content  {$bond_description}'},
    //{title: 'Advance Payment Bond', description: 'Some desc 2', url: 'http://127.0.0.1:8000/bond-test'}
  ],
  template_replace_values: {

  }

  

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


 <script src="{{ asset('/event_components/jquery.min.js')}}"></script>
  <script src="{{ asset('/event_components/bootstrap.min.js')}}"></script>
  <script src="{{ asset('/event_components/fullcalendar.min.js')}}"></script>
  <script src="{{ asset('/event_components/moment.min.js')}}"></script>


<script type="text/javascript">
  $(document).ready(function() {

  
       
    var base_url = '{{ url('/') }}';
     var doctor = $('#doctor').val();

   $('#calendar').fullCalendar({
      weekends: false,
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
     defaultView: 'month',
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

  //$('#new-appointment-request select[name="name"]').select2();

  });
</script>

<script type="text/javascript">
$(function () {
  $('#new-appointment-request input[name="time"]').daterangepicker({
     "daysOfWeek": ['Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
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
$(document).ready(function () {



    loadMedication();
    loadComplaints();
    loadInvestigation();
    loadDiagnosis();
    loadProcedure();
    loadHistory();
    loadDocumentDetail();
     loadVitals();
     loadAssessment();
     loadfuturePlan();
     loadPlan();



    $('#tooth').select2();
    $('#vital_remark').select2();
    $('#investigation').select2();  
    $('#procedure').select2();
    $('#medication').select2();
    $('#further_procedure').select2();
    $('#further_tooth').select2();
  
    $('#complaint').select2({
      tags: true
      });

    $('#directquestion').select2({
      tags: true
      });
   
    $('#history').select2({
      tags: true
      });
     $('#diagnosis').select2({
      tags: true
      });
    
    $('#drug_application').select2({
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


      $('#od_ocular_adnexae').select2({
      tags: true
      });
    $('#os_ocular_adnexae').select2({
      tags: true
      });
    $('#od_cornea').select2({
      tags: true
      });
     $('#os_cornea').select2({
      tags: true
      });
    $('#od_ac_lens').select2({
      tags: true
      });
    $('#os_ac_lens').select2({
      tags: true
      });
    $('#od_pupil_lens').select2({
      tags: true
      });
    $('#os_pupil_lens').select2({
      tags: true
      });
    $('#od_ocular_lens').select2({
      tags: true
      });
    $('#os_ocular_lens').select2({
      tags: true
      });
    $('#od_virteous').select2({
      tags: true
      });
    $('#os_virteous').select2({
      tags: true
      });
    $('#od_c_d_ratio').select2({
      tags: true
      });
    $('#os_c_d_ratio').select2({
      tags: true
      });
    $('#od_retina').select2({
      tags: true
      });
    $('#os_retina').select2({
      tags: true
      });
    $('#od_others').select2({
      tags: true
      });
    $('#os_others').select2({
      tags: true
      });
    $('#od_iop').select2({
      tags: true
      });
    $('#os_iop').select2({
      tags: true
      });
     $('#od_visual_ascuity').select2({
      tags: true
      });
      $('#os_visual_ascuity').select2({
      tags: true
      });
       $('#od_conjunctiva_sclera').select2({
      tags: true
      });
       $('#os_conjunctiva_sclera').select2({
      tags: true
      });


       $('#examination_type').select2();

    $('#lens_treatment').select2();
          $('#lens_power').select2();
       $('#rim_type').select2({
      tags: true
      });
    $('#lens_type').select2();
    $('#lens_color').select2({
      tags: true
      });
    $('#lens_style').select2({
      tags: true
      });
    $('#lens_index').select2();

  });
</script>



  <script type="text/javascript">


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


function addlense()
{
if($('#examination_type').val()!= "")
{

    $.get('/add-eye-finding',
        {
          "opd_number": $('#opd_number').val(),
          "patient_id": $('#patient_id').val(),
          "examination_type": $('#examination_type').val(),
          "od_sphere": $('#od_sphere').val(),
          "od_cylinder":  $('#od_cylinder').val(),
          "od_axis":  $('#od_axis').val(),
          "od_h_prism": $('#od_h_prism').val(),
          "od_v_prism":  $('#od_v_prism').val(),
          "od_h_add":  $('#od_h_add').val(),
          "od_v_add": $('#od_v_add').val(),
          "od_h_pd":  $('#od_h_pd').val(),
          "od_v_pd":  $('#od_v_pd').val(),
          "os_sphere": $('#os_sphere').val(),
          "os_cylinder":$('#os_cylinder').val(),
          "os_axis":  $('#os_axis').val(),
          "os_h_prism": $('#os_h_prism').val(),
          "os_v_prism":  $('#os_v_prism').val(),
          "os_h_add":  $('#os_h_add').val(),
          "os_v_add": $('#os_v_add').val(),
          "os_h_pd":  $('#os_h_pd').val(),
          "os_v_pd":  $('#os_v_pd').val(),

          "vl_visual_ascuity":  $('#vl_visual_ascuity').val(),
          "vr_visual_ascuity":  $('#vr_visual_ascuity').val(),

          "od_sphere_auto":  $('#od_sphere_auto').val(),
          "od_cylinder_auto":  $('#od_cylinder_auto').val(),
          "od_axis_auto": $('#od_axis_auto').val(),
          "od_h_prism_auto":  $('#od_h_prism_auto').val(),
          "os_h_prism_auto":  $('#os_h_prism_auto').val(),
           "os_sphere_auto":  $('#os_sphere_auto').val(),
          "os_cylinder_auto":  $('#os_cylinder_auto').val(),
          "os_axis_auto": $('#os_axis_auto').val(),
         
          "lens_type":        $('#lens_type').val(),
          "lens_color":        $('#lens_color').val(),
          "lens_style":        $('#lens_style').val(),
          "lens_power":        $('#lens_power').val(),
          "rim_type":        $('#rim_type').val(),
          "lens_remark":        $('#lens_remark').val(),
          "lens_index":        $('#lens_index').val(),
          "lens_treatment":  $('#lens_treatment').val()

           

        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {

          sweetAlert("Refraction Examination Findings has been added successfully!");
          //sweetAlert("Complaint has been added!");
          //$('#new-complaint').modal('toggle')
          //loadComplaints();
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
  function deletedrug(id)
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

    $.get('/add-complaint',
        {
          "opd_number": $('#opd_number').val(),
          "complaint": $('#complaint').val(),
          "com_period": $('#com_period').val(),
          "com_span":  $('#com_span').val(),
          "com_remark":  $('#com_remark').val()                      
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

   //alert($('#patient_id').val());

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

    $.get('/add-procedure',
        {
          "patient_id": $('#patient_id').val(),
          "opd_number": $('#opd_number').val(),
          "accounttype": $('#accounttype').val(),
          "procedure":  $('#procedure').val(),
          "quantity" : $('#procedure_quantity').val(),
          "discount" : $('#procedure_discount').val(),
          "remark":      $('#procedure_remark').val(),
          "fullname":   $('#fullname').val()                      
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
    {sweetAlert("Please select a Procedure/ and enter quantity!");}
}

function addFurtherProcedure()
{
if($('#further_procedure').val()!= "")
{

    $.get('/add-future-procedure',
        {
          "patient_id": $('#patient_id').val(),
          "opd_number": $('#opd_number').val(),
           "accounttype": $('#accounttype').val(),
          "procedure":  $('#further_procedure').val(),
          "procedure_quantity":  $('#procedure_quantity').val(),
          "tooth":      $('#further_tooth').val(),
          "remark":      $('#further_tooth').val(),
          "fullname":   $('#fullname').val()                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          //sweetAlert("Procedure added!");
           //$('#new-procedure').modal('toggle')
          loadfuturePlan();
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

function addNote()
{
if($('#complaint').val()!= "")
{

  //alert($('#editor').html());
    $.get('/add-note',
        {
          // Chief Complaint & HPI
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

function addDiagnosis()
{
if($('#diagnosis').val()!= "")
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

function addHistory()
{
if($('#history').val()!= "")
{

    $.get('/add-history',
        {
          "patient_id": $('#patient_id').val(),
          "opd_number": $('#opd_number').val(),
          "history": $('#history').val(),
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
            $('#drugTable tbody').append('<tr><td>'+ value['drug_quantity'] +'</td><td>'+ value['drug_name'] +'</td><td>'+ value['drug_application'] +'</td><td>'+ value['drug_cost'] +'</td><td><a a href="#"><i onclick="removeMedication('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
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

    function removeAssessment(id,name)
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
            $('#vitalTable tbody').append('<tr><td>'+ value['created_on'] +'</td><td>'+ value['weight'] +'</td><td>'+ value['height'] +'</td><td>'+ value['weight'] / (value['height'] * value['height']) + (value['bmi_status'] == "Normal" ? '<span class="label label-success btn-rounded">'+ value['bmi_status'] +'</span>' :  '<span class="label label-danger btn-rounded">'+ value['bmi_status'] +'</span>' ) +'</td><td>'+ value['temperature'] + (value['temp_status'] == "Normal" ? '<span class="label label-success btn-rounded">'+ value['temp_status'] +'</span>' :  '<span class="label label-danger btn-rounded">'+ value['temp_status'] +'</span>' ) +'</td><td>'+ value['sbp'] + '/' + value['dbp'] + (value['bp_status'] == "Normal" ? '<span class="label label-success btn-rounded">'+ value['bp_status'] +'</span>' :  '<span class="label label-danger btn-rounded">'+ value['bp_status'] +'</span>' ) +'</td><td>'+ value['pulse_rate'] +'</td><td>'+ value['respiration'] +'</td><td><a a href="#"><i onclick="removeVital('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }

function addOptha()
{
if($('#od_ocular_adnexae').val()!= "")
{

    $.get('/add-ocular-finding',
        {
          "opd_number": $('#opd_number').val(),
          "patient_id": $('#patient_id').val(),
          "od_ocular_adnexae": $('#od_ocular_adnexae').val(),
          "os_ocular_adnexae":  $('#os_ocular_adnexae').val(),
          "od_cornea":  $('#od_cornea').val(),
          "os_cornea": $('#os_cornea').val(),

          "od_ac_lens":  $('#od_ac_lens').val(),
          "os_ac_lens":  $('#os_ac_lens').val(),

          "od_pupil_lens":  $('#od_pupil_lens').val(),
          "os_pupil_lens":  $('#os_pupil_lens').val(),

          "od_ocular_lens":  $('#od_ocular_lens').val(),
          "os_ocular_lens":  $('#os_ocular_lens').val(),

          "od_iop":$('#od_iop').val(),
          "os_iop":  $('#os_iop').val(),

          "os_virteous": $('#os_virteous').val(),
          "od_virteous":  $('#od_virteous').val(),
          "od_c_d_ratio":  $('#od_c_d_ratio').val(),
          "os_c_d_ratio": $('#os_c_d_ratio').val(),
          "od_retina":$('#od_retina').val(),
          "os_retina":  $('#os_retina').val(),

          "os_visual_ascuity":$('#os_visual_ascuity').val(),
          "od_visual_ascuity":  $('#od_visual_ascuity').val(),


          "od_others": $('#od_others').val(),
          "os_others":  $('#os_others').val(),

           "os_conjunctiva_sclera":$('#os_conjunctiva_sclera').val(),
          "od_conjunctiva_sclera":  $('#od_conjunctiva_sclera').val(),





        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          sweetAlert("Ocular Examination Findings has been added successfully!");
          //$('#new-complaint').modal('toggle')
          //loadComplaints();
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


function setOcularNull()
{



          $('#od_ocular_adnexae').val('NAD');
          $('#os_ocular_adnexae').val('NAD');
          
          $('#od_cornea').val('NAD');
          $('#os_cornea').val('NAD');

          $('#od_ac_lens').val('NAD');
          $('#os_ac_lens').val('NAD');

          $('#od_pupil_lens').val('NAD');
          $('#os_pupil_lens').val('NAD');

          $('#od_ocular_lens').val('NAD');
          $('#os_ocular_lens').val('NAD');

          $('#od_iop').val('NAD');
          $('#os_iop').val('NAD');

          $('#os_virteous').val('NAD');
          $('#od_virteous').val('NAD');
          $('#od_c_d_ratio').val('NAD');
          $('#os_c_d_ratio').val('NAD');
          $('#od_retina').val('NAD');
          $('#os_retina').val('NAD');

          $('#os_visual_ascuity').val('NAD');
          $('#od_visual_ascuity').val('NAD');


          $('#od_others').val('NAD');
          $('#os_others').val('NAD');

          $('#os_conjunctiva_sclera').val('NAD');
          $('#od_conjunctiva_sclera').val('NAD');
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
          sweetAlert("Finding saved successfully!");
          loadAssessment();
        }
        else
        {
          sweetAlert("Finding failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please add a text!");}
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
            $('#procedureTable tbody').append('<tr><td>'+ value['is_billable'] +'</td><td>'+ value['procedure'] +'</td><td>'+ value['cost'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['status'] +'</td><td><a a href="#"><i onclick="removeprocedure('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }

     function loadfuturePlan()
   {
         
        
        $.get('/patient-procedure-plan',
          {
            "opd_number": $('#patient_id').val()
          },
          function(data)
          { 

            $('#furthertreatmentTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#furthertreatmentTable tbody').append('<tr><td>'+ value['procedure_quantity'] +'</td><td>'+ value['procedure'] +'</td><td>'+ value['cost'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['status'] +'</td><td>' + ( value['type'] == "Laboratory" ? '<a a href="/print-treatment-plan/'+value['visitid']+'">' : '<a a href="/print-treatment-plan/'+value['visitid']+'">' ) + '<i onclick="" class="fa fa-print"></i></a></td><td><a a href="#"><i onclick="removefurtherprocedure('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
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
            $('#historyTable tbody').append('<tr><td>'+ value['history'] +'</td><td><a a href="#"><i onclick="removeHistory('+value['id']+')" class="fa fa-trash-o"></i></a></td></tr>');
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


function removefurtherprocedure(id)
   {
     
          $.get('/delete-future-procedure',
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
              loadfuturePlan();
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
              sweetalert("Complaint removed!");
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

