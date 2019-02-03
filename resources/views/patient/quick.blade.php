<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>Gilead Medical</title>
		<meta name="description" content="Fullscreen Form Interface: A distraction-free form concept with fancy animations" />
		<meta name="keywords" content="fullscreen form, css animations, distraction-free, web design" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="{{ asset('/register/css/normalize.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('/register/css/demo.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('/register/css/component.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('/register/css/cs-select.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{ asset('/register/css/cs-skin-boxes.css')}}" />
		<script src="{{ asset('/register/js/modernizr.custom.js')}}"></script>
	</head>
	<body>
		<div class="container">

			<div class="fs-form-wrap" id="fs-form-wrap">
				<div class="fs-title">
					<h1>Welcome to Gilead Medical & Dental Centre </h1> 
					<div class="codrops-top">
						<a class="codrops-icon codrops-icon-prev" href="#"><span>Restart</span></a>
						<a class="codrops-icon codrops-icon-drop" href="#"><span>View our rates</span></a>
						<a class="codrops-icon codrops-icon-info" href="#"><span>This is a patient registration form </span></a>
					</div>
				</div>
				<form id="myform" class="fs-form fs-form-full" autocomplete="off">
					<ol class="fs-fields">

						
						<li data-input-trigger>
							<label class="fs-field-label fs-anim-upper" for="q3" data-info="This will help us know what kind of service you need">Who is paying ?</label>
							<div class="fs-radio-group fs-radio-custom clearfix fs-anim-lower">
								<span><input id="accounttype" name="accounttype" type="radio" value="Private"/><label for="accounttype" class="radio-mobile">Myself</label></span>
								<span><input id="accounttype" name="accounttype" type="radio" value="Health Insurance"/><label for="accounttype" class="radio-conversion">My Health Inurance Provider</label></span>
								<span><input id="accounttype" name="accounttype" type="radio" value="Company"/><label for="accounttype" class="radio-social">My Company</label></span>
							</div>
						</li>

						
						<li>
							<label class="fs-field-label fs-anim-upper" for="fullname">What's your name?</label>
							<input class="fs-anim-lower" id="fullname" name="fullname" type="text" placeholder="Dean Moriarty" required/>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="email" data-info="We won't send you spam, we promise...">What's your email address?</label>
							<input class="fs-anim-lower" id="email" name="email" type="email" placeholder="dean@road.us" required/>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="mobile_number" data-info="We won't send you spam, we promise...">What's your mobile number?</label>
							<input class="fs-anim-lower" id="mobile_number" name="mobile_number" type="number" placeholder="024XXXXXXXX" required/>
						</li>

						<li>
							<label class="fs-field-label fs-anim-upper" for="postal_address" data-info="We won't send you spam, we promise...">What's your postal address or residential location ?</label>
							<input class="fs-anim-lower" id="postal_address" name="postal_address" type="text" placeholder="Ridge" required/>
						</li>

						<li>
							<label class="fs-field-label fs-anim-upper" for="occupation" data-info="We won't send you spam, we promise...">Please tell us where you work </label>
							<input class="fs-anim-lower" id="occupation" name="occupation" type="text" placeholder="Ridge" />
						</li>

						<li>
							<label class="fs-field-label fs-anim-upper" for="occupation" data-info="We won't send you spam, we promise...">Tell us what you do </label>
							<input class="fs-anim-lower" id="occupation" name="occupation" type="text" placeholder="Ridge" />
						</li>

						<li>
							<label class="fs-field-label fs-anim-upper" for="date_of_birth" data-info="We won't send you spam, we promise...">When were you born ?</label>
							<input class="fs-anim-lower" id="date_of_birth" name="date_of_birth" type="text" placeholder="dd/mm/YYYY" required/>
						</li>

						<li>
							<label class="fs-field-label fs-anim-upper" for="gender" data-info="We won't send you spam, we promise...">What's your gender ?</label>
							<input class="fs-anim-lower" id="gender" name="gender" type="text" placeholder="Male or Female" required/>
						</li>


						<li>
							<label class="fs-field-label fs-anim-upper" for="civil_status" data-info="We won't send you spam, we promise...">What's your marital status?</label>
							<input class="fs-anim-lower" id="civil_status" name="civil_status" type="text" placeholder="Single" required/>
						</li>

						<li>
							<label class="fs-field-label fs-anim-upper" for="kin_name" data-info="We won't send you spam, we promise...">Give a name of someone we can call incase of emergency ?</label>
							<input class="fs-anim-lower" id="kin_name" name="kin_name" type="text" placeholder="Kofi Manu" required/>
						</li>

						<li>
							<label class="fs-field-label fs-anim-upper" for="kin_phone" data-info="We won't send you spam, we promise...">Enter your emergency contact's phone number here </label>
							<input class="fs-anim-lower" id="kin_phone" name="kin_phone" type="number" placeholder="024XXXXXXXX" required/>
						</li>




						<li data-input-trigger>
							<label class="fs-field-label fs-anim-upper" data-info="We'll make sure to use it all over">Choose an insurer if you are here with insurance.</label>
							<select class="cs-select cs-skin-boxes fs-anim-lower">
								<option value="" disabled selected>Pick an insurer</option>
								<option value="Phoenix Health Insurance" data-class="radio-mobile">#Phoenix Health Insurance</option>
								<option value="Acacia Health Insurance" data-class="color-b0c47f">#Acacia Health Insurance</option>
								<option value="Cosmopolitan Health Insurance" data-class="color-f3e395">#Cosmopolitan Health Insurance</option>
								<option value="Glico Health Care" data-class="color-f3ae73">#Glico Health Care</option>
								<option value="Premier Mutual Health" data-class="color-da645a">#Premier Mutual Health</option>
								<option value="Apex Health Insurance" data-class="color-79a38f">#Apex Health Insurance</option>
								<option value="Metropolitan Health Insurance" data-class="color-c1d099">#Metropolitan Health Insurance</option>
								<option value="Nationwide Mutual Insurance" data-class="color-f5eaaa">#Nationwide Mutual Insurance</option>
								<option value="Universal Health Insurance" data-class="color-f5be8f">#Universal Health Insurance</option>
								<option value="Glico TPA Barclays" data-class="color-e1837b">#Glico TPA Barclays</option>
						
							</select>
						</li>

						<!-- <li>
							<label class="fs-field-label fs-anim-upper" for="q4">Describe how you imagine your new website</label>
							<textarea class="fs-anim-lower" id="q4" name="q4" placeholder="Describe here"></textarea>
						</li>

						<li>
							<label class="fs-field-label fs-anim-upper" for="q5">What's your budget?</label>
							<input class="fs-mark fs-anim-lower" id="q5" name="q5" type="number" placeholder="1000" step="100" min="100"/>
						</li>
 -->
					</ol><!-- /fs-fields -->
					<button class="fs-submit" type="button" onclick="addPatient();">Send us your answers</button>
				</form><!-- /fs-form -->
			</div><!-- /fs-form-wrap -->

		</div><!-- /container -->
		<script src="{{ asset('/register/js/classie.js')}}"></script>
		<script src="{{ asset('/register/js/selectFx.js')}}"></script>
		<script src="{{ asset('/register/js/fullscreenForm.js')}}"></script>

		<script src="{{ asset('/event_components/jquery.min.js')}}"></script>
		<script>
			(function() {
				var formWrap = document.getElementById( 'fs-form-wrap' );

				[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
					new SelectFx( el, {
						stickyPlaceholder: false,
						onChange: function(val){
							document.querySelector('span.cs-placeholder').style.backgroundColor = val;
						}
					});
				} );

				new FForm( formWrap, {
					onReview : function() {
						classie.add( document.body, 'overview' ); // for demo purposes only
					}
				} );
			})();
		</script>

		<script src="{{ asset('/event_components/jquery.min.js')}}"></script>
<script type="text/javascript">
$(function () {
  $('#date_of_birth').daterangepicker({
     "minDate": moment('1930-06-14'),
      "maxDate": moment(),
      "singleDatePicker":true,
      "autoApply": true,
      "showDropdowns": true,
      "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});


</script>
  
		<script type="text/javascript">
function addPatient()
{
	//alert($('#accounttype').val());

    $.get('/create-patient',
        {
         "fullname"                   :$('#fullname').val(),
          "accounttype"                :$('#accounttype').val(),
          "blood_group"                :$('#blood_group').val(),
          "postal_address"             :$('#postal_address').val(),
          "residential_address"        :$('#residential_address').val(),
          "email"                      :$('#email').val(),
          "mobile_number"              :$('#mobile_number').val(),
          "date_of_birth"              :$('#date_of_birth').val(),
          "occupation"                 :$('#occupation').val(),
          "place_of_birth"             :$('#place_of_birth').val(),
          "gender"                     :$('#gender').val(),
          "insurance_company"          :$('#insurance_company').val(),
          "company"                    :$('#company').val(),
          "nationality"                :$('#nationality').val(),
          "insurance_id"               :$('#insurance_id').val(),
          "civil_status"               :$('#civil_status').val(),

          "id_type"                    :$('#id_type').val(),
          "kin_name"                   :$('#kin_name').val(),    
          "kin_phone"                  :$('#kin_phone').val(),    
          "kin_relationship"           :$('#kin_relationship').val(),
          "insurance_cover"            :$('#insurance_cover').val(),    
          "insurance_eligibility"      :$('#insurance_eligibility').val(),
          "parent_id"                  :$('#parent_id').val(),    
          "link_type"                  :$('#link_type').val(),
          "expiry_date"                :$('#date_of_birth').val()

        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        if(data["OK"])
        {
          //toastr.success("Customer successfully saved!");
          
          window.location = "/patient-profile-limited/"+data["ReferenceNumber"];
        
        }
        else
        {
          toastr.error("Customer failed to save!");
          
        }
      });
                                        
        },'json');
  
 
}

		</script>
	</body>
</html>