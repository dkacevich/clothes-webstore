<?php

namespace Modules\Catalog\Models;

use Exception;
use Modules\_base\Model as BaseModel;
use System\ArrayHelper;
use System\DB;
use RedBeanPHP\R;
use System\Pagination;

class Index extends BaseModel {
    const LIMIT = 5;
    protected int $offset = 0;
    public int $cnt;
    public array $paginationLinks;
    public array $priceRange;
    public array $totalPriceRange;

    protected DB $db;
    protected string $table = 'products';

    public function __construct(DB $db) {
        parent::__construct($db);
        $this->cnt = $this->getTotalCount();
        $this->totalPriceRange = $this->getPriceRange();
        $this->priceRange = $this->totalPriceRange;
    }


    protected function getTotalCount() {
        return R::count($this->table);
    }
    public function getPriceRange(string $paramsSql = '', array $binds = []) {

        $min = R::getCell("SELECT MIN(price) FROM {$this->table} $paramsSql", $binds);
        $max = R::getCell("SELECT MAX(price) FROM {$this->table} $paramsSql", $binds);

        return ['min' => $min, 'max' => $max];
    }

    public function getPagination(int $page) {
        $pagination = new Pagination($page, self::LIMIT, $this->cnt);

        $this->offset = $pagination->setOffset();
        $this->paginationLinks = $pagination->getLinks();
    }

    public function getProducts(array $params): array {

        $valuesArr = [':offset' => &$this->offset, ':limit' => self::LIMIT];
        $filterCount = 0;

        $category = '';
        $idProducts = '';
        $sorting = '';
        $range = '';
        


        if (isset($params['tag'])) {
            $allowedTags = $this->getTags();
            $isTagAllowed = false;

            foreach ($allowedTags as $allowedTag) {
                foreach ($params['tag'] as $paramsTag) {
                    if ($allowedTag['id'] === $paramsTag) {
                        $isTagAllowed = true;
                        $filterCount++;
                    }
                }
            }
        }


        if (isset($isTagAllowed) && !$isTagAllowed) {
            throw new Exception("This Tags not found");
        } else if (isset($isTagAllowed) && $isTagAllowed) {
            // TODO later change to Inner Join
            $productsWithTag = R::find('tags_products', 'id_tag IN ('.R::genSlots($params['tag']).')', $params['tag']);

            $productsStr = '';
            foreach ($productsWithTag as $product) {
                $productsStr .= "$product->id_product,";
            }
            $productsStr = rtrim($productsStr, ',');
            $idProducts = ($category === '' ? ' WHERE' : ' AND ') . " id IN ($productsStr)";
        }


        if (isset($params['id_category'])) {
            $allowedCategories = $this->getCategories();
            $isCategoryAllowed = false;

            foreach ($allowedCategories as $category) {
                if ($category['id'] === $params['id_category']) {
                    $isCategoryAllowed = true;
                    $filterCount++;
                }
            }
        }

        if (isset($isCategoryAllowed) && !$isCategoryAllowed) {
            throw new Exception("This category not found");
        } else if (isset($isCategoryAllowed) && $isCategoryAllowed) {
            $category = ($filterCount <= 1 ? ' WHERE' : ' AND ') . " id_category = :id_category ";
            $valuesArr[':id_category'] = $params['id_category'];
        }


        if (isset($params['min']) && isset($params['min'])) {
            $filterCount += 2;
            $this->priceRange = ['min' => $params['min'], 'max' => $params['max']];
            $range = ($filterCount <= 2 ? ' WHERE ' : ' AND ') . "price BETWEEN :min AND :max";
            $valuesArr[':min'] = $params['min'];
            $valuesArr[':max'] = $params['max'];

        }


        $allowedSorting = [
            'name_asc' => "ORDER BY name ASC",
            'price_asc' => "ORDER BY price ASC",
            'date_asc' => "ORDER BY dt_add ASC",
            'name_desc' => "ORDER BY name DESC",
            'price_desc' => "ORDER BY price DESC",
            'date_desc' => "ORDER BY dt_add DESC",
        ];

        if (isset($params['sort']) && array_key_exists($params['sort'], $allowedSorting)) {
            $sorting = $allowedSorting[$params['sort']];
        }

        $baseSql = "SELECT * FROM {$this->table}";
        $paramsSql = " $idProducts $category $range $sorting LIMIT :offset, :limit";
        $sql = trim($baseSql . $paramsSql);

        $this->cnt = R::count($this->table, $paramsSql, $valuesArr);
        $this->getPagination($params['page'] ?? 1);

        // $this->priceRange = $this->getPriceRange($paramsSql, $valuesArr);

        $arr = R::getAll($sql, $valuesArr);


        return $arr;
    }

    public function checkURI(string $uri): string {
        if (str_contains($uri, '?')) {
            if (!preg_match('/&*page=\d/', $uri)) $uri .= '&page=1';
        } else {
            if (!preg_match('/&page=\d/', $uri)) $uri .= '?page=1';
        }

        return $uri;
    }
}
