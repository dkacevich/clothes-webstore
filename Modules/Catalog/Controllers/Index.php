<?php

namespace Modules\Catalog\Controllers;

use Modules\_base\Controller as BaseController;

class Index extends BaseController {
    public function index() {
        $this->pageContent['title'] = 'Fashion';
        $this->pageContent['content'] = $this->view->render('Catalog/Views/v_catalog.twig');
        $this->pageContent['jquery'] = true;
    }
}
