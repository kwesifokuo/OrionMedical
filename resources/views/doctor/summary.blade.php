@extends('layouts.default')
@section('content')

          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>NOTES</p>
              </header>
              
              <section class="scrollable wrapper" id="summaryreport">
             <img src="/images/{{ $company->logo }}" width="15%">
              <div class="row">
                <div class="col-xs-8">
                  <h6> <strong>{{$company->legal_name }} - @if($admission->payercode=='Corporate') CORPORATE ANNUAL MEDICAL EXAM REPORT @else  {{ $admission->consultation_type }} @endif   </strong> </h6>
              
                 <p>  <strong> Patient Name : </strong> {{ $patients->fullname }}</p>
                  <p>  <strong> Care Provider : </strong> {{ $admission->care_provider }}</p>
                 <p>  <strong> Age : </strong> {{ $patients->date_of_birth->age }} year(s)</p>
                  <p>  <strong> Gender : </strong> {{ $patients->gender }}</p>
                  <p>  <strong> Contact No.: </strong> {{ $patients->mobile_number }}</p>
                   <p>  <strong> Examination Time/Date : </strong> {{ date("g:ia\, jS M Y", strtotime($admission->created_on )) }}</p>
                 
                </div>
                <div class="col-xs-4 text-right">
                <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('$admission->opd_number', 'QRCODE')}}" alt="barcode" />     
                  <p>  <strong> Insurance # : </strong> {{ $patients->insurance_id }}</p>
                  <p>  <strong> Examination # : </strong> {{ $admission->opd_number }}</p>
                  <p>  <strong> Patient # : </strong> {{ $patients->patient_id }}</p>
                  <p>  <strong> Date : </strong> {{ date("jS M Y", strtotime(date('Y-m-d')))  }}</p>  
                     
                </div>
              </div>    

               <div class="line"></div>
               <p style="font-size:12px"> <strong> To whom it May Concern: </strong><br>
                I had the privilege to see {{ $patients->fullname }} at the clinic today. @if($patients->gender=='Male') He @else She @endif is a  {{ $patients->date_of_birth->age }}-year-old {{ $patients->gender }} with no significant past medical history who presents to {{$company->legal_name }} as a participant in the <strong> @if($admission->payercode=='Corporate') CORPORATE ANNUAL MEDICAL EXAM REPORT @else  {{ $admission->consultation_type }} @endif </strong>.
               </p>

 
               <div class="line"></div>



                  <div class="row">
                  <div class="media-body">
                  <p>
                    <span><strong>History</strong></span>
                               <ol>
                                @foreach($myhistories as $history)
                               
                                @if($history->medical_history == '') @else <li> <small class="block m-t-xs">Past Medical History : <b> {{ strtoupper($history->medical_history)}} </b> </small> </li> @endif
                                
                                @if($history->family_history == '') @else <li> <small class="block m-t-xs"> Family History : <b>{{strtoupper($history->family_history)}} </b> </small> </li> @endif
                              
                              
                                 @if($history->drug_history == '') @else<li> <small class="block m-t-xs"> Drug History :  <b> Takes {{strtoupper($history->drug_history)}}  </b> </small> </li> @endif
                                
                                @if($history->surgical_history == '') @else <li> <small class="block m-t-xs"> Surgical History : <b>{{strtoupper($history->surgical_history)}}</b> </small> </li> @endif
                               
                                @if($history->allergy == '') @else <li> <small class="block m-t-xs"> Allergies : <b>{{strtoupper($history->allergy)}} </b> </small> </li> @endif

                                 @if($history->vaccinations_history == '') @else <li> <small class="block m-t-xs"> Vacinnations : <b>{{strtoupper($history->vaccinations_history)}} </b> </small> </li> @endif
                              
                               @endforeach
                               </ol>
                               
                           </p>
                           </div>
                           </div>
                 
            <div class="row">
                    <div class="col-xs-12">
                  <p style="font-size:12px">
                    <span><strong style="font-size:12px">Vitals</strong></span>
                              <table>
                               @foreach($myvitals as $vital)
                               <tr>
                               <td>
                                @if($vital->weight == '') @else <li style="font-size:12px"> Weight <label class="badge bg-info"> {{strtoupper($vital->weight)}}  </label></li> @endif
                                </td>
                                <td>
                                @if($vital->height == '') @else <li style="font-size:12px"> Height <label class="badge bg-info"> {{strtoupper($vital->height)}}  </label></li> @endif
                                </td>
                                <td>
                                 @if($vital->bmi == '') @else <li style="font-size:12px"> BMI <label class="badge bg-info"> {{strtoupper($vital->bmi)}}  </label></li> @endif
                                 </td>
                                 <td>
                                @if($vital->temperature == '') @else <li style="font-size:12px"> Temperature <label class="badge bg-info"> {{strtoupper($vital->temperature)}} ° </label></li> @endif
                                </td>
                                <td>
                                @if($vital->pulse_rate == '') @else <li style="font-size:12px"> Pulse Rate <label class="badge bg-info"> {{strtoupper($vital->pulse_rate)}}  </label></li> @endif
                                </td>
                                <td>
                                @if($vital->sbp == '') @else <li style="font-size:12px"> Blood Pressure <label class="badge bg-info"> {{strtoupper($vital->sbp)}} / {{$vital->dbp}}  </label></li> @endif
                                </td>
                                 </tr>
                               @endforeach
                               </table>
                  </p>
                  </div>
                  </div>

                  <div class="row">
                  <div class="col-xs-12">
                  <p style="font-size:12px">
                     <span><strong>General Examination</strong></span>
                                 @foreach($mype as $physical)
                                <ol>
                                @if($physical->pe_general == '') @else <li> <small class="block m-t-xs">General : <b> {{ strtoupper($physical->pe_general)}} </b> </small> </li> @endif

                                @if($physical->pe_HEENT == '') @else  <li> <small class="block m-t-xs">HEENT : <b> {{strtoupper($physical->pe_HEENT)}} </b> </small> </li> @endif


                                @if($physical->pe_neck == '') @else  <li> <small class="block m-t-xs">Neck : <b> {{strtoupper($physical->pe_neck)}} </b> </small> </li> @endif

                                 @if($physical->pe_respiratory == '') @else  <li> <small class="block m-t-xs">Respiratory : <b> {{strtoupper($physical->pe_respiratory)}} </b> </small> </li> @endif

                                @if($physical->pe_heart == '') @else  <li> <small class="block m-t-xs">Cardiovascular : <b> {{strtoupper($physical->pe_heart)}} </b> </small> </li> @endif


                                @if($physical->pe_abdominal == '') @else  <li> <small class="block m-t-xs">Abdominal : <b> {{strtoupper($physical->pe_abdominal)}} </b> </small> </li> @endif

                                @if($physical->pe_extremities == '') @else  <li> <small class="block m-t-xs">Extremities : <b> {{strtoupper($physical->pe_extremities)}} </b> </small> </li> @endif

                                @if($physical->pe_cns == '') @else  <li> <small class="block m-t-xs">CNS : <b> {{strtoupper($physical->pe_cns)}} </b> </small> </li> @endif

                                @if($physical->pe_musculoskeletal == '') @else  <li> <small class="block m-t-xs">Musculoskeletal : <b> {{strtoupper($physical->pe_musculoskeletal)}} </b> </small> </li> @endif


                                @if($physical->pe_psychological == '') @else <li> <small class="block m-t-xs">Psychological : <b> {{strtoupper($physical->pe_psychological)}} </b> </small> </li> @endif
                                 </ol>

                               @endforeach

                  </p>
                  </div>
                  </div>

              
              <div class="row">
              <div class="col-xs-12">
                  <p style="font-size:12px">
                      <span><strong>Investigations</strong></span>
                       
{{--                       

                               @foreach($mylabs as $lab)
                                
                               <div class="col-lg-4 col-sm-6 thumb-lg">
                              
                                 <a><p style="font-size:9px"> {{$lab->investigation}}...<label class="badge bg-default col-lg-4 col-sm-6 thumb-lg"> {{$lab->remark}}  </label></p></a>
                                 
                            
                               </div>
                               @endforeach --}}
                            <div>
                            <ul class="checkbox-grid">
                             @foreach($mylabs as $lab)
                              <li><span style="font-size:9px">{{$lab->investigation}}</span> - <b>{{ strtoupper($lab->remark)}} </b></li>
                            
                               @endforeach
                          </ul>
                          </div>

                        
                  </p>
                  </div>
                  </div>


            
                  <div class="row">
                  <div class="col-xs-12">
                  <p style="font-size:12px">
                    <span><strong>Oral Examination Findings</strong></span>    
                      <p> @foreach($myoralassessment as $myoralassessment) <label > {{ strtoupper($myoralassessment->assessment) }}, </label> @endforeach </p> 
                      

                  </p> 
                  </div>
                  </div>

                  <p style="font-size:14px">
                    <span><strong>Eye Examination Findings</strong></span>
                     <p> @foreach($eyefindings as $eyefinding) <label > {{ strtoupper($eyefinding->diagnosis) }}, </label> @endforeach </p> 
                  </p>  
                 
                 

                  <div class="row">
                  <div class="col-xs-12">
                  <p style="font-size:14px">
                    <span><strong>Conclusion</strong></span>
                   
                    <p> @foreach($myplans as $myplan) <label > {!! strtoupper($myplan->plan) !!}, </label> @endforeach.....................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................ </p>      
                  </p> 
                  </div>
                  </div>
                    <br>
                    <br>

                   <div class="row">
                  <div class="col-xs-12">
                  <p style="font-size:14px">
                    <span><strong>Recommendation(s)</strong></span>
                   
                    <p> @foreach($myplans as $myplan) <label > {!! strtoupper($myplan->action) !!}, </label> @endforeach.....................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................ </p>      
                  </p> 
                  </div>
                  </div> 
                  <br>
                  <br>
                  <br>
                  <p class="pull-right"> ............................................................................. <br> Medical Practitioner's Name : {{ $admission->referal_doctor  }} </p>
                  
                  </section>
                  
                  </section>

             
@stop



