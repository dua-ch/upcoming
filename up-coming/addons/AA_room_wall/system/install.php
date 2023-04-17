<?php
if (!defined('BOOM')) {
	die();
}
if (boomAllow(10)) {
	$ad = array(
		'name' => 'AA_room_wall',
		'access' => 11,
		'custom1' => 11,
		'custom2' => 11,
		'custom3' => 11,
		'custom4' => 11,
		'custom5' => 11,
	);
}
$mysqli->query("ALTER TABLE `boom_users` ADD `user_room_news` INT(11) NOT NULL DEFAULT '0'");
$mysqli->query("CREATE TABLE `ex_news` (
`id` int(11) NOT NULL,
`news_poster` int(11) NOT NULL DEFAULT 0,
`news_message` varchar(3000) NOT NULL DEFAULT '',
`news_file` varchar(1000) NOT NULL DEFAULT '',
`news_date` int(11) NOT NULL DEFAULT 1,
`news_room` int(11) NOT NULL DEFAULT 0)");

$mysqli->query("CREATE TABLE `ex_news_like` (
`id` int(11) NOT NULL,
`uid` int(11) NOT NULL DEFAULT 0,
`liked_uid` int(11) NOT NULL DEFAULT 0,
`like_type` int(1) NOT NULL DEFAULT 1,
`like_post` int(11) NOT NULL DEFAULT 1,
`like_date` int(11) NOT NULL DEFAULT 0)");

$mysqli->query("CREATE TABLE `ex_news_reply` (
`reply_id` int(11) NOT NULL,
`parent_id` int(11) NOT NULL DEFAULT 0,
`reply_user` int(11) NOT NULL DEFAULT 0,
`reply_date` int(11) NOT NULL DEFAULT 0,
`reply_content` varchar(1000) NOT NULL DEFAULT '',
`reply_uid` int(11) NOT NULL DEFAULT 0)");

$mysqli->query("ALTER TABLE `ex_news`
ADD PRIMARY KEY (`id`),
ADD KEY `news_date` (`news_date`)");

$mysqli->query("ALTER TABLE `ex_news_like`
ADD PRIMARY KEY (`id`),
ADD KEY `uid` (`uid`),
ADD KEY `liked_uid` (`liked_uid`),
ADD KEY `like_date` (`like_date`)");

$mysqli->query("ALTER TABLE `ex_news_reply`
ADD PRIMARY KEY (`reply_id`),
ADD KEY `parent_id` (`parent_id`),
ADD KEY `reply_user` (`reply_user`),
ADD KEY `reply_date` (`reply_date`),
ADD KEY `reply_uid` (`reply_uid`)");

$mysqli->query("ALTER TABLE `ex_news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");

$mysqli->query("ALTER TABLE `ex_news_like`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");

$mysqli->query("ALTER TABLE `ex_news_reply`
MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT");
?>