 <section class="panel panel-default">
                                <header class="panel-heading font-bold">+</header>
                                <div class="panel-body">
                                  <form role="form">
                                    <div class="form-group">
                                      <label>Company Name</label>
                                      <input type="text" id="insurance_company" name="insurance_company" data-required="true" class="form-control" placeholder="">
                                    </div>

                                     <div class="form-group">
                                      <label>Contact Person</label>
                                      <input type="text" id="contactperson" name="contactperson" data-required="true" class="form-control" placeholder="">
                                    </div>

                                     <div class="form-group">
                                      <label>Address</label>
                                      <input type="text" id="address" name="address" data-required="true" class="form-control" placeholder="">
                                    </div>


                                     <div class="form-group">
                                      <label>Phone</label>
                                      <input type="text" id="phone" name="phone" data-required="true" class="form-control" placeholder="">
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-default pull-right">Submit</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                  </form>
                                </div>
                              </section>
