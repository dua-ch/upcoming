<?php

/**
 * Codytalk
 * @package Codytalk
 * @author www.codytalk.com
 * @copyright 2022
 * @terms any use of this script without a legal license is prohibited
 * all the content of CodyTalk is the propriety of Mr.Logger and Cannot be 
 * used for another project.
 */

$load_addons = 'topic';
require('../../../system/config_addons.php');

if (!boomAllow($data['addons_access'])) {
	die();
} ?>

<div class="pad20">
	<div class="color_choices" data="<?php echo $data['bccolor']; ?>">
		<div class="reg_menu_container">
			<div class="reg_menu">
				<ul>
					<li class="reg_menu_item reg_selected" data="broadcast_list" data-z="public_announcement"><?php echo $lang['topic']; ?></li>
				</ul>
			</div>
		</div>

		<div id="broadcast_list">

			<div id="public_announcement" class="reg_zone vpad5">
				<div class="setting_element ">
					<p class="label"><?php echo $lang['topic_room']; ?></p>
					<select id="set_topic_room" onchange="populateRoomTopic(this);">
						<?php echo roomSelect($data['user_roomid']); ?>
					</select>
				</div>
				<div class="setting_element">
					<p class="label"><?php echo $lang['topic_content']; ?></p>
					<textarea id="set_topic_msg" maxlength="500" class="large_textarea full_textarea" type="text" required />
				</div>

				<div class="tpad5">
					<button onclick="sendTopicMessage();" class="reg_button ok_btn"><?php echo $lang['save']; ?></button>
					<button class="cancel_modal reg_button default_btn"><?php echo $lang['cancel']; ?></button>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<script data-cfasync="false">
    $(document).ready(function() {

		var user_room_id = <?php echo $data['user_roomid']; ?>;

        fetchRoomTopic = function(id) {
            $.post('addons/topic/system/action.php', {
				fetch_room_topic: 1,
                room_id: id,
                token: utk,
            }, function(response) {
                $('#set_topic_msg').html(response);
            });
        }

		populateRoomTopic = function(t) {
			var room_id = $(t).val();
			fetchRoomTopic(room_id);
        }

		fetchRoomTopic(user_room_id);

    });

</script>