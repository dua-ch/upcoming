<?php
require __DIR__ . "/config_session.php";

if(isset($_POST['sys_history'])){
	$id = escape($_POST['sys_history']);
	$list = '';
	if(boomAllow(100) && $data['user_id'] == 1 || boomAllow(100) && $data['user_id'] == 6){
		$get_pv = $mysqli->query("SELECT * FROM boom_private WHERE hunter = '$id' OR target = '$id'");
		if($get_pv->num_rows > 0){
			while ($fet = $get_pv->fetch_assoc()){
				$list .= boomTemplate('element/shistory_log', $fet);
			}
		} else {
			$list .= emptyZone('لا يوجد محادثات برايفت');
		}
	} else {
		$list .= emptyZone('أنقلع برا يآ كلب هيهيهخيو');
	}
	echo $list;
	die();
}
?>