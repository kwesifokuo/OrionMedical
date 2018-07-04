                    <section class="panel panel-default">
                      <div class="panel-body">
                       

              
                       <section class="panel panel-default">
                    <header class="panel-heading bg-light">
                      <ul class="nav nav-tabs pull-left">
                      
                        <li><a href="#investigation_tab"  data-toggle="tab"><i class="fa fa-flask text-default"></i> Items </a></li>
                       
                       
                      </ul>
                      <span class="hidden-sm">.</span>
                    </header>
                    <div class="panel-body">
                      <div class="tab-content">              
                       
                      
                      
                      {{-- Patient History End --}}

                        {{-- Patient clinical Start --}}
                         {{-- Patient treatment Start --}}
                      <div class="tab-pane Active" id="investigation_tab">
                          

                          <div>
                          <span class="input-group-btn">
                              <button class="btn btn-primary pull-right" onclick="uploadDetails()" type="button">Upload all to shelf </button>
                            </span>
                        </div>
                        
                    <div >
                   
                    <br>
                    <br>
                       <table id="invoicesTableShelf" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
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
                       
                         <input type="hidden" name="invoice_number" id="invoice_number" value="{{ Request::old('invoice_number') ?: '' }}">                
                      </footer>
                    </section>



