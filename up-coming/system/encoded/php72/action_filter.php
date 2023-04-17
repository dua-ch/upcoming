<?php
require __DIR__ . "/../../config_session.php";
if (isset($_POST["word_action"]) && isset($_POST["word_delay"])) {
    echo setwordaction();
    exit;
}
if (isset($_POST["spam_action"]) && isset($_POST["spam_delay"])) {
    echo setspamaction();
    exit;
}
if (isset($_POST["email_filter"])) {
    echo setemailfilter();
    exit;
}
if (isset($_POST["delete_ip"])) {
    echo staffdeleteip();
    exit;
}
if (isset($_POST["delete_word"])) {
    echo staffdeleteword();
    exit;
}
if (isset($_POST["add_word"]) && isset($_POST["type"])) {
    echo staffaddword();
    exit;
}

function setWordAction()
{
    global $mysqli;
    global $data;
    if (!boomAllow(10)) {
        return 0;
    }
    $action = escape($_POST["word_action"]);
    $delay = escape($_POST["word_delay"]);
    $mysqli->query("UPDATE boom_setting SET word_action = '" . $action . "', word_delay = '" . $delay . "' WHERE id = 1");
    return 1;
}

function setSpamAction()
{
    global $mysqli;
    global $data;
    if (!boomAllow(10)) {
        return 0;
    }
    $action = escape($_POST["spam_action"]);
    $delay = escape($_POST["spam_delay"]);
    $mysqli->query("UPDATE boom_setting SET spam_action = '" . $action . "', spam_delay = '" . $delay . "' WHERE id = 1");
    return 1;
}

function setEmailFilter()
{
    global $mysqli;
    global $data;
    $action = escape($_POST["email_filter"]);
    if (!boomAllow(10)) {
        return 0;
    }
    $mysqli->query("UPDATE boom_setting SET email_filter = '" . $action . "' WHERE id = 1");
    return 1;
}

function staffDeleteIp()
{
    global $mysqli;
    global $data;
    $ip = escape($_POST["delete_ip"]);
    if (!boomAllow(9)) {
        return 0;
    }
    $mysqli->query("DELETE FROM boom_banned WHERE id = '" . $ip . "'");
    return 1;
}

function staffDeleteWord()
{
    global $mysqli;
    global $data;
    $word = escape($_POST["delete_word"]);
    if (!boomAllow(9)) {
        return 0;
    }
    $mysqli->query("DELETE FROM boom_filter WHERE id = '" . $word . "'");
    return 1;
}

function staffAddWord()
{
    global $mysqli;
    global $data;
    $word = escape($_POST["add_word"]);
    $type = escape($_POST["type"]);
    if (!boomAllow(9)) {
        return "";
    }
    $check_word = $mysqli->query("SELECT * FROM boom_filter WHERE word = '" . $word . "' AND word_type = '" . $type . "'");
    if (0 < $check_word->num_rows) {
        return 0;
    }
    if (($type == "email" || $type == "username") && !boomAllow(10)) {
        return "";
    }
    if ($word != "") {
        $mysqli->query("INSERT INTO boom_filter (word, word_type) VALUE ('" . $word . "', '" . $type . "')");
        $word_added["id"] = $mysqli->insert_id;
        $word_added["word"] = $word;
        return boomTemplate("element/word", $word_added);
    }
    return 2;
}

?>