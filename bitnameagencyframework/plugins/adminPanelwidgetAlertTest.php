<?php
if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}
	
	


	hookSystem::add_action("boardWidgetAlert", function($data){
		
		$ViewEngine = new ViewEngine();
		
		return $data.''.$ViewEngine->view("static/bootstrap/alert", [
		"class" => "primary",
		"text" => "Widget Alert Hook Location: bitnameagencyframework/plugins/adminPanelwidgetAlertTest.php"
		]);
						
		
	}); 
	






	hookSystem::add_action("boardWidget", function($data){
		
		$ViewEngine = new ViewEngine();
		
		return $data.''.$ViewEngine->view("static/bootstrap/card", [
		"class" => "success",
		"header" => "Başarılı",
		"title" => "Kurulum Tamamlandı",
		"text" => "Widget Hook Location: bitnameagencyframework/plugins/adminPanelwidgetAlertTest.php"
		]);
						
		
	}); 
	



