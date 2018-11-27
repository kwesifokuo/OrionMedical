@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
<p><span class="label label-success">{{ $visit_details->consultation_type }} - {{ $patients->fullname }}</span></p> 
<p class="block"><a href="#" class=""></a> <span class="label label-warning btn-rounded">{{ $visit_details->visit_type }}</span></p>
 <p class="block"><a href="#" class=""></a> <span class="label label-success btn-rounded">{{ $visit_details->opd_number }}</span></p>
 <p class="block"><a href="#" class=""></a> <span class="label label-danger btn-rounded">Created : {{ Carbon\Carbon::parse($visit_details->created_on)->diffForHumans() }}</span></p>


<div class="btn-group pull-right">
                    <p>
                    <a href="#" class="btn btn-rounded btn-sm btn-info"><i class="fa fa-fw fa-user"></i> {{ $visit_details->payercode }}</a>
                   <a href="#" class="btn btn-rounded btn-sm btn-primary"><i class="fa fa-fw fa-home"></i> {{ $visit_details->care_provider }} </a>
                    </p>
              </div>
            </header>
            <section class="scrollable">
              <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="clearfix m-b">
                          <a href="/images/{{ $patients->image }}" class="pull-left thumb m-r">
                            <img src="/images/{{ $patients->image }}" class="img-circle">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs">{{ $patients->fullname }}</div>
                            <br>
                            <div>
                           <p class="block"><a href="#" class="">ID # </a> <span class="label label-info">{{ $patients->patient_id }}</span></p>
                            </div>
                          </div>                
                        </div>
                        <div class="panel wrapper panel-success">
                          <div class="row">
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $patients->gender }}</span>
                                <small class="text-muted">Gender</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $patients->date_of_birth->age }}</span>
                                <small class="text-muted">Age</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h5 block">{{ $patients->civil_status }}</span>
                                <small class="text-muted">Status</small>
                              </a>
                            </div>
                          </div>
                        </div>
                       
                        <div>
                          <small class="text-uc text-xs text-muted">Mobile</small>
                          <p>+{{ $patients->mobile_number }}</p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted">Address</small>
                          <p>{{ $patients->postal_address }}</p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted">Email</small>
                         <p>{{ $patients->email }}</p>
                          </div>

                          <div>
                            <small class="text-uc text-xs text-muted">Date</small>
                          <p>{{ date('Y-m-d') }}</p>
                          <div class="line"></div>
                          <input type="hidden" id="opd_number" name="opd_number" value="{{ $prescriptions->visitid }}">
                         
                          <br>
                          <br>
                          </div> 
                          
                           

                           <a href="/images/BNF 57.pdf">
                        <img src="/images/bnf.png" style="width:100%" >
                        </a>
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="bg-white">
                  <section class="vbox">

                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#requested_tab" data-toggle="tab"> Requested </a></li>
                        <li class=""><a href="#dispensed_tab" data-toggle="tab"> Dispensed </a></li>
                        <li class=""><a href="#returned_tab" data-toggle="tab"> Returned </a></li>
                     
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="requested_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                            <form id="dispenseform" method="post" action="/dispense-medication" >
                          <div class="table-responsive">
                      <table id="drugTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                             <th width="20"><input type="checkbox"></th>
                            <th>#</th>
                            <th>Requested Date</th>
                            <th>Medication</th>
                            <th>Dosage</th>
                            <th>Quantity</th>
                            <th>Unit Cost</th>
                            <th>Total</th>
                            <th>Requested By</th>
                            <th>Status</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                     <footer class="panel-footer text-right bg-light lter">
                       <a href="/print-prescription/{{$visit_details->opd_number}}"> <button type="button" class="btn btn-default btn-s-xs"> Print   </button></a>

                        @if($outstanding > 0.5 and $visit_details->payercode=='Private')

                        @else
                        <button type="submit" class="btn btn-success btn-s-xs">Dispense</button>
                         <input type="hidden" name="_token" value="{{ Session::token() }}">
                        @endif

                      </footer> 
                      </form>
                          </ul>
                        
                      <p>
                    <a href="#" class="btn btn-danger btn-lg">Amount Due for drugs : GHS  {{ number_format($totalcost, 1, '.', ',') }}</a>
                  </p>
                  <br>
                   <br>
                      <br>
                       <br>
                        <br>
                  <div>
                             <a a href="#">Diagnosis : @foreach($mydiagnosis as $val) <label class="badge bg-info"> {{ $val->diagnosis }} </label> </a> @endforeach 
                            <a a href="#">CC : @foreach($mycomplaints as $val) <label class="badge bg-dark"> {{ $val->complaint }} </label> </a> @endforeach 
                          </div>
                        </div>

                        <div class="tab-pane" id="dispensed_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                            <form  method="post" action="/return-medication" >
                          <div class="table-responsive">
                      <table id="dispenseTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                             <th width="20"><input type="checkbox"></th>
                            <th>#</th>
                            <th>Dispensed Date</th>
                            <th>Medication</th>
                            <th>Remark</th>
                            <th>Quantity Dispensed</th>
                            <th>Quantity To Return</th>
                            <th>Unit Cost</th>
                            <th>Total</th>

                            <th></th>
                           
                          </tr>
                        </thead>
                        <tbody>
                     
                        </tbody>
                      </table>
                    </div>
                     <footer class="panel-footer text-right bg-light lter">
                       <a href="/print-prescription/{{$visit_details->opd_number}}"> <button type="button" class="btn btn-default btn-s-xs"> Print   </button></a>
                       @role(['System Admin','Pharmacist','Special Admin'])
                        <button type="submit" class="btn btn-success btn-s-xs">Return</button>
                        @endrole
                         <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </footer> 
                      </form>
                          </ul>

                          <p>
                    <a href="#" class="btn btn-primary btn-lg">Cost of drugs dispensed : GHS  {{ number_format($totaldispensed, 1, '.', ',') }}</a>
                  </p>

                        </div>


                        <div class="tab-pane" id="returned_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                           <div class="table-responsive">
                      <table id="returnTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                             <th width="20"><input type="checkbox"></th>
                            <th>#</th>
                            <th>Returned Date</th>
                            <th>Medication</th>
                            <th>Quantity Returned</th>
                            <th>Unit Cost</th>
                            <th>Total</th>

                            <th></th>
                           
                          </tr>
                        </thead>
                        <tbody>
                     
                        </tbody>
                      </table>
                    </div>
                          </ul>
                        </div>

                      

                      </div>
                    </section>
                  </section>
                  
                </aside>

                 <aside class="col-lg-2 b-l">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">



                       <section class="panel clearfix bg-default lter">
                          <div class="panel-body">
                          
                            <div class="clear">
                           <p>
                       <a href="#" class="btn btn-warning btn-s-md btn-lg pull-right"> Bill : GHS {{ $payables }}</a>
                      </p>
                      <p>
                       <a href="#" class="btn btn-success btn-s-md btn-lg pull-right"> Paid : GHS {{ $receivables }}</a>
                      </p>
                      <p>
                       <a href="#" class="btn btn-danger btn-s-md btn-lg pull-right"> Out. : GHS {{ $outstanding }}</a>
                      </p>
                            </div>
                          </div>
                        </section>

                       
                        <section class="panel clearfix bg-default lter">
                        
                          <div class="panel-body">
                          <div>
                           
                        </div>
                            <div class="clear">

                              <a href="https://reference.medscape.com/drug-interactionchecker" target="_new" class="btn btn-s-md btn-info btn-rounded m-t-xs"> <i class="fa fa-print"></i>Drug Interactions</a>

                              <a href="http://apps.who.int/medicinedocs/documents/s18014en/s18014en.pdf" target="_new" class="btn btn-s-md btn-success btn-rounded m-t-xs"> <i class="fa fa-print"></i>Ghana Medicine List</a>


                              <a href="" class="btn btn-s-md btn-warning btn-rounded m-t-xs"> <i class="fa fa-mail"></i> Drug Exclusion List </a>
                            </div>
                          </div>
                          
                          <div>
                            
                           @foreach($exclusions as $exclusion)
                               <a a href="#"> <label class="badge bg-danger"> {{$exclusion->service}} <i onclick="removecomplain('{{$exclusion->id}}','{{$exclusion->service}}')" class="fa fa-trash-o"></i></label></a>
                               @endforeach
                          
                          </div>
                        

                        </section>

 
                      </div>
                    </section>
                    </section>
                    </aside> 
    
                    </section>
                    </section>
                    </section>

  @stop

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function () {

                loadMedication();
                loadDispensedMedication();
                loadReturnedMedication();

               
  });

 

</script>
  <script type="text/javascript">
  function deletedrug(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+name+" from the prescription list?",   
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
          $.get('/delete-medication',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was removed from prescription list.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from prescription.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to be removed from prescription.", "error");   
        } });

    
   }



   function loadMedication()
   {
         
        $.get('/patient-medication-pending',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#drugTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#drugTable tbody').append('<tr><td><input type="checkbox" name="drug['+value['id']+']" id="'+value['id']+'" value="'+value['id']+'"></td><td>.</td><td>'+ value['created_on'] +'</td><td>'+ value['drug_name'] +'</td><td>'+ value['drug_application'] +'</td><td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" item_code="'+ value['id'] +'" value="'+ value['drug_quantity'] +'" onchange="change_count(this);"></td><td>'+ value['drug_cost'] +'</td><td>'+ value['drug_cost']*value['drug_quantity'] +'</td><td>'+ value['created_by'] +'</td><td>'+ (value['pay_status'] == "Unpaid" ? '<span class="label label-danger btn-rounded">'+ value['pay_status'] +'</span>' :  '<span class="label label-success btn-rounded">'+ value['pay_status'] +'</span>' ) +'</td><td><a a href="#"><i onclick="removeMedication(\''+value['id']+'\',\''+value['drug_name']+'\')" class="fa fa-trash-o"></i></a></td></tr>');

           
            // 
            });
                                          
         },'json');      
    }

    function loadDispensedMedication()
   {
         
        $.get('/medication-dispensed-to-patient',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#dispenseTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#dispenseTable tbody').append('<tr><td><input type="checkbox" name="drug['+value['id']+']" id="'+value['id']+'" value="'+value['id']+'"></td><td>1</td><td>'+ value['created_on'] +'</td><td>'+ value['drug_name'] +'</td><td>'+ value['drug_application'] +'</td><td><input type="text" readonly style="width:40px; border: 1px solid #ABADB3; text-align: center;" value="'+ value['drug_quantity'] +'" onchange="change_count(this);"></td><td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" item_code="'+ value['id'] +'" value="0" onchange="return_stock(this);"></td><td>'+ value['drug_cost'] +'</td><td>'+ value['drug_cost']*value['drug_quantity'] +'</td><td><a a href="#"><i onclick="removeMedication(\''+value['id']+'\',\''+value['drug_name']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
            

            // 
            });
                                          
         },'json');      
    }


    function loadReturnedMedication()
   {
         
        $.get('/medication-returned-to-patient',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#returnTable tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#returnTable tbody').append('<tr><td><input type="checkbox" name="drug['+value['id']+']" id="'+value['id']+'" value="'+value['id']+'"></td><td>1</td><td>'+ value['created_on'] +'</td><td>'+ value['drug_name'] +'</td><td><input type="text" style="width:40px; border: 1px solid #ABADB3 readonly; text-align: center;" item_code="'+ value['id'] +'" value="'+ value['drug_quantity'] +'" onchange="change_count(this);"></td><td>'+ value['drug_cost'] +'</td><td>'+ value['drug_cost']*value['drug_quantity'] +'</td><td><a a href="#"><i onclick="removeMedication(\''+value['id']+'\',\''+value['drug_name']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
            $('#drugTable footer').append('<tr><td class="text-right" style="text-align:right" colspan="5"><h4 style="padding-right: 40px;">Total <span style="font-size: 12px">(this is an approximate total, price may change)</span> : $ 407.00</h4></td></tr>');

            // 
            });
                                          
         },'json');      
    }


    function change_count(obj)
    {

      var item_code=$(obj).attr('item_code');
      var new_qty=parseInt($(obj).val());
        //alert(item_code);

          $.get('/update-drug-quantity',
          {
             "ID": item_code ,
             "drug_quantity": new_qty
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
             loadMedication();
             }
            else
            { 
             loadMedication();
              
            }
           
        });
                                          
          },'json');    
           
    }

    function return_stock(obj)
    {

      var item_code=$(obj).attr('item_code');
      var new_qty=parseInt($(obj).val());
        //alert(item_code);

          $.get('/return-drug-quantity',
          {
             "ID": item_code ,
             "drug_quantity": new_qty
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
             loadMedication();
             }
            else
            { 
             loadMedication();
              
            }
           
        });
                                          
          },'json');    
           
    }




  </script>


