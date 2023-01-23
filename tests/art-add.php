<?php

const BASE_URL = 'http://clothes';
const DB_HOST = 'localhost';
const DB_NAME = 'clothes';
const DB_USER = 'root';
const DB_PASS = '';

include_once('../vendor/autoload.php');

spl_autoload_register(function($name){

	$path = '../' . str_replace('\\', '/', $name) . '.php';
    
	if(file_exists($path)){
        var_dump($path);
        echo '<hr>';
		include_once($path);
	}
});



use Modules\Add\Controllers\Index;

$c = new Index();
$c->add();


// Test attempt
