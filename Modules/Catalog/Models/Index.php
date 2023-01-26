<?php

namespace Modules\Catalog\Models;

use Modules\_base\Model as BaseModel;
use System\Database\Connection;


class Index extends BaseModel {
    const LIMIT = 9;
    protected int $offset = 0;
    public int $cnt;

    protected Connection $db;
    protected string $table = 'products';

    public function __construct(Connection $db) {
        parent::__construct($db);
        // $this->totalCnt = $this->getTotalCount();
        $this->cnt = 16;
    }



    protected function getTotalCount()  {
        $query = "SELECT COUNT(*) FROM {$this->table}";
        return $this->db->select($query)[0]["COUNT(*)"];
    }


    public function getProducts(): array {

        // $cntQuery = "SELECT COUNT(id_product) FROM {$this->table}";
        // $cnt = $this->db->select($cntQuery);
        
        $query = "SELECT * FROM products LIMIT 3 OFFSET 3";
        // $query = "SELECT * FROM products LIMIT 5, " . self::LIMIT;
        $arr = $this->db->select($query);

        return array_merge($arr);
    }
}
