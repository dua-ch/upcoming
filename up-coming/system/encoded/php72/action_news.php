<?php
require __DIR__ . "/../../config_session.php";
if (isset($_POST["add_news"]) && isset($_POST["post_file"])) {
    echo postsystemnews();
    exit;
}
if (isset($_POST["like_news"]) && isset($_POST["like_type"])) {
    echo newslike();
    exit;
}
if (isset($_POST["more_news"])) {
    echo morenews();
    exit;
}
if (isset($_POST["id"]) && isset($_POST["load_news_comment"])) {
    echo loadnewscomment();
    exit;
}
if (isset($_POST["content"]) && isset($_POST["reply_news"])) {
    echo newsreply();
    exit;
}
if (isset($_POST["current"]) && isset($_POST["id"]) && isset($_POST["load_news_reply"])) {
    echo morenewscomment();
    exit;
}
if (isset($_POST["delete_news_reply"])) {
    echo deletenewsreply();
    exit;
}
if (isset($_POST["remove_news"])) {
    echo deletenews();
    exit;
}
function newsReplyCount($id)
{
    global $mysqli;
    global $data;
    $get_count = $mysqli->query("SELECT count(reply_id) as total FROM boom_news_reply WHERE parent_id = '" . $id . "'");
    $t = $get_count->fetch_assoc();
    return $t["total"];
}

function moreNews()
{
    global $mysqli;
    global $data;
    $news = escape($_POST["more_news"]);
    $news_content = "";
    $get_news = $mysqli->query("SELECT boom_news.*, boom_users.*,\r\n\t(SELECT count(id) FROM boom_news) as news_count,\r\n\t(SELECT count( parent_id ) FROM boom_news_reply WHERE parent_id = boom_news.id ) as reply_count,\r\n\t(SELECT like_type FROM boom_news_like WHERE uid = '" . $data["user_id"] . "' AND like_post = boom_news.id) as liked\r\n\tFROM boom_news, boom_users\r\n\tWHERE boom_news.id < '" . $news . "' AND boom_news.news_poster = boom_users.user_id \r\n\tORDER BY news_date DESC LIMIT 10");
    if (0 < $get_news->num_rows) {
        while ($news = $get_news->fetch_assoc()) {
            $news_content .= boomTemplate("element/news", $news);
        }
    } else {
        $news_content .= 0;
    }
    return $news_content;
}

function newsReply()
{
    global $mysqli;
    global $data;
    global $cody;
    $content = escape($_POST["content"]);
    $reply_to = escape($_POST["reply_news"]);
    if (!boomAllow($cody["can_reply_news"])) {
        return "";
    }
    if (muted()) {
        return boomCode(0);
    }
    $content = wordFilter($content);
    if (1001 <= strlen($content)) {
        return boomCode(0);
    }
    $check_valid = $mysqli->query("SELECT * FROM boom_news WHERE id = '" . $reply_to . "'");
    if ($check_valid->num_rows < 1) {
        return boomCode(0);
    }
    $news = $check_valid->fetch_assoc();
    $mysqli->query("INSERT INTO boom_news_reply (parent_id, reply_date, reply_user, reply_content, reply_uid) VALUES ('" . $news["id"] . "', '" . time() . "', '" . $data["user_id"] . "', '" . $content . "', '" . $news["news_poster"] . "')");
    $last_id = $mysqli->insert_id;
    $get_back = $mysqli->query("\r\n\t\tSELECT boom_news_reply.*, boom_users.* \r\n\t\tFROM boom_news_reply, boom_users\r\n\t\tWHERE boom_news_reply.parent_id = '" . $reply_to . "' AND boom_news_reply.reply_user = '" . $data["user_id"] . "' AND boom_users.user_id = '" . $data["user_id"] . "' \r\n\t\tORDER BY reply_id DESC LIMIT 1\r\n\t");
    if ($get_back->num_rows < 1) {
        return boomCode(0);
    }
    $reply = $get_back->fetch_assoc();
    $log = boomTemplate("element/news_reply", $reply);
    $total = newsreplycount($reply_to);
    return boomCode(1, ["data" => $log, "total" => $total]);
}

function loadNewsComment()
{
    global $mysqli;
    global $data;
    global $lang;
    $id = escape($_POST["id"]);
    $load_reply = "";
    $reply_count = 0;
    $find_reply = $mysqli->query("SELECT boom_news_reply.*, boom_users.*,\r\n\t(SELECT count(reply_id) FROM boom_news_reply WHERE parent_id = '" . $id . "' ) as reply_count\r\n\tFROM  boom_news_reply, boom_users WHERE boom_news_reply.parent_id = '" . $id . "' AND boom_news_reply.reply_user = boom_users.user_id ORDER BY boom_news_reply.reply_id DESC LIMIT 10");
    if (0 < $find_reply->num_rows) {
        while ($reply = $find_reply->fetch_assoc()) {
            $load_reply .= boomTemplate("element/news_reply", $reply);
            $reply_count = $reply["reply_count"];
        }
    }
    if (10 < $reply_count) {
        $more = "<a onclick=\"moreNewsComment(this," . $id . ")\" class=\"theme_color text_small more_comment\">" . $lang["view_more_comment"] . "</a>";
    } else {
        $more = 0;
    }
    return boomCode(1, ["reply" => $load_reply, "more" => $more]);
}

function moreNewsComment()
{
    global $mysqli;
    global $data;
    global $lang;
    $id = escape($_POST["id"]);
    $offset = escape($_POST["current"]);
    $reply_comment = "";
    $find_reply = $mysqli->query("SELECT boom_news_reply.*, boom_users.*\r\n\tFROM  boom_news_reply, boom_users WHERE boom_news_reply.parent_id = '" . $id . "' AND boom_news_reply.reply_id < '" . $offset . "' AND boom_news_reply.reply_user = boom_users.user_id ORDER BY boom_news_reply.reply_id DESC LIMIT 20");
    if (0 < $find_reply->num_rows) {
        while ($reply = $find_reply->fetch_assoc()) {
            $reply_comment .= boomTemplate("element/news_reply", $reply);
        }
    } else {
        $reply_comment = 0;
    }
    return $reply_comment;
}

function deleteNewsReply()
{
    global $mysqli;
    global $data;
    global $cody;
    global $lang;
    $reply_id = escape($_POST["delete_news_reply"]);
    $reply_info = $mysqli->query("\r\n\tSELECT boom_news_reply.*, boom_users.*\r\n\tFROM boom_news_reply, boom_users \r\n\tWHERE boom_news_reply.reply_id = '" . $reply_id . "' AND boom_users.user_id = boom_news_reply.reply_user\r\n\t");
    if ($reply_info->num_rows == 1) {
        $reply = $reply_info->fetch_assoc();
        if (!canDeleteNewsReply($reply)) {
            return boomCode(0);
        }
        $mysqli->query("DELETE FROM boom_news_reply WHERE reply_id = '" . $reply_id . "'");
        $total = newsreplycount($reply["parent_id"]);
        return boomCode(1, ["news" => $reply["parent_id"], "reply" => $reply_id, "total" => $total]);
    }
    return boomCode(0);
}

function postSystemNews()
{
    global $mysqli;
    global $data;
    $news = clearBreak($_POST["add_news"]);
    $news = escape($news);
    $post_file = escape($_POST["post_file"]);
    $news_file = "";
    $file_ok = 0;
    if (muted()) {
        return 0;
    }
    if (!canPostNews()) {
        return 0;
    }
    $news = trimContent($news);
    if (empty($news) && empty($post_file)) {
        return 0;
    }
    if ($post_file != "") {
        $get_file = $mysqli->query("SELECT * FROM boom_upload WHERE file_key = '" . $post_file . "' AND file_user = '" . $data["user_id"] . "' AND file_complete = '0'");
        if (0 < $get_file->num_rows) {
            $file = $get_file->fetch_assoc();
            $news_file = "/upload/news/" . $file["file_name"];
            $file_ok = 1;
        } else {
            if ($news == "") {
                return 0;
            }
        }
    }
    $mysqli->query("UPDATE boom_users SET user_news = '" . time() . "' WHERE user_id = '" . $data["user_id"] . "'");
    $mysqli->query("INSERT INTO boom_news ( news_poster, news_message, news_file, news_date ) VALUE ('" . $data["user_id"] . "', '" . $news . "', '" . $news_file . "', '" . time() . "')");
    $news_id = $mysqli->insert_id;
    if ($file_ok == 1) {
        $mysqli->query("UPDATE boom_upload SET file_complete = '1', relative_post = '" . $news_id . "' WHERE file_key = '" . $post_file . "' AND file_user = '" . $data["user_id"] . "'");
    }
    updateAllNotify();
    return showNews($news_id);
}

function deleteNews()
{
    global $mysqli;
    global $data;
    global $lang;
    $news = escape($_POST["remove_news"]);
    $valid = $mysqli->query("\r\n\tSELECT boom_news.*, boom_users.* \r\n\tFROM boom_news, boom_users \r\n\tWHERE boom_news.id = '" . $news . "' AND boom_users.user_id = boom_news.news_poster\r\n\t");
    if (0 < $valid->num_rows) {
        $tnews = $valid->fetch_assoc();
        if (!canDeleteNews($tnews)) {
            return 1;
        }
        $mysqli->query("DELETE FROM boom_news WHERE id = '" . $news . "'");
        $mysqli->query("DELETE FROM boom_news_reply WHERE parent_id = '" . $news . "'");
        $mysqli->query("DELETE FROM boom_news_like WHERE like_post = '" . $news . "'");
        removeRelatedFile($news, "news");
        updateAllNotify();
        if (!mySelf($tnews["user_id"])) {
            boomConsole("news_delete", ["hunter" => $data["user_id"], "target" => $tnews["user_id"]]);
        }
        return "boom_news" . $news;
    }
    return 1;
}

function newsLike()
{
    global $mysqli;
    global $data;
    if (!boomAllow(1)) {
        return "";
    }
    $id = escape($_POST["like_news"]);
    $type = escape($_POST["like_type"]);
    $like_result = $mysqli->query("SELECT news_poster, (SELECT like_type FROM boom_news_like WHERE like_post = '" . $id . "' AND uid = '" . $data["user_id"] . "') AS type FROM boom_news WHERE id = '" . $id . "'");
    if (0 < $like_result->num_rows) {
        $like = $like_result->fetch_assoc();
        $mysqli->query("DELETE FROM boom_news_like WHERE like_post = '" . $id . "' AND uid = '" . $data["user_id"] . "'");
        if ($like["type"] == $type) {
            return boomCode(1, ["data" => getLikes($id, 0, "news")]);
        }
        $mysqli->query("INSERT INTO boom_news_like ( uid, liked_uid, like_type, like_post, like_date) VALUE ('" . $data["user_id"] . "', '" . $like["news_poster"] . "', " . $type . ", '" . $id . "', '" . time() . "')");
        return boomCode(1, ["data" => getLikes($id, $type, "news")]);
    }
    return boomCode(0);
}

?>