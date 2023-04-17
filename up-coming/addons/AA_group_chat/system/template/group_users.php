<div class="user_group_elem  groupuser<?php echo $boom['user_id']; ?>" >
    <img data-img="<?php echo myAvatar($boom['user_tumb']); ?>" class="avatar_friends lazyboom" src="<?php echo myAvatar($boom['user_tumb']); ?>" />
    <?php if($data['group_owner'] == 1 && !mySelf($boom['user_id'])){ ?>
    <span onclick="kickGroupUser(<?php echo '\'' . $data['user_group'] . '\''; ?>, <?php echo $boom['user_id']; ?>);" class="kick_group_user"><i class="fa fa-times"></i></span>
    <?php } ?>
    <div data="<?php echo $boom['user_id']; ?>" class="olay user_square_name get_info">
		<?php echo $boom['user_name']; ?>
	</div>
</div>