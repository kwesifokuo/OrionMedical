@extends('layouts.print')
@section('content')

          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>Claim Form  - {{ 0  }}</p>
            </header>



             

       

            
             <section class="scrollable wrapper">

             <div class="page">
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
                     <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($visits[0]->care_provider, 'QRCODE')}}" alt="barcode" /> 
                  </div>
                </div>  

               <div class="line"></div>
               <p style="font-size:18px"> {{ date("jS M Y", strtotime(date('Y-m-d')))  }} </p>
               <br>
               <br>
               <br>
               <br>
               <p style="font-size:18px"> Dear {{ $visits[0]->care_provider }}, </p>
                <p class="big" style="font-size:18px">
                We sumbit herewith Medical bill for the period {{ date("jS M Y", strtotime($from))  }} to {{ date("jS M Y", strtotime($to))  }}. We appreciate your clients visit and hope the experience met their expectations. </p>
                <br>
                 
                 <p class="big" style="font-size:18px">
                Total amount for the bill is GHS {{  number_format($totalbill - $totalpayments, 2, '.', ',') }} <br>


                 Total number of claims are {{ $visits->count() }}

                <br>

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

               <p style="font-size:18px"> ...................................................................<br>
               Claims Director
               </p>
              </div>


               <div class="page">
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
                     <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($visits[0]->care_provider, 'QRCODE')}}" alt="barcode" /> 
                  </div>
                </div>  

               <div class="line"></div>
               <p style="font-size:18px"> {{ date("jS M Y", strtotime(date('Y-m-d')))  }} </p>
               <br>
               <br>
               <br>
               <br>


              <div class="line"></div>
              
           
              
              <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                  <th width="30" style="font-size:12px">#</th>
                  <th width="30" style="font-size:12px">Date</th>
                    <th width="30" style="font-size:12px">Hospital #</th>
                     <th width="30" style="font-size:12px">Name</th>
                    <th width="30" style="font-size:12px">Claim #</th>
                    <th width="30" style="font-size:12px">Insurance #</th>
                    <th width="30" style="font-size:12px">Total</th>
                    <th width="30" style="font-size:12px">Diagnosis</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($visits as $keys => $visit )

                
                  <tr>
                    <td>{{ ++$keys }}</td>
                    <td>{{ $visit->created_on }}</td>
                    <td>{{ $visit->patient_id }}</td>
                    <td>{{ strtoupper($visit->name) }}</td>
                     <td><a href="/vet-claim/{{ $visit->opd_number }}" >{{ $visit->opd_number }} </a> </td>
                    <td>{{ $visit->patient->insurance_id }}</td>
                    <td>{{ $visit->bills->sum('total_price') - $visit->payments->sum('total_price') }}</td>
                    <td>@foreach($visit->diagonsis as $val) {{ strtoupper($val->diagnosis) }}@endforeach</td>
                  </tr>
                 @endforeach
                  <tr>
                    
                    <td colspan="6" class="text-right"><strong>Grand Total</strong></td>
                    <td>GHS {{ number_format($totalbill - $totalpayments, 2, '.', ',') }}  </td>
                    
                  </tr>



                </tbody>
              </table> 
               
                
              </div>



              @foreach($visits as $visit)


            
            <div class="page">
             <img src="/images/{{ $mycompany->logo }}" width="15%">
              
              <div class="row">
                <div class="col-xs-6">
                   <h4>{{$mycompany->legal_name }} </h4>
                 <p> <strong> Provider : </strong> {{ $visit->care_provider }} </p>  
                 <p>  <strong> Patient Name : </strong> {{ $visit->name }}</p>
                 <p>  <strong> Age : </strong> {{ $visit->patient->date_of_birth->age }}</p>
                  <p>  <strong> Gender : </strong> {{ $visit->patient->gender }}</p>
                  <p>  <strong> Contact No.: </strong> {{ $visit->patient->mobile_number }}</p>
                   <p>  <strong> Admission Time/Date : </strong> {{ date("g:ia\, jS M Y", strtotime($visit->created_on )) }}</p>
                  <br>                 
                </div>
                <div class="col-xs-6 text-right">
                 <br>
                  <p>   <strong> Insurance # : </strong> {{ $visit->patient->insurance_id }}</p>
                   <p>   <strong> Cover Type  # : </strong> {{ $visit->patient->insurance_cover }}</p>
                  <p>   <strong> Claim # : </strong> {{ $visit->opd_number }}</p>
                   <p>  <strong> Patient # : </strong> {{ $visit->patient_id }}</p>
                  <p>  <strong> Date : </strong> {{ date("jS M Y", strtotime(date('Y-m-d')))  }}</p>  
                  <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($visit->opd_number, 'QRCODE')}}" alt="barcode" />        
                </div>
              </div>       
           
              <div class="line"></div>
              
             <p class="text-dark">Consultation Type :  <label class="badge bg-info"> {{ $visit->consultation_type }} </label> </p>
              <p class="text-dark">Diagnosis or Nature of Illness :  <label class="badge bg-info"> @foreach($visit->diagonsis as $val) {{ strtoupper($val->diagnosis) }}@endforeach  </label>  </p> 
              
              <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                    <th width="30" style="font-size:12px">DESCRIPTION</th>
                     <th width="30" style="font-size:12px">SOURCE</th>
                    <th width="30" style="font-size:12px">QTY</th>
                    <th width="30" style="font-size:12px">UNIT PRICE</th>
                    <th width="30" style="font-size:12px">TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($visit->bills as $bill )
                  <tr>
                    <td>{{ $bill->item_name }}</td>
                    <td>{{ $bill->category }}</td>
                    <td>{{ $bill->quantity }}</td>
                    <td>{{ $bill->amount }}</td>
                    <td>{{ $bill->amount * $bill->quantity }}</td>
                  </tr>

                
                 @endforeach
                 

                  

                  <tr>
                    <td colspan="4" class="text-right"><strong>Subtotal</strong></td>
                    <td>GHS {{ number_format($visit->bills->sum('total_price'), 2, '.', ',') }}  </td>
                  </tr>
                  <tr>
                    <td colspan="4" class="text-right no-border"><strong>Paid</strong></td>
                    <td>GHS {{  number_format($visit->payments->sum('total_price'), 2, '.', ',') }}</td>
                  </tr>
                  <tr>
                    <td colspan="4" class="text-right no-border"><strong>Total</strong></td>
                    <td><strong>GHS {{ number_format($visit->bills->sum('total_price') - $visit->payments->sum('total_price'), 2, '.', ',') }}</strong></td>
                  </tr> 
                   

                </tbody>
              </table> 
              <aside>
               <p class="btn btn-sm btn-default pull-right">Printed By : {{ Auth::user()->getNameOrUsername() }}</p>
               <p class="btn btn-sm btn-default pull-left">Doctor's Name : {{ $visit->referal_doctor }}</p>
      <h4 class="text-center">Additional Notes</h4>
      <div class="text-center">
        <p >A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>

      </div>
    </aside> 
 <br>
          
  </div>
 @endforeach
     </section>

{{--      <img align="right" src="/images/unpaid.png" width="15%">   --}}<br>
          
              

            
            </section>



          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop


<style type="text/css">


      body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 300mm;
        min-height: 297mm;
        padding: 10mm;
        margin: 5mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
   /* .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }*/
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 300mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

</style>

