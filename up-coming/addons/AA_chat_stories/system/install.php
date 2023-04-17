<?php
if (!defined('BOOM')) {
	die();
}
$mysqli->query("CREATE TABLE `stories` (
	`story_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`story_source` varchar(500) NOT NULL,
	`story_description` varchar(1000) NOT NULL,
	`story_type` varchar(500) NOT NULL,
	`story_time` int(11) NOT NULL,
	`story_seen` varchar(100) NOT NULL,
	`user_id` int(11) NOT NULL,
	`expire_story` int(11) NOT NULL
  )");
$mysqli->query("CREATE TABLE `story_seen` (
	`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`uid` int(11) NOT NULL,
	`sid` int(11) NOT NULL,
	`time` int(11) NOT NULL
  )");
$mysqli->query("ALTER TABLE boom_users ADD user_story int(11) NOT NULL DEFAULT '0'");
$ad = array(
	'name' => 'AA_chat_stories',
	'bot_name' => 'Story System',
	'access' => 11,
	'bot_type' => 2,
);
