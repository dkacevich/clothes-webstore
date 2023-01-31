<?php

namespace Modules\Auth;

use AltoRouter;
use Modules\Auth\Controllers\Index as C;
use System\Contracts\IModule;

class Module implements IModule{
	public function registerRoutes(AltoRouter $router) : void {

        $router->addRoutes([
            ['GET', '/login',  C::class . "#loginPage"],
            ['GET', '/register',  C::class . "#registerPage"],
            ['GET', '/logout',  C::class . "#logout"],
            ['POST', '/login',  C::class . "#login"],
            ['POST', '/register',  C::class . "#register"],
            // ['POST', '/product/add',  C::class . "#add"],
        ]);
    
	}
}