<?php
require_once('../config_session.php');
if(!guestCanRegister()){
	echo 0;
	die();
}
?>
<style>
	#pswd_info {
		position: relative;
		bottom: -8px;
		width: 100%;
		padding: 15px;
		background: #fefefe;
		font-size: .875em;
		border-radius: 5px;
		box-shadow: 0 1px 3px #ccc;
		border: 1px solid #ddd;
		margin: 0 0 20px 0;
	}

	#pswd_info h4 {
		margin: 0 0 10px 0;
		padding: 0;
		font-weight: normal;
	}

	#pswd_info::before {
		content: "\25B2";
		position: absolute;
		top: -12px;
		left: 50%;
		font-size: 14px;
		line-height: 14px;
		color: #ddd;
		text-shadow: none;
		display: block;
	}

	.invalid {
		line-height: 24px;
		color: red;
	}

	.valid {
		line-height: 24px;
		color: #3a7d34;
	}
	#pswd_info ul {
		display:grid;
	}

	#pswd_info {
		display: none;
	}
</style>
<div class="pad_box" id="guest_register">
	<div class="boom_form">
		<div class="setting_element">
			<p class="label"><?php echo $lang['username']; ?></p>
			<input type="text" <?php if(validName($data['user_name'])){ echo ' value="' . $data['user_name'] . '" '; } ?> id="new_guest_name" placeholder="<?php echo $lang['username']; ?>" class="full_input"/>
		</div>
		<div class="setting_element">
			<h3 class="bold centered_element error">* يرجى اختيار كلمة سر قوية لمزيد من الحماية لحسابك.</h3>
			<p class="label"><?php echo $lang['password']; ?></p>
			<input type="password" id="new_guest_password" class="full_input"/>
		</div>
		<div id="pswd_info">
			<h4>لمزيد من الحماية ، لابد أن تحتوي كلمة المرور على :</h4>
			<ul>
				<li id="letter" class="invalid fa fa-times"> على الاقل <strong>حرف واحد انجليزي</strong></li>
				<li id="capital" class="invalid fa fa-times"> على الاقل <strong>حرف انجليزي كابيتال</strong></li>
				<li id="number" class="invalid fa fa-times"> على الاقل <strong>رقم واحد</strong></li>
				<li id="length" class="invalid fa fa-times"> ان تكون على الاقل <strong>من 8 احرف</strong></li>
			</ul>
		</div>
		<div class="setting_element">
			<p class="label"><?php echo $lang['email']; ?></p>
			<input value="" type="text" id="new_guest_email" class="full_input"/>
		</div>
	</div>
	<button onclick="registerGuest();" class="reg_button theme_btn"><i class="fa fa-edit"></i> <?php echo $lang['register']; ?></button>
	<button class="reg_button default_btn cancel_over"><?php echo $lang['cancel']; ?></button>
</div>
<script>
	$('input[type=password]').keyup(function() {
		var pswd = $(this).val();
		//validate the length
		if (pswd.length < 8) {
			$('#length').removeClass('valid').addClass('invalid');
			$('#length').removeClass('fa-check').addClass('fa-times');
		} else {
			$('#length').removeClass('invalid').addClass('valid');
			$('#length').removeClass('fa-times').addClass('fa-check');
		}
		//validate letter
		if (pswd.match(/[A-z]/)) {
			$('#letter').removeClass('invalid').addClass('valid');
			$('#letter').removeClass('fa-times').addClass('fa-check');
		} else {
			$('#letter').removeClass('valid').addClass('invalid');
			$('#letter').removeClass('fa-check').addClass('fa-times');
		}

		//validate capital letter
		if (pswd.match(/[A-Z]/)) {
			$('#capital').removeClass('invalid').addClass('valid');
			$('#capital').removeClass('fa-times').addClass('fa-check');
		} else {
			$('#capital').removeClass('valid').addClass('invalid');
			$('#capital').removeClass('fa-check').addClass('fa-times');
		}

		//validate number
		if (pswd.match(/\d/)) {
			$('#number').removeClass('invalid').addClass('valid');
			$('#number').removeClass('fa-times').addClass('fa-check');
		} else {
			$('#number').removeClass('valid').addClass('invalid');
			$('#number').removeClass('fa-check').addClass('fa-times');
		}
		// keyup code here
	}).focus(function() {
		$('#pswd_info').show();
	}).blur(function() {
		$('#pswd_info').hide();
	});
</script>