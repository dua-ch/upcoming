<?php
require('config_session.php');

if(isset($_POST['update_status'])){
	$status = escape($_POST['update_status']);
	if(!validStatus($status)){
		$status = 1;
	}
	$mysqli->query("UPDATE boom_users SET user_status = '$status' WHERE user_id = '{$data['user_id']}'");
	echo boomCode(1, array('text'=> statusTitle($status), 'icon'=> newStatusIcon($status)));
	die();
}
if(isset($_POST['edit_username'], $_POST['new_name'])){
	$new_name = escape($_POST['new_name']);
	if(!canName()){
		die();
	}
	if(!boomAllow(89)){
		if(!checkUserLimits('my_name')){
			echo 4;
			die();
		}
	}
	if($new_name == $data['user_name']){
		echo 1;
		die();
	}
	if(!validName($new_name)){
		echo 2;
		die();
	}
	if(!boomSame($new_name, $data['user_name'])){
		if(!boomUsername($new_name)){
			echo 3;
			die();
		}
	}
	$mysqli->query("UPDATE boom_users SET user_name = '$new_name' WHERE user_id = '{$data['user_id']}'");
	recordLimits($data, 'my_name');
	boomConsole('change_name', array('custom'=>$data['user_name']));
	echo 1;
	die();
}
if(isset($_POST['save_color'], $_POST['save_bold'], $_POST['save_font'])){
	$c = escape($_POST['save_color']);
	$b = escape($_POST['save_bold']);
	$f = escape($_POST['save_font']);
	if(!validTextColor($c)){
		echo 0;
		die();
	}
	if(!validTextWeight($b)){
		echo 0;
		die();
	}
	if(!validTextFont($f)){
		echo 0;
		die();
	}
	$mysqli->query("UPDATE boom_users SET bccolor = '$c', bcbold = '$b', bcfont = '$f' WHERE user_id = '{$data['user_id']}'");
	echo 1;
	die();
}
if(isset($_POST['save_mood'])){
	$mood = escape($_POST['save_mood']);
	if(!canMood()){
		echo 0;
		die();
	}
	if(isBadText($mood)){
		echo 2;
		die();
	}
	if(isTooLong($mood, 40)){
		echo 0;
		die();
	}
	if($mood == $data['user_mood']){
		echo getMood($data);
		die();
	}
	$mysqli->query("UPDATE boom_users SET user_mood = '$mood' WHERE user_id = '{$data['user_id']}'");
	$u = userDetails($data['user_id']);
	echo getMood($u);
	die();
	
}	
if(isset($_POST['save_info'], $_POST['age'], $_POST['gender'])){
	$age = escape($_POST['age']);
	$gender = escape($_POST['gender']);
	if(!validGender($gender)  || !validAge($age)) {
		echo boomCode(0);
		die();
	}
	$data['user_sex'] = $gender;
	if(defaultAvatar($data['user_tumb'])){
		$avatar = myAvatar(resetAvatar($data));
	}
	else {
		$avatar = myAvatar($data['user_tumb']);
	}
	$mysqli->query("UPDATE boom_users SET user_age = '$age', user_sex = '$gender' WHERE user_id = '{$data['user_id']}'");
	echo boomCode(1, array('av'=> $avatar));
	die();
}
if(isset($_POST['save_about'], $_POST['about'])){
	$about = clearBreak($_POST['about']);
	$about = escape($about);
	if(isTooLong($about, 900)) {
		echo 0;
		die();
	}
	if(isBadText($about)){
		echo 2;
		die();
	}
	$mysqli->query("UPDATE boom_users SET user_about = '$about' WHERE user_id = '{$data['user_id']}'");
	echo 1;
	die();
}
if(isset($_POST['my_username_color'], $_POST['my_username_font'])){
	$color = escape($_POST['my_username_color']);
	$font = escape($_POST['my_username_font']);
	if(!validNameColor($color)){
		echo 0;
		die();
	}
	if(!validNameFont($font)){
		echo 0;
		die();
	}
	$mysqli->query("UPDATE boom_users SET user_color = '$color', user_font = '$font' WHERE user_id = '{$data['user_id']}'");
	echo 1;
	die();
}
if(isset($_POST['set_private_mode'])){
	$pmode = escape($_POST['set_private_mode']);
	if(isGuest($data)){
		if($pmode != 0 && $pmode != 1){
			echo 0;
			die();
		}
	}
	if($pmode == 0 || $pmode == 1 || $pmode == 2 || $pmode == 3){
		$mysqli->query("UPDATE boom_users SET user_private = '$pmode' WHERE user_id = '{$data['user_id']}'");
		echo 1;
		die();
	}
	else {
		echo 0;
		die();
	}
}

if(isset($_POST['change_sound'])){
	$sound = escape($_POST['change_sound']);
	$mysqli->query("UPDATE boom_users SET user_sound = '$sound' WHERE user_id = '{$data['user_id']}'");
	echo boomCode(1, array('data'=> $sound));
	die();
}

if (isset($_POST['send_points'], $_POST['target'])) {
    $points = escape($_POST['send_points']);
    $target = escape($_POST['target']);
	$percentage = 50;
    $user = userDetails($target);
	$cons_points = ($percentage / 100) * $points;
	$totalpoints = $cons_points + $points;
    if (!boomAllow(10)) {
        die();
    }
    if ($data['user_points'] == 0) {
        echo 2;
        die();
    }
    if ($data['user_points'] < $totalpoints && !boomAllow(100)) {
        echo 2;
        die();
    }
    if ($points < 1) {
        echo 2;
        die();
    }
    if (!ctype_digit($points)) {
        echo 2;
        die();
    }
	$mysqli->query("UPDATE boom_users SET user_points = user_points + $points WHERE user_id = '$target'");
	if(!boomAllow(100)){
		$mysqli->query("UPDATE boom_users SET user_points = user_points - $totalpoints WHERE user_id = '{$data['user_id']}'");
		$msg = str_replace(array('@hunter@', '@target@', '@points@'), array($data['user_name'], $user['user_name'], $points), 
		'[ <b style="color:blue;">@hunter@</b> ] أرسل (<b style="color:red;">@points@</b>) نقطة إلى [ <b style="color:red;">@target@</b> ]');
		systemPostChat($data['user_roomid'], $msg);
	}
    boomNotify('points_sent', array('hunter' => $data['user_id'], 'target' => $user['user_id'], 'custom' => $points));
    boomNotify('points_recipt', array('hunter' => $data['system_id'], 'target' => $data['user_id'], 'custom' => $points, 'custom2' => $user['user_name']));
	echo 1;
	die();
}
?>