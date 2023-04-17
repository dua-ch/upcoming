<?php
function exTemplate($getpage, $boom = '')
{
	global $data, $lang, $mysqli, $cody;
	$page = BOOM_PATH . '/addons/AA_room_wall/' . $getpage . '.php';
	$structure = '';
	ob_start();
	require($page);
	$structure = ob_get_contents();
	ob_end_clean();
	return $structure;
}
function canPostAdvNews()
{
	global $data;
	if (boomAllow($data['custom1'])) {
		return true;
	}
}
function canReplyAdvNews()
{
	global $data;
	if (boomAllow($data['custom2'])) {
		return true;
	}
}
function canDelPostAdvNews()
{
	global $data;
	if (boomAllow($data['custom3'])) {
		return true;
	}
}
function canLikeAdvNews()
{
	global $data;
	if (boomAllow($data['custom4'])) {
		return true;
	}
}
function canDelAdvNewsReply()
{
	global $data;
	if (boomAllow($data['custom5'])) {
		return true;
	}
}
function exThisNews($id)
{
	global $mysqli, $lang;
	$news_content = '';
	$get_news = $mysqli->query("SELECT ex_news.*, boom_users.user_name, boom_users.user_id,  boom_users.user_rank, boom_users.user_color, boom_users.user_tumb
	FROM ex_news, boom_users
	WHERE ex_news.news_poster = boom_users.user_id AND ex_news.id = '$id' AND ex_news.news_room = boom_users.user_roomid 
	ORDER BY news_date DESC LIMIT 1");
	while ($news = $get_news->fetch_assoc()) {
		$news_content .= exTemplate('system/template/adv_news', $news);
	}
	return $news_content;
}
function getAdvLikes($post, $liked, $type)
{
	global $mysqli, $data, $cody, $lang;
	$result = array(
		'like_post' => $post,
		'like_count' => 0,
		'dislike_count' => 0,
		'love_count' => 0,
		'fun_count' => 0,
		'liked' => '',
		'disliked' => '',
		'loved' => '',
		'funned' => '',
	);
	if ($type == 'news') {
		$get_like = $mysqli->query("SELECT like_type FROM ex_news_like WHERE like_post = '$post'");
	} else {
		return '';
	}
	switch ($liked) {
		case 1:
			$result['liked'] = ' liked';
			break;
		case 2:
			$result['disliked'] = ' liked';
			break;
		case 3:
			$result['loved'] = ' liked';
			break;
		case 4:
			$result['funned'] = ' liked';
			break;
		default:
			break;
	}
	if ($get_like->num_rows > 0) {
		while ($like = $get_like->fetch_assoc()) {
			if ($like['like_type'] == 1) {
				$result['like_count']++;
			} else if ($like['like_type'] == 2) {
				$result['dislike_count']++;
			} else if ($like['like_type'] == 3) {
				$result['love_count']++;
			} else if ($like['like_type'] == 4) {
				$result['fun_count']++;
			}
		}
	}
	if ($type == 'news') {
		return exTemplate('system/template/likes_adv_news', $result);
	} else {
		return '';
	}
}
function checkAdvNewsNotify()
{
	global $mysqli, $data;
	$list = '';
	$get = $mysqli->query("SELECT (SELECT count(*) FROM ex_news WHERE news_date > '{$data['user_room_news']}' AND news_room = '{$data['user_roomid']}') as news_count");
	if ($get->num_rows > 0) {
		while ($store = $get->fetch_assoc()) {
			$list = $store['news_count'];
		}
	}
	return $list;
}
function countRoomPostsWall()
{
	global $mysqli, $data;
	$list = '';
	$get = $mysqli->query("SELECT (SELECT count(*) FROM ex_news WHERE news_room = '{$data['user_roomid']}') as news_count");
	if ($get->num_rows > 0) {
		while ($store = $get->fetch_assoc()) {
			$list = $store['news_count'];
		}
	}
	return $list;
}
?>