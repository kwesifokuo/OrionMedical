@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>Claim Form</p>
            </header>
              <section class="scrollable wrapper">
              @foreach($visits as $visit)
            
            <div class="page">
             <img src="/images/{{ $company->logo }}" width="15%">
              
              <div class="row">
                <div class="col-xs-6">
                   <h4>{{$company->legal_name }} </h4>
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
                  <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('222', 'QRCODE')}}" alt="barcode" />        
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
                    <td>GHS {{ $visit->bills->sum('total_price') }}  </td>
                  </tr>
                  <tr>
                    <td colspan="4" class="text-right no-border"><strong>Paid (Top Up)</strong></td>
                    <td>GHS {{  $visit->payments->sum('total_price') }}</td>
                  </tr>
                  <tr>
                    <td colspan="4" class="text-right no-border"><strong>Total</strong></td>
                    <td><strong>GHS {{ $visit->bills->sum('total_price') - $visit->payments->sum('total_price') }}</strong></td>
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
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
          
        </section>
@stop