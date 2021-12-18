<?php
if(!defined('ABSPATH')){exit;}

/*

$realTime = new realTime;

$roomCreate = $realTime->roomData($roomKey);								->room Data

$roomCreate = $realTime->roomCreate($roomName, $roomKey);					->room Create

$roomCreate = $realTime->listenRoom("chatserver", 100);						->listen room

*/


class realTime{
	
	public $db;
	
	public function __construct(){
		global $db;
		
		$this->db = $db;
		
	}
	
	public function roomData($roomKey){
		
		$roomKey = text2slug($roomKey);
		
			$query = $this->db->prepare("SELECT * FROM `Rooms` WHERE roomKey = :roomKey");
			$room = @$query->execute(["roomKey" => $roomKey]);
			$room = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
			
			if($room['roomKey'] == $roomKey){
				
				return $room;
				
			}else{
				
				return false;
				
			}
		
	}
	
	
	public function userData($roomKey){
		
		$roomKey = text2slug($roomKey);
		
			$query = $this->db->prepare("SELECT * FROM `Rooms` WHERE roomKey = :roomKey");
			$room = @$query->execute(["roomKey" => $roomKey]);
			$room = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
			
			if($room['roomKey'] == $roomKey){
				
				return $room;
				
			}else{
				
				return false;
				
			}
		
	}
	
	
########################		R	O	O	M	C	R	E	A	T	E		#######################
	public function roomCreate($roomName, $roomKey){
			
			$roomCreate = self::roomData($roomKey);
		
			if($roomCreate !== $roomKey){
				
				$query = $this->db->prepare("INSERT INTO `Rooms` SET 
				roomKey = :roomKey,
				roomName = :roomName
				");
				$insert = $query->execute([
				"roomKey" => $roomKey,
				"roomName" => $roomName
				]);
				if ( $insert ){
				$last_id = $this->db->lastInsertId();
					return true;
					
					
					/*
					
						self::addUser(moderator EKLE);
						
					*/
					
					
				}else{
					
					return false;
					
				}
				
			}
		
	}
	
	
#######################		R	O 	O 	M 	S 	T 	A 	T 	U 	S	 #######################
	public function roomStatus($roomKey, $status){
		
			$roomData = self::roomData($roomKey);
			
			if($roomData['roomKey']){
			
				
				$query = $this->db->prepare("UPDATE `Rooms` SET 
				status = :status
				WHERE roomID = :roomID");
				$insert = $query->execute(array(
				"status" => $status,
				"roomID" => $roomData['roomID']
				));
				if ( $insert ){
				$last_id = $this->db->lastInsertId();
					return true;
				}else{
					
					return false;
				}	
					
					
				
			}else{
				
				return false;
				
			}
			
	}
	
#######################		L	I	S	T	E	N	R	O	O	M		#######################	
	public function listenRoom($roomKey, $limit){
		
			$Rooms = self::roomData($roomKey);
			
			if(@$Rooms['roomKey'] == $roomKey){
				
				return json_encode($Rooms);
				
				/*
					gelen mesajları limite göre dönder.
					
				*/
				
				
			}else{
				
				return json_encode(["status" => 0]);
				
			}
			
			
	}
	
#######################		A	D	D 	U 	S 	E 	R 		#######################
	public function addUser($roomKey, $userKey){
			
			$Rooms = self::roomData($roomKey);
			
			if($Rooms['roomKey']){				
				
				$query = $this->db->prepare("SELECT * FROM `roomUsers` WHERE userKey = :userKey");
				$roomUser = @$query->execute(["userKey" => $userKey]);
				$roomUser = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
				
					if(@$roomUser['userKey'] !== $userKey){
							
							$query = $this->db->prepare("INSERT INTO `roomUsers` SET 
							roomID = :roomID,
							userKey = :userKey
							");
							$insert = $query->execute([
							"roomID" => $Rooms['roomID'],
							"userKey" => $userKey
							]);
							if ( $insert ){
							$last_id = $this->db->lastInsertId();
							
								return json_encode(["status" => 1]);
								
							}else{
								
								return json_encode(["status" => 0]);
								
							}						
							
						
					}else{
						
						return json_encode(["status" => 0]);
						
					}

				
			}else{
				
				return json_encode(["status" => 0]);
				
			}		
		
	}
	
##########################################################################################	
	public function moderatorUser($roomKey, $userKey){
		
			$Rooms = self::roomData($roomKey);
			
			if($Rooms['roomKey']){				
				
				$query = $this->db->prepare("SELECT * FROM `roomUsers` WHERE userKey = :userKey");
				$roomUser = @$query->execute(["userKey" => $userKey]);
				$roomUser = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
				
					if(@$roomUser['userKey'] !== $userKey){
							
							$query = $this->db->prepare("INSERT INTO `roomUsers` SET 
							roomID = :roomID,
							userKey = :userKey
							");
							$insert = $query->execute([
							"roomID" => $Rooms['roomID'],
							"userKey" => $userKey
							]);
							if ( $insert ){
							$last_id = $this->db->lastInsertId();
							
								return json_encode(["status" => 1]);
								
							}else{
								
								return json_encode(["status" => 0]);
								
							}						
							
						
					}else{
						
						return json_encode(["status" => 0]);
						
					}

				
			}else{
				
				return json_encode(["status" => 0]);
				
			}			
		
	}	
	
##########################################################################################	
	public function sendMessage(){}
	
	public function removeRoom(){}
	public function removeUser(){}	

	public function removeMessage(){}
	public function blockUser2User(){}
		
}

$realTime = new realTime;
//$roomCreate = $realTime->roomStatus("chatServer", 1);
//print_r($roomCreate);



##########################################################################################
##########################################################################################
##########################################################################################

Route::run("/realTime.js", function(){	
		immunity(true);
	hookSystem::add_action("index", function(){
		header('Content-Type: application/javascript');
		$viewEngine = new viewEngine;
		return $viewEngine->view("static/chatscript", [
		
		]);
		
	});	
	
}, "get|post");