<?php
/*===============================================*
 |                                               |
 |   Development      :  [AMEER_PS]              |
 |                                               |
 |   addon name       :  [LIVE_STREAM]           |
 |                                               |
 |   Version          :  [1.0]                   |
 |                                               |
 |   Codychat version :  [CODYCHAT 3.6]          |
 |                                               |
 *===============================================*/
$load_addons = 'AA_live_stream';
require_once('../../../../system/config_addons.php');
$leader_list = '';
function listLive($lead){
	global $lang,$data;
	if(boomAllow(8) && $lead['user_rank'] < 8 ){
		$end = '<div class="score_lm" onclick="EndUserLiveW(' . $lead["user_id"] . ');">
				<div class=" lite_olay">
						<div class="cover_item delete_cover">
							<i id="cover_button" class="fa fa-times"></i>
						</div>
						<div class="cover_item add_cover">
								'.$lang['end_live'].'  <i id="cover_icon"></i> 
						</div>
					</div>
				</div>';
	}
	if($lead['user_id'] != $data['user_id'] ){
	$wh = '<div class="score_lm" onclick="addAllow(' . $lead["user_id"] . ');">
				<div style="background: #3f51b5;" class=" lite_olay">
						<div class="cover_item delete_cover">
							<i id="cover_button" class="fa fa-eye"></i>
						</div>
						<div class="cover_item add_cover">
								'.$lang['show_live'].'  <i id="cover_icon"></i> 
						</div>
					</div>
				</div>';
	}
	return '<div class="ulist_item">
				<div class="get_info ulist_avatar" data="' . $lead['user_id'] . '">
					<img src="' . myavatar($lead['user_tumb']) . '"/>
				</div>
				<div class="ulist_name username ' . $lead['user_color'] . '">
					' . $lead["user_name"] . '
				</div>
				'.$wh.'
				'.$end.'
			</div>';
}

$get_leader = $mysqli->query("SELECT * FROM boom_users WHERE user_live = 1 AND user_bot = 0 ORDER BY user_id DESC LIMIT 100");
if($get_leader->num_rows > 0){
	while($lead = $get_leader->fetch_assoc()){
		$leader_list .= listLive($lead);
	}
}
else {
	$leader_list .= emptyZone($lang['no_data']);
}
?>
<style>
.score_lm {
    display: table-cell;
    vertical-align: middle;
    width: 70px;
    text-align: right;
    font-weight: bold;
    padding: 0 5px;
}
</style>
<div class="ulist_container">
	<?php echo $leader_list; ?>
</div>

