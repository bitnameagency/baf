<?php
if (!defined('ABSPATH')){ exit; }


$allSystemOptions = allSystemOptions();
foreach($allSystemOptions as $Option){
	
	define($Option['optionKey'], OptionFix($Option['optionData']));
	
}


