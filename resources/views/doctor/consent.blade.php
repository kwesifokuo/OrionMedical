@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>Medical Consent Form</p>
              </header>
             <section class="scrollable wrapper">
             <img src="/images/{{ $company->logo }}" width="15%">
              <div class="row">
                <div class="col-xs-6">
                  <h4>{{$company->legal_name }}</h4>
                  <p><a href="#">{{ $company->email }}</a></p>
                   <p><a href="#">{{ $company->address }}</a></p>
                   <p><a href="#">{{ $company->phone }}</a></p>
                   <p><a href="#">{{ $company->website }}</a></p>
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
                <h3 align="center"> <strong> MEDICAL CONSENT FORM </strong> </h3>
                <p style="font-size:18px"> Patient name : {{ $admission->name }}</p>
                <p style="font-size:18px">
                I(we) {{ $admission->name }}..........................................................................................consent to and permit the assigned medical doctor and others working under their supervision to treat {{ $admission->name }} for any illness or injury.</p>
                <br>
                <p style="font-size:18px">I (We) further agree to pay any/all patient medical costs, expenses, and charges and to release and discharge and hold harmless the medical staff.</p>
               
               
              </div>
              <div class="line"></div>

              <div>
                <p style="font-size:18px"> <i>*1. In case of emergency, notify: Please provide at least two names & phone. </i></p>  
              
          <p style="font-size:18px"> <strong> Name & Contact No. : </strong>................................................................... </p>
            <br>
          <p style="font-size:18px"> <strong> Name & Contact No. : </strong>................................................................... </p>
            <br>
            <p style="font-size:18px"> <strong> Name & Contact No. : </strong>................................................................... </p>
            

          <p style="font-size:18px"> <i>2.  Give name of your physician. If you do not know, write “NA”.</i></p>  
            <p style="font-size:18px"> <strong> Physician Name & Phone : </strong>................................................................... </p>

          <p style="font-size:18px"> <i> 3.  Are you under treatment for any condition or taking any medications we should know about? Please specify.</i></p>  
         

            </div>

            <div class="line"></div>

                
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop