<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// class Route  üzerinde Run metodu çalıştırıldı


class FormTokenSecure{
	
	
	 function __construct() {
		 
		 
			if(empty($_SESSION['reloadCount'])){  //ilk reloadCount
				
				$_SESSION['reloadCount'] = 0;
				
			}						
		 		
	 
	 }
	 
	 

	
	public static function reloadCount(){		
		
		$_SESSION['reloadCount'] += 1;
		return $_SESSION['reloadCount'];		
		
	}
		
	
	public static function TokenGenerate($captchaStatus = false, $inputList){		
	
		
		return encryptData(json_encode(array(
		"hash1" => bin2hex(random_bytes(1)),
		"captchaStatus" => $captchaStatus,
		"inputList" => $inputList,
		"reloadCount" => $_SESSION['reloadCount'],
		"token" => fingerPrint(),
		"hash2" => bin2hex(random_bytes(1))
		)));
			
		/***************************************************/
		//echo '<script>alert("'.$captchaStatus.'");</script>';
		/***************************************************/
	}
	
	
	public static function FormTokenSecureGet($captchaStatus = false, $inputList){
	
		return '<input type="hidden" name="token" value="'.self::TokenGenerate($captchaStatus, $inputList).'">';	

	}
	
		
				
	public static function csrf($data){		
		
		
		
		$secure_Output = preg_replace_callback('/<form(.*?)>(.*?)<\/form>/si', function ($expression) {		
			
			$formData = $expression[0];
			
			
						//inputList
						preg_match_all('/name="(.*?)"/', $formData, $inputList);
					
		
						$output = preg_replace_callback('/@csrf/', function ($expression) use ($inputList) {		
					
									
							return self::FormTokenSecureGet(false, $inputList[1]);
			

						}, $formData);
					
					if($output == $formData){
					
						$output = preg_replace_callback('/@captcha/', function ($expression) use ($inputList){		
						

							return captcha::captchaGet().''.self::FormTokenSecureGet(true, $inputList[1]);
			

						}, $formData);
					
					}
					
					
		
			return $output;
		
        }, $data);
		
		
		//if($secure_Output !== $data){ self::reloadCount(); }
		
		return $secure_Output;

		
		  
    }
	

	
	public static function Run(){

			if ($_POST) {				
				
				if(isset($_POST['token'])){
					
					self::reloadCount();
					
				}
				
				
				
				@$postToken = objectToArray(json_decode(decryptData($_POST['token'])));	
	
				@$tokenUsageCount = $_SESSION['reloadCount'] - $postToken['reloadCount'];
				

				// input name dışındakileri sil
				if(@$postToken['inputList']){
					foreach($postToken['inputList'] as $inputList => $tokenpostKey){
						
						$tokenpostKeys[$tokenpostKey] = true;
						
					}
				}
				
				$tokenpostKeys["token"] = true;
				$tokenpostKeys["captcha"] = true;
				
				
				foreach($_POST as $postKey => $postData){
					
					if(@$tokenpostKeys[$postKey] !== true){
						
						unset($_POST[$postKey]);
						
					}
					
				}	
				
					//print_r($postToken);
			
			
				if($tokenUsageCount > FormTokenUsageLimit){
					$_POST = [];
					
					hookSystem::add_action("modalError", function($data){
					
						$ViewEngine = new ViewEngine();
						return $data.''.$ViewEngine->view("static/modalerror", [
								"text" => "Error: token error."
						]);
								
					});
					
				}
			
				
				if(@$postToken['captchaStatus'] == true){
					
					$CheckCode = captcha::PostCode();
				
					if(@strtoupper($_POST['captcha']) !== @$CheckCode){								
								
						$_POST = [];
						hookSystem::add_action("captchaAlert", function($data){
					
							$ViewEngine = new ViewEngine();
							return $ViewEngine->view("static/captchaerror", [
							"text" => __("captchaAlert", "Güvenlik kodu hatalı. Lütfen tekrar deneyiniz."),
							"viewRand" => rand(11111,99999),
							]);

								
						});
						
						
					}
						
					
					
				}
				
				

				/***************************************************/
				
				/*echo '<div style="position: absolute; background-color:white; width: 521px; height: 395px; z-index: 1; left: 329px; top: 191px" id="layer1">';
				print_r($postToken);
				echo '<hr>';

				echo '&nbsp;</div>';*/
				
				/***************************************************/
						
												
	
				
				
				
						
				
				
			}
			
			
		
	}
		
}

