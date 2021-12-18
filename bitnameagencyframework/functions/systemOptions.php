<?php
if (!defined('ABSPATH'))
{  exit; }


function OptionFix($value){
	 	
	if(strtolower($value) == "true"){
		return true;
	}

	if(strtolower($value) == "false"){
		return false;
	}

	if(strtolower($value) == "null"){
		return null;
	}
	
	return $value;

}

function allSystemOptions(){
	global $db;
	$query = $db->prepare("SELECT * FROM `systemOptions`");
	$systemOptions = @$query->execute();
	$systemOptions = @$query->fetchAll(\PDO::FETCH_ASSOC);	
	
	foreach($systemOptions as $option){
		
		$return[$option['optionKey']] = ["optionKey" => $option['optionKey'], "optionData" => $option['optionData']];
		
	}
	return $return;
}


function systemOptions($optionKey, $optionData = null){
	global $db;
	
	$optionKey = (string)$optionKey;
	$optionData = (string)$optionData;
	
		$query = $db->prepare("SELECT * FROM `systemOptions` WHERE optionKey = :optionKey");
		$systemOption = @$query->execute(array("optionKey" => $optionKey));
		$systemOption = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];	
	
			
			if($optionData == null){
				//mevcut veri
				
					if(@$systemOption['optionKey'] == $optionKey){
														
						return OptionFix($systemOption['optionData']);
					
					}else{
					//ilk kez eklenecek	
						
						$query = $db->prepare("INSERT INTO `systemOptions` SET 
						optionKey = :optionKey");
						$insert = $query->execute(array(
						"optionKey" => $optionKey,				
						));
						
						return OptionFix($optionData);
						
					}			
			
				
			}else{
				//yeni veri yazılacak veya güncellenecek
						
					if($systemOption['optionKey'] == $optionKey){
					//daha önce eklenmiş
					
						$query = $db->prepare("UPDATE `systemOptions` SET 
						optionData = :optionData
						WHERE optionKey = :optionKey");
						$insert = $query->execute(array(
						"optionData" => $optionData,
						"optionKey" => $optionKey
						));
						
						return OptionFix($optionData);
					
					}else{
					//ilk kez eklenecek	
						
						$query = $db->prepare("INSERT INTO `systemOptions` SET 
						optionData = :optionData,
						optionKey = :optionKey");
						$insert = $query->execute(array(
						"optionKey" => $optionKey,
						"optionData" => $optionData						
						));
						
						return OptionFix($optionData);
						
					}
				
			}
	
	
}

