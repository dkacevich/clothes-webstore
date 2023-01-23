<?php

namespace Modules\Add\Controllers;

use Aws\S3\Exception\S3Exception;
use Exception;
use Modules\_base\Controller as BaseController;
use Modules\Add\Models\Index as Model;
use System\Exceptions\ExcValidate;

class Index extends BaseController {
    public Model $model;

    public function __construct() {
        parent::__construct();
        $this->model = new Model();
    }

    public function index() {
        $this->pageContent['title'] = 'Добавить товар';
        $this->pageContent['content'] = $this->view->render('Add/Views/v_add.twig');
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
        //  catch (Exception $e) {
        //     echo $e->getMessage();
        //     exit();
        // }

        echo json_encode($res);

        // echo json_encode([$_POST, $_FILES]);
        //    $this->model->add($_POST, $_GET)
        // [$_FILES['product-photo']['name'], ['errors' => []]]
    }
}
