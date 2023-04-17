<?php
require_once('../config_session.php');

$leader_list = '';

function showTopPoints($lead, $rank){
	global $lang;
	$add_me = '';
	if(mySelf($lead['user_id'])){
		$add_me = 'noview';
	}
	return '<div style="padding:10px 5px 3px 0;background: #212121;" class="ulist_item ' . $add_me . ' '.$lead['ex_name_bg'].' '.$lead['ex_name_bg_glow'].'">
				<div class="ranking_lm">
					' . showRankNumber($rank) . '
				</div>
				<div class="get_info toplist_avatar2" data="' . $lead['user_id'] . '">
					<img class="ul_fr_av topav_circle under" src="' . myAvatar($lead['user_tumb']) . '"/>
					<img src="images/border/'.$lead['my_border'].'" class="ul_fr_bg over5">
				</div>
				<div class="ulist_name">
					<p class="username ' . myColor($lead) . '">' . $lead["user_name"] . '</p>
				</div>
			</div>';
}

function showRankNumber($icon)
{
    switch ($icon) {
        case 1:
            return '<img style="width: 25px;top:2px;" src="default_images/icons/r1.png" />';
        case 2:
            return '<img style="width: 25px;top:2px;" src="default_images/icons/r2.png" />';
        case 3:
            return '<img style="width: 25px;top:2px;" src="default_images/icons/r3.png" />';
        default:
            return $icon;
    }
}

$get_leader = $mysqli->query("SELECT * FROM boom_users WHERE user_points > 0 AND user_rank > 88 AND user_rank < 100 AND user_bot = 0 ORDER BY user_points DESC LIMIT 10");
if($get_leader->num_rows > 0){
	$rank = 1;
	while($lead = $get_leader->fetch_assoc()){
		$leader_list .= showTopPoints($lead, $rank);
		$rank++;
	}
}
else {
	$leader_list .= emptyZone($lang['no_data']);
}
?>
<div style="background:black;" class="ulist_container">
	<?php echo $leader_list; ?>
</div>

