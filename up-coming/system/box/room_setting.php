<?php
require_once('../config_session.php');

if (!canEditRoom()) {
	die();
}
$room = roomDetails();
$room_owner = getRoomStaff($data['user_roomid'], 6);
$room_admin = getRoomStaff($data['user_roomid'], 5);
$room_mod   = getRoomStaff($data['user_roomid'], 4);

?>
<style>
	.sp-replacer {
		width: 100%;
	}

	.sp-dd {
		float: right;
	}
</style>
<div class="modal_top">
	<div class="modal_top_empty bold">
	</div>
	<div class="modal_top_element close_modal">
		<i class="fa fa-times"></i>
	</div>
</div>
<div class="modal_menu">
	<ul>
		<li class="modal_menu_item modal_selected" data="mroom_setting" data-z="room_setting"><?php echo $lang['options']; ?></li>
		<li class="modal_menu_item" data="mroom_setting" data-z="room_staff"><?php echo $lang['staff']; ?></li>
		<li class="modal_menu_item" data="mroom_setting" data-z="room_muted"><?php echo $lang['muted']; ?></li>
		<?php if (boomRole(6) || boomAllow(100)) { ?>
			<li class="modal_menu_item" data="mroom_setting" data-z="room_style">الاستايل</li>
		<?php } ?>
		<?php if (boomRole(6) || boomAllow(100)) { ?>
			<li class="modal_menu_item" data="mroom_setting" data-z="room_blocked"><?php echo $lang['blocked']; ?></li>
		<?php } ?>
	</ul>
</div>
<div id="mroom_setting">
	<div class="modal_zone pad_box" id="room_setting">
		<div class="boom_form">
			<?php if (usePlayer()) { ?>
				<div class="setting_element ">
					<p class="label"><?php echo $lang['default_player']; ?></p>
					<select id="set_room_player">
						<?php echo adminPlayer($room['room_player_id'], 1); ?>
					</select>
				</div>
			<?php } ?>
			<div class="setting_element">
				<p class="label"><?php echo $lang['room_name']; ?></p>
				<input id="set_room_name" maxlength="30" class="full_input" value="<?php echo $room['room_name']; ?>" type="text" />
			</div>
			<?php if (boomAllow(100)) { ?>
			<div class="setting_element">
				<p class="label">السماح بالحصول على نقاط من الغرفة</p>
				<select name="allow_points_inroom" id="allow_points_inroom">
					<option <?php echo selCurrent($room['allow_points'], 1); ?> value="1">نعم</option>
					<option <?php echo selCurrent($room['allow_points'], 0); ?> value="0">لا</option>
				</select>
			</div>
			<?php } ?>
			<?php if (boomRole(6) || boomAllow(100)) { ?>
			<div class="setting_element">
				<p class="label">نوع الغرفة</p>
				<select name="this_room_access" id="this_room_access">
					<?php echo listRank($room['access'], 1); ?>
				</select>
			</div>
			<?php } ?>
			<div class="setting_element">
				<p class="label"><?php echo $lang['password']; ?></p>
				<input id="set_room_password" maxlength="20" class="full_input" value="<?php echo $room['password']; ?>" type="text" />
			</div>
			<div class="setting_element">
				<p class="label"><?php echo $lang['room_description']; ?></p>
				<textarea id="set_room_description" class="full_textarea medium_textarea" type="text" maxlength="<?php echo $cody['max_description']; ?>"><?php echo $room['description']; ?></textarea>
			</div>
		</div>
		<button type="button" id="save_room" class="reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
	</div>
	<?php if (boomRole(6) || boomAllow(100)) { ?>
		<div class="modal_zone pad_box hide_zone" id="room_style">
			<div class="boom_form">
				<div class="setting_element">
					<p class="label">اختر لون الغرفة</p>
					<input type='hidden' value='<?php echo $room['ex_room_style']; ?>' name='triggerSet' id='room_style_color' class="full_input" />
					<button style="width:100%;" onclick="saveRoomStyle();" type="button" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
				</div>
				<div class="setting_element">
					<p class="label">خلفية الغرفة</p>
					<input id="ex_room_bg" type="file" class="full_input">
					<button onclick="uploadRoomBg();" type="button" style="width:100%;" class="reg_button ok_btn bmargin5"><i id="r_bg_ico" data="fa-image" class="fa fa-image"></i> رفع خلفية للغرفة</button>
					<button onclick="delRoomBg();" type="button" style="width:100%;" class="reg_button delete_btn bmargin5"><i class="fa fa-trash"></i> حذف الخلفية</button>
				</div>
				<div class="setting_element">
					<p class="label">ايقونة الغرفة</p>
					<input id="ex_room_icon" type="file" class="full_input">
					<button onclick="uploadRoomIcon();" type="button" style="width:100%;" class="reg_button default_btn bmargin5"><i id="r_icon_ico" data="fa-image" class="fa fa-image"></i> رفع ايقونة الغرفة</button>
					<button onclick="delRoomIcon();" type="button" style="width:100%;" class="reg_button delete_btn"><i class="fa fa-trash"></i> حذف الايقونة</button>
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="modal_zone hide_zone" id="room_staff">
		<?php if (empty($room_owner . $room_admin . $room_mod)) { ?>
			<div class="ulist_container">
				<?php echo emptyZone($lang['no_data']); ?>
			</div>
		<?php } ?>
		<?php if (!empty($room_owner . $room_admin . $room_mod)) { ?>
			<div class="ulist_container">
				<?php if (!empty($room_owner)) { ?>
					<p class="label_line"><?php echo $lang['r_owner']; ?></p>
					<div class="vpad15">
						<?php echo $room_owner; ?>
					</div>
				<?php } ?>
				<?php if (!empty($room_admin)) { ?>
					<p class="label_line"><?php echo $lang['r_admin']; ?></p>
					<div class="vpad15">
						<?php echo $room_admin; ?>
					</div>
				<?php } ?>
				<?php if (!empty($room_mod)) { ?>
					<p class="label_line"><?php echo $lang['r_mod']; ?></p>
					<div class="vpad15">
						<?php echo $room_mod; ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<div class="modal_zone hide_zone" id="room_muted">
		<div class="ulist_container">
			<?php echo getRoomMuted($data['user_roomid']); ?>
		</div>
	</div>
	<?php if (boomRole(6) || boomAllow(100)) { ?>
		<div class="modal_zone hide_zone" id="room_blocked">
			<div class="ulist_container">
				<?php echo getRoomBlocked($data['user_roomid']); ?>
			</div>
		</div>
	<?php } ?>
</div>
<script>
	$("#room_style_color").spectrum({
		showPaletteOnly: true,
		togglePaletteOnly: true,
		allowEmpty: true,
		togglePaletteMoreText: 'more',
		togglePaletteLessText: 'less',
		showAlpha: true,
		showInput: true,
		showSelectionPalette: true,
		hideAfterPaletteSelect: true,
		showInitial: true,
		preferredFormat: "hex",
		color: '<?php echo $data['name_glow']; ?>',
		palette: [
			["#000", "#444", "#666", "#999", "#ccc", "#eee", "#f3f3f3", "#fff"],
			["#f00", "#f90", "#ff0", "#0f0", "#0ff", "#00f", "#90f", "#f0f"],
			["#f4cccc", "#fce5cd", "#fff2cc", "#d9ead3", "#d0e0e3", "#cfe2f3", "#d9d2e9", "#ead1dc"],
			["#ea9999", "#f9cb9c", "#ffe599", "#b6d7a8", "#a2c4c9", "#9fc5e8", "#b4a7d6", "#d5a6bd"],
			["#e06666", "#f6b26b", "#ffd966", "#93c47d", "#76a5af", "#6fa8dc", "#8e7cc3", "#c27ba0"],
			["#c00", "#e69138", "#f1c232", "#6aa84f", "#45818e", "#3d85c6", "#674ea7", "#a64d79"],
			["#900", "#b45f06", "#bf9000", "#38761d", "#134f5c", "#0b5394", "#351c75", "#741b47"],
			["#600", "#783f04", "#7f6000", "#274e13", "#0c343d", "#073763", "#20124d", "#4c1130"]
		]
	});

	// Show the original input to demonstrate the value changing when calling `set`
	$("#room_style_color").show();
</script>