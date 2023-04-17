<?php
/*===============================================*
 |                                               |
 |   Development      :  [AMEER_PS]              |
 |                                               |
 |   addon name       :  [YILDIZ_GIFT]           |
 |                                               |
 |   Version          :  [1.0]                   |
 |                                               |
 |   Codychat version :  [CODYCHAT 3.6]          |
 |                                               |
 *===============================================*/
$load_addons = 'yildiz_gift';
require_once('../../../system/config_addons.php');
/*---------ADMIN---------*/
if(boomAllow(10)){
if(isset($_FILES["file"], $_POST['gift_name'] , $_POST['gift_quiz'])){
	        $name = escape($_POST['gift_name']);
	        $quiz = escape($_POST['gift_quiz']);
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$path = '../files/upload/'; // upload directory
			
			if($_FILES['file']){
				$img = $_FILES['file']['name'];
				$tmp = $_FILES['file']['tmp_name'];
				$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
				$final_image = rand(10,1000).$img;
				if(in_array($ext, $valid_extensions)) { 
					$path = $path.strtolower($final_image); 
					$myfile = $data['domain'] . "/addons/yildiz_gift/files/upload/" . $final_image;
					if(move_uploaded_file($tmp,$path)) {
	           $mysqli->query("INSERT INTO `boom_gift` (`gift_name`,`gift_quiz`,gift_img) VALUES ('$name','$quiz','$myfile');");
					}
				 }
			}
    $last_id = $mysqli->insert_id;
	$get_back = $mysqli->query("SELECT * FROM boom_gift WHERE id = '$last_id'");
	if($get_back->num_rows == 1){
		$Ggift = $get_back->fetch_assoc();
		$content = ps_Template('element/list_gift', $Ggift);
		echo boomCode(1, array('data'=> $content));
		die();
	}
	else {
		echo boomCode(0);
		die();
	}
}

if(isset($_POST['set_addon_access'],$_POST['set_addon_box'],$_POST['set_addon_quiz'])){
	$addon_access = escape($_POST['set_addon_access']);
	$custom1 = escape($_POST['set_addon_box']);
	$custom2 = escape($_POST['set_addon_quiz']);
	$mysqli->query("UPDATE boom_addons set addons_access = '$addon_access',custom1= '$custom1',custom2 = '$custom2' WHERE addons = 'yildiz_gift'");
	echo 1;
	die();
}
if(isset($_POST['delete_gift'])){
	$id = escape($_POST['delete_gift']);
	$mysqli->query("DELETE FROM boom_gift WHERE id = '$id'");
	echo 1;
	die();
}
if(isset($_POST['gift_save'], $_POST['gift_name'], $_POST['gift_quiz'])){
	$id = escape($_POST['gift_save']);
	$name = escape($_POST['gift_name']);
	$quiz = escape($_POST['gift_quiz']);
	$mysqli->query("UPDATE boom_gift SET gift_name = '$name', gift_quiz = '$quiz' WHERE id = '$id'");
	$get_back = $mysqli->query("SELECT * FROM boom_gift WHERE id = '$id'");
	if($get_back->num_rows == 1){
		$sstore = $get_back->fetch_assoc();
		$content = ps_Template('element/list_gift', $sstore);
		echo boomCode(1, array('data'=> $content));
		die();
	}
	else {
		echo boomCode(0);
		die();
	}
}
/*---------ADMIN---------*/
}
if (isset($_POST['saveGift'], $_POST['gift_id'], $_POST['info_gift'], $_POST['target'], $_POST['count_gift'])){
	$target = escape($_POST['target']); 
	$id = escape($_POST['gift_id']); 
	$count = escape($_POST['count_gift']);
	$info = escape($_POST['info_gift']);
	$user = userDetails($target);
	$gift = getGift($id);
	$price = $gift['gift_quiz'] * $count ;
	$end_quiz = $price * (1 - 20/100);
	$fame = $price * (1 - 90/100);
	if($id == ''){
	echo 3;
	die();
    }
	if($data['user_points'] < $price){
	echo 4;
	die();
    }
	if($count <= 0 || $count > 10){
	echo 5;
	die();
    }
	if($info == ''){
	echo 6;
	die();
    }
    /*----------------------------------------------------*/	
	$emo = '<img class="fancybox gift_img imgGiftpub" href="'.$gift['gift_img'].'" src="'.$gift['gift_img'].'">';
    $send = '<b class="red">'.$data['user_name'].'</b> ارسل هدية الى <b class="green">'.$user['user_name'].'</b> ( الاهداء : <b class="blue">'.$info.'</b>) '.$emo.'  عدد : <b class="red">('.$count.')</b>';
	/*----------------------------------------------------*/	
	if($data['user_points'] >= $price){
    $mysqli->query("UPDATE boom_users SET user_points = user_points - '$price' WHERE user_id = {$data['user_id']}");
	$mysqli->query("UPDATE boom_users SET user_points = user_points + $end_quiz WHERE user_id = '$target'");
	$mysqli->query("UPDATE boom_users SET user_fame = user_fame + $fame WHERE user_id = '$target'");
	$mysqli->query("INSERT INTO `boom_gift_send` (`gift_name`,`gift_img`,`user_id`,`gift_count`) VALUES ('{$gift['gift_name']}','{$gift['gift_img']}','$target','$count');");
	systemPostgift($data['user_roomid'],$send);
	if($price >= $data['custom2']){
	$mysqli->query("UPDATE boom_users SET gifts = 1 WHERE user_id");
	$mysqli->query("UPDATE boom_users SET show_gift = '$send' WHERE user_id");
    }
    }
	echo 1;
	die();
}
?>
