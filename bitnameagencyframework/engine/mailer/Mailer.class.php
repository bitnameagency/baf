<?php

class Mailer{
	
	
	static $SendAdressMail;
	static $SendAdressName;
	static $Subject;
	static $Message;
	
	
	 public static function SendAdress($mail, $name){
		
		self::$SendAdressMail = $mail;
		self::$SendAdressName = $name;
	
		
	}

	public static function Subject($Subject){
		
		self::$Subject = $Subject;	
		
	}
	
	
	public static function Message($Message){
		
		if (is_callable($Message)){
		
		self::$Message = call_user_func_array($Message, []);
		
		}
		
	}
	
	


	
		public static function send(){
			

					$mail = new PHPMailer();
					$mail->CharSet = 'utf-8';
					$mail->isSMTP();					
					$mail->Host = MAIL_HOST;
					$mail->Port = MAIL_PORT;
					$mail->SMTPAuth = true;
					$mail->Username = MAIL_USERNAME;
					$mail->Password = MAIL_PASSWORD;
					$mail->setFrom(MAIL_FROMADRESS, MAIL_FROMNAME);
					$mail->addReplyTo(MAIL_REPLYADRESS, MAIL_REPLYNAME);
					$mail->addAddress(self::$SendAdressMail, self::$SendAdressName);
					$mail->Subject = self::$Subject;
					$mail->msgHTML(self::$Message);
					$mail->AltBody = 'This is a plain-text message body';

					if (!$mail->send()) {
						return false;
					} else {
						return true;
					}
							
			
		}
	
	
}

/**

USAGE:

Mailer::SendAdress("kaziminemlumia@gmail.com", "Kazim İNEM");
Mailer::Subject("func deneme");
Mailer::Message(function(){
	
	return 'message View';
	
});
Mailer::send();  true or false

**/