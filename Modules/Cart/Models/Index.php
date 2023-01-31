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

    protected string $table = 'products';

    public function __construct(DB $db) {
        parent::__construct($db);
    }

    public function add($params, &$sessions) {
        
        $id = $params['id'];

        if (!isset($sessions['cart'])) {
            $sessions['cart'] = [];
        }

        $cart = &$sessions['cart'];

        $product = R::getRow("SELECT * FROM {$this->table} WHERE id = :id", [':id' => $id]);

        if (empty($product)) {
            throw new Exception('Id not found');
        }

        $product['qty'] = 1;


        if (!array_key_exists($id, $cart)) {
            $cart[$id] = $product;
        } else {
            $cart[$id]['qty']++;
        }

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

}
