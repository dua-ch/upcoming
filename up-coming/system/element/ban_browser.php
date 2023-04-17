<div class="sub_list_item console_data_logs" id="banbrowser<?php echo $boom['id']; ?>" value="<?php echo $boom['id']; ?>">
	<div class="sub_list_cell">
		<p style="font-size: 13px;padding: 3px 0;max-width: 100%;overflow: hidden;" class="text_reg">
			<b class="bold" style="color: #337195;"><i class="fa fa-desktop"></i> المتصفح : </b> <?php echo $boom['browser']; ?>
		</p>
		<p style="font-size: 13px;padding: 3px 0;max-width: 100%;overflow: hidden;" class="text_reg">
			<b class="bold" style="color: #337195;"><i class="fa fa-cogs"></i> إصدار المتصفح : </b> <?php echo $boom['bversion']; ?>
		</p>
	</div>
	<div style="width:34px;" onclick="removeBannedBrowser(<?php echo $boom['id']; ?>);" class="sub_list_option">
		<i class="fa fa-times edit_btn error"></i>
	</div>
</div>