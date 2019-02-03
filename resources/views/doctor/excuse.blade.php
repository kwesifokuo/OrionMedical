@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>Excuse Note</p>
              </header>
             <section class="scrollable wrapper">
             <img src="/images/{{ $mycompany->logo }}" width="15%">
              <div class="row">
                <div class="col-xs-6">
                  <h4>{{$mycompany->legal_name }}</h4>
                  <p><a href="#">{{ $mycompany->email }}</a></p>
                   <p><a href="#">{{ $mycompany->address }}</a></p>
                   <p><a href="#">{{ $mycompany->phone }}</a></p>
                   <p><a href="#">{{ $mycompany->website }}</a></p>
                  <br>
                  <br>
                  <br>
                     
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="h4"># {{ $admission->opd_number }}</p>
                    <h5>{{ date('Y-m-d') }}</h5> 
                    <br>
                    <br>
                     <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($admission->name, 'QRCODE')}}" alt="barcode" /> 
                  </div>
                </div>    
              <div>
                <h3 align="center"> <strong> MEDICAL EXCUSE NOTE </strong> </h3>
                <p style="font-size:18px"> This medical excuse note certifies that <strong> {{ $admission->name }} </strong> has been seen at the Gilead Medical & Dental Centre for professional medical attention on <strong> {{ Carbon\Carbon::now()->toDayDateTimeString()  }} </strong></p>
                <br>
                <p style="font-size:18px"> He / She is to be seen for review on (date) ...................................................................... </p>
                <br>

                <p style="font-size:18px"> <strong>Remarks</strong> .....................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br>...............................................................................................................................</p>
                <br>
                <p style="font-size:18px">*We urge employer / school to consider this an excused absence. </p>
              </div>
              
               
              <p class="btn btn-sm btn-default pull-right"> Doctor : {{ Auth::user()->getNameOrUsername() }}</p>
              <br>
              <br>
              <br>
                <br>
              <p class="btn btn-sm btn-default pull-right">Requesting Doctor's Signature : .....................................................................  </p>
              <br>
              <br>
                <br>
                
              
            
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop