<?php

class Route 
{
	
	public static function RouteSaver($url = null){ //404 yakalamak için
		
		static $slug;
		static $filepath; 
		static $line; 
		static $return; 
		
		if($url !== null){
			
			$slug[] = $url;
			$filepath[] = str_replace(homepath, null, debug_backtrace()[1]['file']);
			$line[] = debug_backtrace()[1]['line'];
			
		}	
		
		$return = ["slug" => $slug, "filepath" => $filepath, "line" => $line];
		return $return;		
		
	}

    public static function parse_url()
    {
		
        $dirname = dirname($_SERVER['SCRIPT_NAME']);
        $dirname = $dirname != '/' ? $dirname : null;
        $basename = basename($_SERVER['SCRIPT_NAME']);
        $request_uri = str_replace([$dirname, $basename], null, $_SERVER['REQUEST_URI']);
       // return $request_uri;
        return @parse_url($request_uri)['path'];	
		
	}
	


    public static function run($url, $callback, $method = 'get')
    {				
	
			
        $method = explode('|', strtoupper($method));

        if (in_array($_SERVER['REQUEST_METHOD'], $method)) {

            $patterns = [
                '{url}' => '([0-9a-zA-Z]+)',
                '{id}' => '([0-9]+)'
            ];

            $url = str_replace(array_keys($patterns), array_values($patterns), $url);
			self::RouteSaver($url); //route kayıt

            $request_uri = self::parse_url();				
            if (preg_match('@^' . $url . '$@', $request_uri, $parameters)) {
                unset($parameters[0]);

                if (is_callable($callback)) {

					if(class_exists('FormTokenSecure')){
						 $FormTokenSecure = new FormTokenSecure();
						 $FormTokenSecure::Run();
					 }
							
                    call_user_func_array($callback, $parameters);
                } else {
					
					if(class_exists('FormTokenSecure')){
						 $FormTokenSecure = new FormTokenSecure();
						 $FormTokenSecure::Run();
					 }

                    $controller = explode('@', $callback);
                    $className = explode('/', $controller[0]);
                    $className = end($className);
                    $controllerFile = homepath . '/bitnameagencyframework/resources/controller/' . strtolower($controller[0]) . '.php';

                    if (file_exists($controllerFile)) {						
                        require $controllerFile;												
                       call_user_func_array([new $className, $controller[1]], $parameters);
                    }
                    
                }
			
					
            }
			
			
			

        }

    }
	
	
	
	public static function endURL(){
		
		return end(explode("/", self::parse_url()));
		
	}

}

/*
$pageSelector = array_values(array_filter(explode("/", $_SERVER['REQUEST_URI']))); 
$pageSelector[0] = @parse_url($pageSelector[0])['path'];
	
				print_r($pageSelector[1]);	*/
				
				
		
			
	
			
			