<?php
$load_addons = 'AA_emoji_uploader';
require_once('../../../../system/config_addons.php');
if (!boomAllow($data['addons_access'])) {
    die();
}
?>
<div class="pad_box">
    <div id="emo_list" class="tab_zone">
        <button type="button" onclick="addEmoticonBox();" class="reg_button theme_btn"><i class="fa fa-upload"></i> Upload emoji</button>
        <br>
        <div class="setting_element ">
            <div class="emo_head main_emo_head">
                <div data="" class="dark_selected emo_menu emo_menu_item_temp"><img class="emo_select" src="emoticon_icon/base_emo.png" /></div>
                <?php echo emoListMenuTemp(); ?>
                <div class="empty_emo"></div>
            </div>
            <div id="main_emo_temp" class="emo_content emo_content_admin">
                <?php echo emoLoadList(''); ?>
            </div>
        </div>
    </div>
</div>
<script data-cfasync="false">
    var waitUplodEmoimg = 0;
    $(document).on('click', '.emo_menu_item_temp', function() {
        if (waitUplodEmoimg == 0) {
            waitUplodEmoimg = 1;
            var thisEmo = $(this).attr('data');
            var emoSelect = $(this);
            $.post('addons/AA_emoji_uploader/system/action.php', {
                get_emo_temp: thisEmo,
                token: utk,
            }, function(response) {
                $('#main_emo_temp').html(response);
                $('.emo_menu_item_temp').removeClass('dark_selected');
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
                    hideOver();
                }
            });
            $(".sticker img").each(function(index) {
                if ($(this).attr('src') == target) {
                    $(this).parent().remove();
                    callSaved(system.saved, 1);
                    hideOver();
                }
            });
        });
    }
    addEmoticonBox = function() {
        $.post('addons/AA_emoji_uploader/system/template/emo_add.php', {
            token: utk,
        }, function(response) {
            overModal(response, 500);
        });
    }
    emo_edit = function(emo) {
        $.post('addons/AA_emoji_uploader/system/template/emo_edit.php', {
            emo_name: $(emo).parent().attr('title'),
            src: $(emo).attr('src'),
            token: utk,
        }, function(response) {
            overModal(response, 200);
            var src = $('#emo_image_edit img').attr('src');
            $('#emo_name').val(src);
        });
    }
</script>