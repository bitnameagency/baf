<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class htmlCache
{
	public $htmlOutput;
	public $hiddingTime;
	public $browserid;	
	public $url;
	public $uniqueID;
	public $cacheFile;
	
	
		function __construct() {	
		
			$this->browserid = browserid();
			$this->url = serverName.$_SERVER['REQUEST_URI'];
			$this->uniqueID = md5($this->browserid.''.$this->url);
			$this->cacheFile = homepath.'/bitnameagencyframework/resources/htmlCache/'.$this->uniqueID.'.cache';
			$this->hiddingTime = htmlCacheTime;
			
		}
		
		function htmlOutput($htmlOutput){
			
			$this->htmlOutput = $htmlOutput;
			return $this;
			
		}
		
		
	
	
		public function Render(){			


			
			@define("htmlCache", true);			
			if($this->hiddingTime <= 0 or immunity() == true){
				
				
				return $this->htmlOutput;
				
			}else{
				
				
				if (file_exists($this->cacheFile) && time() - $this->hiddingTime < filemtime($this->cacheFile))
				{		
					
					return file_get_contents($this->cacheFile);
					
					
				}else{
					
					file_put_contents($this->cacheFile, $this->htmlOutput);				
					return $this->htmlOutput;
					
				}
				
			}
			
			
		}
	
}





hookSystem::add_action("cronJob", function(){
	
	$path = homepath.'/bitnameagencyframework/resources/htmlCache/';
	$fileList = rglob($path.'/*.cache', GLOB_BRACE);	

	foreach($fileList as $File){
		
		if(time() - htmlCacheTime < filemtime($File)){
			
			removeFiles($File);
			
		}
		
	}	
	
	
});
