<?php
$key = 'user' . $data['user_id'] . '_' . rand(111111,999999) . rand(111111, 999999);
?>
<div style="
    display: inline-block;
" class="container_sub_player">
	<div class="music_share audio_color" data="<?php echo $key; ?>">
		<div class="music_play bcell_mid">
			<i class="fa fa-play-circle sub_play_icon"></i>
		</div>
		<div class="song_progress bcell_mid">
			<div class="audio_progress" id="slide<?php echo $key; ?>">
				<div class="audio_ball">
				</div>
			</div>
		</div>
		<audio class="chat_audio hidden" id="<?php echo $key; ?>" preload="none" src="<?php echo $boom['file']; ?>"></audio>
	</div>
	<div class="song_title">
		<?php echo $boom['title']; ?>
	</div>
</div>