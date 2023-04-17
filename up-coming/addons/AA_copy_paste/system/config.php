<?php
$load_addons = 'AA_copy_paste';
require_once('../../../system/config_addons.php');

if(!boomAllow($cody['can_manage_addons'])){
	die();
}
?>
<?php echo elementTitle($data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>
<div class="page_full">
   <div class="page_element">
      <div class="boom_form">
         <!--start-->
         <div class="setting_element ">
            <p class="label">منع النسخ واللصق والكليك يمين للماوس</p>
            <select id="allow_copy">
               <option <?php echo selCurrent($data['custom1'], 0); ?> value="0"><?php echo $lang['off']; ?></option>
               <option <?php echo selCurrent($data['custom1'], 1); ?> value="1"><?php echo $lang['on']; ?></option>
            </select>
         </div>
         <div class="setting_element ">
            <p class="label">المنع للرتب الاقل من</p>
            <select id="allow_copy_for">
               <?php echo listRank($data['custom2'], 1); ?>
            </select>
         </div>
         <!--end-->
      </div>
      <button type="button" onclick="saveSettings();" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
   </div>
</div>
<div class="config_section">
   <script data-cfasync="false">
      saveSettings = function() {
         $.post('addons/AA_copy_paste/system/action.php', {
            allow_copy: $('#allow_copy').val(),
            allow_copy_for: $('#allow_copy_for').val(),
            token: utk,
         }, function(response) {
            if (response == 1) {
               callSaved(system.saved, 1);
            } else {
               callSaved(system.error, 3);
            }

         });
      }
   </script>
</div>