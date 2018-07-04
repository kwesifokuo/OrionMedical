@extends('layouts.default')
@section('content')

        <section id="content">
          <section class="hbox stretch">
              <section class="panel panel-default">
                    <header class="panel-heading text-right bg-light">
                      <ul class="nav nav-tabs pull-left">
      <li class="active"><a href="#store" data-toggle="tab"><i class="fa  fa-flash text-default"></i> Store Details </a></li>
      <li><a href="#medicine-type" data-toggle="tab"><i class="fa  fa-inbox text-default"></i> Medicine Types </a></li>
      <li><a href="#generic" data-toggle="tab"><i class="fa fa-money text-default"></i> Generics </a></li>
      <li><a href="#schedule" data-toggle="tab"><i class="fa fa-tasks text-default"></i> Schedules </a></li>
      <li><a href="#manufacturer" data-toggle="tab"><i class="fa fa-sitemap text-default"></i> Tax Categories </a></li>
      <li><a href="#manufacturer" data-toggle="tab"><i class="fa fa-suitcase text-default"></i> Manufacturers </a></li>
      <li><a href="#supplier" data-toggle="tab"><i class="fa fa-shopping-cart text-default"></i> Suppliers </a></li>
      <li><a href="#beneficiary-2" data-toggle="tab"><i class="fa fa-users text-default"></i>  Medicines </a></li>
       <li><a href="#beneficiary-2" data-toggle="tab"><i class="fa fa-users text-default"></i>  Print Settings </a></li>
                      </ul>
                      <span class="hidden-sm">.</span>
                    </header>
                    <div class="panel-body">
                      <div class="tab-content">              
                       


                       <div class="tab-pane fade" id="store">
                              <div class="col-sm-12">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Store Details</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-vehicle-model">
                                    <div class="form-group">
                                      <label>Store Name</label>
                                      <input type="text" id="vehicle_make" name="vehicle_make" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label>Owner Name</label>
                                      <input id="vehicle_model" name="vehicle_model" type="text" class="form-control" placeholder="">
                                    </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Phone</label> 
                            <div class="form-group{{ $errors->has('drug_number') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="drug_number" name="drug_number" value="{{ Request::old('drug_number') ?: '' }}">   
                           @if ($errors->has('drug_number'))
                          <span class="help-block">{{ $errors->first('drug_number') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('drug_name') ? ' has-error' : ''}}">
                            <label>Address</label>
                            <input type="text" rows="3" data-required="true" class="form-control" id="drug_name" name="drug_name" value="{{ Request::old('drug_name') ?: '' }}">      
                           @if ($errors->has('drug_name'))
                          <span class="help-block">{{ $errors->first('drug_name') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Tax No</label> 
                            <div class="form-group{{ $errors->has('drug_number') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="drug_number" name="drug_number" value="{{ Request::old('drug_number') ?: '' }}">   
                           @if ($errors->has('drug_number'))
                          <span class="help-block">{{ $errors->first('drug_number') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('drug_name') ? ' has-error' : ''}}">
                            <label>DL No</label>
                            <input type="text" rows="3" data-required="true" class="form-control" id="drug_name" name="drug_name" value="{{ Request::old('drug_name') ?: '' }}">      
                           @if ($errors->has('drug_name'))
                          <span class="help-block">{{ $errors->first('drug_name') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                                   
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>

                             <section class="panel panel-default">
                  <header class="panel-heading font-bold">Stores
                                 <a href="#new-service" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-info pull-right">+</span></a>
                                </header>
                    <div class="table-responsive">
                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Owner</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Tax #</th>
                            <th width="30"></th>
                          </tr>
                        </thead>
                         <tbody>
                       {{--  @foreach( $items as $key => $item )
                          <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->contactperson }}</td>
                             <td>{{ $item->created_on }}</td>
                             <td><a href="#" class="bootstrap-modal-form-open" onclick="deleteDetails('{{ $item->id }}','{{ $item->name }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                             </td>
                            
                          </tr>
                         @endforeach  --}}
                        </tbody>
 
                      </table>
                    </div>
                  </section>
                  </div>
              </div>






                          <div class="tab-pane fade" id="supplier">
                              <div class="col-sm-12">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Medicine Suppliers</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-vehicle-model">
                                    <div class="form-group">
                                      <label>Supplier Name</label>
                                      <input type="text" id="vehicle_make" name="vehicle_make" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label>Contact Person</label>
                                      <input id="vehicle_model" name="vehicle_model" type="text" class="form-control" placeholder="">
                                    </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Mobile Phone</label> 
                            <div class="form-group{{ $errors->has('drug_number') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="drug_number" name="drug_number" value="{{ Request::old('drug_number') ?: '' }}">   
                           @if ($errors->has('drug_number'))
                          <span class="help-block">{{ $errors->first('drug_number') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('drug_name') ? ' has-error' : ''}}">
                            <label>Office Number</label>
                            <input type="text" rows="3" data-required="true" class="form-control" id="drug_name" name="drug_name" value="{{ Request::old('drug_name') ?: '' }}">      
                           @if ($errors->has('drug_name'))
                          <span class="help-block">{{ $errors->first('drug_name') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Email</label> 
                            <div class="form-group{{ $errors->has('drug_number') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="drug_number" name="drug_number" value="{{ Request::old('drug_number') ?: '' }}">   
                           @if ($errors->has('drug_number'))
                          <span class="help-block">{{ $errors->first('drug_number') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('drug_name') ? ' has-error' : ''}}">
                            <label>Address</label>
                            <input type="text" rows="3" data-required="true" class="form-control" id="drug_name" name="drug_name" value="{{ Request::old('drug_name') ?: '' }}">      
                           @if ($errors->has('drug_name'))
                          <span class="help-block">{{ $errors->first('drug_name') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                            <label>Tax No</label> 
                            <div class="form-group{{ $errors->has('drug_number') ? ' has-error' : ''}}">
                            <input type="text" rows="3" class="form-control" id="drug_number" name="drug_number" value="{{ Request::old('drug_number') ?: '' }}">   
                           @if ($errors->has('drug_number'))
                          <span class="help-block">{{ $errors->first('drug_number') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('drug_name') ? ' has-error' : ''}}">
                            <label>DL No</label>
                            <input type="text" rows="3" data-required="true" class="form-control" id="drug_name" name="drug_name" value="{{ Request::old('drug_name') ?: '' }}">      
                           @if ($errors->has('drug_name'))
                          <span class="help-block">{{ $errors->first('drug_name') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                                   
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>

                             <section class="panel panel-default">
                  <header class="panel-heading font-bold">Stores
                                 <a href="#new-service" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-info pull-right">+</span></a>
                                </header>
                    <div class="table-responsive">
                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Owner</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Tax #</th>
                            <th width="30"></th>
                          </tr>
                        </thead>
                         <tbody>
                       {{--  @foreach( $items as $key => $item )
                          <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->contactperson }}</td>
                             <td>{{ $item->created_on }}</td>
                             <td><a href="#" class="bootstrap-modal-form-open" onclick="deleteDetails('{{ $item->id }}','{{ $item->name }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                             </td>
                            
                          </tr>
                         @endforeach  --}}
                        </tbody>
 
                      </table>
                    </div>
                  </section>
                  </div>
              </div>




                      <div class="tab-pane fade" id="medicine-type">
                              <div class="col-sm-12">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Medicine Types</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-vehicle-model">
                                    <div class="form-group">
                                      <label>Medicine Type</label>
                                      <input type="text" id="vehicle_make" name="vehicle_make" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label>Description</label>
                                      <input id="vehicle_model" name="vehicle_model" type="text" class="form-control" placeholder="">
                                    </div>
                                   
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>

                             <section class="panel panel-default">
                  <header class="panel-heading font-bold">Medicine Types
                                 <a href="#new-service" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-info pull-right">+</span></a>
                                </header>
                    <div class="table-responsive">
                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>Serial #</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Option</th>
                            <th width="30"></th>
                          </tr>
                        </thead>
                         <tbody>
                       {{--  @foreach( $items as $key => $item )
                          <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->contactperson }}</td>
                             <td>{{ $item->created_on }}</td>
                             <td><a href="#" class="bootstrap-modal-form-open" onclick="deleteDetails('{{ $item->id }}','{{ $item->name }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                             </td>
                            
                          </tr>
                         @endforeach  --}}
                        </tbody>
 
                      </table>
                    </div>
                  </section>
                  </div>
              </div>




                      <div class="tab-pane fade" id="manufacturer">
                              <div class="col-sm-12">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Medicine Manufacturers</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-vehicle-model">
                                    <div class="form-group">
                                      <label>Manufacturer</label>
                                      <input type="text" id="vehicle_make" name="vehicle_make" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label>Description</label>
                                      <input id="vehicle_model" name="vehicle_model" type="text" class="form-control" placeholder="">
                                    </div>
                                   
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>

                             <section class="panel panel-default">
                  <header class="panel-heading font-bold">Manufacturers
                                 <a href="#new-service" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-info pull-right">+</span></a>
                                </header>
                    <div class="table-responsive">
                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>Serial #</th>
                            <th>Manufacturer</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Option</th>
                            <th width="30"></th>
                          </tr>
                        </thead>
                         <tbody>
                       {{--  @foreach( $items as $key => $item )
                          <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->contactperson }}</td>
                             <td>{{ $item->created_on }}</td>
                             <td><a href="#" class="bootstrap-modal-form-open" onclick="deleteDetails('{{ $item->id }}','{{ $item->name }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                             </td>
                            
                          </tr>
                         @endforeach  --}}
                        </tbody>
 
                      </table>
                    </div>
                  </section>
                  </div>
              </div>



                <div class="tab-pane fade" id="schedule">
                              <div class="col-sm-12">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Schedules</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-vehicle-model">
                                    <div class="form-group">
                                      <label>Schedule</label>
                                      <input type="text" id="vehicle_make" name="vehicle_make" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label>Description</label>
                                      <input id="vehicle_model" name="vehicle_model" type="text" class="form-control" placeholder="">
                                    </div>
                                   
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>

                             <section class="panel panel-default">
                  <header class="panel-heading font-bold">Schedule
                                 <a href="#new-service" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-info pull-right">+</span></a>
                                </header>
                    <div class="table-responsive">
                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>Serial #</th>
                            <th>Schedule</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Option</th>
                            <th width="30"></th>
                          </tr>
                        </thead>
                         <tbody>
                       {{--  @foreach( $items as $key => $item )
                          <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->contactperson }}</td>
                             <td>{{ $item->created_on }}</td>
                             <td><a href="#" class="bootstrap-modal-form-open" onclick="deleteDetails('{{ $item->id }}','{{ $item->name }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                             </td>
                            
                          </tr>
                         @endforeach  --}}
                        </tbody>
 
                      </table>
                    </div>
                  </section>
                  </div>
              </div>



               <div class="tab-pane fade" id="generic">
                              <div class="col-sm-12">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Generics</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-vehicle-model">
                                    <div class="form-group">
                                      <label>Generic Name</label>
                                      <input type="text" id="vehicle_make" name="vehicle_make" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label>Description</label>
                                      <input id="vehicle_model" name="vehicle_model" type="text" class="form-control" placeholder="">
                                    </div>
                                   
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>

                             <section class="panel panel-default">
                  <header class="panel-heading font-bold">Generics
                                 <a href="#new-service" class="bootstrap-modal-form-open" data-toggle="modal"><span class="badge bg-info pull-right">+</span></a>
                                </header>
                    <div class="table-responsive">
                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>Serial #</th>
                            <th>Generic</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Option</th>
                            <th width="30"></th>
                          </tr>
                        </thead>
                         <tbody>
                       {{--  @foreach( $items as $key => $item )
                          <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->contactperson }}</td>
                             <td>{{ $item->created_on }}</td>
                             <td><a href="#" class="bootstrap-modal-form-open" onclick="deleteDetails('{{ $item->id }}','{{ $item->name }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                             </td>
                            
                          </tr>
                         @endforeach  --}}
                        </tbody>
 
                      </table>
                    </div>
                  </section>
                  </div>
              </div>






                        <div class="tab-pane fade" id="Currency-2">
                            <div class="col-sm-6">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new currency</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-currency">
                                    <div class="form-group">
                                      <label>Enter currency</label>
                                      <input type="text" id="currency" name="currency" class="form-control" placeholder="">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Property-2">
                          <div class="col-sm-6">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new property</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-property">
                                    <div class="form-group">
                                      <label>Add property type</label>
                                      <input type="text" id="propertytype" name="propertytype" class="form-control" placeholder="">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Mortgage-2">
                          <div class="col-sm-6">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new mortgage company</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-mortgage">
                                    <div class="form-group">
                                      <label>Add mortgage company</label>
                                      <input type="text" id="mortgage_compaany" name="mortgage_compaany" class="form-control" placeholder="">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Insurer-2">
                               <div class="col-sm-6">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new insurer</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-insurer">
                                    <div class="form-group">
                                      <label>Add isurer name</label>
                                      <input type="text" id="insurer" name="insurer" class="form-control" placeholder="">
                                    </div>
                                     <div class="form-group">
                                      <label>Group (General , Life , Health)</label>
                                      <input type="text" id="insurer_type" name="insurer_type" class="form-control" placeholder="">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Policy-2">
                           <div class="col-sm-6">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new policy product</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-policy-product">
                                    <div class="form-group">
                                      <label>Add policy name</label>
                                      <input type="text" id="policytype" name="policytype" class="form-control" placeholder="">
                                    </div>
                                     <div class="form-group">
                                      <label>Group (General , Life , Health)</label>
                                      <input type="text" id="policygroup" name="policygroup" class="form-control" placeholder="">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
                            </div>
                        </div>
                         <div class="tab-pane fade" id="beneficiary-2">
                           <div class="col-sm-6">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new beneficiary</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-beneficiary">
                                    <div class="form-group">
                                      <label>Add beneficiary type</label>
                                      <input type="text" id="beneficiary_type" name="beneficiary_type" class="form-control" placeholder="">
                                    </div>
                                    
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
                            </div>
                        </div>
                      </div>
                    </div>
                  </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop


 



