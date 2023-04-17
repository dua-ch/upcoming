<?php
$load_addons = 'AA_chat_store';
require_once('../../../system/config_addons.php');
?>
<div class="bpad30 hpad30">
	<div class="centered_element bpad15">
		<img class="large_icon" src="<?php echo $data['domain']; ?>/default_images/level-up-logo.png"/>
	</div>
	<div class="centered_element">
		<p class="text_large bold">تم ترقية المستوى</p>
		<p class="text_small tpad10">لقد أرتقى مستواك إلى <?php $newlevel = $data['user_level'] + 1; echo $newlevel; ?> مبارك اليك</p>
	</div>
	<div class="tpad20 centered_element">
		<button class="close_modal ok_btn reg_button">إستمر</button>
	</div>
</div>