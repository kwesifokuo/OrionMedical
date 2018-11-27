@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Manage Patient </li>
              </ul>

             
             <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/448908.svg" width="15%">
                    <a class="clear" href="/active-patients"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>{{ $customerlists->total() }}</strong></span>
                      <small class="text-muted text-uc">Active Patient</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/249205.svg" width="15%">
                    </span>
                    <a class="clear" href="/inactive-patients">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Inactive Patient</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/426363.svg" width="15%">
                    <a class="clear" href="/registered-companies">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Registered Companies</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/212298.svg" width="15%">
                    </span>
                    <a class="clear" href="/event-calendar">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Appointments</small>
                    </a>
                  </div>

                 
                </div>
              </section>


              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-patient" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by patient, company, status, phone number">
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
                            <th width="20"></th>
                            <th width="20"></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $customerlists as $customerlist )
                          <tr>
                           
                            <td><a href="/patient-profile-limited/{{ $customerlist->patient_id }}"  id="edit" name="edit" data-toggle="modal" alt="edit">{{ $customerlist->ref_code }}</a></td>
                            <td>{{  ucwords(strtolower($customerlist->fullname)) }}</td>
                             <td>{{ $customerlist->gender }}</td>
                              <td>{{ $customerlist->date_of_birth->format('Y-m-d')  }} <span class="badge badge-info"> {{$customerlist->date_of_birth->age}} year(s) </span></td>
                            <td>{{ $customerlist->mobile_number }}</td>
                             <td>{{  ucwords(strtolower(str_limit($customerlist->residential_address,15))) }}</td>
                             <td>{{  ucwords(strtolower(str_limit($customerlist->accounttype,15))) }}</td>
 {{--                            {{ Carbon\Carbon::parse($customerlist->created_at)->diffForHumans() }}</td> --}}
                             <td>@if($customerlist->accounttype=='Corporate')  {{ str_limit($customerlist->company,15) }}
                              @elseif($customerlist->accounttype=='Health Insurance') {{ str_limit($customerlist->insurance_company,15) }} 
                              @else 
                              @endif</td>
                            
                            <td>
                            @if($customerlist->status == 'Active')
                            <a href="#edit-patient" class="bootstrap-modal-form-open" onclick="setAccountNo('{{ $customerlist->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>

                           
                            @else
                            
                            @endif
                             </td>
                            
                           
                             <td>
                             @if($customerlist->status == 'Active')
                              <a href="#" class="" onclick="deactivate('{{ $customerlist->id }}','{{ $customerlist->fullname }}')" data-toggle="class"><i class="fa fa-thumbs-down" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deactivate"></i> </a>
                              @else
                             <a href="#" class="" onclick="activate('{{ $customerlist->id }}','{{ $customerlist->fullname }}')" data-toggle="class"><i class="fa fa-thumbs-up"></i></a>
                             @endif
                            </td>
                            @role(['Medical Records Manager','System Admin'])
                             <td>
                            <a  href="#" class="" onclick="deletePatient('{{$customerlist->id}}','{{ $customerlist->fullname }}')"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a>
                            </td> 
                            @endrole
                            
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
<i class="fa fa-plus my-float"></i><i class="fa fa-user my-float"></i>
</a> 



                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $customerlists->total() }} {{ str_plural('Patient', $customerlists->total()) }}</span>
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-center text-center-xs">                
                     
                         {!!$customerlists->render()!!}
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>

@stop



<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
  function gettabstatus() 
{

 // alert($('#edit-patient select[name="accounttype"]').val());

   if( $('#accounttype').val() == "Health Insurance" || $('#edit-patient select[name="accounttype"]').val() == "Health Insurance")
    {
         
      $('#insurancetab').show();
       $('#corporatetab').show();

       $('#edit-patient div[name="insurancetab"]').show();
       $('#edit-patient div[name="corporatetab"]').show();

      
    }


    else if( $('#accounttype').val() == "Corporate" || $('#edit-patient select[name="accounttype"]').val() == "Corporate")
    {
     
       $('#insurancetab').hide();
       $('#corporatetab').show();

       $('#edit-patient div[name="insurancetab"]').hide();
       $('#edit-patient div[name="corporatetab"]').show();
     }

     else if( $('#accounttype').val() == "Private" || $('#edit-patient select[name="accounttype"]').val() == "Private" )
    {
     
       $('#insurancetab').hide();
       $('#corporatetab').hide();

       $('#edit-patient div[name="insurancetab"]').hide();
       $('#edit-patient div[name="corporatetab"]').hide();
  
     }

     else if( $('#accounttype').val() == "")
    {
     
       $('#insurancetab').hide();
       $('#corporatetab').hide();

       $('#edit-patient div[name="insurancetab"]').hide();
       $('#edit-patient div[name="corporatetab"]').hide();
     }

   else
   {
       $('#insurancetab').hide();
       $('#corporatetab').hide();

       $('#edit-patient div[name="insurancetab"]').hide();
       $('#edit-patient div[name="corporatetab"]').hide();
  }
}
</script>
<script type="text/javascript">
  $(document).ready(function() {

      $('#insurancetab').hide();
      $('#corporatetab').hide();

      $('#edit-patient div[name="insurancetab"]').hide();
      $('#edit-patient div[name="corporatetab"]').hide();

     
  });
</script>

<script>

var account_no = null;
function setAccountNo(acct_no)
{ 
  //alert(acct_no);
  account_no = acct_no;
  $.get("/edit-patient",
          {"patient_id":account_no},
          function(json)
          {
            
                $('#edit-patient div[name="insurancetab"]').hide();
                $('#edit-patient div[name="corporatetab"]').hide();

                $('#edit-patient input[name="patient_id"]').val(json.patient_id);
                $('#edit-patient input[name="fullname"]').val(json.fullname);
                $('#edit-patient textarea[name="residential_address"]').val(json.residential_address);
                $('#edit-patient textarea[name="postal_address"]').val(json.postal_address);
                $('#edit-patient textarea[name="residential_address"]').val(json.residential_address);
                $('#edit-patient textarea[name="postal_address"]').val(json.postal_address);
                $('#edit-patient input[name="date_of_birth"]').val(json.date_of_birth);
                $('#edit-patient input[name="email"]').val(json.email);
                $('#edit-patient input[name="place_of_birth"]').val(json.place_of_birth);
                $('#edit-patient input[name="occupation"]').val(json.occupation);
                $('#edit-patient input[name="mobile_number"]').val(json.mobile_number);
                $('#edit-patient select[name="blood_group"]').val(json.blood_group);
                $('#edit-patient select[name="civil_status"]').val(json.civil_status);
                $('#edit-patient select[name="gender"]').val(json.gender);
                $('#edit-patient select[name="accounttype"]').val(json.accounttype);
                $('#edit-patient select[name="insurance_company"]').val(json.insurance_company);
                $('#edit-patient input[name="insurance_id"]').val(json.insurance_id);
                $('#edit-patient img[name="imagePreview"]').attr("src", '/images/'+json.image);
                $('#edit-patient input[name="imagename"]').val(json.image);
                $('#edit-patient select[name="company"]').val(json.company);


                $('#edit-patient input[name="kin_name"]').val(json.kin_name);
                $('#edit-patient input[name="kin_phone"]').val(json.kin_phone);
                $('#edit-patient select[name="kin_relationship"]').val(json.kin_relationship);
                $('#edit-patient input[name="parent_id"]').val(json.parent_id);
                $('#edit-patient input[name="link_type"]').val(json.link_type);


                $('#edit-patient select[name="insurance_eligibility"]').val(json.insurance_eligibility);
                $('#edit-patient input[name="expiry_date"]').val(json.expiry_date);
                $('#edit-patient select[name="insurance_cover"]').val(json.insurance_cover).select2({
                  tags: true
                  });
                 //alert('jason');
                

                 if(json.accounttype == 'Corporate')
                 {
                   $('#edit-patient div[name="corporatetab"]').show();
                   $('#edit-patient div[name="insurancetab"]').hide();
                 }
                  if(json.accounttype == 'Health Insurance')
                 {
                   $('#edit-patient div[name="insurancetab"]').show();
                   $('#edit-patient div[name="corporatetab"]').hide();



                 }
               
               
              //}
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}
</script>

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
$(document).ready(function () {
   
    $('#insurance_cover').select2({
      tags: true
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

<script type="text/javascript">
$(function () {
  $('#expiry_date').daterangepicker({
     "minDate": moment(),
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

<script type="text/javascript">
$(function () {
  $('#edit-patient input[name="expiry_date"]').daterangepicker({
     "minDate": moment(),
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


<script >




function deactivate(id,name)
  {

         
      swal({   
        title: "Are you sure?",   
        text: "Do you want to deactivate "+name+" ?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, deactivate it!",   
        cancelButtonText: "No, cancel !",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/deactivate-account',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was successfully deactivated.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to deactivate.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to deactivate.", "error");   
        } });

  }

  function activate(id,name)
  {

        //alert(id,name);
      swal({   
        title: "Are you sure?",   
        text: "Do you want to activate "+name+" ?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, activate it!",   
        cancelButtonText: "No, cancel !",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/activate-account',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was activated successully.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to activate.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to activate.", "error");   
        } });

  }


    function deletePatient(id,name)
  {

         
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
          $.get('/delete-patient',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was successfully deleted.", "success"); 
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
                $('#modal_check_in select[name="accounttype"]').select2();
                $('#modal_check_in select[name="referal_doctor"]').select2();
                $('#modal_check_in select[name="consultation_type"]').select2();
                $('#modal_check_in select[name="visit_type"]').select2();
                $('#modal_check_in select[name="anaesthetist"]').select2();
                $('#modal_check_in select[name="sponsor"]').select2();
                $('#modal_check_in img[name="imagePreview"]').attr("src", '/images/'+json.image);


                getAge();
                loadRisk();
                
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}

 


</script>
<script type="text/javascript">

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
            $('#accounttype').val(data.AccountType);
            $('#request_patient_id').val(data.PatientID);
            $('#request_name').val(data.PatientName);
            $('#request_visitid').val(data.VisitID);

            //$('#drug_quantity').val("");
       
      });
                                        
        },'json');
}




</script>

 

<div class="modal fade" id="new-patient" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Create New Patient</h4>
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
                           <form  class="bootstrap-modal-form" data-validate="parsley" enctype="multipart/form-data" method="post" action="/create-patient" class="panel-body wrapper-lg">
                          @include('patient/create')
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

  <div class="modal fade" id="edit-patient" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Update Customer</h4>
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
                           <form  class="bootstrap-modal-form" method="post" enctype="multipart/form-data" action="/update-patient" class="panel-body wrapper-lg">
                          @include('patient/edit')
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

  </div>



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









