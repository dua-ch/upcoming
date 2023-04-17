<?php
function searchUsersList($lead){
	global $lang;
	return '<div style="padding:6px;" class="sub_list_item btauto">
                <div style="width:30px;" class="sub_list_avatar">
                    <img data="' . $lead['user_id'] . '" class="get_info" style="width:30px;height:30px;" src="' . myavatar($lead['user_tumb']) . '">
                </div>
                <div style="font-size:12px;" class="sub_list_name addons_name bold">
                ' . $lead["user_name"] . '
                </div>
            </div>';
}
function getMyProfileFans($id){
    global $mysqli, $data;
    $users = '';
    $get_users = $mysqli->query("SELECT * FROM profile_fan WHERE target = '$id'");
    if($get_users->num_rows > 0){
        while($fan = $get_users->fetch_assoc()){
            $user = userDetails($fan['hunter']);
            $users .= searchUsersList($user);
        }
    }
    else {
        $users = emptyZone('this member don not have fans yet, be the first.');
    }
    return $users;
}
function profileFanMsg(){
    global $lang;
    $msg = array(
    $lang['fan_msg1'],
    $lang['fan_msg2'],
    $lang['fan_msg3'],
    $lang['fan_msg4'],
    $lang['fan_msg5'],
    $lang['fan_msg6']
    );
    return $msg[array_rand($msg)];
}