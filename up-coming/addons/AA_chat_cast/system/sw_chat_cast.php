<?php
$load_addons = 'AA_chat_cast';
require_once('../../../system/config_addons.php');
if (!boomAllow($data['addons_access'])) {
   die();
}
?>
<div class="pad_box">
   <div class="color_choices" data="bgcolor4">
      <div class="reg_menu_container">
         <div class="reg_menu">
            <ul>
               <li class="reg_menu_item reg_selected" data="staff_list" data-z="owner">اعلان للجميع</li>
               <li class="reg_menu_item" data="staff_list" data-z="superadmin">اعلان اداري</li>
			   <li class="reg_menu_item" data="staff_list" data-z="hide">اعلان مخفي</li>
            </ul>
         </div>
      </div>
      <div id="staff_list">
         <div id="owner" class="reg_zone vpad5">
            <div id="container_user">
               <div id="usersnames">
                  <div class="online_user">
                     <div class="boom_form">
                        <p class="label">رسالة الاعلان</p>
                        <textarea class="full_textarea" id="send_cast_all"></textarea>
                     </div>
                     <button onclick="sendCastAll();" class="reg_button theme_btn"><i class="fa fa-save listing_icon"></i> Send</button>
                  </div>
               </div>
            </div>
            <div class="clear"></div>
         </div>
		 <div id="superadmin" class="reg_zone vpad5 hide_zone">
            <div id="container_user">
               <div id="usersnames">
                  <div class="online_user">
                     <div class="boom_form">
                        <p class="label">رسالة الاعلان</p>
                        <textarea class="full_textarea" id="send_cast_staff"></textarea>
                     </div>
                     <button onclick="sendCastStaff();" class="reg_button theme_btn"><i class="fa fa-save listing_icon"></i> Send</button>
                  </div>
               </div>
            </div>
            <div class="clear"></div>
         </div>
		 <div id="hide" class="reg_zone vpad5 hide_zone">
            <div id="container_user">
               <div id="usersnames">
                  <div class="online_user">
                     <div class="boom_form">
                        <p class="label">رسالة الاعلان</p>
                        <textarea class="full_textarea" id="send_cast_hide"></textarea>
                     </div>
                     <button onclick="sendCastHide();" class="reg_button theme_btn"><i class="fa fa-save listing_icon"></i> Send</button>
                  </div>
               </div>
            </div>
            <div class="clear"></div>
         </div>
      </div>
   </div>
   <div class="clear"></div>
</div>