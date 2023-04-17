<?php
require __DIR__ . "/../../config_session.php";
if (isset($_POST["run_console"])) {
    $console = escape($_POST["run_console"]);
    echo boomrunconsole($console);
} else {
    echo 0;
    exit;
}

function boomRunConsole($console)
{
    global $mysqli;
    global $data;
    global $cody;
    global $lang;
    $command = explode(" ", trim($console));
            if ($command[0] == "/removetheme" && boomAllow(11)) {
                $theme = trimCommand($console, "/removetheme");
                if ($theme == $data["default_theme"]) {
                    return 3;
                }
                $mysqli->query("UPDATE boom_users SET user_theme = 'system' WHERE user_theme = '" . $theme . "'");
                return 1;
            }
            if ($command[0] == "/removelanguage" && boomAllow(11)) {
                $language = trimCommand($console, "/removelanguage");
                if ($language == $data["language"]) {
                    return 3;
                }
                $mysqli->query("UPDATE boom_users SET user_language = '" . $data["language"] . "' WHERE user_language = '" . $language . "'");
                return 1;
            }
            if ($command[0] == "/clearwall" && boomAllow(11)) {
                $mysqli->query("TRUNCATE TABLE boom_post");
                $mysqli->query("TRUNCATE TABLE boom_post_reply");
                $mysqli->query("TRUNCATE TABLE boom_post_like");
                $mysqli->query("DELETE FROM boom_notification WHERE notify_source = 'post'");
                return 1;
            }
            if ($command[0] == "/clearprivate" && boomAllow(11)) {
                $mysqli->query("DELETE FROM boom_private WHERE id > 0");
                return 1;
            }
            if ($command[0] == "/clearnotification" && boomAllow(11)) {
                $mysqli->query("TRUNCATE TABLE boom_notification");
                return 1;
            }
            if ($command[0] == "/resetgeo" && boomAllow(11)) {
                $mysqli->query("UPDATE boom_users SET country = '' WHERE user_id > 0");
                $mysqli->query("UPDATE boom_users SET country = 'ZZ' WHERE user_bot > 0");
                return 1;
            }
            if ($command[0] == "/resetcover" && boomAllow(11)) {
                $mysqli->query("UPDATE boom_users SET user_cover = '' WHERE user_id > 0");
                return 1;
            }
            if ($command[0] == "/clearchat" && boomAllow(10)) {
                $mysqli->query("DELETE FROM boom_chat WHERE post_id > 0");
                return 1;
            }
            if ($command[0] == "/clearreport" && boomAllow(10)) {
                $mysqli->query("TRUNCATE TABLE boom_report");
                return 1;
            }
            if ($command[0] == "/clearmail" && boomAllow(11)) {
                $mysqli->query("TRUNCATE TABLE boom_mail");
                return 1;
            }
            if ($command[0] == "/resetsystembot" && boomAllow(11)) {
                if (isset($data["system_id"])) {
                    $user = userDetails($data["system_id"]);
                } else {
                    $user = userDetails(0);
                }
                clearUserData($user);
                sleep(1);
                $mysqli->query("\r\n\t\tINSERT INTO `boom_users` \r\n\t\t(user_name, user_email, user_ip, user_join, user_language, user_password, user_rank, user_tumb, verified, user_bot) VALUES\r\n\t\t('System', '', '0.0.0.0', '" . time() . "', 'English', '" . randomPass() . "', '9', 'default_system.png', '1', '9')\r\n\t\t");
                $last_id = $mysqli->insert_id;
                $mysqli->query("UPDATE boom_setting SET system_id = '" . $last_id . "'");
                return 1;
            }
            if ($command[0] == "/clearnews" && boomAllow(11)) {
                $mysqli->query("TRUNCATE TABLE boom_news");
                $mysqli->query("TRUNCATE TABLE boom_news_reply");
                $mysqli->query("TRUNCATE TABLE boom_news_like");
                updateAllNotify();
                return 1;
            }
            if ($command[0] == "/clearcache" && boomAllow(11)) {
                boomCacheUpdate();
                return 1;
            }
            if ($command[0] == "/makefullowner" && boomAllow(11)) {
                $t = trimCommand($console, "/makefullowner");
                $target = nameDetails($t);
                if (empty($target)) {
                    return 4;
                }
                if (!mySelf($target["user_id"]) && !isOwner($target)) {
                    $mysqli->query("UPDATE boom_users SET user_rank = 11 WHERE user_name = '" . $target["user_name"] . "'");
                    return 1;
                }
                return 5;
            }
            if ($command[0] == "/makevisible" && boomAllow(11)) {
                $mysqli->query("UPDATE boom_users SET user_status = 1 WHERE user_status = 6 AND user_id != '" . $data["user_id"] . "' AND user_rank < 11");
                return 1;
            }
            if ($command[0] == "/resetsystem" && boomAllow(11)) {
                $mysqli->query("TRUNCATE TABLE boom_chat");
                $mysqli->query("TRUNCATE TABLE boom_private");
                $mysqli->query("TRUNCATE TABLE boom_notification");
                $mysqli->query("TRUNCATE TABLE boom_post");
                $mysqli->query("TRUNCATE TABLE boom_post_reply");
                $mysqli->query("TRUNCATE TABLE boom_post_like");
                return 1;
            }
            if ($command[0] == "/banip" && boomAllow(10)) {
                $ip = $command[1];
                if (!filter_var($ip, FILTER_VALIDATE_IP) === false || !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
                    $mysqli->query("INSERT INTO boom_banned (ip) VALUES ('" . $ip . "')");
                    return 1;
                }
                return 2;
            }
            if ($command[0] == "/resetterms" && boomAllow(11)) {
                require BOOM_PATH . "/system/template/data_template.php";
                $mysqli->query("UPDATE `boom_page` SET `page_content` = '" . $term_content . "' WHERE page_name = 'terms_of_use'");
                return 1;
            }
            if ($command[0] == "/resetprivacy" && boomAllow(11)) {
                require BOOM_PATH . "/template/data_template.php";
                $mysqli->query("UPDATE `boom_page` SET `page_content` = '" . $privacy_content . "' WHERE page_name = 'privacy_policy'");
                return 1;
            }
            if ($command[0] == "/resethelp" && boomAllow(11)) {
                require BOOM_PATH . "/template/data_template.php";
                $mysqli->query("UPDATE `boom_page` SET `page_content` = '" . $help_content . "' WHERE page_name = 'help'");
                return 1;
            }
            if ($command[0] == "/fontreset" && boomAllow(11)) {
                $mysqli->query("UPDATE boom_users SET user_font = '', bcfont = '' WHERE user_id > 0");
                return 1;
            }
            if ($command[0] == "/moodreset" && boomAllow(11)) {
                $mysqli->query("UPDATE boom_users SET user_mood = '' WHERE user_rank < '" . $data["allow_mood"] . "'");
                return 1;
            }
            if ($command[0] == "/themereset" && boomAllow(11)) {
                $mysqli->query("UPDATE boom_users SET user_theme = 'system' WHERE user_rank < '" . $data["allow_theme"] . "'");
                return 1;
            }
            return 0;
}

?>