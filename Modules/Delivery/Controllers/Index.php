<?php

namespace Modules\Delivery\Controllers;

use Modules\_base\Controller as BaseController;

class Index extends BaseController {
    public function index() {
        $this->pageContent['title'] = 'Доставка';
        $this->pageContent['content'] = $this->view->render('Delivery/Views/v_delivery.twig');
    }
}
