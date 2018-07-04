
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Doctor Station </li>
              </ul>
            
          
             
            <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                     <img src="/images/384514.svg" width="15%">
                    <a class="clear" href="/opd-consultation-doctor"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong> 0 </strong></span>
                      <small class="text-muted text-uc">Patient List</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                     <img src="/images/425837.svg" width="15%">
                    </span>
                    <a class="clear" href="/review-consultation">
                      <span class="h3 block m-t-xs"><strong id="bugs">{{$myrequests->count()}}</strong></span>
                      <small class="text-muted text-uc">Awaiting Investigations</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/139290.svg" width="15%">
                    <a class="clear" href="/ipd-consultation">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Admission & Detentions</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                     <img src="/images/medical-scheduling.png" width="21%">
                    </span>
                    <a class="clear" href="/doctor-appointments/{{ Auth::user()->getNameOrUsername() }}">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Your Appointments</small>
                    </a>
                  </div>

                 
                </div>
              </section> 


              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-patient-folder" method="GET">


                      <div class="input-group text-ms">
                        
                        <div class="col-md-8">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by patient, test, status">
                        </div>
                       
                         <div class="col-md-4">
                        <input type="text" name='review_period' id='review_period' class="input-sm form-control" placeholder="Search by patient, test, status">
                        </div>

                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-success" type="submit">Search Case!</button>
                        </div>
                      </div>



                      </form>
                    </header>
                    <div class="table-responsive">
 <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>

                            <th>Patient </th>
                            <th>Visit # </th>
                            <th>Investigation Request Type</th>
                            <th>Requested By</th>
                            <th>Date Requested</th>
                            <th>Status</th>
                              <th></th>
                               <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($myrequests as $myrequest )
                          <tr>
                            
                           
                            <td>{{ $myrequest->patient_name }} </td>
                            <td>{{ $myrequest->visitid }}</td>
                            <td>{{ $myrequest->investigation }}</td>

                            <td>{{ $myrequest->created_by }}</td>
                            <td>{{ $myrequest->created_on }}</td>
                            <td>
                                @if($myrequest->status == 'Partially Ready - Pending Approval')
                                   <a href="#" ><span class="btn btn-s-md bg-warning btn-rounded"> Partially Ready  </span></a>

                              @elseif($myrequest->type == 'Radiology')
                                   <a href="/upload-scan/{{ $myrequest->visitid }}" ><span class="btn btn-s-md bg-success btn-rounded"> Available </span></a>
                               @elseif($myrequest->status == 'Not Ready')
                                   <a href="/perform-analysis/{{ $myrequest->visitid }}" ><span class="btn btn-s-md bg-danger btn-rounded"> Not Ready </span></a>
                               
                                @else
                                   <a href="/perform-analysis/{{ $myrequest->visitid }}" ><span class="btn btn-s-md bg-success btn-rounded"> Available </span></a>
                                @endif
                                </td>
                          
                           <td><a href="/perform-analysis/{{ $myrequest->visitid }}"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a></td> 
                             
                              @if($myrequest->status == 'Partially Ready')
                             <td><a href="#" class="bootstrap-modal-form-open"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print Result"></i></a></td>
                             @else
                              <td><a href="/test-collection-slip/{{$myrequest->visitid}}" class="bootstrap-modal-form-open"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print Collection Slip"></i></a></td>
                              @endif
                               <td><a href="#" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a></td> 

                          </tr>
                         @endforeach
                        </tbody>
 
                      </table>
                    </div>
                  </section>
         
                </div>
              </div>

            </section>
           <footer class="footer bg-white b-t">
                  
                                    <a href="#new-lab-request" class="bootstrap-modal-form-open float" data-toggle="modal">
<i class="fa fa-plus my-float"></i><i class="fa fa-flask my-float"></i>
</a>

                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $myrequests->total() }} {{ str_plural('Request', $myrequests->total()) }}</span>
                      </p>
                    </div>
                     {!!$myrequests->render()!!} 
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                       
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>


@stop



<script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#review_period span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#review_period').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
    
});


</script>









 
