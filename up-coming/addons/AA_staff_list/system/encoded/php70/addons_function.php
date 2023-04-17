<?php
require_once('../../../system/config_addons.php');
function createUserlists($list, $type = 1){
	global $data, $lang;
	$icon = '';
	$muted = '';
	$mob = '';
	$status = '';
	$mood = '';
	$offline = 'offline';
	$rank_icon = getRankIcon($list, 'list_rank');
	$mute_icon = getMutedIcon($list, 'list_mute');
	$mob_icon = getMobileIcon($list, 'list_mob');
	if($rank_icon != ''){
		$icon = '<div class="user_item_icon icrank">' . $rank_icon . '</div>';
	}
	if($mute_icon != ''){
		$muted = '<div class="user_item_icon icmute">' . $mute_icon . '</div>';
	}
	if($mob_icon != ''){
		$mob = '<div class="user_item_icon icmob">' . $mob_icon . '</div>';
	}
	if($list['last_action'] > getDelay() || isBot($list)){
		$offline = '';
		$status = getStatus($list['user_status'], 'list_status');
	}
	if(!empty($list['user_mood'])){
		$mood = '<p class="text_xsmall bustate bellips">' . $list['user_mood'] . '</p>';
	}
	return '<div  class="avtrig user_item ' . $offline . '">
				<div class="user_item_avatar"><img data="'. $list['user_id'] .'" class="get_info avav acav ' . avGender($list['user_sex']) . ' ' . ownAvatar($list['user_id']) . '" src="' . myAvatar($list['user_tumb']) . '"/> ' . $status . '</div>
				<div class="user_item_data"><p class="username ' . myColorFont($list) . '">' . $list["user_name"] . '</p>' . $mood . '</div>
				' . $muted . $mob . $icon . '
			</div>';
}

function createUserslists($list, $type = 1){
	global $data, $lang;
	$icon = '';
	$muted = '';
	$mob = '';
	$status = '';
	$mood = '';
	$offline = 'offline';
	$rank_icon = getRankIcon($list, 'list_rank');
	$mute_icon = getMutedIcon($list, 'list_mute');
	$mob_icon = getMobileIcon($list, 'list_mob');
	if($rank_icon != ''){
		$icon = '<div class="user_item_icon icrank">' . $rank_icon . '</div>';
	}
	if($mute_icon != ''){
		$muted = '<div class="user_item_icon icmute">' . $mute_icon . '</div>';
	}
	if($mob_icon != ''){
		$mob = '<div class="user_item_icon icmob">' . $mob_icon . '</div>';
	}
	if($list['last_action'] > getDelay() || isBot($list)){
		$offline = '';
		$status = getStatus($list['user_status'], 'list_status');
	}
	if(!empty($list['user_mood'])){
		$mood = '<p class="text_xsmall bustate bellips">' . $list['user_mood'] . '</p>';
	}
	return '<div class="avtrig user_item ' . $offline . '">
				<div class="user_item_avatar"><img data="'. $list['user_id'] .'" class="get_info avav acav ' . avGender($list['user_sex']) . ' ' . ownAvatar($list['user_id']) . '" src="' . myAvatar($list['user_tumb']) . '"/> ' . $status . '</div>
				<div class="user_item_data"><p class="username ' . myColorFont($list) . '">' . $list["user_name"] . '</p>' . $mood . '</div>
				' . $muted . $mob . $icon . '
			</div>';
}

function loadStaffList($rank){
	global $mysqli, $data, $lang;
	$loadd = '';
	$get_paneladd = $mysqli->query("SELECT * FROM boom_users WHERE user_rank = '$rank' AND user_bot = 0");
	if($get_paneladd->num_rows > 0){
		while($add = $get_paneladd->fetch_assoc()){
			$loadd .= createUserLists($add);
		}
	}
	else {
		$loadd .= emptyZone($lang['no_data']);
	}
	return $loadd;
}

function loadPrimList(){
	global $mysqli, $data, $lang;
	$loadd = '';
	$get_paneladd = $mysqli->query("SELECT * FROM boom_users WHERE user_prim > '0' AND user_bot = 0");
	if($get_paneladd->num_rows > 0){
		while($add = $get_paneladd->fetch_assoc()){
			$loadd .= createUsersLists($add);
		}
	}
	else {
		$loadd .= emptyZone($lang['no_data']);
	}
	return $loadd;
}
?>