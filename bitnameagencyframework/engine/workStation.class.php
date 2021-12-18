<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class workStation{
	
	public $ws_IS;
	
	
	 function __construct($ws_IS) {
		 
		$this->ws_IS = $ws_IS;
	
	}
	
	public function getData(){
		global $db;
		
		$query = $db->prepare("SELECT * FROM `workstationSystem` WHERE ws_IS = :ws_IS");
		$workstationSystem = @$query->execute(array("ws_IS" => $this->ws_IS));
		$workstationSystem = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
		
		if(@$workstationSystem['ws_IS'] == $this->ws_IS){
			
			return $workstationSystem;
			
		}else{
			
			return false;			
			
		}		
		
	}
	
	
	public function statusChange($status){
		
		global $db;
		$getData = self::getData();
		
		$query = $db->prepare("UPDATE `workstationSystem` SET 
		status = :status
		WHERE ws_IS = :ws_IS");
		$insert = $query->execute(array(
		"status" => $status,
		"ws_IS" => $this->ws_IS
		));
		if ( $insert ){
			$last_id = $db->lastInsertId();
			return true;
		}else{
			return false;			
		}
		
	}
	
	public function titleChange($ws_Title){
		
		global $db;
		$getData = self::getData();
		
		$query = $db->prepare("UPDATE `workstationSystem` SET 
		ws_Title = :ws_Title
		WHERE ws_IS = :ws_IS");
		$insert = $query->execute(array(
		"ws_Title" => $ws_Title,
		"ws_IS" => $this->ws_IS
		));
		if ( $insert ){
			$last_id = $db->lastInsertId();
			return true;
		}else{
			return false;			
		}
		
	}
	
	public function descChange($ws_Description){
		
		global $db;
		$getData = self::getData();
		
		$query = $db->prepare("UPDATE `workstationSystem` SET 
		ws_Description = :ws_Description
		WHERE ws_IS = :ws_IS");
		$insert = $query->execute(array(
		"ws_Description" => $ws_Description,
		"ws_IS" => $this->ws_IS
		));
		if ( $insert ){
			$last_id = $db->lastInsertId();
			return true;
		}else{
			return false;			
		}		
		
	}
	
	public function priorityChange($ws_Priority){
		
			global $db;
		$getData = self::getData();
		
		$query = $db->prepare("UPDATE `workstationSystem` SET 
		ws_Priority = :ws_Priority
		WHERE ws_IS = :ws_IS");
		$insert = $query->execute(array(
		"ws_Priority" => $ws_Priority,
		"ws_IS" => $this->ws_IS
		));
		if ( $insert ){
			$last_id = $db->lastInsertId();
			return true;
		}else{
			return false;			
		}
		
	}
	
	
	public function remove(){
		
		global $db;
		$getData = self::getData();
		
		$query = $db->prepare("DELETE FROM `workstationSystem`
		WHERE ws_IS = :ws_IS");
		$insert = $query->execute(array(
		"ws_IS" => $this->ws_IS
		));
		if ( $insert ){
			$last_id = $db->lastInsertId();
			unlink($getData['ws_Path']);
			return true;
		}else{
			return false;			
		}
		
		
	}
		
}

//USAGE:
//$workStation = new workStation(50);
//$workStation = $workStation->statusChange(1);
//$workStation = $workStation->titleChange("Mainpage Title");
//$workStation = $workStation->descChange("Mainpage desc");
//$workStation = $workStation->priorityChange(100);
