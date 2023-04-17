<?php
require __DIR__ . "/../../config_session.php";
session_write_close();
if (!isset($_POST["page"])) {
    exit;
}
$page = escape($_POST["page"]);
boomgeo();
updateuseraccount();
function boomGeo()
{
    global $mysqli;
    global $data;
    if (checkGeo()) {
        require BOOM_PATH . "/system/location/country_list.php";
        require BOOM_PATH . "/system/element/timezone.php";
        $ip = getIp();
        $country = "ZZ";
        $tzone = $data["user_timezone"];
        $loc = doCurl("http://www.geoplugin.net/php.gp?ip=" . $ip);
        $res = unserialize($loc);
        if (isset($res["geoplugin_countryCode"]) && array_key_exists($res["geoplugin_countryCode"], $country_list)) {
            $country = escape($res["geoplugin_countryCode"]);
        }
        if (isset($res["geoplugin_timezone"]) && in_array($res["geoplugin_timezone"], $timezone)) {
            $tzone = escape($res["geoplugin_timezone"]);
        }
        $mysqli->query("UPDATE boom_users SET user_ip = '" . $ip . "', country = '" . $country . "', user_timezone = '" . $tzone . "' WHERE user_id = '" . $data["user_id"] . "'");
        return 1;
    }
    return 0;
}

function checkRegMute()
{
    global $data;
    global $page;
    $result = "";
    if (insideChat($page)) {
        if (guestMuted()) {
            $result = modalPending(boomTemplate("element/guest_talk"), "empty", 400);
        } else {
            if (isRegMute($data)) {
                $result = modalPending(boomTemplate("element/regmute"), "empty", 400);
            } else {
                $result = "";
            }
        }
    }
    return $result;
}

function updateUserAccount()
{
    global $mysqli;
    global $data;
    global $cody;
    $mob = getMobile();
    $mysqli->query("UPDATE boom_users SET user_mobile = " . $mob . " WHERE user_id = '" . $data["user_id"] . "'");
}

?>