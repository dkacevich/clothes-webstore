<?php

namespace Modules\Auth\Models;

use Exception;
use Modules\_base\Model;
use Rakit\Validation\Validator;
use System\DB;
use System\Exceptions\ExcValidate;
use RedBeanPHP\R;
use System\Session;

class Index extends Model {
    protected Validator $validator;
    protected array $loginRules = [
        'login' => 'required|between:5,25',
        'password' => 'required|between:5,25',
    ];
    protected array $registerRules = [
        'login' => 'required|between:5,25',
        'password' => 'required|between:5,25',
        'email' => 'required|email',
        'name' => 'required|between:5,25',
    ];


    public function __construct(DB $db) {
        parent::__construct($db);
        $this->validator = new Validator();
    }

    public function login(array $fields) {
        $validation = $this->validator->validate($fields, $this->loginRules);

        if ($validation->fails()) {
            throw new ExcValidate('Validation fails in Add module', $validation->errors());
        }

        $params = array_map('trim', $fields);

        $user = R::getRow('SELECT * FROM users WHERE login = :login', [':login' => $params['login']]);

        if (!$user || !password_verify($params['password'], $user['password'])) {
            throw new Exception("Login or Password are wrong", 1);
        }

        $token = bin2hex(random_bytes(64));
        $status = $user['id_status'];

        $session = R::dispense('sessions');
        $session->token = $token;
        $session->id_user = $user['id'];

        R::store($session);

        Session::set('token', $token, 'user');
        Session::set('status', $status, 'user');

    }

    public function register(array $fields) {
        $validation = $this->validator->validate($fields, $this->registerRules);

        if ($validation->fails()) {
            throw new ExcValidate('Validation fails in Add module', $validation->errors());
        }

        $params = array_map('trim', $fields);

        $user = R::getRow('SELECT * FROM users WHERE login = :login', [':login' => $params['login']]);

        if ($user) {
            throw new Exception("Sorry this login already taken", 1);
        }

        $newUser = R::dispense('users');
        foreach ($params as $key => $value) {
            if ($key === 'password') {
                $newUser->$key = password_hash($value, PASSWORD_BCRYPT);
                continue;
            }

            $newUser->$key = $value;
        }
        R::store($newUser);

        $token = bin2hex(random_bytes(64));
        $status = UserStatuses::buyer;

        Session::set('token', $token, 'user');
        Session::set('status', $status, 'user');

    }
}