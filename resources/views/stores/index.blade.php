@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Medical Store Manager </li>
              </ul>
{{-- 
            @role(['Pharmacist','System Admin'])
             <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                     <img src="/images/395537.png" width="15%">
                    <a class="clear" href="/list-of-drugs-avaliable"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open">
                      <span class="h3 block m-t-xs"><strong>0</strong></span>
                      <small class="text-muted text-uc"> Medical Requisition </small>
                    </a>
                  </div>
                    <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                     <img src="/images/449368.svg" width="15%">
                    </span>
                    <a class="clear" href="/consumables-list">
                      <span class="h3 block m-t-xs"><strong id="bugs"> </strong></span>
                      <small class="text-muted text-uc"> General Requisition </small>
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
                      <small class="text-muted text-uc">General Info</small>
                    </a>
                  </div>

                 
                </div>
              </section>
              @endrole --}}

              <div class="row">

                <div class="col-md-12">
 
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-requisition" method="GET">
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
                            
                           
                           <th>#</th>
                            <th>Item Name</th>
                            <th>Quantity Requested</th>
                            <th>Quantity Approved</th>
                            <th>Cost of Requistion</th>
                             <th>Requested By</th>
                             <th>Requested On</th>
                             <th>Approved By</th>
                              <th>Status</th>
                            <th></th>
                             <th></th>
                              <th></th>
                           
                          </tr>
                        </thead>
                        <tbody>

                       @foreach($requisitions as $key => $item )
                          <tr>
                           <td>{{ ++$key }}</td>
                            <td>{{ $item->consumable }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->quantity_approved }}</td>
                            <td>{{ $item->quantity_approved *  $item->cost}}</td>
                            <td>{{ $item->created_by }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->approved_by }}</td>
                             <td>{{ $item->status }}</td>
                        
                            
                           
                            
                            
                            <td><a href="#update-stock" class="bootstrap-modal-form-open" onclick="approverequisition('{{ $item->id }}','{{ $item->consumable }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-thumbs-up"></i></a></td>
                          

                            <td><a href="#" class="bootstrap-modal-form-open" onclick="deletedrug('{{ $item->id }}','{{ $item->name }}')"  id="delete" name="delete" data-toggle="modal" alt="edit"><i class="fa fa-print"></i></a></td>

                           
                            <td><a href="#" class="bootstrap-modal-form-open" onclick="deleterequest('{{ $item->id }}','{{ $item->consumable }}')"  id="delete" name="delete" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a></td>
                          
                         
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
                      <span class="badge badge-info">Record(s) Found : {{ $requisitions->total() }} {{ str_plural('Requisition', $requisitions->total()) }}</span>

                       <span class="badge badge-info">Total Cost of Requisitions : 0 </span>
                      </p>
                    </div>
                    {!!$requisitions->render()!!}
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                        
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>


@stop

<script type="text/javascript">
  function deleterequest(id,name)
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
          $.get('/delete-requisition',
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



  function approverequisition(id,name)
   {
    swal({
  title: "Are you sure?",
  text: "Please enter quantity to approve for "+ name,
  type: "input",
  showCancelButton: true,
  closeOnConfirm: false,
  animation: "slide-from-top",
  inputPlaceholder: "Write something"
},
function(inputValue){
  if (inputValue === false) return false;

  if (inputValue === "") {
    swal.showInputError("You need to write something!");
    return false
  }

//alert(inputValue);
  $.get('/approve-requisition',
          {
             "ID": id,
             "approved_quantity" : inputValue
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Success!", name +" was removed from list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled","Failed to be removed from list.", "error");
              
            }
            });
                                          
          },'json');  

    


});


   }

</script>

