<?php
/**
 * Enqueue script and styles for child theme
 */
function woodmart_child_enqueue_styles() {
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'woodmart-style' ), woodmart_get_theme_info( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'woodmart_child_enqueue_styles', 10010 );

 // Redirect WooCommerce Shop URL
function wpc_shop_url_redirect() {
    if( is_shop() ){
        wp_redirect( home_url( '/our-store/' ) ); // Assign custom internal page here
        exit();
    }
}
add_action( 'template_redirect', 'wpc_shop_url_redirect' );
// Redirect WooCommerce Shop URL ENd
//Loading Bootstrap
function enqueue_bootstrap() {
    // Enqueue Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');

    // Enqueue Bootstrap JavaScript and its dependencies (jQuery)
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'), '4.5.2', true);
}

add_action('wp_enqueue_scripts', 'enqueue_bootstrap');
 //loading jquery
 
function enqueue_jquery() {

    // Enqueue jQuery
    wp_enqueue_script('jquery');
}

// Hook this function to run when WordPress initializes
add_action('wp_enqueue_scripts', 'enqueue_jquery');

function registration_form_shortcode() {
    ob_start(); ?>
<!-- ======= Register Now Section ======= -->
<style>

/*--------------------------------------------------------------
# Register Form
--------------------------------------------------------------*/

.register-contact label{
    color:#fff;
}
	.register-contact input{
		height:42px !important;
    background-color:#fff;
}
.contact-us-form {
    background: linear-gradient(to right,#a48f5f 50%, #a48f5f 50%); 
    padding: 50px 0px 50px 0px; 
    background: linear-gradient(89deg, #0a2e19, #a48f5f);
}
.contact {
    background-color: #fff;
    padding: 30px 30px 30px;
/*     box-shadow: 12px 12px 0 0 rgba(31,50,32,0.3); */
    /*border: 20px solid #0a2e19;*/
    background: #fff;
}
	.custom-control-input:checked~.custom-control-label::before {
    color: #fff !important;
    border-color: #ffffff !important;
    background-color: #e7a52f !important;
}
	.danger{
		color:#FF0000;
	}
	.datelabel{
		width:100%;
		    padding-left: 15px;
    padding-bottom: 5px;
	}
	#register-create-form input,select,textarea{
		border-radius: 10px;
border: 1px solid #112E1C;
background: #FFF;
	}
	#register-create-form textarea{
		height: 171.315px;
	}
	#register-create-form select{
		appearance: auto !important;
	}
	#register-create-form input,select{
		height: 42px !important;
	}
	#player_email{
		    border: none !important;
    border-radius: 8px !important;
	}
	.hide {
    display: none;
}
	.phonenumber{
		padding-left:15px;
		color: #FFF;
text-align: center;
font-family: Inter;
font-size: 20px;
font-style: normal;
font-weight: 700;
line-height: normal;
	}
	.phone{
		fill:#fff;
	}
	.mainphonewrap:hover .phone{
		fill:#E7A52F;
	}
	.phonenumber:hover{
		color:#E7A52F;
		
	}
	.register-btn-contact-bg {
    background: #112E1C;
    color: #fff;
		font-size:16px;
    padding: 13px 40px;
    border-radius: 10px;
    pointer-events: bounding-box;
    box-shadow: #212529 2px 2px 0 0, #000 2px 2px 0 1px;
    text-transform: capitalize;
}
	
	.register-btn-contact-bg:hover {
    background: #E7A52F !important;
    
}
	.alert{
		margin-top: 30px;
	}
	.alert-success {
    color: #000000 !important;
    background-color: #E7A52F !important;
    border-color: #112E1C !important;
    max-width: fit-content !important;
}
	
</style>
<section id="register" class="registration-form section-padding">
	<div class="container">
		<div class="row">
			<div class="">
				<div class="register-contact">
					<form id="register-create-form" method="post" class="form" name="Register-Form" onkeypress="return event.keyCode != 13;" autocomplete="off" enctype="multipart/form-data" novalidate>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="player_first_name">Player's First Name <span class="danger">*</span></label>
								<input type="text" name="player_first_name" id="player_first_name" class="form-control" placeholder="" required="required" onfocusout="validate_player_first_name();">
								<span id="error_player_first_name"></span>
							</div>
							<div class="form-group col-md-6">
								<label for="player_last_name">Player's Last Name <span class="danger">*</span></label>
								<input type="text" name="player_last_name" id="player_last_name" class="form-control" placeholder="" required="required" onfocusout="validate_player_last_name();">
								<span id="error_player_last_name"></span>
							</div>
								<!--
								Gender Part 
							-->
							<div class="form-group col-md-12  " style="padding-right:-13px;">
								<label for="player_gender">  Choose Gender <span class="danger">*</span> </label>
								<select id="player_gender" name="player_gender" class="form-control" placeholder="" required="required" onfocusout="validate_player_gender()">
									<option value="">Gender</option>
									<option value="Boy">Boy</option>
									<option value="Girl">Girl</option>
								</select>
								<span id="error_player_gender"></span>
							</div>
							<!--
								Gender Part 
							-->
							<br>
							<div class="w-10 text-light datelabel">
									Date of Birth <span class="danger">*</span>
								</div>
							<br>
							<div class="form-group col-md-4 padding-right">
								
								<select id="player_date_of_birth_year" name="player_date_of_birth_year" class="form-control" placeholder="" required="required" onfocusout="validate_player_date_of_birth_year();">
									<option value="">Year</option>
									<?php
									$year_start = date('Y'); // current Year
									$ending_year = 2005; // user date of birth year
									for ($i_year = $year_start; $i_year >= $ending_year; $i_year--) {
										echo '<option value="' . $i_year . '">' . $i_year . '</option>' . "\n";
									}
									?>
								</select>
								<span id="error_player_date_of_birth_year"></span>
							</div>
							<div class="form-group col-md-4 padding-right padding-top">
								<!--<label for="player_date_of_birth_month">  </label>-->
								<select id="player_date_of_birth_month" name="player_date_of_birth_month" class="form-control" placeholder="" required="required" onfocusout="validate_player_date_of_birth_month();">
									<option value="">Month</option>
									<?php
										for ($i_month = 1; $i_month <= 12; $i_month++) { 
										    $dateObj   = DateTime::createFromFormat('!m', $i_month);
                                            $monthName = $dateObj->format('F');
												echo '<option value="'.$i_month.'">'. $monthName.'</option>'."\n";
										}	
									?>
								</select>
								<span id="error_player_date_of_birth_month"></span>
							</div>
							<div class="form-group col-md-4 padding-top">
								<!--<label for="player_date_of_birth_day"></label>-->
								<select id="player_date_of_birth_day" name="player_date_of_birth_day" class="form-control" placeholder="" required="required" onfocusout="validate_player_date_of_birth_day();">
									<option value="">Day</option>
									<?php
									for ($i_day = 1; $i_day <= 31; $i_day++) {
										echo '<option value="' . $i_day . '">' . $i_day . '</option>' . "\n";
									}
									?>
								</select>
								<span id="error_player_date_of_birth_day"></span>
							</div>
							<!-- <div class="form-group  col-md-12">
								<input type="text" name="player_date_of_birth" id="player_date_of_birth" class="form-control datepicker" placeholder="Birthday">
							</div> -->
							<div class="form-group col-md-6">
								<label for="parent_first_name" style="font-size:15px !important;">Legal Guardian's First Name <span class="danger">*</span></label>
								<input type="text" name="parent_first_name" id="parent_first_name" class="form-control" placeholder="" required="required" onfocusout="validate_parent_first_name();">
								<span id="error_parent_first_name"></span>
							</div>
							<div class="form-group col-md-6">
								<label for="parent_last_name" style="font-size:15px !important;">Legal Guardian's Last Name <span class="danger">*</span></label>
								<input type="text" name="parent_last_name" id="parent_last_name" class="form-control" placeholder="" required="required" onfocusout="validate_parent_last_name();">
								<span id="error_parent_last_name"></span>
							</div>
							<div class="form-group col-md-6">
								<label for="player_email">Email <span class="danger">*</span></label>
								<input type="email" name="player_email" id="player_email" class="form-control" placeholder="" required="required" onfocusout="validate_player_email();">
								<span id="error_player_email"></span>
							</div>
							<div class="form-group col-md-6">
								<label for="player_contact_number">Phone Number <span class="danger">*</span></label>
								<input type="text" name="player_contact_number" id="player_contact_number" class="form-control" placeholder="(xxx)xxx-xxxx" required="required" onfocusout="validate_player_contact_number();">
								<span id="error_player_contact_number"></span>
							</div>
							<div class="w-9 text-light datelabel pl-4">
									Choose the Program You Want To Register In <span class="danger">*</span>
								</div>
							<div class="form-group col-md-6 mt-form-0" style="margin-bottom: 0;">
							<div class="form-group   my-1">
								<div class="custom-control custom-checkbox mr-sm-2">
									<input type="checkbox" class="custom-control-input" id="team_registration" name="team_registration">
									<label class="custom-control-label" for="team_registration">Team Soccer Registration</label>
								</div>
							</div>
							<div class="form-group   my-1">
								<div class="custom-control custom-checkbox mr-sm-2">
									<input type="checkbox" class="custom-control-input" id="private_training" name="private_training" >
									<label class="custom-control-label" for="private_training">Private Soccer Training</label>
								</div>
							</div>
							<div class="form-group   my-1">
								<div class="custom-control custom-checkbox mr-sm-2">
									<input type="checkbox" class="custom-control-input" id="summer_training" name="summer_training" >
									<label class="custom-control-label" for="summer_training">Summer Soccer Training</label>
								</div>
							</div>
							</div>
							<div class="form-group col-md-6" style="margin-bottom: 0;">
							<div class="form-group  my-1">
								<div class="custom-control custom-checkbox mr-sm-2">
									<input class="custom-control-input" id="fall_session" name="fall_session"  type="checkbox">
									<label class="custom-control-label" for="fall_session">Fall Session</label>
								</div>
							</div>
							<div class="form-group  my-1">
								<div class="custom-control custom-checkbox mr-sm-2">
									<input type="checkbox" class="custom-control-input" id="winter_session" name="winter_session" >
									<label class="custom-control-label" for="winter_session">Winter Session</label>
								</div>
							</div>
							<div class="form-group ">
								<div class="custom-control custom-checkbox mr-sm-2">
									<input type="checkbox" class="custom-control-input" id="spring_sessions" name="spring_sessions" >
									<label class="custom-control-label" for="spring_sessions">Spring Session</label>
								</div>
							</div>
								
							</div>
							<span id="error_program_select" style="color: red; font-size: 13px; float: left; padding-left:15px;"></span>
							<div class="form-group col-md-12">
								<label for="player_contact_number">Your Message</label>
								<textarea rows="6" name="register_message" id="register_message" class="form-control" placeholder="" ></textarea>
							</div>
							<div class="col-md-12 d-flex justify-content-between align-items-center reg_form_submit_container">
								<div>
									<input type="hidden" name="action" value="registration_form_submit" id="action" />
								<button type="submit" name="next" id="register_third_step_process" class="register_create_submit submit btn register-btn-contact-bg" value="Submit">Submit</button>
								</div>
								<div class="d-flex justify-content-center align-items-center mainphonewrap">
									<a href="tel:980-216-8082" class="d-flex justify-content-center align-items-center ">
									<svg width="18" height="18" viewBox="0 0 18 18" class="phone" xmlns="http://www.w3.org/2000/svg">
<path d="M17.4873 14.14L13.4223 10.444C13.2301 10.2693 12.9776 10.1762 12.7181 10.1842C12.4585 10.1922 12.2123 10.3008 12.0313 10.487L9.63828 12.948C9.06228 12.838 7.90428 12.477 6.71228 11.288C5.52028 10.095 5.15928 8.934 5.05228 8.362L7.51128 5.968C7.69769 5.78712 7.80642 5.54082 7.81444 5.2812C7.82247 5.02159 7.72917 4.76904 7.55428 4.57699L3.85928 0.512995C3.68432 0.320352 3.44116 0.203499 3.18143 0.187255C2.92171 0.17101 2.66588 0.256653 2.46828 0.425995L0.298282 2.28699C0.125393 2.46051 0.0222015 2.69145 0.00828196 2.93599C-0.00671804 3.18599 -0.292718 9.108 4.29928 13.702C8.30528 17.707 13.3233 18 14.7053 18C14.9073 18 15.0313 17.994 15.0643 17.992C15.3088 17.9783 15.5396 17.8747 15.7123 17.701L17.5723 15.53C17.7423 15.333 17.8286 15.0774 17.8127 14.8177C17.7968 14.558 17.68 14.3148 17.4873 14.14Z" />
</svg>

                                    <div class="phonenumber">
	                                       980-216-8082
									</div></a>
								</div>
							</div>
						</div>
					</form>
					<div id="register-success" class="register-contact-success hide">
						<div class="">
							<div id="register-alert-success" class="alert hide alert-success">
								<strong>Success!</strong> Indicates a successful or positive action.
							</div>
						</div>
						<div class="">
							<div id="register-alert-fail" class="alert hide alert-danger">
								<strong>Success!</strong> Indicates a successful or positive action.
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

jQuery(document).ready(function($){
$(".register_create_submit").click(function(e) {
        e.preventDefault();
        var response = validate_step_1();
        if (response == true) {
            
            // $('#signup').on("submit", function(e) {
                e.preventDefault();
                    $('#register_third_step_process').prop('disabled', true);
                 formdate =$("#register-create-form").serialize();
                 console.log(formdate);
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        url: "<?php echo admin_url('admin-ajax.php');  ?>",
                        data: {
							action: 'create_register_record', // This should match the WordPress AJAX action
                formData: $("#register-create-form").serialize()
						},
                        success: function(data) {
							if(data.status == 1 ){
                                $('#register_third_step_process').prop('disabled', false);
                                document.getElementById("register_third_step_process").innerText = 'Submit';
                                document.getElementById("register-create-form").reset();
                                document.getElementById("register-alert-success").innerText = data.message;
                                $('#register-success').show();
                                $('#register-alert-success').show();
							
                                $('#register-alert-fail').hide();
								$('#return-crud-call').css({
                                'background-color': '#28A744 !important',
                                           'border-color': '#28A744 !important'
                                        });
                            }else{
                                $('#register_third_step_process').prop('disabled', false);
                                document.getElementById("register_third_step_process").innerText = 'Submit';
                                document.getElementById("register-alert-fail").innerText = data.message;
                                $('#register-success').show();
                                $('#register-alert-success').hide();
                                $('#register-alert-fail').show();
                                // $('#thank-you').hide();
                                // $('#signup').show();
                                // $('.wpcf7-response-output').show();
                                // $('.wpcf7-response-output').innerText = data.message;
                            }
                        }
                    });
            // });
        }
    });
});

function validate_step_1() {
        var player_first_name = document.getElementById("player_first_name").value;
        var player_last_name = document.getElementById("player_last_name").value;
        var player_gender = document.getElementById("player_gender").value;
        var player_date_of_birth_year = document.getElementById("player_date_of_birth_year").value;
        var player_date_of_birth_month = document.getElementById("player_date_of_birth_month").value;
        var player_date_of_birth_day = document.getElementById("player_date_of_birth_day").value;
        var parent_first_name = document.getElementById("parent_first_name").value;
        var parent_last_name = document.getElementById("parent_last_name").value;
        var player_email = document.getElementById("player_email").value;
        var player_contact_number = document.getElementById("player_contact_number").value;
        var register_message = document.getElementById("register_message").value;
	 var register_message = document.getElementById("team_registration").value;
	if($('#team_registration').prop('checked')){
			var team_registration ="on";
	}
	else{
		var team_registration ="off";
	}
	
	if($('#private_training').prop('checked')){
			var private_training ="on";
	}
	else{
		var private_training ="off";
	}
	
	if($('#summer_training').prop('checked')){
			var summer_training ="on";
	}
	else{
		var summer_training ="off";
	}

	if($('#fall_session').prop('checked')){
			var fall_session ="on";
	}
	else{
		var fall_session ="off";
	}
		if($('#winter_session').prop('checked')){
			var winter_session ="on";
	}
	else{
		var winter_session ="off";
	}
		if($('#spring_sessions').prop('checked')){
			var spring_sessions ="on";
	}
	else{
		var spring_sessions ="off";
	}
	
        if (player_first_name == "") {
            jQuery('#player_first_name').removeClass('validate');
            jQuery('#player_first_name').css({"box-shadow": "0px 1px 0px #f4524d"});
            document.getElementById('error_player_first_name').innerHTML = "Enter Player First Name";
            jQuery('#error_player_first_name').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
            document.getElementById('player_first_name').focus();
            return false;
        } else {
            jQuery('#player_first_name').addClass('validate');
            jQuery('#player_first_name').css("box-shadow", "");
            document.getElementById('error_player_first_name').innerHTML = "";
            valid = true;
        }
        if (player_last_name == "") {
            jQuery('#player_last_name').removeClass('validate');
            jQuery('#player_last_name').css({"box-shadow": "0px 1px 0px #f4524d"});
            document.getElementById('error_player_last_name').innerHTML = "Enter Player Last Name";
            jQuery('#error_player_last_name').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
            document.getElementById('player_last_name').focus();
            return false;
        } else {
            jQuery('#player_last_name').addClass('validate');
            jQuery('#player_last_name').css("box-shadow", "");
            document.getElementById('error_player_last_name').innerHTML = "";
            valid = true;
        }
        if (player_gender == "") {
            jQuery('#player_gender').removeClass('validate');
            jQuery('#player_gender').css({"box-shadow": "0px 1px 0px #f4524d"});
            document.getElementById('error_player_gender').innerHTML = "Select Genter";
            jQuery('#error_player_gender').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
            document.getElementById('player_gender').focus();
            return false;
        } else {
            jQuery('#player_gender').addClass('validate');
            jQuery('#player_gender').css("box-shadow", "");
            document.getElementById('error_player_gender').innerHTML = "";
            valid = true;
        }
        if (player_date_of_birth_year == "") {
            jQuery('#player_date_of_birth_year').removeClass('validate');
            jQuery('#player_date_of_birth_year').css({"box-shadow": "0px 1px 0px #f4524d"});
            document.getElementById('error_player_date_of_birth_year').innerHTML = "Select Birth Year";
            jQuery('#error_player_date_of_birth_year').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
            document.getElementById('player_date_of_birth_year').focus();
            return false;
        } else {
            jQuery('#player_date_of_birth_year').addClass('validate');
            jQuery('#player_date_of_birth_year').css("box-shadow", "");
            document.getElementById('error_player_date_of_birth_year').innerHTML = "";
            valid = true;
        }

        if (player_date_of_birth_month == "") {
            jQuery('#player_date_of_birth_month').removeClass('validate');
            jQuery('#player_date_of_birth_month').css({"box-shadow": "0px 1px 0px #f4524d"});
            document.getElementById('error_player_date_of_birth_month').innerHTML = "Select Birth Month";
            jQuery('#error_player_date_of_birth_month').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
            document.getElementById('player_date_of_birth_month').focus();
            return false;
        } else {
            jQuery('#player_date_of_birth_month').addClass('validate');
            jQuery('#player_date_of_birth_month').css("box-shadow", "");
            document.getElementById('error_player_date_of_birth_month').innerHTML = "";
            valid = true;
        }

        if (player_date_of_birth_day == "") {
            jQuery('#player_date_of_birth_day').removeClass('validate');
            jQuery('#player_date_of_birth_day').css({"box-shadow": "0px 1px 0px #f4524d"});
            document.getElementById('error_player_date_of_birth_day').innerHTML = "Select Birth Day";
            jQuery('#error_player_date_of_birth_day').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
            document.getElementById('player_date_of_birth_day').focus();
            return false;
        } else {
            jQuery('#player_date_of_birth_day').addClass('validate');
            jQuery('#player_date_of_birth_day').css("box-shadow", "");
            document.getElementById('error_player_date_of_birth_day').innerHTML = "";
            valid = true;
        }

        if (parent_first_name == "") {
            jQuery('#parent_first_name').removeClass('validate');
            jQuery('#parent_first_name').css({"box-shadow": "0px 1px 0px #f4524d"});
            document.getElementById('error_parent_first_name').innerHTML = "Enter Guaridian's First Name";
            jQuery('#error_parent_first_name').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
            document.getElementById('parent_first_name').focus();
            return false;
        } else {
            jQuery('#parent_first_name').addClass('validate');
            jQuery('#parent_first_name').css("box-shadow", "");
            document.getElementById('error_parent_first_name').innerHTML = "";
            valid = true;
        }
        
        if (parent_last_name == "") {
            jQuery('#parent_last_name').removeClass('validate');
            jQuery('#parent_last_name').css({"box-shadow": "0px 1px 0px #f4524d"});
            document.getElementById('error_parent_last_name').innerHTML = "Enter Guaridian's Last Name";
            jQuery('#error_parent_last_name').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
            document.getElementById('parent_last_name').focus();
            return false;
        } else {
            jQuery('#parent_last_name').addClass('validate');
            jQuery('#parent_last_name').css("box-shadow", "");
            document.getElementById('error_parent_last_name').innerHTML = "";
            valid = true;
        }
        var player_email = document.getElementById("player_email").value;
        response = false;
        if (player_email == "") {
            jQuery('#player_email').removeClass('validate');
            jQuery('#player_email').css({"box-shadow": "0px 1px 0px #f4524d"});
            document.getElementById('error_player_email').innerHTML = "Enter Email Address";
            jQuery('#error_player_email').css({"color": "red","text-transform": "capitalize","font-size": "13px","float": "left","margin-top": "5px"});
            document.getElementById('player_email').focus();
            return false;
        } else if (player_email) {
            var validemail = document.getElementById('player_email');
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(validemail.value)) {
            validemail.value = "";
            jQuery('#player_email').css({"box-shadow": "0px 1px 0px #f4524d"});
            document.getElementById('error_player_email').innerHTML = "Enter Valid Email Address";
            jQuery('#error_player_email').css({"color": "red","font-size": "13px","float": "left","margin-top":"5px"});
            document.getElementById('player_email').focus();
            return false;
            } else {
                jQuery('#player_email').addClass('validate');
                jQuery('#player_email').css("box-shadow", "");
                document.getElementById('error_player_email').innerHTML = "";
                valid = true;
            }
        }
        if (player_contact_number == "") {
            jQuery('#player_contact_number').removeClass('validate');
            jQuery('#player_contact_number').css({"box-shadow": "0px 1px 0px #f4524d"});
            document.getElementById('error_player_contact_number').innerHTML = "Enter Phone Number";
            jQuery('#error_player_contact_number').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
            document.getElementById('player_contact_number').focus();
            return false;
        } else if (player_contact_number) {
            var validecontact= document.getElementById('player_contact_number');
            var filter = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
            if (!filter.test(validecontact.value)) {
                validecontact.value = "";
                jQuery('#player_contact_number').css({"box-shadow": "0px 1px 0px #f4524d"});
            document.getElementById('error_player_contact_number').innerHTML = "Enter Valid Phone Number (xxx)xxx xxxx";
            jQuery('#error_player_contact_number').css({"color": "red","font-size": "13px","float": "left","margin-top":"5px"});
            document.getElementById('player_contact_number').focus();
            return false;
            } else {
                jQuery('#player_contact_number').addClass('validate');
                jQuery('#player_contact_number').css("box-shadow", "");
                document.getElementById('error_player_contact_number').innerHTML = "";
                valid = true;
            }
			if(team_registration == "off" && private_training == "off" && summer_training == "off" && fall_session == "off" && winter_session == "off" && spring_sessions == "off"){
            document.getElementById('error_program_select').innerHTML = "Choose At least One Program";
            jQuery('#error_program_select').css({"margin-bottom": "7px"});
            document.getElementById('team_registration').focus();
            return false;
	        }
	   else{
		     document.getElementById('error_program_select').innerHTML = "";
            jQuery('#error_program_select').css({"margin-bottom": "0"});
	      valid = true;
	   }
        }
        if (valid) {
            return true;
        }
    }

	function validate_player_first_name(){
    var player_first_name = document.getElementById("player_first_name").value;
    if (player_first_name == "") {
        jQuery('#player_first_name').removeClass('validate');
        jQuery('#player_first_name').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_player_first_name').innerHTML = "Enter Player First Name";
        jQuery('#error_player_first_name').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
        return false;
    } else {
        jQuery('#player_first_name').addClass('validate');
        jQuery('#player_first_name').css("box-shadow", "");
        document.getElementById('error_player_first_name').innerHTML = "";
        valid = true;
    }
    if (valid) {
        return true;
    }
}
function validate_player_last_name(){
    var player_last_name = document.getElementById("player_last_name").value;
    if (player_last_name == "") {
        jQuery('#player_last_name').removeClass('validate');
        jQuery('#player_last_name').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_player_last_name').innerHTML = "Enter Player Last Name";
        jQuery('#error_player_last_name').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
        return false;
    } else {
        jQuery('#player_last_name').addClass('validate');
        jQuery('#player_last_name').css("box-shadow", "");
        document.getElementById('error_player_last_name').innerHTML = "";
        valid = true;
    }
    if (valid) {
        return true;
    }
}
function validate_parent_first_name(){
    var parent_first_name = document.getElementById("parent_first_name").value;
    if (parent_first_name == "") {
        jQuery('#parent_first_name').removeClass('validate');
        jQuery('#parent_first_name').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_parent_first_name').innerHTML = "Enter Guaridian's First Name";
        jQuery('#error_parent_first_name').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
        return false;
    } else {
        jQuery('#parent_first_name').addClass('validate');
        jQuery('#parent_first_name').css("box-shadow", "");
        document.getElementById('error_parent_first_name').innerHTML = "";
        valid = true;
    }
    if (valid) {
        return true;
    }
}
function validate_parent_last_name(){
    var parent_last_name = document.getElementById("parent_last_name").value;
    if (parent_last_name == "") {
        jQuery('#parent_last_name').removeClass('validate');
        jQuery('#parent_last_name').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_parent_last_name').innerHTML = "Enter Guaridian's Last Name";
        jQuery('#error_parent_last_name').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
        return false;
    } else {
        jQuery('#parent_last_name').addClass('validate');
        jQuery('#parent_last_name').css("box-shadow", "");
        document.getElementById('error_parent_last_name').innerHTML = "";
        valid = true;
    }
    if (valid) {
        return true;
    }
}
function validate_player_date_of_birth_year(){
    var player_date_of_birth_year = document.getElementById("player_date_of_birth_year").value;
    if (player_date_of_birth_year == "") {
        jQuery('#player_date_of_birth_year').removeClass('validate');
        jQuery('#player_date_of_birth_year').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_player_date_of_birth_year').innerHTML = "Select Birth Year";
        jQuery('#error_player_date_of_birth_year').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
        return false;
    } else {
        jQuery('#player_date_of_birth_year').addClass('validate');
        jQuery('#player_date_of_birth_year').css("box-shadow", "");
        document.getElementById('error_player_date_of_birth_year').innerHTML = "";
        valid = true;
    }
    if (valid) {
        return true;
    }
}
function validate_player_date_of_birth_month(){
    var player_date_of_birth_month = document.getElementById("player_date_of_birth_month").value;
    if (player_date_of_birth_month == "") {
        jQuery('#player_date_of_birth_month').removeClass('validate');
        jQuery('#player_date_of_birth_month').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_player_date_of_birth_month').innerHTML = "Select Birth Month";
        jQuery('#error_player_date_of_birth_month').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
        return false;
    } else {
        jQuery('#player_date_of_birth_month').addClass('validate');
        jQuery('#player_date_of_birth_month').css("box-shadow", "");
        document.getElementById('error_player_date_of_birth_month').innerHTML = "";
        valid = true;
    }
    if (valid) {
        return true;
    }
}
function validate_player_date_of_birth_day(){
    var player_date_of_birth_day = document.getElementById("player_date_of_birth_day").value;
    if (player_date_of_birth_day == "") {
        jQuery('#player_date_of_birth_day').removeClass('validate');
        jQuery('#player_date_of_birth_day').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_player_date_of_birth_day').innerHTML = "Select Birth Day";
        jQuery('#error_player_date_of_birth_day').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
        return false;
    } else {
        jQuery('#player_date_of_birth_day').addClass('validate');
        jQuery('#player_date_of_birth_day').css("box-shadow", "");
        document.getElementById('error_player_date_of_birth_day').innerHTML = "";
        valid = true;
    }
    if (valid) {
        return true;
    }
}
function validate_player_email(){
    var player_email = document.getElementById("player_email").value;
    response = false;
    if (player_email == "") {
        jQuery('#player_email').removeClass('validate');
        jQuery('#player_email').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_player_email').innerHTML = "Enter email address";
        jQuery('#error_player_email').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
        return false;
    } else if (player_email) {
        var validemail = document.getElementById('player_email');
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(validemail.value)) {
        //validemail.value = "";
        jQuery('#player_email').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_player_email').innerHTML = "Enter valid email address";
        jQuery('#error_player_email').css({"color": "red","font-size": "13px","float": "left","margin-top":"5px"});
        return false;
        } else {
            jQuery('#player_email').addClass('validate');
            jQuery('#player_email').css("box-shadow", "");
            document.getElementById('error_player_email').innerHTML = "";
            valid = true;
        }
      }
    if (valid) {
        return true;
    }
}
function validate_player_contact_number(){
    var player_contact_number = document.getElementById("player_contact_number").value;
    if (player_contact_number == "") {
        jQuery('#player_contact_number').removeClass('validate');
        jQuery('#player_contact_number').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_player_contact_number').innerHTML = "Enter Phone Number";
        jQuery('#error_player_contact_number').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
        return false;
    } else if (player_contact_number) {
        var validecontact= document.getElementById('player_contact_number');
        var filter = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if (!filter.test(validecontact.value)) {
            //validecontact.value = "";
            jQuery('#player_contact_number').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_player_contact_number').innerHTML = "Enter Valid Phone Number (000)000-0000";
        jQuery('#error_player_contact_number').css({"color": "red","font-size": "13px","float": "left","margin-top":"5px"});
        return false;
        } else {
            jQuery('#player_contact_number').addClass('validate');
            jQuery('#player_contact_number').css("box-shadow", "");
            document.getElementById('error_player_contact_number').innerHTML = "";
            valid = true;
        }
    }
    if (valid) {
        return true;
    }
}
function validate_register_message(){
    var register_message = document.getElementById("register_message").value;
    if (register_message == "") {
        jQuery('#register_message').removeClass('validate');
        jQuery('#register_message').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_register_message').innerHTML = "Enter Your Message";
        jQuery('#error_register_message').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
        return false;
    } else {
        jQuery('#register_message').addClass('validate');
        jQuery('#register_message').css("box-shadow", "");
        document.getElementById('error_register_message').innerHTML = "";
        valid = true;
    }
    if (valid) {
        return true;
    }
}
////////////////////////////////////////////////////////////////////////Gender Condition/////////////////
function validate_player_gender(){
    var player_gender = document.getElementById("player_gender").value;
    if (player_gender == "") {
        jQuery('#player_gender').removeClass('validate');
        jQuery('#player_gender').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_player_gender').innerHTML = "Select Gender";
        jQuery('#error_player_gender').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
        return false;
    } else {
        jQuery('#player_gender').addClass('validate');
        jQuery('#player_gender').css("box-shadow", "");
        document.getElementById('error_player_gender').innerHTML = "";
        valid = true;
    }
    if (valid) {
        return true;
    }
}
	
////////////////////////////////////////////////////////////////////////Gender Condition end /////////////////
</script>



    <?php
    return ob_get_clean();
}
add_shortcode('registration_form', 'registration_form_shortcode');










///////////////////////////////Create Register Record//////////////////////////
function create_register_record(){
	global $wpdb;
    parse_str($_POST['formData'], $formParams);
    $table_create_name = 'player_registration'; // Replace with your actual table name
        $player_create_first_name = sanitize_text_field($formParams['player_first_name']);
    // $player_create_first_name = isset($_POST['player_first_name']) ? sanitize_text_field($_POST['player_first_name']);
    $player_create_last_name = isset($formParams['player_last_name']) ? sanitize_text_field($formParams['player_last_name']) : '';
    $player_create_gender = isset($formParams['player_gender']) ? sanitize_text_field($formParams['player_gender']) : '';
    $player_create_date_of_birth_year = isset($formParams['player_date_of_birth_year']) ? intval($formParams['player_date_of_birth_year']) : 0;
    $player_create_date_of_birth_month = isset($formParams['player_date_of_birth_month']) ? intval($formParams['player_date_of_birth_month']) : 0;
    $player_create_date_of_birth_day = isset($formParams['player_date_of_birth_day']) ? intval($formParams['player_date_of_birth_day']) : 0;
    
    $parent_create_first_name = isset($formParams['parent_first_name']) ? sanitize_text_field($formParams['parent_first_name']) : '';
    $parent_create_last_name = isset($formParams['parent_last_name']) ? sanitize_text_field($formParams['parent_last_name']) : '';
    $player_create_email = isset($formParams['player_email']) ? sanitize_email($formParams['player_email']) : '';
    $player_create_contact_number = isset($formParams['player_contact_number']) ? sanitize_text_field($formParams['player_contact_number']) : '';
    $team_create_registration = isset($formParams['team_registration']) ? 'YES' : 'No';
    $private_create_training = isset($formParams['private_training']) ? 'YES' : 'No';
    $fall_create_session = isset($formParams['fall_session']) ? 'YES' : 'No';
    $winter_create_session = isset($formParams['winter_session']) ? 'YES' : 'No';
    $spring_create_sessions = isset($formParams['spring_sessions']) ? 'YES' : 'No';
    
    $summer_create_training = isset($formParams['summer_training']) && $formParams['summer_training'] === 'on' ? 'Yes' : 'No';
    
    $register_create_message = isset($formParams['register_message']) ? sanitize_text_field($formParams['register_message']) : '';
	
        $site_title =  get_bloginfo( 'name' );
        $site_url = get_site_url();
	 $body1 = '<style>
            table, td, div, h1, h3, h5, p {font-family: "Josefin Sans", sans-serif;}        
            </style>
            <body style="margin:0;padding:0;">
                <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#efeff3;max-width:786px;margin:0 auto;">
                    <tr>
                        <td align="center" style="padding:0;padding-top:70px;padding-bottom:0;">
                            <img style="width:170px;" src="'.$site_url.'/wp-content/uploads/2023/09/Layer_1.png">
                            <h3 style="font-size:30px;">Hi '.$player_create_first_name.',</h3>
                            <img style="width:220px;margin:40px 0;" src="https://pcreate-spaces.sgp1.digitaloceanspaces.com/2021/12/email-sign.png">
                            <h3 style="font-size:30px;">Thank You For Registration.</h3>				
                            <p style="margin:30px 0;font-size:20px;max-width:500px;line-height:1.4;">Our representative will get in touch with you shortly.</p>
                            <p style="margin:30px 0;font-size:20px;max-width:500px;line-height:1.4;">Best,<br><a href="'.$site_url.'" style="color:#1e897a;text-decoration:none;" target="_blank">'.$site_title.'</a> Support</p>
                            <img src="https://pcreate-spaces.sgp1.digitaloceanspaces.com/2021/12/footer.png">
                        </td>
                    </tr>
                </table>
            </body>';
    $body = 'Player First Name: '.$player_create_first_name.'&nbsp;<br>
            Player Last Name: '.$player_create_last_name.'&nbsp;<br>
			Player Gender: '.$player_create_gender.'&nbsp;<br>
            Player Birth Date: '.$player_create_date_of_birth_year.'-'.$player_create_date_of_birth_month.'-'.$player_create_date_of_birth_day.'&nbsp;<br>
            Legal Guardian First Name: '.$parent_create_first_name.'&nbsp;<br>
            Legal Guardian Last Name: '.$parent_create_last_name.'&nbsp;<br>
            Email: '.$player_create_email.'&nbsp;<br>
            Phone Number: '.$player_create_contact_number.'&nbsp;<br>
            Team Register: '.$team_create_registration.'&nbsp;<br>
            Private Training: '.$private_create_training.'&nbsp;<br>
            Summer Training: '.$summer_create_training.'&nbsp;<br>
           Fall Session: '.$fall_create_session.'&nbsp;<br>
            Winter Session: '.$winter_create_session.'&nbsp;<br>
		   Spring Sessions: '.$spring_create_sessions.'&nbsp;<br>
		   Message: '.$register_create_message.'&nbsp;<br><br>
            This e-mail was sent from a contact form on '.$site_title.' '.$site_url;
	
	
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: '.$site_title.' <admin@risefcsoccer.com>';
    $headers[] = 'Reply-To: '.$to;
    $to='tanvir@genxintegratedsystems.com';
// 	$to='ahmed@genxintegratedsystems.com';
    $user_subject="Thank You For Registration!";
	$subject="New Registration!";
    $is_mail_sent = wp_mail($to, $subject, $body,$headers,$attachments); 
	 $headers2[] = 'Content-Type: text/html; charset=UTF-8';
    $headers2[] = 'From: '.$site_title.' <register@risefcsoccer.com>';
    $headers2[] = 'Reply-To: register@risefcsoccer.com';
	$attachments2 = null;
	    $is_mail_sent_2 = wp_mail($player_create_email, $user_subject, $body1,$headers2,$attachments2); 
    
        
    /////////////////////////////////////////////////////Register Form Db Submittion /////////////////
    
    
    $insert_create_data = array(
        'player_first_name' => $player_create_first_name,
        'player_last_name' => $player_create_last_name,
        'player_date_of_birth_year' => $player_create_date_of_birth_year,
        'player_date_of_birth_month' => $player_create_date_of_birth_month,
        'player_date_of_birth_day' => $player_create_date_of_birth_day,
        'player_gender' => $player_create_gender,
        'parent_first_name' => $parent_create_first_name,
        'parent_last_name' => $parent_create_last_name,
        'player_email' => $player_create_email,
        'player_contact_number' => $player_create_contact_number,
        'team_registration' => $team_create_registration,
        'private_training' => $private_create_training,
        'fall_session' => $fall_create_session,
        'winter_session' => $winter_create_session,
        'spring_sessions' => $spring_create_sessions,
        'summer_training' => $summer_create_training,
        'register_message' => $register_create_message,
    );

    ob_start(); // Start output buffering for JSON response
    // var_dump($_POST);
    $create_result = $wpdb->insert($table_create_name, $insert_create_data);
    if ($create_result !== false && $is_mail_sent != false) {
        $success = 'Thank You For Registration.';
        echo json_encode(array('status' => 1, 'message' => $success));
    } else {
        $failed = 'There was an error trying to send your message. Please try again later.';
        echo json_encode(array('status' => 0, 'message' => $failed));
    }

    wp_die(); // End processing and exit

    ob_end_clean(); // Clean the output buffer
}

add_action('wp_ajax_create_register_record', 'create_register_record');
add_action('wp_ajax_nopriv_create_register_record', 'create_register_record');

function contact_form_shortcode() {
    ob_start(); ?>
<style>
	.contact{background: transparent !important;
    box-shadow: none !important;
    padding: 0 !important;}
	.form input,textarea{
		border-radius: 6px;
border: 1px solid #112E1C;
background: #FFF;
	}
	.btn-contact-bg{
		  background: #112E1C;
    color: #E7A52F;
text-align: center;
font-family: Inter;
font-size: 16px;
font-style: normal;
font-weight: 700;
line-height: normal;
    padding: 9px 40px;
    border-radius: 10px;
    pointer-events: bounding-box;
    box-shadow: #212529 2px 2px 0 0, #fff 2px 2px 0 1px;
    text-transform: capitalize;
	}
	.form textarea{
		
min-height: 104px !important;
		height:0px !important;
	}
	.form label{
		padding-left:8px;
		color: #FFF;
font-family: Inter;
font-size: 16px;
font-style: normal;
font-weight: 500;
line-height: normal;
	}
		.hide {
    display: none;
}
	.danger{
		color:#FF0000;
	}
	.alert{
		margin-top: 30px;
	}
	.alert-success {
    color: #000000 !important;
    background-color: #E7A52F !important;
    border-color: #112E1C !important;
    max-width: fit-content !important;
}
</style>
<div class="contact" >
					<form id="signup" class="form" name="contact-us"  onkeypress="return event.keyCode != 13;" autocomplete="off" enctype="multipart/form-data" novalidate>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="first_name">Name <span class="danger">*</span></label>
								<input type="text" name="first_name" id="first_name" class="form-control" placeholder="" required="required" onfocusout="validate_first_name();">
								<span id="error_first_name"></span>
							</div>
							
						
                            <div class="form-group col-md-12">
								<label for="email">Email <span class="danger">*</span></label>
								<input type="email" name="email" id="email" class="form-control" placeholder="" required="required" onfocusout="validate_email();">
								<span id="error_email"></span>
							</div>
							<div class="form-group col-md-12">
								<label for="message">Your Message <span class="danger">*</span></label>
								<textarea rows="6" name="message" id="message" class="form-control" placeholder=""  onfocusout="validate_message();"></textarea>
								<span id="error_message"></span>
							</div>
							<div class="col-md-12">
								<input type="hidden" name="action" value="vendor_signup_form_submit" id="action" />
								<button type="submit"  name="next" id="third_step_process" class="vendor_submit btn btn-contact-bg" value="Submit">Send</button>
							</div>
						</div>
					</form>
					<div id="contact-success" class="contact-success hide">
    					<div class="col-md-12">
    						<div id="contact-alert-success" class="alert hide alert-success">
    							<strong>Success!</strong> Indicates a successful or positive action.
    						</div>
    					</div>
    					<div class="col-md-12">
    						<div id="contact-alert-fail" class="alert hide alert-danger">
    							<strong>Success!</strong> Indicates a successful or positive action.
    						</div>
    					</div>
    				</div>
				</div>
<!-- 
jquery Requestes
-->
<script>
jQuery(document).ready(function($){
	$(".vendor_submit").click(function(e) {
        e.preventDefault();
        var response = validate_step_3();
        if (response == true) {
            document.getElementById("third_step_process").innerText = 'Send';
            $('.wpcf7-response-output').hide();
            // $('#signup').on("submit", function(e) {
                e.preventDefault();
                    $('#third_step_process').prop('disabled', true);
                    $.ajax({
                        type: "POST",
                        dataType: 'json',
                        url: '<?php echo admin_url('admin-ajax.php');  ?>',
                         data: {
        action: 'create_contact_record', // This should match the WordPress AJAX action
        contactData: $("#signup").serialize()
    },
                        success: function(data) {
                            if(data.status == 1 ){
                                $('#third_step_process').prop('disabled', false);
                                document.getElementById("third_step_process").innerText = 'Sent';
                                document.getElementById("signup").reset();
                                document.getElementById("contact-alert-success").innerText = data.message;
                                $('#contact-success').show();
                                $('#contact-alert-success').show();
                                $('#contact-alert-fail').hide();
                            }else{
                                $('#third_step_process').prop('disabled', false);
                                document.getElementById("third_step_process").innerText = 'Sent';
                                document.getElementById("contact-alert-fail").innerText = data.message;
                                $('#contact-success').show();
                                $('#contact-alert-success').hide();
                                $('#contact-alert-fail').show();
                                // $('#thank-you').hide();
                                // $('#signup').show();
                                // $('.wpcf7-response-output').show();
                                // $('.wpcf7-response-output').innerText = data.message;
                            }
                        }
                    });
            // });
        }
    });
	});
	function validate_step_3(){
        var first_name = document.getElementById("first_name").value;
        var email = document.getElementById("email").value;
        var message = document.getElementById("message").value;
        if (first_name == "") {
            jQuery('#first_name').removeClass('validate');
            jQuery('#first_name').css({"box-shadow": "0px 1px 0px #f4524d"});
            document.getElementById('error_first_name').innerHTML = "Enter your Name";
            jQuery('#error_first_name').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
            document.getElementById('first_name').focus();
            return false;
        } else {
            jQuery('#first_name').addClass('validate');
            jQuery('#first_name').css("box-shadow", "");
            document.getElementById('error_first_name').innerHTML = "";
            valid = true;
        }
        
        if (email == "") {
            jQuery('#email').removeClass('validate');
            jQuery('#email').css({"box-shadow": "0px 1px 0px #f4524d"});
            document.getElementById('error_email').innerHTML = "Enter email address";
            jQuery('#error_email').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
            document.getElementById('email').focus();
            return false;
        } else if (email) {
            var validemail = document.getElementById('email');
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(validemail.value)) {
            validemail.value = "";
            jQuery('#email').css({"box-shadow": "0px 1px 0px #f4524d"});
            document.getElementById('error_email').innerHTML = "Enter valid email address";
            jQuery('#error_email').css({"color": "red","font-size": "13px","float": "left","margin-top":"5px"});
            document.getElementById('email').focus();
            return false;
            } else {
                jQuery('#email').addClass('validate');
                jQuery('#email').css("box-shadow", "");
                document.getElementById('error_email').innerHTML = "";
                valid = true;
            }
        }
        
        
        if (valid) {
            return true;
        }
    }
	function validate_first_name(){
    var first_name = document.getElementById("first_name").value;
    if (first_name == "") {
        jQuery('#first_name').removeClass('validate');
        jQuery('#first_name').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_first_name').innerHTML = "Enter your Name";
        jQuery('#error_first_name').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
        return false;
    } else {
        jQuery('#first_name').addClass('validate');
        jQuery('#first_name').css("box-shadow", "");
        document.getElementById('error_first_name').innerHTML = "";
        valid = true;
    }
    if (valid) {
        return true;
    }
}
	function validate_email(){
    var email = document.getElementById("email").value;
    response = false;
    if (email == "") {
        jQuery('#email').removeClass('validate');
        jQuery('#email').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_email').innerHTML = "Enter email address";
        jQuery('#error_email').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
        return false;
    } else if (email) {
        var validemail = document.getElementById('email');
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(validemail.value)) {
        //validemail.value = "";
        jQuery('#email').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_email').innerHTML = "Enter valid email address";
        jQuery('#error_email').css({"color": "red","font-size": "13px","float": "left","margin-top":"5px"});
        return false;
        } else {
            jQuery('#email').addClass('validate');
            jQuery('#email').css("box-shadow", "");
            document.getElementById('error_email').innerHTML = "";
            valid = true;
        }
      }
    if (valid) {
        return true;
    }
}
	function validate_message(){
    var message = document.getElementById("message").value;
    if (message == "") {
        jQuery('#message').removeClass('validate');
        jQuery('#message').css({"box-shadow": "0px 1px 0px #f4524d"});
        document.getElementById('error_message').innerHTML = "Enter Your Message";
        jQuery('#error_message').css({"color": "red","font-size": "13px","float": "left","margin-top": "5px"});
        return false;
    } else {
        jQuery('#message').addClass('validate');
        jQuery('#message').css("box-shadow", "");
        document.getElementById('error_message').innerHTML = "";
        valid = true;
    }
    if (valid) {
        return true;
    }
}
</script>
<?php
    return ob_get_clean();
}
add_shortcode('contact_form', 'contact_form_shortcode');



function create_contact_record(){
	parse_str($_POST['contactData'], $contactParams);
	
	 $first_name = ( ! empty( $contactParams['first_name'] ) ) ? sanitize_text_field( $contactParams['first_name'] ) : '';
		$email = ( ! empty( $contactParams['email'] ) ) ? sanitize_text_field( $contactParams['email'] ) : '';
        $message = ( ! empty( $contactParams['message'] ) ) ? sanitize_text_field( $contactParams['message'] ) : '';
        $site_title =  get_bloginfo( 'name' );
        $site_url = get_site_url();
	
	///////////////////////////////Db Submission///////////////////

        global $wpdb;
        $contact_table_name ='contact_form';
        $contactdata = array(
            'first_name' => $first_name,
            'email' => $email,
            'message' => $message,
        );
$contactsubmitresult =   $wpdb->insert($contact_table_name, $contactdata);
	 $body3 = 'First Name: '.$first_name.'&nbsp;<br>
            Email: '.$email.'&nbsp;<br>
            Message: '.$message.'&nbsp;<br><br> 
            This e-mail was sent from a contact form on '.$site_title.' '.$site_url; 
	
        $body4 = '<style>
            table, td, div, h1, h3, h5, p {font-family: "Josefin Sans", sans-serif;}        
            </style>
            <body style="margin:0;padding:0;">
                <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#efeff3;max-width:786px;margin:0 auto;">
                    <tr>
                        <td align="center" style="padding:0;padding-top:70px;padding-bottom:0;">
                            <img style="width:170px;" src="'.$site_url.'/wp-content/uploads/2023/09/Layer_1.png">
                            <h3 style="font-size:30px;">Hi '.$first_name.',</h3>
                            <img style="width:220px;margin:40px 0;" src="https://pcreate-spaces.sgp1.digitaloceanspaces.com/2021/12/email-sign.png">
                            <h3 style="font-size:30px;">Thank You For Contacting Us!</h3>				
                            <p style="margin:30px 0;font-size:20px;max-width:500px;line-height:1.4;">Our representative will get in touch with you shortly.</p>
                            <p style="margin:30px 0;font-size:20px;max-width:500px;line-height:1.4;">Best,<br><a href="'.$site_url.'" style="color:#1e897a;text-decoration:none;" target="_blank">'.$site_title.'</a> Support</p>
                            <img src="https://pcreate-spaces.sgp1.digitaloceanspaces.com/2021/12/footer.png">
                        </td>
                    </tr>
                </table>
            </body>';
	$user_subject="Thank You For Contacting Us!";
	
    $headers4[] = 'Content-Type: text/html; charset=UTF-8';
    $headers4[] = 'From: '.$site_title.' <info@risefcsoccer.com>';
    $headers4[] = 'Reply-To: info@risefcsoccer.com';
    //$to='usmanrashid074@gmail.com';
    $is_mail_sent = wp_mail($email, $user_subject, $body4,$headers4,$attachments = null); 
	
	
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: '.$site_title.' <admin@risefcsoccer.com>';
    $headers[] = 'Reply-To: '.$to;
    $to='tanvir@genxintegratedsystems.com';
// 	$to='ahmed@genxintegratedsystems.com';
    $subject= "Contact Us Form New Record";
    $is_mail_sent3 = wp_mail($to, $subject, $body3,$headers,$attachments); 
            if( $contactsubmitresult && $is_mail_sent3){
                $success = 'Thank You For Contacting Us.';
                echo json_encode(array('status'=>1,'message'=>$success,'vendor_mail'=>$is_vendor_mail_send,'user_mail'=>$is_user_mail_send));
                wp_die();
            }else{
                $failed  ='There was an error trying to send your message. Please try again later.';
                echo json_encode(array('status'=>0,'message'=>$failed));
                wp_die();
            }
        die();
}

add_action('wp_ajax_create_contact_record', 'create_contact_record');
add_action('wp_ajax_nopriv_create_contact_record', 'create_contact_record');

/* Search Module */

function searchmodule() {
    ob_start(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
.searchbody{
  
    margin-top: 5%;
    border-radius: 10px;
    border: 3px solid #112E1C;
    background: rgba(217, 217, 217, 0.50);
    backdrop-filter: blur(6px);
}
.searchbody .heading{
    position: relative;
    padding-top: 41px;
    color: #112E1C;
text-align: center;
font-size: 25px;
font-weight: 700;
line-height: 89.023%; 
	display:flex;
	justify-content:center;
	align-items:center;
}
.searchbody .heading .headingh3{
	width: fit-content;
    position: relative;
}
.searchbody .heading .headingh3:before{
    top: 42%;
    left: -30%;
    content: "";
    width: 61px;
height: 3px;
background: #112E1C;
position: absolute;
}

.searchbody .heading .headingh3:after{
    top: 42%;
    right: -30%;
    content: "";
    width: 61px;
height: 3px;
background: #112E1C;
position: absolute;
}
.searchbody .searchcontent{
    position: relative;
    padding: 47px;
    width: 100%;
display: flex;
justify-content: center;
align-items: center;
text-align: center;
gap: 28px;
}
.searchlabel{
    color: #112E1C;
font-size: 18px;
font-weight: 600;
line-height: 89.023%; 
letter-spacing: -0.72px;
}
.searchbody .option{
    padding: 45px 0 0 0;
    color: #0A2E19;
text-align: center;
font-size: 25px;
font-weight: 500;
}
		.searchbody .option h3{
			margin:0 !important;
		}
.searchselect{
	appearance:auto;
    font-size: 18px;
    width: 12vw;
    border-radius: 5px !important;
border: 1px solid #112E1C !important;
background: #FFF;
}
.search1,.search2{

    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap:17px;
}
.searchbtn{
    width: 100%;
    text-align: center;
}
.searchbtn #searchBtn{
  
    background: #112E1C;
    color: #E7A52F;
text-align: center;
font-family: Inter;
font-size: 16px;
font-weight: 700;
padding: 10px 28px;
border: none;
cursor: pointer;
	text-transform:capitalize;
	 box-shadow: #919191 2px 2px 0 0, #121212 2px 2px 0 1px !important;
    border-radius: 10px !important;


}
.searchbtn #searchBtn:hover{
    background-color: #E7A52F;
    color: #0A2E19;
	   
}
.searchresult{
    padding-top: 40px;
    width: 100%;
    text-align: center;
}
.resulthead{
    padding: 0 0 48px 0;
    color: #112E1C;
    font-size: 18px;
    font-weight: 600;
    line-height: 89.023%; 
    letter-spacing: -0.72px;
}
.programresultcontent{
    justify-content: center;
    align-items: center;
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    width: 100%;
}
.programslot{
  border-radius: 10px;
border: 2px solid #112E1C;
background: rgba(255, 255, 255, 0.25);
    gap: 7px;
    /*display: none;*/
    justify-content: center;
    /* align-items: center; */
    flex-direction: column;
    width: 19vw;
	margin-bottom:5%;
}
.programimg{
margin:auto;
    overflow: hidden;
	border-radius:6px 6px 0 0;
}
		
.searcherrors{
    padding: 10px;
    color: rgb(255, 0, 0);
    font-weight: 400;
}
.programimg img{
	
    transition: transform 0.5s linear;
		
}
.tan-btn-1  {
	transition:0.3s opacity ease;
   opacity:0;
   max-width: fit-content !important;
   margin: auto auto 20px auto !important;
	background: #112E1C !important;
    color: #fff !important;
   
}
		.tan-btn-1 {
box-shadow: #919191 2px 2px 0 0, #121212 2px 2px 0 1px !important;
			 border-radius: 10px !important;
}
.programslot:hover .tan-btn-1 {
  opacity:1;
}
	
.programimg:hover img{
    transform: scale(1.2);
}
.programslot .programname{
	padding-top: 10px;
    width: 100%;
    overflow: hidden;
    word-wrap:wrap;
    color: #000;
font-size: 20px;
font-weight: 700;
text-align: center;
	margin:0 !important;
}
.programslot .programages{
    color: #000;
font-size: 15px;
font-weight: 400;
text-align: center;
	margin:0 !important;
}
.programslot .programdescription{
	    margin-bottom: 02px;
    color: #000;
text-align: center !important;
font-size: 16px;
font-weight: 300;
padding: 10px;
}
.programslot .programmorelink{
    color: #000;
    text-align: right;
    font-family: Inter;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    text-decoration: none;
	padding-left: 14px !important;
}
.programreadlink{
display: flex;
justify-content: start;
width: 100%;
		}
		.programslot .tan-btn-1 a{
			color:#fff;
		}
		.programslot .tan-btn-1{
		    padding: 5px 20px 5px 20px !important;
		}
		@media (max-width: 1150px) {
			.searchselect{
				width:18vw;
			}
			.programslot{
				    width: 30vw ;
			}
}
		@media screen and (max-width: 769px) {
  /* Your CSS rules for screens with a maximum width of 767 pixels go here */
			.searchselect {
    width: 27vw;
			}
			.searchbody .heading .headingh3:before{
				left:20%;
			}
			.searchbody .heading .headingh3:after{
				right:20%;
			}
			.programslot {
				width:40vw;
			}
			.searchbody .heading .headingh3:before{
				display:none;
				
			}
			.searchbody .heading .headingh3:after{
				display:none;
			}
}
		@media screen and (max-width: 425px) {
			.programslot {
				width:80vw;
			}
			.searchbody .searchcontent{
				flex-direction:column;
			}
			.searchbody .option{
				padding:0;
			}
			.searchselect {
    width: 65vw;
}
			.searchbody .searchcontent{
				padding:20px;
			}
			.searchlabel{
				margin:0;
			}
			.searchbody .heading .headingh3:before{
				display:none;
			}
			.searchbody .heading .headingh3:after{
				display:none;
			}
			.resulthead {
				padding: 0 0 15px 0;
			}
		}
    </style>
    <div class="searchbody">
        <div class="heading">
            <h3 class="headingh3">Find Your Child’s Program</h3>
        </div>
        <!--Search Entry-->
        <div class="searchcontent">
            <div class="search1">
                <div class="search1label">
                    <h3 class="searchlabel">Birth Year</h3>
                </div>
                <select name="birthYear" class="searchselect" id="birthYear">
                    <option value="">Birth Year</option>
                </select>
            </div>
            <div class="option">
                <h3>or</h3>
            </div>
            <div class="search2">
                <h3 class="searchlabel">Age (years)</h3>

                <select name="ageYears" class="searchselect" id="ageYears">
                    <option value="">Age</option>
                </select>
            </div>
        </div>
        <div class="searchbtn">
            <button id="searchBtn">
                Search
            </button>
            <div class="searcherrors" id="searchErrors">
            </div>
        </div>
        <!--Search Data-->
        <div class="searchresult">
            <h4 class="resulthead">Programs Your Child Is Eligible For:</h4>
            <div class="programresultcontent">
                <div class="programslot programslot1">
                    <div class="programimg">
                        <img src="https://jumnah.net/wp-content/uploads/2023/09/img-3.png" alt="risingstars">
                    </div>
                    <h3 class="programname">Rising Stars</h3>
                    <h4 class="programages">U5 - U8</h4>
                    <p class="programdescription">Expert coaches provide age-appropriate drills, tactical sessions, and
                        friendly matches to boost confidence and passion for the sport. It's a fantastic opportunity for
                        young players to enhance their abilities and create lasting memories on the field.</p>
                        <div class="tan-btn-1">
                    <a href="#" class="programmorelink">Learn More </a>
                    </div>
                </div>
                <div class="programslot programslot2">
                    <div class="programimg">
                        <img src="https://jumnah.net/wp-content/uploads/2023/09/img-1.png" alt="risingstars">
                    </div>
                    <h3 class="programname">Academy Teams</h3>
                    <h4 class="programages">U8 - U19</h4>
                    <p class="programdescription">Expert coaches provide age-appropriate drills, tactical sessions, and friendly matches to boost confidence and passion for the sport. It's a fantastic opportunity for young players to enhance their abilities and create lasting memories on the field.</p>
                        <div class="tan-btn-1">
                    <a href="#" class="programmorelink">Learn More </a></div>
                   
                </div>
                <div class="programslot programslot3">
                    <div class="programimg">
                        <img src="https://jumnah.net/wp-content/uploads/2023/09/img-2.png" alt="risingstars">
                    </div>
                    <h3 class="programname">Youth Soccer <br>
                        Winter Camp</h3>
                    
                    <p class="programdescription">Expert coaches provide age-appropriate drills, tactical sessions, and
                        friendly matches to boost confidence and passion for the sport. It's a fantastic opportunity for
                        young players to enhance their abilities and create lasting memories on the field.</p>
                        <div class="tan-btn-1">
                    <a href="#" class="programmorelink">Learn More </a></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
const selectElement = document.getElementById("birthYear");
for (let year = "2019"; year >= 2005; year--) {
    const option = document.createElement("option");
    option.value = year;
    option.text = year;
    selectElement.appendChild(option);
}
const selectElement2 = document.getElementById("ageYears");
for (let age = 4; age <= 18; age++) {
    const option = document.createElement("option");
    option.value = age;
    option.text = age;
    selectElement2.appendChild(option);
}
$(document).ready(function () {
    $("#searchBtn").click(function (e) {
        e.preventDefault();
 $(".programslot").css("display", "none");
        var birthyear = $("#birthYear").val();
        var age2 = $("#ageYears").val();
        // Calculate age1 based on birth year
        var age1;
        const currentYear = new Date().getFullYear();
        if (birthyear == "") {
            age1 = "";
        } else {
            age1 = currentYear - birthyear;
        }
        // Display error messages or process based on conditions
        if (age1 == "" && age2 == "") {
            $("#searchErrors").html("Select Age Or Birth Year");
        } else if (age1 != "" && age2 != "") {
            if (age1 != age2) {
                $("#searchErrors").html("Select Same Age And Birth Year");
            } else {
                $("#searchErrors").html("");
                var resultage1 = age1;
                if (resultage1 == 4) {
                    $(".programslot1").css("display", "flex");
                } else if (resultage1 == 5) {
                    $(".programslot2").css("display", "flex");
                } else if (resultage1 == 6) {
                    $(".programslot3").css("display", "flex");
                } else {
                    $("#searchErrors").html("No Programs Found");
                } 
            }
        } else {
            $("#searchErrors").html("");
            var resultage1;

            if (age1 != "") {
                resultage1 = age1;
            }
            if (age2 != "") {
                resultage1 = age2;
            }
            console.log(resultage1);
            
            if (resultage1 == 4) {
                  $(".programslot1").css("display", "flex");
                  
             
            } else if (resultage1 == 5) {
                $(".programslot2").css("display", "flex");
                 
               
            } else if (resultage1 == 6) {
                $(".programslot3").css("display", "flex");
                
               
            } else {
               $("#searchErrors").html("No Programs Found");
            }
        }
    });
});
    </script>
<?php
    return ob_get_clean();
}
add_shortcode('searchmodule', 'searchmodule');

