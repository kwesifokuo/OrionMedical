@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
          <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Tariff Manager</div>
              <ul class="nav">
               @role('System Admin','Medical Records Manager')
               <li class="b-b b-light"><a href="/service-charges"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> Service Charges</a></li>
                <li class="b-b b-light"><a href="/insurance-company"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> Health Insurance</a></li>

                <li class="b-b b-light"><a href="/insurance-packages"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> Health Packages / Plans </a></li>


                 <li class="b-b b-light"><a href="/registered-companies"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> Corporate Clients </a></li>
                <li class="b-b b-light"><a href=""><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Visit Types</a></li>
                <li class="b-b b-light"><a href="/complaints"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Complaint Types </a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i> Patient History</a></li>
                <li class="b-b b-light"><a href="/departments"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Departments</a></li>
               @endrole
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print List</a>
                     <span class="badge badge-info">Record(s) Found :  {{ $items->total() }} {{ str_plural('Services', $items->total()) }}</span>
                    </div>

                  <form action="/search-service" method="GET">
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
                  <header class="panel-heading font-bold">Service Charges
                              @role(['System Admin','Billing'])
                                 <a href="#new-service" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-info pull-right">+</span></a>
                                 @endrole
                                </header>
                    <div class="table-responsive">
                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                           <th>#</th>
                            <th>Cost Center</th>
                            <th>Name </th>
                            <th>Walk-in charge</th>
                            <th>Corporate Charge</th>
                            <th>Insurance Charge</th>
                             <th>Glico</th>
                              <th>Cosmopolitan</th>
                              <th>Premier</th>
                             <th>Status</th>
                             <th>Added On</th>
                            <th width="20"></th>
                            <th width="20"></th>
                          </tr>
                        </thead>
                         <tbody>
                        @foreach( $items as $key => $item )
                          <tr>
                            <td>{{ $item->serial }}</td>
                            <td>{{ $item->department }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->walkin }}</td>
                            <td>{{ $item->corporate }}</td>
                            <td>{{ $item->insurance }}</td>
                            <td>{{ $item->glico }}</td>
                             <td>{{ $item->cosmopolitan }}</td>
                               <td>{{ $item->premier }}</td>
                             <td>{{ $item->status }}</td>
                             <td>{{ $item->created_on }}</td>
                             @role('System Admin','Laboratory')
                              
                              <td>
                              <a href="#edit-service" class="bootstrap-modal-form-open" onclick="editService('{{ $item->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>

                              </td>

                             <td><a href="#" class="bootstrap-modal-form-open" onclick="deleteDetails('{{ $item->id }}','{{ $item->name }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                             </td>
                             @endrole
                            
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
                     
                        {!!$items->render()!!}
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop

<div class="modal fade" id="new-service" style="height:900px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Service Charge</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" action="/add-service" class="panel-body wrapper-lg">
                           @include('settings/add_service')
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


<div class="modal fade" id="edit-service" style="height:900px">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Update Service Charge</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" action="/update-service" class="panel-body wrapper-lg">
                           @include('settings/edit_service')
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


<script src="{{ asset('/js/jquery.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function () {
   
    $('#department').select2();

    

  });
</script>


<script>
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
          $.get('/delete-service-charge',
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




function editService(id)
{ 
   //alert(id);
  $.get("/edit-service",
          {"id":id},
          function(json)
          {
            
              $('#edit-service input[name="myoldid"]').val(json.myoldid);
                $('#edit-service input[name="service"]').val(json.service);
                $('#edit-service input[name="description"]').val(json.remark);
                 $('#edit-service input[name="charge"]').val(json.charge);
                $('#edit-service input[name="walk_margin"]').val(json.charge);
                $('#edit-service input[name="corporate_margin"]').val(json.corporate_margin);
                $('#edit-service input[name="insurance_margin"]').val(json.insurance_margin);
                $('#edit-service input[name="glico_margin"]').val(json.glico_margin);
                $('#edit-service input[name="cosmopolitan_margin"]').val(json.cosmopolitan_margin);
                $('#edit-service input[name="premier_margin"]').val(json.premier_margin);
                
                $('#edit-service select[name="department"]').val(json.department);
                 $('#edit-service select[name="department"]').select2();

              //}
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}
</script>





