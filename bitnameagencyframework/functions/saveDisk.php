<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function saveDisk($sD_key, $sD_data = null){
	global $db;
	
	$filepath = str_replace(homepath, null, debug_backtrace()[0]['file']);
	$line = debug_backtrace()[0]['line'];
	$viewURL = $_SERVER['REQUEST_URI'];

	
		$sD_unique_key	 = md5(SECURE_KEY.''.$filepath.''.$line.''.$sD_key);
		
					$query = $db->prepare("SELECT * FROM `saveDisk` WHERE sD_unique_key = :sD_unique_key");
					$saveDisk = @$query->execute(array("sD_unique_key" => $sD_unique_key));
					$saveDisk = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
					$return_ = @$saveDisk['sD_data'];
					
	if($sD_data){
		
	if(empty($saveDisk['sD_ID'])){
		
				
						//boş			
					$query = $db->prepare("INSERT INTO `saveDisk` SET sD_unique_key = :sD_unique_key, sD_path = :sD_path, sD_path_line = :sD_path_line, sD_key = :sD_key, sD_data = :sD_data, viewURL = :viewURL");
					$insert = $query->execute(array("sD_unique_key" => $sD_unique_key, "sD_path" => $filepath, "sD_path_line" => $line, "sD_key" => $sD_key, "sD_data" => $sD_data, "viewURL" => $viewURL));
					if ( $insert ){
						$last_id = $db->lastInsertId();
						$return_ =  $sD_data;
								}
		
			
	}else{
		
						//dolu
				
				
				
				
				if(saveDiskProcessing == true){
				
			
					//debug modu		
				
					$query = $db->prepare("UPDATE `saveDisk` SET sD_data = :sD_data, sD_path = :sD_path, sD_path_line = :sD_path_line, viewURL = :viewURL WHERE sD_unique_key = :sD_unique_key");
					$insert = $query->execute(array("sD_unique_key" => $sD_unique_key, "sD_data" => $sD_data, "sD_path" => $filepath, "sD_path_line" => $line, "viewURL" => $viewURL));
					if ( $insert ){
					$last_id = $db->lastInsertId();
					$return_ = $sD_data;
					} 
				
				}
				
				
				
				
	}
		
	}	
		

		
				
	
	
	
	
			return $return_;
	

	
	
}



//saveDisk("key1", "sentence123");




?>