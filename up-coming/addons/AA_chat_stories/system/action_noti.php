<?php
$load_addons = 'AA_chat_stories';
require_once('../../../system/config_addons.php');

$counter = 0;
$my_time = escape($data['user_story']);
$get_bois = $mysqli->query("SELECT * FROM stories WHERE story_time > '$my_time'");
if($get_bois->num_rows > 0){
    while($get = $get_bois->fetch_assoc()){
        $counter++;
    }
}

$datastory = escape($data['user_story']);
echo json_encode(array(
	"count" => $counter
), JSON_UNESCAPED_UNICODE);