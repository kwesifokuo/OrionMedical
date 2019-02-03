@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>Claims Cover Letter</p>
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
                  
                     
                  </div>


                  
                  <div class="col-xs-6 text-right">
                  <p class="h4 badge bg-default">Reference number #{{ uniqid() }}</p>
                  <h5>{{ date('Y-m-d') }}</h5>   
                     <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($bills[0]->care_provider, 'QRCODE')}}" alt="barcode" /> 
                  </div>
                </div>  

               <div class="line"></div>
               <p style="font-size:18px"> {{ date("jS M Y", strtotime(date('Y-m-d')))  }} </p>
               <br>
               <br>
               <br>
               <br>
               <p style="font-size:18px"> Dear {{ ucwords(strtolower($bills->care_provider)) }}, </p>
                <p class="big" style="font-size:18px">
                We sumbit herewith Medical bill for the period {{ $bills->created_on }}. We appreciate your clients visit and hope the experience met their expectations. </p> 
                <br>
                 
                 <p class="big" style="font-size:18px">
                Total amount for the bill is GHC {{ 0 }}

                Enclosed, please find the details of summary of your clients visit to  our facility.  </p>
                <br>
                
                <p class="big" style="font-size:18px">
                We are most interested in your feedback about ways we can improve our services, and be grateful for any comments you might provide. 

               </p>

               <p style="font-size:18px"> Best wishes</p>

               <br>

               <p style="font-size:18px">Warmest Regards,</p>
               <br>
               <br>

               <p style="font-size:18px">Catherine Adu-Sarkodee, <br>
               Medical Director
               </p>
               <p style="font-size:18px"> Executive Health: The Program for Diagnostic and Preventive Medicine </p>

              
               
                  </section>

                  </section>
                  

             
@stop
<style type="text/css">
  p.big {
    line-height: 2;
}
</style>

