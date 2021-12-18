<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


Route::run('/', function () {
    
	

	
	
		hookSystem::add_action("index", 	function (){
		
		
	$ViewEngine = new ViewEngine();

    return $ViewEngine->view('main', [        
        'title' => "Main Page",
		'post' => $_POST
    ]);


	
	}	);
	
	
	
}, "get|post");

