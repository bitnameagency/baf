<?php

class Database
{

    static protected $db;
	

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS);
        } catch (PDOException $e) {
            echo $e->getMessage();
        } 
				
    }
	
	

}