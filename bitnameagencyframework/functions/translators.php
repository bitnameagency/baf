<?php

	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}


function translators_unique_generator($lang_ID, $ts_path, $ts_path_line, $ts_key){	
	
	$ts_unique_key	 = md5(SECURE_KEY.''.$lang_ID.''.$ts_path.''.$ts_path_line.''.$ts_key);
	return $ts_unique_key;
	
}




	function translators_select_sentence($ts_path, $ts_path_line, $ts_key, $lang_ID = 1){
		
		global $db;
		
				//$ts_unique_key	 = md5(SECURE_KEY.''.$lang_ID.''.$ts_path.''.$ts_path_line.''.$ts_key);
				$ts_unique_key	 = translators_unique_generator($lang_ID, $ts_path, $ts_path_line, $ts_key);

			
			$query = $db->prepare("SELECT * FROM `translators_sentence` WHERE 
			ts_unique_key = :ts_unique_key and lang_ID = :lang_ID");
			$icerik_Kontrol = @$query->execute(array("ts_unique_key" => $ts_unique_key, "lang_ID" => $lang_ID));
			$return_ = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
			return $return_;	
		
	}
	
	



	function translators_insert_sentence($lang_ID, $ts_path, $ts_path_line, $ts_key, $ts_sentence){
		
		global $db;
		
				//$ts_unique_key	 = md5(SECURE_KEY.''.$lang_ID.''.$ts_path.''.$ts_path_line.''.$ts_key);
				$ts_unique_key	 = translators_unique_generator($lang_ID, $ts_path, $ts_path_line, $ts_key);
			
			$query = $db->prepare("INSERT INTO `translators_sentence` SET
			lang_ID = :lang_ID,
			ts_path = :ts_path,
			ts_path_line = :ts_path_line,
			ts_key = :ts_key,
			ts_unique_key = :ts_unique_key,
			ts_sentence = :ts_sentence,
			viewURL = :viewURL");
			$insert = $query->execute(array(
				"lang_ID" => $lang_ID,
				"ts_path" => $ts_path,
				"ts_path_line" => $ts_path_line,
				"ts_key" => $ts_key,
				"ts_unique_key" => $ts_unique_key,
				"ts_sentence" => $ts_sentence,
				"viewURL" => $_SERVER['REQUEST_URI']
			));
			if ( $insert ){
				$last_id = $db->lastInsertId();
				return true;
			}
				
																					}
				




	function __($key, $sentence){
		

		global $db;
		$filepath = str_replace(homepath, null, debug_backtrace()[0]['file']);
		$ts_path_line = debug_backtrace()[0]['line'];
		
	
		
		// lang_code to lang_ID function
			$query = $db->prepare("SELECT * FROM `translators_lang` WHERE 
			lang_code = :lang_code ");
			$icerik_Kontrol = @$query->execute(array("lang_code" => $_COOKIE['language']));
			$lang_ID = @$query->fetchAll(\PDO::FETCH_ASSOC)[0]['lang_ID'];
		

	
			$filepath = str_replace(homepath, null, $filepath);
			$translators_select_sentence_default = translators_select_sentence($filepath, $ts_path_line, $key, 1); //default language
			$translators_select_sentence_sellect = translators_select_sentence($filepath, $ts_path_line, $key, $lang_ID); //select language


			if(@$translators_select_sentence_default['ts_key'] == $key){
				
				/*daha ??nce eklenmi??.
				Default lang_code sahibi veriler dosyadaki metinlerin yans??mas??d??r.*/
								
				
			}else{
				//ilk kez eklenecek
						
					if(languageProcessing == true){
						
						translators_insert_sentence(1, $filepath, $ts_path_line, $key, $sentence);
					
					}
				
			}
			
			
			if(@$translators_select_sentence_sellect['ts_key'] == $key){
				/*Belirtilen dil ile ilgili metin bulundu.*/
					
					return @$translators_select_sentence_sellect['ts_sentence'];
						
				
			}else{
				/*Belirtilen dil ile ilgili metin bulunamad??. Aynen metin d??nd??r??lecek.*/
								
					return $sentence;
					
				
			}
			
			
		

			
			/*
			??yle bir fonksiyon ki;
			Eklenen keyler veritaban??na d??????yor. hangi dosyada oldu??u ile birlikte
			Admin panelinden istenilen dil ekleniyor.
			E??er dil kar????l?????? yoksa sentence yazd??r??l??yor.
			
			Debug modu 1. 2. 3. ??eklinde ba??lar??na numara geliyor ve consola keyler yazd??r??l??yor
			
			debug modunu consol yerine alta sabitlenmi?? div i??ine yazd??r. Hatalar?? dizi haline getir ard??ndan foreach
			*/
			
		
	}

/*
Usage

__("key", "sentence");

*/



?>