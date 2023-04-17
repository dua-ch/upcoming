<?php
if(boomAllow(11)){
	$mysqli->query("DROP TABLE `ex_news`");
	$mysqli->query("DROP TABLE `ex_news_reply`");
	$mysqli->query("DROP TABLE `ex_news_like`");
}
?>