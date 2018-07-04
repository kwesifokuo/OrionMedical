@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>INSTRUCTIONS AFTER DENTAL SURGERY/EXTRACTION</p>
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

                  <p><h4>{{ $patients->fullname }}</h4>
                    {{ $patients->postal_address }}
                  </p>
                  <p>
                    Telephone:  +{{ $patients->mobile_number }}<br>
                    Email:  {{ $patients->email }}
                  </p>
                
                </div>
                <div class="col-xs-6 text-right">
                  {{-- <p class="h4 badge bg-default">#{{ $bills[0]->paymentid }}</p>
                  <h5>{{ date('Y-m-d') }}</h5>   
                  <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('$bills[0]->paymentid', 'QRCODE')}}" alt="barcode" />    --}}     
                </div>
              </div>       
               <div class="line"></div>
                <h4 class="h3 m-t-xs m-b-xs"> <strong> INSTRUCTIONS AFTER TOOTH EXTRACTION AND DELIVERY OF YOUR NEW DENTURE </strong></h4>
              <div class="line"></div>
              <div>

                <h4><strong>  1ST DAY </strong></h4>
                <ol>
                <li><p style="font-size:18px">  You may remove the denture, briefly rinse it under running water, then put it back in your mouth. </p> </li>

                <li> <p style="font-size:18px">  Tonight, rinse it, put it back in your mouth and sleep with it in your mouth.</p></li>
               

                </ol>
                <br>
                <br>
                <h4><strong> 2ND DAY AND SUBSEQUENT DAYS </strong></h4>
                  <ol>
                <li><p style="font-size:18px"> Beginning tomorrow night, you will remove it, clean it and soak it in plain water. </p></li>
                <li><p style="font-size:18px">Put it back in your mouth in the morning.</p></li>
                <li><p style="font-size:18px">Clean it with a soft brush or soft sponge and liquid soap. Do not use any harsh object or hard brush or sponge.</p></li>
                <li><p style="font-size:18px">Be careful with it. If you drop it in the sink or the floor, it may break apart.</p></li>
                <li><p style="font-size:18px">If you need assistance call <b>0302227196</b>, ask for dental.</p></li>

                </ol>

              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
@stop