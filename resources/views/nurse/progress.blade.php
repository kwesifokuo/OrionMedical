@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
          <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Nurse Manager</div>
              <ul class="nav">
                <li class="b-b b-light"><a href="/ipd-medication"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Patient Medications</a></li>
                <li class="b-b b-light"><a href="/ipd-fluid-chart"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Intake / Output Records</a></li>
                <li class="b-b b-light"><a href="/nurse-admission-progress"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Nurse Progress Notes</a></li>
                <li class="b-b b-light"><a href="/ipd-vital-signs"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Vital Signs</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Bed Side Procedure</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Room Transfer</a></li>
                <li class="b-b b-light"><a href="/get-history-record"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Patient History</a></li>
                <li class="b-b b-light"><a href="/ipd-discharge-summary"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Discharge Summary</a></li>
                <li class="b-b b-light"><a href="/temperature-chart"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Temperature Chart</a></li>
                 <div class="wrapper b-b header">Antenatal</div>
                  <li class="b-b b-light"><a href="/antenatal-admission"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Antenatal Admission</a></li>
                    <li class="b-b b-light"><a href="/antenatal-attendance"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Antenatal Attendances</a></li>
                     <li class="b-b b-light"><a href="/puerperium"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Puerperium</a></li>
                        <li class="b-b b-light"><a href="/record-of-labour"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Record of Labour</a></li>
                   <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                 <img width="150" height="200" src="/images/ask_for_help.png"> 
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <form method="post" action="/add-new-request">
  <textarea id="report" name="report" >{!! $myrequest[0]->doc !!}</textarea>
   <footer class="panel-footer text-right bg-light lter">
                        <button type="submit" class="btn btn-success btn-s-xs">Process</button>
                         <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </footer>
                    </form>        
                  </section>
                <footer class="footer bg-white b-t">
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t">
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                       {{--  {!!$drugs->render()!!} --}}
                        
                    </div>
                  </div>
                </footer>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop
<script src="{{ asset('/js/tinymce/js/tinymce/tinymce.min.js')}}"></script>
  <script>tinymce.init({ selector:'#report' ,menubar: false,
  browser_spellcheck: true,height: 700 });</script>






