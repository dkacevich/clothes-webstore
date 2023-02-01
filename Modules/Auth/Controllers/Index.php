<?php


namespace Modules\Auth\Controllers;

use Exception;
use Modules\_base\Controller as BaseController;
use Modules\Auth\Models\Index as Model;
use System\DB;
use System\Exceptions\ExcValidate;
use System\Session;

class Index extends BaseController{
    public Model $model;
    protected DB $db;

    public function __construct() {
        parent::__construct();
        $this->db = DB::getInstance();
        $this->model = new Model($this->db);
    }

    public function loginPage() {
        $this->pageContent['title'] = "Вход";
        $this->pageContent['content'] = $this->view->render('Auth/Views/v_login.twig');
    }

    public function registerPage() {
        $this->pageContent['title'] = "Регистрация";
        $this->pageContent['content'] = $this->view->render('Auth/Views/v_register.twig');
    }

    public function login() {
        $res = [
            'errors' => [],
            'message' => ''
        ];


        try {
            $this->model->login($_POST);
        } catch (ExcValidate $e) {
            $bag = $e->getBag();
            $errors = $bag->firstOfAll();
            $res['errors'] = $errors;
        } catch (Exception $e) {
            $res['errors'][] = $e->getMessage();
        }
        
        echo json_encode($res);
    }

    public function register() {
        $res = [
            'errors' => [],
            'message' => ''
        ];


        try {
            $this->model->register($_POST);
        } catch (ExcValidate $e) {
            $bag = $e->getBag();
            $errors = $bag->firstOfAll();
            $res['errors'] = $errors;
        } catch (Exception $e) {
            $res['errors'][] = $e->getMessage();
        }
        
        echo json_encode($res);
    }


    public function logout() {
        Session::remove('user');
        header('location: ' . BASE_URL);
    }
}
