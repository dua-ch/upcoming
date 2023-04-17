<?php
require __DIR__ . "/../../config_session.php";
if (isset($_POST["set_user_theme"])) {
    echo setusertheme();
    exit;
}
if (isset($_POST["add_friend"])) {
    $id = escape($_POST["add_friend"]);
    echo addfriend($id);
    exit;
}
if (isset($_POST["accept_friend"])) {
    $id = escape($_POST["accept_friend"]);
    echo addfriend($id);
    exit;
}
if (isset($_POST["remove_friend"])) {
    $id = escape($_POST["remove_friend"]);
    echo boomRemoveFriend($id);
    exit;
}
if (isset($_POST["unfriend"])) {
    $id = escape($_POST["unfriend"]);
    echo boomRemoveFriend($id);
    exit;
}
if (isset($_POST["add_ignore"])) {
    $id = escape($_POST["add_ignore"]);
    echo ignore($id);
    exit;
}
if (isset($_POST["remove_ignore"])) {
    $id = escape($_POST["remove_ignore"]);
    echo removeIgnore($id);
    exit;
}
if (isset($_POST["unignore"])) {
    $id = escape($_POST["unignore"]);
    echo removeIgnore($id);
    exit;
}
if (isset($_POST["delete_room"]) && boomAllow(10)) {
    $room = escape($_POST["delete_room"]);
    echo deleteRoom($room, 1);
    exit;
}

function setUserTheme()
{
    global $mysqli;
    global $data;
    $theme = escape($_POST["set_user_theme"]);
    if ($theme == "system") {
        $user_theme = "system";
    } else {
        if ($theme == $data["user_theme"]) {
            $user_theme = escape($data["user_theme"]);
        } else {
            if (file_exists(BOOM_PATH . "/css/themes/" . $theme . "/" . $theme . ".css")) {
                $user_theme = $theme;
            } else {
                $user_theme = "system";
            }
        }
    }
    if ($user_theme == "system") {
        $new_theme = $data["default_theme"];
    } else {
        $new_theme = $user_theme;
    }
    $mysqli->query("UPDATE boom_users SET user_theme = '" . $user_theme . "' WHERE user_id = '" . $data["user_id"] . "'");
    $data["user_theme"] = $new_theme;
    $logo = getLogo();
    return boomCode(0, ["theme" => $new_theme, "logo" => $logo]);
}

function acceptFriend($id)
{
    global $mysqli;
    global $data;
    $user = boomUserInfo($id);
    if (empty($user)) {
        return 3;
    }
    $user["page"] = escape($_POST["page"]);
    if (!isMember($user) || !isMember($data)) {
        return 0;
    }
    if (0 < $user["ignored"] || mySelf($user["user_id"])) {
        return 0;
    }
    if ($user["friendship"] == 1) {
        $mysqli->query("UPDATE boom_friends SET fstatus = 3 WHERE hunter = '" . $data["user_id"] . "' AND target = '" . $id . "' OR hunter = '" . $id . "' AND target = '" . $data["user_id"] . "'");
        boomNotify("accept_friend", ["hunter" => $data["user_id"], "target" => $user["user_id"]]);
        updateNotify($data["user_id"]);
        return 1;
    }
    if (1 < $user["friendship"]) {
        return 1;
    }
    if ($user["friendship"] == 0) {
        $mysqli->query("INSERT INTO boom_friends (hunter, target, fstatus) VALUES ('" . $data["user_id"] . "', '" . $id . "', '2'), ('" . $id . "', '" . $data["user_id"] . "', '1')");
        updateNotify($id);
        return 2;
    }
}

function addFriend($id)
{
    global $mysqli;
    global $data;
    $user = boomUserInfo($id);
    if (empty($user)) {
        return 3;
    }
    if (!isMember($user) || !isMember($data)) {
        return 0;
    }
    if (0 < $user["ignored"] || mySelf($user["user_id"])) {
        return 0;
    }
    if (1 < $user["friendship"]) {
        return 1;
    }
    if ($user["friendship"] == 1) {
        $mysqli->query("UPDATE boom_friends SET fstatus = 3 WHERE hunter = '" . $data["user_id"] . "' AND target = '" . $user["user_id"] . "' OR hunter = '" . $user["user_id"] . "' AND target = '" . $data["user_id"] . "'");
        boomNotify("accept_friend", ["hunter" => $data["user_id"], "target" => $user["user_id"]]);
        updateNotify($data["user_id"]);
        return 1;
    }
    if ($user["friendship"] == 0) {
        $mysqli->query("INSERT INTO boom_friends (hunter, target, fstatus) VALUES ('" . $data["user_id"] . "', '" . $user["user_id"] . "', '2'), ('" . $user["user_id"] . "', '" . $data["user_id"] . "', '1')");
        updateNotify($user["user_id"]);
        return 1;
    }
}

?>