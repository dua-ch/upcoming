<?php
$load_addons = 'user_search';
require_once('../../../system/config_addons.php');

if(!boomAllow($cody['can_manage_addons'])){
	die();
}

?>
<?php echo elementTitle($data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>
<div class="page_full">
	<div class="page_element">
		<div class="config_section">
			<div class="setting_element">
				<p class="label"><?php echo $lang['limit_feature']; ?></p>
				<select id="set_user_search_access">
					<?php echo listRank($data['addons_access'], 1); ?>
				</select>
			</div>
			<div class="setting_element">
				<p class="label"><?php echo $lang['evolve_max_result']; ?></p>
				<select id="set_max_result">
					<?php echo optionCount($data['custom1'], 10, 300, 10, ''); ?>
				</select>
			</div>
			<div class="setting_element">
				<p class="label"><?php echo $lang['evolve_guest']; ?></p>
				<select id="set_show_guest">
					<?php echo yesNo($data['custom2']); ?>
				</select>
			</div>
			<div class="tpad10">
				<button id="save_user_search" onclick="savsEvUserSearch();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
			</div>
		</div>
	</div>
		<div class="config_section">
			<script data-cfasync="false">
				savsEvUserSearch = function(){
					$.post('addons/user_search/system/action.php', {
						save: 1,
						set_user_search: $('#set_user_search_access').val(),
						set_max_result: $('#set_max_result').val(),
						set_show_guest: $('#set_show_guest').val(),
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
