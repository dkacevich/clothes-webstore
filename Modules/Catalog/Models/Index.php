<?php

namespace Modules\Catalog\Models;

use System\Database\Connection;


class Index {
    const LIMIT = 2;
    protected int $offset = 0;

    protected Connection $db;
    protected string $table = 'products';

    public function __construct(Connection $db) {
        $this->db = $db;
    }





    public function getProducts(): array {

        // $cntQuery = "SELECT COUNT(id_product) FROM {$this->table}";
        // $cnt = $this->db->select($cntQuery);
        
        $query = "SELECT * FROM products LIMIT 3 OFFSET 3";
        // $query = "SELECT * FROM products LIMIT 5, " . self::LIMIT;
        $arr = $this->db->select($query);

        var_dump($query);
        return array_merge($arr);
    }
}
