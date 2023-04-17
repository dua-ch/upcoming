<?php
if(!defined('BOOM')){
	die();
}
if(boomAllow(10)){
	$ad = array(
	'name' => 'AA_chat_cast',
	'access'=> 11,
	);
}
$mysqli->query("ALTER TABLE `boom_users` ADD show_cast varchar(5000) NOT NULL DEFAULT ''");
$mysqli->query("ALTER TABLE `boom_users` ADD caster int(11) NOT NULL DEFAULT '0'");
$mysqli->query("ALTER TABLE `boom_users` ADD caster_rank int(11) NOT NULL DEFAULT '0'");
?>