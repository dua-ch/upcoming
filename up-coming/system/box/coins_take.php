<?php
require_once('../config_session.php');
require_once('../ex_function/main_func.php');
if (!boomAllow($data['ex_coins_take'])) {
    die();
}
if (!isset($_POST['target'])) {
    echo 0;
    die();
}
$target = escape($_POST['target']);
$user = userDetails($target);
?>
<div class="pad_box">
    <div class="color_choices" data="bgcolor4">
        <div class="reg_menu_container">
            <div class="reg_menu">
                <ul>
                    <?php if (boomAllow($data['allow_takecoins'])) { ?>
                        <li class="reg_menu_item reg_selected" data="staff_list" data-z="superadmin">خصم كوينز</li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div id="staff_list">
            <div id="superadmin" class="reg_zone vpad5">
                <div id="container_user">
                    <div id="usersnames">
                        <div class="online_user">
                            <p class="label">اكتب عدد الكوينز التي تريد خصمها</p>
                            <input type="number" id="take_my_coins" class="full_input" />
                            <input type="hidden" id="target" value="<?php echo $user['user_id']; ?>" class="full_input" />
                            <div class="pad10">
                                <button onclick="takeMyCoins();" class="reg_button theme_btn"><i class="fa fa-bitcoin"></i> خصم</button>
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