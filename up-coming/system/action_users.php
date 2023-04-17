<?php
require_once('config_session.php');

if(isset($_POST['adj_pts_user'],$_POST['adj_new_rank'])){
    $target = escape($_POST['adj_pts_user']);
    $newRank = escape($_POST['adj_new_rank']);
    $user = userDetails($target);
    $uPoints = $user['user_points'];
    $uNeed = setUserExp($user) - $uPoints;
    $setNeed = $uNeed - $uPoints;
    if(!boomAllow(99) || !isGreater($user['user_rank'])){
        die();
    }
    if($uNeed < $uPoints && $newRank < $data['user_rank']){
        $mysqli->query("UPDATE boom_users SET user_points = 0 WHERE user_id = '$target'");
    } else {
        return false;
    }
}