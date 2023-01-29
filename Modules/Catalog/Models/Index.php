<?php

namespace Modules\Catalog\Models;

use Modules\_base\Model as BaseModel;
use System\ArrayHelper;
use System\DB;
use RedBeanPHP\R;
use System\Pagination;

class Index extends BaseModel {
    const LIMIT = 3;
    protected int $offset = 0;
    public int $cnt;

    protected DB $db;
    protected string $table = 'products';

    public function __construct(DB $db) {
        parent::__construct($db);
        $this->cnt = $this->getTotalCount();
    }


    protected function getTotalCount() {
       return R::count($this->table);
    }
    public function getPriceRange() {
        $query = "SELECT MIN(price) AS min, MAX(price) AS max FROM {$this->table}";
        return R::find($this->table, $query);
    }

    public function getPagination(int $page) : array {
        $pagination = new Pagination($page, self::LIMIT, $this->cnt);
        $this->offset = $pagination->setOffset();

        return $pagination->getLinks();
    }

    public function getProducts(array $params): array {
        $allowedSorting = [
            'name_asc' => "ORDER BY name ASC",
            'price_asc' => "ORDER BY price ASC",
            'name_desc' => "ORDER BY name DESC",
            'price_desc' => "ORDER BY price DESC"
        ];

        $sorting = '';

        if ($params['sort'] && array_key_exists($params['sort'], $allowedSorting)) {
            $sorting = $allowedSorting[$params['sort']];
        }

        var_dump($sorting);

        var_dump($params['sort']);
        $arr= R::find($this->table, "$sorting LIMIT ?, ?", [$this->offset, self::LIMIT]);

        return $arr;
    }

    public function checkURI(string $uri) : string {
        if (str_contains($uri, '?')) {
            if (!preg_match('/&*page=\d/', $uri)) $uri .= '&page=1';
        } else {
            if (!preg_match('/&page=\d/', $uri)) $uri .= '?page=1';
        }
        
        return $uri;
    }
}
