<?php
require('../config_session.php');
?>
<div id="editprofile_shadow" <?php echo setProfileShadows($data); ?>>
<div id="my_profile_top" class="modal_wrap_top modal_top profile_background <?php echo coverClass($data); ?>" <?php echo getCover($data); ?>>
	<div class="brow">
		<div class="bcell">
			<div class="modal_top_menu">
				<div class="bcell_mid">
				</div>
				<?php if (canCover()) { ?>
					<div class="cover_menu">
						<div class="cover_item_wrap lite_olay">
							<div class="cover_item delete_cover" onclick="deleteCover();">
								<i id="cover_button" class="fa fa-times"></i>
							</div>
							<div class="cover_item add_cover">
								<i id="cover_icon" data="fa-camera" class="fa fa-camera"></i>
								<input id="cover_file" class="up_input" onchange="uploadCover();" type="file" />
							</div>
						</div>
					</div>
					<div class="modal_top_menu_empty">
					</div>
				<?php } ?>
				<div class="cancel_modal modal_top_item cover_text">
					<i class="fa fa-times"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="brow">
		<div class="bcell_bottom profile_top">
			<div class="btable_auto">
				<div id="proav" class="profile_avatar" data="<?php echo $data['user_tumb']; ?>">
					<div class="avatar_spin">
						<img class="fancybox avatar_profile" <?php echo profileAvatar($data['user_tumb']); ?> />
					</div>
					<?php if (canAvatar()) { ?>
						<div class="avatar_control olay">
							<div class="avatar_button" onclick="deleteAvatar();" id="delete_avatar">
								<i class="fa fa-times"></i>
							</div>
							<div id="avatarupload" class="avatar_button">
								<i id="avat_icon" data="fa-camera" class="fa fa-camera"></i>
								<input id="avatar_image" class="up_input" onchange="uploadAvatar();" type="file">
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="profile_tinfo">
					<div class="pdetails">
						<?php if (canName()) { ?>
							<div class="pdetails_icon text_med cover_text bold bclick" onclick="changeUsername();">
								<i class="fa fa-pencil-alt"></i>
							</div>
						<?php } ?>
						<div id="pro_name" class="pdetails_text pro_name cover_text">
							<?php echo $data['user_name']; ?>
						</div>
					</div>
					<?php if (canMood()) { ?>
						<div class="pdetails">
							<div class="pdetails_icon text_med cover_text bclick" onclick="changeMood();">
								<i class="fa fa-pencil-alt"></i>
							</div>
							<div id="pro_mood" class="pdetails_text pro_mood cover_text bellips">
								<?php echo getMood($data); ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if (!isSecure($data) && isMember($data)) { ?>
	<div id="secure_account_warn" onclick="openSecure();" class="profile_info_box ok_btn">
		<i class="fa fa-exclamation-circle"></i> <?php echo $lang['secure_account']; ?>
	</div>
<?php } ?>
<?php if (guestCanRegister()) { ?>
	<div id="secure_account_warn" onclick="openGuestRegister();" class="profile_info_box ok_btn">
		<i class="fa fa-exclamation-circle"></i> <?php echo $lang['register_guest']; ?>
	</div>
<?php } ?>
<?php if (userDelete($data)) { ?>
	<div id="delete_warn" class="pad15 warn_btn">
		<p class="text_xsmall">
			<span><?php echo str_replace('%date%', longDate($data['user_delete']), $lang['close_warning']); ?></span>
			<span onclick="cancelDelete();" class="link_like"><?php echo $lang['cancel_request']; ?></span>
		</p>
	</div>
<?php } ?>
<div id="editprofile_tabs_background" class="modal_menu pro_color_prev <?php echo $data['ex_pro_colors']; ?>">
	<ul>
		<li class="modal_menu_item modal_selected" data="meditprofile" data-z="personal_more">حسابي</li>
		<?php if (isMember($data)) { ?>
			<li class="modal_menu_item" data="meditprofile" data-z="friends_more">الاصدقاء</li>
			<li class="modal_menu_item" data="meditprofile" data-z="ignore_more">تجاهل</li>
		<?php } ?>
		<li class="modal_menu_item" data="meditprofile" data-z="options_more" id="personal_options_btn">خيارات</li>
		<?php if (boomAllow(89)) { ?>
			<li class="modal_menu_item delete_btn" data="meditprofile" data-z="premium_more">البريميم</li>
		<?php } ?>
		<?php if (canNameColor()) { ?>
			<li class="modal_menu_item" data="meditprofile" data-z="colors_more">الالوان</li>
		<?php } ?>
		<li class="modal_menu_item" data="meditprofile" data-z="get_more">المزيد</li>
	</ul>
</div>
<div id="meditprofile" <?php echo setProfileColors($data); ?>>
	<div class="modal_zone pad25" id="personal_more">
			<?php if (boomAllow(101)) { ?>
				<div class="listing_element info_pro">
					<p class="pro_title">رابط الدعوة</p>
					<p style="position: relative;" class="sub_text text_small pro_text">
						<input class="full_input" type="text" value="<?php echo $data['domain']; ?>?referer=<?php echo $data['user_id']; ?>" id="referer_user_link">
						<i style="position: absolute;z-index: 99999;left: 10px;top: 10px;color: #012832;font-size: 20px;" class="fa fa-copy" onclick="copyRefererLink()"></i>
					</p>
				</div>
				<?php } ?>
		<div class="boom_form">
			<?php if (canInfo()) { ?>
				<div class="form_split">
					<div class="form_left">
						<div class="setting_element ">
							<p class="label"><?php echo $lang['age']; ?></p>
							<select id="set_profile_age">
								<?php echo listAge($data['user_age'], 2); ?>
							</select>
						</div>
					</div>
					<div class="form_right">
						<div class="setting_element ">
							<p class="label"><?php echo $lang['gender']; ?></p>
							<select id="set_profile_gender">
								<?php echo listGender($data['user_sex']); ?>
							</select>
						</div>
					</div>
					<button type="button" onclick="saveInfo();" class="reg_button theme_btn"><i class="fa fa-save"></i> حفظ</button>
				</div>
			<?php } ?>
			<div class="setting_element ">
				<p class="label"><?php echo $lang['language']; ?></p>
				<select id="set_profile_language">
					<?php echo listLanguage($data['user_language'], 1); ?>
				</select>
			</div>
			<div class="form_split">
				<div class="form_left_full">
					<div class="setting_element ">
						<p class="label"><?php echo $lang['country']; ?></p>
						<select id="set_profile_country">
							<?php echo listCountry($data['country']); ?>
						</select>
					</div>
				</div>
				<div class="form_right_full">
					<div class="setting_element ">
						<p class="label"><?php echo $lang['user_timezone']; ?></p>
						<select id="set_profile_timezone">
							<?php echo getTimezone($data['user_timezone']); ?>
						</select>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<button onclick="saveLocation();" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
			<?php if (canAbout()) { ?>
				<div class="form_split">
					<div class="setting_element">
						<p class="label"><?php echo $lang['about_me']; ?></p>
						<textarea id="set_user_about" class="large_textarea about_area full_textarea" spellcheck="false" maxlength="800"><?php echo $data['user_about']; ?></textarea>
					</div>
				</div>
				<button type="button" onclick="saveAbout();" id="save_profile" class="reg_button theme_btn"><i class="fa fa-save"></i> حفظ</button>
			<?php } ?>
		</div>
	</div>
	<div class="modal_zone pad25 hide_zone" id="options_more">
		<div class="clearbox">
			<div class="listing_half_element">
				<div class="listing_title"><i class="fa fa-chevron-left"></i> دردشة خاصة</div>
				<select id="set_private_mode" onchange="savePrivateSettings();">
					<?php echo createSelect('private', $data['user_private']); ?>
				</select>
			</div>
			<div class="listing_half_element">
				<div class="listing_title"><i class="fa fa-chevron-left"></i> الاصوات</div>
				<select id="set_sound" onchange="setUserSound(this);">
					<?php echo createSelect('sound', $data['user_sound']); ?>
				</select>
			</div>
			<div class="listing_half_element">
				<div class="listing_title"><i class="fa fa-chevron-left"></i> طلبات التحدث</div>
				<select onchange="setPrivateAsk(this);">
					<?php echo createSelect('ask_private', $data['private_ask']); ?>
				</select>
			</div>
			<div class="listing_half_element">
				<div class="listing_title"><i class="fa fa-chevron-left"></i> طلبات الصداقه</div>
				<select onchange="setAllowAddFriend(this);">
					<?php echo createSelect('ask_friend', $data['friend_ask']); ?>
				</select>
			</div>
			<div class="listing_half_element">
				<div class="listing_title"><i class="fa fa-chevron-left"></i> من يمكنه رؤية نقاطي</div>
				<select onchange="setPointsAccess(this);">
					<?php echo createSelect('points', $data['points_access']); ?>
				</select>
			</div>
			<div class="listing_half_element">
				<div class="listing_title"><i class="fa fa-chevron-left"></i> من يمكنه رؤية اصدقائي</div>
				<select onchange="setFriendsAccess(this);">
					<?php echo createSelect('friends', $data['friends_access']); ?>
				</select>
			</div>
			<div class="listing_half_element">
				<div class="listing_title"><i class="fa fa-chevron-left"></i> رسائل الانضمام</div>
				<select onchange="setJoinLogs(this);">
					<?php echo createSelect('join', $data['join_logs']); ?>
				</select>
			</div>
			<?php if (canTheme()) { ?>
				<div class="listing_half_element">
					<div class="listing_title"><i class="fa fa-chevron-left"></i> استايل الدردشة</div>
					<select onchange="setUserTheme(this);" id="set_user_theme">
						<?php echo listTheme($data['user_theme'], 2); ?>
					</select>
				</div>
			<?php } ?>
		</div>
	</div>
	<?php if (isMember($data)) { ?>
		<div class="modal_zone pad25 hide_zone" id="friends_more">
			<div class="clearbox">
				<?php echo myFriendList(); ?>
			</div>
		</div>
		<div class="modal_zone pad25 hide_zone" id="ignore_more">
			<div class="clearbox">
				<?php echo myIgnore(); ?>
			</div>
		</div>
	<?php } ?>
	<?php if (boomAllow(89)) { ?>
		<div class="modal_zone pad25 hide_zone" id="premium_more">
			<div class="clearbox">
				<div class="user_color" data-u="<?php echo $data['user_id']; ?>" data="<?php echo $data['user_color']; ?>">
					<div class="reg_menu_container tmargin10">
						<div class="reg_menu">
							<ul>
								<?php if(boomAllow(97)){ ?>
								<li class="reg_menu_item reg_selected" data="color_tab" data-z="lm3acolor">لمعة الاسم</li>
								<?php } ?>
								<li class="reg_menu_item <?php if(!boomAllow(97)){ echo 'reg_selected'; } ?>" data="color_tab" data-z="name_bg">خلفية الاسم</li>
								<li class="reg_menu_item" data="color_tab" data-z="pro_av">صورة شخصية متحركة</li>
								<li class="reg_menu_item" data="color_tab" data-z="list_bg_glow">توهج خلفيه الاسم</li>
								<li class="reg_menu_item" data="color_tab" data-z="pro_color">الوان البروفايل</li>
								<li class="reg_menu_item" data="color_tab" data-z="av_border">اطار الصورة</li>
								<li class="reg_menu_item" data="color_tab" data-z="music_color">موسيقى البروفايل</li>
							</ul>
						</div>
					</div>
					<div id="color_tab">
						<?php if(boomAllow(97)){ ?>
						<div id="lm3acolor" class="reg_zone vpad5">
							<?php echo exGradyChoices($data['user_color'], 1); ?>
							<div class="clear"></div>
							<div class="tpad10">
								<button onclick="exSaveNewUserColors(<?php echo $data['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
								<button onclick="delUserNameColors(<?php echo $data['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> <?php echo $lang['delete']; ?></button>
							</div>
						</div>
						<?php } ?>
						<div id="pro_av" class="reg_zone vpad5 <?php if(boomAllow(97)){ echo 'hide_zone'; } ?>">
							<div class="setting_element">
								<p class="label">اختر صورة متحركه لملفك الشخصي</p>
								<input id="ex_av_gif" type="file" class="full_input">
							</div>
							<div class="tpad10">
								<button onclick="exSaveAvGif(<?php echo $data['user_id']; ?>);" class="reg_button theme_btn"><i id="gift_av_ico" data="fa-save" class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
							</div>
						</div>
						<div id="name_bg" class="reg_zone vpad5 hide_zone">
							<?php echo exNameBg($data['ex_name_bg'], 1); ?>
							<div class="clear"></div>
							<div class="tpad10">
								<button onclick="exSaveNewNameBg(<?php echo $data['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
								<button onclick="delUserNameBg(<?php echo $data['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> <?php echo $lang['delete']; ?></button>
							</div>
						</div>
						<div id="list_bg_glow" class="reg_zone vpad5 hide_zone">
							<?php echo exListBgGlow($data['ex_name_bg_glow'], 1); ?>
							<div class="clear"></div>
							<div class="tpad10">
								<button onclick="exSaveListGlow(<?php echo $data['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
								<button onclick="delUserNameBgGlow(<?php echo $data['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> <?php echo $lang['delete']; ?></button>
							</div>
						</div>
						<div id="av_border" class="reg_zone vpad5 hide_zone">
							<?php echo exNameBg($data['ex_av_border'], 2); ?>
							<div class="clear"></div>
							<div class="tpad10">
								<button onclick="exSaveAvBorder(<?php echo $data['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
								<button onclick="exDelAvBorder(<?php echo $data['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> <?php echo $lang['delete']; ?></button>
							</div>
						</div>
						<div id="pro_color" class="reg_zone vpad5 hide_zone">
							<p class="label"><?php echo $lang['pro_color']; ?></p>
							<div value="<?php echo $data['user_id']; ?>" data="<?php echo $data['ex_pro_colors']; ?>" class="my_pro_color vpad5 box_height">
								<?php echo proGradChoices($data['ex_pro_colors'], 4); ?>
								<div class="clear"></div>
								<div class="pad10">
									<button type="button" onclick="saveProColor(<?php echo $data['user_id']; ?>);" class="reg_button default_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
								</div>
							</div>
							<p class="label"><?php echo $lang['pro_glow']; ?></p>
							<div value="<?php echo $data['user_id']; ?>" data="<?php echo $data['ex_pro_shadow']; ?>" class="my_pro_shadow vpad5 box_height">
								<?php echo proShadowGradChoices($data['ex_pro_shadow'], 4); ?>
								<div class="clear"></div>
								<div class="pad10">
									<button type="button" onclick="saveProShadow(<?php echo $data['user_id']; ?>);" class="reg_button default_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
								</div>
							</div>
							<div class="pad10">
								<button type="button" onclick="delProColors(<?php echo $data['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> البروفايل لافتراضي</button>
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
								<button type="button" onclick="uploadProfileSong(<?php echo $data['user_id']; ?>);" class="reg_button theme_btn"><i id="avat_icon_song" data="fa-save" class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
								<button type="button" onclick="delProfileSong(<?php echo $data['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-times"></i> <?php echo $lang['delete']; ?></button>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="modal_zone pad25 hide_zone" id="get_more">
		<div class="clearbox">
			<?php if (boomAllow(89)) { ?>
				<div onclick="getSpecialFrames();" class="listing_element">
					<i class="fa fa-image listing_icon bgrad3"></i> الاطارات الخاصة
				</div>
			<?php } ?>
			<?php if ($data['verified'] == 0 && canVerify()) { ?>
				<div id="verify_hide" onclick="getVerify();" class="listing_element">
					<i class="fa fa-check listing_icon success"></i><?php echo $lang['verify_account']; ?>
				</div>
			<?php } ?>
			<?php if (isMember($data) && isSecure($data)) { ?>
				<div onclick="getEmail();" class="listing_element">
					<i class="fa fa-envelope listing_icon default_color"></i><?php echo $lang['edit_email']; ?>
				</div>
			<?php } ?>
			<?php if (isMember($data) && isSecure($data)) { ?>
				<div onclick="getPassword();" class="listing_element">
					<i class="fa fa-key listing_icon theme_color"></i><?php echo $lang['change_password']; ?>
				</div>
			<?php } ?>
		</div>
	</div>
	<?php if (canNameColor()) { ?>
		<div class="modal_zone pad25 hide_zone" id="colors_more">
			<div class="clearbox">
				<div class="preview_zone border_bottom centered_element">
					<p class="label"><?php echo $lang['preview']; ?></p>
					<p id="preview_name" class="<?php echo myColorFont($data); ?>"><?php echo $data['user_name']; ?></p>
				</div>
				<div class="user_edit_color">
					<div class="user_color" data="<?php echo $data['user_color']; ?>">
						<?php if (canNameGrad() || canNameNeon()) { ?>
							<div class="reg_menu_container tmargin10">
								<div class="reg_menu">
									<ul>
										<li class="reg_menu_item reg_selected" data="color_tab" data-z="reg_color"><?php echo $lang['color']; ?></li>
										<?php if (canNameNeon()) { ?>
											<li class="reg_menu_item" data="color_tab" data-z="neon_color"><?php echo $lang['neon']; ?></li>
										<?php } ?>
										<?php if (canNameGrad()) { ?>
											<li class="reg_menu_item" data="color_tab" data-z="grad_color"><?php echo $lang['gradient']; ?></li>
										<?php } ?>
									</ul>
								</div>
							</div>
						<?php } ?>
						<div id="color_tab">
							<div id="reg_color" class="reg_zone vpad5">
								<?php echo colorChoice($data['user_color'], 3); ?>
								<div class="clear"></div>
							</div>
							<?php if (canNameGrad()) { ?>
								<div id="grad_color" class="reg_zone vpad5 hide_zone">
									<?php echo gradChoice($data['user_color'], 3); ?>
									<div class="clear"></div>
								</div>
							<?php } ?>
							<?php if (canNameNeon()) { ?>
								<div id="neon_color" class="reg_zone vpad5 hide_zone">
									<?php echo neonChoice($data['user_color'], 3); ?>
									<div class="clear"></div>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div>
					<?php if (canNameFont()) { ?>
						<div class="setting_element">
							<p class="label"><?php echo $lang['font']; ?></p>
							<select id="fontitname">
								<?php echo listNameFont($data['user_font']); ?>
							</select>
						</div>
					<?php } ?>
					<?php if (!canNameFont()) { ?>
						<input id="fontitname" value="" class="hidden" />
					<?php } ?>
				</div>
				<div class="tpad10">
					<button onclick="saveNameColor();" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
</div>
<?php if (!empty($data['ex_pro_colors'])) { ?>
	<script>
		$('.listing_text').css('color', 'white');
	</script>
<?php } ?>
<?php if (empty($data['ex_pro_colors'])) { ?>
	<script>
		$('.listing_text, .listing_title').css('color', 'black');
	</script>
<?php } ?>
<script>
	function copyRefererLink() {
		/* Get the text field */
		var copyText = document.getElementById("referer_user_link");

		/* Select the text field */
		copyText.select();
		copyText.setSelectionRange(0, 99999); /* For mobile devices */

		/* Copy the text inside the text field */
		navigator.clipboard.writeText(copyText.value);

		/* Alert the copied text */
		alert("تم نسخ رابط الدعوة");
	}
</script>