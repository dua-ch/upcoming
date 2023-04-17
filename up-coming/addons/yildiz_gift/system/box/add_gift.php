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
	die();
}
?>
<div class="alert_gift" id="error_show"> 
  <strong></strong> <b class="error_gift"></b>
       </div>
<div class="pad_box">
	<div class="boom_form">
	 <div class="bold page_top_title">
     <p class="label"> <i class="fa fa-wrench black"></i> اضافة هدية جديدة</p>
     </div>
	 <div class="setting_element info">
     <p class="label"> <i class="fa fa-picture-o black"></i> الملفات المسموحة : 'jpeg', 'jpg', 'png', 'gif'</p>
	 </div>
	 <div class="setting_element ">
              <p class="label">رفع صورة</p>
              <input id="gift_file" class="full_input" type="file"/>
       </div>
		<div class="setting_element ">
			<p class="label">اسم الهدية</p>
			<input id="gift_name" class="full_input" type="text" placeholder="اسم الهدية"/>
		</div>
		<div class="setting_element ">
			<p class="label">سعر الهدية</p>
		<input id="gift_quiz"  class="full_input"  type="number" placeholder="سعر الهدية"/>
		</div>
	</div>
	<button id="add_adnoyer" onclick="addGiftNew();" type="button" class="reg_button theme_btn"><i class="fa fa-plus"></i> <?php echo $lang['add']; ?></button>
</div>