@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
             <div class="h3 m-t-xs m-b-xs btn btn-rounded btn-sm btn-info">Lab Result Slip</div>
            </header>
            <section class="scrollable wrapper">
             <img src="/images/{{ $company->logo }}" width="15%">
              <h4>{{$company->legal_name }}</h4>
                  <p><a href="#">{{ $company->email }}</a></p>
                   <p><a href="#">{{ $company->address }}</a></p>
                   <p><a href="#">{{ $company->phone }}</a></p>
                   <p><a href="#">{{ $company->website }}</a></p>
                    <div class="line"></div>
              <div class="row">
                <div class="col-xs-6">
                 
                 
                <p><strong> Lab Reference :</strong> {{ $labrequest->visitid }}</p>
                <p><strong>Patient Name:    </strong> {{ $labrequest->patient_name }}</p>
                <p><strong>Telephone:    </strong>  +{{ $patients->mobile_number }}</p> 
                <p><strong>Gender / Age:</strong> {{ $patients->gender }} / {{ $patients->date_of_birth->age }}</p>
                 <p><strong>Consulting Doctor:</strong> {{ $labrequest->created_by }} </p>
                </div>
                




                
               <div class="col-xs-6 text-right">
               
             
                    <p> <strong>Result Date :</strong> {{ $labrequest->created_on->toDayDateTimeString() }}</p>
                    <p> <strong>Order Date :</strong> {{ $labrequest->created_on->toDayDateTimeString() }}</p>
                    <p><strong> Sample No : </strong> {{ $labrequest->visitid  }}</p>
                    <p><strong> Sample Date : </strong> {{ $labrequest->created_on->toDayDateTimeString() }}</p>
                    <p><strong> Specimen :</strong> Blood </p>
                    <p><strong> Printed By : </strong> {{ Auth::user()->getNameOrUsername() }}</p>


                   
                </div>
              </div>     
              <p align="center">DEPARTMENT OF HAEMATOLOGY</p>
              <div class="line"></div>
               <br>
               <p class="h5 text-dark"><strong>Investigation : @foreach($tests as $val)  <label class="badge bg-success"> {{ $val->investigation }} </label> @endforeach </strong></p>
               <br>

              <div class="line"></div>
              <table class="table">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Parameters</th>
                  <th>Result</th>
                  <th>Reference</th>
                 
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($labresults as $key => $labresults )
                  <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{ $labresults->test }}</td>
                  <td>{{ $labresults->result }}</td>
                  <td>{{ $labresults->range }}</td>
                 
                    <td></td>
                  </tr>

                 @endforeach 
                 
              </table> 
              <div class="line"></div> 
               <p align="center">*** END OF REPORT ***</p>
          

            <div class="line"></div>
            Remarks
            <footer>
              <p>Key: L - Abnormal Low, H - Abnormal High.
All reports need Clinical correlation.  Please discuss if needed.  Test results relate only to the item tested.  No part of the report can be reproduce without permission of the Laboratory.
</p>
            </footer>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop