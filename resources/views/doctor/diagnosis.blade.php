
 <section class="panel panel-default">

                              <header class="panel-heading">
                    
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' multiple class="input-sm form-control" keyup="loadAllDiagnosis()" placeholder="Search by ID or Name">
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-dark" type="button"  onclick="loadAllDiagnosis()">Search!</button>
                        </div>
                      </div>
                    </header>
                                <div class="panel-body">

                        
                                      <div class="table-responsive">
                      <table id="searchTable" cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                        
                            <th>Code </th>
                            <th>Category</th>
                            <th>Diagnosis</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                       
                        </tbody>
 
                      </table>
                    </div>           
                </div>
</section>