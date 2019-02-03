<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">{{   $mycompany->legal_name }}</li>   
              </ul>
              <div class="m-b-md">
                <h3 class="m-b-none">{{   $mycompany->legal_name }}</h3>
                 @if(Auth::check())
                <small>Welcome back,  {{ Auth::user()->getNameOrUsername() }}</small>
                 @endif
              </div>

              <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">

                    <img src="/images/437553.svg" width="15%" class="pull-left">
                    <a class="clear" href="/active-patients">
                      <span class="h3 block m-t-xs"><strong>{{ $customercount }}</strong></span>
                      <small class="text-muted text-uc">Patients</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                      <img src="/images/1040214.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/event-calendar">
                      <span class="h3 block m-t-xs"><strong id="bugs">{{ $events->count() }}</strong></span>
                      <small class="text-muted text-uc">Appointments</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">                     
                         <img src="/images/754554.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/waiting-opd">
                      <span class="h3 block m-t-xs"><strong id="firers">{{ $visits }}</strong></span>
                      <small class="text-muted text-uc">Today's Visits</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/138361.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/service-charges">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Service Charges</small>
                    </a>
                  </div>
                </div>
              </section>
        @role('System Admin')
              <div class="row">
               

                  <div class="col-lg-8">
                  <section class="panel panel-default">
                    <header class="panel-heading">
                      Patient visit within 90 days trend
                    </header>
                    <div class="panel-body text-center">
                      
                      <small class="text-muted block"></small>
                      <div class="inline">
                          @include('charts/visit') 
                      </div>                      
                    </div>
                    <div class="panel-footer"><small><a href="/visits-by-type" > % of visits</a></small></div>
                  </section>
                </div>


                <div class="col-md-4">
                  <section class="panel panel-default">
                    <header class="panel-heading font-bold">Data graph</header>
                    <div class="bg-light dk wrapper">
                      <span class="pull-right">{{ date('D')}}</span>
                      <span class="h4">GHS{{ $payments }}<br>
                        
                      </span>
                      <div class="text-center m-b-n m-t-sm">
                          <div class="sparkline" data-type="line" data-height="65" data-width="100%" data-line-width="2" data-line-color="#dddddd" data-spot-color="#bbbbbb" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="3" data-resize="true" values="280,320,220,385,450,320,345,250,250,250,400,380"></div>
                          <div class="sparkline inline" data-type="bar" data-height="45" data-bar-width="6" data-bar-spacing="6" data-bar-color="#65bd77">10,9,11,10,11,10,12,10,9,10,11,9,8</div>
                      </div>
                    </div>
                    <div class="panel-body">
                      <div>
                        <span class="text-muted">Total collections today:</span>
                        <span class="h3 block"><a href="/charts" >GHS{{ $payments }}</a></span>
                      </div>

                       <div>
                        <span class="text-muted">Total bills generated today:</span>
                        <span class="h3 block"><a href="/charts" >GHS{{ $bills }}</a></span>
                      </div>

                      <div class="line pull-in"></div>
                      <div class="row m-t-sm">
                        <div class="col-xs-3">
                          <small class="text-muted block">OPD</small>
                          <span class="badge bg-default"><a href="/visits-by-doctor"> GHS{{ $opdbills }}</a></span>
                        </div>
                        <div class="col-xs-3">
                          <small class="text-muted block">Labs</small>
                          <span class="badge bg-info">GHS{{ $labbills }}</span>
                        </div>
                        <div class="col-xs-3">
                          <small class="text-muted block">Pharmacy</small>
                          <span class="badge bg-warning"><a href="/chart-drugs-dispensed" >GHS{{ $pharmacybills }}</a></span>
                        </div>
                        <div class="col-xs-3">
                          <small class="text-muted block">Imaging</small>
                          <span class="badge bg-success">GHS{{ $imagingbills }}</span>
                        </div>
                      </div> 
                    </div>
                  </section>
                </div>
              </div>


              <div class="row">

            <div class="col-lg-12">
                  <section class="panel panel-default">
                    <header class="panel-heading">
                      Patient bills within 30 days trend
                    </header>
                    <div class="panel-body text-center">
                      
                      <small class="text-muted block"></small>
                      <div class="inline">
                          @include('charts/bills') 
                      </div>                      
                    </div>
                    <div class="panel-footer"><small><a href="/visits-by-type" > % of Bills</a></small></div>
                  </section>
                </div>  
              </div>


             



           {{--    <div class="row">

            <div class="col-lg-12">
                  <section class="panel panel-default">
                    <header class="panel-heading">
                      Department revenue within 90 days trend
                    </header>
                    <div class="panel-body text-center">
                      
                      <small class="text-muted block"></small>
                      <div class="inline">
                          @include('charts/service_trend') 
                      </div>                      
                    </div>
                    <div class="panel-footer"><small><a href="#" > % of Bills</a></small></div>
                  </section>
                </div>  
              </div> --}}

               <div class="row">

            <div class="col-lg-12">
                  <section class="panel panel-default">
                    <header class="panel-heading">
                      Department revenue - monthly trend
                    </header>
                    <div class="panel-body text-center">
                      
                      <small class="text-muted block"></small>
                      <div class="inline">
                          @include('charts/utilization') 
                      </div>                      
                    </div>
                    <div class="panel-footer"><small><a href="#" > % of Bills</a></small></div>
                  </section>
                </div>  
              </div>

                <div class="row">

            <div class="col-lg-12">
                  <section class="panel panel-default">
                    <header class="panel-heading">
                      Source revenue - monthly trend
                    </header>
                    <div class="panel-body text-center">
                      
                      <small class="text-muted block"></small>
                      <div class="inline">
                          @include('charts/businesssource') 
                      </div>                      
                    </div>
                    <div class="panel-footer"><small><a href="#" > % of Bills</a></small></div>
                  </section>
                </div>  
              </div>


                <div class="row">

            <div class="col-lg-12">
                  <section class="panel panel-default">
                    <header class="panel-heading">
                      Payment Received - monthly trend
                    </header>
                    <div class="panel-body text-center">
                      
                      <small class="text-muted block"></small>
                      <div class="inline">
                          @include('charts/paymentsource') 
                      </div>                      
                    </div>
                    <div class="panel-footer"><small><a href="#" > % of Payments</a></small></div>
                  </section>
                </div>  
              </div>



              @endrole


              <div class="row">
                <div class="col-md-12">
                  <h4 class="m-t-none">Today's Visits</h4>
                  <ul class="list-group gutter list-group-lg list-group-sp sortable">
                  @foreach($myvisits as $visit)
                    <li class="list-group-item box-shadow" draggable="true">
                      <a href="#" class="pull-right" data-dismiss="alert">
                        <i class="fa fa-times icon-muted"></i>
                      </a>
                      <span class="pull-left media-xs">
                        <i class="fa fa-sort icon-muted fa m-r-sm"></i>
                        <a href="#todo-2" data-toggle="class:text-lt text-danger">
                          <i class="fa fa-square-o fa-fw text"></i>
                          <i class="fa fa-check-square-o fa-fw text-active text-danger"></i>
                        </a>
                      </span>
                      <div class="clear" id="todo-2">
                          {{ $visit->opd_number  }} | {{ $visit->consultation_type }} | {{ $visit->created_on->diffForHumans() }}
                      </div>
                    </li>
                    @endforeach
                  </ul>                  
                </div>
                {{-- <div class="col-md-6">
                  <section class="panel b-light">
                    <header class="panel-heading bg-dark dker no-border"><strong>Calendar</strong></header>
                    <div id="calendar" class="bg-default m-l-n-xxs m-r-n-xxs"></div>

                    <div class="list-group">
                    @foreach($events as $event)
                      <a href="#" class="list-group-item text-ellipsis">
                        <span class="badge bg-danger">{{ date("g:ia\, jS M Y", strtotime($event->start_time)) }}</span> 
                        {{ $event->name  }}
                      </a>
                      @endforeach
                    </div>
                  </section>                  
                </div> --}}
              </div>

                 <div class="row">

             <div class="col-md-12">
              <section class="panel b-light">
                    <header class="panel-heading bg-dark dker no-border"><strong>Appointments</strong></header>
                  <div class="panel-body text-center">
                       <div class="calendar" id="calendar">                 
                    </div>
                  </section> 
                </div>
               
              </div>
@role('System Admin')


         
            <!-- /.aside -->

              <div class="row">
             
              <div class="col-md-6">
              <section class="panel b-light">
                    <header class="panel-heading bg-dark dker no-border"><strong>Top 10 Diagnosis</strong></header>
                  <div class="panel-body text-center">
                      <div class="inline">
                          @include('charts/topdiagnosis') 
                      </div>                      
                    </div>
                  </section> 
                </div>



                 <div class="col-md-6">
              
              <section class="panel b-light">
                    <header class="panel-heading bg-dark dker no-border"><strong>Top Selling Drugs</strong></header>
                  <div class="panel-body text-center">
                      <div class="inline">
                          @include('charts/topdrugs') 
                      </div>                      
                    </div>
                  </section> 
                </div>
              </div>
    @endrole
     {{--  <a><i class="fa fa-long-arrow-up"><iframe src="http://www.bloomberg.com/markets/components/data-drawer" width="1700" height="100px" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0">
         </iframe></i></a> --}}
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
<script src="{{ asset('/event_components/jquery.min.js')}}"></script>



  <script src="{{ asset('/event_components/jquery.min.js')}}"></script>
  <script src="{{ asset('/event_components/bootstrap.min.js')}}"></script>
  <script src="{{ asset('/event_components/fullcalendar.min.js')}}"></script>
  <script src="{{ asset('/event_components/moment.min.js')}}"></script>


<script type="text/javascript">
  $(document).ready(function() {
    
    var base_url = '{{ url('/') }}';

    $('#calendar').fullCalendar({
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
     defaultView: 'agendaWeek',
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
  
  });
</script>


<script type="text/javascript">
  function getdrugdetail(id)
{ 

  $.get("/get-consumable-detail",
          {"id":id},
          function(json)
          {
            

                $('#assign-consumable input[name="drugid"]').val(json.drugid);
                $('#assign-consumable input[name="drug_number"]').val(json.drug_number);
                $('#assign-consumable select[name="drug_name"]').val(json.drug_name);
                $('#assign-consumable input[name="stock"]').val(json.stock);

               $('#assign-consumable select[name="assignee"]').select2({
                  tags: true
                  });

               $('#assign-consumable select[name="drug_name"]').select2({
                  tags: true
                  });
                 
              //}
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}


</script>



