<div class="sub_list_item console_data_logs" id="bancountry<?php echo $boom['id']; ?>" value="<?php echo $boom['id']; ?>">
	<div class="sub_list_cell">
		<p style="font-size: 15px;padding: 3px 0;max-width: 100%;overflow: hidden;" class="text_reg">
			<b class="bold" style="color: #337195;"><i class="fa fa-globe"></i> الدولة : </b> <?php echo $boom['country']; ?>
		</p>
	</div>
	<div style="width:34px;" onclick="removeBannedCountry(<?php echo $boom['id']; ?>);" class="sub_list_option">
		<i class="fa fa-times edit_btn error"></i>
	</div>
</div>