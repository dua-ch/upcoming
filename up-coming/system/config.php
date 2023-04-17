<?php
// try {
	// $redis = new Redis();
	// $redis->connect('127.0.0.1', 6379);
	// $redis->auth('8Ra9W_Dx@8aMmzNJhV5');
	// $allowed_requests_per_period = 12;
	// $time_frame_in_seconds       = 60;
	// $total_requests = 0;

	// if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		// $user_ip_address = $_SERVER['HTTP_CLIENT_IP'];
	// } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		// $user_ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
	// } else {
		// $user_ip_address = $_SERVER['REMOTE_ADDR'];
	// }
	// if ($redis->exists($user_ip_address)) {
		// $redis->INCR($user_ip_address);
		// $total_requests = $redis->get($user_ip_address);

		// if ($total_requests > $allowed_requests_per_period) {
			// header('Location: ../error.html');
			// exit();
		// }
	// } else {
		// $redis->set($user_ip_address, 1);
		// $redis->expire($user_ip_address, $time_frame_in_seconds);
		// $total_requests = 1;
	// }
// } catch (Exception $e) {
	// echo $e->getMessage();
// }
session_start();
if (!isset($_COOKIE['stpdOrigin'])) {
	$arr_cookie_options = array (
		'expires' => time() + 3600,
		'path' => '/',
		'domain' => $data['domain'], // leading dot for compatibility or use subdomain
		'secure' => false,     // or false
		'httponly' => false,    // or false
		'samesite' => 'Lax' // None || Lax  || Strict
		);
	setcookie('stpdOrigin', $_SERVER['HTTP_REFERER'], $arr_cookie_options);
}
$boom_access = 0;
require("database.php");
require("variable.php");
require("function.php");
require("function_2.php");
$mysqli = @new mysqli(BOOM_DHOST, BOOM_DUSER, BOOM_DPASS, BOOM_DNAME);
if (mysqli_connect_errno() || $check_install != 1) {
	if($check_install != 1){
		$chat_install = 2;
	}
	else{
		$chat_install = 3;
	}
}
else{
	$chat_install = 1;
	if(isset($_COOKIE[BOOM_PREFIX . 'userid']) && isset($_COOKIE[BOOM_PREFIX . 'utk'])){
		$ident = escape($_COOKIE[BOOM_PREFIX . 'userid']);
		$pass = escape($_COOKIE[BOOM_PREFIX . 'utk']);
		$get_data = $mysqli->query("SELECT boom_setting.*, boom_users.* FROM boom_users, boom_setting WHERE boom_users.user_id = '$ident' AND boom_users.user_password = '$pass' AND boom_setting.id = '1'");
		if($get_data->num_rows > 0){
			$data = $get_data->fetch_assoc();
			$boom_access = 1;
		}
		else {
			$get_data = $mysqli->query("SELECT * FROM boom_setting WHERE boom_setting.id = '1'");
			$data = $get_data->fetch_assoc();
			sessionCleanup();
		}
	}
	else {
		$get_data = $mysqli->query("SELECT * FROM boom_setting WHERE boom_setting.id = '1'");
		$data = $get_data->fetch_assoc();
		sessionCleanup();
	}
	$cur_lang = getLanguage();
	require("language/" . $cur_lang . "/language.php");
}
if($chat_install == 1){
	date_default_timezone_set("{$data['timezone']}");
}
else {
	date_default_timezone_set("America/Montreal");
}
?>