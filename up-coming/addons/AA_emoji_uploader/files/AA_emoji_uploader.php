<?php
include(addonsLang('AA_emoji_uploader'));
if (boomAllow($addons['addons_access'])) { ?>
    <script data-cfasync="false">
        $(document).ready(function() {
            appLeftMenu('smile', '<?php echo $lang['emoji_uploader']; ?>', 'emojiUploaderTemplate();');
        });
        emojiUploaderTemplate = function() {
            $.post('addons/AA_emoji_uploader/system/template/emo_uploader_temp.php', {
                token: utk,
            }, function(response) {
                if (response == 0) {
                    callSaved(system.error, 3);
                } else {
                    showModal(response, 600);
                }
            });
        }
    </script>
<?php } ?>