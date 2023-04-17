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
if(isset($_POST['target'])){
	$target = escape($_POST['target']);
	$user = userDetails($target);
	if(empty($user)){
		die();
	}
	if(mySelf($user['user_id'])){ 
		die();
	}
}
?>
<div class="pad_box" style="overflow: auto;">
	<div class="boom_form">
	<div class="btable">
			<div class="avatar_top_mod">
				<img src="<?php echo myAvatar($user['user_tumb']); ?>"/>
			</div>
			<div class="avatar_top_name">
				(<?php echo $user['user_name']; ?>) : ارسال هدية الى 
			</div> 
		</div>
		<div class="alert_gift" id="error_show"> 
  <strong></strong> <b class="error_gift"></b>
       </div>
	<div style="max-height: 280px !important;" class="ulist_container">
		<div class="setting_element">
		<section class="gifts_box">
		<?php if (showGift() != ''){ ?>
			<div class="info">يتم خصم 20% من سعر الهدية للمستلم <i class="fa fa-exclamation-triangle red"></i></i></div>
		<?php }?>
<?php
if (showGift() != ''){
$show = showGift();
}else{
$show = emptyZone('لم يتم اضافة هداية');
}
echo $show;?>
		</section>
		</div>
		</div>
	</div>
</div>
<?php if (showGift() != ''){ ?>
<hr>
<div class="pad_box" style="overflow: auto;">
<div class="boom_form">
<div class="clearbox">
 <div class="listing_half_element info_pro AMerr">
     <div class="listing_title">اسم الهدية</div>
   <div class="listing_text"><b class="quiz_gift"><span data="" class="name_gifts">CHAT</span></b></div>
 </div>
<div class="listing_half_element info_pro AMerr">
     <div class="listing_title">سعر الهدية</div>
   <div class="listing_text"><b class="quiz_gift"> <span data="" class="price_gifts">0</span> <i class="gift_icon fa fa-money"></i></b></div>
</div>
<div class="listing_half_element info_pro AMerr">
     <div class="listing_title">نقاطك</div>
   <div class="listing_text"><b class="quiz_gift"><?php echo $data['user_coins'];?> <i class="gift_icon fa fa-money"></i></b> </div>
</div>
<div class="listing_half_element info_pro AMerr">
     <div class="listing_title">عدد الهداية</div>
   <div class="listing_text"><input id="count_gifts" maxlength="30" class="num_gifts" value="1" autocomplete="off" type="number"></div>
 </div>
 <div class="listing_half_element info_pro AMerr">
     <div class="listing_title">معاينة الصورة</div>
   <div class="listing_text"><img style="width: 56px;" class="fancybox" href="<?php echo $data['domain']; ?>/default_images/logo.png" src="<?php echo $data['domain']; ?>/default_images/logo.png" id="img_gif"></div>
 </div>
 <div class="listing_half_element info_pro AMerr">
     <div class="listing_title">الاهداء</div>
   <div style="height: 20px;" class="listing_text"><input id="info_gift" maxlength="25" class="num_gifts" placeholder="اكتب اهداء لا يزيدك 25 حرف" autocomplete="off" type="text"></div>
 </div>
</div>
</div>
</div>
<?php }?>
<div class="pad_box" style="overflow: auto;">
<div style="direction: rtl;" class="boom_form">
<button type="button" class="reg_button default_btn cancel_modal">إلغاء</button>
<?php if (showGift() != ''){ ?>
<button id="gift_id" data-user="<?php echo $user['user_id']; ?>" data="" type="button" onclick="sendGiftsPs(this);" class="reg_button theme_btn"><i class="fa fa-paper-plane"></i> ارسال </button>
<?php }?>
  </div>
</div>
