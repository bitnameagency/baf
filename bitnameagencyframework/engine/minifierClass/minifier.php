<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class minifier{
	
	static public function minify_html($buffer) {		
		
		 $buffer = Minify_HTML::minify($buffer, array(
        'cssMinifier' => array('Minify_CSS', 'minify'),
        'jsMinifier' => array('JSMin', 'minify')
    ));
    return $buffer;
		
				
	}


	static public function Go($input){
		
		if(immunity() !== true){
				
			$output = self::minify_html($input);		
			return $output;
			
		}else{
			
			return $input;
			
		}		
		
	}
	
	
}