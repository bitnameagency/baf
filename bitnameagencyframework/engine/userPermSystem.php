<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


define("userKey", secureSessionGet("userKey"));



// USAGE

/*	

$user = new user;
$user = $user->getData(loginInput or userKey);												-> getData
$user->login("loginInputoruserKey", "password"); 											-> LOGIN and Data
$user->logout(); 																			-> LOGOUT
$user->UserAdd($loginInput, $loginPassword);												-> UserAdd
$user->UserUpdate($loginInputoruserKey, $loginInput = null, $loginPassword = null);			-> UserUpdate
$user->UserDelete("test23");																-> UserDelete
$banned = $User->userBanned("root", 10);													->UserBanned


$user = $user->userOption("root");															-> user all options list data
$user = $user->userOption("root", "tel");													-> user single option data
$user = $user->userOption("root", "tel", "055555");											-> insert or update 


$user = $user->roles();																		->roles list
$user = $user->roles("key");																->roles data						
$user = $user->roles("keynew");																->key add	
$user = $user->roleRemove("key");															->role remove			

$user = $user->perm();																		-> project list

$user = $user->perm([
"projectKey" => "test6"
]);																							->perm list yada proje select


$user = $user->perm([
"projectKey" => "test6",
"permKey" => "permtest4"
]);																							-> perm select

$user = $user->perm([
"projectKey" => "",
"permKey" => ""
]);																							-> perm insert


$user = $user->projectRemove("test6");														-> projectRemove	

$user = $user->permRemove([
"projectKey" => "test2",
"permKey" => "permtest3"
]);																							-> project perm remove					


$user = $user->mergeRolePerm([
"permID" => 1,
"roleID" => 1,
"process" => "insert"
]);																							-> Rollere Perm atama


$rolePermdata = $User->rolePermdata("role2"); 												-> Role perm List

$user = $user->mergeRolePerm([
"permID" => 1,
"roleID" => 1,
"process" => "remove"
]);																							-> Rolden Perm silme


$user = $user->mergeRolesUser([
"loginInputoruserKey" => "root",
"roleID" => 1,
"process" => "insert"
]);																							-> User Rol atama


$user = $user->mergeRolesUser([
"loginInputoruserKey" => "root",
"roleID" => 1,
"process" => "remove"
]);																							-> User Rol silme


$userPermsRoleData = $User->userRoleData(loginInputoruserKey)					 			->User rol and perm list

$userPermsRoleData = $User->userPermsRoleData(); 											->Login User rol and perm list


$user = $user->userPermsRoleData();															-> login yapmış kullanıcın yetkileri ve rolleri

$user->permCheck("baf@login", page or return);												-> permCheck page
*/



class User extends Database{
	
		public function __($key, $text){
						
			return __($key, $text);
			
		}
		
		
		

		public function userList(){
			
			
			$query = $this->db->prepare("SELECT * FROM `userSystem`");
			$userList = @$query->execute();
			$userList = @$query->fetchAll(\PDO::FETCH_ASSOC);	
						
			return @$userList;			
			
		}
		
		
		
		public function getData($loginInputoruserKey  = null){
		
		
			if($loginInputoruserKey){
				
				$query = $this->db->prepare("SELECT * FROM `userSystem` WHERE userKey = :userKey");
				$userSystem = @$query->execute(array("userKey" => $loginInputoruserKey));
				$userSystem = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];	
				$queryType = 'userKey';
			
				
				
				if(@$userSystem['userKey'] !== $loginInputoruserKey){
				$query = $this->db->prepare("SELECT * FROM `userSystem` WHERE loginInput = :loginInput");
				$userSystem = @$query->execute(array("loginInput" => $loginInputoruserKey));
				$userSystem = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];	
				$queryType = 'loginInput';
				}
					
				
				
				if(@$userSystem['loginInput'] == @$loginInputoruserKey or @$userSystem['userKey'] == @$loginInputoruserKey){ //böyle bir kullanıcı var mı?
										
					return array_merge($userSystem, array("queryType" => $queryType));
				
				}else{ //böyle bir kullanıcı yok
					
					return false;
					
				}


		}else{
			
			return false;
			
		}

	}

	public function login($loginInput  = null, $loginPassword  = null){
		
		if($loginInput !== null){	//yeni giriş yapılacak
		
						
			secureSessionRemove("userKey"); // giriş varsa sıfırla
			
			$getData = self::getData($loginInput);
					
					
			if(@$getData['loginInput'] == $loginInput){ //böyle bir user var
				
				
				if(@$getData['loginPassword'] == sha1(md5($loginPassword))){ //şifre doğru
					
												
					secureSessionSet("userKey", $getData['userKey']);
					self::disciplineCheck($getData);
					return @$getData;
					
				}else{  //şifre yanlış
					
					
					return false;
					
				}
				
				
				
				
			}else{ //böyle bir user yok
				
				
				return false;
				
			}
						
			
			
		}elseif(userKey){ //mevcut giriş var

			self::disciplineCheck(self::getData(userKey));
			return self::getData(userKey);
			

		}else{ 
			
			
			return false;
			
		}		
		
	}
	
	public function disciplineCheck($getData){
		
								
						if(!empty($getData['bannedDate'])){ //Banlı
		
							$time = strtotime($getData['bannedDate']);
							
							if($time > time()){ //ban süresi devam ediyor
								
								hookSystem::add_action("modalError", function($data) use($getData){
					
									$ViewEngine = new ViewEngine();
									return $data.''.$ViewEngine->view("static/modalerror", [
											"text" => "The account has been banned until ".$getData['bannedDate'],
									]);
										
								});
								
								
								self::logout(); 
								return true;
								
							}else{
								
								goto noBan;
								
							}
							
						}else{ //Ban yok
						
							noBan:
							
							if($getData['deleted'] == 1){ //hesap silindi
							
								hookSystem::add_action("modalError", function($data) use($getData){
					
									$ViewEngine = new ViewEngine();
									return $data.''.$ViewEngine->view("static/modalerror", [
											"text" => "Your account has been deleted.",
									]);
										
								});
							
								self::logout(); 
								return true;
								
							}else{ //hesap silinmedi
								
								//secureSessionSet("userKey", $getData['userKey']);
								//return @$getData;
								
							}	
						
							
							
						}
				
					
				
	}
	
	
	public function logout(){
		
		secureSessionRemove("userKey"); // giriş varsa sıfırla
		return true;
		
	}
	
	
		public function UserAdd($loginInput, $loginPassword){
		
		
		$getData = self::getData($loginInput);

			if(@$getData['loginInput'] == $loginInput){ //böyle bir user var


				return false;

			}else{ //böyle bir user yok
				
			$userKey =  sha1(bin2hex(random_bytes(50)).''.$loginInput.''.SECURE_KEY);
				
				
			$query = $this->db->prepare("INSERT INTO `userSystem` SET 
			userKey = :userKey,
			loginInput = :loginInput,
			loginPassword = :loginPassword	
			");
			$insert = $query->execute(array(
			"userKey" => $userKey, 
			"loginInput" => $loginInput, 
			"loginPassword" => sha1(md5($loginPassword))
			));
			if ( $insert ){
			$last_id = $this->db->lastInsertId();
				return true;
			}else{
				
				return false;
				
			}
	
				
				
			}
		
		
	}
	
	
		public function UserUpdate($loginInputoruserKey, $loginInput = null, $loginPassword = null){
		
		$return = false;
		
		
		$getData = self::getData($loginInputoruserKey);	
	
	
	if($loginInput == null){
		
		$loginInput = $getData['loginInput'];
		
	}
	
	if($loginPassword == null){
		
		$loginPassword = $getData['loginPassword'];
		
	}else{
		
		$loginPassword = sha1(md5($loginPassword));
		
	}
		
	
			$query = $this->db->prepare("UPDATE `userSystem` SET 
			loginInput = :loginInput,
			loginPassword = :loginPassword
			WHERE {$getData['queryType']} = :data");
			$insert = $query->execute(array(
			"loginInput" => $loginInput,
			"loginPassword" => $loginPassword,
			"data" => $getData[$getData['queryType']]
			));
			if ( $insert ){
			$last_id = $this->db->lastInsertId();
			$return = true;
			} 
			
				return $return;
	
		
		
	}
	
	
		public function UserDelete($loginInputoruserKey){
		
		$getData = self::getData($loginInputoruserKey);	

			if(@$getData[$getData['queryType']] == $loginInputoruserKey){ //böyle bir user var
	
	
				//$query = $this->db->prepare("DELETE FROM `userSystem` WHERE {$getData['queryType']} = :data");
				//$delete = $query->execute(array(
				//   'data' => $getData[$getData['queryType']]
				//));
					
					$query = $this->db->prepare("UPDATE `userSystem` SET 
					deleted = :deleted
					WHERE uS_ID = :uS_ID");
					$insert = $query->execute(array(
					"deleted" => 1,
					"uS_ID" => $getData['uS_ID']
					));
					if ( $insert ){
					$last_id = $this->db->lastInsertId();
					
						return true;
						
					}else{
						
						return false;
					}		
					
			
	
			}else{ //böyle bir kullanıcı yok
			
				return false;
				
			}
		
	}
	
		public function UserBanned($loginInputoruserKey, $day = 1){
			
			$getData = self::getData($loginInputoruserKey);	

			if(@$getData[$getData['queryType']] == $loginInputoruserKey){ //böyle bir user var
			
			
					$query = $this->db->prepare("UPDATE `userSystem` SET 
					bannedDate = :bannedDate
					WHERE uS_ID = :uS_ID");
					$insert = $query->execute(array(
					"bannedDate" => date("Y-m-d", time()+((60*60)*24*$day)),
					"uS_ID" => $getData['uS_ID']
					));
					if ( $insert ){
					$last_id = $this->db->lastInsertId();
					
						return true;
						
					}else{
						
						return false;
					}		
					
			
			
			}else{ //böyle bir kullanıcı yok
				
				return false;
				
			}
			
		}
		
		
		public function resetPasswordURL($loginInputoruserKey){
			
			$getData = self::getData($loginInputoruserKey);	
			
			if(@$getData[$getData['queryType']] == $loginInputoruserKey){ //böyle bir user var
				
				$hash = encryptData($getData['userKey'].'|'.time());
				$URL = '/reset-password?hash='.urlencode($hash);
				return $URL;
				
			}else{ //böyle bir kullanıcı yok
				
				return false;
				
			}	
			
			
		}
	
##################################################################	
##################################################################	
##################################################################	
	
	
		public function userOption($loginInputoruserKey, $optionKey = null, $optionData = null){
			
			$getData = self::getData($loginInputoruserKey);	

			if(@$getData[$getData['queryType']] == $loginInputoruserKey){ //böyle bir user var
	
				if(@$optionData == null){
					//select
				
					if($optionKey == null){
						
						$query = $this->db->prepare("SELECT * FROM `userOptions` WHERE userKey = :userKey");
						$userOption = @$query->execute(array("userKey" => $getData['userKey']));
						$userOption = @$query->fetchAll(\PDO::FETCH_ASSOC);	
						
						return $userOption;
						
					}else{
						
						$query = $this->db->prepare("SELECT * FROM `userOptions` WHERE userKey = :userKey and optionKey = :optionKey");
						$userOption = @$query->execute(array("userKey" => $getData['userKey'], "optionKey" => $optionKey));
						$userOption = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];	
						
						return $userOption;						
						
					}
					
						
				
				}else{
					//insert or update
					$optionCheck = self::userOption($getData['userKey'], $optionKey);
					
					if(@$optionCheck['optionKey'] == $optionKey){
						//update
						
							$query = $this->db->prepare("UPDATE `userOptions` SET 
							optionData = :optionData
							WHERE optionKey = :optionKey");
							$insert = $query->execute(array(
							"optionData" => $optionData,
							"optionKey" => $optionKey
							));
							if ( $insert ){
							$last_id = $this->db->lastInsertId();
								return true;
							}else{
								
								return false;
							}					
						
						
					}else{
						//insert
						
						$query = $this->db->prepare("INSERT INTO `userOptions` SET 
						optionKey = :optionKey,
						optionData = :optionData,
						userKey = :userKey	
						");
						$insert = $query->execute(array(
						"optionKey" => $optionKey, 
						"optionData" => $optionData, 
						"userKey" => $getData['userKey']
						));
						if ( $insert ){
						$last_id = $this->db->lastInsertId();
							return true;
						}else{
							
							return false;
							
						}
						
						
					}			
					
					
				}
			
			}else{
				
				return false;
				
			}
			
			
			
		}
		

		
##################################################################	
##################################################################	
##################################################################	
		
		public function roles($value = null){
			
			if($value == null){
				//roles list
				
				$query = $this->db->prepare("SELECT * FROM `roles`");
				$roles = @$query->execute();
				$roles = @$query->fetchAll(\PDO::FETCH_ASSOC);
				
				
				foreach($roles as  $role){
					
					$return[$role['roleKey']] = [
					"roleID" => $role['roleID'],
					"roleKey" => $role['roleKey'],
					"roleText" => self::__('role_'.$role['roleKey'], $role['roleKey'])
					];
					
				}
				
				return $return;
				
			}else{
				
					//ekle veye var olanaın idsini döndür
				
				$rolesList = self::roles();
				
					if(isset($rolesList[$value])){
						//var						
						return $rolesList[$value];
						
					}else{
						//yok						
						$query = $this->db->prepare("INSERT INTO `roles` SET 
						roleKey = :roleKey
						");
						$insert = $query->execute(array(
						"roleKey" => text2slug($value)
						));
						if ( $insert ){
						$last_id = $this->db->lastInsertId();
							return true;
						}else{
							
							return false;
							
						}
						
					}
				
			}
			
			
		}
		
		
			public function roleRemove($value = null){
			
			$value = text2slug($value);
			
			if($value !== null){
				
				$rolesList = self::roles();
				
				if(isset($rolesList[$value])){ 
										
					$query = $this->db->prepare("DELETE FROM `mergeRolePerm` WHERE roleID = :roleID");
					$delete = $query->execute(array(
					 'roleID' => $rolesList[$value]['roleID']
					));
					
					$query = $this->db->prepare("DELETE FROM `mergeRolesUser` WHERE roleID = :roleID");
					$delete = $query->execute(array(
					 'roleID' => $rolesList[$value]['roleID']
					));
									
			
					$query = $this->db->prepare("DELETE FROM `roles` WHERE roleKey = :roleKey");
					$delete = $query->execute(array(
					 'roleKey' => $value
					));
					
					
					return true;
					
				}else{
					
					return false;
					
				}
						
				
				
			}else{
				
				return false;			
				
			}
			
			
		}
		
##################################################################	
##################################################################	
##################################################################			
		
##################################################################	
##################################################################	
##################################################################	
		
		public function perm($value = null){
			
			if($value == null){
				// project List
				
				$query = $this->db->prepare("SELECT DISTINCT projectKey FROM `perms");
				$projectList = @$query->execute();
				$projectList = @$query->fetchAll(\PDO::FETCH_ASSOC);								
				
				foreach($projectList as $project){
					
					$return[$project['projectKey']] = ["projectKey" => $project['projectKey'], "projectText" => self::__($project['projectKey'], $project['projectKey'])];
					
					
				}
				
				return $return;
				
			}elseif(isset($value['permKey']) == null){
				//perm List
		
				$query = $this->db->prepare("SELECT * FROM `perms` WHERE projectKey = :projectKey");
				$perms = @$query->execute(["projectKey" => $value['projectKey']]);
				$perms = @$query->fetchAll(\PDO::FETCH_ASSOC);
				
				foreach($perms as $perm){
					
					$return[$perm['projectKey'].'@'.$perm['permKey']] = [
					"permID" => $perm['permID'],
					"permKey" => $perm['permKey'],
					"permText" => self::__($perm['projectKey'].'@'.$perm['permKey'], $perm['projectKey'].'@'.$perm['permKey']),
					"projectKey" => $perm['projectKey'],
					"projectText" => self::__($perm['projectKey'], $perm['projectKey'])
					
					
					];
					
				}
				
				return @$return;
				
			}elseif(isset($value['permKey'])){

								
				$permList = self::perm(["projectKey" => $value['projectKey']]);
		
	
				if(isset($permList)){
					//proje var
					
					//perm key var mı ona bak
				if(isset($permList[$value['projectKey'].'@'.$value['permKey']])){
					//permKey var
					
					return @$permList[$value['permKey']];
					
					
				}else{
					//permKey yok
					
					$query = $this->db->prepare("INSERT INTO `perms` SET 
					permKey = :permKey,
					projectKey = :projectKey
					");
					$insert = $query->execute([
					"permKey" => text2slug($value['permKey']),
					"projectKey" => text2slug($value['projectKey'])
					]);
					if ( $insert ){
					$last_id = $this->db->lastInsertId();
						return true;
					}else{
						
						return false;
						
					}
					
					
				}				
				
				}else{
					//proje yok
					
					
					$query = $this->db->prepare("INSERT INTO `perms` SET 
					permKey = :permKey,
					projectKey = :projectKey
					");
					$insert = $query->execute([
					"permKey" => text2slug($value['permKey']),
					"projectKey" => text2slug($value['projectKey'])
					]);
					if ( $insert ){
					$last_id = $this->db->lastInsertId();
						return true;
					}else{
						
						return false;
						
					}
					
					
				}
	
	
	
				
			}else{
				
				return false;
				
			}
			
			
			
		} 
##################################################################	
##################################################################	
##################################################################	
		public function projectRemove($value){
		
			$project = self::perm([
			"projectKey" => $value
			]);	
			
			if(isset($project)){
				//var
				
				$query = $this->db->prepare("DELETE FROM `perms` WHERE projectKey = :projectKey");
				$delete = $query->execute(array(
				 'projectKey' => $value
				));
				
				return true;
				
				
			}else{
				
				return false;
				
			}			
			
		}
		
##################################################################	
##################################################################	
##################################################################			
		public function permRemove($value){
			
			
			$query = $this->db->prepare("SELECT * FROM `perms` WHERE projectKey = :projectKey and permKey = :permKey");
			$permSelect = @$query->execute([
			"projectKey" => $value['projectKey'],
			"permKey" => $value['permKey']			
			]);
			$permSelect = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
			
								
			if(@$permSelect['permKey'] == $value['permKey']){
				//var
				
				$query = $this->db->prepare("DELETE FROM `perms` WHERE permID = :permID");
				$delete = $query->execute(array(
				 'permID' => $permSelect['permID']
				));
				
				return true;
				
			}else{
				
				return false;
				
			}
					
			
		}
##################################################################	
##################################################################	
##################################################################	

	public function rolePermdata($value){
		
		$query = $this->db->prepare("SELECT * FROM `roles` WHERE roleKey = :roleKey");
		$roleSelect = @$query->execute([
		"roleKey" => $value
		]);
		$roleID = @$query->fetchAll(\PDO::FETCH_ASSOC)[0]['roleID'];
		
		//$query = $this->db->prepare("SELECT * FROM `mergeRolePerms` WHERE roleID = :roleID");
		$query = $this->db->prepare("SELECT * FROM mergeRolePerms JOIN perms ON mergeRolePerms.permID = perms.permID WHERE mergeRolePerms.roleID = :roleID");
		$PermsMerge = @$query->execute([
		"roleID" => $roleID
		]);
		$PermsMerge = @$query->fetchAll(\PDO::FETCH_ASSOC);
		
		foreach($PermsMerge as $perm){
			
			$returnPermsMerge[] = [
			"permID" => $perm['permID'],
			"roleID" => $perm['roleID'],
			"permKey" => $perm['permKey'],
			"projectKey" => $perm['projectKey'],
			"permText" => self::__($perm['projectKey'].'@'.$perm['permKey'], $perm['projectKey'].'@'.$perm['permKey'])			
			];
			
		}
		
		return $returnPermsMerge;
	}
	
	

	public function mergeRolePerm($value){		
		
		$query = $this->db->prepare("SELECT * FROM `perms` WHERE permID = :permID");
		$permSelect = @$query->execute([
		"permID" => $value['permID']
		]);
		$permID = @$query->fetchAll(\PDO::FETCH_ASSOC)[0]['permID'];
		
		$query = $this->db->prepare("SELECT * FROM `roles` WHERE roleID = :roleID");
		$roleSelect = @$query->execute([
		"roleID" => $value['roleID']
		]);
		$roleID = @$query->fetchAll(\PDO::FETCH_ASSOC)[0]['roleID'];
		
		$query = $this->db->prepare("SELECT * FROM `mergeRolePerms` WHERE permID = :permID and roleID = :roleID");
		$mergeRolePerms = @$query->execute([
		"permID" => $permID,
		"roleID" => $roleID
		]);
		$mergeRolePerms = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];		
		
		
		
		if($permID == $value['permID'] and $roleID == $value['roleID']){
			
						

			if($value['process'] == "insert"){
				
				if(!isset($mergeRolePerms['mergeRolePermID'])){
					
					$query = $this->db->prepare("INSERT INTO `mergeRolePerms` SET 
					permID = :permID,
					roleID = :roleID	
					");
					$insert = $query->execute([
					"permID" => $permID,
					"roleID" =>$roleID
					]);
					if ( $insert ){
					$last_id = $this->db->lastInsertId();
					
						return true;
						
					}else{
						
						return false;
						
					}
					
				}else{
					
					return false;
					
				}
				
			}elseif($value['process'] == "remove"){
				
				if(isset($mergeRolePerms['mergeRolePermID'])){
					
					$query = $this->db->prepare("DELETE FROM `mergeRolePerms` WHERE mergeRolePermID = :mergeRolePermID");
					$delete = $query->execute(array(
					 'mergeRolePermID' => $mergeRolePerms['mergeRolePermID']
					));
					
					return true;
					
				}else{
					
					return false;
					
				}
				
				
			}else{
				
				return false;
				
			}
		
		}else{
			
			return false;
			
		}
	}
		
		
		
	public function mergeRolesUser($value){
		
		$userData = self::getData($value['loginInputoruserKey']);
		
		$query = $this->db->prepare("SELECT * FROM `roles` WHERE roleID = :roleID");
		$roleSelect = @$query->execute([
		"roleID" => $value['roleID']
		]);
		$roleID = @$query->fetchAll(\PDO::FETCH_ASSOC)[0]['roleID'];
		
		$query = $this->db->prepare("SELECT * FROM `mergeRolesUser` WHERE userKey = :userKey and roleID	 = :roleID");
		$mergeRolesUser = @$query->execute([
		"userKey" => $userData['userKey'],
		"roleID" => $value['roleID']
		]);
		$mergeRolesUser = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
		
		if($userData[$userData['queryType']] == $value['loginInputoruserKey'] and $roleID == $value['roleID']){
			
			
			if($value['process'] == "insert"){
				
				if(!isset($mergeRolesUser)){
					
					$query = $this->db->prepare("INSERT INTO `mergeRolesUser` SET 
					userKey	 = :userKey	,
					roleID = :roleID	
					");
					$insert = $query->execute([
					"userKey" => $userData['userKey'],
					"roleID" => $value['roleID']
					]);
					if ( $insert ){
					$last_id = $this->db->lastInsertId();
					
						return true;
						
					}else{
						
						return false;
						
					}
					
				}else{
					
					return false;
					
				}
				
				
			}elseif($value['process'] == "remove"){
				
				if(isset($mergeRolesUser)){
					
					$query = $this->db->prepare("DELETE FROM `mergeRolesUser` WHERE mergeRolesUserID = :mergeRolesUserID");
					$delete = $query->execute(array(
					 'mergeRolesUserID' => $mergeRolesUser['mergeRolesUserID']
					));
					
					return true;
					
				}else{
					
					return false;
					
				}
				
				
			}else{
				
				return false;
				
			}		
			
			
		}else{
			
			return false;
			
		}
		
	
		
		
	}
	
	public function userRoleData($value){
		
		$getData = self::getData($value);	
		
			$query = $this->db->prepare("SELECT * FROM `mergeRolesUser` WHERE userKey = :userKey");
			$mergeRolesUser = @$query->execute([
			"userKey" => $getData['userKey']
			]);
			$mergeRolesUser = @$query->fetchAll(\PDO::FETCH_ASSOC);
			
			foreach($mergeRolesUser as $roles){
				
				
				$query = $this->db->prepare("SELECT * FROM `roles` WHERE roleID = :roleID");
				$Role = @$query->execute([
				"roleID" => $roles['roleID']
				]);
				$Role = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];				
				
				$Roles[$Role['roleKey']] = [
				"roleID" => $Role['roleID'],
				"roleKey" => $Role['roleKey'],
				"roleText" => self::__($Role['roleKey'], $Role['roleKey'])			
				]; 
				
			}
			
			return $Roles;
		
	}
	
	
	public function userPermsRoleData(){
			
			$login = self::login();
			$userKey = @$login['userKey'];
						
						
			$query = $this->db->prepare("SELECT * FROM `mergeRolesUser` WHERE userKey = :userKey");
			$mergeRolesUser = @$query->execute([
			"userKey" => $login['userKey']
			]);
			$mergeRolesUser = @$query->fetchAll(\PDO::FETCH_ASSOC);
			
			
			foreach($mergeRolesUser as $RolesUser){
				
				$roleID = $RolesUser['roleID'];
				
					$query = $this->db->prepare("SELECT * FROM `roles` WHERE roleID = :roleID");
					$Role = @$query->execute([
					"roleID" => $roleID
					]);
					$Role = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];				
				
					

						$query = $this->db->prepare("SELECT * FROM `mergeRolePerms` WHERE roleID = :roleID");
						$RolePerms = @$query->execute([
						"roleID" => $Role['roleID']
						]);
						$RolePerms = @$query->fetchAll(\PDO::FETCH_ASSOC);
											
						
						foreach($RolePerms as $RPerms){
						
							$query = $this->db->prepare("SELECT * FROM `perms` WHERE permID = :permID");
							$perms = @$query->execute([
							"permID" => $RPerms['permID']
							]);
							$perms = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
							
							if(!empty($perms['projectKey']) and !empty($perms['permKey'])){
							
							$permList[$perms['projectKey'].'@'.$perms['permKey']] = $Role['roleKey'];
					
							}
					
						}
			}
		
		
	
		return @$permList;
	}

	public function permCheck($value = null, $callback = "page"){
		
		
		$value = strtolower($value);
		$parseValue = explode("@", $value);
		self::perm([
		"projectKey" => $parseValue[0],
		"permKey" => $parseValue[1]
		]);		
		
		$permList = self::userPermsRoleData();
		
		if($value !== null and !isset($permList[$value])){
			
				if($callback == "page"){
					
					//self::logout();
					header('HTTP/1.0 403 Forbidden', true, 403);	
					die();
					
				}elseif($callback == "return"){
					
					return false;
					
				}
			
	
						
		}else{
			
			return true;
			
		}
		
	}
	


}



$User = new User;
$roleRemove = $User->roleRemove();
print_r($roleRemove);


/** Password Restart URL **/
/** Password Restart URL **/
/** Password Restart URL **/
/** Password Restart URL **/
/** Password Restart URL **/
/** Password Restart URL **/
/** Password Restart URL **/
/** Password Restart URL **/
/** Password Restart URL **/
Route::run("/reset-password", function(){
	

		
		$hash = explode("|", decryptData($_GET['hash']));
		$userKey = $hash[0];
		$Createtime = $hash[1];
		
		$User = new User;
		$getData = $User->getData($userKey);
	
	
	hookSystem::add_action("index", function() use ($getData, $User, $Createtime){
		
		if($Createtime < (time() - resetPasswordTime)){ //link süresi geçmiş
		
		hookSystem::add_action("resetPasswordAlert", function(){
							
			$viewEngine = new viewEngine;
			return $viewEngine->view("static/reset-passwordError", [
			"text" => __("passwordChangeTimeout", "Link süresi dolmuş")
			]);
							
		});
		
		
	}else{ //süresi geçmemiş
		
		if(isset($_POST['New_Password']) and isset($_POST['TryNew_Password'])){
						
				
				if($_POST['New_Password'] == $_POST['TryNew_Password']){ //basarılı
				
					$changePassword = $User->UserUpdate($getData['userKey'], $getData['loginInput'], $_POST['New_Password']);								
					if($changePassword){ //degistirildi
						
						hookSystem::add_action("resetPasswordAlert", function(){
							
							$viewEngine = new viewEngine;
							return $viewEngine->view("static/reset-passwordError", [
							"text" => __("passwordChangesuccess", "Başarılı")
							]);
							
						});
						
					}else{ //basarisiz
						
						hookSystem::add_action("resetPasswordAlert", function(){
							
							$viewEngine = new viewEngine;
							return $viewEngine->view("static/reset-passwordError", [
							"text" => __("passwordChangeunsuccess", "Başarısız")
							]);
							
						});
						
					}
				
				
				}else{ //iki şifre aynı değil
					
					hookSystem::add_action("resetPasswordAlert", function(){
							
						$viewEngine = new viewEngine;
						return $viewEngine->view("static/reset-passwordError", [
						"text" => __("passwordChangepasswordrepeatincorrect", "Şifre Tekrarı Hatalı")
						]);
							
					});
					
				}
				
				
			
			

		}	
		
	}
		
		$viewEngine = new viewEngine;
		return $viewEngine->view("static/reset-password", [
		"New_Password_placeholder" => __("New_Password_placeholder", "Yeni Şifre"),
		"TryNew_Password_placeholder" => __("TryNew_Password_placeholder", "Yeni Şifre Tekrar"),
		"changePassword_button" => __("changePassword_button", "Şifre Değiştir"),
		]);
		
	});
	
}, "get|post");