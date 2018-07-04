@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
            <p class="h4 text-dark"><strong>Test to take : @foreach($tests as $val) <label class="badge bg-danger"> {{ $val->investigation }} </label> @endforeach </strong></p>
             
            </header>
            <section class="scrollable">
              <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="clearfix m-b">
                          <a href="/images/{{ $patients[0]->image }}" class="pull-left thumb m-r">
                            <img src="/images/{{ $patients[0]->image }}" class="img-circle">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs">{{ $patients[0]->fullname }}</div>
                            <br>
                            <div>
                          
                           <p class="block"><a href="#" class="">ID # </a> <span class="label label-default btn-rounded">{{ $patients[0]->patient_id }}</span></p>
                            </div>
                          </div>                
                        </div>
                        <div class="panel wrapper panel-success">
                          <div class="row">
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $patients[0]->gender }}</span>
                                <small class="text-muted">Gender</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $patients[0]->date_of_birth->age }}</span>
                                <small class="text-muted">Age</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h5 block">{{ $patients[0]->civil_status }}</span>
                                <small class="text-muted">Status</small>
                              </a>
                            </div>
                          </div>
                        </div>
                       
                        <div>
                          <small class="text-uc text-xs text-muted">Mobile</small>
                          <p>+{{ $patients[0]->mobile_number }}</p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted">Address</small>
                          <p>{{ $patients[0]->postal_address }}</p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted">Email</small>
                         <p>{{ $patients[0]->email }}</p>
                          </div>

                          <div>
                            <small class="text-uc text-xs text-muted">Date</small>
                          <p>{{ date('Y-m-d') }}</p>
                          <div class="line"></div>
                          <input type="hidden" name="opd_number" id="opd_number" value="{{ $visitdetails->visitid }}">
                          <p class="block"><a href="#" class="">Visit Number </a> <span class="label label-info btn-rounded">{{ $visitdetails->visitid }}</span></p>
                           
                          <div class="line"></div>
                          <p class="block"><a href="#" class="">Blood Group </a> <span class="label label-danger btn-rounded">{{ $patients[0]->blood_group }}</span></p>
                          
                          <div class="line"></div>
                          <p class="block"><a href="#" class="">Insurance No. </a> <span class="label label-warning btn-rounded">{{ $patients[0]->insurance_company }}</span></p>
                          
                          <br>
                          <br>
                          </div> 
                           <img src="/images/enzyme.png"> 
                        </div>

                    </section>
                  </section>
                </aside>


                <aside class="bg-white">

                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#haematology" data-toggle="tab"> Test Results </a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                   
                <div class="tab-content">
                    <div class="tab-pane active" id="haematology">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div class="table-responsive">
                           <form  method="post" action="/test-save" >
                      <table id="parameterTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Parameter</th>
                            <th>Result</th>
                            <th>Normal Range</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach( $haematology as $key => $haematology )
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td><input name="test_name[]" id="test_name" value="{{ $haematology->type }}" class="btn btn-rounded btn-sm btn-default"></td>
                            @if($haematology->input == 'textbox')
                            <td><input type="text" id="test_result" name="test_result[]" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
                            @else
                           <td> <select id="test_result" name="test_result[]" value="" rows="3" tabindex="1" data-placeholder="Select here.." style="width:150px; text-align: center;">
                              <option value=""></option>
                              @foreach($resultselector as $result)
                                <option value="{{ $result->type }}">{{ $result->type }}</option>
                              @endforeach
                            </select> </td>
                             @endif   
                              <td><input name="test_range[]" id="test_range" value="{{ $haematology->range }}" class="btn btn-rounded btn-sm btn-default"></td>
                          </tr>
                         @endforeach
                        </tbody>
                        <br>
                        <footer>
                          <div class="btn-group pull-right">
                            <p>
                                  <button type="submit" class="btn btn-rounded btn-sm btn-info"><i class="fa fa-fw fa-download"></i>Save</button> 
                                  <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    <input type="hidden" name="opd_number" id="opd_number" value="{{ $visitdetails->visitid }}">
                                  <a href="#" class="btn btn-rounded btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i> Cancel</a>
                                  <a href="#" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Print </a>
                            </p>
                            </div>
                        </footer>
                      </table>
                      </form>
                    </div>
                    </ul>
                 </div>
                </div>
            </section>
          </section>        
      </aside>
  </section>
  </section>
</section>
  @stop

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {

     $('#test_name').select2();
     loadTestResults();
    

  });
</script>


  <script type="text/javascript">
  function deleteresult(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+name+" from the result list?",   
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
          $.get('/delete-lab-result',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was removed from result list.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from result list.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to be removed from prescription.", "error");   
        } });

    
   }
   

  
   function loadTestResults()
   {
  
        $.get('/load-test-results',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#testResult tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#testResult tbody').append('<tr><td>'+ value['test'] +'</td><td>'+ value['result'] +'</td><td>'+ value['range'] +'</td><td><a a href="#"><i onclick="deleteresult(\''+value['id']+'\',\''+value['test']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');     


   }



    function saveresult()
    {

        alert($('#test_name').val());
          $.get('/save-test-results',
          {
            "labid": $('#opd_number').val(),
             "test_name": $('#test_name').val() ,
             "test_result": $('#test_result').val(),
             "comment": $('#comment').val()
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
             alert("success");
            }
            else
            { 
              alert("fail");
            }
           
        });
                                          
          },'json');    
           
    }





  </script>




