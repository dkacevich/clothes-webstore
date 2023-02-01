<?php

namespace Modules\Add\Controllers;

use Exception;
use Modules\_base\Controller as BaseController;
use Modules\Add\Models\Index as Model;
use Modules\Auth\Models\UserStatuses;
use System\DB;
use System\Exceptions\ExcValidate;
use RedBeanPHP\R;
use System\Session;

class Index extends BaseController {
    public Model $model;
    protected DB $db;

    public function __construct() {
        parent::__construct();
        $this->db = DB::getInstance();
        $this->model = new Model($this->db);
    }

    public function index() {
       

        if (!Session::get('user') || Session::get('status', 'user') != UserStatuses::admin) {
            header('location: ' . BASE_URL);
        }

        $this->pageContent['title'] = 'Добавить товар';
        $this->pageContent['content'] = $this->view->render('Add/Views/v_add.twig', [
            'categories' => $this->model->getCategories(),
            'tags' => $this->model->getTags()
        ]);
    }

    public function add() {
        $res = [
            'errors' => [],
            'message' => ''
        ];

        try {
            $this->model->add($_POST + $_FILES);
        } catch (ExcValidate $e) {
            $bag = $e->getBag();
            $errors = $bag->firstOfAll();
            $res['errors'] = $errors;
        }

        echo json_encode($res);
    }
}
