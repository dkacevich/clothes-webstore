<?php

namespace Modules\Catalog\Controllers;

use Modules\_base\Controller as BaseController;
use Modules\Catalog\Models\Index as Model;
use System\ArrayHelper;
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
            'products' => $this->model->getProducts(),
            'pages' => range(1, ceil($this->model->cnt / Model::LIMIT), 1),
            // 'current' => $_GET['page'],
            'baseUrl' => BASE_URL . '/catalog',
            'count' => $this->model->cnt,
            'categories' => $this->model->getCategories(),
            'tags' => $this->model->getTags()
        ]);
        $this->pageContent['jquery'] = true;


        echo "<pre>";
        var_dump($_GET);
        echo "</pre>";
    }
}
