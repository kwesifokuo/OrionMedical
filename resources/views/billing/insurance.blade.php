@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Doctor Station </li>
              </ul>

            
            @role(['Billing','System Admin','Pharmacist'])                 
             <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                   <img src="/images/1392052.svg" width="15%" class="pull-left">
                    <a class="clear" href="/billing-index"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>{{$bills->total()}}</strong></span>
                      <small class="text-muted text-uc">Bills</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/138368.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/payment-index">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Patient Collections</small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/1414577.svg" width="15%" class="pull-left">
                    <a class="clear" href="/insurance-claims">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Corporate & Insurance Bills</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <img src="/images/1136118.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/service-charges">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Service Charges</small>
                    </a>
                  </div>

                 
                </div>
              </section>
              @endrole


              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default">


                  {{-- <header class="panel-heading">
                    <form action="/find-bill" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by patient, insurance, encounter">
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-success" type="submit">Search!</button>
                        </div>
                      </div>
                      </form>
                    </header> --}}

                    <header class="panel-heading">
                    <form action="/find-bill" method="GET">
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
                            <th>Invoice No</th>
                            <th>Name</th>
                            <th>Copayer</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Inovice</th>
                            <th>Paid</th>
                            <th>Balance</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($bills as $bill )
                          <tr>
                            
                            <td><a href="#" class="text-danger">IN-{{ $bill->visit_id }}</a></td>
                            <td>{{ ucwords(strtolower($bill->fullname)) }}</td>
                            <td>{{ $bill->copayer }}</td>
                            <td>{{ $bill->item_name }} ...</td>
                            <td>{{ $bill->date }}</td>
                            <td> {{ number_format($bill->total_cost , 1, '.', ',') }}</td>
                             <td>{{ number_format($bill->payments->sum('AmountReceived'), 1, '.', ',') }}</td>
                             <td>{{  number_format($bill->total_cost - $bill->payments->sum('AmountReceived') ,1, '.', ',') }}</td>
                             <td>
                             @if($bill->note=="Paid")
                              <a href="/billing-invoice/{{ $bill->visit_id }}" class="btn btn-s-md btn-danger btn-rounded bootstrap-modal-form-open"  id="edit" name="edit" data-toggle="modal" alt="edit">Collect Payment</a>
                             <td><a href="/billing-print/{{ $bill->visit_id }}" class="bootstrap-modal-form-open" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-print"></i></a></td> 
                             @else
                               <a href="/billing-invoice/{{ $bill->visit_id }}" class="btn btn-s-md btn-danger btn-rounded bootstrap-modal-form-open"  id="edit" name="edit" data-toggle="modal" alt="edit">Collect Payment</a>
                                
                                 <td>
                                 @if($bill->payercode!='Private')
                                 <a href="/claim-form/{{ $bill->visit_id }}" class="bootstrap-modal-form-open" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-print"></i></a>
                                  @else
                                   <a href="/billing-print/{{ $bill->visit_id }}" class="bootstrap-modal-form-open" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-print"></i></a>
                                   @endif
                                 </td> 

                                  @permission('edit-bill')
                                  <td><a href="#" onclick="excludefrombill('{{ $bill->id }}','{{ $bill->item_name }}')" id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a></td> 
                                  @endpermission

                            @endif
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
                  

                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $bills->total() }} {{ str_plural('Bill', $bills->total()) }}</span>
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                        {!!$bills->render()!!}
                        
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

