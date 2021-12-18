<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
//Kullanım
/*
$translators = new translators;


$translators = $translators->language()->create([
	"lang_code" => "en",
	"lang_flag" => "usaflag",
	"lang_name" => "English"
]);                                                                					-> language ekler

$translators = $translators->language()->select();									-> language list

$translators = $translators->language()->select(lang_codeorlang_ID);				-> seçilen language data

$translators = $translators->pathList()->select([
"lang_codeorlang_ID" => "tr"
]);																					-> path list


$translators = $translators->sentence()->select([
"lang_codeorlang_ID" => "tr",
"ws_Path" => "/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php"
]);																					-> sentence list


$translators = $translators->sentence()->select([
"ts_ID" => 1
]);																					-> sentence select


$translators = $translators->sentence()->create([
"lang_code" => "english",
"ts_path" => "/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php",
"ts_path_line" => 131,
"ts_key" => "boardWidget",
"ts_sentence" => "denemeMetni"
]);   																				-> sentence create


$translators = $translators->language()->update([
"lang_codeorlang_ID" => "en",
"lang_code" => "en",
"lang_flag" => "english",
"lang_name" => "English"
]);																					-> language update


$translators = $translators->sentence()->update([
"ts_ID" => 13,
"ts_sentence" => "Deneme",
]);																					-> sentence update


$translators = $translators->language()->remove([
"lang_codeorlang_ID" => 1
]);																					-> language remove


$translators = $translators->sentence()->remove(52);								-> sentence remove



$translators = $translators->sentence()->check([
"lang_codeorlang_ID" => "tr",
"ts_path" => "/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php",
"ts_path_line" => "101",
"ts_key" => "passwordplaceholder"
]);																					-> sentence select (2)

*/
class translators{
	
	
	public $select;	
					
	
		public function language(){
			
			$this->select = 'language';
			return $this;
			
		}
		
		public function sentence(){
			
			$this->select = 'sentence';
			return $this;
			
		}
		
		
		public function pathList(){
			
			$this->select = 'pathList';
			return $this;
			
		}
		/*****************************/
		
		/*****************************/		
		public function create($value){
			global $db;
			
			if($this->select == "language"){ 		/*****************************/	

			if($value !== null){

				$query = $db->prepare("SELECT * FROM `translators_lang` WHERE 
				lang_code = :lang_code");
				$language = @$query->execute([
				"lang_code" => $value['lang_code']
				]);
				$language = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
				
				if(@$language['lang_code'] == $value['lang_code']){ //zaten ekli
					
					return false;
					
				}else{ //ekleme işlemi için musait
					
					$query = $db->prepare("INSERT INTO `translators_lang` SET
					lang_code = :lang_code,
					lang_flag = :lang_flag,
					lang_name = :lang_name");
					$insert = $query->execute([
					"lang_code" => $value['lang_code'],
					"lang_flag" => $value['lang_flag'],
					"lang_name" => $value['lang_name']
					]);
						if($insert){
							
							return true;
							
						}else{
							
							return false;
							
						}
					
					
					}


			}
			
			}elseif($this->select == "sentence"){
				
			if($value !== null){
				
					$languageSelect =  self::language()->select($value['lang_code']);
					if($languageSelect['lang_code'] == $value['lang_code']){
					$ts_unique_key	 = md5(SECURE_KEY.''.$languageSelect['lang_ID'].''.$value['ts_path'].''.$value['ts_path_line'].''.$value['ts_key']);
					
					$query = $db->prepare("INSERT INTO `translators_sentence` SET
					lang_ID = :lang_ID,
					ts_path = :ts_path,
					ts_path_line = :ts_path_line,
					ts_key = :ts_key,
					ts_unique_key = :ts_unique_key,
					ts_sentence = :ts_sentence");
					$insert = $query->execute([
					"lang_ID" => $languageSelect['lang_ID'],
					"ts_path" => $value['ts_path'],
					"ts_path_line" => $value['ts_path_line'],
					"ts_key" => $value['ts_key'],
					"ts_unique_key" => $ts_unique_key,
					"ts_sentence" => $value['ts_sentence']
					]);
						if($insert){
							
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
				

			}else{
				
				return false;
				
			}
			
		}
				
				
		/*****************************/		
		public function select($value = null){
			global $db;
			
			if($this->select == "language"){ 		/*****************************/		
				
				if($value == null){
					
					$query = $db->prepare("SELECT * FROM `translators_lang`");
					$language = @$query->execute();
					$language = @$query->fetchAll(\PDO::FETCH_ASSOC);
					
					return $language;					
					
				}else{
						
					$query = $db->prepare("SELECT * FROM `translators_lang` WHERE lang_code = :lang_code");
					$language = @$query->execute(["lang_code" => $value]);
					$language = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
					$queryType = 'lang_code';
					
					if(@$language['lang_code'] !== $value){
						
						$query = $db->prepare("SELECT * FROM `translators_lang` WHERE lang_ID = :lang_ID");
						$language = @$query->execute(["lang_ID" => $value]);
						$language = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
						$queryType = 'lang_ID';						
						
					}
					
						if(@$language['lang_code'] == $value or @$language['lang_ID'] == $value){
							
							return array_merge($language, ["queryType" => $queryType]);				
							
						}else{
							
							return false;
							
						}
					
				}
				
			}elseif($this->select == "sentence"){	/*****************************/		
			
				if($value !== null){
					
					
					if(isset($value['ws_Path'])){
					$language = self::language()->select($value['lang_codeorlang_ID']);	
						
						if(@$language[$language['queryType']] == $value['lang_codeorlang_ID']){							
							
							$query = $db->prepare("SELECT * FROM `translators_sentence` WHERE ts_path = :ts_path AND lang_ID = :lang_ID ORDER BY `translators_sentence`.`ts_path_line` ASC");
							$sentenceList = @$query->execute([
							"lang_ID" => $language['lang_ID'],
							"ts_path" => $value['ws_Path']							
							]);
							$sentenceList = @$query->fetchAll(\PDO::FETCH_ASSOC);
							
							return $sentenceList;
							
						}else{
							
							return false;
							
						}							
						
					}elseif(isset($value['ts_ID'])){
						
						
						$query = $db->prepare("SELECT * FROM `translators_sentence` WHERE ts_ID = :ts_ID");
						$sentenceData = @$query->execute(["ts_ID" => $value['ts_ID']]);
						$sentenceData = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];							
						return $sentenceData;
						
						
						
						
					}else{ 
						
						return false;
						
					}
			
				
				}else{
					
					return false;
					
				}
				
			}elseif($this->select == "pathList"){  /*****************************/	
				
				if($value !== null){
				
					$language = self::language()->select($value['lang_codeorlang_ID']);	
						if(@$language[$language['queryType']] == $value['lang_codeorlang_ID']){
						
						
							$query = $db->prepare("SELECT DISTINCT ts_path FROM translators_sentence WHERE lang_ID = :lang_ID");
							$pathList = @$query->execute([
							"lang_ID" => $language['lang_ID']
							]);
							$pathList = @$query->fetchAll(\PDO::FETCH_ASSOC);
								
								foreach($pathList as $path){
									
									$ts_pathList[] = $path['ts_path'];
																		
								}
								
								if(@$ts_pathList){
									
									return array_unique($ts_pathList);
									
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
			
		}
		
		public function update($value){
			global $db;
			
			if($value !== null){
			
			if($this->select == "language"){ 		/*****************************/		
				$language = self::language()->select($value['lang_codeorlang_ID']);
				
				if(@$value['lang_codeorlang_ID'] == @$language[$language['queryType']]){
					
					$query = $db->prepare("UPDATE `translators_lang` SET 
					lang_code = :lang_code,
					lang_flag = :lang_flag,
					lang_name = :lang_name
					WHERE {$language['queryType']} = :lang_codeorlang_ID");
					$insert = $query->execute(array(
					"lang_code" => $value['lang_code'],
					"lang_flag" => $value['lang_flag'],
					"lang_name" => $value['lang_name'],
					"lang_codeorlang_ID" => $language[$language['queryType']]
					));		
					
					return true;
					
				}else{
					
					return false;
										
				}
				
				
				
			}elseif($this->select == "sentence"){	/*****************************/						
				
				
				$selectSentence = self::sentence()->select(["ts_ID" => $value['ts_ID']]);	
				if($selectSentence['ts_ID'] == $value['ts_ID']){
					
					$query = $db->prepare("UPDATE `translators_sentence` SET 
					ts_sentence = :ts_sentence
					WHERE ts_ID = :ts_ID");
					$insert = $query->execute([
					"ts_sentence" => $value['ts_sentence'],
					"ts_ID" => $value['ts_ID']
					]);		
					
					return true;
					
				}else{					
					
					return false;
					
				}
				
			}
			
			}else{
				
				return false;
				
			}
			 
		}
		
		
		public function remove($value){
			global $db;
			
			if($this->select == "language"){ 		/*****************************/		
				
				$language = self::language()->select($value['lang_codeorlang_ID']);				
				if(@$value['lang_codeorlang_ID'] == @$language[$language['queryType']]){
					
					
					$query = $db->prepare("DELETE FROM `translators_lang` WHERE lang_ID = :lang_ID");
					$insert = $query->execute(array("lang_ID" => $value['lang_codeorlang_ID']));
					
					
					$query = $db->prepare("DELETE FROM `translators_sentence` WHERE lang_ID = :lang_ID");
					$insert = $query->execute(array("lang_ID" => $language['lang_ID']));
					if ( $insert ){
						$last_id = $db->lastInsertId();
						return true;
					}
						
					
					
					
				}else{
					
					return false;
					
				}
				
				
				
			}elseif($this->select == "sentence"){	/*****************************/						
				
				if($value !== null){
					
					$query = $db->prepare("DELETE FROM `translators_sentence` WHERE ts_ID = :ts_ID");
					$insert = $query->execute(array("ts_ID" => $value));
					if ( $insert ){
						$last_id = $db->lastInsertId();
						return true;
					}
					
				}else{
					
					return false;
					
				}
				
				
			}
			
		}	
		
		
		public function check($value = null){
			global $db;
			
			if($this->select == "sentence"){
				
				if($value !== null){
					
					$language = self::language()->select($value['lang_codeorlang_ID']);				
					if(@$value['lang_codeorlang_ID'] == @$language[$language['queryType']]){
						
							
						$ts_unique_key	 = translators_unique_generator($language['lang_ID'], $value['ts_path'], $value['ts_path_line'], $value['ts_key']);
						
							$query = $db->prepare("SELECT * FROM `translators_sentence` WHERE 
							ts_unique_key = :ts_unique_key");
							$sentenceData = @$query->execute([
							"ts_unique_key" => $ts_unique_key
							]);
							$sentenceData = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
							
								if(@$sentenceData['ts_unique_key'] == $ts_unique_key){
									
									return $sentenceData;
									
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
			
		}
		
		public static function pathRemove($path){
			global $db;
			
		
			$query = $db->prepare("DELETE FROM `translators_sentence` WHERE ts_path = :ts_path");
			$insert = $query->execute(array("ts_path" => $path));
			if ( $insert ){
				$last_id = $db->lastInsertId();
				return true;
			}else{
				
				return false;
				
			}
						
		
		}
		
		
		public static function debugMode($hash = null){
			global $db;
			
			if($hash !== null){
				
					//API
					$fileReaderGet = objectToArray(json_decode(decryptData($hash)));
				
					
					$getSource = @txtread(homepath."".$fileReaderGet['pathSelect']);
					$line = @explode("\n", $getSource);		
					
					if(@$line[$fileReaderGet['pathLine']-1]){
						//dosyadan veri alındı
						
						
						preg_match_all("/__(\(.*?)\)/", $line[$fileReaderGet['pathLine']-1], $lineData);
						$lineData = @$lineData[0][0];
						
						if($lineData !== null){
							// __() VAR
							
							
							preg_match_all('/__\("(.*?)", "(.*?)"\)/', $lineData, $callback);	
							
							if(@$callback[1][0] !== $fileReaderGet['ts_key']){
								
								preg_match_all('/__\("(.*?)","(.*?)"\)/', $lineData, $callback);	
								
							}
							
							if(@$callback[1][0] !== $fileReaderGet['ts_key']){
								
								preg_match_all('/__\("(.*?)" ,"(.*?)"\)/', $lineData, $callback);	
								
							}
							
							if(@$callback[1][0] !== $fileReaderGet['ts_key']){
								
								preg_match_all('/__\("(.*?)" , "(.*?)"\)/', $lineData, $callback);	
								
							}
							
							
								
								if(@$callback[1][0] == $fileReaderGet['ts_key']){ //Key doğru
									
									if(@$callback[2][0] == $fileReaderGet['ts_sentence']){ //İçerik doğru
										
										return json_encode(["status" => true, "error" => false, "lineData" => '__("<strong>'.$fileReaderGet['ts_key'].'</strong>", "<strong>'.$fileReaderGet['ts_sentence'].'</strong>");', "ts_ID" => $fileReaderGet['ts_ID']]);
										
									}else{ //içerikyanlıs
										
										return json_encode(["status" => "warning", "error" => "contentFalse", "lineData" => $lineData, "ts_ID" => $fileReaderGet['ts_ID']]);
										
									}
									
									
									
								}else{ //key yanlıs
									
								
									return json_encode(["status" => "warning", "error" => "keyFalse", "lineData" => $lineData, "ts_ID" => $fileReaderGet['ts_ID']]);

									
								}
					
								
								
						
							
						}else{
							// __() YOK
							
							return json_encode(["status" => false, "error" => "syntaxError", "lineData" => "*****SecretCode*****", "ts_ID" => $fileReaderGet['ts_ID']]);
							
						}
						
						
						
						
						
					}else{
						//dosyadan veri alınmadı
						
						return json_encode(["status" => "error", "error" => "syntaxError"]);
						
					}
				
				
				
				
			}else{
				
				return false;
				
			}
			
		}
		
		
	public static function debugFixer(){
		global $db;
			
			$lang_codeorlang_ID = "original";
			
			$translators = new translators;
			$pathList = $translators->pathList()->select([
			"lang_codeorlang_ID" => $lang_codeorlang_ID
			]);	
			
			foreach($pathList as $path){
				
				
				
				if(@file_exists(homepath.''.$path)){
				
					$sentenceList = $translators->sentence()->select([
					"lang_codeorlang_ID" => $lang_codeorlang_ID,
					"ws_Path" => $path
					]);		
					
						foreach($sentenceList as $sentence){
							
							$hash = encryptData(json_encode([
							"pathSelect" => $sentence['ts_path'],
							"pathLine" => $sentence['ts_path_line'],
							"ts_key" => $sentence['ts_key'],
							"ts_sentence" => $sentence['ts_sentence'],
							"ts_ID" => $sentence['ts_ID']						
							]));
							
								$debugMode = self::debugMode($hash);
								$debugSentence = objectToArray(json_decode($debugMode));
								
								if($debugSentence['error'] == "syntaxError"){
									
									$translators->sentence()->remove($debugSentence['ts_ID']);
									
								}
								
								if($debugSentence['error'] == "keyFalse"){
									
									$translators->sentence()->remove($debugSentence['ts_ID']);
									
								}
								
								
								
						}
					
				}else{
					
					self::pathRemove($path);
					
				}
				
			}
		
		
	
	
	}
		
		
		
	public function selectLanguage(){
		global $db;
			
			
			// tarayıcı diline geçiş yap
			$browserLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);		
			$selectLanguage = self::language()->select($browserLang);
			
				if(@$selectLanguage['lang_code'] == @$browserLang){					
					
					if(!isset($_COOKIE['language'])){
							
						setcookie("language", $browserLang, time() + 9999999999);
						header("Location: ".serverName.''.parse_url($_SERVER['REQUEST_URI'])['path']);	
						
					}						
										
				}else{
					
					if(!isset($_COOKIE['language'])){
						
						//default olarak belirtilen dile geçiş yap
						setcookie("language", defaultLanguage, time() + 9999999999); 	
						header("Location: ".serverName.''.parse_url($_SERVER['REQUEST_URI'])['path']);	
						
					}
					
				}				
		
			
		
		

			// belirtilen dile geçiş yap	
			if(@$_GET['language']){
			
			$selectLanguage = self::language()->select($_GET['language']);
			
				if(@$selectLanguage['lang_code'] == @$_GET['language']){					
									
					setcookie("language", $_GET['language'], time() + 9999999999);
					header("Location: ".serverName.''.parse_url($_SERVER['REQUEST_URI'])['path']);		
										
				}				
		
			}
		
		return $_COOKIE['language'];
	}	
		
		
	
}

