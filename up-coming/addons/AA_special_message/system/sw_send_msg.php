<?php
$load_addons = 'AA_special_message';
require_once('../../../system/config_addons.php');
if(!boomAllow($data['addons_access'])){
	die();
}
?>
<div class="pad_box">
	<div class="boom_form">
		<p class="bold centered_element text_large">قم بكتابة رسالتك هنا</p>
		<p class="label error">* يرجى الانتباه انه سيتم خصم 100 نقطة مقابل الرسالة المميزة</p>
		<textarea rows="10" cols="30" id="my_new_ehdaa" placeholder="write something ..." class="full_textarea"/></textarea>
	</div>
	<button onclick="sendEhdaa();" class="reg_button theme_btn"><i class="fa fa-share listing_icon"></i> ارسال</button>
</div>