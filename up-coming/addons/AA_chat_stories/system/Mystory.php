<?php
$load_addons = 'AA_chat_stories';
require_once('../../../system/config_addons.php');
$story_link = '' . $data["domain"] . '/addons/AA_chat_stories/actions/upload/';
$my_id = escape($data['user_id']);
$story_list = '';
$story = $mysqli->query("SELECT * FROM stories WHERE user_id = '$my_id'");
if ($story->num_rows >= 0) {
	while ($find_story = $story->fetch_assoc()) {
		if (empty($find_story['story_description'])) {
			$description = 'Empty..';
		} else {
			$description = $find_story['story_description'];
		}
		if($find_story['story_type'] == 'image'){
			$type = '<img class="fancybox" href="' . $story_link . '' . $find_story['story_source'] . '" src="' . $story_link . '' . $find_story['story_source'] . '">';
		}
		else {
			$type = '<video width="70" height="70" controls><source src="' . $story_link . '' . $find_story['story_source'] . '" type="video/mp4"></video>';
		}
		$user = userRoomDetails($find_story['user_id']);
		$story_list .= '<div class="gift-responsive" data="">
				<div class="gift-container">
					'. $type .'
					<div class="gift-desc">' . $description . '</div>
					<button style="background: #6ed4e5;
					color: #0a0870;
					border: 1px solid #708aff;border-radius: 0;margin: 2px 0;" class="info_ps" onclick="whoSeeMine(' . $find_story['story_id'] . ')"> Viewers <i class="fa fa-times"></i></button>
					<br>
					<button style="border-radius: 0;" class="info_ps" onclick="delStoryUser(' . $find_story['story_id'] . ')"> Delete <i class="fa fa-times"></i></button>
				</div>
				</div>';
	}
}
if ($story_list == '') {
	$story_list .= emptyZone('You have not posted anything');
}
?>
<script data-cfasync="false">
	boomAddCss('addons/AA_chat_stories/files/story.css');
</script>
<div class="page_full">
	<br>
	<?php echo $story_list; ?>
</div>