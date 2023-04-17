<style>
		.seen_msg {
			border-radius: 25px;
			box-shadow: 0 0 10px #ff61ad;
			margin-bottom: 8px;
			background: #ffe6f2;
			color: #330019;
		}
	</style>
<?php if (boomAllow($addons['addons_access'])) {
	$bbfv = boomFileVersion();
?>
	<script data-cfasync="false" type="text/javascript">
		$(document).ready(function() {
			boomAddCss('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
			appLeftMenu('envelope warn', 'رسالة مميزة', 'showSendEhdaa();');
			showSendEhdaa = function() {
				$.post('addons/AA_special_message/system/sw_send_msg.php', {
					token: utk,
				}, function(response) {
					if (response == 0) {
						callSaved(system.error, 3);
					} else {
						overModal(response);
					}
				});
			}
			sendEhdaa = function() {
				$.post('addons/AA_special_message/system/action.php', {
					sendehdaa_text: $('#my_new_ehdaa').val(),
					token: utk
				}, function(response) {
					callSaved('تم ارسال الرسالة المميزة وخصم النقاط', 1);
					hideOver();
					return true;
				});
			}
		});
	</script>
<?php } ?>