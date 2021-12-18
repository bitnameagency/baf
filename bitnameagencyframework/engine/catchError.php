<?php

class catchError extends ViewEngine{
	
	static $mailSend;
	static $errorText;
	
	
	public static function go($errorText, $mailSend = false){
		
		self::$mailSend 	= $mailSend;
		self::$errorText 	= $errorText;
		
		if(self::$mailSend  == true){
		
		Mailer::SendAdress(authorizedMail, "BA Framework");
		Mailer::Subject("ERROR");
		Mailer::Message(function(){
			
			return self::$errorText ;
			
		});
		Mailer::send(); 
		
		}
		
		//return '<script>alert("ERROR: '.self::$errorText.'");</script>';
		
		$ViewEngine = new ViewEngine();
		return $ViewEngine->view("static/catcherror", ["text" => self::$errorText]);
	}
	
	
	
}


/*
catchError::go("error text", true);
*/