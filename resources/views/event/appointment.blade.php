
@extends('layouts.default')
@section('content')
        <!-- /.aside -->
        <section id="content">
          <section class="vbox">
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Appointment</li>
              </ul>
              <div class="m-b-md">
                <h3 class="font-thin">Book Appointment</h3>
              </div>
              <div class="panel panel-default">
                <div class="wizard clearfix" id="form-wizard">
                  <ul class="steps">
                    <li data-target="#step1" class="active"><span class="badge badge-info">1</span>Personal Information</li>
                    <li data-target="#step2"><span class="badge">2</span>Appointment Information</li>
                    <li data-target="#step3"><span class="badge">3</span>Review and Submit</li>
                  </ul>

                  <div class="actions m-t">
                        <button type="button" class="btn btn-default btn-xs btn-prev" disabled="disabled">Prev</button>
                        <button type="button" class="btn btn-default btn-xs btn-next" data-last="Finish">Next</button>
                      </div>
                </div>
                <div class="step-content">
                    <form  class="bootstrap-modal-form" method="post" action="/create-event-new" class="panel-body wrapper-lg">
                    <div class="step-pane active" id="step1">
                      <p>Fullname</p>
                      <input type="text" name="name" id="name" class="form-control" data-trigger="change" data-required="true" data-type="url" placeholder="">
                    

                          <p class="m-t">Gender</p>
                           <select id="gender" name="gender" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control sm-3">
                           <option value=""></option>
                         @foreach($genders as $gender)
                        <option value="{{ $gender->type }}">{{ $gender->type }}</option>
                          @endforeach 
                        </select>                         
                          
                   
                       
                         <p class="m-t">Date of Birth</p>
                        <div class="input-group">
                        <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="Select your time"  value="">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>

                      <p class="m-t">Phone Number</p>
                      <input type="text" class="form-control" name="phonenumber" id="phonenumber" data-trigger="change" data-required="true"  placeholder="">

                      <p class="m-t">Email</p>
                      <input type="text" class="form-control" name="email" id="email" data-trigger="change" data-required="true" data-type="email" placeholder="">
                    </div>
                    <div class="step-pane" id="step2">
                     <div class="form-group{{ $errors->has('title') ? ' has-error' : ''}}">
                            <label>Service Type</label>
                             <select id="title" name="title" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                         @foreach($servicetype as $servicetype)
                        <option value="{{ $servicetype->type }}">{{  ucwords(strtolower($servicetype->type)) }}</option>
                          @endforeach 
                        </select>         
             </div>  
              <div class="form-group{{ $errors->has('referal_doctor') ? ' has-error' : ''}}">
                            <label>Doctor</label>
                            <select id="referal_doctor" name="referal_doctor" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control" >
                          @foreach($doctors as $doctor)
                        <option value="{{ $doctor->name }}">{{ $doctor->name }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('referal_doctor'))
                          <span class="help-block">{{ $errors->first('referal_doctor') }}</span>
                           @endif    
                          </div> 
                    <div class="form-group @if($errors->has('time')) has-error @endif">
        <label for="time">Time</label>
        <div class="input-group">
          <input type="text" class="form-control" name="time" id="time" placeholder="Select your time" value="{{ old('time') }}">
          <span class="input-group-addon">
            <span class="fa fa-calendar"></span>
                    </span>
        </div>
        @if ($errors->has('time'))
          <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
          {{ $errors->first('time') }}
          </p>
        @endif
      </div>
                    </div>
                    <div class="step-pane" id="step3">
<section class="panel panel-default">
                    <header class="panel-heading">
                      <div class="input-group text-sm">

                      <h3 class="font-thin">When you register on this site, Gilead Medical Center create a record that help us communicate with you. Please review and agree to the following guidelines for registered users.</h3>
                      </div>
                    </header>
                    <ul class="list-group alt">
                      <li class="list-group-item">
                       <div class="media">
                        
                          <div class="pull-right text-muted m-t-sm">
                            <i class="fa fa-male"></i>
                          </div>
                          <div class="media-body">
                            <div><a href="#">Users must be at least 18 years old.</a></div>
                            
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="media">
                     
                          <div class="pull-right text-muted m-t-sm">
                              <i class="fa fa-building"></i>
                          </div>
                          <div class="media-body">
                            <div><a href="#">Users will use the services of this website for their intended purposes, specifically, to find out about the hospital, inquire about and plan for healthcare at our facilities.</a></div>
                            
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="media">
                         
                          <div class="pull-right text-muted m-t-sm">
                              <i class="fa fa-eye-slash"></i>
                          </div>
                          <div class="media-body">
                            <div><a href="#">Users will not transmit material that is unlawful, obscene, defamatory, threatening, abusive, or slanderous. </a></div>
                            <small class="text-muted"></small>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="media">
                         
                          <div class="pull-right text-danger m-t-sm">
                            <i class="fa fa-exclamation-circle"></i>
                          </div>
                          <div class="media-body">
                            <div><a href="#">Users will not impersonate another person or create any false patient information or health record for themselves or others. </a></div>
                            <small class="text-muted"></small>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="media">
                        
                          <div class="pull-right text-muted m-t-sm">
                            <i class="fa fa-meh-o"></i>
                          </div>
                          <div class="media-body">
                            <div><a href="#">Users will not hold Gilead Medical Center liable for damages because of any services or information provided by this website. The sole remedy for dissatisfaction with the services of this site is to stop using the service. </a></div>
                            <small class="text-muted"></small>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="media">

                          <div class="pull-right text-muted m-t-sm">
                            <i class="fa fa-gavel"></i>
                          </div>
                          <div class="media-body">
                            <div><a href="#">Any dispute or claim (including injury claims) related to healthcare services you receive from Gilead Medical Center that is not resolved by mutual agreement is subject to the exclusive jurisdiction of the appropriate court in Ghana. </a></div>
                            <small class="text-muted"></small>
                          </div>
                        </div>
                      </li>

                      <li class="list-group-item">
                        <div class="media">
                         
                          <div class="pull-right text-muted m-t-sm">
                            <i class="fa fa-money"></i>
                          </div>
                          <div class="media-body">
                            <div><a href="#"> The medical information and any estimated costs supplied are subject to change without notice due to a change of medical condition or unforeseen factors. </a></div>
                            <small class="text-muted"></small>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </section>


                    <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Save Appointment</button>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </footer>
                    </div>                
                  </form>
                  


                 
                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      @stop

       <script src="{{ asset('/event_components/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {

             
    $('#title').select2();

  });
</script>

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