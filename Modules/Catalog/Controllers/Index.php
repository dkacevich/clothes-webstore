<?php

namespace Modules\Catalog\Controllers;

use Modules\_base\Controller as BaseController;
use Modules\Catalog\Models\Index as Model;
use System\Database\Connection;
use System\DB;

class Index extends BaseController {

    protected DB $db;
    protected Model $model;

    public function __construct() {
        parent::__construct();
        $this->db = DB::getInstance();
        $this->model = new Model($this->db);
    }

    public function index() {
        $this->pageContent['title'] = 'Fashion';
        $this->pageContent['content'] = $this->view->render('Catalog/Views/v_catalog.twig', [
            'pages' => $this->model->getPagination($_GET['page'] ?? 1),
            'products' => $this->model->getProducts(['sort' => $_GET['sort'] ?? null]),
            'count' => $this->model->cnt,
            'categories' => $this->model->getCategories(),
            'tags' => $this->model->getTags(),
            'currentURL' => $this->model->checkURI($_SERVER['REQUEST_URI']),
            'selectedSort' => $_GET['sort'] ?? null

        ]);
        $this->pageContent['jquery'] = true;

        
    }
}
