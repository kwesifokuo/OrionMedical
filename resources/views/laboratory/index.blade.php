
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Diagnostic Center </li>
              </ul>
             
             <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/167733.svg" width="15%" class="pull-left">
                    <a class="clear" href="#new-lab-request"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">New Analysis</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                   <img src="/images/201555.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/laboratory">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Result Entry</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/128703.svg" width="15%" class="pull-left">
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Lab Sample Collection</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                   <img src="/images/308254.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/available-labs">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Investigations Details</small>
                    </a>
                  </div>

                 
                </div>
              </section>


              <div class="row">

                <div class="col-md-12">
                  <div class="doc-buttons">
                   
                    <a href="#" class="btn btn-s-md btn-danger btn-rounded">Partial / No Sample Collected</a>
                    <a href="#" class="btn btn-s-md btn-warning btn-rounded">Sample Collected</a>
                    <a href="#" class="btn btn-s-md btn-twitter btn-rounded">Result Entered</a>
                    <a href="#" class="btn btn-s-md btn-info btn-rounded">Finalized</a>
                    <a href="#" class="btn btn-s-md btn-success btn-rounded">Dispatched</a>
                    
                  </div>
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-test-result" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by patient, test, status">
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-success" type="submit">Search!</button>
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
                            <th>Lab Request Type</th>
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
                            
                           
                            <td>{{ $myrequest->patient_name }} [ {{ $myrequest->patientid }} ] </td>
                            <td>{{ $myrequest->visitid }}</td>
                            <td>{{ $myrequest->investigation }}</td>

                            <td>{{ $myrequest->created_by }}</td>
                            <td>{{ $myrequest->created_on }}</td>
                            <td>@if($myrequest->status == 'Partially Ready - Pending Approval')
                                   <a href="#" ><span class="btn btn-s-md bg-warning btn-rounded"> Partially Ready  </span></a>
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
                  
                                    <a href="/register-start" class="bootstrap-modal-form-open float" data-toggle="modal">
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
$(document).ready(function () {
   
    $('#investigation').select2();
    $('#patient_id').select2();
    loadInvestigation();
    

  });
</script>

<script type="text/javascript">

function getVisitDetails()
{

 if($('#request_name').val() != "")
 {


 $.get('/get-visit-details-laboratory',
        {

          "id": $('#request_visitid').val(),
          "fullname": $('#request_name').val(),
         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        
            //sweetAlert("Employee SSF : ", data["PatientName"], "info");
            $('#accounttype').val(data.AccountType);
            $('#request_patient_id').val(data.PatientID);
            //$('#request_name').val(data.PatientName);
            $('#request_visitid').val(data.VisitID);
       
      });
                                        
        },'json');

}

else
{
   sweetAlert("Please enter patient name!");

}


}
  
function addInvestigation()
{
if($('#investigation').val()!= "")
{

    $.get('/add-investigation',
        {
          "patient_id": $('#request_patient_id').val(),
           "accounttype": $('#accounttype').val(),
          "opd_number": $('#request_visitid').val(),
          "investigation": $('#investigation').val(),
          "fullname":  $('#request_name').val()                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
         
          loadInvestigation();
          $('#investigation').val()!= ""
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


function loadInvestigation()
   {
         
        
        $.get('/patient-investigation',
          {
            "opd_number": $('#request_visitid').val()
          },
          function(data)
          { 

            $('#investigationsTable tbody').empty();
            $.each(data, function (key, value) 
            {           
           $('#investigationsTable tbody').append('<tr><td>'+ value['investigation'] +'</td><td>'+ value['cost'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['status'] +'</td><td><a a href="/view-lab-request/'+value['id']+'"><i onclick="" class="fa fa-eye"></i></a></td><td><a a href="#"><i onclick="removeinvestigation(\''+value['id']+'\',\''+value['investigation']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


    function removeinvestigation(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+name+" from the list?",   
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
              swal("Deleted!", name +" was removed from list.", "success"); 
              loadInvestigation();
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

</script>


<div class="modal fade" id="new-lab-request" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">New Lab Request</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" action="/update-prescription-status" class="panel-body wrapper-lg">
                         @include('laboratory.create')
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


