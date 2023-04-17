<?php
require_once('../config_session.php');
$leader_list = '';

$get_leader = $mysqli->query("SELECT * FROM boom_users WHERE user_level > 20 AND user_bot = 0 ORDER BY user_level DESC LIMIT 50");
if($get_leader->num_rows > 0){
	while($lead = $get_leader->fetch_assoc()){
		$leader_list .= getTopLevels($lead);
	}
}
else {
	$leader_list .= emptyZone($lang['no_data']);
}
?>
<div class="ulist_container">
	<?php echo $leader_list; ?>
</div>
