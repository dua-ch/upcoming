<?php
$bbfv = boomFileVersion();
?>
<script data-cfasync="false" src="addons/AA_chat_stories/files/function.js?v=<?php echo time(); ?>"></script>
<script data-cfasync="false">
    var storyUploadDirectory = "<?php echo $data["domain"]; ?>/addons/AA_chat_stories/actions/upload/";
    boomAddCss('addons/AA_chat_stories/files/story.css?v=<?php echo time(); ?>');
</script>
<?php if (!boomAllow($addons['addons_access'])) { ?>
    <style>
        #story_post,
        .main_post_button,
        #story_file,
        .main_post_control {
            display: none;
        }
    </style>
<?php } ?>
<?php if (boomAllow($addons['addons_access'])) { ?>
    <script data-cfasync="false">
        Mystory = function() {
            closeLeft();
            panelIt(400, 1);
            $.post('addons/AA_chat_stories/system/Mystory.php', {
                token: utk,
            }, function(response) {
                chatRightIt(response);
                selectIt();
            });
        }
        showAllStories = function() {
            closeLeft();
            panelIt(400, 1);
            $.post('addons/AA_chat_stories/system/show_stories.php', {
                token: utk,
            }, function(response) {
                chatRightIt(response);
                selectIt();
            });
        }
        appLeftMenu('camera-retro', 'Add Story', 'getStoriesList();');
        $('<div id="chat_story" title="Chat Stories" class="head_option" onclick="showAllStories();"><i class="fa fa-camera-retro i_btm"></i><div id="chat_story_bar" class="head_notify bnotify" style="display: none;">New</div></div>').insertBefore('#get_private');
    </script>
<?php } ?>
<script data-cfasync="false">
    delOldStory = function() {
        $.post('addons/AA_chat_stories/system/action.php', {
            del_old_story: 1,
            token: utk,
        }, function(response) {});
    }
    getStoryNoti = function() {
        $.ajax({
            url: "addons/AA_chat_stories/system/action_noti.php",
            type: "post",
            cache: false,
            dataType: 'json',
            data: {
                token: utk
            },
            success: function(response) {
                var counter = response.count;
                if ((counter) != 0) {
                    $("#chat_story_bar").text(counter).css('display', 'block');
                } else {
                    $("#chat_story_bar").css('display', 'none');
                }
            },
            error: function() {
                return false;
            }

        });
    }
    whoSeeMine = function(id) {
        $.post('addons/AA_chat_stories/system/who_see.php', {
            target:id,
            token: utk,
        }, function(response) {
            showModal(response);
        });
    }
    seeThisStory = function(id) {
        $.post('addons/AA_chat_stories/system/action.php', {
            story_seen_id: id,
            token: utk,
        }, function(response) {});
    }
    $(document).ready(function() {
        endThisStory = setInterval(delOldStory, 1000);
        updateStoryNoti = setInterval(getStoryNoti, 1000);
        delOldStory();
        getStoryNoti();
    });
</script>