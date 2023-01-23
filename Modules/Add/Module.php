<?php

namespace Modules\Add;

use AltoRouter;
use Modules\Add\Controllers\Index as C;
use System\Contracts\IModule;

class Module implements IModule{
	public function registerRoutes(AltoRouter $router) : void {

        $router->addRoutes([
            ['GET', '/product/add',  C::class . "#index"],
            ['POST', '/product/add',  C::class . "#add"],
        ]);
    
	}
}