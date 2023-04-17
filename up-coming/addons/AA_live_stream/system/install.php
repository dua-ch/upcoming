<?php
if (!defined('BOOM')){
  die();
}

$ad = array(
	'name' => 'AA_live_stream',
	'access' => 2,
	'custom1' => 'AmeerPs'.rand(0,400),
	'custom2' => 1,
	'custom3' => 8,
);
$mysqli->query("ALTER TABLE `boom_users`ADD `user_live` INT(11) NULL DEFAULT '0';");

$mysqli->query("CREATE TABLE `live_stream` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT 0,
  `tid` int(11) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL DEFAULT 0,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
?>