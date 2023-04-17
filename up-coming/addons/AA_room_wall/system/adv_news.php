<?php
$load_addons = 'AA_room_wall';
require_once('../../../system/config_addons.php');

$news_content = '';
$news_count = 0;

$get_news = $mysqli->query("SELECT ex_news.*, boom_users.*,
(SELECT count(id) FROM ex_news) as news_count,
(SELECT count( parent_id ) FROM ex_news_reply WHERE parent_id = ex_news.id ) as reply_count,
(SELECT like_type FROM ex_news_like WHERE uid = '{$data['user_id']}' AND like_post = ex_news.id) as liked
FROM ex_news, boom_users
WHERE ex_news.news_poster = boom_users.user_id AND ex_news.news_room =  '{$data['user_roomid']}'
ORDER BY news_date DESC");

if ($get_news->num_rows > 0) {
	while ($news = $get_news->fetch_assoc()) {
		$news_count = $news['news_count'];
		$news_content .= exTemplate('system/template/adv_news', $news);
	}
	$mysqli->query("UPDATE boom_users SET user_room_news = '" . time() . "' WHERE user_id = '{$data['user_id']}'");
} else {
	$news_content .= emptyZone($lang['no_news']);
}
?>
<style>
	.main_post_control {
		padding: 10px;
		border-radius: 3px 3px 25px 25px;
	}

	#adv_news_file {
		-webkit-appearance: none;
		position: absolute;
		top: 0;
		left: 0;
		opacity: 0;
		width: 100%;
		height: 100%;
		cursor: pointer;
		padding: 0px !important;
	}
</style>
<div class="boom_keep">
	<div class="pad20">
		<?php if (canPostAdvNews()) { ?>
			<div class="vpad10">
			<h2 class="chat_head" style="text-align: center;color: white;padding: 10px;border-radius: 25px 25px 3px 3px;"><i class="fa fa-home i_btm"></i> <?php echo $lang['room_wall']; ?> <span id="room_posts_count" style="background:#fff;color:#012832;font-size:16px;" class="ucount back_theme"><?php echo countRoomPostsWall(); ?></span></h2>
				<div class="add_post_container">
					<div id="add_wall_form">
						<div class="post_input_container">
							<textarea onkeyup="textArea(this, 60);" id="news_data" maxlength="3000" spellcheck="false" placeholder="<?php echo $lang['start_new_post']; ?>" class="full_textarea"></textarea>
							<div id="adv_post_file_data" class="pad10 main_post_data hidden" data-key="">
							</div>
						</div>
						<div class="main_post_control chat_head">
							<div class="main_post_item">
								<i class="fa fa-image"></i>
								<input id="adv_news_file" onchange="uploadAdvNews();" type="file" />
							</div>
							<div class="main_post_button">
								<button onclick="sendAdvNews();" class="small_button rounded_button theme_btn"><i class="fa fa-send"></i> <?php echo $lang['post']; ?></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<div id="container_news">
			<?php echo $news_content; ?>
		</div>
	</div>
</div>