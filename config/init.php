<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("APP", ROOT . '/app');
define("CORE", ROOT . '/vendor/wfm');
define("HELPERS", ROOT . '/vendor/wfm/helpers');
define("CACHE", ROOT . '/tmp/cache');
define("LOGS", ROOT . '/tmp/logs');
define("CONFIG", ROOT . '/config');
define("LAYOUT", 'ishop');
define("BASE_URL", 'http://clothes');
define("ADMIN", 'http://new-ishop.loc/admin');
define("NO_IMAGE", 'uploads/no_image.jpg');



spl_autoload_register(function($name) {
    // echo $name. '<hr>';

    $path = str_replace("\\", '/', $name) . '.php';
    if (file_exists($path)) {
        // echo $name. '<hr>';

        include_once($path);
    }
});



require_once ROOT . '/vendor/autoload.php';
