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

        echo "<pre>";
        print_r($_GET);
        echo "</pre>";

        $this->pageContent['title'] = 'Fashion';
        $this->pageContent['content'] = $this->view->render('Catalog/Views/v_catalog.twig', [
            'products' => $this->model->getProducts($_GET),
            'pages' => $this->model->paginationLinks,
            'count' => $this->model->cnt,
            'categories' => $this->model->getCategories(),
            'tags' => $this->model->getTags(),
            'currentURL' => $this->model->checkURI($_SERVER['REQUEST_URI']),
            'selectedSort' => $_GET['sort'] ?? null,
            'selectedCategory' => $_GET['id_category'] ?? null,
            'selectedTags' => $_GET['tag'] ?? null,

        ]);
        $this->pageContent['jquery'] = true;

        
    }
}
