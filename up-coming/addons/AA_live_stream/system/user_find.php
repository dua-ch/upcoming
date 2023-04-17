<?php
/*===============================================*
 |                                               |
 |   Development      :  [AMEER_PS]              |
 |                                               |
 |   addon name       :  [STORE_CHAT]            |
 |                                               |
 |   Version          :  [1.0]                   |
 |                                               |
 |   Codychat version :  [CODYCHAT 3.6]          |
 |                                               |
 *===============================================*/
$load_addons = "AA_live_stream";
require_once "../../../system/config_addons.php";
function findAllow(){
 global $mysqli,$data;
 $allow = array();
 $getallow = $mysqli->query("SELECT * FROM live_stream WHERE uid = '{$data['user_id']}'");
 if($getallow->num_rows > 0){
  $allow = $getallow->fetch_assoc();
 }
 return $allow;
}
$allow = findAllow();

	echo json_encode( array(
	"find_user"=> $allow['uid'],
	"user_id"=> $allow['tid'],
	"show"=> $allow['type'],
	), JSON_UNESCAPED_UNICODE);
?>
