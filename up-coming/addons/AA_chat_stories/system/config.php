<?php
$load_addons = 'AA_chat_stories';
require_once('../../../system/config_addons.php');
if (!boomAllow(10)) {
	die();
}
?>
<?php echo elementTitle($data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>
<div class="page_full">
	<div>
		<div class="tab_menu">
			<ul>
				<li class="tab_menu_item tab_selected" data="korsy" data-z="korsy_setting"><i class="fa fa-cogs"></i> <?php echo $lang['settings']; ?></li>
				<li class="tab_menu_item" data="korsy" data-z="control"><i class="fa fa-cogs"></i> <?php echo $lang['control_story']; ?></li>
			</ul>
		</div>
	</div>
	<div class="page_element">
		<div id="korsy" class="tpad15">
			<div id="korsy_setting" class="tab_zone">
				<div class="setting_element ">
					<p class="label"><?php echo $lang['limit_feature']; ?></p>
					<select id="set_addon_access">
						<?php echo listRank($data['addons_access'], 1); ?>
					</select>
				</div>
				<button onclick="adminstoryRank();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
			</div>
			<div id="control" class="tab_zone hide_zone">
				<div class="page_full">
					<?php echo storyLiSt(); ?>
				</div>
			</div>
		</div>
		<div class="config_section">
			<script data-cfasync="false" type="text/javascript">
				$(document).ready(function() {
					boomAddCss('addons/AA_chat_stories/files/story.css');
				});
				delStoryadmin = function(idn) {
					$.post('addons/AA_chat_stories/system/action.php', {
						Storyadmin: '1',
						idn: idn,
						token: utk,
					}, function(response) {
						if (response == 1) {
							callSaved(system.saved, 1);
							$('.delthisstory' + idn).remove();
						} else {
							callSaved(system.error, 3);
						}

					});
				}
				adminstoryRank = function() {
					$.post('addons/AA_chat_stories/system/action.php', {
						set_addon_access: $('#set_addon_access').val(),
						token: utk,
					}, function(response) {
						if (response == 1) {
							callSaved(system.saved, 1);
							loadLob('../../addons/AA_chat_stories/system/config.php');
						} else {
							callSaved(system.error, 3);
						}
					});
				}
			</script>
		</div>
	</div>
</div>