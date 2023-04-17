<?php 
if(boomAllow($addons['addons_access'])){
	require(addonsLang('contact_us'));
} 
?>
<?php if(boomAllow($addons['addons_access'])){ ?>
<script data-cfasync="false">
openContactUs = function(){
	$.post('addons/contact_us/system/contact_us.php', {
		token: utk,
		}, function(response) {
			showModal(response, 500);
	});
}
sendContactUs = function(){
	var semail = $('#contact_us_email').val();
	var smessage = $('#contact_us_message').val();
	var ssubject = $('#contact_us_subject').val();
	if(semail == '' || smessage == ''){
		callSaved(system.emptyField, 3);
		event.preventDefault();
	}
	else if (/^\s+$/.test(semail) || /^\s+$/.test(smessage)){
		callSaved(system.emptyField, 3);
		event.preventDefault();
	}
	else {
		$('#contact_us_form').hide();
		$('#contact_us_sending').show();
		$.post('addons/contact_us/system/action.php', { 
			email: semail,
			message: smessage,
			subject: ssubject,
			token: utk,
			}, function(response) {
				if(response == 1){
					$('#contact_us_form').remove();
					$('#contact_us_sending').hide();
					$('#contact_us_sent').show();
				}
				else if(response == 2){
					$('#contact_us_sending').hide();
					$('#contact_us_form').show();
					$('#contact_us_email').val('');
					callSaved(system.invalidEmail, 3);
				}
				else {
					hideModal();
					callSaved(system.error, 3);
					return false;
				}
		});
	}
}
$(document).ready(function() {
	appLeftMenu('envelope', '<?php echo $lang['contact_us']; ?>', 'openContactUs();');
});
</script>
<?php } ?>