-<?php
/*===============================================*
 |                                               |
 |   Development      :  [AMEER_PS]              |
 |                                               |
 |   addon name       :  [LIVE_STREAM]           |
 |                                               |
 |   Version          :  [1.0]                   |
 |                                               |
 |   Codychat version :  [CODYCHAT 3.6]          |
 |                                               |
 *===============================================*/
$load_addons = 'AA_live_stream';
require_once('../../../system/config_addons.php');

if(!boomAllow(10)){
	die();
}

?>
<style>
</style>
<?php echo elementTitle('puzzle-piece', $data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>
<div class="page_full">
	<div>
		<div class="tab_menu">
			<ul>
				<li class="tab_menu_item tab_selected" onclick="tabZone(this, 'add_user_setting', 'AA_live_stream');"><i class="fa fa-cogs"></i> <?php echo $lang['settings']; ?></li>
			</ul>
		</div>
	</div>
	<div class="page_element">
		<div class="tpad15">
			<div id="AA_live_stream">
				<div id="add_user_setting" class="tab_zone">
					<div class="setting_element ">
						<p class="label"><?php echo $lang['limit_feature']; ?></p>
						<select id="set_addon_access">
							<?php echo listRank($data['addons_access'], 1); ?>
						</select>
					</div>
					<div class="setting_element">
				     <p class="label"><?php echo $lang['live_name_room']; ?></p>
				      <input id="set_room_name" value="<?php echo $data['custom1']; ?>" class="full_input"  type="text" />
			        </div>
					<div class="setting_element">
						<p class="label"><?php echo $lang['live_user_list']; ?></p>
						<select id="set_user_list">
							<?php echo onOff($data['custom2'], 1); ?>
						</select>
					</div>
					<div class="setting_element ">
						<p class="label"><?php echo $lang['limit_Show']; ?></p>
						<select id="set_show_live_access">
							<?php echo listRank($data['custom3'], 1); ?>
						</select>
					</div>
					<button onclick="saveSettingsLive();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
				</div>
			</div>
		</div>
		<div class="config_section">
			<script data-cfasync="false" type="text/javascript">
				saveSettingsLive = function(){
					$.post('addons/AA_live_stream/system/action.php', {
						set_addon_access: $('#set_addon_access').val(),
						set_room_name: $('#set_room_name').val(),
						set_user_list: $('#set_user_list').val(),
						set_show_live_access: $('#set_show_live_access').val(),
						token: utk,
						}, function(response) {
							if(response == 1){
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
