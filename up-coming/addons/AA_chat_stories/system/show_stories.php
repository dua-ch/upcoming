<?php
$load_addons = 'AA_chat_stories';
require_once('../../../system/config_addons.php');
$mysqli->query("UPDATE boom_users SET user_story = '" . time() . "' WHERE user_id = '{$data['user_id']}'");
?>
<div style="padding: 5px;" id="stories" class="stories user-icon carousel snapgram"></div>
<script>
    updateStoryLog();
    getStories();
</script>