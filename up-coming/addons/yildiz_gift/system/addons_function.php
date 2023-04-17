<?php 
/*===============================================*
 |                                               |
 |   Development      :  [AMEER_PS]              |
 |                                               |
 |   addon name       :  [LEVEL_SYSTEM]          |
 |                                               |
 |   Version          :  [1.0]                   |
 |                                               |
 |   Codychat version :  [CODYCHAT 3.5]          |
 |                                               |
 *===============================================*/
function listGift(){
	global $mysqli, $data, $lang;
	$list = '';
	$get_data = $mysqli->query("SELECT * FROM boom_gift WHERE id > 0 LIMIT 500");
	if($get_data->num_rows > 0){
		while($gift = $get_data->fetch_assoc()){
			$list .= ps_Template('element/list_gift', $gift);
	}
	}
return $list;
}
function systemPostgift($room, $content, $custom = array()){
	global $mysqli, $data;
	$def = array(
		'type'=> 'gift_log',
		'color'=> 'chat_system_gift',
		'rank'=> 99,
	);
	$post = array_merge($def, $custom);
	$mysqli->query("INSERT INTO `boom_chat` (post_date, user_id, post_message, post_roomid, type, log_rank, tcolor) VALUES ('" . time() . "', '{$data['system_id']}', '$content', '$room', '{$post['type']}', '{$post['rank']}', '{$post['color']}')");
	chatAction($room);
	return true;
}
function getGift($id){
	global $mysqli;
	$gift = array();
	$get_gift = $mysqli->query("SELECT * FROM boom_gift WHERE id = '$id'");
	if($get_gift->num_rows > 0){
		$gift = $get_gift->fetch_assoc();
	} else {
		$gift = 2;
	}
	return $gift;
}
function ps_Template($getpage, $boom = '') {
	global $data, $mysqli;
    $page = BOOM_PATH . '/addons/yildiz_gift/system/' . $getpage . '.php';
    $structure = '';
    ob_start();
    require($page);
    $structure = ob_get_contents();
    ob_end_clean();
    return $structure;
}


function showGift(){
global $mysqli;
$select_gift = '';
$get_gift = $mysqli->query("SELECT * FROM boom_gift ORDER BY id DESC LIMIT 30");
if($get_gift->num_rows >= 0){
while($find_gift = $get_gift->fetch_assoc()){
$select_gift .= ps_Template('element/select_gift', $find_gift);
}
}
return $select_gift;
}


?>