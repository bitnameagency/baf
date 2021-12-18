<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function encryptData($data){
	
		return openssl_encrypt($data, "AES-128-ECB", SECURE_KEY);
}


function  decryptData($data){

		return openssl_decrypt($data, "AES-128-ECB", SECURE_KEY);
	
}

?>