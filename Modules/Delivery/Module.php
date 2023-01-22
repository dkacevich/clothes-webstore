<?php

namespace Modules\Delivery;

use AltoRouter;
use Modules\Delivery\Controllers\Index as C;
use System\Contracts\IModule;

class Module implements IModule{
	public function registerRoutes(AltoRouter $router) : void {

        $router->addRoutes([
            ['GET', '/delivery',  C::class . "#index"],
        ]);
    
	}
}