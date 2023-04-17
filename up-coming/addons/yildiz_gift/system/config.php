<?php
/*===============================================*
 |                                               |
 |   Development      :  [AMEER_PS]              |
 |                                               |
 |   addon name       :  [YILDIZ_GIFT]           |
 |                                               |
 |   Version          :  [1.0]                   |
 |                                               |
 |   Codychat version :  [CODYCHAT 3.6]          |
 |                                               |
 *===============================================*/
$load_addons = 'yildiz_gift';
require_once('../../../system/config_addons.php');
if(!boomAllow(10)){
	die();
}

?>
<?php echo elementTitle($data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>
<div class="page_full">
		<div class="tab_menu">
			<ul>
				<li class="tab_menu_item tab_selected" data="store" data-z="store_setting"><i class="fa fa-cogs"></i> <?php echo $lang['settings']; ?></li>
				<li class="tab_menu_item" data="store" data-z="store_add"><i class="fa fa-gift"></i> اضافة هدية</li>
			</ul>
		</div>
	<div class="page_element">	
<div class="tpad15">
<div id="store">
				
			<!------------------------------------------------------------->
			<div id="store_setting" class="tab_zone">
			<div class="setting_element ">
				<p class="label">الحمد من ميزة ارسال الهداية لـ</p>
					<select id="set_addon_access">
							<?php echo listRank($data['addons_access'], 1); ?>
					</select>
			</div>
			<input class="hidden" value="0" id="set_addon_box">
			<input class="hidden" value="0" id="set_addon_quiz">  
				<button onclick="adminRankAmeer();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
			<div class="clear"></div>
			</div>
			<!------------------------------------------------------------->
			
			<!------------------------------------------------------------->		
            <div id="store_add" class="tab_zone hide_zone">
            <div class="bmargin15">
			<button onclick="addNewGift();" class="reg_button theme_btn"><i class="fa fa-plus"></i> <?php echo $lang['add']; ?></button>
			</div>
			<div id="gift_list" class="tmargin15">
				<?php echo listGift(); ?>
			</div>
         </div>
      </div>					
			<!------------------------------------------------------------->
					<div class="clear"></div>
				   </div>
</div>
</div>
<div class="config_section">
<script data-cfasync="false">
boomAddCss('addons/yildiz_gift/files/style_gift.css');
adminRankAmeer = function(){
					$.post('addons/yildiz_gift/system/action.php', {
						set_addon_access: $('#set_addon_access').val(),
						set_addon_box: $('#set_addon_box').val(),
						set_addon_quiz: $('#set_addon_quiz').val(),
						token: utk,
						}, function(response) {
							if(response == 1){
								callSaved(system.saved, 1);
							}
							else{
								callSaved(system.error, 3);
							}
					});	
}
addNewGift = function(){
					$.post('addons/yildiz_gift/system/box/add_gift.php', {
						token: utk,
						}, function(response) {
							if(response == 0){
								return false;
							}
							else{
								showModal(response, 500);
							}
					});	
}
callErrorgift = function(text){
$('.error_gift').text(text);
$('#error_show').show("500");
}
var waitgift = 0;
var upgift = 'يتم رفع الصورة سيتم اغلاق هذه النافذة بعد الانتهاء';
addGiftNew = function(){
	var gift_name = $('#gift_name').val();
	var gift_quiz = $('#gift_quiz').val();
	var file_data = $("#gift_file").prop("files")[0];
	if($("#gift_file").val() === ""){
		callSaved(system.noFile, 3);
	}
	else {
		if(waitgift == 0){
			waitgift = 1;
			callErrorgift((upgift));
			var form_data = new FormData();
			form_data.append("file", file_data)
			form_data.append("gift_name", gift_name)
			form_data.append("gift_quiz", gift_quiz)
			form_data.append("token", utk)
			$.ajax({
				url: "addons/yildiz_gift/system/action.php",
				dataType: 'json',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function(response){
					if(response.code == 1){
						$('#gift_list').prepend(response.data);
						callSaved(system.saved, 1);
						hideModal();
						waitgift = 0;
					}
					else {
						callSaved(system.saved, 1);
						hideModal();
						waitgift = 0;
					}
				},
				error: function(){
					callSaved(system.error, 3);
					waitgift = 0;
				}
			})
		}
		else {
			return false;
		}
	}
} 
editgift = function(id){
					$.post('addons/yildiz_gift/system/box/edit_gift.php', {
						edit_gift: id,
						token: utk,
						}, function(response) {
							if(response == 0){
								callSaved(system.error, 3);
							}
							else{
								showModal(response, 500);
							}
					});	
}
changeGift = function(id){
					$.ajax({
						url: "addons/yildiz_gift/system/action.php",
						type: "post",
						cache: false,
						dataType: 'json',
						data: { 
							gift_save: id,
							gift_name: $('#gift_name').val(),
							gift_quiz: $('#gift_quiz').val(),
							token: utk,
						},
						success: function(response) {
							if(response.code == 1){
								$('.gift'+id).replaceWith(response.data);
								hideModal();
							}
							else {
								callSaved(system.error, 3);
							}
						},
						error: function(){
							callSaved(system.error, 3);
						}
					});
}
deletegift = function(id){
					$.post('addons/yildiz_gift/system/action.php', {
						delete_gift:id,
						token: utk,
						}, function(response) {
							if(response == 1){
								$('.gift'+id).remove();
							}
							else{
								callSaved(system.error, 3);
							}
					});	
}

</script>
</div>