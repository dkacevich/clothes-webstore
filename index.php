<?php

include_once('init.php');
include_once('vendor/autoload.php');

use System\ModulesDispatcher;
use System\Template;

use Modules\Catalog\Module as Catalog;
use Modules\Delivery\Module as Delivery;
use Modules\Add\Module as ProductAdd;

use System\Database\Connection;
use System\Exceptions\Exc404;
use System\Exceptions\Exc500;

const BASE_URL = 'http://clothes.dvl.to'; // http://clothes.dvl.to | http://clothes
const DB_HOST = 'mysql'; // mysql | localhost
const DB_NAME = 'clothes';
const DB_USER = 'root';
const DB_PASS = '';


// $db = Connection::getInstance();

// ac name => dkatsevich4storage
// email => d.katsevich.4@gmail.com
// ID => 115884505569
// CanonicalID => fde8aab872ab5b10106905231447594304089e2d22494066ed302f7018b2db0a

// Access key => AKIARV62BHHQ4CNZMZSN
// Secret Access key => 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

$view = Template::getInstance();

try {
    // Import all Modules
    $router = new AltoRouter();

    $modules = new ModulesDispatcher();
    $modules->add(new Catalog());
    $modules->add(new Delivery());
    $modules->add(new ProductAdd());
    $modules->registerRoutes($router);

    $match = $router->match();

    // Check if URL is match some route
    if (!empty($match)) {
        list($controller, $action) = explode('#', $match['target']);

        if (method_exists($controller, $action)) {
            $obj = new $controller();

            // Check if POST or GET route
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Give data response
                call_user_func_array([$obj, $action], [$_POST]);
            } else {
                // Render HTML Template
                call_user_func_array([$obj, $action], [$match['params']]);
                $htmlMarckup = $obj->render();
                echo $htmlMarckup;
            }
        } else {
            // If there is no object method
            throw new Exc500('Error 500, don\'t worry we already working');
        }
    } else {
        // If URL is wrong
        throw new Exc404('404 Page not found');
    }

} catch (Exc404 $e) {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo $view->render('_base/Views/v_main.twig', [
        'title' => '404 Error',
        'content' => "<h2 class='error'>{$e->getMessage()}</h2>"
    ]);
} catch (Exc500 $e) {
    header($_SERVER["SERVER_PROTOCOL"] . ' 500 System error');
    echo $view->render('_base/Views/v_main.twig', [
        'title' => '500 Error',
        'content' => "<h2 class='error'>{$e->getMessage()}</h2>"
    ]);
}
