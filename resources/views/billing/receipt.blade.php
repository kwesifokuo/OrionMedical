@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>Receipt</p>
            </header>
             <section class="scrollable wrapper">
             <img src="/images/{{ $mycompany->logo }}" width="15%">
              <div class="row">
                <div class="col-xs-6">
                  <h4 style="font-size:10px">{{$mycompany->legal_name }}</h4>
                  <p style="font-size:10px"><a href="#">{{ $mycompany->email }}</a></p>
                   <p style="font-size:10px"><a href="#">{{ $mycompany->address }}</a></p>
                   <p style="font-size:10px"><a href="#">{{ $mycompany->phone }}</a></p>
                   <p style="font-size:10px"><a href="#">{{ $mycompany->website }}</a></p>
                </div>
                 @foreach($bills as $bill )
                <div class="col-xs-6 text-right">
                  <p class="h4 badge bg-default">#{{ $bill->PaymentID }}</p>
                   <p> {{ $bill->items[0]->fullname }} </p>

                  <h5>{{ date('Y-m-d') }}</h5>   
                  <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('$bills->PaymentID', 'QRCODE')}}" alt="barcode" />        
                </div>
              </div>          
          
              <div class="line"></div>
              <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                    <th width="30" style="font-size:10px">QTY</th>
                    <th width="30" style="font-size:10px">DESCRIPTION</th>
                    <th width="30" style="font-size:10px">UNIT PRICE</th>
                    <th width="30" style="font-size:10px">TOTAL</th>
                  </tr>
                </thead>
                <tbody>

                 @foreach($bill->items as $basket )

                  <tr>
                    <td style="font-size:10px"> {{ $basket->quantity }} </td>
                    <td style="font-size:10px"> {{ $basket->item_name }} </td>
                    <td style="font-size:10px"> {{ $basket->rate }} </td>
                    <td style="font-size:10px"> {{ $basket->rate *  $basket->quantity}} </td>
                  </tr>
                @endforeach
                  <tr>
                    <td colspan="3" class="text-right" style="font-size:10px"><strong>Amount Due</strong></td>
                    <td style="font-size:10px">GHS {{ $bill->items->sum('total_price') }}</td>
                  </tr>

                  <tr>
                    <td colspan="3" class="text-right" style="font-size:10px"><strong>Amount Paid</strong></td>
                    <td style="font-size:10px">GHS {{ $receivables - $bill->AmountReceived  }}</td>
                  </tr> 
          
                  <tr>
                    <td colspan="3" class="text-right no-border" style="font-size:10px"><strong>Cash Tendered</strong></td>
                    <td style="font-size:10px"><strong>GHS {{ $bill->AmountReceived }}</strong></td>
                  </tr>

                   <tr>
                    <td colspan="3" class="text-right no-border" style="font-size:10px"><strong>Change</strong></td>
                   <td style="font-size:10px"><strong>GHS {{ $bill->items->sum('total_price') - $receivables  }} </strong></td>
                  </tr>
                </tbody>
              </table> 
              
            <p class="btn btn-sm btn-default pull-right" style="font-size:10px">Printed By : {{ Auth::user()->getNameOrUsername() }} </p>
      <h4 class="text-center" style="font-size:10px">Thank you for your payment!</h4>
     
        <p style="font-size:10px">We declare that this RECEIPT shows the actual price of the services/drugs described and that all particulars are true and correct with NHIL/VAT inclusive.</p>
        <p style="font-size:10px">Amount Includes Vat</p>
            
            @endforeach
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop
