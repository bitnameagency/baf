<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if(maintenanceMode == true and immunity() !== true){
	hookSystem::add_action("index", function (){
		
		
	$ViewEngine = new ViewEngine();

    return $ViewEngine->view('maintenancemode', [
        'title' => 'Maintenance Mode'
    ]);


	
	});
}