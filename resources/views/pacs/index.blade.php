@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Pacs </li>
              </ul>
             
             <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/139291.svg" width="15%">
                    <a class="clear" href="#"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>{{$imagerequests->total()}}</strong></span>
                      <small class="text-muted text-uc">Imaging Request</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/387617.svg" width="15%">
                    </span>
                    <a class="clear" href="/orionpacs/viewers/static/index.html">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Pacs</small>
                    </a>
                  </div>
                </div>
              </section>


              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-imaging-request" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by patient, imageing type, status">
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
                            

                            <th>Patient</th>
                            <th>Request Type</th>
                            <th>Remark</th>
                            <th>Requested By</th>
                            <th>Requested On</th>
                            <th>Imaging Status</th>
                            
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                       @foreach($imagerequests as $imagerequest )
                          <tr>
                            
                            
                            <td>{{ $imagerequest->patient_name }} [ {{ $imagerequest->patientid }} ] </td>
                            <td>{{ $imagerequest->investigation }}</td>
                            <td>{{ $imagerequest->remark }}</td>
                            <td>{{ $imagerequest->created_by }}</td>
                            <td>{{ $imagerequest->created_on }}</td>
                             <td>@if($imagerequest->status == 'Partially Ready - Pending Approval')
                                   <a href="#" ><span class="btn btn-s-md bg-success btn-rounded"> Upload / View </span></a>
                                @elseif($imagerequest->status == 'Not Ready')
                                   <a href="/upload-scan/{{ $imagerequest->visitid }}" ><span class="btn btn-s-md bg-success btn-rounded"> Upload </span></a>
                                @else
                                   <a href="/upload-scan/{{ $imagerequest->visitid }}" ><span class="btn btn-s-md bg-success btn-rounded"> Upload </span></a>
                                @endif
                                </td>
                             <td><a href="/image-request-slip/{{ $imagerequest->visitid }}" class="bootstrap-modal-form-open" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-print"></i></a></td> 

                            <td><a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{ $imagerequest->id }}','{{ $imagerequest->investigation }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a></td> 
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
<i class="fa fa-plus my-float"></i><i class="fa fa-file my-float"></i>
</a>

                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $imagerequests->total() }} {{ str_plural('Request', $imagerequests->total()) }}</span>
                      </p>
                    </div>
                     {!!$imagerequests->render()!!} 
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                       
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>

@stop

<script >
function getVisitDetails()
{
 $.get('/get-visit-details',
        {

          "id": $('#request_visitid').val()
         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        
            //sweetAlert("Employee SSF : ", data["PatientName"], "info");
           // $('#age').val(data.age);
            $('#request_patient_id').val(data.PatientID);
            $('#request_name').val(data.PatientName);
       
      });
                                        
        },'json');
}

function deleteImage(id,name)
  {

      //alert(id);

      swal({   
        title: "Are you sure?",   
        text: "Do you want to delete "+name+" ?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel !",   
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
              swal("Deleted!", name +" was successfully deleted from store.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to delete.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to delete.", "error");   
        } });

  }

  

    function addImageRequest()
{
if($('#scan_type').val()!= "" && $('#request_visitid').val()!= "" )
{

    $.get('/add-image-request',
        {
          "scan_patient": $('#request_patient_id').val(),
          "scan_doctor": $('#request_patient_id').val(),
          "opd_number": $('#request_visitid').val(),
          "fullname": $('#request_name').val(),
          "scan_type": $('#scan_type').val(),                    
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          sweetAlert("Imaging request has been forwarded!");
          loadImagingRequest();
        }
        else
        {
          sweetAlert("Imaging request failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please select an imaging request type!");}
}

function loadImagingRequest()
   {
         
        
        $.get('/get-image-request',
          {
            "opd_number": $('#request_visitid').val()
          },
          function(data)
          { 

            $('#investigationsTable tbody').empty();
            $.each(data, function (key, value) 
            {           
           $('#investigationsTable tbody').append('<tr><td>'+ value['type'] +'</td><td>'+ value['cost'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['status'] +'</td><td><a a href="/view-lab-request/'+value['id']+'"><i onclick="" class="fa fa-eye"></i></a></td><td><a a href="#"><i onclick="removeinvestigation(\''+value['id']+'\',\''+value['type']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }


  </script>


<div class="modal fade" id="image-request" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Imaging Request Form</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                         
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" action="/create-opd" class="panel-body wrapper-lg">
                          @include('pacs/request')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                        </section>
                        </section>
                      </div>
      </div>
        </div>
    </div><!-- /.modal-dialog -->




