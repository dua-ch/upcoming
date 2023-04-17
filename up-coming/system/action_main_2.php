<?php
require_once('config_session.php');

if(!boomAllow(89)){
    die();
}
if (isset($_FILES["file"])){
	ini_set('memory_limit','128M');
	$info = pathinfo($_FILES["file"]["name"]);
	$extension = $info['extension'];
	$origin = escape(filterOrigin($info['filename']) . '.' . $extension);
	$id = escape($_POST['userid']);
	if ( fileError() ){
		echo 1;
		die();
	}
	if (isImage($extension)){
		echo 1;
		die();
	}
	else if (isFile($extension)){
		echo 1;
		die();
	}
	else if (isMusic($extension)){
        $old = BOOM_PATH.'/upload/upload'.$data['ex_pro_music'];
        if(file_exists($old)){
            unlink($old);
        }
		$file_name = encodeFile($extension);
		boomMoveFile('upload/upload/' . $file_name);
		$mysqli->query("UPDATE boom_users SET ex_pro_music = '$file_name' WHERE user_id = '$id'");
		echo 5;
		die();
	}
	else {
		echo 1;
	}
}
else {
	echo 1;
}
?>