<?php

namespace Modules\Catalog\Models;

use Exception;
use Modules\_base\Model as BaseModel;
use System\ArrayHelper;
use System\DB;
use RedBeanPHP\R;
use System\Pagination;

class Index extends BaseModel {
    const LIMIT = 2;
    protected int $offset = 0;
    public int $cnt;
    public array $paginationLinks;

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

    public function getPagination(int $page) {
        $pagination = new Pagination($page, self::LIMIT, $this->cnt);

        $this->offset = $pagination->setOffset();
        $this->paginationLinks = $pagination->getLinks();
    }

    public function getProducts(array $params): array {

        $valuesArr = [':offset' => &$this->offset, ':limit' => self::LIMIT];
        $filterCount = 0;


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

        $category = '';
        if (isset($isCategoryAllowed) && !$isCategoryAllowed) {
            throw new Exception("This category not found");
        } else if (isset($isCategoryAllowed) && $isCategoryAllowed) {
            $category = " id_category = :id_category ";
            $valuesArr[':id_category'] = $params['id_category'];
        }


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

        $idProducts = '';
        if (isset($isTagAllowed) && !$isTagAllowed) {
            throw new Exception("This Tags not found");
        } else if (isset($isTagAllowed) && $isTagAllowed) {
            // $tags = "INNER JOIN tags_products ON {$this->table}.id = tags_products.id";
            // $category = " id_category = :id_category ";
            // $valuesArr[':id_category'] = $params['id_category'];
            $productsWithTag = R::find('tags_products', 'id_tag IN ('.R::genSlots($params['tag']).')', $params['tag']);

            $productsStr = '';
            foreach ($productsWithTag as $product) {
                $productsStr .= "$product->id_product,";
            }
            $productsStr = rtrim($productsStr, ',');
            $idProducts = "id IN ($productsStr)";
        }




        $allowedSorting = [
            'name_asc' => "ORDER BY name ASC",
            'price_asc' => "ORDER BY price ASC",
            'date_asc' => "ORDER BY dt_add ASC",
            'name_desc' => "ORDER BY name DESC",
            'price_desc' => "ORDER BY price DESC",
            'date_desc' => "ORDER BY dt_add DESC",
        ];


        $sorting = '';

        if (isset($params['sort']) && array_key_exists($params['sort'], $allowedSorting)) {
            $sorting = $allowedSorting[$params['sort']];
        }


        var_dump($category);
        var_dump($valuesArr);
        $sql = trim("$idProducts $category $sorting LIMIT :offset, :limit");

        // var_dump($sql);

        $this->cnt = R::count($this->table, $sql, $valuesArr);
        $this->getPagination($params['page'] ?? 1);

        $arr = R::find($this->table, $sql, $valuesArr);

        // echo "<pre>";
        // print_r($arr);
        // echo "</pre>";

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
