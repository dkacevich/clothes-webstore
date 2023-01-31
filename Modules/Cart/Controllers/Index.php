<?php

namespace Modules\Cart\Controllers;

use Error;
use Exception;
use Modules\_base\Controller as BaseController;
use Modules\Cart\Models\Index as Model;
use System\DB;
use RedBeanPHP\R;

class Index extends BaseController {
    public Model $model;
    protected DB $db;

    public function __construct() {
        parent::__construct();
        $this->db = DB::getInstance();
        $this->model = new Model($this->db);
    }

    public function add() {
        $res = [
            'errors' => [],
            'message' => ''
        ];


        try {
            $this->model->add($_POST, $_SESSION);
        } catch (Exception $e) {
            $res['errors'][] = $e->getMessage();
        }
        
        echo json_encode($res);
    }

}
