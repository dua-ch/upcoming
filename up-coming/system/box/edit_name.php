<?php
require('../config_session.php');
$lim = limitDetatils($data['user_id'], 'my_name');
?>
<?php if(empty($lim) || boomAllow(89)){ ?>
<?php if(!boomAllow(89)){ ?>
<div style="background: #ff00002e;width: 100%;padding: 2px;border-radius: 3px;">
	<p class="label error centered_element">* يرجى الانتباه أنه يمكنك تغيير اسمك مره واحده كل شهر ، وسيتم تنزيل رتبتك إلى<br> <?php echo rankTitle($data['user_rank'] - 1); ?></p>
</div>
<?php } ?>
<div style="padding:3px 15px 15px 15px" class="pad_box">
	<div class="boom_form">
		<p class="label"><?php echo $lang['username']; ?></p>
		<input type="text" id="my_new_username" value="<?php echo $data['user_name']; ?>" class="full_input" />
	</div>
	<button onclick="changeMyUsername();" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
	<button class="cancel_over reg_button default_btn"><?php echo $lang['cancel']; ?></button>
</div>
<?php } else { ?>
<div class="pad_box">
	<h2 class="bold error">يمكنك تغيير اسمك مرة اخرى في <?php echo longDate($lim['time']); ?></h2>
</div>
<?php } ?>