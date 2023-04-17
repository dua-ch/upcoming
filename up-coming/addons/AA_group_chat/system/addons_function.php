<?php
function sub_Template($getpage, $boom = '')
{
	global $data, $lang, $mysqli, $cody;
	$page = BOOM_PATH . '/addons/AA_group_chat/' . $getpage . '.php';
	$structure = '';
	ob_start();
	require($page);
	$structure = ob_get_contents();
	ob_end_clean();
	return $structure;
}
function userPostGroupChat($content, $custom = array()){
	global $mysqli, $data;
	$def = array(
		'hunter'=> $data['user_id'],
		'room'=> $data['user_group'],
		'color'=> escape(myTextColor($data)),
		'type'=> 'public__message',
		'rank'=> 99,
		'snum'=> '',
	);
	$c = array_merge($def, $data, $custom);
	$mysqli->query("INSERT INTO `group_chat` (post_date, user_id, post_message, group_id, type, log_rank, snum, tcolor) VALUES ('" . time() . "', '{$c['hunter']}', '$content', '{$c['room']}', '{$c['type']}', '{$c['rank']}', '{$c['snum']}', '{$c['color']}')");
	$last_id = $mysqli->insert_id;
	if(!empty($c['snum'])){
		$user_post = array(
			'post_id'=> $last_id,
			'type'=> $c['type'],
			'post_date'=> time(),
			'tcolor'=> $c['color'],
			'log_rank'=> $c['rank'],
			'post_message'=> $content,
		);
		$post = array_merge($c, $user_post);
		if(!empty($post)){
			return createGchatLog($post, $data);
		}
	}
}
function userPostGroupChatFile($content, $file_name, $type, $custom = array()){
	global $mysqli, $data;
	$def = array(
		'type'=> 'public__message',
		'file2'=> '',
	);
	$c = array_merge($def, $custom);
	$mysqli->query("INSERT INTO `group_chat` (post_date, user_id, post_message, group_id, type, file) VALUES ('" . time() . "', '{$data['user_id']}', '$content', '{$data['user_group']}', '{$c['type']}', '1')");
	$rel = $mysqli->insert_id;
	if($c['file2'] != ''){
		$mysqli->query("INSERT INTO `boom_upload` (file_name, date_sent, file_user, file_zone, file_type, relative_post) VALUES
		('$file_name', '" . time() . "', '{$data['user_id']}', 'group', '$type', '$rel'),
		('{$c['file2']}', '" . time() . "', '{$data['user_id']}', 'group', '$type', '$rel')
		");
	}
	else {
		$mysqli->query("INSERT INTO `boom_upload` (file_name, date_sent, file_user, file_zone, file_type, relative_post) VALUES ('$file_name', '" . time() . "', '{$data['user_id']}', 'group', '$type', '$rel')");
	}
	return true;
}
function systemPostGroupChat($group, $content, $custom = array()){
	global $mysqli, $data;
	$def = array(
		'type'=> 'system',
		'color'=> 'chat_system',
		'rank'=> 99,
	);
	$post = array_merge($def, $custom);
	$mysqli->query("INSERT INTO `group_chat` (post_date, user_id, post_message, group_id, type, log_rank, tcolor) VALUES ('" . time() . "', '{$data['system_id']}', '$content', '$group', '{$post['type']}', '{$post['rank']}', '{$post['color']}')");
	return true;
}
function createGchatLog($post)
{
	return  '<li id="log' . $post['post_id'] . '" data="' . $post['post_id'] . '" class="group_logs ' . $post['type'] . '">
				<div data="' . $post['user_id'] . '" class="avtrig chat_avatar get_info">
					<img class="cavatar avav ' . avGender($post['user_sex']) . ' ' . ownAvatar($post['user_id']) . '" src="' . myAvatar($post['user_tumb']) . '"/>
				</div>
				<div class="group_text">
					<div class="btable">
							<div class="cname">' . chatRank($post) . '<span class="username ' . myColorFont($post) . '">' . $post['user_name'] . '</span></div>
							<div class="cdate">' . chatDate($post['post_date']) . '</div>
					</div>
					<div class="chat_message ' . $post['tcolor'] . '">' . processChatMsg($post) . '</div>
				</div>
			</li>';
}
function emoGroupItem($type){
	switch($type){
		case 1:
			$emoclass = 'emo_menu_group_item';
			break;
	}
	$emo = '';
	$dir = glob('emoticon/*' , GLOB_ONLYDIR);
	foreach($dir as $dirnew){
		$emoitem = str_replace('emoticon/', '', $dirnew);
		$emo .= '<div data="' . $emoitem . '" class="emo_menu ' . $emoclass . '"><img class="emo_select" src="emoticon_icon/' . $emoitem . '.png"/></div>';
	}
	return $emo;
}