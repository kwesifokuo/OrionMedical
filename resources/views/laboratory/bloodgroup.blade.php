@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
<p><span class="label label-success">{{ $visitdetails->name}}</span></p> 
<p class="block"><a href="#" class=""></a> <span class="label label-warning btn-rounded">{{ $visitdetails->visit_type }}</span></p>
 <p class="block"><a href="#" class=""></a> <span class="label label-success btn-rounded">{{ $visitdetails->opd_number }}</span></p>
 <p class="block"><a href="#" class=""></a> <span class="label label-danger btn-rounded">Created : {{ Carbon\Carbon::parse($visitdetails->created_on)->diffForHumans() }}</span></p>

  <div class="btn-group pull-right">
                    <p>
        <a href="#" class="btn btn-rounded btn-sm btn-info"><i class="fa fa-fw fa-user"></i> {{ $visitdetails->payercode }}</a>
        <a href="#" class="btn btn-rounded btn-sm btn-primary"><i class="fa fa-fw fa-home"></i> {{ $visitdetails->care_provider }} </a>
                    </p>
              </div>

            </header>

            <section class="scrollable">
              <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="clearfix m-b">
                          <a href="/images/{{ $patients->image }}" class="pull-left thumb m-r">
                            <img src="/images/{{ $patients->image }}" class="img-circle">
                          </a>
                          <div class="clear">
                            <div class="h3 m-t-xs m-b-xs">{{ $tests[0]->patient_name }}</div>
                            <br>
                            <div>
                          
                           <p class="block"><a href="#" class="">ID # </a> <span class="label label-default btn-rounded">{{ $patients->patient_id }}</span></p>
                            </div>
                          </div>                
                        </div>
                        <div class="panel wrapper panel-success">
                          <div class="row">
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $patients->gender }}</span>
                                <small class="text-muted">Gender</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h4 block">{{ $patients->date_of_birth->age }}</span>
                                <small class="text-muted">Age</small>
                              </a>
                            </div>
                            <div class="col-xs-4">
                              <a href="#">
                                <span class="m-b-xs h5 block">{{ $patients->civil_status }}</span>
                                <small class="text-muted">Status</small>
                              </a>
                            </div>
                          </div>
                        </div>
                       
                        <div>
                         <ul class="list-group no-radius">
                          <li class="list-group-item">
                            <span class="pull-right">{{ str_limit($patients->occupation,12) }}</span>
                             <input type="hidden" id="accounttype" name="accounttype" value="{{ $visitdetails->payercode }}">
                             <small class="text-muted">Occupation</small>
                          </li>
                            <li class="list-group-item">
                            <span class="pull-right">{{ str_limit($patients->nationality,12) }}</span>
                            
                             <small class="text-muted">Nationality</small>
                          </li>
                            <li class="list-group-item">
                            <span class="pull-right">{{ $patients->blood_group }}</span>
                            
                             <small class="text-muted " >Blood Group</small>
                          </li>
                        </ul>
                          </div> 
                        
                        </div>

                    </section>
                  </section>
                </aside>


                <aside class="bg-white">

                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                     
                       @role(['Laboratory','System Admin'])
                        <li><a href="#haematology" data-toggle="tab"> Haematology </a></li>
                          
                              
                      @endrole
                              
                      </ul>
                    </header>
                    <section class="scrollable">

                <div class="tab-content">

               
                    <div class="tab-pane active" id="haematology">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div class="table-responsive">
                           <form  method="post" action="/test-save" >
                      <table id="parameterTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>Parameter</th>
                            <th>Result</th>
                            
                           
                          </tr>
                        </thead>
                        <tbody>
                         @foreach( $fbc as $key => $fbc )
                           <tr>
                          <td>{{ $fbc->type }}
                            <input type="hidden" name="test_name[]" id="test_name" value="{{ $fbc->type }}" >
                          </td>
                         
                         
                
                           <td> <select id="test_result" name="test_result[]" value="" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                              <option value=""></option>
                              @foreach($resultselector as $result)
                                <option value="{{ $result->type }}">{{ $result->type }}</option>
                              @endforeach
                            </select>
                          <td>
                         <input type="hidden" class="form-control" readonly="true" name="test_range[]" id="test_range" value="{{ $fbc->range }}"> 
                          </td>
                        <td>
                         <input type="hidden" class="form-control" name="test_interpretation[]" id="test_interpretation" > 
                          <input type="hidden" class="form-control" name="test_impression[]" id="test_impression" > 
                          </td>
                          </tr>
                         @endforeach

                        </tbody>
                        <br>
                        <footer>
                          <div class="btn-group pull-right">
                            <p>
                                  <button type="submit" class="btn btn-rounded btn-sm btn-info"><i class="fa fa-fw fa-download"></i>Save</button> 
                                  <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    <input type="hidden" name="opd_number" id="opd_number" value="{{ $visitdetails->opd_number }}">
                                    <input type="hidden" name="template" id="template" value="FBC">
                                  <a href="#" class="btn btn-rounded btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i> Cancel</a>
                                  <a href="/laboratory-results/{{ $visitdetails->opd_number }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Print </a>
                            </p>
                            </div>
                        </footer>
                      </table>
                      </form>
                    </div>
                    </ul>
                 </div>

                  
                </div>
            </section>
          </section>        
      </aside>


  </section>
  </section>
</section>
  @stop
