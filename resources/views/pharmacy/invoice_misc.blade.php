                    <section class="panel panel-default">
                      <div class="panel-body">
                       

                       <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                           <select id="consumable_supplier" name="consumable_supplier" rows="3" tabindex="1" data-required="true" data-placeholder="Select supplier ..." style="width:100%">
                           <option value="">-- Nothing selected --</option>
                          @foreach($suppliers as $supplier )
                        <option value="{{ $supplier->name }}">{{ $supplier->name }}</option>
                          @endforeach 
                        </select>  

                          </div>
                        </div>


                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                       <div class="form-group @if($errors->has('invoice_number')) has-error @endif">
                        <label for="invoice_number">Invoice Number</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="consumable_invoice_number" data-required="true" id="consumable_invoice_number" placeholder="inv number" value="{{ old('consumable_invoice_number') }}">
                         <span class="input-group-btn">
                          <button class="btn btn-sm btn-default" type="button" onclick="getVisitDetails()">Go!</button>
                        </span>
                      </div>
                        @if ($errors->has('invoice_number'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('invoice_number') }}
                       </p>
                        @endif
                      </div>
                      </div>
                      
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('invoice_date') ? ' has-error' : ''}}">
                            <label>Invoice Date</label>
                            <input id="consumable_invoice_date" name="consumable_invoice_date" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                       
                           @if ($errors->has('invoice_date'))
                          <span class="help-block">{{ $errors->first('invoice_date') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        
                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                         <div class="form-group{{ $errors->has('invoice_description') ? ' has-error' : ''}}">
                          <label>Description </label>
                          <input type="text" class="form-control" id="consumable_invoice_description" value="{{ Request::old('consumable_invoice_description') ?: '' }}"  name="consumable_invoice_description">
                          @if ($errors->has('invoice_description'))
                          <span class="help-block">{{ $errors->first('invoice_description') }}</span>
                           @endif                        
                        </div>
                        
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                         <div class="form-group{{ $errors->has('invoice_remark') ? ' has-error' : ''}}">
                          <label>Remarks </label>
                          <input type="text" class="form-control" id="consumable_invoice_remark" value="{{ Request::old('consumable_invoice_remark') ?: '' }}"  name="consumable_invoice_remark">
                          @if ($errors->has('invoice_remark'))
                          <span class="help-block">{{ $errors->first('invoice_remark') }}</span>
                           @endif                        
                        </div>
                        
                        </div>
                        </div>

                        <br>
                        <br>
                       

                       <section class="panel panel-default">
                    <header class="panel-heading bg-light">
                      <ul class="nav nav-tabs pull-left">
                      
                        <li><a href="#investigation_tab"  data-toggle="tab"><i class="fa fa-flask text-default"></i> Items </a></li>
                       
                       
                      </ul>
                      <span class="hidden-sm">.</span>
                    </header>
                    <div class="panel-body">
                      <div class="tab-content">              
                       
                      
                      
                  
                <div class="tab-pane Active" id="investigation_tab">
                          <div class="form-group pull-in clearfix">

                          <div class="col-sm-12">
                          <div class="input-group m-b">
                           <select id="consumable" name="consumable" rows="3" onchange="getconsumabledetail()" tabindex="1" data-placeholder="Search consumable ..." style="width:100%">
                           <option value="">-- Select drug from consumables--</option>
                          @foreach($consumables as $drugs)
                        <option value="{{ $drugs->id }}">{{ $drugs->name }}</option>
                          @endforeach
                        </select>  <div class="input-group-btn">
                           <a href="#" class="bootstrap-modal-form-open" data-toggle="modal" ><button  class="btn btn-sm btn-default" type="button"><i class="fa fa-plus-circle"></i></button></a>
                        </div>     
                        </div>   
                          </div>
                        </div>


                         <div class="form-group pull-in clearfix">
                           <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('quantity') ? ' has-error' : ''}}">
                            <label>Quantity</label>
                            <input id="consumable_quantity" name="consumable_quantity" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                       
                           @if ($errors->has('quantity'))
                          <span class="help-block">{{ $errors->first('quantity') }}</span>
                           @endif    
                          </div>   
                        </div>
                      
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('unit_price') ? ' has-error' : ''}}">
                            <label>Unit Cost</label>
                            <input id="consumable_unit_price" name="consumable_unit_price" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                       
                           @if ($errors->has('unit_price'))
                          <span class="help-block">{{ $errors->first('unit_price') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div>
                          <span class="input-group-btn">
                              <button class="btn btn-primary pull-right" onclick="addInvoicesConsumable()" type="button">Add </button>
                            </span>
                        </div>
                    <div >
                   
                    <br>
                    <br>
                       <table id="invoicesTableConsmable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                          <thead>
                            <tr>
                            
                              <th>Description </th>
                              <th>Quantity</th>
                              <th>Unit Cost</th>
                              <th>Amount</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                </div>
                 <div class="line"></div>
                
              </div>

                          
                    </div>
                  </section>

                        
                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                       
                         <input type="hidden" name="consumable_invoice_number" id="consumable_invoice_number" value="{{ Request::old('consumable_invoice_number') ?: '' }}">                
                      </footer>
                    </section>



