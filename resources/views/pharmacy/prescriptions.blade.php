

@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Pharmacy Manager </li>
              </ul>

             
             <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                      <img src="/images/139202.svg" width="15%">
                    <a class="clear" href="/prescriptions-pending"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>{{ $requested }}</strong></span>
                      <small class="text-muted text-uc">Requested</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                     <img src="/images/139180.svg" width="15%">
                    </span>
                    <a class="clear" href="/prescriptions-dispensed">
                      <span class="h3 block m-t-xs"><strong id="bugs">{{ $dispensed }}</strong></span>
                      <small class="text-muted text-uc">Dispensed</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                     <img src="/images/273298.svg" width="15%">
                    <a class="clear" href="/prescriptions-returned">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Returned</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                     <img src="/images/395537.png" width="15%">
                    </span>
                    <a class="clear" href="/list-of-drugs-avaliable">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Drugs in stock</small>
                    </a>
                  </div>

                 
                </div>
              </section>


              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default scrollable padder">
                  <header class="panel-heading">
                    <form action="/find-prescription" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by drug name, patient, status">
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
                            
                            <th width="20"></th>
                            <th>Visit Number</th>
                            <th>Patient Number</th>
                            <th>Patient Name</th>
                            <th>Prescriber</th>
                            <th>Medication</th>
          {{--                   <th>Quantity</th>
                             <th>Unit Price</th>
                              <th>Cost</th> --}}
                            <th>Date</th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($prescriptions as $prescription)
                          <tr>
                            
                            <td><a href="#modal_check_in" class="bootstrap-modal-form-open" onclick="getdrug('{{ $prescription->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil"></i></a></td>
                            <td>{{ $prescription->visitid }}</td>
                            <td>{{ $prescription->patientid }}</td>
                            <td>{{ $prescription->patient_name }}</td>
                            <td>{{ $prescription->created_by }}</td>
                            <td>{{ $prescription->drug_name }}</td>
           {{--                  <td>{{ $prescription->drug_quantity }}</td>
                           <td>{{ $prescription->drug_cost }}</td>
                           <td>{{ $prescription->drug_cost * $prescription->drug_quantity }}</td> --}}
                            <td>{{ $prescription->created_on }}</td>
                            
                            <td>
                                 @if($prescription->status != 'Dispensed')
                                   <a href="/dispense-medication-master/{{ $prescription->visitid }}" class="btn btn-s-md btn-primary btn-rounded bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit">Dispense Medication</a>
                               @elseif($prescription->status == 'Dispensed')
                                   <a href="/dispense-medication-master/{{ $prescription->visitid }}" class="btn btn-s-md btn-default btn-rounded bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit">View</a>
                                @else
                                  <a href="#" class="btn btn-s-md btn-info btn-rounded bootstrap-modal-form-open" onclick=""  id="edit" name="edit" data-toggle="modal" alt="edit">Dispensed</a>
                                @endif
                            </td>
                            {{--  <td><a href="/print-prescription/{{$prescription->visitid}}" class="bootstrap-modal-form-open" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-print"></i></a></td>  --}}

                                @if($prescription->created_by == Auth::user()->getNameOrUsername())
                              <td><a href="/walkin-service/{{$prescription->visitid}}" class="bootstrap-modal-form-open" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil"></i></a></td> 
                              @else


                              @endif
                              
                            
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
                  <a href="#new-request" class="bootstrap-modal-form-open float" data-toggle="modal">
<i class="fa fa-plus my-float"></i><i class="fa fa-upload my-float"></i>
</a>

                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $prescriptions->total() }} {{ str_plural('Drug', $prescriptions->total()) }}</span>
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xxs">                
                     
                        {!!$prescriptions->render()!!}
                        
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
   
    $('#medication').select2();
  });
</script>


  <script>



function getdrug(id)
{ 
//alert(id);
  $.get("/get-prescription",
          {"id":id},
          function(json)
          {


                $('#administer-medication input[name="ItemID"]').val(json.ID);
                $('#administer-medication input[name="VisitID"]').val(json.VisitID);
                $('#administer-medication input[name="PatientID"]').val(json.PatientID);
                $('#administer-medication input[name="PatientName"]').val(json.PatientName);
                $('#administer-medication img[name="imagePreview"]').attr("src", '/images/'+json.PatientID+'.jpg');
                $('#administer-medication a[name="visitid"]').attr("href", '/print-prescription/'+json.VisitID);
                loadMedication();
                loadTotalCost();
                getAge();

          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}


function getAge()
{

    $.get('/patient-age-occupation',
        {

          "id": $('#PatientID').val()
         
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

function loadTotalCost()
{
  $.get('/drug-total',
          {
            "id": $('#VisitID').val()
          },
          function(data)
          { 
               $.each(data, function (key, value) {
        
        
            $('#administer-medication label[name="totalcost"]').text(data.total_price);
            //sweetAlert("Total Bill : ", 'GHS'+ data["total_price"], "info");

            
          });
                                          
         },'json');   
}



function addDrug()
{
if($('#medication').val()!= "" && $('#drug_quantity').val()!=0 && $('#patient_id').val()!= "")
{

    $.get('/add-medication',
        {
          "patient_id": $('#request_patient_id').val(),
          "opd_number": $('#request_visitid').val(),
          "medication": $('#medication').val(),
          "fullname":  $('#request_name').val(),
          "drug_quantity": $('#drug_quantity').val(),
          "drug_dosage": $('#drug_dosage').val(),
          "drug_application": $('#drug_application').val(),
          "drug_frequency": $('#drug_frequency').val(),
          "drug_days": $('#drug_days').val(),
          "drug_span": $('#drug_span').val()                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          loadMedication();
          $('#medication').val()!= "";
        }
        else
        {
          sweetAlert("Drug failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please complete form!");}
}




function getVisitDetails()
{

 if($('#request_name').val() != "")
 {


 $.get('/get-visit-details-pharmacy',
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


function loadMedication()
   {
         
        
        $.get('/patient-medication',
          {
            "opd_number": $('#request_visitid').val()
          },
          function(data)
          { 

            $('#drugTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#drugTable tbody').append('<tr><td>'+ value['drug_quantity'] +'</td><td>'+ value['drug_name'] +'</td><td>'+ value['drug_application'] +'</td><td>'+ value['drug_cost'] +'</td><td>'+ value['drug_cost']*value['drug_quantity'] +'</td><td><a a href="#"><i onclick="removeMedication(\''+value['id']+'\',\''+value['drug_name']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }

   


function dispenseMedication(id,name)
{

  if($('#receipt_number').val()=="")
  {sweetAlert("Payment must be made first ",'Please enter receipt number', "error");}

else
{
  swal({   
        title: "Are you sure?",   
        text: "Do you want to dispense "+ name + " from the prescription list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, dispense it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/dispense-medication',
          {
             "id": id, 
             "receipt_number": $('#receipt_number').val() 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Dispense!", name +" was dispensed from prescription list.", "success"); 
              loadMedication();
               loadTotalCost();
             }
            else
            { 
              swal("Cancelled", name +" failed to be dispensed from prescription.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to be dispensed from prescription.", "error");   
        } });
}





}


 function getdrugdetail()
{ 
   //alert($('#medication').val());\



  $.get("/get-drug-info",
          {"medication": $('#medication').val()},
          function(json)
          {


              
                $('#drug_dosage').val(json['drug_dosage']);
                $('#drug_form').val(json['drug_form']);
                $('#drug_pack_size').val(json['drug_pack_size']);
                $('#drug_generic').val(json['drug_generic']);

                $('#drug_quantity').val("");
              //}
          },
          'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}


function updatePrescription()
  {
if($('#VisitID').val()!="")
{

    $.get('/update-prescription-status',
        {

          "ItemID": $('#ItemID').val(),
          "DrugQuantity": $('#DrugQuantity').val(),
          "DrugFrequency": $('#DrugFrequency').val(),
          "DrugDosage":  $('#DrugDosage').val(), 
          "DrugApplication":  $('#DrugApplication').val(),                  
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          sweetAlert("Drug has successfully been processed!");
         
        }
        else
        {
          sweetAlert("Drug is out of stock!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Error processing medication dispense");}
  }



</script>



 <div class="modal fade" id="new-request" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">New Request</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form"  method="post" action="/update-prescription-status" class="panel-body wrapper-lg">
                           @include('pharmacy.request')
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

