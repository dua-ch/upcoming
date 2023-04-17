<?php
/**
* Codychat
*
* @package Codychat
* @author www.boomcoding.com
* @copyright 2020
* @terms any use of this script without a legal license is prohibited
* all the content of Codychat is the propriety of BoomCoding and Cannot be 
* used for another project.
*/
require_once('../config_session.php');
?>

<div class="vpad15 hpad10">
	<?php if(canRoom()){ ?>
		<button  class="thin_button rounded_button theme_btn" onclick="openAddRoom();"><i class="fa fa-plus"></i> <?php echo $lang['add_room']; ?></button>
	<?php } ?>
	<?php if (boomAllow(100)) { ?>
			<span class="error">Online: <?php echo calUsersInChat(); ?></span>
	<?php } ?>
</div>

<div id="container_room">
	<?php echo getRoomList('list'); ?>
</div>