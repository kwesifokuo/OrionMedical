


@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>STORE RECEIVED VOUCHER</p>
            </header>
             <section class="scrollable wrapper">
             <img src="/images/{{ $company->logo }}" width="15%">
              <div class="row">
                <div class="col-xs-6">
                  <h4 style="font-size:12px">{{$company->legal_name }}</h4>
                  <p style="font-size:12px"><a href="#">{{ $company->email }}</a></p>
                   <p style="font-size:12px"><a href="#">{{ $company->address }}</a></p>
                   <p style="font-size:12px"><a href="#">{{ $company->phone }}</a></p>
                   <p style="font-size:12px"><a href="#">{{ $company->website }}</a></p>
                </div>
                <div class="col-xs-6 text-right">
                     <p>  <strong> SUPPLIER : </strong> {{ $items[0]->supplier }} </p>
                  <p>  <strong> RECEIVING STORE : </strong>  Gilead Medical Store  </p>
                  <p>  <strong> INVOICE NO. : </strong>  {{ $items[0]->invoice_number }}  </p>
                  <h5>{{ date('Y-m-d') }}</h5>   
                  <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('$items[0]->invoice_number', 'QRCODE')}}" alt="barcode" />        
                </div>
              </div>          
          
              <div class="line"></div>
              <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                    <th></th>
                    <th>DESCRIPTION</th>
                    <th>ITEM CODE</th>
                     <th>QUANTITY</th>
                    <th>UNIT PRICE</th>
                    <th>VALUE</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($items as $keys => $item )
                  <tr>
                  <td> {{ ++$keys }}</td>
                   <td>{{ ucwords($item->description) }}</td>
                    <td>GM000{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit_price }}</td>
                    <td>{{ $item->quantity * $item->unit_price }}</td>
                
                    
                  </tr>
                 @endforeach
                  <tr>
                    <td colspan="5" class="text-right"><strong>Total</strong></td>
                    <td>GHS {{ $items->sum('total_price') }}</td>
                  </tr>
                </tbody>
              </table> 
            

               <p class="btn btn-sm btn-default pull-right" style="font-size:12px">Printed By : {{ Auth::user()->getNameOrUsername() }} </p>

               <p class="btn btn-sm btn-default pull-right" style="font-size:12px">Created By : {{ $items[0]->created_by }} </p>

               <p class="btn btn-sm btn-default pull-right" style="font-size:12px">Created On : {{ $items[0]->created_on }} </p>
               
               
             

            
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop
