<?php

namespace Modules\Catalog;

use AltoRouter;
use Modules\Catalog\Controllers\Index as C;
use System\Contracts\IModule;

class Module implements IModule{
	public function registerRoutes(AltoRouter $router) : void {

        $router->addRoutes([
            ['GET', '/catalog',  C::class . "#index"],
            ['POST', '/catalog',  C::class . "#index"],
        ]);
    
	}
}