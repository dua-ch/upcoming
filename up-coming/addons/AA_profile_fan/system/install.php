<?php
if(!defined('BOOM')){
	die();
}
if(boomAllow(10)){
	$ad = array(
	'name' => 'AA_profile_fan',
	'access'=> 11,
	);
}
$mysqli->query("CREATE TABLE IF NOT EXISTS `profile_fan` (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`hunter` int(11) NOT NULL,
	`target` int(11) NOT NULL,
	`msg` varchar(500) NOT NULL,
	`time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)");
?>