<?php

namespace System;

class Pagination {

    protected string $page;
    protected int $limit;
    protected int $itemCount;
    protected int $pageCount;
    protected string $uri;


    public function __construct( string $page, int $limit, int $itemCount ) {
        $this->limit = $limit;
        $this->itemCount = $itemCount;
        $this->pageCount = $this->getCountPages();
        $this->page = $this->setPage($page);
        $this->uri = $this->getURI();

    }

    public function setOffet() : int {
        return ($this->page - 1) * $this->limit;
    }

    public function getLinks() {
        $links = [];

        // start Link
        $links[1] = $this->setLink(1);
        // prev
        if ($this->page > 2) {
            $links[$this->page - 1] = $this->setLink($this->page - 1);
        }
        // current
        $links[$this->page] = $this->setLink($this->page);

        // next
        if ($this->page < $this->pageCount - 1) {
            $links[$this->page + 1] = $this->setLink($this->page + 1);
        }
        // end Link
        $links[$this->pageCount] = $this->setLink($this->pageCount);

        return $links;
    }


    protected function setPage(int $page) {
        if ($page > $this->pageCount) $page = $this->pageCount;
        if ($page <= 0) $page = 1;

        return $page;
    }

    protected function getCountPages() {
        return ceil($this->itemCount / $this->limit);
    }


    public function setLink(string $page) : string {
        $link = $this->uri . "page=$page";
        return $link;
    }

    protected function getURI() {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0];
        if (isset($url[1]) && $url[1] != '') {
            $uri .= '?';
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                if (!preg_match("#page=#", $param)) $uri .= "{$param}&";
            }
        }
        return $uri;
    }
}
