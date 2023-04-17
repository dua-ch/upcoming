<?php
$load_addons = 'live_stream';
require_once('../../../../system/config_addons.php');

$id = escape($_POST['id']);
$user = userDetails($id);
if(empty($user)){
	echo 2;
	die();
}
?>
<style>
	.avatar_vip { width:80px; height:80px; border-radius:50%; }
</style>
<div class="hpad15">
	<div class="centered_element">
			<img class="avatar_vip" src="<?php echo myavatar($user['user_tumb']); ?>"/>
	</div>
	<div class="centered_element vpad10">
		<p class="sub_text"> <?php echo $user['user_name']; ?> </p>
	</div>
	<div class="centered_element vpad10">
		<p class="sub_text"> <?php echo $lang['live_allow_user']; ?> </p>
	</div>
	<div class="centered_element pad15">
		<button onclick="delAllow(<?php echo $user['user_id']; ?>);" class="reg_button default_btn"><i class="fa fa-times"></i> <?php echo $lang['live_del']; ?></button>
		<button onclick="acAllow(<?php echo $user['user_id']; ?>);" class="reg_button ok_btn"><i class="fa fa-check"></i> <?php echo $lang['live_ac']; ?></button>
	</div>
</div>