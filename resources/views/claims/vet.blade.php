@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
              <p> Claim Vetting - {{ $visitdetails->name }} -  <a href="#" class="btn btn-rounded btn-sm btn-danger"> <strong> Admission Time/Date : </strong> {{ date("g:ia\, jS M Y", strtotime($visitdetails->created_on )) }} </a>  -   <a href="#" class="btn btn-rounded btn-sm btn-success"> <strong> Doctor's Name : </strong> {{ $visitdetails->referal_doctor }} </a></p>

                <div class="btn-group pull-right">
              <p>

                    <a href="#" class="btn btn-rounded btn-sm btn-info"><i class="fa fa-fw fa-user"></i> {{ $visitdetails->payercode }}</a>
                       <a href="#" class="btn btn-rounded btn-sm btn-primary"><i class="fa fa-fw fa-home"></i> {{ $visitdetails->care_provider }}  </a>
                   
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
                            <div class="h3 m-t-xs m-b-xs">{{ $visitdetails->name }}</div>
                            <br>
                            <div>
                           <span class="btn btn-xs btn-dark btn-rounded m-t-ml">{{ $visitdetails->patient_id }}</span>
                            </div>
                          </div>                
                        </div>


                          <div>
                          <ul class="list-group no-radius">
                          <li class="list-group-item">
                            <span class="pull-right">{{ $patients->mobile_number }}</span>
                           <div id="opd_number" name="opd_number" value="{{ $bills[0]->visit_id }}"></div>
                             <small class="text-muted">Mobile</small>
                          </li>
                            <li class="list-group-item">
                            <span class="pull-right">{{ $patients->postal_address }}</span>
                            
                             <small class="text-muted">Address</small>
                          </li>
                            <li class="list-group-item">
                            <span class="pull-right">{{ $patients->email }}</span>
                            
                             <small class="text-muted">Email</small>
                          </li>
                        </ul>
                          </div>

                           <img src="/images/489247.svg" style="width:100%" >

                        </div>

                    </section>
                  </section>
                </aside>
                 
                <aside class="bg-white">
                <form  data-validate="parsley" method="post" action="/do-vetting" class="panel-body wrapper-lg">
                
                <section class="panel panel-default">

                
                      <div class="panel-body">

                       <div class="line"></div>
                <p class="text-dark">Consultation Type :  <label class="badge bg-info"> {{ $visitdetails->consultation_type }} </label> </p>
               <p class="text-dark">Diagnosis or Nature of Illness : <label> @foreach($mydiagnosis as $val) <label class="badge bg-info"> {{ strtoupper($val->diagnosis) }} </label> @endforeach 
               </p>
                       
                       <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                          <div class="input-group m-b">
                           <select id="selected_item" name="selected_item" rows="3" tabindex="1" data-placeholder="Add New Service Item" style="width:100%">
                           <option value="">-- Nothing selected --</option>
                          @foreach($services as $service)
                        <option value="{{ $service->type }}">{{ $service->type }}</option>
                          @endforeach 
                        </select>           <div class="input-group-btn">
                           <a><button onclick="addInvestigation()"  class="btn btn-sm btn-default" type="button"><i class="fa fa-plus-circle"></i></button></a>
                        </div>     
                        </div>   
                          </div>
                        </div>

                        <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                          <div class="input-group m-b">
                           <select id="diagnosis" name="diagnosis" multiple rows="3" tabindex="1" data-placeholder="Add New Diagnosis Item" style="width:100%">
                           <option value="">-- Nothing selected --</option>
                  {{--         @foreach($services as $service)
                        <option value="{{ $service->type }}">{{ $service->type }}</option>
                          @endforeach  --}}
                        </select>           <div class="input-group-btn">
                           <a><button onclick="addDiagnosis()"  class="btn btn-sm btn-default" type="button"><i class="fa fa-plus-circle"></i></button></a>
                        </div>     
                        </div>   
                          </div>
                        </div>

                        
                      </div>
                      
                    </section>
                   



                  <section class="vbox">
              

                    <header class="panel-heading">
                  Claim Items
                </header>

                   <p>
                    <a href="#" class="btn btn-danger btn-lg pull-right">Amount Due : GHS {{ number_format($outstanding , 1, '.', ',') }} </a>
                  </p>
                

                         <div class="table-responsive">
               
                       <table id="invoiceTable" cellpadding="0" cellspacing="0" border="2" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                              <th width="20"><input type="checkbox" ></th>
                               <th>#</th>
                              <th>Item Name</th>
                               <th>Source</th>
                              <th>Quantity</th>
                              <th>Unit Price</th>
                              <th>Amount Payable</th>
                              <th>Status</th>
                              <th></th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($bills as $keys => $bill)
   
                        @if($bill->quantity  == 0)
                          <tr bgcolor="#F5B7B1">
                        @else
                        <tr>
                        @endif
                            <td><input type="checkbox" checked="checked" name="item[{{ $bill->uuid }}]" id="{{ $bill->uuid }}" value="{{ $bill->uuid }}"></td>
                           <td>{{ ++$keys }}</td>
                            <td>{{ $bill->item_name }}</td>
                             <td>{{ $bill->category }}</td>
                            <td>{{ $bill->quantity }}</td>
                            <td>{{ $bill->rate }}</td>
                            
                             
                             <td>{{ $bill->rate * $bill->quantity  }}</td>
                              <td>{{ $bill->claimstatus }}</td>
                             @role(['System Admin','Billing'])
                             <td><a href="#" onclick="excludefrombill('{{ $bill->id }}','{{ $bill->item_name }}')" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a></td> 
                             @endrole 
                             </tr>
                            @endforeach
                          </tbody>
                        </table>
                          

                          
                </div>
                
                  <div class="line"></div>

                   <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label>Remarks</label> 
                            <div class="form-group{{ $errors->has('vetting_remark') ? ' has-error' : ''}}">
                            <textarea type="text" rows="3" class="form-control" id="vetting_remark" name="vetting_remark" value="{{ Request::old('vetting_remark') ?: '' }}">{{ $bills[0]->vetting_remark }}</textarea>   
                           @if ($errors->has('vetting_remark'))
                          <span class="help-block">{{ $errors->first('vetting_remark') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>


                          
                        <input type="hidden" name="totalamount" id="totalamount" value="{{ $payables }}" >
                        
                         <div class="doc-buttons">
                        <a href="#" onclick="rejectclaim()" class="btn btn-danger btn-s-xs rounded pull-right">Reject</a>
                      
                         <a href="#" onclick="queryclaim()" class="btn btn-warning btn-s-xs rounded pull-right">Query</a>
                       
                          <a href="#" onclick="approveclaim()" class="btn btn-success btn-s-xs rounded pull-right">Approve</a>
                          </div>
                          <input type="hidden" name="url" id="url" value="{{$url}}">
                          <input type="hidden" name="visit_id" id="visit_id" value="{{ $visitdetails->opd_number }}">
                          <input type="hidden" name="patient_id" id="patient_id" value="{{ $visitdetails->patient_id }}">
                          <input type="hidden" name="payercode" id="payercode" value="{{ $visitdetails->payercode }}">
                          <input type="hidden" name="fullname" id="fullname" value="{{ $visitdetails->name }}">
                          <input type="hidden" name="_token" value="{{ Session::token() }}">

                   
                  </section>
                  </form>
                  
                </aside>

               
                 
            </section>
        </section>
        
  </section>

  @stop




  

  <script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function () {
   
    $('#selected_item').select2();
     $('#diagnosis').select2({
      tags: true
      });
    //loadInvestigation();
    

  });

function excludefrombill(id,name)
  {

         
      swal({   
        title: "Are you sure?",   
        text: "Do you want to exclude "+name+" ?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, exclude it!",   
        cancelButtonText: "No, cancel !",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/exclude-from-bill',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Excluded!", "Successfully excluded.", "success"); 
              //loadinvoiceitems();
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", "Operation failed", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", "Operation failed", "error");   
        } });

  }

  
function addInvestigation()
{
if($('#selected_item').val()!= "")
{
    //alert($('#payercode').val());

    $.get('/add-investigation',
        {
          "patient_id":  $('#patient_id').val(),
          "accounttype": $('#payercode').val(),
          "opd_number":  $('#visit_id').val(),
          "investigation": $('#selected_item').val(),
          "fullname":  $('#fullname').val()                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
         
          location.reload(true);
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


function addDiagnosis()
{
if($('#diagnosis').val()!= "")
{

    $.get('/add-diagnosis',
        {
          "patient_id": $('#patient_id').val(),
          "opd_number": $('#visit_id').val(),
          "diagnosis":  $('#diagnosis').val(),
          "code":       $('#diagnosis_remark').val(),
          "fullname":  $('#fullname').val()                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          location.reload(true);
        }
        else
        {
          sweetAlert("Diagnosis failed to be added!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please select a Diagnosis!");}
}


function approveclaim()
{

    $.get('/approve-claim',
        {
         
          "opd_number": $('#visit_id').val(),
          "vetting_remark": $('#vetting_remark').val()
                        
        },
        function(data)
        { 
          
        $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          location.reload(true);
        }
        else
        {
          sweetAlert("Claim failed to approve!");
        }
      });
                                        
        },'json');
 
}

function rejectclaim()
{

    $.get('/reject-claim',
        {
         
          "opd_number": $('#visit_id').val(),
          "vetting_remark": $('#vetting_remark').val()
                            
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          location.reload(true);
        }
        else
        {
          sweetAlert("Action failed!");
        }
      });
                                        
        },'json');
 
}


function queryclaim()
{


    $.get('/query-claim',
        {
          
          "opd_number": $('#visit_id').val(),
          "vetting_remark": $('#vetting_remark').val()
              
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          
          location.reload(true);
        }
        else
        {
          sweetAlert("Action failed!");
        }
      });
                                        
        },'json');
  
}

</script>






<div class="modal fade" id="new-service" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add Service<span id="selectedName"></span></h4>
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
                        <div class="tab-pane active" id="details">
                            <form  class="bootstrap-modal-form" data-validate="parsley" method="post" action="/do-payment" class="panel-body wrapper-lg">
                          @include('billing/service')
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
          <h4 class="modal-title">Charge Service Request</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" action="" class="panel-body wrapper-lg">
                         @include('billing.service')
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
