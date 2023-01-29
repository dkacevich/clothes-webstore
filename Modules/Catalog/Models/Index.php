<?php

namespace Modules\Catalog\Models;

use Modules\_base\Model as BaseModel;
use System\ArrayHelper;
use System\DB;
use RedBeanPHP\R;
use System\Pagination;

class Index extends BaseModel {
    const LIMIT = 1;
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
        $this->offset = $pagination->setOffet();

        return $pagination->getLinks();
    }

    public function getProducts(): array {
        $arr= R::find($this->table, 'LIMIT ?, ?', [$this->offset, self::LIMIT]);

        return $arr;
    }
}
