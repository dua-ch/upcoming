<?php if (boomAllow($addons['addons_access'])) {
	$bbfv = boomFileVersion();
?>
	<script data-cfasync="false" type="text/javascript">
		$(document).ready(function() {
			appLeftMenu('bullhorn', 'اعلانات الشات', 'showChatCast();');

			showChatCast = function() {
				$.post('addons/AA_chat_cast/system/sw_chat_cast.php', {
					token: utk,
				}, function(response) {
					if (response == 0) {
						callSaved(system.error, 3);
					} else {
						overModal(response);
					}
				});
			}
			sendCastAll = function() {
				$.post('addons/AA_chat_cast/system/action.php', {
					send_cast_all: $('#send_cast_all').val(),
					token: utk
				}, function(response) {
					callSaved('تم ارسال الاعلان', 1);
					hideOver();
					return true;
				});
			}
			sendCastStaff = function() {
				$.post('addons/AA_chat_cast/system/action.php', {
					send_cast_staff: $('#send_cast_staff').val(),
					token: utk
				}, function(response) {
					callSaved('تم ارسال الاعلان', 1);
					hideOver();
					return true;
				});
			}
			sendCastHide = function() {
				$.post('addons/AA_chat_cast/system/action.php', {
					send_cast_hide: $('#send_cast_hide').val(),
					token: utk
				}, function(response) {
					callSaved('تم ارسال الاعلان', 1);
					hideOver();
					return true;
				});
			}
		});
	</script>
<?php } ?>
<audio class="hidden" id="cast_sound" src="addons/AA_chat_cast/files/cast.mp3<?php echo $bbfv; ?>"></audio>
<script data-cfasync="false" type="text/javascript">
	var myRole = <?php echo $data['user_role']; ?>;
	castPlay = function() {
		if (boomSound(3)) {
			document.getElementById('cast_sound').play();
		}
	}
	sendMyCast = function() {
		$.ajax({
			url: "addons/AA_chat_cast/system/check_cast.php",
			type: "post",
			cache: false,
			dataType: 'json',
			data: {
				token: utk
			},
			success: function(response) {
				var Caster = response.caster;
				var CasterRank = response.rankcaster;
				var sCast = response.sCast;
				if (Caster == 1 && myRole >= 4 || Caster == 1 && user_rank >= CasterRank) {
					endCast();
					castPlay();
					showEmptyModal(sCast);
				}
			},
			error: function() {
				return false;
			}
		});
	}
	endCast = function() {
		$.post('addons/AA_chat_cast/system/check_cast.php', {
			end_cast: 1,
			token: utk,
		}, function(response) {});
	}
	$(document).ready(function() {
		myCast = setInterval(sendMyCast, 2000);
		sendMyCast();
	});
</script>