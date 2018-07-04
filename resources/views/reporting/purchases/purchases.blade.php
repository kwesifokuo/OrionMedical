@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Purchases Reports</div>
              <ul class="nav">
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Suppliers</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Invoices</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Unpaid Invoices</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Purchases</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Purchases Details</a></li>
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                     @include('includes.alert')
                      <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                      <a href="/patient.manage" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-reply-all"></i> Back to Main</a>
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print List</a>
                     <span class="badge badge-info">Record(s) Found :  </span>
                    </div>

                  <form action="/patient.find" method="GET">
                    <div class="col-sm-4 m-b-xs">
                      <div class="input-group">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search for a patient">
                        <span class="input-group-btn">
                          <button class="btn btn-sm btn-default" type="submit">Go!</button>
                        </span>
                      </div>
                    </div>
                     </form>
                    </div>
                  </div>
                </header>
                <section class="scrollable wrapper w-f">
                  <section class="panel panel-default">
                  {{--   <div class="table-responsive">
                      <table class="table table-striped m-b-none">
                        <thead>
                          <tr>
                            <th width="20"><input type="checkbox"></th>
                            <th width="20"></th>
                            <th class="th-sortable" data-toggle="class">Patient #
                            </th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Civil Status</th>
                            <th>Age</th>
                            <th>Date Entry</th>
                            <th width="30"></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $patients as $patient )
                          <tr>
                            <td><input type="checkbox" name="post[]" value="2"></td>
                            <td><a href="#modal_check_in" class="bootstrap-modal-form-open" onclick="getDetails('{{ $patient->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-stethoscope"></i></a></td>
                            <td>{{ $patient->patient_id }}</td>
                            <td>{{ $patient->fullname }}</td>
                            <td>{{ $patient->gender }}</td>
                            <td>{{ $patient->civil_status }}</td>
                            <td>{{ $patient->date_of_birth->age }}</td>
                            <td>{{ $patient->created_at }}</td>
                            <td>
                              <a href="#" class="active" onclick="deactivateAccount('{{ $patient->id }}')" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                            </td>
                            
                          </tr>
                         @endforeach
                        </tbody>
 
                      </table>
                    </div> --}}
                  </section>
                </section>
                <footer class="footer bg-white b-t">
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t">
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                       
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop
