<?php
$hunter = userDetails($boom['hunter']);
$target = userDetails($boom['target']);
?>
<div class="sub_list_item hist<?php echo $boom['id']; ?>">
	<div class="sub_list_cell">
		<div class="btable btauto">
			<div class="bcell bold">
				<?php echo $hunter['user_name']; ?> :To: <?php echo $target['user_name']; ?>
			</div>
			<div class="bcell text_xsmall bcauto sub_text aright rtl_aleft">
				<?php echo displayDate($boom['time']); ?>
			</div>
		</div>
		<div class="text_xsmall tpad3  history_reason">
			<span class="sub_text"><?php echo $boom['message']; ?></span>
		</div>
	</div>
</div>