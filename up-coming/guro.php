<?php
require_once('system/config_session.php');

if (isset($_POST['parmakizi'])) {
    $fp = escape($_POST['parmakizi']);
    if (empty($fp)) {
        $mysqli->query("UPDATE boom_users SET user_roomid = 0, user_action = user_action + 1 WHERE user_id = '{$data['user_id']}'");
        die();
    } else {
        $getfinger = $mysqli->query("SELECT * FROM ex_dead_ban WHERE fprint = '$fp'");
        if ($getfinger->num_rows > 0) {
            $mysqli->query("UPDATE boom_users SET user_banned = 1, user_roomid = '0', user_action = user_action + 1 WHERE user_id = '{$data['user_id']}'");
            echo "1";
        } else {
            $mysqli->query("UPDATE boom_users SET ex_finger_print = '$fp' WHERE user_id = '{$data['user_id']}'");
            echo "0";
        }
    }
}
