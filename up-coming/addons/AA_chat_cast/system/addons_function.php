<?php
function exTemplate($getpage, $boom = ''){
	global $data, $lang, $mysqli, $cody;
	$page = BOOM_PATH . '/addons/AA_chat_cast/' . $getpage . '.php';
	$structure = '';
	ob_start();
	require($page);
	$structure = ob_get_contents();
	ob_end_clean();
	return $structure;
}
