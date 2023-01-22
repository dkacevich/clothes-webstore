<?php

namespace Modules\_base;

use System\Template;

class Controller {
    protected Template $view;
    protected array $pageContent;

    public function __construct() {
        $this->view = Template::getInstance();
        $this->pageContent  = [
            'title' => 'Fashion',
            'content' => '',
            'jquery' => false,
            'currentUrl' => BASE_URL . $_SERVER['REQUEST_URI']
        ];
        // $this->pageContent['currentUrl'] = BASE_URL . $_SERVER['REQUEST_URI'];
    }


    public function render() {
        return $this->view->render('_base/Views/v_main.twig', $this->pageContent);
    }
}
