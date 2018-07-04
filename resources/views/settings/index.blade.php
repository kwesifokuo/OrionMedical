@extends('layouts.default')
@section('content')

        <section id="content">
          <section class="hbox stretch">
              <section class="panel panel-default">
                    <header class="panel-heading text-right bg-light">
                      <ul class="nav nav-tabs pull-left">
      <li class="active"><a href="#Model-1" data-toggle="tab"><i class="fa  fa-flash text-default"></i> Health Insurance</a></li>
      <li><a href="#Make-2" data-toggle="tab"><i class="fa  fa-inbox text-default"></i> Company </a></li>
      <li><a href="#Currency-2" data-toggle="tab"><i class="fa fa-money text-default"></i> Visit Types </a></li>
      <li><a href="#Mortgage-2" data-toggle="tab"><i class="fa fa-sitemap text-default"></i> Service Charge </a></li>
      <li><a href="#Insurer-2" data-toggle="tab"><i class="fa fa-suitcase text-default"></i> Procedures </a></li>
      <li><a href="#Policy-2" data-toggle="tab"><i class="fa fa-shopping-cart text-default"></i> Radiology </a></li>
      <li><a href="#beneficiary-2" data-toggle="tab"><i class="fa fa-users text-default"></i> Complaint </a></li>
      <li><a href="#beneficiary-2" data-toggle="tab"><i class="fa fa-users text-default"></i> History </a></li>
                      </ul>
                      <span class="hidden-sm">Left tab</span>
                    </header>
                    <div class="panel-body">
                      <div class="tab-content">              
                        <div class="tab-pane fade" id="Model-1">
                          <div class="col-sm-12">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add New Health Insurance</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-vehicle-model">
                                    <div class="form-group">
                                      <label>Name</label>
                                      <input type="text" id="vehicle_make" name="vehicle_make" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label>Address & Contact Details</label>
                                      <textarea id="vehicle_model" rows="5" name="vehicle_model" type="text" class="form-control" placeholder=""></textarea>
                                    </div>
                                   
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>

                              <section class="panel panel-info">
                                <header class="panel-heading font-bold">List of Health Insurers</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="complaintTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Name</th>
                              <th>Address</th>
                              <th>Date</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                    </div>
                    </div>

                      </section>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="Make-2">
                              <div class="col-sm-12">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add New Corporate Client</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-vehicle-model">
                                    <div class="form-group">
                                      <label>Name</label>
                                      <input type="text" id="vehicle_make" name="vehicle_make" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                      <label>Address & Contact Details</label>
                                      <textarea id="vehicle_model" rows="5" name="vehicle_model" type="text" class="form-control" placeholder=""></textarea>
                                    </div>
                                   
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>

                               <section class="panel panel-info">
                                <header class="panel-heading font-bold">List of Corporate Clients</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="complaintTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Name</th>
                              <th>Address</th>
                              <th>Date</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                    </div>
                    </div>

                      </section>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="Currency-2">
                            <div class="col-sm-12x">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add Visit Type</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-currency">
                                    <div class="form-group">
                                      <label>Visit Type</label>
                                      <input type="text" id="currency" name="currency" class="form-control" placeholder="">
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
                            </div>
                             <section class="panel panel-info">
                                <header class="panel-heading font-bold">List of Visit Types</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="complaintTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Name</th>
                              <th>Address</th>
                              <th>Date</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                    </div>
                    </div>

                      </section>
                        </div>

                        <div class="tab-pane fade" id="Mortgage-2">
                          <div class="col-sm-12">
                              <section class="panel panel-default">
                                <header class="panel-heading font-bold">Add new service charge</header>
                                <div class="panel-body">
                                  <form role="form" method="post" data-validate="parsley" action="/add-service">
                                    <div class="form-group">
                                      <label>Service Name</label>
                                      <input type="text" id="service" name="service" class="form-control" placeholder="">
                                    </div>

                                     <div class="form-group">
                                      <label>Description</label>
                                      <input type="text" id="description" name="description" class="form-control" placeholder="">
                                    </div>

                                     <div class="form-group">
                                      <label>Charge</label>
                                      <input type="text" id="mortgage_compaany" name="mortgage_compaany" class="form-control" placeholder="">
                                    </div>


                                     <div class="form-group">
                                      <label>Department</label>
                                      <input type="text" id="mortgage_compaany" name="mortgage_compaany" class="form-control" placeholder="">
                                    </div>




                                    <button type="submit" class="btn btn-sm btn-default">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>

                               <section class="panel panel-info">
                                <header class="panel-heading font-bold">List of Service Charges</header>
                                <div class="panel-body">
                                      <div class="table-responsive">
                       <table id="complaintTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Charge</th>
                              <th>Service Category</th>
                              <th>Date Added</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                             @foreach( $services as $service )
                          <tr>
                       
                           
                            <td>{{ $service->serial }}</td>
                            <td>{{ $service->type }}</td>
                            <td>{{ $service->charge }}</td>
                            <td>{{ $service->department }}</td>
                             <td>{{ $service->created_on }}</td>
                            <td></td>

                          </tr>
                         @endforeach
                          </tbody>
                        </table>
                         {!!$services->render()!!}
                    </div>
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
                        
                      </div>
                    </div>
                  </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop


 



