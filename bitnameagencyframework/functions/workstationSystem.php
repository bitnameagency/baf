<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function workstationSystem($ws_Title = null, $ws_Description = null, $ws_Category = null, $ws_Path, $ws_Priority = null, $status = 0){
	global $db;
	

	$return[$ws_Priority][] = array("ws_Title" => $ws_Title, "ws_Description" => $ws_Description, "ws_Category" => $ws_Category, "ws_Path" => $ws_Path, "ws_Priority" => $ws_Priority, "status" => $status);


	
	
	
}


function workstationSystemPUT($ws_Title = null, $ws_Description = null, $ws_Category = null, $ws_Path, $ws_Priority = null){
	global $db;
		
		
		$query = $db->prepare("SELECT * FROM `workstationSystem` WHERE ws_Path = :ws_Path");
		$workstationSystem = @$query->execute(array("ws_Path" => $ws_Path));
		$workstationSystem = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
		$workstationSystemSelect = @$workstationSystem['ws_Path'];
	


			if($ws_Path !== $workstationSystemSelect){
				//kayıt yok. Yeni kayıt yapılacak
				
			$query = $db->prepare("INSERT INTO `workstationSystem` SET 
				ws_Title = :ws_Title, 
				ws_Description = :ws_Description, 
				ws_Category = :ws_Category, 
				ws_Path = :ws_Path, 
				ws_Priority = :ws_Priority");
				$insert = $query->execute(array(
				"ws_Title" => $ws_Title,
				"ws_Description" => $ws_Description,
				"ws_Category" => $ws_Category,
				"ws_Path" => $ws_Path,
				"ws_Priority" => $ws_Priority		
				));
				if ( $insert ){
				$last_id = $db->lastInsertId();
				return true;
				}
							
			}



	
}


function workstationSystemGET($ws_Path){
	global $db;
	
		$query = $db->prepare("SELECT * FROM `workstationSystem` WHERE ws_Path = :ws_Path");
		$workstationSystem = @$query->execute(array("ws_Path" => $ws_Path));
		$workstationSystem = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
		$workstationSystemSelect = @$workstationSystem;
	
	
return $workstationSystemSelect;
	
	
}
