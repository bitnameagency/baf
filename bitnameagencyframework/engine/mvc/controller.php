<?php

class Controller extends ViewEngine
{

    public function model($name)
    {
		
		$nameEnd = end(explode("/", strtolower($name)));			
        require homepath. '/bitnameagencyframework/resources/model/' . strtolower($name) . '.php';
        return new $nameEnd();
    }
	
	    public function helper($name)
    {
		
		$nameEnd = end(explode("/", strtolower($name)));			
        require homepath. '/bitnameagencyframework/resources/helper/' . strtolower($name) . '.php';
        return new $nameEnd();
    }
	
	
}