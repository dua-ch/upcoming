<?php
if(!defined('BOOM')){
	die();
}
$mysqli->query("DELETE FROM boom_mail WHERE mail_type = 'contact'");
?>