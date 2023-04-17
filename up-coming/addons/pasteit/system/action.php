<?php
$load_addons = 'pasteit';
require('../../../system/config_addons.php');

if(isset($_POST['set_pasteit_access']) && boomAllow($cody['can_manage_addons'])){
	$pasteit_access = escape($_POST['set_pasteit_access']);
	$mysqli->query("UPDATE boom_addons SET addons_access = '$pasteit_access' WHERE addons = 'pasteit'");
	echo 5;
	die();
}
else {
	die();
}
?>