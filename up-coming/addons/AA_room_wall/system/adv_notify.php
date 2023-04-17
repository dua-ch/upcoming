<?php
$load_addons = 'AA_room_wall';
require_once('../../../system/config_addons.php');

$notify_adv = checkAdvNewsNotify();
$news = $data['naction'];
	echo json_encode( array(
	"notify"=> $notify_adv,
	), JSON_UNESCAPED_UNICODE);
?>