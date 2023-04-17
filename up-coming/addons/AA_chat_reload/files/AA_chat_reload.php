<?php if(boomAllow($addons['addons_access'])){ 
$bbfv = boomFileVersion(); 
?>		
<script data-cfasync="false" type="text/javascript">
$(document).ready(function() {
appLeftMenu('sync', 'تحديث الشات للجميع', 'refreshChatForAll();');
refreshChatForAll = function(){
	$.post('addons/AA_chat_reload/system/action.php', { 
		refreshall: 1,
		token: utk
		}, function(response) {
			if(response == 1){
				callSaved('تم تحديث الشات للجميع', 1);
			}
			else if(response == 2){
				callSaved(system.error, 3);
			}
			else{
				callSaved(system.error, 3);
			}
	});	
}
});
</script>
<?php } ?>