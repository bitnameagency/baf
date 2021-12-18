<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function fingerPrint(){
	
	return md5(json_encode([GetIP(), $_SERVER['HTTP_USER_AGENT'], browserid()]));	
	
}
