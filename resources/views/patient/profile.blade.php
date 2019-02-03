@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
              <p>{{ $patients->fullname }}'s Facesheet</p>

              <div class="btn-group pull-right">
              <p>
                <a href="/event-calendar"  class="btn btn-rounded btn-sm btn-danger"><i class="fa fa-spin fa-spinner hide show inline" id="spin"></i> Schedule Appointment  </a>
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
                          <a href="/images/{{ $patients->image }}" class="pull-left thumb m-r">
                            <img src="/images/{{ $patients->image }}" class="img-circle">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs">{{ $patients->fullname }}</div>
                            <small class="text-muted"><i class="fa fa-map-marker"></i>ID :{{ $patients->patient_id }}</small>
                             <input type="hidden" id="get_patient_id" name="get_patient_id" value="{{ $patients->patient_id }}">
                          </div>                
                        </div>
                        <div class="panel wrapper panel-success">
                          <div class="row">
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $patients->gender }}</span>
                                <small class="text-muted">Gender</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $patients->date_of_birth->age }}</span>
                                <small class="text-muted">Age</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $patients->civil_status }}</span>
                                <small class="text-muted">Status</small>
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="btn-group btn-group-justified m-b">
                          <a href="whatsapp://tel:3216541234" class="btn btn-primary btn-rounded">
                            <span class="text">
                              <i class="fa fa-eye"></i> Whatsapp
                            </span>
                            <span class="text-active">
                              <i class="fa fa-eye-slash"></i> Call
                            </span>
                          </a>
                          <a href="tel:+23351448708" class="btn btn-dark btn-rounded" data-loading-text="Connecting">
                            <i class="fa fa-comment-o"></i> SMS
                          </a>
                        </div>
                        <div>
                          <small class="text-uc text-xs text-muted">Mobile</small>
                          <p>{{ $patients->mobile_number }}</p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted">Address</small>
                          <p>{{ $patients->postal_address }}</p>
                          <div class="line"></div>
                          
                          <small class="text-uc text-xs text-muted">Email</small>
                          <p class="m-t-sm">
                            <a href="#" class="btn btn-rounded btn-twitter btn-icon"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="btn btn-rounded btn-facebook btn-icon"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="btn btn-rounded btn-gplus btn-icon"><i class="fa fa-google-plus"></i></a>
                          </p>
                          
                          </div>
                          <video autoplay  width="200" height="200">
                          <source src="/images/AboutUs@2x.mp4" type="video/mp4">
                          </video>
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                         <li class=""><a href="#information" data-toggle="tab">Demographics</a></li>
                         <li class="active"><a href="#consultations" data-toggle="tab">Visits</a></li>
                         <li class=""><a href="#procedures" data-toggle="tab">Vitals</a></li>
                         <li class=""><a href="#allergy" data-toggle="tab">Allergy</a></li> 
                         <li class=""><a href="#allergy" data-toggle="tab">Medications</a></li> 
                         <li class=""><a href="#statement" data-toggle="tab">Billing</a></li>
                         <li class=""><a href="#reminder" data-toggle="tab">Patient Reminders</a></li>
                        <li class=""><a href="#disclosure" data-toggle="tab">Disclosures</a></li>
                        <li class=""><a href="#amendment" data-toggle="tab">Amendments</a></li>
                         <li class=""><a href="#appointments" data-toggle="tab">Appointment</a></li>
                        <li class=""><a href="#documents" data-toggle="tab">Documents</a></li> 
                       
                        {{-- <li class=""><a href="#images" data-toggle="tab">Images</a></li> --}}
                        <span class="hidden-sm">.</span>
                        
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">

                        <div class="tab-pane" id="information">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Patient Info
                </header>
                <div class="panel-body">
                  <form class="form-horizontal" method="get">
                    <div class="form-group">
                      {{-- <label class="col-sm-2 control-label">Place of birth</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $patients->place_of_birth }}" class="form-control rounded">                        
                      </div>
                    </div>
                     <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Blood Group</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $patients->blood_group }}" class="form-control rounded">                        
                      </div>
                    </div> --}}
                    <div class="line line-dashed line-lg pull-in"></div>
                   <div class="form-group">
                      <label class="col-sm-2 control-label">Account Type</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $patients->accounttype }}" class="form-control rounded">                        
                      </div>
                    </div>
                     <div class="line line-dashed line-lg pull-in"></div>
                <div class="form-group">
                      <label class="col-sm-2 control-label">ID Type</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $patients->id_type }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">ID Number</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $patients->id_number }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div> 
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Occupation</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $patients->occupation }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Nationality</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $patients->nationality }}" class="form-control rounded">                        
                      </div>
                    </div>
                    

                    </form>
                    </div>
                    </section>

                        <section class="panel panel-default">
                        <header class="panel-heading font-bold">
                          Address
                        </header>
                        <div class="panel-body">
                          <form class="form-horizontal" method="get">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Residential</label>
                              <div class="col-sm-10">
                                <input type="text" readonly="true" value="{{ $patients->residential_address }}" class="form-control rounded">                        
                              </div>
                            </div>
                             <div class="form-group">
                              <label class="col-sm-2 control-label">Office</label>
                              <div class="col-sm-10">
                                <input type="text" readonly="true" value="{{ $patients->postal_address }}" class="form-control rounded">                        
                              </div>
                            </div>
                            </form>
                            </div>
                    </section>


                    <section class="panel panel-default">
                        <header class="panel-heading font-bold">
                          Insurance
                        </header>
                        <div class="panel-body">
                          <form class="form-horizontal" method="get">
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Provider</label>
                              <div class="col-sm-10">
                                <input type="text" readonly="true" value="{{ $patients->insurance_company }}" class="form-control rounded">                        
                              </div>
                            </div>
                             <div class="form-group">
                              <label class="col-sm-2 control-label">Policy Number</label>
                              <div class="col-sm-10">
                                <input type="text" readonly="true" value="{{ $patients->insurance_id }}" class="form-control rounded">                        
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Plan Name</label>
                              <div class="col-sm-10">
                                <input type="text" readonly="true" value="{{ $patients->insurance_cover }}" class="form-control rounded">                        
                              </div>
                            </div>
                             <div class="form-group">
                              <label class="col-sm-2 control-label">Eligibility</label>
                              <div class="col-sm-10">
                                <input type="text" readonly="true" value="{{ $patients->insurance_eligibility }}" class="form-control rounded">                        
                              </div>
                            </div>
                             <div class="form-group">
                              <label class="col-sm-2 control-label">Subscriber Employer</label>
                              <div class="col-sm-10">
                                <input type="text" readonly="true" value="{{ $patients->company }}" class="form-control rounded">                        
                              </div>
                            </div>
                            </form>
                            </div>
                    </section>
                          </ul>
                        </div>


                        <div class="tab-pane active" id="consultations">
                        
                        <section class="panel panel-default">
                      <form  class="bootstrap-modal-form" method="post" data-validate="parsley" action="/create-opd" class="panel-body wrapper-lg">

                    <header class="panel-heading bg-light">
                      <ul class="nav nav-tabs pull-left">
                        
                        <li><a href="#profile-1" data-toggle="tab"><i class="fa  fa-folder-open-o text-default"></i> General Information</a></li>
                        
                      </ul>
                      <span class="hidden-sm">.</span>
                    </header>
                    <div class="panel-body">
                      <div class="tab-content">              
                       
                        <div class="tab-pane active" id="profile-1">


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('accounttype') ? ' has-error' : ''}}">
                            <label>Billing Account</label>
                            <select id="accounttype" name="accounttype" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                           <option value=""></option>
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
                            <label>Authorization / Loyalty Code</label> 
                            <div class="form-group{{ $errors->has('authorization_code') ? ' has-error' : ''}}">
                            <select id="authorization_code" name="authorization_code" onchange="stickerexiststatus()" rows="3" tabindex="1" data-placeholder="" style="width:100%">
                           <option value="">-- select from here --</option>
                          @foreach($stickers as $sticker)
                        <option value="{{ $sticker->card_number }}"> {{ $sticker->card_number }}</option>
                          @endforeach
                        </select>    
                           @if ($errors->has('authorization_code'))
                          <span class="help-block">{{ $errors->first('authorization_code') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('visit_type') ? ' has-error' : ''}}">
                            <label>Visit Type</label>
                            <select id="visit_type" name="visit_type" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                             <option value=""> -- Select Visit Type -- </option>
                          @foreach($visittypes as $visittypes)
                        <option value="{{ $visittypes->type }}">{{ $visittypes->type }}</option>
                          @endforeach  
                        </select>         
                           @if ($errors->has('visit_type'))
                          <span class="help-block">{{ $errors->first('visit_type') }}</span>
                           @endif    
                          </div>   
                          </div>


                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('consultation_type') ? ' has-error' : ''}}">
                            <label>Consultation Type</label>
                            <select id="consultation_type" name="consultation_type" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                            <option value=""> -- Select Consultation -- </option>
                          @foreach($servicetype as $servicetype)
                        <option value="{{ $servicetype->type }}">{{ $servicetype->type }} </option>
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
                            <label>Location</label>
                            <select id="location" name="location" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          @foreach($branches as $branch)
                        <option value="{{ $branch->location }}">{{ $branch->location }}</option>
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
                            <select id="referal_doctor" name="referal_doctor" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%" >
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



                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('visit_type') ? ' has-error' : ''}}">
                            <label>Sensitivity</label>
                            <select id="sensitivity" name="sensitivity" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                         
                        <option value="Normal">Normal</option>
                        <option value="High">High</option>
                        <option value="High">Low</option>
                          
                        </select>         
                           @if ($errors->has('visit_type'))
                          <span class="help-block">{{ $errors->first('visit_type') }}</span>
                           @endif    
                          </div>   
                          </div>


                          <div class="col-sm-6">
                               <div class="form-group{{ $errors->has('referal_doctor') ? ' has-error' : ''}}">
                            <label>Issues (Injuries/Medical/Allergy)</label>
                            <select id="issues" name="issues" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%" >
                          <option value="None">None</option>
                          
                        </select>         
                           @if ($errors->has('referal_doctor'))
                          <span class="help-block">{{ $errors->first('referal_doctor') }}</span>
                           @endif    
                          </div> 
                          </div>   
                        </div>

                       

                      


                       

                        </div>

                    </div>

                    <input type="hidden" id="fullname" name="fullname" value="{{ $patients->fullname }}">
                     <input type="hidden" id="patient_id" name="patient_id" value="{{ $patients->patient_id }}">
                     <input type="hidden" name="_token" value="{{ Session::token() }}">



                      <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Create New Visit</button>
                        
                      </footer>
                      </form>

                       @if($patients->accounttype=='Private')
             {{--  <a href="#" class="btn btn-warning btn-s-md btn-lg pull-right">Total Charge : GHS {{ $payables }}</a>
                      <a href="#" class="btn btn-success btn-s-md btn-lg pull-right">Paid : GHS {{ $receivables }}</a> --}}
                      <a href="#" class="btn btn-danger btn-s-md btn-lg pull-left">Outstanding : GHS {{ number_format($outstanding, 1, '.', ',') }}</a>
                      @else
                      <li class="list-group-item">
                       <label>Dental Usage & Limit</label>
                        <div class="progress progress-sm m-t-sm">
                          <div class="progress-bar progress-bar-info" data-toggle="tooltip" data-original-title="10%" style="width: 10%"></div>
                        </div>
                        <label>Eye Usage & Limit</label>
                        <div class="progress progress-sm progress-striped  active">
                          <div class="progress-bar progress-bar-success" data-toggle="tooltip" data-original-title="30%" style="width: 30%"></div>
                        </div>
                        <label>ODP Usage & Limit</label>
                        <div class="progress progress-sm progress-striped">
                          <div class="progress-bar progress-bar-warning" data-toggle="tooltip" data-original-title="20%" style="width: 20%"></div>
                        </div>
                        <label>IPD Usage & Limit</label>
                        <div class="progress progress-sm progress-striped">
                          <div class="progress-bar progress-bar-danger" data-toggle="tooltip" data-original-title="10%" style="width: 10%"></div>
                        </div>
                      </li>
                      @endif

                  </section>


                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          @foreach($consultations as $consult)
                            @if($consult->referal_doctor != null)
                            <li class="list-group-item animated fadeInRightBig">
                              <a href="#" class="thumb-sm pull-left m-r-sm" data-toggle="class:show,hide">
                                <img src="/images/{{ $patients->image }}" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">{{ Carbon\Carbon::parse($consult->created_on)->diffForHumans() }}
                                @role(['Doctor','System Admin','Dentist'])
                              @if($consult->consultation_type=='DENTAL CONSULTATION')
                              <td><a href="/dental-review/{{ $consult->opd_number }}"  class="btn btn-rounded btn-sm btn-primary" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-stethoscope" data-toggle="tooltip" data-placement="top" title="" data-original-title="Consult"> </i> View </a></td>
                              

                              @elseif($consult->consultation_type=='DENTAL CONSULTATION FOLLOW UP')
                              <td><a href="/dental-review/{{ $consult->opd_number }}"  class="btn btn-rounded btn-sm btn-primary" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-stethoscope" data-toggle="tooltip" data-placement="top" title="" data-original-title="Consult"> </i> View </a></td>
                              

                              @elseif($consult->consultation_type=='OPHTHALMOLOGY CONSULTATION')
                              <td><a href="/ophthalmology-review/{{ $consult->opd_number }}" class="btn btn-rounded btn-sm btn-primary" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-stethoscope" data-toggle="tooltip" data-placement="top" title="" data-original-title="Consult"> </i> View </a></td>
                              
                              @elseif($consult->consultation_type=='ANTENATAL')
                              <td><a href="/antenatal-review/{{ $patient->opd_number }}" class="btn btn-rounded btn-sm btn-primary" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-stethoscope" data-toggle="tooltip" data-placement="top" title="" data-original-title="Consult"> </i> View </a></td>

                              @elseif($consult->visit_type=='Admission')
                              <td><a href="/consultation-ipd/{{ $consult->opd_number }}" class="btn btn-rounded btn-sm btn-primary" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-stethoscope" data-toggle="tooltip" data-placement="top" title="" data-original-title="Consult"> </i> View </a></td>

                              @else
                              <td><a href="/consultation/{{ $consult->opd_number }}" class="btn btn-rounded btn-sm btn-primary" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-stethoscope" data-toggle="tooltip" data-placement="top" title="" data-original-title="Consult"> </i> View </a></td>
                              @endif

                            @endrole
                                </small>
                                <strong class="block">{{ $consult->consultation_type }}</strong>
                                <small> {{ $consult->referal_doctor }}</small>
                                <br>
                                <small> Visit Type -  {{ $consult->visit_type }}</small>
                                 <br>
                                <small>Visit Number -  {{ $consult->opd_number }}</small>
                                 <br>
                                <small>Co Payer -  {{ $consult->care_provider }}</small>
                              </a>
                            </li>
                            @else
                            

                            @endif
                            @endforeach
                          </ul>
                        </div>
                     
                       
                        <div class="tab-pane" id="documents">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                                  <header class="panel-heading">
                      <a href="#attach_document" class="bootstrap-modal-form-open" data-toggle="modal"><span class="label bg-success pull-right">Add New Document</span></a>
                      
                    </header>
                          <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <tbody>
                        
                        @foreach($images as $keys => $image)
                   

                   <div class="col-md-3 col-sm-4 thumb-lg">
  
                    @if($image->mime == 'docx')
                   <a href="{!! '/uploads/images/'.$image->filepath !!}">
                              <img src="{!! '/images/ms_word.png' !!}" class="img-circle">
                              </a>  {{ $image->filename }}  <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                    @elseif($image->mime == 'pdf')
                     <a href="{!! '/uploads/images/'.$image->filepath !!}">
                              <img src="{!! '/images/pdf.png' !!}" class="img-circle">
                              </a>{{ $image->filename }}  <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                      @else 
                     <a href="{!! '/uploads/images/'.$image->filepath !!}">
                              <img src="{!! '/uploads/images/'.$image->filepath !!}" class="img-circle">
                              </a> {{ $image->filename }}  <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                    @endif        
                      </div>
                    @endforeach


                        </tbody>
                      </table>
                    </div>
                          </ul>
                        </div>



                        <div class="tab-pane" id="reminder">
                         
                      <section class="panel panel-default">
                    <header class="panel-heading">Patient Reminders</header>
                    <div class="panel-body">

                    <div class="col-lg-6">
                  <!-- .comment-list -->
                  <section class="comment-list block">

                    @foreach($reminders as $key => $memo)
                    <article id="comment-id-{{$key++}}" class="comment-item">
                      <a class="pull-left thumb-sm avatar">
                        <img src="/images/avatar_default.jpg" class="img-circle">
                      </a>
                      <span class="arrow left"></span>
                      <section class="comment-body panel panel-default">
                        <header class="panel-heading bg-white">
                          <a href="#">{{ $memo->created_by }}</a>
                         
                          <span class="text-muted m-l-sm pull-right">
                            <i class="fa fa-clock-o"></i>
                            {{ $memo->created_on }}
                          </span>
                        </header>
                        <div class="panel-body">
                          <div>{!! $memo->memo !!}</div>
                          <div class="comment-action m-t-sm">
                            <a href="#" data-toggle="class" class="btn btn-default btn-xs active">
                              <i class="fa fa-star-o text-muted text"></i>
                              <i class="fa fa-star text-danger text-active"></i> 
                              Like
                            </a>
                            <a href="#comment-form" class="btn btn-default btn-xs">
                              <i class="fa fa-mail-reply text-muted"></i> Reply
                            </a>

                            <a href="#comment-id-{{$key++}}" data-dismiss="alert" class="btn btn-default btn-xs">
                              <i class="fa fa-trash-o text-muted"></i> 
                              Remove
                            </a>
                          </div>
                        </div>
                      </section>
                    </article>
                    @endforeach
                    <!-- .comment-reply -->
                    
                    <!-- / .comment-reply -->
                  
                    
                    <!-- comment form -->
                    <article class="comment-item media" id="comment-form">
                      <a class="pull-left thumb-sm avatar"><img src="/images/avatar_default.jpg" class="img-circle"></a>
                      <section class="media-body">
                        <form action="" class="m-b-none">
                          <div class="input-group">
                            <input type="text" id="memotext" name="memotext" class="form-control" placeholder="Input your comment here">
                            <span class="input-group-btn">
                              <button class="btn btn-primary" type="button" onclick="savereminder()">POST</button>
                            </span>
                          </div>
                        </form>
                      </section>
                    </article>
                  </section>
                  <!-- / .comment-list -->
                </div>
                      

                    </div>
                   
                  </section>


                              </div>

{{--                          <div class="tab-pane" id="images">
                        <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                                  <header class="panel-heading">
                      <a href="#attach_document" class="bootstrap-modal-form-open" data-toggle="modal"><span class="label bg-info pull-right">Add New Image</span></a>
                      
                    </header>
                          <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>Image Name</th>
                            <th>Comment</th>
                            <th>Added</th>
                          </tr>
                        </thead>
                        <tbody>
                        
                        @foreach($images as $image)
                         <tr>
                          @if($image->mime == 'docx')
                         <td><div class="thumb-lg">
                            <a href="{!! '/uploads/images/'.$image->filepath !!}">
                              <img src="{!! '/images/ms_word.png' !!}" class="img-circle">
                              </a>
                            </div>
                          </td>
                          @elseif($image->mime == 'pdf')
                          <td><div class="thumb-lg">
                            <a href="{!! '/uploads/images/'.$image->filepath !!}">
                              <img src="{!! '/images/pdf.png' !!}" class="img-circle">
                              </a>
                            </div>
                          </td>
                          @else
                          <td><div class="thumb-lg">
                            <a href="{!! '/uploads/images/'.$image->filepath !!}">
                              <img src="{!! '/uploads/images/'.$image->filepath !!}" class="img-circle">
                              </a>
                            </div>
                          </td>
                          @endif
                        <td>{{ $image->filename }}</td>
                        <td>{{ $image->created_by }}</td>
                        <td>{{ $image->created_on }}</td>
                        <td>
                            <a href="{!! '/uploads/images/'.$image->filepath !!}" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-eye"></i></a>
                        </td>
                         <td>
                            <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                        </td>
                          
                        </tr>
                        @endforeach

                        </tbody>
                      </table>
                    </div>
                          </ul>
                        </div> --}}

                        <div class="tab-pane" id="allergy">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                           @foreach($allergies as $allergy)
                          
                            <li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="/images/{{ $patients->image }}" class="img-circle">
                              </a>
                              <a href="{{ $allergy->visitid }}"  class="clear">
                                <small class="pull-right">{{ $allergy->created_on }}</small>
                                <strong class="block"><label class="badge bg-info">{{ $allergy->allergy }}</label></strong>
                                {{-- <strong class="block"><label class="badge bg-danger">{{ $allergy->medical_history }}</label></strong>
                                 <strong class="block"><label class="badge bg-warning">{{ $allergy->family_history }}</label></strong>
                                   <strong class="block"><label class="badge bg-dark">{{ $allergy->social_history }}</label></strong>
                                    <strong class="block"><label class="badge bg-danger">{{ $allergy->drug_history }}</label></strong> --}}
                                <small>Examined by - {{ $allergy->created_by }}</small>
                                <br>
                                 <small>Visit Number - {{ $allergy->visitid }}</small>
                              </a>
                            </li>
                           
                            @endforeach
                          </ul>
                        </div>

                       <div class="tab-pane" id="procedures">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <img src="/images/139328.svg" width="7%" align="right"> 
        {{--                 <section class="panel panel-info">
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
 --}}

                    <div class="col-lg-12">
                  <section class="panel panel-default">
                    <header class="panel-heading">
                      Vital Chart Graph
                    </header>
                    <div class="panel-body text-center">
                      
                      <small class="text-muted block"></small>
                      <div class="inline">
                         
                      </div>                      
                    </div>
                    <div class="panel-footer"><small><a href="#" > % of change</a></small></div>
                  </section>
                </div>
                          </ul>
                        </div>



                    
                    <div class="tab-pane" id="statement">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <img src="/images/139328.svg" width="7%" align="right"> 
                        <section class="panel panel-info">
                                <header class="panel-heading font-bold">Patient Statement of Account</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>Visit No</th>
                            <th>Name</th>
                            <th>Copayer</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Invoice</th>
                            <th>Paid</th>
                            <th>Balance</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($statements as $bill )
                          <tr>

                          
                            
                            <td><a href="#" class="text-danger">IN-{{ $bill->visit_id }}</a></td>
                            <td>{{ ucwords(strtolower($bill->fullname)) }}</td>
                            <td>{{ $bill->copayer }}</td>
                            <td>{{ $bill->item_name }}</td>
                            <td>{{ $bill->date }}</td>
                            <td> {{ number_format($bill->total_cost , 1, '.', ',') }}</td>
                             <td>{{ number_format($bill->payments->sum('AmountReceived'), 1, '.', ',') }}</td>
                             <td>{{  number_format($bill->total_cost - $bill->payments->sum('AmountReceived') ,1, '.', ',') }}</td>
                            <td>
                             @if(($bill->total_cost - $bill->payments->sum('AmountReceived')) <= 1)
                              <a href="#" class="btn btn-s-md btn-success btn-rounded bootstrap-modal-form-open"  id="edit" name="edit" data-toggle="modal" alt="edit">Paid</a>

                             <td><a href="/billing-print/{{ $bill->visit_id }}" class="bootstrap-modal-form-open" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-print"></i></a></td> 
                             @else
                               <a href="#" class="btn btn-s-md btn-danger btn-rounded bootstrap-modal-form-open"  id="edit" name="edit" data-toggle="modal" alt="edit">Collect Payment</a>
                                
                                 <td>
                                 @if($bill->payercode!='Private')
                                 <a href="#" class="bootstrap-modal-form-open" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-print"></i></a>
                                  @else
                                   <a href="#" class="bootstrap-modal-form-open" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-print"></i></a>
                                   @endif
                                 </td> 

                                  @permission('edit-bill')
                                  <td><a href="#" onclick="excludefrombill('{{ $bill->id }}','{{ $bill->item_name }}')" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a></td> 
                                  @endpermission

                            @endif
                             </td>
                            
                          </tr>
                         @endforeach
                        </tbody>
 
 
                      </table>
                    </div>
                    </div>

                     
                    </section>
                          </ul>
                        </div>



                         <div class="tab-pane" id="appointments">
                          <section class="panel panel-default">
                    <div class="table-responsive">
                     
                        @if($events->count() > 0)
      <table class="table m-b-none text-sm" width="100%">

      <thead>
        <tr>
          <th>#</th>
          <th>Time In</th>
          <th>Patient</th>
           <th>Mobile Number</th>
          <th>Appointment</th>
          <th>Doctor to see</th>
          <th>From</th>
          <th>To</th>
          <th>Action</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php $i = 1;?>
      @foreach($events as $event)

         
<tr>
          <th scope="row">{{ $i++ }}</th>
           <td><a href="#">{{ $event->start_time->diffForHumans() }}</a></td>
          <td><a href="#">{{ ucwords(strtolower($event->name)) }}</a></td>
          <td><a href="#">{{ $event->mobile_number }}</a></td>
          <td><a href="#">{{ ucwords(strtolower($event->title)) }}</a></td>
          <td><a href="/doctor-appointments/{{ $event->doctor }}">{{ ucwords(strtolower($event->doctor)) }}</a></td>
          <td>{{ date("g:ia\, jS M Y", strtotime($event->start_time)) }}</td>
          <td>{{date("g:ia\, jS M Y", strtotime($event->end_time)) }}</td>
          <td>
           <div class="input-group-btn">
                            
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">{{ $event->status }} <span class="caret"></span>
                             </button>
                            <ul class="dropdown-menu pull-right">
                           
                            </ul>
            </div>
          </td>

           <td> <a href="http://web.whatsapp.com//send?text=Hello {{ ucwords(strtolower($event->name)) }} you have an appointment booked with {{ ucwords(strtolower($event->doctor)) }} at {{ date("g:ia\, jS M Y", strtotime($event->start_time)) }}. Please text YES to confirm.&phone=233{{$event->mobile_number}}" target="_new" class="btn btn-s-md btn-danger btn-rounded"  data-toggle="modal" alt="edit">Send Message</a> </td>


          <td><a href="/appointment-slip/{{ $event->id }}" id="print" name="print" data-toggle="modal" alt="edit"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print App Slip"></i></a>
          </td>
           <td><a href="#modal_check_in" class="bootstrap-modal-form-open" id="generate_visit" onclick="getDetails('{{ $event->patient_id }}')" name="generate_visit" data-toggle="modal" alt="edit"><i class="fa fa-book" data-toggle="tooltip" data-placement="top" title="" data-original-title="Check In"></i></a>
           </td>
           <td><a href="#" class="bootstrap-modal-form-open" onclick="deleteappointment('{{ $event->id }}','{{ $event->title }}')"  id="delete" name="delete" data-toggle="modal" alt="edit"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a>
           </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    @else
      <h2>No appointment found!</h2>
    @endif
                    </div>
                  </section>
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

<script type="text/javascript">
$(document).ready(function () {

$('#referal_doctor').select2();   
$('#sensitivity').select2();    
$('#issues').select2();     
$('#consultation_type').select2();
$('#location').select2();
$('#visit_type').select2();
$('#accounttype').select2();
$('#authorization_code').select2({
      tags: true
      });

loadVitals();


  });
</script>






<script>

function getDetails(acct_no)
{ 

  //alert(acct_no);
  $.get("/edit-patient",
          {"patient_id":acct_no},
          function(json)
          {

                $('#modal_check_in input[name="patient_id"]').val(json.patient_id);
                $('#modal_check_in input[name="fullname"]').val(json.fullname);
                $('#modal_check_in select[name="referal_doctor"]').select2();
                $('#modal_check_in select[name="consultant_doctor"]').select2();
                $('#modal_check_in select[name="department"]').select2();
               

          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}



function savereminder()
{

if($('#patient_id').val()!= "")
{

   // alert($('#liability_report').val());
    //tinyMCE.triggerSave();
     //alert($('#liability_report').val());

    $.get('/add-reminder',
        {

          "patient_id"     :$('#patient_id').val(),
          "memotext"       :$('#memotext').val()
          
        
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
         
         toastr.success("Reminder successfully saved!"); 
       
        }
        else
        {
         toastr.error("Reminder failed to save!"); 
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("No patient number has been generated yet!");}
         
}


  function deleteImage(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+name+" from the file list?",   
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
          $.get('/delete-image-request',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was removed from file list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to be removed from list.", "error");   
        } });

    
   }


   function stickerexiststatus()
    {

      $.get('/get-sticker-availability',
        {
          "authorization_code": $('#authorization_code').val()    

        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
           
         
        }
        else
        {
          $('#authorization_code').val('');
          sweetAlert("Authorization Code "+ $('#authorization_code').val() +" is not available in the system or has been used!");
          $('#authorization_code').val('');
        }
      });
                                        
        },'json');


    }




 function loadVitals()
   {

        $.get('/patient-vitals-all',
          {
            "patient_id": $('#get_patient_id').val()
          },
          function(data)
          { 

            $('#vitalTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#vitalTable tbody').append('<tr><td>'+ value['created_on'] +'</td><td>'+ value['weight'] +'</td><td>'+ value['height'] +'</td><td>'+ value['weight'] / (value['height'] * value['height']) + (value['bmi_status'] == "Normal" ? '<span class="label label-success btn-rounded">'+ value['bmi_status'] +'</span>' :  '<span class="label label-danger btn-rounded">'+ value['bmi_status'] +'</span>' ) +'</td><td>'+ value['temperature'] + (value['temp_status'] == "Normal" ? '<span class="label label-success btn-rounded">'+ value['temp_status'] +'</span>' :  '<span class="label label-danger btn-rounded">'+ value['temp_status'] +'</span>' ) +'</td><td>'+ value['sbp'] + '/' + value['dbp'] + (value['bp_status'] == "Normal" ? '<span class="label label-success btn-rounded">'+ value['bp_status'] +'</span>' :  '<span class="label label-danger btn-rounded">'+ value['bp_status'] +'</span>' ) +'</td><td>'+ value['pulse_rate'] +'</td><td>'+ value['respiration'] +'</td><td><a a href="#"><i onclick="removeVital(\''+value['id']+'\',\''+value['weight']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }

</script>

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
          <input type="file" class="form-control dropbox" width="500px" accept=".doc, .docx, .png, .jpeg, .pdf" height="40px" name="image" /><br>
           <div class="checkbox">
                          <label>
                            <input type="checkbox" name="check" unchecked ><a href="#" class="text-info">is Lab Document</a>
                          </label>
                        </div>
                           <div class="checkbox">
                          <label>
                            <input type="checkbox" name="check" unchecked ><a href="#" class="text-info">is Imaging Document</a>
                          </label>
                        </div>

          <input type="submit" name="submit"  class="btn btn-success btn-s-xs" value="upload" />
          <input type="hidden" name="_token" value="{{ Session::token() }}">
          <input type="hidden" name="selectedid" id="selectedid" value="{{ $patients->patient_id }}">
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

{{-- 
<div class="modal fade" id="modal_check_in" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">OPD Registration</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class="active"><a href="#equitytab" data-toggle="tab">Check-in Details</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" action="/create-opd" class="panel-body wrapper-lg">
                          @include('opd/checkin')
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

 --}}


