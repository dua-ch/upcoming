<?php
$load_addons = 'AA_group_chat';
require_once('../../../system/config_addons.php');
$askers = '';
$find_asker = $mysqli->query("SELECT boom_users.user_name, boom_users.user_id, boom_users.user_tumb, boom_users.user_color, group_chat_ask.* FROM boom_users, group_chat_ask 
WHERE target = '{$data['user_id']}' AND uid = boom_users.user_id ORDER BY id ASC, user_name ASC");
if($find_asker->num_rows > 0){
	while($fetch = $find_asker->fetch_assoc()){
		$askers .= sub_Template('system/template/user_asker', $fetch);
	} 
}
else {
	$askers .= emptyZone('You do not have requests now.');
}
?>
<div class="ulist_container">
	<?php echo $askers; ?>
</div>