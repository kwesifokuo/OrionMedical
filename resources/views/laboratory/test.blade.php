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
                       <li><a href="#uploads" data-toggle="tab"> Quick Result Upload </a></li>
                       @role(['Laboratory','System Admin'])
                        <li><a href="#haematology" data-toggle="tab"> Haematology </a></li>
                          <li><a href="#bodyfluid" data-toggle="tab"> Biochemistry </a></li>
                           <li><a href="#drugalcohol" data-toggle="tab"> Liver Function Test </a></li>
                            <li><a href="#hormonal" data-toggle="tab"> Hormonal </a></li>
                             <li><a href="#microscopy" data-toggle="tab"> Microscopy </a></li>
                             <span class="hidden-sm">.</span>
                              
                      @endrole
                              
                      </ul>
                    </header>
                    <section class="scrollable">

                <div class="tab-content">
                    <div class="tab-pane" id="uploads">

                    @role(['Laboratory','System Admin'])
                        <footer>
                          <div class="btn-group pull-right">
                            <p>
                                  <a href="#attach_document" class="bootstrap-modal-form-open badge bg-success" data-toggle="modal"><i class="fa fa-fw fa-upload"></i>Upload Result</a> 
                                  <input type="hidden" name="_token" value="{{ Session::token() }}">
                                    <input type="hidden" name="opd_number" id="opd_number" value="{{ $visitdetails->opd_number }}">
                            </p>
                            </div>
                        </footer>
                        @endrole
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">

                         @foreach($images as $keys => $image)
                   

                   <div class="col-md-3 col-sm-4 thumb-lg">
  
                    @if($image->mime == 'docx')
                   <a href="{!! '/uploads/images/'.$image->filepath !!}" target="_blank">
                              <img src="{!! '/images/ms_word.png' !!}" class="img-circle">
                              </a>  {{ $image->filename }}  <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                    @elseif($image->mime == 'pdf')
                     <a href="{!! '/uploads/images/'.$image->filepath !!}" target="_blank">
                              <img src="{!! '/images/pdf.png' !!}" class="img-circle">
                              </a>{{ $image->filename }} <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a> <span class="label label-default btn-rounded" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ $image->created_on}}">{{ $image->created_on->diffForHumans() }}</span>
                      @else 
                     <a href="{!! '/uploads/images/'.$image->filepath !!}" target="_blank">
                              <img src="{!! '/uploads/images/'.$image->filepath !!}" class="img-circle">
                              </a> {{ $image->filename }}  <a href="#" class="bootstrap-modal-form-open" onclick="deleteImage('{{  $image->id }}','{{ $image->filename }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                    @endif        
                      </div>
                    @endforeach



                         
                    </ul>
                 </div>
               
                    <div class="tab-pane" id="haematology">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div class="table-responsive">
                           <form  method="post" action="/test-save" >
                      <table id="parameterTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Parameter</th>
                            <th>Result</th>
                            <th>Normal Range</th>
                            <th>Interpretation</th>

                          </tr>
                        </thead>
                        <tbody>
                         @foreach( $haematology as $key => $haematology )
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td><input name="test_name[]" id="test_name" value="{{ $haematology->type }}" class="btn btn-rounded btn-sm btn-default"></td>
                            @if($haematology->input == 'textbox')
                            <td><input type="text" id="test_result" name="test_result[]" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
                            @else
                           <td> <select id="test_result" name="test_result[]" value="" rows="3" tabindex="1" data-placeholder="Select here.." style="width:150px; text-align: center;">
                              <option value=""></option>
                              @foreach($resultselector as $result)
                                <option value="{{ $result->type }}">{{ $result->type }}</option>
                              @endforeach
                            </select> </td>
                             @endif   
                              <td><input name="test_range[]" id="test_range" value="{{ $haematology->range }}" class="btn btn-rounded btn-sm btn-default"></td>
                               <td><input name="test_interpretation[]" id="test_impression" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
                               <td><input name="test_impression[]" id="test_impression" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td> 
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

                  


                  <div class="tab-pane" id="bodyfluid">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div class="table-responsive">
                           <form  method="post" action="/test-save" >
                      <table id="parameterTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Parameter</th>
                            <th>Result</th>
                            <th>Normal Range</th>
                            <th>Interpretation</th>
                            <th>Impression</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach( $bodyfluid as $key => $bodyfluid )
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td><input name="test_name[]" id="test_name" value="{{ $bodyfluid->type }}" class="btn btn-rounded btn-sm btn-default"></td>
                            @if($bodyfluid->input == 'textbox')
                            <td><input type="text" id="test_result" name="test_result[]" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
                            @else
                           <td> <select id="test_result" name="test_result[]" value="" rows="3" tabindex="1" data-placeholder="Select here.." style="width:150px; text-align: center;">
                              <option value=""></option>
                              @foreach($resultselector as $result)
                                <option value="{{ $result->type }}">{{ $result->type }}</option>
                              @endforeach
                            </select> </td>
                             @endif   
                              <td><input name="test_range[]" id="test_range" value="{{ $bodyfluid->range }}" class="btn btn-rounded btn-sm btn-default"></td>
                              <td><input name="test_interpretation[]" id="test_impression" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
                              <td><input name="test_impression[]" id="test_impression" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
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
                                     <input type="hidden" name="template" id="template" value="BIOCHEMISTRY">
                                  <a href="#" class="btn btn-rounded btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i> Cancel</a>
                                  <a href="/laboratory-biochemistry/{{ $visitdetails->opd_number }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Print </a>
                            </p>
                            </div>
                        </footer>
                      </table>
                      </form>
                    </div>
                    </ul>
                 </div>




                  <div class="tab-pane" id="drugalcohol">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div class="table-responsive">
                           <form  method="post" action="/test-save" >
                      <table id="parameterTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Parameter</th>
                            <th>Result</th>
                            <th>Normal Range</th>
                            <th>Interpretation</th>
                            <th>Impression</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach($drugalchohol as $key => $drugalchohol)
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td><input name="test_name[]" id="test_name" value="{{ $drugalchohol->type }}" class="btn btn-rounded btn-sm btn-default"></td>
                            @if($drugalchohol->input == 'textbox')
                            <td><input type="text" id="test_result" name="test_result[]" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
                            @else
                           <td> <select id="test_result" name="test_result[]" value="" rows="3" tabindex="1" data-placeholder="Select here.." style="width:150px; text-align: center;">
                              <option value=""></option>
                              @foreach($resultselector as $result)
                                <option value="{{ $result->type }}">{{ $result->type }}</option>
                              @endforeach
                            </select> </td>
                             @endif   
                              <td><input name="test_range[]" id="test_range" value="{{ $drugalchohol->range }}" class="btn btn-rounded btn-sm btn-default"></td>
                              <td><input name="test_interpretation[]" id="test_impression" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
                              <td><input name="test_impression[]" id="test_impression" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
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
                                  <a href="#" class="btn btn-rounded btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i> Cancel</a>
                                  <a href="#" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Print </a>
                            </p>
                            </div>
                        </footer>
                      </table>
                      </form>
                    </div>
                    </ul>
                 </div>




                    <div class="tab-pane" id="hormonal">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div class="table-responsive">
                           <form  method="post" action="/test-save" >
                      <table id="parameterTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Parameter</th>
                            <th>Result</th>
                            <th>Normal Range</th>
                            <th>Interpretation</th>
                            <th>Impression</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach($hormonal as $key => $hormonal)
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td><input name="test_name[]" id="test_name" value="{{ $hormonal->type }}" class="btn btn-rounded btn-sm btn-default"></td>
                            @if($hormonal->input == 'textbox')
                            <td><input type="text" id="test_result" name="test_result[]" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
                            @else
                           <td> <select id="test_result" name="test_result[]" value="" rows="3" tabindex="1" data-placeholder="Select here.." style="width:150px; text-align: center;">
                              <option value=""></option>
                              @foreach($resultselector as $result)
                                <option value="{{ $result->type }}">{{ $result->type }}</option>
                              @endforeach
                            </select> </td>
                             @endif   
                              <td><input name="test_range[]" id="test_range" value="{{ $hormonal->range }}" class="btn btn-rounded btn-sm btn-default"></td>
                              <td><input name="test_interpretation[]" id="test_impression" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
                              <td><input name="test_impression[]" id="test_impression" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
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
                                  <a href="#" class="btn btn-rounded btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i> Cancel</a>
                                  <a href="#" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Print </a>
                            </p>
                            </div>
                        </footer>
                      </table>
                      </form>
                    </div>
                    </ul>
                 </div>






                 <div class="tab-pane" id="microscopy">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div class="table-responsive">
                           <form  method="post" action="/test-save" >
                      <table id="parameterTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Parameter</th>
                            <th>Result</th>
                            <th>Normal Range</th>
                            <th>Interpretation</th>
                            <th>Impression</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach($microscopy as $key => $microscopy)
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td><input name="test_name[]" id="test_name" value="{{ $microscopy->type }}" class="btn btn-rounded btn-sm btn-default"></td>
                            @if($microscopy->input == 'textbox')
                            <td><input type="text" id="test_result" name="test_result[]" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
                            @else
                           <td> <select id="test_result" name="test_result[]" value="" rows="3" tabindex="1" data-placeholder="Select here.." style="width:150px; text-align: center;">
                              <option value=""></option>
                              @foreach($resultselector as $result)
                                <option value="{{ $result->type }}">{{ $result->type }}</option>
                              @endforeach
                            </select> </td>
                             @endif   
                              <td><input name="test_range[]" id="test_range" value="{{ $microscopy->range }}" class="btn btn-rounded btn-sm btn-default"></td>
                              <td><input name="test_interpretation[]" id="test_impression" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
                              <td><input name="test_impression[]" id="test_impression" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
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
                                  <a href="#" class="btn btn-rounded btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i> Cancel</a>
                                  <a href="#" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Print </a>
                            </p>
                            </div>
                        </footer>
                      </table>
                      </form>
                    </div>
                    </ul>
                 </div>




                   <div class="tab-pane" id="microbiology">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div class="table-responsive">
                           <form  method="post" action="/test-save" >
                      <table id="parameterTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Parameter</th>
                            <th>Result</th>
                            <th>Normal Range</th>
                            <th>Interpretation</th>
                            <th>Impression</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach($microbiology as $key => $microbiology)
                          <tr>
                            <td>{{ ++$key }}</td>
                            <td><input name="test_name[]" id="test_name" value="{{ $microbiology->type }}" class="btn btn-rounded btn-sm btn-default"></td>
                            @if($microbiology->input == 'textbox')
                            <td><input type="text" id="test_result" name="test_result[]" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
                            @else
                           <td> <select id="test_result" name="test_result[]" value="" rows="3" tabindex="1" data-placeholder="Select here.." style="width:150px; text-align: center;">
                              <option value=""></option>
                              @foreach($resultselector as $result)
                                <option value="{{ $result->type }}">{{ $result->type }}</option>
                              @endforeach
                            </select> </td>
                             @endif   
                              <td><input name="test_range[]" id="test_range" value="{{ $microbiology->range }}" class="btn btn-rounded btn-sm btn-default"></td>
                              <td><input name="test_interpretation[]" id="test_impression" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
                              <td><input name="test_impression[]" id="test_impression" value="" style="width:150px; border: 1px solid #ABADB3; text-align: center;"></td>
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
                                  <a href="#" class="btn btn-rounded btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i> Cancel</a>
                                  <a href="#" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Print </a>
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
        <aside class="col-lg-3 b-l">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                       
                         <section class="panel clearfix bg-default lter">
                          <div class="panel-body">
                          
                            <div class="clear">
                           <p>
                       <a href="#" class="btn btn-warning btn-s-md btn-lg pull-right"> Bill : GHS {{ $payables }}</a>
                      </p>
                      <p>
                       <a href="#" class="btn btn-success btn-s-md btn-lg pull-right"> Paid : GHS {{ $receivables }}</a>
                      </p>
                      <p>
                       <a href="#" class="btn btn-danger btn-s-md btn-lg pull-right"> Outstanding. : GHS {{ $outstanding }}</a>
                      </p>
                            </div>
                          </div>
                        </section>

                         <section class="panel clearfix bg-default lter">
                          <div class="panel-body">
                          
                            <div class="clear">
 <p class="h4 text-dark"><strong>Investigations to perform : <br> <br> @foreach($tests as $val)  <label class="badge bg-dark"> {{ $val->investigation }} </label> <a href="#" class="bootstrap-modal-form-open" onclick="removeinvestigation('{{  $val->id }}','{{ $val->investigation }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>  @endforeach </strong></p>
                            </div>
                          </div>
                        </section>

                      
                      </div>
                    </section>
                    </section>
                    </aside>

  </section>
  </section>
</section>
  @stop

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {

     $('#test_name').select2();
     loadTestResults();
    

  });
</script>


  <script type="text/javascript">
  function deleteresult(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+name+" from the result list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/delete-lab-result',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was removed from result list.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from result list.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to be removed from prescription.", "error");   
        } });

    
   }


   function removeinvestigation(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+name+" from the result list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/delete-investigation',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
             swal("Deleted!", name +" was removed from result list.", "success"); 
              location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');
            } 
        else {     
          swal("Cancelled", name +" failed to be removed from prescription.", "error");   
        } });       
    
   }
   

  
   function loadTestResults()
   {
  
        $.get('/load-test-results',
          {
            "opd_number": $('#opd_number').val()
          },
          function(data)
          { 

            $('#testResult tbody').empty();
            $.each(data, function (key, value) 
            {           
            $('#testResult tbody').append('<tr><td>'+ value['test'] +'</td><td>'+ value['result'] +'</td><td>'+ value['range'] +'</td><td><a a href="#"><i onclick="deleteresult(\''+value['id']+'\',\''+value['test']+'\')" class="fa fa-trash-o"></i></a></td></tr>');
            });
                                          
         },'json');     


   }



    function saveresult()
    {

        alert($('#test_name').val());
          $.get('/save-test-results',
          {
            "labid": $('#opd_number').val(),
             "test_name": $('#test_name').val() ,
             "test_result": $('#test_result').val(),
             "comment": $('#comment').val()
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
             alert("success");
            }
            else
            { 
              alert("fail");
            }
           
        });
                                          
          },'json');    
           
    }





  </script>

      <script type="text/javascript">

 function deleteImage(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+name+" from the file list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/delete-image-request',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was removed from file list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from list.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to be removed from list.", "error");   
        } });

    
   }



      </script>


      
     <div class="modal fade" id="attach_document" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Attach Document</h4>
        </div>

        <div class="modal-body">
         <div class="fallback">
          <form method="post"  enctype="multipart/form-data" action="/uploadfiles">
          <input type="text" class="form-control" width="1000px" height="40px" name="filename" id="filename" placeholder="Enter file name" /><br>
          <input type="file" class="form-control dropbox" width="500px" height="40px" name="image" /><br>
          <input type="submit" name="submit"  class="btn btn-success btn-s-xs" value="upload" />
          <input type="hidden" name="_token" value="{{ Session::token() }}">
          <input type="hidden" name="selectedid" id="selectedid" value="{{ $visitdetails->patient_id }}">
           <input type="hidden" name="labid" id="labid" value="{{ $tests[0]->id }}">
          <input type="hidden" name="file_source" id="file_source" value="Laboratory">
          <input type="text" name="visitid" id="visitid" value="{{ $visitdetails->opd_number }}">
        </form>
        </div>
          <br>
          <br>
          <br>
              <div class="jumbotron how-to-create">
                <ul>
                    <li>Documents/Images are uploaded as soon as you drop them</li>
                    <li>Maximum allowed size of image is 8MB</li>
                </ul>

            </div>

      </div>
      </div>
      </div>
      </div>



