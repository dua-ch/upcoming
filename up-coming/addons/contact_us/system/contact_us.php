<?php
$load_addons = 'contact_us';
require('../../../system/config_addons.php');
if(!canContactUs()){
	die();
}
?>
<?php if(canSendContactUs()){ ?>
<div id="contact_us_form" class="pad15">
	<div class="setting_element">
		<p class="label"><?php echo $lang['email']; ?></p>
		<input maxlength="120" value="<?php echo $data['user_email']; ?>" id="contact_us_email" class="full_input"/>
	</div>
	<div class="setting_element">
		<p class="label"><?php echo $lang['subject']; ?></p>
		<input maxlength="60" id="contact_us_subject" class="full_input"/>
	</div>
	<div class="setting_element">
		<p class="label"><?php echo $lang['message']; ?></p>
		<textarea maxlength="2000" id="contact_us_message" class="large_textarea full_textarea"></textarea>
	</div>
	<div class="tpad5">
		<button onclick="sendContactUs();"  class="reg_button ok_btn"><i class="fa fa-send"></i> <?php echo $lang['send']; ?></button>
		<button class="cancel_modal reg_button default_btn"><?php echo $lang['cancel']; ?></button>
	</div>
</div>
<div id="contact_us_sending" class="pad25 centered_element hidden">
	<p class="text_ultra success"><i class="fa fa-spinner fa-spin"></i></p>
	<p class=""><?php echo $lang['please_wait']; ?></p>
</div>
<div id="contact_us_sent" class="centered_element pad25 hidden">
	<p class="text_ultra success"><i class="fa fa-check-circle"></i></p>
	<p class=""><?php echo $lang['contact_sent']; ?></p>
	<div class="tpad15">
		<button class="cancel_modal reg_button default_btn"><?php echo $lang['close']; ?></button>
	</div>
</div>
<?php
}
else { ?>
<div id="support_bad" class="centered_element pad25">
	<p class="text_ultra error"><i class="fa fa-exclamation-triangle"></i></p>
	<p class=""><?php echo $lang['contact_limit']; ?></p>
	<div class="tpad15">
		<button class="cancel_modal reg_button ok_btn"><?php echo $lang['close']; ?></button>
	</div>
</div>
<?php } ?>