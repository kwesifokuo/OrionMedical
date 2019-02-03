@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>Executive Health Cover Letter</p>
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
                     <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($admission->name, 'QRCODE')}}" alt="barcode" /> 
                  </div>
                </div>  

               <div class="line"></div>
               <p style="font-size:18px"> {{ date("jS M Y", strtotime(date('Y-m-d')))  }} </p>
               <br>
               <br>
               <br>
               <br>
               <p style="font-size:18px"> Dear {{ ucwords(strtolower($patients->fullname)) }}, </p>
                <p class="big" style="font-size:18px">
                Thank you for participating in the <strong>{{ $admission->consultation_type }}</strong>. We appreciate your visit and hope the experience met your expectations. </p> 
                <br>
                 
                 <p class="big" style="font-size:18px">
                Enclosed please find the results of your various examinations and summary of your visit by the physician. We suggest that you retain this with your medical records that you provide a copy to your personal physician. We would be pleased to hear from you or your physican if you have any questions or concerns about the results or if we can be helpful in providing referrals for any additional services that may have been recommended. </p>
                   <br>
                
                <p class="big" style="font-size:18px">
                We are most interested in your feedback about ways we can improve our services, and be grateful for any comments you might provide. 

               </p>

               <p style="font-size:18px"> Best wishes for your good health.</p>

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

