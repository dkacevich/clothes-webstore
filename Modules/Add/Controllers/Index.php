<?php

namespace Modules\Add\Controllers;

use Modules\_base\Controller as BaseController;

class Index extends BaseController {
    public function index() {
        $this->pageContent['title'] = 'Добавить товар';
        $this->pageContent['content'] = $this->view->render('Add/Views/v_add.twig');
    }

    public function add($params) {
        echo json_encode([$_FILES['product-photo'], ['errors' => []]]);
    }
}
