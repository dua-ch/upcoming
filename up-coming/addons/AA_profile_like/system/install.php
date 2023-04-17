<?php
if (!defined('BOOM')){
  die();
}

$ad = array(
	'name' => 'AA_profile_like',
	'access' => 0,
);
$mysqli->query("ALTER TABLE `boom_users` ADD user_like int(11) NOT NULL DEFAULT '0'");
$mysqli->query("CREATE TABLE `profile_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL DEFAULT 0,
  `uid` int(11) NOT NULL DEFAULT 0,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
?>