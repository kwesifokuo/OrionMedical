                    <section class="panel panel-default">
                      <div class="panel-body">
                          
                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <label>Tooth </label>
                           <select id="tooth" name="tooth" rows="3" tabindex="1"  style="width:100%">
                           <option value="">-- Select Tooth --</option>
                          @foreach($tooth as $tooth)
                        <option value="{{ $tooth->number }}">{{ $tooth->number }}</option>
                          @endforeach
                        </select>         
                          </div>
                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <label>Procedure </label>
                           <select id="procedure" name="procedure" rows="3" tabindex="1" data-placeholder="drug name" style="width:100%">
                           <option value="">-- Select Procedure --</option>
                          @foreach($treatments as $treatment)
                        <option value="{{ $treatment->type }}">{{ $treatment->type }}</option>
                          @endforeach
                        </select>         
                          </div>
                        </div>

                          <div class="form-group">
                         <div class="form-group{{ $errors->has('fullname') ? ' has-error' : ''}}">
                          <label>Status </label>
                          <input type="text" class="form-control" id="fullname"  value="{{ Request::old('fullname') ?: '' }}"  name="fullname">
                          @if ($errors->has('fullname'))
                          <span class="help-block">{{ $errors->first('fullname') }}</span>
                           @endif                        
                        </div>
                        
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label>Remark</label> 
                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : ''}}">
                            <textarea type="text" rows="3" class="form-control" id="comment" name="comment" value="{{ Request::old('comment') ?: '' }}"></textarea>   
                           @if ($errors->has('comment'))
                          <span class="help-block">{{ $errors->first('comment') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                      </div>
                     
                      <footer class="panel-footer text-right bg-light lter">
                        <button type="button" onclick="addProcedure()" class="btn btn-success btn-s-xs">Save</button>
                      </footer>
                    </section>