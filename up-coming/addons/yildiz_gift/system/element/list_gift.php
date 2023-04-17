<?php
/*===============================================*
 |                                               |
 |   Development      :  [AMEER_PS]              |
 |                                               |
 |   addon name       :  [YILDIZ_GIFT]           |
 |                                               |
 |   Version          :  [1.0]                   |
 |                                               |
 |   Codychat version :  [CODYCHAT 3.6]          |
 |                                               |
 *===============================================*/
?>
<div class="sub_list_item gift<?php echo $boom['id']; ?>">
	<div class="sub_list_content hpad5">
		<?php echo $boom['gift_name']; ?>
	</div>
	<div onclick="editgift(<?php echo $boom['id']; ?>);" class="sub_list_option">
		<i class="fa fa-edit"></i>
	</div>
	<div onclick="deletegift(<?php echo $boom['id']; ?>);" class="sub_list_option">
		<i class="fa fa-times"></i>
	</div>
</div>