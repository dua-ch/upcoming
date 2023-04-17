<?php
function getIp()
{
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$cloud =   @$_SERVER["HTTP_CF_CONNECTING_IP"];
	$remote  = $_SERVER['REMOTE_ADDR'];
	if (filter_var($cloud, FILTER_VALIDATE_IP)) {
		$ip = $cloud;
	} else if (filter_var($client, FILTER_VALIDATE_IP)) {
		$ip = $client;
	} elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
		$ip = $forward;
	} else {
		$ip = $remote;
	}

	return escape($ip);
}     
function boomTemplate($getpage, $boom = '')
{
	global $data, $lang, $mysqli, $cody;
	$page = BOOM_PATH . '/system/' . $getpage . '.php';
	$structure = '';
	ob_start();
	require($page);
	$structure = ob_get_contents();
	ob_end_clean();
	return $structure;
}
function calHour($h)
{
	return time() - ($h * 3600);
}
function calWeek($w)
{
	return time() - (3600 * 24 * 7 * $w);
}
function calmonth($m)
{
	return time() - (3600 * 24 * 30 * $m);
}
function calDay($d)
{
	return time() - ($d * 86400);
}
function calSecond($sec)
{
	return time() - $sec;
}
function calMinutes($min)
{
	return time() - ($min * 60);
}
function calHourUp($h)
{
	return time() + ($h * 3600);
}
function calWeekUp($w)
{
	return time() + (3600 * 24 * 7 * $w);
}
function calmonthUp($m)
{
	return time() + (3600 * 24 * 30 * $m);
}
function calDayUp($d)
{
	return time() + ($d * 86400);
}
function calMinutesUp($min)
{
	return time() + ($min * 60);
}
function calSecondUp($sec)
{
	return time() + $sec;
}
function boomActive($feature)
{
	if ($feature <= 100) {
		return true;
	}
}
function boomFormat($txt)
{
	$count = substr_count($txt, "\n");
	if ($count > 20) {
		return $txt;
	} else {
		return nl2br($txt);
	}
}
function boomFileVersion()
{
	global $data;
	if ($data['bbfv'] > 1.0) {
		return '?v=' . $data['bbfv'];
	}
	return '';
}
function boomNull($val)
{
	if (is_null($val)) {
		return 0;
	} else {
		return $val;
	}
}
function boomCacheUpdate()
{
	global $mysqli;
	$mysqli->query("UPDATE boom_setting SET bbfv = bbfv + 0.01 WHERE id > 0");
}
function embedMode()
{
	global $data;
	if (isset($_GET['embed'])) {
		return true;
	}
}
function embedCode()
{
	global $data;
	if (isset($_GET['embed'])) {
		return 1;
	} else {
		return 0;
	}
}
function myColor($u)
{
	return $u['user_color'];
}
function myColorFont($u)
{
	return $u['user_color'] . ' ' . $u['user_font'];
}
function myTextColor($u)
{
	return $u['bccolor'] . ' ' . $u['bcbold'] . ' ' . $u['bcfont'];
}
function myAvatar($a)
{
	global $data;
	$path =  '/avatar/';
	if (defaultAvatar($a)) {
		$path =  '/default_images/avatar/';
	}
	return $data['domain'] . $path . $a;
}
function defaultAvatar($a)
{
	if (stripos($a, 'default') !== false) {
		return true;
	}
}
function myCover($a)
{
	global $data;
	return $data['domain'] . '/cover/' . $a;
}
function getCover($user)
{
	global $data;
	if (userHaveCover($user)) {
		return 'style="background-image: url(' . myCover($user['user_cover']) . ');"';
	}
}
function coverClass($user)
{
	global $data;
	if (userHaveCover($user)) {
		return 'cover_size';
	}
}
function userHaveCover($user)
{
	global $data;
	if ($user['user_cover'] != '') {
		return true;
	}
}
function getIcon($icon, $c)
{
	global $data, $lang;
	return '<img class="' . $c . '" src="' . $data['domain'] . '/default_images/icons/' . $icon . boomFileVersion() . '"/>';
}
function boomCode($code, $custom = array())
{
	$def = array('code' => $code);
	$res = array_merge($def, $custom);
	return json_encode($res, JSON_UNESCAPED_UNICODE);
}
function profileAvatar($a)
{
	global $data;
	$path =  '/avatar/';
	if (defaultAvatar($a)) {
		$path =  '/default_images/avatar/';
	}
	return 'href="' . $data['domain'] . $path  . $a . '" src="' . $data['domain'] . $path  . $a . '"';
}
function boomUserTheme($user)
{
	global $data;
	if ($user['user_theme'] == 'system') {
		return $data['default_theme'];
	} else {
		return $user['user_theme'];
	}
}
function linkAvatar($a)
{
	if (preg_match('@^https?://@i', $a)) {
		return true;
	}
}
function escape($t)
{
	global $mysqli;
	return $mysqli->real_escape_string(trim(htmlspecialchars($t, ENT_QUOTES)));
}
function boomSanitize($t)
{
	global $mysqli;
	$t = str_replace(array('\\', '/', '.', '<', '>', '%', '#'), '', $t);
	return $mysqli->real_escape_string(trim(htmlspecialchars($t, ENT_QUOTES)));
}
function softEscape($t)
{
	global $mysqli;
	$atags = '<a><p><h1><h2><h3><h4><img><b><strong><br><ul><li><div><i><span><u><th><td><tr><table><strike><small><ol><hr><font><center><blink><marquee>';
	$t = strip_tags($t, $atags);
	return $mysqli->real_escape_string(trim($t));
}
function exEscape($t)
{
	global $mysqli;
	$atags = '<span>';
	$t = strip_tags($t, $atags);
	return $mysqli->real_escape_string(trim($t));
}
function systemReplace($text)
{
	global $lang;
	$text = str_replace('%bcquit%', $lang['leave_message'], $text);
	$text = str_replace('%bcjoin%', $lang['join_message'], $text);
	$text = str_replace('%bcclear%', $lang['clear_message'], $text);
	$text = str_replace('%spam%', $lang['spam_content'], $text);
	$text = str_replace('%bcname%', $lang['name_message'], $text);
	$text = str_replace('%bckick%', $lang['kick_message'], $text);
	$text = str_replace('%bcban%', $lang['ban_message'], $text);
	$text = str_replace('%bcmute%', $lang['mute_message'], $text);
	return $text;
}
function textReplace($text)
{
	global $data, $lang;
	$text = str_replace('%user%', $data['user_name'], $text);
	return $text;
}
function systemSpecial($content, $type, $custom = array())
{
	global $data, $lang;
	$def = array(
		'content' => $content,
		'type' => $type,
		'delete' => 1,
		'title' => $lang['default_title'],
		'icon' => 'default.svg',
	);
	$template = array_merge($def, $custom);
	return boomTemplate('element/system_log', $template);
}
function specialLogIcon($icon)
{
	global $data;
	return $data['domain'] . '/default_images/special/' . $icon . boomFileVersion();
}
function userDetails($id)
{
	global $mysqli;
	$user = array();
	$getuser = $mysqli->query("SELECT * FROM boom_users WHERE user_id = '$id'");
	if ($getuser->num_rows > 0) {
		$user = $getuser->fetch_assoc();
	}
	return $user;
}
function boomUserInfo($id)
{
	global $mysqli, $data;
	$user = array();
	$getuser = $mysqli->query("SELECT *,
	(SELECT fstatus FROM boom_friends WHERE hunter = '{$data['user_id']}' AND target = '$id') as friendship,
	(SELECT count(ignore_id) FROM boom_ignore WHERE ignorer = '{$data['user_id']}' AND ignored = '$id' OR ignorer = '$id' AND ignored = '{$data['user_id']}' ) as ignored
	FROM boom_users WHERE `user_id` = '$id'");
	if ($getuser->num_rows > 0) {
		$user = $getuser->fetch_assoc();
		$user['friendship'] = boomNull($user['friendship']);
	}
	return $user;
}
function ownAvatar($i)
{
	global $data;
	if ($i == $data['user_id']) {
		return 'glob_av';
	}
	return '';
}
function getUserAge($age)
{
	global $lang;
	return $age . ' ' . $lang['years_old'];
}
function delExpired($d)
{
	if ($d < calSecond(12)) {
		return true;
	}
}
function chatAction($room)
{
	global $mysqli, $data;
	$mysqli->query("UPDATE boom_rooms SET rcaction = rcaction + 1, room_action = '" . time() . "' WHERE room_id = '$room'");
}
function boomExNotify($type, $custom = array())
{
	global $mysqli, $data;
	$def = array(
		'hunter' => $data['system_id'],
		'target' => 0,
		'room' => $data['user_roomid'],
		'rank' => 0,
		'delay' => 0,
		'reason' => '',
		'source' => 'system',
		'sourceid' => 0,
		'custom' => '',
		'custom2' => '',
	);
	$c = array_merge($def, $custom);
	if ($c['target'] == 0) {
		return false;
	}
	$mysqli->query("INSERT INTO boom_notification ( notifier, notified, notify_type, notify_date, notify_source, notify_id, notify_rank, notify_delay, notify_reason, notify_custom, notify_custom2) 
	VALUE ('{$c['hunter']}', '{$c['target']}', '$type', '" . time() . "', '{$c['source']}', '{$c['sourceid']}', '{$c['rank']}', '{$c['delay']}', '{$c['reason']}', '{$c['custom']}', '{$c['custom2']}')");
	updateNotify($c['target']);
}
function setUserExp($user)
{
	$exp = 0;
	if ($user['user_rank'] > 0 && $user['user_rank'] < 10) {
		$exp = $user['user_rank'] * 100;
    } elseif ($user['user_rank'] >= 10 && $user['user_rank'] < 15) {
        $exp = $user['user_rank'] * 150;
    } elseif ($user['user_rank'] >= 15 && $user['user_rank'] < 20) {
        $exp = $user['user_rank'] * 200;
    } elseif ($user['user_rank'] >= 20 && $user['user_rank'] < 25) {
        $exp = $user['user_rank'] * 250;
    } elseif ($user['user_rank'] >= 25 && $user['user_rank'] < 30) {
        $exp = $user['user_rank'] * 300;
    } elseif ($user['user_rank'] >= 30 && $user['user_rank'] < 35) {
        $exp = $user['user_rank'] * 350;
    } elseif ($user['user_rank'] >= 35 && $user['user_rank'] < 40) {
        $exp = $user['user_rank'] * 400;
    } elseif ($user['user_rank'] >= 40 && $user['user_rank'] < 45) {
        $exp = $user['user_rank'] * 450;
    } elseif ($user['user_rank'] >= 45 && $user['user_rank'] < 50) {
        $exp = $user['user_rank'] * 500;
	} elseif ($user['user_rank'] >= 50 && $user['user_rank'] < 55) {
		$exp = $user['user_rank'] * 550;
	} elseif ($user['user_rank'] >= 55 && $user['user_rank'] < 60) {
		$exp = $user['user_rank'] * 600;
	} elseif ($user['user_rank'] >= 60 && $user['user_rank'] < 65) {
		$exp = $user['user_rank'] * 650;
	} elseif ($user['user_rank'] >= 65 && $user['user_rank'] < 70) {
		$exp = $user['user_rank'] * 700;
	} elseif ($user['user_rank'] >= 70 && $user['user_rank'] < 80) {
		$exp = $user['user_rank'] * 750;
	} elseif ($user['user_rank'] >= 80 && $user['user_rank'] < 88) {
		$exp = $user['user_rank'] * 800;
	} elseif ($user['user_rank'] >= 88) {
		$exp = 0;
	}
	return $exp;
}
function getMyRoom($id)
{
	global $data, $mysqli;
	$room = array();
	$get_room = $mysqli->query("SELECT * FROM boom_rooms WHERE room_id = '$id'");
	if ($get_room->num_rows > 0) {
		$room = $get_room->fetch_assoc();
	}
	return $room;
}
function getPostDet($id)
{
	global $data, $mysqli;
	$room = array();
	$get_room = $mysqli->query("SELECT * FROM boom_chat WHERE post_id = '$id'");
	if ($get_room->num_rows > 0) {
		$room = $get_room->fetch_assoc();
	}
	return $room;
}
function userExp()
{
	global $mysqli, $data;

	$maxlevel = 88;
	$next_exp = setUserExp($data) - 1;
	if ($data['user_points'] < $next_exp && $data['user_rank'] < $maxlevel) {
		$mysqli->query("UPDATE boom_users SET user_points = user_points + 1  WHERE user_id = '{$data['user_id']}'");
	} else if ($data['user_points'] >= $next_exp && $data['user_rank'] < $maxlevel) {
		$newlev = $data['user_rank'] + 1; 
		boomExNotify('rank_upgraded', array('target' => $data['user_id'], 'source' => 'rank_change', 'rank' => $newlev));
		$mysqli->query("UPDATE boom_users SET user_points = user_points - $next_exp  WHERE user_id = '{$data['user_id']}'");
		$mysqli->query("UPDATE boom_users SET user_rank = user_rank + 1, user_action = user_action + 1  WHERE user_id = '{$data['user_id']}'");
		$msg = str_replace(array('@user@', '@new@', '@old@'), array((empty($data['fancy_name']) ? $data['user_name'] : $data['fancy_name']), rankTitle($newlev), rankTitle($data['user_rank'])), '<div style="direction: ltr !important;display: contents;"><b style="color:green;"> @user@ </b>, Upgraded from rank (<b style="color:blue;">@old@</b>) to (<b style="color:red;">@new@</b>) by points</div>');
		systemPostChat($data['user_roomid'], $msg);
	} elseif ($data['user_rank'] >= $maxlevel) {
		$mysqli->query("UPDATE boom_users SET user_points = user_points + 1  WHERE user_id = '{$data['user_id']}'");
	}
}
function userPostChat($content, $custom = array())
{
	global $mysqli, $data;
	$def = array(
		'hunter' => $data['user_id'],
		'room' => $data['user_roomid'],
		'color' => escape(myTextColor($data)),
		'type' => 'public__message',
		'rank' => 200,
		'snum' => '',
	);
	$myroom = getMyRoom($data['user_roomid']);
	$c = array_merge($def, $data, $custom);
	$lowname = mb_strtolower($content);
	if(!boomAllow(20)){
		$reserved = array('https', '.chat', '.com','.net', '.org');
		foreach ($reserved as $sreserve) {
			if (stripos($lowname, mb_strtolower($sreserve))) {
				$content = '<span class="system_text">غير سموح لك بارسال روابط</span>';
			}
		}
	}
	$mysqli->query("INSERT INTO `boom_chat` (post_date, user_id, post_message, post_roomid, type, log_rank, snum, tcolor) VALUES ('" . time() . "', '{$c['hunter']}', '$content', '{$c['room']}', '{$c['type']}', '{$c['rank']}', '{$c['snum']}', '{$c['color']}')");
	$last_id = $mysqli->insert_id;
	chatAction($data['user_roomid']);
	$mpost = getPostDet($last_id);
	if ($myroom['allow_points'] > 0 && boomAllow(1) && $mpost['type'] == 'public__message') {
		userExp(); 
	}
	if ($myroom['allow_points'] > 0 && $data['user_rank'] == 0 && $mpost['type'] == 'public__message') {
		$mysqli->query("UPDATE boom_users SET user_points = user_points + 1  WHERE user_id = '{$data['user_id']}'");
	}
	if (!empty($c['snum'])) {
		$user_post = array(
			'post_id' => $last_id,
			'type' => $c['type'],
			'post_date' => time(),
			'tcolor' => $c['color'],
			'log_rank' => $c['rank'],
			'post_message' => $content,
		);
		$post = array_merge($c, $user_post);
		if (!empty($post)) {
			return createLog($data, $post);
		}
	}
}
function userPostChatFile($content, $file_name, $type, $custom = array())
{
	global $mysqli, $data;
	$def = array(
		'type' => 'public__message',
		'file2' => '',
	);
	$c = array_merge($def, $custom);
	$mysqli->query("INSERT INTO `boom_chat` (post_date, user_id, post_message, post_roomid, type, file) VALUES ('" . time() . "', '{$data['user_id']}', '$content', '{$data['user_roomid']}', '{$c['type']}', '1')");
	$rel = $mysqli->insert_id;
	chatAction($data['user_roomid']);
	if ($c['file2'] != '') {
		$mysqli->query("INSERT INTO `boom_upload` (file_name, date_sent, file_user, file_zone, file_type, relative_post) VALUES
		('$file_name', '" . time() . "', '{$data['user_id']}', 'chat', '$type', '$rel'),
		('{$c['file2']}', '" . time() . "', '{$data['user_id']}', 'chat', '$type', '$rel')
		");
	} else {
		$mysqli->query("INSERT INTO `boom_upload` (file_name, date_sent, file_user, file_zone, file_type, relative_post) VALUES ('$file_name', '" . time() . "', '{$data['user_id']}', 'chat', '$type', '$rel')");
	}
	return true;
}
function systemPostChat($room, $content, $custom = array())
{
	global $mysqli, $data;
	$def = array(
		'type' => 'system',
		'color' => 'chat_system',
		'rank' => 99,
	);
	$post = array_merge($def, $custom);
	$mysqli->query("INSERT INTO `boom_chat` (post_date, user_id, post_message, post_roomid, type, log_rank, tcolor) VALUES ('" . time() . "', '{$data['system_id']}', '$content', '$room', '{$post['type']}', '{$post['rank']}', '{$post['color']}')");
	chatAction($room);
	return true;
}
function botPostChat($id, $room, $content, $custom = array())
{
	global $mysqli, $data;
	$def = array(
		'type' => 'public__message',
		'color' => '',
		'rank' => 99,
	);
	$post = array_merge($def, $custom);
	$mysqli->query("INSERT INTO `boom_chat` (post_date, user_id, post_message, post_roomid, type, log_rank, tcolor) VALUES ('" . time() . "', '$id', '$content', '$room', '{$post['type']}', '{$post['rank']}', '{$post['color']}')");
	chatAction($room);
	return true;
}
function postPrivate($from, $to, $content, $snum = '')
{
	global $mysqli, $data;
	$emos = ["😀", "🤭","😁","😂","😃","😄","😅","😆","😇","😈","👿","😉","😊","☺️","😋","😌","😍","😎","😏","😐","😑","😒","😓","😔","😕","😖","😗","😘","😙","😚","😛","😜","😝","😞","😟","😠","😡","😢","😣","😤","😥","😦","😧","😨","😩","😪","😫","😬","😭","😮","😯","😰","😱","😲","😳","😴","😵","😶","😷","😸","😹","😺","😻","😼","😽","😾","😿","🙀","👣","👤","👥","👶","👶🏻","👶🏼","👶🏽","👶🏾","👶🏿","👦","👦🏻","👦🏼","👦🏽","👦🏾","👦🏿","👧","👧🏻","👧🏼","👧🏽","👧🏾","👧🏿","👨","👨🏻","👨🏼","👨🏽","👨🏾","👨🏿","👩","👩🏻","👩🏼","👩🏽","👩🏾","👩🏿","👪","👨‍👩‍👧","👨‍👩‍👧‍👦","👨‍👩‍👦‍👦","👨‍👩‍👧‍👧","👩‍👩‍👦","👩‍👩‍👧","👩‍👩‍👧‍👦","👩‍👩‍👦‍👦","👩‍👩‍👧‍👧","👨‍👨‍👦","👨‍👨‍👧","👨‍👨‍👧‍👦","👨‍👨‍👦‍👦","👨‍👨‍👧‍👧","👫","👬","👭","👯","👰","👰🏻","👰🏼","👰🏽","👰🏾","👰🏿","👱","👱🏻","👱🏼","👱🏽","👱🏾","👱🏿","👲","👲🏻","👲🏼","👲🏽","👲🏾","👲🏿","👳","👳🏻","👳🏼","👳🏽","👳🏾","👳🏿","👴","👴🏻","👴🏼","👴🏽","👴🏾","👴🏿","👵","👵🏻","👵🏼","👵🏽","👵🏾","👵🏿","👮","👮🏻","👮🏼","👮🏽","👮🏾","👮🏿","👷","👷🏻","👷🏼","👷🏽","👷🏾","👷🏿","👸","👸🏻","👸🏼","👸🏽","👸🏾","👸🏿","💂","💂🏻","💂🏼","💂🏽","💂🏾","💂🏿","👼","👼🏻","👼🏼","👼🏽","👼🏾","👼🏿","🎅","🎅🏻","🎅🏼","🎅🏽","🎅🏾","🎅🏿","👻","👹","👺","💩","💀","👽","👾","🙇","🙇🏻","🙇🏼","🙇🏽","🙇🏾","🙇🏿","💁","💁🏻","💁🏼","💁🏽","💁🏾","💁🏿","🙅","🙅🏻","🙅🏼","🙅🏽","🙅🏾","🙅🏿","🙆","🙆🏻","🙆🏼","🙆🏽","🙆🏾","🙆🏿","🙋","🙋🏻","🙋🏼","🙋🏽","🙋🏾","🙋🏿","🙎","🙎🏻","🙎🏼","🙎🏽","🙎🏾","🙎🏿","🙍","🙍🏻","🙍🏼","🙍🏽","🙍🏾","🙍🏿","💆","💆🏻","💆🏼","💆🏽","💆🏾","💆🏿","💇","💇🏻","💇🏼","💇🏽","💇🏾","💇🏿","💑","👩‍❤️‍👩","👨‍❤️‍👨","💏","👩‍❤️‍💋‍👩","👨‍❤️‍💋‍👨","🙌","🙌🏻","🙌🏼","🙌🏽","🙌🏾","🙌🏿","👏","👏🏻","👏🏼","👏🏽","👏🏾","👏🏿","👂","👂🏻","👂🏼","👂🏽","👂🏾","👂🏿","👀","👃","👃🏻","👃🏼","👃🏽","👃🏾","👃🏿","👄","💋","👅","💅","💅🏻","💅🏼","💅🏽","💅🏾","💅🏿","👋","👋🏻","👋🏼","👋🏽","👋🏾","👋🏿","👍","👍🏻","👍🏼","👍🏽","👍🏾","👍🏿","👎","👎🏻","👎🏼","👎🏽","👎🏾","👎🏿","☝","☝🏻","☝🏼","☝🏽","☝🏾","☝🏿","👆","👆🏻","👆🏼","👆🏽","👆🏾","👆🏿","👇","👇🏻","👇🏼","👇🏽","👇🏾","👇🏿","👈","👈🏻","👈🏼","👈🏽","👈🏾","👈🏿","👉","👉🏻","👉🏼","👉🏽","👉🏾","👉🏿","👌","👌🏻","👌🏼","👌🏽","👌🏾","👌🏿","✌","✌🏻","✌🏼","✌🏽","✌🏾","✌🏿","👊","👊🏻","👊🏼","👊🏽","👊🏾","👊🏿","✊","✊🏻","✊🏼","✊🏽","✊🏾","✊🏿","✋","✋🏻","✋🏼","✋🏽","✋🏾","✋🏿","💪","💪🏻","💪🏼","💪🏽","💪🏾","💪🏿","👐","👐🏻","👐🏼","👐🏽","👐🏾","👐🏿","🙏","🙏🏻","🙏🏼","🙏🏽","🙏🏾","🙏🏿","🌱","🌲","🌳","🌴","🌵","🌷","🌸","🌹","🌺","🌻","🌼","💐","🌾","🌿","🍀","🍁","🍂","🍃","🍄","🌰","🐀","🐁","🐭","🐹","🐂","🐃","🐄","🐮","🐅","🐆","🐯","🐇","🐰","🐈","🐱","🐎","🐴","🐏","🐑","🐐","🐓","🐔","🐤","🐣","🐥","🐦","🐧","🐘","🐪","🐫","🐗","🐖","🐷","🐽","🐕","🐩","🐶","🐺","🐻","🐨","🐼","🐵","🙈","🙉","🙊","🐒","🐉","🐲","🐊","🐍","🐢","🐸","🐋","🐳","🐬","🐙","🐟","🐠","🐡","🐚","🐌","🐛","🐜","🐝","🐞","🐾","⚡️","🔥","🌙","☀️","⛅️","☁️","💧","💦","☔️","💨","❄️","🌟","⭐️","🌠","🌄","🌅","🌈","🌊","🌋","🌌","🗻","🗾","🌐","🌍","🌎","🌏","🌑","🌒","🌓","🌔","🌕","🌖","🌗","🌘","🌚","🌝","🌛","🌜","🌞","🍅","🍆","🌽","🍠","🍇","🍈","🍉","🍊","🍋","🍌","🍍","🍎","🍏","🍐","🍑","🍒","🍓","🍔","🍕","🍖","🍗","🍘","🍙","🍚","🍛","🍜","🍝","🍞","🍟","🍡","🍢","🍣","🍤","🍥","🍦","🍧","🍨","🍩","🍪","🍫","🍬","🍭","🍮","🍯","🍰","🍱","🍲","🍳","🍴","🍵","☕️","🍶","🍷","🍸","🍹","🍺","🍻","🍼","🎀","🎁","🎂","🎃","🎄","🎋","🎍","🎑","🎆","🎇","🎉","🎊","🎈","💫","✨","💥","🎓","👑","🎎","🎏","🎐","🎌","🏮","💍","❤️","💔","💌","💕","💞","💓","💗","💖","💘","💝","💟","💜","💛","💚","💙","🏃","🏃🏻","🏃🏼","🏃🏽","🏃🏾","🏃🏿","🚶","🚶🏻","🚶🏼","🚶🏽","🚶🏾","🚶🏿","💃","💃🏻","💃🏼","💃🏽","💃🏾","💃🏿","🚣","🚣🏻","🚣🏼","🚣🏽","🚣🏾","🚣🏿","🏊","🏊🏻","🏊🏼","🏊🏽","🏊🏾","🏊🏿","🏄","🏄🏻","🏄🏼","🏄🏽","🏄🏾","🏄🏿","🛀","🛀🏻","🛀🏼","🛀🏽","🛀🏾","🛀🏿","🏂","🎿","⛄️","🚴","🚴🏻","🚴🏼","🚴🏽","🚴🏾","🚴🏿","🚵","🚵🏻","🚵🏼","🚵🏽","🚵🏾","🚵🏿","🏇","🏇🏻","🏇🏼","🏇🏽","🏇🏾","🏇🏿","⛺️","🎣","⚽️","🏀","🏈","⚾️","🎾","🏉","⛳️","🏆","🎽","🏁","🎹","🎸","🎻","🎷","🎺","🎵","🎶","🎼","🎧","🎤","🎭","🎫","🎩","🎪","🎬","🎨","🎯","🎱","🎳","🎰","🎲","🎮","🎴","🃏","🀄️","🎠","🎡","🎢","🚃","🚞","🚂","🚋","🚝","🚄","🚅","🚆","🚇","🚈","🚉","🚊","🚌","🚍","🚎","🚐","🚑","🚒","🚓","🚔","🚨","🚕","🚖","🚗","🚘","🚙","🚚","🚛","🚜","🚲","🚏","⛽️","🚧","🚦","🚥","🚀","🚁","✈️","💺","⚓️","🚢","🚤","⛵️","🚡","🚠","🚟","🛂","🛃","🛄","🛅","💴","💶","💷","💵","🗽","🗿","🌁","🗼","⛲️","🏰","🏯","🌇","🌆","🌃","🌉","🏠","🏡","🏢","🏬","🏭","🏣","🏤","🏥","🏦","🏨","🏩","💒","⛪️","🏪","🏫","🇦🇺","🇦🇹","🇧🇪","🇧🇷","🇨🇦","🇨🇱","🇨🇳","🇨🇴","🇩🇰","🇫🇮","🇫🇷","🇩🇪","🇭🇰","🇮🇳","🇮🇩","🇮🇪","🇮🇱","🇮🇹","🇯🇵","🇰🇷","🇲🇴","🇲🇾","🇲🇽","🇳🇱","🇳🇿","🇳🇴","🇵🇭","🇵🇱","🇵🇹","🇵🇷","🇷🇺","🇸🇦","🇸🇬","🇿🇦","🇪🇸","🇸🇪","🇨🇭","🇹🇷","🇬🇧","🇺🇸","🇦🇪","🇻🇳","⌚️","📱","📲","💻","⏰","⏳","⌛️","📷","📹","🎥","📺","📻","📟","📞","☎️","📠","💽","💾","💿","📀","📼","🔋","🔌","💡","🔦","📡","💳","💸","💰","💎","🌂","👝","👛","👜","💼","🎒","💄","👓","👒","👡","👠","👢","👞","👟","👙","👗","👘","👚","👕","👔","👖","🚪","🚿","🛁","🚽","💈","💉","💊","🔬","🔭","🔮","🔧","🔪","🔩","🔨","💣","🚬","🔫","🔖","📰","🔑","✉️","📩","📨","📧","📥","📤","📦","📯","📮","📪","📫","📬","📭","📄","📃","📑","📈","📉","📊","📅","📆","🔅","🔆","📜","📋","📖","📓","📔","📒","📕","📗","📘","📙","📚","📇","🔗","📎","📌","✂️","📐","📍","📏","🚩","📁","📂","✒️","✏️","📝","🔏","🔐","🔒","🔓","📣","📢","🔈","🔉","🔊","🔇","💤","🔔","🔕","💭","💬","🚸","🔍","🔎","🚫","⛔️","📛","🚷","🚯","🚳","🚱","📵","🔞","🉑","🉐","💮","㊙️","㊗️","🈴","🈵","🈲","🈶","🈚️","🈸","🈺","🈷","🈹","🈳","🈂","🈁","🈯️","💹","❇️","✳️","❎","✅","✴️","📳","📴","🆚","🅰","🅱","🆎","🆑","🅾","🆘","🆔","🅿️","🚾","🆒","🆓","🆕","🆖","🆗","🆙","🏧","♈️","♉️","♊️","♋️","♌️","♍️","♎️","♏️","♐️","♑️","♒️","♓️","🚻","🚹","🚺","🚼","♿️","🚰","🚭","🚮","▶️","◀️","🔼","🔽","⏩","⏪","⏫","⏬","➡️","⬅️","⬆️","⬇️","↗️","↘️","↙️","↖️","↕️","↔️","🔄","↪️","↩️","⤴️","⤵️","🔀","🔁","🔂","#⃣","0⃣","1⃣","2⃣","3⃣","4⃣","5⃣","6⃣","7⃣","8⃣","9⃣","🔟","🔢","🔤","🔡","🔠","ℹ️","📶","🎦","🔣","➕","➖","〰","➗","✖️","✔️","🔃","™","©","®","💱","💲","➰","➿","〽️","❗️","❓","❕","❔","‼️","⁉️","❌","⭕️","💯","🔚","🔙","🔛","🔝","🔜","🌀","Ⓜ️","⛎","🔯","🔰","🔱","⚠️","♨️","♻️","💢","💠","♠️","♣️","♥️","♦️","☑️","⚪️","⚫️","🔘","🔴","🔵","🔺","🔻","🔸","🔹","🔶","🔷","▪️","▫️","⬛️","⬜️","◼️","◻️","◾️","◽️","🔲","🔳","🕐","🕑","🕒","🕓","🕔","🕕","🕖","🕗","🕘","🕙","🕚","🕛","🕜","🕝","🕞","🕟","🕠","🕡","🕢","🕣","🕤","🕥","🕦","🕧"];
	foreach ($emos as $cleaner) {
		$content = str_replace($cleaner, '<span class="emoji">'.$cleaner.'</span>', $content);
	}
	$mysqli->query("INSERT INTO `boom_private` (time, target, hunter, message) VALUES ('" . time() . "', '$to', '$from', '$content')");
	$last_id = $mysqli->insert_id;
	if ($to != $from) {
		$mysqli->query("UPDATE boom_users SET pcount = pcount + 1 WHERE user_id = '$to'");
	}
	if ($snum != '') {
		$user_post = array(
			'id' => $last_id,
			'time' => time(),
			'message' => $content,
			'hunter' => $from,
		);
		$post = array_merge($data, $user_post);
		if (!empty($post)) {
			return privateLog($post, $post['user_id']);
		}
	}
}
function postPrivateContent($from, $to, $content)
{
	global $mysqli, $data;
	$emos = ["😀", "🤭","😁","😂","😃","😄","😅","😆","😇","😈","👿","😉","😊","☺️","😋","😌","😍","😎","😏","😐","😑","😒","😓","😔","😕","😖","😗","😘","😙","😚","😛","😜","😝","😞","😟","😠","😡","😢","😣","😤","😥","😦","😧","😨","😩","😪","😫","😬","😭","😮","😯","😰","😱","😲","😳","😴","😵","😶","😷","😸","😹","😺","😻","😼","😽","😾","😿","🙀","👣","👤","👥","👶","👶🏻","👶🏼","👶🏽","👶🏾","👶🏿","👦","👦🏻","👦🏼","👦🏽","👦🏾","👦🏿","👧","👧🏻","👧🏼","👧🏽","👧🏾","👧🏿","👨","👨🏻","👨🏼","👨🏽","👨🏾","👨🏿","👩","👩🏻","👩🏼","👩🏽","👩🏾","👩🏿","👪","👨‍👩‍👧","👨‍👩‍👧‍👦","👨‍👩‍👦‍👦","👨‍👩‍👧‍👧","👩‍👩‍👦","👩‍👩‍👧","👩‍👩‍👧‍👦","👩‍👩‍👦‍👦","👩‍👩‍👧‍👧","👨‍👨‍👦","👨‍👨‍👧","👨‍👨‍👧‍👦","👨‍👨‍👦‍👦","👨‍👨‍👧‍👧","👫","👬","👭","👯","👰","👰🏻","👰🏼","👰🏽","👰🏾","👰🏿","👱","👱🏻","👱🏼","👱🏽","👱🏾","👱🏿","👲","👲🏻","👲🏼","👲🏽","👲🏾","👲🏿","👳","👳🏻","👳🏼","👳🏽","👳🏾","👳🏿","👴","👴🏻","👴🏼","👴🏽","👴🏾","👴🏿","👵","👵🏻","👵🏼","👵🏽","👵🏾","👵🏿","👮","👮🏻","👮🏼","👮🏽","👮🏾","👮🏿","👷","👷🏻","👷🏼","👷🏽","👷🏾","👷🏿","👸","👸🏻","👸🏼","👸🏽","👸🏾","👸🏿","💂","💂🏻","💂🏼","💂🏽","💂🏾","💂🏿","👼","👼🏻","👼🏼","👼🏽","👼🏾","👼🏿","🎅","🎅🏻","🎅🏼","🎅🏽","🎅🏾","🎅🏿","👻","👹","👺","💩","💀","👽","👾","🙇","🙇🏻","🙇🏼","🙇🏽","🙇🏾","🙇🏿","💁","💁🏻","💁🏼","💁🏽","💁🏾","💁🏿","🙅","🙅🏻","🙅🏼","🙅🏽","🙅🏾","🙅🏿","🙆","🙆🏻","🙆🏼","🙆🏽","🙆🏾","🙆🏿","🙋","🙋🏻","🙋🏼","🙋🏽","🙋🏾","🙋🏿","🙎","🙎🏻","🙎🏼","🙎🏽","🙎🏾","🙎🏿","🙍","🙍🏻","🙍🏼","🙍🏽","🙍🏾","🙍🏿","💆","💆🏻","💆🏼","💆🏽","💆🏾","💆🏿","💇","💇🏻","💇🏼","💇🏽","💇🏾","💇🏿","💑","👩‍❤️‍👩","👨‍❤️‍👨","💏","👩‍❤️‍💋‍👩","👨‍❤️‍💋‍👨","🙌","🙌🏻","🙌🏼","🙌🏽","🙌🏾","🙌🏿","👏","👏🏻","👏🏼","👏🏽","👏🏾","👏🏿","👂","👂🏻","👂🏼","👂🏽","👂🏾","👂🏿","👀","👃","👃🏻","👃🏼","👃🏽","👃🏾","👃🏿","👄","💋","👅","💅","💅🏻","💅🏼","💅🏽","💅🏾","💅🏿","👋","👋🏻","👋🏼","👋🏽","👋🏾","👋🏿","👍","👍🏻","👍🏼","👍🏽","👍🏾","👍🏿","👎","👎🏻","👎🏼","👎🏽","👎🏾","👎🏿","☝","☝🏻","☝🏼","☝🏽","☝🏾","☝🏿","👆","👆🏻","👆🏼","👆🏽","👆🏾","👆🏿","👇","👇🏻","👇🏼","👇🏽","👇🏾","👇🏿","👈","👈🏻","👈🏼","👈🏽","👈🏾","👈🏿","👉","👉🏻","👉🏼","👉🏽","👉🏾","👉🏿","👌","👌🏻","👌🏼","👌🏽","👌🏾","👌🏿","✌","✌🏻","✌🏼","✌🏽","✌🏾","✌🏿","👊","👊🏻","👊🏼","👊🏽","👊🏾","👊🏿","✊","✊🏻","✊🏼","✊🏽","✊🏾","✊🏿","✋","✋🏻","✋🏼","✋🏽","✋🏾","✋🏿","💪","💪🏻","💪🏼","💪🏽","💪🏾","💪🏿","👐","👐🏻","👐🏼","👐🏽","👐🏾","👐🏿","🙏","🙏🏻","🙏🏼","🙏🏽","🙏🏾","🙏🏿","🌱","🌲","🌳","🌴","🌵","🌷","🌸","🌹","🌺","🌻","🌼","💐","🌾","🌿","🍀","🍁","🍂","🍃","🍄","🌰","🐀","🐁","🐭","🐹","🐂","🐃","🐄","🐮","🐅","🐆","🐯","🐇","🐰","🐈","🐱","🐎","🐴","🐏","🐑","🐐","🐓","🐔","🐤","🐣","🐥","🐦","🐧","🐘","🐪","🐫","🐗","🐖","🐷","🐽","🐕","🐩","🐶","🐺","🐻","🐨","🐼","🐵","🙈","🙉","🙊","🐒","🐉","🐲","🐊","🐍","🐢","🐸","🐋","🐳","🐬","🐙","🐟","🐠","🐡","🐚","🐌","🐛","🐜","🐝","🐞","🐾","⚡️","🔥","🌙","☀️","⛅️","☁️","💧","💦","☔️","💨","❄️","🌟","⭐️","🌠","🌄","🌅","🌈","🌊","🌋","🌌","🗻","🗾","🌐","🌍","🌎","🌏","🌑","🌒","🌓","🌔","🌕","🌖","🌗","🌘","🌚","🌝","🌛","🌜","🌞","🍅","🍆","🌽","🍠","🍇","🍈","🍉","🍊","🍋","🍌","🍍","🍎","🍏","🍐","🍑","🍒","🍓","🍔","🍕","🍖","🍗","🍘","🍙","🍚","🍛","🍜","🍝","🍞","🍟","🍡","🍢","🍣","🍤","🍥","🍦","🍧","🍨","🍩","🍪","🍫","🍬","🍭","🍮","🍯","🍰","🍱","🍲","🍳","🍴","🍵","☕️","🍶","🍷","🍸","🍹","🍺","🍻","🍼","🎀","🎁","🎂","🎃","🎄","🎋","🎍","🎑","🎆","🎇","🎉","🎊","🎈","💫","✨","💥","🎓","👑","🎎","🎏","🎐","🎌","🏮","💍","❤️","💔","💌","💕","💞","💓","💗","💖","💘","💝","💟","💜","💛","💚","💙","🏃","🏃🏻","🏃🏼","🏃🏽","🏃🏾","🏃🏿","🚶","🚶🏻","🚶🏼","🚶🏽","🚶🏾","🚶🏿","💃","💃🏻","💃🏼","💃🏽","💃🏾","💃🏿","🚣","🚣🏻","🚣🏼","🚣🏽","🚣🏾","🚣🏿","🏊","🏊🏻","🏊🏼","🏊🏽","🏊🏾","🏊🏿","🏄","🏄🏻","🏄🏼","🏄🏽","🏄🏾","🏄🏿","🛀","🛀🏻","🛀🏼","🛀🏽","🛀🏾","🛀🏿","🏂","🎿","⛄️","🚴","🚴🏻","🚴🏼","🚴🏽","🚴🏾","🚴🏿","🚵","🚵🏻","🚵🏼","🚵🏽","🚵🏾","🚵🏿","🏇","🏇🏻","🏇🏼","🏇🏽","🏇🏾","🏇🏿","⛺️","🎣","⚽️","🏀","🏈","⚾️","🎾","🏉","⛳️","🏆","🎽","🏁","🎹","🎸","🎻","🎷","🎺","🎵","🎶","🎼","🎧","🎤","🎭","🎫","🎩","🎪","🎬","🎨","🎯","🎱","🎳","🎰","🎲","🎮","🎴","🃏","🀄️","🎠","🎡","🎢","🚃","🚞","🚂","🚋","🚝","🚄","🚅","🚆","🚇","🚈","🚉","🚊","🚌","🚍","🚎","🚐","🚑","🚒","🚓","🚔","🚨","🚕","🚖","🚗","🚘","🚙","🚚","🚛","🚜","🚲","🚏","⛽️","🚧","🚦","🚥","🚀","🚁","✈️","💺","⚓️","🚢","🚤","⛵️","🚡","🚠","🚟","🛂","🛃","🛄","🛅","💴","💶","💷","💵","🗽","🗿","🌁","🗼","⛲️","🏰","🏯","🌇","🌆","🌃","🌉","🏠","🏡","🏢","🏬","🏭","🏣","🏤","🏥","🏦","🏨","🏩","💒","⛪️","🏪","🏫","🇦🇺","🇦🇹","🇧🇪","🇧🇷","🇨🇦","🇨🇱","🇨🇳","🇨🇴","🇩🇰","🇫🇮","🇫🇷","🇩🇪","🇭🇰","🇮🇳","🇮🇩","🇮🇪","🇮🇱","🇮🇹","🇯🇵","🇰🇷","🇲🇴","🇲🇾","🇲🇽","🇳🇱","🇳🇿","🇳🇴","🇵🇭","🇵🇱","🇵🇹","🇵🇷","🇷🇺","🇸🇦","🇸🇬","🇿🇦","🇪🇸","🇸🇪","🇨🇭","🇹🇷","🇬🇧","🇺🇸","🇦🇪","🇻🇳","⌚️","📱","📲","💻","⏰","⏳","⌛️","📷","📹","🎥","📺","📻","📟","📞","☎️","📠","💽","💾","💿","📀","📼","🔋","🔌","💡","🔦","📡","💳","💸","💰","💎","🌂","👝","👛","👜","💼","🎒","💄","👓","👒","👡","👠","👢","👞","👟","👙","👗","👘","👚","👕","👔","👖","🚪","🚿","🛁","🚽","💈","💉","💊","🔬","🔭","🔮","🔧","🔪","🔩","🔨","💣","🚬","🔫","🔖","📰","🔑","✉️","📩","📨","📧","📥","📤","📦","📯","📮","📪","📫","📬","📭","📄","📃","📑","📈","📉","📊","📅","📆","🔅","🔆","📜","📋","📖","📓","📔","📒","📕","📗","📘","📙","📚","📇","🔗","📎","📌","✂️","📐","📍","📏","🚩","📁","📂","✒️","✏️","📝","🔏","🔐","🔒","🔓","📣","📢","🔈","🔉","🔊","🔇","💤","🔔","🔕","💭","💬","🚸","🔍","🔎","🚫","⛔️","📛","🚷","🚯","🚳","🚱","📵","🔞","🉑","🉐","💮","㊙️","㊗️","🈴","🈵","🈲","🈶","🈚️","🈸","🈺","🈷","🈹","🈳","🈂","🈁","🈯️","💹","❇️","✳️","❎","✅","✴️","📳","📴","🆚","🅰","🅱","🆎","🆑","🅾","🆘","🆔","🅿️","🚾","🆒","🆓","🆕","🆖","🆗","🆙","🏧","♈️","♉️","♊️","♋️","♌️","♍️","♎️","♏️","♐️","♑️","♒️","♓️","🚻","🚹","🚺","🚼","♿️","🚰","🚭","🚮","▶️","◀️","🔼","🔽","⏩","⏪","⏫","⏬","➡️","⬅️","⬆️","⬇️","↗️","↘️","↙️","↖️","↕️","↔️","🔄","↪️","↩️","⤴️","⤵️","🔀","🔁","🔂","#⃣","0⃣","1⃣","2⃣","3⃣","4⃣","5⃣","6⃣","7⃣","8⃣","9⃣","🔟","🔢","🔤","🔡","🔠","ℹ️","📶","🎦","🔣","➕","➖","〰","➗","✖️","✔️","🔃","™","©","®","💱","💲","➰","➿","〽️","❗️","❓","❕","❔","‼️","⁉️","❌","⭕️","💯","🔚","🔙","🔛","🔝","🔜","🌀","Ⓜ️","⛎","🔯","🔰","🔱","⚠️","♨️","♻️","💢","💠","♠️","♣️","♥️","♦️","☑️","⚪️","⚫️","🔘","🔴","🔵","🔺","🔻","🔸","🔹","🔶","🔷","▪️","▫️","⬛️","⬜️","◼️","◻️","◾️","◽️","🔲","🔳","🕐","🕑","🕒","🕓","🕔","🕕","🕖","🕗","🕘","🕙","🕚","🕛","🕜","🕝","🕞","🕟","🕠","🕡","🕢","🕣","🕤","🕥","🕦","🕧"];
	foreach ($emos as $cleaner) {
		$content = str_replace($cleaner, '<span class="emoji">'.$cleaner.'</span>', $content);
	}
	$mysqli->query("INSERT INTO `boom_private` (time, target, hunter, message, file) VALUES ('" . time() . "', '$to', '$from', '$content', 1)");
	$rel = $mysqli->insert_id;
	$mysqli->query("UPDATE boom_users SET pcount = pcount + 1 WHERE user_id = '$from' OR user_id = '$to'");
	return true;
}
function userPostPrivateFile($content, $target, $file_name, $type)
{
	global $mysqli, $data;
	$mysqli->query("INSERT INTO `boom_private` (time, target, hunter, message, file) VALUES ('" . time() . "', '$target', '{$data['user_id']}', '$content', 1)");
	$rel = $mysqli->insert_id;
	$mysqli->query("UPDATE boom_users SET pcount = pcount + 1 WHERE user_id = '{$data['user_id']}' OR user_id = '$target'");
	$mysqli->query("INSERT INTO `boom_upload` (file_name, date_sent, file_user, file_zone, file_type, relative_post) VALUES ('$file_name', '" . time() . "', '{$data['user_id']}', 'private', '$type', '$rel')");
	return true;
}
function getFriendList($id, $type = 0)
{
	global $mysqli;
	$friend_list = array();
	$find_friend = $mysqli->query("SELECT target FROM boom_friends WHERE hunter = '$id' AND fstatus = '3'");
	if ($find_friend->num_rows > 0) {
		while ($find = $find_friend->fetch_assoc()) {
			array_push($friend_list, $find['target']);
		}
		if ($type == 1) {
			array_push($friend_list, $id);
		}
	}
	return $friend_list;
}
function getRankList($rank)
{
	global $mysqli;
	$list = array();
	$find_list = $mysqli->query("SELECT user_id FROM boom_users WHERE user_rank = '$rank'");
	if ($find_list->num_rows > 0) {
		while ($find = $find_list->fetch_assoc()) {
			array_push($list, $find['user_id']);
		}
	}
	return $list;
}
function getStaffList()
{
	global $mysqli;
	$list = array();
	$find_list = $mysqli->query("SELECT user_id FROM boom_users WHERE user_rank >= 95");
	if ($find_list->num_rows > 0) {
		while ($find = $find_list->fetch_assoc()) {
			array_push($list, $find['user_id']);
		}
	}
	return $list;
}
function boomListNotify($list, $type, $custom = array())
{
	global $mysqli, $data;
	if (!empty($list)) {
		$values = '';
		foreach ($list as $user) {
			$def = array(
				'hunter' => $data['system_id'],
				'room' => $data['user_roomid'],
				'rank' => 0,
				'delay' => 0,
				'reason' => '',
				'source' => 'system',
				'sourceid' => 0,
				'custom' => '',
				'custom2' => '',
			);
			$c = array_merge($def, $custom);
			$values .= "('{$c['hunter']}', '$user', '$type', '" . time() . "', '{$c['source']}', '{$c['sourceid']}', '{$c['rank']}', '{$c['delay']}', '{$c['reason']}', '{$c['custom']}', '{$c['custom2']}'),";
		}
		$values = rtrim($values, ',');
		$mysqli->query("INSERT INTO boom_notification ( notifier, notified, notify_type, notify_date, notify_source, notify_id, notify_rank, notify_delay, notify_reason, notify_custom, notify_custom2) VALUES $values");
		updateListNotify($list);
	}
}
function boomNotify($type, $custom = array())
{
	global $mysqli, $data;
	$def = array(
		'hunter' => $data['system_id'],
		'target' => 0,
		'room' => $data['user_roomid'],
		'rank' => 0,
		'delay' => 0,
		'reason' => '',
		'source' => 'system',
		'sourceid' => 0,
		'custom' => '',
		'custom2' => '',
	);
	$c = array_merge($def, $custom);
	if ($c['target'] == 0) {
		return false;
	}
	$mysqli->query("INSERT INTO boom_notification ( notifier, notified, notify_type, notify_date, notify_source, notify_id, notify_rank, notify_delay, notify_reason, notify_custom, notify_custom2) 
	VALUE ('{$c['hunter']}', '{$c['target']}', '$type', '" . time() . "', '{$c['source']}', '{$c['sourceid']}', '{$c['rank']}', '{$c['delay']}', '{$c['reason']}', '{$c['custom']}', '{$c['custom2']}')");
	updateNotify($c['target']);
}
function updateNotify($id)
{
	global $mysqli;
	$mysqli->query("UPDATE boom_users SET naction = naction + 1 WHERE user_id = '$id'");
}
function updateListNotify($list)
{
	global $mysqli;
	if (empty($list)) {
		return false;
	}
	$list = implode(", ", $list);
	$mysqli->query("UPDATE boom_users SET naction = naction + 1 WHERE user_id IN ($list)");
}
function updateStaffNotify()
{
	global $mysqli;
	$mysqli->query("UPDATE boom_users SET naction = naction + 1 WHERE user_rank > 94");
}
function updateAllNotify()
{
	global $mysqli;
	$delay = calMinutes(2);
	$mysqli->query("UPDATE boom_users SET naction = naction + 1 WHERE last_action > '$delay'");
}
function createIgnore()
{
	global $mysqli, $data, $cody;
	$ignore_list = '';
	$get_ignore = $mysqli->query("SELECT ignored FROM boom_ignore WHERE ignorer = '{$data['user_id']}'");
	while ($ignore = $get_ignore->fetch_assoc()) {
		$ignore_list .= $ignore['ignored'] . '|';
	}
	$_SESSION[BOOM_PREFIX . 'ignore'] = '|' . $ignore_list;
}
function isIgnored($ignore, $id)
{
	global $cody;
	if (strpos($ignore, '|' . $id . '|') !== false) {
		return true;
	}
}
function getIgnore()
{
	global $cody;
	return $_SESSION[BOOM_PREFIX . 'ignore'];
}
function refererDetailsUser($id){
	global $mysqli;
	$user = array();
	$getuser = $mysqli->query("SELECT * FROM referer_sys WHERE hunter = '$id'");
	if($getuser->num_rows > 0){
		$user = $getuser->fetch_assoc();
	}
	return $user;
}
function refererDetailsIp($ip){
	global $mysqli;
	$user = array();
	$getuser = $mysqli->query("SELECT * FROM referer_sys WHERE ip = '$ip'");
	if($getuser->num_rows > 0){
		$user = $getuser->fetch_assoc();
	}
	return $user;
}
function refererDetailsFp($fp){
	global $mysqli;
	$user = array();
	$getuser = $mysqli->query("SELECT * FROM referer_sys WHERE fp = '$fp'");
	if($getuser->num_rows > 0){
		$user = $getuser->fetch_assoc();
	}
	return $user;
}
function refererUserCount($id){
	global $mysqli;
	$counter = 0;
	$getCount = $mysqli->query("SELECT COUNT(target) as refCount FROM referer_sys WHERE target = '$id'");
	if($getCount->num_rows > 0){
		while($user = $getCount->fetch_assoc()){
			$counter = $user['refCount'];
		}
	}
	return $counter;
}
function trafficCounter($type){
	global $mysqli, $data;
	$counter = 0;
	$getCount = $mysqli->query("SELECT * FROM boom_users");
	if($getCount->num_rows > 0){
		while($user = $getCount->fetch_assoc()){
			if($type == 'direct'){
				if (strpos($user['referer_link'], $data['domain']) !== false) {
				$counter++;
				}
			} 
			 if($type == 'facebook'){
				if (strpos($user['referer_link'], 'facebook') !== false) {
					$counter++;
				} else if (strpos($user['referer_link'], 'fb.com') !== false) {
					$counter++;
				}
			} 
			 if($type == 'twitter'){
				if (strpos( $user['referer_link'], 'twitter') !== false) {
					$counter++;
				}
			} 
			 if($type == 'insta'){
				if (strpos( $user['referer_link'], 'instagram') !== false) {
					$counter++;
				}
			} 
			 if($type == 'google'){
				if (strpos( $user['referer_link'], 'google') !== false) {
					$counter++;
				}
			} 
			 if($type == 'others'){
				if ($user['referer_link'] != '') {
					$counter++;
				}
			} 
			 if($type == 'referer'){
				if (strpos( $user['referer_link'], '?referer=') !== false) {
					$counter++;
				}
			} 
			if($type == 'ads'){
				if (strpos( $user['referer_link'], '?gclid=') !== false) {
					$counter++;
				}
			} 
		}
	}
	return $counter;
}
function processChatMsg($post)
{
	global $data;
	$content = $post['post_message'];
	if ($post['user_id'] != $data['user_id'] && !preg_match('/http/', $content)) {
		$content = str_ireplace($data['user_name'], '<span class="my_notice">' . $data['user_name'] . '</span>', $content);
	}
	return mb_convert_encoding(systemReplace($content), 'UTF-8', 'auto');
}
function processPrivateMsg($post)
{
	global $data;
	return mb_convert_encoding(systemReplace($post['message']), 'UTF-8', 'auto');
}
function mainRoom()
{
	global $data;
	if ($data['user_roomid'] == 1) {
		return true;
	}
}
function renderInfo($user)
{
}
function chatRank($user)
{
	global $data;
	if (isBot($user)) {
		return '';
	}
	if (haveRole($user['user_role']) && !isStaff($user['user_rank']) || $user['user_rank'] != 89) {
		$rank = roomRank($user['user_role'], 'chat_rank');
	} else {
		$rank = systemRank($user['user_rank'], 'chat_rank');
	}
	return $rank;
}
function isQuotable($post)
{
	if (!isSystem($post['user_id'])) {
		return true;
	}
}
function getUserBorder()
{
	global $data, $mysqli;
	$getuser = $mysqli->query("SELECT * FROM boom_users WHERE user_points > 0 AND user_rank > 88 AND user_rank < 100 AND user_bot = 0 ORDER BY user_points DESC");
	if ($getuser->num_rows > 0) {
		$rank = 0;
		while ($lead = $getuser->fetch_assoc()) {
			$rank++;
			if($rank == 1){
				$mysqli->query("UPDATE boom_users SET my_border = 'n-fr-mlky.webp' WHERE user_id = '{$lead['user_id']}'");
			} else if($rank == 2){
				$mysqli->query("UPDATE boom_users SET my_border = 'n-fr10.webp' WHERE user_id = '{$lead['user_id']}'");
			} else if($rank == 3){
				$mysqli->query("UPDATE boom_users SET my_border = 'n-fr7.webp' WHERE user_id = '{$lead['user_id']}'");
			} else if($rank == 4){
				$mysqli->query("UPDATE boom_users SET my_border = 'n-fr11.webp' WHERE user_id = '{$lead['user_id']}'");
			} else if($rank == 5){
				$mysqli->query("UPDATE boom_users SET my_border = 'n-fr14.webp' WHERE user_id = '{$lead['user_id']}'");
			} else if($rank == 6){
				$mysqli->query("UPDATE boom_users SET my_border = 'n-fr3.webp' WHERE user_id = '{$lead['user_id']}'");
			} else if($rank == 7){
				$mysqli->query("UPDATE boom_users SET my_border = 'n-fr1.webp' WHERE user_id = '{$lead['user_id']}'");
			} else if($rank == 8){
				$mysqli->query("UPDATE boom_users SET my_border = 'n-fr2.webp' WHERE user_id = '{$lead['user_id']}'");
			} else if($rank == 9){
				$mysqli->query("UPDATE boom_users SET my_border = 'n-fr5.webp' WHERE user_id = '{$lead['user_id']}'");
			} else if($rank == 10){
				$mysqli->query("UPDATE boom_users SET my_border = 'n-fr6.webp' WHERE user_id = '{$lead['user_id']}'");
			} else {
				$mysqli->query("UPDATE boom_users SET my_border = '' WHERE user_id = '{$lead['user_id']}'");
			}
		}
	}
}
function resetPremiumOptions()
{
	global $data, $mysqli;
	$getuser = $mysqli->query("SELECT * FROM boom_users WHERE user_rank < 88 OR user_points == 0");
	if ($getuser->num_rows > 0) {
		while ($lead = $getuser->fetch_assoc()) {
			if($lead['my_border'] != ''){
				$mysqli->query("UPDATE boom_users SET my_border = '' WHERE user_id = '{$lead['user_id']}'");
			}
			if($lead['ex_name_bg'] != ''){
				$mysqli->query("UPDATE boom_users SET ex_name_bg = '' WHERE user_id = '{$lead['user_id']}'");
			}
			if($lead['ex_name_bg_glow'] != ''){
				$mysqli->query("UPDATE boom_users SET ex_name_bg_glow = '' WHERE user_id = '{$lead['user_id']}'");
			}
			if($lead['ex_pro_colors'] != ''){
				$mysqli->query("UPDATE boom_users SET ex_pro_colors = '' WHERE user_id = '{$lead['user_id']}'");
			}
			if($lead['ex_pro_shadow'] != ''){
				$mysqli->query("UPDATE boom_users SET ex_pro_shadow = '' WHERE user_id = '{$lead['user_id']}'");
			}
			if($lead['ex_pro_music'] != ''){
				$mysqli->query("UPDATE boom_users SET ex_pro_music = '' WHERE user_id = '{$lead['user_id']}'");
			}
			if($lead['user_color'] != 'user'){
				$mysqli->query("UPDATE boom_users SET user_color = 'user' WHERE user_id = '{$lead['user_id']}'");
			}
		}
	}
}
function setProfileColors($user)
{
	global $data;
	$color = $user['ex_pro_colors'];
	if (!empty($user['ex_pro_colors'])) {
		return 'class="' . $color . '"';
	}
}
function setProfileShadows($user)
{
	global $data;
	$shadow = $user['ex_pro_shadow'];
	if (!empty($user['ex_pro_shadow'])) {
		return 'class="' . $shadow . '"';
	}
}
function createLog($data, $post, $ignore = '')
{
	$delete = 0;
	$m = 0;
	$frame = '';
	if (isIgnored($ignore, $post['user_id'])) {
		return false;
	}
	
	if(boomAllow(0) && !boomAllow(95) && !boomRole(4) && $post['user_rank'] < 88 && !isBot($post) && !mySelf($post['user_id'])){
		$report = '<span data="' . $post['post_id'] . '" style="display: inline-block;margin:0 6px;font-size:11px;color:#bfbfbf;" onclick="reportChatLog(this);"><i class="fa fa-flag"></i></span>';
	}
	if (boomAllow(95) && isGreater($post['user_rank']) && !isSystem($post['user_id']) && !mySelf($post['user_id']) && $data['no_perm'] == 1 || boomAllow(95) && mySelf($post['user_id'])) {
		$del_option = '<span data="' . $post['post_id'] . '" class="error" style="display: inline-block;margin:0 6px;font-size:14px;color:#bfbfbf;" onclick="deleteLog(this);"><i class="fa fa-times"></i></span>';
	}
	if (boomAllow(97) && isSystem($post['user_id']) && $data['no_perm'] == 1) {
		$del_option = '<span data="' . $post['post_id'] . '" class="error" style="display: inline-block;margin:0 6px;font-size:14px;color:#bfbfbf;" onclick="deleteLog(this);"><i class="fa fa-times"></i></span>';
	}
	if (boomRole(4) && $post['user_role'] < $data['user_role'] && $post['user_rank'] < 95 && !isSystem($post['user_id']) && $data['no_perm'] == 1 || boomRole(4) && mySelf($post['user_id'])) {
		$del_option = '<span data="' . $post['post_id'] . '" class="error" style="display: inline-block;margin:0 6px;font-size:14px;color:#bfbfbf;" onclick="deleteLog(this);"><i class="fa fa-times"></i></span>';
	}
	if (boomAllow(95) && isGreater($post['user_rank']) && !isSystem($post['user_id']) && !mySelf($post['user_id']) && $data['no_perm'] == 1) {
		$more_option = '<span class="warn" style="display: inline-block;margin:0 3px;font-size:14px;color:#bfbfbf;" onclick="logMoreMenu(' . $post['user_id'] . ');"><i class="fa fa-share-square"></i></span>';
	}
	if (boomRole(4) && $post['user_role'] < $data['user_role'] && $post['user_rank'] < 95 && !isSystem($post['user_id']) && !mySelf($post['user_id']) && $data['no_perm'] == 1) {
		$more_option = '<span class="warn" style="display: inline-block;margin:0 3px;font-size:14px;color:#bfbfbf;" onclick="logMoreMenu(' . $post['user_id'] . ');"><i class="fa fa-share-square"></i></span>';
	}
	if ($data['join_logs'] == 0 && $post['type'] == 'system__join') {
		$hide = 'should_hidden';
	}
	if(!empty($post['my_border'])){
		$img_class = 'chat_frame_avatar';
		$style = 'style="width:42px;"';
		$frame_div = '<div class="flexcenter" style="width: 30px; height: 30px;">
						<div data-uname="'.$post['user_name'].'" class="avtrig chat_frame_avatar" style="width: 30px; height: 30px;" onclick="avMenu(this,'.$post['user_id'].','.$post['user_rank'].','.$post['user_bot'].',\''.$post['country'].'\',\''.$post['user_cover'].'\',\''.$post['user_age'].'\',\''.userGender($post['user_sex']).'\');">
							<img class="cavatar avav chat_frame_avatar_inner2 under ch_fr_av" src="' . myAvatar($post['user_tumb']) . '">
							<img src="images/border/' . $post['my_border'] . '" class="ch_fr_bg over2">
						</div>
					</div>';
		$licss = 'padding: 8px 4px;';
	}
	if(empty($post['my_border'])){
		if(!empty($post['ex_av_border'])){
			$frame_div = '<div data-uname="'.$post['user_name'].'" class="avtrig chat_avatar" onclick="avMenu(this,'.$post['user_id'].','.$post['user_rank'].','.$post['user_bot'].',\''.$post['country'].'\',\''.$post['user_cover'].'\',\''.$post['user_age'].'\',\''.userGender($post['user_sex']).'\');">
								<div class="grad_small_border '.$post['ex_av_border'].'">
									<img class="small_av avav ' . ownAvatar($post['user_id']) . '" src="' . myAvatar($post['user_tumb']) . '"/> 
								</div>
							</div>';
		}
		else {
			$frame_div = '<div data-uname="'.$post['user_name'].'" ' . $style . ' class="avtrig chat_avatar" onclick="avMenu(this,'.$post['user_id'].','.$post['user_rank'].','.$post['user_bot'].',\''.$post['country'].'\',\''.$post['user_cover'].'\',\''.$post['user_age'].'\',\''.userGender($post['user_sex']).'\');">
							<img class="cavatar avav ' . avGender($post['user_sex']) . ' ' . ownAvatar($post['user_id']) . '" src="' . myAvatar($post['user_tumb']) . '"/>
						</div>';
		}
	}
	if (!empty($post['my_border'])) {
		$frame = '<img class="ch_fr_bg over2" src="images/border/' . $post['my_border'] . '"/>';
	}
	if(!empty($post['ex_name_bg'])){
		$name_bg = 'class="'. $post['ex_name_bg'] .'"';
	}
	return  '<li style="' . $licss . '" id="log' . $post['post_id'] . '" data="' . $post['post_id'] . '" class="ch_logs ' . $post['type'] . ' '.$hide .'">
				'.$frame_div.'
				<div class="my_text">
				<div class="btable">
					<div class="cname">
					' . getRankIcon($post, 'chat_rank') . '
					<span '.$name_bg.'> <span class="username ' . myColorFont($post) . '">' . $post['user_name'] . '</span> </span>
					</div>
					:
					<div class="chat_message ' . $post['tcolor'] . '">' . processChatMsg($post) . '
					' . $report . $del_option . $more_option . '
					</div>
				</div>
				</div>
			</li>';
}
function privateLog($post, $hunter)
{
	if ($hunter == $post['hunter']) {
		return '<li class="prlog" data-id="' . $post['id'] . '" id="priv' . $post['id'] . '">
					<div class="private_logs">
						<div class="private_avatar">
							<img data="' . $post['user_id'] . '" class="get_info avatar_private" src="' . myAvatar($post['user_tumb']) . '"/>
						</div>
						<div class="private_content">
							<div class="hunter_private">' . processPrivateMsg($post) . '</div>
							<p class="pdate">' . displayDate($post['time']) . '</p>
						</div>
					</div>
				</li>';
	} else {
		return '<li class="prlog" data-id="' . $post['id'] . '" id="priv' . $post['id'] . '">
					<div class="private_logs">
						<div class="private_content">
							<div class="target_private">' . processPrivateMsg($post) . '</div>
							<p class="ptdate">' . displayDate($post['time']) . '</p>
						</div>
						<div class="private_avatar">
							<img data="' . $post['user_id'] . '" class="get_info avatar_private" src="' . myAvatar($post['user_tumb']) . '"/>
						</div>
					</div>
				</li>';
	}
}
function createUserlist($list)
{
	global $data, $lang;
	if (!isVisible($list)) {
		return false;
	}
	$icon = '';
	$muted = '';
	$status = '';
	$mood = '';
	$flag = '';
	$frame = '';
	$offline = 'offline';
	$rank_icon = getRankIcon($list, 'list_rank');
	$mute_icon = getMutedIcon($list, 'list_mute'); 
	if (useFlag($list['country'])) {
		$flag = '<div class="user_item_flag"><img src="' . countryFlag($list['country']) . '"/></div>';
	}
	if ($rank_icon != '') {
		$icon = '<div class="user_item_icon icrank">' . $rank_icon . '</div>';
	}
	if ($mute_icon != '') {
		$muted = '<div class="user_item_icon icmute">' . $mute_icon . '</div>';
	}
	if ($list['last_action'] > getDelay() || isBot($list)) {
		$offline = '';
		$status = getStatus($list['user_status'], 'list_status');
	}
	if(!empty($list['ex_name_bg'])){
		$mybg = $list['ex_name_bg'];
		$myglow = $list['ex_name_bg_glow'];
		$pad = 'style="padding:4px 6px; margin:5px 0;"';
		$mood_style = 'style="color:#fff;"';
	}
	if (!empty($list['user_mood'])) {
		$mood = '<p '. $mood_style .' class="text_xsmall bustate bellips">' . $list['user_mood'] . '</p>';
	}
	if(!empty($list['my_border'])){
		$frame_div = '<div class="user_item_frame_avatar_new">
						<img class="avav user_item_frame_inner under ul_fr_av" src="' . myAvatar($list['user_tumb']) . '">
						<img class="overlist ul_fr_bg" src="images/border/'. $list['my_border'] .'">
					</div>';
	}
	if(empty($list['my_border'])){
		if(!empty($list['ex_av_border'])){
			$frame_div = '<div class="user_item_avatar">
							<div class="grad_bigger_border '.$list['ex_av_border'].'">
									<img style="height:32px;width:32px;" class="avav acav ' . ownAvatar($list['user_id']) . '" src="' . myAvatar($list['user_tumb']) . '"/> 
									' . $status . '
							</div>
						</div>';
		} else {
			$frame_div = '<div class="user_item_avatar"><img class="avav acav ' . avGender($list['user_sex']) . ' ' . ownAvatar($list['user_id']) . '" src="' . myAvatar($list['user_tumb']) . '"/> ' . $status . '</div>';
		}
		
	}
	return '<div data-uname="'.$list['user_name'].'" '. $pad .' onclick="dropUser(this,' . $list['user_id'] . ',' . $list['user_rank'] . ',' . $list['user_bot'] . ',\'' . $list['country'] . '\',\'' . $list['user_cover'] . '\',\'' . $list['user_age'] . '\',\'' . userGender($list['user_sex']) . '\');" class="avtrig user_item ' . $offline . $mybg . ' '. $myglow.'">
				'.$frame_div.'
				<div class="user_item_data"><p class="username ' . myColorFont($list) . '">' . $list["user_name"] . '</p>' . $mood . '</div>
				' . $muted . $icon . $flag . '
			</div>';
}
function useFlag($country)
{
	global $data;
	if ($data['flag_ico'] > 0 && $country != 'ZZ' && $country != '') {
		return true;
	}
}
function listCountry($c)
{
	global $lang;
	require BOOM_PATH . '/system/location/country_list.php';
	$list_country = '';
	$list_country .= '<option value="ZZ" ' . selCurrent($c, 'ZZ') . '>' . $lang['not_shared'] . '</option>';
	foreach ($country_list as $country => $key) {
		$list_country .= '<option ' . selCurrent($c, $country) . ' value="' . $country . '">' . $key . '</option>';
	}
	return $list_country;
}
function userCountry($country)
{
	global $data;
	if ($country != 'ZZ' && $country != '') {
		return true;
	}
}
function countryFlag($country)
{
	global $data;
	return 'system/location/flag/' . $country . '.png';
}
function countryName($country)
{
	global $lang;
	require BOOM_PATH . '/system/location/country_list.php';
	if (array_key_exists($country, $country_list)) {
		return $country_list[$country];
	} else {
		return $lang['not_available'];
	}
}
function chatDate($date)
{
	return date("j/m G:i", $date);
}
function displayDate($date)
{
	return date("j/m G:i", $date);
}
function longDate($date)
{
	return date("Y-m-d ", $date);
}
function longDateTime($date)
{
	return date("Y-m-d G:i ", $date);
}
function userTime($user)
{
	$d = new DateTime(date("d F Y H:i:s", time()));
	$d->setTimezone(new DateTimeZone($user['user_timezone']));
	$r = $d->format('G:i');
	return $r;
}
function boomRenderMinutes($val)
{
	global $lang;
	$day = '';
	$hour = '';
	$minute = '';
	$d = floor($val / 1440);
	$h = floor(($val - $d * 1440) / 60);
	$m = $val - ($d * 1440) - ($h * 60);
	if ($d > 0) {
		if ($d > 1) {
			$day = $d . ' ' . $lang['days'];
		} else {
			$day = $d . ' ' . $lang['day'];
		}
	}
	if ($h > 0) {
		if ($h > 1) {
			$hour = $h . ' ' . $lang['hours'];
		} else {
			$hour = $h . ' ' . $lang['hour'];
		}
	}
	if ($m > 0) {
		if ($m > 1) {
			$minute = $m . ' ' . $lang['minutes'];
		} else {
			$minute = $m . ' ' . $lang['minute'];
		}
	}
	return trim($day . ' ' . $hour  . ' ' . $minute);
}
function boomRenderSeconds($val)
{
	global $lang;
	$day = '';
	$hour = '';
	$minute = '';
	$second = '';
	$d = floor($val / 86400);
	$h = floor(($val - $d * 86400) / 3600);
	$m = floor(($val - ($d * 86400) - ($h * 3600)) / 60);
	$s = $val - ($d * 86400) - ($h * 3600) - ($m * 60);
	if ($d > 0) {
		if ($d > 1) {
			$day = $d . ' ' . $lang['days'];
		} else {
			$day = $d . ' ' . $lang['day'];
		}
	}
	if ($h > 0) {
		if ($h > 1) {
			$hour = $h . ' ' . $lang['hours'];
		} else {
			$hour = $h . ' ' . $lang['hour'];
		}
	}
	if ($m > 0) {
		if ($m > 1) {
			$minute = $m . ' ' . $lang['minutes'];
		} else {
			$minute = $m . ' ' . $lang['minute'];
		}
	}
	if ($s > 0) {
		if ($s > 1) {
			$second = $s . ' ' . $lang['seconds'];
		} else {
			$second = $s . ' ' . $lang['second'];
		}
	}
	return trim($day . ' ' . $hour  . ' ' . $minute . ' ' . $second);
}
function boomTimeLeft($t)
{
	return boomRenderMinutes(floor(($t - time()) / 60));
}
function boomAllow($rank)
{
	global $data;
	if ($data['user_rank'] >= $rank) {
		return true;
	}
}
function userBoomAllow($user, $val)
{
	if ($user['user_rank'] >= $val) {
		return true;
	}
}
function boomRole($role)
{
	global $data;
	if ($data['user_role'] >= $role) {
		return true;
	}
}
function haveRole($role)
{
	if ($role > 0) {
		return true;
	}
}
function isGreater($rank)
{
	global $data;
	if ($data['user_rank'] > $rank) {
		return true;
	}
}
function mySelf($id)
{
	global $data;
	if ($id == $data['user_id']) {
		return true;
	}
}
function isBot($user)
{
	if ($user['user_bot'] > 0) {
		return true;
	}
}
function systemBot($user)
{
	if ($user == 9) {
		return true;
	}
}
function isSystem($id)
{
	global $data;
	if ($id == $data['system_id']) {
		return true;
	}
}
function getTopic($t)
{
	global $lang;
	$topic = processUserData($t);
	if (!empty($topic)) {
		return systemSpecial($topic, 'topic_log', array('icon' => 'topic.svg', 'title' => $lang['topic_title']));
	}
}
function boomRoomData($r)
{
	global $mysqli, $data;
	$room = array();
	$get_room = $mysqli->query("SELECT * FROM boom_rooms WHERE room_id = $r");
	if ($get_room->num_rows > 0) {
		$room = $get_room->fetch_assoc();
		return $room;
	}
}
function boomConsole($type, $custom = array())
{
	global $mysqli, $data;
	$def = array(
		'hunter' => $data['user_id'],
		'target' => $data['user_id'],
		'room' => $data['user_roomid'],
		'rank' => 0,
		'delay' => 0,
		'reason' => '',
		'custom' => '',
		'custom2' => '',
	);
	$c = array_merge($def, $custom);
	if (!boomAllow(100)) {
		$mysqli->query("INSERT INTO boom_console (hunter, target, room, ctype, crank, delay, reason, custom, custom2, cdate) VALUES ('{$c['hunter']}', '{$c['target']}', '{$c['room']}', '$type', '{$c['rank']}', '{$c['delay']}', '{$c['reason']}', '{$c['custom']}', '{$c['custom2']}', '" . time() . "')");
	}
}
function boomHistory($type, $custom = array())
{
	global $mysqli, $data;
	$def = array(
		'hunter' => $data['user_id'],
		'target' => 0,
		'rank' => 0,
		'delay' => 0,
		'reason' => '',
		'content' => '',
	);
	$c = array_merge($def, $custom);
	if ($c['target'] == 0) {
		return false;
	}
	if (!boomAllow(100)) {
		$mysqli->query("INSERT INTO boom_history (hunter, target, htype, delay, reason, history_date) VALUES ('{$c['hunter']}', '{$c['target']}', '$type',  '{$c['delay']}', '{$c['reason']}', '" . time() . "')");
	}
}
function renderReason($t)
{
	global $lang;
	switch ($t) {
		case '':
			return $lang['no_reason'];
		case 'badword':
			return $lang['badword'];
		case 'spam':
			return $lang['spam'];
		case 'flood':
			return $lang['flood'];
		default:
			return systemReplace($t);
	}
}
function userUnmute($user)
{
	global $mysqli;
	if (!guestMuted()) {
		clearNotifyAction($user['user_id'], 'mute');
		$mysqli->query("UPDATE boom_users SET user_mute = 0, mute_msg = '', user_regmute = 0 WHERE user_id = '{$user['user_id']}'");
		boomNotify('unmute', array('target' => $user['user_id'], 'source' => 'mute'));
	}
}
function userUnkick($user)
{
	global $mysqli;
	$mysqli->query("UPDATE boom_users SET user_kick = 0 WHERE user_id = '{$user['user_id']}'");
}
function muted()
{
	global $data;
	if (isMuted($data) || isBanned($data) || isKicked($data) || outChat($data) || isRegmute($data) || guestMuted()) {
		return true;
	}
}
function roomMuted()
{
	global $data;
	if ($data['room_mute'] > 0) {
		return true;
	}
}
function isRoomMuted($user)
{
	if ($user['room_mute'] > 0) {
		return true;
	}
}
function isMuted($user)
{
	if ($user['user_mute'] > time()) {
		return true;
	}
}
function isGuestMuted($user)
{
	global $data;
	if ($user['user_rank'] == 0 && $data['guest_talk'] == 0) {
		return true;
	}
}
function guestMuted()
{
	global $data;
	if ($data['user_rank'] == 0 && $data['guest_talk'] == 0) {
		return true;
	}
}
function isRegmute($user)
{
	if ($user['user_regmute'] > time()) {
		return true;
	}
}
function mutedData($user)
{
	if ($user['user_mute'] > 0 || $user['user_regmute'] > 0) {
		return true;
	}
}
function kickedData($user)
{
	if ($user['user_kick'] > 0) {
		return true;
	}
}
function isBanned($user)
{
	if ($user['user_banned'] > 0) {
		return true;
	}
}
function isKicked($user)
{
	if ($user['user_kick'] > time()) {
		return true;
	}
}
function systemNameFilter($user)
{
	return '<span onclick="getProfile(' . $user['user_id'] . ')"; class="sysname">' . $user['user_name'] . '</span>';
}
function joinRoom()
{
	global $lang, $data, $cody;
	if (allowLogs() && isVisible($data) && $cody['join_room'] == 1) {
		$content = str_replace(
			'@rank@',
			rankTitle($data['user_rank']),
			'<b class="system_message">انضم للغرفة (# @rank@ #)</b>'
		);
		userPostChat($content, array('type' => 'system__join'));
	}
}
function leaveRoom()
{
	global $data, $lang, $cody;
	if (allowLogs() && $cody['leave_room'] == 1) {
		if (isVisible($data) && $data['user_roomid'] != 0 && $data['last_action'] > time() - 30) {
			$content = str_replace('%user%', systemNameFilter($data), $lang['quit_room']);
			systemPostChat($data['user_roomid'], $content, array('type' => 'system__leave'));
		}
	}
}
function changeNameLog($user, $n)
{
	global $lang, $data, $cody;
	if (allowLogs() && isVisible($user) && $cody['name_change'] == 1 && !boomAllow(100)) {
		$content = str_replace('%user%', $user['user_name'], $lang['system_name_change']);
		$user['user_name'] = $n;
		$content = str_replace('%nname%', systemNameFilter($user), $content);
		systemPostChat($user['user_roomid'], $content, array('type' => 'system__action'));
	}
}
function kickLog($user)
{
	global $lang, $data, $cody;
	if (allowLogs() && $cody['action_log'] == 1 && userInRoom($user) && !boomAllow(100)) {
		$msg = str_replace(array('@hunter@', '@target@'), array($data['user_name'], $user['user_name']), '<b><span style="color:blue;"> @hunter@ </span> قام بطرد العضو <span style="color:orange;"> @target@ </span></b>');
		systemPostChat($data['user_roomid'], $msg);
	}
}
function banLog($user)
{
	global $lang, $data, $cody;
	if (allowLogs() && $cody['action_log'] == 1 && userInRoom($user) && !boomAllow(100)) {
		$msg = str_replace(array('@hunter@', '@target@'), array($data['user_name'], $user['user_name']), '<b><span style="color:blue;"> @hunter@ </span> قام بحجب العضو <span style="color:orange;"> @target@ </span></b>');
		systemPostChat($data['user_roomid'], $msg);
	}
}
function muteLog($user)
{
	global $lang, $data, $cody;
	if (allowLogs() && $cody['action_log'] == 1 && userInRoom($user) && !boomAllow(100)) {
		$msg = str_replace(array('@hunter@', '@target@'), array($data['user_name'], $user['user_name']), '<b><span style="color:blue;"> @hunter@ </span> قام بكتم العضو <span style="color:orange;"> @target@ </span></b>');
		systemPostChat($data['user_roomid'], $msg);
	}
}
function warnLog($user)
{
	global $lang, $data, $cody;
	if (allowLogs() && $cody['action_log'] == 1 && userInRoom($user) && !boomAllow(100)) {
		$msg = str_replace(array('@hunter@', '@target@'), array($data['user_name'], $user['user_name']), '<b><span style="color:blue;"> @hunter@ </span> قام بارسال تحذير الى <span style="color:orange;"> @target@ </span></b>');
		systemPostChat($data['user_roomid'], $msg);
	}
}
function recordLimits($user, $type)
{
	global $data, $mysqli;
	if ($type == 'news' || $type == 'rank') {
		$time = strtotime('+1 day', time());
	} else if ($type == 'my_name' && $user['user_rank'] < 88) {
		$time = strtotime('+1 month', time());
	} else if ($type == 'user_name' && $user['user_rank'] >= 97) {
		$time = strtotime('+1 days', time());
	} else {
		return false;
	}
	if ($user['user_rank'] < 100) {
		$mysqli->query("INSERT INTO boom_limits (user_id, type, time) VALUES ('{$user['user_id']}', '$type', '$time')");
	}
}
function fetchUserLimits()
{
	global $mysqli, $data;
	$time = time();
	$mSql = $mysqli->query("SELECT * FROM boom_limits WHERE user_id = '{$data['user_id']}'");
	if ($mSql->num_rows > 0) {
		$mysqli->query("DELETE FROM boom_limits WHERE time < '$time' AND user_id = '{$data['user_id']}'");
	}
}
function checkUserLimits($type)
{
	global $mysqli, $data;
	$mSql = $mysqli->query("SELECT * FROM boom_limits WHERE user_id = '{$data['user_id']}' AND type = '$type'");
	if ($type == 'rank') {
		if ($mSql->num_rows >= 5) {
			return false;
		} else {
			return true;
		}
	} elseif ($type == 'news') {
		if ($mSql->num_rows >= 3) {
			return false;
		} else {
			return true;
		}
	} elseif ($type == 'my_name') {
		if ($mSql->num_rows > 0) {
			return false;
		} else {
			return true;
		}
	} else {
		return false;
	}
}
function limitDetatils($id, $type)
{
	global $mysqli;
	$user = array();
	$getuser = $mysqli->query("SELECT * FROM boom_limits WHERE user_id = '$id' AND type = '$type'");
	if ($getuser->num_rows > 0) {
		$user = $getuser->fetch_assoc();
	}
	return $user;
}
function processUserData($t)
{
	global $data;
	return str_replace(array('%user%'), array($data['user_name']), $t);
}
function roomStaff()
{
	if (boomRole(4)) {
		return true;
	}
}
function userRoomStaff($rank)
{
	if ($rank >= 4) {
		return true;
	}
}
function allowLogs()
{
	global $data;
	if ($data['allow_logs'] == 1) {
		return true;
	}
}
function isVisible($user)
{
	if ($user['user_status'] != 6) {
		return true;
	}
}
function isSecure($user)
{
	if (isEmail($user['user_email'])) {
		return true;
	}
}
function isMember($user)
{
	if (!isGuest($user) && !isBot($user)) {
		return true;
	}
}
function isGuest($user)
{
	if ($user['user_rank'] == 0) {
		return true;
	}
}
function guestForm()
{
	global $data;
	if ($data['guest_form'] == 1) {
		return true;
	}
}
function strictGuest()
{
	global $cody;
	if ($cody['strict_guest'] == 1) {
		return true;
	}
}
function userDj($user)
{
	if ($user['user_dj'] == 1) {
		return true;
	}
}
function boomRecaptcha()
{
	global $data;
	if ($data['use_recapt'] > 0) {
		return true;
	}
}

function encrypt($d)
{
	return sha1(str_rot13($d . BOOM_CRYPT));
}
function boomEncrypt($d, $encr)
{
	return sha1(str_rot13($d . $encr));
}
function getDelay()
{
	return time() - 86400;
} 
function getMinutes($t)
{
	return $t / 60;
}
function userActive($user, $c)
{
	global $data, $cody;
	if (!isVisible($user) && !boomAllow($cody['can_inv_view'])) {
		return '<img class="' . $c . '" src="' . $data['domain'] . '/default_images/icons/innactive.svg"/>';
	} else if ($user['last_action'] >= getDelay() || isBot($user)) {
		return '<img class="' . $c . '" src="' . $data['domain'] . '/default_images/icons/active.svg"/>';
	} else {
		return '<img class="' . $c . '" src="' . $data['domain'] . '/default_images/icons/innactive.svg"/>';
	}
}
function isOwner($user)
{
	if ($user['user_rank'] == 100) {
		return true;
	}
}
function isStaff($rank)
{
	if ($rank >= 89) {
		return true;
	}
}
function genKey()
{
	return md5(rand(10000, 99999) . rand(10000, 99999));
}
function genCode()
{
	return rand(111111, 999999);
}
function genSnum()
{
	global $data;
	return $data['user_id'] . rand(1111111, 9999999);
}
function boomUnderClear($t)
{
	return str_replace('_', ' ', $t);
}
function allowGuest()
{
	global $data;
	if ($data['allow_guest'] == 1) {
		return true;
	}
}
function boomMerge($a, $b)
{
	$c = $a . '_' . $b;
	return trim($c);
}
function clearNotifyAction($id, $type)
{
	global $mysqli;
	$mysqli->query("DELETE FROM boom_notification WHERE notified = '$id' AND notify_source = '$type'");
}
function setToken()
{
	global $data, $cody;
	if (!empty($_SESSION[BOOM_PREFIX . 'token'])) {
		$_SESSION[BOOM_PREFIX . 'token'] = $_SESSION[BOOM_PREFIX . 'token'];
		return $_SESSION[BOOM_PREFIX . 'token'];
	} else {
		$session = md5(rand(000000, 999999));
		$_SESSION[BOOM_PREFIX . 'token'] = $session;
		return $session;
	}
}
function logPending($c)
{
	return array('log', $c);
}
function modalPending($c, $t, $s = 400)
{
	return array('modal', $c, $t, $s);
}
function pendingPush($s, $d)
{
	if (is_array($d)) {
		array_push($s, $d);
	}
	return $s;
}
function boomDuplicateIp($val)
{
	global $mysqli, $data, $cody;
	$dupli = $mysqli->query("SELECT * FROM `boom_banned` WHERE `ip` = '$val'");
	if ($dupli->num_rows > 0) {
		return true;
	}
}
function checkToken()
{
	global $cody;
	if (!isset($_POST['token']) || !isset($_SESSION[BOOM_PREFIX . 'token']) || empty($_SESSION[BOOM_PREFIX . 'token'])) {
		return false;
	}
	if ($_POST['token'] == $_SESSION[BOOM_PREFIX . 'token']) {
		return true;
	}
	return false;
}

// ranking functions

function getMutedIcon($user, $c)
{
	global $lang;
	if (isGuestMuted($user)) {
		return '<img title="' . $lang['view_only'] . '" class="' . $c . '" src="default_images/actions/guestmuted.svg"/>';
	}
	if (isRegmute($user)) {
		return '<img title="' . $lang['muted'] . '" class="' . $c . '" src="default_images/actions/regmuted.svg"/>';
	} else if (isMuted($user)) {
		return '<img title="' . $lang['muted'] . '" class="' . $c . '" src="default_images/actions/muted.svg"/>';
	} else if (isRoomMuted($user)) {
		return '<img title="' . $lang['muted'] . '" class="' . $c . '" src="default_images/actions/room_muted.svg"/>';
	} else {
		return '';
	}
}

// sex and gender and status functions
function listGender($sex)
{
	global $lang;
	$list = '';
	$list .= '<option ' . selCurrent($sex, 1) . ' value="1">' . $lang['male'] . '</option>';
	$list .= '<option ' . selCurrent($sex, 2) . ' value="2">' . $lang['female'] . '</option>';
	$list .= '<option ' . selCurrent($sex, 3) . ' value="3">' . $lang['other'] . '</option>';
	return $list;
}
function validGender($sex)
{
	$gender = array(1, 2, 3);
	if (in_array($sex, $gender)) {
		return true;
	}
}
function getGender($s)
{
	global $lang;
	switch ($s) {
		case 1:
			return $lang['male'];
		case 2:
			return $lang['female'];
		case 3:
			return $lang['other'];
		default:
			return $lang['other'];
	}
}
function userGender($g)
{
	global $lang;
	switch ($g) {
		case 1:
			return $lang['male'];
		case 2:
			return $lang['female'];
		default:
			return '';
	}
}
function avGender($s)
{
	global $data;
	if ($data['gender_ico'] > 0) {
		switch ($s) {
			case 1:
				return 'avsex boy';
			case 2:
				return 'avsex girl';
			case 3:
				return 'avsex nosex';
			default:
				return 'avsex nosex';
		}
	} else {
		return 'avsex nosex';
	}
}

// mobile function

function getMobile()
{
	$list = array('mobile', 'phone', 'iphone', 'ipad', 'ipod', 'android', 'silk', 'kindle', 'blackberry', 'opera Mini', 'opera Mobi', 'symb');
	foreach ($list as $val) {
		if (stripos($_SERVER['HTTP_USER_AGENT'], $val) !== false) {
			return 1;
		}
	}
	return 0;
}
function getMobileIcon($user, $c)
{
	global $lang;
	if ($user['user_mobile'] > 0) {
		return '<img title="' . $lang['mobile'] . '" class="' . $c . '" src="default_images/icons/mobile.svg"/>';
	}
}

// status functions

function validStatus($val)
{
	$valid = array(1, 2, 3, 6);
	if ($val == 6 && !canInvisible()) {
		return false;
	}
	if (in_array($val, $valid)) {
		return true;
	}
}
function statusTitle($status)
{
	global $lang;
	switch ($status) {
		case 1:
			return $lang['online'];
		case 2:
			return $lang['away'];
		case 3:
			return $lang['busy'];
		case 6:
			return $lang['invisible'];
		default:
			return $lang['online'];
	}
}
function statusIcon($status)
{
	switch ($status) {
		case 1:
			return 'online.svg';
		case 2:
			return 'away.svg';
		case 3:
			return 'busy.svg';
		case 6:
			return 'invisible.svg';
		default:
			return 'online.svg';
	}
}
function getStatus($status, $c)
{
	switch ($status) {
		case 2:
			return curStatus(statusTitle(2), statusIcon(2), $c);
		case 3:
			return curStatus(statusTitle(3), statusIcon(3), $c);
		default:
			return '';
	}
}
function listStatus($status)
{
	switch ($status) {
		case 1:
			return statusMenu(statusTitle(1), statusIcon(1));
		case 2:
			return statusMenu(statusTitle(2), statusIcon(2));
		case 3:
			return statusMenu(statusTitle(3), statusIcon(3));
		case 6:
			return statusMenu(statusTitle(6), statusIcon(6));
		default:
			return statusMenu(statusTitle(1), statusIcon(1));
	}
}
function listAllStatus()
{
	$list = '';
	$list .= statusElement(1, statusTitle(1), statusIcon(1));
	$list .= statusElement(2, statusTitle(2), statusIcon(2));
	$list .= statusElement(3, statusTitle(3), statusIcon(3));
	if (canInvisible()) {
		$list .= statusElement(6, statusTitle(6), statusIcon(6));
	}
	return $list;
}
function newStatusIcon($status)
{
	return 'default_images/status/' . statusIcon($status);
}
function curStatus($txt, $icon, $c)
{
	return '<img title="' . $txt . '" class="' . $c . '" src="default_images/status/' . $icon . '"/>';
}
function statusMenu($txt, $icon)
{
	return '<div class="status_zone"><img class="status_icon" src="default_images/status/' . $icon . '"/></div><div class="status_text">' . $txt . '</div>';
}
function statusElement($val, $txt, $icon)
{
	return '<div class="status_option sub_item" onclick="updateStatus(' . $val . ');" data="' . $val . '">
				<div class="zone_status"><img class="icon_status" src="default_images/status/' . $icon . '"/></div>
				<div class="icon_text">' . $txt . '</div>
			</div>';
}

// system ranking define name and functions

function botRankTitle()
{
	global $lang;
	return 'المراقب الالي';
}
function botRankIcon()
{
	global $lang;
	return 'robot gray_ico';
}
function rankIcon($rank)
{
	if ($rank == 0) {
		return '';
	} else if ($rank > 0 && $rank < 11) {
		return '';
	} else if ($rank >= 11 && $rank < 15) {
		return '';
	} else if ($rank >= 15 && $rank < 20) {
		return '';
	} else if ($rank >= 20 && $rank < 25) {
		return 'gem';
	} else if ($rank >= 25 && $rank < 30) {
		return 'gem';
	} else if ($rank >= 30 && $rank < 35) {
		return 'medal';
	} else if ($rank >= 35 && $rank < 45) {
		return 'medal';
	} else if ($rank >= 45 && $rank < 50) {
		return 'medal';
	} else if ($rank >= 50 && $rank < 55) {
		return 'medal';
	} else if ($rank >= 55 && $rank < 60) {
		return 'medal';
	} else if ($rank >= 60 && $rank < 70) {
		return 'medal';
	} else if ($rank >= 70 && $rank < 75) {
		return 'award';
	} else if ($rank >= 75 && $rank < 80) {
		return 'award';
	} else if ($rank >= 80 && $rank < 87) {
		return 'award';
	} else if ($rank == 88) {
		return 'robot';
	} else if ($rank == 89) {
		return 'award';
	} else if ($rank >= 90 && $rank < 95) {
		return 'life-ring';
	} else if ($rank == 95) {
		return 'shield-alt';
	} else if ($rank == 96) {
		return 'star-half-alt';
	} else if ($rank == 97) {
		return 'star';
	} else if ($rank == 98) {
		return 'star';
	} else if ($rank == 99) {
		return 'crown';
	} else if ($rank == 100) {
		return 'trophy';
	} else {
		return 'user';
	}
}
function rankTitle($rank)
{
	global $lang;
	if ($rank == 0) {
		return 'زائر';
	} else if ($rank > 0 && $rank < 11) {
		return 'عضو مشارك رتبة ' . $rank . '';
	} else if ($rank >= 11 && $rank < 15) {
		return 'عضو نشيط رتبة' . $rank . '';
	} else if ($rank >= 15 && $rank < 20) {
		return 'عضو مجتهد رتبة ' . $rank . '';
	} else if ($rank >= 20 && $rank < 25) {
		return 'عضو مميز رتبة ' . $rank . '';
	} else if ($rank >= 25 && $rank < 30) {
		return 'عضو لامع رتبة ' . $rank . '';
	} else if ($rank >= 30 && $rank < 35) {
		return 'عضو متألق رتبة ' . $rank . '';
	} else if ($rank >= 35 && $rank < 45) {
		return 'عضو فضي رتبة ' . $rank . '';
	} else if ($rank >= 45 && $rank < 50) {
		return 'عضو ذهبي رتبة ' . $rank . '';
	} else if ($rank >= 50 && $rank < 55) {
		return 'عضو ماسي رتبة ' . $rank . '';
	} else if ($rank >= 55 && $rank < 60) {
		return 'عضو ملكي رتبة ' . $rank . '';
	} else if ($rank >= 60 && $rank < 70) {
		return 'عضو محترف رتبة ' . $rank . '';
	} else if ($rank >= 70 && $rank < 75) {
		return 'عضو مؤسس رتبة ' . $rank . '';
	} else if ($rank >= 75 && $rank < 80) {
		return 'عضو مؤسس رتبة ' . $rank . '';
	} else if ($rank >= 80 && $rank < 87) {
		return 'عضو اداري رتبة ' . $rank . '';
	} else if ($rank == 88) {
		return 'المراقب الآلي';
	} else if ($rank == 89) {
		return 'Premium';
	} else if ($rank >= 90 && $rank < 95) {
		return 'Support ' . $rank . '';
	} else if ($rank == 95) {
		return 'Moderator';
	} else if ($rank == 96) {
		return 'Director';
	} else if ($rank == 97) {
		return 'Admin';
	} else if ($rank == 98) {
		return 'SuperAdmin';
	} else if ($rank == 99) {
		return 'Owner';
	} else if ($rank == 100) {
		return 'صاحب الموقع';
	} else {
		return 'User';
	}
}
function roomRankTitle($rank)
{
	global $lang;
	switch ($rank) {
		case 6:
			return $lang['r_owner'];
		case 5:
			return $lang['r_admin'];
		case 4:
			return $lang['r_mod'];
		default:
			return $lang['user'];
	}
}
function roomRankIcon($rank)
{
	switch ($rank) {
		case 6:
			return 'gavel brown_ico';
		case 5:
			return 'gavel gold_ico';
		case 4:
			return 'gavel bblue_ico';
		default:
			return 'user';
	}
}
function botRank($type)
{
	return curRanking($type, botRankTitle(), botRankIcon());
}
function systemRank($rank, $type)
{
	if ($rank == 0) {
		return curRanking($type, 'زائر', '');
	} else if ($rank > 0 && $rank < 11) {
		return curRanking($type, 'عضو مشارك رتبة ' . $rank . '', '');
	} else if ($rank >= 11 && $rank < 15) {
		return curRanking($type, 'عضو نشيط رتبة ' . $rank . '', '');
	} else if ($rank >= 15 && $rank < 20) {
		return curRanking($type, 'عضو مجته رتبة ' . $rank . '', '');
	} else if ($rank >= 20 && $rank < 25) {
		return curRanking($type, 'عضو ممي رتبة ' . $rank . '', 'gem white_ico');
	} else if ($rank >= 25 && $rank < 30) {
		return curRanking($type, 'عضو لام رتبة ' . $rank . '', 'gem orange_ico');
	} else if ($rank >= 30 && $rank < 35) {
		return curRanking($type, 'عضو متالق رتبة ' . $rank . '', 'medal orange_ico');
	} else if ($rank >= 35 && $rank < 40) {
		return curRanking($type, 'عضو رونزي رتبة ' . $rank . '', 'medal wbrown_ico');
	} else if ($rank >= 40 && $rank < 45) {
		return curRanking($type, 'ضو فضي رتبة ' . $rank . '', 'medal white_ico');
	} else if ($rank >= 45 && $rank < 50) {
		return curRanking($type, 'ضو ذهبي رتبة ' . $rank . '', 'medal gold_ico');
	} else if ($rank >= 50 && $rank < 55) {
		return curRanking($type, 'عضو ماسي رتبة ' . $rank . '', 'medal brown_ico');
	} else if ($rank >= 55 && $rank < 60) {
		return curRanking($type, 'عضو ملكي رتبة ' . $rank . '', 'medal brown_ico');
	} else if ($rank >= 60 && $rank < 70) {
		return curRanking($type, 'عضو محترف رتبة ' . $rank . '', 'award white_ico');
	} else if ($rank >= 70 && $rank < 75) {
		return curRanking($type, 'عضو مؤسس رتبة ' . $rank . '', 'award gold_ico');
	} else if ($rank >= 75 && $rank < 80) {
		return curRanking($type, 'عضو مؤسس رتبة ' . $rank . '', 'award gold_ico');
	} else if ($rank >= 80 && $rank < 87) {
		return curRanking($type, 'عضو اداري رتبة ' . $rank . '', 'award gold_ico');
	} else if ($rank == 88) {
		return curRanking($type, 'المرقب الالي', 'robot gray_ico');
	} else if ($rank == 89) {
		return curRanking($type, 'Premium', 'award gold_ico');
	} else if ($rank >= 90 && $rank < 95) {
		return curRanking($type, 'Support ' . $rank . '', 'life-ring brown_ico');
	} else if ($rank == 95) {
		return curRanking($type, 'Moderator', 'shield-alt gray_ico');
	} else if ($rank == 96) {
		return curRanking($type, 'Director', 'star-half-alt gray_ico');
	} else if ($rank == 97) {
		return curRanking($type, 'Admin', 'star gray_ico');
	} else if ($rank == 98) {
		return curRanking($type, 'SuperAdmin', 'star gold_ico');
	} else if ($rank == 99) {
		return curRanking($type, 'Owner', 'crown gold_ico');
	} else if ($rank == 100) {
		return curRanking($type, 'صاحب الموقع', 'trophy gold_ico');
	} else {
		return '';
	}
}
function proRanking($user, $type)
{
	if (isBot($user)) {
		return proRank($type, botRankTitle(), botRankIcon());
	} else {
		if ($user['user_rank'] == 0) {
			return proRank($type, 'زائر', '');
		} else if ($user['user_rank'] > 0 && $user['user_rank'] < 11) {
			return proRank($type, 'عضو مشارك رتبة ' . $user['user_rank'] . '', '');
		} else if ($user['user_rank'] >= 11 && $user['user_rank'] < 15) {
			return proRank($type, 'عضو نيط رتبة ' . $user['user_rank'] . '', '');
		} else if ($user['user_rank'] >= 15 && $user['user_rank'] < 20) {
			return proRank($type, 'عضو مجتهد رتبة ' . $user['user_rank'] . '', '');
		} else if ($user['user_rank'] >= 20 && $user['user_rank'] < 25) {
			return proRank($type, 'عضو مميز رتبة ' . $user['user_rank'] . '', 'gem white_ico');
		} else if ($user['user_rank'] >= 25 && $user['user_rank'] < 30) {
			return proRank($type, 'عضو لامع رتبة ' . $user['user_rank'] . '', 'gem orange_ico');
		} else if ($user['user_rank'] >= 30 && $user['user_rank'] < 35) {
			return proRank($type, 'عضو متلق رتبة ' . $user['user_rank'] . '', 'medal orange_ico');
		} else if ($user['user_rank'] >= 35 && $user['user_rank'] < 40) {
			return proRank($type, 'عضو بونزي رتبة ' . $user['user_rank'] . '', 'medal wbrown_ico');
		} else if ($user['user_rank'] >= 40 && $user['user_rank'] < 45) {
			return proRank($type, 'عضو فضي رتبة ' . $user['user_rank'] . '', 'medal white_ico');
		} else if ($user['user_rank'] >= 45 && $user['user_rank'] < 50) {
			return proRank($type, 'عضو ذهبي رتة ' . $user['user_rank'] . '', 'medal gold_ico');
		} else if ($user['user_rank'] >= 50 && $user['user_rank'] < 55) {
			return proRank($type, 'عضو ماس رتبة ' . $user['user_rank'] . '', 'medal brown_ico');
		} else if ($user['user_rank'] >= 55 && $user['user_rank'] < 60) {
			return proRank($type, 'عضو ملكي رتبة ' . $user['user_rank'] . '', 'medal brown_ico');
		} else if ($user['user_rank'] >= 60 && $user['user_rank'] < 70) {
			return proRank($type, 'عضو محترف رتبة ' . $user['user_rank'] . '', 'award white_ico');
		} else if ($user['user_rank'] >= 70 && $user['user_rank'] < 75) {
			return proRank($type, ' عضو مؤسس رتبة ' . $user['user_rank'] . '', 'award gold_ico');
		} else if ($user['user_rank'] >= 75 && $user['user_rank'] < 80) {
			return proRank($type, 'عضو مؤسس رتبة ' . $user['user_rank'] . '', 'award gold_ico');
		} else if ($user['user_rank'] >= 80 && $user['user_rank'] < 87) {
			return proRank($type, 'عضو اداري رتبة ' . $user['user_rank'] . '', 'award gold_ico');
		} else if ($user['user_rank'] == 88) {
			return proRank($type, 'المراقب آلالي', 'bot gray_ico');
		} else if ($user['user_rank'] == 89) {
			return proRank($type, 'Premium', 'award gold_ico');
		} else if ($user['user_rank'] >= 90 && $user['user_rank'] < 95) {
			return proRank($type, 'Support ' . $user['user_rank'] . '', 'life-ring wbrown_ico');
		} else if ($user['user_rank'] == 95) {
			return proRank($type, 'Moderator', 'shield-alt gray_ico');
		} else if ($user['user_rank'] == 96) {
			return proRank($type, 'Director', 'star-half-alt gray_ico');
		} else if ($user['user_rank'] == 97) {
			return proRank($type, 'Admin', 'star gray_ico');
		} else if ($user['user_rank'] == 98) {
			return proRank($type, 'SuperAdmin', 'star gold_ico');
		} else if ($user['user_rank'] == 99) {
			return proRank($type, 'Owner', 'crown gold_ico');
		} else if ($user['user_rank'] == 100) {
			return proRank($type, 'صاحب الموقع', 'trophy gold_ico');
		} else {
			return '';
		}
	}
}
function roomRank($rank, $type)
{
	switch ($rank) {
		case 6:
		case 5:
		case 4:
			return curRanking($type, roomRankTitle($rank), roomRankIcon($rank));
		default:
			return '';
	}
}
function listRank($current, $req = 0)
{
	global $data;
	$rank = '';
	$min = 1;
	if ($req == 1) {
		$rank .= '<option value="0" ' . selCurrent($current, 0) . '>' . rankTitle(0) . '</option>';
	}
	for ($n = $min; $n <= 100; $n++) {
		if ($n < 88) {
			$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Rank / ' . $n . '</option>';
		} else if ($n == 88) {
			$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>المراقب الآلي / ' . $n . '</option>';
		} else if ($n == 89) {
			$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Premium / ' . $n . '</option>';
		} else if ($n >= 90 && $n < 95) {
			$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Support / ' . $n . '</option>';
		} else if ($n == 95) {
			$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Moderator / ' . $n . '</option>';
		} else if ($n == 96) {
			$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Director / ' . $n . '</option>';
		} else if ($n == 97) {
			$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Admin / ' . $n . '</option>';
		} else if ($n == 98) {
			$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>SuperAdmin / ' . $n . '</option>';
		} else if ($n == 99) {
			$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Owner / ' . $n . '</option>';
		} else if ($n == 100) {
			$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>صاحب الموقع / ' . $n . '</option>';
		} else {
			$rank = '';
		}
	}
	return $rank;
}
function changeRank($current)
{
	global $data, $cody;
	$rank = '';
	$min = 1;
	for ($n = $min; $n <= 99; $n++) {
		if ($data['user_rank'] == 97) {
			if ($n >= 1 && $n <= 5) {
				$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Rank / ' . $n . '</option>';
			}
		}
		if ($data['user_rank'] == 98) {
			if ($n >= 1 && $n <= 10) {
				$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Rank / ' . $n . '</option>';
			}
		}
		if ($data['user_rank'] == 99) {
			if ($n >= 1 && $n <= 20) {
				$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Rank / ' . $n . '</option>';
			}
		}
		if (boomAllow(100)) {
			if ($n < 88) {
				$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Rank / ' . $n . '</option>';
			} else if ($n == 88) {
				$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>المراقب الالي / ' . $n . '</option>';
			} else if ($n == 89) {
				$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Premium / ' . $n . '</option>';
			} else if ($n >= 90 && $n < 95) {
				$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Support / ' . $n . '</option>';
			} else if ($n == 95) {
				$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Moderator / ' . $n . '</option>';
			} else if ($n == 96) {
				$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Director / ' . $n . '</option>';
			} else if ($n == 97) {
				$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Admin / ' . $n . '</option>';
			} else if ($n == 98) {
				$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>SuperAdmin / ' . $n . '</option>';
			} else if ($n == 99) {
				$rank .= '<option value="' . $n . '" ' . selCurrent($current, $n) . '>Owner / ' . $n . '</option>';
			} else {
				$rank = '';
			}
		}
	}
	return $rank;
}
function listRoomRank($current = 0)
{
	global $lang, $data;
	$rank = '';
	if (boomAllow(100) || boomRole(6)) {
		$rank .= '<option value="0" ' . selCurrent($current, 0) . '>' . $lang['none'] . '</option>';
		$rank .= '<option value="4" ' . selCurrent($current, 4) . '>' . roomRankTitle(4) . '</option>';
		$rank .= '<option value="5" ' . selCurrent($current, 5) . '>' . roomRankTitle(5) . '</option>';
	}
	if (boomAllow(100)) {
		$rank .= '<option value="6" ' . selCurrent($current, 6) . '>' . roomRankTitle(6) . '</option>';
	}
	return $rank;
}
function curRanking($type, $txt, $icon)
{
	return '<i class="fa fa-' . $icon . ' ' . $type . '" title="' . $txt . '"></i>';
}
function proRank($type, $txt, $icon)
{
	return '<i class="fa fa-' . $icon . ' ' . $type . '"/></i> ' . $txt;
}
function getRankIcon($list, $type)
{
	if (isBot($list)) {
		return botRank($type);
	} else if (haveRole($list['user_role']) && !isStaff($list['user_rank'])) {
		return roomRank($list['user_role'], $type);
	} else {
		return systemRank($list['user_rank'], $type);
	}
}

// room access ranking functions

function roomAccessTitle($room)
{
	global $lang;
	switch ($room) {
		case 0:
			return $lang['public'];
		case 1:
			return $lang['members'];
		case 2:
			return $lang['vip'];
		case 8:
			return $lang['staff'];
		case 9:
			return $lang['admin'];
		default:
			return $lang['public'];
	}
}
function roomAccessIcon($room)
{
	global $lang;
	switch ($room) {
		case 0:
			return 'public_room.svg';
		case 1:
			return 'member_room.svg';
		case 2:
			return 'vip_room.svg';
		case 8:
			return 'staff_room.svg';
		case 9:
			return 'admin_room.svg';
		default:
			return 'public_room.svg';
	}
}
function roomRanking($rank = 0)
{
	global $lang;
	$room_menu = '<option value="0" ' . selCurrent($rank, 0) . '>' . roomAccessTitle(0) . '</option>';
	if (boomAllow(100)) {
		$room_menu .= '<option value="1" ' . selCurrent($rank, 1) . '>' . roomAccessTitle(1) . '</option>';
		$room_menu .= '<option value="2" ' . selCurrent($rank, 2) . '>' . roomAccessTitle(2) . '</option>';
		$room_menu .= '<option value="8" ' . selCurrent($rank, 8) . '>' . roomAccessTitle(8) . '</option>';
		$room_menu .= '<option value="9" ' . selCurrent($rank, 9) . '>' . roomAccessTitle(9) . '</option>';
	}
	return $room_menu;
}
function roomIcon($room, $type)
{
	global $lang;
	switch ($room['access']) {
		case 0:
		case 1:
		case 2:
		case 8:
		case 9:
			return roomIconTemplate($type, roomAccessTitle($room['access']), roomAccessIcon($room['access']));
		default:
			return roomIconTemplate($type, roomAccessTitle(0), roomAccessIcon(0));
	}
}
function roomIconTemplate($type, $txt, $icon)
{
	global $data;
	return '<img title="' . $txt . '" class="' . $type .  '" src="' . $data['domain'] . '/default_images/rooms/' . $icon . '">';
}
function roomLock($room, $type)
{
	global $data, $lang;
	if ($room['password'] != '') {
		return '<img title="' . $lang['password'] . '" class="' . $type .  '" src="' . $data['domain'] . '/default_images/rooms/locked_room.svg">';
	}
}

// permission functions

function canEditRoom()
{
	global $cody, $data;
	if (boomRole(6) && $data['no_perm'] == 1 || boomAllow($cody['can_edit_room']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canManageRoom()
{
	global $cody, $data;
	if (boomRole(6)  && $data['no_perm'] == 1 || boomAllow($cody['can_manage_room'])  && $data['no_perm'] == 1) {
		return true;
	}
}
function canUploadChat()
{
	global $data;
	if (boomAllow($data['allow_cupload'])) {
		return true;
	}
}
function canUploadPrivate()
{
	global $data;
	if (boomAllow($data['allow_pupload'])) {
		return true;
	}
}
function canUploadWall()
{
	global $data;
	if (boomAllow($data['allow_wupload'])) {
		return true;
	}
}
function canCover()
{
	global $data;
	if (boomAllow($data['allow_cover'])) {
		return true;
	}
}
function canGifCover()
{
	global $data;
	if (boomAllow($data['allow_gcover'])) {
		return true;
	}
}
function canRoom()
{
	global $data;
	if (boomAllow($data['allow_room'])) {
		return true;
	}
}
function canEmo()
{
	global $data;
	if (boomAllow($data['emo_plus'])) {
		return true;
	}
}
function canName()
{
	global $data;
	if (boomAllow($data['allow_name'])) {
		return true;
	}
}
function canDirect()
{
	global $data;
	if (boomAllow($data['allow_direct'])) {
		return true;
	}
}
function userCanDirect($user)
{
	global $data;
	if (userBoomAllow($user, $data['allow_direct'])) {
		return true;
	}
}
function canColor()
{
	global $data;
	if (boomAllow($data['allow_colors'])) {
		return true;
	}
}
function canGrad()
{
	global $data;
	if (boomAllow($data['allow_grad'])) {
		return true;
	}
}
function canNeon()
{
	global $data;
	if (boomAllow($data['allow_neon'])) {
		return true;
	}
}
function canFont()
{
	global $data;
	if (boomAllow($data['allow_font'])) {
		return true;
	}
}
function canMood()
{
	global $data;
	if (boomAllow($data['allow_mood'])) {
		return true;
	}
}
function canVerify()
{
	global $data;
	if (boomAllow($data['allow_verify'])) {
		return true;
	}
}
function canHistory()
{
	global $data;
	if (boomAllow($data['allow_history'])) {
		return true;
	}
}
function canAvatar()
{
	global $data;
	if (boomAllow($data['allow_avatar'])) {
		return true;
	}
}
function canTheme()
{
	global $data;
	if (boomAllow($data['allow_theme'])) {
		return true;
	}
}
function canInfo()
{
	global $cody;
	if (boomAllow($cody['can_edit_info'])) {
		return true;
	}
}
function canAbout()
{
	global $cody;
	if (boomAllow($cody['can_edit_about'])) {
		return true;
	}
}
function canNameColor()
{
	global $data;
	if (boomAllow($data['allow_name_color']) || boomRole(4)) {
		return true;
	}
}
function canNameGrad()
{
	global $data;
	if (boomAllow($data['allow_name_grad']) || boomRole(4)) {
		return true;
	}
}
function canNameNeon()
{
	global $data;
	if (boomAllow($data['allow_name_neon']) || boomRole(6)) {
		return true;
	}
}
function canNameFont()
{
	global $data;
	if (boomAllow($data['allow_name_font'])) {
		return true;
	}
}
function canInvisible()
{
	global $data, $cody;
	if (boomAllow($cody['can_invisible']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canPostNews()
{
	global $data, $cody;
	if (boomAllow($cody['can_post_news']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canModifyAvatar($user)
{
	global $data, $cody;
	if (!empty($user) && canEditUser($user, $cody['can_modify_avatar']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canModifyCover($user)
{
	global $data, $cody;
	if (!empty($user) && canEditUser($user, $cody['can_modify_cover']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canModifyName($user)
{
	global $data, $cody;
	if (!empty($user) && canEditUser($user, $cody['can_modify_name']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canModifyMood($user)
{
	global $data, $cody;
	if (!empty($user) && canMood() && canEditUser($user, $cody['can_modify_mood']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canModifyAbout($user)
{
	global $data, $cody;
	if (!empty($user) && canEditUser($user, $cody['can_modify_about']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canModifyEmail($user)
{
	global $data, $cody;
	if (!empty($user) && isMember($user) && isSecure($user) && canEditUser($user, $cody['can_modify_email'], 1) && $data['no_perm'] == 1) {
		return true;
	}
}
function canModifyColor($user)
{
	global $data, $cody;
	if (!empty($user) && canEditUser($user, $cody['can_modify_color']) && $data['no_perm'] == 1 || boomRole(4) && $data['no_perm'] == 1) {
		return true;
	}
}
function canModifyPassword($user)
{
	global $data, $cody;
	if (!empty($user) && isMember($user) && isSecure($user) && canEditUser($user, $cody['can_modify_password'], 1) && $data['no_perm'] == 1) {
		return true;
	}
}
function canUserHistory($user)
{
	global $data, $cody;
	if (!empty($user) && canEditUser($user, $cody['can_view_history'], 1) && $data['no_perm'] == 1) {
		return true;
	}
}
function canViewInvisible()
{
	global $cody, $data;
	if (boomAllow($cody['can_inv_view']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canViewTimezone($user)
{
	global $data, $cody;
	if (canEditUser($user, $cody['can_view_timezone'], 1) && $data['no_perm'] == 1) {
		return true;
	}
}
function canViewEmail($user)
{
	global $data, $cody;
	if (userHaveEmail($user) && canEditUser($user, $cody['can_view_email'], 1) && $data['no_perm'] == 1) {
		return true;
	}
}
function canViewId($user)
{
	global $data, $cody;
	if (canEditUser($user, $cody['can_view_id'], 1) && $data['no_perm'] == 1) {
		return true;
	}
}
function canCritera($t)
{
	if (boomAllow($t) && $data['no_perm'] == 1) {
		return true;
	}
}
function canViewIp($user)
{
	global $data, $cody;
	if (canEditUser($user, $cody['can_view_ip'], 1) && $data['no_perm'] == 1) {
		return true;
	}
}
function canRoomPassword()
{
	global $data, $cody;
	if (boomAllow($cody['can_room_pass']) && $data['no_perm'] == 1 || boomRole(6) && $data['no_perm'] == 1) {
		return true;
	}
}
function canBan()
{
	global $data, $cody;
	if (boomAllow($cody['can_ban']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canBanUser($user)
{
	global $data, $cody;
	if (!empty($user) && canEditUser($user, $cody['can_ban'], 1) && $data['no_perm'] == 1) {
		return true;
	}
}
function canRankUser($user)
{
	global $data, $cody;
	if (isOwner($user) || isGuest($user)) {
		return false;
	}
	if (!empty($user) && canEditUser($user, $cody['can_rank'], 0) && $data['no_perm'] == 1) {
		return true;
	}
}
function canDeleteUser($user)
{
	global $data, $cody;
	if (isOwner($user) || $data['no_perm'] == 0) {
		return false;
	}
	if (!empty($user) && canEditUser($user, $cody['can_delete'], 1)) {
		return true;
	}
}
function canKick()
{
	global $data, $cody;
	if (boomAllow($cody['can_kick']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canKickUser($user)
{
	global $data, $cody;
	if (!empty($user) && canEditUser($user, $cody['can_kick'], 1) && $data['no_perm'] == 1) {
		return true;
	}
}
function canDeleteNews($news)
{
	global $data, $cody;
	if (mySelf($news['news_poster']) || isOwner($data)) {
		return true;
	}
	if (boomAllow($cody['can_delete_news']) && isGreater($news['user_rank']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canDeleteNewsReply($reply)
{
	global $data, $cody;
	if (mySelf($reply['reply_uid']) || isOwner($data)) {
		return true;
	}
	if (boomAllow($cody['can_delete_news']) && isGreater($reply['user_rank']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canDeleteWall($wall)
{
	global $data, $cody;
	if (mySelf($wall['post_user'])) {
		return true;
	}
	if (boomAllow($cody['can_delete_wall']) && isGreater($wall['user_rank']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canDeleteWallReply($wall)
{
	global $data, $cody;
	if (mySelf($wall['reply_user'])) {
		return true;
	}
	if (mySelf($wall['reply_uid'])) {
		return true;
	}
	if (boomAllow($cody['can_delete_wall']) && isGreater($wall['user_rank']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canDeleteLog()
{
	global $cody, $data;
	if (boomAllow(1) && boomAllow($cody['can_delete_logs']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canDeleteSelfLog($p)
{
	global $data, $cody;
	if ($p['user_id'] == $data['user_id'] && boomAllow($cody['can_delete_slogs'])) {
		return true;
	}
}
function canReport()
{
	global $cody;
	if (boomAllow($cody['can_report'])) {
		return true;
	}
}
function canManageReport()
{
	global $cody;
	if (boomAllow($cody['can_manage_report'])) {
		return true;
	}
}
function selfManageReport($id)
{
	global $cody;
	if (!mySelf($id)) {
		return true;
	}
	if (mySelf($id) && boomAllow($cody['can_self_report'])) {
		return true;
	}
}
function canDeletePrivate()
{
	global $cody;
	if (boomAllow($cody['can_delete_private'])) {
		return true;
	}
}
function canDeleteRoomLog()
{
	global $data;
	if (boomAllow(1) && boomRole(4) && $data['no_perm'] == 1) {
		return true;
	}
}
function canClearRoom()
{
	global $cody, $data;
	if (boomAllow($cody['can_clear_room']) && $data['no_perm'] == 1 || boomRole(6) && $data['no_perm'] == 1) {
		return true;
	}
}

// DO NOT MODIFY THE MUTE PERMISSION THIS WILL MAKE CONFLICT IN THE SYSTEM.

function canMute()
{
	global $data, $cody;
	if (boomAllow($cody['can_mute']) && $data['no_perm'] == 1) {
		return true;
	}
}
function canMuteUser($user)
{
	global $data, $cody;
	if (!empty($user) && canEditUser($user, $cody['can_mute'], 1) && $data['no_perm'] == 1) {
		return true;
	}
}

function fileFlood()
{
	global $cody;
	$f = basename($_SERVER['PHP_SELF']);
	$t1 = round(microtime(true) * 1000);
	$t2 = round(microtime(true) * 1000) - 500;

	if (isset($_SESSION[BOOM_PREFIX . 'ufile'], $_SESSION[BOOM_PREFIX . 'ufiletime'])) {
		if ($_SESSION[BOOM_PREFIX . 'ufile'] == $f && $_SESSION[BOOM_PREFIX . 'ufiletime'] >= $t2) {
			return true;
		} else {
			$_SESSION[BOOM_PREFIX . 'ufiletime'] = $t1;
			$_SESSION[BOOM_PREFIX . 'ufile'] = $f;
			return false;
		}
	} else {
		$_SESSION[BOOM_PREFIX . 'ufiletime'] = $t1;
		$_SESSION[BOOM_PREFIX . 'ufile'] = $f;
		return false;
	}
}
function createSelect($type, $current)
{
	$select = '';
	if ($type == 'private') {
		$select .= '<option value="1" ' . selCurrent($current, 1) . '>الجميع</option>';
		if (boomAllow(1)) {
			$select .= '<option value="3" ' . selCurrent($current, 3) . '>الاعضاء</option>';
			$select .= '<option value="2" ' . selCurrent($current, 2) . '>الاصدقاء فقط</option>';
		}
		$select .= '<option value="0" ' . selCurrent($current, 0) . '>ايقاف</option>';
	} else if ($type == 'sound') {
		$select .= '<option value="1" ' . selCurrent($current, 1) . '>جميع الاصوات</option>';
		$select .= '<option value="2" ' . selCurrent($current, 2) . '>الخاص والاشعارات فقط</option>';
		$select .= '<option value="0" ' . selCurrent($current, 0) . '>صامت</option>';
	} else if ($type == 'ask_private') {
		$select .= '<option value="1" ' . selCurrent($current, 1) . '>تشغيل</option>';
		$select .= '<option value="0" ' . selCurrent($current, 0) . '>ايقاف</option>';
	} else if ($type == 'ask_friend') {
		$select .= '<option value="1" ' . selCurrent($current, 1) . '>تشغيل</option>';
		$select .= '<option value="0" ' . selCurrent($current, 0) . '>ايقاف</option>';
	} else if ($type == 'points') {
		$select .= '<option value="1" ' . selCurrent($current, 1) . '>الجميع</option>';
		$select .= '<option value="3" ' . selCurrent($current, 3) . '>الاعضاء</option>';
		$select .= '<option value="2" ' . selCurrent($current, 2) . '>الاصدقاء فقط</option>';
		$select .= '<option value="0" ' . selCurrent($current, 0) . '>انا فقط</option>';
	} else if ($type == 'friends') {
		$select .= '<option value="1" ' . selCurrent($current, 1) . '>الجميع</option>';
		$select .= '<option value="3" ' . selCurrent($current, 3) . '>الاعضاء</option>';
		$select .= '<option value="2" ' . selCurrent($current, 2) . '>الاصدقاء قط</option>';
		$select .= '<option value="0" ' . selCurrent($current, 0) . '>انا فقط</option>';
	} else if ($type == 'join') {
		$select .= '<option value="1" ' . selCurrent($current, 1) . '>تشغيل</option>';
		$select .= '<option value="0" ' . selCurrent($current, 0) . '>ايقاف</option>';
	} else {
		$select = '';
	}
	return $select;
}
function calUsersInChat()
{
	global $data, $mysqli;
	$usersCount = 0;
	$delay = time() - 30;
	$mSql = $mysqli->query("SELECT * FROM boom_users WHERE last_action > '$delay'");
	if ($mSql->num_rows > 0) {
		while ($s = $mSql->fetch_assoc()) {
			$usersCount++;
		}
	}
	return $usersCount;
}
function burls(){
	$ht = 'http';
	if(isset($_SERVER['HTTPS'])){
		$ht = 'https';
	}
	$burl = $ht . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	return $burl;
}
function geoCurl($url, $f = [])
{
    $result = "";
    if (function_exists("curl_init")) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        if (!empty($f)) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $f);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_REFERER, burls());
        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            $result = "";
        }
        curl_close($curl);
    }
    return $result;
}
function sameAccountDC($u)
{
	global $mysqli, $lang;
	$getsame = $mysqli->query("SELECT user_name, user_id FROM boom_users WHERE device_code = '{$u['device_code']}' AND user_id != '{$u['user_id']}' AND user_bot = 0 ORDER BY user_id DESC LIMIT 50");
	$same = array();
	if ($getsame->num_rows > 0) {
		while ($usame = $getsame->fetch_assoc()) {
			array_push($same, '<a onclick="getProfile('.$usame['user_id'].');">'.$usame['user_name'].'</a>');
		}
	} else {
		array_push($same, '');
	}
	return listThisArray($same);
}
function sameAccountDCAdmin($u)
{
	global $mysqli, $lang;
	$getsame = $mysqli->query("SELECT user_name, user_id FROM boom_users WHERE device_code = '$u' AND user_bot = 0 ORDER BY user_id DESC LIMIT 50");
	$same = array();
	if ($getsame->num_rows > 0) {
		while ($usame = $getsame->fetch_assoc()) {
			array_push($same, '<a onclick="getProfile('.$usame['user_id'].');">'.$usame['user_name'].'</a>');
		}
	} else {
		array_push($same, '');
	}
	return listThisArray($same);
}
function getBannedDevices(){
	global $mysqli;
	$pg = '';
	$getCount = $mysqli->query("SELECT * FROM ex_dead_device");
	if($getCount->num_rows > 0){
		while($user = $getCount->fetch_assoc()){
			$pg .= boomTemplate('element/ban_devices', $user);
		}
	} else {
		$pg = emptyZone('No Devices Found.');
	}
	return $pg;
}
function getBannedBrowsers(){
	global $mysqli;
	$pg = '';
	$getCount = $mysqli->query("SELECT * FROM ex_dead_browser");
	if($getCount->num_rows > 0){
		while($user = $getCount->fetch_assoc()){
			$pg .= boomTemplate('element/ban_browser', $user);
		}
	} else {
		$pg = emptyZone('No Browsers Found.');
	}
	return $pg;
}
function getBannedCountry(){
	global $mysqli;
	$pg = '';
	$getCount = $mysqli->query("SELECT * FROM ex_dead_country");
	if($getCount->num_rows > 0){
		while($user = $getCount->fetch_assoc()){
			$pg .= boomTemplate('element/ban_country', $user);
		}
	} else {
		$pg = emptyZone('No Countries Found.');
	}
	return $pg;
}
function checkBanDevice($d)
{
	global $mysqli, $data;
	if (boomLogged()) {
		$getip = $mysqli->query("SELECT * FROM ex_dead_device WHERE dcode = '$d'");
		if ($getip->num_rows > 0 || $data['user_banned'] > 0) {
			if (!boomAllow(101)) {
				return true;
			}
		}
	}
}
function checkBanBrowser($d)
{
	global $mysqli, $data;
	if (boomLogged()) {
		$getip = $mysqli->query("SELECT * FROM ex_dead_browser WHERE browser = '$d'");
		if ($getip->num_rows > 0 || $data['user_banned'] > 0) {
			if (!boomAllow(100)) {
				return true;
			}
		}
	}
}
function checkBanCountry($d)
{
	global $mysqli, $data;
	if (boomLogged()) {
		$getip = $mysqli->query("SELECT * FROM ex_dead_country WHERE country = '$d'");
		if ($getip->num_rows > 0 || $data['user_banned'] > 0) {
			if (!boomAllow(100)) {
				return true;
			}
		}
	}
}