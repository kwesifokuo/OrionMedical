@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Room Manager</div>
              <ul class="nav">
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Enquiry</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>View by Category</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Room Master</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Bed Master</a></li>
                 <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                  <br>
                <br>
                <br>
                <br>
                <br>
                <br>
              
             
                <br>
                <br>
                <br>
                 <img src="/images/139257.svg"> 
                
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                      <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                      <a href="/patient.manage" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-reply-all"></i> Back to Main</a>
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print List</a>
                     <a href="#modal_new_ward" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-plus"></i> New Room </a>
                     <span class="badge badge-info">Record(s) Found : {{ $rooms->total() }} {{ str_plural('Rooms', $rooms->total()) }} </span>
                    </div>

                  <form action="/patient.find" method="GET">
                    <div class="col-sm-4 m-b-xs">
                      <div class="input-group">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search for a patient">
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
                    <div class="table-responsive">
                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th width="20"><input type="checkbox"></th>
                            <th width="20"></th>
                            <th>Ward / Room #</th>
                            <th>Type</th>
                            <th>Total Beds</th>
                            <th>Occupied</th>
                            <th>Unoccupied</th>
                            <th>Room Rate</th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $rooms as $room )
                          <tr>
                            <td><input type="checkbox" name="post[]" value="2"></td>
                            <td><a href="#modal_edit_ward" class="bootstrap-modal-form-open" onclick="getDetails('{{ $room->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil"></i></a></td>
                            <td>{{ $room->ward_no }}</td>
                            <td>{{ $room->ward_type }}</td>
                            <td>{{ $room->total_beds }}</td>
                            <td>{{ $room->occupied_beds }}</td>
                            <td>{{ $room->total_beds - $room->occupied_beds }}</td>
                            <td>GHS {{ $room->cost }}</td>

                            @if( ($room->total_beds - $room->occupied_beds) > 0 )
                            <td><span class="label bg-info pull-right"> Bed Available </span></td>
                            @else
                            <td><span class="label bg-danger pull-right"> Fully Occupied </span></td>
                            @endif
                            <td>
                              <a href="#" class="active" onclick="deactivateAccount('{{ $room->id }}')" data-toggle="class"><i class="fa fa-trash text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
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
                     
                        {!!$rooms->render()!!}
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop





 <script>
function getDetails(id)
{ 
  //alert(id,patientid);
  
  $.get("/edit-ward",
          {"ID":id
       
          },
          function(json)
          {

                //var data = JSON.stringify(json.complaint);
                $('#modal_edit_ward input[name="ward_number"]').val(json.ward_number);
                $('#modal_edit_ward input[name="ward_name"]').val(json.ward_name);
                $('#modal_edit_ward input[name="ward_rate"]').val(json.ward_rate);
                $('#modal_edit_ward input[name="ward_location"]').val(json.ward_location);
                $('#modal_edit_ward input[name="total_beds"]').val(json.total_beds);
                
    

          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}

</script>



<div class="modal fade" id="modal_new_ward" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">New Ward Registration<span id="selectedName"></span></h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">

                        <li class="active"><a href="#details" data-toggle="tab">Ward Details</a></li>
                        
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="details">
                            <form  class="bootstrap-modal-form" method="post" action="/add-new-ward" class="panel-body wrapper-lg">
                          @include('room/new')
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


<div class="modal fade" id="modal_edit_ward" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Update Ward Details<span id="selectedName"></span></h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">

                        <li class="active"><a href="#details" data-toggle="tab">Ward Details</a></li>
                        
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="details">
                            <form  class="bootstrap-modal-form" method="post" action="/update-ward" class="panel-body wrapper-lg">
                          @include('room/edit')
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


