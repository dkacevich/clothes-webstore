<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("CONFIG", ROOT . '/config');
define("SYSTEM", ROOT . '/System');
define("BASE_URL", 'http://clothes'); // dvl.to



spl_autoload_register(function($name) {
    // echo $name. '<hr>';

    $path = str_replace("\\", '/', $name) . '.php';
    if (file_exists($path)) {
        // echo $name. '<hr>';

        include_once($path);
    }
});



require_once ROOT . '/vendor/autoload.php';
