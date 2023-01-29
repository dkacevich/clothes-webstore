<?php

namespace Modules\_base;

use System\DB;
use RedBeanPHP\R;

class Model {
    protected DB $db;

    public function __construct(DB $db) {
        $this->db = $db;
    }


    public function getCategories(): array {
        $query = "SELECT * FROM categories";
        return R::getAll($query);
    }

    public function getTags(): array {
        $query = "SELECT * FROM tags";
        return R::getAll($query);
    }
    
}
