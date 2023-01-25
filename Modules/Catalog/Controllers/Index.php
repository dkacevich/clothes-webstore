<?php

namespace Modules\Catalog\Controllers;

use Modules\_base\Controller as BaseController;
use Modules\Catalog\Models\Index as Model;
use System\Database\Connection;

class Index extends BaseController {

    protected Connection $db;
    protected Model $model;

    public function __construct() {
        parent::__construct();
        $this->db = Connection::getInstance();
        $this->model = new Model($this->db);
    }

    public function index() {
        $this->pageContent['title'] = 'Fashion';
        $this->pageContent['content'] = $this->view->render('Catalog/Views/v_catalog.twig', [
            'products' => $this->model->getProducts()
        ]);
        $this->pageContent['jquery'] = true;
        echo "<pre>";
        print_r($this->model->getProducts());
        echo "</pre>";
    }
}
