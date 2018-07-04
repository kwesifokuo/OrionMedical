@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">
            <header class="header bg-white b-b b-light">
              <p>Contacts <small>(Doctors)</small></p>
            </header>
            <section class="scrollable wrapper">              
              <div class="row">
                
                @foreach($contacts as $contact)
                <div class="col-lg-4">
                  <section class="panel panel-default">
                    <div class="panel-body">
                      <div class="clearfix text-center m-t">
                        <div class="inline">
                          <div class="easypiechart" data-percent="75" data-line-width="5" data-bar-color="#4cc0c1" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="130" data-line-cap='butt' data-animate="1000">
                            <div class="thumb-lg">
                              <img src="images/avatar_default.jpg" class="img-circle">
                            </div>
                          </div>
                          <div class="h4 m-t m-b-xs"> {{ $contact->name }}</div>
                          <small class="text-muted m-b"> {{ $contact->speciality }}</small>
                        </div>                      
                      </div>
                    </div>
                    <footer class="panel-footer bg-info text-center">
                      <div class="row pull-out">
                        <div class="col-xs-6">
                          <div class="padder-v">
                            <span class="m-b-xs h3 block text-white">{{ $contact->phone }}</span>
                            <small class="text-muted">Phone</small>
                          </div>
                        </div>
                        <div class="col-xs-6 dk">
                          <div class="padder-v">
                            <span class="m-b-xs h3 block text-white">{{ $contact->time }}</span>
                            <small class="text-muted">Dates </small>
                          </div>
                        </div>
                       
                      </div>
                    </footer>
                  </section>
                </div>
                @endforeach
              </div>
              
            </section>

              @stop


<script>

var account_no = null;
function getDetails(acct_no)
{ 
  account_no = acct_no;
  $.get("/patient.edit",
          {"patient_id":account_no},
          function(json)
          {

                $('#modal_check_in input[name="patient_id"]').val(json.patient_id);
                $('#modal_check_in input[name="fullname"]').val(json.fullname);

          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}

 var OneSignal = window.OneSignal || [];
OneSignal.push(function() {
  OneSignal.getUserId(function(userId) {
    console.log("OneSignal User ID:", userId);
    // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316    
  });
});

</script>


