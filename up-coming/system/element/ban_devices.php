<div class="sub_list_item console_data_logs" id="bandevice<?php echo $boom['id']; ?>" value="<?php echo $boom['id']; ?>">
	<div class="sub_list_cell">
		<p style="font-size: 13px;padding: 3px 0;max-width: 100%;overflow: hidden;" class="text_reg">
			<b class="bold" style="color: #337195;"><i class="fa fa-desktop"></i> نوع الجهاز : </b> <?php echo $boom['device']; ?>
		</p>
		<p style="font-size: 13px;padding: 3px 0;max-width: 100%;overflow: hidden;" class="text_reg">
			<b class="bold" style="color: #337195;"><i class="fa fa-cogs"></i> إصدار الجهاز : </b> <?php echo $boom['dversion']; ?>
		</p>
		<p style="font-size: 13px;padding: 3px 0;max-width: 100%;overflow: hidden;" class="text_reg">
			<b class="bold" style="color: #337195;"><i class="fa fa-key"></i> شفرة الجهاز : </b> <?php echo $boom['dcode']; ?>
		</p>
		<p style="font-size: 13px;padding: 3px 0;max-width: 100%;overflow: hidden;" class="text_reg">
			<b class="bold" style="color: #337195;"><i class="fa fa-users"></i> حسابات بنفس الشفرة : </b> <?php echo sameAccountDCAdmin($boom['dcode']); ?>
		</p>
	</div>
	<div style="width:34px;" onclick="removeBannedDevice(<?php echo $boom['id']; ?>);" class="sub_list_option">
		<i class="fa fa-times edit_btn error"></i>
	</div>
</div>