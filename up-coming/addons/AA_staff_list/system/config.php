<?php
   $load_addons = 'AA_staff_list';
   require_once('../../../system/config_addons.php'); 
 ?>
<?php echo elementTitle($data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>
<div class="page_full">
   <div>
      <div class="tab_menu">
         <ul>
            <li class="tab_menu_item tab_selected" data="korsy" data-z="korsy_setting"><i class="fa fa-cogs"></i> <?php echo $lang['settings']; ?></li>
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
            <button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
         </div>
      </div>
      <div class="config_section">
         <script data-cfasync="false" type="text/javascript">
            saveSettings = function () {
            	$.post('addons/AA_staff_list/system/action.php', {
            		set_addon_access: $('#set_addon_access').val(),
            		token: utk,
            	}, function (response) {
            		if (response == 1) {
            			callSaved('تم حفظ الاعدادات الجديدة', 1);
            		} else {
            			callSaved(system.error, 3);
            		}
            	});
            }
         </script>
      </div>
   </div>
</div>