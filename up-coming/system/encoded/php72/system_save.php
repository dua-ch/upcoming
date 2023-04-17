<?php
require __DIR__ . "/../../config_session.php";
if (isset($_POST["save_admin_section"])) {
    $section = escape($_POST["save_admin_section"]);
    echo saveadminpanel($section);
    exit;
}
if (isset($_POST["test_mail"]) && isset($_POST["test_email"])) {
    $data["user_email"] = escape($_POST["test_email"]);
    if (!boomAllow(10)) {
        exit;
    }
    echo sendEmail("test", $data);
    exit;
}
if (isset($_POST["save_page"]) && isset($_POST["page_content"]) && isset($_POST["page_target"])) {
    $content = softEscape($_POST["page_content"]);
    $target = escape($_POST["page_target"]);
    echo boompagecontent($content, $target);
    exit;
}
exit;

function saveAdminPanel($section)
{
    global $mysqli;
    global $data;
    global $cody;
    global $lang;
    if (!boomAllow(10)) {
        return 99;
    }
    if ($section == "main_settings" && boomAllow(10)) {
        if (isset($_POST["set_index_path"]) && isset($_POST["set_title"]) && isset($_POST["set_timezone"]) && isset($_POST["set_default_language"]) && isset($_POST["set_site_description"]) && isset($_POST["set_site_keyword"])) {
            $index = escape($_POST["set_index_path"]);
            $title = escape($_POST["set_title"]);
            $timezone = escape($_POST["set_timezone"]);
            $language = escape($_POST["set_default_language"]);
            $description = escape($_POST["set_site_description"]);
            $keyword = escape($_POST["set_site_keyword"]);
            if ($language != $data["language"]) {
                $mysqli->query("UPDATE boom_users SET user_language = '" . $language . "' WHERE user_id > 0");
            }
            $mysqli->query("UPDATE boom_setting SET domain = '" . $index . "', title = '" . $title . "', site_description = '" . $description . "', site_keyword = '" . $keyword . "',\r\n\t\t\ttimezone = '" . $timezone . "', language = '" . $language . "'\r\n\t\t\tWHERE id = '1'");
            if ($language != $data["language"]) {
                return 2;
            }
            return 1;
        }
        return 99;
    }
    if ($section == "maintenance" && boomAllow(11)) {
        if (isset($_POST["set_maint_mode"])) {
            $maint_mode = escape($_POST["set_maint_mode"]);
            if ($maint_mode == 1 && $maint_mode != $data["maint_mode"]) {
                $mysqli->query("UPDATE boom_users SET user_action = user_action + 1 WHERE user_rank < 8");
            }
            $mysqli->query("UPDATE boom_setting SET maint_mode = '" . $maint_mode . "' WHERE id = '1'");
            return 1;
        }
        return 99;
    }
    if ($section == "display" && boomAllow(11)) {
        if (isset($_POST["set_login_page"]) && isset($_POST["set_main_theme"])) {
            $login_page = escape($_POST["set_login_page"]);
            $theme = escape($_POST["set_main_theme"]);
            if (file_exists(BOOM_PATH . "/control/login/" . $login_page . "/login.php")) {
                $mysqli->query("UPDATE boom_setting SET login_page = '" . $login_page . "', default_theme = '" . $theme . "' WHERE id = 1");
                if ($theme != $data["default_theme"]) {
                    return 2;
                }
                return 1;
            }
            return 99;
        }
        return 99;
    }
    if ($section == "data_setting" && boomAllow(10)) {
        if (isset($_POST["set_max_avatar"]) && isset($_POST["set_max_cover"]) && isset($_POST["set_max_file"])) {
            $max_avatar = escape($_POST["set_max_avatar"]);
            $max_cover = escape($_POST["set_max_cover"]);
            $max_file = escape($_POST["set_max_file"]);
            $mysqli->query("UPDATE boom_setting SET max_avatar = '" . $max_avatar . "', max_cover = '" . $max_cover . "', file_weight = '" . $max_file . "' WHERE id = '1'");
            return 1;
        }
        return 99;
    }
    if ($section == "player" && boomAllow(10)) {
        if (isset($_POST["set_default_player"])) {
            $default_player = escape($_POST["set_default_player"]);
            $mysqli->query("UPDATE boom_setting SET player_id = '" . $default_player . "' WHERE id = '1'");
            if ($default_player == 0 || $default_player != $data["player_id"]) {
                return 2;
            }
            return 1;
        }
        return 99;
    }
    if ($section == "registration" && boomAllow(10)) {
        if (isset($_POST["set_activation"]) && isset($_POST["set_registration"]) && isset($_POST["set_regmute"]) && isset($_POST["set_max_username"]) && isset($_POST["set_min_age"])) {
            $registration = escape($_POST["set_registration"]);
            $regmute = escape($_POST["set_regmute"]);
            $activation = escape($_POST["set_activation"]);
            $max_name = escape($_POST["set_max_username"]);
            $min_age = escape($_POST["set_min_age"]);
            if ($activation == 0) {
                $mysqli->query("UPDATE boom_users SET user_verify = 0 WHERE user_id > 0");
            }
            $mysqli->query("UPDATE boom_setting SET registration = '" . $registration . "', regmute = '" . $regmute . "', activation = '" . $activation . "', max_username = '" . $max_name . "', min_age = '" . $min_age . "' WHERE id = '1'");
            return 1;
        }
        return 99;
    }
    if ($section == "guest" && boomAllow(10)) {
        if (isset($_POST["set_allow_guest"]) && isset($_POST["set_guest_form"]) && isset($_POST["set_guest_talk"])) {
            $allow_guest = escape($_POST["set_allow_guest"]);
            $guest_form = escape($_POST["set_guest_form"]);
            $guest_talk = escape($_POST["set_guest_talk"]);
            if ($allow_guest == 0 && $allow_guest != $data["allow_guest"]) {
                cleanList("guest");
            }
            $mysqli->query("UPDATE boom_setting SET allow_guest = '" . $allow_guest . "', guest_form = '" . $guest_form . "', guest_talk = '" . $guest_talk . "' WHERE id = '1'");
            return 1;
        }
        return 99;
    }
    if ($section == "bridge_registration" && boomAllow(10)) {
        if (isset($_POST["set_use_bridge"])) {
            $use_bridge = escape($_POST["set_use_bridge"]);
            if (0 < $use_bridge && !file_exists(BOOM_PATH . "/../boom_bridge.php")) {
                return 404;
            }
            $mysqli->query("UPDATE boom_setting SET use_bridge = '" . $use_bridge . "' WHERE id = '1'");
            return 1;
        }
        return 99;
    }
    if ($section == "social_registration" && boomAllow(10)) {
        if (isset($_POST["set_facebook_login"]) && isset($_POST["set_facebook_id"]) && isset($_POST["set_facebook_secret"]) && isset($_POST["set_twitter_login"]) && isset($_POST["set_twitter_id"]) && isset($_POST["set_twitter_secret"]) && isset($_POST["set_google_login"]) && isset($_POST["set_google_id"]) && isset($_POST["set_google_secret"])) {
            $facebook_login = escape($_POST["set_facebook_login"]);
            $facebook_id = escape($_POST["set_facebook_id"]);
            $facebook_secret = escape($_POST["set_facebook_secret"]);
            $google_login = escape($_POST["set_google_login"]);
            $google_id = escape($_POST["set_google_id"]);
            $google_secret = escape($_POST["set_google_secret"]);
            $twitter_login = escape($_POST["set_twitter_login"]);
            $twitter_id = escape($_POST["set_twitter_id"]);
            $twitter_secret = escape($_POST["set_twitter_secret"]);
            $mysqli->query("UPDATE boom_setting SET \r\n\t\t\tfacebook_login = '" . $facebook_login . "', facebook_id = '" . $facebook_id . "', facebook_secret = '" . $facebook_secret . "',\r\n\t\t\tgoogle_login = '" . $google_login . "', google_id = '" . $google_id . "', google_secret = '" . $google_secret . "',\r\n\t\t\ttwitter_login = '" . $twitter_login . "', twitter_id = '" . $twitter_id . "', twitter_secret = '" . $twitter_secret . "'\r\n\t\t\tWHERE id = 1");
            return 1;
        }
        return 99;
    }
    if ($section == "limitation" && boomAllow(10)) {
        if (isset($_POST["set_allow_cupload"]) && isset($_POST["set_allow_pupload"]) && isset($_POST["set_allow_wupload"]) && isset($_POST["set_allow_cover"]) && isset($_POST["set_allow_gcover"]) && isset($_POST["set_emo_plus"]) && isset($_POST["set_allow_direct"]) && isset($_POST["set_allow_room"]) && isset($_POST["set_allow_theme"]) && isset($_POST["set_allow_history"]) && isset($_POST["set_allow_colors"]) && isset($_POST["set_allow_name_color"]) && isset($_POST["set_allow_name_neon"]) && isset($_POST["set_allow_name_font"]) && isset($_POST["set_allow_verify"]) && isset($_POST["set_allow_name"]) && isset($_POST["set_allow_avatar"]) && isset($_POST["set_allow_mood"]) && isset($_POST["set_allow_grad"]) && isset($_POST["set_allow_neon"]) && isset($_POST["set_allow_font"]) && isset($_POST["set_allow_name_grad"])) {
            $allow_avatar = escape($_POST["set_allow_avatar"]);
            $allow_cover = escape($_POST["set_allow_cover"]);
            $allow_gcover = escape($_POST["set_allow_gcover"]);
            $allow_cupload = escape($_POST["set_allow_cupload"]);
            $allow_pupload = escape($_POST["set_allow_pupload"]);
            $allow_wupload = escape($_POST["set_allow_wupload"]);
            $emo_plus = escape($_POST["set_emo_plus"]);
            $allow_direct = escape($_POST["set_allow_direct"]);
            $allow_room = escape($_POST["set_allow_room"]);
            $allow_theme = escape($_POST["set_allow_theme"]);
            $allow_history = escape($_POST["set_allow_history"]);
            $allow_verify = escape($_POST["set_allow_verify"]);
            $allow_name = escape($_POST["set_allow_name"]);
            $allow_mood = escape($_POST["set_allow_mood"]);
            $allow_colors = escape($_POST["set_allow_colors"]);
            $allow_grad = escape($_POST["set_allow_grad"]);
            $allow_neon = escape($_POST["set_allow_neon"]);
            $allow_font = escape($_POST["set_allow_font"]);
            $allow_name_color = escape($_POST["set_allow_name_color"]);
            $allow_name_grad = escape($_POST["set_allow_name_grad"]);
            $allow_name_neon = escape($_POST["set_allow_name_neon"]);
            $allow_name_font = escape($_POST["set_allow_name_font"]);
            $mysqli->query("\r\n\t\t\t\tUPDATE boom_setting SET  \r\n\t\t\t\tallow_name_color = '" . $allow_name_color . "', allow_name_grad = '" . $allow_name_grad . "', allow_name_neon = '" . $allow_name_neon . "', allow_name_font = '" . $allow_name_font . "', allow_mood = '" . $allow_mood . "',\r\n\t\t\t\tallow_cupload = '" . $allow_cupload . "', allow_pupload = '" . $allow_pupload . "', allow_wupload = '" . $allow_wupload . "', allow_cover = '" . $allow_cover . "', allow_gcover = '" . $allow_gcover . "', \r\n\t\t\t\temo_plus = '" . $emo_plus . "', allow_direct = '" . $allow_direct . "', allow_room = '" . $allow_room . "',allow_theme = '" . $allow_theme . "', allow_history = '" . $allow_history . "', allow_verify = '" . $allow_verify . "',\r\n\t\t\t\tallow_colors = '" . $allow_colors . "', allow_grad = '" . $allow_grad . "', allow_neon = '" . $allow_neon . "', allow_font = '" . $allow_font . "', allow_name = '" . $allow_name . "', allow_avatar = '" . $allow_avatar . "'\r\n\t\t\t\tWHERE id = '1'\r\n\t\t\t");
            return 1;
        }
        return 99;
    }
    if ($section == "email_settings" && boomAllow(11)) {
        if (isset($_POST["set_mail_type"]) && isset($_POST["set_site_email"]) && isset($_POST["set_email_from"]) && isset($_POST["set_smtp_host"]) && isset($_POST["set_smtp_username"]) && isset($_POST["set_smtp_password"]) && isset($_POST["set_smtp_port"]) && isset($_POST["set_smtp_type"])) {
            $mail_type = escape($_POST["set_mail_type"]);
            $site_email = escape($_POST["set_site_email"]);
            $email_from = escape($_POST["set_email_from"]);
            $smtp_host = escape($_POST["set_smtp_host"]);
            $smtp_username = escape($_POST["set_smtp_username"]);
            $smtp_password = escape($_POST["set_smtp_password"]);
            $smtp_port = escape($_POST["set_smtp_port"]);
            $smtp_type = escape($_POST["set_smtp_type"]);
            $mysqli->query("UPDATE boom_setting SET\r\n\t\t\t\t\t\t\tmail_type = '" . $mail_type . "', site_email = '" . $site_email . "', email_from = '" . $email_from . "', smtp_host = '" . $smtp_host . "', \r\n\t\t\t\t\t\t\tsmtp_username = '" . $smtp_username . "', smtp_password = '" . $smtp_password . "', smtp_port = '" . $smtp_port . "', smtp_type = '" . $smtp_type . "'\r\n\t\t\t\t\t\t\tWHERE id = '1'");
            return 1;
        }
        return 99;
    }
    if ($section == "chat" && boomAllow(10)) {
        if (isset($_POST["set_gender_ico"]) && isset($_POST["set_flag_ico"]) && isset($_POST["set_max_main"]) && isset($_POST["set_max_private"]) && isset($_POST["set_speed"]) && isset($_POST["set_max_offcount"]) && isset($_POST["set_allow_logs"])) {
            $gender_ico = escape($_POST["set_gender_ico"]);
            $flag_ico = escape($_POST["set_flag_ico"]);
            $max_main = escape($_POST["set_max_main"]);
            $max_private = escape($_POST["set_max_private"]);
            $max_offcount = escape($_POST["set_max_offcount"]);
            $speed = escape($_POST["set_speed"]);
            $allow_logs = escape($_POST["set_allow_logs"]);
            $mysqli->query("UPDATE boom_setting SET\r\n\t\t\t\t\t\t\tallow_logs = '" . $allow_logs . "', gender_ico = '" . $gender_ico . "', flag_ico = '" . $flag_ico . "', max_main = '" . $max_main . "', max_private = '" . $max_private . "',\r\n\t\t\t\t\t\t\tspeed = '" . $speed . "', max_offcount = '" . $max_offcount . "' WHERE id = '1'");
            return 1;
        }
        return 99;
    }
    if ($section == "delays" && boomAllow(10)) {
        if (isset($_POST["set_chat_delete"]) && isset($_POST["set_private_delete"]) && isset($_POST["set_wall_delete"]) && isset($_POST["set_member_delete"]) && isset($_POST["set_room_delete"]) && isset($_POST["set_act_delay"])) {
            $act_delay = escape($_POST["set_act_delay"]);
            $chat = escape($_POST["set_chat_delete"]);
            $private = escape($_POST["set_private_delete"]);
            $wall = escape($_POST["set_wall_delete"]);
            $member = escape($_POST["set_member_delete"]);
            $room = escape($_POST["set_room_delete"]);
            $mysqli->query("UPDATE boom_setting SET act_delay = '" . $act_delay . "', chat_delete = '" . $chat . "', private_delete = '" . $private . "', wall_delete = '" . $wall . "', last_clean = '0', member_delete = '" . $member . "', room_delete = '" . $room . "' WHERE id = '1'");
            return 1;
        }
        return 99;
    }
    if ($section == "modules" && boomAllow(10)) {
        if (isset($_POST["set_use_wall"]) && isset($_POST["set_use_lobby"]) && isset($_POST["set_cookie_law"])) {
            $use_lobby = escape($_POST["set_use_lobby"]);
            $use_wall = escape($_POST["set_use_wall"]);
            $cookie_law = escape($_POST["set_cookie_law"]);
            if ($use_wall == 0) {
                $mysqli->query("DELETE FROM boom_notification WHERE notify_source = 'post'");
                $mysqli->query("DELETE FROM boom_report WHERE report_type = '2'");
            }
            $mysqli->query("UPDATE boom_setting SET use_lobby = '" . $use_lobby . "', use_wall = '" . $use_wall . "', cookie_law = '" . $cookie_law . "' WHERE id = '1'");
            return 1;
        }
        return 99;
    }
    if ($section == "security_registration" && boomAllow(10)) {
        if (isset($_POST["set_use_recapt"]) && isset($_POST["set_recapt_key"]) && isset($_POST["set_recapt_secret"])) {
            $use_recapt = escape($_POST["set_use_recapt"]);
            $recapt_key = escape($_POST["set_recapt_key"]);
            $recapt_secret = escape($_POST["set_recapt_secret"]);
            $mysqli->query("UPDATE boom_setting SET use_recapt = '" . $use_recapt . "', recapt_key = '" . $recapt_key . "', recapt_secret = '" . $recapt_secret . "' WHERE id = '1'");
            return 1;
        }
        return 99;
    }
}

function boomPageContent($content, $target)
{
    global $mysqli;
    if (!boomAllow(10)) {
        return "";
    }
    if (empty($content)) {
        $content = "";
    }
    $target = escape($_POST["page_target"]);
    $check_page = $mysqli->query("SELECT * FROM boom_page WHERE page_name = '" . $target . "'");
    if (0 < $check_page->num_rows) {
        $mysqli->query("UPDATE boom_page SET page_content = '" . $content . "' WHERE page_name = '" . $target . "'");
    } else {
        $mysqli->query("INSERT INTO boom_page (page_name, page_content) VALUES ('" . $target . "', '" . $content . "')");
    }
    return 1;
}

?>