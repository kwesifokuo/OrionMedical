@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>Treatment Plan</p>
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
                  <br>
                  <br>
                     
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="h4"># {{ $admission[0]->visitid }}</p>
                    <p class="h4">{{ $patients->fullname }}</p>
                    <h5>{{ date('Y-m-d') }}</h5> 
                    <br>
                    <br>
                     <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($admission[0]->visitid, 'QRCODE')}}" alt="barcode" /> 
                  </div>
                </div>   


            <div class="line"></div>
              <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                    <th width="30" style="font-size:12px">QTY</th>
                    <th width="30" style="font-size:12px">DESCRIPTION</th>
                    <th width="30" style="font-size:12px">UNIT PRICE</th>
                    <th width="30" style="font-size:12px">TOTAL</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($admission as $bill )
                  <tr>
                    <td>{{ $bill->procedure_quantity }}</td>
                    <td>{{ $bill->procedure }} - {{ $bill->remark }}</td>
                    <td>{{ $bill->cost }}</td>
                    <td>{{ $bill->cost * $bill->procedure_quantity }}</td>
                  </tr>
                 @endforeach



                  <tr>
                    <td colspan="3" class="text-right"><strong>Subtotal</strong></td>
                    <td>GHS {{  $payables }}</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-right no-border"><strong>Deliveries</strong></td>
                    <td>GHS0.00</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-right no-border"><strong>Total</strong></td>
                    <td><strong>GHS {{  $payables }}</strong></td>
                  </tr>
                </tbody>
              </table>  
             


               
@stop