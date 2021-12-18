<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



Route::run('/adminPanel/{url}', 'adminPanel/adminPanel@index', "get|post");
Route::run('/adminPanel/users/datatablelang.json', 'adminPanel/adminPanel@datatablelang', "get|post");

