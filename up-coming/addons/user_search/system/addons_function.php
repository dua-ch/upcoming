<?php
function evSearchType($search_type){
	switch($search_type) {
		case 1:
			return "user_id > 0";
		case 2:
			return "user_sex = 2";
		case 3:
			return "user_sex = 1";
		default:
			return "";
	}
}
function evSearchOrder($search_order){
	
	switch($search_order) {
		case 0:
			return "ORDER BY rand()";
		case 1:
			return "ORDER BY user_join DESC";
		case 2:
			return "ORDER BY last_action DESC";
		case 3:
			return "ORDER BY user_name ASC";
		case 4:
			return "ORDER BY user_rank DESC";
		default:
			return "";
	}
}
?>