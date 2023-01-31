<?php

namespace Modules\Cart\Controllers;

use Error;
use Exception;
use Modules\_base\Controller as BaseController;
use Modules\Cart\Models\Index as Model;
use System\DB;
use RedBeanPHP\R;
use System\Exceptions\ExcValidate;

class Index extends BaseController {
    public Model $model;
    protected DB $db;

    public function __construct() {
        parent::__construct();
        $this->db = DB::getInstance();
        $this->model = new Model($this->db);
    }


    public function index() {
        $this->pageContent['title'] = 'Корзина товаров';
        $this->pageContent['content'] = $this->view->render('Cart/Views/v_cart.twig', [
            'products' => $this->model->getProducts($_SESSION),
            'totalSum'  => $this->model->totalSum,
            'totalQty' => $this->model->totalQty,
        ]);
    }

    public function checkout() {
        $res = [
            'errors' => [],
            'message' => ''
        ];

        try {
            $this->model->checkout($_POST, $_SESSION);
            unset($_SESSION['cart']);
        } catch (ExcValidate $e) {
            $bag = $e->getBag();
            $errors = $bag->firstOfAll();
            $res['errors'] = $errors;
        }
        
        echo json_encode($res);
    }



    public function add() {
        $res = [
            'errors' => [],
            'message' => ''
        ];


        try {
            $this->model->addProduct($_POST, $_SESSION);
        } catch (Exception $e) {
            $res['errors'][] = $e->getMessage();
        }
        
        echo json_encode($res);
    }

    public function remove() {
        $res = [
            'errors' => [],
            'message' => ''
        ];


        try {
            $this->model->removeProduct($_POST, $_SESSION);
        } catch (Exception $e) {
            $res['errors'][] = $e->getMessage();
        }
        
        echo json_encode($res);
    }

}
