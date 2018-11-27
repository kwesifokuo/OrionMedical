@extends('layouts.default')
@section('content')
<section id="content">
          <section class="hbox stretch scrollable wrapper">          
            <!-- .aside -->
            <aside>
              <section class="vbox scrollable wrapper">
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
         <aside class="aside-lg b-l scrollable">
              <div class="padder scrollable">
                <h5>Event Status</h5>
                <div class="line"></div>
                <div id="myEvents" class="pillbox clearfix m-b no-border no-padder">
                  <ul>
                    <li class="label bg-warning">Rescheduled</li>
                    <li class="label bg-danger">No show</li>
                    <li class="label bg-dark">Reminder Sent</li>
                    <li class="label bg-dark">Appointment Confirmed</li>
                    <li class="label bg-success">Patient has arrived</li>
                    <li class="label bg-info">Arrived Late</li>
                    <li class="label bg-danger">Cancelled</li>
                    <span class="badge"><li class="label">Pending Arrival</li></span>

                    <input type="text" placeholder="add leave">




                  </ul>
                </div>
                <div class="line"></div>
                <div class="checkbox">
                  <label class="checkbox-custom"><input type='checkbox' id='drop-remove' /><i class="fa fa-square-o"></i> remove after drop</label>
                </div>
{{--                 <div>
                <a href="/book-appointment"  data-toggle="modal" class="btn btn-sm btn-info bootstrap-modal-form-open"> <i class="fa fa-plus"></i>  Create New Appointment </a>
                </div> --}}

                  <div>
                <a href="#new-appointment-request"  data-toggle="modal" class="btn btn-sm btn-info bootstrap-modal-form-open"> <i class="fa fa-plus"></i> Create An Appointment </a>
                </div>

                 <div class="line"></div>
                <div class="line"></div>
                 <div>
                <a href="/event-list"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open"> <i class="fa fa-file"></i>   All Appointment</a>
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
                <input type="hidden" id="subsidiary" name="subsidiary" value="">
                </div>
                <p class="text-muted">By Doctor </p>
                <div>
                @foreach($doctors as $doctor)
                <a href="/doctor-appointments/{{ $doctor->name }}"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open"> <i class="fa fa-user-md"></i>  {{ $doctor->name }} </a>
                @endforeach
                </div>
                <img src="/images/medical-scheduling.png" width="70%"> 
              </div>
            </aside>
            <!-- /.aside -->
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        <aside class="bg-light lter b-l aside-md hide" id="notes">
          <div class="wrapper">Notification</div>
        </aside>
      </section>
    </section>
  </section>
    @stop



  <script src="{{ asset('/event_components/jquery.min.js')}}"></script>
  <script src="{{ asset('/event_components/bootstrap.min.js')}}"></script>
  <script src="{{ asset('/event_components/fullcalendar.min.js')}}"></script>
  <script src="{{ asset('/event_components/moment.min.js')}}"></script>


<script type="text/javascript">
  $(document).ready(function() {
    
    var base_url = '{{ url('/') }}';

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
        url: 'appointments',
        error: function() {
          alert("cannot load json");
        }
      }
    });
  
  $('#new-appointment-request select[name="title"]').select2();
  $('#new-appointment-request select[name="name"]').select2();
  });
</script>




  <script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
$(function () {
  $('#time').daterangepicker({
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


  