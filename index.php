<?php

include_once('init.php');
include_once('vendor/autoload.php');

use System\ModulesDispatcher;
use System\Template;

use Modules\Catalog\Module as Catalog;

use System\Exceptions\Exc404;
use System\Exceptions\Exc500;

define('BASE_URL','http://clothes');


try {


    $router = new AltoRouter();

    $modules = new ModulesDispatcher();
    $modules->add(new Catalog());
    $modules->registerRoutes($router);

    $match = $router->match();

    
      

    if (!empty($match)) {

        list($controller, $action) = explode('#', $match['target']);

        if (method_exists($controller, $action)) {
            $obj = new $controller();
            call_user_func_array([$obj, $action], [$match['params']]);
            $htmlMarckup = $obj->render();
            echo $htmlMarckup;
        } else {
            throw new Exc500('Error 500, don\'t worry we already working');

        }
    } else {
        throw new Exc404('404 Page not found');
    }


} catch (Exc404 $e) {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo Template::getInstance()->render('_base/Views/v_main.twig', [
        'title' => '404 Error',
        'content' => "<h2 class='error'>{$e->getMessage()}</h2>"
    ]);
} catch (Exc500 $e) {
    header($_SERVER["SERVER_PROTOCOL"] . ' 500 System error');
    echo Template::getInstance()->render('_base/Views/v_main.twig', [
        'title' => '500 Error',
        'content' => "<h2 class='error'>{$e->getMessage()}</h2>"
    ]);
}
