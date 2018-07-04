


@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>Receipt</p>
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
                  <p class="h4 badge bg-default">#{{ $bills[0]->visit_id }}</p>
                   <p>{{ $patients->fullname }}</p>
                  <p>{{ $patients->date_of_birth->age }}</p>
                  <p>{{ $patients->gender }}</p>
                  <p>{{ $patients->mobile_number }}</p>
                  <h5>{{ date('Y-m-d') }}</h5>   
                  <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('$bills[0]->visit_id ,$patients->fullname', 'QRCODE')}}" alt="barcode" />        
                </div>
              </div>          
          
              <div class="line"></div>
              <table class="table table-striped m-b-none text-sm" width="100%">
                <thead>
                  <tr>
                    <th>QTY</th>
                    <th>DRUG NAME</th>
                     <th>DOSAGE REMARK</th>
                    <th>STATUS</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($bills as $bill )
                  <tr>
                     <td>{{ $bill->drug_quantity }}</td>
                    <td>{{ $bill->drug_name }}</td>
                     <td>{{ ucwords($bill->drug_application) }}</td>
                    @if($bill->status == 'Dispensed')
                    <td>Dispensed</td>
                    @else
                     <td>Not Dispensed</td>
                    @endif
                  </tr>
                 @endforeach
                  
                </tbody>
              </table> 
            

               <p class="btn btn-sm btn-default pull-right" style="font-size:12px">Printed By : {{ Auth::user()->getNameOrUsername() }} </p>
               
               
             

            
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop
