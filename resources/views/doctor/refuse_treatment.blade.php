@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>REFUSAL OF TREATMENT AGAINST MEDICAL ADVICE</p>
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
                  <br>
                  <br>
                     
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="h4"># {{ $admission->opd_number }}</p>
                    <h5>{{ date('Y-m-d') }}</h5> 
                    <br>
                    <br>
                     <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($admission->name, 'QRCODE')}}" alt="barcode" /> 
                  </div>
                </div>    
              <div>
                <h3 align="center"> <strong> REFUSAL OF TREATMENT AGAINST MEDICAL ADVICE </strong> </h3>
                <p style="font-size:18px"> It is the policy of {{$company->legal_name}} to give our patients enough information about the purpose, importance, benefits, risks and possible costs associated with proposed tests, referrals or treatments, to enable patients and their families to make informed decisions about their health.</p>
                <p style="font-size:18px">
                However, patients have the right to seek a second opinion or refuse recommended medical advice or treatment. If you choose to refuse the recommended medical advice or treatment of our medical practitioners, we are required to record your decision.</p>
                <br>
                <p style="font-size:18px"> Please consider carefully:</p>
                <p style="font-size:18px">
                <ul>
                    <li style="font-size:18px"> Why do you want to refuse treatment against advice? Discuss this with your medical
                    practitioner. </li>
                    <li style="font-size:18px"> Is there a particular concern that can be addressed that will make you feel more
                    comfortable or come to a compromise with your medical practitioner’s advice?  </li>
                    <li style="font-size:18px"> If you decide to refuse treatment, your medical practitioner will discuss with you
                    any signs of deterioration to look for, what to do and when to return to the practice
                    or seek medical advice. </li>
                    <li style="font-size:18px"> You may also be given prescribed medications, prescriptions and/or a treatment plan. </li>
                  </ul>
                  </p>
               
              </div>
              <div class="line"></div>

              <div>
                <p style="font-size:18px"> <i>*Please complete all parts of this form before you leave the doctor’s office / consulting room. </i></p>  
              
          <p style="font-size:18px"> <strong> Patient name : {{ $admission->name }} </strong> </p>
            <br>
          <p style="font-size:18px"> <strong> Date : {{ $admission->created_on->toDayDateTimeString()  }}</strong> </p>
            <br>
           <p style="font-size:18px"> <strong> Medical Practitioner’s Name : {{ $admission->referal_doctor  }}</strong> </p>
            

            <ul class="bg-primary">      
            <li style="font-size:18px">  I declare that I am refusing the advised treatment of <strong > {{$company->legal_name}} </strong>. </li>
            <li style="font-size:18px">  I understand that the consequences of failing to follow the medical advice given to me might result in significant disability or even death.</li>
            <li style="font-size:18px"> I understand I can change my mind at any time and return for treatment. </li>
            </ul>

            </div>

            <div class="line"></div>


            <p style="font-size:18px"> <strong> Witness : </strong> ....................................................................................................................  </p>
            <p style="font-size:18px"> <strong> Designation of witness : </strong>....................................................................................................................................  </p>
            <p style="font-size:18px"> <strong> Date & Time : </strong> ....................................................................................................................................  </p>

                
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop