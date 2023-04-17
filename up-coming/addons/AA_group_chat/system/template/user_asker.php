<div class="ulist_item group_ask_<?php echo $boom['group_id']; ?>">
    <div class="ulist_avatar">
        <img src="<?php echo myAvatar($boom['user_tumb']); ?>" />
    </div>
    <div class="ulist_name">
        <p class="username <?php echo myColor($boom); ?>"><?php echo $boom["user_name"]; ?></p>
        <p class="sub_text">Invited you to group chat.</p>
    </div>
    <div onclick="declineGchat('<?php echo $boom['group_id']; ?>');" class="ulist_option">
        <i class="fa fa-times error"></i></button>
    </div>
    <div onclick="acceptGchat('<?php echo $boom['group_id']; ?>');" class="ulist_option">
        <i class="fa fa-check success"></i>
    </div>
</div>