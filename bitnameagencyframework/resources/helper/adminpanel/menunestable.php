<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class menunestable extends Helper {
	
	public $id;
	public $getList;
	
	public function construct($id, $getList){
		
		$this->id = $id;
		$this->getList = $getList;
		return $this;
	}
	
	
	
	public function item($getList){		
	
		if($getList){
		
			$html = '';
			$ViewEngine = new ViewEngine();
				
			foreach(@$getList as $item){
				
				//print_r($item);
				
				
				if($item['children']){
					
					$html .= '
					<li class="dd-item dd3-item" data-id="'.$item['children']['ID'].'">
					<div class="dd-handle dd3-handle"></div>
					<div class="dd3-content"> '.$item['children']['itemText'].'
					<div class="pb-10"></div>
					'.$ViewEngine->view("adminpanel/menusystem/nestablecollapse", [
					"ID" => $item['children']['ID'],
					"collapseID" => 'collapse_'.$item['children']['ID'],
					"itemLink" => $item['children']['itemLink'],
					"itemKey" => $item['children']['itemKey'],
					"itemTarget" => $item['children']['itemTarget'],
					"edit_item_button" => __("edit-item-button", "Düzenle"),
					"delete_item_button" => __("delete-item-button", "Kaldır"),
					"collepseNote" => __("collepseNote", "Not: Görünen adı değiştirmek için dil sayfasında ilgili bölümü değiştiriniz."),
					"Collapse_itemKey" => __("Collapse_itemKey", "itemKey"),
					"Collapse_itemLink" => __("Collapse_itemLink", "itemLink"),
					"childrenEditbutton" => __("childrenEditbutton", "Kaydet")
					]).'
			
					</div>';
					
						if($item['children']['children']){
							$html .= '<ol class="dd-list">';
							$html .= self::item($item['children']['children']);
							$html .= ' </ol>';
						}				
						
					
					$html .= '</li>';		
					
				}
				
			}
			
			
			return $html;
		}	
		
	}


	

	
	
	public function Render(){
		$html = '<div class="dd" id="'.$this->id.'">';
		$html .= '<ol class="dd-list">';
		
		$html .= self::item($this->getList);
		
		$html .= ' </ol>';
		$html .= ' </div>';
		
		return $html;;
	}
	
	
	
	public static function backRender($menuDesign, $subID = 0){
		
				
		foreach($menuDesign as $item){$childrens[]['children'] = $item;}
						
			static $orderInt = 0;
			static $_return = [];
			
			
			foreach($childrens as $children){
				
				if($children['children']){
						
					$orderInt++;
					$_return[] = ["ID" => $children['children']['id'], "subID" => $subID, "orderInt" => $orderInt];
					
					if(@$children['children']['children']){
						
												
						self::backRender($children['children']['children'], $children['children']['id']);
						
					}
					
				}
				
				
			}
			
			return $_return;
		
	}
	
	
	
	
	
}