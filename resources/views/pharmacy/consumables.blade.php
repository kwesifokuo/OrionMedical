@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Medical Store Manager </li>
              </ul>

            @role(['Pharmacist','System Admin'])
             <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                     <img src="/images/395537.png" width="15%">
                    <a class="clear" href="/list-of-drugs-avaliable"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Drugs In Stock </small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                     <img src="/images/449368.svg" width="15%">
                    </span>
                    <a class="clear" href="/consumables-list">
                      <span class="h3 block m-t-xs"><strong id="bugs">{{ $drugs->total() }}</strong></span>
                      <small class="text-muted text-uc">Medical Store / Consumables </small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/384496.svg" width="15%">
                    <a class="clear" href="/drug-reports">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Reports</small>
                    </a>
                  </div>
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                     <img src="/images/139315.svg" width="15%">
                    </span>
                    <a class="clear" href="/drug-settings">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Drug Settings</small>
                    </a>
                  </div>

                 
                </div>
              </section>
              @endrole

              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-consumable" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by consumable name, brand, category, status">
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
                            
                           
                           
                            <th>Item Name</th>
                             <th>Supplier</th>
                             <th>Stock Level</th>
                             @role(['Pharmacist','System Admin'])
                            <th>Current Pack Price</th>
                            <th>Current Unit Price</th>
                            <th>Expiry Date</th>
                            <th></th>
                             <th></th>
                             <th></th>
                             <th></th>
                             @endrole
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>

                        @foreach($drugs as $drug )
                          <tr>
                           
                            <td>{{ $drug->name }}</td>
                            <td>{{ $drug->supplier }}</td>
                            <td>{{ $drug->stock }}</td>
                             @role(['Pharmacist','System Admin'])
                            <td>{{ $drug->sale_price }}</td>
                            <td>{{ $drug->unit_price }}</td>
                        
                            
                           
                            <td>{{ $drug->expiry_date->diffForHumans() }}</td>
                            <td>
                                @if($drug->expiry_date <= Carbon\Carbon::today())

                                 <a href="#" data-toggle="modal" class="bootstrap-modal-form-open" onclick="getdrugdetail('{{ $drug->id }}')"><span class="label bg-danger pull-right"> Expired
                                   </span></a>

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
                            <td><a href="#update-stock" class="bootstrap-modal-form-open" onclick="getdrugdetailstock('{{ $drug->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil"></i></a></td>

                            <td><a href="#update-stock" class="bootstrap-modal-form-open" onclick="getdrugdetailstock('{{ $drug->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-retweet"></i></a></td>

                            <td><a href="#" class="bootstrap-modal-form-open" onclick="deletedrug('{{ $drug->id }}','{{ $drug->name }}')"  id="delete" name="delete" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a></td>
                            @endrole
                             <td><a href="#assign-consumable" class="bootstrap-modal-form-open" onclick="getdrugdetail('{{ $drug->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-shopping-cart"></i></a></td>
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
                                    
                         <a href="#add-consumable" class="bootstrap-modal-form-open float" data-toggle="modal">
<i class="fa fa-plus my-float"></i><i class="fa fa-tasks my-float"></i>
</a>
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $drugs->total() }} {{ str_plural('Consumables', $drugs->total()) }}</span>

                       <span class="badge badge-info">Total Cost of Drugs : {{ $totalcost }} </span>
                      </p>
                    </div>
                    {!!$drugs->render()!!}
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                        
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>


@stop

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>

<script type="text/javascript">
$(function () {
  $('#add-consumable input[name="expiry_date"]').daterangepicker({
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
  $('#edit-drug input[name="expiry_date"]').daterangepicker({
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
  $('#update-stock input[name="expiry_date"]').daterangepicker({
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
  $('#assign-consumable input[name="assigned_on"]').daterangepicker({
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
  $(document).ready(function() {

                  $('#add-consumable select[name="classification"]').select2({
                  tags: true
                  });
                  $('#add-consumable select[name="supplier"]').select2({
                  tags: true
                  });

                   $('#add-consumable select[name="supplier"]').select2({
                  tags: true
                  });
                   $('#add-consumable select[name="drug_form"]').select2({
                  tags: true
                  });
                    $('#add-consumable select[name="brand"]').select2({
                  tags: true
                  });
   



  });
</script>

<script>

function getdrugdetail(id)
{ 

  $.get("/get-consumable-detail",
          {"id":id},
          function(json)
          {
            

                $('#edit-drug input[name="drugid"]').val(json.drugid);
                $('#edit-drug input[name="drug_number"]').val(json.drug_number);
                $('#edit-drug select[name="supplier"]').val(json.supplier);
                $('#edit-drug input[name="drug_name"]').val(json.drug_name);
                $('#edit-drug input[name="generic_name"]').val(json.generic_name);
                $('#edit-drug input[name="drug_description"]').val(json.drug_description);
                $('#edit-drug select[name="classification"]').val(json.classification);
                $('#edit-drug select[name="brand"]').val(json.brand);
                $('#edit-drug input[name="stock"]').val(json.stock);
                $('#edit-drug input[name="buy_price"]').val(json.buy_price);
                $('#edit-drug input[name="sale_price"]').val(json.sale_price);
                $('#edit-drug input[name="unit_price"]').val(json.unit_price);
                $('#edit-drug select[name="drug_form"]').val(json.drug_form);
                $('#edit-drug input[name="pack_size"]').val(json.pack_size);
                $('#edit-drug input[name="store_box"]').val(json.store_box);
                $('#edit-drug input[name="expiry_date"]').val(json.expiry_date);
                $('#edit-drug input[name="stock_alert"]').val(json.stock_alert);
                
                $('#edit-drug textarea[name="effects"]').val(json.effects);
                
                 $('#edit-drug select[name="classification"]').select2({
                  tags: true
                  });
                  $('#edit-drug select[name="supplier"]').select2({
                  tags: true
                  });
                   $('#edit-drug select[name="drug_form"]').select2({
                  tags: true
                  });
                    $('#edit-drug select[name="brand"]').select2({
                  tags: true
                  });
                 
              //}
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}


function getdrugdetail(id)
{ 

  $.get("/get-consumable-detail",
          {"id":id},
          function(json)
          {
            

                $('#assign-consumable input[name="drugid"]').val(json.drugid);
                $('#assign-consumable input[name="drug_number"]').val(json.drug_number);
                $('#assign-consumable input[name="item_requested"]').val(json.drug_name);
                $('#assign-consumable input[name="stock"]').val(json.stock);
                $('#assign-consumable input[name="item_price"]').val(json.unit_price);

               
              
                 
              //}
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}



function deletedrug(id,name)
  {

      //alert(id);

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
          $.get('/delete-consumable',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was successfully deleted from store.", "success"); 
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
</script>


<script>

function getdrugdetailstock(id)
{ 

  $.get("/get-consumable-detail",
          {"id":id},
          function(json)
          {
            

                $('#update-stock input[name="drugid"]').val(json.drugid);
                $('#update-stock input[name="drug_number"]').val(json.drug_number);
                $('#update-stock select[name="supplier"]').val(json.supplier);
                $('#update-stock input[name="drug_name"]').val(json.drug_name);
                $('#update-stock input[name="generic_name"]').val(json.generic_name);
                $('#update-stock input[name="drug_description"]').val(json.drug_description);
                $('#update-stock select[name="classification"]').val(json.classification);
                $('#update-stock select[name="brand"]').val(json.brand);
                $('#update-stock input[name="stock"]').val(json.stock);
                $('#update-stock input[name="buy_price"]').val(json.buy_price);
                $('#update-stock input[name="sale_price"]').val(json.sale_price);
                $('#update-stock input[name="unit_price"]').val(json.unit_price);
                $('#update-stock select[name="drug_form"]').val(json.drug_form);
                $('#update-stock input[name="pack_size"]').val(json.pack_size);
                $('#update-stock input[name="store_box"]').val(json.store_box);
                $('#update-stock input[name="stock_alert"]').val(json.stock_alert);
                 $('#update-stock  input[name="expiry_date"]').val(json.expiry_date);
                
                $('#update-stock textarea[name="effects"]').val(json.effects);
                
                 $('#update-stock select[name="classification"]').select2({
                  tags: true
                  });
                  $('#update-stock select[name="supplier"]').select2({
                  tags: true
                  });
                   $('#update-stock select[name="drug_form"]').select2({
                  tags: true
                  });
                    $('#update-stock select[name="brand"]').select2({
                  tags: true
                  });
                 
              //}
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}
</script>





    <div class="modal fade" id="edit-drug" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Consumable</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox scrollable">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class="active"><a href="#equitytab" data-toggle="tab">Consumable Details</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" data-validate="parsley" action="/update-consumable-details" class="panel-body wrapper-lg">
                           @include('pharmacy/edit_consumable')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                    </section>
                  </section>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div>


<div class="modal fade" id="add-consumable" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Item to Store</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class="active"><a href="#equitytab" data-toggle="tab">Consumable Details</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" data-validate="parsley" method="post" action="/save-consumable" class="panel-body wrapper-lg">
                           @include('pharmacy/new_consumable')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                      </div>
                    </section>
                  </section>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div>


  <div class="modal fade" id="update-stock" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Update Items in Store</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class="active"><a href="#equitytab" data-toggle="tab">Consumable Details</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" data-validate="parsley" method="post" action="/update-consumable-details" class="panel-body wrapper-lg">
                           @include('pharmacy/edit_consumable')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                      </div>
                    </section>
                  </section>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div> 


<div class="modal fade" id="assign-consumable" size="00">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add Requisition</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class="active"><a href="#equitytab" data-toggle="tab">Assignment Details</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" data-validate="parsley" method="post" action="/assign-consumable" class="panel-body wrapper-lg">
                           @include('pharmacy/assign_consumable')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                      </div>
                    </section>
                  </section>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div>



