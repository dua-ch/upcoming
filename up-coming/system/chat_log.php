<?php
require_once('config_chat.php');
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;
use DeviceDetector\Parser\OperatingSystem;
AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

$chat_history = 20;
$chat_substory = 20;
$private_history = 18;
$status_delay = $data['last_action'] + 21;
$out_delay = time() - 1800;

if (isset($_POST['last'], $_POST['snum'], $_POST['caction'], $_POST['fload'], $_POST['preload'], $_POST['priv'], $_POST['lastp'], $_POST['pcount'], $_POST['room'], $_POST['notify'])) {

	// clearing post data 
	$last = escape($_POST['last']);
	$fload = escape($_POST['fload']);
	$snum = escape($_POST['snum']);
	$caction = escape($_POST['caction']);
	$preload = escape($_POST['preload']);
	$priv = escape($_POST['priv']);
	$lastp = escape($_POST['lastp']);
	$pcount = escape($_POST['pcount']);
	$room = escape($_POST['room']);
	$notify = escape($_POST['notify']);

	if ($room != $data['user_roomid']) {
		echo json_encode(array("check" => 199));
		die();
	}

	// main chat part
	$d['mlogs'] = '';
	$d['plogs'] = '';
	$d['mlast'] = $last;
	$d['plast'] = $lastp;
	$main = 1;
	$private = 1;
	$ssnum = 0;
	
	// detect device and set device serial
		$uadev = htmlentities($_SERVER['HTTP_USER_AGENT']);
		$clientHints = ClientHints::factory($_SERVER); // client hints are optional
		$detect = new DeviceDetector($uadev, $clientHints);
		$detect->parse();
		if ($detect->isBot()) {
				// handle bots,spiders,crawlers,...
				$botInfo = $detect->getBot();
				$bname = $botInfo['name'];
				$bcat = $botInfo['category'];
		$mysqli->query("UPDATE boom_users SET device_info = '$bname', device_ua = '$uadev', device_ver = '$bcat' WHERE user_id = '{$data['user_id']}'");
			} else {
				$userInfo = $detect->getClient();
				$osInfo = $detect->getOs();
				
				$ubrowser = $userInfo['name'];
				$ubrowser_ver = $userInfo['engine_version'];
				$device = $detect->getDeviceName();
				$brand = $detect->getBrandName();
				$model = $detect->getModel();
				$brand = $brand != '' ? '/ '.$brand : '';
				$model = $model != '' ? '/ '.$model : '';
				$osInfoName = $osInfo['name'];
				$wver = '';
				if($osInfoName == 'Windows'){
					$wver = $osInfo['version'] .' / '.$osInfo['platform'];
				} else {
					$wver = $osInfo['version'];
				}
				$mysqli->query("UPDATE boom_users SET device_info = '$device $brand $model ', device_ua = '$uadev', device_ver = '$osInfoName / $wver', android_ver = '{$osInfo['version']}', user_browser = '$ubrowser', browser_ver = '$ubrowser_ver' WHERE user_id = '{$data['user_id']}'");
			}
			$divceCode = sha1(str_rot13($device.$brand.$model.$osInfoName.$wver));
			$mysqli->query("UPDATE boom_users SET device_code = '$divceCode' WHERE user_id = '{$data['user_id']}'");
			$mip = getIp();
	$loc = geocurl("http://www.geoplugin.net/php.gp?ip=" . $mip);
	$res = unserialize($loc);
	
	$country_name = escape($res["geoplugin_countryName"]); 
	$city = escape($res["geoplugin_city"]); 
	$region = escape($res["geoplugin_regionName"]); 
	$containt = escape($res["geoplugin_continentName"]); 
	$mysqli->query("UPDATE boom_users SET geo_country = '".$country_name."', geo_city = '".$city."', geo_zip = '".$region."', geo_cont = '".$containt."' WHERE user_id = '" . $data["user_id"] . "'");

	// join room message part
	if (time() > $status_delay || $fload == 0) {
		$ip = getIp();
		if ($fload == 0 && $data['join_msg'] == 0 || $data['last_action'] < $out_delay) {
			joinRoom();
		}
		$mysqli->query("UPDATE boom_users SET join_msg = '1', last_action = '" . time() . "', user_ip = '$ip' WHERE user_id = '{$data['user_id']}'");
	}


	// notification check
	if ($notify < $data['naction']) {
		$get_notify = $mysqli->query("SELECT
		(SELECT count(*) FROM boom_friends WHERE target = '{$data['user_id']}' AND fstatus = '2' AND viewed = '0') as friend_count,
		(SELECT count(*) FROM boom_notification WHERE notified = '{$data['user_id']}' AND notify_view = '0') as notify_count,
		(SELECT count(*) FROM boom_report) as report_count,
		(SELECT count(*) FROM boom_news WHERE news_date > '{$data['user_news']}') as news_count
		");
		if ($get_notify->num_rows == 1) {
			$fetch = $get_notify->fetch_assoc();
			$d['use'] = 1;
			$d['friends'] = $fetch['friend_count'];
			$d['notify'] = $fetch['notify_count'];
			$d['news'] = $fetch['news_count'];
			$d['nnotif'] = $data['naction'];
			if (boomAllow(95)) {
				$d['report'] = $fetch['report_count'];
			}
		}
	}

	// main chat logs part
	if ($fload == 0) {
		$log = $mysqli->query("
		SELECT log.*, 
		boom_users.user_name, boom_users.user_color, boom_users.user_font, boom_users.user_rank, boom_users.bccolor, boom_users.user_sex, boom_users.user_age, boom_users.user_tumb, boom_users.user_cover, boom_users.country, boom_users.user_bot, boom_users.user_role, boom_users.private_ask, boom_users.my_border, boom_users.ex_name_bg,
		boom_users.ex_av_border
		FROM ( SELECT * FROM `boom_chat` WHERE `post_roomid` = {$data['user_roomid']}  AND post_id > '$last' ORDER BY `post_id` DESC LIMIT $chat_history) AS log
		LEFT JOIN boom_users ON log.user_id = boom_users.user_id
		ORDER BY `post_id` ASC
		");
		$ssnum = 1;
	} else {
		if ($caction != $data['rcaction']) {
			$log = $mysqli->query("
				SELECT log.*,
				boom_users.user_name, boom_users.user_color, boom_users.user_font, boom_users.user_rank, boom_users.bccolor, boom_users.user_sex, boom_users.user_age, boom_users.user_tumb, boom_users.user_cover, boom_users.country, boom_users.user_bot, boom_users.user_role, boom_users.private_ask, boom_users.my_border, boom_users.ex_name_bg,
				boom_users.ex_av_border 
				FROM ( SELECT * FROM `boom_chat` WHERE `post_roomid` = {$data['user_roomid']} AND post_id > '$last' ORDER BY `post_id` DESC LIMIT $chat_substory) AS log
				LEFT JOIN boom_users ON log.user_id = boom_users.user_id
				ORDER BY `post_id` ASC
				");
		} else {
			$main = 0;
		}
	}
	if ($main == 1) {
		if ($log->num_rows > 0) {
			while ($chat = $log->fetch_assoc()) {
				$d['mlast'] = $chat['post_id'];
				$d['pt'] = $chat['private_ask'];
				if ($chat['snum'] != $snum || $ssnum == 1) {
					$d['mlogs'] .= createLog($data, $chat, $ignore);
				}
			}
		}
	}

	if (!delExpired($data['rltime'])) {
		$d['del'] = array();
		$todelete = explode(",", $data['rldelete']);
		foreach ($todelete as $delpost) {
			$delpost = trim($delpost);
			array_push($d['del'], $delpost);
		}
	}

	// private logs part
	if ($preload == 1) {
		$privlog = $mysqli->query("
		SELECT 
		log.*, boom_users.user_id, boom_users.user_name, boom_users.user_color, boom_users.user_tumb, boom_users.user_bot 
		FROM ( SELECT * FROM `boom_private` WHERE  `hunter` = '{$data['user_id']}' AND `target` = '$priv'  OR `hunter` = '$priv' AND `target` = '{$data['user_id']}' ORDER BY `id` DESC LIMIT $private_history) AS log 
		LEFT JOIN boom_users
		ON log.hunter = boom_users.user_id
		ORDER BY `time` ASC");
	} else {
		if ($pcount != $data['pcount'] && $priv != 0) {
			$privlog = $mysqli->query("
			SELECT 
			log.*, boom_users.user_id, boom_users.user_name, boom_users.user_color, boom_users.user_tumb, boom_users.user_bot
			FROM ( SELECT * FROM `boom_private` WHERE  `hunter` = '$priv' AND `target` = '{$data['user_id']}' AND id > '$lastp' OR hunter = '{$data['user_id']}' AND target = '$priv' AND id > '$lastp' AND file = 1 ORDER BY `id` DESC LIMIT $private_history) AS log 
			LEFT JOIN boom_users
			ON log.hunter = boom_users.user_id
			ORDER BY `time` ASC");
		} else {
			$private = 0;
		}
	}
	if ($private == 1) {
		if ($privlog->num_rows > 0) {
			$mysqli->query("UPDATE `boom_private` SET `status` = 1 WHERE `hunter` = '$priv' AND `target` = '{$data['user_id']}'");
			while ($private = $privlog->fetch_assoc()) {
				$d['plogs'] .= privateLog($private, $data['user_id']);
				$d['plast'] = $private['id'];
			}
		}
	}

	// topic part
	if ($fload == 0) {
		if ($data['topic'] != '') {
			$d['top'] = getTopic($data['topic']);
		}
	}

	// room access part
	if (canEditRoom()) {
		$d['rset'] = 1;
	}

	// room ranking
	if (haveRole($data['user_role'])) {
		$d['role'] = $data['user_role'];
	}

	// mute check
	if (roomMuted()) {
		$d['rm'] = 1;
	}
	if (guestMuted()) {
		$d['rm'] = 2;
	}
	if (mutedData($data)) {
		if (isMuted($data) || isRegmute($data)) {
			$d['rm'] = 2;
		} else {
			userUnmute($data);
		}
	}

	// $next_exp = setUserExp($data) - 1;
	// if ($data['user_points'] >= $next_exp && $data['user_rank'] < 88 && $data['user_rank'] > 0) {
		// $newlev = $data['user_rank'] + 1;
		// $mysqli->query("UPDATE boom_users SET user_points = user_points - $next_exp  WHERE user_id = '{$data['user_id']}'");
		// $mysqli->query("UPDATE boom_users SET user_rank = user_rank + 1  WHERE user_id = '{$data['user_id']}'");
		// $msg = str_replace(array('@user@', '@new@', '@old@'), array((empty($data['fancy_name']) ? $data['user_name'] : $data['fancy_name']), rankTitle($newlev), rankTitle($data['user_rank'])), '<div style="direction: ltr !important;display: contents;"><b style="color:green;"> [ @user@ ] </b>, Upgraded from rank (<b style="color:blue;">@old@</b>) to (<b style="color:red;">@new@</b>) by points</div>');
		// systemPostChat($data['user_roomid'], $msg);
	// }

	// if($data['user_points'] < 0){
		// $mysqli->query("UPDATE boom_users SET user_points = 0 WHERE user_id = '{$data['user_id']}'");
	// }
	
	$d['lrid'] = 0;
	$prvSeen = userDetails($priv);
	if($data['private_seen'] > 0 && $prvSeen['user_rank'] < 100){
		$seenSql = $mysqli->query("SELECT id FROM boom_private WHERE hunter = '{$data['user_id']}' AND target = '$priv' AND status = '1' ORDER BY id DESC LIMIT 1");
		if ($seenSql->num_rows > 0) {
			while($s = $seenSql->fetch_assoc()){
				$d['lrid'] = $s['id'];
			}
		}
	}

	if ($priv > 0) {
		$user = userDetails($priv);
		$fSql = $mysqli->query("SELECT * FROM boom_friends WHERE hunter = '{$data['user_id']}' AND target = '$priv' AND fstatus = '3' OR hunter = '$priv' AND target = '{$data['user_id']}' AND fstatus = '3'");
		if ($fSql->num_rows > 0) {
			$isFriend = 1;
		} else {
			$isFriend = 0;
		}
		$iSql = $mysqli->query("SELECT * FROM boom_ignore WHERE ignorer = '{$data['user_id']}' AND ignored = '$priv' OR ignorer = '$priv' AND ignored = '{$data['user_id']}'");
		if ($iSql->num_rows > 0) {
			$isIgnored = 1;
		} else {
			$isIgnored = 0;
		}
		$mSql = $mysqli->query("SELECT * FROM prv_ask WHERE uid = '{$data['user_id']}' AND asker = '$priv' AND status = '1' 
		OR uid = '$priv' AND asker = '{$data['user_id']}' AND status = '1'");
		if ($mSql->num_rows > 0) {
			$user_asked = 1;
		} else {
			$user_asked = 0;
		}
		$mSql2 = $mysqli->query("SELECT * FROM prv_ask WHERE uid = '{$data['user_id']}' AND asker = '$priv' AND status = '2' 
		OR uid = '$priv' AND asker = '{$data['user_id']}' AND status = '2'");
		if ($mSql2->num_rows > 0) {
			$ask_allowed = 1;
		}
		$getPremLockedPrivate = $mysqli->query("SELECT * FROM prv_ask WHERE uid = '{$data['user_id']}' AND asker = '$priv' AND status = '3' 
		OR uid = '$priv' AND asker = '{$data['user_id']}' AND status = '3'");
		if ($getPremLockedPrivate->num_rows > 0) {
			if (!boomAllow(100)) {
				$d['perm_locked_private'] = 1;
			} else {
				$d['perm_locked_private'] = 0;
			}
		}
		if ($d['perm_locked_private'] == 1) {
			$d['pt'] = 3;
		} else {
			if ($user['private_ask'] == 1) {
			 if ($ask_allowed == 1) {
					$d['pt'] = 0;
				} else if (isOwner($data) || $user['user_private'] == 2 && $isFriend == 1 || $user['user_private'] == 1 || $user['user_private'] == 3 && $data['user_rank'] >= 1) {
					$d['pt'] = 0;
				} else if (!isOwner($data) && $isIgnored == 1) {
					$d['pt'] = 3;
				} else if (!isOwner($data) && $user['user_private'] == 0 || !isOwner($data) && $user['user_private'] == 2 && $isFriend == 0 || !isOwner($data) && $user['user_private'] == 3 && $data['user_rank'] < 1 || !isOwner($data) && $user_asked == 0) {
					$d['pt'] = 1;
				} else if ($user_asked == 1) {
					$d['pt'] = 2;
				}
			} else {
				if (!isOwner($data) && $user['user_private'] == 2 && $isFriend == 0 || !isOwner($data) && $user['user_private'] == 3 && $data['user_rank'] < 1) {
					$d['pt'] = 3;
				} else if (!isOwner($data) && $user['user_private'] == 0 || !isOwner($data) && $isIgnored == 1) {
					$d['pt'] = 3;
				} else if (isOwner($data) || $user['user_private'] == 1 || $user['user_private'] == 2 && $isFriend == 1 || $user['user_private'] == 3 && $data['user_rank'] >= 1) {
					$d['pt'] = 0;
				}
			}
		}
	}
	
	if ($priv > 0) {
		$getInsidePrvIgnore = $mysqli->query("SELECT * FROM prv_ask WHERE uid = '{$data['user_id']}' AND asker = '$priv' AND status = '2'
		OR asker = '{$data['user_id']}' AND uid = '$priv' AND status = '2'");
		if ($getInsidePrvIgnore->num_rows > 0) {
			$d['prv_close'] = true;
		} else {
			$d['prv_close'] = false;
		}
		$getLockedPrivate = $mysqli->query("SELECT * FROM prv_ask WHERE uid = '{$data['user_id']}' AND asker = '$priv' AND status = '3' AND lock_creator = '{$data['user_id']}'
		OR asker = '{$data['user_id']}' AND uid = '$priv' AND status = '3' AND lock_creator = '{$data['user_id']}'");
		if ($getLockedPrivate->num_rows > 0) {
			$d['prv_locked'] = true;
		} else {
			$d['prv_locked'] = false;
		}
	}
	
	if($data['user_rank'] == 0 && $data['guest_notify'] == 0){
		boomNotify('guest_notify', array("target" => $data['user_id'], "source" => 'guest_notify'));
		$mysqli->query("UPDATE boom_users SET guest_notify = '1' WHERE user_id = '{$data['user_id']}'");
	}

	$eshSql = $mysqli->query("SELECT * FROM boom_users WHERE eshtrak_time > 0");
	if($eshSql->num_rows > 0){
		while($esh = $eshSql->fetch_assoc()){
			if($esh['eshtrak_time'] > 0 AND $esh['eshtrak_time'] < time()){
				$mysqli->query("UPDATE boom_users SET user_rank = '{$esh['base_rank']}' WHERE user_id = '{$esh['user_id']}'");
				if($esh['base_rank'] < 89){
					$mysqli->query("UPDATE boom_users SET my_border = '', ex_av_border = '', ex_name_bg = '', ex_name_bg_glow = '', ex_pro_colors = '', ex_pro_shadow = '', ex_pro_music = '', user_color = 'user' WHERE user_id = '{$esh['user_id']}'");
				}
				$mysqli->query("UPDATE boom_users SET base_rank = '0', eshtrak_time = '0', user_action = user_action + 1 WHERE user_id = '{$esh['user_id']}'");
			}
		}
	}

	$rSql = $mysqli->query("SELECT * FROM boom_rooms WHERE room_id = '{$data['user_roomid']}'");
	if($rSql->num_rows > 0){
		$mroom = $rSql->fetch_assoc();
		$d['room_color'] = $mroom['ex_room_style'];
		$d['room_bg'] = $mroom['ex_room_bg'];
		$d['room_icon'] = $mroom['ex_room_icon'];
	}
	if($data['user_points'] == 0 || $data['user_rank'] < 89 && $data['user_rank'] != 100){
		$mysqli->query("UPDATE boom_users SET my_border = '' WHERE user_id = '{$data['user_id']}'");
	}
	$getuser = $mysqli->query("SELECT * FROM boom_users WHERE user_points >= 0 AND user_rank > 88 AND user_rank != 100 AND user_bot = 0 ORDER BY user_points DESC");
	if ($getuser->num_rows > 0) {
		$rank = 0;
		while ($lead = $getuser->fetch_assoc()) {
			$rank++;
			if($lead['user_points'] >= 1){
				if($rank == 1){
					$mysqli->query("UPDATE boom_users SET my_border = 'n-fr-mlky.webp' WHERE user_id = '{$lead['user_id']}'");
				} else if($rank == 2){
					$mysqli->query("UPDATE boom_users SET my_border = 'n-fr26.gif' WHERE user_id = '{$lead['user_id']}'");
				} else if($rank == 3){
					$mysqli->query("UPDATE boom_users SET my_border = 'n-fr11.webp' WHERE user_id = '{$lead['user_id']}'");
				} else if($rank == 4){
					$mysqli->query("UPDATE boom_users SET my_border = 'n-fr9.webp' WHERE user_id = '{$lead['user_id']}'");
				} else if($rank == 5){
					$mysqli->query("UPDATE boom_users SET my_border = 'n-fr3.webp' WHERE user_id = '{$lead['user_id']}'");
				} else if($rank == 6){
					$mysqli->query("UPDATE boom_users SET my_border = 'ko6.webp' WHERE user_id = '{$lead['user_id']}'");
				} else if($rank == 7){
					$mysqli->query("UPDATE boom_users SET my_border = 'n-fr1.webp' WHERE user_id = '{$lead['user_id']}'");
				} else if($rank == 8){
					$mysqli->query("UPDATE boom_users SET my_border = 'n-fr4.webp' WHERE user_id = '{$lead['user_id']}'");
				} else if($rank == 9){
					$mysqli->query("UPDATE boom_users SET my_border = 'n-fr5.webp' WHERE user_id = '{$lead['user_id']}'");
				} else if($rank == 10){
					$mysqli->query("UPDATE boom_users SET my_border = 'n-fr6.webp' WHERE user_id = '{$lead['user_id']}'");
				} else {
					$mysqli->query("UPDATE boom_users SET my_border = '' WHERE user_id = '{$lead['user_id']}'");
				}
			}
			 else {
				$mysqli->query("UPDATE boom_users SET my_border = '' WHERE user_id = '{$lead['user_id']}'");
			}
		}
	}

	resetPremiumOptions();
	// getUserBorder();
	fetchUserLimits();
	mysqli_close($mysqli);

	// sending results
	$d['pcount'] = $data['pcount'];
	$d['cact'] = $data['rcaction'];
	$d['act'] = $data['user_action'];
	$d['ses'] = $data['session_id'];
	$d['curp'] = $priv;
	$d['spd'] = (int)$data['speed'];
	$d['acd'] = $data['act_delay'];
	$d['pico'] = $data['private_count'];

	echo json_encode($d, JSON_UNESCAPED_UNICODE);
}
