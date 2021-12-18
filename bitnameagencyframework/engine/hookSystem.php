<?php
//5jLcD1hFCl8
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class hookSystem extends taskStarter
{

	
public static function hook($name, $callback = null, $value = null, $priority = 10){
	
	
	static $events = [];
	static $callbackKeyArray = [];
	static $callbackKey;
	
	if($callback !== null){
		
		if($callback){
			
			
			
			
			
			$callbackKeyArray[] = $callback;
			$callbackKey = count($callbackKeyArray)-1;
			

			
			$events[$name][$callbackKey] = $priority;
						
		} else {
			
			unset($events[$name]);
						
		}
		
	}elseif(isset($events[$name])){
		
		
		arsort($events[$name]);
		
	  foreach($events[$name] as $callback => $priority){
		  
		  

		if (is_callable($callbackKeyArray[$callback])) {					
                   
			 $value = call_user_func_array($callbackKeyArray[$callback], array($value));
				   
                }
		  
		
		  
	  }
	  
	 return $value;
		
	}
	
	return $value;	
	
}
/*****/
public static function add_action($name, $callback, $priority = 10){
	
	return self::hook($name, $callback, null, $priority);
}
/*****/
public static function do_action($name, $value = null){
	
	return self::hook($name, null, $value);
	
}
/*****/
public static function remove_action($name){
	
	self::hook($name, false);
		
}



}
################################################ Finish ################################################
################################################ Finish ################################################
################################################ Finish ################################################
?>