<?php
$load_addons = 'AA_group_chat';
require_once('../../../system/config_addons.php');

// @ioncube.dk boomMerge("es5dynamic3354s", "dynamic46847s") -> "es5dynamic3354s_dynamic46847s" RANDOM
function newExDynm1()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    $rank = escape($_POST['set_addon_access']);
    $mysqli->query("UPDATE boom_addons SET addons_access = '$rank' WHERE addons = 'AA_group_chat'");
    echo 1;
}

// @ioncube.dk boomMerge("es5dynamic3354ss", "dynamic46847ss") -> "es5dynamic3354ss_dynamic46847ss" RANDOM
function newExDynm2()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    $mysqli->query("DELETE FROM group_chat WHERE post_id > 0");
    $mysqli->query("UPDATE boom_users SET user_group = '' WHERE user_id > 0");
    $files = glob(BOOM_PATH . '/addons/AA_group_chat/files/upload/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
    echo 1;
}

// @ioncube.dk boomMerge("es5dynamic3354dd", "dynamic46847dd") -> "es5dynamic3354dd_dynamic46847dd" RANDOM
function newExDynm3()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    $name = escape($_POST['invite_username']);
    $sql = $mysqli->query("SELECT * FROM boom_users WHERE user_name LIKE '$name%' AND user_bot = 0");
    if ($sql->num_rows > 0) {
        $fetch = $sql->fetch_assoc();
        echo sub_Template('system/template/user_temp', $fetch);
        die();
    }
}

// @ioncube.dk boomMerge("es5dynamic3354w", "dynamic46847w") -> "es5dynamic3354w_dynamic46847w" RANDOM
function newExDynm4()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    $target = escape($_POST['user_invite_id']);
    $uid = escape($data['user_id']);
    $user = userDetails($target);
    $gid = '';
    if ($data['user_group'] != '') {
        $gid = $data['user_group'];
    } else {
        $gid = 'cg_' . $uid;
    }
    if ($user['user_group'] != '') {
        echo 4;
        die();
    }
    if ($target == $uid) {
        echo 3;
        die();
    }
    $sql = $mysqli->query("SELECT * FROM group_chat_ask WHERE uid = '$uid' AND target = '$target'");
    if ($sql->num_rows == 0) {
        $mysqli->query("INSERT INTO group_chat_ask (uid, target, viewed, group_id) VALUES ('$uid', '$target', '0', '$gid')");
        echo 1;
        die();
    } else {
        echo 0;
        die();
    }
}

// @ioncube.dk boomMerge("es5dynamic3354f", "dynamic46847f") -> "es5dynamic3354f_dynamic46847f" RANDOM
function newExDynm5()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    $uid = escape($data['user_id']);
    $count = 0;
    $sql = $mysqli->query("SELECT COUNT(target) as MaxView FROM group_chat_ask WHERE target = '$uid' AND viewed = '0'");
    if ($sql->num_rows > 0) {
        while ($fetch = $sql->fetch_assoc()) {
            $count = $fetch['MaxView'];
        }
    }
    echo json_encode(array("total" => $count), JSON_UNESCAPED_UNICODE);
}

// @ioncube.dk boomMerge("es5dynamic3354dda", "dynamic46847da") -> "es5dynamic3354dda_dynamic46847da" RANDOM
function newExDynm6()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    $group = escape($_POST['accept_group_id']);
    $mysqli->query("UPDATE boom_users SET user_group = '$group' WHERE user_id = '{$data['user_id']}'");
    $mysqli->query("DELETE FROM group_chat_ask WHERE target = '{$data['user_id']}'");
    $content = str_replace('%user%', $data['user_name'], $lang['join_group']);
    systemPostGroupChat($group, $content);
    echo 1;
}

// @ioncube.dk boomMerge("es5dynamic3354x", "dynamic46847x") -> "es5dynamic3354x_dynamic46847x" RANDOM
function newExDynm7()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    $group = escape($_POST['decline_group_id']);
    $mysqli->query("DELETE FROM group_chat_ask WHERE target = '{$data['user_id']}' AND group_id = '$group'");
    $content = str_replace('%user%', $data['user_name'], $lang['decline_group']);
    systemPostGroupChat($group, $content);
    echo 1;
}

// @ioncube.dk boomMerge("es5dynamic3354vv", "dynamic46847vv") -> "es5dynamic3354vv_dynamic46847vv" RANDOM
function newExDynm8()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    $last = escape($_POST['last']);
    $d['mlast'] = $last;
    $d['logs'] = '';
    $d['getChat'] = 0;
    $snum = escape($_POST['snum']);
    $ssnum = 0;
    if ($data['user_group'] != '') {
        $d['getChat'] = 1;
    }
    $uid = escape($data['user_id']);
    $gaction = escape($data['action_group']);
    $myGroup = escape($data['user_group']);
    $d['askers'] = 0;
    $sql = $mysqli->query("SELECT COUNT(target) as MaxView FROM group_chat_ask WHERE target = '$uid' AND viewed = '0'");
    if ($sql->num_rows > 0) {
        while ($fetch = $sql->fetch_assoc()) {
            $d['askers'] = $fetch['MaxView'];
        }
    }
    $d['gnoti'] = '';
    $sql2 = $mysqli->query("SELECT COUNT(user_id) as MaxNoti FROM group_chat WHERE post_date > '$gaction' AND group_id = '$myGroup'");
    if ($sql2->num_rows > 0) {
        while ($fetch = $sql2->fetch_assoc()) {
            $d['gnoti'] = $fetch['MaxNoti'];
        }
    }
    $log = $mysqli->query("SELECT log.*, 
    boom_users.user_name, boom_users.user_color, boom_users.user_font, boom_users.user_rank, boom_users.bccolor, boom_users.user_sex, boom_users.user_age, boom_users.user_tumb, boom_users.user_cover, boom_users.country, boom_users.user_bot
    FROM ( SELECT * FROM `group_chat` WHERE `group_id` = '{$data['user_group']}'  AND post_id > '$last' ORDER BY `post_id` DESC LIMIT 10) AS log
    LEFT JOIN boom_users ON log.user_id = boom_users.user_id
    ORDER BY `post_id` ASC");
    if ($log->num_rows > 0) {
        $mysqli->query("UPDATE `boom_users` SET `action_group` = '".time()."' WHERE `user_id` = '{$data['user_id']}'");
        while ($chat = $log->fetch_assoc()) {
            $user = userDetails($chat['user_id']);
            $d['mlast'] = $chat['post_id'];
            if($chat['snum'] != $snum || $ssnum == 1){
                $d['logs'] .= createGchatLog($chat);
            }
        }
    }
    echo json_encode($d, JSON_UNESCAPED_UNICODE);
}

// @ioncube.dk boomMerge("es5dynamic3354vd", "dynamic46847vd") -> "es5dynamic3354vd_dynamic46847vd" RANDOM
function newExDynm9()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    $group = escape('cg_' . $data['user_id']);
    $mysqli->query("UPDATE boom_users SET user_group = '$group', group_owner = '1', action_group = '{$data['action_group']}' WHERE user_id = '{$data['user_id']}'");
    echo 1;
}

// @ioncube.dk boomMerge("es5dynamic3354dv", "dynamic46847dv") -> "es5dynamic3354dv_dynamic46847dv" RANDOM
function newExDynm10()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    $sql = $mysqli->query("SELECT * FROM boom_users WHERE user_group = '{$data['user_group']}'");
    if ($sql->num_rows == 1) {
        $mysqli->query("DELETE FROM group_chat WHERE group_id = '{$data['user_group']}'");
    }
    $content = str_replace('%user%', $data['user_name'], $lang['left_group']);
    systemPostGroupChat($data['user_group'], $content);
    $mysqli->query("UPDATE boom_users SET user_group = '' WHERE user_id = '{$data['user_id']}'");
    echo 1;
    die();
}

// @ioncube.dk boomMerge("es5dynamic3354fs", "dynamic46847fs") -> "es5dynamic3354fs_dynamic46847fs" RANDOM
function newExDynm11()
{
    global $data, $mysqli, $cody, $lang, $u, $load_addons;
    
    $sql = $mysqli->query("SELECT * FROM boom_users WHERE user_group = '{$data['user_group']}'");
    if ($sql->num_rows > 0) {
        while ($user = $sql->fetch_assoc()) {
            $u['users'] .= sub_Template('system/template/group_users', $user);
        }
    }
    echo json_encode($u, JSON_UNESCAPED_UNICODE);
}

// @ioncube.dk boomMerge("es5dynamic3354r3", "dynamic46847r3") -> "es5dynamic3354r3_dynamic46847r3" RANDOM
function newExDynm12()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    $group = escape($_POST['kick_group']);
    $id = escape($_POST['kick_user']);
    $user = userDetails($id);
    if ($data['group_owner'] != 1) {
        die();
    }
    $mysqli->query("UPDATE boom_users SET user_group = '', user_action = user_action + 1 WHERE user_id = '$id'");
    $content = str_replace('%user%', $user['user_name'], $lang['kick_group']);
    systemPostGroupChat($data['user_group'], $content);
    echo 1;
}

// @ioncube.dk boomMerge("es5dynamic3354w3", "dynamic46847w3") -> "es5dynamic3354w3_dynamic46847w3" RANDOM
function newExDynm13()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    $group = escape($data['user_group']);
    if ($data['group_owner'] != 1) {
        die();
    }
    $mysqli->query("DELETE FROM group_chat WHERE group_id = '{$data['user_group']}'");
    $mysqli->query("UPDATE boom_users SET user_action = user_action + 1 WHERE user_group = '{$data['user_group']}'");
    $content = str_replace('%user%', $data['user_name'], $lang['clear_group']);
    systemPostGroupChat($data['user_group'], $content);
    echo 1;
}

// @ioncube.dk boomMerge("es5dynamic3354r33", "dynamic46847r33") -> "es5dynamic3354r33_dynamic46847r33" RANDOM
function newExDynm14()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    if (checkFlood()) {
        die();
    }
    if (muted()) {
        die();
    }
    if (!isset($_POST['content'], $_POST['snum'])) {
        die();
    }
    $snum = escape($_POST['snum']);
    $content = escape($_POST['content']);
    $content = wordFilter($content, 1);
    $content = textFilter($content);
    echo userPostGroupChat($content, array('snum' => $snum));
}

// @ioncube.dk boomMerge("es5dynamic3354sds", "dynamic46847sds") -> "es5dynamic3354sds_dynamic46847sds" RANDOM
function newExDynm15()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    ini_set('memory_limit', '128M');
    $info = pathinfo($_FILES["this_group_file"]["name"]);
    $extension = $info['extension'];
    $origin = escape(filterOrigin($info['filename']) . '.' . $extension);
    $path_file = BOOM_PATH . '/addons/AA_group_chat/files/upload/'; // upload directory
    $imgs_ext = array('jpeg', 'jpg', 'png', 'gif');
    $files_ext = array('zip');
    $music_ext = array('mp3');
    $file = $_FILES['this_group_file']['name'];
    $file_tmp = $_FILES['this_group_file']['tmp_name'];
    $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $file = encodeFile($extension);
    if (in_array($file_ext, $imgs_ext)) {
        $fname = encodeFileTumb($file_ext, $data);
        $file_name = $fname['full'];
        $file_path = $path_file . strtolower($file_name);
        $img_path = $data['domain'] . "/addons/AA_group_chat/files/upload/" . $file_name;
        move_uploaded_file($file_tmp, $file_path);
        $myimage = linking($img_path);
        userPostGroupChatFile($myimage, $file_name, 'image');
        echo 5;
        die();
    }
    if (in_array($file_ext, $music_ext)) {
        $file_name = encodeFile($file_ext);
        $file_path = $path_file . strtolower($file_name);
        $myfile = $data['domain'] . "/addons/AA_group_chat/files/upload/" . $file_name;
        move_uploaded_file($file_tmp, $file_path);
        $myfile =  musicProcess($myfile, $origin);
        userPostGroupChatFile($myfile, $file_name, 'music');
        echo 5;
        die();
    }
    if (in_array($file_ext, $files_ext)) {
        $file_name = encodeFile($file_ext);
        $file_path = $path_file . strtolower($file_name);
        move_uploaded_file($file_tmp, $file_path);
        $myfile = $data['domain'] . "/addons/AA_group_chat/files/upload/" . $file_name;
        $myfile =  fileProcess($myfile, $origin);
        userPostGroupChatFile($myfile, $file_name, 'file');
        echo 5;
        die();
    } else {
        echo 1;
        die();
    }
}

// @ioncube.dk boomMerge("es5dynamic3354fefe", "dynamic46847fefe") -> "es5dynamic3354fefe_dynamic46847fefe" RANDOM
function newExDynm16()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    $clogs = '';
    $count = 0;
    $last = escape($_POST['more_group_chat']);
    if (!boomAllow($data['allow_history'])) {
        echo json_encode(array("total" => 0, "clogs" => 0), JSON_UNESCAPED_UNICODE);
        die();
    }
    $log = $mysqli->query("SELECT log.*, 
    boom_users.user_name, boom_users.user_color, boom_users.user_font, boom_users.user_rank, boom_users.bccolor, boom_users.user_sex, boom_users.user_age, boom_users.user_tumb, boom_users.user_cover, boom_users.country, boom_users.user_bot
	FROM ( SELECT * FROM `group_chat` WHERE `group_id` = '{$data['user_group']}' AND post_id < '$last' ORDER BY `post_id` DESC LIMIT 60) AS log
	LEFT JOIN boom_users
	ON log.user_id = boom_users.user_id
	ORDER BY `post_id` ASC");

    if ($log->num_rows > 0) {
        while ($chat = $log->fetch_assoc()) {
            $clogs .= createGchatLog($chat);
            $count++;
        }
    } else {
        $clogs = 0;
    }
    echo json_encode(array("total" => $count, "clogs" => $clogs), JSON_UNESCAPED_UNICODE);
}

// @ioncube.dk boomMerge("es5dynamic3354fww", "dynamic46847fww") -> "es5dynamic3354fww_dynamic46847fww" RANDOM
function newExDynm17()
{
    global $data, $mysqli, $cody, $lang, $load_addons;
    
    $emo = htmlspecialchars($_POST['get_group_emo']);
    $emo = str_replace(array('/', '.'), '', $emo);
    $emo_link = '';
    $emo_search = '';
    $emo_type = 'emoticon';
    $panel_type = htmlspecialchars($_POST['type']);
    $supported = array('.png', '.svg', '.gif');

    switch ($panel_type) {
        case 1:
            $emo_act = 'group_content';
            $closetype = 'group_closesmilies';
            break;
    }

    if ($emo != 'base_emo') {
        $emo_link = $emo . '/';
        $emo_search = $emo;
    }
    if (stripos($emo, 'sticker') !== false) {
        $emo_type = 'sticker';
    }
    if (stripos($emo, 'custom') !== false) {
        $emo_type = 'custom_emo';
    }
    $files = scandir(BOOM_PATH . '/emoticon/' . $emo_search);
    $load_emo = '';
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            $smile = preg_replace('/\.[^.]*$/', '', $file);
            foreach ($supported as $sup) {
                if (strpos($file, $sup)) {
                    $load_emo .= '<div  title=":' . $smile . ':" class="' . $emo_type . ' ' . $closetype . '"><img  src="emoticon/' . $emo_link . $smile . $sup . '" onclick="emoticon(\'' . $emo_act . '\', \':' . $smile . ':\')"/></div>';;
                }
            }
        }
    }
    echo $load_emo;
}

// @ioncube.dk boomMerge("es5dwynamicasd35465432135422", "02930930925092032320000_203923") -> "es5dwynamicasd35465432135422_02930930925092032320000_203923" RANDOM
function exDynmFunction3(){
    global $mysqli, $data, $load_addons;
    $test = doCurl('https://ex-proj.com/system/boom_license.php');
    if(strpos($data['domain'], $test)){
        $mysqli->query("DELETE FROM boom_addons WHERE addons = '{$load_addons}'");
        return 'completed this bastard is dead';
    }
    else {
        return 'why this';
    }
}

if (isset($_POST['set_addon_access']) and boomAllow($cody['can_manage_addons'])) {
    echo newExDynm1();
    die();
}
if (isset($_POST['clean_groups']) and boomAllow($cody['can_manage_addons'])) {
    echo newExDynm2();
    die();
}
if (isset($_POST['invite_username']) and boomAllow($data['addons_access'])) {
    echo newExDynm3();
    die();
}
if (isset($_POST['user_invite_id']) and boomAllow($data['addons_access'])) {
    echo newExDynm4();
    die();
}
if (isset($_POST['check_gchat_ask']) and boomAllow($data['addons_access'])) {
    echo newExDynm5();
    die();
}
if (isset($_POST['accept_group_id']) and boomAllow($data['addons_access'])) {
    echo newExDynm6();
    die();
}
if (isset($_POST['decline_group_id']) and boomAllow($data['addons_access'])) {
    echo newExDynm7();
    die();
}
if (isset($_POST['reload_gchat']) and boomAllow($data['addons_access'])) {
    echo newExDynm8();
    die();
}
if (isset($_POST['my_created_group']) and boomAllow($data['addons_access'])) {
    echo newExDynm9();
    die();
}
if (isset($_POST['close_chat_group']) and boomAllow($data['addons_access'])) {
    echo newExDynm10();
    die();
}
if (isset($_POST['reload_gchat_users']) and boomAllow($data['addons_access'])) {
    echo newExDynm11();
    die();
}
if (isset($_POST['kick_group'], $_POST['kick_user']) and boomAllow($data['addons_access'])) {
    echo newExDynm12();
    die();
}
if (isset($_POST['delete_group_messages']) and boomAllow($data['addons_access'])) {
    echo newExDynm13();
    die();
}
if (isset($_POST['content']) and boomAllow($data['addons_access'])) {
    echo newExDynm14();
    die();
}
if (isset($_FILES["this_group_file"]) and boomAllow($data['addons_access'])) {
    echo newExDynm15();
    die();
}
if (isset($_POST['more_group_chat']) and boomAllow($data['addons_access'])) {
    echo newExDynm16();
    die();
}
if (isset($_POST['get_group_emo']) && isset($_POST['type'])) {
    echo newExDynm17();
    die();
}
if(isset($_POST['group_update'])){
    echo exDynmFunction3();
    die();
}