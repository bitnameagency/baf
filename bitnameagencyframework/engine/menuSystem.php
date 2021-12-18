<?php

if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}
	
/*
KULLANIM KLAVUZU

$menu = new menu;


$menu = $menu->groupKey()->select();    					-> groupKey listesi
$menu = $menu->groupKey()->select("Key");   	  			-> group içindeki item listesi
$menu = $menu->groupKey()->create("groupKey");				-> groupKey oluşturur

$menu = $menu->groupKey()->update([
["groupKey" => "old"],
["groupKey" => "new"]
]);															-> groupKey günceller

$menu = $menu->groupKey()->remove("testmenu");				-> groupKey ve elemanlarını siler



													

$menu = $menu->children()->select(int ID or itemKey);		-> children idsi veya itemkey ile verileri getirir.

$menu = $menu->children()->create([
"subID" => 0,
"itemKey" => "mainpage",
"itemLink" => "/path",
"itemTarget" => "_self",
"groupKey" => "mainKey",
"orderInt" => 1
]);															-> children oluşturur

$menu = $menu->children()->update([
"itemKeyorID" => "",
"subID" => "0",
"itemKey" => "",
"itemLink" => "",
"itemTarget" => "",
"groupKey" => "",
"orderInt" => ""
]);															-> children günceller

$menu = $menu->children()->remove(int ID or itemKey);		->  children silme




*/	
	
	
	
	
	
	
		
	class menu{
		
		public $select;
		
						
		
			public function groupKey(){
				
				$this->select = 'groupKey';
				return $this;
				
			}
			
			
			public function children(){
				
				$this->select = 'children';
				return $this;
								
			}
		
		
			    /**************************/
				
							
				
				public function childrenList($groupKey = null, $subID = 0){
				
				global $db;

					$query = $db->prepare("SELECT * FROM `menuSystem` WHERE groupKey = :groupKey and subID = :subID ORDER BY `menuSystem`.`orderInt` ASC");
					$subItemList = @$query->execute([
					"groupKey" => $groupKey,
					"subID" => $subID
					]);
					
					$subItemList = @$query->fetchAll(\PDO::FETCH_ASSOC);
					
					if($subItemList){
									
						foreach($subItemList as $item){
							
							$item['itemText'] = __('MENUID'.$item['ID'].'-'.$item['itemKey'], $item['itemKey']);
																	
							$return[] = [
							"children" => array_merge($item, ["children" =>  self::childrenList($groupKey, $item['ID'])])
							];								
									
						}							
						
						return @$return;										
				
					}else{
						
						return false;
						
					}
				}
				 			
			    /**************************/
				

				
				
				/**************************/
				public function select($value = null){
					global $db;
					
					if($this->select == "groupKey"){ /**************************/
						
						if($value == null){
						
							$query = $db->prepare("SELECT DISTINCT groupKey FROM menuSystem");
							$menuSystem = @$query->execute();
							$menuSystem = @$query->fetchAll(\PDO::FETCH_ASSOC);
								
								foreach($menuSystem as $menu){
									
									$keyList[] = $menu['groupKey'];
																		
								}
								
								if(@$keyList){
									
									return array_unique($keyList);
									
								}else{
									
									return false;
									
								}					
						
						
						}else{
							
							
								return self::childrenList($value, $sub_ID = 0);	
						
						}
						
					}elseif($this->select == "children"){ /**************************/					
					
							$query = $db->prepare("SELECT * FROM `menuSystem` WHERE `ID` = :ID");
							$menuSystem = @$query->execute(["ID" => $value]);
							$menuSystem = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
							$queryType = 'ID';
	
	
						if((int)@$menuSystem['ID'] !== $value){
							
							$query = $db->prepare("SELECT * FROM `menuSystem` WHERE itemKey = :itemKey");
							$menuSystem = @$query->execute(["itemKey" => $value]);
							$menuSystem = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
							$queryType = 'itemKey';						
							
						}
						
						
							
						
						if(@$menuSystem['ID'] == $value or @$menuSystem['itemKey'] == $value){
							
							
							return array_merge($menuSystem, ["queryType" => $queryType]);						
							
							
						}else{
							
							return false;
												
						}
						
					}
					
				}				
				/**************************/
				/**************************/
				public function create($value = null){ 
					global $db;
					
					if($this->select == "groupKey"){ /**************************/
						
						if($value !== null){
							
							
							$groupKey = self::groupKey()->select($value);
						
							if($groupKey !== false){
								
								//daha önce eklenmiş								
								return false;
								
							}else{
								
								$query = $db->prepare("INSERT INTO `menuSystem` SET 
								subID = :subID,
								itemKey = :itemKey,
								itemLink = :itemLink,
								itemTarget = :itemTarget,
								groupKey = :groupKey,
								orderInt = :orderInt");
								$insert = $query->execute([
								"subID" => 0,
								"itemKey" => "empty",
								"itemLink"  => "empty",
								"itemTarget"  => "empty",
								"groupKey" => text2slug($value),
								"orderInt" => 0							
								]);
								if ( $insert ){
								$last_id = $db->lastInsertId();
								return true;
								}
								
							}
							
						}else{ //value null
							
							return false;
							
						}
						
						
					}elseif($this->select == "children"){ /**************************/
						
						
							if($value !== null){
								
								extract($value);									
						
								$children = self::children()->select($itemKey);
							
								if($children !== false){
									
									//daha önce eklenmiş								
									return false;
									
								}else{
									
									$query = $db->prepare("INSERT INTO `menuSystem` SET 
									subID = :subID,
									itemKey = :itemKey,
									itemLink = :itemLink,
									itemTarget = :itemTarget,
									groupKey = :groupKey,
									orderInt = :orderInt");
									$insert = $query->execute([
									"subID" => $subID,
									"itemKey" => text2slug($itemKey),
									"itemLink"  => $itemLink,
									"itemTarget"  => $itemTarget,
									"groupKey" => text2slug($groupKey),
									"orderInt" => $orderInt						
									]);
									if ( $insert ){
									$last_id = $db->lastInsertId();
									return true;
									}
									
								}
							
						}else{ //value null
							
							return false;
							
						}						
						
					}
					
					
					
				}
				/**************************/
				/**************************/
				public function update($value = null){
					global $db;
					
					if($this->select == "groupKey"){  /**************************/
						
						if($value !== null){											
								
							$query = $db->prepare("SELECT * FROM `menuSystem` WHERE groupKey = :groupKey");
							$menuSystem = @$query->execute(["groupKey" => $value[0]['groupKey']]);
							$menuSystem = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];	
								
							if(@$menuSystem['groupKey'] == $value[0]['groupKey']){
							
								$query = $db->prepare("UPDATE `menuSystem` SET 
								groupKey = :NewgroupKey
								WHERE groupKey = :groupKey");
								$insert = $query->execute(array(
								"NewgroupKey" => text2slug($value[1]['groupKey']),
								"groupKey" => text2slug($value[0]['groupKey'])
								));		

								return true;
								
							}else{
								
								return false;
								
							}	
								
							
							
						}else{
							
							return false;
							
						}			
						
						
					}elseif($this->select == "children"){  /**************************/
						
						
						if($value !== null){
							
							$children = self::children()->select($value['itemKeyorID']);
							if(@$children[$children['queryType']] == @$value['itemKeyorID']){								
							
								
								$query = $db->prepare("UPDATE `menuSystem` SET 
								subID = :subID,
								itemKey = :itemKey,
								itemLink = :itemLink,
								itemTarget = :itemTarget,
								groupKey = :groupKey,
								orderInt = :orderInt
								WHERE {$children['queryType']} = :itemKeyorID");
								$insert = $query->execute(array(
								"subID" => $value['subID'],
								"itemKey" => text2slug($value['itemKey']),
								"itemLink" => $value['itemLink'],
								"itemTarget" => $value['itemTarget'],
								"groupKey" => text2slug($value['groupKey']),
								"orderInt" => $value['orderInt'],
								"itemKeyorID" => $value['itemKeyorID']
								));		
								
								return true;
								
							}else{
								
								return false;
								
							}
							
						}else{
							
							return false;
							
						}
						
						
						
					}
				
					
				}
				/**************************/
				/**************************/
				public function remove($value = null){
					global $db;
					
						if($this->select == "groupKey"){  /**************************/
						
						if($value !== null){
							
							$query = $db->prepare("SELECT * FROM `menuSystem` WHERE groupKey = :groupKey");
							$menuSystem = @$query->execute(["groupKey" => $value]);
							$menuSystem = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];	
									
								if(@$menuSystem['groupKey'] == $value){
								
									$query = $db->prepare("DELETE FROM `menuSystem` WHERE groupKey = :groupKey");
									$insert = $query->execute(array("groupKey" => $value));
									if ( $insert ){
										$last_id = $db->lastInsertId();
										return true;
									}
									
								}else{
								
									return false;
								
								}									
										
							
						}else{
							
							return false;
							
						}
						
						
						
						
					}elseif($this->select == "children"){  /**************************/
						
						
						if($value !== null){
							
							
							$children = self::children()->select($value);
							
							if(@$children[$children['queryType']] == $value){
						
								
								$queryUpdate = $db->prepare("UPDATE `menuSystem` SET 
								subID = :NewsubID
								WHERE subID = :subID");
								$insert = $queryUpdate->execute(array(
								"NewsubID" => 0,
								"subID" => $children['ID']
								));	
								
							
								
								$queryDelete = $db->prepare("DELETE FROM `menuSystem` WHERE {$children['queryType']} = :itemKeyorID");
								$insert = $queryDelete->execute(array("itemKeyorID" => $value));
								if ( $insert ){
									$last_id = $db->lastInsertId();
									return true;
								}									
															
								
							}else{
							
							return false;
							
							}
							
						}else{
							
							return false;
							
						}
						
						
						
					}
					
					
				}
				/**************************/			
	

	}
/*
$menu = new menu;
$menuData = $menu->groupKey()->select("key");
print_r($menuData); */