                    <section class="panel panel-default">
                      <div class="panel-body">
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                       <div class="form-group @if($errors->has('opd_number')) has-error @endif">
                        <label for="opd_number">Visit Number</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="opd_number" data-required="true" id="opd_number" placeholder="Enter visit number" value="{{ old('opd_number') }}">
                         <span class="input-group-btn">
                          <button class="btn btn-sm btn-default" type="button" onclick="getVisitDetails()">Go!</button>
                        </span>
                      </div>
                        @if ($errors->has('opd_number'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('opd_number') }}
                       </p>
                        @endif
                      </div>
                      </div>
                      
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('accounttype') ? ' has-error' : ''}}">
                            <label>Account Type</label>
                            <input id="accounttype" name="accounttype" value="Private" readonly="true" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                       
                           @if ($errors->has('accounttype'))
                          <span class="help-block">{{ $errors->first('accounttype') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        
                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                         <div class="form-group{{ $errors->has('fullname') ? ' has-error' : ''}}">
                          <label>Patient Name </label>
                          <input type="text" class="form-control" id="fullname" value="{{ Request::old('fullname') ?: '' }}"  name="fullname">
                          <input type="hidden" class="form-control" id="patient_id" readonly="true" value="{{ Request::old('patient_id') ?: '' }}"  name="patient_id">
                          @if ($errors->has('fullname'))
                          <span class="help-block">{{ $errors->first('fullname') }}</span>
                           @endif                        
                        </div>
                        
                        </div>
                        </div>


                        <div class="form-group pull-in clearfix">

                        <div class="col-sm-2">
                            <label>Quantity</label> 
                           <input type="number" class="form-control" id="drug_quantity"  value="{{ Request::old('drug_quantity') ?: '' }}"  name="drug_quantity">
                          @if ($errors->has('drug_quantity'))
                          <span class="help-block">{{ $errors->first('drug_quantity') }}</span>
                           @endif   
                          </div>


                        <div class="col-sm-10">
                         <div class="form-group{{ $errors->has('medication') ? ' has-error' : ''}}">
                          <label>Medication</label>
                         <select id="medication" name="medication" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          @foreach($drugs as $drug)
                        <option value="{{ $drug->id }}">{{ $drug->name }}</option>
                          @endforeach
                        </select> 
                          @if ($errors->has('medication'))
                          <span class="help-block">{{ $errors->first('medication') }}</span>
                           @endif                        
                        </div>
                        </div>
                        </div>
                        <div >

                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addDrug()"  class="btn btn-success btn-s-xs">Add</button>       
                      </footer>
                      <br>
                    <br>
                    <header class="panel-heading">
                      <span class="label bg-dark pull-left">Prescription List</span>
                  </header>
                    <br>
                    <br>
                       <table id="drugTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Quantity</th>
                              <th>Drug Name</th>
                              <th>Cost</th>
                              <th></th>
                               <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                </div>
                 <div class="line"></div>
                      </div>
                    </section>


