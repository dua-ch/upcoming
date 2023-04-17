<div class="top_mod">
	<div class="top_mod_empty">
	</div>
	<div class="top_mod_option close_modal">
		<i class="fa fa-times"></i>
	</div>
</div>
<div class="bpad30 hpad30">
	<div class="centered_element bpad15">
		<img class="large_icon" src="https://www.iconpacks.net/icons/2/free-bell-icon-2031-thumb.png"/>
	</div>
	<div class="centered_element">
		<p class="text_large bold">المرسل : <?php echo $boom['user_name']; ?></p>
		<p class="text_small tpad10">هذا المستخدم ارسل اليك طلب محادثه خاصة</p>
	</div>
	<div class="tpad20 centered_element">
		<button onclick="acceptPrvAsk(<?php echo $boom['user_id']; ?>);" class="close_modal ok_btn reg_button">قبول</button>
		<button onclick="refusePrvAsk(<?php echo $boom['user_id']; ?>);" class="close_modal delete_btn reg_button">رفض</button>
	</div>
</div>