<?php
if(boomAllow(10)){
	$mysqli->query("ALTER TABLE `boom_users` DROP show_cast");
	$mysqli->query("ALTER TABLE `boom_users` DROP caster");
}
?>