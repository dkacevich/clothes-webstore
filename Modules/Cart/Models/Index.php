<?php

namespace Modules\Cart\Models;

use Exception;
use Modules\_base\Model as BaseModel;
use Rakit\Validation\Validator;
use System\ArrayHelper;
use System\DB;
use System\Exceptions\ExcValidate;
use RedBeanPHP\R;

class Index extends BaseModel {

    public int $totalSum = 0;
    public int $totalQty = 0;

    protected Validator $validator;
    protected array $validateRules = [
        'firstname' => 'required|min:2',
        'lastname' => 'required|min:2',
        'phone' => 'required|regex:/^\+\d{10,12}$/',
        'email' => 'required|email',
    ];


    public function __construct(DB $db) {
        parent::__construct($db);
        $this->validator = new Validator();
    }


    public function checkout(array $fields, array &$sessions) {
        $validation = $this->validator->validate($fields, $this->validateRules);

        if ($validation->fails()) {
            throw new ExcValidate('Validation fails in Add module', $validation->errors());
        }

        $params = array_map('trim', $fields);

        $order = R::dispense('orders');
        foreach ($params as $key => $value) {
            if (!empty($value)) {
                $order->$key = $value;
            }
        }
        $orderId = R::store($order);

        
        // Save order products to separate DB

        foreach ($sessions['cart'] as $key => $product) {
            if (is_int($key)) {
                $tagBean = R::xdispense('orders_products');
                $tagBean->id_order = $orderId;
                $tagBean->id_product = $product['id'];
                $tagBean->product_qty = $product['qty'];
                
                R::store($tagBean);
            }
        }
    }



    public function getProducts($sessions): array {

        $res = [];

        if (isset($sessions['cart'])) {
            foreach ($sessions['cart'] as $id => $product) {
                if (is_int($id)) {
                    $res[] = $product;
                }
            }


            $this->totalQty = $sessions['cart']['totalQty'];
            $this->totalSum = $sessions['cart']['totalSum'];
        }

        return $res;
    }

    public function addProduct($params, &$sessions) {

        $id = $params['id'];

        if (!isset($sessions['cart'])) {
            $sessions['cart'] = [];
        }

        $cart = &$sessions['cart'];

        $product = R::getRow("SELECT * FROM products WHERE id = :id", [':id' => $id]);

        if (empty($product)) {
            throw new Exception('Id not found');
        }

        $product['qty'] = 1;


        if (!array_key_exists($id, $cart)) {
            $cart[$id] = $product;
        } else {
            $cart[$id]['qty']++;
        }

        $this->calcAssets($cart);
    }

    public function calcAssets(array &$cart) {
        $totalSum = 0;
        $totalQty = 0;

        foreach ($cart as $id => $product) {
            if (is_int($id)) {
                $totalSum += $product['qty'] * $product['price'];
                $totalQty += $product['qty'];
            }
        }

        $cart['totalSum'] = $totalSum;
        $cart['totalQty'] = $totalQty;
    }

    public function removeProduct($params, &$sessions) {

        $id = $params['id'];


        $cart = &$sessions['cart'];

        if (array_key_exists($id, $cart)) {
            unset($cart[$id]);
        } else {
            throw new Exception('Id not found');
        }

        $this->calcAssets($cart);
    }
}
