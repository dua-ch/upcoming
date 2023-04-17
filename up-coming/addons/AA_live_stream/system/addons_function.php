<?php
function findAllowUser($id){
	global $data, $mysqli, $lang;
	$allow = array();
	$getallow = $mysqli->query("SELECT * FROM live_stream WHERE tid = '{$data['user_id']}' && uid = '$id'");
	if($getallow->num_rows > 0){
		$allow = $getallow->fetch_assoc();
	}
	return $allow;
}
?>