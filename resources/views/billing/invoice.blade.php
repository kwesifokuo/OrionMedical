@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
              <p>{{ $visitdetails->name }}'s Bill </p>
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

                           <img src="/images/384493.svg" style="width:100%" >

                        </div>

                    </section>
                  </section>
                </aside>
                 
                <aside class="bg-white">
                <form  data-validate="parsley" method="post" action="/do-payment" class="panel-body wrapper-lg">
                <section class="panel panel-default">
                  
                    @role(['Billing','System Admin','Special Admin'])
                      <div class="panel-body">
                       
                        <div class="clearfix m-b">

                          <a href="#" class="thumb-lg">
                            <img src="" name="imagePreview" id="imagePreview"  class="img-circle">
                          </a>
                          
                        </div>
                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('paymentmethod') ? ' has-error' : ''}}">
                            <label>Payment Method</label>
                            <select id="paymentmethod" name="paymentmethod" data-required="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                           @foreach($receiptmodes as $receiptmode)
                        <option value="{{ $receiptmode->type }}">{{ $receiptmode->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('paymentmethod'))
                          <span class="help-block">{{ $errors->first('paymentmethod') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-6">
                            <label>Reference Number</label> 
                            <div class="form-group{{ $errors->has('referencenumber') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control"  id="referencenumber" name="referencenumber" value="{{ Request::old('referencenumber') ?: '' }}">   
                           @if ($errors->has('referencenumber'))
                          <span class="help-block">{{ $errors->first('referencenumber') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                         <div class="col-sm-6 ">
                            <label>Amount Received</label> 
                            <div class="form-group{{ $errors->has('amountreceived') ? ' has-error' : ''}} has-success">
                            <input type="number" min="0" value="0" step="0.01"  class="form-control" id="amountreceived" data-required="true" value="{{ Request::old('amountreceived') ?: '' }}"  name="amountreceived">   
                           @if ($errors->has('amountreceived'))
                          <span class="help-block">{{ $errors->first('amountreceived') }}</span>
                           @endif    
                          </div>
                          </div>

                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                         <div class="form-group{{ $errors->has('fullname') ? ' has-error' : ''}}">
                          <label>Paid By </label>
                          <input type="text" class="form-control" id="fullname_paid" data-required="true" value="{{ Request::old('fullname') ?: '' }}"  name="fullname_paid">
                          @if ($errors->has('fullname'))
                          <span class="help-block">{{ $errors->first('fullname') }}</span>
                           @endif                        
                        </div>
                        </div>
                        </div>


                        <br>
                        <br>
                        <br>
                        <br>
                             
                        <footer class="panel-footer text-right bg-light lter">
                        <a href="/billing-print/{{ $bills[0]->visit_id }}"><button type="button" class="btn btn-warning btn-s-xs">Print Bill</button></a> 
                        <input type="hidden" name="totalamount" id="totalamount" value="{{ $payables }}" >
                        <button type="submit" class="btn btn-success btn-s-xs">Pay</button>
                         <input type="hidden" name="visit_id" id="visit_id" value="{{ $visitdetails->opd_number }}">
                          <input type="hidden" name="patient_id" id="patient_id" value="{{ $visitdetails->patient_id }}">
                          <input type="hidden" name="payercode" id="payercode" value="{{ $visitdetails->payercode }}">
                          <input type="hidden" name="fullname" id="fullname" value="{{ $visitdetails->name }}">
                          <input type="hidden" name="_token" value="{{ Session::token() }}">
                          <input type="hidden" name="outstanding" id="outstanding" value="{{ $outstanding }}">
                      </footer>
                     
                      </div>
                       @endrole
                    </section>
                   



                  <section class="vbox">
               {{--      <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#consultation_tab" data-toggle="tab"> Billable Items </a></li>
                        
                      </ul>
                    </header> --}}
                    <header class="panel-heading">
                  Items Payable
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
                               <th>Date</th>
                              <th>Item Name</th>
                              <th>Quantity</th>
                              <th>Unit Price</th>
                              <th>Source</th>
                              <th>Discount</th>
                              <th>Amount Payable</th>
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
                            <td>{{ $bill->date }}</td>
                            <td>{{ $bill->item_name }}</td>
                            <td>{{ $bill->quantity }}</td>
                            <td>{{ $bill->rate }}</td>
                             <td>{{ $bill->category }}</td>
                              <td>0</td>
                             <td>{{ $bill->rate * $bill->quantity  }}</td>
                             @role(['System Admin','Billing'])
                             <td><a href="#" onclick="excludefrombill('{{ $bill->id }}','{{ $bill->item_name }}')" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a></td> 
                             @endrole 
                             </tr>
                            @endforeach
                          </tbody>
                        </table>
                         

                          
                </div>

                
                 


                   
                  </section>
                  
                  <footer>
                  
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
                </footer>
                </aside>
                 </form>
               

                 
            </section>
        </section>
        
  </section>

  @stop




  

  <script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function () {
   
    $('#selected_item').select2();
    //loadInvestigation();
    

  });

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

  


</script>





