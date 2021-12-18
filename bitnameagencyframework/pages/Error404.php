<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

			function Error404(){
				
	$ViewEngine = new ViewEngine();	
	return $ViewEngine->view('Error404');	
	
}