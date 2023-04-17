<?php
$ask = 0;
$current = '';
$owner = '';
if ($boom['password'] != '') {
	$ask = 1;
}
if ($boom['room_id'] == $data['user_roomid']) {
	$current = 'noview';
}
if ($boom['description'] == '') {
	$description = $lang['room_no_description'];
} else {
	$description = $boom['description'];
}
if ($data['user_id'] == $boom['room_creator']) {
	$owner = 'owner ';
}
?>
<div class="room_element add_shadow element_color" onclick="switchRoom(<?php echo $boom['room_id']; ?>, <?php echo $ask; ?>, <?php echo $boom['access']; ?>);">
	<div class="btable">
		<div class="bcell">
		</div>
		<div class="room_icon">
			<?php
			if($boom['ex_room_icon'] == ''){
				echo roomIcon($boom, 'room_img');
			} else {
				echo '<img title="' . $boom['room_name'] . '" class="room_img" src="' . $data['domain'] . '/default_images/rooms/' . $boom['ex_room_icon'] . '">';
			}
			?>
			<?php echo roomLock($boom, 'room_lock'); ?>
		</div>
		<div class="bcell">
		</div>
	</div>
	<div class="btable">
		<div class="bcell">
			<div class="room_name centered_element">
				<?php echo $boom['room_name']; ?>
			</div>
			<div class="room_count centered_element">
				<p class="default_color text_xmed"><?php echo $boom['room_count']; ?> <i class="fa fa-users"></i></p>
			</div>
			<div class="room_description sub_text centered_element">
				<?php echo $description; ?>
			</div>
			<button class="reg_button full_button default_btn"><i class="fa fa-sign-in-alt"></i> أضغط هنا للانضمام للدردشة</button>
		</div>
	</div>
</div>