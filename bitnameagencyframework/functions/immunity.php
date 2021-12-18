<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function immunity($value = null){
	
	static $immunityValue;
	
		if($value == null){
			
			return $immunityValue;
			
		}elseif($value == true){
			
			$immunityValue = true;
			
		}		
	
}
