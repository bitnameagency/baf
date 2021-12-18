<?php
if (!defined('ABSPATH')){ exit; }

ob_start("ob_gzhandler");
ini_set('session.gc_maxlifetime', 31536000); //365 day
session_set_cookie_params(31536000); //365 day
ignore_user_abort(true);
set_time_limit(0);

	if(file_exists("bitnameagencyframework/config/config.php") == false){
				
		header("Location: ../install.php");					
		exit();
				
	}


//Config

require_once ("bitnameagencyframework/config/config.php");



try
{
    $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
}
catch(PDOException $e)
{
    print $e->getMessage();
}

require_once ("bitnameagencyframework/functions/systemOptions.php");
require_once ("bitnameagencyframework/config/define.php");


class taskStarter{
	
	
	public static function Run()
	{
			  
		
		   self::funcStart();		   		   
		   self::workstationSystem();
		   self::Error404Check();   	   
			 		   
	   
	   
		if(cronJob == true){
			$cronJob = hookSystem::do_action("cronJob");
		}
	   
	   
	   	if(developerMode == true){
					
			removeFiles("bitnameagencyframework/resources/viewsRender");
			removeFiles("bitnameagencyframework/resources/htmlCache");
					
		}
		
		$language = new translators;
		$language = $language->selectLanguage();		
	   
	}

	//Functions Get
	//Ana fonksiyonların bulunduğu bölüm
	public static function funcStart(){
		
		 $functions_list = glob('bitnameagencyframework/functions/*.php', GLOB_BRACE);
		foreach ($functions_list as $functions)
		{
			require_once ($functions);
		}
		
	}



	//workstationSystem
	public static function workstationSystem()
	{

		$files = array(
			"engine",
			"pages",
			"plugins"
		);

		foreach ($files as $filename)
		{

			$workstationSystem_list = rglob('bitnameagencyframework/' . $filename . '/*.php', GLOB_BRACE);

			foreach ($workstationSystem_list as $wss)
			{

				workstationSystemPUT(null, null, $filename, $wss, 10);
				$workstationSystem[workstationSystemGET($wss) ['ws_Path']] = workstationSystemGET($wss) ['ws_Priority'];

			}

			arsort($workstationSystem);

			foreach ($workstationSystem as $path => $ws_Priority)
			{

				$status = workstationSystemGET($path) ['status'];

				if ($filename !== "engine")
				{

					if ($status == 1)
					{
						$workstationSystem_List[$path] = $ws_Priority;
					}

				}
				else
				{

					$workstationSystem_List[$path] = $ws_Priority;

				}

			}

		}

		arsort($workstationSystem_List);
		foreach ($workstationSystem_List as $path => $ws_Priority)
		{

			require_once ($path);

		}

	}



	public static function Error404Check(){
		
	$RouteSaver = Route::RouteSaver();
	$ParseUrl = Route::parse_url();

	$Error404Status = 1;
	foreach ($RouteSaver['slug'] as $slug)
	{

		if (preg_match('@^' . $slug . '$@', $ParseUrl, $parameters))
		{

			$Error404Status = 0;

		}

	}

	if ($Error404Status === 1)
	{
		
		hookSystem::add_action("index", "Error404");
		header('HTTP/1.0 404 Not Found', true, 404);

	}

		
		
	}
	
	
	public static function theEnd(){
		
		global $latestOutput;			
		$latestOutput .= '';
		
				
		if(HTMLMinify == true){	
		
			$latestOutput = minifier::Go($latestOutput);
			$htmlCache = new htmlCache;
			$latestOutput = $htmlCache->htmlOutput($latestOutput)->Render(); 
			echo $latestOutput;
			
		}else{
			
			$htmlCache = new htmlCache;
			$htmlCache = $htmlCache->htmlOutput($latestOutput)->Render(); 
			echo $htmlCache;
			
		}
		
		$logSystem = new logSystem;
		$logDump = $logSystem->Run()->triggerDump();
	
				
		
	}
	

}