<?php
if (!defined('ABSPATH'))
{
    exit; // Exit if accessed directly.
    
}


Class logSystem{
	
	public $status;
	
		public function __construct(){
			
			$this->status = logSystem;
			
		}
		

		public function Run(){
			global $db;
			
		
		
			if($this->status == true and immunity() !== true){
				
				$dateTime = time();
				$userKey = secureSessionGet("userKey");
				$IP = @GetIP();
				$browserID = @browserID();
				$userAgent = @$_SERVER['HTTP_USER_AGENT'];
				$RequestMethod = @$_SERVER['REQUEST_METHOD'];
				$responseCode = @http_response_code();
				$URL = @$_SERVER['REQUEST_URI'];
				$Ref = @$_SERVER['HTTP_REFERER'];
				
				foreach($_GET as $getK => $getD){
					
					$GetDataS[] = $getK.' => '.$getD;
					
				}
				if(!empty($GetDataS)){
				@$GetData = @implode(" | ", $GetDataS);
				}
				
				foreach($_POST as $postK => $postD){
					
					$PostDataS[$postK] = $postK.' => '.$postD;
					
				}
				if(isset($PostDataS['token'])){unset($PostDataS['token']);}
				if(isset($PostDataS['captcha'])){unset($PostDataS['captcha']);}
				if(!empty($PostDataS)){
						@$PostData = @implode(" | ", $PostDataS);
				}
			
			
				
					$query = $db->prepare("INSERT INTO `Log` SET 
					dateTime = :dateTime,
					userKey = :userKey,
					IP = :IP,
					browserID = :browserID,
					userAgent = :userAgent,
					RequestMethod = :RequestMethod,
					responseCode = :responseCode,
					URL = :URL,
					Ref = :Ref,
					GetData = :GetData,
					PostData = :PostData					
					");
					$insert = $query->execute([
					"dateTime" => $dateTime,
					"userKey" => $userKey,
					"IP" => $IP,
					"browserID" => $browserID,
					"userAgent" => $userAgent,
					"RequestMethod" => $RequestMethod,
					"responseCode" => $responseCode,
					"URL" => $URL,
					"Ref" => $Ref,
					"GetData" => @$GetData,
					"PostData" => @$PostData
					]);
					
					
				
			
			}
			return $this;
			
		}
		
		public function Dump(){
			global $db;

			$fileKey = md5(SECURE_KEY.''.rand(11111,99999).''.time());
			$filePath = '/bitnameagencyframework/src/logDisk/'.$fileKey;
			
			$query = $db->prepare("SELECT * FROM `Log`");
			$Logs = @$query->execute();
			$Logs = @$query->fetchAll(\PDO::FETCH_ASSOC);

				$txtData = 'logID | dateTime | userKey | IP | browserID | userAgent | RequestMethod | responseCode | URL | REF | GetData | PostData
';
				foreach($Logs as $logKeys => $logDatas){
					
					$logDatas['dateTime'] = date('Y-m-d H:i:s', $logDatas['dateTime']);
					
					$txtData .= implode(" | ", $logDatas).'
';
					
				}
				
					file_put_contents(homepath.''.$filePath, $txtData);
				
					$query = $db->prepare("INSERT INTO `logList` SET 
					path = :path,
					dateTime = :dateTime					
					");
					$insert = $query->execute([
					"path" => $filePath,
					"dateTime" => time()
					]);
					
					
					$query = $db->prepare("DELETE FROM `Log`");
					$delete = $query->execute();
				
				
		}
		
		
		
		
		public function triggerDump(){
			global $db;
			
			$query = $db->prepare("SELECT * FROM `Log` ORDER BY logID DESC LIMIT 1;");
			$lastLog = @$query->execute();
			$lastLog = @$query->fetchAll(\PDO::FETCH_ASSOC)[0];
			if($lastLog){
				
				if(strtotime(date('Y-m-d', $lastLog['dateTime'])) < strtotime(date('Y-m-d', time()))){
				
				self::Dump();
				
				}
			
				
			}
			
			return true;
		}
		
		
		public function logList(){
			global $db;
			
			$query = $db->prepare("SELECT * FROM `logList` ORDER BY `logList`.`logListID` DESC");
			$logsList = @$query->execute();
			$logsList = @$query->fetchAll(\PDO::FETCH_ASSOC);
			
			foreach($logsList as $logList){
				
				 $returnList[] = ["dateTime" => $logList['dateTime'], "downloadURL" => serverName.'/src/logDisk/'.$logList['dateTime'].'.txt'];
				
			}
			
			return @$returnList;
			
		}
	
}

global $db;
Route::run("/src/logDisk/{url}.txt", function($hash) use ($db){
	global $db;
	$User = new User;
	$User->permCheck("baf@logDownloader");	//yetki sorgula
	
	hooksystem::add_action("index", function() use ($db, $hash){
		global $db;
			
		if(isset($hash)){
			
			$query = $db->prepare("SELECT * FROM `logList` WHERE dateTime = :dateTime");
			$logData = @$query->execute([
			"dateTime" => $hash
			]);
			$logDatapath = @$query->fetchAll(\PDO::FETCH_ASSOC)[0]['path'];
			
			//echo txtread($logDatapath);			
			
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($hash.'.txt'));
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			readfile(homepath.''.$logDatapath);
			
		}

		
	});	
	
});