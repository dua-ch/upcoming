<div class="sub_list_item subuserelem" id="gchatuser">
	<div class="sub_list_avatar">
		<img class="admin_user<?php echo $boom['user_id']; ?>" src="<?php echo myAvatar($boom['user_tumb']); ?>" />
	</div>
	<div class="sub_list_content hpad5">
		<p class="bold <?php echo myColor($boom); ?> bellpis"><?php echo $boom['user_name']; ?></p>
	</div>
	<div data="<?php echo $boom['user_id']; ?>" onclick="sendUserInvite(this);" class="sub_list_option">
		<i id="invite_gchat_ico" class="fa fa-plus"></i>
	</div>
</div> 