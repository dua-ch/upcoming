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
require_once('../../../system/config_addons.php');

if (!boomAllow(10)) {
	die();
}

echo elementTitle($data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>

<div class="page_full">
	<div>
		<div class="tab_menu">
			<ul>
				<li class="tab_menu_item tab_selected" onclick="tabZone(this, 'broadcast_setting', 'broadcast');"><i class="fa fa-cogs"></i> <?php echo $lang['settings']; ?></li>
			</ul>
		</div>
	</div>
	<div class="page_element">
		<div class="tpad15">
			<div id="broadcast">
				<div id="broadcast_setting" class="tab_zone">
					<div class="setting_element ">
						<p class="label"><?php echo $lang['limit_feature']; ?></p>
						<select id="set_topic_addon_access">
							<?php echo listRank($data['addons_access'], 1); ?>
						</select>
					</div>
					<button onclick="saveTopicAddonSettings();" type="button" class="tmargin10 reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
				</div>
			</div>
		</div>
		<div class="config_section">
			<script data-cfasync="false" type="text/javascript">
				saveTopicAddonSettings = function() {
					$.post('addons/topic/system/action.php', {
						addons_access: $('#set_topic_addon_access').val(),
						change_settings :1,
						token: utk,
					}, function(response) {
						if (response == 5) {
							callSaved(system.saved, 1);
						} else {
							callSaved(system.error, 3);
						}
					});
				}
			</script>
		</div>
	</div>
</div>