
@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
{{--             <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Appointment Manager</div>
              <ul class="nav">
              <li class="b-b b-light"><a href="/event-list"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Appointments</a></li>
              <li class="b-b b-light"><a href="/event-calendar"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Calendar</a></li>
              </ul>
            </aside> --}}
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-4 m-b-xs">
                      <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                        <a href="/book-appointment"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open"><i class="fa fa-group"></i> Create New</a>
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print List</a>
                     <span class="badge badge-info">Record(s) Found : {{ $events->total() }} {{ str_plural('Appointments', $events->total()) }} </span>
                    </div>

                  <form action="/find-appointment" method="GET">
                    <div class="col-sm-8 m-b-xs">
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
                    </div>
                     </form>
                    </div>
                  </div>
                </header>
                <section class="scrollable wrapper w-f">
                  <section class="panel panel-default">
                    <div class="table-responsive">
                     
                        @if($events->count() > 0)
			<table class="table m-b-none text-sm" width="100%">

			<thead>
				<tr>
					<th>#</th>
          <th>Time In</th>
          <th>Patient</th>
           <th>Mobile Number</th>
					<th>Appointment</th>
          <th>Doctor to see</th>
					<th>From</th>
					<th>To</th>
          <th>Action</th>
					<th></th>
          <th></th>
          <th></th>
				</tr>
			</thead>
			<tbody>
			<?php $i = 1;?>
			@foreach($events as $event)

         
<tr>
					<th scope="row">{{ $i++ }}</th>
           <td><a href="#">{{ $event->start_time->diffForHumans() }}</a></td>
          <td><a href="#">{{ ucwords(strtolower($event->name)) }}</a></td>
          <td><a href="#">{{ $event->mobile_number }}</a></td>
					<td><a href="#">{{ ucwords(strtolower($event->title)) }}</a></td>
          <td><a href="/doctor-appointments/{{ $event->doctor }}">{{ ucwords(strtolower($event->doctor)) }}</a></td>
					<td>{{ date("g:ia\, jS M Y", strtotime($event->start_time)) }}</td>
					<td>{{date("g:ia\, jS M Y", strtotime($event->end_time)) }}</td>
          <td>
           <div class="input-group-btn">
                            
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">{{ $event->status }} <span class="caret"></span>
                             </button>
                            <ul class="dropdown-menu pull-right">
                            @foreach($statuses as $status)
                            <li><a onclick="updateStatus('{{ $event->id }}','{{ $status->type }}')">{{ $status->type }}</a></li>
                            @endforeach
                            </ul>
            </div>
          </td>
          <td><a href="/appointment-slip/{{ $event->id }}" id="print" name="print" data-toggle="modal" alt="edit"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print App Slip"></i></a>
          </td>
           <td><a href="#modal_check_in" class="bootstrap-modal-form-open" id="generate_visit" onclick="getDetails('{{ $event->patient_id }}')" name="generate_visit" data-toggle="modal" alt="edit"><i class="fa fa-book" data-toggle="tooltip" data-placement="top" title="" data-original-title="Check In"></i></a>
           </td>
					 <td><a href="#" class="bootstrap-modal-form-open" onclick="deleteappointment('{{ $event->id }}','{{ $event->title }}')"  id="delete" name="delete" data-toggle="modal" alt="edit"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"></i></a>
           </td>
				</tr>
			@endforeach
			</tbody>
		</table>
		@else
			<h2>No appointment found!</h2>
		@endif
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
                     
                        {!!$events->render()!!}
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
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
$(function () {
	$('#modal_create_event input[name="time"]').daterangepicker({
		"minDate": moment('2016-06-14 0'),
		"timePicker": true,
		"timePicker24Hour": true,
		"timePickerIncrement": 15,
		"autoApply": true,
		"locale": {
			"format": "DD/MM/YYYY HH:mm:ss",
			"separator": " - ",
		}
	});
});
</script>

<script >

var account_no = null;
function getDetails(acct_no)
{ 
  account_no = acct_no;
  $.get("/edit-patient",
          {"patient_id":account_no},
          function(json)
          {

                $('#modal_check_in input[name="patient_id"]').val(json.patient_id);
                $('#modal_check_in input[name="fullname"]').val(json.fullname);
                $('#modal_check_in select[name="accounttype"]').select2();
                $('#modal_check_in select[name="referal_doctor"]').select2();
                $('#modal_check_in select[name="consultation_type"]').select2();
                $('#modal_check_in select[name="visit_type"]').select2();
                $('#modal_check_in select[name="anaesthetist"]').select2();
                $('#modal_check_in select[name="sponsor"]').select2();
                $('#modal_check_in img[name="imagePreview"]').attr("src", '/images/'+json.image);

                getAge();
                loadRisk();
                loadBillState();

          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}

function loadRisk()
   {
         
        
        $.get('/load-account',
          {
            "patient_id": $('#patient_id').val()
          },
          function(data)
          { 

            $('#accounttype').empty();
            $.each(data, function () 
            {           
            $('#accounttype').append($('<option></option>').val(this['accounttype']).html(this['accounttype']));
            });
                                          
         },'json');      
    }

    function loadBillState()
   {
         
        
        $.get('/get-bill-state',
        {

          "patient_id": $('#patient_id').val()
         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        
            //sweetAlert("Employee SSF : ", data["PatientName"], "info");
            $('#last_visit_date').val(data.mylastvisit);
           $('#myoutstanding').val(data.myoutstanding);
            //$('#drug_quantity').val("");
       
      });
                                        
        },'json');
    }

function getAge()
{

    $.get('/patient-age-occupation',
        {

          "id": $('#patient_id').val()
         
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        
          //sweetAlert("Employee SSF : ", data["employeessf"], "info");
           $('#age').val(data.age);
           $('#occupation').val(data.occupation);
           $('#accounttype').val(data.accounttype);
       
      });
                                        
        },'json');
  
}

function deleteappointment(id,name)
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
          $.get('/delete-appointment',
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


  function updateStatus(id,status)
{
if($('#appstatus').val()!= "")
{

    //alert(status);

    $.get('/update-appointment-status',
        {
          "id": id,
          "status": status,                      
        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          location.reload(true);
           toastr.success("Appointment status changed!");
           
        }
        else
        {
          toastr.error("Error updating appointment status!");
        }
      });
                                        
        },'json');
  }
  else
    {toastr.error("Please check selecction!");}
}
  </script>

  <script type="text/javascript">
$(function () {
  $('#visit_date').daterangepicker({
     "minDate": moment('2017-02-01'),
     "maxDate": moment(),
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


   <div class="modal fade" id="modal_create_event" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">New Appointment</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" action="/create-event" class="panel-body wrapper-lg">
                          @include('event/create')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                      </div>
                    </section>
                  </section>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>




<div class="modal fade" id="modal_check_in" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">OPD Registration</h4>
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
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" data-validate="parsley" action="/create-opd" class="panel-body wrapper-lg">
                          @include('opd/checkin')
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


