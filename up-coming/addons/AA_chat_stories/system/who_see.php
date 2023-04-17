<?php
$load_addons = 'AA_chat_stories';
require_once('../../../system/config_addons.php');

$target = escape($_POST['target']);
$list = '';
$get_data = $mysqli->query("SELECT * FROM story_seen WHERE sid = '$target'");
if($get_data->num_rows > 0){
    while($mine = $get_data->fetch_assoc()){
        $boom = userRoomDetails($mine['uid']);
        $list .= '<div class="ulist_item">
                        <div class="ulist_avatar">
                            <img onclick="getProfile('. $boom['user_id'] .');" src="'. myAvatar($boom['user_tumb']) .'"/>
                        </div>
                        <div class="ulist_name">
                            <p class="username '. myColor($boom) .'">'. $boom["user_name"] .'</p>
                            <p style="font-size:11px;" class="sub_text">'. chatDate($mine['time']) .'</p>
                        </div>
                    </div>';
    }
}
?>
<div class="pad_box">
    <?php echo $list; ?>
</div>