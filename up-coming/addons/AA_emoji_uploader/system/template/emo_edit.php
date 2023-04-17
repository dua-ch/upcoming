<?php
$load_addons = 'AA_emoji_uploader';
require('../../../../system/config_addons.php');

if(!boomAllow($cody['can_manage_addons'])){
	die();
}
if (!isset($_POST['emo_name'])){
    die();
}
$emo = escape($_POST['emo_name']);
$cat = escape($_POST['src']);
$item = explode('/',$cat);
$emo_name = str_ireplace(':','',$emo);

?>
<div class="pad_box">
    <div class="setting_element">
        <center id="emo_image_edit" data-name="<?php echo (!isset($item[2])?$item[1]:$item[2]); ?>" ><?php echo emoticon($emo); ?></center>
    </div>
	<div class="setting_element">
        <input id="emo_name" class="full_input" type="text" value="<?php echo $emo_name; ?>" data-oldname="<?php echo $emo_name; ?>" disabled hidden/>
    </div>
    <center>
    <button type="button" onclick="delete_emoji();" class="reg_button delete_btn"><i class="fa fa-trash"></i> <?php echo $lang['delete']; ?></button>
    </center>
</div>