<?php
$load_addons = 'AA_chat_cast';
require_once('../../../system/config_addons.php');

if(isset($_POST['send_cast_all'])){
    $all = escape($_POST['send_cast_all']);
    if(!boomAllow($data['addons_access'])){
        die();
    }
	if(empty($all)){
        die();
    }
	$cast_msg = '
    <div style="box-shadow: 0 0px 10px #0010ff;" class="pad_box">
		<h2 class="bold" style="border: 1px dashed #eebdbd;padding: 6px 0;text-align:center;color:white;background-image: linear-gradient(to bottom, #1215d3, #2e00d3, #1d00cf, #3d00c6, #4c1bb9);"><i class="fa fa-bullhorn"></i> إعلان للاعضاء <i class="fa fa-users"></i></h2>
        <div style="background: #eeeeee;" class="boom_form">
            <li style="background: #eeeeee;padding: 6px;">
                <div class="avtrig chat_avatar">
                    <img style="border: 1px solid #fff;border-radius:3px;" class="cavatar" src="' . myAvatar($data['user_tumb']) . '">
                </div>
                <div class="my_text">
                    <div class="btable">
                        <div class="cname">
                            <span class="username '. myColor($data) .'"> '. (empty($data['fancy_name']) ? $data['user_name'] : $data['fancy_name']) .' </span>
                        </div>
                        <div class="cdate">' . chatDate($post['post_date']) . '</div>
                    </div>
                    <div style="color:black;word-break: break-word;" class="chat_message chat_system">'. $all .'</div>
                </div>
            </li>
        </div>
		<button style="margin: 10px 0 0 0;background: #0010ff;" class="cancel_modal reg_button default_btn">إغلاق</button>
    </div>';
	$mysqli->query("UPDATE boom_users SET show_cast = '$cast_msg', caster = '1', caster_rank = '0'");
	echo 1;
}

if(isset($_POST['send_cast_staff'])){
    $staff = escape($_POST['send_cast_staff']);
    if(!boomAllow($data['addons_access'])){
        die();
    }
	if(empty($staff)){
        die();
    }
	$cast_msg = '
    <div style="box-shadow: 0 0px 10px red;" class="pad_box">
		<h2 class="bold" style="border: 1px dashed #eebdbd;padding: 6px 0;text-align:center;color:white;background-image: linear-gradient(to bottom, #d31212, #d30030, #cf0047, #c6005b, #b91b6d);"><i class="fa fa-bullhorn"></i> إعلان للادارة <i class="fa fa-trophy"></i></i></h2>
        <div style="background: #eeeeee;" class="boom_form">
            <li style="background: #eeeeee;padding: 6px;">
                <div class="avtrig chat_avatar">
                    <img style="border: 1px solid #fff;border-radius:3px;" class="cavatar" src="' . myAvatar($data['user_tumb']) . '">
                </div>
                <div class="my_text">
                    <div class="btable">
                        <div class="cname">
                            <span class="username '. myColor($data) .'"> '. (empty($data['fancy_name']) ? $data['user_name'] : $data['fancy_name']) .' </span>
                        </div>
                        <div class="cdate">' . chatDate($post['post_date']) . '</div>
                    </div>
                    <div style="color:black;word-break: break-word;" class="chat_message chat_system">'. $staff .'</div>
                </div>
            </li>
        </div>
		<button style="margin: 10px 0 0 0;background: #cf0047;" class="cancel_modal reg_button default_btn">إغلاق</button>
    </div>';
	$mysqli->query("UPDATE boom_users SET show_cast = '$cast_msg', caster = '1', caster_rank = '95'");
	echo 1;
}

if(isset($_POST['send_cast_hide'])){
    $hide = escape($_POST['send_cast_hide']);
    if(!boomAllow($data['addons_access'])){
        die();
    }
	if(empty($hide)){
        die();
    }
	$cast_msg = '
    <div style="box-shadow: 0 0px 10px #000;" class="pad_box">
		<h2 class="bold" style="border: 1px dashed #eebdbd;padding: 6px 0;text-align:center;color:white;background-image: linear-gradient(to bottom, #545454, #656565, #575757, #3d3d3d, #292929);"><i class="fa fa-bullhorn"></i> اعلان النظام <i class="fa fa-users"></i></i></h2>
        <div style="background: #eeeeee;" class="boom_form">
            <li style="background: #eeeeee;padding: 6px;">
                <div class="avtrig chat_avatar">
                    <img style="border: 1px solid #ff;border-radius:3px;" class="cavatar" src="'. $data['domain'] .'/default_images/avatar/default_system.png">
                </div>
                <div class="my_text">
                    <div class="btable">
                        <div class="cname">
                            <span class="username bcolor1 bnfont11"> النظام الآلي </span>
                        </div>
                        <div class="cdate">' . chatDate($post['post_date']) . '</div>
                    </div>
                    <div style="color:black;word-break: break-word;" class="chat_message chat_system">'. $hide .'</div>
                </div>
            </li>
        </div>
		<button style="margin: 10px 0 0 0;background: #6c6c6c;" class="cancel_modal reg_button default_btn">إغلاق</button>
    </div>';
	$mysqli->query("UPDATE boom_users SET show_cast = '$cast_msg', caster = '1', caster_rank = '0'");
	echo 1;
}

if(isset($_POST['set_addon_access'])){
    $rank = escape($_POST['set_addon_access']);
    if(!boomAllow(10)){
        die();
    }
	$mysqli->query("UPDATE boom_addons SET addons_access = '$rank' WHERE addons = 'AA_chat_cast'");
	echo 1;
}
?>