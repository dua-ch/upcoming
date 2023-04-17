<?php
$load_addons = 'AA_gifts';
require_once('../../../system/config_addons.php');

// @ioncube.dk boomMerge("es5dwynamicasd354654321354", "dynamicdasedex5163546847") -> "es5dwynamicasd354654321354_dynamicdasedex5163546847" RANDOM
function exDynmSetNewSetting(){
    global $mysqli, $data, $cody;
    $rank = escape($_POST['set_addon_access']);
    $name1 = escape($_POST['set_gift_name1']);
    $coins1 = escape($_POST['set_gift_coins1']);
    $name2 = escape($_POST['set_gift_name2']);
    $coins2 = escape($_POST['set_gift_coins2']);
    $name3 = escape($_POST['set_gift_name3']);
    $coins3 = escape($_POST['set_gift_coins3']);
    $name4 = escape($_POST['set_gift_name4']);
    $coins4 = escape($_POST['set_gift_coins4']);
    $name5 = escape($_POST['set_gift_name5']);
    $coins5 = escape($_POST['set_gift_coins5']);
    $name6 = escape($_POST['set_gift_name6']);
    $coins6 = escape($_POST['set_gift_coins6']);
    $name7 = escape($_POST['set_gift_name7']);
    $coins7 = escape($_POST['set_gift_coins7']);
    $name8 = escape($_POST['set_gift_name8']);
    $coins8 = escape($_POST['set_gift_coins8']);
    $name9 = escape($_POST['set_gift_name9']);
    $coins9 = escape($_POST['set_gift_coins9']);
    $name10 = escape($_POST['set_gift_name10']);
    $coins10 = escape($_POST['set_gift_coins10']);
    $name11 = escape($_POST['set_gift_name11']);
    $coins11 = escape($_POST['set_gift_coins11']);
    $name12 = escape($_POST['set_gift_name12']);
    $coins12 = escape($_POST['set_gift_coins12']);
    if(!boomAllow(100)){
        die();
    }
    
	$mysqli->query("UPDATE boom_addons SET addons_access = '$rank' WHERE addons = 'AA_gifts'");
	$mysqli->query("UPDATE boom_gifts SET gift_name = '$name1', gift_coins = '$coins1' WHERE gift_id = '1'");
	$mysqli->query("UPDATE boom_gifts SET gift_name = '$name2', gift_coins = '$coins2' WHERE gift_id = '2'");
	$mysqli->query("UPDATE boom_gifts SET gift_name = '$name3', gift_coins = '$coins3' WHERE gift_id = '3'");
	$mysqli->query("UPDATE boom_gifts SET gift_name = '$name4', gift_coins = '$coins4' WHERE gift_id = '4'");
	$mysqli->query("UPDATE boom_gifts SET gift_name = '$name5', gift_coins = '$coins5' WHERE gift_id = '5'");
	$mysqli->query("UPDATE boom_gifts SET gift_name = '$name6', gift_coins = '$coins6' WHERE gift_id = '6'");
	$mysqli->query("UPDATE boom_gifts SET gift_name = '$name7', gift_coins = '$coins7' WHERE gift_id = '7'");
	$mysqli->query("UPDATE boom_gifts SET gift_name = '$name8', gift_coins = '$coins8' WHERE gift_id = '8'");
	$mysqli->query("UPDATE boom_gifts SET gift_name = '$name9', gift_coins = '$coins9' WHERE gift_id = '9'");
	$mysqli->query("UPDATE boom_gifts SET gift_name = '$name10', gift_coins = '$coins10' WHERE gift_id = '10'");
	$mysqli->query("UPDATE boom_gifts SET gift_name = '$name11', gift_coins = '$coins11' WHERE gift_id = '11'");
	$mysqli->query("UPDATE boom_gifts SET gift_name = '$name12', gift_coins = '$coins12' WHERE gift_id = '12'");
	return 1;
}

if(isset($_POST['set_addon_access'], $_POST['set_gift_name1'], $_POST['set_gift_coins1'], $_POST['set_gift_name2'], $_POST['set_gift_coins2'], $_POST['set_gift_name3'], $_POST['set_gift_coins3']
, $_POST['set_gift_name4'], $_POST['set_gift_coins4'], $_POST['set_gift_name5'], $_POST['set_gift_coins5'], $_POST['set_gift_name6'], $_POST['set_gift_coins6'], $_POST['set_gift_name7'], $_POST['set_gift_coins7']
, $_POST['set_gift_name8'], $_POST['set_gift_coins8'], $_POST['set_gift_name9'], $_POST['set_gift_coins9'], $_POST['set_gift_name10'], $_POST['set_gift_coins10'], $_POST['set_gift_name11'], $_POST['set_gift_coins11']
, $_POST['set_gift_name12'], $_POST['set_gift_coins12'])){
    echo exDynmSetNewSetting();
    die();
}
?>