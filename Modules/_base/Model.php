<?php

namespace Modules\_base;

use System\Database\Connection;

class Model {
    protected Connection $db;

    public function __construct(Connection $db) {
        $this->db = $db;
    }


    public function getCategories(): array {
        $query = "SELECT * FROM categories";
        return $this->db->select($query);
    }

    public function getTags(): array {
        $query = "SELECT * FROM tags";
        return $this->db->select($query);
    }
    
}
