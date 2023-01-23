<?php

namespace System\Exceptions;

use Exception;
use Rakit\Validation\ErrorBag;

class ExcValidate extends Exception {
    protected ErrorBag $errors;

    public function __construct(string $message, ErrorBag $errors) {
        parent::__construct($message);
        $this->errors = $errors;
    }

    public function getBag() : ErrorBag {
        return $this->errors;
    }
};