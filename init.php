<?php


spl_autoload_register(function($name) {
    // echo $name. '<hr>';

    $path = str_replace("\\", '/', $name) . '.php';
    if (file_exists($path)) {
        // echo $name. '<hr>';

        include_once($path);
    }
});