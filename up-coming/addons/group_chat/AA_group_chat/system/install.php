<?php
if(!defined('BOOM')){
	die();
}
if(boomAllow(10)){
	$ad = array(
	'name' => 'AA_group_chat',
	'access'=> 99,
	);
}
$mysqli->query("CREATE TABLE IF NOT EXISTS `group_chat` (
	`post_id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) NOT NULL DEFAULT 0,
	`post_date` int(11) NOT NULL DEFAULT 0,
	`post_message` varchar(2000) NOT NULL DEFAULT '',
	`group_id` varchar(100) NOT NULL DEFAULT '',
	`type` varchar(50) NOT NULL DEFAULT '',
	`log_rank` int(5) NOT NULL DEFAULT 99,
	`file` int(11) NOT NULL DEFAULT 0,
	`snum` varchar(20) NOT NULL DEFAULT '',
	`tcolor` varchar(50) NOT NULL DEFAULT '',
	PRIMARY KEY (`post_id`),
	KEY `post_roomid` (`group_id`),
	KEY `user_id` (`user_id`),
	KEY `post_date` (`post_date`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
  $mysqli->query("CREATE TABLE IF NOT EXISTS `group_chat_ask` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`uid` int(11) NOT NULL,
	`target` int(11) NOT NULL,
	`viewed` int(11) NOT NULL,
	`group_id` varchar(100) NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
  $mysqli->query("ALTER TABLE boom_users ADD user_group VARCHAR(500) NOT NULL DEFAULT ''");
  $mysqli->query("ALTER TABLE boom_users ADD group_owner INT(1) NOT NULL DEFAULT '0'");
  $mysqli->query("ALTER TABLE boom_users ADD action_group INT(1) NOT NULL DEFAULT '0'");
?>