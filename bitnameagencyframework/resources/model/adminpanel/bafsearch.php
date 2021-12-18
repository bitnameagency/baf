<?php

class bafsearch extends Model {

    public function value($value)
    {
		$searchEngine = new searchEngine();
		@$searchs = $searchEngine->where("translators_sentence")->column("ts_sentence")->value($value)->process()->result();
		
		if(isset($searchs)){
			
			foreach($searchs as $search){
			
				if($search['viewURL'] and $search['ts_path'] == "/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php"){
					
					$result[] = $search;
					
				}				
				
			}
			
		}
	
		
		return  @$result;
		
    }

}