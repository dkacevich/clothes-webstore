<?php


namespace System;


class Pagination {

    public $currentPage;
    public $perpage;
    public $total;
    public $countPages;
    public $uri;

    public function __construct($page, $perpage, $total) {
        $this->perpage = $perpage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }

    public function getPageData(): array {
        $pageLinks = [];

        // $startpage
        if ($this->currentPage > 2) {
            $pageLinks[1] = $this->getLink(1);
        }
        

        // $back
        if ($this->currentPage > 1) {
            $pageLinks[$this->currentPage - 1] = $this->getLink($this->currentPage - 1);
        }

        $pageLinks[$this->currentPage] = $this->getLink($this->currentPage);

        // $forward
        if ($this->currentPage < $this->countPages) {
            $pageLinks[$this->currentPage + 1] = $this->getLink($this->currentPage + 1);
        }

     
        // $endpage
        if ($this->currentPage < ($this->countPages - 2)) {
            $pageLinks[$this->countPages] = $this->getLink($this->countPages);
        }

        return $pageLinks;
    }

    public function getLink($page) {
        if ($page == 1) {
            return rtrim($this->uri, '?&');
        }

        if (str_contains($this->uri, '&')) {
            return "{$this->uri}page={$page}";
        } else {
            if (str_contains($this->uri, '?')) {
                return "{$this->uri}page={$page}";
            } else {
                return "{$this->uri}?page={$page}";
            }
        }
    }


    public function getCountPages() {
        return ceil($this->total / $this->perpage) ?: 1;
    }

    public function getCurrentPage($page) {
        if (!$page || $page < 1) $page = 1;
        if ($page > $this->countPages) $page = $this->countPages;
        return $page;
    }

    public function getStart() {
        return ($this->currentPage - 1) * $this->perpage;
    }

    public function getParams() {
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
