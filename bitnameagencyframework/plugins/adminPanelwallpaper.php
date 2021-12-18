<?php
if (!defined('ABSPATH'))
{
    exit; // Exit if accessed directly.
    
}

function randomImage(){
	
	return curl_("https://source.unsplash.com/random/100x100");
	
}


hookSystem::add_action("boardfooter", function($data){
	
	
	$style = "
	<style>
	
		.hk-pg-wrapper { 
	  background: url(".randomImage().") no-repeat center center fixed;
	  -webkit-background-size: cover;
	  -moz-background-size: cover;
	  -o-background-size: cover;
	  background-size: cover;
	}
		
	</style>	
	";
	
	
	return $data.''.$style;
	
});