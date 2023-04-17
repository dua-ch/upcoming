<?php
require_once('../config_session.php');
if(!canDeletePrivate()){
	echo 0;
	die();
}
?>
<div class="pad25">
	<div class="tpad10 bpad20">
		<p class="centered_element text_med bold error">
		أنت على وشك حذف جميع المحادثات الخاصة لديك ، ولا يمكن التراجع في هذا الاجراء بعد تنفيذه ، هل أنت متاكد أنك تريد حذف جميع المحادثات الخاصة؟
		</p>
	</div>
	<div class="centered_element">
		<button onclick="clearPrivateList();" class="reg_button theme_btn"><?php echo $lang['yes']; ?></button>
		<button class="reg_button cancel_over default_btn"><?php echo $lang['cancel']; ?></button>
	</div>
</div>