<?php

namespace Modules\Main;

use AltoRouter;
use Modules\Main\Controller as C;
use System\Contracts\IModule;

class Module implements IModule{
	public function registerRoutes(AltoRouter $router) : void {

        $router->addRoutes([
            ['GET', '/',  C::class . "#index"],
        ]);
    
	}
}