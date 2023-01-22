<?php

namespace System;

use AltoRouter;
use System\Contracts\IModule;	

class ModulesDispatcher{
	protected array $modules = [];

	public function add(IModule $module) : void{
		$this->modules[] = $module;
	}

	public function registerRoutes(AltoRouter $router) : void{
		foreach($this->modules as $module){
			$module->registerRoutes($router);
		}
	}
}