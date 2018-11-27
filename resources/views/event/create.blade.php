
			<div class="form-group @if($errors->has('name')) has-error has-feedback @endif">
				<label for="name">Name</label>
				 <select id="name" name="name" rows="3" tabindex="1" data-required="true" data-placeholder="Select here.." style="width:100%">
				  <option value="">Select Patient</option>
                          @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->fullname }}</option>
                          @endforeach
                        </select>
				@if ($errors->has('name'))
					<p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
					{{ $errors->first('name') }}
					</p>
				@endif
			</div>

						<div class="form-group{{ $errors->has('title') ? ' has-error' : ''}}">
                            <label>Appointment Type</label>
                             <select id="title" name="title" rows="3" tabindex="1" data-required="true" data-placeholder="Select here.." style="width:100%">
                             <option value="">Select Appointment Type</option>
                          @foreach($servicetype as $servicetype)
                        <option value="{{ $servicetype->type }}">{{ $servicetype->type }}</option>
                          @endforeach
                        </select>         
             			</div>  
                               <div class="form-group{{ $errors->has('referal_doctor') ? ' has-error' : ''}}">
                            <label>Doctor</label>
                            <select id="referal_doctor" name="referal_doctor" rows="3" data-required="true" tabindex="1" data-placeholder="Select here.." style="width:100%">
                            <option value="">Select Doctor</option>
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
		