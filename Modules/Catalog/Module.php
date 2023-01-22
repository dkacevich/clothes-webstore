<?php

namespace Modules\Catalog;

use AltoRouter;
use Modules\Catalog\Controllers\Index as C;
use System\Contracts\IModule;

class Module implements IModule{
	public function registerRoutes(AltoRouter $router) : void {

        $router->addRoutes([
            ['GET', '/',  C::class . "#index"],
            ['GET', '/catalog',  C::class . "#index"],
            ['GET', '/catalog/new',  C::class . "#index"],
            ['GET', '/catalog/sale',  C::class . "#index"],
        ]);
    
	}
}