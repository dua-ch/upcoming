<?php
require('../config_session.php');

if(!isset($_POST['id'])){
	die();
}
$id = escape($_POST['id']);
$user = userRoomDetails($id);

if(empty($user)){
	echo 0;
	die();
}
if(mySelf($user['user_id'])){
	echo 1;
	die();
}

$main_actions = '';
$main_actions = trim(boomTemplate('element/m_actions', $user));
?>
<div class="modal_top">
	<div class="modal_top_empty">
		<div class="btable">
			<div class="avatar_top_mod">
				<img src="<?php echo myAvatar($user['user_tumb']); ?>"/>
			</div>
			<div class="avatar_top_name">
				<?php echo $user['user_name']; ?>
			</div>
		</div>
	</div>
	<div class="modal_top_element close_over">
		<i class="fa fa-times"></i>
	</div>
</div>
<div class="modal_zone pad20" id="main_actions">
		<?php 
		if(empty($main_actions)){
			echo emptyZone($lang['no_data']);
		}
		else {
			echo $main_actions;
		}
		?>
	</div>