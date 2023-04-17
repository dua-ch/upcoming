<?php
$load_addons = 'paintit';
require_once('../../../system/config_addons.php');

if(!boomAllow($cody['can_manage_addons'])){
	die();
}

?>
<style>
</style>
<?php echo elementTitle($data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>
<div class="page_full">
	<div>
		<div class="tab_menu">
			<ul>
				<li class="tab_menu_item tab_selected" onclick="tabZone(this, 'paint_setting', 'paint');"><?php echo $lang['settings']; ?></li>
			</ul>
		</div>
	</div>
	<div class="page_element">
		<div class="tpad15">
			<div id="paint">
				<div id="paint_setting" class="tab_zone">
					<div class="setting_element ">
						<p class="label"><?php echo $lang['limit_feature']; ?></p>
						<select id="set_paint_access">
							<?php echo listRank($data['addons_access'], 1); ?>
						</select>
					</div>
					<div class="setting_element ">
						<p class="label"><?php echo $lang['paint_main']; ?></p>
						<select id="set_paint_main">
							<?php echo onOff($data['custom1']); ?>
						</select>
					</div>
					<div class="setting_element ">
						<p class="label"><?php echo $lang['paint_private']; ?></p>
						<select id="set_paint_private">
							<?php echo onOff($data['custom2']); ?>
						</select>
					</div>
					<button onclick="saveSettings();" type="button" class="tmargin10 reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
				</div>
			</div>
		</div>
		<div class="config_section">
			<script data-cfasync="false" type="text/javascript">
				saveSettings = function(){
					$.post('addons/paintit/system/action.php', {
						set_paint_access: $('#set_paint_access').val(),
						set_paint_main: $('#set_paint_main').val(),
						set_paint_private: $('#set_paint_private').val(),
						token: utk,
						}, function(response) {
							if(response == 5){
								callSaved(system.saved, 1);
							}
							else{
								callSaved(system.error, 3);
							}
					});	
				}
			</script>
		</div>
	</div>
</div>
