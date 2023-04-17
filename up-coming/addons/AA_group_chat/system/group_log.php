<?php
$load_addons = 'AA_group_chat';
require_once('../../../system/config_addons.php');

$chat_history = 20;
$chat_substory = 20;

if (isset($_POST['last'], $_POST['snum'], $_POST['caction'], $_POST['fload'])) {

    // clearing post data 
    $last = escape($_POST['last']);
    $fload = escape($_POST['fload']);
    $snum = escape($_POST['snum']);
    $caction = escape($_POST['caction']);

    // main chat part
    $d['mlogs'] = '';
    $d['mlast'] = $last;
    $main = 1;
    $ssnum = 0;

    $d['getChat'] = 0;
    if ($data['user_group'] != '') {
        $d['getChat'] = 1;
    }
    $uid = escape($data['user_id']);
    $d['askers'] = 0;
    $sql = $mysqli->query("SELECT COUNT(target) as MaxView FROM group_chat_ask WHERE target = '$uid' AND viewed = '0'");
    if ($sql->num_rows > 0) {
        while ($fetch = $sql->fetch_assoc()) {
            $d['askers'] = $fetch['MaxView'];
        }
    }

    // main chat logs part
    if ($fload == 0) {
        $log = $mysqli->query("
		SELECT log.*, 
		boom_users.user_name, boom_users.user_color, boom_users.user_font, boom_users.user_rank, boom_users.bccolor, boom_users.user_sex, boom_users.user_age, boom_users.user_tumb, boom_users.user_cover, boom_users.country, boom_users.user_bot
		FROM ( SELECT * FROM `group_chat` WHERE `group_id` = {$data['user_group']}  AND post_id > '$last' ORDER BY `post_id` DESC LIMIT $chat_history) AS log
		LEFT JOIN boom_users ON log.user_id = boom_users.user_id
		ORDER BY `post_id` ASC
		");
        $ssnum = 1;
    } else {
        if ($caction != $data['rcaction']) {
            $log = $mysqli->query("
				SELECT log.*,
				boom_users.user_name, boom_users.user_color, boom_users.user_font, boom_users.user_rank, boom_users.bccolor, boom_users.user_sex, boom_users.user_age, boom_users.user_tumb, boom_users.user_cover, boom_users.country, boom_users.user_bot
				FROM ( SELECT * FROM `group_chat` WHERE `group_id` = {$data['user_group']} AND post_id > '$last' ORDER BY `post_id` DESC LIMIT $chat_substory) AS log
				LEFT JOIN boom_users ON log.user_id = boom_users.user_id
				ORDER BY `post_id` ASC
				");
        } else {
            $main = 0;
        }
    }
    if ($main == 1) {
        if ($log->num_rows > 0) {
            while ($chat = $log->fetch_assoc()) {
                $d['mlast'] = $chat['post_id'];
                if ($chat['snum'] != $snum || $ssnum == 1) {
                    $d['mlogs'] .= createGchatLog($chat);
                }
            }
        }
    }

    mysqli_close($mysqli);

    // sending results
    $d['cact'] = $data['rcaction'];
    $d['ses'] = $data['session_id'];

    echo json_encode($d, JSON_UNESCAPED_UNICODE);
}
