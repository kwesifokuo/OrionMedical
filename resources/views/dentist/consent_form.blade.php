@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>INSTRUCTIONS AFTER DENTAL SURGERY/EXTRACTION</p>
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
                <h4 class="h3 m-t-xs m-b-xs"> <strong> INFORMED CONSENT FOR ORAL & MAXILLOFACIAL SURGERY </strong></h4>
              <div class="line"></div>
              <div>
                <p style="font-size:18px">PROCEDURE: <strong> {{ $procedures->procedure }} </strong> </p>

                <p style="font-size:18px">  Alternatives to Surgery:  I understand that if these tooth / teeth are not removed my condition may worsen resulting in complication including but not limited to:  </p>
                <ol>
                <li><p style="font-size:18px">Infection </p> </li>
                <li> <p style="font-size:18px">Loss of addition teeth </p></li>
                <li> <p style="font-size:18px"> Pain </p></li>

                </ol>
                <br>
                
                <h4><strong> Possible complications which have been explained to me: </strong></h4>
                  <ol>
                <li><p style="font-size:18px"> Dry Socket-happen if you smoke, rinse you mouth, or use a straw too soon after extraction </p></li>
                <li><p style="font-size:18px"> Infection </p></li>
                <li><p style="font-size:18px"> Decision to leave a small piece of root in the jaw when its removal would require extensive surgery and increased risk of complications. You will be informed if such ma decision is necessary. </p></li>
                <li><p style="font-size:18px"> Bleeding and bruising-not common with simple extractions. Possible if extraction involves bone removal. </p></li>
                <li><p style="font-size:18px"> Swelling </p></li>
                <li><p style="font-size:18px"> Injury to adjacent teeth fillings </p></li>
                 <li><p style="font-size:18px"> Injury to nerves or blood vessels </p></li>

                </ol>
                <br>
                <br>
                <br>
                  <h4> I have had the opportunity to discuss my surgery with <strong>{{ $visitdetails->referal_doctor }} </strong> and to ask questions. I consent to surgery as described. </h4>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
@stop