
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Nurse Station </li>
              </ul>

             
             <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                     <img src="/images/801699.svg" width="15%" class="pull-left">
                    <a class="clear" href="/nurse-station"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Checked In</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/816721.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Practitioners List</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/139290.svg" width="15%" class="pull-left">
                    <a class="clear" href="/ipd-consultation">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Admissions & Dententions</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/845102.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/nurse-calendar">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Handing Notes</small>
                    </a>
                  </div>

                 
                </div>
              </section>


              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-nurse-folder" method="GET">


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
                          
                         <th>Visit #</th>
                           
                            <th>Time In</th>
                            <th>Patient Name</th>
                             <th>Visit Type</th>
                            <th>Chief Complaint</th>
                            <th>Practioner</th>
                            <th>Location</th>
                             <th>Care Provider</th>
                            <th width="30"></th>
                            <th width="30"></th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $patients as $patient )
                        @if($patient->consultation_type == 'DENTAL CONSULTATION')
                          <tr bgcolor="#DCE775">
                        @elseif($patient->consultation_type == 'DENTAL CONSULTATION FOLLOW UP')
                        <tr bgcolor="#DCE775">
                        @else
                        <tr>
                        @endif
                       
                             <td><a href="/patient-profile/{{ $patient->patient_id }}"  id="edit" name="edit" data-toggle="modal" alt="edit">{{ $patient->opd_number }}</a></td>
                             <td>{{ $patient->created_on->format('H:i:s - jS M Y') }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->consultation_type }}</td>
                             
                              @role(['Nurse','System Admin'])
                             <td>{{ $patient->chief_complaint }}</td>
                             @endrole
                            {{--  <td>{{ $patient->referal_doctor }}</td> --}}
                             <td>
                                <div class="input-group-btn">
                          
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">{{ $patient->referal_doctor }} <span class="caret"></span></button>
                            
                            <ul class="dropdown-menu pull-right">
                            @foreach($doctors as $doctor)
                            <li><a onclick="assignDoctor('{{ $patient->id }}','{{ $doctor->name }}')">{{ $doctor->name }}</a></li>
                            @endforeach
                            </ul>
                            </div>
                            </td>

                              <td>
                                <div class="input-group-btn">
                            @if($patient->location==="Consulting Room 1")
                            <button type="button" class="btn btn-success btn-xs dropdown-toggle" style="background-color: #bc65bd" data-toggle="dropdown">{{ $patient->location }} <span class="caret"></span></button>
                            @elseif($patient->location==="Consulting Room 2")
                            <button type="button" class="btn btn-success btn-xs dropdown-toggle" style="background-color: #f79554" data-toggle="dropdown">{{ $patient->location }} <span class="caret"></span></button>
                              @elseif($patient->location==="Consulting Room 3")
                            <button type="button" class="btn btn-dark btn-xs dropdown-toggle"  data-toggle="dropdown">{{ $patient->location }} <span class="caret"></span></button>
                              @elseif($patient->location==="Consulting Room 4")
                            <button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown">{{ $patient->location }} <span class="caret"></span></button>
                             @elseif($patient->location==="Consulting Room 5")
                            <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">{{ $patient->location }} <span class="caret"></span></button>
                              @elseif($patient->location==="Waiting Room")
                            <button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown">{{ $patient->location }} <span class="caret"></span></button>
                              @elseif($patient->location==="Confirmed by email")
                            <button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown">{{ $patient->location }} <span class="caret"></span></button>
                              @elseif($patient->location==="Triage Room")
                            <button type="button" class="btn btn-primary btn-xs dropdown-toggle" style="background-color: #f79554" data-toggle="dropdown">{{ $patient->location }} <span class="caret"></span></button>
                             @elseif($patient->location==="Treatment Room")
                            <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">{{ $patient->location }} <span class="caret"></span></button>
                              @elseif($patient->location==="Radiology")
                            <button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown">{{ $patient->location }} <span class="caret"></span></button>
                             @elseif($patient->location==="Lab")
                            <button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown">{{ $patient->location }} <span class="caret"></span></button>
                            @else
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">{{ $patient->location }} <span class="caret"></span></button>
                            @endif
                            <ul class="dropdown-menu pull-right">
                            @foreach($locations as $location)
                            <li><a onclick="updateLocationStatus('{{ $patient->id }}','{{ $location->type }}')">{{ $location->type }}</a></li>
                            @endforeach
                            </ul>
                            </div>
                            </td>



                              <td>{{$patient->payercode }} , {{ $patient->care_provider }}</td>

                                 <td><a href="/nurse-review/{{ $patient->opd_number }}" class="btn btn-rounded btn-sm btn-info" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-stethoscope" data-toggle="tooltip" data-placement="top" title="" data-original-title="Consult"> </i> Review </a></td>
                      
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

function getDetails(visitid,patientid)
{ 

  $.get("/opd-details",
          {
            "opd_number" : visitid
            
          },
          function(json)
          {

                //alert(json.haha);
                $('#review-patient input[name="patient_id"]').val(json.patient_id);
                $('#review-patient input[name="fullname"]').val(json.fullname);
                $('#review-patient input[name="opd_number"]').val(json.opd_number);
                $('#review-patient input[name="pulse_rate"]').val(json.pulse_rate);
                $('#review-patient input[name="blood_pressure"]').val(json.blood_pressure);
                $('#review-patient input[name="respiration"]').val(json.respiration);
                $('#review-patient input[name="height"]').val(json.bmi_height);
                $('#review-patient input[name="weight"]').val(json.bmi_weight);
                $('#review-patient input[name="temperature"]').val(json.temperature);
                $('#review-patient input[name="bmi"]').val(json.bmi_weight/(json.bmi_height*json.bmi_height));
                $('#review-patient input[name="consultation_title"]').val(json.consultant_doctor);
                $('#review-patient select[name="complaint"]').select2();
                $('#review-patient select[name="investigation"]').select2();
                $('#review-patient select[name="diagnosis"]').select2();
                $('#review-patient select[name="diagnosis_category"]').select2();
                $('#review-patient select[name="procedure"]').select2();
                $('#review-patient select[name="medication"]').select2();
                $('#review-patient select[name="drug_quantity"]').select2();
                $('#review-patient select[name="history"]').select2();
                $('#review-patient select[name="drug_frequency"]').select2();
                $('#review-patient select[name="drug_dosage"]').select2();
                $('#review-patient select[name="drug_application"]').select2();
                $('#review-patient select[name="drug_days"]').select2();
                $('#review-patient select[name="drug_period"]').select2();
                $('#review-patient input[name="selectedid"]').val(json.patient_id);

                $('#review-patient img[name="imagePreview"]').attr("src", '/images/'+json.patient_id+'.jpg');
                $('#review-patient a[name="visitid"]').attr("href", '/print-prescription/'+json.opd_number);

          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}
  
  function addVitals()
{


    $.get('/add-vitals',
        {
          "patient_id": $('#patient_id').val(),
          "opd_number": $('#opd_number').val(),
          "weight": $('#weight').val(),
          "height": $('#height').val(),
          "waist_circumference": $('#waist_circumference').val(),
          "hip_circumference":  $('#hip_circumference').val(),
          "frame": $('#frame').val(),
          "b_fat": $('#b_fat').val(),
          "v_fat": $('#v_fat').val(),
          "pulse_rate": $('#pulse_rate').val(),
          "blood_pressure": $('#blood_pressure').val(),
          "respiration": $('#respiration').val(),
          "temperature": $('#temperature').val(),
          "rbs": $('#rbs').val(),
          "fbs": $('#fbs').val(),
          "spo2": $('#spo2').val()                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          sweetAlert("Vital parameters added!");
        }
        else
        {
          sweetAlert("Vital parameters failed to be added!");
        }
      });
                                        
        },'json');
 
}



  function updateLocationStatus(id,status)
{
  //alert(status);

    $.get('/update-location-status',
        {
          "id": id,
          "status": status,                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          location.reload(true);
           toastr.success("Location changed!");
           
        }
        else
        {
          toastr.error("Error updating location!");
        }
      });
                                        
        },'json');
  }
  


function updateCareStatus(id,status)
{

    $.get('/update-location-status',
        {
          "id": id,
          "status": status,                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          location.reload(true);
           toastr.success("Status updated!");
           
        }
        else
        {
          toastr.error("Error updating status!");
        }
      });
                                        
        },'json');
  }


  function assignDoctor(id,doctor)
{

    $.get('/assign-doctor-patient',
        {
          "id": id,
          "doctor": doctor,                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          location.reload(true);
           toastr.success("Doctor assigned!");
           
        }
        else
        {
          toastr.error("Error assigning doctor!");
        }
      });
                                        
        },'json');
  }
  

</script>



