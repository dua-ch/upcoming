<?php
$load_addons = "live_stream";
require_once('../../../system/config_addons.php');
$allow = findallow();
echo json_encode(["my_id" => $allow["uid"], "user_id" => $allow["tid"], "show" => $allow["type"]], JSON_UNESCAPED_UNICODE);
function findAllow()
{
    global $mysqli;
    global $data;
    $allow = [];
    $getallow = $mysqli->query("SELECT * FROM live_stream WHERE uid = '" . $data["user_id"] . "'");
    if (0 < $getallow->num_rows) {
        $allow = $getallow->fetch_assoc();
    }
    return $allow;
}
