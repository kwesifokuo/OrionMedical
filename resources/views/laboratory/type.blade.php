@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                      <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                      
                    <a href="#add-test" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-plus"></i> Add New Test </a>
                     <span class="badge badge-info">Record(s) Found : {{ $tests->total() }} {{ str_plural('Test', $tests->total()) }} </span> <img width="30" height="30" src="/images/drugs.png"> 
                    </div>

                  <form action="/find-lab-type" method="GET">
                    <div class="col-sm-4 m-b-xs">
                      <div class="input-group">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search for test">
                        <span class="input-group-btn">
                          <button class="btn btn-sm btn-default" type="submit">Go!</button>
                        </span>
                      </div>
                    </div>
                     </form>
                    </div>
                
                </header>
                <section class="scrollable wrapper w-f">
                  <section class="panel panel-default">
                    <div class="table-responsive">
                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            

                           
                             <th>Test</th>
                            <th>Cost</th>
                            <th>Specimen</th>
                            <th>Status</th>
                             <th></th>
                             <th></th>
                              <th></th>
                             
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($tests as $test )
                          <tr>  
                         
                          
                            <td>{{ $test->type }}</td>
                            <td>{{ $test->charge }}</td>
                            <td>{{ $test->specimen }}</td>
                            <td>Active</td>
                              <td>
                            <a href="#add-parameter" class="bootstrap-modal-form-open"  id="delete" name="delete" data-toggle="modal" alt="edit"><i class="fa fa-plus"></i></a>
                            </td>
                             <td>
                            <a href="#" class="bootstrap-modal-form-open" onclick="deletedrug('{{ $test->id }}','{{ $test->name }}')"  id="delete" name="delete" data-toggle="modal" alt="edit"><i class="fa fa-pencil"></i></a>
                            </td>
                            <td>
                            <a href="#" class="bootstrap-modal-form-open" onclick="deletedrug('{{ $test->id }}','{{ $test->name }}')"  id="delete" name="delete" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                            </td>
                          
                            
                          </tr>
                         @endforeach
                        </tbody>
 
                      </table>
                    </div>
                  </section>
                </section>
                <footer class="footer bg-white b-t">
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t">
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                        {!!$tests->render()!!}
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
   
    $('#investigation').select2();
    

  });
</script>

<div class="modal fade" id="add-parameter" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Parameter</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class="active"><a href="#equitytab" data-toggle="tab">Parameter Details</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" data-validate="parsley" method="post" action="/save-drug" class="panel-body wrapper-lg">
                            @include('laboratory/category') 
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                        </section>
                     </section>
        </div>
        
      </div><!-- /.modal-content -->
      </div>
    </div><!-- /.modal-dialog -->

<div class="modal fade" id="add-test" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Add New Test</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class="active"><a href="#equitytab" data-toggle="tab">Test Details</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" data-validate="parsley" method="post" action="/" class="panel-body wrapper-lg">
                            @include('laboratory/new') 
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                        </section>
                     </section>
        </div>
        
      </div><!-- /.modal-content -->
      </div>
    </div><!-- /.modal-dialog -->

    <div class="modal fade" id="edit-test" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Test</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                          <li class="active"><a href="#equitytab" data-toggle="tab">Test Details</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" method="post" data-validate="parsley" action="/update-drug-details" class="panel-body wrapper-lg">
                           
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                      </div>
                    </section>
                  </section>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->


