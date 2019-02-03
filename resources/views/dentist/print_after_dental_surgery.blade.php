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
                <h4 class="h3 m-t-xs m-b-xs"> <strong> INSTRUCTIONS AFTER DENTAL SURGERY/EXTRACTION </strong></h4>
              <div class="line"></div>
              <div>
                <p style="font-size:18px">You have just had a tooth pulled (extracted). There are certain things you need to be aware of and things you need to do to make the post-surgical experience more comfortable for you.</p>

                <h4> <strong> DAY ONE – DAY OF THE EXTRACTION </strong> </h4>
                <ol>
                <li><p style="font-size:18px">  You have been given eight pieces of gauze. Put two pieces together in a pack as you were shown and bite on it for twenty minutes. Change the pack after twenty minutes. (you will change it four times). If there’s still bleeding after the last pack, wet a tea bag and bite on it for another twenty minutes. If bleeding is excessive and not stopping, call the dental department, or go immediately to a nearby emergency room. </p> </li>

                <li> <p style="font-size:18px">  Do not rinse your mouth for twenty-four hours after the extraction. The blood in the extraction socket needs to clot. It is what will eventually from a scar, so if you rinse the blood out, you will delay the healing process and also, you will likely get dry socket which can be very uncomfortable. If you develop a dry socket, call the dental department and return for a dry socket dressing.</p></li>
                <li> <p style="font-size:18px"> Do not use straw to drink for a whole week. </p></li>

                <li> <p style="font-size:18px"> Brush your teeth normally, but do not gargle with the water. Simply use your tongue to gently remove the toothpaste from your teeth. </p></li>

                <li><p style="font-size:18px">   Drink plenty of fluids and eat nutritious meals to help promote better healing. Avoid chewing bones, fried chips or any food with sharp edges that might dig into the socket.</p> </li>

                <li><p style="font-size:18px">   Take all your medications as instructed. </p></li>

                <li><p style="font-size:18px">  Do not do any strenuous work suck as lifting heavy objects. This can cause heavy bleeding. </p></li>

                <li><p style="font-size:18px">  If you have any swelling of the cheek, put some ice in a plastic bag and put it on your cheek off/on for 15 minutes. Repeat this every three hours. Do not allow the ice to sit on your cheek continuously. This can lead to an ice burn of the cheek which can take a long time to heal.</p></li>
                </ol>
                <br>
                <br>
                <h4><strong> DAY TWO – 24HOURS AFTER EXTRACTION </strong></h4>
                  <ol>
                <li><p style="font-size:18px"> Put one teaspoon of salt in a cup of warm water. Put some of the warm salt water repeatedly in your mouth </p></li>
                <li><p style="font-size:18px">Do not gargle with it otherwise the blood clot will fall out, causing a dry socket.</p></li>

                </ol>

              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
@stop