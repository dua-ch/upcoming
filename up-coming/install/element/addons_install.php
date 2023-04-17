<div class="sub_list_item btauto">
	<div class="sub_list_avatar">
		<img src="<?php echo $data['domain']; ?>/addons/<?php echo $boom; ?>/files/icon.png"/>
	</div>
	<div class="sub_list_name addons_name">
		<?php echo pSUnderClear1($boom); ?>
	</div>
	<div class="sub_list_cell bcauto">
		<button class="default_btn button work_button"><i class="fa fa-clock-o"></i> جاري التنصيب....</button>
		<button onclick="installThisAddon(this, '<?php echo $boom; ?>');" data="<?php echo $boom; ?>" type="button" class="activate_addons button theme_btn"><i class="fa fa-upload edit_btn"></i> <span class="hide_mobile"><?php echo $lang['install']; ?></span></button>
	</div>
</div>