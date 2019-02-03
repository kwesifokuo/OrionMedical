@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>
              <p>LENS FINDINGS</p>
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

                 
                </div>
                <div class="col-xs-6 text-right">
                 <p><h4>{{ $patients->fullname }}</h4>
                    {{ $patients->postal_address }}
                  </p>
                  <p>
                    Telephone:  +{{ $patients->mobile_number }}<br>
                    Email:  {{ $patients->email }}
                  </p>
                
                </div>
              </div>       
               <div class="line"></div>
                <h4 class="h3 m-t-xs m-b-xs"> <strong> EXAMINATION RESULTS </strong></h4>
              <div class="line"></div>
              <div>

               <label>Subjective Refraction </label>
                        <div class="table-responsive">
                       <table id="" cellpadding="2" cellspacing="0" border="2" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th></th>
                              <th>Sphere</th>
                              <th>Cylinder</th>
                              <th>Axis</th>
                              <th>Prism</th>
                              <th>Add</th>
                              <th>PD</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                          <tr>
                          <td>OD</td>
                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_sphere" name="od_sphere" value="{{ $admission->od_sphere }}"></td>
                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_cylinder" name="od_cylinder" value="{{ $admission->od_cylinder }}"></td>
                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_axis" name="od_axis" value="{{ $admission->od_axis }}"></td>
                          <td>H: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_h_prism" name="od_h_prism" value="{{ $admission->od_h_prism }}"> <br><br> V: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_v_prism" name="od_v_prism" value="{{ $admission->od_v_prism }}"> </td>

                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_h_add" name="od_h_add" value="{{ $admission->od_h_add }}"> {{-- <br><br> <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_v_add" name="od_v_add"> --}} </td>

                          <td> D: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_h_pd" name="od_h_pd" value="{{ $admission->od_h_pd }}"> N: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="od_v_pd" name="od_v_pd" value="{{ $admission->od_v_pd }}"> </td>
                          <td></td>
                          </tr>

                          <tr>
                           <tr>
                          <td>OS</td>
                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_sphere" name="os_sphere" value="{{ $admission->os_sphere }}"></td>
                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_cylinder" name="os_cylinder" value="{{ $admission->os_cylinder }}"></td>
                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_axis" name="os_axis" value="{{ $admission->os_axis }}"></td>
                          <td>H: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_h_prism" name="os_h_prism" value="{{ $admission->os_h_prism }}"> <br><br> V: <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_v_prism" name="os_v_prism" value="{{ $admission->os_v_prism }}"> </td>

                          <td><input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_h_add" name="os_h_add" value="{{ $admission->os_h_add }}"> {{-- <br><br> <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_v_add" name="os_v_add">  --}}</td>

                          <td>{{-- <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_h_pd" name="os_h_pd"> <br><br> <input type="text" style="width:40px; border: 1px solid #ABADB3; text-align: center;" id="os_v_pd" name="os_v_pd">  --}}</td>
                          <td></td>
                          </tr>
                          </tbody>
                        </table>
                    </div>



                    <div class="row">
                  <div class="col-xs-12">
                  <p style="font-size:12px">
                    <span><strong>Lens Type</strong></span>    
                      <p> {{ $admission->lens_type }}.....................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................ </p> 

                  </p> 
                  </div>
                  </div>

                  <div class="row">
                  <div class="col-xs-12">
                  <p style="font-size:12px">
                    <span><strong>Lens Power</strong></span>    
                      <p> {{ $admission->lens_power }}.....................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................ </p> 

                  </p> 
                  </div>
                  </div>

                    <div class="row">
                  <div class="col-xs-12">
                  <p style="font-size:12px">
                    <span><strong>Lens Treatment</strong></span>    
                      <p> {{ $admission->lens_treatment }}.....................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................ </p> 

                  </p> 
                  </div>
                  </div>

                   <div class="row">
                  <div class="col-xs-12">
                  <p style="font-size:12px">
                    <span><strong>Lens Index</strong></span>    
                      <p> {{ $admission->lens_index }}.....................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................ </p> 

                  </p> 
                  </div>
                  </div>


                  <div class="row">
                  <div class="col-xs-12">
                  <p style="font-size:12px">
                    <span><strong>Remarks</strong></span>    
                      <p> {{ $admission->remarks }}.....................................................................................................................................................................................................................................................................................................................................................<br>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................ </p> 

                  </p> 
                  </div>
                  </div>
                  
                    <br>
                    <br>
                  <p class="pull-right"> ............................................................................. <br> Prescriber's Name : {{ $admission->created_by  }} </p>
                    <p class="pull-left"> Glasses Rx Expires on : {{ $admission->created_on->addYear()  }} </p>
                    

              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
@stop