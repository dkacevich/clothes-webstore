<?php

use System\Template;

include_once('init.php');
include_once('vendor/autoload.php');

const BASE_URL = 'http://clothes/';


$html = Template::getInstance()->render('_base/Views/v_main.twig', [
    'content' => 'worked'
]);
