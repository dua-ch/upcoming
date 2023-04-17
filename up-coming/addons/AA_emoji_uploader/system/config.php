<?php
$load_addons = 'AA_emoji_uploader';
require_once('../../../system/config_addons.php');
if (!boomAllow($cody['can_manage_addons'])) {
    die();
}
?>
<?php echo elementTitle($data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>
<div class="page_full">
    <div>
        <div class="tab_menu">
            <ul>
                <li class="tab_menu_item tab_selected" data="korsy" data-z="upload_emoji"><i class="fa fa-cogs"></i> <?php echo $lang['emoji_uploader']; ?></li>
                <li class="tab_menu_item" data="korsy" data-z="setting"><i class="fa fa-cogs"></i> <?php echo $lang['settings']; ?></li>
            </ul>
        </div>
    </div>
    <div class="page_element">
        <div id="korsy" class="tpad15">
            <div id="upload_emoji" class="tab_zone">
                <button type="button" onclick="addEmoticonBox();" class="reg_button theme_btn"><i class="fa fa-upload"></i> Upload emoji</button>
                <br>
                <div class="setting_element ">
                    <div class="emo_head main_emo_head">
                        <div data="" class="dark_selected emo_menu emo_menu_item"><img class="emo_select" src="emoticon_icon/base_emo.png" /></div>
                        <?php echo emoListMenu(); ?>
                        <div class="empty_emo"></div>
                    </div>
                    <div id="main_emo" class="emo_content emo_content_admin">
                        <?php echo emoLoadList(''); ?>
                    </div>
                </div>
            </div>
            <div id="setting" class="tab_zone hide_zone">
                <div class="setting_element ">
                    <p class="label"><?php echo $lang['lim_emoji_uploader']; ?></p>
                    <select id="set_emoji_up_to">
                        <?php echo listRank($data['addons_access'], 1); ?>
                    </select>
                </div>
                <button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
            </div>
        </div>
    </div>

    <div class="config_section">
        <script data-cfasync="false">
            saveSettings = function() {
                $.post('addons/AA_emoji_uploader/system/action.php', {
                    set_emoji_up_to: $('#set_emoji_up_to').val(),
                    token: utk,
                }, function(response) {
                    if (response == 1) {
                        callSaved(system.saved, 1);
                    } else {
                        callSaved(system.error, 3);
                    }

                });
            }
            var waitUplodEmoimg = 0;
            $(document).on('click', '.emo_menu_item', function() {
                if (waitUplodEmoimg == 0) {
                    waitUplodEmoimg = 1;
                    var thisEmo = $(this).attr('data');
                    var emoSelect = $(this);
                    $.post('addons/AA_emoji_uploader/system/action.php', {
                        get_emo: thisEmo,
                        token: utk,
                    }, function(response) {
                        $('#main_emo').html(response);
                        $('.emo_menu_item').removeClass('dark_selected');
                        emoSelect.addClass('dark_selected');
                        waitUplodEmoimg = 0;
                    });
                }
            });
            delete_emoji = function() {
                var target = $('#emo_name').val();
                $.post('addons/AA_emoji_uploader/system/action.php', {
                    delete_emo: target,
                    token: utk,
                }, function(response) {
                    $(".emoticon img").each(function(index) {
                        if ($(this).attr('src') == target) {
                            $(this).parent().remove();
                            callSaved(system.saved, 1);
                            hideModal();
                        }
                    });
                    $(".sticker img").each(function(index) {
                        if ($(this).attr('src') == target) {
                            $(this).parent().remove();
                            callSaved(system.saved, 1);
                            hideModal();
                        }
                    });
                });
            }
            addEmoticonBox = function() {
                $.post('addons/AA_emoji_uploader/system/template/emo_add.php', {
                    token: utk,
                }, function(response) {
                    showModal(response, 600);
                });
            }
            emo_edit = function(emo) {
                $.post('addons/AA_emoji_uploader/system/template/emo_edit.php', {
                    emo_name: $(emo).parent().attr('title'),
                    src: $(emo).attr('src'),
                    token: utk,
                }, function(response) {
                    showModal(response, 200);
                    var src = $('#emo_image_edit img').attr('src');
                    $('#emo_name').val(src);
                });
            }
        </script>
    </div>