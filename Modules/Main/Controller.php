<?php


namespace Modules\Main;

use Modules\_base\Controller as BaseController;

class Controller extends BaseController {

    public function index() {
        $this->pageContent['content'] = $this->view->render('Main/View.twig');
    }
    
}