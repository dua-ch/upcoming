<?php
require __DIR__ . "/../../config_session.php";
if (isset($_POST["more_chat"])) {
    echo chatmorechat();
    exit;
}
if (isset($_POST["more_private"]) && isset($_POST["target"])) {
    echo privatemoreprivate();
    exit;
}

function chatMoreChat()
{
    global $mysqli;
    global $data;
    $last = escape($_POST["more_chat"]);
    $clogs = "";
    $count = 0;
    if (!canHistory()) {
        return boomCode(0, ["total" => 0, "clogs" => 0]);
    }
    $log = $mysqli->query("\r\n\tSELECT log.*,boom_users.*\r\n\tFROM ( SELECT * FROM `boom_chat` WHERE `post_roomid` = '" . $data["user_roomid"] . "' AND post_id < '" . $last . "' ORDER BY `post_id` DESC LIMIT 60) AS log\r\n\tLEFT JOIN boom_users ON log.user_id = boom_users.user_id\r\n\tORDER BY `post_id` ASC\r\n\t");
    if (0 < $log->num_rows) {
        for ($ignore = getIgnore(); $chat = $log->fetch_assoc(); $count++) {
            $clogs .= createLog($data, $chat, $ignore);
        }
    } else {
        $clogs = 0;
    }
    return boomCode(0, ["total" => $count, "clogs" => $clogs]);
}

function privateMorePrivate()
{
    global $mysqli;
    global $data;
    $last = escape($_POST["more_private"]);
    $priv = escape($_POST["target"]);
    $plogs = "";
    $count = 0;
    $privlog = $mysqli->query("SELECT log.*, boom_users.* \r\n\tFROM ( SELECT * FROM `boom_private` WHERE  `hunter` = '" . $data["user_id"] . "' AND `target` = '" . $priv . "' AND id < '" . $last . "' OR `hunter` = '" . $priv . "' AND `target` = '" . $data["user_id"] . "'  AND id < '" . $last . "' ORDER BY `id` DESC LIMIT 30) AS log \r\n\tLEFT JOIN boom_users\r\n\tON log.hunter = boom_users.user_id\r\n\tORDER BY `time` ASC");
    if (0 < $privlog->num_rows) {
        while ($private = $privlog->fetch_assoc()) {
            $plogs .= privateLog($private, $data["user_id"]);
            $count++;
        }
    } else {
        $plogs = 0;
    }
    return boomCode(0, ["total" => $count, "clogs" => $plogs]);
}

?>