<?php
require('../config.php');
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
<div id="registration_form_box" class="pad_box">
	<div class="boom_form">
		<p class="label"><?php echo $lang['username']; ?></p>
		<input spellcheck="false" id="reg_username" class="full_input" type="text" maxlength="<?php echo $data['max_username']; ?>" autocomplete="off">
		<input type="text" style="display:none">
		<input type="password" style="display:none">
		<p class="label tpad5"><?php echo $lang['password']; ?></p>
		<input spellcheck="false" id="reg_password" class="full_input" maxlength="30" type="password" autocomplete="off">
		<div id="pswd_info">
			<h4>لمزيد من الحماية ، لابد أن تحتوي كلمة المرور على :</h4>
			<ul>
				<li id="letter" class="invalid fa fa-times"> على الاقل <strong>حرف واحد انجليزي</strong></li>
				<li id="capital" class="invalid fa fa-times"> على الاقل <strong>حرف انجليزي كابيتال</strong></li>
				<li id="number" class="invalid fa fa-times"> على الاقل <strong>رقم واحد</strong></li>
				<li id="length" class="invalid fa fa-times"> ان تكون على الاقل <strong>من 8 احرف</strong></li>
			</ul>
		</div>
		<p class="label tpad5"><?php echo $lang['email']; ?></p>
		<input spellcheck="false" id="reg_email" class="full_input" maxlength="80" type="text" autocomplete="off">
		<div class="form_split register_options tpad5">
			<div class="form_left">
				<p class="label"><?php echo $lang['gender']; ?></p>
				<select id="login_select_gender">
					<?php echo listGender(1); ?>
				</select>
			</div>
			<div class="form_right">
				<p class="label"><?php echo $lang['age']; ?></p>
				<select size="1" id="login_select_age">
					<?php
					echo listAge('', 1);
					?>
				</select>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<?php if (boomRecaptcha()) { ?>
		<div class="recapcha_div tmargin10">
			<div id="boom_recaptcha" class="register_recaptcha">
			</div>
		</div>
	<?php } ?>
	<div class="login_control">
		<button onclick="sendRegistration();" type="button" class="theme_btn full_button large_button" id="register_button"><i class="fa fa-edit"></i> <?php echo $lang['register']; ?></button>
	</div>
	<div class="rules_text_elem tpad10">
		<p class="rules_text text_xsmall sub_text"><?php echo $lang['i_agree']; ?> <span class="rules_click" onclick="showRules();"><?php echo $lang['rules']; ?></span></p>
	</div>
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