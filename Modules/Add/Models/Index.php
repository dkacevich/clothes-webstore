<?php

namespace Modules\Add\Models;

use Rakit\Validation\Validator;
use System\Exceptions\ExcValidate;

class Index {
    protected Validator $validator;
    protected array $validateRules = [
        'product-name' => 'required|min:2',
		'product-price' => 'required|numeric',
        'product-photo' => 'uploaded_file|max:5M|mimes:jpeg,png',
    ];
    

    public function __construct() {
        // TODO Dependency injection
        $this->validator = new Validator();
    }

    public function add(array $fields) {
        $validation = $this->validator->validate($fields, $this->validateRules);
        
        if ($validation->fails()) {
            throw new ExcValidate('Validation fails in Add module', $validation->errors());
        }

        // if (!isset($fields['product-photo']['error'])) {

        // }
    }
}