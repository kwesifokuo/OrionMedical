@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>Referal Letter</p>
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
                  
                     
                  </div>
                  <div class="col-xs-6 text-right">
                 <p>   <strong> OPD # : </strong> {{ $admission->opd_number }}</p>
                  <p>  <strong> Patient Name : </strong> {{ $patients->fullname }}</p>
                  <p>  <strong> Age : </strong> {{ $patients->date_of_birth->age }}</p>
                  <p>  <strong> Gender : </strong> {{ $patients->gender }}</p>
                  <p>  <strong> Admission Time/Date : </strong> {{ date("g:ia\, jS M Y", strtotime($admission->created_on )) }}</p>
                    
                    <h5>{{ date('Y-m-d') }}</h5> 
                   
                     <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($admission->name, 'QRCODE')}}" alt="barcode" /> 
                  </div>
                </div>    
              <div>

               <p style="font-size:12px"> <strong>Chief Complaint :</strong> @foreach($mycomplaints as $complaint)
                               <a a href="#"> {{$complaint->complaint}} <i onclick="removecomplain('{{$complaint->id}}','{{$complaint->complaint}}')" class="fa fa-trash-o"></i></a>
                               @endforeach 
                            
                        
                               </p>
                               <br>

                  <p style="font-size:12px"> <strong>HPI :</strong> @foreach($mycomplaints as $complaint)
                               <a a href="#"> {!!$complaint->presenting!!} <i onclick="removecomplain('{{$complaint->id}}','{{$complaint->complaint}}')" class="fa fa-trash-o"></i></a>
                               @endforeach </p>
                               <br>


              
                  <p style="font-size:12px">
                    <span><strong>Past Medical History :  </strong></span>
                    <br>
                                @foreach($myhistories as $history)
                                <ul>
                                @if($history->medical_history == '') @else <li>Past Medical History <label class="badge bg-default"> {{$history->medical_history}}  </label></li> @endif
                                @if($history->family_history == '') @else <li>Family History <label class="badge bg-info"> {{$history->family_history}}  </label></li> @endif
                                @if($history->social_history == '') @else <li> Social History <label class="badge bg-primary"> {{$history->social_history}}  </label></li> @endif
                                 @if($history->drug_history == '') @else <li> Drug History <label class="badge bg-success">Takes {{$history->drug_history}}  </label></li> @endif
                                @if($history->surgical_history == '') @else <li>Surgical History <label class="badge bg-warning"> {{$history->surgical_history}}  </label></li> @endif
                                @if($history->reproductive_history == '') @else <li> Reproductive History <label class="badge bg-danger"> {{$history->reproductive_history}}  </label></li> @endif
                                @if($history->vaccinations_history == '') @else <li>Vacinnations <label class="badge bg-default"> {{$history->vaccinations_history}}  </label></li> @endif
                                @if($history->allergy == '') @else <li> Allergies <label class="badge bg-danger"> {{$history->allergy}}  </label></li> 
                                @endif
                                </ul>
                               @endforeach 
                              
                  </p>


                     <div class="row">
                  <div class="col-xs-12">
                  <p style="font-size:12px">
                     <span><strong>Examination Finding(s)</strong></span>
                                 @foreach($mype as $physical)
                                <ol>
                                @if($physical->pe_general == '') @else <li> <small class="block m-t-xs">General : <b> {{$physical->pe_general}} </b> </small> </li> @endif

                                @if($physical->pe_HEENT == '') @else  <li> <small class="block m-t-xs">HEENT : <b> {{$physical->pe_HEENT}} </b> </small> </li> @endif


                                @if($physical->pe_neck == '') @else  <li> <small class="block m-t-xs">Neck : <b> {{$physical->pe_neck}} </b> </small> </li> @endif

                                 @if($physical->pe_respiratory == '') @else  <li> <small class="block m-t-xs">Respiratory : <b> {{$physical->pe_respiratory}} </b> </small> </li> @endif

                                @if($physical->pe_heart == '') @else  <li> <small class="block m-t-xs">Cardiovascular : <b> {{$physical->pe_heart}} </b> </small> </li> @endif


                                @if($physical->pe_abdominal == '') @else  <li> <small class="block m-t-xs">Abdominal : <b> {{$physical->pe_abdominal}} </b> </small> </li> @endif

                                @if($physical->pe_extremities == '') @else  <li> <small class="block m-t-xs">Extremities : <b> {{$physical->pe_extremities}} </b> </small> </li> @endif

                                @if($physical->pe_cns == '') @else  <li> <small class="block m-t-xs">CNS : <b> {{$physical->pe_cns}} </b> </small> </li> @endif

                                @if($physical->pe_musculoskeletal == '') @else  <li> <small class="block m-t-xs">Musculoskeletal : <b> {{$physical->pe_musculoskeletal}} </b> </small> </li> @endif


                                @if($physical->pe_psychological == '') @else <li> <small class="block m-t-xs">Psychological : <b> {{$physical->pe_psychological}} </b> </small> </li> @endif
                                 </ol>

                               @endforeach

                  </p>
                  </div>
                  </div>

                  <br>
                  <br>

                   <p style="font-size:12px">
                     <span><strong>Diagnosis(es)</strong></span>
                               <p class="text-dark"> @foreach($mydiagnosis as $mydiagnosis) <label >  {{ strtoupper($mydiagnosis->diagnosis) }} </label>  @endforeach .....................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br>  </p>
                  </p>
 
                  <p style="font-size:12px">
                  <span><strong>Investigation done so far</strong></span>
                                <p class="text-dark"> @foreach($mylabs as $lab) <label> {{ strtoupper($lab->investigation) }} </label> @endforeach .....................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br> </p>
                  </p>

                  <p style="font-size:12px">
                 <span><strong>Medication(s) prescribed</strong></span>
                           <p class="text-dark"> @foreach($mydrugs as $drug) <label > {{ strtoupper($drug->drug_name) }}, </label> @endforeach .....................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br> </p>
                  </p>

                    <p style="font-size:12px">
                 <span><strong>Reason for Referal </strong></span>
                           <p class="text-dark"> @foreach($myplan as $val) <label > {{ strtoupper($val->assessment) }}, </label> @endforeach .....................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................<br> </p>
                  </p>


                  <p class="btn btn-sm btn-default pull-right"> Referring Doctor : {{ Auth::user()->getNameOrUsername() }}</p>
              <br>
              <br>
              <br>
                <br>
              <p class="btn btn-sm btn-default pull-right">Referring Doctor's Signature : .....................................................................  </p>
              <br>
              <br>
                <br>
                

               
@stop