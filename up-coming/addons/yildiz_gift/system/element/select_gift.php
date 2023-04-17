<?php
$bbfv = boomFileVersion();
?>
<div data-id = "<?php echo $boom['id']; ?>" data-img ="<?php echo $boom['gift_img']; ?>" value="<?php echo $boom['gift_quiz']; ?>" name="<?php echo $boom['gift_name']; ?>" class="selected_gifts new_style_gift gift-responsive">
<div class="new_style_gift gift-container">
	<img src="<?php echo $boom['gift_img']; ?><?php echo $bbfv; ?>">
	  <h4 class="selected-gift"><?php echo $boom['gift_name']; ?></h4>
		<small class="gift_dec"> <i class="gift_icon fa fa-money"></i> <?php echo $boom['gift_quiz']; ?> </small>
</div>
   </div> 