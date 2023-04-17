<?php
$load_addons = 'contact_us';
require_once('../../../system/config_addons.php');

if(!boomAllow($cody['can_manage_addons'])){
	die();
}

?>
<?php echo elementTitle($data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>
<div class="page_full">
	<div class="page_element">
		<div class="config_section">
			<div class="boom_form">
				<div class="setting_element ">
					<p class="label"><?php echo $lang['limit_feature']; ?></p>
					<select id="set_contact_access">
						<?php echo listRank($data['addons_access'], 1); ?>
					</select>
				</div>
				<div class="setting_element">
					<p class="label"><?php echo $lang['contact_reply']; ?></p>
					<input id="set_contact_email" class="full_input" value="<?php echo $data['custom1']; ?>" type="text"/>
				</div>
				<div class="setting_element ">
					<p class="label"><?php echo $lang['max_contact_hour']; ?></p>
					<select id="set_contact_max">
						<?php echo optionCount($data['custom2'], 1, 20, 1); ?>
					</select>
				</div>
			</div>
			<button onclick="saveContactUs();" type="button" class="reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
		</div>
		<div class="config_section">
			<script data-cfasync="false">
				saveContactUs = function(){
					$.post('addons/contact_us/system/action.php', {
						save: 1,
						set_contact_email: $('#set_contact_email').val(),
						set_contact_access: $('#set_contact_access').val(),
						set_contact_max: $('#set_contact_max').val(),
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
