<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*
$searchEngine = new searchEngine();
$search = $searchEngine->where("translators_sentence")->column("ts_sentence")->value("roller")->process()->result();
print_r($search);
*/


class searchEngine{
		
	public $db;
	public $where;
	public $column;
	public $value;
	public array $result;
	
		public function __construct(){
			
			global $db;
			$this->db = $db;
			
		}
		
		public function where($where){
			
			$this->where = $where;
			return $this;
			
		}
		
		public function column($column){
			
			$this->column = $column;
			return $this;
			
		}
		
		
		public function value($value){
			
			$this->value = $value;
			return $this;
			
		}
		
		
		 public function process()
		{
			//$this->NATURAL_LANGUAGE_MODE();
			//$this->soundexResult();				
			$this->likeResult();							
			return $this;
		}
		
				
		
		public function result(){ 
				
			foreach($this->result as $results){
				
				foreach($results as $result){

					$key = md5($result['ts_sentence'].''.$result['viewURL']);
					$return[$key] = $result;
					
				}				
			}
				
			return @$return;
			
			
		}
				
		public function soundexResult(){			
			
			$query = $this->db->prepare("SELECT * FROM {$this->where} WHERE SOUNDEX({$this->column}) LIKE SOUNDEX(:search)");
			$result = $query->execute(array("search" => $this->value));
			$result = $query->fetchAll(\PDO::FETCH_ASSOC);
			$this->result[] = $result;
			
				$valueExplode = explode(" ", $this->value);
				
				foreach($valueExplode as $value){		
				
				$query = $this->db->prepare("SELECT * FROM {$this->where} WHERE SOUNDEX({$this->column}) LIKE SOUNDEX(:search)");
				$result = $query->execute(array("search" => $value));
				$result = $query->fetchAll(\PDO::FETCH_ASSOC);
				$this->result[] = $result;		
	
				
				}
			
		}
		
		
		public function NATURAL_LANGUAGE_MODE(){			
			
			$query = $this->db->prepare("SELECT * FROM {$this->where} WHERE MATCH({$this->column}) AGAINST(:search)");
			$result = $query->execute(array("search" => $this->value));
			$result = $query->fetchAll(\PDO::FETCH_ASSOC);
			$this->result[] = $result;
			
				$valueExplode = explode(" ", $this->value);
				
				foreach($valueExplode as $value){		
				
					$query = $this->db->prepare("SELECT * FROM {$this->where} WHERE MATCH({$this->column}) AGAINST(:search)");
					$result = $query->execute(array("search" => $value));
					$result = $query->fetchAll(\PDO::FETCH_ASSOC);
					$this->result[] = $result;
							
				}
			
		}
		
		public function likeResult(){			
			
			$query = $this->db->prepare("SELECT * FROM {$this->where} WHERE {$this->column} like :search");
			$result = $query->execute(array("search" => $this->value));
			$result = $query->fetchAll(\PDO::FETCH_ASSOC);
			$this->result[] = $result;
			
			$valueExplode = explode(" ", $this->value);
				
				foreach($valueExplode as $value){		
				
				$querya = $this->db->prepare("SELECT * FROM {$this->where} WHERE {$this->column} like :search");
				$resulta = $querya->execute(array("search" => '%'.$this->value.'%'));
				$resulta = $querya->fetchAll(\PDO::FETCH_ASSOC);
				$this->result[] = $resulta;			
				
				$queryb = $this->db->prepare("SELECT * FROM {$this->where} WHERE {$this->column} like :search");
				$resultb = $queryb->execute(array("search" => ''.$this->value.'%'));
				$resultb = $queryb->fetchAll(\PDO::FETCH_ASSOC);
				$this->result[] = $resultb;			
				
				$queryc = $this->db->prepare("SELECT * FROM {$this->where} WHERE {$this->column} like :search");
				$resultc = $queryc->execute(array("search" => '%'.$this->value.''));
				$resultc = $queryc->fetchAll(\PDO::FETCH_ASSOC);
				$this->result[] = $resultc;		
				
				$queryd = $this->db->prepare("SELECT * FROM {$this->where} WHERE {$this->column} like :search");
				$resultd = $queryd->execute(array("search" => $this->value));
				$resultd = $queryd->fetchAll(\PDO::FETCH_ASSOC);
				$this->result[] = $resultd;			
				
				}
			
		}
	
}