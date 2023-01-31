<?php

namespace Modules\Cart;

use AltoRouter;
use Modules\Cart\Controllers\Index as C;
use System\Contracts\IModule;

class Module implements IModule{
	public function registerRoutes(AltoRouter $router) : void {


        $router->addRoutes([
            ['GET', '/cart',  C::class . "#index"],
            ['POST', '/cart/add',  C::class . "#add"],
            ['POST', '/cart/remove',  C::class . "#remove"],
            ['POST', '/cart/checkout',  C::class . "#checkout"],
        ]);
    
	}
}