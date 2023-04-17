<?php
require('../config_session.php');
if (!isset($_POST['edit_user'])) {
	die();
}
if (!boomAllow(97) && !boomRole(4)) {
	die();
}
$result = '';
$target = escape($_POST['edit_user']);
$user = userDetails($target);
$user2 = userRoomDetails($target);
if (!canEditUser($user, 97) && !boomRole(4)) {
	echo 99;
	die();
}
?>
<div class="modal_wrap_top modal_top  profile_background <?php echo coverClass($user); ?>" <?php echo getCover($user); ?>>
	<div class="brow">
		<div class="bcell">
			<div class="modal_top_menu">
				<div onclick="getProfile(<?php echo $user['user_id']; ?>);" class="modal_top_item cover_text">
					<i class="fa fa-arrow-left"></i>
				</div>
				<div class="bcell_mid">
				</div>
				<?php if (canModifyCover($user)) { ?>
					<div class="cover_menu">
						<div class="cover_item_wrap lite_olay">
							<div class="cover_item delete_cover" onclick="adminRemoveCover(<?php echo $user['user_id']; ?>);">
								<i id="cover_button" class="fa fa-times"></i>
							</div>
							<div class="cover_item add_cover">
								<i id="admin_cover_icon" data="fa-camera" class="fa fa-camera"></i>
								<input id="admin_cover_file" class="up_input" onchange="adminUploadCover(<?php echo $user['user_id']; ?>);" type="file" />
							</div>
						</div>
					</div>
				<?php } ?>
				<div class="modal_top_menu_empty">
				</div>
				<div class="cancel_modal modal_top_item cover_text">
					<i class="fa fa-times"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="brow">
		<div class="bcell_bottom profile_top">
			<div class="btable_auto">
				<div class="profile_avatar" data="<?php echo $user['user_tumb']; ?>">
					<div class="avatar_spin">
						<img class="fancybox avatar_profile" <?php echo profileAvatar($user['user_tumb']); ?> />
					</div>
					<?php
					if (canModifyAvatar($user)) { ?>
						<div class="avatar_control olay">
							<div class="avatar_button" onclick="adminRemoveAvatar(<?php echo $user['user_id']; ?>);">
								<i class="fa fa-times"></i>
							</div>
							<div id="avatarupload" class="avatar_button">
								<i id="avat_admin" data="fa-camera" class="fa fa-camera"></i>
								<input id="admin_avatar_image" class="up_input" onchange="adminUploadAvatar(<?php echo $user['user_id']; ?>);" type="file">
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="profile_tinfo cover_text">
					<div class="pdetails">
						<?php if (canModifyName($user)) { ?>
							<div class="pdetails_icon text_med bold" onclick="adminChangeName(<?php echo $user['user_id']; ?>);">
								<i class="fa fa-pencil-alt"></i>
							</div>
						<?php } ?>
						<div id="pro_admin_name" class="pdetails_text pro_name">
							<?php echo $user['user_name']; ?>
						</div>
					</div>
					<div class="pdetails">
						<?php if (canModifyMood($user)) { ?>
							<div class="pdetails_icon text_med bold" onclick="adminChangeMood(<?php echo $user['user_id']; ?>);">
								<i class="fa fa-pencil-alt"></i>
							</div>
						<?php } ?>
						<div id="pro_admin_mood" class="pdetails_text pro_mood bellips">
							<?php echo getMood($user); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal_menu">
	<ul>
		<li class="modal_menu_item modal_selected" data="madminuser" data-z="admin_pro_details"><?php echo $lang['options']; ?></li>
		<?php if (boomAllow(100)) { ?>
			<li class="modal_menu_item" data="madminuser" data-z="admin_edit_color"><?php echo $lang['color']; ?></li>
		<?php } ?>
		<?php if (boomAllow(100) && isMember($user)) { ?>
			<li class="modal_menu_item" data="madminuser" data-z="user_eshtrak">الاشتراك</li>
		<?php } ?>
		<?php if (boomAllow(100) && isMember($user)) { ?>
			<li class="modal_menu_item delete_btn" data="madminuser" data-z="personal_prem">المميزات</li>
		<?php } ?>

		<li class="modal_menu_item" data="madminuser" data-z="void" onclick="getProfile(<?php echo $user['user_id']; ?>);"><?php echo $lang['back']; ?></li>
	</ul>
</div>
<div id="madminuser">
	<div class="modal_zone pad25" id="admin_pro_details">
		<div class="">
			<?php if (canModifyEmail($user)) { ?>
				<div onclick="adminGetEmail(<?php echo $user['user_id']; ?>);" class="listing_element">
					<i class="fa fa-envelope listing_icon"></i><?php echo $lang['edit_email']; ?>
				</div>
			<?php } ?>
			<?php if (canModifyAbout($user)) { ?>
				<div onclick="adminUserAbout(<?php echo $user['user_id']; ?>);" class="listing_element">
					<i class="fa fa-user listing_icon"></i><?php echo $lang['edit_about']; ?>
				</div>
			<?php } ?>
			<?php if (canModifyPassword($user)) { ?>
				<div onclick="adminUserPassword(<?php echo $user['user_id']; ?>);" class="listing_element">
					<i class="fa fa-key listing_icon"></i><?php echo $lang['change_password']; ?>
				</div>
			<?php } ?>
			<?php if (canEditUser($user, 100, 1)) { ?>
				<div onclick="adminUserVerify(<?php echo $user['user_id']; ?>);" class="listing_element">
					<i class="fa fa-check-circle listing_icon"></i><?php echo $lang['edit_verify']; ?>
				</div>
			<?php } ?>
			<?php if (canDeleteUser($user)) { ?>
				<div onclick="eraseAccount(<?php echo $user['user_id']; ?>);" class="listing_element">
					<i class="fa fa-trash listing_icon"></i><?php echo $lang['delete_account']; ?>
				</div>
			<?php } ?>
		</div>
	</div>
	
	<?php if (boomAllow(100)) { ?>
		<div class="hide_zone modal_zone" id="user_eshtrak">
			<div class="pad_box">
				<p class="text_med bold">الاشتراكات</p>
				<div class="setting_element">
					<p class="label">رتبة الاشتراك</p>
					<select id="eshtrak_rank">
						<?php echo listRank($user['user_rank']); ?>
					</select>
				</div>
				<div class="setting_element">
					<p class="label">مدة الاشتراك بالايام</p>
					<input id="eshtrak_time" type="number" class="full_input" value="0">
				</div>
				<button onclick="giveRankEshtrak(<?php echo $user['user_id']; ?>);" class="reg_button ok_btn"><i class="fa fa-save"></i> منح الاشتراك</button>
			</div>
		</div>
	<?php } ?>
	<?php if (boomAllow(100)) { ?>
		<div class="hide_zone modal_zone" id="admin_edit_color">
			<div class="pad_box">
				<div class="preview_zone border_bottom">
					<p class="label"><?php echo $lang['preview']; ?></p>
					<p id="preview_name" class="<?php echo myColorFont($user); ?>"><?php echo $user['user_name']; ?></p>
				</div>
				<div class="user_color" data-u="<?php echo $user['user_id']; ?>" data="<?php echo $user['user_color']; ?>">
					<?php if (boomAllow(100)) { ?>
						<div class="reg_menu_container tmargin10">
							<div class="reg_menu">
								<ul>
									<li class="reg_menu_item reg_selected" data="color_tab" data-z="reg_color"><?php echo $lang['color']; ?></li>
									<?php if (boomAllow(100)) { ?>
										<li class="reg_menu_item" data="color_tab" data-z="neon_color"><?php echo $lang['neon']; ?></li>
									<?php } ?>
									<?php if (boomAllow(100)) { ?>
										<li class="reg_menu_item" data="color_tab" data-z="grad_color"><?php echo $lang['gradient']; ?></li>
									<?php } ?>
								</ul>
							</div>
						</div>
					<?php } ?>
					<div id="color_tab">
						<div id="reg_color" class="reg_zone vpad5">
							<?php echo colorChoice($user['user_color'], 1); ?>
							<div class="clear"></div>
						</div>
						<?php if (boomAllow(100)) { ?>
							<div id="grad_color" class="reg_zone vpad5 hide_zone">
								<?php echo gradChoice($user['user_color'], 1); ?>
								<div class="clear"></div>
							</div>
						<?php } ?>
						<?php if (boomAllow(100)) { ?>
							<div id="neon_color" class="reg_zone vpad5 hide_zone">
								<?php echo neonChoice($user['user_color'], 1); ?>
								<div class="clear"></div>
							</div>
						<?php } ?>
					</div>
					<div class="clear"></div>
				</div>
				<div>
					<?php if (boomAllow(100)) { ?>
						<div class="setting_element">
							<p class="label"><?php echo $lang['font']; ?></p>
							<select id="fontitname">
								<?php echo listNameFont($user['user_font']); ?>
							</select>
						</div>
					<?php } ?>
				</div>
				<div class="tpad10">
					<button onclick="saveUserColor(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php if (boomAllow(100)) { ?>
<div class="hide_zone modal_zone" id="personal_prem">
	<div class="pad_box">
		<div class="premium_colors" data-u="<?php echo $user['user_id']; ?>" data="<?php echo $user['user_color']; ?>">
			<div class="reg_menu_container tmargin10">
				<div class="reg_menu">
					<ul>
						<?php if (boomAllow(100)) { ?>
							<li class="reg_menu_item reg_selected" data="color_tab" data-z="lm3acolor">لمعة الاسم</li>
						<?php } ?>
						<li class="reg_menu_item <?php if (!boomAllow(100)) {
														echo 'reg_selected';
													} ?>" data="color_tab" data-z="name_bg">خلفية الاسم</li>
						<li class="reg_menu_item" data="color_tab" data-z="pro_av">صورة شخصية متحركة</li>
						<li class="reg_menu_item" data="color_tab" data-z="list_bg_glow">توهج خلفيه الاسم</li>
						<li class="reg_menu_item" data="color_tab" data-z="pro_color">الوان البروفايل</li>
						<li class="reg_menu_item" data="color_tab" data-z="av_border">اطار الصورة</li>
						<li class="reg_menu_item" data="color_tab" data-z="music_color">موسيقى البروفايل</li>
					</ul>
				</div>
			</div>
			<div id="color_tab">
				<?php if (boomAllow(97)) { ?>
					<div id="lm3acolor" class="reg_zone vpad5">
						<?php echo exGradyChoices($user['user_color'], 1); ?>
						<div class="clear"></div>
						<div class="tpad10">
							<button onclick="exSaveNewUserColors(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
							<button onclick="delUserNameColors(<?php echo $user['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> <?php echo $lang['delete']; ?></button>
						</div>
					</div>
				<?php } ?>
				<div id="pro_av" class="reg_zone vpad5 <?php if (boomAllow(97)) {
															echo 'hide_zone';
														} ?>">
					<div class="setting_element">
						<p class="label">اختر صورة متحركه لملفك الشخصي</p>
						<input id="ex_av_gif" type="file" class="full_input">
					</div>
					<div class="tpad10">
						<button onclick="exSaveAvGif(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn"><i id="gift_av_ico" data="fa-save" class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
					</div>
				</div>
				<div id="name_bg" class="reg_zone vpad5 hide_zone">
					<?php echo exNameBg($user['ex_name_bg'], 1); ?>
					<div class="clear"></div>
					<div class="tpad10">
						<button onclick="exSaveNewNameBg(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
						<button onclick="delUserNameBg(<?php echo $user['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> <?php echo $lang['delete']; ?></button>
					</div>
				</div>
				<div id="list_bg_glow" class="reg_zone vpad5 hide_zone">
					<?php echo exListBgGlow($user['ex_name_bg_glow'], 1); ?>
					<div class="clear"></div>
					<div class="tpad10">
						<button onclick="exSaveListGlow(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
						<button onclick="delUserNameBgGlow(<?php echo $user['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> <?php echo $lang['delete']; ?></button>
					</div>
				</div>
				<div id="av_border" class="reg_zone vpad5 hide_zone">
					<?php echo exNameBg($user['ex_av_border'], 2); ?>
					<div class="clear"></div>
					<div class="tpad10">
						<button onclick="exSaveAvBorder(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
						<button onclick="exDelAvBorder(<?php echo $user['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> <?php echo $lang['delete']; ?></button>
					</div>
				</div>
				<div id="pro_color" class="reg_zone vpad5 hide_zone">
					<p class="label"><?php echo $lang['pro_color']; ?></p>
					<div value="<?php echo $user['user_id']; ?>" data="<?php echo $user['ex_pro_colors']; ?>" class="my_pro_color vpad5 box_height">
						<?php echo proGradChoices($user['ex_pro_colors'], 4); ?>
						<div class="clear"></div>
						<div class="pad10">
							<button type="button" onclick="saveProColor(<?php echo $user['user_id']; ?>);" class="reg_button default_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
							<button type="button" onclick="delProColors(<?php echo $user['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> الافتراضي</button>
						</div>
					</div>
					<p class="label"><?php echo $lang['pro_glow']; ?></p>
					<div value="<?php echo $user['user_id']; ?>" data="<?php echo $user['ex_pro_shadow']; ?>" class="my_pro_shadow vpad5 box_height">
						<?php echo proShadowGradChoices($user['ex_pro_shadow'], 4); ?>
						<div class="clear"></div>
						<div class="pad10">
							<button type="button" onclick="saveProShadow(<?php echo $user['user_id']; ?>);" class="reg_button default_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
							<button type="button" onclick="delProColors(<?php echo $user['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> الافتراضي</button>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div id="music_color" class="reg_zone vpad5 hide_zone">
					<div class="setting_element">
						<p class="label"><b style="color:red;"> <?php echo $lang['choose_music']; ?> </b></p>
						<input id="pro_song" class="full_input" type="file" />
						<p class="sub_text sub_label"> <?php echo $lang['limit_pro_music']; ?></p>
					</div>
					<div class="pad10">
						<button type="button" onclick="uploadProfileSong(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn"><i id="avat_icon_song" data="fa-save" class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
						<button type="button" onclick="delProfileSong(<?php echo $user['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-times"></i> <?php echo $lang['delete']; ?></button>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php } ?>
</div>