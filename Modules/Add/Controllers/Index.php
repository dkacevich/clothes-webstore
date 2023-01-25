<?php

namespace Modules\Add\Controllers;

use Aws\S3\Exception\S3Exception;
use Modules\_base\Controller as BaseController;
use Modules\Add\Models\Index as Model;
use System\Database\Connection;
use System\Exceptions\ExcValidate;

class Index extends BaseController {
    public Model $model;
    protected Connection $db;

    public function __construct() {
        parent::__construct();
        $this->db = Connection::getInstance();
        $this->model = new Model($this->db);
    }

    public function index() {
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
        } catch (S3Exception $e) {
            $res['errors'] = $e->getAwsErrorMessage();
        }
       

        echo json_encode($res);
    }
}
