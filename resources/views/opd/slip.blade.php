

@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
           <header class="header b-b b-light hidden-print">
                <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
                <p>Examination Slip</p>
              </header>
             <section class="scrollable wrapper">
            <div >
  
    <div >
      <span style="font-size:18px">{{ $patient->consultation_type }}</span>
      <br>
       <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($patient->opd_number, 'QRCODE')}}" alt="barcode" /> 
       <br>
      <span style="font-size:18px">#{{ $patient->opd_number }}</span>
      <br>
     <div >
        <span style="font-size:18px">{{ $patient->name }}</span>
        <br>
        <span style="font-size:18px">{{ $patient->created_on->format('H:i:s A') }}</span>
        <br>
        <input type="checkbox" name="vehicle" value="Bike" style="font-size:18px"> <label style="font-size:18px"> Triage </label> <br>
        <input type="checkbox" name="vehicle" value="Car" style="font-size:18px"><label style="font-size:18px"> Consulting Room Visit </label> <br>
        <input type="checkbox" name="vehicle" value="Bike" style="font-size:18px"><label style="font-size:18px"> Lab </label> <br>
        <input type="checkbox" name="vehicle" value="Car" style="font-size:18px"><label style="font-size:18px"> ECG </label> <br>
        <input type="checkbox" name="vehicle" value="Bike" style="font-size:18px"> <label style="font-size:18px">Oral Examination </label> <br>
        <input type="checkbox" name="vehicle" value="Car" style="font-size:18px"> <label style="font-size:18px"> Chest Xray </label> <br>
        <input type="checkbox" name="vehicle" value="Car" style="font-size:18px"> <label style="font-size:18px"> Eye Test </label> <br>

      </div> 
    </div>
  </div>

               
            
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop