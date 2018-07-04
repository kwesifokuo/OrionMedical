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
                    <img src="/images/119066.svg" width="15%">
                    <a class="clear" href="/new-ipd"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">New Admission</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/387585.svg" width="15%">
                    </span>
                    <a class="clear" href="/show-admitted">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Ward Admissions</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/139290.svg" width="15%">
                    <a class="clear" href="/review-opd">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Operating Room</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/250500.svg" width="15%">
                    </span>
                    <a class="clear" href="/event-list">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Discharged</small>
                    </a>
                  </div>

                 
                </div>
              </section>


              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-patient-ipd" method="GET">
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
                            <th>#</th>
                            {{-- <th></th> --}}
                            <th>Patient ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Civil Status</th>
                            <th>Age</th>
                            <th>Date Entry</th>
                            <th width="30"></th>
                          </tr>
                        </thead>
                        <tbody>
                       @foreach( $patients as $keys => $patient )
                          <tr>
                            <td>{{ ++$keys }}</td>

                              {{-- <td> <a href="/images/{{ $patient->image }}" class="thumb-sm pull-left m-r-sm">
                                <img src="/images/{{ $patient->image }}" class="img-circle">
                              </a></td> --}}

                            <td>{{ $patient->patient_id }}</td>
                            <td>{{ ucwords(strtolower($patient->fullname)) }}</td>
                            <td>{{ $patient->gender }}</td>
                            <td>{{ $patient->civil_status }}</td>
                            <td>{{ $patient->date_of_birth->age }}</td>
                            <td>{{ $patient->created_at }}</td>
                            <td>
                              
                                 <a href="#modal_check_in" class="btn btn-s-sm btn-info btn-rounded bootstrap-modal-form-open" onclick="getDetails('{{ $patient->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-stethoscope"> </i> Admit </a>
                               
                            </td>
                            
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

             <a href="#new-service-request" class="bootstrap-modal-form-open float" data-toggle="modal">
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
  <link rel="stylesheet" href="{{ asset('/js/sweetalert.css')}}" type="text/css"/>
 <script src="{{ asset('/js/sweetalert.min.js')}}"></script>



<script>

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
                
                $('#modal_check_in select[name="referal_doctor"]').select2();
                $('#modal_check_in select[name="consultation_type"]').select2();
                $('#modal_check_in select[name="visit_type"]').select2();
                $('#modal_check_in select[name="anaesthetist"]').select2();
                $('#modal_check_in select[name="sponsor"]').select2();
                $('#modal_check_in img[name="imagePreview"]').attr("src", '/images/'+json.image);

                getAge();
                loadAvailable();


          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

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
           $('#accounttype').val(data.accounttype);
       
      });
                                        
        },'json');
  
}


function assignWard(wardnumber,bednumber)
  {
if($('#patient_id').val()!="" && $('#consultation_type').val()!="")
{
// alert($('#consultant_doctor').val());
    $.get('/assign-ward',
        {
          "patient_id": $('#patient_id').val(),
          "fullname": $('#fullname').val(),
          "referal_doctor": $('#referal_doctor').val(),
          "department": $('#department').val(),
          "consultation_type": $('#consultation_type').val(),
          "visit_type": $('#visit_type').val(),
           "accounttype": $('#accounttype').val(),
          "ward_id": wardnumber,
          "bed_id": bednumber
                        
        },
        function(data)
        { 
          
        $.each(data, function (key, value) 
        {
        if(data["OK"])
        {
          //sweetAlert("Bed was successfully assigned !");
          swal("Bed Assigned!", "Bed was successfully assigned!", "success")
           window.location.href = "/show-admitted";
        }
        else
        {
          sweetAlert("Bed failed to be assigned to patient!");
        }
      });
                                        
        },'json');
  }
  else
    {swal("Please select a consultation type!");}
  }


function loadAvailable()
   {
         
        
        $.get('/available-ward',
          {
            //"opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#wardTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#wardTable tbody').append('<tr><td>'+ value['ward_no'] +'</td><td>'+ value['ward_type'] +'</td><td>'+ value['total_beds'] +'</td><td>'+ value['occupied_beds'] +'</td><td>'+ value['unoccupied_beds'] +'</td><td>'+ value['cost'] +'</td><td><a onclick="assignWard(\''+value['ward_no']+'\',\''+value['unoccupied_beds']+'\')" class="btn btn-info rounded">Alot bed</a></td></tr>');
        });
                                          
         },'json');      
    }


</script>


<div class="modal fade" id="modal_check_in" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">IPD Registration</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class="active"><a href="#equitytab" data-toggle="tab">Admission Details</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" action="/ipd.assignPatientWard" class="panel-body wrapper-lg">
                          @include('ipd/admit')
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
