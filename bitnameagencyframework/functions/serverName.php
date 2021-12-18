<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function isSecure() {
  return
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443;
}




function serverName(){
	
	if(isSecure()){
		
		return 'https://'.$_SERVER['SERVER_NAME'];
		
		
	}else{
		
		return 'http://'.$_SERVER['SERVER_NAME'];
		
	}
	
	
	
}

define("serverName", serverName());
