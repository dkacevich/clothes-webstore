<?php

use System\Database\Connection;
use System\Database\SelectBuilder;

const BASE_URL = 'http://clothes.dvl.to';
const DB_HOST = 'mysql';
const DB_NAME = 'clothes';
const DB_USER = 'root';
const DB_PASS = '';

include_once('../vendor/autoload.php');

spl_autoload_register(function ($name) {

    $path = '../' . str_replace('\\', '/', $name) . '.php';

    if (file_exists($path)) {
        var_dump($path);
        echo '<hr>';
        include_once($path);
    }
});



$db = Connection::getInstance();

$builder = new SelectBuilder('products');


echo $builder->where('id_message = :id')->order_by('something ASC');

// INSERT INTO TABLE (col1, col2) VALUES (val1, val2)

