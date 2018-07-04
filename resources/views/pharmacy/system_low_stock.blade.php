@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Pharmacy Reports</div>
              <ul class="nav">
                 <li class="b-b b-light"><a href="/pharmacy.dashboard"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Overview</a></li>
                <li class="b-b b-light"><a href="/report-dispensed-drugs"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Drugs Dispensed</a></li>
                 <li class="b-b b-light"><a href="/report-mpharma-drugs"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>mPharma Dispensed</a></li>
                 
               <li class="b-b b-light"><a href="/expired-drugs"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Reported Expired Drugs</a></li>
                <li class="b-b b-light"><a href="/flagged-expired-drugs"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Flagged Expired Drugs</a></li>
                 <li class="b-b b-light"><a href="/flagged-low-stock"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Flagged Low Stock </a></li>
                <li class="b-b b-light"><a href="/damaged-drugs"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Damaged Drugs</a></li>
                         <li class="b-b b-light"><a href="/expired-reported-drugs"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Expired Drugs</a></li>

                <li class="b-b b-light"><a href="/transfered-drugs"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Transfered Drugs</a></li>

                <li class="b-b b-light"><a href="/returned-drugs"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Returned Drugs</a></li>
                <li class="b-b b-light"><a href="/stock-level-transactions"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Stock Level Audit</a></li>
   
        
              </ul>
            </aside>
            <aside>
              <section class="vbox">
               <section class="panel panel-default">
                  <header class="panel-heading">
                    {{-- <form action="/find-drugs" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by drug name, patient, status">
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-success" type="submit">Search!</button>
                        </div>
                      </div>
                      </form> --}}
                       <a href="/download-flagged-low-stock"><button class="btn btn-success pull-right">Download xls</button></a>
                    </header>
                    <div class="table-responsive">
                    
                      <table class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                          <tr>
                            
                           
                           
                            <th>Date Expired </th>
                            <th>Item</th>
                           <th>Quantity</th>
                            <th>Price</th>
                            <th>Cost</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($drugs as $drug )
                          <tr>
                            
                            <td>{{ $drug->expiry_date }}</td>
                            <td>{{ $drug->name }}</td>
                            <td>{{ $drug->stock }}</td>
                            <td>{{ $drug->unit_price }}</td>
                            <td>{{ $drug->stock *  $drug->unit_price }}</td>

                           
                         @endforeach 
                        </tbody>
 
                      </table>
                    </div>
                  </section>
                <footer class="footer bg-white b-t">


                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $drugs->total() }} {{ str_plural('Drug', $drugs->total()) }}</span>

                       <span class="badge badge-info">Total Cost of Drugs : {{ $totalcost }} </span>
                      </p>
                    </div>
                    {!!$drugs->render()!!}
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                        
                        
                    </div>
                  </div> 
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop



