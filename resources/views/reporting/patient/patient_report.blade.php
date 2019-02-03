@extends('layouts.default')
@section('content')


          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>Patient List  </p>
            </header>

            
             <section class="scrollable wrapper">
             
            
            <div class="page">
             <img src="/images/{{ $mycompany->logo }}" width="15%">
              
            
           <h4 align="center"> <strong>Patient list from {{ $datefrom }} to {{ $dateto }} </strong></h4>
             
            <table class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                          <tr>
                            <th > </th>
                            <th >Patient Record # </th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Birthday</th>
                            <th>Phone</th>
                            <th>Address</th>
                             <th>Account Type</th>
{{--                             <th>Date Registered</th> --}}
                            <th>Copayer</th>
                             
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $customerlists as $keys=> $customerlist )
                          <tr>
                           <td>{{ ++$keys}}</td>
                            <td><a href=""  id="edit" name="edit" data-toggle="modal" alt="edit">{{ $customerlist->ref_code }}</a></td>
                            <td>{{  ucwords(strtolower($customerlist->fullname)) }}</td>
                             <td>{{ $customerlist->gender }}</td>
                              <td>{{ $customerlist->date_of_birth->format('Y-m-d')  }} <span class="badge badge-info"> {{$customerlist->date_of_birth->age}} year(s) </span></td>
                            <td>{{ $customerlist->mobile_number }}</td>
                             <td>{{  ucwords(strtolower(str_limit($customerlist->residential_address,15))) }}</td>
                             <td>{{  ucwords(strtolower(str_limit($customerlist->accounttype,15))) }}</td>
 {{--                            {{ Carbon\Carbon::parse($customerlist->created_at)->diffForHumans() }}</td> --}}
                             <td>@if($customerlist->accounttype=='Corporate')  {{ str_limit($customerlist->company,15) }}
                              @elseif($customerlist->accounttype=='Health Insurance') {{ str_limit($customerlist->insurance_company,15) }} 
                              @else 
                              @endif
                              </td>
                          
                          </tr>
                         @endforeach
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



