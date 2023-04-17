<?php if(boomAllow($addons['addons_access'])){ 
$bbfv = boomFileVersion(); 
?>		
<script data-cfasync="false" type="text/javascript">
$(document).ready(function() {
appLeftMenu('users', 'قائمة الاداريين', 'showStaffList();');
showStaffList = function(){
	$.post('addons/AA_staff_list/system/sw_staff_list.php', { 
		token: utk,
		}, function(response) {
			if(response == 0){
				callSaved(system.error, 3);
			}
			else {
				showModal(response);
			}
	});
}
});
</script>
<?php } ?>