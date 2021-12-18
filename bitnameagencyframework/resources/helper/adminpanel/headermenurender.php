<?php
if (!defined('ABSPATH'))
{
    exit; // Exit if accessed directly.
    
}

class headermenurender extends Helper {

	public $groupKey;
	public $childrenList;
	
	public function groupKey($groupKey){
		
		$menu = new menu;
		$this->childrenList = $menu->groupKey()->select($groupKey);  
		return $this;
		
	}
	
	
	
	public function item(){
		
	if($this->childrenList){
		
		$activeUrl = parse_url($_SERVER['REQUEST_URI'])['path'];
		
		$html = '';
		
		foreach($this->childrenList as $children){
			
			$html .= '<li class="nav-item dropdown show-on-hover">';			

			
				if($children['children']){					
					
					if($children['children']['children']){
						
						// 2 children
						
						$html .= ' <a class="nav-link dropdown-toggle" target="'.$children['children']['itemTarget'].'" href="'.$children['children']['itemLink'].'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
						
						$html .= $children['children']['itemText'];			
						
						$html .= '</a>';
						
						$html .= '<div class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">';
						
						$html .= '<div class="sub-dropdown-menu show-on-hover">';
						
							foreach($children['children']['children'] as $children2){
								
								
								if($children2['children']['children']){
									// 3 children
									
									$html .= '<a href="#" class="dropdown-toggle dropdown-item">';
									
									$html .= $children2['children']['itemText'];	
									
									$html .= '</a>';
									
									$html .= '<div class="dropdown-menu open-right-side">';
									
									foreach($children2['children']['children'] as $children3){
										
										// 3 children
										if($activeUrl == $children3['children']['itemLink']){ $activeClass = "active"; }else{ $activeClass = ""; }

										
										$html .= '<a class="dropdown-item '.$activeClass.'" target="'.$children3['children']['itemTarget'].'" href="'.$children3['children']['itemLink'].'">';
										
										$html .= $children3['children']['itemText'];	
										
										$html .= '</a>';
										
									}
									
									$html .= '</div>';
									
								}else{
									// 2 children
									if($activeUrl == $children2['children']['itemLink']){ $activeClass = "active"; }else{ $activeClass = ""; }

									
									$html .= '<a target="'.$children2['children']['itemTarget'].'" href="'.$children2['children']['itemLink'].'" class="dropdown-item '.@$activeClass.'">';
									
									$html .= $children2['children']['itemText'];	
									
									$html .= '</a>';
									
									
								}				
								
								
							}
							
						$html .= '</div>';
						
						$html .= '</div>';
						
					}else{
						
						// 1 children
						if($activeUrl == $children['children']['itemLink']){ $activeClass = "active"; }else{ $activeClass = ""; }

						
						$html .= '<a class="nav-link '.@$activeClass.'" target="'.$children['children']['itemTarget'].'" href="'.$children['children']['itemLink'].'">';
						
						$html .= $children['children']['itemText'];			
						
						$html .= '</a>';	
					
					}
					
					
				}	

			$html .= '</li>';
			
		}
	}
		
		
		
			if(@$html){
				
				return $html;
			
			}else{
				
				return false;
				
			}
			
			
		
		
	}
	
	

	public function Render(){
		
		$html = '<ul class="navbar-nav">';
		
		$html .= self::item();
		
		$html .= '</ul>';	
		
		return $html;
		
	}




}



