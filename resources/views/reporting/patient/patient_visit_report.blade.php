@extends('layouts.default')
@section('content')


          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>Patient List  </p>
            </header>

            
             <section class="scrollable wrapper">
             
            
            <div class="page">
             <img src="/images/{{ $mycompany->logo }}" width="15%">
              
            
           <h4 align="center"> <strong>Patient Visits from {{ $datefrom }} to {{ $dateto }} </strong></h4>
            <table class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                          <tr>
                          <th></th>
                           <th>Visit #</th>
                            <th>Time In</th>
                            <th>Patient Name</th>
                            <th>Visit Type</th>
                             <th>Practioner</th>
                            <th>Area</th>
                            <th>Care Provider</th>
    
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $patients as $key => $patient )
                          <tr>
                            <td> {{ ++$key }}</td>
                            <td>{{ $patient->opd_number }}</td>
                            <td>{{ $patient->created_on->format('H:i:s - jS M Y') }}</td>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->consultation_type }}</td>
                            <td>{{ $patient->referal_doctor }}</td>
                            <td>{{ $patient->location }}</td>
                            <td>{{$patient->payercode }}, {{ $patient->care_provider }}</td>
                            
                          </tr>
                         @endforeach
                        </tbody> 
                      </table>
              <aside>
               <p class="btn btn-sm btn-default pull-right">Printed By : {{ Auth::user()->getNameOrUsername() }}</p>
              
     

      </div>
    </aside> 
 <br>
          
  </div>

     </section>

{{--      <img align="right" src="/images/unpaid.png" width="15%">   --}}<br>
          
              

            
            </section>



          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop



