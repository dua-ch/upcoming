<?php
require('config_session.php');

if (isset($_POST['take_action'], $_POST['target'])) {
	$action = escape($_POST['take_action']);
	$target = escape($_POST['target']);

	if ($action == 'unban') {
		echo unbanAccount($target);
		die();
	} else if ($action == 'unmute') {
		echo unmuteAccount($target);
		die();
	}
	if ($action == 'room_block') {
		echo blockRoom($target);
		die();
	} else if ($action == 'room_mute') {
		echo muteRoom($target); 
		die();
	} else if ($action == 'room_unmute') {
		echo unmuteRoom($target);
		die();
	} else if ($action == 'muted') {
		echo unmuteAccount($target);
		die();
	} else if ($action == 'banned') {
		echo unbanAccount($target);
		die();
	} else if ($action == 'room_unblock') {
		echo unblockRoom($target);
		die();
	} else if ($action == 'kicked') {
		echo unkickAccount($target);
		die();
	} else if ($action == 'unkick') {
		echo unkickAccount($target);
		die();
	} else if ($action == 'warn') {
		echo warnThisUser($target);
		die();
	} else if ($action == 'xban') {
		echo xbanAccount($target);
		die();
	} else if ($action == 'more_mute') {
		echo xbanAccount($target);
		die();
	} else if ($action == 'more_kick') {
		echo xbanAccount($target);
		die();
	} else if ($action == 'more_ban') {
		echo xbanAccount($target);
		die();
	} else if ($action == 'take_all_perm') {
		if(!boomAllow(100)){
			die();
		}
		echo $mysqli->query("UPDATE boom_users SET no_perm = 0 WHERE user_id = '$target'");
		die();
	} else if ($action == 'give_all_perm') {
		if(!boomAllow(100)){
			die();
		}
		echo $mysqli->query("UPDATE boom_users SET no_perm = 1 WHERE user_id = '$target'");
		die();
	} else {
		echo 0;
		die();
	}
}
if (isset($_POST['check_kick'])) {
	if ($data['user_kick'] == 0) {
		echo 1;
		die();
	}
}
if (isset($_POST['check_maintenance'])) {
	if ($data['maint_mode'] == 0) {
		echo 1;
		die();
	}
}
if (isset($_POST['kick'], $_POST['reason'], $_POST['delay'])) {
	$target = escape($_POST['kick']);
	$reason = escape($_POST['reason']);
	$delay = escape($_POST['delay']);
	echo kickAccount($target, $delay, $reason);
	die();
}
if (isset($_POST['mute'], $_POST['reason'], $_POST['delay'])) {
	$target = escape($_POST['mute']);
	$reason = escape($_POST['reason']);
	$delay = escape($_POST['delay']);
	echo muteAccount($target, $delay, $reason);
	die();
}
if (isset($_POST['ban'], $_POST['reason'])) {
	$target = escape($_POST['ban']);
	$reason = escape($_POST['reason']);
	echo banAccount($target, $reason);
	die();
}
if (isset($_POST['remove_room_staff'], $_POST['target'])) {
	$target = escape($_POST['target']);
	echo removeRoomStaff($target);
	die();
}
if (isset($_POST['user_msgs'], $_POST['type'])) {
	$target = escape($_POST['user_msgs']);
	$type = escape($_POST['type']);
	$sql = $mysqli->query("SELECT * FROM boom_chat WHERE user_id = '$target'");
	$myArray = array();
	if ($sql->num_rows > 0) {
		while ($rows = $sql->fetch_assoc()) {
			array_push($myArray, $rows['post_id']);
		}
	}
	$posts = listThisArray($myArray);
	if ($type == 1) {
		$mysqli->query("UPDATE boom_rooms SET rldelete = CONCAT(rldelete, ',$posts'), rltime = '" . time() . "' WHERE room_id = '{$data['user_roomid']}'");
	} else {
		$mysqli->query("UPDATE boom_rooms SET rldelete = '$posts', rltime = '" . time() . "' WHERE room_id = '{$data['user_roomid']}'");
	}
	$mysqli->query("DELETE FROM boom_chat WHERE user_id = '$target'");
	die();
}
