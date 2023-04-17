<?php
/*===============================================*
 |                                               |
 |   Development      :  [AMEER_PS]              |
 |                                               |
 |   addon name       :  [YILDIZ_GIFT]           |
 |                                               |
 |   Version          :  [1.0]                   |
 |                                               |
 |   Codychat version :  [CODYCHAT 3.6]          |
 |                                               |
 *===============================================*/
$load_addons = 'yildiz_gift';
require_once('../../../system/config_addons.php');
if(isset($_POST['mnewuser'])){
	$mysqli->query("UPDATE boom_users SET gifts = 0 WHERE user_id = {$data['user_id']}");
	$mysqli->query("UPDATE boom_users SET gift_id = '' WHERE user_id = {$data['user_id']}");
	echo 1;
	die();
}
function exGiftTemplate($getpage, $boom = '')
{
	global $data, $lang, $mysqli, $cody;
	$page = BOOM_PATH . '/addons/yildiz_gift/' . $getpage . '.php';
	$structure = '';
	ob_start();
	require($page);
	$structure = ob_get_contents();
	ob_end_clean();
	return $structure;
}
$Gifs = $data['gifts'];
if($Gifs == 1){
$rand = rand(1,99);
$PGift = exGiftTemplate('system/box/show_cast');
$class_rand = '.giftsrand'.$rand.'';
}
	echo json_encode( array(
	"gifts"=> $Gifs,
	"PGift"=> $PGift,
	"class"=> $class_rand,
	), JSON_UNESCAPED_UNICODE);
?>
