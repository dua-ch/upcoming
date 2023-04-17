<?php
$load_addons = 'AA_gifts';
require_once('../../../system/config_addons.php');

if (!isset($_POST['target'])) {
	die();
}
if (checkFlood()) {
	echo 100;
	die();
}
if (muted() || roomMuted()) {
	die();
}

if (isset($_POST['target'])) {
	$target = escape($_POST['target']);
	$user = userDetails($target);
	if (empty($user)) {
		die();
	}
}
?>
<style>
	div.gift-desc {
		background: #790849;
	}

	div.gift-container img {
		display: inline-block;
		position: relative;
		margin-left: 0;
		left: 0;
		right: 0;
		width: 100%;
		height: 100px;
	}

	;
</style>
<div class="pad_box" style="overflow: auto;">
	<div class="boom_form">
		<div class="setting_element ">

			<div class="gift-responsive" onclick="sendUserGift(this, 1)" data="<?php echo $user['user_id']; ?>" value="<?php echo chooseGiftCoins(1); ?>">
				<div class="gift-container">
					<img style="display: inline-block;     position: relative;     margin-left: 0;     left: 0;     right: 0;     width: 100%;     height: 100px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(1); ?>">
					<div class="gift-desc"><?php echo chooseGiftName(1); ?></div>
				</div>
			</div>

			<div class="gift-responsive" onclick="sendUserGift(this, 4)" data="<?php echo $user['user_id']; ?>" value="<?php echo chooseGiftCoins(2); ?>">
				<div class="gift-container">
					<img style="display: inline-block;     position: relative;     margin-left: 0;     left: 0;     right: 0;     width: 100%;     height: 100px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(2); ?>">
					<div class="gift-desc"><?php echo chooseGiftName(2); ?></div>
				</div>
			</div>

			<div class="gift-responsive" onclick="sendUserGift(this, 7)" data="<?php echo $user['user_id']; ?>" value="<?php echo chooseGiftCoins(3); ?>">
				<div class="gift-container">
					<img style="display: inline-block;     position: relative;     margin-left: 0;     left: 0;     right: 0;     width: 100%;     height: 100px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(3); ?>">
					<div class="gift-desc"><?php echo chooseGiftName(3); ?></div>
				</div>
			</div>

			<div class="gift-responsive" onclick="sendUserGift(this, 8)" data="<?php echo $user['user_id']; ?>" value="<?php echo chooseGiftCoins(4); ?>">
				<div class="gift-container">
					<img style="display: inline-block;     position: relative;     margin-left: 0;     left: 0;     right: 0;     width: 100%;     height: 100px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(4); ?>">
					<div class="gift-desc"><?php echo chooseGiftName(4); ?></div>
				</div>
			</div>

			<div class="gift-responsive" onclick="sendUserGift(this, 9)" data="<?php echo $user['user_id']; ?>" value="<?php echo chooseGiftCoins(5); ?>">
				<div class="gift-container">
					<img style="display: inline-block;     position: relative;     margin-left: 0;     left: 0;     right: 0;     width: 100%;     height: 100px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(5); ?>">
					<div class="gift-desc"><?php echo chooseGiftName(5); ?></div>
				</div>
			</div>


			<div class="gift-responsive" onclick="sendUserGift(this, 10)" data="<?php echo $user['user_id']; ?>" value="<?php echo chooseGiftCoins(6); ?>">
				<div class="gift-container">
					<img style="display: inline-block;     position: relative;     margin-left: 0;     left: 0;     right: 0;     width: 100%;     height: 100px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(6); ?>">
					<div class="gift-desc"><?php echo chooseGiftName(6); ?></div>
				</div>
			</div>

			<div class="gift-responsive" onclick="sendUserGift(this, 11)" data="<?php echo $user['user_id']; ?>" value="<?php echo chooseGiftCoins(7); ?>">
				<div class="gift-container">
					<img style="display: inline-block;     position: relative;     margin-left: 0;     left: 0;     right: 0;     width: 100%;     height: 100px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(7); ?>">
					<div class="gift-desc"><?php echo chooseGiftName(7); ?></div>
				</div>
			</div>

			<div class="gift-responsive" onclick="sendUserGift(this, 12)" data="<?php echo $user['user_id']; ?>" value="<?php echo chooseGiftCoins(8); ?>">
				<div class="gift-container">
					<img style="display: inline-block;     position: relative;     margin-left: 0;     left: 0;     right: 0;     width: 100%;     height: 100px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(8); ?>">
					<div class="gift-desc"><?php echo chooseGiftName(8); ?></div>
				</div>
			</div>

			<div class="gift-responsive" onclick="sendUserGift(this, 13)" data="<?php echo $user['user_id']; ?>" value="<?php echo chooseGiftCoins(9); ?>">
				<div class="gift-container">
					<img style="display: inline-block;     position: relative;     margin-left: 0;     left: 0;     right: 0;     width: 100%;     height: 100px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(9); ?>">
					<div class="gift-desc"><?php echo chooseGiftName(9); ?></div>
				</div>
			</div>

			<div class="gift-responsive" onclick="sendUserGift(this, 14)" data="<?php echo $user['user_id']; ?>" value="<?php echo chooseGiftCoins(10); ?>">
				<div class="gift-container">
					<img style="display: inline-block;     position: relative;     margin-left: 0;     left: 0;     right: 0;     width: 100%;     height: 100px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(10); ?>">
					<div class="gift-desc"><?php echo chooseGiftName(10); ?></div>
				</div>
			</div>

			<div class="gift-responsive" onclick="sendUserGift(this, 15)" data="<?php echo $user['user_id']; ?>" value="<?php echo chooseGiftCoins(11); ?>">
				<div class="gift-container">
					<img style="display: inline-block;     position: relative;     margin-left: 0;     left: 0;     right: 0;     width: 100%;     height: 100px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(11); ?>">
					<div class="gift-desc"><?php echo chooseGiftName(11); ?></div>
				</div>
			</div>

			<div class="gift-responsive" onclick="sendUserGift(this, 16)" data="<?php echo $user['user_id']; ?>" value="<?php echo chooseGiftCoins(12); ?>">
				<div class="gift-container">
					<img style="display: inline-block;     position: relative;     margin-left: 0;     left: 0;     right: 0;     width: 100%;     height: 100px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(12); ?>">
					<div class="gift-desc"><?php echo chooseGiftName(12); ?></div>
				</div>
			</div>

		</div>
	</div>
</div>