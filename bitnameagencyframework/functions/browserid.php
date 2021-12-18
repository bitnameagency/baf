<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function browserid(){
	

	$key = md5(SECURE_KEY.''.session_id().''.time().''.rand(111111111,99999999));

		
	if(empty($_COOKIE['Sbrowserid'])){
		

		setcookie("Sbrowserid", $key, time()+31556926, '/');
		return $key;
		
	}else{
		
		return $_COOKIE['Sbrowserid'];		
		
	}
	
	
	
}