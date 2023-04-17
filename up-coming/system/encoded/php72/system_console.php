<?php


require __DIR__ . "/../../config_session.php";
require BOOM_PATH . "/system/language/" . $data["user_language"] . "/console.php";
if (!boomAllow($cody["can_view_console"])) {
    echo 0;
    exit;
}
if (isset($_POST["reload_console"])) {
    $last = escape($_POST["reload_console"]);
    echo reloadsystemconsole($last);
    exit;
}
if (isset($_POST["more_console"])) {
    $last = escape($_POST["more_console"]);
    echo loadmoresystemconsole($last);
    exit;
}
if (isset($_POST["search_console"])) {
    $find = escape($_POST["search_console"]);
    if ($find == "") {
        echo reloadsystemconsole(0);
        exit;
    }
    $id = 0;
    $user = nameDetails($find);
    if (!empty($user)) {
        $id = $user["user_id"];
    }
    echo searchsystemconsole($id, $find);
    exit;
}
if (isset($_POST["clear_console"]) && boomAllow(11)) {
    echo clearsystemconsole();
    exit;
}
function consoleUser($console)
{
    return "<span onclick=\"getProfile(" . $console["hunter"] . ");\" class=\"bold console_user\">" . $console["chunter"] . "</span>";
}
function consoleTarget($console)
{
    return "<span onclick=\"getProfile(" . $console["target"] . ");\" class=\"bold console_user\">" . $console["ctarget"] . "</span>";
}
function consoleText($t)
{
    return "<span class=\"bold console_text\">" . $t . "</span>";
}

function renderConsoleText($console)
{
    global $data;
    global $clang;
    global $lang;
    $ctext = $clang[$console["ctype"]];
    $ctext = str_replace(["%hunter%", "%target%", "%oldname%", "%room%", "%data%", "%data2%", "%rank%", "%roomrank%", "%delay%"], [consoleuser($console), consoletarget($console), consoletext($console["custom"]), consoletext($console["croom"]), consoletext($console["custom"]), consoletext($console["custom2"]), consoletext(rankTitle($console["crank"])), consoletext(roomRankTitle($console["crank"])), consoletext(boomRenderMinutes($console["delay"]))], $ctext);
    return $ctext;
}

function reloadSystemConsole($id)
{
    global $mysqli;
    global $data;
    global $lang;
    global $clang;
    $get_console = $mysqli->query("\r\n\tSELECT *,\r\n\t(SELECT user_name FROM boom_users WHERE user_id = hunter) AS chunter,\r\n\t(SELECT user_name FROM boom_users WHERE user_id = target) AS ctarget,\r\n\t(SELECT room_name FROM boom_rooms WHERE room_id = room) AS croom\r\n\tFROM boom_console WHERE id > '" . $id . "' ORDER BY cdate DESC LIMIT 500\r\n\t");
    if (0 < $get_console->num_rows) {
        $list = "";
        while ($console = $get_console->fetch_assoc()) {
            $list .= boomTemplate("element/console_log", $console);
        }
        return $list;
    }
    return 0;
}

function loadMoreSystemConsole($id)
{
    global $mysqli;
    global $data;
    global $lang;
    global $clang;
    $get_console = $mysqli->query("SELECT *,\r\n\t(SELECT user_name FROM boom_users WHERE user_id = hunter) AS chunter,\r\n\t(SELECT user_name FROM boom_users WHERE user_id = target) AS ctarget,\r\n\t(SELECT room_name FROM boom_rooms WHERE room_id = room) AS croom\r\n\tFROM boom_console WHERE id < '" . $id . "' ORDER BY cdate DESC LIMIT 500");
    if (0 < $get_console->num_rows) {
        $list = "";
        while ($console = $get_console->fetch_assoc()) {
            $list .= boomTemplate("element/console_log", $console);
        }
        return $list;
    }
    return 0;
}

function searchSystemConsole($id, $find)
{
    global $mysqli;
    global $data;
    global $lang;
    global $clang;
    $find_list = [];
    foreach ($clang as $key => $value) {
        if (stripos($value, $find) !== false) {
            array_push($find_list, $key);
        }
    }
    $find_list = listWordArray($find_list);
    $get_console = $mysqli->query("SELECT *,\r\n\t(SELECT user_name FROM boom_users WHERE user_id = hunter) AS chunter,\r\n\t(SELECT user_name FROM boom_users WHERE user_id = target) AS ctarget,\r\n\t(SELECT room_name FROM boom_rooms WHERE room_id = room) AS croom\r\n\tFROM boom_console WHERE hunter = '" . $id . "' OR target = '" . $id . "' OR ctype IN (" . $find_list . ") ORDER BY cdate DESC LIMIT 500");
    if (0 < $get_console->num_rows) {
        $list = "";
        while ($console = $get_console->fetch_assoc()) {
            $list .= boomTemplate("element/console_log", $console);
        }
        return $list;
    }
    return emptyZone($lang["no_data"]);
}

function clearSystemConsole()
{
    global $mysqli;
    global $data;
    global $cody;
    if (!boomAllow($cody["can_clear_console"])) {
        return 0;
    }
    $mysqli->query("TRUNCATE TABLE boom_console");
    boomConsole("clear_console");
    return 1;
}

?>