<?php
require_once('../config_session.php');
if (!boomAllow(2)) {
    die();
}
if (!isset($_POST['target'])) {
    echo 0;
    die();
}
$target = escape($_POST['target']);
$user = userDetails($target);
if ($user['user_level'] > 0 && $user['user_level'] < 10) {
    $need_exp = $user['user_level'] * 100;
} elseif ($user['user_level'] >= 10 && $user['user_level'] < 20) {
    $need_exp = $user['user_level'] * 250;
} elseif ($user['user_level'] >= 20 && $user['user_level'] < 30) {
    $need_exp = $user['user_level'] * 350;
} elseif ($user['user_level'] >= 30 && $user['user_level'] < 40) {
    $need_exp = $user['user_level'] * 650;
} elseif ($user['user_level'] >= 40 && $user['user_level'] < 50) {
    $need_exp = $user['user_level'] * 850;
} elseif ($user['user_level'] >= 50 && $user['user_level'] < 60) {
    $need_exp = $user['user_level'] * 1500;
} elseif ($user['user_level'] >= 60 && $user['user_level'] < 70) {
    $need_exp = $user['user_level'] * 2300;
} elseif ($user['user_level'] >= 70 && $user['user_level'] < 80) {
    $need_exp = $user['user_level'] * 3500;
} elseif ($user['user_level'] >= 80 && $user['user_level'] < 90) {
    $need_exp = $user['user_level'] * 4400;
} elseif ($user['user_level'] >= 90 && $user['user_level'] < 100) {
    $need_exp = $user['user_level'] * 7800;
} else {
    $need_exp = 0;
}
$result = $need_exp - $user['user_exp'];
?>
<div class="pad_box">
    <div class="color_choices" data="bgcolor4">
        <div class="reg_menu_container">
            <div class="reg_menu">
                <ul>
                    <?php if (boomAllow(2)) { ?>
                        <li class="reg_menu_item reg_selected" data="staff_list" data-z="owner">ارسال نقاط</li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div id="staff_list">
            <div id="owner" class="reg_zone vpad5">
                <div id="container_user">
                    <div id="usersnames">
                        <div class="online_user">
                            <p class="label error">يحتاج هذا العضو <?php echo $result; ?> نقطة ليرتقى للمستوى القادم </p>
                            <input class="full_input" type="number" max="<?php echo $result; ?>" id="send_my_coins" placeholder="ادخل عدد النقاط التي تريد ارسالها...." >
                            <input type="hidden" id="target" value="<?php echo $user['user_id']; ?>" class="full_input" />
                            <div class="pad10">
                                <button onclick="sendMyCoins();" class="reg_button theme_btn"><i class="fa fa-bitcoin"></i> ارسال</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>