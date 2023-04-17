<?php include(addonsLang('AA_profile_fan')); ?>
<?php if (boomAllow($addons['addons_access'])) {
    $bbfv = boomFileVersion();
?>
    <script data-cfasync="false" type="text/javascript">
        $(document).ready(function() {
			appAvMenu('self', 'heart error', "اعجاباتي", 'openProfileFan(this);');
            $(".avother").append("<div data='' onclick='openProfileFan(this)' class='avset avitem'><span class='list_icon'><i class='fa fa-heart error'></i></span> <?php echo $lang['send_fan']; ?></div>");
            $(".avstaff").append("<div data='' onclick='openProfileFan(this)' class='avset avitem'><span class='list_icon'><i class='fa fa-heart error'></i></span> <?php echo $lang['send_fan']; ?></div>");
            $(".avroomstaff").append("<div data='' onclick='openProfileFan(this)' class='avset avitem'><span class='list_icon'><i class='fa fa-heart error'></i></span> <?php echo $lang['send_fan']; ?></div>");
        });
        openProfileFan = function(source) {
            var target = $(source).attr('data');
            $.post('addons/AA_profile_fan/system/open_fans.php', {
                target: target,
                token: utk,
            }, function(response) {
                showModal(response, 500);
                closeTrigger();
            });
        }
        sendThisFan = function(target) {
            $.post('addons/AA_profile_fan/system/action.php', {
                target_fan: target,
                token: utk,
            }, function(response) {
                if (response == 1) {
                    callSaved('You are a fan now', 1);
                    hideModal();
                } else if (response == 2) {
                    callSaved('you allready fan for this member', 3);
                } else {
                    callSaved(system.error, 3);
                }
            });
        }
    </script>
<?php } ?>