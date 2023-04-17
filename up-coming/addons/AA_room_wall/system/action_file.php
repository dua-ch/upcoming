<?php
$load_addons = 'AA_room_wall';
require_once('../../../system/config_addons.php');


if(muted()){
	die();
}
if(checkFlood()){
	echo boomCode(1);
	die();
}
if (isset($_FILES["file"])){
	$info = pathinfo($_FILES["file"]["name"]);
	$extension = $info['extension'];
	$origin = escape(filterOrigin($info['filename']) . '.' . $extension);
	if ( fileError() ){
		echo boomCode(1);
		die();
	}
	$file_name = encodeFile($extension);
	if (isImage($extension)){
		$imginfo = getimagesize($_FILES["file"]["tmp_name"]);
		if ($imginfo !== false) {
			boomMoveFile('upload/news/' . $file_name);
			$filedata['image'] = $data['domain'] . "/upload/news/" . $file_name;
			$filedata['encrypt'] = encrypt($file_name);
			$mysqli->query("INSERT INTO boom_upload (file_name, file_key, date_sent, file_user, file_zone, file_type, file_complete) VALUES ('$file_name', '{$filedata['encrypt']}', '" . time() . "', '{$data['user_id']}', 'news', 'image', 0)");
			echo boomCode(0, array("file" => boomTemplate('element/post_file_template', $filedata),"key" => $filedata['encrypt']));
			die();
		}
		else {
			echo boomCode(1);
			die();
		}
	}
	else {
		echo boomCode(1);
		die();
	}
}
else {
	echo boomCode(1);
	die();
}