<?php
require_once('../config_session.php');
if(!boomAllow(88)){
	die();
}
?>
<div class="pad_box">
	<div class="user_color" data-u="<?php echo $data['user_id']; ?>" data="<?php echo $data['user_color']; ?>">
		<div class="reg_menu_container tmargin10">
			<div class="reg_menu">
				<ul>
					<?php if(boomAllow(97)){ ?>
					<li class="reg_menu_item reg_selected" data="color_tab" data-z="lm3acolor">لمعة الاسم</li>
					<?php } ?>
					<li class="reg_menu_item <?php if(!boomAllow(97)){ echo 'reg_selected'; } ?>" data="color_tab" data-z="name_bg">خلفية الاسم</li>
					<li class="reg_menu_item" data="color_tab" data-z="pro_av">صورة شخصية متحركة</li>
					<li class="reg_menu_item" data="color_tab" data-z="list_bg_glow">توهج خلفيه الاسم</li>
					<li class="reg_menu_item" data="color_tab" data-z="pro_color">الوان البروفايل</li>
					<li class="reg_menu_item" data="color_tab" data-z="av_border">اطار الصورة</li>
					<li class="reg_menu_item" data="color_tab" data-z="music_color">موسيقى البروفايل</li>
				</ul>
			</div>
		</div>
		<div id="color_tab">
			<?php if(boomAllow(97)){ ?>
			<div id="lm3acolor" class="reg_zone vpad5">
				<?php echo exGradyChoices($data['user_color'], 1); ?>
				<div class="clear"></div>
				<div class="tpad10">
					<button onclick="exSaveNewUserColors(<?php echo $data['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
					<button onclick="delUserNameColors(<?php echo $data['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> <?php echo $lang['delete']; ?></button>
				</div>
			</div>
			<?php } ?>
			<div id="pro_av" class="reg_zone vpad5 <?php if(boomAllow(97)){ echo 'hide_zone'; } ?>">
				<div class="setting_element">
					<p class="label">اختر صورة متحركه لملفك الشخصي</p>
					<input id="ex_av_gif" type="file" class="full_input">
				</div>
				<div class="tpad10">
					<button onclick="exSaveAvGif();" class="reg_button theme_btn"><i id="gift_av_ico" data="fa-save" class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
					<button onclick="exDelAvGif();" class="reg_button delete_btn"><i class="fa fa-trash"></i> <?php echo $lang['delete']; ?></button>
				</div>
			</div>
			<div id="name_bg" class="reg_zone vpad5 hide_zone">
				<?php echo exNameBg($data['ex_name_bg'], 1); ?>
				<div class="clear"></div>
				<div class="tpad10">
					<button onclick="exSaveNewNameBg(<?php echo $data['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
					<button onclick="delUserNameBg(<?php echo $data['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> <?php echo $lang['delete']; ?></button>
				</div>
			</div>
			<div id="list_bg_glow" class="reg_zone vpad5 hide_zone">
				<?php echo exListBgGlow($data['ex_name_bg_glow'], 1); ?>
				<div class="clear"></div>
				<div class="tpad10">
					<button onclick="exSaveListGlow(<?php echo $data['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
					<button onclick="delUserNameBgGlow(<?php echo $data['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> <?php echo $lang['delete']; ?></button>
				</div>
			</div>
			<div id="av_border" class="reg_zone vpad5 hide_zone">
				<?php echo exNameBg($data['ex_av_border'], 2); ?>
				<div class="clear"></div>
				<div class="tpad10">
					<button onclick="exSaveAvBorder(<?php echo $data['user_id']; ?>);" class="reg_button theme_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
					<button onclick="exDelAvBorder(<?php echo $data['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> <?php echo $lang['delete']; ?></button>
				</div>
			</div>
			<div id="pro_color" class="reg_zone vpad5 hide_zone">
				<p class="label"><?php echo $lang['pro_color']; ?></p>
				<div value="<?php echo $data['user_id']; ?>" data="<?php echo $data['pro_color']; ?>" class="my_pro_color vpad5 box_height">
					<?php echo proGradChoices($data['pro_color'], 4); ?>
					<div class="clear"></div>
					<div class="pad10">
						<button type="button" onclick="saveProColor(<?php echo $data['user_id']; ?>);" class="reg_button default_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
					</div>
				</div>
				<p class="label"><?php echo $lang['pro_glow']; ?></p>
				<div value="<?php echo $data['user_id']; ?>" data="<?php echo $data['pro_shadow']; ?>" class="my_pro_shadow vpad5 box_height">
					<?php echo proShadowGradChoices($data['pro_shadow'], 4); ?>
					<div class="clear"></div>
					<div class="pad10">
						<button type="button" onclick="saveProShadow(<?php echo $data['user_id']; ?>);" class="reg_button default_btn"><i class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
					</div>
				</div>
				<div class="pad10">
					<button type="button" onclick="delProColors(<?php echo $data['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-trash"></i> البروفايل لافتراضي</button>
				</div>
				<div class="clear"></div>
			</div>
			<div id="music_color" class="reg_zone vpad5 hide_zone">
				<div class="setting_element">
					<p class="label"><b style="color:red;"> <?php echo $lang['choose_music']; ?> </b></p>
					<input id="pro_song" class="full_input" type="file" />
					<p class="sub_text sub_label"> <?php echo $lang['limit_pro_music']; ?></p>
				</div>
				<div class="pad10">
					<button type="button" onclick="uploadProfileSong(<?php echo $data['user_id']; ?>);" class="reg_button theme_btn"><i id="avat_icon_song" data="fa-save" class="fa fa-save"></i> <?php echo $lang['save']; ?></button>
					<button type="button" onclick="delProfileSong(<?php echo $data['user_id']; ?>);" class="reg_button delete_btn"><i class="fa fa-times"></i> <?php echo $lang['delete']; ?></button>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>