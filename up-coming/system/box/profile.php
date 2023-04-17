<?php
require('../config_session.php');

if (!isset($_POST['get_profile'], $_POST['cp'])) {
	die();
}
$id = escape($_POST['get_profile']);
$curpage = escape($_POST['cp']);
$user = boomUserInfo($id);
$user2 = userRoomDetails($id);
if (empty($user)) {
	echo 2;
	die();
}
$user['page'] = $curpage;
$pro_menu = boomTemplate('element/pro_menu', $user);
$room = roomInfo($user['user_roomid']);
$ignore = getIgnore();
if (!empty($user['my_border'])) {
	$frame_div = '<div class="" style="position: relative;  top: -128px; left: -2px; ">
					<div class="dummy-child" style="display: inline-block;vertical-align: middle;"></div>
					<img class="fancybox avatar_profile_round under" ' . profileAvatar($user['user_tumb']) . '>
					<img src="images/border/' . $user['my_border'] . '" class="over_pro" style="width: 128px;">
				</div>';
}
if (empty($user['my_border'])) {
	$frame_div = '<div class="avatar_spin">
					<img class="fancybox avatar_profile" ' . profileAvatar($user['user_tumb']) . ' />
				</div>
				' . userActive($user, 'state_profile') . '';
}
?>
<style>
	.listing_element .video_container {
		width: 200px;
		padding-bottom: 29.25%;
	}

	.listing_element .video_container iframe {
		height: auto;
		width: 200px;
	}
</style>
<div <?php echo setProfileShadows($user); ?>>
	<div class="modal_wrap_top modal_top profile_background <?php echo coverClass($user); ?>" <?php echo getCover($user); ?>>
		<div class="brow">
			<div class="bcell">
				<div class="modal_top_menu">
					<div class="bcell_mid hpad15">
					</div>
					<div class="modal_top_menu_empty">
					</div>
					<div class="cancel_modal cover_text modal_top_item">
						<i class="fa fa-times"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="brow">
			<div class="bcell_bottom profile_top">
				<div class="btable_auto">
					<div id="proav" class="profile_avatar_round" data="<?php echo $user['user_tumb']; ?>">
						<?php echo $frame_div; ?>
					</div>
					<div <?php if (!empty($user['my_border'])) { ?> style="pagging: 0 25px 0 0;" <?php } ?> class="profile_tinfo">
						<div class="pdetails">
							<div class="pdetails_text pro_rank cover_text">
								<?php if (verified($user)) { ?>
									<img style="display: inline-block;" class="status_icon" src="default_images/status/online.svg">
								<?php } ?>
								<?php echo proRanking($user, 'pro_ranking'); ?>
							</div>
						</div>
						<div class="pdetails">
							<div <?php if($user['user_rank'] >= 89){echo 'style="font-size:25px;"';} ?> class="pdetails_text pro_name <?php if($user['user_rank'] >= 89){echo $user['user_color'];} ?>">
								<?php echo $user['user_name']; ?>
							</div>
						</div>
						<div class="pdetails">
							<?php if (!empty($user['user_mood'])) { ?>
								<div class="pdetails_text pro_mood bellips cover_text">
									<?php echo $user['user_mood']; ?>
								</div>
							<?php } ?>
						</div>
						<div class="pdetails cover_text">
							<div class="pdetails_text">
								<?php if (!mySelf($user['user_id']) && !ignored($user) && insideChat($user['page'])) { ?>
									<button data="<?php echo $user['user_id']; ?>" value="<?php echo $user['user_name']; ?>" data-av="<?php echo myAvatar($user['user_tumb']); ?>" data-ask="<?php echo $user['private_ask']; ?>" class="tiny_button theme_btn gprivate"><i class="fa fa-comments"></i> <span class="hide_mobile">محادثة خاصة</span></button>
								<?php } ?>
								<?php if (!mySelf($user['user_id']) && canFriend($user) && !ignored($user) && isMember($data) && isMember($user) && $user['friend_ask'] == 1) { ?>
									<button onclick="addFriend(<?php echo $user['user_id']; ?>);" class="tiny_button ok_btn"><i class="fa fa-user-plus"></i> <span class="hide_mobile">اضافة صديق</span></button>
								<?php } ?>
								<?php if (!mySelf($user['user_id']) && !canFriend($user) && !ignored($user) && isMember($data) && isMember($user)) { ?>
									<button onclick="unFriend(<?php echo $user['user_id']; ?>);" class="tiny_button delete_btn"><i class="fa fa-user-times"></i> <span class="hide_mobile">ازالة صديق</span></button>
								<?php } ?>
								<?php if (!isIgnored($ignore, $user['user_id']) && canIgnore($user)) { ?>
									<button onclick="ignoreUser(<?php echo $user['user_id']; ?>);" class="tiny_button delete_btn"><i class="fa fa-ban"></i> <span class="hide_mobile">تجاهل</span></button>
								<?php } ?>
								<?php if (isIgnored($ignore, $user['user_id'])) { ?>
									<button onclick="unIgnore(<?php echo $user['user_id']; ?>);" class="tiny_button ok_btn"><i class="fa fa-check-circle"></i> <span class="hide_mobile">ازالة التجاهل</span></button>
								<?php } ?>
								<?php if (!mySelf($user['user_id']) && !isBot($user) && canReport() && $user['user_rank'] < 100) { ?>
									<button onclick="openReport(<?php echo $user['user_id']; ?>, 4);" class="tiny_button warn_btn"><i class="fa fa-flag"></i> <span class="hide_mobile">بلاغ</span></button>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if (isRegmute($user) && !isMuted($user) && !isBanned($user)) { ?>
		<div class="im_muted profile_info_box theme_btn">
			<i class="fa fa-exclamation-circle"></i> <?php echo $lang['user_regmuted']; ?>
		</div>
	<?php } ?>
	<?php if (isMuted($user) && !isBanned($user)) { ?>
		<div class="im_muted profile_info_box warn_btn">
			<i class="fa fa-exclamation-circle"></i> <?php echo $lang['user_muted']; ?>
		</div>
	<?php } ?>
	<?php if (isBanned($user)) { ?>
		<div class="im_banned profile_info_box delete_btn">
			<i class="fa fa-exclamation-circle"></i> <?php echo $lang['user_banned']; ?>
		</div>
	<?php } ?>
	<div class="modal_menu <?php echo $user['ex_pro_colors']; ?>">
		<ul>
			<li class="modal_menu_item modal_selected" data="mprofilemenu" data-z="profile_info"><?php echo $lang['about_me']; ?></li>
			<?php if (!isGuest($user) && !isBot($user) && accessProLimits($user['user_id'], $user['friends_access'])) { ?>
				<li class="modal_menu_item" data="mprofilemenu" onclick="lazyBoom('profile_friends');" data-z="profile_friends"><?php echo $lang['friends']; ?></li>
			<?php } ?>
			<?php if (boomAllow(10) && !isGuest($user) && !isBot($user) && !mySelf($user['user_id'])) { ?>
				<li class="modal_menu_item" data="mprofilemenu" data-z="points_zone">النقاط</li>
			<?php } ?>
			<?php if (!isBot($user) && boomAllow(0)) { ?>
				<li class="modal_menu_item" data="mprofilemenu" data-z="prodetails"><?php echo $lang['main_info']; ?></li>
			<?php } ?>
			<?php if (canEditUser($user, 95) && isGreater($user['user_rank']) && $data['no_perm'] == 1 || boomRole(4) && betterRole($user2['room_ranking']) && !isOwner($user) && $data['no_perm'] == 1) { ?>
				<li class="modal_menu_item" data="mprofilemenu" data-z="do_action"><?php echo $lang['do_action']; ?></li>
			<?php } ?>
			<?php if (canEditUser($user, 97) && isGreater($user['user_rank'])) { ?> 
				<li onclick="editUser(<?php echo $user['user_id']; ?>);" class="modal_menu_item" data="mprofilemenu" data-z="void"><?php echo $lang['edit']; ?></li>
			<?php } ?>
			<?php if (canUserHistory($user)) { ?>
			<li class="modal_menu_item" data="mprofilemenu" data-z="admin_history_box" onclick="actionHistory(<?php echo $user['user_id']; ?>);">السجلات</li>
			<?php } ?>
			<?php if (boomAllow(100)) { ?>
			<li class="modal_menu_item" data="mprofilemenu" data-z="admin_shistory_box">Security</li>
			<?php } ?>
		</ul>
	</div>
	<div id="mprofilemenu" <?php echo setProfileColors($user); ?>>
		<div class="modal_zone pad25 tpad15" id="profile_info">
			<div class="clearbox">
				<?php if (boomAllow(100) && !empty($user['referer_link'])) { ?>
					<div class="listing_element info_pro">
						<p class="listing_title">رابط الدخول لأول مرة</p>
						<p class="listing_text"><?php echo $user['referer_link']; ?></p>
					</div>
				<?php } ?>
				<?php if (!isGuest($user) && !isOwner($user)) { ?>
					<div class="listing_element info_pro">
						<p class="listing_title">عدد دعوات الاصدقاء</p>
						<p class="listing_text"><?php echo refererUserCount($user['user_id']); ?></p>
					</div>
				<?php } ?>
				<?php if ($user['eshtrak_time'] > 0 && boomAllow(100) || $user['eshtrak_time'] > 0 && mySelf($user['user_id'])) { ?>
					<div class="listing_element info_pro">
						<div class="listing_title">الوقت المتبقي لانتهاء الاشتراك 
						<?php if(boomAllow(100) && $data['base_rank'] == 0){ ?>
							<span style="font-size:12px;" onclick="cancelThisSubscribe(<?php echo $user['user_id']; ?>);" class="tiny_button delete_btn"><i class="fa fa-times"></i> انهاء الاشتراك</span>
						<?php } ?>
						</div>
						<div class="listing_text"><?php echo boomTimeLeft($user['eshtrak_time']); ?></div>
						<div class="listing_text">الرتبة الاساسية <?php echo rankTitle($user['base_rank']); ?></div>
					</div>
				<?php } ?>
				<?php if (boomAge($user['user_age'])) { ?>
					<div class="listing_element info_pro">
						<div class="listing_title"><?php echo $lang['age']; ?></div>
						<div class="listing_text"><?php echo getUserAge($user['user_age']); ?></div>
					</div>
				<?php } ?>
				<?php if (boomSex($user['user_sex'])) { ?>
					<div class="listing_element info_pro">
						<div class="listing_title"><?php echo $lang['gender']; ?></div>
						<div class="listing_text"><?php echo getGender($user['user_sex']); ?></div>
					</div>
				<?php } ?>
				<?php if (usercountry($user['country'])) { ?>
					<div class="listing_element info_pro">
						<div class="listing_title"><?php echo $lang['country']; ?></div>
						<div class="listing_text"><?php echo countryName($user['country']); ?></div>
					</div>
				<?php } ?>
				<div class="listing_element info_pro">
					<div class="listing_title"><?php echo $lang['join_chat']; ?></div>
					<div class="listing_text"><?php echo longDate($user['user_join']); ?></div>
				</div>
				<?php if (boomAllow(100) && !isBot($user) || isVisible($user) && !isBot($user)) { ?>
					<div class="listing_element info_pro">
						<div class="listing_title">اخر تواجد</div>
						<div class="listing_text"><?php echo displayDate($user['last_action']) . ' <b>غرفة : </b>' . $room['room_name']; ?></div>
					</div>
				<?php } ?>
				<?php if (accessProLimits($user['user_id'], $user['points_access']) || mySelf($user['user_id']) || boomAllow(100)) { ?>
					<div class="listing_element info_pro">
						<div class="listing_title">النقاط</div>
						<div class="listing_text"><?php echo $user['user_points']; ?></div>
						<?php if ($user['user_rank'] < 88 && $user['user_rank'] > 0) { ?>
							<div class="listing_title">النقاط المطلوبه للمستوى القادم</div>
							<div class="listing_text"><?php echo setUserExp($user) - $user['user_points']; ?></div>
						<?php } ?>
					</div>
				<?php } ?>
				<?php if ($user['user_rank'] < 87 && $user['user_warn'] > 0) { ?>
					<div class="listing_element info_pro">
						<div class="listing_title">التحذيرات 
						<?php if(boomAllow(100)){ echo '<span onclick="delAllUserWarns('. $user['user_id'] .');" style="font-size:12px;" class="tiny_button delete_btn"><i class="fa fa-times"></i> تصفير</span>'; } ?>
						</div>
						<div class="listing_text"><?php echo $user['user_warn']; ?></div>
					</div>
				<?php } ?>
				<?php if ($user['user_about'] != '') { ?>
					<div class="listing_element info_pro">
						<div class="listing_title"><?php echo $lang['about_me']; ?></div>
						<div class="listing_text">
							<?php
							if ($user['user_rank'] >= 20) {
								echo boomPostIt($user, $user['user_about']);
							} else {
								echo boomFormat($user['user_about']);
							}
							?>
						</div>
					</div>
				<?php } ?>
			</div>

		</div>
		<?php if (!isBot($user) && boomAllow(0)) { ?>
			<div class="hide_zone  pad25 tpad15 modal_zone" id="prodetails">
				<div class="clearbox">
						<div class="listing_element info_pro">
							<div class="listing_title"><?php echo $lang['language']; ?></div>
							<div class="listing_text"><?php echo $user['user_language']; ?></div>
						</div>
						<div class="listing_element info_pro">
							<div class="listing_title"><?php echo $lang['user_theme']; ?></div>
							<div class="listing_text"><?php echo boomUserTheme($user); ?></div>
						</div>
							<div class="listing_element info_pro">
								<div class="listing_title"><?php echo $lang['user_timezone']; ?></div>
								<div class="listing_text"><?php echo $user['user_timezone']; ?></div>
							</div>
					<?php if (boomAllow(99)) { ?>
						<?php if (canViewEmail($user)) { ?>
							<div class="listing_element info_pro">
								<div class="listing_title"><?php echo $lang['email']; ?></div>
								<div class="listing_text"><?php echo $user['user_email']; ?></div>
							</div>
						<?php } ?>
						<?php if (canViewIp($user)) { ?>
							<div class="listing_element info_pro">
								<div class="listing_title"><?php echo $lang['ip']; ?></div>
								<div class="listing_text"><?php echo $user['user_ip']; ?></div>
							</div>
						<?php } ?>
						<?php if (canViewId($user)) { ?>
							<div class="listing_element info_pro">
								<div class="listing_title"><?php echo $lang['user_id']; ?></div>
								<div class="listing_text"><?php echo $user['user_id']; ?></div>
							</div>
						<?php } ?>
					<?php } ?>
					<?php if (boomAllow(97) && isGreater($user['user_rank'])) { ?>
						<div class="listing_element info_pro">
							<div class="listing_title"><?php echo $lang['other_account']; ?></div>
							<div class="listing_text"><?php echo sameAccount($user); ?></div>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
		<?php if (!isGuest($user) && !isBot($user) && accessProLimits($user['user_id'], $user['friends_access'])) { ?>
			<div class="hide_zone pad20 modal_zone" id="profile_friends">
				<?php echo findFriend($user); ?>
				<div class="clear"></div>
			</div>
		<?php } ?>
		<?php if (canUserHistory($user)) { ?>
			<div class="hide_zone modal_zone" id="admin_history_box">
				<div id="history_list" class="box_height400 clearbox pad15">
					<?php echo emptyZone($lang['fetching']); ?>
				</div>
			</div>
		<?php } ?>
		<?php if (boomAllow(100)) { ?>
			<div class="hide_zone modal_zone" id="admin_shistory_box">
				<div id="shistory_list" class="box_height400 clearbox pad15">
					<div class="listing_element info_pro">
							<p class="pro_title"><i class="fa fa-desktop"></i> معلومات الجهاز</p>
							<p class="sub_text text_small pro_text"><?php echo $user['device_info']; ?></p>
							<p class="sub_text text_small pro_text"><?php echo $user['device_ver']; ?></p>
							<?php if ($user['device_info'] != 'Computer / Laptop') { ?>
							<p class="sub_text text_small pro_text">الاصدار: <?php echo $user['android_ver']; ?></p>
							<?php } ?>
						</div>
						<div class="listing_element info_pro">
							<p class="pro_title"><i class="fa fa-key"></i> سيريال الجهاز <button onclick="bannedUserDevice('<?php echo $user['user_id'] ?>', '<?php echo $user['device_code'] ?>', '<?php echo $user['device_info'] ?>', '<?php echo $user['device_ver'] ?>');" style="padding: 4px 6px;border: 1px dashed white;box-shadow: 0 0 5px grey;" class="reg_button delete_btn"><i class="fa fa-ban"></i> Banned Device</button></p>
							<p class="sub_text text_small pro_text"><?php echo $user['device_code']; ?> </p>
						</div>
						<?php if (!empty(sameAccountDC($user))) { ?>
						<div class="listing_element info_pro">
							<p class="pro_title"><i class="fa fa-users"></i> حسابات اخرى تستخدم نفس الجهاز</p>
							<p class="sub_text text_small pro_text"><?php echo sameAccountDC($user); ?></p>
						</div>
						<?php } ?>
						<div class="listing_element info_pro">
							<p class="pro_title"><i class="fab fa-edge"></i> معلومات المتصفح <button onclick="bannedUserBrowser('<?php echo $user['user_browser']; ?>', <?php echo $user['user_id'] ?>, '<?php echo $user['browser_ver']; ?>');" style="padding: 4px 6px;border: 1px dashed white;box-shadow: 0 0 5px grey;" class="reg_button delete_btn"><i class="fa fa-ban"></i> Banned Browser</button></p>
							<p class="sub_text text_small pro_text">المتصفح: <?php echo $user['user_browser']; ?></p>
							<p class="sub_text text_small pro_text">الاصدار: <?php echo $user['browser_ver']; ?></p>
							<p class="sub_text text_small pro_text"><?php echo $user['device_ua']; ?></p>
						</div>
						<div class="listing_element info_pro">
							<p class="pro_title"><i class="fa fa-globe"></i> معلومات الموقع <button onclick="bannedUserCountry('<?php echo $user['geo_country']; ?>', <?php echo $user['user_id'] ?>);" style="padding: 4px 6px;border: 1px dashed white;box-shadow: 0 0 5px grey;" class="reg_button delete_btn"><i class="fa fa-ban"></i> Banned Country</button></p>
							<p class="sub_text text_small pro_text">الدولة: <?php echo $user['geo_country']; ?></p>
							<p class="sub_text text_small pro_text">المدينة: <?php echo $user['geo_city']; ?></p>
							<p class="sub_text text_small pro_text">المنطقة الزمنية: <?php echo $user['geo_zip']; ?></p>
							<p class="sub_text text_small pro_text">القارة: <?php echo $user['geo_cont']; ?></p>
						</div>
				</div>
			</div>
		<?php } ?>
		<?php if (!isGuest($user) && !isBot($user) && boomAllow(10) && !mySelf($user['user_id'])) { ?>
			<div class="hide_zone pad20 modal_zone" id="points_zone">
				<?php if(boomAllow(100)){ ?>
				<div class="setting_element">
					<p class="text_med bold">اضافة نقاط للعضو</p>
					<p class="label">قم بادخال عدد النقاط التي تريد اضافتها للعضو</p>
					<input value="0" id="add_points_to_user" type="number" class="full_input">
					<button onclick="addPointsToUser(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn tmargin10"><i class="fa fa-save"></i> حفظ</button>
				</div>
				<div class="setting_element">
					<p class="text_med bold">خصم نقاط للعضو</p>
					<p class="label">قم بادخال عدد النقاط التي تريد خصمها للعضو</p>
					<input value="0" id="take_points_to_user" type="number" class="full_input">
					<button onclick="takePointsToUser(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn tmargin10"><i class="fa fa-save"></i> حفظ</button>
				</div>
				<?php } ?>
				<div class="setting_element">
					<p class="text_med bold">ارسال النقاط</p>
					<p class="label">قم باختيار عدد النقاط التي تريد ارسالها للعضو</p>
					<p class="label centered_element error">
					* يرجى الانتباه انه سيتم خصم 50% اضافيه من نقاطك من مجموع النقاط التي ستقوم بارسالها
					</p>
					<select id="send_user_points">
						<option value="50">50</option>
						<option value="100">100</option>
						<option value="200">200</option>
						<option value="300">300</option>
						<option value="400">400</option>
						<option value="500">500</option>
						<option value="1000">1000</option>
						<option value="2000">2000</option>
						<option value="3000">3000</option>
						<option value="4000">4000</option>
						<option value="5000">5000</option>
					</select>
					<button onclick="sendUserPoints(<?php echo $user['user_id']; ?>);" class="reg_button theme_btn tmargin10"><i class="fa fa-share"></i> ارسال النقاط</button>
				</div>
			</div>
		<?php } ?>
		<?php if (boomAllow(95) && isGreater($user['user_rank']) && !mySelf($user['user_id']) && $data['no_perm'] == 1 || boomRole(4) && betterRole($user2['room_ranking']) && !mySelf($user['user_id']) && $data['no_perm'] == 1) { ?>
			<div class="hide_zone pad20 modal_zone" id="do_action">
			<?php if (boomAllow(95) && isGreater($user['user_rank']) && !mySelf($user['user_id'])) { ?>
				<p class="text_med bold">العمل الرئيسي</p>
				<?php if (!isGuest($user) && isOwner($data) || !isGuest($user) && $data['user_rank'] == 97 && $user['user_rank'] < 6 || !isGuest($user) && $data['user_rank'] == 98 && $user['user_rank'] < 11 || !isGuest($user) && $data['user_rank'] == 99 && $user['user_rank'] < 21) { ?>
					<div class="setting_element">
						<p class="label"><?php echo $lang['user_rank']; ?></p>
						<select id="profile_rank" onchange="changeRank(this, <?php echo $user['user_id']; ?>);">
							<?php echo changeRank($user['user_rank']); ?>
						</select>
					</div>
				<?php } ?>
				<?php if (canEditUser($user, 95, 1)) { ?>
					<div class="setting_element">
						<p class="label"><?php echo $lang['do_action']; ?></p>
						<select id="set_user_action" onchange="takeAction(this, <?php echo $user['user_id']; ?>);">
							<?php echo listAction($user); ?>
						</select>
					</div>
				<?php } ?>
			<?php } ?>
				<?php if (isOwner($data)) { ?>
					<div class="tpad15">
						<p class="text_med bold">نشاط الغرفة</p>
						<?php if (isOwner($data)) { ?>
							<div class="setting_element">
								<p class="label"><?php echo $lang['room_rank']; ?></p>
								<select onChange="changeRoomRank(<?php echo $user['user_id']; ?>);" id="room_staff_rank">
									<?php echo listRoomRank($user2['room_ranking']); ?>
								</select>
							</div>
						<?php } ?>
						<?php if (isOwner($data) && $user['user_role'] < 4) { ?>
							<div class="setting_element">
								<p class="label"><?php echo $lang['do_action']; ?></p>
								<select id="set_room_action" onchange="takeAction(this, <?php echo $user['user_id']; ?>);">
									<?php echo listRoomAction($user2); ?>
								</select>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
				<?php if (boomRole(4)) { ?>
					<div class="tpad15">
						<p class="text_med bold">نشاط الغرفة</p>
						<?php if (boomRole(6)) { ?>
							<div class="setting_element">
								<p class="label"><?php echo $lang['room_rank']; ?></p>
								<select onChange="changeRoomRank(<?php echo $user['user_id']; ?>);" id="room_staff_rank">
									<?php echo listRoomRank($user2['room_ranking']); ?>
								</select>
							</div>
						<?php } ?>
						<?php if (boomRole(4) && betterRole($user2['room_ranking'])) { ?>
							<div class="setting_element">
								<p class="label"><?php echo $lang['do_action']; ?></p>
								<select id="set_room_action" onchange="takeAction(this, <?php echo $user['user_id']; ?>);">
									<option value="no_action">لا شيء</option>
									<?php if ($data['user_role'] == 4 && $user['user_rank'] < 95) { ?>
									<option value="room_unmute">فك كتم</option>
									<option value="room_mute">كتم</option>
									<?php } ?>
									<?php if ($data['user_role'] == 5 && $user['user_rank'] < 95) { ?>
									<option value="room_unmute">فك كتم</option>
									<option value="room_mute">كتم</option>
									<option value="room_block">طرد</option>
									<?php } ?>
									<?php if ($data['user_role'] == 6 && $user['user_rank'] < 100) { ?>
									<option value="room_unmute">فك كتم</option>
									<option value="room_mute">كتم</option>
									<option value="room_block">طرد</option>
									<option value="room_unmute">فك الطرد</option>
									<?php } ?>
								</select>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
		
	</div>
</div>
<?php if (!empty($user['ex_pro_colors'])) { ?>
	<script>
		$('.listing_text').css('color', 'white');
	</script>
<?php } ?>
<?php if (empty($user['ex_pro_colors'])) { ?>
	<script>
		$('.listing_text, .listing_title').css('color', 'black');
	</script>
<?php } ?>
<?php if (!empty($user['ex_pro_music'])) { ?>
	<audio autoplay="true" loop="true" src="upload/upload/<?php echo $user['ex_pro_music']; ?>"></audio>
<?php } ?>
