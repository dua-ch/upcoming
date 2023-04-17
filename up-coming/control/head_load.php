<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
use MyChatSocket\WSChatHelper;
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;
use DeviceDetector\Parser\OperatingSystem;
AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

$uadev = htmlentities($_SERVER['HTTP_USER_AGENT']);
$clientHints = ClientHints::factory($_SERVER); // client hints are optional
$detect = new DeviceDetector($uadev, $clientHints);
$detect->parse();
$userInfo = $detect->getClient();
$osInfo = $detect->getOs();
$ubrowser = $userInfo['name'];
$ubrowser_ver = $userInfo['engine_version'];
$device = $detect->getDeviceName();
$brand = $detect->getBrandName();
$model = $detect->getModel();
$brand = $brand != '' ? '/ '.$brand : '';
$model = $model != '' ? '/ '.$model : '';
$osInfoName = $osInfo['name'];
$wver = '';
if($osInfoName == 'Windows'){
					$wver = $osInfo['version'] .' / '.$osInfo['platform'];
				} else {
					$wver = $osInfo['version'];
				}
$divceCode = sha1(str_rot13($device.$brand.$model.$osInfoName.$wver));
$mip = getIp();
$loc = geoCurl("http://www.geoplugin.net/php.gp?ip=" . $mip);
$res = unserialize($loc);
$country_name = escape($res["geoplugin_countryName"]); 

if ($chat_install != 1) {
	header('location: ./');
	die();
}
$ip = getIp();
$page = getPageData($page_info);
$bbfv = '?v='.time();
$brtl = 0;
if (isRtl($cur_lang) && $page['page_rtl'] == 1) {
	$brtl = 1;
}
if ($page['page'] == 'chat') {
	$room = roomDetails(1);
	$page['page_title'] = $room['room_name'];
	$radio = getPlayer($room['room_player_id']);
}
if (boomLogged() && !boomAllow($page['page_rank'])) {
	header('location: ' . $data['domain']);
	die();
}
$myroom = roomInfo($data['user_roomid']);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
	<base href="<?php echo $data['domain']; ?>">
	<link rel="canonical" href="<?php echo $data['domain']; ?>" />
	<title><?php echo $page['page_title']; ?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name='dmca-site-verification' content='SzhCdnhDL3FheE5SRmNvSktBbE56Zz090' />
	<meta name="description" content="<?php echo $page['page_description']; ?>">
	<meta name="keywords" content="<?php echo $page['page_keyword']; ?>">
	<meta property="og:title" content="<?php echo $page['page_title']; ?>" />
	<meta property="og:description" content="<?php echo $page['page_description']; ?>" />
	<meta property="og:site_name" content="<?php echo $page['page_title']; ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php echo $data['domain']; ?>" />
	<meta property="og:image" content="<?php echo $data['domain']; ?>/default_images/logo.png" />
	<meta property="og:image:type" content="image/png" />
	<meta property="og:image:width" content="200" />
	<meta property="og:image:height" content="200" />
	<meta property="og:image:alt" content="<?php echo $page['page_title']; ?>" />
	<meta name="twitter:title" content="<?php echo $page['page_title']; ?>" />
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:description" content="<?php echo $page['page_description']; ?>" />
	<meta name="twitter:site" content="<?php echo $data['domain']; ?>" />
	<meta name="twitter:image" content="<?php echo $data['domain']; ?>/default_images/logo.png" />
	<meta name="twitter:image:alt" content="<?php echo $page['page_title']; ?>" />
	<meta name="twitter:creator" content="شات دندنة" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<link id="siteicon" rel="shortcut icon" type="image/png" href="default_images/icon.png<?php echo $bbfv; ?>" />
	<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css<?php echo $bbfv; ?>" media="screen" />
	<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
	<link rel="stylesheet" type="text/css" href="css/selectboxit.css<?php echo $bbfv; ?>" />
	<link rel="stylesheet" type="text/css" href="js/jqueryui/jquery-ui.min.css<?php echo $bbfv; ?>" />
	<link rel="stylesheet" type="text/css" href="css/main.css<?php echo $bbfv; ?>" />
	<link rel="stylesheet" type="text/css" href="js/JBox1.3.3/jBox.all.min.css<?php echo $bbfv; ?>" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">
	<?php if (!boomLogged()) { ?>
		<link rel="stylesheet" type="text/css" href="control/login/<?php echo getLoginPage(); ?>/login.css<?php echo $bbfv; ?>" />
	<?php } ?>
	<link id="gradient_sheet" rel="stylesheet" type="text/css" href="css/colors.css<?php echo $bbfv; ?>" />
	<link id="actual_theme" rel="stylesheet" type="text/css" href="css/themes/<?php echo getTheme(); ?><?php echo $bbfv; ?>" />
	<?php if (!empty($myroom['ex_room_bg'])) { ?>
		<link id="actual_theme" rel="stylesheet" type="text/css" href="css/custom-lite/custom-lite.css<?php echo $bbfv; ?>" />
	<?php } ?>
	<link rel="stylesheet" type="text/css" href="css/responsive.css<?php echo $bbfv; ?>" />
	<link rel="stylesheet" type="text/css" href="css/spectrum.css<?php echo $bbfv; ?>" />
	<script data-cfasync="false" src="js/jquery-1.11.2.min.js<?php echo $bbfv; ?>"></script>
	<script data-cfasync="false" src="system/language/<?php echo $cur_lang; ?>/language.js<?php echo $bbfv; ?>"></script>
	<script data-cfasync="false" src="js/fancybox/jquery.fancybox.js<?php echo $bbfv; ?>"></script>
	<script data-cfasync="false" src="js/jqueryui/jquery-ui.min.js<?php echo $bbfv; ?>"></script>
	<script data-cfasync="false" src="js/global.min.js<?php echo $bbfv; ?>"></script>
	<script data-cfasync="false" src="js/function_split.js<?php echo $bbfv; ?>"></script>
	<script data-cfasync="false" src="js/JBox1.3.3/jBox.all.min.js<?php echo $bbfv; ?>"></script>
	<script data-cfasync="false" src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.1/spectrum.min.js<?php echo $bbfv; ?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
	<?php if (boomRecaptcha() && !boomLogged()) { ?>
		<script src='https://google.com/recaptcha/api.js'></script>
	<?php } ?>
	<?php if (boomLogged()) { ?>
		<script data-cfasync="false" src="js/function_logged.js<?php echo $bbfv; ?>"></script>
	<?php } ?>
	<?php if ($brtl == 1) { ?>
		<link rel="stylesheet" type="text/css" href="css/rtl.css<?php echo $bbfv; ?>" />
	<?php } ?>
	<link rel="stylesheet" type="text/css" href="css/custom.css<?php echo $bbfv; ?>" />
	<script data-cfasync="false">
		var pageEmbed = <?php echo embedCode(); ?>;
		var pageRoom = <?php echo $page['page_room']; ?>;
		var curPage = '<?php echo $page['page']; ?>';
		var loadPage = '<?php echo $page['page_load']; ?>';
		var bbfv = '<?php echo $bbfv; ?>';
		var rtlMode = '<?php echo $brtl; ?>';
	</script>
	<?php if (!boomLogged()) { ?>
		<script data-cfasync="false">
			var logged = 0;
			var utk = '0';
			var recapt = <?php echo $data['use_recapt']; ?>;
			var recaptKey = '<?php echo $data['recapt_key']; ?>';
		</script>
	<?php } ?>
	<?php if (boomLogged()) { ?>
		<script data-cfasync="false">
			var user_rank = <?php echo $data["user_rank"]; ?>;
			var user_id = <?php echo $data["user_id"]; ?>;
			var utk = '<?php echo setToken(); ?>';
			var avw = <?php echo $data['max_avatar']; ?>;
			var cvw = <?php echo $data['max_cover']; ?>;
			var fmw = <?php echo $data['file_weight']; ?>;
			var uSound = '<?php echo $data['user_sound']; ?>';
			var logged = 1;
			var systemLoaded = 0;
			var room_bg = '<?php echo $myroom['ex_room_bg']; ?>';
			var prv_seen = <?php echo $data['private_seen']; ?>;
		</script>
	<?php } ?>
	<?php if (boomLogged() && $page['page'] == 'chat') { ?>
		<script data-cfasync="false">
			var user_room = <?php echo $data['user_roomid']; ?>;
			var sesid = '<?php echo $data['session_id']; ?>';
			var my_id = '<?php echo $data['user_id']; ?>';
			var userAction = '<?php echo $data['user_action']; ?>';
			var pCount = "<?php echo $data['pcount']; ?>";
			var source = "<?php echo $radio['player_url']; ?>";
			var speed = <?php echo $data['speed']; ?>;
			var inOut = <?php echo $data['act_delay']; ?>;
			var snum = "<?php echo genSnum(); ?>";
			var balStart = <?php echo $cody['act_time']; ?>;
			var rightHide = <?php echo $cody['rbreak']; ?>;
			var rightHide2 = <?php echo $cody['rbreak'] + 1; ?>;
			var leftHide = <?php echo $cody['lbreak']; ?>;
			var leftHide2 = <?php echo $cody['lbreak'] + 1; ?>;
			var defRightWidth = <?php echo $cody['right_size']; ?>;
			var defLeftWidth = <?php echo $cody['left_size']; ?>;
			var cardCover = <?php echo $cody['card_cover']; ?>;
			var userAge = "<?php echo $lang['years_old']; ?>";
		</script>
	<?php } ?>
	<script>
		// ss
	</script>
</head>

<body>
	<?php
	if (checkBanDevice($divceCode)) {
		include('device.php');
		include('body_end.php');
		die();
	}
	if (checkBanCountry($country_name)) {
		include('country.php');
		include('body_end.php');
		die();
	}
	if (checkBanBrowser($ubrowser)) {
		include('browser.php');
		include('body_end.php');
		die();
	}
	if (checkBan($ip)) {
		include('banned.php');
		include('body_end.php');
		die();
	}
	if (checkKick()) {
		include('kicked.php');
		include('body_end.php');
		die();
	}
	if (boomLogged() && mustVerify()) {
		include('verification.php');
		include('body_end.php');
		die();
	}
	if (maintMode()) {
		include('maintenance.php');
		include('body_end.php');
		die();
	}
	if (!boomLogged() && $page['page_out'] == 0) {
		include('control/login/' . getLoginPage() . '/login.php');
		include('body_end.php');
		die();
	}
	if ($page['page'] == 'chat') {
		createIgnore();
	}
	// $expire_ref = strtotime('-1 hour', time());
	// if (isset($_GET['referer']) && !empty($_GET['referer']) && boomLogged() && $data['user_join'] >= $expire_ref) {
		// $id = escape($_GET['referer']);
		// $myIP = getIp();
		// $ok_ref = 1;
		// $refUser = refererDetailsUser($data['user_id']);
		// $refIp = refererDetailsIp($myIP);
		// $refFp = refererDetailsFp($data['ex_finger_print']);
		// if (!empty($refUser)) {
			// $ok_ref = 0;
		// }
		// if (!empty($refIp)) {
			// $ok_ref = 0;
		// }
		// if (!empty($refFp)) {
			// $ok_ref = 0;
		// }
		// if ($ok_ref == 1) {
			// $mysqli->query("INSERT INTO referer_sys (hunter, target, ip, fp) VALUES ('{$data['user_id']}', '$id', '$myIP', '{$data['ex_finger_print']}')");
		// }
		// if (!empty($refUser) && $refUser['fp'] == '') {
			// $mysqli->query("UPDATE boom_users SET user_action = user_action + 1 WHERE user_id = '{$data['user_id']}'");
			// $mysqli->query("UPDATE referer_sys SET fp = '{$data['ex_finger_print']}' WHERE hunter = '{$data['user_id']}' AND target = '$id' AND ip = '$myIP'");
		// }
	// }
	// if (isset($_COOKIE['stpdOrigin']) && boomLogged()) {
		// $referer = escape($_COOKIE['stpdOrigin']);
		// if ($data['referer_link'] == '') {
			// $mysqli->query("UPDATE boom_users SET referer_link = '$referer' WHERE user_id = '{$data['user_id']}'");
		// }
	// }
	?>