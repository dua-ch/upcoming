<?php
$load_addons = 'AA_profile_fan';
require_once('../../../system/config_addons.php');
$target = escape($_POST['target']);
$user = userDetails($target);
?>
<div class="pad10">
    <p class="label"><?php echo $lang['type_username']; ?></p>
	<?php if($data['user_id'] != $user['user_id']){ ?>
    <div data="<?php echo $target; ?>" class="admin_search ignore_with_blocker centered_element">
        <p class="label"><?php echo $lang['send_this_fan']; ?></p>
        <button style="width: 100%;" type="button" onclick="sendThisFan(<?php echo $user['user_id']; ?>);" class="button delete_btn"><i class="fa fa-heart"></i> <?php echo $lang['send_me_fan']; ?></button>
    </div>
	<?php } else { ?>
	<div class="error centered_element text_large bold bmargin10"><i class="fa fa-heart"></i> اعجاباتي</div>
	<?php }?>
    <div style="margin: 5px 0;" id="ignore_users_result">
        <?php echo getMyProfileFans($user['user_id']); ?>
    </div>
</div>