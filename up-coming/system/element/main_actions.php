<?php if(!isMuted($boom) && !isRegmute($boom) && canMuteUser($boom)){ ?>
<div onclick="listAction(<?php echo $boom['user_id']; ?>, 'mute');" class="sub_list_item">
	<div class="sub_list_icon"><i class="fa fa-microphone-slash warn"></i></div>
	<div class="sub_list_content"><?php echo $lang['mute']; ?></div>
</div>
<?php } ?>
<?php if((isMuted($boom) || isRegmute($boom)) && canMuteUser($boom)){ ?>
<div onclick="listAction(<?php echo $boom['user_id']; ?>, 'unmute');" class="sub_list_item">
	<div class="sub_list_icon"><i class="fa fa-microphone warn"></i></div>
	<div class="sub_list_content"><?php echo $lang['unmute']; ?></div>
</div>
<?php } ?>
<?php if(isKicked($boom) && canKickUser($boom)){ ?>
<div onclick="listAction(<?php echo $boom['user_id']; ?>, 'unkick');" class="sub_list_item">
	<div class="sub_list_icon"><i class="fa fa-bolt default_color"></i></div>
	<div class="sub_list_content"><?php echo $lang['unkick']; ?></div>
</div>
<?php } ?>
<?php if(!isKicked($boom) && canKickUser($boom)){ ?>
<div onclick="listAction(<?php echo $boom['user_id']; ?>, 'kick');" class="sub_list_item">
	<div class="sub_list_icon"><i class="fa fa-bolt default_color"></i></div>
	<div class="sub_list_content"><?php echo $lang['kick']; ?></div>
</div>
<?php } ?>
<?php if(isBanned($boom) && canBanUser($boom)){ ?>
<div onclick="listAction(<?php echo $boom['user_id']; ?>, 'unban');" class="sub_list_item">
	<div class="sub_list_icon"><i class="fa fa-ban error"></i></div>
	<div class="sub_list_content"><?php echo $lang['unban']; ?></div>
</div>
<?php } ?>
<?php if(!isBanned($boom) && canBanUser($boom)){ ?>
<div onclick="listAction(<?php echo $boom['user_id']; ?>, 'ban');" class="sub_list_item">
	<div class="sub_list_icon"><i class="fa fa-ban error"></i></div>
	<div class="sub_list_content"><?php echo $lang['ban']; ?></div>
</div>
<?php } ?>
<?php if(canDeleteUser($boom)){ ?>
<div onclick="listAction(<?php echo $boom['user_id']; ?>, 'delete_account');" class="sub_list_item">
	<div class="sub_list_icon"><i class="fa fa-trash error"></i></div>
	<div class="sub_list_content"><?php echo $lang['delete_account']; ?></div>
</div>
<?php } ?>