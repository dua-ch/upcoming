<?php
require_once('config_session.php');

if (isset($_POST['prv_ask'])) {
    $ask = escape($_POST['prv_ask']);
    if (!boomAllow(0)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET private_ask = '$ask' WHERE user_id = '{$data['user_id']}'");
    echo 1;
    die();
}

if (isset($_POST['allow_friend'])) {
    $af = escape($_POST['allow_friend']);
    if (!boomAllow(0)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET friend_ask = '$af' WHERE user_id = '{$data['user_id']}'");
    echo 1;
    die();
}

if (isset($_POST['points_access'])) {
    $pa = escape($_POST['points_access']);
    if (!boomAllow(0)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET points_access = '$pa' WHERE user_id = '{$data['user_id']}'");
    echo 1;
    die();
}

if (isset($_POST['friends_access'])) {
    $fa = escape($_POST['friends_access']);
    if (!boomAllow(0)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET friends_access = '$fa' WHERE user_id = '{$data['user_id']}'");
    echo 1;
    die();
}

if (isset($_POST['join_logs'])) {
    $ja = escape($_POST['join_logs']);
    if (!boomAllow(0)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET join_logs = '$ja' WHERE user_id = '{$data['user_id']}'");
    echo 1;
    die();
}

if (isset($_POST['ask_user_to_talk'])) {
    $userid = escape($_POST['ask_user_to_talk']);
	$user = userDetails($userid);
    $mSql = $mysqli->query("SELECT * FROM prv_ask WHERE uid = '{$data['user_id']}' AND asker = '$userid'");
    if ($mSql->num_rows == 0) {
        $mysqli->query("INSERT INTO prv_ask (uid, asker, status, lock_creator) VALUES ('{$data['user_id']}', '$userid', '1', '{$data['user_id']}')");
        $last_id = $mysqli->insert_id;
        if(boomAllow(100)){
            $mysqli->query("UPDATE prv_ask SET status = '2' WHERE id = '$last_id'");
        }
		if(!boomAllow(100)){
            boomNotify('prv_ask', array("hunter" => $data['user_id'], "target" => $user['user_id'], "source" => 'prv_ask'));
        }
		
        echo 1;
        die();
    } else {
        die();
    }
}

if (isset($_POST['accept_user_prv'], $_POST['accept_user_notify'])) {
    $id = escape($_POST['accept_user_prv']);
    $notifyid = escape($_POST['accept_user_notify']);
    $mysqli->query("UPDATE prv_ask SET status = '2' WHERE uid = '$id' AND asker = '{$data['user_id']}'");
    $mysqli->query("UPDATE boom_notification SET notify_type = 'prv_ask_accepted' WHERE id = '$notifyid'");
	if(!boomAllow(100)){
		boomNotify('prv_asker_accepted', array("hunter" => $data['user_id'], "target" => $id, "source" => 'prv_asker_accepted'));
	}
    echo 1;
    die();
}

if (isset($_POST['refuse_user_prv'], $_POST['refuse_user_notify'])) {
    $id = escape($_POST['refuse_user_prv']);
    $notifyid = escape($_POST['refuse_user_notify']);
    $mysqli->query("DELETE FROM prv_ask WHERE uid = '$id' AND asker = '{$data['user_id']}'");
	$mysqli->query("UPDATE boom_notification SET notify_type = 'prv_ask_refused' WHERE id = '$notifyid'");
    echo 1;
    die();
}

if (isset($_POST['close_priv'])) {
    $id = escape($_POST['close_priv']);
	$user = userDetails($id);
    if (!boomAllow(0)) {
        die();
    }
	if($data['user_rank'] < 100 && $user['user_rank'] == 100){
		die();
	}
    $mysqli->query("DELETE FROM prv_ask WHERE uid = '{$data['user_id']}' AND asker = '$id' OR uid = '$id' AND asker = '{$data['user_id']}'");
    echo 1;
    die();
}

if (isset($_POST['change_rank'], $_POST['target'])) {
    $rank = escape($_POST['change_rank']);
    $id = escape($_POST['target']);
    $user = userDetails($id);
    // شروط لمنع العبث بالخاصية
    if (!boomAllow($cody['can_rank'])) {
        die();
    }
    if ($data['user_rank'] < $user['user_rank']) {
        echo 0;
        die();
    }
	if ($data['user_rank'] == 97 && $rank > 5) {
        echo 0;
        die();
    }
    if ($data['user_rank'] == 98 && $rank > 10) {
        echo 0;
        die();
    }
    if ($data['user_rank'] == 99 && $rank > 60) {
        echo 0;
        die();
    }
    if (!checkUserLimits('rank')) {
        echo 2;
        die();
    }
    recordLimits($data, 'rank');
    // تحديث الداتابيز
    $mysqli->query("UPDATE boom_users SET user_rank = '$rank', user_status = 1, user_action = user_action + 1 WHERE user_id = '$id'");
	if( $user['user_rank'] > 88 && $rank < 89){
		$mysqli->query("UPDATE boom_users SET my_border = '', ex_av_border = '', ex_name_bg = '', ex_name_bg_glow = '', ex_pro_colors = '', ex_pro_shadow = '', ex_pro_music = '', user_color = 'user', user_cover = '', user_tumb = 'default_avatar.png', bccolor = 'user', user_font = '' WHERE user_id = '{$user['user_id']}'");
	}
	if($rank < 98 && $user['user_status'] == 6){
		$mysqli->query("UPDATE boom_users SET user_status = 1 WHERE user_id = '$id'");
	}
    // تسجيل العملية في سجل الاحداث للوحة التحكم
    boomConsole('change_rank', array('target' => $user['user_id'], 'rank' => $rank));
    // اشعار تغيير الرتبة
    boomNotify('rank_change', array('target' => $user['user_id'], 'source' => 'rank_change', 'rank' => $rank));
    echo 1;
    die();
}

if (isset($_POST['eshtrak_user'], $_POST['eshtrak_rank'], $_POST['eshtrak_time'])) {
    $id = escape($_POST['eshtrak_user']);
    $rank = escape($_POST['eshtrak_rank']);
    $time = escape($_POST['eshtrak_time']);
    $user = userDetails($id);
	if($user['base_rank'] > 0){
		$oldRank = $user['base_rank'];
	} else {
		$oldRank = $user['user_rank'];
	}
    if (!boomAllow(100)) {
        die();
    }
    if ($time == 0) {
        die();
    }
    if ($time > 1) {
        $format = 'days';
    } else {
        $format = 'day';
    }
    if ($user['eshtrak_time'] == 0) {
        $expire = strtotime('+' . $time . $format . '', time());
    } else {
        $expire = strtotime('+' . $time . $format . '', $user['eshtrak_time']);
    }
    if ($user['base_rank'] == 0) {
        $mysqli->query("UPDATE boom_users SET base_rank = '{$user['user_rank']}' WHERE user_id = '$id'");
    }
    $mysqli->query("UPDATE boom_users SET user_rank = '$rank', eshtrak_time = '$expire', user_action = user_action + 1 WHERE user_id = '$id'");
    $msg = str_replace(
        array('@oldrank@', '@newrank@', '@expire@'),
        array(rankTitle($oldRank), rankTitle($rank), longDate($expire)),
        'تم منحك أشتراك @newrank@ وسينتهي اشتراكك في @expire@ وستعود الى رتبة @oldrank@ بعد انتهاء الاشتراك'
    );
    postPrivate($data['system_id'], $id, $msg);
    echo 1;
    die();
}
function postSystemNews($news, $post_file)
{
    global $mysqli, $data;
    $file_ok = 0;
    if (!checkUserLimits('news')) {
        echo 2;
        die();
    }
    if (empty($news) && empty($post_file)) {
        return 0;
    }
    if ($post_file != '') {
        $get_file = $mysqli->query("SELECT * FROM boom_upload WHERE file_key = '$post_file' AND file_user = '{$data['user_id']}' AND file_complete = '0'");
        if ($get_file->num_rows > 0) {
            $file = $get_file->fetch_assoc();
            $news = $news . ' ' . $data['domain'] . '/upload/news/' . $file['file_name'];
            $file_ok = 1;
        } else {
            if ($news == '') {
                return 0;
            }
        }
    }
    if ($news != '') {
        $mysqli->query("UPDATE boom_users SET user_news = '" . time() . "' WHERE user_id = '{$data['user_id']}'");
        $mysqli->query("INSERT INTO boom_news ( news_poster, news_message, news_date ) VALUE ('{$data['user_id']}', '$news', '" . time() . "')");
        $news_id = $mysqli->insert_id;
        if ($file_ok == 1) {
            $mysqli->query("UPDATE boom_upload SET file_complete = '1', relative_post = '$news_id' WHERE file_key = '$post_file' AND file_user = '{$data['user_id']}'");
        }
        recordLimits($data, 'news');
        updateAllNotify();
        return showNews($news_id);
    } else {
        return 0;
    }
}
if (isset($_POST['add_news'], $_POST['post_file']) && boomAllow($cody['can_post_news'])) {
    $news = clearBreak($_POST['add_news']);
    $news = escape($news);
    $news = trimContent($news);
    $post_file = escape($_POST['post_file']);
    echo postSystemNews($news, $post_file);
    die();
}

if (isset($_POST['target_id'], $_POST['user_new_name'])) {
    $id = escape($_POST['target_id']);
    $name = escape($_POST['user_new_name']);
    $checkName = nameDetails($name);
    $user = userDetails($id);
    $oldName = escape($user['user_name']);
    if (!boomAllow($cody['can_modify_name'])) {
        die();
    }
    if (!empty($checkName)) {
        echo 3;
        die();
    }
    if (!validName($name)) {
        echo 2;
        die();
    }
    // if (!checkUserLimits('user_name')) {
        // echo 4;
        // die();
    // }
    $mysqli->query("UPDATE boom_users SET user_name = '$name' WHERE user_id = '$id'");
    boomConsole('rename_user', array('target' => $user['user_id'], 'custom' => $user['user_name']));
    recordLimits($data, 'user_name');
    echo 1;
    die();
}
if (isset($_POST['user_target'], $_POST['user_color'])) {
    $id = escape($_POST['user_target']);
    $color = escape($_POST['user_color']);
    if (!boomAllow(89) || !boomAllow(100) && !mySelf($id)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET user_color = '$color' WHERE user_id = '$id'");
    echo 1;
    die();
}

if (isset($_POST['user_target'], $_POST['user_name_bg'])) {
    $id = escape($_POST['user_target']);
    $bg = escape($_POST['user_name_bg']);
    if (!boomAllow(89) || !boomAllow(100) && !mySelf($id)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET ex_name_bg = '$bg' WHERE user_id = '$id'");
    echo 1;
    die();
}

if (isset($_POST['user_target'], $_POST['user_av_border'])) {
    $id = escape($_POST['user_target']);
    $bg = escape($_POST['user_av_border']);
    if (!boomAllow(89) ||  !boomAllow(100) && !mySelf($id)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET ex_av_border = '$bg' WHERE user_id = '$id'");
    echo 1;
    die();
}

if (isset($_POST['user_target'], $_POST['user_list_glow'])) {
    $id = escape($_POST['user_target']);
    $glow = escape($_POST['user_list_glow']);
    if (!boomAllow(89) || !boomAllow(100) && !mySelf($id)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET ex_name_bg_glow = '$glow' WHERE user_id = '$id'");
    echo 1;
    die();
}

if (isset($_POST['my_newpro_color'], $_POST['my_pro_color_id'])) {
    $pro_color = escape($_POST['my_newpro_color']);
    $id = escape($_POST['my_pro_color_id']);
    if (!boomAllow(89) || !boomAllow(100) && !mySelf($id)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET ex_pro_colors = '$pro_color' WHERE user_id = '$id'");
    echo 1;
    die();
}
if (isset($_POST['my_newpro_shadow'], $_POST['my_pro_glow_id'])) {
    $pro_shadow = escape($_POST['my_newpro_shadow']);
    $id = escape($_POST['my_pro_glow_id']);
    if (!boomAllow(89) || !boomAllow(100) && !mySelf($id)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET ex_pro_shadow = '$pro_shadow' WHERE user_id = '$id'");
    echo 1;
    die();
}
if (isset($_POST['delete_profile_colors'])) {
    $id = escape($_POST['delete_profile_colors']);
    if (!boomAllow(89) || !boomAllow(100) && !mySelf($id)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET ex_pro_shadow = '', ex_pro_colors = '' WHERE user_id = '$id'");
    echo 1;
    die();
}
if (isset($_POST['delete_profile_song'])) {
    $id = escape($_POST['delete_profile_song']);
    if (!boomAllow(89) || !boomAllow(100) && !mySelf($id)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET ex_pro_music = '' WHERE user_id = '$id'");
    echo 1;
    die();
}
if (isset($_POST['delete_name_bg'])) {
    $id = escape($_POST['delete_name_bg']);
    if (!boomAllow(89) || !boomAllow(100) && !mySelf($id)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET ex_name_bg = '' WHERE user_id = '$id'");
    echo 1;
    die();
}
if (isset($_POST['delete_name_sp_color'])) {
    $id = escape($_POST['delete_name_sp_color']);
    if (!boomAllow(89) || !boomAllow(100) && !mySelf($id)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET user_color = 'user' WHERE user_id = '$id'");
    echo 1;
    die();
}
if (isset($_POST['delete_bg_glow'])) {
    $id = escape($_POST['delete_bg_glow']);
    if (!boomAllow(89) || !boomAllow(100) && !mySelf($id)) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET ex_name_bg_glow = '' WHERE user_id = '$id'");
    echo 1;
    die();
}
if (isset($_POST['del_user_av_border'])) {
    $id = escape($_POST['del_user_av_border']);
    if (!boomAllow(89 || !boomAllow(100) && !mySelf($id))) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET ex_av_border = '' WHERE user_id = '$id'");
    echo 1;
    die();
}
if (isset($_POST['room_style_color'])) {
    $color = escape($_POST['room_style_color']);
    if (boomAllow(100) || boomRole(6)) {
        $mysqli->query("UPDATE boom_rooms SET ex_room_style = '$color' WHERE room_id = '{$data['user_roomid']}'");
        echo 1;
        die();
    } else {
        die();
    }
}
function exDynPanelGifts2(){
	global $data, $lang, $mysqli;
    ini_set('memory_limit', '128M');
    $info = pathinfo($_FILES["room_bg"]["name"]);
    $extension = $info['extension'];
    if (fileError()) {
        echo 1;
        die();
    }
    if (isFile($extension)) {
        echo 1;
        die();
    }
    if (isMusic($extension)) {
        echo 1;
        die();
    }
    $imginfo = getimagesize($_FILES["room_bg"]["tmp_name"]);
    if ($imginfo !== false && boomAllow(100) || boomRole(6)) {
        $file_name = encodeFile($extension);
        move_uploaded_file($_FILES["room_bg"]["tmp_name"], BOOM_PATH . '/upload/upload/' . $file_name);
        $mysqli->query("UPDATE boom_rooms SET ex_room_bg = '$file_name' WHERE room_id = '{$data['user_roomid']}'");
        $mysqli->query("UPDATE boom_users SET user_action = user_action + 1 WHERE user_roomid = '{$data['user_roomid']}'");
        echo 5;
        die();
    } else {
        echo 1;
        die();
    }
}
if (isset($_FILES['room_bg'])) {
    echo exDynPanelGifts2();
}
function exDynPanelGifts3(){
	global $data, $lang, $mysqli;
    ini_set('memory_limit', '128M');
    $info = pathinfo($_FILES["room_icon"]["name"]);
    $extension = $info['extension'];
    if (fileError()) {
        echo 1;
        die();
    }
    if (isFile($extension)) {
        echo 1;
        die();
    }
    if (isMusic($extension)) {
        echo 1;
        die();
    }
    $imginfo = getimagesize($_FILES["room_icon"]["tmp_name"]);
    if ($imginfo !== false && boomAllow(100) || boomRole(6)) {
        $file_name = encodeFile($extension);
        move_uploaded_file($_FILES["room_icon"]["tmp_name"], BOOM_PATH . '/default_images/rooms/' . $file_name);
        $mysqli->query("UPDATE boom_rooms SET ex_room_icon = '$file_name' WHERE room_id = '{$data['user_roomid']}'");
        echo 5;
        die();
    } else {
        echo 1;
        die();
    }
}
if (isset($_FILES['room_icon'])) {
    echo exDynPanelGifts3();
}
function exDynPanelGifts4()
{
    global $data, $lang, $mysqli;
    ini_set('memory_limit', '128M');
    $id = escape($_POST['av_id']);
    $user = userDetails($id);
    $info = pathinfo($_FILES["gif_av"]["name"]);
    $extension = $info['extension'];
    if(!boomAllow(89) || !boomAllow(100) && !mySelf($id)){
        die();
    }
    if (fileError()) {
        echo boomCode(1);
        die();
    }
    if (isFile($extension)) {
        echo boomCode(1);
        die();
    }
    if (isMusic($extension)) {
        echo boomCode(1);
        die();
    }
    $imginfo = getimagesize($_FILES["gif_av"]["tmp_name"]);
    if ($imginfo !== false) {
        $file_name = encodeFile($extension);
        $srcimg = $data['domain'] . '/avatar/' . $file_name;
        move_uploaded_file($_FILES["gif_av"]["tmp_name"], BOOM_PATH . '/avatar/' . $file_name);
        unlinkAvatar($user['user_tumb']);
        $mysqli->query("UPDATE boom_users SET user_tumb = '$file_name' WHERE user_id = '$id'");
        echo boomCode(5, array('data' => $srcimg));
        die();
    }
}
if (isset($_FILES['gif_av'])) {
    echo exDynPanelGifts4();
}
if (isset($_POST['del_room_bg'])) {
    if (boomAllow(100) || boomRole(6)) {
        $mysqli->query("UPDATE boom_rooms SET ex_room_bg = '' WHERE room_id = '{$data['user_roomid']}'");
        $mysqli->query("UPDATE boom_users SET user_action = user_action + 1 WHERE user_roomid = '{$data['user_roomid']}'");
        echo 1;
        die();
    } else {
        die();
    }
}
if (isset($_POST['del_room_icon'])) {
    if (boomAllow(100) || boomRole(6)) {
        $mysqli->query("UPDATE boom_rooms SET ex_room_icon = '' WHERE room_id = '{$data['user_roomid']}'");
        echo 1;
        die();
    } else {
        die();
    }
}
if(isset($_POST['set_photo_frame'], $_POST['set_frame_user'])){
    $frame = escape($_POST['set_photo_frame']);
    $id = escape($_POST['set_frame_user']);
	if(!boomAllow(98)){
        die();
    }
	$mysqli->query("UPDATE boom_users SET my_border = '$frame' WHERE user_id = '$id'");
	echo 1;
	die();
}
if(isset($_POST['delete_photo_frame'])){
    $id = escape($_POST['delete_photo_frame']);
	if(!boomAllow(98)){
        die();
    }
	$mysqli->query("UPDATE boom_users SET my_border = '' WHERE user_id = '$id'");
	echo 1;
	die();
}
if(isset($_POST['cancel_user_esh'])){
    $id = escape($_POST['cancel_user_esh']);
    $user = userDetails($id);
	if(!boomAllow(100)){
        die();
    }
	$mysqli->query("UPDATE boom_users SET user_rank = '{$user['base_rank']}', base_rank = 0, eshtrak_time = 0, user_action = user_action + 1 WHERE user_id = '$id'");
	if($user['base_rank'] < 89){
		$mysqli->query("UPDATE boom_users SET my_border = '', ex_av_border = '', ex_name_bg = '', ex_name_bg_glow = '', ex_pro_colors = '', ex_pro_shadow = '', ex_pro_music = '', user_color = 'user' WHERE user_id = '{$user['user_id']}'");
	}
    boomNotify('eshtrak_end', array('hunter' => $data['system_id'],'target' => $user['user_id']));
	echo 1;
	die();
}
if(isset($_POST['points_for_user'], $_POST['user_pointer'])){
    $points = escape($_POST['points_for_user']);
    $id = escape($_POST['user_pointer']);
    $user = userDetails($id);
	if(!boomAllow(100)){
        die();
    }
	$mysqli->query("UPDATE boom_users SET user_points = user_points + '$points' WHERE user_id = '$id'");
    boomNotify('points_for_user', array('hunter' => $data['user_id'], 'target' => $user['user_id'], 'custom' => $points));
	boomNotify('points_recipt', array('hunter' => $data['system_id'], 'target' => $data['user_id'], 'custom' => $points, 'custom2' => $user['user_name']));
	echo 1;
	die();
}
if(isset($_POST['take_points_to_user'], $_POST['user_pointer'])){
    $points = escape($_POST['take_points_to_user']);
    $id = escape($_POST['user_pointer']);
    $user = userDetails($id);
	if(!boomAllow(100)){
        die();
    }
	$mysqli->query("UPDATE boom_users SET user_points = user_points - '$points' WHERE user_id = '$id'");
    boomNotify('take_points_for_user', array('hunter' => $data['user_id'], 'target' => $user['user_id'], 'custom' => $points));
	echo 1;
	die();
}
if(isset($_POST['del_all_user_warns'])){
    $id = escape($_POST['del_all_user_warns']);
    $user = userDetails($id);
	if(!boomAllow(100)){
        die();
    }
	$mysqli->query("UPDATE boom_users SET user_warn = 0 WHERE user_id = '$id'");
	echo 1;
	die();
}
if(isset($_POST['finger_target'], $_POST['user_finger'])){
    $fingerid = escape($_POST['finger_target']);
    $userid = escape($_POST['user_finger']);
    $user = userDetails($userid);
	if(!boomAllow(99)){
        die();
    }
    if(!isGreater($user['user_rank'])){
        die();
    }
    systemUnBan($user);
    $mysqli->query("DELETE FROM ex_dead_ban WHERE id = '$fingerid' OR target = '$userid'");
    boomConsole('unxban', array('target' => $user['user_id'], 'hunter' => $data['user_id'], 'reason' => 'تم فك الاكس باند'));
	boomHistory('unxban', array('target' => $user['user_id'], 'reason' => 'تم فك الاكس باند'));
	echo 1;
    die();
}
if(isset($_POST['my_moving_color'])){
    $color = escape($_POST['my_moving_color']);
	if(!boomAllow(89)){
        die();
    }
	$mysqli->query("UPDATE boom_users SET user_color = '$color' WHERE user_id = '{$data['user_id']}'");
	echo 1;
	die();
}
if(isset($_POST['change_prv_seen']) && boomAllow(100)){
	$seen = escape($_POST['change_prv_seen']);
	$mysqli->query("UPDATE boom_setting SET private_seen = '$seen' WHERE id > 0");
	echo boomCode(1);
}
if (isset($_POST['lock_private']) && boomAllow(0)) {
	$target = escape($_POST['lock_private']);
	$hunter = escape($data['user_id']);
	$user = userDetails($target);
	if (isOwner($user)) {
		echo 0;
		die();
	}
	$getPrvAsk = $mysqli->query("SELECT * FROM prv_ask WHERE uid = '$hunter' AND asker = '$target' AND lock_creator = '$hunter'
	AND status = '3' OR uid = '$target' AND asker = '$hunter' AND status = '3' AND lock_creator = '$hunter'");
	if ($getPrvAsk->num_rows > 0) {
		echo 2;
		die();
	}
	$getPrvAsk = $mysqli->query("SELECT * FROM prv_ask WHERE uid = '$hunter' AND asker = '$target' OR uid = '$target' AND asker = '$hunter'");
	if ($getPrvAsk->num_rows > 0) {
		$mysqli->query("UPDATE prv_ask SET status = '3', lock_creator = '$hunter' WHERE uid = '$hunter' AND asker = '$target' OR uid = '$target' AND asker = '$hunter'");
	} else {
		$mysqli->query("INSERT INTO prv_ask (uid, asker, status, lock_creator) VALUES ('$hunter', '$target', '3', '$hunter')");
		$mysqli->query("INSERT INTO prv_ask (uid, asker, status, lock_creator) VALUES ('$target', '$hunter', '3', '$hunter')");
	}
	echo 1;
	die();
}
if (isset($_POST['unlock_private']) && boomAllow(0)) {
	$target = escape($_POST['unlock_private']);
	$hunter = escape($data['user_id']);
	$getPrvAsk = $mysqli->query("SELECT * FROM prv_ask WHERE uid = '$hunter' AND asker = '$target' AND status = '3' AND lock_creator = '$hunter'
	OR uid = '$target' AND asker = '$hunter' AND status = '3' AND lock_creator = '$hunter'");
	if ($getPrvAsk->num_rows > 0) {
		$mysqli->query("DELETE FROM prv_ask WHERE uid = '$hunter' AND asker = '$target' AND status = '3' AND lock_creator = '$hunter'");
		$mysqli->query("DELETE FROM prv_ask WHERE asker = '$hunter' AND uid = '$target' AND status = '3' AND lock_creator = '$hunter'");
		echo 1;
		die();
	} else {
		echo 0;
		die();
	}
}
if (isset($_POST['target'], $_POST['target_device'], $_POST['device_version'], $_POST['device_code'])) {
	$t = escape($_POST['target']);
	$d = escape($_POST['target_device']);
	$v = escape($_POST['device_version']);
	$c = escape($_POST['device_code']);
	$user = userDetails($t);
    if (!boomAllow(100)) {
        die();
    }
    $mysqli->query("INSERT INTO ex_dead_device (device, dversion, dcode) VALUES ('$v', '$c', '$d')");
	$mysqli->query("UPDATE boom_users SET ws_reload = 1 WHERE user_id = '$t'");
    echo 1;
    die();
}
if (isset($_POST['remove_ban_device'])) {
	$t = escape($_POST['remove_ban_device']);
    if (!boomAllow(100)) {
        die();
    }
    $mysqli->query("DELETE FROM ex_dead_device WHERE id = '$t'");
    echo 1;
    die();
}
if (isset($_POST['target'], $_POST['target_browser'], $_POST['target_browser_ver'])) {
	$t = escape($_POST['target']);
	$b = escape($_POST['target_browser']);
	$v = escape($_POST['target_browser_ver']);
	$user = userDetails($t);
    if (!boomAllow(100)) {
        die();
    }
    $mysqli->query("INSERT INTO ex_dead_browser (browser, bversion) VALUES ('$b', '$v')");
	$mysqli->query("UPDATE boom_users SET ws_reload = 1 WHERE user_id = '$t'");
    echo 1;
    die();
}
if (isset($_POST['remove_ban_browser'])) {
	$t = escape($_POST['remove_ban_browser']);
    if (!boomAllow(100)) {
        die();
    }
    $mysqli->query("DELETE FROM ex_dead_browser WHERE id = '$t'");
    echo 1;
    die();
}
if (isset($_POST['target'], $_POST['target_country'])) {
	$t = escape($_POST['target']);
	$c = escape($_POST['target_country']);
	$user = userDetails($t);
    if (!boomAllow(100)) {
        die();
    }
    $mysqli->query("INSERT INTO ex_dead_country (country) VALUES ('$c')");
	$mysqli->query("UPDATE boom_users SET ws_reload = 1 WHERE user_id = '$t'");
    echo 1;
    die();
}
if (isset($_POST['add_country_ban'])) {
	$t = escape($_POST['add_country_ban']);
    if (!boomAllow(100)) {
		echo 0;
        die();
    }
    $mysqli->query("INSERT INTO ex_dead_country (country) VALUES ('$t')");
	$lastid = $mysqli->insert_id;
	$get = $mysqli->query("SELECT * FROM ex_dead_country WHERE id = '$lastid'");
	if($get->num_rows > 0){
		$f = $get->fetch_assoc();
		echo boomTemplate('element/ban_country', $f);
		die();
	}
    else {
		echo 0;
		die();
	}
}
if (isset($_POST['remove_ban_country'])) {
	$t = escape($_POST['remove_ban_country']);
    if (!boomAllow(100)) {
        die();
    }
    $mysqli->query("DELETE FROM ex_dead_country WHERE id = '$t'");
    echo 1;
    die();
}