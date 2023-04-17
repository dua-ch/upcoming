<?php
$load_addons = 'AA_chat_cast';
require_once('../../../system/config_addons.php');
$caster = $data['caster'];
$caster_rank = $data['caster_rank'];

if ($caster == 1 && boomAllow($caster_rank) || $caster == 1 && $data['user_role'] >= 4) {
    $cast_box = $data['show_cast'];
}

if (isset($_POST['end_cast'])) {
    $mysqli->query("UPDATE boom_users SET caster = 0, show_cast = '' WHERE user_id = {$data['user_id']}");
    echo 1;
    die();
}

echo json_encode(array(
    "caster" => $caster,
    "rankcaster" => $caster_rank,
    "sCast" => $cast_box,
), JSON_UNESCAPED_UNICODE);
