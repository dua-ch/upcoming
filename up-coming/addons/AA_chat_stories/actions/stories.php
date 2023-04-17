<?php
$load_addons = 'AA_chat_stories';
require_once('../../../system/config_addons.php');

if (!boomAllow($data['addons_access'])) {
    die();
}
$story_time = strtotime('-1 day', time());
$stories = [];
$users_list = $mysqli->query("SELECT * FROM `stories` where `story_time` > '{$story_time}' order by `story_id` ASC");
if ($users_list->num_rows > 0) {
    $users = [];
    while ($list = $users_list->fetch_assoc()) {
        $users['u' . $list['user_id']] = $list;
    }
    foreach ($users as $key => $value) {
        $stories_list = $mysqli->query("SELECT * FROM `stories` WHERE `user_id`='{$value['user_id']}' and `story_time` > '{$story_time}' order by `story_id` ASC");
        if ($stories_list->num_rows > 0) {
            $user_stories = [];
            while ($list = $stories_list->fetch_assoc()) { 
                $story['story_id'] = $list['story_id'];
                $story['story_source'] = $list['story_source'];
                $story['story_description'] = $list['story_description'];
                $story['story_type'] = $list['story_type'];
                $story['story_time'] = $list['story_time'];
                $story_seen = json_decode($list['story_seen'], true);
                $story['story_seen'] = is_array($story_seen) ? count($story_seen) : 0;
                array_push($user_stories, $story);
            }
        }
        $story_seen = in_array($data['user_id'], json_decode($value['story_seen'], true)) ? 'true' : 'false';
        $user = userDetails($value['user_id']);

        $user_story_data = [
            'user_photo' => myavatar($user['user_tumb']),
            'user_name' => '<span class="' . $user['user_color'] . '">' . $user['user_name'] . '</span>',
            'user_id' => $user['user_id'],
            'last_updated' => $value['story_time'], 'story_seen' => $story_seen, 'story' => $user_stories
        ];
        array_push($stories, $user_story_data);
    }
}
echo json_encode(['stories' => $stories, 'stories_count' => count($stories)]);
