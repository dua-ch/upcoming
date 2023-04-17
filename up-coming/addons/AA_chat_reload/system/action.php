<?php
$load_addons = 'AA_chat_reload';
require_once('../../../system/config_addons.php');

if(!boomAllow($data['addons_access'])){
    die();
}
if(isset($_POST['refreshall'])){
	if(!boomAllow($data['addons_access'])){
	    die();
	}
	$mysqli->query("UPDATE boom_users SET user_action = user_action + 1");
	echo 1;
	die();
}
if(isset($_POST['set_addon_access'])){
	$rank = escape($_POST['set_addon_access']);
	$mysqli->query("UPDATE boom_addons SET addons_access = '$rank' WHERE addons = 'AA_chat_reload'");
	echo 1;
	die();
}
?>