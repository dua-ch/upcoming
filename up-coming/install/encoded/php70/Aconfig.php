<?php
require_once ('../system/config.php');

if(!boomAllow(10)){
	die();
}
function pSUnderClear($t){
	return str_replace('AA_', ' ', $t);
}
function pSUnderClear1($t){
	return str_replace('_', ' ', pSUnderClear($t));
}
function ps_Template($getpage, $boom = '') {
	global $data, $mysqli, $lang;
    $page = BOOM_PATH . '/install/element/' . $getpage . '.php';
    $structure = '';
    ob_start();
    require($page);
    $structure = ob_get_contents();
    ob_end_clean();
    return $structure;
}
function addonsPs(){
	global $mysqli;
	$dir = glob(__DIR__ . '/../../../addons/AA*' , GLOB_ONLYDIR);
	foreach($dir as $dirnew){
		$addon = str_replace(__DIR__ . '/../../../addons/', '', $dirnew);
	    $get_addon = $mysqli->query("SELECT * FROM boom_addons WHERE addons = '$addon'");
	    if($get_addon->num_rows > 0){
		    $addon = $get_addon->fetch_assoc();
			echo ps_Template('addons_uninstall', $addon);
	    } else {
			echo ps_Template('addons_install', $addon);
	    }
	    
	}
}
?>