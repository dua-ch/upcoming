<?php
$load_addons = 'AA_group_chat';
require_once('../../../system/config_addons.php');
$myGroup = $data['user_group'];
if($myGroup != '' AND $data['group_owner'] == 0){
   echo 2;
   die();
}
?>
<div class="pad_box">
   <div class="setting_element">
      <p class="label">Write user name to invite for group chat</p>
      <div class="admin_search ignore_with_blocker">
         <div class="admin_input bcell">
            <input class="full_input" id="username_invite" type="text">
         </div>
         <div id="search_invite_gchat" class="admin_search_btn default_btn">
            <i class="fa fa-search" aria-hidden="true"></i>
         </div>
      </div>
      <div class="tmargin10 box_height" id="invite_search_res"></div>
   </div>
   <?php if($myGroup == ''){ ?>
   <button id="start_gchat" style="width: 100%;display: none;" class="reg_button theme_btn"><i class="fa fa-comments"></i> Start group chat</button>
   <?php } ?>
</div>
<script data-cfasync="false" type="text/javascript">
   $(document).on('click', '#search_invite_gchat', function() {
      validSearch = $('#username_invite').val().length;
      if (validSearch >= 1) {
         $.post('addons/AA_group_chat/system/action.php', {
            invite_username: $('#username_invite').val(),
            token: utk,
         }, function(response) {
            $('#invite_search_res').html(response);
         });
      } else {
         callSaved(system.tooShort, 3);
      }
   });
</script>