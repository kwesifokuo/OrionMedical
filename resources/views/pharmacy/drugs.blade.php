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
                  
                   @role(['Pharmacist','System Admin'])
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                     <img src="/images/1404394.svg" width="15%" class="pull-left">
                    <a class="clear" href="/list-of-drugs-avaliable"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Drugs In Stock </small>
                    </a>
                  </div>
                  @endrole

                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                     <img src="/images/138268.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/consumables-list">
                      <span class="h3 block m-t-xs"><strong id="bugs">{{ $drugs->total() }}</strong></span>
                      <small class="text-muted text-uc">Medical Store </small>
                    </a>
                  </div>

                    <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <img src="/images/1188525.svg" width="15%" class="pull-left">
                    <a class="clear" href="/drug-reports">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc">Reports</small>
                    </a>
                  </div>

                     @role(['Pharmacist','System Admin'])
                   <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                     <img src="/images/214342.svg" width="15%" class="pull-left">
                    </span>
                    <a class="clear" href="/drug-settings">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Drug Settings</small>
                    </a>
                  </div>
                  @endrole

                 
                </div>
              </section>


              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-drugs" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by drug name, brand, generic name, supplier , status">
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
                            <th>Insurance S.P </th>
                            <th>Expiry Date</th>
                            <th></th>
                             <th></th>
                             <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>

                        @foreach($drugs as $drug )
                          <tr>
                            <td>{{ $drug->name }}</td>
                            <td>{{ $drug->supplier }}</td>
                            <td>{{ $drug->drug_application_default }}</td>
                            <td>{{ $drug->drug_quantity_default }}</td>
                            <td>{{ $drug->stock }}</td>
                           
                            @role(['Pharmacist','System Admin'])
                            <td>{{ $drug->sale_price }}</td>
                            <td>{{ $drug->unit_price }}</td>
                              @endrole
                             <td>{{ $drug->unit_price * $drug->walk_margin  }}</td>
                             <td>{{ $drug->unit_price * $drug->insurance_margin }}</td>
                          
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
                            <td><a href="#edit-drug" class="bootstrap-modal-form-open" onclick="getdrugdetail('{{ $drug->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a></td>


                              @role(['Pharmacist','System Admin'])
{{--                             <td><a href="#update-stock" class="bootstrap-modal-form-open" onclick="getdrugdetailstock('{{ $drug->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-retweet" data-toggle="tooltip" data-placement="top" title="" data-original-title="Adjust Stock"></i></a></td>
  --}}
                           
                           <td><a href="#new-damaged-drug" class="bootstrap-modal-form-open" onclick="getdrugdetailstock('{{ $drug->id }}','{{ $drug->name }}')"  id="delete" name="delete" data-toggle="modal" alt="edit"><i class="fa fa-warning (alias)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Report Damage"></i></a></td>


                             <td><a href="#new-expired-drug" class="bootstrap-modal-form-open" onclick="getdrugdetail('{{ $drug->id }}','{{ $drug->name }}')"  id="delete" name="delete" data-toggle="modal" alt="edit"><i class="fa fa-sign-out" data-toggle="tooltip" data-placement="top" title="" data-original-title="Report Expired"></i></a></td>

                             <td>
                             @if($drug->status == 'Active')
                              <a href="#" class="" onclick="deactivateDrug('{{ $drug->id }}','{{ $drug->name }}')" data-toggle="class"><i class="fa fa-thumbs-up text-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deactivate"></i> </a>
                              @else
                             <a href="#" class="" onclick="activateDrug('{{ $drug->id }}','{{ $drug->name }}')" data-toggle="class"><i class="fa fa-thumbs-down text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Activate"></i></a>
                             @endif
                            </td>

                            <td><a href="#" class="bootstrap-modal-form-open" onclick="deletedrug('{{ $drug->id }}','{{ $drug->name }}')"  id="delete" name="delete" data-toggle="modal" alt="edit"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a></td>
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
                                    
                         <a href="#add-drug" class="bootstrap-modal-form-open float" data-toggle="modal">
                      <i class="fa fa-plus my-float"></i><i class="fa fa-flask my-float"></i>
                </a>
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $drugs->total() }} {{ str_plural('Drug', $drugs->total()) }}</span>

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
  $('#add-drug input[name="expiry_date"]').daterangepicker({
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
  $(document).ready(function() {

                  $('#add-drug select[name="classification"]').select2({
                  tags: true
                  });
                  $('#add-drug select[name="supplier"]').select2({
                  tags: true
                  });
                   $('#add-drug select[name="drug_form"]').select2({
                  tags: true
                  });
                    $('#add-drug select[name="brand"]').select2({
                  tags: true
                  });
   



  });
</script>

<script>

function getdrugdetail(id)
{ 

  $.get("/get-drug-detail",
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

                $('#edit-drug input[name="walk_margin"]').val(json.walk_margin);
                $('#edit-drug input[name="insurance_margin"]').val(json.insurance_margin);


                $('#new-expired-drug input[name="stock"]').val(json.stock);
                $('#new-expired-drug input[name="drugid"]').val(json.drugid);
                $('#new-expired-drug select[name="drug_name"]').val(json.drug_name);
                $('#new-expired-drug select[name="drug_name"]').select2({tags: true });

                
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
          $.get('/delete-drug',
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


  function activateDrug(id,name)
  {

      //alert(id);

      swal({   
        title: "Are you sure?",   
        text: "Do you want to activate "+name+" ?",   
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
          $.get('/activate-drug',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was successfully activated in store.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to activate.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to activate.", "error");   
        } });

  }



  function deactivateDrug(id,name)
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
          $.get('/deactivate-drug',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was successfully deactivated from store.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to deactivate.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to deactivate.", "error");   
        } });

  }

</script>


<script>

function getdrugdetailstock(id)
{ 

  $.get("/get-drug-detail",
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
                $('#update-stock select[name="drug_form"]').val(json.drug_form);
               
                $('#new-damaged-drug input[name="stock"]').val(json.stock);
                $('#new-damaged-drug input[name="drugid"]').val(json.drugid);
                $('#new-damaged-drug select[name="drug_name"]').val(json.drug_name);
                $('#new-damaged-drug select[name="drug_name"]').select2({tags: true });
                
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
          <h4 class="modal-title">Edit Drug</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox scrollable">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class="active"><a href="#equitytab" data-toggle="tab">Drug Details</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" data-validate="parsley" action="/update-drug-details" class="panel-body wrapper-lg">
                           @include('pharmacy/edit_drug')
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


<div class="modal fade" id="add-drug" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Drug</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class="active"><a href="#equitytab" data-toggle="tab">Drug Details</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" data-validate="parsley" method="post" action="/save-drug" class="panel-body wrapper-lg">
                           @include('pharmacy/new_drug')
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
          <h4 class="modal-title">Update Stock</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class="active"><a href="#equitytab" data-toggle="tab">Drug Details</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" data-validate="parsley" method="post" action="/update-drug-stock-level" class="panel-body wrapper-lg">
                           @include('pharmacy/updatestock')
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


  <div class="modal fade" id="new-damaged-drug" size="300px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Report Status</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox scrollable">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class="active"><a href="#equitytab" data-toggle="tab">Drug Details</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" data-validate="parsley" action="/add-damaged-details" class="panel-body wrapper-lg">
                           @include('pharmacy/new_damaged')
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


 <div class="modal fade" id="new-expired-drug" size="300px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add Expired Drug</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox scrollable">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class="active"><a href="#equitytab" data-toggle="tab">Drug Details</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" data-validate="parsley" action="/add-expired-details" class="panel-body wrapper-lg">
                           @include('pharmacy/new_expired')
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



