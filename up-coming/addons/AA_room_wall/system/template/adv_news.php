<div id="boom_news<?php echo $boom['id']; ?>" data="<?php echo $boom['id']; ?>" class="news_box post_element">
	<div class="post_title">
		<div class=" post_avatar get_info" data="<?php echo $boom['user_id']; ?>">
			<img src="<?php echo myAvatar($boom['user_tumb']); ?>"/>
		</div>
		<div class="bcell_mid hpad5 maxflow post_info">
			<p class="username text_small <?php echo myColor($boom); ?>"><?php echo $boom['user_name']; ?></p>
			<p class="text_xsmall date"><?php echo displayDate($boom['news_date']); ?></p>
		</div>
		<div onclick="openPostOptions(this);" class="post_edit bcell_mid_center">
			<i class="fa fa-ellipsis-h"></i>
			<div class="post_menu fmenu">
				<div onclick="viewAdvNewsLikes(<?php echo $boom['id']; ?>);" class="fmenu_item fmenut">
					<?php echo $lang['view_likes']; ?>
				</div>
				<?php if(canDelPostAdvNews()){ ?>
				<div onclick="deleteAdvNews(this, <?php echo $boom['id']; ?>);" class="fmenu_item fmenut">
					<?php echo $lang['delete']; ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="post_content">
		<?php echo htmlspecialchars_decode(stripslashes(boomPostIt($boom, $boom['news_message']))); ?>
		<?php echo boomPostFile($boom['news_file']); ?>
	</div>
	<div class="post_control btauto">
		<?php if(!muted() && canLikeAdvNews()){ ?>
		<div class="bcell_mid like_container advnewslike<?php echo $boom['id']; ?>">
			<?php echo getAdvLikes($boom['id'], $boom['liked'], 'news'); ?>
		</div>
		<?php } ?>
		<div data="0" class="bcell_mid comment_count bcauto load_comment <?php if($boom['reply_count'] < 1){ echo 'hidden'; } ?>" onclick="loadAdvNewsComment(this, <?php echo $boom['id']; ?>);">
			<span id="advnrepcount<?php echo $boom['id']; ?>"><?php echo $boom['reply_count']; ?></span> <img class="comment_icon" src="<?php echo $data['domain']; ?>/default_images/icons/comment.svg"/>
		</div>
	</div>
	<?php if(!muted() && canReplyAdvNews()){ ?>
	<div class="add_comment_zone cmb<?php echo $boom['id']; ?>">
		<div class="tpad10 reply_post">
			<input onkeydown="advNewsReply(event, <?php echo $boom['id']; ?>, this);" maxlength="500" placeholder="<?php echo $lang['comment_here']; ?>" class="add_comment full_input">
		</div>
	</div>
	<?php } ?>
	<div class="tpad10 ncmtboxwrap<?php echo $boom['id']; ?>">
		<div class="ncmtbox advncmtbox<?php echo $boom['id']; ?>">
		</div>
		<div class="nmorebox advnmorebox<?php echo $boom['id']; ?>">
		</div>
		<div class="clear"></div>
	</div>
</div>
