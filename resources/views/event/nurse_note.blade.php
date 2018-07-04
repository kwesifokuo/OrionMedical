
						<div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <label>Note</label> 
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : ''}}">
                            <textarea type="text" rows="20" class="form-control" id="title" name="title" value="{{ Request::old('title') ?: '' }}"></textarea>   
                           @if ($errors->has('title'))
                          <span class="help-block">{{ $errors->first('title') }}</span>
                           @endif    
                          </div>
                          </div>
                        </div>

                               <div class="form-group{{ $errors->has('referal_doctor') ? ' has-error' : ''}}">
                            <label>Assigned Nurse</label>
                            <select id="referal_doctor" name="referal_doctor" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control" >
                         <option value="All Nurses">All Nurses</option>
                          @foreach($doctors as $doctor)
                        <option value="{{ $doctor->name }}">{{ $doctor->name }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('referal_doctor'))
                          <span class="help-block">{{ $errors->first('referal_doctor') }}</span>
                           @endif    
                          </div> 
 
			<div class="form-group @if($errors->has('time')) has-error @endif">
				<label for="time">Time</label>
				<div class="input-group">
					<input type="text" class="form-control" name="time" id="time" placeholder="Select your time" value="{{ old('time') }}">
					<span class="input-group-addon">
						<span class="fa fa-calendar"></span>
                    </span>
				</div>
				@if ($errors->has('time'))
					<p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
					{{ $errors->first('time') }}
					</p>
				@endif
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		