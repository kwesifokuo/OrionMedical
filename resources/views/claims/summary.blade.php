@extends('layouts.default')
@section('content')


          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>Claim Summary  </p>
            </header>

            
             <section class="scrollable wrapper">
             
            
            <div class="page">
             <img src="/images/{{ $company->logo }}" width="15%">
              
            
           <h4 align="center"> <strong>Claims Summary from {{ $datefrom }} to {{ $dateto }} </strong></h4>
             
             <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                          <th></th>
                            <th>Claim #</th>
                            <th>Name</th>
                            <th>Copayer</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Top Up</th>
                            <th>Payable</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($bills as $keys => $bill )
                          <tr>
                            <td>{{ ++$keys }}</td>
                             <td><a href="#" class="text-danger">CL{{ $bill->visit_id }}</a></td>
                            <td>{{ ucwords(strtolower($bill->fullname)) }}</td>
                            <td>{{ $bill->copayer }}</td>
                            <td>{{ $bill->item_name }} ...</td>
                            <td>{{ $bill->date }}</td>
                            <td> {{ number_format($bill->total_cost , 1, '.', ',') }}</td>
                             <td>{{ number_format($bill->payments->sum('AmountReceived'), 1, '.', ',') }}</td>
                             <td>{{  number_format($bill->total_cost - $bill->payments->sum('AmountReceived') ,1, '.', ',') }}</td>
                          </tr>
                          @endforeach
                           
                   <tr>
                    <td colspan="6" class="text-right no-border"><strong>Paid</strong></td>
                    <td>GHS {{  $bills->total_cost }}</td>
                  </tr>
                 
                         
                        </tbody>
                        </table>
              <aside>
               <p class="btn btn-sm btn-default pull-right">Printed By : {{ Auth::user()->getNameOrUsername() }}</p>
              
     

      </div>
    </aside> 
 <br>
          
  </div>

     </section>

{{--      <img align="right" src="/images/unpaid.png" width="15%">   --}}<br>
          
              

            
            </section>



          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop



