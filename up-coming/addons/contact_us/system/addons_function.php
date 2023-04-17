<?php
function canContactUs(){
	global $data, $cody;
	if(boomAllow($data['addons_access']) && $data['custom1'] != ''){
		return true;
	}
}
function canSendContactUs(){
	global $mysqli, $data;
	if(canSendMail($data, 'contact_us', $data['custom2'])){
		return true;
	}
}
?>