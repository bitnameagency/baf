<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function txtread($file){
	$data = fopen($file, 'r');
	$txtread = fread($data, filesize($file));
	fclose($data);
	return $txtread;
}

?>