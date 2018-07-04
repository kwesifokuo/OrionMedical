@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
          <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Supplier Manager</div>
              <ul class="nav">

          <ul class="nav">
           <li class="b-b b-light"><a href="/pharmacy.dashboard"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Overview</a></li>
                <li class="b-b b-light"><a href="/supplier-payments"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Payments</a></li>
                <li class="b-b b-light"><a href="/supplier-purchases"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Purchases</a></li>
                <li class="b-b b-light"><a href="/supplier-bills"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Inovices</a></li>
                 <li class="b-b b-light"><a href="/drugs-pending-approval"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Pending Approval</a></li>
               
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print List</a>
{{--                      <span class="badge badge-info">Record(s) Found :  {{ $items->total() }} {{ str_plural('Branch', $items->total()) }}</span> --}}
                    </div>

                  <form action="/#" method="GET">
                    <div class="col-sm-4 m-b-xs">
                      <div class="input-group">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search ...">
                        <span class="input-group-btn">
                          <button class="btn btn-sm btn-default" type="submit">Go!</button>
                        </span>
                      </div>
                    </div>
                     </form>
                    </div>
                  </div>
                </header>
                <section class="scrollable wrapper w-f">
                  <section class="panel panel-default">
                  <header class="panel-heading font-bold">Drugs Pending Approval
                                 <a href="#new-invoice" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-info pull-right">+</span></a>
                                </header>
                    <div class="table-responsive">
                     <table class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                          <tr>
                            <th width="20"><input type="checkbox"></th>
                            <th></th>
                            <th>Display Name</th>
                            <th>Supplier</th>
                            <th>Unit</th>
                            <th>Pack Size</th>
                            <th>Stock level</th>
                             @role(['System Admin','Pharmacist'])
                            <th>Current Pack Price</th>
                            <th>Current Unit Price</th>
                             @endrole
                            <th>Selling Price</th>
                            <th>Corporate S.P </th>
                            <th>Expiry Date</th>
                            <th></th>
                            
                          </tr>
                        </thead>
                        <tbody>
                      <form  method="post" action="/approve-drug-bulk" >
                        @foreach($drugs as $key => $drug )
                          <tr>
                            <td><input type="checkbox" name="drug[{{ $drug->id}}]" id="{{ $drug->id }}" value="{{ $drug->id }}"></td>
                            <td>{{ ++$key }}</td>
                            <td>{{ $drug->name }}</td>
                            <td>{{ $drug->supplier }}</td>
                            <td>{{ $drug->drug_application_default }}</td>
                            <td>{{ $drug->drug_quantity_default }}</td>
                            <td>{{ $drug->stock }}</td>
                           
                            @role(['Pharmacist','System Admin'])
                            <td>{{ $drug->sale_price }}</td>
                            <td>{{ $drug->unit_price }}</td>
                              @endrole
                             <td>{{ $drug->unit_price * 1.45 }}</td>
                             <td>{{ $drug->unit_price * 1.50 }}</td>
                          
                            <td>{{ $drug->expiry_date->diffForHumans() }}</td>
                            <td>
                                @if($drug->expiry_date <= Carbon\Carbon::today())

                                <a href="#new-expired-drug" data-toggle="modal" class="bootstrap-modal-form-open" onclick="getdrugdetail('{{ $drug->id }}')"><span class="label bg-danger pull-right"> Expired </span>
                                </a>
                                @else
                                    @if($drug->stock === 0)
                                       <a href="#edit-drug" data-toggle="modal" class="bootstrap-modal-form-open" onclick="getdrugdetail('{{ $drug->id }}')"><span class="label bg-danger pull-right"> Out-of-Stock </span></a>
                                    @elseif($drug->stock <= $drug->stock_alert)
                                       <a href="#edit-drug" data-toggle="modal" class="bootstrap-modal-form-open" onclick="getdrugdetail('{{ $drug->id }}')" ><span class="label bg-warning pull-right"> Low-Stock </span></a>
                                    @else
                                       <a href="#" ><span class="label bg-success pull-right"> Available </span></a>
                                    @endif

                                @endif
                            </td>
                            
                          </tr>
                         @endforeach
                        </tbody>
 
                      </table>
                    </div>
                  </section>
                </section>
                <footer class="footer bg-white b-t">
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t">
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                        {!! $drugs->render()!!} 
                          <input type="hidden" name="_token" value="{{ Session::token() }}">
                         <button type="submit" class="btn btn-sm btn-success pull-left"><i class="fa fa-add"></i> Approve </button>
                        
                    </div>
                  </div>
                   </form>
                </footer>
                
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop




<script src="{{ asset('/js/jquery.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function () {
   
    $('#medication').select2();
    $('#supplier').select2();


  });
</script>


<script>

function addInvoices()
{
if($('#invoice_number').val()!= "")
{

    $.get('/add-drug-invoice',
        {
          "invoice_number": $('#invoice_number').val(),
          "invoice_date": $('#invoice_date').val(),
          "invoice_description": $('#invoice_description').val(),

          "medication": $('#medication').val(),
          "supplier": $('#supplier').val(),
          "quantity":  $('#quantity').val(),
          "unit_price":  $('#unit_price').val(),
          "cost_price":  $('#cost_price').val(), 
           "sale_price":  $('#sale_price').val()                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
         
          loadInvoices();
          $('#invoice_number').val()!= ""
        }
        else
        {
          sweetAlert("Invoice failed to add!");
        }
      });
                                        
        },'json');
  }
  else
    {sweetAlert("Please select a medication!");}
}


function loadInvoices()
   {
         
        
        $.get('/fetch-invoices',
          {
            "invoice_number": $('#invoice_number').val()
          },
          function(data)
          { 

            $('#invoicesTable tbody').empty();
            $.each(data, function (key, value) 
            {           
           $('#invoicesTable tbody').append('<tr><td>'+ value['name'] +'</td><td>'+ value['quantity'] +'</td><td>'+ value['unit_price'] +'</td><td>'+ value['unit_price']* value['quantity'] +'</td><td>'+ value['cost_price'] +'</td><td>'+ value['sale_price'] +'</td><td><a a href=""><i onclick="" class="fa fa-pencil"></i></a></td><td><a a href="#"><i onclick="removeinvestigation(\''+value['id']+'\',\''+value['investigation']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');      
    }



  function deleteDetails(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+ name +" from list?",   
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
          $.get('/delete-location',
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
               location.reload(true);
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled","Failed to be removed from list.", "error");   
        } });

    
   }
</script>

<div class="modal fade" id="new-invoice" style="height:900px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">New Invoice</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" action="/add-drug-category" class="panel-body wrapper-lg">
                          @include('pharmacy/invoice') 
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                        </section>
                        </section>
                      </div>
                    
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->




