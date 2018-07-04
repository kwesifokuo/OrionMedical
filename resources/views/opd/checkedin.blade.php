
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Manage OPD </li>
              </ul>

             
             <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/184697.svg" width="15%">
                    <a class="clear" href="/new-opd"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Check In List</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/201633.svg" width="15%">
                    </span>
                    <a class="clear" href="/waiting-opd">
                      <span class="h3 block m-t-xs"><strong id="bugs">{{ $patients->count() }}</strong></span>
                      <small class="text-muted text-uc">Practitioners List</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/383764.svg" width="15%">
                    <a class="clear" href="/review-opd">
                      <span class="h3 block m-t-xs"><strong>{{ $reviewing }}</strong></span>
                      <small class="text-muted text-uc">Awaiting Investigations</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/250500.svg" width="15%">
                    </span>
                    <a class="clear" href="/discharged-opd">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Admissions & Dententions</small>
                    </a>
                  </div>

                 
                </div>
              </section>


              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default">

                  <header class="panel-heading">
                    <form action="/folder-history" method="GET">
                      <div class="input-group text-ms">
                        
                        <div class="col-md-8">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by patient, company, status">
                        </div>
                       
                         <div class="col-md-4">
                        <input type="text" name='review_period' id='review_period' class="input-sm form-control" placeholder="Search by patient, test, status">
                        </div>
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-success" type="submit">Search List!</button>
                        </div>
                      </div>
                      </form>
                    </header>

                    <div class="table-responsive">

                      <table class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                          <tr>
                          <th></th>
                           <th>Visit #</th>
                            <th>Time In</th>
                            <th>Patient Name</th>
                            <th>Appointment Type</th>
                             <th>Practioner</th>
                            <th>Area</th>
                             <th>Care Provider</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $patients as $key => $patient )
                          <tr>
                            <td> {{ ++$key }}</td>
                            <td><a href="/patient-profile-limited/{{ $patient->patient_id }}"  id="edit" name="edit" data-toggle="modal" alt="edit">{{ $patient->opd_number }}</a></td>
                            <td>{{ $patient->created_on->format('H:i:s - jS M Y') }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->consultation_type }}</td>
                            <td>{{ $patient->referal_doctor }}</td>
                            <td>{{ $patient->location }}</td>
                            <td>{{$patient->payercode }}, {{ $patient->care_provider }}</td>

                            
                           <td><a href="#edit-visit" class="bootstrap-modal-form-open" onclick="getDetails('{{ $patient->opd_number }}')" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Visit Detail"></i></a></td>
                            

                             <td><a href="/opd-ticket/{{ $patient->opd_number }}" class="bootstrap-modal-form-open"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print Ticket"></i></a>
                             </td>
                            
                            @if($patient->consultation_type=='WALK-IN LAB')
                             <td><a href="/walkin-service/{{ $patient->opd_number }}"  class="btn btn-rounded btn-sm btn-info" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-plus-square icon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add Investigation"> </i> </a></td>
                               @elseif($patient->consultation_type=='WALK-IN DIAGNOSTIC')
                               <td><a href="/walkin-service/{{ $patient->opd_number }}"  class="btn btn-rounded btn-sm btn-info" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-plus-square icon" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add Investigation"> </i> </a></td>
                             @elseif($patient->consultation_type=='WALK-IN PHARMACY')
                               <td><a href="/walkin-service/{{ $patient->opd_number }}"  class="btn btn-rounded btn-sm btn-info" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-flask" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add Medication"> </i> </a></td>
                             @endif

                             @role(['Medical Records Manager','System Admin'])
                            <td>
                              <a href="#" class="active" onclick="doDelete('{{ $patient->id }}','{{ $patient->name }}')" data-toggle="class"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a>
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
  
  function doDischarge(id,name)
  {

  swal({
  title: "Discharging " + name +"!",
  //text: "Enter discharge comment:",
  type: "input",
  showCancelButton: true,
  closeOnConfirm: false,
  animation: "slide-from-top",
  inputPlaceholder: "Enter discharge comment"
},
function(inputValue){
  if (inputValue === false) return false;
  
  if (inputValue === "") {
    swal.showInputError("You need to enter discharge comment!");
    return false
  }
  
  else
  {
    $.get('/discharge-patient',
          {
             "ID": id,
             "comment": inputValue  
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Discharged!", name +" was successfully discharged.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Failed", name +" failed to process.", "error");
              
            }
           
        });
                                          
          },'json');    
  }
});

}


function doDelete(id,name)
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
          $.get('/delete-opd',
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
          // $('#accounttype').val(data.accounttype);
       
      });
                                        
        },'json');
  
}

var account_no = null;
function getDetails(acct_no)
{ 

  //alert(acct_no);

  account_no = acct_no;
  $.get("/opd-details",
          {"opd_number":account_no},
          function(json)
          {
           

            


                $('#edit-visit input[name="patient_id"]').val(json.patient_id);
                $('#edit-visit input[name="fullname"]').val(json.fullname);
                $('#edit-visit input[name="opd_number"]').val(json.opd_number);
                $('#edit-visit select[name="accounttype"]').val(json.accounttype);
                $('#edit-visit img[name="imagePreview"]').attr("src", '/images/'+json.image);
                $('#edit-visit input[name="uuid"]').val(json.uuid);
                $('#edit-visit select[name="consultation_type"]').val(json.consultation_type);
                $('#edit-visit select[name="referal_doctor"]').val(json.referal_doctor);
                $('#edit-visit select[name="accounttype"]').select2();
                $('#edit-visit select[name="referal_doctor"]').select2();
                $('#edit-visit select[name="consultation_type"]').select2();
                $('#edit-visit select[name="visit_type"]').select2();
                
                getAge();
                //loadRisk();
                loadBillState();

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
            //$('#accounttype').val(data.AccountType);
            $('#request_patient_id').val(data.PatientID);
            $('#request_name').val(data.PatientName);
            $('#request_visitid').val(data.VisitID);

            //$('#drug_quantity').val("");
       
      });
                                        
        },'json');
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




</script>




<div class="modal fade" id="edit-visit" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Visit Details</h4>
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
                           <form  class="bootstrap-modal-form" method="post" data-validate="parsley" action="/update-opd-detail" class="panel-body wrapper-lg">
                          @include('opd/edit')
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
