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
                    <a href="#" class="btn btn-rounded btn-sm btn-info"><i class="fa fa-fw fa-user"></i> {{ $patients[0]->accounttype }}</a>
                    <a href="#" class="btn btn-rounded btn-sm btn-primary"><i class="fa fa-fw fa-home"></i> {{ $patients[0]->insurance_company }}</a>
                   
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
                             <input type="hidden" id="accounttype" name="accounttype" value="{{ $patients[0]->accounttype }}">
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
                          <li class="list-group-item">
                          @if($triage)
                            <span class="pull-right"> @if($triage->weight==0)  @else {{ $triage->weight/($triage->height*$triage->height) }} @endif</span>
                            @else
                             <span class="pull-right"> 0 </span>
                          @endif
                            BMI
                          </li>
                          <li class="list-group-item">
                           @if($triage)
                            <span class="pull-right">{{ $triage->temperature }} (°C)</span>
                            @else
                             <span class="pull-right"> 0 </span>
                          @endif
                            Temp.
                          </li>
                        </ul>
                          <br>
                     
                          <div>
                          
                           <input type="hidden" id="opd_number" name="opd_number" value="{{ $visit_details->opd_number }}">
                           <input type="hidden" id="fullname" name="fullname" value="{{ $visit_details->name }}">
                            <input type="hidden" id="patient_id" name="patient_id" value="{{ $visit_details->patient_id }}">

                          <br>
                          </div> 

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
                     
                        <li class=""><a href="#review-complaint" data-toggle="tab"><i class="fa fa-meh-o text-default"></i> Complaint </a></li>
                        <li class=""><a href="#review-history" data-toggle="tab"><i class="fa fa-comments text-default"></i> Patient History </a></li>
                        <li class=""><a href="#review-investigation" data-toggle="tab"><i class="fa fa-film text-default"></i> Lab / Investigations </a></li>
                        <li class=""><a href="#review-diagnosis" data-toggle="tab"><i class="fa fa fa-legal (alias) text-default"></i> Provisional Diagnosis / Assesment </a></li> 
                        <li class=""><a href="#review-procedure" data-toggle="tab"><i class="fa fa-gears (alias) text-default"></i> Procedures </a></li>
                        <li class=""><a href="#review-medication" data-toggle="tab"><i class="fa fa-flask text-default"></i> Medication </a></li>
                         <li class=""><a href="#review-plan" data-toggle="tab"><i class="fa fa-lightbulb-o text-default"></i> Treatment Plan </a></li> 
                         <li class=""><a href="#review-documents" data-toggle="tab"><i class="fa fa-folder text-default"></i> Documents </a></li> 
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
                           <select id="investigation" name="investigation" rows="3" tabindex="1" data-placeholder="drug name" style="width:100%">
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

                   <div class="tab-pane" id="review-history">
                                         <section class="panel panel-default">
                      <div class="panel-body">

                    {{-- <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <select id="history" name="history" rows="3" tabindex="1" data-placeholder="drug name" style="width:100%">
                           <option value="">-- Nothing selected --</option>
                          @foreach($histories as $history)
                        <option value="{{ $history->type }}">{{ $history->type }}</option>
                          @endforeach
                        </select>         
                          </div>
                        </div> --}}

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

                   <div class="tab-pane active" id="review-complaint">
                          <section class="panel panel-default">
                      <div class="panel-body">
                          

                        <label class="badge bg-default">Chief Complaints</label> 
                        <div class="form-group pull-in clearfix">

                
                           <div class="col-sm-4">
                              <label>Complaint</label> 
                        <select name="complaint[]" id="complaint" style="width:100%" multiple data-placeholder=""  >
                          @foreach($complaints as $complaint)
                        <option  value="{{ $complaint->type }}">{{ $complaint->type }}</option>
                          @endforeach
                            </select>    
                          </div>

                         
                          <div class="col-sm-4">
                            <label>Since</label> 
                            <div class="form-group{{ $errors->has('com_period') ? ' has-error' : ''}}">
                             <select id="com_period" name="com_period" rows="1" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value="">-- Not set --</option>
                          @foreach($complaintperiods as $complaintperiod)
                            <option value="{{ $complaintperiod }}">{{  $complaintperiod }}</option>
                          @endforeach 
                        </select>            
                           @if ($errors->has('com_period'))
                          <span class="help-block">{{ $errors->first('com_period') }}</span>
                           @endif    
                          </div>
                          </div>
                           <div class="col-sm-4">
                            <label>Duration</label> 
                            <div class="form-group{{ $errors->has('com_span') ? ' has-error' : ''}}">
                             <select id="com_span" name="com_span" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value="">-- Not set --</option>
                      @foreach($periods as $period)
                            <option value="{{ $period->type }}">{{ $period->type }}</option>
                          @endforeach 
                        </select>            
                           @if ($errors->has('com_span'))
                          <span class="help-block">{{ $errors->first('com_span') }}</span>
                           @endif    
                          </div>
                          </div>
                          </div>


                     {{--    <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label><span class="badge bg-default"> History Of Presenting Complaints</span></label> 
                            <div class="form-group{{ $errors->has('com_remark') ? ' has-error' : ''}}">
                            <textarea type="text" rows="10" class="form-control" id="com_remark" name="com_remark" value="{{ Request::old('com_remark') ?: '' }}"></textarea>   
                           @if ($errors->has('com_remark'))
                          <span class="help-block">{{ $errors->first('com_remark') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div> --}}
                        <br>
                        

                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                        <label class="badge bg-default">History of Presenting Complaint</label> 
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
                        <div id="editor" name="editor" class="form-control" style="overflow:scroll;height:150px;max-height:150px" contenteditable="true"></div>
                      </div>
                    </div>


                    <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label class="badge bg-default">On Direct Question</label> 
                            <div class="form-group{{ $errors->has('directquestion') ? ' has-error' : ''}}">
                            <textarea type="text" rows="3" class="form-control" id="directquestion" name="directquestion" value="{{ Request::old('directquestion') ?: '' }}"></textarea>   
                           @if ($errors->has('directquestion'))
                          <span class="help-block">{{ $errors->first('directquestion') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addComplaint()" class="btn btn-success btn-s-xs">Add Complaint</button>
                      </footer>
                    </section>


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
 
 

                    <div class="tab-pane" id="review-diagnosis">
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
                    <section class="panel panel-default">
                      <div class="panel-body">
                 
                      <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                          <div class="input-group m-b">
                           <select id="medication" name="medication" rows="3" tabindex="1" data-placeholder="drug name" style="width:100%">
                           <option value="">-- Select drug from pharmacy--</option>
                          @foreach($drugs as $drugs)
                        <option value="{{ $drugs->name }}">{{ $drugs->name }}</option>
                          @endforeach
                        </select>  <div class="input-group-btn">
                           <a href="#new-medication" class="bootstrap-modal-form-open" data-toggle="modal" ><button  class="btn btn-sm btn-default" type="button"><i class="fa fa-plus-circle"></i></button></a>
                        </div>     
                        </div>   
                          </div>
                        </div>



                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-3">
                            <label>Quantity</label> 
                           <input type="number" class="form-control" class="text-success" id="drug_quantity"  value="{{ Request::old('drug_quantity') ?: '' }}"  name="drug_quantity">
                          @if ($errors->has('drug_quantity'))
                          <span class="help-block">{{ $errors->first('drug_quantity') }}</span>
                           @endif   
                          </div>


                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('drug_dosage') ? ' has-error' : ''}}">
                            <label>Dosage</label>
                            <select id="drug_dosage" name="drug_dosage" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          @foreach($dosage as $dosage)
                        <option value="{{ $dosage->type }}">{{ $dosage->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('drug_dosage'))
                          <span class="help-block">{{ $errors->first('drug_dosage') }}</span>
                           @endif    
                          </div>   
                        </div>
                            
                         {{--
                         <div class="col-sm-3">
                            <label>Application</label> 
                          <select id="drug_application" name="drug_application" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          @foreach($application as $application)
                        <option value="{{ $application->type }}">{{ $application->type }}</option>
                          @endforeach
                        </select> 
                           @if ($errors->has('drug_application'))
                          <span class="help-block">{{ $errors->first('drug_application') }}</span>
                           @endif    
                          </div>

                            <div class="col-sm-3">
                            <label>Frequency</label> 
                          <select id="drug_frequency" name="drug_frequency" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          @foreach($frequency as $frequency)
                        <option value="{{ $frequency->type }}">{{ $frequency->type }}</option>
                          @endforeach
                        </select> 
                           @if ($errors->has('drug_frequency'))
                          <span class="help-block">{{ $errors->first('drug_frequency') }}</span>
                           @endif    
                          </div> --}}

                        </div>
                         <div class="form-group pull-in clearfix">
                        <div class="col-sm-3">
                            <label>Number of Day(s)</label> 
                           <input type="number" class="form-control" id="drug_days"  value="{{ Request::old('drug_days') ?: '' }}"  name="drug_days">
                          @if ($errors->has('drug_days'))
                          <span class="help-block">{{ $errors->first('drug_days') }}</span>
                           @endif   
                          </div>

                           <div class="col-sm-3">
                            <label>Period</label> 
                          <select id="drug_span" name="drug_span" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          @foreach($periods as $period)
                        <option value="{{ $period->type }}">{{ $period->type }}</option>
                          @endforeach
                        </select> 
                           @if ($errors->has('drug_span'))
                          <span class="help-block">{{ $errors->first('drug_span') }}</span>
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
                              <th>Unit Cost</th>
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
                           <select id="procedure" name="procedure" rows="3" tabindex="1" data-placeholder="drug name" style="width:100%">
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
                            <label class="badge bg-default">Assessment</label> 
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
                        <button type="button" onclick="addAssessment()" class="btn btn-success btn-s-xs">Add Assessment</button>
                      </footer>
                    </section>

                    <img src="/images/439190.svg" width="10%" align="right"> 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Assessment History</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="assessmentTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                              <th>Assessment</th>
                              <th>Comment</th>
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
                          <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>File</th>
                            <th>Comment</th>
                            <th>Added</th>
                          </tr>
                        </thead>
                        <tbody>
                        
                        @foreach($images as $image)
                         <tr>
                        <td>{{ $image->filename }}</td>
                        <td>{{ $image->created_by }}</td>
                        <td>{{ $image->created_on }}</td>
                        <td>
                            <a href="{!! '/uploads/images/'.$image->filepath !!}" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-eye"></i></a>
                        </td>
                         <td>
                            <a href="#" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                        </td>
                          
                        </tr>
                        @endforeach

                        </tbody>
                      </table>
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

      <div class="modal fade" id="new-investigation" style="height:700px width=100%">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add Investigation</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" action="/add-new-investigation" method="post" class="panel-body wrapper-lg">
                           @include('doctor/investigation')
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


      <div class="modal fade" id="new-history" style="height:700px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add History</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" class="panel-body wrapper-lg">
                           @include('doctor/history')
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


 <div class="modal fade" id="new-complaint" style="height:700px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add Complaint</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" class="panel-body wrapper-lg">
                           @include('doctor/complaint')
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

    <div class="modal fade" id="new-procedure" style="height:700px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add Procedure</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" class="panel-body wrapper-lg">
                           @include('doctor/procedure')
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


<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


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
    $('#new-diagnosis select[name="diagnosis_category"]').select2();     
    $('#new-diagnosis select[name="diagnosis"]').select2();  
    $('#complaint').select2();
    $('#procedure').select2();
    $('#history').select2();

    $('#medication').select2();
    $('#drug_dosage').select2();
    $('#drug_span').select2();

    $('#social_history').select2();
    $('#medical_history').select2();
    $('#family_history').select2();
    $('#vaccinations_history').select2();
    $('#drug_history').select2();

  });
</script>



  <script type="text/javascript">

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
    $.get('/add-complaint',
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
          "code":       $('#code').val(),
          "fullname":  $('#fullname').val()                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          //sweetAlert("Diagnosis added!");
           $('#new-diagnosis').modal('toggle')
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
            $('#DocumentTable tbody').append('<tr><td>'+ value['filename'] +'</td><td>'+ value['original_name'] +'</td><td>'+ value['size'] +'</td><td>'+ value['created_on'] +'</td><td><a a href="/uploads/images/'+ value['filepath'] +'"><i onclick="/uploads/images/'+ value['filepath'] +'" class="fa fa-eye"></i></a></td><td><a a href="#"><i onclick="deleteDocument(\''+value['id']+'\',\''+value['filename']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
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
            $('#drugTable tbody').append('<tr><td>'+ value['drug_quantity'] +'</td><td>'+ value['drug_name'] +'</td><td>'+ value['drug_cost'] +'</td><td><a a href="#"><i onclick="removeMedication(\''+value['id']+'\',\''+value['drug_name']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
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
            $('#planTable tbody').append('<tr><td>'+ value['plan'] +'</td><td>'+ value['action'] +'</td><td>'+ value['date'] +'</td><td><a a href="#"><i onclick="removePlan(\''+value['id']+'\',\''+value['plan']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
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
            $('#assessmentTable tbody').append('<tr><td>'+ value['assessment'] +'</td><td>'+ value['created_by'] +'</td><td>'+ value['created_on'] +'</td><td><a a href="#"><i onclick="removeAssessment(\''+value['id']+'\',\''+value['assessment']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
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
            $('#complaintTable tbody').append('<tr><td>'+ value['complaint'] +'</td><td>'+ value['period'] +' '+ value['span'] +' '+ value['remark'] +'</td><td>'+ value['date'] +'</td><td><a a href="#"><i onclick="removecomplain(\''+value['id']+'\',\''+value['complaint']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
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
            $('#vitalTable tbody').append('<tr><td>'+ value['weight'] +'</td><td>'+ value['height'] +'</td><td>'+ value['pulse_rate'] +'</td><td>'+ value['blood_pressure'] +'</td><td>'+ value['temperature'] +'</td><td>'+ value['respiration'] +'</td><td>'+ value['waist_circumference'] +'</td><td>'+ value['hip_circumference'] +'</td><td><a a href="#"><i onclick="removecomplain(\''+value['id']+'\',\''+value['complaint']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
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
           $('#investigationsTable tbody').append('<tr><td>'+ value['investigation'] +'</td><td>'+ value['cost'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['status'] +'</td><td><a a href="/test-collection-slip/'+value['visitid']+'"><i onclick="" class="fa fa-print"></i></a></td><td><a a href="/laboratory-results/'+value['visitid']+'"><i onclick="" class="fa fa-eye"></i></a></td><td><a a href="#"><i onclick="removeinvestigation(\''+value['id']+'\',\''+value['investigation']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
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
            $('#diagnosisTable tbody').append('<tr><td>'+ value['diagnosis'] +'</td><td>'+ value['date'] +'</td><td><a a href="#"><i onclick="removediagnosis(\''+value['id']+'\',\''+value['diagnosis']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
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
            $('#procedureTable tbody').append('<tr><td>'+ value['procedure'] +'</td><td>'+ value['cost'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['status'] +'</td><td><a a href="#"><i onclick="removeprocedure(\''+value['id']+'\',\''+value['procedure']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
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
            $('#historyTable tbody').append('<tr><td>'+ value['medical_history'] +'</td><td>'+ value['family_history'] +'</td><td>'+ value['social_history'] +'</td><td>'+ value['vaccinations_history'] +'</td><td><a a href="#"><i onclick="removeHistory(\''+value['id']+'\',\''+value['history']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
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
            $('#ImageTable tbody').append('<tr><td>'+ value['diagnosis'] +'</td><td>'+ value['remark'] +'</td><td>'+ value['date'] +'</td><td><a a href="#"><i onclick="removediagnosis(\''+value['id']+'\',\''+value['diagnosis']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }




  function removeMedication(id,name)
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

    function removeHistory(id,name)
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




   function removediagnosis(id,name)
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


function removeinvestigation(id,name)
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

   function removePlan(id,name)
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


function removeprocedure(id,name)
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

   function removecomplain(id,name)
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




