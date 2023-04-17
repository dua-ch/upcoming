<?php
include(addonsLang('quizbot'));
?>
<script data-cfasync="false">

quizLeaderboard = function(){
	$.post('addons/quizbot/system/leaderboard.php', { 
		token: utk,
		}, function(response) {
		showModal(response, 420);
	});
}

$(document).ready(function(){
	boomAddCss('addons/quizbot/files/quizbot.css');
	appLeftMenu('trophy', 'ابطال المسابقات', 'quizLeaderboard();');
});
</script>