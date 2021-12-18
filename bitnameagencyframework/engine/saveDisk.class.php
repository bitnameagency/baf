<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*
KULLANIM
$saveDisk = new saveDisk;
$saveDisk = $saveDisk->pathList();															-> pathList


$saveDisk = $saveDisk->pathList("/bitnameagencyframework/functions/saveDisk.php");			-> itemList

$saveDisk = $saveDisk->select(32);															->itemData

$saveDisk = $saveDisk->remove(32);															->itemDelete

$saveDisk = $saveDisk->update([
"sD_ID" => 36,
"sD_data" => "değiştirilen metin"

]);																							->item Update

*/


class saveDisk{
	
	
	public function pathList($value = null){
		global $db;
		if($value == null){
			//pathList		
			
			$query = $db->prepare("SELECT DISTINCT sD_path FROM saveDisk");
			$pathList = @$query->execute();
			$pathList = @$query->fetchAll(\PDO::FETCH_ASSOC);
			
				foreach($pathList as $path){
					
					$List[] = $path['sD_path'];
					
				}
			
			return @$List;
			
		}else{
			//item List
			$query = $db->prepare("SELECT * FROM `saveDisk` WHERE sD_path = :sD_path");
			$itemData = @$query->execute(["sD_path" => $value]);
			$itemData = @$query->fetchAll(\PDO::FETCH_ASSOC);							
			return $itemData;
			
		}
		
		
	}
	
	
	public function select($value = null){
		global $db;
		if($value == null){
			
			return false;
			
		}else{
			
			//item Data
			$query = $db->prepare("SELECT * FROM `saveDisk` WHERE sD_ID = :sD_ID");
			$itemData = @$query->execute(["sD_ID" => $value]);
			$itemData = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];							
			return $itemData;
			
		}
		
	}
	
	public function remove($value = null){
		global $db;
		if($value == null){
			
			return false;
			
		}else{
			
			$itemData = self::select($value);
			if($value == $itemData['sD_ID']){
				
				
				$query = $db->prepare("DELETE FROM `saveDisk` WHERE sD_ID = :sD_ID");
				$insert = $query->execute(["sD_ID" => $value]);
				if ( $insert ){
					$last_id = $db->lastInsertId();
					return true;
				}
				
				
			}else{
				
				return false;
				
			}
			
			
		}
		
	}
	
	
	public function update($value = null){
		global $db;
		if($value == null){
			
			return false;
			
		}else{
			
			$itemData = self::select($value['sD_ID']);
			if($value['sD_ID'] == $itemData['sD_ID']){
				
				$queryUpdate = $db->prepare("UPDATE `saveDisk` SET 
				sD_data = :sD_data
				WHERE sD_ID = :sD_ID");
				$insert = $queryUpdate->execute(array(
				"sD_data" => $value['sD_data'],
				"sD_ID" => $value['sD_ID']
				));	
				
				return true;
				
			}else{
				
				return false;
				
			}
			
			
		}		
		
	}

	
	
}