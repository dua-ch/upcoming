<?php
/*===============================================*
 |                                               |
 |   Development      :  [AMEER_PS]              |
 |                                               |
 |   addon name       :  [YILDIZ_GIFT]           |
 |                                               |
 |   Version          :  [1.0]                   |
 |                                               |
 |   Codychat version :  [CODYCHAT 3.6]          |
 |                                               |
 *===============================================*/
$load_addons = 'yildiz_gift';
require_once('../../../../system/config_addons.php');
if(!boomAllow(10)){
	echo 0;
	die();
}
$id = escape($_POST['edit_gift']);
$gift = getGift($id);
?>
<div class="pad_box">
	<div class="boom_form">
		 <div class="bold page_top_title info">
                  <p class="label"> <i class="fa fa-wrench black"></i>التعديل على الهدية :  <?php echo $gift['gift_name']; ?></p>
     </div>
		<div class="setting_element ">
			<p class="label">تعديل الاسم : </p>
			<input id="gift_name" class="full_input" type="text" value="<?php echo $gift['gift_name']; ?>"/>
		</div>
        <div class="setting_element ">
			<p class="label">تعديل السعر</p>
		<input id="gift_quiz"  class="full_input"  type="number" value="<?php echo $gift['gift_quiz']; ?>"/>
		</div>
	</div>
	<button id="add_adnoyer" onclick="changeGift(<?php echo $gift['id']; ?>);" type="button" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
</div>