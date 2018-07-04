

@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>Bill</p>
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
                  </p>
                </div>
                <div class="col-xs-6 text-right">
                  <p class="h4 badge bg-default">#{{ $bills[0]->uuid }}</p>
                  <p>{{ $bills[0]->fullname }}</p>
                  <p>{{ $patients[0]->mobile_number }}</p>
                  <h5>{{ $bills[0]->date }}</h5>   
                  <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('$bills[0]->paymentid', 'QRCODE')}}" alt="barcode" />        
                </div>
              </div>       
          
              <div class="line"></div>
              <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                     
                    <th width="30" style="font-size:12px">DESCRIPTION</th>
                    <th width="30" style="font-size:12px">UNIT PRICE</th>
                    <th width="30" style="font-size:12px">QTY</th>
                    <th width="30" style="font-size:12px">TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($bills as $bill )
                  <tr>
                   
                    <td>{{ $bill->item_name }}</td>
                    <td>{{ $bill->amount }}</td>
                     <td>{{ $bill->quantity }}</td>
                    <td>{{ $bill->amount * $bill->quantity }}</td>
                  </tr>
                 @endforeach



                  <tr>
                    <td colspan="3" class="text-right"><strong>Subtotal</strong></td>
                    <td>GHS {{ $payables }}</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-right no-border"><strong>Paid</strong></td>
                    <td>GHS{{$receivables}}</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-right no-border"><strong>Total</strong></td>
                    <td><strong>GHS {{ number_format($payables-$receivables, 1, '.', ',') }}</strong></td>
                  </tr>
                </tbody>
              </table> 
              <p class="btn btn-sm btn-default pull-right">Printed By : {{ Auth::user()->getNameOrUsername() }}</p>
      <h4 class="text-center">Additional Notes</span></h1>
      <div class="text-center">
        <p>A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>
           
            
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop


