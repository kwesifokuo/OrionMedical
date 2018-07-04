@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
              <p><b>{{ $labrequest->investigation }} -RESULTS</b></p>
            </header>
            <section class="scrollable">
              <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="clearfix m-b">
                          <a href="/images/{{ $patients->image }}" class="thumb-lg">
                            <img src="/images/{{ $patients->image }}" class="img-circle">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs">{{ $patients->fullname }}</div>
                            <small class="text-muted"><i class="fa fa-map-marker"></i>ID :{{ $patients->patient_id }}</small>
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
                                <span class="m-b-xs h4 block">{{ $patients->blood_group }}</span>
                                <small class="text-muted">Blood Group</small>
                              </a>
                            </div>
                          </div>
                        </div>
                       
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="bg-white">
                  <section class="vbox">
                            <form method="post" action="/add-new-lab-report">
                              <textarea id="report" name="report" >{!! $myrequest->request_type !!}</textarea>
                               <footer class="panel-footer text-right bg-light lter">
                                  
                                  <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  <input type="hidden" name="patientid" id="patientid"  value="{{ $patients->patient_id }}">
                                  <input type="hidden" name="investigation" id="investigation"  value="{{ $labrequest->investigation }}">
                                  <input type="hidden" name="visitid" id="visitid"  value="{{ $labrequest->visitid }}">

                      </footer>
                    </form>        
                  </section>
                </aside>
  @stop
<script src="{{ asset('/js/tinymce/js/tinymce/tinymce.min.js')}}"></script>
  <script>tinymce.init({ selector:'#report', readonly : "1",plugins: "print",
  menubar: "file",
 
  toolbar: "print",height: 700 });</script>








