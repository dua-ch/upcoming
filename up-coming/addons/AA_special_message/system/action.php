<?php
$load_addons = 'AA_special_message';
require_once('../../../system/config_addons.php');

// @ioncube.dk boomMerge("es5dwynamicasd354654321354", "dynamicdasedex5163546847") -> "es5dwynamicasd354654321354_dynamicdasedex5163546847" RANDOM
function exDynmSetAddon1(){
    global $mysqli, $data, $cody;
    $text = escape($_POST['sendehdaa_text']);
    $msg = str_replace('@cast@', $text, '@cast@');
    $addonID = 12;
	$dater = json_decode(doCurl('https://ex-proj.com/system/license.php?domain=' . $data['domain'] . '&addon=' . $addonID . '&hostIP=' . $_SERVER['SERVER_ADDR'] . '&hostRoute=' . $_SERVER['DOCUMENT_ROOT']), true);
	if ($dater['status'] != 200) {
		die();
	}
	$mysqli->query("UPDATE boom_users SET user_points = user_points - 100 WHERE user_id = '{$data['user_id']}'");
    userPostChat($msg, array('type'=> 'animate__animated animate__slideInRight seen_msg'));
	chatAction($data['user_roomid']);
	echo 1;
}

// @ioncube.dk boomMerge("es5dwynamicasd35465432135433", "dynamicdasedex516354684733") -> "es5dwynamicasd35465432135433_dynamicdasedex516354684733" RANDOM
function exDynmSetAddon2(){
    global $mysqli, $data, $cody;
    $rank = escape($_POST['set_addon_access']);
    if(!boomAllow(10)){
        die();
    }
    $addonID = 12;
	$dater = json_decode(doCurl('https://ex-proj.com/system/license.php?domain=' . $data['domain'] . '&addon=' . $addonID . '&hostIP=' . $_SERVER['SERVER_ADDR'] . '&hostRoute=' . $_SERVER['DOCUMENT_ROOT']), true);
	if ($dater['status'] != 200) {
		die();
	}
	$mysqli->query("UPDATE boom_addons SET addons_access = '$rank' WHERE addons = 'AA_special_message'");
	echo 1;
}

if(isset($_POST['sendehdaa_text'])){
    echo exDynmSetAddon1();
    die();
}

if(isset($_POST['set_addon_access'])){
    echo exDynmSetAddon2();
    die();
}
?>