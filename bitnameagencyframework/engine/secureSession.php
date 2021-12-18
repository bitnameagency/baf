<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



function secureSession($sessionKey, $sessionData = null, $hidingTime = 14, $remove = false){
	
	
	
	global $db;
	
		// Değişkenler
		$sessionKey 		= 	$sessionKey; 		//Görünür Anahtar
		$sessionSecureKey	= 	md5($sessionKey.'|'.SECURE_KEY.'|'.browserid().'|'.GetIP());	//Gizli Anahtar



		if($sessionKey){

		if($remove == false){
		
	
			if($sessionData == null){
				//veri çıkışı
				
				if(@$_COOKIE['secureSession'][$sessionKey] == $sessionSecureKey){
				
					$query = $db->prepare("SELECT * FROM `secureSession` WHERE sessionSecureKey = :sessionSecureKey");
			/**/	$secureSession = @$query->execute(array("sessionSecureKey" => $_COOKIE['secureSession'][$sessionKey]));
					$secureSession = decryptData(@$query->fetchAll(\PDO::FETCH_ASSOC)[0]['sessionData']);
				
					return $secureSession;
					
				}else{
					
					secureSessionRemove($sessionKey);
					return false;
				}
				
			}else{
				//veri girişi
					$sessionencryptData		= 	encryptData($sessionData);					//Şifrelenmemiş veri	
					$deletionDate		=	date("Y-m-d",strtotime('+'.$hidingTime.' day',strtotime(date("Y-m-d")))); 	//session silinme tarihi
					$hidingTimeSecond = time() + ((60 * 60) * 24) * $hidingTime; //To Second
		
		
					$query = $db->prepare("SELECT * FROM `secureSession` WHERE sessionSecureKey = :sessionSecureKey");
					$secureSession = @$query->execute(array("sessionSecureKey" => $sessionSecureKey));
					$secureSession = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
					$sessionSecureKeyDB = @$secureSession['sessionSecureKey'];
		
		
			if($sessionSecureKey == $sessionSecureKeyDB){
				//daha önce veri vardı. Update yapalım
				
					$query = $db->prepare("UPDATE `secureSession` SET 
					sessionKey = :sessionKey,					
					sessionData = :sessionData, 
					deletionDate = :deletionDate
					WHERE sessionSecureKey = :sessionSecureKey");
					$insert = $query->execute(array(
					"sessionSecureKey" => $sessionSecureKey,
					"sessionData" => $sessionencryptData,
					"deletionDate" => $deletionDate,
					"sessionKey" => $sessionKey));
					if ( $insert ){
					$last_id = $db->lastInsertId();
		/**/		//$_SESSION['secureSession'][$sessionKey] = $sessionSecureKey;
		/**/		setcookie('secureSession['.$sessionKey.']', $sessionSecureKey, $hidingTimeSecond, "/");
					} 
				
				
				
			
				
			}else{
		
						
					
					//daha önce veri yoksa
					$query = $db->prepare("INSERT INTO `secureSession` SET 
					sessionKey = :sessionKey, 
					sessionSecureKey = :sessionSecureKey, 
					sessionData = :sessionData, 
					deletionDate = :deletionDate");
					$insert = $query->execute(array(
					"sessionKey" => $sessionKey, 
					"sessionSecureKey" => $sessionSecureKey,
					"sessionData" => $sessionencryptData,
					"deletionDate" => $deletionDate
					));
					if ( $insert ){
					$last_id = $db->lastInsertId();
			/**/	//$_SESSION['secureSession'][$sessionKey] = $sessionSecureKey;
					setcookie('secureSession['.$sessionKey.']', $sessionSecureKey, $hidingTimeSecond, "/");
					}

					
			}
					
									
				
				
				
						return $sessionData;
				
			}
	
	
		}elseif($remove == true){
			
			
			
					$query = $db->prepare("DELETE FROM `secureSession` WHERE sessionSecureKey = :sessionSecureKey");
					$delete = $query->execute(array(
			/**/   'sessionSecureKey' => @$_COOKIE['secureSession'][$sessionKey]
					));
			
			/**/	//unset($_SESSION['secureSession'][$sessionKey]);
					setcookie('secureSession['.$sessionKey.']', $sessionSecureKey, time() - 3600, "/");
					return true;
					
					
		}
	
	
		}else{
			
				 throw new Exception("key not found."); //ERROR
			
		}
	
}


function secureSessionSet($sessionKey, $sessionData = null, $hidingTime = 14){
	
	return secureSession($sessionKey, $sessionData, $hidingTime, false);
	
}


function secureSessionGet($sessionKey){
	
	return secureSession($sessionKey, null, null, false);
	
}


function secureSessionRemove($sessionKey){
	
	return secureSession($sessionKey, null, null, true);
	
}


function sessionList($value = null){
	
	global $db;
	
	if($value == null){
				
		$query = $db->prepare("SELECT DISTINCT sessionKey FROM `secureSession`");
		$sessionKeys = $query->execute();
		$sessionKeys = @$query->fetchAll(\PDO::FETCH_ASSOC);		
			
			foreach($sessionKeys as $sessionKey){
					
				$List[] = $sessionKey['sessionKey'];
					
			}
			
			return @$List;
				
	}else{
		
		$query = $db->prepare("SELECT * FROM `secureSession` WHERE sessionKey = :sessionKey");
		$secureSessions = @$query->execute(["sessionKey" => $value]);
		$secureSessions = @$query->fetchAll(\PDO::FETCH_ASSOC);
		
			foreach($secureSessions as $secureSession){
					
				$List[] = [
				"sS_ID" => $secureSession['sS_ID'],
				"sessionSecureKey" => $secureSession['sessionSecureKey'],
				"sessionKey" => $secureSession['sessionKey'],
				"sessionData" => decryptData($secureSession['sessionData'])			
				];
					
			}
			
			return @$List;
	}
	
}

function sessionIDremove($ID){
	
	global $db;
	
		$query = $db->prepare("DELETE FROM `secureSession` WHERE sS_ID = :sS_ID");
		$delete = $query->execute(array(
		'sS_ID' => $ID
		));
		
		return true;
	
}



####Cron job hiding time####
function secureSessionCronJobRemove(){
	
	global $db;
	
		$query = $db->prepare("DELETE FROM `secureSession` WHERE deletionDate BETWEEN '1700-01-01' and NOW();");
		$delete = $query->execute(array());
				
}



$hookSystem = new hookSystem();
$hookSystem->add_action("cronJob", "secureSessionCronJobRemove");



###########Kullanım#############
/*
secureSessionSet($sessionKey, $sessionData, $hidingTime); or secureSessionSet($sessionKey, $sessionData);
secureSessionGet($sessionKey);
secureSessionRemove($sessionKey);
*/



