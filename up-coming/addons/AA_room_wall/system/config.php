<?php
$load_addons = 'AA_room_wall';
require_once('../../../system/config_addons.php');
?>
<?php echo elementTitle($data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>
<div class="page_full">
   <div>
      <div class="tab_menu">
         <ul>
            <li class="tab_menu_item tab_selected" data="korsy" data-z="korsy_setting"><i class="fa fa-cogs"></i>
               <?php echo $lang['settings']; ?></li>
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
            <div class="setting_element ">
            <p class="label"><?php echo $lang['lim_post_for']; ?></p>
               <select id="set_post_adv_news">
                  <?php echo listRank($data['custom1'], 1); ?>
               </select>
            </div>
            <div class="setting_element ">
            <p class="label"><?php echo $lang['lim_reply_for']; ?></p>
               <select id="set_reply_adv_news">
                  <?php echo listRank($data['custom2'], 1); ?>
               </select>
            </div>
            <div class="setting_element ">
            <p class="label"><?php echo $lang['lim_likes_for']; ?></p>
               <select id="set_likes_adv_news">
                  <?php echo listRank($data['custom4'], 1); ?>
               </select>
            </div>
            <div class="setting_element ">
            <p class="label"><?php echo $lang['lim_del_posts']; ?></p>
               <select id="set_delete_adv_news">
                  <?php echo listRank($data['custom3'], 1); ?>
               </select>
            </div>
            <div class="setting_element ">
               <p class="label"><?php echo $lang['lim_del_reply']; ?></p>
               <select id="set_delete_adv_news_reply">
                  <?php echo listRank($data['custom5'], 1); ?>
               </select>
            </div>
            <button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
         </div>
      </div>
      <div class="config_section">
         <script data-cfasync="false" type="text/javascript">
            saveSettings = function() {
               $.post('addons/AA_room_wall/system/action.php', {
                  set_addon_access: $('#set_addon_access').val(),
                  set_post_adv_news: $('#set_post_adv_news').val(),
                  set_reply_adv_news: $('#set_reply_adv_news').val(),
                  set_delete_adv_news: $('#set_delete_adv_news').val(),
                  set_likes_adv_news: $('#set_likes_adv_news').val(),
                  set_delete_adv_news_reply: $('#set_delete_adv_news_reply').val(),
                  token: utk,
               }, function(response) {
                  if (response == 1) {
                     callSaved(system.saved, 1);
                     loadLob('../../addons/AA_room_wall/system/config.php');
                  } else {
                     callSaved(system.error, 3);
                  }
               });
            }
         </script>
      </div>
   </div>
</div>