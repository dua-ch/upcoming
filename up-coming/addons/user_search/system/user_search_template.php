<?php
/** 
* Evolve user search 
* 
* @package Evolve user search  
* @author sadcookie.com
* @copyright 2020 
* @terms any use of this script without a legal license is prohibited
* all the content of this file is the propriety of sadcookie.com made to work with ®CodyChat and cannot be 
* copied amd use for another project.
*/
$load_addons = 'user_search';
require('../../../system/config_addons.php');
?>

<div id="ev_search_container" class="panel_wrap boom_keep">
	<div class="bpad5">
		<p class="label"><?php echo $lang['evolve_search_user']; ?></p>
		<input id="ev_search_users" name="evolve_users" placeholder="<?php echo $lang['evolve_type_username'] ?>" class="evolve_users full_input" value="" type="text" autocomplete="off" />
	</div>
	<div class="bmargin10 form_split">
		<div class="form_left">
			<p class="label"><?php echo $lang['evolve_type']; ?></p>
			<select id="ev_search_type">
				<option value="1"><?php echo $lang['all']?></option>
				<option value="2"><?php echo $lang['female']?></option>
				<option value="3"><?php echo $lang['male']?></option>
			</select>
		</div>
		<div class="form_right">
			<p class="label"><?php echo $lang['evolve_order']; ?></p>
			<select id="ev_search_order">
				<option value="0"><?php echo $lang['evolve_random']; ?></option>
				<option value="1"><?php echo $lang['evolve_new']; ?></option>
				<option value="2"><?php echo $lang['evolve_active']; ?></option>
				<option value="3"><?php echo $lang['evolve_name']; ?></option>
				<option value="4"><?php echo $lang['evolve_rank']; ?></option>
			</select>
		</div>
		<div class="clear"></div>
	</div>
	<div class="tmargin15" id="ev_user_results">
	</div>
</div>