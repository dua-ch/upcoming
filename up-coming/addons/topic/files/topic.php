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

require(addonsLang('topic'));
if (boomAllow($addons['addons_access'])) { ?>
	<script data-cfasync="false">
		sendTopicMessage = function() {
			var set_topic_msg = $('#set_topic_msg').val().replace(/\r\n|\r|\n/g, " <br/>");
			if (set_topic_msg == '') {
				callSaved(system.emptyField, 3);
				event.preventDefault();
			} else if (/^\s+$/.test(set_topic_msg)) {
				callSaved(system.emptyField, 3);
				event.preventDefault();
			} else {
				$.post('addons/topic/system/action.php', {
					room_id: $('#set_topic_room').val(),
					change_topic:1,
					topic_text: set_topic_msg,
					token: utk
				}, function(response) {
					if (response == 1) {
						callSaved(system.saved, 1);
					} 
					else if(response == 2) {
						callSaved("Too long text", 3);
					} else {
						callSaved(system.error, 3);
					}
				});
			}
		}
		$(document).ready(function() {

			openTopicAddonBox = function() {
				$.post('addons/topic/system/change_topic.php', {
					token: utk,
				}, function(response) {
					showModal(response, 500);
				});
			}
			appLeftMenu('envelope', '<?php echo $lang['topic']; ?>', 'openTopicAddonBox();');
		});
	</script>

<?php } ?>