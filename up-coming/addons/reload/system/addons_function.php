<?php

/**
 * Codytalk
 * @package Codytalk
 * @author www.codytalk.com
 * @copyright 2022
 * @terms any use of this script without a legal license is prohibited
 * all the content of CodyTalk is the propriety of Mr.Logger and Cannot be 
 * used for another project.
 */

function canReloadAll(){
	global $data, $cody;
	if(boomAllow($data['addons_access'])){
		return true;
	}
}



?>