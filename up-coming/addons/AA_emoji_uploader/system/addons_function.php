<?php
function emoListMenu(){
	$emo = '';
	$emoclass = 'emo_menu_item';
	$dir = glob(BOOM_PATH.'/emoticon/*' , GLOB_ONLYDIR);
	foreach($dir as $dirnew){
		$emoitem = str_replace(BOOM_PATH.'/emoticon/', '', $dirnew);
		$emo .= '<div id="cat_' . $emoitem . '"  data="' . $emoitem . '" class="emo_menu ' . $emoclass . '"><img class="emo_select" src="emoticon_icon/' . $emoitem . '.png"/></div>';
	}
	return $emo;
}

function emoListMenuTemp(){
	$emo = '';
	$emoclass = 'emo_menu_item_temp';
	$dir = glob(BOOM_PATH.'/emoticon/*' , GLOB_ONLYDIR);
	foreach($dir as $dirnew){
		$emoitem = str_replace(BOOM_PATH.'/emoticon/', '', $dirnew);
		$emo .= '<div id="cat_' . $emoitem . '"  data="' . $emoitem . '" class="emo_menu ' . $emoclass . '"><img class="emo_select" src="emoticon_icon/' . $emoitem . '.png"/></div>';
	}
	return $emo;
}

function emoLoadList($list){
	$supported = smiliesType();
	$emo_list = '';
	$emo_type = '';
	if(stripos($list, 'sticker') !== false){
		$emo_type = 'sticker';
	} else {
		$emo_type = 'emoticon';
	}
	if(empty($list)){
		$list = '';
	} else {
		$list = $list.'/';
	}
 	$files = scandir(BOOM_PATH . '/emoticon/'.$list);
	foreach ($files as $file){
		if ($file != "." && $file != ".."){
			$smile = preg_replace('/\.[^.]*$/', '', $file);
			foreach($supported as $sup){
				if(strpos($file, $sup)){
					$emo_list.= '<div  title=":' . $smile . ':" class="' . $emo_type . '"><img class="lazyboom" src="emoticon/'.$list. $smile . $sup . '" onclick="emo_edit(this)"/></div>';
				}
			}
		}
	}
	return $emo_list;
}

function listEmojiCat($cat=''){
	global $lang;
	$language_list = '<option value="base">'.$lang['emo_cat_base'].'</option>';
	$dir = glob(BOOM_PATH . '/emoticon/*' , GLOB_ONLYDIR);
	foreach($dir as $dirnew){
		$emocat = str_replace(BOOM_PATH . '/emoticon/', '', $dirnew);
		$language_list .= '<option ' . selCurrent($cat, $emocat) . ' value="' . $emocat . '">' . $emocat . '</option>';
	}
	return $language_list;
}
?>