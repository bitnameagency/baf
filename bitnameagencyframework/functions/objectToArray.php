<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 
	function objectToArray($d) {
		if (is_object($d)) {
			// Gelen nesnenin özelliklerini get_object_vars metodu
                        // ile alırız
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			// Nesneden diziye çevirilmiş veriyi döndürür
                        // burdaki __FUNCTION__ bir magic constanttır.
                        // recursive gibi kendini çağırır
			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
	}