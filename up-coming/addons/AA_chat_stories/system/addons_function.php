<?php
function fe_Template($getpage, $boom = ''){
	global $data, $lang, $mysqli, $cody;
	$page = BOOM_PATH . '/addons/AA_chat_stories/actions/' . $getpage . '.php';
	$structure = '';
	ob_start();
	require($page);
	$structure = ob_get_contents();
	ob_end_clean();
	return $structure;
}
function main_Template($getpage, $boom = ''){
	global $data, $lang, $mysqli, $cody;
	$page = BOOM_PATH . '/addons/AA_chat_stories/' . $getpage . '.php';
	$structure = '';
	ob_start();
	require($page);
	$structure = ob_get_contents();
	ob_end_clean();
	return $structure;
}
function storyLiSt(){
	global $data, $lang, $mysqli;
	$story_link = '' . $data["domain"] . '/addons/AA_chat_stories/actions/upload/';
	$story_list = '';
	$story = $mysqli->query("SELECT * FROM stories ORDER BY story_id");
	if ($story->num_rows >= 0) {
		while ($find_story = $story->fetch_assoc()) {
			if (empty($find_story['story_description'])) {
				$description = 'No details';
			} else {
				$description = $find_story['story_description'];
			}
			$user = userRoomDetails($find_story['user_id']);
			$story_list .= '<div class="gift-responsive delthisstory' . $find_story['story_id'] . '" data="">
				<div class="gift-container">
					<img style="max-height: 100px;margin: 0 auto;display: block;" src="' . $story_link . '' . $find_story['story_source'] . '">
					<div class="gift-desc">' . $user['user_name'] . '</div>
					<p style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;display: table-cell;max-width: 195px;">' . $description . '</p>
					<p style="cursor: pointer;" class="info_ps" onclick="delStoryadmin(' . $find_story['story_id'] . ')"> Delete <i class="fa fa-times"></i></p>
				</div>
				</div>';
		}
	}
	if ($story_list == '') {
		$story_list .= emptyZone('No Story');
	}
	return $story_list;
}
function storyDetails($id){
	global $mysqli;
	$user = array();
	$getuser = $mysqli->query("SELECT * FROM stories WHERE story_id = '$id'");
	if($getuser->num_rows > 0){
		$user = $getuser->fetch_assoc();
	}
	return $user;
}