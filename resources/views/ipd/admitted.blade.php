@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">IPD Manager</div>
              <ul class="nav">
           <li class="b-b b-light"><a href="/new-ipd"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>New Admission <span class="badge bg-info">0</span> </a></li>
                <li class="b-b b-light"><a href="/show-admitted"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Admitted <span class="badge bg-info">0</span></a></li>
                <li class="b-b b-light"><a href="/review-opd"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Operating Room <span class="badge bg-default">0 </span></a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Discharged <span class="badge bg-default">0</span></a></li>
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
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <img src="/images/387552.svg" width="80%">
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
                     <span class="badge badge-info">Record(s) Found : {{ $patients->total() }} {{ str_plural('Patient', $patients->total()) }} </span>
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
                </header>
                <section class="scrollable wrapper w-f">
                  <section class="panel panel-default">
                    <div class="table-responsive">
                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>Visit # 
                            </th>
                            <th>Patient #</th>
                            <th>Patient Name</th>
                            <th>Doctor-In-Charge</th>
                            <th>Admission Type</th>
                            <th>Admission Date</th>
                            <th>Ward</th>
                            <th>Bed</th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $patients as $patient )
                          <tr>
                            <td>{{ $patient->opd_number }}</td>
                            <td>{{ $patient->patient_id }}</td>
                            <td>{{ $patient->name }}</td>                          
                            <td>{{ $patient->referal_doctor }}</td>
                              <td>{{ $patient->consultation_type }}</td>
                              <td>{{ $patient->created_on }}</td>
                               <td>{{ $patient->ward_id }}</td>
                              <td>{{ $patient->bed_id }}</td>
                              
                            <td>
                              <a href="#" class="btn btn-s-md btn-danger btn-rounded" class="active" onclick="doDischarge('{{ $patient->id }}','{{ $patient->name }}')" data-toggle="class">Discharge</a>
                            </td>
                            <td>
                              <a href="#" class="btn btn-s-md btn-twitter btn-rounded" class="active" onclick="doDelete('{{ $patient->id }}','{{ $patient->name }}')" data-toggle="class">Delete</a>
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
                     
                        {!!$patients->render()!!}
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop



<script type="text/javascript">
  
  function doDischarge(id,name)
  {

  swal({
  title: "Discharging " + name +"!",
  //text: "Enter discharge comment:",
  type: "input",
  showCancelButton: true,
  closeOnConfirm: false,
  animation: "slide-from-top",
  inputPlaceholder: "Enter discharge comment"
},
function(inputValue){
  if (inputValue === false) return false;
  
  if (inputValue === "") {
    swal.showInputError("You need to enter discharge comment!");
    return false
  }
  
  else
  {
    $.get('/discharge-patient',
          {
             "ID": id,
             "comment": inputValue  
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Discharged!", name +" was successfully discharged.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Failed", name +" failed to process.", "error");
              
            }
           
        });
                                          
          },'json');    
  }
});

}


function doDelete(id,name)
  {

         
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
          $.get('/delete-opd',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was successfully deleted.", "success"); 
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