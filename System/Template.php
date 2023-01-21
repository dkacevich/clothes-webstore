<?php

namespace System;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Template {

    protected Environment $twig;
    public static $instance;

    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }


    protected function __construct() {
        $loader = new FilesystemLoader('Modules');
        $this->twig = new Environment($loader, [
            'cache' => 'cache/twig',
            'auto_reload' => true
        ]);
    }


    public function render(string $pathToTemplate, array $vars = []) {
        echo $this->twig->render($pathToTemplate, $vars);
    }
}
