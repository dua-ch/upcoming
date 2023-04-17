<?php
$load_addons = 'AA_emoji_uploader';
require('../../../../system/config_addons.php');
if (!boomAllow($cody['can_manage_addons'])) {
	die();
}
?>
<div class="pad_box">
	<button type="button" id="extrabutton" class="reg_button theme_btn"><i class="fa fa-upload"></i> Done!, upload.</button>
	<span style="display: block;" class="error_emo_upload label"></span>
	<div class="setting_element">
		<p class="label"><?php echo $lang['select_emoji']; ?>:</p>
		<div style="background: #eeeeee;" id="fileuploader" class="reg_button">
		</div>
	</div>
</div>
<script data-cfasync="false" src="addons/AA_emoji_uploader/files/jquery.uploadfile.min.js"></script>
<script data-cfasync="false">
	$(document).ready(function() {
		boomAddCss('addons/AA_emoji_uploader/files/AA_emoji_uploader.css');
	});
	var emo_name = '<?php echo $lang['emo_name']; ?>';
	var emo_cat = '<?php echo $lang['emo_cat']; ?>';
	var emo_cat_list = '<?php echo listEmojiCat(); ?>';
	var upObj = $("#fileuploader").uploadFile({
		url: "addons/AA_emoji_uploader/system/action.php",
		fileName: "file",
		multiple: true,
		dragDrop: true,
		maxFileCount: 50,
		showProgress: true,
		showPreview: true,
		autoSubmit: false,
		previewHeight: '30px',
		previewWidth: 'auto',
		allowedTypes: "png,gif",
		acceptFiles: "image/*",
		showFileCounter: false,
		extraHTML: function() {
			var html = "<div class='setting_element'><b>Emoji Name :</b><input class='full_input' type='text' placeholder='Name Optional' name='emo_name' value='' /> <br/>";
			html += "<div class='setting_element'><b>Emoji Folder :</b><select name='emo_cat'>" + emo_cat_list + "</select></div>";
			html += "</div>";
			return html;
		},
		uploadStr: '<span style="padding:5px 10px;background:#6a6a6a;color:#fff;"><i class="fa fa-paperclip"></i> Click here to select files</span>',
		formData: {
			add_emoji: 1,
			token: utk
		},
		onSuccess: function(files, data, xhr, pd) {
			var response = jQuery.parseJSON(data);
			if (response.code == 2) {
				callSaved(system.wrongFile, 3);
			} else if (response.code == 3) {
				callSaved('<?php echo $lang["emo_exists"]; ?>', 3);
				$('.error_emo_upload').show();
				$('.error_emo_upload').text('Change this emoji name, please!!');
				$('.error_emo_upload').addClass('error_up_msg');
				$('.ajax-file-upload-statusbar').remove();
			} else if (response.code == 1) {
				callSaved(system.saved, 1);
				$('.emo_content').html(response.data);
				$('.error_emo_upload').hide();
			} else {
				callSaved(system.error, 3);
			}
		},
		onError: function(files) {
			callSaved(system.error, 3);
		},
	});
	$("#extrabutton").click(function() {
		upObj.startUpload();
	});
</script>