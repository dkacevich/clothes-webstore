<?php

namespace Modules\Catalog\Models;

use Modules\_base\Model as BaseModel;
use System\ArrayHelper;
use System\Database\Connection;

use function Aws\filter;

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



    protected function getTotalCount() {
        $query = "SELECT COUNT(*) FROM {$this->table}";
        return $this->db->select($query)[0]["COUNT(*)"];
    }

    public function getPriceRange() {
        $query = "SELECT MIN(price) AS min, MAX(price) AS max FROM {$this->table}";
        return $this->db->select($query)[0];
    }

    public function getProducts(array $filters): array {

        $query = "SELECT * FROM products ";
        $validFilters = [];

        if (!empty($filters)) {
            $validFilters = ArrayHelper::htmlChars($filters);

            if (isset($validFilters['tag'])) {
                $query .= "INNER JOIN tags_products ON products.id_product = tags_products.id_product ";
            }

            if (isset($validFilters['id_category']) && $validFilters['id_category'] === '*') {
                unset($validFilters['id_category']);
            }


            $i = 0;
            foreach ($validFilters as $filter => $value) {
                // if ($filter === 'min' || $filter === 'max') {
                if (preg_match('/m../', $filter)) {
                    continue;
                }

                
                if (!$i) {
                    $query .= "WHERE ";
                } else {
                    $query .= " AND ";
                }

                if ($filter === 'tag') {
                    $tagsArr = [];

                    for ($j = 1; $j  < count($value) + 1; $j++) {
                        $tagsArr["id_tag_$j"] = $validFilters['tag'][$j - 1];
                        if ($j === 1) {
                            $query .= "(";
                        }
                        $query .= "id_tag = :id_tag_$j ";

                        if ($j === count($value)) {
                            $query .= ")";
                        } else {
                            $query .= "OR ";
                        }
                    }
                    $validFilters += $tagsArr;
                    unset($validFilters['tag']);
                    $i++;
                    continue;
                }


                $query .= "$filter = :$filter";
                $i++;
            }

            if ($i === 0) {
                $query .= " WHERE";
            } else {
                $query .= " AND";
            }
            $query .= " price >= :min AND price <= :max";
        }

        $query .= " LIMIT " . self::LIMIT;

        echo "<pre>";
        var_dump($query);
        echo "</pre>";

        $arr = $this->db->select($query, $validFilters);

        echo "<pre>";
        print_r($arr);
        echo "</pre>";

        return array_merge($arr);
    }
}
