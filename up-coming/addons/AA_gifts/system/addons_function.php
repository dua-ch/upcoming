<?php
function giftContent($gift, $from, $to) {
    global $data;
	$content = '<span class="'. $data['bccolor'] .'"><b class="error">[ ' . $from . ' ]</b> Has send <b class="warn">[ ' . $gift . ' ]</b> to user <b class="theme_color">[ ' . $to . ' ]</b></span>';
	$content = textFilter($content);
	return $content;
}
function chooseGiftName($id){
	global $mysqli, $data, $lang;
	$loadd = '';
	$get_gift = $mysqli->query("SELECT * FROM boom_gifts WHERE gift_id = '$id'");
	if($get_gift->num_rows > 0){
		while($gift = $get_gift->fetch_assoc()){
			$loadd .= $gift['gift_name'];
		}
	}
	else {
    	return false;
	}
	return $loadd;
}
function chooseGiftCoins($id){
	global $mysqli, $data, $lang;
	$loadd = '';
	$get_gift = $mysqli->query("SELECT * FROM boom_gifts WHERE gift_id = '$id'");
	if($get_gift->num_rows > 0){
		while($gift = $get_gift->fetch_assoc()){
			$loadd .= $gift['gift_coins'];
		}
	}
	else {
    	return false;
	}
	return $loadd;
}
function chooseGiftPhoto($id){
	global $mysqli, $data, $lang;
	$loadd = '';
	$get_gift = $mysqli->query("SELECT * FROM boom_gifts WHERE gift_id = '$id'");
	if($get_gift->num_rows > 0){
		while($gift = $get_gift->fetch_assoc()){
			$loadd .= $gift['gift_photo'];
		}
	}
	else {
    	return false;
	}
	return $loadd;
}
?>