@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Manage OPD </li>
              </ul>

             
           {{--   <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/754554.svg" width="15%" class="pull-left">
                    <a class="clear" href="/new-opd"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>{{ $checkedin }}</strong></span>
                      <small class="text-muted text-uc">Check In List</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/846958.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/waiting-opd">
                      <span class="h3 block m-t-xs"><strong id="bugs">{{ $reviewing  }}</strong></span>
                      <small class="text-muted text-uc">Practitioners List</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/971609.svg" width="15%" class="pull-left">
                    <a class="clear" href="/billing-index">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Bills</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/188056.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/show-admitted">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Admissions & Dententions</small>
                    </a>
                  </div>

                 
                </div>
              </section>
 --}}

              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-patient-opd" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="form-control input-lgx m-b" placeholder="Search using ID ...">
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-success" type="submit"></button>
                        </div>
                      </div>
                      </form>
                    </header>
                    <br>
                     <br>
                      <br>
                       <br>
                        <br>


                    @if($patients->isNotEmpty())
                    <div class="table-responsive">

                      <table class="table table-striped m-b-none text-sm" width="100%">
                           <thead>
                          <tr><th></th>
                             <th >Patient Record # </th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Birthday</th>
                            <th>Phone</th>
                            <th>Address</th>
                             <th>Account Type</th>
{{--                             <th>Date Registered</th> --}}
                            <th>Copayer</th>
                            <th width="30"></th>
                          </tr>
                        </thead>
                        <tbody>
                       @foreach( $patients as $keys => $patient )
                          <tr>
                            <td>{{ ++$keys }}</td>
                           
                            <td><a href="/patient-profile-limited/{{ $patient->patient_id }}"  id="edit" name="edit" data-toggle="modal" alt="edit">{{ $patient->ref_code }}</a></td>
                            <td>{{  ucwords(strtolower($patient->fullname)) }}</td>
                             <td>{{ $patient->gender }}</td>
                              <td>{{ $patient->date_of_birth->format('Y-m-d')  }} <span class="badge badge-info"> {{$patient->date_of_birth->age}} year(s) </span></td>
                            <td>{{ $patient->mobile_number }}</td>
                             <td>{{  ucwords(strtolower($patient->residential_address)) }}</td>
                             <td>{{  ucwords(strtolower($patient->accounttype)) }}</td>
 {{--                            {{ Carbon\Carbon::parse($customerlist->created_at)->diffForHumans() }}</td> --}}
                             <td>@if($patient->accounttype=='Corporate')  {{ str_limit($patient->company,15) }}
                              @elseif($patient->accounttype=='Health Insurance') {{ str_limit($patient->insurance_company,15) }} 
                              @else 
                              @endif</td>
                            <td>
                              
                                 <a href="/patient-profile-limited/{{ $patient->patient_id }}" class="btn btn-s-sm btn-primary btn-rounded"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-folder"> </i> View </a>
                               
                            </td>
                            
                          </tr>
                         @endforeach
                        </tbody>
 
                      </table>
                    </div>
                    @else

                    @endif



                  </section>
         
                </div>
              </div>

            </section>
             <footer class="footer bg-white b-t">

             <a href="/register-start" class="bootstrap-modal-form-open float" data-toggle="modal">
<i class="fa fa-plus my-float"></i><i class="fa fa-tags my-float"></i>
</a>
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $patients->total() }} {{ str_plural('Patient', $patients->total()) }}</span>
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                         {!!$patients->render()!!}
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>

@stop



<script src="{{ asset('/js/jquery.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function () {
   
    $('#investigation').select2();
    loadInvestigation();

    $('#consultation_type2').select2();


              

  });
</script>
<script>

function getAge()
{

    $.get('/patient-age-occupation',
        {

          "id": $('#patient_id').val()
         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        
          //sweetAlert("Employee SSF : ", data["employeessf"], "info");
           $('#age').val(data.age);
           $('#occupation').val(data.occupation);
           //$('#accounttype').val(data.accounttype);
       
      });
                                        
        },'json');
  
}

var account_no = null;
function getDetails(acct_no)
{ 
  account_no = acct_no;
  $.get("/edit-patient",
          {"patient_id":account_no},
          function(json)
          {

                $('#modal_check_in input[name="patient_id"]').val(json.patient_id);
                $('#modal_check_in input[name="fullname"]').val(json.fullname);
                //$('#modal_check_in select[name="accounttype"]').val(json.accounttype);
                $('#modal_check_in img[name="imagePreview"]').attr("src", '/images/'+json.image);

                $('#modal_check_in select[name="accounttype"]').select2();
                $('#modal_check_in select[name="referal_doctor"]').select2();
                $('#modal_check_in select[name="consultation_type"]').select2();
                $('#modal_check_in select[name="visit_type"]').select2();
                $('#modal_check_in select[name="location"]').select2();
                $('#modal_check_in select[name="anaesthetist"]').select2();
                $('#modal_check_in select[name="sponsor"]').select2();
                
                getAge();
                //loadRisk();
                loadBillState();

          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}







</script>
<script type="text/javascript">

// function getVisitDetails()
// {
//  $.get('/get-visit-details',
//         {

//           "id": $('#request_visitid').val()
         
//         },
//         function(data)
//         { 
          
//           $.each(data, function (key, value) {
        
//             //sweetAlert("Employee SSF : ", data["PatientName"], "info");
//             //$('#accounttype').val(data.AccountType);
//             $('#request_patient_id').val(data.PatientID);
//             //$('#request_name').val(data.PatientName);
//             $('#request_visitid').val(data.VisitID);

//             //$('#drug_quantity').val("");
       
//       });
                                        
//         },'json');
// }


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



 function loadRisk()
   {
         
        
        // $.get('/load-account',
        //   {
        //     "patient_id": $('#patient_id').val()
        //   },
        //   function(data)
        //   { 

        //     $('#accounttype').empty();
        //     $.each(data, function () 
        //     {           
        //     $('#accounttype').append($('<option></option>').val(this['accounttype']).html(this['accounttype']));
        //     });
                                          
        //  },'json');      
    }

    function loadBillState()
   {
         
        
        $.get('/get-bill-state',
        {

          "patient_id": $('#patient_id').val()
         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        
            //sweetAlert("Employee SSF : ", data["PatientName"], "info");
            $('#last_visit_date').val(data.mylastvisit);
           $('#myoutstanding').val(data.myoutstanding);
            //$('#drug_quantity').val("");
       
      });
                                        
        },'json');
    }


  
function addInvestigation()
{
if($('#investigation').val()!= "")
{
    //alert($('#request_patient_id').val());

    $.get('/add-investigation',
        {
          "patient_id": $('#request_patient_id').val(),
           "accounttype": $('#request_accounttype').val(),
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
           $('#investigationsTable tbody').append('<tr><td>'+ value['investigation'] +'</td><td>'+ value['cost'] +'</td><td>'+ value['created_on'] +'</td><td>'+ value['status'] +'</td><td><a a href="/billing-print/'+value['visitid']+'"><i onclick="" class="fa fa-print"></i></a></td><td><a a href="#"><i onclick="removeinvestigation(\''+value['id']+'\',\''+value['investigation']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
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




<script type="text/javascript">
$(function () {
  $('#visit_date').daterangepicker({
     "minDate": moment('2017-02-01'),
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


<div class="modal fade" id="modal_check_in" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Visit Registration</h4>
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
                           <form  class="bootstrap-modal-form" method="post" data-validate="parsley" action="/create-opd" class="panel-body wrapper-lg">
                          @include('opd/checkin')
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




    <div class="modal fade" id="new-service-request" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Walk In Request</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" data-validate="parsley" action="/create-opd-walkin" class="panel-body wrapper-lg">
                         @include('opd.service')
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




