<?php
$load_addons = 'AA_staff_list';
require_once('../../../system/config_addons.php');
?>
<div class="pad_box">
   <div class="color_choices" data="bgcolor4">
      <div class="reg_menu_container">
         <div class="reg_menu">
            <ul>
               <li class="reg_menu_item reg_selected" data="staff_list" data-z="owner">Owners</li>
               <li class="reg_menu_item" data="staff_list" data-z="superadmin">SuperAdmins</li>
               <li class="reg_menu_item" data="staff_list" data-z="admin">Admins</li>
               <li class="reg_menu_item" data="staff_list" data-z="mod">Directores</li>
               <li class="reg_menu_item" data="staff_list" data-z="mods">Moderators</li>
               <li class="reg_menu_item" data="staff_list" data-z="modss">Premium</li>
            </ul>
         </div>
      </div>
      <div id="staff_list">
         <div id="owner" class="reg_zone vpad5">
            <div id="container_user">
               <div id="usersnames">
                  <div class="online_user">
                    <?php echo loadStaffList(99); ?>
                  </div>
               </div>
            </div>
            <div class="clear"></div>
         </div>
         <div id="superadmin" class="reg_zone vpad5 hide_zone">
            <div id="container_user">
               <div id="usersnames">
                  <div class="online_user">
                     <?php echo loadStaffList(98); ?>
                  </div>
               </div>
            </div>
            <div class="clear"></div>
         </div>
         <div id="admin" class="reg_zone vpad5 hide_zone">
            <div id="container_user">
               <div id="usersnames">
                  <div class="online_user">
                     <?php echo loadStaffList(97); ?>
                  </div>
               </div>
            </div>
            <div class="clear"></div>
         </div>
         <div id="mod" class="reg_zone vpad5 hide_zone">
            <div id="container_user">
               <div id="usersnames">
                  <div class="online_user">
                     <?php echo loadStaffList(96); ?>
                  </div>
               </div>
            </div>
            <div class="clear"></div>
         </div>
		 <div id="mods" class="reg_zone vpad5 hide_zone">
            <div id="container_user">
               <div id="usersnames">
                  <div class="online_user">
                     <?php echo loadStaffList(95); ?>
                  </div>
               </div>
            </div>
            <div class="clear"></div>
         </div>
		 <div id="modss" class="reg_zone vpad5 hide_zone">
            <div id="container_user">
               <div id="usersnames">
                  <div class="online_user">
                     <?php echo loadStaffList(89); ?>
                  </div>
               </div>
            </div>
            <div class="clear"></div>
         </div>
      </div>
   </div>
   <div class="clear"></div>
</div>