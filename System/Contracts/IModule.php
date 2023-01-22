<?php

namespace System\Contracts;

use AltoRouter;

interface IModule{
	public function registerRoutes(AltoRouter $router) : void;
}