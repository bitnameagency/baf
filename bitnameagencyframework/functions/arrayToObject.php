<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 function arrayToObject($d) {
		if (is_array($d)) {
			// diziyi nesne olarak kendine döndürür
                        // __FUNCTION__ magic constanttır.
			return (object) array_map(__FUNCTION__, $d);
		}
		else {
			// Return object
			return $d;
		}
	}