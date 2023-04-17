<?php
require('../config_session.php');
?>
<div class="pad_box">
	<div class="user_color" data-u="<?php echo $data['user_id']; ?>" data="<?php echo $data['user_color']; ?>">
		<div class="reg_menu_container tmargin10">
			<div class="reg_menu">
				<ul>
					<li class="reg_menu_item reg_selected" data="color_tab" data-z="mframes"> الاطارات الخاصة</li>
				</ul>
			</div>
		</div>
		<div id="color_tab">
			<div id="mframes" class="reg_zone vpad5">
				<div class="gift-responsive" onclick="delPhotoFrame(<?php echo $data['user_id']; ?>)" value="em">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 50px;width: 50px;padding: 0;margin: 5px 0 0 0;" src="images/border/em.png" />
						</div>
						<div style="background: red;" class="gift-desc"><?php echo $lang['delete']; ?></div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('dragon.webp', <?php echo $data['user_id']; ?>)" value="dragon">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/dragon.webp" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr-mlky.webp', <?php echo $data['user_id']; ?>)" value="n-fr-mlky">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr-mlky.webp" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr1.webp', <?php echo $data['user_id']; ?>)" value="n-fr1">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr1.webp" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr2.webp', <?php echo $data['user_id']; ?>)" value="n-fr2">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr2.webp" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr3.webp', <?php echo $data['user_id']; ?>)" value="n-fr3">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr3.webp" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr4.webp', <?php echo $data['user_id']; ?>)" value="n-fr4">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr4.webp" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr5.webp', <?php echo $data['user_id']; ?>)" value="n-fr5">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr5.webp" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr6.webp', <?php echo $data['user_id']; ?>)" value="n-fr6">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr6.webp" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr7.webp', <?php echo $data['user_id']; ?>)" value="n-fr7">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr7.webp" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr8.webp', <?php echo $data['user_id']; ?>)" value="n-fr8">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr8.webp" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr9.webp', <?php echo $data['user_id']; ?>)" value="n-fr9">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr9.webp" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr10.webp', <?php echo $data['user_id']; ?>)" value="n-fr10">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr10.webp" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr11.webp', <?php echo $data['user_id']; ?>)" value="n-fr11">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr11.webp" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr13.webp', <?php echo $data['user_id']; ?>)" value="n-fr13">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr13.webp" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr14.gif', <?php echo $data['user_id']; ?>)" value="n-fr14">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr14.gif" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr12.png', <?php echo $data['user_id']; ?>)" value="n-fr12">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr12.png" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr17.png', <?php echo $data['user_id']; ?>)" value="n-fr17">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr17.png" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr19.png', <?php echo $data['user_id']; ?>)" value="n-fr19">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr19.png" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr27.png', <?php echo $data['user_id']; ?>)" value="n-fr27">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr27.png" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="gift-responsive" onclick="savePhotoFrame('n-fr28.png', <?php echo $data['user_id']; ?>)" value="n-fr28">
					<div class="gift-container">
						<div style="height:60px;">
							<img style="height: 55px;width: 50px;padding: 0;" src="images/border/n-fr28.png" />
						</div>
						<div class="gift-desc">اضغط</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>